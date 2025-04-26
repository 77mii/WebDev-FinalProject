<x-layout1>
    <x-slot:title>Add Lecturer</x-slot:title>

    <div class="max-w-3xl mx-auto p-8 rounded shadow">
        <!-- Add Lecturer Form -->
        <form method="POST" action="{{ route('admin.lecturer.store') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label for="lecturername" class="block text-gray-700 font-semibold">Full Name</label>
                <input type="text" id="lecturername" name="lecturername" 
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold">Email</label>
                <input type="email" id="email" name="email" 
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-semibold">Password</label>
                <input type="password" id="password" name="password"
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Profile Picture -->
            <div class="mb-4">
                <label for="pfp" class="block text-gray-700 font-semibold">Profile Picture (URL)</label>
                <input type="url" id="pfp" name="pfp"
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Employee Number -->
            <div class="mb-4">
                <label for="employeenumber" class="block text-gray-700 font-semibold">Employee Number</label>
                <input type="text" id="employeenumber" name="employeenumber" 
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Submit Button -->
            <div class="flex space-x-4">
                <button type="submit" class="bg-green-500 text-white px-6 py-3 rounded hover:bg-green-600">
                    Create Lecturer
                </button>
                <a href="{{ route('admin.lecturer.log') }}" 
                   class="bg-gray-300 text-gray-800 px-6 py-3 rounded hover:bg-gray-400">Cancel</a>
            </div>
        </form>
    </div>
</x-layout1>
