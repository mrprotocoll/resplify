<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\GlobalHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\RemarkRequest;
use App\Http\Resources\V1\RemarkResource;
use App\Models\Remark;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RemarkController extends Controller
{

    public function index(): JsonResponse|RemarkResource
    {
        try {
            $remarks = Remark::with(['user'])->all();
            return $remarks ? new RemarkResource($remarks) : GlobalHelper::error();
        }catch (\Exception $e) {
            Log::error($e);
            return ResponseHelper::error();
        }
    }
}
