<?php

namespace App\Helpers;
use Illuminate\Http\JsonResponse;
class ResponseHelper
{
    public static function error($message = 'Oops something went wrong', $status = 500): JsonResponse
    {
        return response()->json(['error' => $message], $status);
    }

    public static function success($data = null, string $message = null, $status = 200): JsonResponse
    {
        $response = ['status' => 'success', 'statusCode' => $status];
        if($data) $response['date'] = $data;
        if($message) $response['message']  = $message;
        return response()->json($response, $status);
    }
}
