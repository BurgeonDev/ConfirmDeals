<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Notifications\CompleteProfileNotification;
use Illuminate\Support\Facades\DB;

class SocialiteController extends Controller
{
    // Redirect to Provider
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    // public function callback($provider)
    // {
    //     try {
    //         $socialUser = Socialite::driver($provider)->user();

    //         // Split the full name into first_name and last_name
    //         $fullName = $socialUser->getName();
    //         $nameParts = explode(' ', $fullName, 2);
    //         $firstName = $nameParts[0] ?? null;
    //         $lastName = $nameParts[1] ?? null;

    //         // Get free coins value from the coins table
    //         $freeCoins = DB::table('coins')->value('free_coins') ?? 0;

    //         // Find or Create User
    //         $user = User::updateOrCreate(
    //             ['email' => $socialUser->getEmail()],
    //             [
    //                 'first_name' => $firstName,
    //                 'last_name' => $lastName,
    //                 'email' => $socialUser->getEmail(),
    //                 'provider_id' => $socialUser->getId(),
    //                 'provider_name' => $provider,
    //                 'profile_pic' => $socialUser->getAvatar(),
    //                 'coins' => $freeCoins,  // Assign free coins from coins table
    //             ]
    //         );

    //         // Log in the user
    //         Auth::login($user);

    //         // Check if the user's profile is incomplete and send notification
    //         $user->notify(new CompleteProfileNotification());

    //         return redirect()->intended('home');
    //     } catch (\Exception $e) {
    //         // Handle errors
    //         return redirect()->route('login')->withErrors(['error' => 'Login failed! ' . $e->getMessage()]);
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

            // Get free coins value from the coins table
            $freeCoins = DB::table('coins')->value('free_coins') ?? 0;

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
                    'coins' => $freeCoins,  // Assign free coins from coins table
                    'is_email_verified' => false, // Ensure email verification is required
                ]
            );

            // Send the email verification notification
            $user->sendEmailVerificationNotification();

            // Log in the user
            Auth::login($user);

            // Redirect to the verification notice page
            return redirect()->route('verification.notice');
        } catch (\Exception $e) {
            // Handle errors
            return redirect()->route('login')->withErrors(['error' => 'Login failed! ' . $e->getMessage()]);
        }
    }
}
