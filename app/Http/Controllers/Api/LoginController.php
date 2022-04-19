<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        $user = User::where(['email' => $request->email])->first();

        if (!$user || !hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid Credentials'], Response::HTTP_FORBIDDEN);
        }

        $token = $user->createToken($request->ip())->plainTextToken;
        return response()->json(['authToken' => $token]);
    }
}
