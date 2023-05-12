<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_updates_task(): void
    {
        $task = Task::factory()->create();

        $data = [
            'name' => 'Updated task name',
            'dueDate' => now()->tomorrow()->format('Y-m-d'),
            'description' => fake()->paragraph(),
        ];

        $response = $this->putJson('/api/tasks/'.$task->id, $data);

        $response->assertStatus(200);

        $response->assertJsonFragment($data);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'name' => $data['name'],
            'due_date' => $data['dueDate'],
            'description' => $data['description'],
        ]);
    }

    public function test_it_fails_to_update_task_without_name(): void
    {
        $task = Task::factory()->create();

        $data = [
            'name' => '',
            'dueDate' => now()->format('Y-m-d'),
            'description' => fake()->paragraph(),
        ];

        $response = $this->putJson('/api/tasks/'.$task->id, $data);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'name',
            ],
        ]);

        $this->assertNotEquals([
            'name' => $task->name,
            'description' => $task->description,
            'dueDate' => $task->due_date,
        ], $data);
    }

    public function test_it_fails_to_update_task_without_description(): void
    {
        $task = Task::factory()->create();

        $data = [
            'name' => fake()->sentence,
            'dueDate' => now()->format('Y-m-d'),
            'description' => '',
        ];

        $response = $this->putJson('/api/tasks/'.$task->id, $data);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'description',
            ],
        ]);

        $this->assertNotEquals([
            'name' => $task->name,
            'description' => $task->description,
            'dueDate' => $task->due_date,
        ], $data);
    }

    public function test_it_fails_to_update_task_without_dueDate(): void
    {
        $task = Task::factory()->create();

        $data = [
            'name' => fake()->sentence,
            'dueDate' => '',
            'description' => fake()->paragraph(),
        ];

        $response = $this->putJson('/api/tasks/'.$task->id, $data);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'dueDate',
            ],
        ]);

        $this->assertNotEquals([
            'name' => $task->name,
            'description' => $task->description,
            'dueDate' => $task->due_date,
        ], $data);
    }

    public function test_it_fails_to_update_task_with_past_dueDate(): void
    {
        $task = Task::factory()->create();

        $data = [
            'name' => fake()->sentence,
            'dueDate' => now()->yesterday()->format('Y-m-d'),
            'description' => fake()->paragraph(),
        ];

        $response = $this->putJson('/api/tasks/'.$task->id, $data);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'dueDate',
            ],
        ]);

        $this->assertNotEquals([
            'name' => $task->name,
            'description' => $task->description,
            'dueDate' => $task->due_date,
        ], $data);
    }

    public function test_it_fails_to_update_task_without_valid_dueDate(): void
    {
        $task = Task::factory()->create();

        $data = [
            'name' => fake()->sentence,
            'dueDate' => now()->format('M-d-Y'),
            'description' => fake()->paragraph(),
        ];

        $response = $this->putJson('/api/tasks/'.$task->id, $data);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'dueDate',
            ],
        ]);

        $this->assertNotEquals([
            'name' => $task->name,
            'description' => $task->description,
            'dueDate' => $task->due_date,
        ], $data);
    }
}
