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
class UserController extends Controller
{
    /**
     * Display a listing of users based on their role.
     *
     * Retrieve a paginated list of users filtered by role.
     *
     * @urlParam role string The role by which to filter the users (e.g., "USER", "REVIEWER", "ADMIN").
     * @queryParam page int The page number for pagination (default: 1).
     * @queryParam per_page int The number of items per page (default: 15).
     *
     * @param RoleEnum|string $role The role to filter the users by. If not provided, all users are listed.
     *
     * @return JsonResponse
     */
    public function index(RoleEnum|string $role): JsonResponse
    {
        if($role)
            $user = User::whereHas('roles', function ($query) use ($role) {
                $query->where('name', $role);
            })->paginate();
        else
            $user = User::paginate();

        return GlobalHelper::response(UserResource::collection($user));
    }

    /**
     * Display a listing of users with the "USER" role.
     *
     * Retrieve a paginated list of users with the "USER" role.
     *
     * @queryParam page int The page number for pagination (default: 1).
     * @queryParam per_page int The number of items per page (default: 15).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function user(): JsonResponse
    {
        return $this->index(RoleEnum::USER);
    }

    /**
     * Display a listing of users with the "REVIEWER" role.
     *
     * Retrieve a paginated list of users with the "REVIEWER" role.
     *
     * @queryParam page int The page number for pagination (default: 1).
     * @queryParam per_page int The number of items per page (default: 15).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function reviewer(): JsonResponse
    {
        return $this->index(RoleEnum::REVIEWER);
    }

    /**
     * Display a listing of users with the "ADMIN" role.
     *
     * Retrieve a paginated list of users with the "ADMIN" role.
     *
     * @queryParam page int The page number for pagination (default: 1).
     * @queryParam per_page int The number of items per page (default: 15).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function admin(): JsonResponse
    {
        return $this->index(RoleEnum::ADMIN);
    }

    /**
     * Show a user resource.
     *
     * Retrieves a user resource by its ID.
     *
     * @urlParam id string required The unique identifier of the user.
     * @response 200 \App\Http\Resources\UserResource Successful response with the user resource.
     * @response 404 {"message": "User not found"} If the user with the given ID is not found.
     *
     * @param  string  $id  The unique identifier of the user.
     *
     * @return \App\Http\Resources\UserResource
     */
    public function show(string $id): JsonResponse
    {
        // Find the user by ID
        $user = User::find($id);

        if (!$user) {
            // Return a 404 response if the user is not found
            return GlobalHelper::response(message: 'User not found', status: 404);
        }

        // Return a successful response with the user resource
        return GlobalHelper::response(new UserResource($user));
    }
}
