<?php

use App\Enums\ReviewStatusEnum;
use App\Http\Controllers\Api\V1\ResumeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'role:'. ReviewStatusEnum::USER->value])->group(function () {
    Route::apiResource('resumes', ResumeController::class)
        ->only(['index', 'store', 'destroy']);
});
