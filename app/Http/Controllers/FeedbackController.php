<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Ad;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request, Ad $ad)
    {
        $request->validate([
            'seller_rating' => 'required|integer|between:1,5',
            'buyer_rating' => 'required|integer|between:1,5',
            'buyer_comments' => 'required|string',
            'seller_comments' => 'nullable|string',
        ]);

        Feedback::create([
            'ad_id' => $ad->id,
            'seller_id' => $ad->user_id,  // Assuming seller is the ad's creator
            'buyer_id' => auth()->id(),
            'seller_rating' => $request->seller_rating,
            'buyer_comments' => $request->buyer_comments,
            'buyer_rating' => $request->buyer_rating,
            'seller_comments' => $request->seller_comments,
        ]);

        return redirect()->route('ads.show', $ad->id)->with('success', 'Feedback submitted.');
    }
}
