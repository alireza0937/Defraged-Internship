<?php

namespace App\Http\Controllers;

use App\Models\smsCommunication;
use App\Models\communicationConfig;
use Illuminate\Support\Facades\Auth;

class SmsCommunicationController extends Controller
{
    public function store(){
        try {
            $formFileds = request()->validate([
                "name"=> "required",
                "auth_token"=> "required"
            ]);
            $creatingNewCommunication = communicationConfig::query()->create([
                "type"=> "sms",
                "user_id" => Auth::id()
            ]);
            $formFileds["communication_config_id"] = $creatingNewCommunication->id;
            smsCommunication::query()->create($formFileds);
            return response()->json(["message"=> "SMS Succesfully Created."]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                "message" => "Invalid data provided.",
                "errors" => $e->errors() 
            ], 422);
    
        } catch (\Exception $e) {
            return response()->json(["message" => "An unexpected error occurred."], 500);
        }
    }

    public function update(smsCommunication $smsCommunication){
        try {
            $formFileds = request()->validate([
                "name"=> "required",
                "auth_token"=> "required"
            ]);
            $smsCommunication->update($formFileds);
            return response()->json(["message"=> "SMS Succesfully Updated."]);
        } catch (\Throwable $th) {
            return response()->json(["message"=> "Invalid data"], 409);
        }
    }

    public function destroy(smsCommunication $id){
        communicationConfig::query()->where("id", $id->communication_config_id)->delete();
        return response()->json(["message"=> "Communication(SMS) Delete Successfully"]);
    }
}
