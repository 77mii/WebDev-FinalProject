<x-layout1>
    <x-slot:title>Edit Course: {{ $course->mataKuliah->namamk ?? 'Unknown Course' }}</x-slot:title>

    <div class="mx-auto p-0 rounded ">
        <form method="POST" action="{{ route('admin.course.update', $course->id) }}">
            @csrf
            @method('PUT')

            <!-- Year -->
            <div class="mb-4">
                <label for="tahun" class="block text-gray-700 font-semibold">Year</label>
                <input type="number" id="tahun" name="tahun" value="{{ old('tahun', $course->tahun) }}"
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Semester -->
            <div class="mb-4">
                <label for="semester" class="block text-gray-700 font-semibold">Semester</label>
                <input type="text" id="semester" name="semester" value="{{ old('semester', $course->semester) }}"
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label for="lmk_status" class="block text-gray-700 font-semibold">Status</label>
                <select id="lmk_status" name="lmk_status" 
                        class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" required>
                    <option value="Ongoing" {{ old('lmk_status', $course->lmk_status) == 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
                    <option value="Finished" {{ old('lmk_status', $course->lmk_status) == 'Finished' ? 'selected' : '' }}>Finished</option>
                </select>
            </div>

            <!-- Image URL -->
            <div class="mb-4">
                <label for="lmk_image" class="block text-gray-700 font-semibold">Image URL</label>
                <input type="url" id="lmk_image" name="lmk_image" value="{{ old('lmk_image', $course->lmk_image) }}"
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Additional Lecturers -->
            <div class="mb-4">
                <label for="additional_lecturers" class="block text-gray-700 font-semibold">Additional Lecturers</label>
                <input type="text" id="additional_lecturers" name="additional_lecturers"
                       value="{{ old('additional_lecturers', $course->additional_lecturers) }}"
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Visibility -->
            <div class="mb-4">
                <label for="visibility" class="block text-gray-700 font-semibold">Visibility</label>
                <select id="visibility" name="visibility" class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" required>
                    <option value="1" {{ $course->visibility ? 'selected' : '' }}>Visible</option>
                    <option value="0" {{ !$course->visibility ? 'selected' : '' }}>Not Visible</option>
                </select>
            </div>

            <!-- Submit -->
            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600">Save Changes</button>
                <a href="{{ route('guestcoursedetail.show', $course->id) }}" 
                   class="bg-gray-300 text-gray-800 px-6 py-3 rounded hover:bg-gray-400">Cancel</a>
            </div>
        </form>
    </div>
</x-layout1>
