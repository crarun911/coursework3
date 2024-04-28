<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;


Route::group(['middleware'=>'auth'],function(){
});
Route::get('profile',[ProfileController::class,'showProfile'])->name('profile');
// Route::get('/', function () {    return view('welcome');});
Route::get('register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [UserController::class, 'register']);
Route::get('login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('login', [UserController::class, 'authenticate']);
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
// Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::post('logout', [UserController::class, 'logout'])->name('logout');
Route::get('/profile/edit',[ProfileController::class,'editProfile'])->name('profile.edit');
Route::get('/',function () {    return view('test');});
