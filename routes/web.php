<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AuthController;

// Redirect default ke students
Route::get('/', fn() => redirect()->route('students.index'));

// AUTH
Route::get('/register', [AuthController::class, 'registerForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Hanya admin yang login bisa akses students (create/edit/delete)
// tapi biarkan index & show bisa diakses untuk siswa/umum
Route::resource('students', StudentController::class)->only(['index']);

Route::middleware('auth')->group(function () {
Route::resource('students', StudentController::class)->except(['index']);
});
