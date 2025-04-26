<x-layout1>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container px-0 mx-auto">
        <!-- Student Profile Picture -->
        <div class="mb-8 text-center">
            <img alt="Profile Picture for {{ $student->studentname }}"
                 class="object-cover w-48 h-48 mx-auto mb-4 rounded-full"
                 src="{{ $student->pfp ?? 'https://placehold.co/300x300' }}" />
            <h1 class="text-3xl font-bold">{{ $student->studentname }}</h1>
        </div>

        <!-- Student Details -->
        <div class="space-y-4">
            <p class="text-lg font-semibold">Email: {{ $student->email }}</p>
            <p class="text-lg font-semibold">NIM: {{ $student->nim }}</p>
        </div>

        <!-- Student Projects -->
        <div class="mt-8">
            <h2 class="mb-4 text-2xl font-bold">Student Projects:</h2>
            @if ($student->studentGroups->count() > 0)
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($student->studentGroups as $studentGroup)
                        @if ($studentGroup->studentProject)
                            <a href="{{ route('guest.studentprojectdetail.show', ['id' => $studentGroup->studentProject->id]) }}" class="block p-4 transition-transform duration-300 border rounded-lg shadow hover:scale-105">
                                <!-- Student Project Image -->
                                <img alt="Image for {{ $studentGroup->studentProject->sptitle }}"
                                     class="object-cover w-full h-48 mb-4"
                                     src="{{ $studentGroup->studentProject->projectImages->first()->imageurl ?? 'https://placehold.co/300x200' }}" />

                                <!-- Student Project Details -->
                                <h2 class="text-lg font-bold">{{ $studentGroup->studentProject->sptitle }}</h2>
                                <p class="text-sm text-gray-500">
                                    {{ $studentGroup->studentProject->sp_description }}
                                </p>
                            </a>
                        @endif
                    @endforeach
                </div>
            @else
                <p class="text-gray-600">No student projects found.</p>
            @endif
        </div>
    </div>
</x-layout1>