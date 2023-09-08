<?php

use App\Enums\RoleEnum;
use App\Http\Controllers\Api\V1\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::middleware(['auth:sanctum', 'role:'. RoleEnum::ADMIN])->group(function () {
        Route::apiResource('roles', \App\Http\Controllers\Api\V1\Admin\RoleController::class)
            ->only(['index','store', 'update']);

        // get all users
        Route::get('/users', [UserController::class, 'user']);
        // get all reviewers
        Route::get('/reviewers', [UserController::class, 'reviewer']);
        // get all admin
        Route::get('/admins', [UserController::class, 'admin']);
    });
});
