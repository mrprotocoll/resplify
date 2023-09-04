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
    /**
     * Admin Logout.
     * @authenticated
     * @response 204 {
     *      "message": "Logged out successfully."
     *  }
     * @response 402 {
     *      "message": "Unauthorized user"
     *  }
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request) : JsonResponse
    {
        //
        $user = Auth::user();
        if(!Auth::check()) {
            return response()->json(['message' => 'Unauthorized user'], 402);
        }
        $user->currentAccessToken()->delete();

        return response()->json(['message' => 'logged out successfuly'], 204);
    }
}
