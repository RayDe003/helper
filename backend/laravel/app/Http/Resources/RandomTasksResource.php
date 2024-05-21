<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RandomTasksResource extends JsonResource
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
            'user_system_task_id' => $this->userSystemTask->id,
            'system_task_id' => $this->userSystemTask->system_task_id,
            'title' => $this->userSystemTask->systemTask->title,
            'is_complete' => $this->is_complete,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deteled_at' => $this->deleted_at
        ];
    }
}
