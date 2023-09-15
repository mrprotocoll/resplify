<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\ResumeRequest;
use App\Http\Requests\V1\ResumeReviewRequest;
use App\Models\Resume;
use App\Models\ResumeReview;
use Illuminate\Http\Request;

class ResumeReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ResumeReviewRequest $request)
    {
        $save = Resume::upload($request->file('resume'), $request->job_titles);
        if($save) {
            // create a new resume request from the newly created resume resume
            $resumeRequest = new ResumeReview();
            $save->review()->create([
                "reviewer_id" => $request->reviewer,
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ResumeReview $resumeReview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ResumeReview $resumeReview)
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
