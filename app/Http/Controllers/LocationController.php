<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class LocationController extends Controller
{
    public function getStateList(Request $request) {
        $states = DB::table("state")
            ->where("country_id",$request->countryID)
            ->pluck("name","id");
            return response()->json($states);
            
    }

    public function getCityList(Request $request) {
        $cities = DB::table("city")
        ->where("state_id",$request->stateID)
        ->pluck("name","id");
        return response()->json($cities);
    }
}
