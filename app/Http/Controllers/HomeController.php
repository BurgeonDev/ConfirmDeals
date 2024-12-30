<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\City;
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
        $verifiedAds = Ad::with('user')
            ->where('is_verified', true)->limit(8)
            ->get();
        $serviceAds = $verifiedAds->where('type', 'service');
        $productAds = $verifiedAds->where('type', 'product');

        $latestAds = Ad::with('user')->where('type', 'product')->where('is_verified', true)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        $categories = Category::all();
        $professions = Profession::all();
        $categoryIcons = [
            'Electronics' => 'fas fa-tv',                // TV for electronics
            'Furniture' => 'fas fa-couch',               // Couch for furniture
            'Books' => 'fas fa-book',                    // Book for books
            'Clothing' => 'fas fa-tshirt',               // T-shirt for clothing
            'Sports' => 'fas fa-tv',               // Football for sports
            'Toys' => 'fas fa-puzzle-piece',             // Puzzle piece for toys
            'Health & Beauty' => 'fas fa-stethoscope',      // Lipstick for health & beauty
            'Automotive' => 'fas fa-car',                // Car for automotive
            'Jewelry' => 'fas fa-gem',                   // Gem for jewelry
            'Groceries' => 'fas fa-hamburger',           // Hamburger for groceries
            'Home Appliances' => 'fas fa-blender',       // Blender for home appliances
            'Music' => 'fas fa-music',                   // Music note for music
            'Garden' => 'fas fa-leaf',                   // Leaf for garden
            'Office Supplies' => 'fas fa-briefcase',     // Briefcase for office supplies
            'Pet Supplies' => 'fas fa-paw',             // Paw print for pet supplies
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
            'professions'
        ));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
