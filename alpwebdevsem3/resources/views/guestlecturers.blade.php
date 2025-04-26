<x-layout1>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container px-0 mx-auto">
        @if ($lecturers->count() > 0)
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($lecturers as $lecturer)
                    <a href="{{ route('guestlecturerdetail.show', ['id' => $lecturer->id]) }}" class="block p-4 transition-transform duration-300 border rounded-lg shadow hover:scale-105">
                        <!-- Lecturer Profile Picture -->
                        <img alt="Profile Picture for {{ $lecturer->lecturername }}"
                             class="object-cover w-48 h-48 mx-auto mb-4 rounded-full"
                             src="{{ $lecturer->pfp ?? 'https://placehold.co/300x300' }}" />

                        <!-- Lecturer Name -->
                        <h2 class="text-lg font-bold text-center">{{ $lecturer->lecturername }}</h2>
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-gray-600">No lecturers found.</p>
        @endif
    </div>
</x-layout1>