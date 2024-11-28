<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BidController extends Controller
{
    use AuthorizesRequests;
    public function store(Request $request)
    {
        $request->validate([
            'ad_id' => 'required|exists:ads,id',
            'offer' => 'required|numeric|min:0.01',
        ]);

        $bid = Bid::create([
            'buyer_id' => auth()->id(),
            'ad_id' => $request->ad_id,
            'offer' => $request->offer,
        ]);

        return redirect()->route('ads.show', $request->ad_id)->with('success', 'Your bid has been placed.');
    }

    public function accept(Bid $bid)
    {
        $this->authorize('accept-bid', $bid); // Ensure only the seller can accept the bid

        $bid->update(['is_accepted' => true]);

        return redirect()->route('ads.show', $bid->ad_id)->with('success', 'Bid accepted.');
    }

    public function reject(Bid $bid)
    {
        $this->authorize('reject-bid', $bid); // Ensure only the seller can reject the bid

        $bid->update(['is_accepted' => false]);

        return redirect()->route('ads.show', $bid->ad_id)->with('success', 'Bid rejected.');
    }
}
