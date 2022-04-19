<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OTPVerifyRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\OtpCode;
use App\Models\User;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    public function store(RegisterRequest $request)
    {

        $user = User::create($request->validated())
            ->assignRole('student');
        OtpCode::create(['otp_code' => random_int(1000, 9999), 'user_id' => $user->id]);

        $token = $user->createToken($request->ip())->plainTextToken;
        return response()->json(['authToken' => $token], Response::HTTP_CREATED);
    }


    public function update(OTPVerifyRequest $request)
    {
        $otp = auth()->user()->otp()->latest()->first();
        if ($otp == $request->otp && $otp->expires_at <= now()) {
            return response()->json(['message' => 'OTP already expired, Please request a new one'], Response::HTTP_BAD_REQUEST);
        }
        if ($otp->otp_code != $request->otp) {
            return response()->json(['message' => 'Invalid OTP'], Response::HTTP_BAD_REQUEST);
        }
        auth()->user()->update(['is_verified' => true]);
        return response()->json(['message' => 'Verified'], Response::HTTP_ACCEPTED);
    }
}
