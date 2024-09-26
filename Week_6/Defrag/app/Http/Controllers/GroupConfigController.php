<?php

namespace App\Http\Controllers;

use App\Models\groupCamera;
use App\Models\GroupConfig;
use App\Models\cameraConfig;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class GroupConfigController extends Controller
{

    public function index(){
        $allGroups = GroupConfig::query()->get();
        $test = groupCamera::query()->get();
        return $test;
        return $allGroups;
        return response()->json($allGroups->items());
    }

    public function store(){
        try {
            $formFileds = request()->validate([
                "name"=> "required"
            ]);
            $formFileds["user_id"] = Auth::id();
            GroupConfig::query()->create($formFileds);
            return response()->json(["message"=> "Group Created Successfully."]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                "message" => "Invalid data provided.",
                "errors" => $e->errors() 
            ], 422);
        }
    }

    public function assign(){
        try {
            $formFileds = request()->validate([
                "cameraName"=> "required",
                "groupName"=> "required"
            ]);

            $groupDetails = GroupConfig::query()->where('name', $formFileds["groupName"])->first();
            $cameraID = cameraConfig::query()->where('cameraName', $formFileds["cameraName"])->pluck("id")->first();
            if ($groupDetails["user_id"] != Auth::id()) {
               return response()->json(["message"=> "You Do Not Have Access To This Group For Assign Camera To It"], 400);
            }

            groupCamera::query()->create([
                "group_config_id"=> $groupDetails["id"],
                "camera_config_id"=> $cameraID
            ]);
            return response()->json(["message"=> "Camera Added To The Group Successfully."]);
        } catch (ValidationException $e) {
            return response()->json([
                "message" => "Invalid data provided.",
                "errors" => $e->errors() 
            ], 422);
        }
        catch (\Exception $e) {
            return response()->json(["message" => "Check Camera Or Group Name And Try Again."], 404);
    }
    }

    public function deassign(){
        try {
            $formFileds = request()->validate([
                "cameraName"=> "required",
                "groupName"=> "required"
            ]);
            $groupDetails = GroupConfig::query()->where('name', $formFileds["groupName"])->first();
            $cameraID = cameraConfig::query()->where('cameraName', $formFileds["cameraName"])->pluck("id")->first();
            if ($groupDetails["user_id"] != Auth::id()) {
                return response()->json(["message"=> "You Do Not Have Access To This Group For Deassign Camera From It"], 400);
            }
            $response = groupCamera::query()->where("camera_config_id", $cameraID)->where("group_config_id", $groupDetails["id"])->delete();
            if ($response == 1) {
                return response()->json(["message"=> "Camera Deassign From The Group Successfully."]);
            }
            return response()->json(["message"=> "Camera Doesn't Belong To The Group You Entered."], 400);
        } catch (ValidationException $e) {
            return response()->json([
                "message" => "Invalid data provided.",
                "errors" => $e->errors() 
            ], 422);
        }
        catch (\Exception $e) {
            return response()->json(["message" => "Check Camera Or Group Name And Try Again."], 404);
    }
    }

    public function destroy(GroupConfig $id){
        $id->delete();
        return response()->json(["message"=> "Group Seccessfully Removed"]);
    }
}
