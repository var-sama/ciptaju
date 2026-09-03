<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VisionMissionController extends Controller
{   
    public function index(){
        $title = "ini test";
        return view('vision-mission.index', [
            'title' => $title,
        ] );
    }
}