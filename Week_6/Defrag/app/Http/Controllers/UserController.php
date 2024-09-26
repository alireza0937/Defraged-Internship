<?php

namespace App\Http\Controllers;

use App\Jobs\DeleteOtpJob;
use App\Models\User;
use App\Mail\UserMail;
use App\Models\UserOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{

    public function getEmail(Request $request){
        try {
            $email = $request->validate([
                "email" => ["required", "email"]
            ]);
            $otp = $this->generateOTP();
            $response = $this->checkUserHasActiveOTP($email);
            if ($response[0]) {
                $this->storeOTP($otp, $response[1]);
                $this->sendEmail($email, $otp);
                DeleteOtpJob::dispatch($response[1])->delay(now()->addMinutes(5));
                return response()->json(["message" => "OTP sent to your email"]);
            }
            return response()->json(["message"=> "You already have an active OTP."], 400);

        } catch (ValidationException $e) {
            return response()->json(["message" => "Invalid email"], 422);
        }
    }

    public function generateOTP(){
        $otp = rand(10000, 99999);
        return $otp;
    }

    public function sendEmail($email, $otp){
        Mail::to($email)->queue(
            new UserMail($otp)
        );
    }

    public function checkUserHasActiveOTP($email){
        $userData = User::query()->where("email", $email)->get()->first();
        if (is_null($userData)) {
            return response()->json([
                'message' => 'User Not Found.'
            ], 404)->throwResponse();
        }
        $chekingUserHasActiveOtp = UserOtp::query()->where("user_id", $userData->id)->get();
        if (count($chekingUserHasActiveOtp) >= 1) {
            return [0, 0];
        }
        return [1, $userData];
    }

    public function storeOTP($otp, $userData){
        UserOtp::query()->create([
            'user_id'=> $userData->id,
            "otp"=> $otp
        ]);
    }

    public function token(){
        return response()->json(["message"=> "You should Use Your Token For Access Our Apis."], 401);
    }
}
