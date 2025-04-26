<x-layout1>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container px-0 mx-auto">
        <!-- Add Course Button (Visible Only to Admins) -->
        @auth('admin')
        <div class="mb-6 -mt-6">
            <a href="{{ route('admin.course.create2') }}" 
               class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">
                Add Course
            </a>
        </div>
        @endauth

        <!-- Search Bar -->
        <form method="GET" action="{{ route('guestcourses.search') }}" class="mb-8">
            <input 
                type="text" 
                name="query" 
                placeholder="Search courses by name" 
                class="w-full px-4 py-2 border rounded" 
                value="{{ request('query') }}"
            >
            <button type="submit" class="bg-orange-500 text-white px-6 py-3 rounded hover:bg-orange-600 mt-4 w-full flex justify-center">
                Search
            </button>
        </form>

        <!-- Course Listing -->
        @if ($courses->count() > 0)
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($courses as $course)
                    <a href="{{ route('guestcoursedetail.show', ['id' => $course->id]) }}" class="block p-4 transition-transform duration-300 border rounded-lg shadow hover:scale-105">
                        <!-- Course Image -->
                        <img alt="Image for {{ $course->mataKuliah->namamk ?? 'Unknown Course' }}"
                             class="object-cover w-full h-48 mb-4"
                             src="{{ $course->mataKuliah->smallimage ?? 'https://placehold.co/300x200' }}" />

                        <!-- Course Details -->
                        <h2 class="text-lg font-bold">{{ $course->mataKuliah->namamk ?? 'Unknown Course' }}</h2>
                        <p class="text-sm text-gray-500">
                            Course ID: {{ $course->mk_id }}<br>
                            Lecturer: {{ $course->lecturer->lecturername ?? 'Unknown Lecturer' }}<br>
                            Semester: {{ $course->semester }}<br>
                            Year: {{ $course->tahun }}
                        </p>
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-gray-600">No courses found.</p>
        @endif
    </div>
</x-layout1>


{{-- <x-layout1>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container px-0 mx-auto">
        <!-- Add Course Button (Visible Only to Admins) -->
    @auth('admin')
        <div class="mb-6 -mt-6">
            <a href="{{ route('admin.course.create2') }}" 
            class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">
                Add Course
            </a>
        </div>
    @endauth


        <!-- Course Listing -->
        @if ($courses->count() > 0)
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($courses as $course)
                    <a href="{{ route('guestcoursedetail.show', ['id' => $course->id]) }}" class="block p-4 transition-transform duration-300 border rounded-lg shadow hover:scale-105">
                        <!-- Course Image -->
                        <img alt="Image for {{ $course->mataKuliah->namamk ?? 'Unknown Course' }}"
                             class="object-cover w-full h-48 mb-4"
                             src="{{ $course->mataKuliah->smallimage ?? 'https://placehold.co/300x200' }}" />

                        <!-- Course Details -->
                        <h2 class="text-lg font-bold">{{ $course->mataKuliah->namamk ?? 'Unknown Course' }}</h2>
                        <p class="text-sm text-gray-500">
                            Course ID: {{ $course->mk_id }}<br>
                            Lecturer: {{ $course->lecturer->lecturername ?? 'Unknown Lecturer' }}<br>
                            Semester: {{ $course->semester }}<br>
                            Year: {{ $course->tahun }}
                        </p>
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-gray-600">No courses found.</p>
        @endif
    </div>
</x-layout1> --}}
