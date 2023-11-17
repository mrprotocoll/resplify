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

    public function store(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        $request->authenticate();
        $user = $request->user();
        $user->tokens()->delete();
        $device = substr($request->userAgent() ?? '', 0, 255);
        $token = $user->createToken($device)->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'status' => 'success',
            'statusCode' => '200',
            'access-token' => $token,
            'data' => new UserResource($user)
        ]);

    }

    public function destroy(Request $request): JsonResponse
    {
        if(!Auth::guard('user')->check()) {
            return response()->json(['message' => 'Unauthorized user'], 402);
        }

        Auth::guard('user')->logout();

        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'logged out successfuly',
            'status' => 'success',
            'statusCode' => '204',
        ], 204);
    }
}
