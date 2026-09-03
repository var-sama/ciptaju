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

    public function newsdetail()
    {
        $title = "Detail Berita";
        $id = 1;

        return view('students.newsdetail', [
            'title' => $title,
            'id' => $id,
        ]);
    }

    public function registration()
    {
        return view('students.pendaftaran');
    }

    public function storeRegistration(Request $request)
    {
        $request->validate([
            'school_target' => ['required', 'string', 'max:100'],
            'school_year' => ['required', 'string', 'max:20'],
            'student_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'active_number' => ['required', 'string', 'max:30'],
        ]);

        return redirect()->route('students.registration')->with('success', 'Pendaftaran berhasil dikirim.');
    }
}