<?php

namespace App\Http\Controllers\Api\V1\Reviewer;

use App\Enums\ReviewStatusEnum;
use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\ResumeRequest;
use App\Http\Requests\V1\ResumeReviewRequest;
use App\Http\Resources\V1\ResumeResource;
use App\Http\Resources\V1\ResumeReviewResource;
use App\Models\Remark;
use App\Models\Resume;
use App\Models\ResumeReview;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class ResumeReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = User::current()->reviews()->paginate();
        return ResumeReviewResource::collection($reviews);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ResumeReviewRequest $request, ResumeReview $review): JsonResponse|ResumeResource
    {
        $review->summary = $request->summary;
        DB::transaction(function () use ($request, $review) {
            // update review status to success
            $review->status = ReviewStatusEnum::SUCCESS->value;
            $review->save();
            foreach ($request->remarks as $remark) {
                $review->remarks()->attach(Remark::findOrFail($remark['id']), [
                    'description' => $remark['description'],
                    'score' => $remark['score']
                ]);
            }
        });

        // TODO:: Send Email to customer of review on their resume
        return GlobalHelper::response(data: new ResumeReviewResource($review) ,message: "Resume reviewed successfully", status: 200);
    }

    public function show(ResumeReview $resumeReview)
    {
        if(!$resumeReview->exists()){
            GlobalHelper::error('Could not update status. Try again', 404);
        }

        return new ResumeReviewResource($resumeReview);
    }

    public function updateStatus(Request $request, ResumeReview $resumeReview): JsonResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(ReviewStatusEnum::values())]
        ]);

        $resumeReview->status = $validated->status;

        return $resumeReview->save()
            ? GlobalHelper::response(data: new ResumeReviewResource($resumeReview) ,message: "Resume status updated successfully", status: 200)
            : GlobalHelper::error('Could not update status. Try again');
    }
}
