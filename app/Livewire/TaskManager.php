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
    public $showEditForm = [];
    public $editingName = [];
    public $editingColor = [];
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

    public function deleteList($listId)
    {
        TaskList::where('id', $listId)
            ->where('user_id', Auth::id())
            ->delete();

        $this->dispatch('list-deleted');
        session()->flash('message', 'List deleted successfully!');
    }
    public function updateList($listId)
    {
            $this->validate([
        'editingName.' . $listId => 'required|string|max:255',
        'editingColor.' . $listId => 'nullable|string',
    ]);

    $list = TaskList::findOrFail($listId);
    $list->update([
        'name' => $this->editingName[$listId],
        'color' => $this->editingColor[$listId] ?? $list->color,
    ]);

    $this->closeEditForm($listId);

    session()->flash('message', 'List updated successfully!');

    }

    public function cancelEditList()
    {
        $this->reset(['editingName', 'editingColor']);
    }

    public function openAddForm($listId)
    {
        $status = 'todo';
        $this->showAddForm[$listId] = true;
        $this->newTaskStatus[$listId] = $status;
        $this->newTaskPriority = 'medium';
        
    }

    public function closeAddForm($listId)
    {
        $this->showAddForm[$listId] = false;
        $this->reset(['newTaskTitle', 'newTaskDescription', 'newTaskDueDate', 'newTaskDueTime', 'newTaskStatus', 'newTaskPriority', 'newTaskListId']);
    }

    public function createTask($listId)
    {
        $status = 'todo';
        // Ensure status is set (in case it was lost)
        $this->newTaskStatus[$listId] = 'todo';
        
        
        $this->validate([
            'newTaskTitle.' . $listId => 'required|string|max:255|min:1',
            'newTaskDescription.' . $listId => 'nullable|string|max:5000',
            'newTaskDueDate.' . $listId => 'nullable|date',
            'newTaskDueTime.' . $listId => ['nullable','string','regex:/^([0-1][0-9]|2[0-3]):[0-5][0-9]$/'],
            'newTaskStatus.' . $listId => 'required|in:todo,in_work,done',
            'newTaskPriority' => 'required|in:low,medium,high',
        ], [
            'newTaskTitle.' . $listId . '.required' => 'Task title is required.',
            'newTaskTitle.' . $listId . '.string' => 'Task title must be a valid string.',
            'newTaskTitle.' . $listId . '.max' => 'Task title cannot exceed 255 characters.',
            'newTaskTitle.' . $listId . '.min' => 'Task title must be at least 1 character.',
            'newTaskDescription.' . $listId . '.max' => 'Task description cannot exceed 5000 characters.',
            'newTaskDueDate.' . $listId . '.date' => 'Due date must be a valid date.',
            'newTaskDueDate.' . $listId . '.after_or_equal' => 'Due date cannot be in the past.',
            'newTaskDueTime.' . $listId . '.regex' => 'Due time must be in HH:MM format (24-hour).',
            'newTaskPriority.required' => 'Task priority is required.',
            'newTaskPriority.in' => 'Task priority must be low, medium, or high.',
        ]);

        // Verify the list belongs to the user
        $selectedList = TaskList::where('id', $listId)
            ->where('user_id', Auth::id())
            ->first();

        if (!$selectedList) {
            session()->flash('error', 'You do not have access to this list.');
            return;
        }

        $dueDateTime = null;

        if (!empty($this->newTaskDueDate[$listId])) {
            $date = $this->newTaskDueDate[$listId];
            $time = $this->newTaskDueTime[$listId] ?? '00:00';
            $dueDateTime = $date . ' ' . $time . ':00';
        }

        $selectedListId = $listId;
        $mappedStatus = $this->mapStatusToDatabase($status);
        
        Task::create([
            'list_id' => $listId,
            'title' => $this->newTaskTitle[$listId],
            'description' => $this->newTaskDescription[$listId] ?? null,
            'due_date' => $dueDateTime,
            'priority' => $this->newTaskPriority,
            'status' => $mappedStatus,
            'is_completed' => $status === 'done',
            'order_position' => $selectedList->tasks()->count(),
        ]);

        $this->closeAddForm($listId);
        
        // Reload the current list if it matches
        if ($listId == $selectedListId) {
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
    public function toggleTaskComplete($taskId)
{
    $task = Task::findOrFail($taskId);
    
    // Verify user has access to this task
    $userList = TaskList::where('id', $task->list_id)
        ->where('user_id', Auth::id())
        ->first();
    
    if (!$userList) {
        session()->flash('error', 'You do not have access to this task.');
        return;
    }
    
    // Toggle the completed status
    $task->update([
        'is_completed' => !$task->is_completed,
        'status' => !$task->is_completed ? 'done' : 'todo',
    ]);
    
    $this->dispatch('notify', message: $task->is_completed ? 'Task marked as complete!' : 'Task marked as incomplete!');
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
            'editingDueTime' => ['nullable','string','regex:/^([0-1][0-9]|2[0-3]):[0-5][0-9]$/'] ,
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

    public function openEditForm($listId){
        $list = TaskList::find($listId);
        $this->showEditForm[$listId] = true;
        $this->editingName[$listId] = $list->name;
    $this->editingColor[$listId] = $list->color;
    }
    public function closeEditForm($listId){
        $this->showEditForm[$listId] = false;
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

    public function getTasksByListId($listId)
    {
        $theList =  TaskList::where('id', $listId)
                ->where('user_id', Auth::id())
                ->with(['tasks' => function ($query) {
                    $query->where('is_archived', false)
                          ->orderBy('order_position');
                }])
                ->first();

        $tasks = $theList->tasks->filter(function($task) use ($listId) {
            
            return $task->list_id == $listId;
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
