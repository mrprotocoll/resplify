<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\FileHelper;
use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ResumeResource;
use App\Models\Resume;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResumeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resumes = User::current()->resumes;

        return ResumeResource::collection($resumes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::current();
        $request = $request->validated();
        $count = 0;
        $successfullyStoredResumes = [];

        foreach ($request->file('resumes') as $resume) {
            $resumeName = "resumes/". FileHelper::formatName($resume->getClientOriginalName());

            // Store the résumé in the 'public' disk (storage/app/public)
            Storage::disk('public')->put($resumeName, file_get_contents($resume));

            // Save the resume file name in the database
            $save = $user->resumes()->create(['name' => $resumeName]);
            if($save) {
                $count++;
                $successfullyStoredResumes[] = new ResumeResource($save);
            }
        }

        if($count < 1) {
            return GlobalHelper::error();
        }else{
            return ResumeResource::collection($successfullyStoredResumes);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resume $resume): JsonResponse|ResumeResource
    {
        $deleted = $resume;
        if($resume->delete())
            return new ResumeResource($deleted);
        else
            return GlobalHelper::error();
    }
}
