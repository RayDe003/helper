<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
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
//            'file' => asset('/storage/' . $this->file),
            'deadline' => $this->deadline,
            'priority_id' => $this->priority_id,
            'is_complete' => $this->userTask->is_complete,
            'sub_tasks' => SubTaskResource::collection($this->whenLoaded('subTasks')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
