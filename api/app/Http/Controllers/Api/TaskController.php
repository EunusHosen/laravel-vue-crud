<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\TaskRequest;
use App\Repositories\TaskRepository;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaskController extends Controller
{
    public function __construct(private readonly TaskRepository $taskRepository)
    {
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        $request->validate([
            'page' => 'integer|min:1',
        ]);

        return TaskResource::collection($this->taskRepository->paginate());
    }

    public function store(TaskRequest $request): JsonResponse
    {
        $task = $this->taskRepository->create($request->validated());

        return (new TaskResource($task))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Task $task): TaskResource
    {
        return new TaskResource($task);
    }

    public function update(UpdateTaskRequest $request, Task $task): TaskResource
    {
        $data = $request->validated();

        $task = $this->taskRepository->update($task, $data);

        return new TaskResource($task);
    }

    public function destroy(Task $task): Response
    {
        $this->taskRepository->delete($task);

        return response()->noContent();
    }
}
