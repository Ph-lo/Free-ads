<?php

use App\Http\Controllers\AdController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;


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

// Auth::routes(['verify' => true]);

Route::get('/', [AdController::class, 'getAllAds'])->name('/');
Route::get('index', [IndexController::class, 'showIndex']);
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::get('profile', [AuthController::class, 'profile'])->name('profile');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'register'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegister'])->name('register.post'); 
Route::get('dashboard', [AdController::class, 'getAllAds'])->name('dashboard'); 
Route::get('modify-password', [AuthController::class, 'modifyPass'])->name('modify.pass'); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::post('post-modify-pass', [UserController::class, 'passwordUpdate'])->name('modifyPass.post'); 
Route::post('post-modify-profile', [UserController::class, 'profileUpdate'])->name('modifyProfile.post'); 

Route::get('my-ads', [AdController::class, 'index'])->name('my.ads'); 
Route::get('new-ad', [AdController::class, 'newAd'])->name('new.ad'); 
Route::post('post-new-ad', [AdController::class, 'postAd'])->name('ad.post');
Route::post('search-ads', [AdController::class, 'searchAds'])->name('search.ads');
Route::get('ad/{id}', [AdController::class, 'show'])->name('ads.show');
Route::get('modify-ad/{id}', [AdController::class, 'modify'])->name('ads.modify');
Route::post('update/{id}', [AdController::class, 'update'])->name('ads.update');
Route::get('delete-ad/{id}', [AdController::class, 'destroy'])->name('ads.delete');

Route::get('messages', [MessageController::class, 'getAllConvos'])->name('messages'); 
Route::get('new-message/{id}', [MessageController::class, 'newMessage'])->name('message.new');
Route::get('convo/{from_id}', [MessageController::class, 'getConvo'])->name('convo');
Route::post('post-message/{id}', [MessageController::class, 'postMessage'])->name('message.post');

// Route::get('')


// Auth::routes(['verify' => true]);
// Route::get('/email/verify', 'VerificationController@show')->name('verification.notice');
// Route::get('/email/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify')->middleware(['signed']);
// Route::post('/email/resend', 'VerificationController@resend')->name('verification.resend');
