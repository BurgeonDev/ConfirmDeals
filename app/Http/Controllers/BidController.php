<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\BidReceivedNotification;
use App\Notifications\BidStatusNotification;


class BidController extends Controller
{
    public function placeBid(Request $request, $adId)
    {
        $ad = Ad::findOrFail($adId);
        $user = auth()->user();

        // Check if the user has enough coins
        if ($user->coins < $ad->coins_needed) {
            return redirect()->back()
                ->withErrors(['You do not have enough coins to bid on this ad.']);
        }
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
        // Assume $bid is the bid object
        $ad = $bid->ad; // Retrieve the ad associated with the bid
        $adOwner = $ad->user; // Assuming the ad has a user relation

        // Notify the ad owner
        $adOwner->notify(new BidReceivedNotification($ad));
        // return redirect()->route('ad.show', $adId)->with('success', 'Bid placed successfully!');
        return view('frontend.bids.success');
    }


    public function acceptBid($bidId)
    {
        $bid = Bid::findOrFail($bidId);
        $adOwner = $bid->ad->user; // User B (ad owner)
        $bidder = $bid->user; // User A (the bidder)

        // Reject all other bids for the ad
        Bid::where('ad_id', $bid->ad_id)->where('id', '!=', $bid->id)->update(['status' => 'rejected']);

        // Accept the selected bid
        $bid->status = 'accepted';
        $bid->save();

        // Notify User A (the bidder) about the accepted bid
        $bidder->notify(new BidStatusNotification($bid, 'accepted'));

        return redirect()->back()->with('success', 'Bid accepted successfully!');
    }

    public function rejectBid($bidId)
    {
        $bid = Bid::findOrFail($bidId);
        $bidder = $bid->user; // User A (the bidder)

        // Reject the bid
        $bid->status = 'rejected';
        $bid->save();

        // Notify User A (the bidder) about the rejected bid
        $bidder->notify(new BidStatusNotification($bid, 'rejected'));

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

        // Retrieve user bids categorized by status
        $pendingBids = Bid::where('user_id', $user->id)
            ->where('status', 'pending')
            ->with('ad')
            ->paginate(5, ['*'], 'pending_page');

        $acceptedBids = Bid::where('user_id', $user->id)
            ->where('status', 'accepted')
            ->with('ad')
            ->paginate(5, ['*'], 'accepted_page');

        $rejectedBids = Bid::where('user_id', $user->id)
            ->where('status', 'rejected')
            ->with('ad')
            ->paginate(5, ['*'], 'rejected_page');

        return view('frontend.bids.myBids', compact('pendingBids', 'acceptedBids', 'rejectedBids'));
    }
}
