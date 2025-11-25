<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        $statuses = ['pending', 'draft', 'completed', 'upcoming'];
        $status = $this->faker->randomElement($statuses);
        
        // Set due_date based on status
        $dueDate = null;
        if ($status === 'upcoming') {
            $dueDate = $this->faker->dateTimeBetween('+1 day', '+1 month');
        } elseif ($status === 'pending') {
            $dueDate = $this->faker->optional(0.7)->dateTimeBetween('-1 week', '+2 weeks');
        } else {
            $dueDate = $this->faker->optional(0.5)->dateTimeBetween('-1 month', '+1 month');
        }

        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->optional(0.8)->sentence(8),
            'due_date' => $dueDate,
            'priority' => $this->faker->randomElement(['low', 'medium', 'high']),
            'status' => $status,
            'is_completed' => $status === 'completed' ? true : false,
            'order_position' => $this->faker->unique()->numberBetween(0, 100),
        ];
    }
}
