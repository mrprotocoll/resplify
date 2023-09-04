<?php

use App\Enums\RoleEnum;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::middleware(['auth:sanctum', 'role:'. RoleEnum::ADMIN])->group(function () {
        Route::apiResource('roles', \App\Http\Controllers\Api\V1\RoleController::class)
            ->only(['index','store', 'update']);
    });
});
