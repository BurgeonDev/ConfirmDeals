<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Locality;
use Illuminate\Http\Request;
use App\Notifications\AdApprovedNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('Manage Admin Dashbaord')) {
            abort(403, 'Unauthorized action.');
        }
        $ads = Ad::with(['user', 'category'])->all();
        return view('admin.ads.index', compact('ads'));
    }
    public function toggleVerifiedStatus(Ad $ad)
    {
        $ad->is_verified = !$ad->is_verified;
        $ad->save();
        if ($ad->is_verified) {
            $adOwner = $ad->user; // Retrieve the owner of the ad
            $adOwner->notify(new AdApprovedNotification($ad));
        }
        return redirect()->back()->with('success', 'Ad verification status updated successfully!');
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
