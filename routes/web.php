<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobsController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'account'], function () {
    // this section for guest
    Route::group(['middleware' => 'guest'], function () {
        Route::post('/authenticate', [AccountController::class, 'authenticate'])->name('account.authenticate');
        Route::get('/register', [AccountController::class, 'register'])->name('account.register');
        Route::post('/process-registration', [AccountController::class, 'processRegistration'])->name('account.processRegistration');
        Route::get('/login', [AccountController::class, 'login'])->name('account.login');
    });

    // this section for user who authenticated
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/profile', [AccountController::class, 'profile'])->name('account.profile');
        Route::put('/update-profile', [AccountController::class, 'updateProfile'])->name('account.updateProfile');
        Route::put('/update-profile-pic', [AccountController::class, 'updateProfilePic'])->name('account.updateProfilePic');
        Route::get('/create-job', [JobsController::class, 'create'])->name('account.createJob');
        Route::post('/store-job', [JobsController::class, 'store'])->name('account.storeJob');
        Route::get('/jobs', [JobsController::class, 'getJob'])->name('account.getJob');
        Route::get('/logout', [AccountController::class, 'logout'])->name('account.logout');
    });
});
