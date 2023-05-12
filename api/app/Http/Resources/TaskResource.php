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
            'name' => $this->name,
            'completed' => !! $this->completed_at,
            'description' => $this->description,
            'overdue' => ! $this->completed_at && $this->due_date->endOfDay()->isPast(),
            'dueDate' => $this->due_date->format('Y-m-d'),
            'completedAt' => $this->completed_at ? $this->completed_at->format('Y-m-d H:i:s') : null,
            'createdAt' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
