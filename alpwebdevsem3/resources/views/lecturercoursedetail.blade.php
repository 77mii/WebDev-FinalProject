<x-layout1>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container px-0 mx-auto">
        <!-- Course Banner Image -->
        <img src="{{ $lecturerMK->lmk_image ?? 'https://placehold.co/1200x400' }}"
             alt="Course Image"
             class="w-full h-64 object-cover rounded mb-4">

        <!-- Course Details -->
        <div class="space-y-2 mb-8">
            <h1 class="text-3xl font-bold">
                {{ $lecturerMK->mataKuliah->namamk ?? 'Unknown Course' }} - {{ $lecturerMK->tahun ?? 'Year' }}
            </h1>
            <p><strong>Program:</strong> {{ $lecturerMK->mataKuliah->namaprodi ?? 'Unknown Program' }}</p>
            <p><strong>Lecturer:</strong> {{ $lecturerMK->lecturer->lecturername ?? 'Unknown Lecturer' }}</p>
            <p><strong>Status:</strong>
                <span class="{{ $isOngoing ? 'text-green-600' : 'text-gray-500' }} font-semibold">
                    {{ $lecturerMK->lmk_status }}
                </span>
            </p>
        </div>

        <!-- Enrolled Students -->
        <h2 class="text-2xl font-bold mb-4">Enrolled Students</h2>
        @if (count($students) > 0)
            <div class="bg-white rounded-lg shadow p-4 mb-8">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2 px-4">#</th>
                            <th class="py-2 px-4">Name</th>
                            <th class="py-2 px-4">NIM</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $index => $student)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-2 px-4">{{ $index + 1 }}</td>
                                <td class="py-2 px-4">{{ $student['name'] }}</td>
                                <td class="py-2 px-4">{{ $student['nim'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-600 mb-8">No students enrolled in this course.</p>
        @endif

        <!-- Projects -->
        <h2 class="text-2xl font-bold mb-6">Projects</h2>
        @if (count($projects) > 0)
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($projects as $project)
                    <a href="{{ route('lecturer.project.detail', ['id' => $project['id']]) }}"
                       class="block p-4 transition-transform duration-300 border rounded-lg shadow hover:scale-105">
                        <img src="{{ $project['image_url'] }}"
                             alt="{{ $project['project_name'] }}"
                             class="object-cover w-full h-48 mb-4 rounded">
                        <h3 class="text-lg font-bold">{{ $project['project_name'] }}</h3>
                        <p class="text-sm text-gray-500">Type: {{ $project['type'] }}</p>
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-gray-600">No projects for this course yet.</p>
        @endif
    </div>
</x-layout1>
