<x-layout1>
    <x-slot:title>Add Student Project</x-slot:title>

    <div class="mx-auto p-0 rounded">
        <!-- Add Student Project Form -->
        <form method="POST" action="{{ route('admin.studentproject.store2') }}">
            @csrf

            <!-- Select LecturerMK -->
            <div class="mb-4">
                <label for="lecturermk_id" class="block text-gray-700 font-semibold">Select LecturerMK</label>
                <select id="lecturermk_id" name="lecturermk_id" 
                        class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" required>
                    <option value="" disabled selected>Choose a LecturerMK</option>
                    @foreach ($lecturerMKs as $lecturerMK)
                        <option value="{{ $lecturerMK->id }}">
                            {{ $lecturerMK->mataKuliah->namamk }} ({{ $lecturerMK->tahun }} - {{ $lecturerMK->semester }}) 
                            - Lecturer: {{ $lecturerMK->lecturer->lecturername }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Select Project -->
            <div class="mb-4">
                <label for="project_id" class="block text-gray-700 font-semibold">Select Project</label>
                <select id="project_id" name="project_id" 
                        class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" required>
                    <option value="" disabled selected>Choose a project</option>
                    <!-- Options will be dynamically populated -->
                </select>
            </div>


            <!-- Title -->
            <div class="mb-4">
                <label for="sptitle" class="block text-gray-700 font-semibold">Project Title</label>
                <input type="text" id="sptitle" name="sptitle" 
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="sp_description" class="block text-gray-700 font-semibold">Description</label>
                <textarea id="sp_description" name="sp_description" rows="4"
                          class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <!-- File Type -->
            <div class="mb-4">
                <label for="file_type" class="block text-gray-700 font-semibold">File Type</label>
                <input type="text" id="file_type" name="file_type"
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

            <!-- Images (URLs) -->
            <div class="mb-6">
                <h3 class="block text-gray-700 font-semibold mb-2">Project Images (URLs)</h3>
                <div id="imageContainer" class="space-y-4">
                    <div>
                        <input type="url" name="image_urls[]" placeholder="Image URL"
                               class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <button type="button" onclick="addImageField()" 
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mt-2">
                    Add Another Image
                </button>
            </div>

            <!-- Group -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-2">Add Group</h3>

                <!-- Group Name -->
                <label for="groupname" class="block text-gray-700 font-semibold">Group Name</label>
                <input type="text" id="groupname" name="groupname" 
                    class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" required>

                <!-- Students -->
                <label class="block text-gray-700 font-semibold mt-4">Select Students</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($students as $student)
                        <div class="flex items-center space-x-2">
                            <input type="checkbox" id="student-{{ $student->id }}" name="students[]" value="{{ $student->id }}"
                                class="mr-2">
                            <label for="student-{{ $student->id }}">{{ $student->studentname }} ({{ $student->nim }})</label>
                        </div>
                    @endforeach
                </div>
                {{-- <div class="space-y-2">
                    @foreach ($students as $student)
                        <div class="flex items-center">
                            <input type="checkbox" id="student-{{ $student->id }}" name="students[]" value="{{ $student->id }}"
                                class="mr-2">
                            <label for="student-{{ $student->id }}">{{ $student->studentname }} ({{ $student->nim }})</label>
                        </div>
                    @endforeach
                </div> --}}
            </div>

            <!-- Submit -->
            <div class="flex space-x-4">
                <button type="submit" class="bg-green-500 text-white px-6 py-3 rounded hover:bg-green-600">Create</button>
                <a href="{{ route('guestprojects.index') }}" 
                   class="bg-gray-300 text-gray-800 px-6 py-3 rounded hover:bg-gray-400">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('lecturermk_id').addEventListener('change', function () {
            const lmkId = this.value;
            const projectSelect = document.getElementById('project_id');

            // Clear current project options
            projectSelect.innerHTML = '<option value="" disabled selected>Loading...</option>';

            fetch(`/api/projects/${lmkId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to fetch projects');
                    }
                    return response.json();
                })
                .then(projects => {
                    projectSelect.innerHTML = '<option value="" disabled selected>Choose a Project</option>';
                    projects.forEach(project => {
                        const option = document.createElement('option');
                        option.value = project.id;
                        option.textContent = `${project.projectname} - ${project.type}`;
                        projectSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    projectSelect.innerHTML = '<option value="" disabled selected>Error loading projects</option>';
                    console.error('Error fetching projects:', error);
                });
        });

        function addImageField() {
            const container = document.getElementById('imageContainer');
            const newField = document.createElement('div');
            newField.innerHTML = `
                <input type="url" name="image_urls[]" placeholder="Image URL"
                       class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
            `;
            container.appendChild(newField);
        }
    </script>
</x-layout1>
