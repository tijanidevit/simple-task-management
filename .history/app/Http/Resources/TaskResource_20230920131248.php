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
            'taskId' => $this->id,
            'projectId' => $this->project_id,
            'title' => $this->title,
            'description' => $this->description,
            'startTime' => $this->start_time,
            'endTime' => $this->end_time,
            'status' => $this->status,
            'project' => new ProjectResource($this->whenLoaded('project')),
            'notes' => TaskResource::collection($this->whenLoaded('notes')),
        ];
    }
}
