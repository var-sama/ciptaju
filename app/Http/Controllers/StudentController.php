<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
        $title = "ini test";
        return view('students.index', [
            'title' => $title,
        ] );
    }

    public function visionmission(){
        $title = "ini test";
        return view('students.visionmission', [
            'title' => $title,
        ] );
    }
}