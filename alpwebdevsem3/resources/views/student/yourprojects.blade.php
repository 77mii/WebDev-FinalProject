<x-layout1>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container px-0 mx-auto">
        @if ($studentProjects->count() > 0)
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($studentProjects as $studentProject)
                    <a href="{{ route('guest.studentprojectdetail.show', ['id' => $studentProject->id]) }}"
                       class="block p-0 transition-transform duration-300 hover:scale-105">
                        <!-- Project Image -->
                        <img alt="Image for {{ $studentProject->sptitle }}"
                             class="object-cover w-full h-48 mb-4"
                             src="{{ $studentProject->project->projectimage ?? 'https://placehold.co/300x200' }}" />

                        <!-- Project Details -->
                        <p class="text-sm text-gray-500">
                            {{ $studentProject->project->lecturerMK->mataKuliah->namamk ?? 'Unknown Course' }} -
                            {{ $studentProject->project->projectname }} -
                            {{ $studentProject->project->type }}
                            <br/>{{ $studentProject->project->tahun }}
                        </p>
                        <h2 class="text-lg font-bold">{{ $studentProject->sptitle }}</h2>
                        <p class="text-gray-700">Group: {{ $studentProject->studentGroups->first()->groupname ?? 'No Group' }}</p>
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-gray-600">No projects found.</p>
        @endif
    </div>
</x-layout1>
