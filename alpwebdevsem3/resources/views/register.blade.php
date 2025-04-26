<x-layout1>
    <x-slot:title>Admin Register</x-slot:title>

    <div class="max-w-lg mx-auto mt-8 p-8 rounded ">
    {{-- <div class="flex justify-center items-center min-h-screen"> --}}
        {{-- <form method="POST" action="{{ route('admin.register.submit') }}" class="w-full max-w-md p-8 rounded"> --}}
        <form method="POST" action="{{ route('admin.register.submit') }}">
            @csrf
            <!-- Username -->
            <div class="mb-4">
                <label for="username" class="block text-gray-700 mb-2">Username:</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" required
                       class="w-full px-3 py-2 border rounded">
                @error('username')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 mb-2">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                       class="w-full px-3 py-2 border rounded">
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700 mb-2">Password:</label>
                <input type="password" id="password" name="password" required
                       class="w-full px-3 py-2 border rounded">
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700 mb-2">Confirm Password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                       class="w-full px-3 py-2 border rounded">
            </div>

            <!-- Admin Code -->
            <div class="mb-4">
                <label for="admin_code" class="block text-gray-700 mb-2">Admin Code:</label>
                <input type="text" id="admin_code" name="admin_code" required
                       class="w-full px-3 py-2 border rounded">
                @error('admin_code')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full bg-orange-500 text-white py-2 rounded hover:bg-orange-600 transition duration-200">
                    Register
                </button>
            </div>
        </form>
    </div>
</x-layout1>
