<?php

namespace Database\Factories;

use App\Models\TaskList;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskListFactory extends Factory
{
    protected $model = TaskList::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'color' => $this->faker->hexColor(),
            'order_position' => $this->faker->unique()->numberBetween(0, 100),
        ];
    }
}
