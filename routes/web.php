<?php

use App\Http\Controllers\Admin\AmenityController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\RoomtypeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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




Route::get('/', [HomeController::class, 'index'])->name('home');

//Auth
Route::get('/login/page', [LoginController::class, 'showLoginForm'])->name('login.page');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register/page', [RegisterController::class, 'index'])->name('register.page');
Route::post('/register/store', [RegisterController::class, 'store'])->name('register.store');
Route::get('/v/{hash}', [VerificationController::class, 'verifyEmail'])->name('email.verify');

Route::get('/resend/page', [VerificationController::class, 'viewResend'])->name('resend.page')->middleware(['auth', 'verify_email']);
Route::post('/resend', [VerificationController::class, 'resendEmail'])->name('resend')->middleware(['auth', 'verify_email']);
Route::get('/resend', [VerificationController::class, 'resendEmail'])->name('resend')->middleware(['auth', 'verify_email']);


Route::get('/verify/success', [VerificationController::class, 'viewVerifySuccess'])->name('verify.success');

Route::get('/password/reset',[ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/emai',[ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}',[ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset',[ResetPasswordController::class,'reset'])->name('password.update');


//admin

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [HomeController::class,'admin'])->name('home');

    Route::get('/post',[PostController::class,'adminPost'])->name('post');

    Route::prefix('manager')->name('manager.')->group(function () {
        Route::get('amenity',[AmenityController::class,'index'])->name('amenity');
        Route::post('amenity/update',[AmenityController::class,'update'])->name('amenity.update');
        Route::post('amenity/store', [AmenityController::class, 'store'])->name('amenity.store');
        Route::post('amenity/delete', [AmenityController::class, 'delete'])->name('amenity.delete');

        Route::get('roomtype', [RoomtypeController::class, 'index'])->name('roomtype');
        Route::post('roomtype/update', [RoomtypeController::class, 'update'])->name('roomtype.update');
        Route::post('roomtype/store', [RoomtypeController::class, 'store'])->name('roomtype.store');
        Route::post('roomtype/delete', [RoomtypeController::class, 'delete'])->name('roomtype.delete');

        Route::get('location', [LocationController::class, 'index'])->name('location');
        Route::post('location/update', [LocationController::class, 'update'])->name('location.update');
        Route::post('location/store', [LocationController::class, 'store'])->name('location.store');
        Route::post('location/delete', [LocationController::class, 'delete'])->name('location.delete');

        Route::get('question', [QuestionController::class, 'index'])->name('question');
        Route::post('question/update', [QuestionController::class, 'update'])->name('question.update');
        Route::post('question/store', [QuestionController::class, 'store'])->name('question.store');
        Route::post('question/delete', [QuestionController::class, 'delete'])->name('question.delete');

        Route::get('user', [UserController::class, 'index'])->name('user');
        Route::post('user/store', [UserController::class, 'store'])->name('user.store');
        Route::post('user/ban-unban/review', [UserController::class, 'ban_unban_Review'])->name('user.ban.unban.review');

       

    });
});

