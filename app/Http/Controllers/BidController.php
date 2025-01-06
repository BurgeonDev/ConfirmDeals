<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\BidReceivedNotification;
use App\Notifications\BidStatusNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BidController extends Controller
{
    public function placeBid(Request $request, $adId)
    {
        // Validate the bid input
        $validatedData = $request->validate([
            'offer' => 'required|numeric',
            'notes' => 'nullable|string',
            'time_slots' => 'nullable|string',
        ]);

        // Get the ad and user
        $ad = Ad::findOrFail($adId);
        $user = auth()->user();

        // Check if the user has enough coins
        if ($user->coins < $ad->coins_needed) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['coins_needed' => 'You do not have enough coins to place a bid on this ad.']);
        }

        // Begin transaction
        DB::beginTransaction();

        try {
            // Deduct coins from user
            $user->decrement('coins', $ad->coins_needed);

            // Create the bid
            $bid = new Bid();
            $bid->user_id = $user->id;
            $bid->ad_id = $adId;
            $bid->offer = $validatedData['offer'];
            $bid->status = 'pending';
            $bid->notes = $validatedData['notes'] ?? null;
            $bid->time_slots = $validatedData['time_slots'] ?? null;
            $bid->save();

            // Commit transaction
            DB::commit();

            // Notify the ad owner
            $adOwner = $ad->user; // Assuming the ad has a user relation
            $adOwner->notify(new BidReceivedNotification($ad));

            // Return success view
            return view('frontend.bids.success');
        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollBack();

            // Log the error for debugging
            Log::error('Error placing bid: ', ['error' => $e->getMessage()]);

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'An error occurred while processing your bid. Please try again.']);
        }
    }




    // public function acceptBid($bidId)
    // {
    //     $bid = Bid::findOrFail($bidId);
    //     $adOwner = $bid->ad->user; // User B (ad owner)
    //     $bidder = $bid->user; // User A (the bidder)

    //     // Reject all other bids for the ad
    //     Bid::where('ad_id', $bid->ad_id)->where('id', '!=', $bid->id)->update(['status' => 'rejected']);

    //     // Accept the selected bid
    //     $bid->status = 'accepted';
    //     $bid->save();

    //     // Notify User A (the bidder) about the accepted bid
    //     $bidder->notify(new BidStatusNotification($bid, 'accepted'));

    //     return redirect()->back()->with('success', 'Bid accepted successfully!');
    // }
    public function acceptBid($bidId)
    {
        $bid = Bid::findOrFail($bidId);
        $adOwner = $bid->ad->user; // User B (ad owner)
        $bidder = $bid->user; // User A (the bidder)

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

    // public function showAllBids()
    // {
    //     $user = Auth::user();

    //     // Retrieve all ads with their bids
    //     $ads = $user->ads()->with('bids.user')->get();

    //     return view('frontend.bids.index', compact('ads'));
    // }
    public function showAllBids()
    {
        $user = Auth::user();

        // Retrieve all ads with their bids, ensuring the ad has at least one bid, ordered by the latest bid date
        $ads = $user->ads()
            ->select('ads.id', 'ads.title', 'ads.user_id', 'ads.featured_until') // Select specific columns to avoid GROUP BY error
            ->leftJoin('bids', 'ads.id', '=', 'bids.ad_id')
            ->groupBy('ads.id', 'ads.title', 'ads.user_id', 'ads.featured_until') // Group by all selected columns
            ->havingRaw('COUNT(bids.id) > 0') // Ensure there is at least one bid for the ad
            ->orderByDesc(\DB::raw('(SELECT MAX(created_at) FROM bids WHERE bids.ad_id = ads.id)')) // Order by the latest bid date
            ->with(['bids.user' => function ($query) {
                $query->orderByDesc('created_at'); // Order bids by latest first
            }])
            ->get();

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
    public function dealPage()
    {
        $user = Auth::user();

        // Fetch accepted bids where the user is either the bidder or the ad owner (seller)
        $bids = Bid::where('status', 'accepted')
            ->where(function ($query) use ($user) {
                $query->where('user_id', $user->id) // Buyer
                    ->orWhereHas('ad', function ($query) use ($user) {
                        $query->where('user_id', $user->id); // Seller
                    });
            })
            ->with(['ad.user', 'user']) // Load ad (seller) and bid user (buyer)
            ->get();

        return view('frontend.bids.dealPage', compact('bids'));
    }
}
