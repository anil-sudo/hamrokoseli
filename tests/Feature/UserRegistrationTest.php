<?php

use App\Models\User;

it('creates a user when a phone number is provided', function () {
    $email = fake()->unique()->safeEmail();
    $phone = fake()->numerify('98########');

    $response = $this->post('/userregister', [
        'name' => 'Suraj Tamang',
        'email' => $email,
        'phone' => $phone,
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $response->assertRedirect('/userlogin');
    $this->assertDatabaseHas('users', [
        'email' => $email,
        'phone' => $phone,
    ]);

    User::where('email', $email)->delete();
});
