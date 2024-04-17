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
Route::get('/jobs/detail/{id}', [JobsController::class, 'show'])->name('detailJob');

Route::group(['prefix' => 'account'], function () {
    // this section for guest
    Route::group(['middleware' => 'guest'], function () {
        Route::post('/authenticate', [AccountController::class, 'authenticate'])->name('account.authenticate');
        Route::get('/register', [AccountController::class, 'register'])->name('account.register');
        Route::post('/process-registration', [AccountController::class, 'processRegistration'])->name('account.processRegistration');
        Route::get('/login', [AccountController::class, 'login'])->name('account.login');
    });

    // this section for user who authenticated
    Route::middleware(['auth','banned'])->group(function () {

        // Account Controller
        Route::get('/profile', [AccountControllqer::class, 'profile'])->name('account.profile');
        Route::get('/dashboard', [AccountController::class, 'profileAdmin'])->name('dash.dashboard');
        Route::get('/appliedJob', [AccountController::class, 'appliedJob'])->name('account.appliedJob');
        Route::get('/savedJob', [AccountController::class, 'savedJob'])->name('account.savedJob');
        Route::get('/jobsApp/remove/{jobId}', [AccountController::class, 'removeJob'])->name('account.removeJob');
        Route::get('/jobsSaved/remove/{jobId}', [AccountController::class, 'removeSavedJob'])->name('account.removeSavedJob');
        Route::put('/updateProfile', [AccountController::class, 'updateProfile'])->name('account.updateProfile');
        Route::put('/updateProfilePic', [AccountController::class, 'updateProfilePic'])->name('account.updateProfilePic');
        Route::get('/logout', [AccountController::class, 'logout'])->name('account.logout');
        // end account controller
        // Jobs controller
        //this one for candidate that he wants to remove his candidature from this job
        Route::get('/jobs', [JobsController::class, 'getJob'])->name('account.getJob');

        // ressource jobs
        Route::get('/createJob', [JobsController::class, 'create'])->name('account.createJob');
        Route::get('/jobs/edit/{jobId}', [JobsController::class, 'edit'])->name('account.editJob');
        Route::post('/storeJob', [JobsController::class, 'store'])->name('account.storeJob');
        Route::patch('/jobs/update/{jobId}', [JobsController::class, 'update'])->name('account.update');
        Route::delete('/jobs/delete/{jobId}', [JobsController::class, 'delete'])->name('account.deleteJob');
        // end ressource job

        Route::post('/applyJob', [JobsController::class, 'applyJob'])->name('account.applyJob');
        Route::post('/saveJob', [JobsController::class, 'saveJob'])->name('account.saveJob');
        // end jobs controller

        // Admin Controller
        Route::put('/updateStatusJob/{job}', [AdminController::class, 'updateStatus'])->name('dash.statusJob');
        Route::put('/updateStatusUser/{user}', [AdminController::class, 'updateStatusUser'])->name('dash.statusUser');
        Route::get('/jobsUpdateStatus', [AdminController::class, 'all'])->name('dash.allJobs');

        // ressource type
        Route::post('/storeType', [TypeJobController::class, 'store'])->name('dash.storeType');
        Route::put('/updateType/{id}', [TypeJobController::class, 'update'])->name('dash.updateType');
        //Route::delete('/deleteType/{id}', [TypeJobController::class, 'destroy'])->name('dash.deleteType');
        Route::get('/editType/{id}', [TypeJobController::class, 'edit'])->name('dash.editType');
        Route::resource('type-jobs', TypeJobController::class)->only([
            'store', 'update', 'destroy', 'edit'
        ]);
        // end ressource type

        // ressource category
        Route::post('/storeCategory', [CategoryJobController::class, 'store'])->name('dash.storeCateg');
        Route::put('/updateCategory/{id}', [CategoryJobController::class, 'update'])->name('dash.updateCateg');
        Route::delete('/deleteCategory/{id}', [CategoryJobController::class, 'destroy'])->name('dash.deleteCateg');
        Route::get('/editCategory/{id}', [CategoryJobController::class, 'edit'])->name('dash.editCateg');

        // end ressource category
        Route::get('/users', [AdminController::class, 'users'])->name('dash.users');
        // end admin controller

        Route::get('/categories', [CategoryJobController::class, 'displayCategory'])->name('dash.category');
        Route::get('/jobTypes', [TypeJobController::class, 'displayTypes'])->name('dash.type');


        // start post and put and patch method
       // Route::post('/edit-category', [CategoryJobController::class, 'edit'])->name('account.editCategoy');




        // end post method
    });
});
