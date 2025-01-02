<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Feedback;
use App\Models\Locality;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->can('Manage Ad')) {
            abort(403, 'Unauthorized action.');
        }
        // Load the category relationship with ads
        $ads = Ad::where('user_id', auth()->id())
            ->with('category') // Eager load the category relationship
            ->paginate(10);
        $featuredAdRate = DB::table('settings')->where('key', 'featured_ad_rate')->value('value');
        $user = auth()->user();
        return view('frontend.postAd.index', compact('ads', 'featuredAdRate', 'user'));
    }


    /**
     * Show the form for creating a new resource.
     */ public function create()
    {
        if (!auth()->user()->can('Post Ad')) {
            abort(403, 'Unauthorized action.');
        }
        $categories = Category::all();
        $countries = Country::with('cities.localities')->get();
        $localities = Locality::all();
        $cities = $countries->pluck('cities')->flatten();

        return view('frontend.postAd.create', compact('countries', 'categories', 'cities', 'localities'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:service,product',
            'is_verified' => 'boolean',
            'pictures' => 'required|array|max:5',
            'pictures.*' => 'file|mimes:jpg,jpeg,png|max:12288',
            'price' => 'required|numeric|min:0',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
            'locality_id' => 'required|exists:localities,id',
            'coins_needed' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $user = auth()->user();

        // Check if the user has enough coins
        if ($user->coins < $validatedData['coins_needed']) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['coins_needed' => 'You do not have enough coins to post this ad.']);
        }

        // Process pictures
        if ($request->hasFile('pictures')) {
            $validatedData['pictures'] = array_map(
                fn($file) => $file->store('ads', 'public'),
                $request->file('pictures')
            );
        }

        // Begin transaction
        DB::beginTransaction();

        try {
            // Deduct coins from user
            $user->decrement('coins', $validatedData['coins_needed']);

            // Create the ad
            Ad::create($validatedData);

            // Commit transaction
            DB::commit();

            return view('frontend.postAd.success');
        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'An error occurred while processing your request. Please try again.']);
        }
    }





    public function show(Ad $ad)
    {
        // Eager load the feedbacks relationship for the ad
        $ad->load('feedbacks', 'city', 'locality');

        // Load countries with related cities and localities
        $countries = Country::with('cities.localities')->get();
        $user = $ad->user; // Get the ad owner (User model)

        // Calculate the average rating for all ads owned by this user
        $averageRating = $user->ads()
            ->join('feedbacks', 'ads.id', '=', 'feedbacks.ad_id')
            ->avg('feedbacks.rating');
        return view('frontend.postAd.show', compact('ad', 'countries', 'averageRating'));
    }



    public function edit(Ad $ad)
    {
        // Check if the authenticated user is the owner of the ad
        if (auth()->id() !== $ad->user_id) {
            abort(403, 'Unauthorized action.');
        }
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
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:service,product',
            'is_verified' => 'boolean',
            'pictures' => 'nullable|array|max:5',
            'pictures.*' => 'file|mimes:jpg,jpeg,png|max:12288',
            'price' => 'required|numeric|min:0',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
            'locality_id' => 'required|exists:localities,id',
            'coins_needed' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $user = auth()->user();

        // Retrieve the ad
        $ad = Ad::findOrFail($id);

        // Restore previously deducted coins
        $user->increment('coins', $ad->coins_needed);

        // Check if the user has enough coins for the updated ad
        if ($user->coins < $validatedData['coins_needed']) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['coins_needed' => 'You do not have enough coins to update this ad.']);
        }

        // Deduct new coins required
        $user->decrement('coins', $validatedData['coins_needed']);

        // Process new pictures, if uploaded
        if ($request->hasFile('pictures')) {
            $validatedData['pictures'] = array_map(
                fn($file) => $file->store('ads', 'public'),
                $request->file('pictures')
            );
        } else {
            unset($validatedData['pictures']); // Keep existing pictures if not updated
        }

        // Begin transaction
        DB::beginTransaction();

        try {
            // Update the ad
            $ad->update($validatedData);

            // Commit transaction
            DB::commit();

            return redirect()->route('ad.show', $ad->id)
                ->with('success', 'Ad updated successfully.');
        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollBack();
            $user->increment('coins', $validatedData['coins_needed']);

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'An error occurred while updating your ad. Please try again.']);
        }
    }
    public function destroy(Ad $ad)
    {
        $ad->delete();
        return redirect()->route('ad.index')->with('success', 'Ad deleted successfully!');
    }

    public function featureAd(Request $request, $id)
    {
        // Validate the input
        $validatedData = $request->validate([
            'featured_days' => 'required|integer|min:1', // Number of days the ad should be featured
        ]);

        $user = auth()->user();
        $ad = Ad::findOrFail($id);

        // Get the featured ad rate from settings
        $featuredAdRate = Setting::getValue('featured_ad_rate');

        if (!$featuredAdRate) {
            return redirect()->back()->withErrors(['error' => 'Featured ad rate is not set.']);
        }

        $coinsNeeded = $validatedData['featured_days'] * $featuredAdRate;

        // Check if the user has enough coins
        if ($user->coins < $coinsNeeded) {
            return redirect()->back()
                ->withErrors(['coins_needed' => 'You do not have enough coins to feature this ad.']);
        }

        // Begin transaction
        DB::beginTransaction();

        try {
            // Deduct the coins from the user
            $user->decrement('coins', $coinsNeeded);

            // Set the ad as featured and store the number of featured days
            $ad->is_featured = true; // Set is_featured to true
            $ad->featured_until = now()->addDays(intval($validatedData['featured_days']));

            $ad->save();

            // Commit transaction
            DB::commit();

            return redirect()->route('ad.show', $ad->id)
                ->with('success', "Ad has been featured for {$validatedData['featured_days']} days.");
        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollBack();
            return redirect()->back()
                ->withErrors(['error' => 'An error occurred while featuring the ad. Please try again.']);
        }
    }

    public function updateFeatureAd(Request $request, $id)
    {
        // Validate the input
        $validatedData = $request->validate([
            'featured_days' => 'required|integer|min:1',
        ]);

        $user = auth()->user();
        $ad = Ad::findOrFail($id);

        // Get the featured ad rate from settings
        $featuredAdRate = Setting::getValue('featured_ad_rate');

        if (!$featuredAdRate) {
            return redirect()->back()->withErrors(['error' => 'Featured ad rate is not set.']);
        }

        // Check if the user wants to un-feature the ad
        if ($request->has('unfeature') && $request->unfeature == '1') {
            // Un-feature the ad
            $ad->is_featured = false;
            $ad->featured_until = null;
            $ad->save();

            return redirect()->route('ad.show', $ad->id)
                ->with('success', 'Ad has been un-featured successfully.');
        }

        // Calculate the new coins needed
        $coinsNeeded = $validatedData['featured_days'] * $featuredAdRate;

        // Check if the user has enough coins for the updated duration
        if ($user->coins < $coinsNeeded) {
            return redirect()->back()
                ->withErrors(['coins_needed' => 'You do not have enough coins for the updated duration.']);
        }

        // Begin transaction
        DB::beginTransaction();

        try {
            // If the ad was previously featured, refund the old featured coins
            $oldFeaturedDays = $ad->featured_until ? now()->diffInDays($ad->featured_until) : 0;
            $refundAmount = $oldFeaturedDays * $featuredAdRate;
            $user->increment('coins', $refundAmount);

            // Deduct the new coins for the updated duration
            $user->decrement('coins', $coinsNeeded);

            // Ensure the value passed to addDays is an integer
            $newFeaturedUntil = now()->addDays((int) $validatedData['featured_days']); // Casting to int

            // Update the featured days of the ad
            $ad->featured_until = $newFeaturedUntil;
            $ad->is_featured = true; // Mark the ad as featured
            $ad->save();

            // Commit transaction
            DB::commit();

            return redirect()->route('ad.show', $ad->id)
                ->with('success', "Ad featured days updated to {$validatedData['featured_days']} days.");
        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollBack();
            return redirect()->back()
                ->withErrors(['error' => 'An error occurred while updating the featured ad. Please try again.']);
        }
    }
    public function unfeature($id)
    {
        $ad = Ad::findOrFail($id);

        // Un-feature the ad by setting is_featured to false and removing the featured_until date
        $ad->is_featured = false;
        $ad->featured_until = null;
        $ad->save();

        return redirect()->route('ad.show', $ad->id)->with('success', 'Ad has been un-featured successfully.');
    }



    public function showFeaturedAds()
    {
        // Get the authenticated user
        $user = auth()->user();

        // Fetch the featured ads of the user
        $ads = Ad::where('user_id', $user->id)
            ->whereNotNull('featured_until')
            ->where('featured_until', '>', now())
            ->get();
        $featuredAdRate = DB::table('settings')->where('key', 'featured_ad_rate')->value('value');
        $user = auth()->user();
        // Return the view with ads
        return view('frontend.postAd.featured', compact('ads', 'featuredAdRate', 'user'));
    }
}
