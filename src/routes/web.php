<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StampController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use Illuminate\Support\Facades\URL;

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

// 会員登録認証ルート
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout']);
// ーーーーーーーーーーーーーーー


// 会員登録後のsuccess表示のルート
Route::get('/register/success', function () {
    return view('auth.success');
})->name('register.success');

// ーーーーーーーーーーーーーーー


// 勤怠打刻画面と日別一覧のビューのルート
Route::middleware('auth')->group(function() {
    Route::get('/attendance', [AttendanceController::class, 'index']);
    Route::get('/', [StampController::class, 'index']);
});
// ーーーーーーーーーーーーーーー


// 勤務時間と休憩時間の打刻ページのルート
Route::middleware('auth')->group(function() {
    Route::post('/start-work', [StampController::class, 'startWork'])->name('start.work');
    Route::post('/end-work', [StampController::class, 'endWork'])->name('end.work');
    Route::post('/start-break', [StampController::class, 'startBreak'])->name('start.break');
    Route::post('/end-break', [StampController::class, 'endBreak'])->name('end.break');
});
// ーーーーーーーーーーーーーーー


// 勤務者一覧ビューのルート

Route::get('/employee',[EmployeeController::class,'employee'])->name('employees.employee');
Route::get('/employees/{id}', [EmployeeController::class, 'detail'])->name('employees.detail');

// ーーーーーーーーーーーーーーー



// メール認証関連のルート
Route::middleware(['auth'])->group(function () {
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])
        ->middleware(['signed'])
        ->name('verification.verify');

    Route::post('/email/resend', [AuthController::class, 'resendVerificationEmail'])
        ->middleware('throttle:6,1')
        ->name('verification.resend');
});
// ーーーーーーーーーーーーーーー


