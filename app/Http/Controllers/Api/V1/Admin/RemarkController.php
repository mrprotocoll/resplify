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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class RemarkController extends Controller
{

    public function store(RemarkRequest $request)
    {
        try {
            $remark = new Remark();
            $remark->created_by = Admin::current()->id;
            $remark->name = $request->name;
            $remark->description = $request->description;
            $image = $request->file('image');
            if($image) {
                $remark->image = FileHelper::upload($image, 'remarks');
            }

            $remark->save();
            return ResponseHelper::success(new RemarkResource($remark));
        }catch (\Exception $e) {
            Log::error($e);
            return ResponseHelper::error();
        }
    }

    public function update(RemarkRequest $request, Remark $remarks)
    {
        try {
            $remarks->name = $request->name;
            $remarks->description = $request->description;
            $image = $request->file('image');
            if($image) {
                $remarks->image = FileHelper::upload($image, 'remarks');
            }
            return ResponseHelper::success(new RemarkResource($remarks));
        }catch (\Exception $e) {
            Log::error($e);
            return ResponseHelper::error();
        }
    }

    public function destroy(Remark $remarks)
    {
        try {
            $deleted = $remarks;
            $remarks->delete();
            return ResponseHelper::success(new RemarkResource($deleted));
        }catch (\Exception $e) {
            Log::error($e);
            return ResponseHelper::error();
        }
    }
}
