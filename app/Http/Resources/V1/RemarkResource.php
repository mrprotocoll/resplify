<?php

namespace App\Http\Resources\V1;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RemarkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $resource = [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image ? assert('storage/', $this->image) : null,
        ];

        if(User::isAdmin()) {
            $resource['createdBy'] = new UserResource($this->created_by);
            $resource['createdAt'] = $this->created_at;
        }
        return $resource;
    }
}
