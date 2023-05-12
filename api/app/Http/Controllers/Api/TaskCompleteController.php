<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use App\Http\Resources\TaskResource;
use App\Repositories\TaskRepository;
use App\Http\Controllers\Controller;

class TaskCompleteController extends Controller
{
    public function __construct(private readonly TaskRepository $repository)
    {

    }

    public function update(Task $task): TaskResource
    {
        $this->repository->toggleComplete($task);

        return new TaskResource($task);
    }
}
