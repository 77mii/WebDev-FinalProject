<x-layout1>
    <x-slot:title>Student Login</x-slot:title>

    <div class="max-w-md mx-auto p-8 rounded mt-10">
        {{-- <h2 class="text-2xl font-bold mb-6">Student Login</h2> --}}

        <form method="POST" action="{{ route('student.login.submit') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold">Email</label>
                <input type="email" id="email" name="email" 
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-semibold">Password</label>
                <input type="password" id="password" name="password" 
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <button type="submit" 
                        class="w-full bg-orange-500 text-white py-2 rounded hover:bg-orange-600 transition duration-200">
                    Login
                </button>
            </div>

            <div class="mt-4 text-center">
                <p class="text-sm text-gray-600">
                    Don't have an account? 
                    <a href="{{ route('student.register') }}" class="text-orange-500 hover:text-orange-600">Register here</a>
                </p>
            </div>

        </form>
    </div>
</x-layout1>
