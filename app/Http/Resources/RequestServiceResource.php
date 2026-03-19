<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RequestServiceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'small_label' => $this->small_label,
            'title' => $this->title,
            'description' => $this->description,
            'button_text' => $this->button_text,
            'image' => $this->image ? asset($this->image) : null,
        ];
    }
}
