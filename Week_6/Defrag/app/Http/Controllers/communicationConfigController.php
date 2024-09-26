<?php

namespace App\Http\Controllers;

use App\Models\communicationConfig;
use Illuminate\Http\Request;

class communicationConfigController extends Controller
{
    public function index(){
        $allCommunications = communicationConfig::query()->simplePaginate(2);
        return response()->json($allCommunications->items());
    }
}
