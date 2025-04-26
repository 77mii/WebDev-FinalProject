<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Lecturer;
use App\Models\StudentProject;
use App\Models\LecturerMK;
use App\Models\Project;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show the students log (alphabetically listed).
     */
    public function showStudentsLog()
    {
        // Fetch all students ordered alphabetically by their name
        $students = Student::orderBy('studentname', 'asc')->get();

        return view('admin.studentlog', compact('students'));
    }

    /**
     * Show the details of a specific student.
     */
    public function showStudentDetails($studentId)
    {
        // Eager load all required relationships
        $student = Student::with([
            'studentGroups.studentProject.project.lecturerMK.mataKuliah',  // Eager load mataKuliah and related data
            'studentGroups.studentProject.projectImages'  // Eager load project images
        ])->findOrFail($studentId);

        // Get the student projects associated with the student through studentGroups
        $studentProjects = $student->studentGroups->map(function ($group) {
            return $group->studentProject; // Access the studentProject associated with each group
        })->filter(); // Remove null values if any

        // Map through the student projects to include images (the first image per project)
        $studentProjectsWithImages = $studentProjects->map(function ($project) {
            $project->image = $project->projectImages->isNotEmpty() 
                            ? $project->projectImages->first() 
                            : null;
            return $project;
        });

        // Pass student and projects to the view
        return view('admin.studentdetails', compact('student', 'studentProjectsWithImages'));
    }
    // public function showStudentDetails($studentId)
    // {
    //     // Eager load the student's groups, studentProjects, and projectImages
    //     $student = Student::with([
    //         'studentGroups.studentProject.projectImages',  // Eager load project images
    //     ])->findOrFail($studentId);
    
    //     // Get the student projects associated with the student through studentGroups
    //     $studentProjects = $student->studentGroups->map(function ($group) {
    //         return $group->studentProject; // Access the studentProject associated with each group
    //     })->filter(); // Remove null values if any
    
    //     // Map through the student projects to include images (the first image per project)
    //     $studentProjectsWithImages = $studentProjects->map(function ($project) {
    //         // Check if projectImages exist, if not return a placeholder
    //         $project->image = $project->projectImages->isNotEmpty() 
    //                           ? $project->projectImages->first() 
    //                           : null;
    //         return $project;
    //     });
    
    //     // Pass student and projects to the view
    //     return view('admin.studentdetails', compact('student', 'studentProjectsWithImages'));
    // }

    public function editStudentProject($id)
    {
        $studentProject = StudentProject::findOrFail($id);
        return view('admin.studentprojectedit', compact('studentProject'));
    }

    public function updateStudentProject(Request $request, $id)
        {
            // Validate the incoming data
            $request->validate([
                'sptitle' => 'required|string|max:255',
                'sp_description' => 'nullable|string',
                'visibility' => 'required|boolean',
                'image_urls' => 'nullable|array',
                'image_urls.*' => 'nullable|url',
            ]);

            // Find the student project
            $studentProject = StudentProject::with('projectImages')->findOrFail($id);

            // Update basic fields
            $studentProject->update([
                'sptitle' => $request->input('sptitle'),
                'sp_description' => $request->input('sp_description'),
                'visibility' => $request->input('visibility'),
            ]);

            // Handle project images
            $existingImageUrls = $studentProject->projectImages->pluck('imageurl')->toArray();
            $newImageUrls = $request->input('image_urls', []);

            // Determine images to delete
            $imagesToDelete = array_diff($existingImageUrls, $newImageUrls);

            // Determine images to add
            $imagesToAdd = array_diff($newImageUrls, $existingImageUrls);

            // Delete images that are no longer present
            foreach ($imagesToDelete as $url) {
                $studentProject->projectImages()->where('imageurl', $url)->delete();
            }

            // Add new images
            foreach ($imagesToAdd as $url) {
                if (!empty($url)) {
                    $studentProject->projectImages()->create(['imageurl' => $url]);
                }
            }

            return redirect()
                ->route('guest.studentprojectdetail.show', $studentProject->id)
                ->with('success', 'Student project updated successfully.');
        }

        public function destroyStudentProject($id)
        {
            $studentProject = StudentProject::with(['projectImages', 'studentGroups'])->findOrFail($id);
        
            // Save the student ID for redirection
            $studentId = $studentProject->studentGroups->first()?->students->first()?->id;
        
            // Delete related project images
            $studentProject->projectImages()->delete();
        
            // Delete related student groups
            $studentProject->studentGroups()->delete();
        
            // Now delete the student project
            $studentProject->delete();
        
            // Redirect back to the student's details page
          //  return redirect()->route('admin.student.details', $studentId)
            return redirect()->route('admin.dashboard')
                ->with('success', 'Project deleted successfully!');
        }

        public function editStudent($studentId)
        {
            // Fetch the student to be edited
            $student = Student::findOrFail($studentId);
        
            // Return the edit view with the student data
            return view('admin.studentedit', compact('student'));
        }
        
        public function updateStudent(Request $request, $studentId)
        {
            // Validate the input data
            $request->validate([
                'studentname' => 'required|string|max:255',
                'email'       => 'required|email|unique:students,email,' . $studentId, // Ensure email is unique except for the current student
                'nim'         => 'required|string|max:50|unique:students,nim,' . $studentId, // Ensure NIM is unique
                'pfp'         => 'nullable|url', // Expect a URL for the profile picture
            ]);
        
            // Fetch the student
            $student = Student::findOrFail($studentId);
        
            // Update the student data
            $student->update([
                'studentname' => $request->input('studentname'),
                'email'       => $request->input('email'),
                'nim'         => $request->input('nim'),
                'pfp'         => $request->input('pfp'), // Directly save the profile picture URL
            ]);
        
            // Redirect back to the student details page with a success message
            return redirect()->route('admin.student.details', $student->id)
                ->with('success', 'Student updated successfully!');
        }

    public function destroyStudent($studentId)
    {
        // Find the student
        $student = Student::findOrFail($studentId);

        // Detach associations in the pivot table `student_group_student`
        $student->studentGroups()->detach();

        // Delete the student record
        $student->delete();

        // Redirect to the student list with a success message
        return redirect()->route('admin.students.log')
            ->with('success', 'Student deleted successfully.');
    }

    public function showLecturersLog()
    {
        $lecturers = Lecturer::orderBy('lecturername', 'asc')->get();

        return view('admin.lecturerlog', [
            'title' => 'Lecturers Log',
            'lecturers' => $lecturers,
        ]);
    }

    /**
     * Show a specific lecturer's details.
     */
    public function showLecturerDetails($id)
    {
        $lecturer = Lecturer::with('lecturerMKs.mataKuliah')->findOrFail($id);

        return view('admin.lecturerdetails', [
            'title' => 'Lecturer Details',
            'lecturer' => $lecturer,
        ]);
    }

    /**
     * Show a course's details.
     */
    public function showCourseDetail($id)
    {
        $course = LecturerMK::with(['mataKuliah', 'lecturer', 'projects'])->findOrFail($id);

        return view('admin.coursedetail', [
            'title' => 'Course Details',
            'course' => $course,
        ]);
    }

    /**
     * Edit a lecturer (functionality to be implemented as needed).
     */
    public function editLecturer($lecturerId)
    {
        // Fetch the lecturer
        $lecturer = Lecturer::findOrFail($lecturerId);
    
        // Return the edit view with the lecturer data
        return view('admin.lectureredit', compact('lecturer'));
    }
    
    public function updateLecturer(Request $request, $lecturerId)
    {
        // Validate the request data
        $request->validate([
            'lecturername' => 'required|string|max:255',
            'email' => 'required|email|unique:lecturers,email,' . $lecturerId,
            'employeenumber' => 'required|string|max:50|unique:lecturers,employeenumber,' . $lecturerId,
            'pfp' => 'nullable|url', // Profile picture URL
        ]);
    
        // Fetch the lecturer
        $lecturer = Lecturer::findOrFail($lecturerId);
    
        // Update lecturer details
        $lecturer->update([
            'lecturername' => $request->input('lecturername'),
            'email' => $request->input('email'),
            'employeenumber' => $request->input('employeenumber'),
            'pfp' => $request->input('pfp'),
        ]);
    
        // Redirect to the lecturer details page with a success message
        return redirect()->route('admin.lecturer.details', $lecturer->id)
                         ->with('success', 'Lecturer updated successfully.');
    }
    

    /**
     * Delete a lecturer.
     */
    public function destroyLecturer($id)
    {
        // Fetch the lecturer with all related data
        $lecturer = Lecturer::with('lecturerMKs.projects.studentProjects.studentGroups', 'lecturerMKs.projects.studentProjects.projectImages')->findOrFail($id);
    
        // Delete all related data
        $lecturer->lecturerMKs->each(function ($lecturerMK) {
            $lecturerMK->projects->each(function ($project) {
                $project->studentProjects->each(function ($studentProject) {
                    // Delete all related student groups
                    $studentProject->studentGroups->each(function ($studentGroup) {
                        $studentGroup->delete();
                    });
    
                    // Delete all related project images
                    $studentProject->projectImages->each(function ($projectImage) {
                        $projectImage->delete();
                    });
    
                    // Delete the student project itself
                    $studentProject->delete();
                });
    
                // Delete the project itself
                $project->delete();
            });
    
            // Delete the LecturerMK record
            $lecturerMK->delete();
        });
    
        // Finally, delete the lecturer
        $lecturer->delete();
    
        // Redirect with a success message
        return redirect()->route('admin.lecturer.log')->with('success', 'Lecturer and all related records deleted successfully!');
    }    

    public function showStudentProjectDetails($id)
    {
        // Fetch the student project with necessary relationships
        $studentProject = StudentProject::with(['projectImages', 'studentGroups.students'])
            ->findOrFail($id);

        // Pass the project to the view
        return view('admin.studentprojectdetails', [
            'title' => $studentProject->sptitle,
            'studentProject' => $studentProject,
        ]);
    }

    public function showProjectDetails($id)
    {
        // Fetch the project with its student projects
        $project = Project::with(['studentProjects.projectImages', 'studentProjects.studentGroups.students'])
                        ->findOrFail($id);

        return view('admin.projectdetails', [
            'title' => 'Project Details',
            'project' => $project,
        ]);
    }

    public function editProject($id)
    {
        $project = Project::findOrFail($id);

        return view('admin.projectedit', compact('project'));
    }

    public function updateProject(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'projectname' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|max:50',
            'type' => 'required|string|max:50',
            'projectimage' => 'nullable|url',
            'visibility' => 'required|boolean',
        ]);

        // Find the project
        $project = Project::findOrFail($id);

        // Update the project's details
        $project->update([
            'projectname' => $request->input('projectname'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'type' => $request->input('type'),
            'projectimage' => $request->input('projectimage'),
            'visibility' => $request->input('visibility'),
        ]);

        return redirect()
        ->route('gueststudentprojects.show', ['id' => $id])
        ->with('success', 'Project updated successfully!');
    }

    public function destroyProject($id)
    {
        // Fetch the project by ID
        $project = Project::with(['studentProjects.projectImages', 'studentProjects.studentGroups'])->findOrFail($id);

        // Cascade delete related student projects
        foreach ($project->studentProjects as $studentProject) {
            // Delete related project images
            $studentProject->projectImages()->delete();

            // Delete related student groups
            $studentProject->studentGroups()->delete();

            // Delete the student project itself
            $studentProject->delete();
        }

        // Finally, delete the project
        $project->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Project deleted successfully!');
    }

    public function createProject($courseId)
    {
        return view('admin.addproject', ['courseId' => $courseId]);
    }

    public function storeProject(Request $request)
    {
        $validated = $request->validate([
            'projectname' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:AFL1,AFL2,AFL3,ALP',
            'projectimage' => 'nullable|url',
            'visibility' => 'required|boolean',
            'lmk_id' => 'required|exists:lecturer_mks,id',
        ]);

        $validated['status'] = 'Finished'; // Default to Finished
        Project::create($validated);

        return redirect()->route('guestcoursedetail.show', $validated['lmk_id'])
                        ->with('success', 'Project added successfully!');
    }

    public function createStudentProject($project_id)
    {
        $project = Project::findOrFail($project_id); // Fetch the project
        $students = Student::orderBy('studentname', 'asc')->get(); // Fetch all students

        return view('admin.studentprojectcreate', compact('project', 'students'));
    }

    public function storeStudentProject(Request $request)
    {
        // Validate input
        $request->validate([
            'sptitle' => 'required|string|max:255',
            'sp_description' => 'nullable|string',
            'file_type' => 'required|string|max:50',
            'project_id' => 'required|exists:projects,id',
            'visibility' => 'required|boolean',
            'image_urls' => 'nullable|array',
            'image_urls.*' => 'nullable|url',
            'groupname' => 'required|string|max:255',
            'students' => 'required|array|min:1',
            'students.*' => 'exists:students,id',
        ]);
    
        // Create the student project
        $studentProject = StudentProject::create([
            'sptitle' => $request->sptitle,
            'sp_description' => $request->sp_description,
            'file_type' => $request->file_type,
            'project_id' => $request->project_id,
            'visibility' => $request->visibility,
        ]);
    
        // Create the group and attach students
        $group = $studentProject->studentGroups()->create([
            'groupname' => $request->groupname,
        ]);
        $group->students()->attach($request->students);
    
        // Add images
        if ($request->image_urls) {
            foreach ($request->image_urls as $url) {
                if (!empty($url)) {
                    $studentProject->projectImages()->create(['imageurl' => $url]);
                }
            }
        }
    
        return redirect()
        ->route('gueststudentprojects.show', ['id' => $studentProject->project_id])
        ->with('success', 'Student Project created successfully!');
    }

    public function editCourse($id)
    {
        $course = LecturerMK::findOrFail($id); // Fetch the course
        return view('admin.editcourse', compact('course'));
    }

    public function updateCourse(Request $request, $id)
    {
        $request->validate([
            'tahun' => 'required|integer|min:1900|max:' . date('Y'),
            'semester' => 'required|string|max:255',
            'lmk_status' => 'nullable|string|max:255',
            'lmk_image' => 'nullable|url',
            'additional_lecturers' => 'nullable|string|max:255',
            'visibility' => 'required|boolean',
        ]);

        $course = LecturerMK::findOrFail($id);
        $course->update([
            'tahun' => $request->input('tahun'),
            'semester' => $request->input('semester'),
            'lmk_status' => $request->input('lmk_status'),
            'lmk_image' => $request->input('lmk_image'),
            'additional_lecturers' => $request->input('additional_lecturers'),
            'visibility' => $request->input('visibility'),
        ]);

        return redirect()
            ->route('guestcoursedetail.show', ['id' => $id])
            ->with('success', 'Course updated successfully!');
    }

    public function destroyCourse($id)
    {
        $course = LecturerMK::findOrFail($id);

        // Delete related projects and other dependencies before deleting the course
        $course->projects()->each(function ($project) {
            $project->studentProjects()->each(function ($studentProject) {
                $studentProject->projectImages()->delete();
                $studentProject->studentGroups()->delete();
                $studentProject->delete();
            });
            $project->delete();
        });

        $course->delete();

        return redirect()
            ->route('guestcourses.index')
            ->with('success', 'Course deleted successfully!');
    }

    public function createCourse($lecturerId)
    {
        $lecturer = Lecturer::findOrFail($lecturerId);
        $matakuliah = MataKuliah::orderBy('namamk', 'asc')->get();

        return view('admin.addcourse', compact('lecturer', 'matakuliah'));
    }
    
    public function storeCourse(Request $request)
    {
        $request->validate([
            'mk_id' => 'required|exists:mata_kuliahs,id',
            'tahun' => 'required|string',
            'semester' => 'required|string',
            'lmk_status' => 'required|in:Ongoing,Finished',
            'lmk_image' => 'nullable|url',
            'additional_lecturers' => 'nullable|string',
            'visibility' => 'required|boolean',
            'lecturer_id' => 'required|exists:lecturers,id',
        ]);
    
        LecturerMK::create([
            'lecturer_id' => $request->lecturer_id,
            'mk_id' => $request->mk_id,
            'tahun' => $request->tahun,
            'semester' => $request->semester,
            'lmk_status' => $request->lmk_status,
            'lmk_image' => $request->lmk_image,
            'additional_lecturers' => $request->additional_lecturers,
            'visibility' => $request->visibility,
        ]);
    
        return redirect()
            ->route('admin.lecturer.details', $request->lecturer_id)
            ->with('success', 'Course added successfully.');
    }

    public function createStudent()
    {
        return view('admin.addstudent');
    }

    public function storeStudent(Request $request)
    {
        $validatedData = $request->validate([
            'studentname' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'password' => 'required|string|min:6',
            'nim' => 'required|string|max:50|unique:students,nim',
            'pfp' => 'nullable|url',
        ]);

        Student::create([
            'studentname' => $validatedData['studentname'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'nim' => $validatedData['nim'],
            'pfp' => $validatedData['pfp'] ?? null,
        ]);

        return redirect()
            ->route('admin.students.log')
            ->with('success', 'Student added successfully.');
    }

    public function createLecturer()
    {
        return view('admin.addlecturer');
    }

    public function storeLecturer(Request $request)
    {
        // Validate input
        $validatedData = $request->validate([
            'lecturername' => 'required|string|max:255',
            'email' => 'required|email|unique:lecturers,email',
            'password' => 'required|string|min:6',
            'pfp' => 'nullable|url',
            'employeenumber' => 'required|string|unique:lecturers,employeenumber',
        ]);

        // Create the lecturer
        Lecturer::create([
            'lecturername' => $validatedData['lecturername'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']), // Hash the password
            'pfp' => $validatedData['pfp'] ?? null, // Profile picture URL
            'employeenumber' => $validatedData['employeenumber'],
        ]);

        // Redirect to the lecturers log
        return redirect()
            ->route('admin.lecturer.log')
            ->with('success', 'Lecturer added successfully.');
    }

    public function createMatakuliah(Lecturer $lecturer)
    {
        return view('admin.addmatakuliah', compact('lecturer'));
    }
    

    public function storeMatakuliah(Request $request)
    {
        $validated = $request->validate([
            'namamk' => 'required|string|max:255',
            'description' => 'nullable|string',
            'tahun' => 'required|string|max:255',
            'semester' => 'required|string|max:255',
            'lmk_status' => 'required|in:Ongoing,Finished',
            'lmk_image' => 'nullable|url',
            'additional_lecturers' => 'nullable|string|max:255',
            'visibility' => 'required|boolean',
            'lecturer_id' => 'required|exists:lecturers,id',
        ]);

        // Create the MataKuliah with placeholder images
        $mataKuliah = MataKuliah::create([
            'namamk' => $validated['namamk'],
            'description' => $validated['description'],
            'smallimage' => 'https://via.placeholder.com/640x480.png/0011cc?text=project+Image+voluptatem',
            'longimage' => 'https://via.placeholder.com/1280x720.png/0011cc?text=course+Banner+voluptatem',
        ]);

        // Create the LecturerMK for the lecturer
        LecturerMK::create([
            'lecturer_id' => $validated['lecturer_id'],
            'mk_id' => $mataKuliah->id,
            'tahun' => $validated['tahun'],
            'semester' => $validated['semester'],
            'lmk_status' => $validated['lmk_status'],
            'lmk_image' => $validated['lmk_image'],
            'additional_lecturers' => $validated['additional_lecturers'],
            'visibility' => $validated['visibility'],
        ]);

        return redirect()
            ->route('admin.lecturer.details', $validated['lecturer_id'])
            ->with('success', 'Course and MataKuliah added successfully.');
    }

    public function createCourseAdmin()
    {
        return view('admin.coursecreate'); // Placeholder view
    }



}

