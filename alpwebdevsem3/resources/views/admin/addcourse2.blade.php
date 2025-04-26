<x-layout1>
    <x-slot:title>Add Course</x-slot:title>

    <div class="max-w-3xl mx-auto p-8 rounded shadow">
        <form method="POST" action="{{ route('admin.course.store2') }}">
            @csrf

            <!-- Select Lecturer -->
            <div class="mb-4">
                <label for="lecturer_id" class="block text-gray-700 font-semibold">Select Lecturer</label>
                <select id="lecturer_id" name="lecturer_id" 
                        class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" required>
                    <option value="" disabled selected>Choose a lecturer</option>
                    @foreach ($lecturers as $lecturer)
                        <option value="{{ $lecturer->id }}">{{ $lecturer->lecturername }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Select or Add MataKuliah -->
            <div class="mb-4">
                <label for="mk_id" class="block text-gray-700 font-semibold">Select Matakuliah</label>
                <select id="mk_id" name="mk_id" 
                        class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    <option value="" disabled selected>Choose an existing course</option>
                    @foreach ($matakuliah as $mk)
                        <option value="{{ $mk->id }}">{{ $mk->namamk }}</option>
                    @endforeach
                </select>
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

            <!-- Submit -->
            <div class="flex space-x-4">
                <button type="submit" class="bg-green-500 text-white px-6 py-3 rounded hover:bg-green-600">Create</button>
                    <a href="{{ route('guestcourses.index') }}" 
                    class="bg-gray-300 text-gray-800 px-6 py-3 rounded hover:bg-gray-400">
                        Cancel
                    </a>
                <a href="{{ route('admin.matakuliah.create2') }}" 
                   class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600">Add Brand New Course</a>
            </div>
        </form>
    </div>
</x-layout1>
