<x-layout1>
    <x-slot:title>Edit Project: {{ $studentProject->sptitle }}</x-slot:title>

    <!-- Project Edit Form -->
    <form action="{{ route('student.studentproject.update', $studentProject->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Indicate that this is a PUT request for updating -->

        <div class="space-y-6">
            <!-- Project Title -->
            <div>
                <label for="sptitle" class="block text-lg font-semibold">Project Title</label>
                <input type="text" id="sptitle" name="sptitle" value="{{ old('sptitle', $studentProject->sptitle) }}" 
                       class="w-full p-3 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500"
                       required>
            </div>

            <!-- Project Description -->
            <div>
                <label for="sp_description" class="block text-lg font-semibold">Project Description</label>
                <textarea id="sp_description" name="sp_description" rows="4"
                          class="w-full p-3 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500">{{ old('sp_description', $studentProject->sp_description) }}</textarea>
            </div>

            <!-- Visibility -->
            <div>
                <label for="visibility" class="block text-lg font-semibold">Visibility</label>
                <select id="visibility" name="visibility" class="w-full p-3 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500">
                    <option value="1" {{ $studentProject->visibility == 1 ? 'selected' : '' }}>Visible</option>
                    <option value="0" {{ $studentProject->visibility == 0 ? 'selected' : '' }}>Hidden</option>
                </select>
            </div>

            <!-- Project Images -->
            <div>
                <label class="block text-lg font-semibold">Project Images</label>
                <div class="space-y-2">
                    @foreach ($studentProject->projectImages as $image)
                        <div class="flex items-center space-x-2">
                            <input type="url" name="image_urls[]" value="{{ old('image_urls.' . $loop->index, $image->imageurl) }}"
                                   class="w-full p-3 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500"
                                   placeholder="Image URL">
                            <button type="button" onclick="this.parentElement.remove()" 
                                    class="bg-red-500 text-white px-3 py-2 rounded hover:bg-red-600">
                                Remove
                            </button>
                        </div>
                    @endforeach
                </div>
                <button type="button" id="addImageButton" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Add Image
                </button>
            </div>

            <!-- Submit Button -->
            <div class="mt-6 flex space-x-4">
                <!-- Save Changes Button -->
                <button type="submit" class="bg-orange-400 text-white px-6 py-3 rounded hover:bg-orange-700 w-full sm:w-auto">Save Changes</button>

                <!-- Cancel Button -->
                <a href="{{ route('guest.studentprojectdetail.show', $studentProject->id) }}" 
                   class="bg-gray-300 text-gray-800 px-6 py-3 rounded hover:bg-gray-400 w-full sm:w-auto text-center flex items-center justify-center">
                    Back
                </a>
            </div>
        </div>
    </form>
</x-layout1>

<script>
    document.getElementById('addImageButton').addEventListener('click', function() {
        const container = document.createElement('div');
        container.className = 'flex items-center space-x-2 mt-2';
        container.innerHTML = `
            <input type="url" name="image_urls[]" 
                   class="w-full p-3 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500"
                   placeholder="New Image URL">
            <button type="button" onclick="this.parentElement.remove()" 
                    class="bg-red-500 text-white px-3 py-2 rounded hover:bg-red-600">
                Remove
            </button>
        `;
        this.insertAdjacentElement('beforebegin', container);
    });
</script>
