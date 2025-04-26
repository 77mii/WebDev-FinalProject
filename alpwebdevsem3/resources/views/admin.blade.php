<!-- resources/views/admin.blade.php -->
<x-layout1>
    <x-slot:title>{{ $title }}</x-slot:title>

    <!-- Admin content here, similar to guest view -->
    <div class="flex justify-center items-center min-h-screen">
        <h1 class="text-3xl font-bold text-center">{{ $title }}</h1>
        <div class="py-8 px-4 sm:px-6 lg:px-8">
            <!-- Your content here -->
            <p>Welcome to the Admin Panel</p>
            <!-- Add any admin-specific content here -->
        </div>
    </div>
</x-layout1>
