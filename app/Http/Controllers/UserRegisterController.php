<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

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

            $userData = [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => 'user',
            ];

            if (Schema::hasColumn('users', 'is_active')) {
                $userData['is_active'] = true;
            }

            if (Schema::hasColumn('users', 'phone')) {
                $userData['phone'] = $data['phone'] ?? null;
            }

            $user = User::create($userData);

            app()[PermissionRegistrar::class]->forgetCachedPermissions();
            $role = Role::findOrCreate('user', 'web');
            $user->assignRole($role);

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
