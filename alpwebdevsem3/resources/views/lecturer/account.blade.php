<x-layout1>
    <x-slot:title>{{ $lecturer->lecturername }}'s Details</x-slot:title>

    <!-- Content -->
    <div class="max-w-5xl mx-auto p-8 border border-black rounded bg-transparent">
        <div class="flex items-center space-x-8">
            <!-- Profile Picture -->
            <img src="{{ $lecturer && $lecturer->pfp
                ? (Str::startsWith($lecturer->pfp, 'http')
                    ? $lecturer->pfp
                    : asset('storage/' . $lecturer->pfp))
                : asset('UserPFP.png') }}"
                alt="Profile Picture"
                class="w-48 h-48 rounded-full border border-gray-400">

            <!-- Lecturer Details -->
            <div class="space-y-2 ml-8">
                <h2 class="text-lg font-bold text-gray-800">Full Name</h2>
                <p class="text-gray-600">{{ $lecturer->lecturername ?? 'Lecturer' }}</p>

                <h2 class="text-lg font-bold text-gray-800 mt-4">Employee Number</h2>
                <p class="text-gray-600">{{ $lecturer->employeenumber ?? '-' }}</p>

                <h2 class="text-lg font-bold text-gray-800 mt-4">Email</h2>
                <p class="text-gray-600">
                    <a href="mailto:{{ $lecturer->email ?? '' }}" class="text-gray-600">
                        {{ $lecturer->email ?? '-' }}
                    </a>
                </p>
            </div>
        </div>
    </div>
</x-layout1>
