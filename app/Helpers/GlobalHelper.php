<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;

class GlobalHelper
{
    public static function error($message = 'Oops something went wrong', $status = 500): JsonResponse
    {
        return response()->json(['error' => $message], $status);
    }

    public static function response($data = null, string $message = null, $status = null): JsonResponse
    {
        $response = [];
        if($data) $response['date'] = $data;
        if($message) $response['message']  = $message;
        return $status ? response()->json($response, $status) : response()->json($response);
    }

    /**
     * format timestamp in the format 'Y-m-d H:i:s'
     * @param $date
     * @return string
     */
    public static function dateTime($date): string
    {
        return $date->toDateTimeString();
    }
}
