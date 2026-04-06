<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AboutResource extends JsonResource
{
    protected function imageUrl(?string $path): ?string
    {
        return $path ? asset($path) : null;
    }

    public function toArray(Request $request): array
    {
        return [
            'about' => [
                'badge' => $this->about_badge ?: $this->title,
                'title' => $this->about_title ?: $this->title,
                'description' => $this->about_description ?: $this->desc,
                'image' => $this->imageUrl($this->about_image ?: $this->image),
                'second_image' => $this->imageUrl($this->second_image),
            ],
            'mission' => [
                'badge' => $this->mission_badge,
                'title' => $this->mission_title,
                'description' => $this->mission_description,
                'image' => $this->imageUrl($this->mission_image),
            ],
            'vision' => [
                'badge' => $this->vision_badge,
                'title' => $this->vision_title,
                'description' => $this->vision_description,
                'image' => $this->imageUrl($this->vision_image),
            ],
            'what_shapes_the_work' => [
                'badge' => $this->shapes_badge,
                'title' => $this->shapes_title,
                'description' => $this->shapes_description,
                'items' => $this->shapes_items ?? [],
            ],
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
