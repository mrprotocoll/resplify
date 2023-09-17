<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\RemarkRequest;
use App\Http\Resources\V1\RemarkResource;
use App\Models\Remark;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RemarkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse|RemarkResource
    {
        $remarks = Remark::with(['user'])->all();
        return $remarks ? new RemarkResource($remarks) : GlobalHelper::error();
    }
}
