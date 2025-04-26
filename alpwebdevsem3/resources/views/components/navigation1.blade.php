<!-- navigation1.blade.php for Guest View -->
<div class="px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto flex justify-between items-center py-1">
        <div class="flex space-x-4">
            <a class="text-black hover:text-gray-700 transition duration-200" href="https://elearn.uc.ac.id">Elearn</a>
            <a class="text-black hover:text-gray-700 transition duration-200" href="https://employee.uc.ac.id/">CEdX</a>
            <a class="text-black hover:text-gray-700 transition duration-200" href="https://www.ciputra.ac.id/">About UC</a>
        </div>
        <div class="flex items-center space-x-4">
            <!-- User greeting split into two lines -->
            <div class="flex flex-col items-end">
                <span class="text-gray-600">
                    Welcome,
                </span>
                <span class="text-gray-600">
                    Guest
                </span>
            </div>
            <img src="UserPFP.png" alt="Profile Picture" class="h-8 w-8 rounded-full" height="32">
        </div>
    </div>

    <!-- Thicker Orange Line -->
    <div class="border-t-4 border-orange-500 w-full"></div>
</div>

<!-- Main Navigation Bar with Orange Border -->
<nav class="sticky top-0 z-50 bg-[#EFEDEA]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex justify-between items-center">
            <div class="flex space-x-4">
                <!-- Lower Navigation Links for Guest -->
                <a href="/" class="text-lg hover:text-orange-300 transition duration-200 
                    {{ request()->is('/') ? 'text-orange-500 font-bold' : 'text-black font-bold' }}">Home</a>
                <a href="{{ route('guestprojects.index') }}" class="text-lg hover:text-orange-300 transition duration-200
                    {{ request()->is('guestprojects') ? 'text-orange-500 font-bold' : 'text-black font-bold' }}">Projects</a>
                <a href="{{ route('guestcourses.index') }}" class="text-lg hover:text-orange-300 transition duration-200
                    {{ request()->is('guestcourses') ? 'text-orange-500 font-bold' : 'text-black font-bold' }}">Courses</a>
                <a href="{{ route('guestlecturers.index') }}" class="text-lg hover:text-orange-300 transition duration-200
                    {{ request()->is('guestlecturers') ? 'text-orange-500 font-bold' : 'text-black font-bold' }}">Lecturers</a>
                 <a href="{{ route('gueststudents.index') }}" class="text-lg hover:text-orange-300 transition duration-200
                    {{ request()->is('gueststudents') ? 'text-orange-500 font-bold' : 'text-black font-bold' }}">Students</a>

            </div>

            <!-- Login Button -->
            <div class="flex space-x-4">
                <a href="{{ route('student.login') }}" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition duration-200">
                    Student Login
                </a>
                <a href="{{ route('admin.login') }}" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition duration-200">
                    Admin Login
                </a>
            </div>
        </div>
    </div>
</nav>
