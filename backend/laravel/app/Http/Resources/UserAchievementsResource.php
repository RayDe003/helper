<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserAchievementsResource extends JsonResource
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
            'achievement_id' => $this->achievement_id,
            'user_id' => $this->user_id,
            'title' => $this->achievement->title,
            'required_count' => $this->achievement->required_count,
            'progress' => $this->progress,
            'is_complete' => $this->is_complete,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
