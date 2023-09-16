<?php

use App\Enums\RoleEnum;
use App\Http\Controllers\Api\V1\ResumeController;
use App\Http\Controllers\Api\V1\ResumeReviewController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'role:'. RoleEnum::USER->value])->group(function () {
    Route::apiResource('/resumes', ResumeController::class)
        ->only(['index', 'store', 'destroy']);

    // create resume review
    Route::post('/resume-review', [ResumeReviewController::class, 'store']);
});
