<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update the user's profile image.
     */

    // edited
    public function updateProfileImage(Request $request): RedirectResponse
    {
        $request->validate([
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = $request->user();

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = 'img_' . time() . '.' . $image->getClientOriginalExtension();

            try {
                $image->move(public_path('profile_images'), $imageName);

                // Delete old profile image if it exists
                if ($user->profile_image && File::exists(public_path('profile_images/' . $user->profile_image))) {
                    File::delete(public_path('profile_images/' . $user->profile_image));
                }

                $user->profile_image = $imageName;
                $user->save();

                Log::info('Profile image updated successfully: ' . $imageName);
            } catch (\Exception $e) {
                Log::error('Error uploading profile image: ' . $e->getMessage());
                return Redirect::route('profile.edit')->with('error', 'Image upload failed. Please try again.');
            }
        } else {
            Log::warning('No file uploaded');
            return Redirect::route('profile.edit')->with('error', 'No file was uploaded.');
        }

        return Redirect::route('profile.edit')->with('success', 'Image updated successfully');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:4',
        ]);

        $user = $request->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return Redirect::route('profile.edit')->with('success', 'Password updated successfully');
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