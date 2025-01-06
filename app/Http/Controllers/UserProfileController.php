<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Locality;
use App\Models\Profession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        $professions = Profession::all();
        $countries = Country::with('cities.localities')->get();
        $cities = City::where('country_id', $user->country_id)->get();
        $localities = Locality::where('city_id', $user->city_id)->get();
        return view('frontend.profile.edit', [
            'user' => Auth::user(),
            'professions' => $professions,
            'countries' => $countries,
            'cities' => $cities,
            'localities' => $localities

        ]);
    }
    public function getCities($countryId)
    {
        $cities = City::where('country_id', $countryId)->get();
        return response()->json($cities);
    }

    public function getLocalities($cityId)
    {
        $localities = Locality::where('city_id', $cityId)->get();
        return response()->json($localities);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate the request data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'phone_number' => ['required', 'regex:/^[0-9\-\(\)\/\+\s]*$/', 'max:15'],
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:8048',
            'profession_id' => 'required|exists:professions,id',
            'locality_id' => 'required|exists:localities,id',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
        ]);

        // Update the user's data
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone_number = $request->phone_number;
        $user->email = $request->email;
        $user->profession_id = $request->profession_id;
        $user->locality_id = $request->locality_id;
        $user->city_id = $request->city_id;
        $user->country_id = $request->country_id;

        // If a password is provided, hash and update it
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Handle profile picture upload
        if ($request->hasFile('profile_pic')) {
            // Store the file and get the path
            $path = $request->file('profile_pic')->store('profile_pics', 'public');
            $user->profile_pic = $path;
        }

        // Save the changes
        $user->save();

        return redirect()->route('userProfile.edit')->with('success', 'Profile updated successfully.');
    }

    public function destroy()
    {
        $user = Auth::user();
        $user->delete();

        // Log the user out after deleting the account
        Auth::logout();

        return redirect('/')->with('success', 'Your account has been deleted.');
    }
    // public function publicProfile(User $user)
    // {
    //     // Fetch the user's average rating
    //     $averageRating = $user->ads()
    //         ->join('feedbacks', 'ads.id', '=', 'feedbacks.ad_id')
    //         ->avg('feedbacks.rating');

    //     // Fetch the user's ads with feedback details
    //     $ads = $user->ads()->with(['feedbacks.user'])->get();

    //     return view('frontend.profile.public', [
    //         'user' => $user,
    //         'averageRating' => $averageRating,
    //         'ads' => $ads,
    //     ]);
    // }


    public function publicProfile(User $user)
    {
        // Fetch the user's average rating
        $averageRating = $user->ads()
            ->join('feedbacks', 'ads.id', '=', 'feedbacks.ad_id')
            ->avg('feedbacks.rating');

        // Fetch the user's ads, ordered by the latest feedback date (subquery)
        $ads = $user->ads()
            ->select('ads.*')
            ->leftJoin('feedbacks', 'ads.id', '=', 'feedbacks.ad_id')
            ->orderByDesc(\DB::raw('(SELECT MAX(created_at) FROM feedbacks WHERE feedbacks.ad_id = ads.id)')) // Order by the latest feedback date
            ->distinct() // Ensures that only distinct ads are selected
            ->with(['feedbacks' => function ($query) {
                $query->orderByDesc('created_at'); // Order feedback by latest first
            }])
            ->get();

        return view('frontend.profile.public', [
            'user' => $user,
            'averageRating' => $averageRating,
            'ads' => $ads,
        ]);
    }
}
