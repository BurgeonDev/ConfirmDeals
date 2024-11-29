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
        ]);

        // Update the user's name and email
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone_number = $request->phone_number;
        $user->email = $request->email;

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
