<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            'description' => $this->description,
            'image' => $this->image ? asset($this->image) : null,
            'slug' => $this->slug,
            'sort_order' => (int) $this->sort_order,
            'has_projects' => (bool) $this->has_projects,
            'show_in_projects_filter' => (bool) $this->show_in_projects_filter,
            'status' => (bool) $this->status,
        ];
    }
}
