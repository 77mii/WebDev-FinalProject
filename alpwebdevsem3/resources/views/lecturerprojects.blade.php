<x-layout1>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container px-0 mx-auto">
        <!-- Ongoing Projects -->
        <h2 class="text-2xl font-bold mb-6">Ongoing Projects</h2>
        @if (count($ongoingProjects) > 0)
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 mb-12">
                @foreach ($ongoingProjects as $project)
                    <a href="{{ route('lecturer.project.detail', ['id' => $project['id']]) }}"
                       class="block p-4 transition-transform duration-300 border rounded-lg shadow hover:scale-105">
                        <img src="{{ $project['image_url'] }}"
                             alt="{{ $project['projectname'] }}"
                             class="object-cover w-full h-48 mb-4 rounded">
                        <h3 class="text-lg font-bold">{{ $project['projectname'] }}</h3>
                        <p class="text-sm text-gray-500">
                            Type: {{ $project['type'] }}<br>
                            Course: {{ $project['coursename'] }}<br>
                            Year: {{ $project['tahun'] }}
                        </p>
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-gray-600 mb-12">No ongoing projects.</p>
        @endif

        <!-- Completed Projects -->
        <h2 class="text-2xl font-bold mb-6">Completed Projects</h2>
        @if (count($completedProjects) > 0)
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($completedProjects as $project)
                    <a href="{{ route('lecturer.project.detail', ['id' => $project['id']]) }}"
                       class="block p-4 transition-transform duration-300 border rounded-lg shadow hover:scale-105 opacity-75">
                        <img src="{{ $project['image_url'] }}"
                             alt="{{ $project['projectname'] }}"
                             class="object-cover w-full h-48 mb-4 rounded">
                        <h3 class="text-lg font-bold">{{ $project['projectname'] }}</h3>
                        <p class="text-sm text-gray-500">
                            Type: {{ $project['type'] }}<br>
                            Course: {{ $project['coursename'] }}<br>
                            Year: {{ $project['tahun'] }}
                        </p>
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-gray-600">No completed projects.</p>
        @endif
    </div>
</x-layout1>
