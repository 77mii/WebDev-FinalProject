<x-layout1>
    <x-slot:title>Add Project</x-slot:title>

    <div class="mx-auto p-0 rounded">
        <form method="POST" action="{{ route('admin.project.store') }}">
            @csrf

            <!-- Project Name -->
            <div class="mb-4">
                <label for="projectname" class="block text-gray-700 font-semibold">Project Name</label>
                <input type="text" id="projectname" name="projectname" 
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-semibold">Description</label>
                <textarea id="description" name="description" rows="4"
                          class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <!-- Type -->
            <div class="mb-4">
                <label for="type" class="block text-gray-700 font-semibold">Type</label>
                <select id="type" name="type" 
                        class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" required>
                    <option value="AFL1">AFL1</option>
                    <option value="AFL2">AFL2</option>
                    <option value="AFL3">AFL3</option>
                    <option value="ALP">ALP</option>
                </select>
            </div>

            <!-- Project Image (URL) -->
            <div class="mb-4">
                <label for="projectimage" class="block text-gray-700 font-semibold">Project Image URL</label>
                <input type="url" id="projectimage" name="projectimage"
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Visibility -->
            <div class="mb-4">
                <label for="visibility" class="block text-gray-700 font-semibold">Visibility</label>
                <select id="visibility" name="visibility" 
                        class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" required>
                    <option value="1">Visible</option>
                    <option value="0">Not Visible</option>
                </select>
            </div>

            <!-- Hidden Course ID -->
            <input type="hidden" name="lmk_id" value="{{ $courseId }}">

            <!-- Submit -->
            <div class="flex space-x-4">
                <button type="submit" class="bg-green-500 text-white px-6 py-3 rounded hover:bg-green-600">Create</button>
                <a href="{{ route('guestcoursedetail.show', $courseId) }}" 
                   class="bg-gray-300 text-gray-800 px-6 py-3 rounded hover:bg-gray-400">Cancel</a>
            </div>
        </form>
    </div>
</x-layout1>
