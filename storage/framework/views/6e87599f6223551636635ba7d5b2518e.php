<div class="bg-[#2D2E3A] rounded-lg p-4 border border-[#3A3B47] hover:border-[#4A4B57] transition-all cursor-move group"
     draggable="true"
     x-data="{ dragging: false }"
     @dragstart="dragging = true; $event.dataTransfer.setData('taskId', '<?php echo e($task->id); ?>')"
     @dragend="dragging = false"
     :class="{ 'opacity-50': dragging }"
     onclick="window.location.href='<?php echo e(route('tasks', $task->list_id)); ?>'">
    
    <!-- Task Title -->
    <h3 class="text-white font-semibold mb-3 group-hover:text-purple-400 transition-colors">
        <?php echo e($task->title); ?>

    </h3>

    <!-- Due Date -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($task->due_date): ?>
    <p class="text-gray-400 text-sm mb-3">
        <?php echo e($task->due_date->format('F j, Y')); ?>.
    </p>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Progress Bar -->
    <?php
        $progress = $task->progress ?? ($task->is_completed ? 100 : 0);
        $progressColor = match(true) {
            $progress >= 75 => 'bg-gradient-to-r from-purple-500 to-blue-500',
            $progress >= 50 => 'bg-pink-500',
            $progress >= 25 => 'bg-yellow-500',
            default => 'bg-blue-500',
        };
    ?>
    <div class="mb-3">
        <div class="flex justify-between items-center mb-1">
            <span class="text-xs text-gray-400"><?php echo e($progress); ?>%</span>
        </div>
        <div class="w-full bg-[#353642] rounded-full h-2">
            <div class="<?php echo e($progressColor); ?> h-2 rounded-full transition-all" style="width: <?php echo e($progress); ?>%"></div>
        </div>
    </div>

    <!-- Assigned Users -->
    <div class="flex items-center gap-2">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($task->assignedUsers->isNotEmpty()): ?>
            <div class="flex -space-x-2">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $task->assignedUsers->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-white text-xs font-medium border-2 border-[#2D2E3A]" 
                     title="<?php echo e($user->name); ?>">
                    <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($task->assignedUsers->count() > 3): ?>
                <div class="w-8 h-8 rounded-full bg-[#353642] flex items-center justify-center text-gray-400 text-xs border-2 border-[#2D2E3A]">
                    +<?php echo e($task->assignedUsers->count() - 3); ?>

                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        <?php else: ?>
            <button class="w-8 h-8 rounded-full bg-[#353642] flex items-center justify-center text-gray-400 hover:bg-[#3A3B47] border-2 border-dashed border-[#3A3B47] transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
            </button>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>

<?php /**PATH C:\Users\sarat\Herd\Capstone_g10\resources\views/livewire/partials/task-card.blade.php ENDPATH**/ ?>