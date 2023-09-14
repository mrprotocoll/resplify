<?php

use App\Enums\RoleEnum;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'role:'. RoleEnum::REVIEWER->value])->group(function () {

});
