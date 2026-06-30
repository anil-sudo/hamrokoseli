<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

app()[PermissionRegistrar::class]->forgetCachedPermissions();
Role::findOrCreate('user', 'web');

$userData = [
    'name' => 'Runtime Verify User',
    'email' => 'runtime-verify-' . uniqid() . '@example.com',
    'password' => Hash::make('password123'),
    'role' => 'user',
];

if (Schema::hasColumn('users', 'is_active')) {
    $userData['is_active'] = true;
}

if (Schema::hasColumn('users', 'phone')) {
    $userData['phone'] = '9812345678';
}

$user = User::create($userData);
$user->assignRole('user');
echo 'created-user-id=' . $user->id . PHP_EOL;
