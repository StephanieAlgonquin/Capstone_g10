<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Tasky - Welcome</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-[#1A1B23] text-white">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <nav class="bg-[#252732] border-b border-[#3A3B47] sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16 text-center">
                    <div class="flex flex-row gap-1">
                        <img src="<?php echo e(asset('taskmaker-logo.svg')); ?>" alt="TaskMaker Logo" class="w-10 h-10 sm:h-32 sm:w-32">

                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold text-white tracking-tight">Tasky</h1>
                    </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="<?php echo e(route('login')); ?>" 
                           class="px-4 py-2 text-gray-300 hover:text-white font-medium transition-colors duration-200">
                            Sign In
                        </a>
                        <a href="<?php echo e(route('register')); ?>" 
                           class="px-5 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-all duration-200 font-medium shadow-md hover:shadow-lg transform hover:scale-105">
                            Sign Up
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <main class="flex-1 flex items-center justify-center px-4 sm:px-6 lg:px-8 py-12 lg:py-20">
            <div class="max-w-5xl mx-auto text-center">
                <!-- Main Heading -->
                <div class="mb-8 animate-fade-in">
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold text-white mb-4 leading-tight tracking-tight">
                        Welcome to 
                        <span class="text-purple-400 relative inline-block">
                            Tasky
                            <span class="absolute -bottom-2 left-0 right-0 h-3 bg-purple-400/20 rounded-full"></span>
                        </span>
                    </h1>
                </div>
                
                <!-- Tagline -->
                <p class="text-xl sm:text-2xl lg:text-3xl text-gray-300 mb-6 max-w-3xl mx-auto font-medium leading-relaxed">
                    Organize your tasks, boost your productivity, and achieve your goals
                </p>

                <!-- Description -->
                <p class="text-lg sm:text-xl text-gray-400 mb-12 max-w-3xl mx-auto leading-relaxed font-light">
                    Tasky helps you stay organized with intuitive task lists, priority management, and seamless collaboration. 
                    Create custom lists, set priorities, track deadlines, and never miss an important task again.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-20">
                    <a href="<?php echo e(route('register')); ?>" 
                       class="group w-full sm:w-auto px-10 py-4 bg-purple-600 text-white text-lg font-semibold rounded-xl hover:bg-purple-700 transition-all duration-300 transform hover:scale-105 hover:shadow-2xl shadow-lg flex items-center justify-center gap-2">
                        <span>Get Started</span>
                        <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                    <a href="<?php echo e(route('login')); ?>" 
                       class="w-full sm:w-auto px-10 py-4 bg-[#2D2E3A] text-white text-lg font-semibold rounded-xl border-2 border-[#3A3B47] hover:bg-[#353642] transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-105">
                        Sign In
                    </a>
                </div>

                <!-- Features Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-20">
                    <!-- Feature 1 -->
                    <div class="bg-[#2D2E3A] border border-[#3A3B47] rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 group">
                        <div class="w-16 h-16 bg-purple-600 rounded-xl flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-3">Organize Tasks</h3>
                        <p class="text-gray-400 leading-relaxed">
                            Create custom lists and organize your tasks by project, priority, or category with ease.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-[#2D2E3A] border border-[#3A3B47] rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 group">
                        <div class="w-16 h-16 bg-purple-600 rounded-xl flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-3">Set Priorities</h3>
                        <p class="text-gray-400 leading-relaxed">
                            Mark tasks as high, medium, or low priority to focus on what matters most to you.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-[#2D2E3A] border border-[#3A3B47] rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 group">
                        <div class="w-16 h-16 bg-purple-600 rounded-xl flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-3">Track Deadlines</h3>
                        <p class="text-gray-400 leading-relaxed">
                            Set due dates and never miss an important deadline with visual reminders and alerts.
                        </p>
                    </div>
                </div>

                <!-- Additional CTA Section -->
                <div class="mt-20 bg-gradient-to-r from-purple-600 to-blue-600 rounded-3xl p-12 shadow-2xl">
                    <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">
                        Ready to boost your productivity?
                    </h2>
                    <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto">
                        Join thousands of users who are already organizing their tasks with Tasky.
                    </p>
                    <a href="<?php echo e(route('register')); ?>" 
                       class="inline-block px-10 py-4 bg-white text-purple-600 text-lg font-bold rounded-xl hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-xl">
                        Start Free Today
                    </a>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-[#252732] border-t border-[#3A3B47] py-8 mt-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col sm:flex-row justify-between items-center">
                    <p class="text-gray-400 mb-4 sm:mb-0">© <?php echo e(date('Y')); ?> Tasky. Built with Laravel & Livewire.</p>
                    <div class="flex gap-6">
                        <a href="<?php echo e(route('login')); ?>" class="text-gray-400 hover:text-white transition-colors">Sign In</a>
                        <a href="<?php echo e(route('register')); ?>" class="text-gray-400 hover:text-white transition-colors">Sign Up</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in {
            animation: fade-in 0.8s ease-out;
        }
    </style>
</body>
</html>
<?php /**PATH C:\Users\Stephanie\OneDrive\Stephanie\Desktop (1)\semester4\php\capstone\capstone\resources\views/welcome.blade.php ENDPATH**/ ?>