<x-layout1>
    <x-slot:title>Lecturers Log</x-slot:title>

    <div class="container px-0 mx-auto">
        @if ($lecturers->count() > 0)
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($lecturers as $lecturer)
                    <a href="{{ route('admin.lecturer.details', ['lecturer' => $lecturer->id]) }}" 
                       class="block p-4 transition-transform duration-300 border rounded-lg shadow hover:scale-105">
                        <img alt="Profile Picture for {{ $lecturer->lecturername }}"
                             class="object-cover w-48 h-48 mx-auto mb-4 rounded-full"
                             src="{{ $lecturer->pfp ?? 'https://placehold.co/300x300' }}" />
                        <h2 class="text-lg font-bold text-center">{{ $lecturer->lecturername }}</h2>
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-gray-600">No lecturers found.</p>
        @endif

        <!-- Add Lecturer Button -->
    <a href="{{ route('admin.lecturer.create') }}" 
    class="bg-orange-500 text-white px-6 py-3 rounded hover:bg-orange-600 mt-8 mx-auto flex justify-center">
        Add Lecturer
    </a>
    </div>
</x-layout1>
