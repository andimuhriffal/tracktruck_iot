<?php

// routes/web.php
use App\Http\Controllers\DetectionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TableController;

Route::get('/', function() {
    return view('auth.login');
 }); 

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/camera', function () {return view('camera');});
Route::get('/table', [TableController::class, 'index']);
Route::get('/detections', [DetectionController::class, 'index']);

// web.php
Route::middleware('auth')->group(function () {
    Route::get('/table', [TableController::class, 'index'])->name('table');
    Route::get('/detections', [DetectionController::class, 'index'])->name('detections');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::get('/detections', [DetectionController::class, 'index'])->name('detections.index');
Route::get('/detections/{id}', [DetectionController::class, 'show'])->name('detections.show');

