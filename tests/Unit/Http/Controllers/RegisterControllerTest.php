<?php

use function Pest\Laravel\post;
use function Pest\Faker\faker;


beforeEach(fn() => \Pest\Laravel\seed(\Database\Seeders\RoleSeeder::class));

test('should return a token when registration is successful', function () {
    post('/api/register', [
        'email' => faker()->email,
        'password' => 'password',
        'name' => faker()->name,
        'phone_number' => faker()->phoneNumber,
    ])
        ->assertJsonStructure(['authToken'])
        ->assertCreated();
});


test('should return error when has duplicate values', function () {

    $values = [
        'email' => faker()->email,
        'password' => 'password',
        'name' => faker()->name,
        'phone_number' => faker()->phoneNumber
    ];

    \App\Models\User::factory()->create([
        'email' => $values['email'],
        'password' => $values['password'],
        'phone_number' => $values['phone_number'],
        'name' => $values['name']
    ]);

    post('api/register', [
        'email' => $values['email'],
        'password' => $values['password'],
        'phone_number' => $values['phone_number'],
        'name' => $values['name']
    ])
        ->assertJsonValidationErrors(['email', 'phone_number'])
        ->assertUnprocessable();
});
