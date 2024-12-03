<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Validate the login credentials
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return redirect()->route('login')->withErrors(['email' => 'The provided credentials are incorrect.']);
        }

        if ($user->status !== 'approved') {
            return redirect()->route('login')->withErrors(['email' => 'Unable to login. Your status is ' . $user->status . '.']);
        }

        // Authenticate the user
        Auth::attempt($credentials);

        $request->session()->regenerate();

        // Check the user's role and redirect accordingly
        if ($user->role === User::ROLE_ADMIN) {
            return redirect()->intended(route('admin.home'));
        } elseif ($user->role === User::ROLE_SUPERADMIN) {
            return redirect()->intended(route('superadmin.home'));
        } else {
            return redirect()->intended(route('staff.home'));
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}