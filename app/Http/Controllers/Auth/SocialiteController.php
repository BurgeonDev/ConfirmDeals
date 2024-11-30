<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    // Redirect to Provider
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    // Handle Callback
    // public function callback($provider)
    // {
    //     try {
    //         $socialUser = Socialite::driver($provider)->user();

    //         // Find or Create User
    //         $user = User::updateOrCreate(
    //             ['email' => $socialUser->getEmail()],
    //             [
    //                 'name' => $socialUser->getName(),
    //                 'email' => $socialUser->getEmail(),
    //                 'provider_id' => $socialUser->getId(),
    //                 'provider_name' => $provider,
    //                 // 'avatar' => $socialUser->getAvatar(),
    //             ]
    //         );

    //         // Log in the user
    //         Auth::login($user);

    //         return redirect()->intended('home');
    //     } catch (\Exception $e) {
    //         // return redirect()->route('login')->withErrors(['error' => 'Login failed!']);
    //         dd('somthing wronngn' . $e->getMessage());
    //     }
    // }
    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();

            // Split the full name into first_name and last_name
            $fullName = $socialUser->getName();
            $nameParts = explode(' ', $fullName, 2);
            $firstName = $nameParts[0] ?? null;
            $lastName = $nameParts[1] ?? null;

            // Find or Create User
            $user = User::updateOrCreate(
                ['email' => $socialUser->getEmail()],
                [
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'email' => $socialUser->getEmail(),
                    'provider_id' => $socialUser->getId(),
                    'provider_name' => $provider,
                    'profile_pic' => $socialUser->getAvatar(),
                ]
            );

            // Log in the user
            Auth::login($user);

            return redirect()->intended('home');
        } catch (\Exception $e) {
            // Handle errors
            return redirect()->route('login')->withErrors(['error' => 'Login failed! ' . $e->getMessage()]);
        }
    }
}
