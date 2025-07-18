<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                if ($user->status === 'approved') {
                    Auth::login($user);
                    if ($user->role === User::ROLE_ADMIN) {
                        return redirect()->intended(route('admin.home'));
                    } elseif ($user->role === User::ROLE_SUPERADMIN) {
                        return redirect()->intended(route('superadmin.home'));
                    } else {
                        return redirect()->intended(route('staff.home'));
                    }
                } else {
                    return redirect()->route('login')->withErrors(['email' => 'Unable to login. Account is not approved.']);
                }
            } else {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'email_verified_at' => now(),
                    'password' => bcrypt('1234'),
                    'role' => User::ROLE_STAFF, 
                    'status' => 'pending',  
                ]);

                return redirect()->route('login')->withErrors(['email' => 'Unable to login. Account is not approved.']);
            }
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['error' => 'Failed to authenticate with Google.']);
        }
    }
}