<x-layout1>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container px-0 mx-auto">
        <!-- Main Project Image -->
        <div class="mb-4">
            <img src="{{ $mainImage }}" alt="Student Project Image" class="w-full h-64 object-cover rounded">
        </div>

        <!-- Project Details -->
        <div class="mb-8">
            <p class="text-lg font-bold">
                {{ $studentProject->project->lecturerMK->mataKuliah->namamk ?? 'Unknown Course' }} -
                {{ $studentProject->project->lecturerMK->tahun ?? 'Year' }}
            </p>
            <p class="text-lg font-bold">
                Lecturer: {{ $studentProject->project->lecturerMK->lecturer->lecturername ?? 'Unknown' }}
            </p>
            <h1 class="text-3xl font-bold mt-2">{{ $studentProject->sptitle }}</h1>
            <p class="mt-4 text-gray-700">{{ $studentProject->sp_description }}</p>
            <p class="mt-2 text-sm text-gray-500">File Type: {{ $studentProject->file_type }}</p>
        </div>

        <!-- Group Members -->
        <h2 class="text-2xl font-bold mt-8">Group Members</h2>
        @if ($studentProject->studentGroups->count() > 0)
            <ul class="list-disc mt-4 ml-6 mb-8">
                @foreach ($studentProject->studentGroups as $group)
                    <li class="font-semibold mb-2">{{ $group->groupname }}
                        <ul class="list-circle ml-4 font-normal">
                            @foreach ($group->students as $student)
                                <li>{{ $student->studentname }} - {{ $student->nim }}</li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-600 mb-8">No group members assigned.</p>
        @endif

        <!-- Project Images -->
        <h2 class="text-2xl font-bold mt-8 mb-4">Project Images</h2>
        @if ($studentProject->projectImages->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($studentProject->projectImages as $image)
                    <img src="{{ $image->imageurl ?? 'https://placehold.co/300x200' }}"
                         alt="{{ $image->description ?? 'Project Image' }}"
                         class="w-full h-48 object-cover rounded">
                @endforeach
            </div>
        @else
            <p class="text-gray-600">No images uploaded for this project.</p>
        @endif
    </div>
</x-layout1>
