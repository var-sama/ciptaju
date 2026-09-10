<?php
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::name('auth.')->prefix('auth')->group(function(){
   
    //daftar(index)
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::get('/view', [AuthController::class, 'view'])->name('view');
    //detail(show)
    
});



