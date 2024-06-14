<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StampController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use Illuminate\Support\Facades\Mail;
use Laravel\Fortify\Fortify;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 認証ルート
Route::get('/register', [AuthController::class, 'showRegisterForm']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout']);




// 勤怠打刻画面のビュー　日別一覧のビュー
Route::middleware('auth')->group(function() {
    Route::get('/attendance', [AttendanceController::class, 'index']);
    Route::get('/', [StampController::class, 'index']);
});


// --認証不要なルート--
// 勤怠打刻画面のビュー
// Route::get('/', [StampController::class, 'index']);
// 日別一覧のビュー
// Route::get('/attendance', [AttendanceController::class, 'index']);

// 勤務時間と休憩時間の打刻
Route::middleware('auth')->group(function() {
    Route::post('/start-work', [StampController::class, 'startWork'])->name('start.work');
    Route::post('/end-work', [StampController::class, 'endWork'])->name('end.work');
    Route::post('/start-break', [StampController::class, 'startBreak'])->name('start.break');
    Route::post('/end-break', [StampController::class, 'endBreak'])->name('end.break');
});


// ーーーーーーーーーーーーーーーー

