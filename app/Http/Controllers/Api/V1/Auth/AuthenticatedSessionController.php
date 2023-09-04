<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\LoginRequest;
use App\Http\Resources\V1\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * User Login.
     *
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws ValidationException
     * @response {
     *      "token": "generated_token"
     *      "data": {
     *          "id": 1,
     *          "name": "User",
     *          "email": "user@email.com"
     *      }
     *  }
     * @response 422 {
     *      "error": "The provided credentials are incorrect."
     * }
     *
     */
    public function store(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        $request->authenticate();
        $user = $request->user();
        $user->tokens()->delete();
        $device = substr($request->userAgent() ?? '', 0, 255);
        $token = $user->createToken($device)->plainTextToken;

        return response()->json(['token' => $token, 'data' => new UserResource($user)], 201);

    }

    /**
     * Logout.
     * @authenticated
     * @response 204 {
     *      "message": "Logged out successfully."
     *  }
     * @response 402 {
     *      "message": "Unauthorized user"
     *  }
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        if(!Auth::check()) {
            return response()->json(['message' => 'Unauthorized user'], 402);
        }

        Auth::guard('api')->logout();

        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'logged out successfuly'], 204);
    }
}
