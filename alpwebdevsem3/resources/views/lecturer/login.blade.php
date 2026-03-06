<x-layout1>
    <x-slot:title>Lecturer Login</x-slot:title>

    <div class="max-w-md mx-auto p-8 rounded mt-10">
        <form method="POST" action="{{ route('lecturer.login.submit') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-orange-500" required>
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-semibold">Password</label>
                <input type="password" id="password" name="password"
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-orange-500" required>
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <button type="submit"
                        class="w-full bg-orange-500 text-white py-2 rounded hover:bg-orange-600 transition duration-200">
                    Login
                </button>
            </div>
        </form>
    </div>
</x-layout1>
