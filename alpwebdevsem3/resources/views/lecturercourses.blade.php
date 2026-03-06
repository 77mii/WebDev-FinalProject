<x-layout1>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container px-0 mx-auto">
        <!-- Ongoing Courses -->
        <h2 class="text-2xl font-bold mb-6">Ongoing Courses</h2>
        @if (count($ongoingCourses) > 0)
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 mb-12">
                @foreach ($ongoingCourses as $course)
                    <a href="{{ route('lecturer.course.detail', ['id' => $course['id']]) }}"
                       class="block p-4 transition-transform duration-300 border rounded-lg shadow hover:scale-105">
                        <img src="{{ $course['image_url'] }}"
                             alt="{{ $course['class_name'] }}"
                             class="object-cover w-full h-48 mb-4 rounded">
                        <h3 class="text-lg font-bold">{{ $course['class_name'] }}</h3>
                        <p class="text-sm text-gray-500">
                            Program: {{ $course['program_name'] }}<br>
                            Year: {{ $course['year'] }}
                        </p>
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-gray-600 mb-12">No ongoing courses.</p>
        @endif

        <!-- Completed Courses -->
        <h2 class="text-2xl font-bold mb-6">Completed Courses</h2>
        @if (count($completedCourses) > 0)
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($completedCourses as $course)
                    <a href="{{ route('lecturer.course.detail', ['id' => $course['id']]) }}"
                       class="block p-4 transition-transform duration-300 border rounded-lg shadow hover:scale-105 opacity-75">
                        <img src="{{ $course['image_url'] }}"
                             alt="{{ $course['class_name'] }}"
                             class="object-cover w-full h-48 mb-4 rounded">
                        <h3 class="text-lg font-bold">{{ $course['class_name'] }}</h3>
                        <p class="text-sm text-gray-500">
                            Program: {{ $course['program_name'] }}<br>
                            Year: {{ $course['year'] }}
                        </p>
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-gray-600">No completed courses.</p>
        @endif
    </div>
</x-layout1>
