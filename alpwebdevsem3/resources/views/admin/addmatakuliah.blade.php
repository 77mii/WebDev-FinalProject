<x-layout1>
    <x-slot:title>Add New Course for {{ $lecturer->lecturername }}</x-slot:title>

    <div class="max-w-3xl mx-auto p-8 rounded shadow">
        <form method="POST" action="{{ route('admin.matakuliah.store') }}">
            @csrf

            <!-- Course Name -->
            <div class="mb-4">
                <label for="namamk" class="block text-gray-700 font-semibold">Course Name</label>
                <input type="text" id="namamk" name="namamk" 
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-semibold">Course Description</label>
                <textarea id="description" name="description" rows="4"
                          class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <!-- Year -->
            <div class="mb-4">
                <label for="tahun" class="block text-gray-700 font-semibold">Year</label>
                <input type="text" id="tahun" name="tahun" 
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Semester -->
            <div class="mb-4">
                <label for="semester" class="block text-gray-700 font-semibold">Semester</label>
                <input type="text" id="semester" name="semester" 
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label for="lmk_status" class="block text-gray-700 font-semibold">Status</label>
                <select id="lmk_status" name="lmk_status" 
                        class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" required>
                    <option value="Ongoing">Ongoing</option>
                    <option value="Finished">Finished</option>
                </select>
            </div>

            <!-- Image -->
            <div class="mb-4">
                <label for="lmk_image" class="block text-gray-700 font-semibold">Image URL</label>
                <input type="url" id="lmk_image" name="lmk_image" 
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Additional Lecturers -->
            <div class="mb-4">
                <label for="additional_lecturers" class="block text-gray-700 font-semibold">Additional Lecturers</label>
                <input type="text" id="additional_lecturers" name="additional_lecturers" 
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Visibility -->
            <div class="mb-4">
                <label for="visibility" class="block text-gray-700 font-semibold">Visibility</label>
                <select id="visibility" name="visibility" 
                        class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" required>
                    <option value="1">Visible</option>
                    <option value="0">Hidden</option>
                </select>
            </div>

            <!-- Hidden Lecturer ID -->
            <input type="hidden" name="lecturer_id" value="{{ $lecturer->id }}">

            <div class="flex space-x-4">
                <button type="submit" class="bg-green-500 text-white px-6 py-3 rounded hover:bg-green-600">
                    Create Course
                </button>
                <a href="{{ route('admin.lecturer.details', $lecturer->id) }}" 
                   class="bg-gray-300 text-gray-800 px-6 py-3 rounded hover:bg-gray-400">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-layout1>
