<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserOtp;

class AuthController extends Controller
{
    public function verify(){
        try {
            $otp = request()->validate([
                "otp"=> "required"
            ]);
            $validateOTP = UserOtp::query()->where("otp", $otp)->get()->first();
            if (is_null($validateOTP)) {
                return response()->json(["message"=> "Invalid OTP. Try Again."]);
            }
            $user = User::query()->find($validateOTP->user_id);
            $token = $user->createToken("auth_token");

            return ['token' => $token->plainTextToken];
        }
         catch (\Throwable $th) {
            
            return response()->json(["message" => "You Should Send Me OTP."], 422);
        }
    }
}
