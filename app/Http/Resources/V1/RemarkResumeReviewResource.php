<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RemarkResumeReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        print_r($this->pivot);
        return [
            'id' => $this->id,
            'remark' => $this->remark,
            'description' => $this->pivot->description,
            'score' => $this->pivot->score
        ];
    }
}
