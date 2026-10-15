<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{   
    public function index(){
        $title = "Halaman Utama";
        return view('admins.index', [
            'title' => $title,
        ] );
    }
}