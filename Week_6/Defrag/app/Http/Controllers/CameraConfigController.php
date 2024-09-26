<?php

namespace App\Http\Controllers;

use App\Models\cameraConfig;
use Illuminate\Http\Request;

class CameraConfigController extends Controller
{
    public function index(){
        $allCameras = cameraConfig::query()->simplePaginate(2);
        return response()->json($allCameras->items());
    }

    public function store(){
        try {
            $formFileds = request()->validate([
                "cameraName"=> "required",
                "cameraCode"=> "required",
                "cameraIP"=> "required",
                "description"=> "required"
            ]);
            cameraConfig::query()->create($formFileds);
            return response()->json(["message"=> "Camera Successfully Created."]);
        } catch (\Throwable $th) {
            return response()->json(["message"=> "Incomplete Info"], 409);
        }

    }

    public function update(cameraConfig $id){
        try {
            $formFileds = request()->validate([
                "cameraName"=> "required",
                "cameraCode"=> "required",
                "cameraIP"=> "required",
                "description"=> "required"
            ]);
            $id->update($formFileds);
            return response()->json(["message"=> "Camera Successfully Updated."]);
        } catch (\Throwable $th) {
            return response()->json(["message"=> "Incomplete Info"], 409);
        }
    }

    public function destroy(cameraConfig $id){
        $id->delete();
        return response()->json(["message"=> "Camera Successfully Deleted."]);
    }
}
