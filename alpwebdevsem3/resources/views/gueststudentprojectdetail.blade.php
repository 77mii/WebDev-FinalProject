<x-layout1>
    <x-slot:title>{{ $title }}</x-slot:title>

    <!-- Big Project Image -->
    <div class="mb-2">
        <img src="{{ $bigImage }}" alt="Project Big Image" class="w-full h-64 object-cover rounded">
    </div>

    <!-- Project Details -->
    <div class="mb-8">
        <p class="text-lg font-bold">{{ $matakuliahName }} - {{ $tahun }} - Semester {{ $semester }}</p>
        <p class="text-lg font-bold">Lecturer: {{ $lecturerName }}</p>
        <h1 class="text-3xl font-bold mt-2">{{ $studentProject->sptitle }}</h1>
        <p class="mt-4 text-gray-700">{{ $studentProject->sp_description }}</p>
    </div>

    <!-- Group Members -->
    <h2 class="text-2xl font-bold mt-8">Group Members:</h2>
    <ul class="list-disc mt-4 ml-6 mb-8">
        @foreach ($groupMembers as $student)
            <li>{{ $student->studentname }} - {{ $student->nim }}</li>
        @endforeach
    </ul>

    <!-- Project Images -->
    <h2 class="text-2xl font-bold mt-8 mb-4">Project Images</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse ($images as $image)
            <img src="{{ $image->imageurl ?? 'https://placehold.co/300x200' }}" 
                 alt="Project Image" class="w-full h-48 object-cover rounded">
        @empty
            <p>No images uploaded for this project.</p>
        @endforelse
    </div>

    <!-- Admin Edit/Delete Buttons -->
    @if(auth()->guard('admin')->check())
        <div class="mt-8 flex space-x-4">
            <a href="{{ route('admin.studentproject.edit', $studentProject->id) }}" 
               class="bg-blue-500 text-white px-4 py-2 rounded">Edit Project</a>
            <form action="{{ route('admin.studentproject.destroy', $studentProject->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="bg-red-500 text-white px-4 py-2 rounded" 
                        onclick="return confirm('Are you sure you want to delete this project?');">
                    Delete Project
                </button>
            </form>
        </div>
    @endif

        <!-- Student Edit/Delete Buttons -->
    @auth('student')
        @if($groupMembers->contains('id', auth()->guard('student')->user()->id))
            <div class="mt-8 flex space-x-4">
                <!-- Edit Button -->
                <a href="{{ route('student.studentproject.edit', $studentProject->id) }}" 
                   class="bg-blue-500 text-white px-4 py-2 rounded">
                    Edit Project
                </a>

                <!-- Delete Button -->
                <form action="{{ route('student.studentproject.destroy', $studentProject->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="bg-red-500 text-white px-4 py-2 rounded" 
                            onclick="return confirm('Are you sure you want to delete this project?');">
                        Delete Project
                    </button>
                </form>
            </div>
        @endif
    @endauth
    
</x-layout1>
