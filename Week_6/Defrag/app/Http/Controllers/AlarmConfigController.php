<?php

namespace App\Http\Controllers;

use App\Models\alarmConfig;
use App\Models\GroupConfig;
use App\Models\communicationConfig;
use App\Models\objectConfig;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AlarmConfigController extends Controller
{
    public function store(){
        $formFileds = $this->validateUserInputs();
        $groupID = $this->validateGroup($formFileds);
        $communicationID = $this->validateCommunication($formFileds);
        $objectID = $this->validateObject($formFileds);

        alarmConfig::query()->create([
            "group_id"=> $groupID,
            "alarm_type_id"=> $communicationID,
            "object_id"=> $objectID,
            "user_id"=> Auth::id(),
            "alarm_name"=> $formFileds["alarmName"],
            "treshhold"=> $formFileds["treshhold"],
            "subject"=> $formFileds["subject"],
            "description"=> $formFileds["description"],
        ]);
        return response()->json(["message"=> "Alarm Created Successfully."]);
    }

    private function validateGroup($formFileds){
        $groupID = GroupConfig::query()->where("name", $formFileds["group_name"])->where("user_id", Auth::id())->pluck("id")->first();
        if (is_null($groupID)) {
            return response()->json(["message"=> "You Can not Register A Alarm For A Group That You Do Not A Member Of That."], 400)->throwResponse();
        }
        return $groupID;
    }

    private function validateCommunication($formFileds){
        $communicationID = communicationConfig::query()->where("type", $formFileds["alarm_type"])->where("user_id",Auth::id())->pluck("id")->first();
        if (is_null($communicationID)) {
            return response()->json(["message"=> "You Can't Request An Communication Method With Notification That You Don't Have."], 400)->throwResponse();
        }
        return $communicationID;
    }

    private function validateObject($formFileds){
        $objectID = objectConfig::query()->where("object_name", $formFileds["detection_object"])->pluck("id")->first();
        if (is_null($objectID)) {
            return response()->json(["message"=> "The Object You Choose Not Found."], 400)->throwResponse();
        }
        return $objectID;
    }

    private function validateUserInputs(){
        try {
            $formFileds = request()->validate([
                "alarmName"=> "required",
                "group_name"=> "required",
                "alarm_type"=> "required",
                "detection_object"=> "required",
                "treshhold"=> "required|min:1|max:100",
                "subject"=> "required",
                "description"=> "required",
            ]);
            return $formFileds;
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->validator->errors(),
            ], 422)->throwResponse();
        }
    }
}