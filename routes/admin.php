<?php

use App\Enums\RoleEnum;
use App\Http\Controllers\Api\V1\Admin\CategoryController;
use App\Http\Controllers\Api\V1\Admin\RemarkController;
use App\Http\Controllers\Api\V1\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::middleware(['auth:admin'])->group(function () {
        Route::apiResource('roles', \App\Http\Controllers\Api\V1\Admin\RoleController::class)
            ->only(['index','store', 'update']);

        // get user by id
        Route::get('/users/{user}', [UserController::class, 'show']);

        // get all customers
        Route::get('/users', [UserController::class, 'user']);
        // get all reviewers
        Route::get('/reviewers', [UserController::class, 'reviewer']);
        // get all admins
        Route::get('/admins', [UserController::class, 'admin']);
        // remarks
        Route::apiResource('/remarks', RemarkController::class)
            ->only(['destroy','store', 'update']);
        // categories
        Route::apiResource('/categories', CategoryController::class)
            ->except(['destroy', 'edit']);
    });
});
