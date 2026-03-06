<x-layout1>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container px-0 mx-auto">
        <!-- Master Table -->
        <div class="bg-white rounded-lg shadow overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-orange-500 text-white">
                    <tr>
                        <th class="py-3 px-4">#</th>
                        <th class="py-3 px-4">Course</th>
                        <th class="py-3 px-4">Program</th>
                        <th class="py-3 px-4">Year</th>
                        <th class="py-3 px-4">Project</th>
                        <th class="py-3 px-4">Type</th>
                        <th class="py-3 px-4">Student Project</th>
                        <th class="py-3 px-4">Group</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($Courses as $index => $course)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-2 px-4">{{ $index + 1 }}</td>
                            <td class="py-2 px-4">{{ $course['class_name'] }}</td>
                            <td class="py-2 px-4">{{ $course['program_name'] }}</td>
                            <td class="py-2 px-4">{{ $course['year'] }}</td>
                            <td class="py-2 px-4">{{ $course['project_name'] }}</td>
                            <td class="py-2 px-4">{{ $course['type'] }}</td>
                            <td class="py-2 px-4">{{ $course['sptitle'] }}</td>
                            <td class="py-2 px-4">{{ $course['group_name'] }}</td>
                            <td class="py-2 px-4">
                                <span class="{{ $course['status'] === 'Ongoing' ? 'text-green-600' : 'text-gray-500' }} font-semibold">
                                    {{ $course['status'] }}
                                </span>
                            </td>
                            <td class="py-2 px-4">
                                <a href="{{ route('lecturer.studentproject.detail', ['id' => $course['student_project_id']]) }}"
                                   class="text-orange-500 hover:text-orange-600 font-semibold">
                                    View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="py-4 px-4 text-center text-gray-600">No data available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layout1>
