<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Redirect root to welcome page
Route::get('/', [UserController::class, 'welcome'])->name('user.welcome');

// Authentication routes
Route::get('/welcome', [UserController::class, 'welcome'])->name('user.welcome');
Route::get('/login', [UserController::class, 'showLogin'])->name('user.login');
Route::post('/login', [UserController::class, 'login'])->name('user.login');
Route::get('/signup', [UserController::class, 'showSignup'])->name('user.signup');
Route::post('/signup', [UserController::class, 'signup'])->name('user.signup');
Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');

// Protected user management routes
Route::get('/dashboard', [UserController::class, 'index'])->name('user.index');
Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/{user}/update', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/{user}/destroy', [UserController::class, 'destroy'])->name('user.destroy');