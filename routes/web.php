<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;



Route::get('/', function () {
    return view('welcome');
});
Route::get('register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
