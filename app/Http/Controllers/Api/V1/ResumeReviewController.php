<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\ResumeRequest;
use App\Http\Requests\V1\ResumeReviewRequest;
use App\Http\Resources\V1\ResumeResource;
use App\Http\Resources\V1\ResumeReviewResource;
use App\Models\Resume;
use App\Models\ResumeReview;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ResumeReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Resume $resume)
    {
        //
        $reviews = $resume->reviews()->with(['reviewer']);
        return ResumeReviewResource::collection($reviews);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ResumeReviewRequest $request): JsonResponse|ResumeResource
    {
        $savedResume = null;
        DB::transaction(function () use ($request) {
            $savedResume = Resume::upload($request->file('resume'), $request->job_titles);
            if($savedResume) {
                // create a new resume request from the newly created resume résumé
                $review = new ResumeReview();
                $review->reviewer_id = $request->reviewer;
                $review->resume_id = $savedResume->id;
                $review->save();
            }
        });

        // TODO:: Send Email to customer and reviewer of a new review
        return GlobalHelper::response(message: "Review created successfully", status: 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(ResumeReview $resumeReview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ResumeReview $resumeReview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ResumeReview $resumeReview)
    {
        //
    }
}
