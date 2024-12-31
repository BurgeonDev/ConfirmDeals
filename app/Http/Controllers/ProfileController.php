<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        if (!auth()->user()->can('Manage Admin Dashbaord')) {
            abort(403, 'Unauthorized action.');
        }
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
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

        return back()->with('success', 'Admin profile updated');
    }
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
