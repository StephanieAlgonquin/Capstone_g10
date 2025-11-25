@php
use Illuminate\Support\Facades\Storage;
@endphp
<div>
<div class="min-h-screen bg-[#1A1B23] text-white flex">
    <!-- Sidebar -->
    <aside class="hidden md:flex w-20 bg-[#252732] flex-col items-center py-6 border-r border-[#3A3B47]">
        <a href="{{ route('dashboard') }}" class="mb-8 p-3 bg-blue-600 rounded-lg">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
            </svg>
        </a>
        <a href="{{ route('tasks') }}" class="mb-4 p-3 text-white bg-[#353642] rounded-lg" title="Tasks">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
            </svg>
        </a>
        <a href="{{ route('calendar') }}" class="mb-4 p-3 text-gray-400 hover:text-white hover:bg-[#353642] rounded-lg transition-colors" title="Calendar">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
        </a>
        <a href="#" class="mb-4 p-3 text-gray-400 hover:text-white hover:bg-[#353642] rounded-lg transition-colors" title="Files">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
            </svg>
        </a>
        <a href="#" class="mb-4 p-3 text-gray-400 hover:text-white hover:bg-[#353642] rounded-lg transition-colors" title="Gallery">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
        </a>
        <a href="#" class="mb-4 p-3 text-gray-400 hover:text-white hover:bg-[#353642] rounded-lg transition-colors" title="Clock">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </a>
        <a href="#" class="mb-4 p-3 text-gray-400 hover:text-white hover:bg-[#353642] rounded-lg transition-colors" title="Messages">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
        </a>
        <a href="#" class="mb-4 p-3 text-gray-400 hover:text-white hover:bg-[#353642] rounded-lg transition-colors" title="Security">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
        </a>
        <a href="{{ route('profile') }}" class="mb-4 p-3 text-gray-400 hover:text-white hover:bg-[#353642] rounded-lg transition-colors" title="Settings">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
        </a>
        <div class="mt-auto">
            <button class="p-3 text-gray-400 hover:text-white hover:bg-[#353642] rounded-lg transition-colors" title="Dark Mode">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                </svg>
            </button>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Header -->
        <header class="bg-[#1A1B23] border-b border-[#3A3B47] px-6 py-4">
            <div class="flex items-center justify-between">
                <!-- Left: App Title -->
                <div class="flex items-center gap-4">
                    <div class="flex items-center justify-center w-10 h-10 bg-gradient-to-br from-purple-600 to-purple-800 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-white">TaskFlow</h1>
                        <p class="text-xs text-gray-400">Task Manager</p>
                    </div>
                </div>

                <!-- Center: Search and Filter -->
                <div class="flex items-center gap-2 md:gap-4 flex-1 max-w-2xl mx-2 md:mx-8">
                    <div class="relative flex-1">
                        <svg class="w-5 h-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input type="text" 
                               wire:model.live.debounce.300ms="searchQuery"
                               placeholder="Archive tasks" 
                               class="w-full pl-10 pr-4 py-2 bg-[#252732] border border-[#3A3B47] rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>
                    <button class="p-2 text-gray-400 hover:text-white hover:bg-[#252732] rounded-lg transition-colors" title="Filter">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                    </button>
                    <button wire:click="openCreateListModal" 
                            class="p-2 text-gray-400 hover:text-white hover:bg-[#252732] rounded-lg transition-colors" title="Create List">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </button>
                    <button wire:click="openAddForm('todo')" 
                            class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors font-medium flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        New task
                    </button>
                </div>

                <!-- Right: User Profile -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('profile') }}" class="flex items-center gap-3 hover:bg-[#252732] rounded-lg px-3 py-2 transition-colors">
                        @if(Auth::user()->avatar)
                            <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="Profile" class="w-10 h-10 rounded-full object-cover">
                        @else
                            <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif
                        <span class="text-white font-medium">{{ Auth::user()->name }}</span>
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="p-2 text-gray-400 hover:text-white hover:bg-[#252732] rounded-lg transition-colors" title="Logout">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Create List Modal -->
        @if($showCreateListModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" wire:click="closeCreateListModal">
            <div class="bg-[#2D2E3A] border border-[#3A3B47] rounded-lg p-6 max-w-md w-full mx-4" wire:click.stop>
                <h3 class="text-lg font-semibold text-white mb-4">Create New List</h3>
                <form wire:submit.prevent="createList" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">List Name</label>
                        <input type="text" 
                               wire:model="newListName" 
                               placeholder="Enter list name"
                               class="w-full px-4 py-2 bg-[#353642] border border-[#3A3B47] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        @error('newListName') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Color</label>
                        <input type="color" 
                               wire:model="newListColor" 
                               class="w-full h-12 bg-[#353642] border border-[#3A3B47] rounded-lg cursor-pointer">
                    </div>
                    <div class="flex gap-3 justify-end">
                        <button type="button" 
                                wire:click="closeCreateListModal"
                                class="px-4 py-2 bg-[#353642] border border-[#3A3B47] text-white rounded-lg hover:bg-[#3A3B47] transition-colors">
                            Cancel
                        </button>
                        <button type="submit" 
                                wire:loading.attr="disabled"
                                wire:target="createList"
                                class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 disabled:opacity-50 transition-colors">
                            Create List
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endif

        <!-- Kanban Board -->
        <main class="flex-1 overflow-x-auto p-6 bg-[#1A1B23]">
            @if($userLists->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6 h-full min-h-[600px]">
                <!-- To Do Column -->
                <div class="bg-[#2D2E3A] border border-[#3A3B47] rounded-lg p-4 flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-white">To Do</h2>
                        <button wire:click="openAddForm('todo')" 
                                class="p-1 text-gray-400 hover:text-white hover:bg-[#353642] rounded transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Add Task Form -->
                    @if(isset($showAddForm['todo']) && $showAddForm['todo'])
                    <div class="mb-4 p-3 bg-[#353642] border border-[#3A3B47] rounded-lg">
                        <form wire:submit.prevent="createTask('todo')" class="space-y-3">
                            @if($userLists->count() === 0)
                            <div class="p-2 bg-yellow-500/20 border border-yellow-500/50 rounded-lg text-yellow-300 text-xs mb-2">
                                No lists available. Please create a list first.
                            </div>
                            @else
                            <select wire:model="newTaskListId.todo" 
                                    class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm">
                                <option value="">Select a list...</option>
                                @foreach($userLists as $userList)
                                <option value="{{ $userList->id }}">{{ $userList->name }}</option>
                                @endforeach
                            </select>
                            @error('newTaskListId.todo') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                            @endif
                            <input type="text" wire:model="newTaskTitle.todo" 
                                   placeholder="Task title" 
                                   class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm">
                            @error('newTaskTitle.todo') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                            <textarea wire:model="newTaskDescription.todo" 
                                      placeholder="Description" 
                                      rows="2"
                                      class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm"></textarea>
                            <div class="grid grid-cols-2 gap-2">
                                <input type="date" wire:model="newTaskDueDate.todo" 
                                       class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm">
                                <input type="time" wire:model="newTaskDueTime.todo" 
                                       class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm">
                            </div>
                            <select wire:model="newTaskPriority" 
                                    class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm">
                                <option value="low">Low Priority</option>
                                <option value="medium">Medium Priority</option>
                                <option value="high">High Priority</option>
                            </select>
                            <div class="flex gap-2">
                                <button type="submit" 
                                        wire:loading.attr="disabled"
                                        wire:target="createTask"
                                        class="flex-1 px-3 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 disabled:opacity-50 text-sm"
                                        @if($userLists->count() === 0) disabled @endif>
                                    Add
                                </button>
                                <button type="button" 
                                        wire:click="closeAddForm('todo')"
                                        class="px-3 py-2 bg-[#3A3B47] text-white rounded-lg hover:bg-[#40414d] text-sm">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                    @endif

                    <!-- Tasks List -->
                    <div class="flex-1 space-y-3 overflow-y-auto tasks-list" data-list-id="{{ $listId ?? '' }}">
                        @if($list)
                        @forelse($this->getTasksByStatus('todo') as $task)
                            @if($editingTaskId === $task->id)
                            <!-- Edit Form -->
                            <div class="p-3 bg-[#353642] border border-[#3A3B47] rounded-lg">
                                <form wire:submit.prevent="updateTask" class="space-y-3">
                                    <input type="text" wire:model="editingTitle" 
                                           class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm">
                                    @error('editingTitle') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                                    <textarea wire:model="editingDescription" 
                                              rows="2"
                                              class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm"></textarea>
                                    @error('editingDescription') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                                    <div class="grid grid-cols-2 gap-2">
                                        <input type="date" wire:model="editingDueDate" 
                                               class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm">
                                        <input type="time" wire:model="editingDueTime" 
                                               class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm">
                                    </div>
                                    @error('editingDueDate') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                                    <div class="grid grid-cols-2 gap-2">
                                        <select wire:model="editingStatus" 
                                                class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm">
                                            <option value="todo">To Do</option>
                                            <option value="in_work">In Work</option>
                                            <option value="done">Done</option>
                                        </select>
                                        @error('editingStatus') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                                        <select wire:model="editingPriority" 
                                                class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm">
                                            <option value="low">Low</option>
                                            <option value="medium">Medium</option>
                                            <option value="high">High</option>
                                        </select>
                                        @error('editingPriority') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="flex gap-2">
                                        <button type="submit" 
                                                wire:loading.attr="disabled"
                                                wire:target="updateTask"
                                                class="flex-1 px-3 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 disabled:opacity-50 text-sm">
                                            Save
                                        </button>
                                        <button type="button" 
                                                wire:click="cancelEdit"
                                                class="px-3 py-2 bg-[#3A3B47] text-white rounded-lg hover:bg-[#40414d] text-sm">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                            @else
                            <!-- Task Card -->
                            <div class="p-3 bg-[#353642] border border-[#3A3B47] rounded-lg hover:border-purple-500 transition-colors cursor-pointer task-item"
                                 data-id="{{ $task->id }}"
                                 wire:click="editTask({{ $task->id }})">
                                <h3 class="text-white font-medium mb-1 text-sm">{{ $task->title }}</h3>
                                @if($task->description)
                                <p class="text-gray-400 text-xs mb-2 line-clamp-2">{{ $task->description }}</p>
                                @endif
                                @if($task->due_date)
                                <div class="flex items-center gap-2 text-xs text-gray-400 mb-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $task->due_date->format('M j, Y') }}
                                    @if($task->due_date->format('H:i') !== '00:00')
                                        {{ $task->due_date->format('g:i A') }}
                                    @endif
                                </div>
                                @endif
                                <div class="flex items-center justify-between">
                                    <span class="text-xs px-2 py-1 rounded-full
                                        {{ $task->priority === 'high' ? 'bg-red-500/20 text-red-400' : ($task->priority === 'medium' ? 'bg-yellow-500/20 text-yellow-400' : 'bg-green-500/20 text-green-400') }}">
                                        {{ ucfirst($task->priority) }}
                                    </span>
                                    <button wire:click.stop="openDeleteModal({{ $task->id }})" 
                                            class="px-2 py-1 text-red-400 hover:text-red-300 hover:bg-red-500/10 rounded transition-colors"
                                            title="Delete task">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            @endif
                        @empty
                        <div class="text-center py-16 text-gray-500 text-sm">No tasks</div>
                        @endforelse
                        @else
                        <div class="text-center py-16 text-gray-500 text-sm">Select a list to view tasks</div>
                        @endif
                    </div>
                </div>

                <!-- In Work Column -->
                <div class="bg-[#2D2E3A] border border-[#3A3B47] rounded-lg p-4 flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-white">In Work</h2>
                        <button wire:click="openAddForm('in_work')" 
                                class="p-1 text-gray-400 hover:text-white hover:bg-[#353642] rounded transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </button>
                    </div>
                    
                    @if(isset($showAddForm['in_work']) && $showAddForm['in_work'])
                    <div class="mb-4 p-3 bg-[#353642] border border-[#3A3B47] rounded-lg">
                        <form wire:submit.prevent="createTask('in_work')" class="space-y-3">
                            @if($userLists->count() === 0)
                            <div class="p-2 bg-yellow-500/20 border border-yellow-500/50 rounded-lg text-yellow-300 text-xs mb-2">
                                No lists available. Please create a list first.
                            </div>
                            @else
                            <select wire:model="newTaskListId.in_work" 
                                    class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm">
                                <option value="">Select a list...</option>
                                @foreach($userLists as $userList)
                                <option value="{{ $userList->id }}">{{ $userList->name }}</option>
                                @endforeach
                            </select>
                            @error('newTaskListId.in_work') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                            @endif
                            <input type="text" wire:model="newTaskTitle.in_work" 
                                   placeholder="Task title" 
                                   class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm">
                            @error('newTaskTitle.in_work') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                            <textarea wire:model="newTaskDescription.in_work" 
                                      placeholder="Description" 
                                      rows="2"
                                      class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm"></textarea>
                            <div class="grid grid-cols-2 gap-2">
                                <input type="date" wire:model="newTaskDueDate.in_work" 
                                       class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm">
                                <input type="time" wire:model="newTaskDueTime.in_work" 
                                       class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm">
                            </div>
                            <select wire:model="newTaskPriority" 
                                    class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm">
                                <option value="low">Low Priority</option>
                                <option value="medium">Medium Priority</option>
                                <option value="high">High Priority</option>
                            </select>
                            <div class="flex gap-2">
                                <button type="submit" 
                                        wire:loading.attr="disabled"
                                        wire:target="createTask"
                                        class="flex-1 px-3 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 disabled:opacity-50 text-sm"
                                        @if($userLists->count() === 0) disabled @endif>
                                    Add
                                </button>
                                <button type="button" 
                                        wire:click="closeAddForm('in_work')"
                                        class="px-3 py-2 bg-[#3A3B47] text-white rounded-lg hover:bg-[#40414d] text-sm">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                    @endif

                    <div class="flex-1 space-y-3 overflow-y-auto tasks-list" data-list-id="{{ $listId ?? '' }}">
                        @if($list)
                        @forelse($this->getTasksByStatus('in_work') as $task)
                            @if($editingTaskId === $task->id)
                            <div class="p-3 bg-[#353642] border border-[#3A3B47] rounded-lg">
                                <form wire:submit.prevent="updateTask" class="space-y-3">
                                    <input type="text" wire:model="editingTitle" 
                                           class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm">
                                    @error('editingTitle') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                                    <textarea wire:model="editingDescription" 
                                              rows="2"
                                              class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm"></textarea>
                                    @error('editingDescription') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                                    <div class="grid grid-cols-2 gap-2">
                                        <input type="date" wire:model="editingDueDate" 
                                               class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm">
                                        <input type="time" wire:model="editingDueTime" 
                                               class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm">
                                    </div>
                                    @error('editingDueDate') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                                    <div class="grid grid-cols-2 gap-2">
                                        <select wire:model="editingStatus" 
                                                class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm">
                                            <option value="todo">To Do</option>
                                            <option value="in_work">In Work</option>
                                            <option value="done">Done</option>
                                        </select>
                                        @error('editingStatus') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                                        <select wire:model="editingPriority" 
                                                class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm">
                                            <option value="low">Low</option>
                                            <option value="medium">Medium</option>
                                            <option value="high">High</option>
                                        </select>
                                        @error('editingPriority') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="flex gap-2">
                                        <button type="submit" 
                                                wire:loading.attr="disabled"
                                                wire:target="updateTask"
                                                class="flex-1 px-3 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 disabled:opacity-50 text-sm">
                                            Save
                                        </button>
                                        <button type="button" 
                                                wire:click="cancelEdit"
                                                class="px-3 py-2 bg-[#3A3B47] text-white rounded-lg hover:bg-[#40414d] text-sm">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                            @else
                            <div class="p-3 bg-[#353642] border border-[#3A3B47] rounded-lg hover:border-purple-500 transition-colors cursor-pointer task-item"
                                 data-id="{{ $task->id }}"
                                 wire:click="editTask({{ $task->id }})">
                                <h3 class="text-white font-medium mb-1 text-sm">{{ $task->title }}</h3>
                                @if($task->description)
                                <p class="text-gray-400 text-xs mb-2 line-clamp-2">{{ $task->description }}</p>
                                @endif
                                @if($task->due_date)
                                <div class="flex items-center gap-2 text-xs text-gray-400 mb-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $task->due_date->format('M j, Y') }}
                                    @if($task->due_date->format('H:i') !== '00:00')
                                        {{ $task->due_date->format('g:i A') }}
                                    @endif
                                </div>
                                @endif
                                <div class="flex items-center justify-between">
                                    <span class="text-xs px-2 py-1 rounded-full
                                        {{ $task->priority === 'high' ? 'bg-red-500/20 text-red-400' : ($task->priority === 'medium' ? 'bg-yellow-500/20 text-yellow-400' : 'bg-green-500/20 text-green-400') }}">
                                        {{ ucfirst($task->priority) }}
                                    </span>
                                    <button wire:click.stop="openDeleteModal({{ $task->id }})" 
                                            class="px-2 py-1 text-red-400 hover:text-red-300 hover:bg-red-500/10 rounded transition-colors"
                                            title="Delete task">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            @endif
                        @empty
                        <div class="text-center py-16 text-gray-500 text-sm">No tasks</div>
                        @endforelse
                        @else
                        <div class="text-center py-16 text-gray-500 text-sm">Select a list to view tasks</div>
                        @endif
                    </div>
                </div>

                <!-- Done Column -->
                <div class="bg-[#2D2E3A] border border-[#3A3B47] rounded-lg p-4 flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-white">Done</h2>
                        <button wire:click="openAddForm('done')" 
                                class="p-1 text-gray-400 hover:text-white hover:bg-[#353642] rounded transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </button>
                    </div>
                    
                    @if(isset($showAddForm['done']) && $showAddForm['done'])
                    <div class="mb-4 p-3 bg-[#353642] border border-[#3A3B47] rounded-lg">
                        <form wire:submit.prevent="createTask('done')" class="space-y-3">
                            @if($userLists->count() === 0)
                            <div class="p-2 bg-yellow-500/20 border border-yellow-500/50 rounded-lg text-yellow-300 text-xs mb-2">
                                No lists available. Please create a list first.
                            </div>
                            @else
                            <select wire:model="newTaskListId.done" 
                                    class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm">
                                <option value="">Select a list...</option>
                                @foreach($userLists as $userList)
                                <option value="{{ $userList->id }}">{{ $userList->name }}</option>
                                @endforeach
                            </select>
                            @error('newTaskListId.done') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                            @endif
                            <input type="text" wire:model="newTaskTitle.done" 
                                   placeholder="Task title" 
                                   class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm">
                            @error('newTaskTitle.done') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                            <textarea wire:model="newTaskDescription.done" 
                                      placeholder="Description" 
                                      rows="2"
                                      class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm"></textarea>
                            <div class="grid grid-cols-2 gap-2">
                                <input type="date" wire:model="newTaskDueDate.done" 
                                       class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm">
                                <input type="time" wire:model="newTaskDueTime.done" 
                                       class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm">
                            </div>
                            <select wire:model="newTaskPriority" 
                                    class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm">
                                <option value="low">Low Priority</option>
                                <option value="medium">Medium Priority</option>
                                <option value="high">High Priority</option>
                            </select>
                            <div class="flex gap-2">
                                <button type="submit" 
                                        wire:loading.attr="disabled"
                                        wire:target="createTask"
                                        class="flex-1 px-3 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 disabled:opacity-50 text-sm"
                                        @if($userLists->count() === 0) disabled @endif>
                                    Add
                                </button>
                                <button type="button" 
                                        wire:click="closeAddForm('done')"
                                        class="px-3 py-2 bg-[#3A3B47] text-white rounded-lg hover:bg-[#40414d] text-sm">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                    @endif

                    <div class="flex-1 space-y-3 overflow-y-auto tasks-list" data-list-id="{{ $listId ?? '' }}">
                        @if($list)
                        @forelse($this->getTasksByStatus('done') as $task)
                            @if($editingTaskId === $task->id)
                            <div class="p-3 bg-[#353642] border border-[#3A3B47] rounded-lg">
                                <form wire:submit.prevent="updateTask" class="space-y-3">
                                    <input type="text" wire:model="editingTitle" 
                                           class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm">
                                    @error('editingTitle') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                                    <textarea wire:model="editingDescription" 
                                              rows="2"
                                              class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm"></textarea>
                                    @error('editingDescription') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                                    <div class="grid grid-cols-2 gap-2">
                                        <input type="date" wire:model="editingDueDate" 
                                               class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm">
                                        <input type="time" wire:model="editingDueTime" 
                                               class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm">
                                    </div>
                                    @error('editingDueDate') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                                    <div class="grid grid-cols-2 gap-2">
                                        <select wire:model="editingStatus" 
                                                class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm">
                                            <option value="todo">To Do</option>
                                            <option value="in_work">In Work</option>
                                            <option value="done">Done</option>
                                        </select>
                                        @error('editingStatus') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                                        <select wire:model="editingPriority" 
                                                class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm">
                                            <option value="low">Low</option>
                                            <option value="medium">Medium</option>
                                            <option value="high">High</option>
                                        </select>
                                        @error('editingPriority') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="flex gap-2">
                                        <button type="submit" 
                                                wire:loading.attr="disabled"
                                                wire:target="updateTask"
                                                class="flex-1 px-3 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 disabled:opacity-50 text-sm">
                                            Save
                                        </button>
                                        <button type="button" 
                                                wire:click="cancelEdit"
                                                class="px-3 py-2 bg-[#3A3B47] text-white rounded-lg hover:bg-[#40414d] text-sm">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                            @else
                            <div class="p-3 bg-[#353642] border border-[#3A3B47] rounded-lg hover:border-purple-500 transition-colors cursor-pointer opacity-75 task-item"
                                 data-id="{{ $task->id }}"
                                 wire:click="editTask({{ $task->id }})">
                                <h3 class="text-white font-medium mb-1 text-sm line-through">{{ $task->title }}</h3>
                                @if($task->description)
                                <p class="text-gray-400 text-xs mb-2 line-clamp-2">{{ $task->description }}</p>
                                @endif
                                @if($task->due_date)
                                <div class="flex items-center gap-2 text-xs text-gray-400 mb-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $task->due_date->format('M j, Y') }}
                                    @if($task->due_date->format('H:i') !== '00:00')
                                        {{ $task->due_date->format('g:i A') }}
                                    @endif
                                </div>
                                @endif
                                <div class="flex items-center justify-between">
                                    <span class="text-xs px-2 py-1 rounded-full
                                        {{ $task->priority === 'high' ? 'bg-red-500/20 text-red-400' : ($task->priority === 'medium' ? 'bg-yellow-500/20 text-yellow-400' : 'bg-green-500/20 text-green-400') }}">
                                        {{ ucfirst($task->priority) }}
                                    </span>
                                    <button wire:click.stop="openDeleteModal({{ $task->id }})" 
                                            class="px-2 py-1 text-red-400 hover:text-red-300 hover:bg-red-500/10 rounded transition-colors"
                                            title="Delete task">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            @endif
                        @empty
                        <div class="text-center py-16 text-gray-500 text-sm">No tasks</div>
                        @endforelse
                        @else
                        <div class="text-center py-16 text-gray-500 text-sm">Select a list to view tasks</div>
                        @endif
                    </div>
                </div>
            </div>
            @else
            <div class="text-center py-16 text-gray-400">
                <div class="max-w-md mx-auto">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="text-lg font-semibold text-white mb-2">No Lists Found</h3>
                    <p class="text-gray-400 mb-4">Create your first list to start managing tasks</p>
                    <button wire:click="openCreateListModal" 
                            class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors font-medium">
                        Create Your First List
                    </button>
                </div>
            </div>
            @endif
        </main>
    </div>

    <!-- Delete Task Confirmation Modal -->
    @if($showDeleteModal)
    <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50" wire:click="closeDeleteModal">
        <div class="bg-[#2D2E3A] border border-[#3A3B47] rounded-lg p-6 max-w-md w-full mx-4" wire:click.stop>
            <div class="flex items-center gap-4 mb-4">
                <div class="flex-shrink-0 w-12 h-12 bg-red-500/20 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-white">Delete Task</h3>
                    <p class="text-sm text-gray-400">This action cannot be undone.</p>
                </div>
            </div>
            <div class="mb-6">
                <p class="text-white mb-2">Are you sure you want to delete this task?</p>
                <p class="text-purple-400 font-medium">"{{ $deleteTaskTitle }}"</p>
            </div>
            <div class="flex gap-3">
                <button wire:click="closeDeleteModal" 
                        class="flex-1 px-4 py-2 bg-[#3A3B47] text-white rounded-lg hover:bg-[#40414d] transition-colors font-medium">
                    Cancel
                </button>
                <button wire:click="confirmDeleteTask" 
                        class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium">
                    Delete Task
                </button>
            </div>
        </div>
    </div>
    @endif
</div>
</div>
