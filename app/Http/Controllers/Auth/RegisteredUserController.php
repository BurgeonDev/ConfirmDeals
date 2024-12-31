<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Locality;
use App\Models\Profession;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $professions = Profession::all();
        $countries = Country::all();
        $cities = City::all(); // Or filter based on old('country_id')
        $localities = Locality::all();
        return view('auth.register', compact('professions', 'countries', 'cities', 'localities'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'profession' => 'required|exists:professions,id',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
            'locality_id' => 'required|exists:localities,id',
            'phone_number' => 'required|string|max:15|unique:' . User::class,
        ]);
        // Get free coins value
        $freeCoins = Setting::getValue('free_coins') ?? 0;

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profession_id' => $request->profession,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'locality_id' => $request->locality_id,
            'phone_number' => $request->phone_number,
            'coins' => $freeCoins,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('home', absolute: false));
    }
}
