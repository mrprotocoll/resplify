<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Helpers\FileHelper;
use App\Helpers\GlobalHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\RemarkRequest;
use App\Http\Resources\V1\RemarkResource;
use App\Models\Admin;
use App\Models\Remark;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class RemarkController extends Controller
{

    public function store(RemarkRequest $request)
    {
        $remark = new Remark();
        $remark->created_by = Admin::current()->id;
        $remark->name = $request->name;
        $remark->description = $request->description;
        $image = $request->file('image');
        if($image) {
            $remark->image = FileHelper::upload($image, 'remarks');
        }

        $saved = $remark->save();
        return $saved ? ResponseHelper::success(new RemarkResource($remark)) : ResponseHelper::error();
    }

    public function update(RemarkRequest $request, Remark $remarks)
    {
        $remarks->name = $request->name;
        $remarks->description = $request->description;
        $image = $request->file('image');
        if($image) {
            $remarks->image = FileHelper::upload($image, 'remarks');
        }
        return $remarks->save() ? ResponseHelper::success(new RemarkResource($remarks)) : ResponseHelper::error();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Remark $remarks)
    {
        $deleted = $remarks;
        return $remarks->delete() ? ResponseHelper::success(new RemarkResource($deleted)) : ResponseHelper::error();
    }
}
