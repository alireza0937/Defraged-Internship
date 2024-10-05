<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAlertRequest;
use App\Models\alert;

class AlertController extends Controller
{
    public function store(StoreAlertRequest $request){

        $response = alert::validateAlert($request);
        $imagesUrls = alert::saveAlertImages($request);

        alert::query()->create([
            "camera_config_id"=> $response[0],
            "object_config_id"=> $response[1],
            "description"=> $request->input("description"),
            "orgImageUrl"=> 'alerts/' . $imagesUrls[0],
            "imageUrl"=> 'alerts/' . $imagesUrls[1],
            "conf"=> $request->input("conf")
        ]);

        return response()->json(["message"=> "Thank you for your information. A Notif Will Send To Required Persons."], 201);
    }

    public function get(){
        $alerts = alert::query()->where("status", "pending")->get();
        return response()->json($alerts);
    }
}
