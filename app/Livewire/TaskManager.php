<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\TaskList;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;

#[Layout('layouts.app')]
class TaskManager extends Component
{
    public $listId;
    public $list;

    // Create List Form
    public $showCreateListModal = false;
    public $newListName = '';
    public $newListColor = '#9333ea';

    // Add Task Form Fields
    public $showAddForm = [];
    public $newTaskTitle = [];
    public $newTaskDescription = [];
    public $newTaskDueDate = [];
    public $newTaskDueTime = [];
    public $newTaskStatus = [];
    public $newTaskPriority = 'medium';
    public $newTaskListId = []; // Store selected list for each status

    // Edit Task Fields
    public $editingTaskId = null;
    public $editingTitle = '';
    public $editingDescription = '';
    public $editingDueDate = '';
    public $editingDueTime = '';
    public $editingStatus = '';
    public $editingPriority = 'medium';

    public $showDeleteModal = false;
    public $deleteTaskId = null;
    public $deleteTaskTitle = '';

    public $searchQuery = '';

    protected $listeners = [
        'reorderTasks' => 'reorderTasks',
        'reorderLists' => 'reorderLists',
    ];

    public function mount($listId = null)
    {
        if ($listId) {
            $this->listId = $listId;
            $this->loadList();
            
            if (!$this->list) {
                session()->flash('error', 'List not found or you do not have access to it.');
                return $this->redirectRoute('dashboard', navigate: true);
            }
        } else {
            // If no list ID, get the first list or create a default one
            $firstList = TaskList::where('user_id', Auth::id())->first();
            if ($firstList) {
                $this->listId = $firstList->id;
                $this->loadList();
            }
        }
    }

    public function loadList()
    {
        if ($this->listId) {
            $this->list = TaskList::where('id', $this->listId)
                ->where('user_id', Auth::id())
                ->with(['tasks' => function ($query) {
                    $query->where('is_archived', false)
                          ->orderBy('order_position');
                }])
                ->first();
        }
    }

    public function openCreateListModal()
    {
        $this->showCreateListModal = true;
        $this->newListName = '';
        $this->newListColor = '#9333ea';
    }

    public function closeCreateListModal()
    {
        $this->showCreateListModal = false;
        $this->reset(['newListName', 'newListColor']);
    }

    public function createList()
    {
        $this->validate([
            'newListName' => 'required|string|max:255|min:1',
            'newListColor' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
        ], [
            'newListName.required' => 'List name is required.',
            'newListName.string' => 'List name must be a valid string.',
            'newListName.max' => 'List name cannot exceed 255 characters.',
            'newListName.min' => 'List name must be at least 1 character.',
            'newListColor.required' => 'List color is required.',
            'newListColor.regex' => 'List color must be a valid hex color (e.g., #FF5733).',
        ]);

        $list = TaskList::create([
            'user_id' => Auth::id(),
            'name' => trim($this->newListName),
            'color' => $this->newListColor,
            'order_position' => TaskList::where('user_id', Auth::id())->count(),
        ]);

        $this->closeCreateListModal();
        
        // If no list was selected, use the newly created one
        if (!$this->listId) {
            $this->listId = $list->id;
            $this->loadList();
        }
        
        session()->flash('message', 'List created successfully!');
    }

    public function openAddForm($status)
    {
        $this->showAddForm[$status] = true;
        $this->newTaskStatus[$status] = $status;
        $this->newTaskPriority = 'medium';
        // Set default list ID if available
        if ($this->listId) {
            $this->newTaskListId[$status] = $this->listId;
        } else {
            $firstList = TaskList::where('user_id', Auth::id())->first();
            if ($firstList) {
                $this->newTaskListId[$status] = $firstList->id;
            }
        }
    }

    public function closeAddForm($status)
    {
        $this->showAddForm[$status] = false;
        $this->reset(['newTaskTitle', 'newTaskDescription', 'newTaskDueDate', 'newTaskDueTime', 'newTaskStatus', 'newTaskPriority', 'newTaskListId']);
    }

