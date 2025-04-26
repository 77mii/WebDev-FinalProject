<x-layout1>
    <x-slot:title>{{$title}}</x-slot:title>
    <!-- x slot calls title -->

    <div class="space-y-8">
    @forelse (array_slice($ongoingProjects, 0, 5) as $projects)
        <div class="border-b-2 border-black ">
        <a href="{{ route('studentprojects.show', ['id' => $projects['id']]) }}"
            class="block p-0 my-10 transition-transform duration-300 hover:scale-105">
            <div class="flex space-x-4">
                <div class="flex-shrink-0 h-40 bg-gray-200 w-72">
                    <img alt="Project Image" class="object-cover w-full h-fuller" src="{{ $projects['image_url'] ?? 'https://placehold.co/300x200' }}">
                </div>
                <div>
                    <h2 class="my-4 text-xl font-semibold">
                        {{ $projects['projectname'] }} - {{ $projects['title'] }}
                    </h2>
                    <p class="my-4 text-gray-600">
                        {{ $projects['spdescription'] }}
                    </p>
                    <div class="my-4 text-gray-800">
                        {{ $projects['coursename'] }}
                    </div>
                    <div class="my-4 text-gray-800">
                        {{ $projects['type'] }}
                    </div>
                </div>
            </div>
        </a>
    </div>
        @empty
        <p>No ongoing projects found.</p>
        @endforelse


    </div>
    <div class="pt-6">
        <a class="underline" href="{{ route('studentprojects.index') }}">Click Here to see more Projects</a>
    </div>
</x-layout1>