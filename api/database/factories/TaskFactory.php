<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dueDate = $this->faker->dateTimeBetween('-1 month', '+1 month')->format('Y-m-d');

        return [
            'due_date' => $dueDate,
            'name' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'completed_at' => $this->faker->boolean() ? $this->faker->dateTimeInInterval($dueDate) : null,
        ];
    }

    public function completed(): static
    {
        return $this->state(function(array $attributes) {
            return [
                'completed_at' => Carbon::createFromFormat('Y-m-d', $attributes['due_date'])->addDays(random_int(2, 15)),
            ];
        });
    }

    public function incomplete(): static
    {
        return $this->state(fn(array $attributes) => [
            'completed_at' => null,
        ]);
    }
}
