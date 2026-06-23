<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserRegisterController extends Controller
{
    /**
     * Handle registration for a regular (buyer) account.
     */
    public function register(Request $request): RedirectResponse
    {
        try {
            $data = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:150', 'unique:users,email'],
                'phone' => ['nullable', 'string', 'max:20', 'unique:users,phone'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'] ?? null,
                'password' => Hash::make($data['password']),
                'role' => 'user',
                'is_active' => true,
            ]);

            $user->assignRole('user');

            return redirect()->route('userlogin')
                ->with('success', 'Account created successfully! Please sign in to continue.');

        } catch (ValidationException $e) {
            // Redirect back with errors and flag to show register view
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('show_register', true);
        }
    }
}
