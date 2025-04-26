<x-layout1>
    <x-slot:title>Edit Student: {{ $student->studentname }}</x-slot:title>

    <div class="max-w-3xl mx-auto p-8 rounded shadow">
        <!-- Edit Form -->
        <form method="POST" action="{{ route('admin.student.update', $student->id) }}" class="flex flex-col space-y-6">
            @csrf
            @method('PUT')

            <!-- Student Name -->
            <div>
                <label for="studentname" class="block text-gray-700 font-semibold">Full Name</label>
                <input type="text" id="studentname" name="studentname" value="{{ old('studentname', $student->studentname) }}" 
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500"
                       required>
                @error('studentname')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-gray-700 font-semibold">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $student->email) }}" 
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500"
                       required>
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- NIM -->
            <div>
                <label for="nim" class="block text-gray-700 font-semibold">NIM</label>
                <input type="text" id="nim" name="nim" value="{{ old('nim', $student->nim) }}" 
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500"
                       required>
                @error('nim')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Profile Picture (URL) -->
            <div>
                <label for="pfp" class="block text-gray-700 font-semibold">Profile Picture URL</label>
                <input type="url" id="pfp" name="pfp" value="{{ old('pfp', $student->pfp) }}" 
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                @error('pfp')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                <!-- Current Profile Picture -->
                @if ($student->pfp)
                    <div class="mt-4">
                        <p class="text-gray-500">Current Picture:</p>
                        <img src="{{ $student->pfp }}" alt="Profile Picture" 
                             class="w-24 h-24 rounded border">
                    </div>
                @endif
            </div>

        <div class="flex justify-start">
            <!-- Save Changes -->
            <form method="POST" action="{{ route('admin.student.update', $student->id) }}">
                @csrf
                @method('PUT')
                <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600">
                    Save Changes
                </button>
            </form>

            <!-- Cancel -->
            <a href="{{ route('admin.student.details', $student->id) }}" 
            class="bg-gray-300 text-gray-800 px-6 py-3 rounded hover:bg-gray-400 ml-4">
                Cancel
            </a>

            <!-- Delete -->
            <form action="{{ route('admin.student.destroy', $student->id) }}" method="POST" 
                onsubmit="return confirm('Are you sure you want to delete this student?');" class="ml-4">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-6 py-3 rounded hover:bg-red-600">
                    Delete Student
                </button>
            </form>
        </div>
    </div>

</x-layout1>
