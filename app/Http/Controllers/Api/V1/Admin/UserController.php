<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Enums\RoleEnum;
use App\Helper\GlobalHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/**
 * @group Users management
 */
class UserController extends \App\Http\Controllers\Api\V1\UserController
{
    /**
     * Display a listing of the resource.
     */
    private function index(RoleEnum|string $role): JsonResponse
    {
        if($role)
            $user = User::whereHas('roles', function ($query) use ($role) {
                $query->where('name', $role);
            })->paginate();
        else
            $user = User::paginate();

        return GlobalHelper::response(UserResource::collection($user));
    }

    public function user(): JsonResponse
    {
        return $this->index(RoleEnum::USER);
    }

    public function reviewer(): JsonResponse
    {
        return $this->index(RoleEnum::REVIEWER);
    }

    public function admin(): JsonResponse
    {
        return $this->index(RoleEnum::ADMIN);
    }

}
