<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryJobController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use \App\Http\Controllers\TypeJobController;
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
        Route::get('/dashboard', [AccountController::class, 'profileAdmin'])->name('dash.dashboard');
        //this one for candidate that he wants to remove his candidature from this job
        Route::get('/jobs', [JobsController::class, 'getJob'])->name('account.getJob');
        Route::get('/jobs/edit/{jobId}', [JobsController::class, 'editJob'])->name('account.editJob');
        Route::get('/create-job', [JobsController::class, 'create'])->name('account.createJob');
        Route::get('/jobs/delete/{jobId}', [JobsController::class, 'deleteJob'])->name('account.deleteJob');
        Route::get('/appliedJob', [AccountController::class, 'appliedJob'])->name('account.appliedJob');
        Route::get('/jobsApp/remove/{jobId}', [AccountController::class, 'removeJob'])->name('account.removeJob');
        Route::get('/savedJob', [AccountController::class, 'savedJob'])->name('account.savedJob');
        Route::get('/categories', [AdminController::class, 'displayCategory'])->name('dash.category');
        Route::get('/job-types', [TypeJobController::class, 'displayTypes'])->name('dash.type');
        Route::get('/jobsSaved/remove/{jobId}', [AccountController::class, 'removeSavedJob'])->name('account.removeSavedJob');
        Route::get('/delete-category/{id}', [AdminController::class, 'destroyCategory'])->name('dash.deleteCateg');
        Route::get('/delete-type/{id}', [AdminController::class, 'destroyType'])->name('dash.deleteType');
        Route::get('/logout', [AccountController::class, 'logout'])->name('account.logout');
        Route::get('/edit-category/{id}', [AdminController::class, 'editCategory'])->name('dash.editCateg');
        Route::get('/edit-type/{id}', [AdminController::class, 'editType'])->name('dash.editType');
        // end get methods

        // start post and put and patch method
        Route::put('/update-profile', [AccountController::class, 'updateProfile'])->name('account.updateProfile');
        Route::put('/update-profile-pic', [AccountController::class, 'updateProfilePic'])->name('account.updateProfilePic');
        Route::post('/store-job', [JobsController::class, 'store'])->name('account.storeJob');
        Route::put('/update-category/{id}', [AdminController::class, 'updateCategory'])->name('dash.updateCateg');
        Route::put('/update-type/{id}', [AdminController::class, 'updateType'])->name('dash.updateType');
        Route::post('/store-category', [AdminController::class, 'storeCategory'])->name('dash.storeCateg');
        Route::post('/store-type', [AdminController::class, 'storeType'])->name('dash.storeType');
       // Route::post('/edit-category', [CategoryJobController::class, 'edit'])->name('account.editCategoy');
        Route::post('/jobs/update/{jobId}', [JobsController::class, 'update'])->name('account.update');
        Route::post('/apply-job', [JobsController::class, 'applyJob'])->name('account.applyJob');
        Route::post('/save-job', [JobsController::class, 'saveJob'])->name('account.saveJob');

        // end post method
    });
});
