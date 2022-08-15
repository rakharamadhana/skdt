<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthExController;

use App\Http\Controllers\CardRequestController;
use App\Http\Controllers\CardApprovalController;

use App\Http\Controllers\LetterRequestController;
use App\Http\Controllers\LetterApprovalController;

use App\Http\Controllers\CertRequestController;
use App\Http\Controllers\CertApprovalController;

use App\Http\Controllers\RegistSubmissionController;
use App\Http\Controllers\RegistApprovalController;

use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\SubmissionApprovalController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;


use App\Http\Controllers\Auth\GoogleLoginController;

use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthController::class, 'indexSignIn']);
Route::post('signin', [AuthController::class, 'actionSignIn'])->name('user.signin');
Route::get('signout', [AuthController::class, 'actionSignOut'])->name('user.signout');
Route::get('404', function(){
    return view('pages/404');
});

Route::get('signin-with-google', [GoogleLoginController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);

Route::middleware(['web', 'my.auth'])->group(function () {
    Route::get('dashboard', [AuthController::class, 'indexDashboard']);
    Route::get('welcome', [AuthController::class, 'indexWelcome']);
    Route::post('password', [AuthController::class, 'actionChangePassword'])->name('user.password');
    
    Route::resource('profile', ProfileController::class, ['only' => ['index', 'store']]);
    Route::resource('user', UserController::class);

    Route::get('user/password/{id}', [UserController::class, 'indexUserPassword']);
    Route::post('user/password/{id}', [UserController::class, 'actionUserPassword']);

    Route::resource('letter-request', LetterRequestController::class);
    Route::resource('letter-approval', LetterApprovalController::class);
    
    Route::resource('cert-request', CertRequestController::class);
    Route::resource('cert-approval', CertApprovalController::class);
    
    Route::resource('card-request', CardRequestController::class);
    
    Route::get('card-approval/download-excel', [CardApprovalController::class, 'actionDownload']);
    Route::resource('card-approval', CardApprovalController::class);
    
    Route::resource('regist-submission', RegistSubmissionController::class);
    Route::resource('regist-approval', RegistApprovalController::class);

    Route::resource('submission', SubmissionController::class);
    Route::get('submission/add-extra/{id}', [SubmissionController::class, 'indexAddExtra']);
    Route::post('submission/add-extra/{id}', [SubmissionController::class, 'actionAddExtra']);
    
    Route::resource('submission-approval', SubmissionApprovalController::class);
});