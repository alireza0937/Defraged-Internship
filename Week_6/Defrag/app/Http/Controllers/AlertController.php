<?php

namespace App\Http\Controllers;

use App\Models\alarmConfig;
use App\Models\alert;
use App\Models\cameraConfig;
use App\Models\groupCamera;
use App\Models\objectConfig;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AlertController extends Controller
{
    public function store(Request $request){
        try {
            $formFileds = request()->validate([
                "camera_code"=> "required",
                "description"=> "required",
                "object_code"=> "required",
                "conf"=> "required",
                "orgImage"=> "required",
                "image"=> "required",
            ]);
           $response = $this->alertValidation($formFileds);

            $orgImageData = $request->input('orgImage');
            $imageData = $request->input('image');

            $orgImage = explode(',', $orgImageData)[1];
            $image = explode(',', $imageData)[1];


            $orgImageFilename = uniqid('org_', true) . '.png';
            $imageFilename = uniqid('proc_', true) . '.png';
            

            Storage::disk('public')->put($orgImageFilename, base64_decode($orgImage));
            Storage::disk('public')->put($imageFilename, base64_decode($image));

            
            $orgImageUrl = Storage::url($orgImageFilename);
            $imageUrl = Storage::url($imageFilename);

            alert::query()->create([
                "camera_config_id"=> $response[0],
                "object_config_id"=> $response[1],
                "description"=> $formFileds["description"],
                "orgImageUrl"=> 'alerts/' . $orgImageUrl,
                "imageUrl"=> 'alerts/' . $imageUrl,
                "conf"=> $formFileds["conf"]
            ]);
            return response()->json(["message"=> "Thank you for your information. A Notif Will Send To Required Persons."], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->validator->errors(),
            ], 422);
        }
    }

    public function get(){
        $alerts = alert::query()->where("status", "pending")->get();
        return response()->json($alerts);
    }

    private function alertValidation($data){
        $objectID = objectConfig::query()->where("object_code", $data["object_code"])->pluck("id")->first();
        if (is_null($objectID)) {
            return response()->json(["message"=> "Object You Choose Not Found"], 404)->throwResponse();
        }
        $cameraID = cameraConfig::query()->where("cameraCode", $data["camera_code"])->pluck("id")->first();
        $cameraGroupID = groupCamera::query()->where("camera_config_id", $cameraID)->pluck("group_config_id")->first();
        $allAlarmsSetForThisGroup = alarmConfig::query()->where("group_id", $cameraGroupID)->get();
        if (count($allAlarmsSetForThisGroup) > 0) {
            foreach ($allAlarmsSetForThisGroup as $value) {
                if ($objectID == $value["object_id"] or $value["treshhold"] <= $data["conf"] ) {
                    return [$cameraID, $objectID];
                }
            }
            return response()->json(["message"=> "The Object You Register Has No Registerd Alert With This Informations."], 422)->throwResponse();
        }
        return response()->json(["message"=> "The Camera You Choose Has No Registerd Alert."], 422)->throwResponse();        
    }
}
