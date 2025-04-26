<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Junge&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
    <title>{{ $title ?? 'Page' }}</title>
</head>
<body class="bg-[#EFEDEA] flex flex-col min-h-screen">

    <!-- Flex container for sidebar and main content -->
    <div class="flex flex-1 min-h-screen ">
        <!-- Sidebar -->
        <div class="sidebar text-black w-48 flex flex-col items-center py-4 bg-[#EFEDEA] ">
            <img src="{{ asset('logoucbnw.png') }}" alt="University Logo" class="w-auto h-40 mb-4">
            <div class="flex mt-2">
                <p class="mt-10 text-3xl font-bold writing-mode-vertical-rl text-orientation-upright" style="font-family: 'Junge', serif;">Integrity</p>
                <p class="mt-2 text-3xl font-bold writing-mode-vertical-rl text-orientation-upright" style="font-family: 'Junge', serif;">Professionalism</p>
                <p class="mt-10 text-3xl font-bold writing-mode-vertical-rl text-orientation-upright" style="font-family: 'Junge', serif;">Entrepreneurship</p>
            </div>
        </div>

        <!-- Main content area -->
        <div class="flex-1 bg-[#EFEDEA]">
        <!-- layout.blade.php -->
        @if (auth()->guard('admin')->check())
            <!-- If the user is an admin, use navigation2 -->
            <x-navigation2></x-navigation2>
        @elseif (auth()->guard('student')->check())
            <!-- If the user is a student, use navigation3 -->
            <x-navigation3></x-navigation3>
        @else
            <!-- Use navigation1 for guests -->
            <x-navigation1></x-navigation1>
        @endif
            {{-- @if (auth()->guard('admin')->check()) 
                <!-- If the user is an admin, use navigation2 -->
                <x-navigation2></x-navigation2>
            @else
                <!-- Use navigation1 for other users -->
                <x-navigation1></x-navigation1>
            @endif --}}

            <x-header1 :title="$title"></x-header1>

            <!-- Main content slot -->
            <div class="py-8 px-4 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </div>
    </div>

    <!-- Footer -->
    <x-footer class="w-full"></x-footer>
</body>
</html>
