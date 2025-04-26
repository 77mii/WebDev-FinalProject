<x-layout1>
    <x-slot:title>{{ $title }}</x-slot:title>

    <!-- Admin Add Student Project and Filter Buttons -->
    <div class="flex justify-between items-center mb-8 -mt-6">
        @auth('admin')
        <div>
            <a href="{{ route('admin.studentproject.create2') }}" 
               class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">
                Add Student Project
            </a>
        </div>
        @endauth
        <div>
            <button onclick="toggleDropdown()" 
                    class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none">
                Filter
            </button>
            <div id="dropdownMenu" class="absolute hidden w-56 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5">
                <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                    <!-- Title Filter -->
                    <button onclick="toggleSubDropdown('title')" 
                            class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100">
                        Title
                    </button>
                    <div id="titleSubDropdown" class="hidden pl-4">
                        <a href="{{ route('guest.filter', ['filter' => 'title', 'order' => 'asc']) }}" 
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Ascending
                        </a>
                        <a href="{{ route('guest.filter', ['filter' => 'title', 'order' => 'desc']) }}" 
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Descending
                        </a>
                    </div>
                    <!-- Semester Filter -->
                    <button onclick="toggleSubDropdown('semester')" 
                            class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100">
                        Semester
                    </button>
                    <div id="semesterSubDropdown" class="hidden pl-4">
                        <a href="{{ route('guest.filter', ['filter' => 'semester', 'order' => 'asc']) }}" 
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Ascending
                        </a>
                        <a href="{{ route('guest.filter', ['filter' => 'semester', 'order' => 'desc']) }}" 
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Descending
                        </a>
                    </div>
                    <!-- Year Filter -->
                    <button onclick="toggleSubDropdown('year')" 
                            class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100">
                        Year
                    </button>
                    <div id="yearSubDropdown" class="hidden pl-4">
                        <a href="{{ route('guest.filter', ['filter' => 'year', 'order' => 'asc']) }}" 
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Ascending
                        </a>
                        <a href="{{ route('guest.filter', ['filter' => 'year', 'order' => 'desc']) }}" 
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Descending
                        </a>
                    </div>
                    <!-- Course Filter -->
                    <button onclick="toggleSubDropdown('course')" 
                            class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100">
                        Course
                    </button>
                    <div id="courseSubDropdown" class="hidden pl-4">
                        <a href="{{ route('guest.filter', ['filter' => 'course', 'order' => 'asc']) }}" 
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Ascending
                        </a>
                        <a href="{{ route('guest.filter', ['filter' => 'course', 'order' => 'desc']) }}" 
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Descending
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Bar -->
    <form method="GET" action="{{ route('guestprojects.search') }}" class="mb-8">
        <input 
            type="text" 
            name="query" 
            placeholder="Search projects by title" 
            class="w-full px-4 py-2 border rounded" 
            value="{{ request('query') }}"
        >
        <button type="submit" class="bg-orange-500 text-white px-6 py-3 rounded hover:bg-orange-600 mt-4 w-full flex justify-center">Search</button>
    </form>

    <!-- Filter Dropdown JavaScript -->
    <script>
        function toggleDropdown() {
            document.getElementById('dropdownMenu').classList.toggle('hidden');
        }

        function toggleSubDropdown(filter) {
            document.getElementById(filter + 'SubDropdown').classList.toggle('hidden');
        }
    </script>

    <!-- Display Student Projects -->
    <div class="container px-0 mx-auto">
        @if ($studentProjects->count() > 0)
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($studentProjects as $studentProject)
                    <a href="{{ route('guest.studentprojectdetail.show', ['id' => $studentProject->id]) }}"
                       class="block p-0 transition-transform duration-300 hover:scale-105">
                        <!-- Project Image -->
                        <img alt="Image for {{ $studentProject->sptitle }}"
                             class="object-cover w-full h-48 mb-4"
                             src="{{ $studentProject->project->projectimage ?? 'https://placehold.co/300x200' }}" />

                        <!-- Project Details -->
                        <p class="text-sm text-gray-500">
                            {{ $studentProject->project->lecturerMK->mataKuliah->namamk ?? 'Unknown Course' }} -
                            {{ $studentProject->project->projectname }} -
                            {{ $studentProject->project->type }}
                            <br/>{{ $studentProject->project->tahun }}
                        </p>
                        <h2 class="text-lg font-bold">{{ $studentProject->sptitle }}</h2>
                        <p class="text-gray-700">Group: {{ $studentProject->studentGroups->first()->groupname ?? 'No Group' }}</p>
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-gray-600">No projects found.</p>
        @endif
    </div>
</x-layout1>



{{-- <x-layout1>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container px-0 mx-auto">
        @auth('admin')
        <div class="mb-6 -mt-6">
            <a href="{{ route('admin.studentproject.create2') }}" 
            class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">
                Add Student Project
            </a>
        </div>
    @endauth
        @if ($studentProjects->count() > 0)
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($studentProjects as $studentProject)
                    <a href="{{ route('guest.studentprojectdetail.show', ['id' => $studentProject->id]) }}"
                       class="block p-0 transition-transform duration-300 hover:scale-105">
                        <!-- Project Image -->
                        <img alt="Image for {{ $studentProject->sptitle }}"
                             class="object-cover w-full h-48 mb-4"
                             src="{{ $studentProject->project->projectimage ?? 'https://placehold.co/300x200' }}" />

                        <!-- Project Details -->
                        <p class="text-sm text-gray-500">
                            {{ $studentProject->project->lecturerMK->mataKuliah->namamk ?? 'Unknown Course' }} -
                            {{ $studentProject->project->projectname }} -
                            {{ $studentProject->project->type }}
                            <br/>{{ $studentProject->project->tahun }}
                        </p>
                        <h2 class="text-lg font-bold">{{ $studentProject->sptitle }}</h2>
                        <p class="text-gray-700">Group: {{ $studentProject->studentGroups->first()->groupname ?? 'No Group' }}</p>
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-gray-600">No projects found.</p>
        @endif
    </div>
</x-layout1> --}}
