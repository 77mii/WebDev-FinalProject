<x-layout1>
    <x-slot:title>Edit Account: {{ $student->studentname }}</x-slot:title>

    <div class="max-w-3xl mx-auto p-8 rounded shadow">
        <h2 class="text-2xl font-bold mb-6">Edit Account</h2>

        <form method="POST" action="{{ route('student.update.account') }}">
            @csrf
            @method('PUT')

            <!-- Student Name -->
            <div class="mb-4">
                <label for="studentname" class="block text-gray-700 font-semibold">Full Name</label>
                <input type="text" id="studentname" name="studentname" value="{{ old('studentname', $student->studentname) }}"
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $student->email) }}"
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- NIM -->
            <div class="mb-4">
                <label for="nim" class="block text-gray-700 font-semibold">NIM</label>
                <input type="text" id="nim" name="nim" value="{{ old('nim', $student->nim) }}"
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Profile Picture URL -->
            <div class="mb-4">
                <label for="pfp" class="block text-gray-700 font-semibold">Profile Picture URL</label>
                <input type="url" id="pfp" name="pfp" value="{{ old('pfp', $student->pfp) }}"
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-semibold">New Password</label>
                <input type="password" id="password" name="password"
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" placeholder="Leave blank to keep current password">
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700 font-semibold">Confirm New Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" placeholder="Confirm your new password">
            </div>

            <!-- Submit Button -->
            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600">
                    Save Changes
                </button>
                <a href="{{ route('student.account') }}" 
                   class="bg-gray-300 text-gray-800 px-6 py-3 rounded hover:bg-gray-400">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-layout1>
