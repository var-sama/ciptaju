<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AchievementController extends Controller
{   
    public function index(){
        $title = "ini test";
        return view('achievements.index', [
            'title' => $title,
        ] );
    }
}