    public function createTask($status)
    {
        // Ensure status is set (in case it was lost)
        $this->newTaskStatus[$status] = $status;
        
        // Validate status parameter
        if (!in_array($status, ['todo', 'in_work', 'done'])) {
            session()->flash('error', 'Invalid task status.');
            return;
        }
        
        $this->validate([
            'newTaskTitle.' . $status => 'required|string|max:255|min:1',
            'newTaskDescription.' . $status => 'nullable|string|max:5000',
            'newTaskDueDate.' . $status => 'nullable|date',
            'newTaskDueTime.' . $status => 'nullable|string|regex:/^([0-1][0-9]|2[0-3]):[0-5][0-9]$/',
            'newTaskStatus.' . $status => 'required|in:todo,in_work,done',
            'newTaskListId.' . $status => 'required|exists:lists,id',
            'newTaskPriority' => 'required|in:low,medium,high',
        ], [
            'newTaskTitle.' . $status . '.required' => 'Task title is required.',
            'newTaskTitle.' . $status . '.string' => 'Task title must be a valid string.',
            'newTaskTitle.' . $status . '.max' => 'Task title cannot exceed 255 characters.',
            'newTaskTitle.' . $status . '.min' => 'Task title must be at least 1 character.',
            'newTaskDescription.' . $status . '.max' => 'Task description cannot exceed 5000 characters.',
            'newTaskDueDate.' . $status . '.date' => 'Due date must be a valid date.',
            'newTaskDueDate.' . $status . '.after_or_equal' => 'Due date cannot be in the past.',
            'newTaskDueTime.' . $status . '.regex' => 'Due time must be in HH:MM format (24-hour).',
            'newTaskListId.' . $status . '.required' => 'Please select a list.',
            'newTaskListId.' . $status . '.exists' => 'Selected list does not exist.',
            'newTaskPriority.required' => 'Task priority is required.',
            'newTaskPriority.in' => 'Task priority must be low, medium, or high.',
        ]);

        // Verify the list belongs to the user
        $selectedList = TaskList::where('id', $this->newTaskListId[$status])
            ->where('user_id', Auth::id())
            ->first();

        if (!$selectedList) {
            session()->flash('error', 'You do not have access to this list.');
            return;
        }

        $dueDateTime = null;
        if (!empty($this->newTaskDueDate[$status])) {
            $date = $this->newTaskDueDate[$status];
            $time = $this->newTaskDueTime[$status] ?? '00:00';
            $dueDateTime = $date . ' ' . $time . ':00';
        }

        $selectedListId = $this->newTaskListId[$status];
        $mappedStatus = $this->mapStatusToDatabase($status);
        
        Task::create([
            'list_id' => $selectedListId,
            'title' => $this->newTaskTitle[$status],
            'description' => $this->newTaskDescription[$status] ?? null,
            'due_date' => $dueDateTime,
            'priority' => $this->newTaskPriority,
            'status' => $mappedStatus,
            'is_completed' => $status === 'done',
            'order_position' => $selectedList->tasks()->count(),
        ]);

        $this->closeAddForm($status);
        
        // Reload the current list if it matches
        if ($this->listId == $selectedListId) {
            $this->loadList();
        }
        
        session()->flash('message', 'Task created successfully!');
    }

    private function mapStatusToDatabase($status)
    {
        $mapping = [
            'todo' => 'todo',
            'in_work' => 'in_progress',
            'done' => 'done',
        ];
        return $mapping[$status] ?? 'todo';
    }

    public function editTask($taskId)
    {
        $task = Task::whereHas('list', function ($query) {
            $query->where('user_id', Auth::id());
        })->find($taskId);

        if ($task) {
            $this->editingTaskId = $taskId;
            $this->editingTitle = $task->title;
            $this->editingDescription = $task->description ?? '';
            $this->editingDueDate = $task->due_date?->format('Y-m-d') ?? '';
            $this->editingDueTime = $task->due_date?->format('H:i') ?? '';
            $this->editingStatus = $this->mapDatabaseStatusToKanban($task->status ?? 'todo');
            $this->editingPriority = $task->priority;
        }
    }

    private function mapDatabaseStatusToKanban($status)
    {
        $mapping = [
            'todo' => 'todo',
            'pending' => 'todo',
            'in_progress' => 'in_work',
            'in_work' => 'in_work',
            'done' => 'done',
            'completed' => 'done',
        ];
        return $mapping[$status] ?? 'todo';
    }

