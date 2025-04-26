<x-layout1>
    <x-slot:title>{{ $student->studentname }}'s Details</x-slot:title>

    <!-- Content -->
    <div class="max-w-5xl mx-auto p-8 border border-black rounded bg-transparent">
        <div class="flex items-center space-x-8">
            <!-- Profile Picture -->
            <img src="{{ $student && $student->pfp 
                ? (Str::startsWith($student->pfp, 'http') 
                    ? $student->pfp 
                    : asset('storage/' . $student->pfp)) 
                : asset('UserPFP.png') }}" 
                alt="Profile Picture" 
                class="w-48 h-48 rounded-full border border-gray-400">

            <!-- Student Details -->
            <div class="space-y-2 ml-8">
                <h2 class="text-lg font-bold text-gray-800">Full Name</h2>
                <p class="text-gray-600">{{ $student->studentname ?? 'I am The User' }}</p>

                <h2 class="text-lg font-bold text-gray-800 mt-4">NIM</h2>
                <p class="text-gray-600">{{ $student->nim ?? '0706012130404' }}</p>

                <h2 class="text-lg font-bold text-gray-800 mt-4">Email</h2>
                <p class="text-gray-600">
                    <a href="mailto:{{ $student->email ?? '' }}" class="text-gray-600">
                        {{ $student->email ?? 'user.404@ciputra.ac.id' }}
                    </a>
                </p>
            </div>
        </div>
    </div>

    <div class="mt-10 text-center">
        <a href="{{ route('admin.student.edit', $student->id) }}"
        class="bg-orange-500 hover:bg-orange-600 text-white py-2 px-4">
            Edit Profile
        </a>
    </div>


    <!-- Student Projects -->
    <div class="mx-auto mt-12">
        <h3 class="text-3xl font-bold mb-4">Projects Made</h3>
        <div class="border-t-4 border-orange-500 mb-6"></div>

        <!-- Grid View for Student Projects -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($studentProjectsWithImages as $project)
                <a href="{{ route('guest.studentprojectdetail.show', ['id' => $project->id]) }}" class="block p-0 hover:scale-105 transition-transform duration-300">
                    <!-- Project Image -->
                    <img alt="Image for {{ $project->sptitle }}" 
                        class="w-full h-48 object-cover mb-4" 
                        src="{{ $project->image->imageurl ?? 'https://placehold.co/300x200' }}" />

                    <!-- Project Details -->
                    <p class="text-sm text-gray-500">
                        {{ $project->project->lecturerMK->mataKuliah->namamk ?? 'Unknown Course' }} - 
                        {{ $project->project->type ?? 'Unknown Type' }} - 
                        {{ $project->project->lecturerMK->tahun ?? 'Unknown Year' }}
                    </p>
                    <h2 class="font-bold text-lg">{{ $project->sptitle }}</h2>
                </a>
            @empty
                <p class="text-gray-600">No projects associated with this student.</p>
            @endforelse
        </div>
    </div>

</x-layout1>
