<x-layout1>
    <x-slot:title>Students Log</x-slot:title>

    <div class="container mx-auto mt-[-30px]">

        <!-- Add Student Button -->
        {{-- @auth('admin') --}}
        <div class="mb-6">
            <a href="{{ route('admin.student.create') }}" 
               class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">
                Add Student
            </a>
        </div>
        
        {{-- @endauth --}}

        <!-- A, B, C, D, etc. -->
        @foreach(range('A', 'Z') as $letter)
            <!-- Group Students by First Letter -->
            @php
                $filteredStudents = $students->filter(function ($student) use ($letter) {
                    return strtoupper($student->studentname[0]) == $letter;
                });
            @endphp

            @if($filteredStudents->isNotEmpty())
                <h3 class="text-2xl font-semibold mt-6 mb-2">{{ $letter }}</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                    <!-- Loop through filtered students -->
                    @foreach($filteredStudents as $student)
                        <div class="bg-white p-4 border rounded-lg shadow-md hover:shadow-xl transition">
                            <a href="{{ route('admin.student.details', $student->id) }}" class="block">
                                <h4 class="text-xl font-bold text-black">{{ $student->studentname }}</h4>
                                <p class="text-gray-500">{{ $student->nim }}</p>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        @endforeach
    </div>
</x-layout1>