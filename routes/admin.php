<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
        Route::apiResource('roles', \App\Models\Role::class)
            ->only(['store', 'update']);
    });
});
