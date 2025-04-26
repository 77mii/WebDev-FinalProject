<x-layout1>
    <x-slot:title>{{ $title }}</x-slot:title>

    <!-- Project Image -->
    <div class="mb-8">
        <img src="{{ $studentProject->projectImages->first()->imageurl ?? 'https://placehold.co/1200x400' }}" 
             alt="Project Image" class="w-full h-64 object-cover rounded mb-4">
    </div>

    <!-- Project Details -->
    <div class="space-y-4">
        <h1 class="text-3xl font-bold">{{ $studentProject->sptitle }}</h1>
        <p class="text-lg font-semibold">Project Description</p>
        <p>{{ $studentProject->sp_description }}</p>
    </div>

    <!-- Group Members -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold mb-4">Group Members:</h2>
        <ul class="list-disc list-inside">
            @foreach ($studentProject->studentGroups->flatMap->students as $student)
                <li>{{ $student->studentname }} ({{ $student->nim }})</li>
            @endforeach
        </ul>
    </div>

    <!-- Project Images -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold mb-4">Project Images:</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($studentProject->projectImages as $image)
                <img src="{{ $image->imageurl }}" alt="Project Image" class="w-full h-48 object-cover rounded">
            @endforeach
        </div>
    </div>

        <!-- Submit and Action Buttons -->
        <div class="flex space-x-4">
            <!-- Save Changes Button -->
            <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600">
                Save Changes
            </button>

            <!-- Cancel Button -->
            <a href="{{ route('admin.student.details', $student->id) }}" 
            class="bg-gray-300 text-gray-800 px-6 py-3 rounded hover:bg-gray-400">
                Cancel
            </a>

            <!-- Delete Button -->
            <form action="{{ route('admin.student.destroy', $student->id) }}" method="POST" 
                onsubmit="return confirm('Are you sure you want to delete this student? This action cannot be undone.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-6 py-3 rounded hover:bg-red-600">
                    Delete Student
                </button>
            </form>
        </div>

</x-layout1>
