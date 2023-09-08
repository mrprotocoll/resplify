<?php

namespace App\Http\Controllers\Api\V1\Reviewer;

use App\Enums\RoleEnum;
use App\Helper\GlobalHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ReviewerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(RoleEnum|string $role = RoleEnum::USER)
    {
        $user = User::whereHas('roles', function ($query) use ($role) {
            $query->where('name', $role);
        })->paginate();

        return GlobalHelper::response(UserResource::collection($user));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $user = User::find($id);
        return GlobalHelper::response(new UserResource($user));
    }


    /**
     * Change the authenticated user's password.
     *
     * @authenticated
     * @param Request $request The password change request.
     *
     * @bodyParam current_password string required The user's current password.
     * @bodyParam new_password string required The new password.
     * @bodyParam new_password_confirmation string required The confirmation of the new password.
     *
     * @response {
     *     "message": "Password changed successfully"
     * }
     * @response 401 {
     *     "error": "Current password is incorrect"
     * }
     * @response 422 {
     *     "error": "Validation failed."
     * }
     *
     * @return JsonResponse
     * @throws ValidationException
     */
    public function changePassword(Request $request) : JsonResponse
    {
        $user = User::current();
        $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($request->input('current_password'), $user->password)) {
            return response()->json(['error' => 'Current password is incorrect'], 401);
        }

        $user->update(['password' => Hash::make($request->input('new_password'))]);

        return response()->json(['message' => 'Password changed successfully'], 200);
    }

}
