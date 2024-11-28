<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {
        try {
            $google_user = Socialite::driver('google')->user();
            $user = User::where('google_id', $google_user->getId())->first();

            if (!$user) {
                $new_user = User::create([
                    'name' => $google_user->getName(),
                    'email' => $google_user->getEmail(),
                    'google_id' => $google_user->getId(),
                    'email_verified_at' => now(),
                    'password' => bcrypt(Str::random(8)),
                    'role' => User::ROLE_STAFF,
                    'status' => 'pending',
                    'profile_image' => $google_user->getAvatar(),
                ]);

                return redirect()->route('login')->withErrors(['email' => 'Unable to login. Account is not approved.']);
            } else {
                if ($user->status === 'approved') {
                    Auth::login($user);
                    
                    if (!$user->profile_image) {
                        $user->profile_image = $google_user->getAvatar();
                        $user->save();
                    }

                    switch ($user->role) {
                        case User::ROLE_ADMIN:
                            return redirect()->intended(route('admin.home'));
                        case User::ROLE_SUPERADMIN:
                            return redirect()->intended(route('superadmin.home'));
                        default:
                            return redirect()->intended(route('staff.home'));
                    }
                } else {
                    return redirect()->route('login')->withErrors(['email' => 'Unable to login. Account is not approved.']);
                }
            }
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['error' => 'Failed to authenticate with Google.']);
        }
    }
}
