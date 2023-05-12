<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_task(): void
    {
        $data = [
            'name' => fake()->sentence,
            'dueDate' => now()->format('Y-m-d'),
            'description' => fake()->paragraph(),
        ];

        $response = $this->postJson('/api/tasks', $data);

        $response->assertStatus(201);

        $response->assertJsonFragment($data);
    }

    public function test_it_fails_to_create_task_without_name(): void
    {
        $data = [
            'name' => '',
            'dueDate' => now()->format('Y-m-d'),
            'description' => fake()->paragraph(),
        ];

        $response = $this->postJson('/api/tasks', $data);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'name',
            ],
        ]);
    }

    public function test_it_fails_to_create_task_without_description(): void
    {
        $data = [
            'name' => fake()->sentence,
            'dueDate' => now()->format('Y-m-d'),
            'description' => '',
        ];

        $response = $this->postJson('/api/tasks', $data);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'description',
            ],
        ]);
    }

    public function test_it_fails_to_create_task_without_dueDate(): void
    {
        $data = [
            'name' => fake()->sentence,
            'dueDate' => '',
            'description' => fake()->paragraph(),
        ];

        $response = $this->postJson('/api/tasks', $data);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'dueDate',
            ],
        ]);
    }

    public function test_it_fails_to_create_task_with_past_dueDate(): void
    {
        $data = [
            'name' => fake()->sentence,
            'dueDate' => now()->yesterday()->format('Y-m-d'),
            'description' => fake()->paragraph(),
        ];

        $response = $this->postJson('/api/tasks', $data);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'dueDate',
            ],
        ]);
    }

    public function test_it_fails_to_create_task_without_valid_dueDate(): void
    {
        $data = [
            'name' => fake()->sentence,
            'dueDate' => now()->format('M-d-Y'),
            'description' => fake()->paragraph(),
        ];

        $response = $this->postJson('/api/tasks', $data);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'dueDate',
            ],
        ]);
    }
}
