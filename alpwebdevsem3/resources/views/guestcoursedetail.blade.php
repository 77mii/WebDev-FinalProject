<x-layout1>
    <x-slot:title>{{ $title }}</x-slot:title>

    <!-- Top Section: Image and Course Details -->
    <div class="mb-4">
        <!-- Course Long Image -->
        <img src="{{ $course->mataKuliah->longimage ?? 'https://placehold.co/1200x400' }}" 
             alt="Course Image" 
             class="w-full h-64 object-cover rounded mb-4">
        
        <!-- Course Details -->
        <div class="space-y-2">
            <!-- Semester -->
            <h2 class="text-lg font-semibold">
                Semester {{ $course->semester }}
            </h2>
            
            <!-- Course Name and Year -->
            <h1 class="text-3xl font-bold">
                {{ $course->mataKuliah->namamk ?? 'Unknown Course' }} - {{ $course->tahun ?? 'Year' }}
            </h1>
            
            <!-- Lecturer Name -->
            <p>
                <strong>Lecturer:</strong> {{ $course->lecturer->lecturername ?? 'Unknown Lecturer' }}
                @if ($course->additional_lecturers)
                    , {{ $course->additional_lecturers }}
                @endif
            </p>

            <!-- Course Description -->
            <p class="mt-2">
                {{ $course->mataKuliah->description ?? 'No course description provided.' }}
            </p>
        </div>

                <!-- Add Admin Action Buttons -->
        @auth('admin')
            <div class="flex justify-center space-x-4 mb-8 mt-8">
                <!-- Edit Course -->
                <a href="{{ route('admin.course.edit', ['id' => $course->id]) }}" 
                class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                    Edit Course
                </a>

                <!-- Delete Course -->
                <form method="POST" action="{{ route('admin.course.destroy', ['id' => $course->id]) }}"
                    onsubmit="return confirm('Are you sure you want to delete this course? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded hover:bg-red-600">
                        Delete Course
                    </button>
                </form>
            </div>
        @endauth

    </div>

    <!-- Related Projects Section -->
    <h2 class="text-3xl font-bold mt-16 mb-6">Projects</h2>
        @auth('admin')
        <div class="mb-6">
            <a href="{{ route('admin.project.create', ['courseId' => $course->id]) }}" 
            class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">
                Add Project
            </a>
        </div>
    @endauth
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @if ($course->projects->count() > 0)
            @foreach ($course->projects as $project)
                <a href="{{ route('gueststudentprojects.show', ['id' => $project->id]) }}" 
                class="block hover:scale-105 transition-transform duration-300">
                    <!-- Project Image -->
                    <img src="{{ $project->projectimage ?? 'https://placehold.co/300x200' }}" 
                        alt="Project Image" 
                        class="w-full h-48 object-cover rounded mb-4">
                    
                    <!-- Project Details -->
                    <p class="text-sm text-gray-500">{{ $project->type }}</p>
                    <h2 class="text-lg font-bold mt-0">{{ $project->projectname }}</h2>
                </a>
            @endforeach
        @else
            <p class="text-gray-600">No projects found for this class.</p>
        @endif
    </div>

</x-layout1>


{{-- <x-layout1>
    <x-slot:title>Course Detail</x-slot:title>

    <!-- Course Long Image -->
    <div class="mb-8">
        <img src="{{ $course->mataKuliah->longimage ?? 'https://placehold.co/1200x400' }}"
             alt="Course Image" class="object-cover w-full h-64 mb-4 rounded">
    </div>

    <!-- Course Details -->
    <div class="space-y-4">
        <h1 class="text-3xl font-bold">{{ $course->mataKuliah->namamk ?? 'Unknown Course' }}</h1>
        <p class="text-lg font-semibold">Course Description</p>
        <p>{{ $course->mataKuliah->description ?? 'No Description' }}</p>
    </div>

    <!-- Lecturer Details -->
    <div class="mt-8">
        <h2 class="mb-4 text-2xl font-bold">Lecturers:</h2>
        <p>{{ $course->lecturer->lecturername ?? 'Unknown Lecturer' }}</p>
        <p>{{ $course->additional_lecturers ?? 'None' }}</p>
    </div>

    <!-- Course Information -->
    <div class="mt-8">
        <h2 class="mb-4 text-2xl font-bold">Course Information:</h2>
        <p>Semester: {{ $course->semester }}</p>
        <p>Year: {{ $course->tahun }}</p>
        <p>Status: {{ $course->lmk_status ?? 'Unknown' }}</p>
    </div>

    <!-- Related Projects -->
    <div class="mt-8">
        <h2 class="mb-4 text-2xl font-bold">Related Projects:</h2>
        @if ($course->projects->count() > 0)
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($course->projects as $project)
                    <a href="{{ route('gueststudentprojects.show', ['id' => $project->id]) }}" class="block p-4 transition-transform duration-300 border rounded-lg shadow hover:scale-105">
                        <!-- Project Image -->
                        <img alt="Image for {{ $project->projectname }}"
                             class="object-cover w-full h-48 mb-4"
                             src="{{ $project->projectimage ?? 'https://placehold.co/300x200' }}" />

                        <!-- Project Details -->
                        <h2 class="text-lg font-bold">{{ $project->projectname }}</h2>
                        <p class="text-sm text-gray-500">
                            {{ $project->type }}<br>
                            {{ $project->status }}
                        </p>
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-gray-600">No projects found.</p>
        @endif
    </div>
</x-layout1> --}}