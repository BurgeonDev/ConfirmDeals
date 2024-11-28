<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Locality;
use Illuminate\Http\Request;
use Validator;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Load the category relationship with ads
        $ads = Ad::where('user_id', auth()->id())
            ->with('category') // Eager load the category relationship
            ->get();

        return view('frontend.postAd.index', compact('ads'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $countries = Country::with('cities.localities')->get(); // Load cities and their localities for each country
        return view('frontend.postAd.create', compact('countries', 'categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:service,product',
            'is_verified' => 'boolean',
            'pictures' => 'nullable|array',
            'pictures.*' => 'file|mimes:jpg,jpeg,png|max:2048',
            'price' => 'nullable|numeric|min:0',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
            'locality_id' => 'nullable|exists:localities,id',
            'coins_needed' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',

        ]);

        if ($request->hasFile('pictures')) {
            $validatedData['pictures'] = array_map(
                fn($file) => $file->store('ads', 'public'),
                $request->file('pictures')
            );
        }

        Ad::create($validatedData);

        return redirect()->route('ad.index')->with('success', 'Ad created successfully!');
    }



    /**
     * Display the specified resource.
     */
    public function show(Ad $ad)
    {
        $countries = Country::with('cities.localities')->get();
        return view('frontend.postAd.show', compact('ad', 'countries'));
    }

    public function edit(Ad $ad)
    {
        $categories = Category::all();
        $countries = Country::with('cities.localities')->get();
        $oldPictures = $ad->pictures; // Assuming 'pictures' is a JSON or array of image paths

        return view('frontend.postAd.edit', compact('ad', 'categories', 'countries', 'oldPictures'));
    }



    public function update(Request $request, $id)
    {
        // Find the ad by ID
        $ad = Ad::findOrFail($id);

        // Validate the input
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:service,product',
            'is_verified' => 'boolean',
            'pictures' => 'nullable|array',
            'pictures.*' => 'file|mimes:jpg,jpeg,png|max:2048',
            'price' => 'nullable|numeric|min:0',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
            'locality_id' => 'nullable|exists:localities,id',
            'coins_needed' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Check if new pictures are uploaded
        if ($request->hasFile('pictures')) {
            // Store new pictures
            $validatedData['pictures'] = array_map(
                fn($file) => $file->store('ads', 'public'),
                $request->file('pictures')
            );
        }

        // Update the ad with the validated data
        $ad->update($validatedData);

        // Redirect or return a success response
        return redirect()->route('ad.index')->with('success', 'Ad updated successfully!');
    }


    public function destroy(Ad $ad)
    {
        $ad->delete();
        return redirect()->route('ad.index')->with('success', 'Ad deleted successfully!');
    }
}
