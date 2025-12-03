<div>
<div class="min-h-screen bg-[#1A1B23] text-white flex">
    <!-- Sidebar -->
    <aside class="w-20 bg-[#252732] flex flex-col items-center py-6 border-r border-[#3A3B47]">
               <a href="<?php echo e(route('tasks')); ?>" class="mb-4 p-3 text-gray-400 hover:text-white hover:bg-[#353642] rounded-lg transition-colors" title="Tasks">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
            </svg>
        </a>
 
        <a href="<?php echo e(route('profile')); ?>" class="mb-4 p-3 text-white bg-[#353642] rounded-lg" title="Settings">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
        </a>

    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Header -->
        <header class="bg-[#252732] border-b border-[#3A3B47] px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex flex-row gap-1">
                    <img src="<?php echo e(asset('taskmaker-logo.svg')); ?>" alt="TaskMaker Logo" class="w-10 h-10 sm:h-32 sm:w-32">

                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold text-white tracking-tight">Tasky</h1>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-semibold overflow-hidden <?php echo e(Auth::user()->avatar ? '' : 'bg-blue-600'); ?>">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Auth::user()->avatar && Storage::exists('public/' . Auth::user()->avatar)): ?>
                                <img src="<?php echo e(Storage::url(Auth::user()->avatar)); ?>" alt="<?php echo e(Auth::user()->name); ?>" class="w-full h-full object-cover">
                            <?php else: ?>
                                <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <span class="text-white font-medium"><?php echo e(Auth::user()->name); ?></span>
                    </div>
                    <a href="<?php echo e(route('dashboard')); ?>" class="px-4 py-2 bg-[#353642] text-white rounded-lg hover:bg-[#3A3B47] transition-colors text-sm">
                        Back to Dashboard
                    </a>
                </div>
            </div>
        </header>

        <!-- Profile Content -->
        <main class="flex-1 overflow-y-auto p-6">
            <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Profile Information -->
                    <div class="bg-[#2D2E3A] border border-[#3A3B47] rounded-lg p-6">
                        <h2 class="text-xl font-semibold text-white mb-6">Profile Information</h2>
                        <form wire:submit.prevent="updateProfile" class="space-y-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">Name</label>
                                <input type="text" wire:model="name" 
                                       class="w-full px-4 py-2 bg-[#353642] border border-[#3A3B47] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500"
                                       placeholder="Enter your name">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['name'];
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
                                <label class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                                <input type="email" wire:model="email" 
                                       class="w-full px-4 py-2 bg-[#353642] border border-[#3A3B47] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500"
                                       placeholder="Enter your email">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
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
















































































                            <div class="pt-4">
                                <button type="submit" 
                                        wire:loading.attr="disabled"
                                        wire:target="updateProfile"
                                        class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 disabled:opacity-50 disabled:cursor-not-allowed transition-colors font-medium">
                                    <span wire:loading.remove wire:target="updateProfile">Update Profile</span>
                                    <span wire:loading wire:target="updateProfile" class="flex items-center gap-2">
                                        <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Saving...
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Change Password -->
                    <div class="bg-[#2D2E3A] border border-[#3A3B47] rounded-lg p-6">
                        <h2 class="text-xl font-semibold text-white mb-6">Change Password</h2>
                        <form wire:submit.prevent="updatePassword" class="space-y-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">Current Password</label>
                                <input type="password" wire:model="currentPassword" 
                                       class="w-full px-4 py-2 bg-[#353642] border border-[#3A3B47] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500"
                                       placeholder="Enter current password">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['currentPassword'];
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
                                <label class="block text-sm font-medium text-gray-300 mb-2">New Password</label>
                                <input type="password" wire:model="newPassword" 
                                       class="w-full px-4 py-2 bg-[#353642] border border-[#3A3B47] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500"
                                       placeholder="Enter new password (min. 8 characters)">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['newPassword'];
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
                                <label class="block text-sm font-medium text-gray-300 mb-2">Confirm New Password</label>
                                <input type="password" wire:model="newPasswordConfirmation" 
                                       class="w-full px-4 py-2 bg-[#353642] border border-[#3A3B47] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500"
                                       placeholder="Confirm new password">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['newPasswordConfirmation'];
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

                            <div class="pt-4">
                                <button type="submit" 
                                        wire:loading.attr="disabled"
                                        wire:target="updatePassword"
                                        class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 disabled:opacity-50 disabled:cursor-not-allowed transition-colors font-medium">
                                    <span wire:loading.remove wire:target="updatePassword">Update Password</span>
                                    <span wire:loading wire:target="updatePassword" class="flex items-center gap-2">
                                        <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Updating...
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Sidebar Stats -->
                <div class="space-y-6">
                    <!-- Account Stats -->
                    <div class="bg-[#2D2E3A] border border-[#3A3B47] rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-white mb-6">Account Stats</h3>
                        <div class="space-y-6">
                            <div class="pb-4 border-b border-[#3A3B47]">
                                <p class="text-sm text-gray-400 mb-1">Total Lists</p>
                                <p class="text-3xl font-bold text-white"><?php echo e(Auth::user()->lists()->count()); ?></p>
                            </div>
                            <div class="pb-4 border-b border-[#3A3B47]">
                                <p class="text-sm text-gray-400 mb-1">Total Tasks</p>
                                <p class="text-3xl font-bold text-white">
                                    <?php echo e(\App\Models\Task::whereHas('list', function($q) { $q->where('user_id', Auth::id()); })->count()); ?>

                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-400 mb-1">Member Since</p>
                                <p class="text-lg font-semibold text-white">
                                    <?php echo e(Auth::user()->created_at->format('M Y')); ?>

                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-[#2D2E3A] border border-[#3A3B47] rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-white mb-6">Quick Actions</h3>
                        <div class="space-y-3">
                            <a href="<?php echo e(route('dashboard')); ?>" class="block w-full px-4 py-3 text-center bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors font-medium">
                                Go to Dashboard
                            </a>
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="block w-full px-4 py-3 text-center bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
</div>
<?php /**PATH C:\Users\Stephanie\OneDrive\Stephanie\Desktop (1)\semester4\php\capstone\capstone\resources\views/livewire/profile.blade.php ENDPATH**/ ?>