<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Show the login page for regular (buyer) users.
     */
    public function showLogin()
    {
        return view('welcome');
    }

    /**
     * Handle a login attempt on the default "web" guard.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (! Auth::attempt($credentials, $remember)) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'These credentials do not match our records.']);
        }

        $user = Auth::user();

        if (! $user->is_active) {
            Auth::logout();

            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Your account is inactive. Please contact support.']);
        }

        $request->session()->regenerate();

        // Send vendors/admins to their own dashboards if they log in from here.
        if ($user->isVendor()) {
            return redirect()->route('dashboard');
        }

        return redirect()->route('home');
    }

    /**
     * Log the user out of the "web" guard.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
