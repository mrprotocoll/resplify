<?php

namespace App\Http\Controllers\Api\V1\Reviewer;

use App\Enums\StatusEnum;
use App\Helpers\GlobalHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\ResumeReviewRequest;
use App\Http\Resources\V1\ResumeResource;
use App\Http\Resources\V1\ResumeReviewResource;
use App\Models\Remark;
use App\Models\ResumeReview;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class ResumeReviewController extends Controller
{

    public function index()
    {
        try {
            $reviews = User::current()->reviews()->paginate();
            return ResponseHelper::success(ResumeReviewResource::collection($reviews));
        }catch (\Exception $e) {
            Log::error($e);
            return ResponseHelper::error();
        }

    }

    public function store(ResumeReviewRequest $request, ResumeReview $review): JsonResponse|ResumeResource
    {
        try {
            $review->summary = $request->summary;
            DB::transaction(function () use ($request, $review) {
                // update review status to success
                $review->status = StatusEnum::SUCCESS->value;
                $review->save();
                foreach ($request->remarks as $remark) {
                    $review->remarks()->attach(Remark::findOrFail($remark['id']), [
                        'description' => $remark['description'],
                        'score' => $remark['score']
                    ]);
                }
            });

            // TODO:: Send Email to customer of review on their resume
            return ResponseHelper::success(data: new ResumeReviewResource($review) ,message: "Resume reviewed successfully", status: 201);
        }catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
            return ResponseHelper::error();
        }
    }

    public function show(ResumeReview $resumeReview)
    {
        try {
            return !$resumeReview->exists()
                ? ResponseHelper::error('Could not update status. Try again', 404)
                : ResponseHelper::success(new ResumeReviewResource($resumeReview));
        }catch (\Exception $e) {
            Log::error($e);
            return ResponseHelper::error();
        }
    }

    public function updateStatus(Request $request, ResumeReview $resumeReview): JsonResponse
    {
        try {
            $validated = $request->validate([
                'status' => ['required', Rule::in(StatusEnum::values())]
            ]);

            $resumeReview->status = $validated->status;
            $resumeReview->save();
            return ResponseHelper::success(data: new ResumeReviewResource($resumeReview) ,message: "Resume status updated successfully", status: 200);
        }catch (\Exception $e) {
            Log::error($e);
            return ResponseHelper::error('Could not update status. Try again');
        }
    }
}
