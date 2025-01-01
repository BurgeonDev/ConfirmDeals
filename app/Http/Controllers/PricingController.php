<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coin; // Make sure to import the Coin model

class PricingController extends Controller
{
    public function index()
    {
        // Fetch all coins from the database
        $coins = Coin::all();

        // Pass the coins data to the view
        return view('frontend.pricing.index', compact('coins'));
    }
}
