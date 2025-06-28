<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Storage;

class UserResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'full_name' => $this->first_name . ' ' . $this->last_name,
            'phone' => $this->phone,
            'birth_date' => $this->birth_date,
            'is_active' => $this->is_active,
            'email_verified' => $this->email_verified,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            // 'avatar_url' => $this->avatar_path ? Storage::disk('public')->url($this->avatar_path) : null,
            'created_at' => $this->created_at,
            'joined_date' => $this->created_at?->format('M d, Y'),

            'token' => $this->when(isset($this->token), $this->token),

        ];
    }
}
