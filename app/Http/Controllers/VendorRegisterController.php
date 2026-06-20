<?php

namespace App\Http\Controllers;

use App\Mail\NewVendorRegistered;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VendorRegisterController extends Controller
{
    public function show()
    {
        return view('auth.vendor-register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'phone' => 'required|string|max:20|unique:users,phone',
            'vendor_name' => 'required|string|max:150',
            'owner_name' => 'required|string|max:100',
            'vendor_email' => 'required|email|unique:vendors,email',
            'vendor_phone' => 'required|string|max:20|unique:vendors,phone',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:80',
            'province' => 'nullable|string|max:80',
            'pan_number' => 'nullable|string|max:30|unique:vendors,pan_number',
        ]);

        // Create user
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phone' => $data['phone'],
            'role' => 'vendor',
            'is_active' => true,
        ]);

        // Assign Spatie role
        $user->assignRole('vendor');

        // Auto-create vendor record
        $vendor = $user->vendor()->create([
            'vendor_name' => $data['vendor_name'],
            'owner_name' => $data['owner_name'],
            'email' => $data['vendor_email'],
            'phone' => $data['vendor_phone'],
            'vendor_address' => $data['address'] ?? null,
            'city' => $data['city'] ?? null,
            'province' => $data['province'] ?? null,
            'pan_number' => $data['pan_number'] ?? null,
            'status' => 'pending',
        ]);

        $adminEmails = User::where('role', 'admin')->pluck('email');

        foreach ($adminEmails as $adminEmail) {
            Mail::to($adminEmail)->queue(new NewVendorRegistered($vendor));
        }

        return redirect()->route('seller.login')
            ->with('success', 'Registration successful! Wait for admin approval. You will receive an email after approval.');
    }
}
