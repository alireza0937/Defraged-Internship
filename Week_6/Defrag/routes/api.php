<?php

use App\Http\Controllers\AlarmConfigController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CameraConfigController;
use App\Http\Controllers\communicationConfigController;
use App\Http\Controllers\EmailCommunicationController;
use App\Http\Controllers\GroupConfigController;
use App\Http\Controllers\ObjectConfigController;
use App\Http\Controllers\SmsCommunicationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/* A Default Message When The User Insert Wrong Token */ 
Route::get("", [UserController::class, "token"])->name("token");

/* Enter Email For Getting The OTP In That Email */
Route::post("/login", [UserController::class, "getEmail"]);

/* Verify OTP And Get Token */
Route::post("/verify", [AuthController::class, "verify"]);

/* Get All Objects */
Route::get("/objects/all", [ObjectConfigController::class, "index"]);

/* Create An Object */
Route::post("/object/create", [ObjectConfigController::class, "store"]);

/* Update An Object */
Route::put("/object/{objectConfig}/update", [ObjectConfigController::class, "update"]);

/* Delete An Object */
Route::delete("/object/{objectConfig}/delete", [ObjectConfigController::class, "destroy"]);

/* Get All Communications */
Route::get("communication/all", [communicationConfigController::class, "index"]);

/* Create SMS Communication */
Route::post("communication/create/sms", [SmsCommunicationController::class, "store"])->middleware("auth:sanctum");

/* Create Email Communication */
Route::post("communication/create/email", [EmailCommunicationController::class, "store"])->middleware("auth:sanctum");

/* Update SMS Communication */
Route::put("communication/sms/{smsCommunication}/update", [SmsCommunicationController::class, "update"])->middleware("auth:sanctum");

/* Update Email Communication */
Route::put("communication/email/{emailCommunication}/update", [EmailCommunicationController::class, "update"])->middleware("auth:sanctum");

/* Delete SMS Communication */
Route::delete("communication/sms/{id}/delete", [SmsCommunicationController::class, "destroy"])->middleware("auth:sanctum");

/* Delete Email Communication */
Route::delete("communication/email/{id}/delete", [EmailCommunicationController::class, "destroy"])->middleware("auth:sanctum");

/* Get All Cameras */
Route::get("camera/all", [CameraConfigController::class, "index"]);

/* Create a Camera */
Route::post("camera/create", [CameraConfigController::class, "store"]);

/* Update a Camera */
Route::put("camera/{id}/update", [CameraConfigController::class, "update"]);

/* Delete a Camera */
Route::delete("camera/{id}/delete", [CameraConfigController::class, "destroy"]);

/* Get All Groups */
Route::get("group/all", [GroupConfigController::class, "index"]);

/* Create A Group */
Route::post("group/create", [GroupConfigController::class, "store"])->middleware("auth:sanctum");

/* Delete A Group */
Route::delete("group/{id}/delete", [GroupConfigController::class, "destroy"])->middleware("auth:sanctum");

/* Assign A Camera To Group */
Route::post("group/camera/assign", [GroupConfigController::class, "assign"])->middleware("auth:sanctum");

/* Deassign A Camera From A Group */
Route::delete("group/camera/deassign", [GroupConfigController::class, "deassign"])->middleware("auth:sanctum");

/* Create A Alarm */
Route::post("alarm/create", [AlarmConfigController::class, "store"])->middleware("auth:sanctum");

/* Register A Alert */
Route::post("alert/create", [AlertController::class, "store"]);

/* Get All Pending Alerts */
Route::get("alert/pending/all", [AlertController::class, "get"]);


