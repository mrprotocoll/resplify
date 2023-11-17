<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\RoleEnum;
use App\Helpers\GlobalHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

/**
 * @group Logged-in User
 * Used for the currently logged-in user info
 */
class UserController extends Controller
{

    public function show()
    {
        try {
            return ResponseHelper::success(new UserResource(User::current()));

        }catch (\Exception $e) {
            Log::error($e);
            return ResponseHelper::error();
        }
    }


    public function changePassword(Request $request) : JsonResponse
    {
        try {
            $user = User::current();
            $this->validate($request, [
                'current_password' => 'required',
                'new_password' => 'required|min:8|confirmed',
            ]);

            if (!Hash::check($request->input('current_password'), $user->password)) {
                return ResponseHelper::error(message: 'Current password is incorrect',status: 401);
            }

            $user->update(['password' => Hash::make($request->input('new_password'))]);

            return ResponseHelper::success(message: 'Password changed successfully');
        }catch (\Exception $e) {
            Log::error($e);
            return ResponseHelper::error();
        }
    }

}
