<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alert extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'camera_config_id',
        'object_config_id',
        'orgImageUrl',
        'imageUrl',
        'conf',
        'description'
    ];
    use HasFactory;

    public static function validateAlert($data){
        $objectID = objectConfig::query()->where("object_code", $data["object_code"])->pluck("id")->first();
        if (is_null($objectID)) {
            return response()->json(["message"=> "Object You Choose Not Found"], 404)->throwResponse();
        }
        $cameraID = cameraConfig::query()->where("cameraCode", $data["camera_code"])->pluck("id")->first();
        $cameraGroupID = groupCamera::query()->where("camera_config_id", $cameraID)->pluck("group_config_id")->first();
        $allAlarmsSetForThisGroup = alarmConfig::query()->where("group_id", $cameraGroupID)->get();
        if (count($allAlarmsSetForThisGroup) > 0) {
            foreach ($allAlarmsSetForThisGroup as $value) {
                if ($objectID == $value["object_id"] and $value["treshhold"] <= $data["conf"]) {
                    return [$cameraID, $objectID];
                }
            }
            return response()->json(["message"=> "The Object You Register Has No Registerd Alert With This Informations."], 422)->throwResponse();
        }
        return response()->json(["message"=> "The Camera You Choose Has No Registerd Alert."], 422)->throwResponse();        
    }

    public static function saveAlertImages($formFileds){

    $orgImageData = $formFileds['orgImage'];
    $imageData = $formFileds['image'];

    $orgImage = explode(',', $orgImageData)[1];
    $image = explode(',', $imageData)[1];

    $orgImageFilename = uniqid('org_', true) . '.png';
    $imageFilename = uniqid('proc_', true) . '.png';

    
    Storage::disk('public')->put($orgImageFilename, base64_decode($orgImage));
    Storage::disk('public')->put($imageFilename, base64_decode($image));

    $orgImageUrl = Storage::url($orgImageFilename);
    $imageUrl = Storage::url($imageFilename);

    return [$orgImageUrl, $imageUrl];
    }
}
