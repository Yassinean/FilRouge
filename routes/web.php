<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/account/authenticate', [AccountController::class, 'authenticate'])->name('account.authenticate');
Route::get('/account/profile', [AccountController::class, 'profile'])->name('account.profile');
Route::get('/account/logout', [AccountController::class, 'logout'])->name('account.logout');

Route::group(['account'], function () {
    // this section for guest 
    Route::group(['middleware'],function(){
        Route::get('/register', [AccountController::class, 'register'])->name('account.register');
        Route::post('/process-registration', [AccountController::class, 'processRegistration'])->name('account.processRegistration');
        Route::get('/login', [AccountController::class, 'login'])->name('account.login');
    });

    // this section for user who authenticated 
});