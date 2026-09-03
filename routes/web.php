<?php
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\ExtracurricularController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\VisionMissionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::name('students.')->prefix('students')->group(function () {
    Route::get('/', [StudentController::class, 'index'])->name('index');
});

Route::name('news.')->prefix('news')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('index');
});

Route::get('/achievement', [AchievementController::class, 'index'])->name('achievement.index');
Route::get('/ekskul', [ExtracurricularController::class, 'index'])->name('extracurricular.index');
Route::get('/visimisi', [VisionMissionController::class, 'index'])->name('vision-mission.index');