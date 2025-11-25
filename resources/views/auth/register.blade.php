<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TaskFlow - Register</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#1A1B23] text-white">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Logo/Brand -->
            <div class="text-center">
                <h1 class="text-4xl font-bold text-white">TaskFlow</h1>
                <p class="mt-2 text-gray-400">Create your account</p>
            </div>

            <!-- Registration Form -->
            <form method="POST" action="{{ route('register') }}" id="registerForm" class="mt-8 space-y-6 bg-[#2D2E3A] border border-[#3A3B47] p-8 rounded-lg shadow-lg" novalidate>
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-300">Full Name</label>
                    <input id="name" name="name" type="text" required minlength="2" maxlength="255"
                        class="mt-1 block w-full px-3 py-2 bg-[#353642] border border-[#3A3B47] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 invalid:border-red-500 invalid:ring-red-500"
                        value="{{ old('name') }}" placeholder="Enter your name">
                    <span id="nameError" class="text-red-400 text-sm hidden"></span>
                    @error('name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                    <input id="email" name="email" type="email" required maxlength="255"
                        class="mt-1 block w-full px-3 py-2 bg-[#353642] border border-[#3A3B47] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 invalid:border-red-500 invalid:ring-red-500"
                        value="{{ old('email') }}" placeholder="Enter your email"
                        pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$">
                    <span id="emailError" class="text-red-400 text-sm hidden"></span>
                    @error('email') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                    <input id="password" name="password" type="password" required minlength="8" maxlength="255"
                        class="mt-1 block w-full px-3 py-2 bg-[#353642] border border-[#3A3B47] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 invalid:border-red-500 invalid:ring-red-500" 
                        placeholder="Enter your password (min. 8 characters)">
                    <span id="passwordError" class="text-red-400 text-sm hidden"></span>
                    <p class="text-xs text-gray-400 mt-1">Password must be at least 8 characters long.</p>
                    @error('password') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-300">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required minlength="8" maxlength="255"
                        class="mt-1 block w-full px-3 py-2 bg-[#353642] border border-[#3A3B47] rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 invalid:border-red-500 invalid:ring-red-500" 
                        placeholder="Confirm your password">
                    <span id="passwordConfirmationError" class="text-red-400 text-sm hidden"></span>
                </div>

                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors">
                    Sign Up
                </button>

                <p class="text-center text-sm text-gray-400">
                    Already have an account?
                    <a href="{{ route('login') }}" class="font-medium text-purple-400 hover:text-purple-300">
                        Login here
                    </a>
                </p>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('registerForm');
            const nameInput = document.getElementById('name');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const passwordConfirmationInput = document.getElementById('password_confirmation');
            const nameError = document.getElementById('nameError');
            const emailError = document.getElementById('emailError');
            const passwordError = document.getElementById('passwordError');
            const passwordConfirmationError = document.getElementById('passwordConfirmationError');

            // Real-time validation
            nameInput.addEventListener('input', validateName);
            emailInput.addEventListener('input', validateEmail);
            passwordInput.addEventListener('input', function() {
                validatePassword();
                validatePasswordConfirmation();
            });
            passwordConfirmationInput.addEventListener('input', validatePasswordConfirmation);

            function validateName() {
                const name = nameInput.value.trim();
                nameError.classList.add('hidden');
                nameInput.classList.remove('border-red-500', 'ring-red-500');

                if (!name) {
                    nameError.textContent = 'Full name is required.';
                    nameError.classList.remove('hidden');
                    nameInput.classList.add('border-red-500', 'ring-red-500');
                    return false;
                }

                if (name.length < 2) {
                    nameError.textContent = 'Full name must be at least 2 characters.';
                    nameError.classList.remove('hidden');
                    nameInput.classList.add('border-red-500', 'ring-red-500');
                    return false;
                }

                if (name.length > 255) {
                    nameError.textContent = 'Full name cannot exceed 255 characters.';
                    nameError.classList.remove('hidden');
                    nameInput.classList.add('border-red-500', 'ring-red-500');
                    return false;
                }

                return true;
            }

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

                if (password.length < 8) {
                    passwordError.textContent = 'Password must be at least 8 characters long.';
                    passwordError.classList.remove('hidden');
                    passwordInput.classList.add('border-red-500', 'ring-red-500');
                    return false;
                }

                if (password.length > 255) {
                    passwordError.textContent = 'Password cannot exceed 255 characters.';
                    passwordError.classList.remove('hidden');
                    passwordInput.classList.add('border-red-500', 'ring-red-500');
                    return false;
                }

                return true;
            }

            function validatePasswordConfirmation() {
                const password = passwordInput.value;
                const passwordConfirmation = passwordConfirmationInput.value;
                passwordConfirmationError.classList.add('hidden');
                passwordConfirmationInput.classList.remove('border-red-500', 'ring-red-500');

                if (!passwordConfirmation) {
                    passwordConfirmationError.textContent = 'Please confirm your password.';
                    passwordConfirmationError.classList.remove('hidden');
                    passwordConfirmationInput.classList.add('border-red-500', 'ring-red-500');
                    return false;
                }

                if (password !== passwordConfirmation) {
                    passwordConfirmationError.textContent = 'Password confirmation does not match.';
                    passwordConfirmationError.classList.remove('hidden');
                    passwordConfirmationInput.classList.add('border-red-500', 'ring-red-500');
                    return false;
                }

                return true;
            }

            // Form submission validation
            form.addEventListener('submit', function(e) {
                const isNameValid = validateName();
                const isEmailValid = validateEmail();
                const isPasswordValid = validatePassword();
                const isPasswordConfirmationValid = validatePasswordConfirmation();

                if (!isNameValid || !isEmailValid || !isPasswordValid || !isPasswordConfirmationValid) {
                    e.preventDefault();
                    e.stopPropagation();
                }
            });
        });
    </script>
</body>

</html>