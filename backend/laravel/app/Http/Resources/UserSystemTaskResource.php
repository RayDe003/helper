<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserSystemTaskResource extends JsonResource
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
            'system_task_id' => $this->system_task_id,
            'user_id' => $this->user_id,
            'accept' => $this->accept,
            'title' => $this->systemTask->title,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
