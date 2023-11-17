<?php

namespace App\Http\Resources\V1;

use App\Helpers\GlobalHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewRemarksResource extends JsonResource
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
            'description' => $this->pivot->description,
            'score' => $this->pivot->score, // Assuming 'score' is a field in your pivot table
            // Add other fields from your Remark model as needed
            'createdAt' => GlobalHelper::dateTime($this->created_at),
            'updatedAt' => GlobalHelper::dateTime($this->updated_at),
        ];
    }
}
