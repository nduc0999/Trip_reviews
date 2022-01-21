<?php

use App\Http\Controllers\Admin\AmenityController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\RoomtypeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TravelController;
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



//Home
Route::get('/', [HomeController::class, 'index'])->name('home');

//Post, review, like 
Route::get('/Review-{slug}_{id}',[PostController::class,'loadPost'])->name('post.show');
Route::post('/post/search',[PostController::class,'search'])->name('post.search');
Route::get('/post/search/result', [PostController::class, 'searchPage'])->name('post.search.result');
Route::get('/post/region-{region}',[PostController::class,'vỉewPostRegion'])->name('post.region');

Route::middleware('auth')->group(function(){
    Route::get('/UserReviewEdit-{slug}_{id}',[PostController::class,'formReview'])->name('form.review')->middleware('not_verify_email');
    Route::post('/review/store',[PostController::class,'storeReivew'])->name('review.store');
    Route::post('/review/like',[PostController::class,'likeReview'])->name('review.like');
    Route::get('/review/success',[PostController::class,'reviewSuccess'])->name('review.success');
    Route::post('/review/rep', [PostController::class, 'repReview'])->name('review.rep');
    Route::post('/review/rep/delete',[PostController::class,'deleteRep'])->name('review.rep.delete');
    Route::post('/review/rep/update',[PostController::class,'repUpdate'])->name('review.rep.update');
    Route::post('/review/hidden', [PostController::class, 'hiddenReview'])->name('review.hidden');
    Route::post('/review/remove',[PostController::class, 'removeReview'])->name('review.remove');

    Route::get('/propose',[PostController::class,'showPropose'])->name('propose.show');
    Route::get('/post/list/amenity', [PostController::class, 'listAmenity'])->name('post.list.amenity');
    Route::get('/post/list/roomtype', [PostController::class, 'listRoomtype'])->name('post.list.roomtype');
    Route::post('/post/propose/store', [PostController::class, 'storePropose'])->name('post.propose.store');
    Route::get('/post/propose/success',[PostController::class,'proposeSuccess'])->name('post.propose.success');

    Route::get('/travel',[TravelController::class,'index'])->name('travel');
    Route::post('/travel/store', [TravelController::class, 'store'])->name('travel.store');
    Route::post('/travel/update', [TravelController::class, 'update'])->name('travel.update');
    Route::get('/Travel-{slug}_{id}', [TravelController::class, 'infoTravel'])->name('travel.info');
    Route::post('/travel/status', [TravelController::class, 'changeStatus'])->name('travel.status');
    Route::get('/travel/search', [TravelController::class, 'search'])->name('travel.search');
    Route::post('/travel/remove', [TravelController::class, 'removeTravel'])->name('travel.remove');
    Route::post('/travel/remove/post',[TravelController::class,'removePost'])->name('travel.remove.post');
    Route::post('/travel/add/post', [TravelController::class, 'addPost'])->name('travel.add.post');

    Route::post('/home/list/travel',[HomeController::class,'listHomeTravel'])->name('home.list.travel');
    Route::post('/home/add/travel', [HomeController::class, 'addToTravel'])->name('home.add.travel');

    Route::get('/list/post/review',[PostController::class,'listReview'])->name('list.post.review');

    Route::get('/profile/{name}_{id}',[UserController::class,'profileUser'])->name('profile.user');
    Route::post('/profile/update',[UserController::class,'updateProfile'])->name('profile.update');
    Route::post('/profile/change/avatar', [UserController::class, 'changeAvatar'])->name('profile.change.avatar');
    Route::post('/profile/change/wall', [UserController::class, 'changeWall'])->name('profile.change.wall');
    Route::post('/user/post/photo', [UserController::class, 'postPhoto'])->name('user.post.photo');
    Route::post('/postphoto/like',[UserController::class, 'likePostPhoto'])->name('postphoto.like');
    Route::post('/postphoto/delete',[UserController::class,'deletePostPhoto'])->name('post.photo.delete');

});

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
Route::get('/password/change',[UserController::class,'viewChangePassword'])->name('password.change')->middleware('auth');
Route::post('/password/change/check', [UserController::class, 'checkPassword'])->name('password.change.check')->middleware('auth');
Route::get('/password/change/new', [UserController::class, 'viewNewPassword'])->name('password.change.new')->middleware('auth');
Route::post('/password/change/update', [UserController::class, 'updatePassword'])->name('password.change.update')->middleware('auth');
Route::get('/password/change/success', [UserController::class, 'viewChangeSuccess'])->name('password.change.success')->middleware('auth');



//admin

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login',[LoginController::class,'formLoginAdmin'])->name('login');
    Route::post('login/check',[LoginController::class, 'checkLoginAdmin'])->name('login.check');
Route::middleware(['auth_admin','is_admin'])->group(function () {
    Route::get('/', [HomeController::class,'admin'])->name('home');

    Route::get('/post',[PostController::class,'adminPost'])->name('post');
    Route::get('/post/list/amenity',[PostController::class,'listAmenity'])->name('post.list.amenity');
    Route::get('/post/list/roomtype', [PostController::class, 'listRoomtype'])->name('post.list.roomtype');
    Route::post('/post/store', [PostController::class, 'store'])->name('post.store');
    Route::post('/post/drafts', [PostController::class, 'drafts'])->name('post.drafts');
    Route::get('/post/approval',[PostController::class,'listApproval'])->name('approval.post');
    Route::get('/post/approval/{id}/show', [PostController::class, 'showApprovalPost'])->name('approval.post.show');

    Route::get('/dashboard/chart',[HomeController::class,'loadChart'])->name('dashboard.chart');

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
        Route::post('question/activity', [QuestionController::class, 'activityQuestion'])->name('question.activity');

        Route::get('user', [UserController::class, 'index'])->name('user');
        Route::post('user/add/admin', [UserController::class, 'addAdmin'])->name('user.add.admin');
        Route::post('user/ban-unban/review', [UserController::class, 'ban_unban_Review'])->name('user.ban.unban.review');
        Route::post('user/profile', [UserController::class, 'profile'])->name('user.profile');
        Route::post('user/admin/resetpassword', [UserController::class, 'resetPasswordAdmin'])->name('user.admin.resetpassword');


        Route::get('review/approval', [ReviewController::class, 'listApproval'])->name('approval.review');
        Route::get('review/list', [ReviewController::class, 'listReview'])->name('list.review');
        Route::post('review/status/update', [ReviewController::class, 'updateStatus'])->name('review.status.update');

        Route::get('post/list', [PostController::class, 'adminListPost'])->name('post.list');
        Route::post('post/status/update', [PostController::class, 'updateStatus'])->name('post.status.update');
        Route::get('post/edit/{id}/show', [PostController::class, 'showEditPost'])->name('post.edit.show');
        Route::post('post/edit/update',[PostController::class,'updatePost'])->name('post.edit.update');
        Route::post('post/drafts/delete',[PostController::class,'deleteDrafts'])->name('post.drafts.delete');

        

    });
});
});

