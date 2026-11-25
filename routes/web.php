<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ExtracurricularController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentRegistrationController;
use App\Http\Controllers\VisionMissionController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return redirect()->route('news.index');
// });

Route::name('students.')->prefix('students')->group(function () {
    Route::get('/', [StudentController::class, 'index'])->name('index');
});

Route::name('admins.')->prefix('admins')->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
});

Route::name('achievements.')->prefix('achievements')->group(function () {
    Route::get('/', [AchievementController::class, 'index'])->name('index');
    Route::get('/{achievement}', [AchievementController::class, 'view'])->whereNumber('achievement')->name('view');
    Route::post('/', [AchievementController::class, 'store'])->middleware('auth')->name('store');
    Route::put('/{achievement}', [AchievementController::class, 'update'])->middleware('auth')->name('update');
    Route::delete('/{achievement}', [AchievementController::class, 'destroy'])->middleware('auth')->name('destroy');
});

Route::get('/extracurriculars', [ExtracurricularController::class, 'index'])->name('extracurriculars.index');
Route::post('/extracurriculars', [ExtracurricularController::class, 'store'])->middleware('auth')->name('extracurriculars.store');
Route::put('/extracurriculars/{extracurricular}', [ExtracurricularController::class, 'update'])->middleware('auth')->name('extracurriculars.update');
Route::delete('/extracurriculars/{extracurricular}', [ExtracurricularController::class, 'destroy'])->middleware('auth')->name('extracurriculars.destroy');
Route::get('/vision-mission', [VisionMissionController::class, 'index'])->name('vision-mission.index');
Route::middleware('auth')->prefix('admins/users')->name('admins.users.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::post('/', [AdminController::class, 'store'])->name('store');
    Route::put('/{user}', [AdminController::class, 'update'])->name('update');
    Route::delete('/{user}', [AdminController::class, 'destroy'])->name('destroy');
});

Route::middleware('auth')->prefix('admins/registrations')->name('admins.registrations.')->group(function () {
    Route::get('/', [StudentRegistrationController::class, 'index'])->name('index');
    Route::get('/{studentRegistration}', [StudentRegistrationController::class, 'show'])->name('show');
    Route::patch('/{studentRegistration}/status', [StudentRegistrationController::class, 'updateStatus'])->name('status');
});

Route::name('news.')->prefix('news')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('index');
    Route::get('/banner/{banner}', [NewsController::class, 'bannerView'])->name('banner.view');
    Route::get('/{id}', [NewsController::class, 'view'])->whereNumber('id')->name('view');
    Route::post('/', [NewsController::class, 'store'])->middleware('auth')->name('store');
    Route::put('/{news}', [NewsController::class, 'update'])->middleware('auth')->name('update');
    Route::delete('/{news}', [NewsController::class, 'destroy'])->middleware('auth')->name('destroy');
});

Route::name('banners.')->prefix('banners')->middleware('auth')->group(function () {
    Route::post('/', [BannerController::class, 'store'])->name('store');
    Route::put('/{banner}', [BannerController::class, 'update'])->name('update');
    Route::delete('/{banner}', [BannerController::class, 'destroy'])->name('destroy');
});

Route::name('auth.')->prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class, 'loginView'])
        ->name('login')
        ->middleware('guest');

    Route::post('/login', [AuthController::class, 'loginPost'])
        ->name('login.submit')
        ->middleware('guest');

    Route::get('/register', [AuthController::class, 'registerView'])
        ->name('register')
        ->middleware('guest');

    Route::post('/register', [AuthController::class, 'registerPost'])
        ->name('register.submit')
        ->middleware('guest');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout')
        ->middleware('auth');

    Route::get('/view', [AuthController::class, 'view'])
        ->name('view');

    Route::get('/registration', [AuthController::class, 'registration'])
        ->name('registration');

    Route::post('/registration', [AuthController::class, 'storeRegistration'])
        ->name('registration.store');
});

Route::get('/', function () {
    return view('welcome');
});

Route::name('about.')->prefix('about')->group(function () {

    // daftar(index)
    Route::get('/', [AboutController::class, 'index'])->name('index');
    // detail(show)
    // tambah(create)
    Route::get('/view', [AboutController::class, 'view'])->name('view');
    Route::get('/discover', [AboutController::class, 'discover'])->name('discover');
});
