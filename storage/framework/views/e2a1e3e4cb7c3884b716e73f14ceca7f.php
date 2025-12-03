<?php
use Illuminate\Support\Facades\Storage;
?>
<div>
<div class="min-h-screen bg-[#1A1B23] text-white flex">
    <!-- Sidebar -->
    <aside class="hidden md:flex w-20 bg-[#252732] flex-col items-center py-6 border-r border-[#3A3B47]">
        <a href="<?php echo e(route('tasks')); ?>" class="mb-8 p-3 bg-blue-600 rounded-lg" title="Tasks">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
            </svg>
        </a>

        
        <a href="<?php echo e(route('profile')); ?>" class="mb-4 p-3 text-gray-400 hover:text-white hover:bg-[#353642] rounded-lg transition-colors" title="Settings">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
        </a>

    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Header -->
        <header class="bg-[#1A1B23] border-b border-[#3A3B47] px-6 py-4">
            <div class="flex items-center justify-between">
                <!-- Left: App Title -->
                <div class="flex flex-row gap-1">
                    <img src="<?php echo e(asset('taskmaker-logo.svg')); ?>" alt="TaskMaker Logo" class="w-10 h-10 sm:h-32 sm:w-32">

                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold text-white tracking-tight">Tasky</h1>
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
                    
                    <button wire:click="openCreateListModal" 
                            class="p-2 text-gray-400 hover:text-white hover:bg-[#252732] rounded-lg transition-colors flex flex-row items-center" title="Create List">
                            
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Create List
                        
                    </button>
                    
                    
                </div>
                
                <!-- Right: User Profile -->
                <div class="flex items-center gap-3">
                    <a href="<?php echo e(route('profile')); ?>" class="flex items-center gap-3 hover:bg-[#252732] rounded-lg px-3 py-2 transition-colors">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Auth::user()->avatar): ?>
                            <img src="<?php echo e(Storage::url(Auth::user()->avatar)); ?>" alt="Profile" class="w-10 h-10 rounded-full object-cover">
                        <?php else: ?>
                            <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold">
                                <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <span class="text-white font-medium"><?php echo e(Auth::user()->name); ?></span>
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
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
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showCreateListModal): ?>
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-[#2D2E3A] border border-[#3A3B47] rounded-lg p-6 max-w-md w-full mx-4" >
                <h3 class="text-lg font-semibold text-white mb-4">Create New List</h3>
                <form wire:submit.prevent="createList" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">List Name</label>
                        <input type="text" 
                               wire:model="newListName" 
                               placeholder="Enter list name"
                               class="w-full px-4 py-2 bg-[#353642] border border-[#3A3B47] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['newListName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-400 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <!-- Kanban Board -->
        <main class="flex-1 overflow-x-auto p-6 bg-[#1A1B23]">
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($userLists->count() > 0): ?>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6 h-full min-h-[600px]">
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $userLists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tasklist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                <div class="bg-[#2D2E3A] border rounded-lg p-4 flex flex-col border-1" style="border-color: <?php echo e($tasklist->color); ?>;">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-white"><?php echo e($tasklist->name); ?></h2>
                        <div>
                        <button wire:click="openAddForm(<?php echo e($tasklist->id); ?>)" 
                                class="p-1 text-gray-400 hover:text-white hover:bg-[#353642] rounded transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </button>
                        <button wire:click="openEditForm(<?php echo e($tasklist->id); ?>)" 
                                class="p-1 text-gray-400 hover:text-white hover:bg-[#353642] rounded transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                        </button>
                        </div>
                    </div>
                    
                    <!-- Edit List Form -->
                                        
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($showEditForm[$tasklist->id]) && $showEditForm[$tasklist->id]): ?>
                    <div class="mb-4 p-4 bg-[#353642] border border-purple-500/30 rounded-lg shadow-lg">
                        <h3 class="text-sm font-semibold text-white mb-4 flex items-center gap-2">
                            <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit List
                        </h3>
                        <form wire:submit.prevent="updateList(<?php echo e($tasklist->id); ?>)" class="space-y-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-300 mb-2">List Name</label>
                                <input type="text" 
                                    wire:model="editingName.<?php echo e($tasklist->id); ?>" 
                                    
                                    class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 transition-all text-sm">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['editingName.' . $tasklist->id];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> 
                                    <span class="text-red-400 text-xs mt-1 block"><?php echo e($message); ?></span> 
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-300 mb-2">List Color</label>
                                <div class="flex items-center gap-3">
                                    <input type="color" 
                                        wire:model="editingColor.<?php echo e($tasklist->id); ?>"
                                        class="w-14 h-10 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg cursor-pointer">
                                    <span class="text-xs text-gray-400">
                                        <?php echo e($editingColor[$tasklist->id] ?? $tasklist->color ?? '#6366F1'); ?>

                                    </span>
                                </div>
                            </div>
                            <div class="flex gap-2 pt-2">
                                <button type="submit" 
                                    wire:loading.attr="disabled"
                                    wire:target="updateList"
                                    class="flex-1 px-3 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 disabled:opacity-50 disabled:cursor-not-allowed transition-colors text-sm font-medium flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span wire:loading.remove wire:target="updateList">Save Changes</span>
                                    <span wire:loading wire:target="updateList">Saving...</span>
                                </button>
                                <button type="button" 
                                    wire:click="closeEditForm(<?php echo e($tasklist->id); ?>)"
                                    class="px-3 py-2 bg-[#3A3B47] text-white rounded-lg hover:bg-[#40414d] transition-colors text-sm font-medium">
                                    Cancel
                                </button>
                                <button type="button"
                                    wire:click="deleteList(<?php echo e($tasklist->id); ?>)"
                                    class="px-3 py-2 bg-red-600/20 text-red-400 hover:bg-red-600/30 border border-red-500/30 rounded-lg transition-colors text-sm font-medium"
                                    title="Delete this list">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    
                    <!-- Add Task Form -->
                    <?php elseif(isset($showAddForm[$tasklist->id]) && $showAddForm[$tasklist->id]): ?>
                    <div class="mb-4 p-3 bg-[#353642] border border-[#3A3B47] rounded-lg">
                        <form wire:submit.prevent="createTask(<?php echo e($tasklist->id); ?>)" class="space-y-3">
                            <?php if($userLists->count() === 0): ?>
                            <div class="p-2 bg-yellow-500/20 border border-yellow-500/50 rounded-lg text-yellow-300 text-xs mb-2">
                                No lists available. Please create a list first.
                            </div>
                            <?php else: ?>
                            <input type="hidden" wire:model="newTaskListId.<?php echo e($tasklist->id); ?>" 
                                   value="<?php echo e($tasklist->id); ?>">
                            
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <input type="text" wire:model="newTaskTitle.<?php echo e($tasklist->id); ?>" 
                                   placeholder="Task title" 
                                   class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['newTaskTitle.<?php echo e($tasklist->id); ?>'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-400 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <textarea wire:model="newTaskDescription.<?php echo e($tasklist->id); ?>" 
                                      placeholder="Description" 
                                      rows="2"
                                      class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm"></textarea>
                            <div class="grid grid-cols-2 gap-2">
                                <input type="date" wire:model="newTaskDueDate.<?php echo e($tasklist->id); ?>" 
                                       class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm">
                                <input type="time" wire:model="newTaskDueTime.<?php echo e($tasklist->id); ?>" 
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
                                        <?php if($userLists->count() === 0): ?> disabled <?php endif; ?>>
                                    Add
                                </button>
                                <button type="button" 
                                        wire:click="closeAddForm(<?php echo e($tasklist->id); ?>)"
                                        class="px-3 py-2 bg-[#3A3B47] text-white rounded-lg hover:bg-[#40414d] text-sm">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                    

                    <!-- Tasks List -->
                    <?php else: ?>
                    <div class="flex-1 space-y-3 overflow-y-auto tasks-list" data-list-id="<?php echo e($listId ?? ''); ?>">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($list): ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $this->getTasksByListId($tasklist->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($editingTaskId === $task->id): ?>
                            <!-- Edit Form -->
                            <div class="p-3 bg-[#353642] border border-[#3A3B47] rounded-lg">
                                <form wire:submit.prevent="updateTask" class="space-y-3">
                                    <input type="text" wire:model="editingTitle" 
                                           class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['editingTitle'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-400 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <textarea wire:model="editingDescription" 
                                              rows="2"
                                              class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm"></textarea>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['editingDescription'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-400 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <div class="grid grid-cols-2 gap-2">
                                        <input type="date" wire:model="editingDueDate" 
                                               class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm">
                                        <input type="time" wire:model="editingDueTime" 
                                               class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm">
                                    </div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['editingDueDate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-400 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <div class="grid grid-cols-2 gap-2">
                                        
                                        
                                        <select wire:model="editingPriority" 
                                                class="w-full px-3 py-2 bg-[#2D2E3A] border border-[#3A3B47] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm">
                                            <option value="low">Low</option>
                                            <option value="medium">Medium</option>
                                            <option value="high">High</option>
                                        </select>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['editingPriority'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-400 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
                            <?php else: ?>
                            <!-- Task Card -->
                            <div class="p-3 bg-[#353642] border border-[#3A3B47] rounded-lg hover:border-purple-500 transition-colors cursor-pointer task-item"
                                 data-id="<?php echo e($task->id); ?>"
                                 wire:click="editTask(<?php echo e($task->id); ?>)">
                                 <div class="flex flex-row justify-between pr-2">
                                <h3 class="text-white font-medium mb-1 text-sm"><?php echo e($task->title); ?></h3>
                                <button wire:click.stop="toggleTaskComplete(<?php echo e($task->id); ?>)"
                                            class="flex-shrink-0 mt-1 p-1.5 rounded-lg transition-all <?php echo e($task->is_completed ? 'bg-green-500/30 text-green-400' : 'bg-[#3A3B47] text-gray-400 hover:bg-purple-500/30 hover:text-purple-400'); ?>"
                                            title="<?php echo e($task->is_completed ? 'Mark as incomplete' : 'Mark as complete'); ?>">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($task->description): ?>
                                <p class="text-gray-400 text-xs mb-2 line-clamp-2"><?php echo e($task->description); ?></p>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($task->due_date): ?>
                                <div class="flex items-center gap-2 text-xs text-gray-400 mb-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <?php echo e($task->due_date->format('M j, Y')); ?>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($task->due_date->format('H:i') !== '00:00'): ?>
                                        <?php echo e($task->due_date->format('g:i A')); ?>

                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <div class="flex items-center justify-between">
                                    <span class="text-xs px-2 py-1 rounded-full
                                        <?php echo e($task->priority === 'high' ? 'bg-red-500/20 text-red-400' : ($task->priority === 'medium' ? 'bg-yellow-500/20 text-yellow-400' : 'bg-green-500/20 text-green-400')); ?>">
                                        <?php echo e(ucfirst($task->priority)); ?>

                                    </span>
                                    <button wire:click.stop="openDeleteModal(<?php echo e($task->id); ?>)" 
                                            class="px-2 py-1 text-red-400 hover:text-red-300 hover:bg-red-500/10 rounded transition-colors"
                                            title="Delete task">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="text-center py-16 text-gray-500 text-sm">No tasks</div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php else: ?>
                        <div class="text-center py-16 text-gray-500 text-sm">Select a list to view tasks</div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?> 
            
        </main>
    </div>

    <!-- Delete Task Confirmation Modal -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showDeleteModal): ?>
    <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50" wire:click="closeDeleteModal">
        <div class="bg-[#2D2E3A] border border-[#3A3B47] rounded-lg p-6 max-w-md w-full mx-4" >
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
                <p class="text-purple-400 font-medium">"<?php echo e($deleteTaskTitle); ?>"</p>
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
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
</div>
<?php /**PATH C:\Users\Stephanie\OneDrive\Stephanie\Desktop (1)\semester4\php\capstone\capstone\resources\views/livewire/task-manager.blade.php ENDPATH**/ ?>