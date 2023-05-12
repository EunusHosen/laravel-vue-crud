<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_deletes_task(): void
    {
        $task = Task::factory()->create();

        $response = $this->deleteJson('/api/tasks/' . $task->id);

        $response->assertStatus(204);

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }
}
