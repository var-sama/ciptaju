<?php
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::name('students.')->prefix('students')->group(function(){
   

    Route::get('/', [StudentController::class, 'index'])->name('index');
    Route::get('/vision-mission',[StudentController::class, 'visionmission'])->name('visionmission');
    Route::get('/extracurricular',[StudentController::class, 'extra'])->name('extra');
    Route::get('/achievement',[StudentController::class, 'trophy'])->name('trophy');
    Route::get('/news',[StudentController::class, 'news'])->name('news');

});