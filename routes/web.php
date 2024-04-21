<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryJobController;
use App\Http\Controllers\EmplyeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\CandidateController;
use \App\Http\Controllers\TypeJobController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/jobs-page', [JobsController::class, 'index'])->name('jobs-page');
Route::get('/candidates', [CandidateController::class, 'index'])->name('candidate');
Route::get('/jobs/detail/{id}', [JobsController::class, 'show'])->name('detailJob');
Route::get('/candidate/profile/{id}', [CandidateController::class, 'profileCandidate'])->name('profileCandidate');

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

        /********** Account Controller ***********/

        Route::get('/profile', [AccountController::class, 'profile'])->name('account.profile');
        Route::get('/appliedJob', [EmplyeeController::class, 'appliedJob'])->name('account.appliedJob');
        Route::get('/myInfos', [EmplyeeController::class, 'myInfo'])->name('account.info');
        Route::post('/registerProfile', [EmplyeeController::class, 'store'])->name('account.registerData');
        Route::get('/savedJob', [EmplyeeController::class, 'savedJob'])->name('account.savedJob');
        Route::delete('/jobsApp/remove/{jobId}', [EmplyeeController::class, 'removeJob'])->name('account.removeJob');
        Route::delete('/jobsSaved/remove/{jobId}', [EmplyeeController::class, 'removeSavedJob'])->name('account.removeSavedJob');
        Route::put('/updateProfile', [AccountController::class, 'updateProfile'])->name('account.updateProfile');
        Route::put('/updateProfilePic', [AccountController::class, 'updateProfilePic'])->name('account.updateProfilePic');
        Route::get('/logout', [AccountController::class, 'logout'])->name('account.logout');

        /********* end account controller **********/

        /************* Category controller ************/
        Route::resource('category-jobs',CategoryJobController::class);
        /*********** end category controller **********/

        /************* Type controller ************/
        Route::resource('type-jobs',TypeJobController::class);
        /*********** end type controller **********/

        /************* Jobs controller ************/

        //this one for candidate that he wants to remove his candidature from this job
        Route::get('/jobs', [JobsController::class, 'getJob'])->name('account.getJob');
        // resource jobs
        Route::resource('jobs',JobsController::class)->only([
            'create','store','edit','update','destroy'
        ]);
        // end resource job
        Route::post('/applyJob', [JobsController::class, 'applyJob'])->name('account.applyJob');
        Route::post('/saveJob', [JobsController::class, 'saveJob'])->name('account.saveJob');
        // end jobs controller

        /************* Jobs controller ************/

        /************* Admin Controller ***********/

        Route::get('/dashboard', [AdminController::class, 'create'])->name('dash.dashboard');
        Route::put('/updateStatusJob/{job}', [AdminController::class, 'updateStatus'])->name('dash.statusJob');
        Route::put('/updateStatusUser/{user}', [AdminController::class, 'updateStatusUser'])->name('dash.statusUser');
        Route::put('/updateFeatureJob/{job}', [AdminController::class, 'updateStatusFeaturedJob'])->name('dash.statusFeaturedJob');
        Route::get('/jobsUpdateStatus', [AdminController::class, 'all'])->name('dash.allJobs');
        Route::get('/users', [AdminController::class, 'users'])->name('dash.users');
        /************ end admin controller **********/


        Route::get('/categories', [CategoryJobController::class, 'displayCategory'])->name('dash.category');
        Route::get('/jobTypes', [TypeJobController::class, 'displayTypes'])->name('dash.type');

       // Route::post('/edit-category', [CategoryJobController::class, 'edit'])->name('account.editCategoy');
    });
});
