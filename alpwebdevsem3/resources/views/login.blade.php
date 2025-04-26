<x-layout1>
    <x-slot:title>Admin Login</x-slot:title>

    <div class="max-w-md mx-auto p-8 rounded mt-10">
        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            {{-- <h2 class="text-2xl font-bold mb-6 text-center">Admin Login</h2> --}}

            <!-- Username -->
            <div class="mb-4">
                <label for="username" class="block text-gray-700 font-semibold">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" required
                       class="w-full px-3 py-2 border rounded">
                @error('username')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-6 relative">
                <label for="password" class="block text-gray-700 font-semibold">Password</label>
                <input type="password" id="password" name="password" required
                       class="w-full px-3 py-2 border rounded" id="password-field">
                <button type="button" id="toggle-password" class="absolute right-3 top-3 text-gray-500">
                    <i class="fa fa-eye" id="eye-icon"></i>
                </button>
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full bg-orange-500 text-white py-2 rounded hover:bg-orange-600 transition duration-200">
                    Login
                </button>
            </div>

            <!-- Register Link -->
            <div class="mt-4 text-center">
                <p class="text-sm text-gray-600">
                    Don't have an account? 
                    <a href="{{ route('admin.register') }}" class="text-orange-500 hover:text-orange-600">Register here</a>
                </p>
            </div>
        </form>
    </div>

    <script>
        // Password visibility toggle
        const togglePassword = document.querySelector('#toggle-password');
        const passwordField = document.querySelector('#password-field');
        const eyeIcon = document.querySelector('#eye-icon');

        togglePassword.addEventListener('click', function (e) {
            // Toggle the type attribute
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            // Toggle the eye icon
            eyeIcon.classList.toggle('fa-eye-slash');
        });
    </script>
</x-layout1>
