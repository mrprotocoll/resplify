<?php

use App\Http\Controllers\Api\V1\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Api\V1\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Api\V1\Auth\GoogleAuthController;
use App\Http\Controllers\Api\V1\Auth\NewPasswordController;
use App\Http\Controllers\Api\V1\Auth\PasswordResetLinkController;
use App\Http\Controllers\Api\V1\Auth\RegisteredUserController;
use App\Http\Controllers\Api\V1\Auth\VerifyEmailController;
use App\Http\Controllers\Api\V1\ProductController;
use Illuminate\Support\Facades\Route;

// register users
Route::post('/user/register', [RegisteredUserController::class, 'user'])
    ->middleware('guest')
    ->name('register');

// Register reviewers
Route::post('/reviewer/register', [RegisteredUserController::class, 'reviewer'])
    ->middleware('guest')
    ->name('reviewer_register');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest')
    ->name('login');

Route::post('/admin/login', \App\Http\Controllers\Api\V1\Admin\Auth\LoginController::class);

//Route::post('/auth/oauth', GoogleAuthController::class)
//    ->middleware('guest')
//    ->name('auth.google');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.store');

