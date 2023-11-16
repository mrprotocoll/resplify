<?php

namespace App\Http\Controllers\Api\V1\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @group Authentication
 *
 * Endpoint to manage user authentication
 */
class LogoutController extends Controller
{

    public function __invoke(Request $request) : JsonResponse
    {
        //
        $user = Auth::guard('admin')->user();
        if(!Auth::guard('admin')->check()) {
            return response()->json([
                'message' => 'Unauthorized user',
                'status' => 'error',
                'statusCode' => '402',
            ], 402);
        }
        $user->currentAccessToken()->delete();

        return response()->json([
            'message' => 'logged out successfuly',
            'status' => 'success',
            'statusCode' => '204',
        ], 204);
    }
}
