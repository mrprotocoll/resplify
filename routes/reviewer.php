<?php

use App\Enums\ReviewStatusEnum;
use App\Http\Controllers\Api\V1\ResumeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'role:'. ReviewStatusEnum::REVIEWER->value])->group(function () {

});
