<?php

use App\Http\Controllers\Admin\Sign\SigninController;
use App\Http\Controllers\Admin\Sign\SignupController;
use App\Http\Controllers\Admin\Sign\ForgotController;
use App\Http\Controllers\Master\User\UserController;
use App\Http\Controllers\Master\Role\RoleController;
use App\Http\Controllers\Master\Major\MajorController;
use App\Http\Controllers\Master\Key\KeyController;
use App\Http\Controllers\Master\Utils\LockerController;
use App\Http\Controllers\Master\Student\StudentController;
use App\Http\Controllers\Master\Instructor\InstructorController;
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
Route::resource('major', MajorController::class);
Route::get('key/check-name', [KeyController::class, 'checkName'])->name('key.check-name');
Route::resource('key', KeyController::class);
Route::get('locker/check-code', [LockerController::class, 'checkCode'])->name('locker.check-code');
Route::resource('locker', LockerController::class);
Route::resource('student', StudentController::class);
Route::resource('instructor', InstructorController::class);
