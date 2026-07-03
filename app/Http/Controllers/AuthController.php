<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    /**
     * Show the login page for regular (buyer) users.
     */
    public function showLogin()
    {
        return view('welcome');
    }

    public function redirect()
    {
        return Socialite::driver('google')->redirect();

    }

    public function callback()
    {
        $googleuser = Socialite::driver('google')->stateless()->user();

        $old_user = User::where('email', $googleuser->email)->first();

        if ($old_user) {
            Auth::login($old_user);

            return redirect()->route('home');
        }

        $new_user = new User;
        $new_user->name = $googleuser->name;
        $new_user->email = $googleuser->email;
        $new_user->password = Hash::make(rand(10000, 99999));
        $new_user->save();

        Auth::login($new_user);

        return redirect()->route('home');
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
