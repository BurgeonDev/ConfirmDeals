<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    public function placeBid(Request $request, $adId)
    {
        $ad = Ad::findOrFail($adId);
        $user = auth()->user();

        // Validate the bid
        $request->validate([
            'offer' => 'required|numeric', // Removed the dynamic minimum offer condition
        ]);

        // Create the bid
        $bid = new Bid();
        $bid->user_id = $user->id;
        $bid->ad_id = $adId;
        $bid->offer = $request->offer;
        $bid->status = 'pending'; // Default status
        $bid->save();

        return redirect()->route('ad.show', $adId)->with('success', 'Bid placed successfully!');
    }


    public function acceptBid($bidId)
    {
        $bid = Bid::findOrFail($bidId);



        // Reject all other bids for the ad
        Bid::where('ad_id', $bid->ad_id)->update(['status' => 'rejected']);

        // Accept the selected bid
        $bid->status = 'accepted';
        $bid->save();

        return redirect()->back()->with('success', 'Bid accepted successfully!');
    }

    public function rejectBid($bidId)
    {
        $bid = Bid::findOrFail($bidId);

        // Ensure the user is authorized to reject bids


        // Reject the bid
        $bid->status = 'rejected';
        $bid->save();

        return redirect()->back()->with('success', 'Bid rejected successfully!');
    }

    public function showAllBids()
    {
        $user = Auth::user();

        // Retrieve all ads with their bids
        $ads = $user->ads()->with('bids.user')->get();

        return view('frontend.bids.index', compact('ads'));
    }
    public function showMyBids()
    {
        $user = Auth::user();

        // Retrieve all bids made by the user, with the ad details
        $bids = Bid::where('user_id', $user->id)->with('ad')->get();

        return view('frontend.bids.myBids', compact('bids'));
    }
}
