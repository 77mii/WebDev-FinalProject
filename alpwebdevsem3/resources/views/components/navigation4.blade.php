<!-- navigation4.blade.php for Lecturer View -->
<div class="px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto flex justify-between items-center py-1">
        <div class="flex space-x-4">
            <a class="text-black hover:text-gray-700 transition duration-200" href="https://elearn.uc.ac.id">Elearn</a>
            <a class="text-black hover:text-gray-700 transition duration-200" href="https://employee.uc.ac.id/">CEdX</a>
            <a class="text-black hover:text-gray-700 transition duration-200" href="https://www.ciputra.ac.id/">About UC</a>
        </div>
        <div class="flex items-center space-x-4">
            <!-- User greeting -->
            <div class="flex flex-col items-end">
                <span class="text-gray-600">Welcome,</span>
                <span class="text-gray-600">{{ Auth::guard('lecturer')->user()->lecturername ?? 'Lecturer' }}</span>
            </div>
            <img src="{{ Auth::guard('lecturer')->user()->pfp ?? asset('UserPFP.png') }}"
                alt="Profile Picture" class="h-8 w-8 rounded-full" height="32">
        </div>
    </div>

    <!-- Thicker Orange Line -->
    <div class="border-t-4 border-orange-500 w-full"></div>
</div>

<!-- Main Navigation Bar -->
<nav class="sticky top-0 z-50 bg-[#EFEDEA]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex justify-between items-center">
            <div class="flex space-x-4">
                <a href="{{ route('lecturer.courses') }}"
                   class="text-lg hover:text-orange-300 transition duration-200
                   {{ request()->is('lecturer/courses') ? 'text-orange-500 font-bold' : 'text-black font-bold' }}">
                    Courses
                </a>
                <a href="{{ route('lecturer.projects') }}"
                   class="text-lg hover:text-orange-300 transition duration-200
                   {{ request()->is('lecturer/projects') ? 'text-orange-500 font-bold' : 'text-black font-bold' }}">
                    Projects
                </a>
                <a href="{{ route('lecturer.mastertable') }}"
                   class="text-lg hover:text-orange-300 transition duration-200
                   {{ request()->is('lecturer/mastertable') ? 'text-orange-500 font-bold' : 'text-black font-bold' }}">
                    Master Table
                </a>
                <a href="{{ route('lecturer.account') }}"
                   class="text-lg hover:text-orange-300 transition duration-200
                   {{ request()->is('lecturer/account') ? 'text-orange-500 font-bold' : 'text-black font-bold' }}">
                    Account
                </a>
            </div>

            <!-- Log Out Button -->
            <form method="POST" action="{{ route('lecturer.logout') }}">
                @csrf
                <button type="submit"
                        class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition duration-200">
                    Log Out
                </button>
            </form>
        </div>
    </div>
</nav>
