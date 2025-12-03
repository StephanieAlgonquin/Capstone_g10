<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Tasky - Login</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>

<body class="bg-[#1A1B23] text-white">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Logo/Brand -->
            <div class="text-center">
                <h1 class="text-4xl font-bold text-white">Tasky</h1>
                <p class="mt-2 text-gray-400">Sign in to your account</p>
            </div>

            <!-- Login Form -->
            <form method="POST" action="<?php echo e(route('login')); ?>" id="loginForm" class="mt-8 space-y-6 bg-[#2D2E3A] border border-[#3A3B47] p-8 rounded-lg shadow-lg" novalidate>
                <?php echo csrf_field(); ?>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                    <input id="email" name="email" type="email" required maxlength="255"
                        class="mt-1 block w-full px-3 py-2 bg-[#353642] border border-[#3A3B47] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 invalid:border-red-500 invalid:ring-red-500"
                        value="<?php echo e(old('email')); ?>" placeholder="Enter your email"
                        pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$">
                    <span id="emailError" class="text-red-400 text-sm hidden"></span>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-400 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                    <input id="password" name="password" type="password" required minlength="1" maxlength="255"
                        class="mt-1 block w-full px-3 py-2 bg-[#353642] border border-[#3A3B47] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 invalid:border-red-500 invalid:ring-red-500" 
                        placeholder="Enter your password">
                    <span id="passwordError" class="text-red-400 text-sm hidden"></span>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-400 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-[#3A3B47] rounded bg-[#353642]">
                    <label for="remember" class="ml-2 block text-sm text-gray-300">
                        Remember me
                    </label>
                </div>

                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors">
                    Sign In
                </button>

                <p class="text-center text-sm text-gray-400">
                    Don't have an account?
                    <a href="<?php echo e(route('register')); ?>" class="font-medium text-purple-400 hover:text-purple-300">
                        Register here
                    </a>
                </p>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('loginForm');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const emailError = document.getElementById('emailError');
            const passwordError = document.getElementById('passwordError');

            // Real-time email validation
            emailInput.addEventListener('input', function() {
                validateEmail();
            });

            // Real-time password validation
            passwordInput.addEventListener('input', function() {
                validatePassword();
            });

            function validateEmail() {
                const email = emailInput.value.trim();
                emailError.classList.add('hidden');
                emailInput.classList.remove('border-red-500', 'ring-red-500');

                if (!email) {
                    emailError.textContent = 'Email address is required.';
                    emailError.classList.remove('hidden');
                    emailInput.classList.add('border-red-500', 'ring-red-500');
                    return false;
                }

                if (email.length > 255) {
                    emailError.textContent = 'Email address cannot exceed 255 characters.';
                    emailError.classList.remove('hidden');
                    emailInput.classList.add('border-red-500', 'ring-red-500');
                    return false;
                }

                const emailPattern = /^[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$/i;
                if (!emailPattern.test(email)) {
                    emailError.textContent = 'Please enter a valid email address.';
                    emailError.classList.remove('hidden');
                    emailInput.classList.add('border-red-500', 'ring-red-500');
                    return false;
                }

                return true;
            }

            function validatePassword() {
                const password = passwordInput.value;
                passwordError.classList.add('hidden');
                passwordInput.classList.remove('border-red-500', 'ring-red-500');

                if (!password) {
                    passwordError.textContent = 'Password is required.';
                    passwordError.classList.remove('hidden');
                    passwordInput.classList.add('border-red-500', 'ring-red-500');
                    return false;
                }

                return true;
            }

            // Form submission validation
            form.addEventListener('submit', function(e) {
                const isEmailValid = validateEmail();
                const isPasswordValid = validatePassword();

                if (!isEmailValid || !isPasswordValid) {
                    e.preventDefault();
                    e.stopPropagation();
                }
            });
        });
    </script>
</body>

</html><?php /**PATH C:\Users\Stephanie\OneDrive\Stephanie\Desktop (1)\semester4\php\capstone\capstone\resources\views/auth/login.blade.php ENDPATH**/ ?>