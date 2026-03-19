<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'cover_image' => $this->coverImage() ? asset($this->coverImage()->image) : null,
            'year' => $this->year,
            'location' => $this->location,
            'area' => $this->area,
            'service' => new ServiceResource($this->whenLoaded('service')),
            'sort_order' => (int) $this->sort_order,
        ];
    }
}
