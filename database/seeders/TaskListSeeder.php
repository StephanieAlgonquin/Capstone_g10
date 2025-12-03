<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TaskList;
use App\Models\User;

class TaskListSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        if (!$user) return;

        TaskList::factory()->count(3)->create([
            'user_id' => $user->id,
        ]);
    }
}
