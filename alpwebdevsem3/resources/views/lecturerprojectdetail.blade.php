<x-layout1>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container px-0 mx-auto">
        <!-- Project Banner Image -->
        <img src="{{ $project->projectimage ?? 'https://placehold.co/1200x400' }}"
             alt="{{ $project->projectname }}"
             class="w-full h-64 object-cover rounded mb-4">

        <!-- Project Details -->
        <div class="space-y-2 mb-8">
            <h1 class="text-3xl font-bold">{{ $project->projectname }}</h1>
            <p class="text-lg font-semibold">
                {{ $project->lecturerMK->mataKuliah->namamk ?? 'Unknown Course' }} -
                {{ $project->lecturerMK->tahun ?? 'Year' }}
            </p>
            <p><strong>Type:</strong> {{ $project->type }}</p>
            <p><strong>Status:</strong>
                <span class="{{ $project->status === 'Ongoing' ? 'text-green-600' : 'text-gray-500' }} font-semibold">
                    {{ $project->status }}
                </span>
            </p>
            <p><strong>Lecturer:</strong> {{ $project->lecturerMK->lecturer->lecturername ?? 'Unknown' }}</p>
            <p class="mt-4 text-gray-700">{{ $project->description }}</p>
        </div>

        <!-- Student Projects -->
        <h2 class="text-2xl font-bold mb-6">Student Projects</h2>
        @if (count($studentProjects) > 0)
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($studentProjects as $sp)
                    <a href="{{ route('lecturer.studentproject.detail', ['id' => $sp['id']]) }}"
                       class="block p-4 transition-transform duration-300 border rounded-lg shadow hover:scale-105">
                        <img src="{{ $sp['image_url'] }}"
                             alt="{{ $sp['sp_title'] }}"
                             class="object-cover w-full h-48 mb-4 rounded">
                        <h3 class="text-lg font-bold">{{ $sp['sp_title'] }}</h3>
                        <p class="text-sm text-gray-500">Group: {{ $sp['group_name'] }}</p>
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-gray-600">No student projects submitted yet.</p>
        @endif
    </div>
</x-layout1>
