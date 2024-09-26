<?php

namespace App\Http\Controllers;

use App\Models\objectConfig;
use Illuminate\Validation\ValidationException;


class ObjectConfigController extends Controller
{
    public function index(){
        $objects = objectConfig::query()->simplePaginate(2);
        return response()->json($objects->items());
    }

    public function store(){
        try {
            $formFileds = request()->validate([
                "object_name"=> ["required"],
                "object_code"=> ["required"],
                "description"=> ["required"],
            ]);
            objectConfig::query()->create($formFileds);
            return response()->json(["message"=> "The object Created succesfully."]);
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->validator->errors(),
            ], 422);
        }
    }

    public function destroy(objectConfig $objectConfig){
        $objectConfig->delete();
        return response()->json(["meesage"=> "Seccesfully deleted."]);
    }

    public function update(objectConfig $objectConfig){
        try {
            $formFileds = request()->validate([
                "object_name"=> "required",
                "object_code"=> "required",
                "description"=> "required",
            ]);
            $objectConfig->update($formFileds);
            return response()->json(["message"=> "The object updated succesfully."]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                "message" => "Invalid data provided.",
                "errors" => $e->errors() 
            ], 422);
    
        } catch (\Exception $e) {
            return response()->json(["message" => "An unexpected error occurred."], 500);
        }

        
    }
}
