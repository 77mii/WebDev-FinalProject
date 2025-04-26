<x-layout1>
    <x-slot:title>Lecturer Details</x-slot:title>

    <div class="container px-0 mx-auto">
        <!-- Lecturer Profile Picture and Details -->
        <div class="mb-8 text-center">
            <img alt="Profile Picture for {{ $lecturer->lecturername }}"
                 class="object-cover w-48 h-48 mx-auto mb-4 rounded-full"
                 src="{{ $lecturer->pfp ?? 'https://placehold.co/300x300' }}" />
            <h1 class="text-3xl font-bold">{{ $lecturer->lecturername }}</h1>
            
            <!-- Admin Actions -->
            <div class="flex justify-center space-x-4 mt-4">
                <!-- Edit Lecturer -->
                <a href="{{ route('admin.lecturer.edit', ['lecturer' => $lecturer->id]) }}" 
                class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                    Edit Lecturer
                </a>

                <!-- Delete Lecturer -->
            <form method="POST" action="{{ route('admin.lecturer.destroy', ['lecturer' => $lecturer->id]) }}" 
                onsubmit="return confirm('Are you sure you want to delete this lecturer?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded hover:bg-red-600">
                    Delete Lecturer
                </button>
            </form>
            </div>
        </div>

        <!-- Lecturer Details -->
        <div class="space-y-4">
            <p class="text-lg font-semibold">Email: {{ $lecturer->email }}</p>
            <p class="text-lg font-semibold">Employee Number: {{ $lecturer->employeenumber }}</p>
        </div>

        <!-- Courses Taught -->
        <div class="mt-8">
            <h2 class="mb-4 text-2xl font-bold">Courses Taught:</h2>
            <!-- Add Course Button -->
            @auth('admin')
            <div class="mb-6">
                <a href="{{ route('admin.course.create', ['lecturerId' => $lecturer->id]) }}" 
                class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">
                    Add Course
                </a>
            </div>
            @endauth
            @if ($lecturer->lecturerMKs->count() > 0)
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($lecturer->lecturerMKs as $lecturerMK)
                        <a href="{{ route('guestcoursedetail.show', ['id' => $lecturerMK->id]) }}" 
                           class="block p-4 transition-transform duration-300 border rounded-lg shadow hover:scale-105">
                            <img alt="Image for {{ $lecturerMK->mataKuliah->namamk ?? 'Unknown Course' }}"
                                 class="object-cover w-full h-48 mb-4"
                                 src="{{ $lecturerMK->mataKuliah->smallimage ?? 'https://placehold.co/300x200' }}" />
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
