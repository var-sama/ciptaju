<?php
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\ExtracurricularController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\VisionMissionController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::name('students.')->prefix('students')->group(function () {
    Route::get('/', [StudentController::class, 'index'])->name('index');
});

Route::name('achievements.')->prefix('achievements')->group(function () {
    Route::get('/', [AchievementController::class, 'index'])->name('index');
    Route::get('/detail', [AchievementController::class, 'view'])->name('view');
});

Route::get('/extracurriculars', [ExtracurricularController::class, 'index'])->name('extracurriculars.index');
Route::get('/vision-mission', [VisionMissionController::class, 'index'])->name('vision-mission.index');

Route::name('news.')->prefix('news')->group(function(){
    Route::get('/', [NewsController::class, 'index'])->name('index');
    Route::get('/detail', [NewsController::class, 'view'])->name('view');
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

Route::name('about.')->prefix('about')->group(function(){
   
    //daftar(index)
    Route::get('/', [AboutController::class, 'index'])->name('index');
    //detail(show)
    //tambah(create)
    Route::get('/view',[AboutController::class, 'view'])->name('view');
    Route::get('/discover',[AboutController::class, 'discover'])->name('discover');
});



