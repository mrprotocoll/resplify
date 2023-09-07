<?php

namespace App\Helper;

use Illuminate\Http\JsonResponse;

class GlobalHelper
{
    public static function error(): JsonResponse
    {
        return response()->json(['error' => 'Oops something went wrong'], 500);
    }

    public static function response($data, string $message = null, $status = null): JsonResponse{
        $response['date']  = $data;
        if($message) {
            $response['message']  = $message;
        }
        return $status ? response()->json($response, $status) : response()->json($response);
    }
}
