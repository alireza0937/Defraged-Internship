<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\emailCommunication;
use App\Models\communicationConfig;
use Illuminate\Support\Facades\Auth;

class EmailCommunicationController extends Controller
{
    public function store(){
        try {
            $formFileds = request()->validate([
                "name"=> "required",
                "emailFrom"=> ["required", "email"],
                "smtpHost"=> "required",
                "smtpUsername"=> "required",
                "smtpPassword"=> "required"
            ]);
            $newCommunication = communicationConfig::query()->create([
                "type"=> "email",
                "user_id"=> Auth::id()
            ]);
            $formFileds["communication_config_id"] = $newCommunication->id;
            emailCommunication::query()->create($formFileds);
            return response()->json(["message"=> "Email Succesfully Created."]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                "message" => "Invalid data provided.",
                "errors" => $e->errors() 
            ], 422);
    
        } catch (\Exception $e) {
            return response()->json(["message" => "An unexpected error occurred."], 500);
        }
    }

    public function update(emailCommunication $emailCommunication){
        try {
            $formFileds = request()->validate([
                "name"=> "required",
                "emailFrom"=> ["required", "email"],
                "smtpHost"=> "required",
                "smtpUsername"=> "required",
                "smtpPassword"=> "required"
            ]);
   
            $emailCommunication->update($formFileds);
            return response()->json(["message"=> "Email Succesfully Updated."]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                "message" => "Invalid data provided.",
                "errors" => $e->errors() 
            ], 422);
    
        } catch (\Exception $e) {
            return response()->json(["message" => "An unexpected error occurred."], 500);
        }
    }

    public function destroy(emailCommunication $id){
        communicationConfig::query()->where("id", $id->communication_config_id)->delete();
        return response()->json(["message"=> "Communication(Email) Delete Successfully"]);
    }
}
