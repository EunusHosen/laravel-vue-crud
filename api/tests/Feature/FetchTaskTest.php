<?php

namespace Tests\Feature;

use App\Models\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FetchTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_15_tasks_per_page_with_pagination(): void
    {
        Task::factory(20)->create();

        $response = $this->get('/api/tasks');

        $response->assertStatus(200);

        $response->assertJsonCount(15, 'data');

        $response->assertJsonStructure($this->paginationJsonStructure());
    }

    public function test_it_returns_15_tasks_per_page_with_pagination_with_a_page_number()
    {
        Task::factory(40)->create();

        $response = $this->get('/api/tasks');

        $response->assertStatus(200);
        $response->assertJsonCount(15, 'data');
        $response->assertJsonStructure($this->paginationJsonStructure());
    }

    public function test_it_returns_no_tasks_with_a_page_number_that_doesnt_exist(): void
    {
        Task::factory(20)->create();

        $response = $this->getJson('/api/tasks?page=3');

        $response->assertStatus(200);
        $response->assertJsonCount(0, 'data');
        $response->assertJsonStructure($this->paginationJsonStructure());
    }

    public function test_it_fails_with_a_page_number_that_is_less_than_1(): void
    {
        Task::factory(20)->create();

        $response = $this->getJson('/api/tasks?page=0');

        $response->assertStatus(422);
    }

    public function test_it_fails_with_a_page_number_that_is_not_an_integer(): void
    {
        Task::factory(20)->create();

        $response = $this->getJson('/api/tasks?page=abc');

        $response->assertStatus(422);
    }

    public function test_it_returns_specific_task_by_id()
    {
        $task = Task::factory()->create();

        $response = $this->get('/api/tasks/' . $task->id);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'dueDate',
                'overdue',
                'completed',
                'description',
                'created_at',
            ],
        ]);
    }

    public function test_it_returns_404_for_invalid_task_id()
    {
        $response = $this->get('/api/tasks/1');

        $response->assertStatus(404);
    }

    private function paginationJsonStructure(): array
    {
        return [
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'dueDate',
                    'overdue',
                    'completed',
                    'description',
                    'created_at',
                ],
            ],
        ];
    }
}
