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

Route::get('/achievements', [AchievementController::class, 'index'])->name('achievements.index');
Route::get('/extracurriculars', [ExtracurricularController::class, 'index'])->name('extracurriculars.index');
Route::get('/vision-mission', [VisionMissionController::class, 'index'])->name('vision-mission.index');