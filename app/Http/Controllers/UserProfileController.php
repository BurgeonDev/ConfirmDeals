<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserProfileController extends Controller
{
    // Show the user profile edit form
    public function edit()
    {
        return view('frontend.profile.edit', ['user' => Auth::user()]);
    }

    // Update the user profile
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update the user's name and email
        $user->name = $request->name;
        $user->email = $request->email;

        // If a password is provided, hash and update it
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Save the changes
        $user->save();

        return redirect()->route('userProfile.edit')->with('success', 'Profile updated successfully.');
    }

    // Delete the user's account
    public function destroy()
    {
        $user = Auth::user();
        $user->delete();

        // Log the user out after deleting the account
        Auth::logout();

        return redirect('/')->with('success', 'Your account has been deleted.');
    }
}
