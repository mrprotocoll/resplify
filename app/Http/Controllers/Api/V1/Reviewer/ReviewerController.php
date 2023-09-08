<?php

namespace App\Http\Controllers\Api\V1\Reviewer;

use App\Enums\RoleEnum;
use App\Helper\GlobalHelper;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/**
 * @group Users management
 */
class ReviewerController extends UserController
{

}
