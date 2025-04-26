<x-layout1>
    <x-slot:title>Edit Project: {{ $project->projectname }}</x-slot:title>

    <div class="mx-auto p-0 rounded">
        <form method="POST" action="{{ route('admin.project.update', $project->id) }}">
            @csrf
            @method('PUT')

            <!-- Project Name -->
            <div class="mb-4">
                <label for="projectname" class="block text-gray-700 font-semibold">Project Name</label>
                <input type="text" id="projectname" name="projectname" 
                       value="{{ old('projectname', $project->projectname) }}" 
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" required>
                @error('projectname')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-semibold">Description</label>
                <textarea id="description" name="description" rows="4" 
                          class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">{{ old('description', $project->description) }}</textarea>
                @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label for="status" class="block text-gray-700 font-semibold">Status</label>
                <input type="text" id="status" name="status" 
                       value="{{ old('status', $project->status) }}" 
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" required>
                @error('status')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Type -->
            <div class="mb-4">
                <label for="type" class="block text-gray-700 font-semibold">Type</label>
                <input type="text" id="type" name="type" 
                       value="{{ old('type', $project->type) }}" 
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" required>
                @error('type')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Project Image -->
            <div class="mb-4">
                <label for="projectimage" class="block text-gray-700 font-semibold">Project Image URL</label>
                <input type="url" id="projectimage" name="projectimage" 
                       value="{{ old('projectimage', $project->projectimage) }}" 
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                @error('projectimage')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Visibility -->
            <div class="mb-4">
                <label for="visibility" class="block text-gray-700 font-semibold">Visibility</label>
                <select id="visibility" name="visibility" 
                        class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    <option value="1" {{ old('visibility', $project->visibility) ? 'selected' : '' }}>Visible</option>
                    <option value="0" {{ !old('visibility', $project->visibility) ? 'selected' : '' }}>Hidden</option>
                </select>
                @error('visibility')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit and Cancel Buttons -->
            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600">Save Changes</button>
            <a href="{{ route('gueststudentprojects.show', ['id' => $project->id]) }}" 
            class="bg-gray-300 text-gray-800 px-6 py-3 rounded hover:bg-gray-400">Cancel</a>
            </div>
        </form>
    </div>
</x-layout1>
