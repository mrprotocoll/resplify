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
        return [
            'id' => $this->id,
            "resume" => new ResumeResource($this->resume),
            "status" => $this->status,
            "summary" => $this->summary,
            'remarks' => RemarkResource::collection($this->remarks)
        ];
    }
}
