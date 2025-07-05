<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GoodResource extends JsonResource
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
            'good_uuid' => $this->good_uuid,
            'title' => $this->title,
            'slug' => $this->slug,
            'type' => $this->type,
            'exchange_condition' => $this->exchange_condition,
            'status' => $this->status,
            'state' => $this->state,
            'description' => $this->description,
            'owner_id' => $this->owner_id,
            'category_id' => $this->category_id,
            'created_at' => $this->created_at,
        ];
    }
}
