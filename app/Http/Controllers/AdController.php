<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Locality;
use Illuminate\Http\Request;
use App\Notifications\AdApprovedNotification;
use App\Notifications\AdCancelledNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('Manage Admin Dashbaord')) {
            abort(403, 'Unauthorized action.');
        }

        $ads = Ad::with(['user', 'category'])->get();
        return view('admin.ads.index', compact('ads'));
    }


    public function toggleVerifiedStatus(Request $request, Ad $ad)
    {
        if (!auth()->user()->can('Edit Ad Status')) {
            abort(403, 'Unauthorized action.');
        }
        // Validate the input status
        $validated = $request->validate([
            'status' => 'required|in:verified,cancel,expired,pending',
        ]);

        // Set the new status from the dropdown
        $ad->status = $validated['status'];
        $ad->save();

        // Notify the user based on the new status
        $adOwner = $ad->user; // Retrieve the owner of the ad
        switch ($ad->status) {
            case 'verified':
                $adOwner->notify(new AdApprovedNotification($ad));
                break;

            case 'cancel':
                $adOwner->notify(new AdCancelledNotification($ad));
                break;

                // Add cases for other statuses if needed
        }

        return redirect()->back()->with('success', 'Ad status updated successfully!');
    }


    public function destroy(Ad $ad)
    {
        $ad->delete();
        return redirect()->route('ads.index')->with('success', 'Ad deleted successfully!');
    }
    public function getCoinPriceAndBalance()
    {
        // Fetch the coin details
        $coin = DB::table('coins')->first();
        $user = Auth::user(); // Get the authenticated user

        // Check if coin price is configured correctly
        if (!$coin || $coin->price_in_pkr <= 0) {
            return response()->json(['error' => 'Coin price not configured correctly.'], 400);
        }

        // Check if the user is authenticated
        if (!$user) {
            return response()->json(['error' => 'User not authenticated.'], 401);
        }

        // Return coin price and user balance
        return response()->json([
            'price_in_pkr' => $coin->price_in_pkr,
            'user_balance' => $user->coins,
        ]);
    }
}
