<x-layout1>
    <x-slot:title>{{ $title }}</x-slot:title>
    <!-- Search Form -->
    <form method="GET" action="{{ route('guest.search') }}" class="mb-8 -mt-8">
        <input type="text" name="query" placeholder="Search projects by title" class="w-full px-4 py-2 border rounded" value="{{ request('query') }}">
        <button type="submit" class="bg-orange-500 text-white px-6 py-3 rounded hover:bg-orange-600 mt-4 w-full flex justify-center">
            Search
        </button>
    </form>

    <div class="space-y-8">
        @if ($studentProjects->count() > 0)
            @foreach ($studentProjects as $studentProject)
                <div class="border-b-2 border-black">
                    <a href="{{ route('guest.studentprojectdetail.show', ['id' => $studentProject->id]) }}"
                       class="block p-0 my-10 transition-transform duration-300 hover:scale-105">
                        <div class="flex space-x-4">
                            <div class="flex-shrink-0 h-40 bg-gray-200 w-72">
                                <!-- Project Image -->
                                <img alt="Image for {{ $studentProject->sptitle }}"
                                     class="object-cover w-full h-full"
                                     src="{{ $studentProject->project->projectimage ?? 'https://placehold.co/300x200' }}" />
                            </div>
                            <div>
                                <!-- Project Details -->
                                <h2 class="my-4 text-xl font-semibold">
                                    {{ $studentProject->project->lecturerMK->mataKuliah->namamk ?? 'Unknown Course' }} -
                                    {{ $studentProject->project->projectname }} -
                                    {{ $studentProject->project->type }}
                                    <br/>{{ $studentProject->project->tahun }}
                                </h2>
                                <h2 class="my-4 text-lg font-bold">{{ $studentProject->sptitle }}</h2>
                                <p class="my-4 text-gray-600">{{ $studentProject->sp_description }}</p>
                                <p class="my-4 text-gray-700">Group: {{ $studentProject->studentGroups->first()->groupname ?? 'No Group' }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
            <div class="pt-6">
                <a class="underline" href="{{ route('guestprojects.index') }}">Click Here to see more Projects</a>
            </div>
        @else
            <p class="text-gray-600">No projects found.</p>
        @endif
    </div>
</x-layout1>

{{-- <x-layout1>
    <x-slot:title>{{ $title }}</x-slot:title>

    <!-- Search Form -->
    <form method="GET" action="{{ route('guest.search') }}" class="mb-8">
        <input type="text" name="query" placeholder="Search projects by title" class="w-full px-4 py-2 border rounded" value="{{ request('query') }}">
        <button type="submit" class="px-4 py-2 mt-2 text-white bg-blue-500 rounded">Search</button>
    </form>

    <div class="space-y-8">
        @if ($studentProjects->count() > 0)
            @foreach ($studentProjects as $studentProject)
                <div class="border-b-2 border-black">
                    <a href="{{ route('guest.studentprojectdetail.show', ['id' => $studentProject->id]) }}"
                       class="block p-0 my-10 transition-transform duration-300 hover:scale-105">
                        <div class="flex space-x-4">
                            <div class="flex-shrink-0 h-40 bg-gray-200 w-72">
                                <!-- Project Image -->
                                <img alt="Image for {{ $studentProject->sptitle }}"
                                     class="object-cover w-full h-full"
                                     src="{{ $studentProject->project->projectimage ?? 'https://placehold.co/300x200' }}" />
                            </div>
                            <div>
                                <!-- Project Details -->
                                <h2 class="my-4 text-xl font-semibold">
                                    {{ $studentProject->project->lecturerMK->mataKuliah->namamk ?? 'Unknown Course' }} -
                                    {{ $studentProject->project->projectname }} -
                                    {{ $studentProject->project->type }}
                                    <br/>{{ $studentProject->project->tahun }}
                                </h2>
                                <h2 class="my-4 text-lg font-bold">{{ $studentProject->sptitle }}</h2>
                                <p class="my-4 text-gray-600">{{ $studentProject->sp_description }}</p>
                                <p class="my-4 text-gray-700">Group: {{ $studentProject->studentGroups->first()->groupname ?? 'No Group' }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
            <div class="pt-6">
                <a class="underline" href="{{ route('guestprojects.index') }}">Click Here to see more Projects</a>
            </div>
        @else
            <p class="text-gray-600">No projects found.</p>
        @endif
    </div>
</x-layout1> --}}

{{-- <x-layout1>
    <x-slot:title>{{ $title }}</x-slot:title>

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
            <div class="mt-8">
                <a href="{{ route('guestprojects.index') }}" class="px-4 py-2 text-white bg-blue-500 rounded">Show More</a>
            </div>
        @else
            <p class="text-gray-600">No projects found.</p>
        @endif
    </div>
</x-layout1> --}}

