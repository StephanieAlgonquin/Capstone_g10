<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\TaskList;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
class Dashboard extends Component
{
    /**
     * The authenticated user's lists.
     *
     * @var \Illuminate\Database\Eloquent\Collection
     */
    public $lists;

    public $searchQuery = '';
    public $filterPriority = '';
    public $filterStatus = '';

    public function mount()
    {
        $this->loadLists();
    }

    public function loadLists()
    {
        $query = TaskList::where('user_id', Auth::id())
            ->orderBy('order_position');
        
        // Apply search filter - show lists if name matches OR if any task matches
        if ($this->searchQuery) {
            $searchTerm = '%' . $this->searchQuery . '%';
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm)
                  ->orWhereHas('tasks', function($taskQuery) use ($searchTerm) {
                      $taskQuery->where(function($searchQ) use ($searchTerm) {
                          $searchQ->where('title', 'like', $searchTerm)
                                  ->orWhere('description', 'like', $searchTerm);
                      });
                  });
            });
        }
        
        $query->with(['tasks' => function ($q) {
            $q->orderBy('order_position');
            
            // Apply search filter to tasks
            if ($this->searchQuery) {
                $searchTerm = '%' . $this->searchQuery . '%';
                $q->where(function($searchQ) use ($searchTerm) {
                    $searchQ->where('title', 'like', $searchTerm)
                            ->orWhere('description', 'like', $searchTerm);
                });
            }
            
            // Apply priority filter
            if ($this->filterPriority) {
                $q->where('priority', $this->filterPriority);
            }
            
            // Apply status filter
            if ($this->filterStatus === 'completed') {
                $q->where('is_completed', true);
            } elseif ($this->filterStatus === 'pending') {
                $q->where('is_completed', false);
            } elseif ($this->filterStatus === 'overdue') {
                $q->where('is_completed', false)
                  ->where('due_date', '<', now());
            }
        }]);
        
        $this->lists = $query->get();
    }

    public function updatedSearchQuery()
    {
        $this->loadLists();
    }

    public function updatedFilterPriority()
    {
        $this->loadLists();
    }

    public function updatedFilterStatus()
    {
        $this->loadLists();
    }

    public function clearFilters()
    {
        $this->searchQuery = '';
        $this->filterPriority = '';
        $this->filterStatus = '';
        $this->loadLists();
    }

    public $showQuickTaskModal = false;
    public $quickTaskTitle = '';
    public $quickTaskListId = null;
    public $quickTaskPriority = 'medium';

    protected $listeners = [
        'list-created' => 'loadLists',
        'list-updated' => 'loadLists',
        'list-deleted' => 'loadLists',
        'reorderLists' => 'reorderLists',
        'reorderTasks' => 'reorderTasks',
        'toggle-task' => 'handleToggleTask',
    ];

    public function handleToggleTask($data)
    {
        $taskId = $data['id'] ?? null;
        if (!$taskId) {
            return;
        }

        $task = \App\Models\Task::whereHas('list', function ($query) {
            $query->where('user_id', Auth::id());
        })->find($taskId);

        if ($task) {
            $task->update(['is_completed' => !$task->is_completed]);
            $this->loadLists();
        }
    }

    public function reorderLists($data)
    {
        $orderedIds = $data['orderedIds'] ?? $data ?? [];
        
        // Validate input
        if (!is_array($orderedIds) || empty($orderedIds)) {
            return;
        }

        foreach ($orderedIds as $position => $id) {
            if (!is_numeric($id) || !is_numeric($position)) {
                continue;
            }
            
            TaskList::where('id', $id)
                ->where('user_id', Auth::id())
                ->update(['order_position' => (int)$position]);
        }

        $this->loadLists();
    }

    public function reorderTasks($payload)
    {
        $listId = $payload['listId'] ?? null;
        $orderedIds = $payload['orderedIds'] ?? [];

        // Validate inputs
        if (!is_numeric($listId) || !is_array($orderedIds) || empty($orderedIds)) {
            return;
        }

        $list = TaskList::where('id', $listId)
            ->where('user_id', Auth::id())
            ->first();

        if (!$list) {
            session()->flash('error', 'List not found or you do not have access to it.');
            return;
        }

        foreach ($orderedIds as $position => $taskId) {
            if (!is_numeric($taskId) || !is_numeric($position)) {
                continue;
            }
            
            $list->tasks()->where('id', $taskId)->update(['order_position' => (int)$position]);
        }

        $this->loadLists();
    }

    public function openQuickTaskModal()
    {
        $this->loadLists(); // Refresh lists before opening
        if ($this->lists->isNotEmpty()) {
            $this->quickTaskListId = $this->lists->first()->id;
        } else {
            $this->quickTaskListId = null;
        }
        $this->showQuickTaskModal = true;
    }

    public function createQuickTask()
    {
        $this->validate([
            'quickTaskTitle' => 'required|string|max:255|min:1',
            'quickTaskListId' => 'required|exists:lists,id',
            'quickTaskPriority' => 'required|in:low,medium,high',
        ], [
            'quickTaskTitle.required' => 'Task title is required.',
            'quickTaskTitle.string' => 'Task title must be a valid string.',
            'quickTaskTitle.max' => 'Task title cannot exceed 255 characters.',
            'quickTaskTitle.min' => 'Task title must be at least 1 character.',
            'quickTaskListId.required' => 'Please select a list.',
            'quickTaskListId.exists' => 'Selected list does not exist.',
            'quickTaskPriority.required' => 'Task priority is required.',
            'quickTaskPriority.in' => 'Task priority must be low, medium, or high.',
        ]);

        $list = TaskList::where('id', $this->quickTaskListId)
            ->where('user_id', Auth::id())
            ->first();

        if (!$list) {
            session()->flash('error', 'You do not have access to this list.');
            return;
        }

        \App\Models\Task::create([
            'list_id' => $this->quickTaskListId,
            'title' => trim($this->quickTaskTitle),
            'priority' => $this->quickTaskPriority,
            'order_position' => $list->tasks()->count(),
        ]);

        $this->reset(['quickTaskTitle', 'quickTaskListId', 'quickTaskPriority', 'showQuickTaskModal']);
        $this->loadLists();
        session()->flash('message', 'Task created successfully!');
    }

    public function closeQuickTaskModal()
    {
        $this->reset(['quickTaskTitle', 'quickTaskListId', 'quickTaskPriority', 'showQuickTaskModal']);
    }

    public function handleTaskMove($taskId, $newStatus)
    {
        // Validate inputs
        if (!$taskId || !is_numeric($taskId)) {
            session()->flash('error', 'Invalid task ID.');
            return;
        }

        if (!in_array($newStatus, ['todo', 'in_progress', 'done', 'pending', 'completed'])) {
            session()->flash('error', 'Invalid task status.');
            return;
        }

        $task = Task::whereHas('list', function ($query) {
            $query->where('user_id', Auth::id());
        })->find($taskId);

        if (!$task) {
            session()->flash('error', 'Task not found or you do not have access to it.');
            return;
        }

        $task->update([
            'status' => $newStatus,
            'is_completed' => in_array($newStatus, ['done', 'completed']),
        ]);
        $this->loadLists();
        session()->flash('message', 'Task moved successfully!');
    }

    public function openTaskModal($taskId = null)
    {
        // This will be handled by a separate TaskManager component
        // For now, redirect to task detail page
        if ($taskId) {
            $task = Task::whereHas('list', function ($query) {
                $query->where('user_id', Auth::id());
            })->find($taskId);
            
            if ($task) {
                return redirect()->route('tasks', $task->list_id);
            }
        }
    }

    public function getTasksByStatus($status)
    {
        $allTasks = Task::whereHas('list', function ($query) {
            $query->where('user_id', Auth::id());
        })
        ->with(['assignedUsers', 'list'])
        ->where('status', $status)
        ->orderBy('order_position')
        ->get();

        return $allTasks;
    }

    public function getStatsProperty()
    {
        $allTasks = Task::whereHas('list', function ($query) {
            $query->where('user_id', Auth::id());
        })->get();

        return [
            'total' => $allTasks->count(),
            'completed' => $allTasks->where('is_completed', true)->count(),
            'pending' => $allTasks->where('is_completed', false)->count(),
            'overdue' => $allTasks->where('is_completed', false)
                ->filter(function($task) {
                    return $task->due_date && $task->due_date->isPast();
                })->count(),
            'high_priority' => $allTasks->where('priority', 'high')
                ->where('is_completed', false)->count(),
        ];
    }

    public function render()
    {
        return view('livewire.dashboard', [
            'lists' => $this->lists,
            'stats' => $this->stats,
        ]);
    }
}