    public function updateTask()
    {
        // Validate task ID exists and belongs to user
        if (!$this->editingTaskId) {
            session()->flash('error', 'Task ID is required.');
            return;
        }

        $task = Task::whereHas('list', function ($query) {
            $query->where('user_id', Auth::id());
        })->find($this->editingTaskId);

        if (!$task) {
            session()->flash('error', 'Task not found or you do not have access to it.');
            return;
        }

        $this->validate([
            'editingTitle' => 'required|string|max:255|min:1',
            'editingDescription' => 'nullable|string|max:5000',
            'editingDueDate' => 'nullable|date',
            'editingDueTime' => 'nullable|string|regex:/^([0-1][0-9]|2[0-3]):[0-5][0-9]$/',
            'editingStatus' => 'required|in:todo,in_work,done',
            'editingPriority' => 'required|in:low,medium,high',
        ], [
            'editingTitle.required' => 'Task title is required.',
            'editingTitle.string' => 'Task title must be a valid string.',
            'editingTitle.max' => 'Task title cannot exceed 255 characters.',
            'editingTitle.min' => 'Task title must be at least 1 character.',
            'editingDescription.max' => 'Task description cannot exceed 5000 characters.',
            'editingDueDate.date' => 'Due date must be a valid date.',
            'editingDueTime.regex' => 'Due time must be in HH:MM format (24-hour).',
            'editingStatus.required' => 'Task status is required.',
            'editingStatus.in' => 'Task status must be todo, in_work, or done.',
            'editingPriority.required' => 'Task priority is required.',
            'editingPriority.in' => 'Task priority must be low, medium, or high.',
        ]);

        $dueDateTime = null;
        if (!empty($this->editingDueDate)) {
            $time = $this->editingDueTime ?? '00:00';
            $dueDateTime = $this->editingDueDate . ' ' . $time . ':00';
        }

        Task::whereHas('list', function ($query) {
            $query->where('user_id', Auth::id());
        })->where('id', $this->editingTaskId)->update([
            'title' => $this->editingTitle,
            'description' => $this->editingDescription,
            'due_date' => $dueDateTime,
            'priority' => $this->editingPriority,
            'status' => $this->mapStatusToDatabase($this->editingStatus),
            'is_completed' => $this->editingStatus === 'done',
        ]);

        $this->cancelEdit();
        $this->loadList();
        session()->flash('message', 'Task updated successfully!');
    }

    public function cancelEdit()
    {
        $this->reset(['editingTaskId', 'editingTitle', 'editingDescription', 'editingDueDate', 'editingDueTime', 'editingStatus', 'editingPriority']);
    }

    public function openDeleteModal($taskId)
    {
        $task = Task::whereHas('list', function ($query) {
            $query->where('user_id', Auth::id());
        })->find($taskId);

        if ($task) {
            $this->deleteTaskId = $taskId;
            $this->deleteTaskTitle = $task->title;
            $this->showDeleteModal = true;
        }
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->reset(['deleteTaskId', 'deleteTaskTitle']);
    }

    public function confirmDeleteTask()
    {
        if ($this->deleteTaskId) {
            $this->deleteTask($this->deleteTaskId);
            $this->closeDeleteModal();
        }
    }

    public function deleteTask($taskId)
    {
        // Validate task ID
        if (!$taskId || !is_numeric($taskId)) {
            session()->flash('error', 'Invalid task ID.');
            return;
        }

        $task = Task::whereHas('list', function ($query) {
            $query->where('user_id', Auth::id());
        })->find($taskId);

        if (!$task) {
            session()->flash('error', 'Task not found or you do not have access to it.');
            return;
        }

        $task->delete();
        $this->loadList();
        session()->flash('message', 'Task deleted successfully!');
    }

    public function getTasksByStatus($status)
    {
        if (!$this->list) {
            return collect();
        }

        $tasks = $this->list->tasks->filter(function($task) use ($status) {
            $taskStatus = $task->status ?? 'todo';
            
            if ($status === 'todo') {
                return ($taskStatus === 'todo' || $taskStatus === 'pending') && !$task->is_completed;
            } elseif ($status === 'in_work') {
                return ($taskStatus === 'in_work' || $taskStatus === 'in_progress') && !$task->is_completed;
            } elseif ($status === 'done') {
                return $task->is_completed || $taskStatus === 'done' || $taskStatus === 'completed';
            }
            
            return false;
        });

        // Apply search filter
        if ($this->searchQuery) {
            $tasks = $tasks->filter(function($task) {
                return stripos($task->title, $this->searchQuery) !== false 
                    || ($task->description && stripos($task->description, $this->searchQuery) !== false);
            });
        }

        return $tasks->sortBy('order_position');
    }

    public function getUserLists()
    {
        return TaskList::where('user_id', Auth::id())
            ->orderBy('order_position')
            ->get();
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

        $this->loadList();
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

        // Reload if current list was reordered
        if (in_array($this->listId, $orderedIds)) {
            $this->loadList();
        }
    }

    public function render()
    {
        return view('livewire.task-manager', [
            'list' => $this->list,
            'userLists' => $this->getUserLists(),
        ]);
    }
}
