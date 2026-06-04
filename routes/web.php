<?php

use App\Http\Controllers\Admin\Sign\SigninController;
use App\Http\Controllers\Admin\Sign\SignupController;
use App\Http\Controllers\Admin\Sign\ForgotController;
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
Route::get('forgot', function () {
    return view('admin.sign.forgot');
})->name('forgot');
Route::post('forgot', [ForgotController::class, 'forgot']);

// Dashboard
Route::get('dashboard', function () {
    return view('admin.dashboard.index');
})->middleware(['auth', 'prevent-back-history'])->name('dashboard');


// Logout
Route::post('logout', [SigninController::class, 'logout'])->name('logout');


