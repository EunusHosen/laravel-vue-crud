<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TaskRepository
{
    public function paginate($perPage = 15): LengthAwarePaginator
    {
        return Task::query()->orderBy('due_date')->whereNull('completed_at')->paginate($perPage);
    }

    public function completed($perPage = 15): LengthAwarePaginator
    {
        return Task::query()->completed()->latest('completed_at')->paginate($perPage);
    }

    public function create(array $data): Task|Model
    {
        $data['due_date'] = $data['dueDate'];

        return Task::query()->create($data);
    }

    public function update(Task $task, $data): Task
    {
        $data['due_date'] = $data['dueDate'];

        $task->update($data);

        return $task;
    }

    public function delete(Task $task): void
    {
        $task->delete();
    }

    public function toggleComplete(Task $task): Task
    {
        $task->update([
            'completed_at' => $task->completed_at ? null : now(),
        ]);

        return $task;
    }
}
