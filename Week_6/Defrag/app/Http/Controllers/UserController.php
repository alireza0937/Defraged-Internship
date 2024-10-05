<?php

namespace App\Http\Controllers;

use App\Jobs\DeleteOtpJob;
use App\Models\User;
use App\Mail\UserMail;
use App\Models\UserOtp;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function getEmail(){
        $email = $this->validateUserInputs();
        return $this->startOtpProcess($email);
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
        $userData = $this->checkUserExist($email);
        $chekingUserHasActiveOtp = UserOtp::query()->where("user_id", $userData->id)->first();
        if (is_null($chekingUserHasActiveOtp)) {
            return $userData;
        }
        return response()->json(["message"=> "You already have an active OTP."], 400)->throwResponse();
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

    private function validateUserInputs(){
        try {
            $email = request()->validate([
                "email" => ["required", "email"]
            ]);
            return $email;
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->validator->errors(),
            ], 422)->throwResponse();
        }
    }

    private function startOtpProcess($email){
        $otp = $this->generateOTP();
        $userData = $this->checkUserHasActiveOTP($email);
        $this->storeOTP($otp, $userData);
        $this->sendEmail($email, $otp);
        $this->addDeleteTheOtpAfterSpecificTime($userData);
        return response()->json(["message" => "OTP sent to your email"]);
    }

    private function addDeleteTheOtpAfterSpecificTime($userData){
        DeleteOtpJob::dispatch($userData)->delay(now()->addMinutes(5));
    }

    private function checkUserExist($email){
        $userData = User::query()->where("email", $email)->get()->first();
        if (is_null($userData)) {
            return response()->json([
                'message' => 'User Not Found.'
            ], 404)->throwResponse();
        }
        return $userData;
    }
}
