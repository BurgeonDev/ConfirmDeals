<?php

// app/Http/Controllers/FavoriteController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;
use App\Models\User;

class FavoriteController extends Controller
{
    // Add or remove favorite
    public function toggle(Request $request)
    {
        $user = Auth::user();
        $adId = $request->input('ad_id');

        // Check if favorite exists
        $favorite = Favorite::where('user_id', $user->id)->where('ad_id', $adId)->first();

        if ($favorite) {
            // Remove from favorites
            $favorite->delete();
            return redirect()->back()->with('status', 'Ad removed from favorites');
        } else {
            // Add to favorites
            Favorite::create([
                'user_id' => $user->id,
                'ad_id' => $adId,
            ]);
            return redirect()->back()->with('status', 'Ad added to favorites');
        }
    }
    public function index()
    {
        $favorites = Favorite::with('ad.category')->where('user_id', Auth::id())->get();


        return view('frontend.favorites.index', compact('favorites'));
    }
}
