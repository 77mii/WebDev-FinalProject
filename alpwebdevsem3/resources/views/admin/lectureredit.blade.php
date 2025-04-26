<x-layout1>
    <x-slot:title>Edit Lecturer: {{ $lecturer->lecturername }}</x-slot:title>

    <div class="max-w-3xl mx-auto p-8 rounded shadow">
        <!-- Edit Form -->
        <form method="POST" action="{{ route('admin.lecturer.update', $lecturer->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Lecturer Name -->
            <div class="mb-4">
                <label for="lecturername" class="block text-gray-700 font-semibold">Full Name</label>
                <input type="text" id="lecturername" name="lecturername" value="{{ old('lecturername', $lecturer->lecturername) }}" 
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" required>
                @error('lecturername')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $lecturer->email) }}" 
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" required>
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Employee Number -->
            <div class="mb-4">
                <label for="employeenumber" class="block text-gray-700 font-semibold">Employee Number</label>
                <input type="text" id="employeenumber" name="employeenumber" value="{{ old('employeenumber', $lecturer->employeenumber) }}" 
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" required>
                @error('employeenumber')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Profile Picture (URL) -->
            <div class="mb-6">
                <label for="pfp" class="block text-gray-700 font-semibold">Profile Picture URL</label>
                <input type="url" id="pfp" name="pfp" value="{{ old('pfp', $lecturer->pfp) }}" 
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                @error('pfp')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                <!-- Current Profile Picture -->
                @if ($lecturer->pfp)
                    <div class="mt-4">
                        <p class="text-gray-500">Current Picture:</p>
                        <img src="{{ $lecturer->pfp }}" alt="Profile Picture" class="w-24 h-24 rounded border">
                    </div>
                @endif
            </div>

            <!-- Submit and Cancel Buttons -->
            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600">
                    Save Changes
                </button>
                <a href="{{ route('admin.lecturer.details', $lecturer->id) }}" 
                   class="bg-gray-300 text-gray-800 px-6 py-3 rounded hover:bg-gray-400">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-layout1>
