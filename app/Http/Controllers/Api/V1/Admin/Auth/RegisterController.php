<?php

namespace App\Http\Controllers\Api\V1\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\RegisterRequest;
use App\Http\Resources\V1\AdminResource;
use App\Models\Admin;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{

    public function __invoke(RegisterRequest $request)
    {
        // check if user already exist

        if(Admin::where("email", $request->email)->exists()){
            return response()->json([
                "message" => "Account already exist, kindly login",
                'status' => 'error',
                'statusCode' => '204',
            ]);
        }

        $request->password = Hash::make($request->password);
        $user = Admin::create($request->validated());
        if($user) {
            event(new Registered($user));

            return response()->json([
                'message' => 'Registration successful',
                'status' => 'success',
                'statusCode' => '201',
                'data' => new AdminResource($user)
            ]);

        }else{
            return response()->json([
                "message" => "Error occurred. Please try again",
                'status' => 'error',
                'statusCode' => '422',
            ], 422);
        }
    }
}
