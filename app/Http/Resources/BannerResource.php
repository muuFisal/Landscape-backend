<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
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
            'banner' => $this->banner ? asset($this->banner) : null,
            'title' => $this->title,
            'primary_label' => $this->primary_label,
            'secondary_label' => $this->secondary_label,
            'sub_labels' => collect($this->sub_labels ?? [])->map(function($item) {
                $locale = app()->getLocale();
                return $item[$locale] ?? ($item['en'] ?? '');
            }),
            'sort_order' => $this->sort_order,
            'status' => $this->status,
        ];
    }
}
