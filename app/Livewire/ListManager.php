<?php

namespace App\Livewire;

use App\Models\TaskList;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;

class ListManager extends Component
{
    #[Validate('required|string|max:255')]
    public $listName = '';

    #[Validate('required|string')]
    public $listColor = '#3B82F6';

    public $editingListId = null;
    public $editingName = '';
    public $editingColor = '';

    public $showDeleteModal = false;
    public $deleteListId = null;
    public $deleteListName = '';

    protected $listeners = [
        'open-edit-list-modal' => 'handleEditList',
        'open-delete-list-modal' => 'handleDeleteList',
    ];

    public function createList()
    {
        $this->validate([
            'listName' => 'required|string|max:255|min:1',
            'listColor' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
        ], [
            'listName.required' => 'List name is required.',
            'listName.string' => 'List name must be a valid string.',
            'listName.max' => 'List name cannot exceed 255 characters.',
            'listName.min' => 'List name must be at least 1 character.',
            'listColor.required' => 'List color is required.',
            'listColor.regex' => 'List color must be a valid hex color (e.g., #FF5733).',
        ]);

        TaskList::create([
            'user_id' => Auth::id(),
            'name' => trim($this->listName),
            'color' => $this->listColor,
            'order_position' => Auth::user()->lists()->count(),
        ]);

        $this->reset(['listName', 'listColor']);
        $this->dispatch('list-created');
        session()->flash('message', 'List created successfully!');
    }

    public function handleDeleteList($data)
    {
        $this->deleteListId = $data['id'] ?? null;
        $this->deleteListName = $data['name'] ?? '';
        $this->showDeleteModal = true;
    }

    public function confirmDeleteList()
    {
        if (!$this->deleteListId || !is_numeric($this->deleteListId)) {
            session()->flash('error', 'Invalid list ID.');
            $this->showDeleteModal = false;
            return;
        }

        $list = TaskList::where('id', $this->deleteListId)
            ->where('user_id', Auth::id())
            ->first();

        if (!$list) {
            session()->flash('error', 'List not found or you do not have access to it.');
            $this->showDeleteModal = false;
            return;
        }

        $list->delete();

        $this->showDeleteModal = false;
        $this->reset(['deleteListId', 'deleteListName']);
        $this->dispatch('list-deleted');
        session()->flash('message', 'List deleted successfully!');
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->reset(['deleteListId', 'deleteListName']);
    }

    public function deleteList($listId)
    {
        TaskList::where('id', $listId)
            ->where('user_id', Auth::id())
            ->delete();

        $this->dispatch('list-deleted');
        session()->flash('message', 'List deleted successfully!');
    }

    public function handleEditList($data)
    {
        $listId = $data['id'] ?? null;
        $this->editList($listId);
    }

    public function editList($listId)
    {
        $list = TaskList::where('id', $listId)
            ->where('user_id', Auth::id())
            ->first();

        if ($list) {
            $this->editingListId = $listId;
            $this->editingName = $list->name;
            $this->editingColor = $list->color;
        }
    }

    public function updateList()
    {
        // Validate list ID
        if (!$this->editingListId || !is_numeric($this->editingListId)) {
            session()->flash('error', 'Invalid list ID.');
            return;
        }

        // Verify list belongs to user
        $list = TaskList::where('id', $this->editingListId)
            ->where('user_id', Auth::id())
            ->first();

        if (!$list) {
            session()->flash('error', 'List not found or you do not have access to it.');
            return;
        }

        $this->validate([
            'editingName' => 'required|string|max:255|min:1',
            'editingColor' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
        ], [
            'editingName.required' => 'List name is required.',
            'editingName.string' => 'List name must be a valid string.',
            'editingName.max' => 'List name cannot exceed 255 characters.',
            'editingName.min' => 'List name must be at least 1 character.',
            'editingColor.required' => 'List color is required.',
            'editingColor.regex' => 'List color must be a valid hex color (e.g., #FF5733).',
        ]);

        $list->update([
            'name' => trim($this->editingName),
            'color' => $this->editingColor,
        ]);

        $this->reset(['editingListId', 'editingName', 'editingColor']);
        $this->dispatch('list-updated');
        session()->flash('message', 'List updated successfully!');
    }

    public function cancelEdit()
    {
        $this->reset(['editingListId', 'editingName', 'editingColor']);
    }

    public function render()
    {
        return view('livewire.list-manager');
    }
}
