<?php

use function Pest\Laravel\post;
use App\Models\User;

test('should return authToken when login is successful', function () {
    $user = User::factory()->create();
    post('/api/authenticate', [
        'email' => $user->email,
        'password' => 'password'
    ])->assertJsonStructure(['authToken'])
        ->assertOk();
});


test('should return 403 status code when password doesnt match', function () {
    $user = User::factory()->create();
    post('/api/authenticate', [
        'email' => $user->email,
        'password' => 'wrongPassword'
    ])
        ->assertExactJson(['message' => 'Invalid Credentials'])
        ->assertForbidden();
});

