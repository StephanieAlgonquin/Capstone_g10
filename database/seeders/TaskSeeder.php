<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\TaskList;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $lists = TaskList::all();
        
        if ($lists->isEmpty()) {
            $this->command->warn('No lists found. Please create lists first.');
            return;
        }

        foreach ($lists as $list) {
            // Create sample tasks with different statuses
            // First create with compatible status, then update
            $sampleTasks = [
                // Pending tasks
                [
                    'title' => 'Review project proposal',
                    'description' => 'Go through the proposal document and provide feedback',
                    'due_date' => Carbon::now()->addDays(2)->setTime(14, 0),
                    'priority' => 'high',
                    'status' => 'todo', // Use old status first
                    'is_completed' => false,
                ],
                [
                    'title' => 'Update website content',
                    'description' => 'Update the about page with new information',
                    'due_date' => Carbon::now()->addDays(5)->setTime(10, 30),
                    'priority' => 'medium',
                    'status' => 'todo',
                    'is_completed' => false,
                ],
                [
                    'title' => 'Send meeting notes',
                    'description' => 'Share the meeting notes with the team',
                    'due_date' => Carbon::now()->addDays(1)->setTime(16, 0),
                    'priority' => 'low',
                    'status' => 'todo',
                    'is_completed' => false,
                ],
                
                // Draft tasks - use todo status first
                [
                    'title' => 'Plan team building event',
                    'description' => 'Brainstorm ideas for the next team event',
                    'due_date' => null,
                    'priority' => 'medium',
                    'status' => 'todo',
                    'is_completed' => false,
                ],
                [
                    'title' => 'Research new tools',
                    'description' => 'Look into productivity tools for the team',
                    'due_date' => null,
                    'priority' => 'low',
                    'status' => 'todo',
                    'is_completed' => false,
                ],
                
                // Completed tasks
                [
                    'title' => 'Complete quarterly report',
                    'description' => 'Finish and submit the Q4 quarterly report',
                    'due_date' => Carbon::now()->subDays(3)->setTime(12, 0),
                    'priority' => 'high',
                    'status' => 'done',
                    'is_completed' => true,
                ],
                [
                    'title' => 'Update software licenses',
                    'description' => 'Renew all software licenses for the team',
                    'due_date' => Carbon::now()->subDays(1)->setTime(9, 0),
                    'priority' => 'medium',
                    'status' => 'done',
                    'is_completed' => true,
                ],
                
                // Upcoming tasks
                [
                    'title' => 'Client presentation',
                    'description' => 'Prepare and deliver presentation to new client',
                    'due_date' => Carbon::now()->addDays(7)->setTime(15, 0),
                    'priority' => 'high',
                    'status' => 'todo',
                    'is_completed' => false,
                ],
                [
                    'title' => 'Team training session',
                    'description' => 'Conduct training on new project management tools',
                    'due_date' => Carbon::now()->addDays(10)->setTime(11, 0),
                    'priority' => 'medium',
                    'status' => 'todo',
                    'is_completed' => false,
                ],
                [
                    'title' => 'Annual review meeting',
                    'description' => 'Schedule and prepare for annual performance reviews',
                    'due_date' => Carbon::now()->addDays(14)->setTime(13, 30),
                    'priority' => 'high',
                    'status' => 'todo',
                    'is_completed' => false,
                ],
            ];

            $createdTasks = [];
            foreach ($sampleTasks as $index => $taskData) {
                $task = Task::create(array_merge($taskData, [
                    'list_id' => $list->id,
                    'order_position' => $index,
                ]));
                $createdTasks[] = ['task' => $task, 'index' => $index];
            }

            // Now update statuses to new values using raw SQL to bypass constraint
            // Update pending tasks (first 3)
            DB::table('tasks')
                ->whereIn('id', array_slice(array_column($createdTasks, 'task'), 0, 3))
                ->update(['status' => 'pending']);
            
            // Update draft tasks (next 2)
            DB::table('tasks')
                ->whereIn('id', array_slice(array_column($createdTasks, 'task'), 3, 2))
                ->update(['status' => 'draft']);
            
            // Completed tasks already have 'done' status, update to 'completed'
            DB::table('tasks')
                ->whereIn('id', array_slice(array_column($createdTasks, 'task'), 5, 2))
                ->update(['status' => 'completed']);
            
            // Update upcoming tasks (last 3)
            DB::table('tasks')
                ->whereIn('id', array_slice(array_column($createdTasks, 'task'), 7, 3))
                ->update(['status' => 'upcoming']);
        }

        $this->command->info('Sample tasks created successfully!');
    }
}
