<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\City;
use App\Models\Coin;
use App\Models\Country;
use App\Models\Locality;
use App\Models\Profession;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    public function index()
    {
        $countries = Country::all();
        $cities = City::all();
        $localities = Locality::all();
        $coins = Coin::all();

        // Fetch featured service ads with 'verified' status
        $serviceAds = Ad::with('user')
            ->where('status', 'verified')
            ->where('type', 'service')
            ->where('is_featured', true) // Filter by featured status
            ->limit(12)
            ->get();

        // Fetch featured product ads with 'verified' status
        $productAds = Ad::with('user')
            ->where('status', 'verified')
            ->where('type', 'product')
            ->where('is_featured', true) // Filter by featured status
            ->limit(12)
            ->get();

        // Fetch latest featured product ads with 'verified' status
        $latestAds = Ad::with('user')
            ->where('type', 'product')
            ->where('status', 'verified')
            ->where('is_featured', true) // Filter by featured status
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        $categories = Category::all();
        $professions = Profession::all();

        $categoryIcons = [
            'Electronics' => 'fas fa-tv',                   // TV for electronics
            'Furniture' => 'fas fa-couch',                 // Couch for furniture
            'Books' => 'fas fa-book',                      // Book for books
            'Clothing' => 'fas fa-tshirt',                 // T-shirt for clothing
            'Sports' => 'fas fa-football-ball',            // Football for sports
            'Toys' => 'fas fa-puzzle-piece',               // Puzzle piece for toys
            'Health & Beauty' => 'fas fa-stethoscope',     // Stethoscope for health & beauty
            'Automotive' => 'fas fa-car',                  // Car for automotive
            'Jewelry' => 'fas fa-gem',                     // Gem for jewelry
            'Groceries' => 'fas fa-shopping-basket',       // Shopping basket for groceries
            'Home Appliances' => 'fas fa-blender',         // Blender for home appliances
            'Music' => 'fas fa-music',                     // Music note for music
            'Garden' => 'fas fa-leaf',                     // Leaf for garden
            'Office Supplies' => 'fas fa-briefcase',       // Briefcase for office supplies
            'Pet Supplies' => 'fas fa-paw',                // Paw print for pet supplies
            'Tools & Hardware' => 'fas fa-wrench',         // Wrench for tools & hardware
            'Toys & Games' => 'fas fa-gamepad',            // Gamepad for toys & games
            'Art & Crafts' => 'fas fa-paint-brush',        // Paintbrush for art & crafts
            'Travel & Luggage' => 'fas fa-suitcase-rolling', // Suitcase for travel & luggage
            'Baby Products' => 'fas fa-baby-carriage',     // Baby carriage for baby products
            'Watches' => 'fas fa-clock',                   // Clock for watches
            'Footwear' => 'fas fa-shoe-prints',            // Shoe prints for footwear
            'Gaming' => 'fas fa-gamepad',                  // Gamepad for gaming
            'Other' => 'fas fa-ellipsis-h',                // Ellipsis for other categories
        ];

        return view('frontend.home', compact(
            'countries',
            'cities',
            'localities',
            'serviceAds',
            'productAds',
            'latestAds',
            'categories',
            'categoryIcons',
            'professions',
            'coins'
        ));
    }
}
