<x-layout1>
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
                    <a href="{{ route('gueststudentprojects.show', ['id' => $project->id]) }}" 
                       class="block p-4 transition-transform duration-300 border rounded-lg shadow hover:scale-105">
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
</x-layout1>
