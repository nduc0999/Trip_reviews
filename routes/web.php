<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\HomeController;
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
Route::get('/login/page', [LoginController::class, 'index'])->name('login.page');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register/page', [RegisterController::class, 'index'])->name('register.page');
Route::post('/register/store', [RegisterController::class, 'store'])->name('register.store');
Route::get('/v/{hash}', [VerificationController::class, 'verifyEmail'])->name('email.verify');

Route::get('/resend/page', [VerificationController::class, 'viewResend'])->name('resend.page')->middleware(['auth', 'verify_email']);
Route::post('/resend', [VerificationController::class, 'resendEmail'])->name('resend')->middleware(['auth', 'verify_email']);

Route::get('/verify/success', [VerificationController::class, 'viewVerifySuccess'])->name('verify.success');
