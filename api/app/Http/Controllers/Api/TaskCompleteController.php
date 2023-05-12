<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Resources\TaskResource;
use App\Repositories\TaskRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaskCompleteController extends Controller
{
    public function __construct(private readonly TaskRepository $repository)
    {
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        $request->validate([
            'page' => 'integer|min:1',
        ]);

        return TaskResource::collection($this->repository->completed());
    }

    public function update(Task $task): TaskResource
    {
        $this->repository->toggleComplete($task);

        return new TaskResource($task);
    }
}
