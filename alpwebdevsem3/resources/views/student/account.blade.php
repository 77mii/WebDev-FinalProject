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

    <!-- Edit Profile Button -->
    <div class="mt-10 text-center">
        <a href="{{ route('student.edit.account') }}"
        class="bg-orange-500 hover:bg-orange-600 text-white py-2 px-4">
            Edit Profile
        </a>
    </div>
</x-layout1>
