<x-layout1>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container px-0 mx-auto">
        <!-- Lecturer Profile Picture -->
        <div class="mb-8 text-center">
            <img alt="Profile Picture for {{ $lecturer->lecturername }}"
                 class="object-cover w-48 h-48 mx-auto mb-4 rounded-full"
                 src="{{ $lecturer->pfp ?? 'https://placehold.co/300x300' }}" />
            <h1 class="text-3xl font-bold">{{ $lecturer->lecturername }}</h1>
        </div>

        <!-- Lecturer Details -->
        <div class="space-y-4">
            <p class="text-lg font-semibold">Email: {{ $lecturer->email }}</p>
            <p class="text-lg font-semibold">Employee Number: {{ $lecturer->employeenumber }}</p>
        </div>

        <!-- Courses Taught by Lecturer -->
        <div class="mt-8">
            <h2 class="mb-4 text-2xl font-bold">Courses Taught:</h2>
            @if ($lecturer->lecturerMKs->count() > 0)
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($lecturer->lecturerMKs as $lecturerMK)
                        <a href="{{ route('guestcoursedetail.show', ['id' => $lecturerMK->id]) }}" class="block p-4 transition-transform duration-300 border rounded-lg shadow hover:scale-105">
                            <!-- Course Image -->
                            <img alt="Image for {{ $lecturerMK->mataKuliah->namamk ?? 'Unknown Course' }}"
                                 class="object-cover w-full h-48 mb-4"
                                 src="{{ $lecturerMK->mataKuliah->smallimage ?? 'https://placehold.co/300x200' }}" />

                            <!-- Course Details -->
                            <h3 class="text-lg font-bold">{{ $lecturerMK->mataKuliah->namamk ?? 'Unknown Course' }}</h3>
                            <p class="text-sm text-gray-500">
                                Semester: {{ $lecturerMK->semester }}<br>
                                Year: {{ $lecturerMK->tahun }}
                            </p>
                        </a>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600">No courses found.</p>
            @endif
        </div>
    </div>
</x-layout1>