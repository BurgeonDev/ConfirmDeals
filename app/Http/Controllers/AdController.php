<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Locality;
use Illuminate\Http\Request;

class AdController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('Manage Admin Dashbaord')) {
            abort(403, 'Unauthorized action.');
        }
        $ads = Ad::with(['user', 'category'])->paginate(10);
        return view('admin.ads.index', compact('ads'));
    }
    public function toggleVerifiedStatus(Ad $ad)
    {
        $ad->update(['is_verified' => !$ad->is_verified]);

        return redirect()->back()->with('success', 'Ad verification status updated successfully!');
    }


    public function create()
    {
        if (!auth()->user()->can('Post Ad')) {
            abort(403, 'Unauthorized action.');
        }
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


    public function show(Ad $ad)
    {
        if (!auth()->user()->can('Manage Ad')) {
            abort(403, 'Unauthorized action.');
        }
        return view('ads.show', compact('ad'));
    }

    public function edit(Ad $ad)
    {
        if (!auth()->user()->can('Manage Ad')) {
            abort(403, 'Unauthorized action.');
        }
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
        return redirect()->route('ads.index')->with('success', 'Ad deleted successfully!');
    }
}
