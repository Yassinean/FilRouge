<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobsController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/jobs-page', [JobsController::class, 'index'])->name('jobs-page');
Route::get('/jobs/detail/{id}', [JobsController::class, 'detailJob'])->name('detailJob');
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
        // get methods

        Route::get('/profile', [AccountController::class, 'profile'])->name('account.profile');
        //this one for candidate that he wants to remove his candidature from this job
        Route::get('/jobs', [JobsController::class, 'getJob'])->name('account.getJob');
        Route::get('/jobs/edit/{jobId}', [JobsController::class, 'editJob'])->name('account.editJob');
        Route::get('/create-job', [JobsController::class, 'create'])->name('account.createJob');
        Route::get('/jobs/delete/{jobId}', [JobsController::class, 'deleteJob'])->name('account.deleteJob');
        Route::get('/appliedJob', [AccountController::class, 'appliedJob'])->name('account.appliedJob');
        Route::get('/jobsApp/remove/{jobId}', [AccountController::class, 'removeJob'])->name('account.removeJob');
        Route::get('/savedJob', [AccountController::class, 'savedJob'])->name('account.savedJob');
        Route::get('/jobsSaved/remove/{jobId}', [AccountController::class, 'removeSavedJob'])->name('account.removeSavedJob');
        Route::get('/logout', [AccountController::class, 'logout'])->name('account.logout');

        // end get methods
        Route::put('/update-profile', [AccountController::class, 'updateProfile'])->name('account.updateProfile');
        Route::put('/update-profile-pic', [AccountController::class, 'updateProfilePic'])->name('account.updateProfilePic');
        Route::post('/store-job', [JobsController::class, 'store'])->name('account.storeJob');
        Route::post('/jobs/update/{jobId}', [JobsController::class, 'update'])->name('account.update');
        Route::post('/apply-job', [JobsController::class, 'applyJob'])->name('account.applyJob');
        Route::post('/save-job', [JobsController::class, 'saveJob'])->name('account.saveJob');
    });
});
