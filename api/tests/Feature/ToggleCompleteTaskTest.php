<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ToggleCompleteTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_sets_complete_to_true_for_incomplete_task(): void
    {
        $task = Task::factory()->create(['completed' => false]);

        $response = $this->put('/api/tasks/' . $task->id . '/complete');

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'completed' => true,
        ]);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'completed' => true,
        ]);
    }

    public function test_it_sets_complete_to_false_for_complete_task(): void
    {
        $task = Task::factory()->create(['completed' => true]);

        $response = $this->put('/api/tasks/' . $task->id . '/complete');

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'completed' => false,
        ]);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'completed' => false,
        ]);
    }
}
