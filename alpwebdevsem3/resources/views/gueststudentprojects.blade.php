<x-layout1>
    <x-slot:title>{{ $title }}</x-slot:title>

    <!-- Header Section -->
    <div class="mb-8 -mt-8">
        <p class="text-xl font-semibold mt-2">
            Semester {{ $project->lecturerMK->semester }}
        </p>
        <p class="text-3xl font-bold mt-2">
            {{ $project->lecturerMK->mataKuliah->namamk ?? 'Class Name' }} - 
            {{ $project->lecturerMK->tahun ?? 'Year' }}
        </p>
        <p class="text-xl mt-2">
            <strong>Lecturer:</strong> {{ $project->lecturerMK->lecturer->lecturername ?? 'Unknown Lecturer' }}
            @if ($project->lecturerMK->additional_lecturers)
                , {{ $project->lecturerMK->additional_lecturers }}
            @endif
        </p>
    </div>

        <!-- Admin Actions: Edit and Delete Project -->
        @auth('admin')
            <div class="flex justify-center space-x-4 mb-8">
                <!-- Edit Project -->
                <a href="{{ route('admin.project.edit', ['id' => $project->id]) }}" 
                class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                    Edit Project
                </a>

                <!-- Delete Project -->
                <form method="POST" action="{{ route('admin.project.destroy', ['id' => $project->id]) }}" 
                    onsubmit="return confirm('Are you sure you want to delete this project? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded hover:bg-red-600">
                        Delete Project
                    </button>
                </form>
            </div>
        @endauth

    <!-- Project Description -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold mb-4">Project Description</h2>
        <p class="text-lg">{{ $project->description ?? 'No description available for this project.' }}</p>
    </div>

    <!-- Student Projects Section -->
    <h2 class="text-3xl font-bold mb-4">Student Projects</h2>

        @auth('admin')
        <!-- Add Student Project Button -->
        <div class="mb-6">
            <a href="{{ route('admin.studentproject.create', ['project_id' => $project->id]) }}" 
               class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">
                Add Student Project
            </a>
        </div>
    @endauth

        @auth('student')
        <div class="mb-6">
            <a href="{{ route('student.project.create', ['project_id' => $project->id]) }}" 
               class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">
                Add My Project
            </a>
        </div>
    @endauth

    @if ($project->studentProjects->count() > 0)
        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($project->studentProjects as $studentProject)
                <a href="{{ route('guest.studentprojectdetail.show', ['id' => $studentProject->id]) }}" 
                   class="block p-4 transition-transform duration-300 border rounded-lg shadow hover:scale-105">
                    <!-- Student Project Image -->
                    <img alt="Image for {{ $studentProject->sptitle }}"
                         class="object-cover w-full h-48 mb-4"
                         src="{{ $studentProject->projectImages->first()->imageurl ?? 'https://placehold.co/300x200' }}" />

                    <!-- Student Project Details -->
                    <h2 class="text-lg font-bold">{{ $studentProject->sptitle }}</h2>
                    <p class="text-sm text-gray-500">
                        {{ $studentProject->sp_description }}
                    </p>
                </a>
            @endforeach
        </div>
    @else
        <p class="text-gray-600">No student projects found.</p>
    @endif
</x-layout1>
