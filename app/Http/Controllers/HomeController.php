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
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $countries = Country::all();
    //     $cities = City::all();
    //     $localities = Locality::all();
    //     $ads = Ad::with('user')->get();
    //     $latestAds = Ad::with('user')
    //         ->orderBy('created_at', 'desc')
    //         ->limit(3)
    //         ->get();
    //     $categories = Category::all();
    //     $professions = Profession::all();
    //     return view('frontend.home', compact(
    //         'countries',
    //         'cities',
    //         'localities',
    //         'ads',
    //         'latestAds',
    //         'categories',
    //         'professions'
    //     ));
    // }
    public function index()
    {
        $countries = Country::all();
        $cities = City::all();
        $localities = Locality::all();
        $verifiedAds = Ad::with('user')
            ->where('is_verified', true)->limit(4)
            ->get();
        $serviceAds = $verifiedAds->where('type', 'service');
        $productAds = $verifiedAds->where('type', 'product');

        $latestAds = Ad::with('user')->where('type', 'product')->where('is_verified', true)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        $categories = Category::all();
        $professions = Profession::all();

        return view('frontend.home', compact(
            'countries',
            'cities',
            'localities',
            'serviceAds',
            'productAds',
            'latestAds',
            'categories',
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
