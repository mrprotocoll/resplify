<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResumeReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // reviews
        return [
            'resume' => new ResumeResource($this->resume),
            'remarks' => ReviewRemarksResource::collection($this->remarks),
            'reviewer' => new UserResource($this->reviwer->id),
            'summary' => $this->summary,
            'createdAt' => $this->created_at->toDateTimeString(),
            'updatedAt' => $this->updated_at->toDateTimeString(),
        ];
    }
}
