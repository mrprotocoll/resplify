<?php

namespace App\Http\Controllers\Api\V1\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\RegisterRequest;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

/**
 * @group Authentication
 *
 * Endpoint to manage user authentication
 */
class RegisterController extends Controller
{
    /**
     * Register a new admin.
     *
     * @response 422 {
     *       "error": "Account already exist, kindly login"
     * }
     * @apiResource App\Http\Resources\V1\UserResource
     * @apiResourceModel App\Models\User
     * @param RegisterRequest $request
     * @return UserResource | JsonResponse
     */
    public function __invoke(RegisterRequest $request)
    {
        // check if user already exist

        if(User::where("email", $request->email)->where("role", 'admin')->exists()){
            return response()->json(["message" => "Account already exist, kindly login"]);
        }

        $request->password = Hash::make($request->password);
        $user = User::create($request->validated());
        if($user) {
            event(new Registered($user));
            return new UserResource($user);
        }else{
            return response()->json(["message" => "Error occurred. Please try again"], 422);
        }
    }
}
