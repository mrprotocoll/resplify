<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\FileHelper;
use App\Helpers\GlobalHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\ResumeRequest;
use App\Http\Resources\V1\ResumeResource;
use App\Models\Resume;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ResumeController extends Controller
{

    public function index()
    {
        try {
            $resumes = User::current()->resumes;
            return ResponseHelper::success(ResumeResource::collection($resumes));
        }catch (\Exception $e) {
            Log::error($e);
            return ResponseHelper::error();
        }
    }


    public function store(ResumeRequest $request)
    {
        try {
            $count = 0;
            $successfullyStoredResumes = [];

            if ($request->hasFile('resumes')) {
                foreach ($request->file('resumes') as $resume) {
                    $save = Resume::upload($resume);
                    if ($save) {
                        $count++;
                        $successfullyStoredResumes[] = new ResumeResource($save);
                    }
                }
            }else{
                return ResponseHelper::error('No resume file found', 404);
            }

            if($count < 1) {
                return ResponseHelper::error('No files saved');
            }else{
                return ResponseHelper::success(data: ResumeResource::collection($successfullyStoredResumes), status: 201);
            }
        }catch (\Exception $e) {
            Log::error($e);
            return ResponseHelper::error();
        }
    }

    public function destroy(Resume $resume): JsonResponse|ResumeResource
    {
        try {
            $deleted = $resume;
            $resume->delete();
            return ResponseHelper::success(new ResumeResource($deleted));
        }catch (\Exception $e) {
            Log::error($e);
            return ResponseHelper::error();
        }
    }
}
