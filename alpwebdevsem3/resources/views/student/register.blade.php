<x-layout1>
    <x-slot:title>Student Register</x-slot:title>

    <div class="max-w-lg mx-auto mt-8 p-8 rounded ">
        {{-- <h2 class="text-2xl font-bold mb-6">Student Registration</h2> --}}
        <form method="POST" action="{{ route('student.register.submit') }}" enctype="multipart/form-data">
            @csrf

            <!-- Student Name -->
            <div class="mb-4">
                <label for="studentname" class="block text-gray-700 font-semibold mb-2">Name</label>
                <input type="text" id="studentname" name="studentname" 
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                <input type="email" id="email" name="email" 
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                <input type="password" id="password" name="password" 
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700 font-semibold mb-2">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" 
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- NIM -->
            <div class="mb-4">
                <label for="nim" class="block text-gray-700 font-semibold mb-2">NIM</label>
                <input type="text" id="nim" name="nim" 
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Profile Picture -->
            <div class="mb-4">
                <label for="pfp" class="block text-gray-700 font-semibold mb-2">Profile Picture URL</label>
                <input type="url" id="pfp" name="pfp" 
                    placeholder="Enter the URL of your profile picture"
                    class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Submit -->
            <div class="flex justify-between items-center">
                <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition duration-200">Register</button>
                <a href="{{ route('student.login') }}" class="text-blue-500 text-sm underline">Already have an account? Login</a>
            </div>
        </form>
    </div>
</x-layout1>
