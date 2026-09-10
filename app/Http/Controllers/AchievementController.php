<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AchievementController extends Controller
{   
    public function index(){
        $title = "Daftar Prestasi Ciptaju";
        return view('achievements.index', [
            'title' => $title,
        ] );
    }

    public function view($id = 1)
    {
        $title = "Detail Prestasi";

        return view('achievements.view', [
            'title' => $title,
            'id' => $id,
        ]);
    }
}