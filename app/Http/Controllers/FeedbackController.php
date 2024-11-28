<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Ad;

class FeedbackController extends Controller
{
    public function store(Request $request, $adId)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'comments' => 'required|string|max:1000',
        ]);

        Feedback::create([
            'ad_id' => $adId,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'comments' => $validated['comments'],
        ]);

        return redirect()->route('ad.show', $adId)
            ->with('success', 'Your comment has been posted successfully.');
    }
}
