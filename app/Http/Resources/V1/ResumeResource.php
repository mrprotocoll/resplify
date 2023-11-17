<?php

namespace App\Http\Resources\V1;

use App\Helpers\GlobalHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResumeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $jobs = $this->job_titles
            ? array_map(fn($job) => trim($job), explode(',', $this->job_titles))
            : '';

        return [
            'id' => $this->id,
            'job_titles' => $jobs,
            'url' => asset('storage/' . $this->name), // Return the full URL to the image
            'createdAt' => GlobalHelper::dateTime($this->created_at)
        ];
    }
}
