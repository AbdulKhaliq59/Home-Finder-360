<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //
    public function showProfile()
    {
        return view('pages.dashboard.profile');
    }
    public function showUserProfile()
    {
        return view('pages.user-profile');
    }
    public function updateProfile(Request $request)
    {
        try {
            $user = Auth::user();

            // Validate the request
            $request->validate([
                'email' => 'required|email|unique:users,email,' . $user->id,
                'fullName' => 'required|string|max:255',
                'job' => 'nullable|string|max:255',
                'country' => 'nullable|string|max:255',
                'address' => 'nullable|string|max:255',
                'profileImage' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Add image validation rules
            ]);

            // Update the user profile
            $user->email = $request->input('email');
            $user->name = $request->input('fullName');
            $user->phoneNumber = $request->input('phoneNumber');
            $user->country = $request->input('country');
            $user->address = $request->input('address');

            // Upload and update the profile image
            if ($request->hasFile('profileImage')) {
                $imagePath = $request->file('profileImage')->store('profile_images', 'public');
                $user->profile_image = $imagePath;
            }
            // Save the changes
            $user->save();
            return redirect()->route('dashboard.profile')->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    public function updateUserProfile(Request $request)
    {
        try {
            $user = Auth::user();

            // Validate the request
            $request->validate([
                'email' => 'required|email|unique:users,email,' . $user->id,
                'fullName' => 'required|string|max:255',
                'job' => 'nullable|string|max:255',
                'country' => 'nullable|string|max:255',
                'address' => 'nullable|string|max:255',
                'profileImage' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Add image validation rules
            ]);

            // Update the user profile
            $user->email = $request->input('email');
            $user->name = $request->input('fullName');
            $user->phoneNumber = $request->input('phoneNumber');
            $user->country = $request->input('country');
            $user->address = $request->input('address');

            // Upload and update the profile image
            if ($request->hasFile('profileImage')) {
                $imagePath = $request->file('profileImage')->store('profile_images', 'public');
                $user->profile_image = $imagePath;
            }
            // Save the changes
            $user->save();
            return redirect()->route('user-profile')->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('error', 'Error occured while updating');
        }
    }
    public function updatePassword(Request $request)
    {
        try {
            $request->validate([
                'currentPassword' => 'required',
                'newpassword' => 'required|string|min:8',
                'password_confirmation' => 'required|string|min:8',
            ]);

            if ($request->input('newpassword') !== $request->input('password_confirmation')) {
                dd('Password do not match');
            }

            $user = auth()->user();

            // Check if the current password matches the one in the database
            if (!Hash::check($request->currentPassword, $user->password)) {
                return redirect()->back()->withErrors(['currentPassword' => 'Incorrect current password']);
            }
            // Update the user's password
            $user->update([
                'password' => bcrypt($request->newpassword),
            ]);
            dd('updated' . $user);
            return redirect()->route('dashboard.profile')->with('success', 'Password updated successfully');
        } catch (\Exception $e) {
            //throw $th;
            return response()->json(['error', $e->getMessage()]);
        }

    }
    public function updateUserPassword(Request $request)
    {
        try {
            $request->validate([
                'currentPassword' => 'required',
                'newpassword' => 'required|string|min:8',
                'password_confirmation' => 'required|string|min:8',
            ]);

            if ($request->input('newpassword') !== $request->input('password_confirmation')) {
                dd('Password do not match');
            }

            $user = auth()->user();

            // Check if the current password matches the one in the database
            if (!Hash::check($request->currentPassword, $user->password)) {
                return redirect()->back()->withErrors(['currentPassword' => 'Incorrect current password']);
            }
            // Update the user's password
            $user->update([
                'password' => bcrypt($request->newpassword),
            ]);
            dd('updated' . $user);
            return redirect()->route('user-profile')->with('success', 'Password updated successfully');
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->back()->withErrors('error', 'Error occured while updating');
        }

    }
}
