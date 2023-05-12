<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ToggleCompleteTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_sets_completed_at_for_incomplete_task(): void
    {
        $task = Task::factory()->incomplete()->create();

        $response = $this->put('/api/tasks/' . $task->id . '/complete');

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'completed' => true,
        ]);

        $this->assertNotNull($task->fresh()->completed_at);
    }

    public function test_it_sets_completed_at_to_null_for_complete_task(): void
    {
        $task = Task::factory()->completed()->create();

        $response = $this->put('/api/tasks/' . $task->id . '/complete');

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'completed' => false,
        ]);

        $this->assertNull($task->fresh()->completed_at);
    }
}
