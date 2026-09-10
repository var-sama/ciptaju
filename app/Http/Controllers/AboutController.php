<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(){
        $title = "Tentang Ciptaju";
        return view('about.index', [
            'title' => $title,
        ]);
    }

    public function view(){
        $title = "Detail Tentang Ciptaju";
        return view('about.view', [
            'title' => $title,
        ]);
    }

    public function discover(){
        $title = "Sejarah Ciptaju";
        return view('about.discover', [
            'title' => $title,
        ]);
    }
}