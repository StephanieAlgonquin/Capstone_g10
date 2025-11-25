<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

#[Layout('layouts.app')]
class Calendar extends Component
{
    public $currentDate;
    public $currentYear;
    public $currentMonth;
    public $days = [];
    public $monthName = '';

    public function mount()
    {
        $this->currentDate = now();
        $this->loadMonth();
    }

    public function loadMonth()
    {
        $this->currentYear = $this->currentDate->year;
        $this->currentMonth = $this->currentDate->month;
        $this->monthName = $this->currentDate->format('F Y');
        
        // Get first day of month and last day
        $firstDay = Carbon::create($this->currentYear, $this->currentMonth, 1);
        $lastDay = $firstDay->copy()->endOfMonth();
        
        // Start from Monday of the week containing the first day
        $startDate = $firstDay->copy()->startOfWeek(Carbon::MONDAY);
        // End on Sunday of the week containing the last day
        $endDate = $lastDay->copy()->endOfWeek(Carbon::SUNDAY);
        
        // Load tasks for this month
        $tasks = Task::whereHas('list', function ($query) {
            $query->where('user_id', Auth::id());
        })
        ->whereNotNull('due_date')
        ->whereBetween('due_date', [
            $startDate->copy()->startOfDay(),
            $endDate->copy()->endOfDay()
        ])
        ->with('list')
        ->get()
        ->groupBy(function($task) {
            return $task->due_date->format('Y-m-d');
        });
        
        // Build calendar days array
        $this->days = [];
        $currentDay = $startDate->copy();
        $today = now()->startOfDay();
        
        while ($currentDay <= $endDate) {
            $dateKey = $currentDay->format('Y-m-d');
            $isCurrentMonth = $currentDay->month == $this->currentMonth;
            $isToday = $currentDay->format('Y-m-d') === $today->format('Y-m-d');
            
            $dayTasks = $tasks->get($dateKey, collect());
            
            if ($isCurrentMonth) {
                $this->days[] = [
                    'day' => $currentDay->day,
                    'date' => $currentDay->copy(),
                    'isToday' => $isToday,
                    'isCurrentMonth' => true,
                    'tasks' => $dayTasks->toArray(),
                ];
            } else {
                // Empty cell for days outside current month
                $this->days[] = null;
            }
            
            $currentDay->addDay();
        }
    }

    public function previousMonth()
    {
        $this->currentDate = $this->currentDate->subMonth();
        $this->loadMonth();
    }

    public function nextMonth()
    {
        $this->currentDate = $this->currentDate->addMonth();
        $this->loadMonth();
    }

    public function goToToday()
    {
        $this->currentDate = now();
        $this->loadMonth();
    }

    public function render()
    {
        return view('livewire.calendar');
    }
}
