<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;


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
Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::post('logout', [UserController::class, 'logout'])->name('logout');
Route::get('/profile/edit',[ProfileController::class,'editProfile'])->name('profile.edit');
Route::get('/delete-post/{post_id}',[PostController::class, 'getDeletePost'])->name('post.delete')->middleware('auth');
Route::post('/edit',[PostController::class,'postEdit'])->name('edit');
Route::post('/like',[PostController::class,'likePost'])->name('like');
Route::get('/user/{user}/posts', [PostController::class,'userPosts'])->name('user.posts');
Route::post('/posts/{post}/comment', [CommentController::class, 'store'])->name('comment.store');
Route::post('/update',[ProfileController::class,'updateProfile'])->name('update');

