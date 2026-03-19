<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectDetailsResource extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug,
            'short_description' => $this->short_description,
            'year' => $this->year,
            'location' => $this->location,
            'area' => $this->area,
            'challenge' => [
                'title' => $this->challenge_title,
                'description' => $this->challenge_description,
            ],
            'solution' => [
                'title' => $this->solution_title,
                'description' => $this->solution_description,
            ],
            'facts' => $this->facts,
            'service' => new ServiceResource($this->whenLoaded('service')),
            'gallery' => ProjectImageResource::collection($this->whenLoaded('images')),
            'sort_order' => (int) $this->sort_order,
        ];
    }
}
