<x-layout1>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container px-0 mx-auto">
        @if ($students->count() > 0)
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($students as $student)
                    <a href="{{ route('gueststudentdetails.show', ['id' => $student->id]) }}" class="block p-4 transition-transform duration-300 border rounded-lg shadow hover:scale-105">
                        <!-- Student Profile Picture -->
                        <img alt="Profile Picture for {{ $student->studentname }}"
                             class="object-cover w-48 h-48 mx-auto mb-4 rounded-full"
                             src="{{ $student->pfp ?? 'https://placehold.co/300x300' }}" />

                        <!-- Student Name -->
                        <h2 class="text-lg font-bold text-center">{{ $student->studentname }}</h2>
                        <p class="text-sm text-center text-gray-500">{{ $student->nim }}</p>
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-gray-600">No students found.</p>
        @endif
    </div>
</x-layout1>