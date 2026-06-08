<?php

use App\Http\Controllers\Admin\Sign\SigninController;
use App\Http\Controllers\Admin\Sign\SignupController;
use App\Http\Controllers\Admin\Sign\ForgotController;
use App\Http\Controllers\Master\User\UserController;
use App\Http\Controllers\Master\Role\RoleController;
use App\Http\Controllers\Master\Utils\LockerController;
use Illuminate\Support\Facades\Route;



// Login
Route::get('/', function () {
    return view('admin.sign.signin');
});
Route::get('signin', function () {
    return view('admin.sign.signin');
})->name('signin');
Route::post('signin', [SigninController::class, 'signin']);
Route::get('login', function () {
    return redirect()->route('signin');
})->name('login');
// Register
Route::get('signup', function () {
    return view('admin.sign.signup');
})->name('signup');
Route::post('signup', [SignupController::class, 'signup']);

// Forgot Password
Route::get('forgot', [ForgotController::class, 'showForgotForm'])->name('forgot');
Route::post('forgot', [ForgotController::class, 'handleForgot'])->name('forgot.submit');
Route::post('forgot/reset', [ForgotController::class, 'resetForgot'])->name('forgot.reset');

// Dashboard
Route::get('dashboard', function () {
    return view('admin.dashboard.index');
})->middleware(['auth', 'prevent-back-history'])->name('dashboard');


// Logout
Route::post('logout', [SigninController::class, 'logout'])->name('logout');

// Resource
Route::resource('user', UserController::class);
Route::resource('role', RoleController::class);
Route::get('locker/check-code', [LockerController::class, 'checkCode'])->name('locker.check-code');
Route::resource('locker', LockerController::class);
