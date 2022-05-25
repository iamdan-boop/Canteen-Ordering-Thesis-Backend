<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MeController extends Controller
{

    public function __invoke(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'authToken' => $request->user()->createToken($request->ip())->plainTextToken
        ]);
    }
}
