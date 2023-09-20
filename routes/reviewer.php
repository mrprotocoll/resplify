<?php

use App\Enums\RoleEnum;
use App\Http\Controllers\Api\V1\Reviewer\ResumeReviewController;
use Illuminate\Support\Facades\Route;

Route::prefix('reviewer')->group(function () {
    Route::middleware(['auth:sanctum', 'role:'. RoleEnum::REVIEWER->value])->group(function () {
        Route::get('/reviews', [ResumeReviewController::class, 'index']);
        Route::get('/reviews/{review}', [ResumeReviewController::class, 'show']);
        Route::post('/reviews/{review}', [ResumeReviewController::class, 'store']);
        Route::put('/reviews/{review}', [ResumeReviewController::class, 'updateStatus']);
    });
});
