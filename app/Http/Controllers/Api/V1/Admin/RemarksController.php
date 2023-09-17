<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\RemarkRequest;
use App\Http\Resources\V1\RemarkResource;
use App\Models\Remark;
use Illuminate\Http\Request;

class RemarksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $remarks = Remark::all();
        return $remarks ? new RemarkResource($remarks) : GlobalHelper::error();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RemarkRequest $request)
    {
        $remark = new Remark();
        $remark->name = $request->name;
        return $remark->save() ? new RemarkResource($remark) : GlobalHelper::error();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RemarkRequest $request, Remark $remarks)
    {
        $remarks->name = $request->name;
        return $remarks->save() ? new RemarkResource($remarks) : GlobalHelper::error();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Remark $remarks)
    {
        $deleted = $remarks;
        return $remarks->delete() ? new RemarkResource($deleted) : GlobalHelper::error();
    }
}
