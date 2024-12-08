<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;
use App\Models\Feedback;


class FeedbackController extends Controller
{
    // public function create($adId)
    // {
    //     $ad = Ad::findOrFail($adId);
    //     return view('feedback.create', compact('ad'));
    // }

    public function store(Request $request, $adId)
    {
        // Validate the input
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:255',
        ]);

        // Check if the ad exists
        $ad = Ad::findOrFail($adId);

        // Create a new feedback record
        $feedback = new Feedback();
        $feedback->user_id = auth()->id();
        $feedback->ad_id = $adId;
        $feedback->rating = $request->input('rating');
        $feedback->comment = $request->input('comment');
        $feedback->save();

        return redirect()->route('ad.show', $adId)
            ->with('success', 'Feedback submitted successfully!');
    }
}
