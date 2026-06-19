<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->boolean('remember');

        $user = User::where('email', $credentials['email'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors(['email' => 'Invalid email or password.'])->onlyInput('email');
        }

        if ($user->hasRole('admin')) {
            Auth::guard('web')->login($user, $remember);
            $request->session()->regenerate();

            return redirect('/admin');
        }

        if ($user->hasRole('vendor')) {
            Auth::guard('vendor')->login($user, $remember);
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'You do not have a seller account.'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();   // was: Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
