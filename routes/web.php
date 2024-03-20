<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/register', [AccountController::class, 'register'])->name('account.register');
Route::post('/process-registration', [AccountController::class, 'processRegistration'])->name('account.processRegistration');
Route::get('/login', [AccountController::class, 'login'])->name('account.login');