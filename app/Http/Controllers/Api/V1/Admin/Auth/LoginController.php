<?php

namespace App\Http\Controllers\Api\V1\Admin\Auth;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\LoginRequest;
use App\Http\Resources\V1\AdminResource;
use App\Http\Resources\V1\UserResource;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function __invoke(LoginRequest $request): JsonResponse
    {
        $user = Admin::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'The provided credentials are incorrect.',
                'status' => 'error',
                'statusCode' => '422',
            ], 422);
        }

//        if(!$user->hasRole(RoleEnum::ADMIN)){
//            return response()->json(['error' => 'Permission Denied'], 403);
//        }

        $device = substr($request->userAgent() ?? '', 0, 255);
        $token = $user->createToken($device)->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'status' => 'success',
            'statusCode' => '200',
            'access-token' => $token,
            'data' => new AdminResource($user)
        ]);
    }
}
