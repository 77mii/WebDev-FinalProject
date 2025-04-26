<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentGroup;
use App\Models\Lecturer;
use App\Models\StudentProject;
use App\Models\LecturerMK;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a view with student data.
     */
    public function show($id)
    {
        $student = Student::findOrFail($id); // Find student by ID, or fail if not found

        return view('dashboard', [
            'title' => 'Dashboard',
            'student' => $student, // Pass the student data to the view
        ]);
    }

    public function showAccount()
    {
        $student = Auth::guard('student')->user();

        return view('student.account', compact('student'));
    }

    public function updateAccount(Request $request)
    {
        $student = Auth::guard('student')->user();

        $request->validate([
            'studentname' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'nim' => 'required|string|max:20|unique:students,nim,' . $student->id,
            'pfp' => 'nullable|url',
            'password' => 'nullable|confirmed|min:8',
        ]);

        $student->update([
            'studentname' => $request->studentname,
            'email' => $request->email,
            'nim' => $request->nim,
            'pfp' => $request->pfp,
            'password' => $request->password ? Hash::make($request->password) : $student->password,
        ]);

        return redirect()->route('student.account')->with('success', 'Account updated successfully!');
    }

    public function editAccount()
    {
        $student = Auth::guard('student')->user();
        return view('student.accountedit', compact('student'));
    }

    public function createStudentProject($project_id)
    {
        $project = Project::findOrFail($project_id);
        $loggedInStudent = Auth::guard('student')->user();
        $students = Student::orderBy('studentname', 'asc')->get();
    
        return view('student.studentprojectcreate', compact('project', 'loggedInStudent', 'students'));
    }
    
    public function storeStudentProject(Request $request)
    {
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
    
        $loggedInStudent = Auth::guard('student')->user();
        if (!in_array($loggedInStudent->id, $request->students)) {
            $request->merge([
                'students' => array_merge($request->students, [$loggedInStudent->id]),
            ]);
        }
    
        $studentProject = StudentProject::create([
            'sptitle' => $request->sptitle,
            'sp_description' => $request->sp_description,
            'file_type' => $request->file_type,
            'project_id' => $request->project_id,
            'visibility' => $request->visibility,
        ]);
    
        $group = $studentProject->studentGroups()->create([
            'groupname' => $request->groupname,
        ]);
        $group->students()->attach($request->students);
    
        if ($request->image_urls) {
            foreach ($request->image_urls as $url) {
                if (!empty($url)) {
                    $studentProject->projectImages()->create(['imageurl' => $url]);
                }
            }
        }
    
        return redirect()
            ->route('gueststudentprojects.show', ['id' => $studentProject->project_id])
            ->with('success', 'Student Project added successfully!');
    }

    public function editStudentProject($id)
    {
        $studentProject = StudentProject::with('studentGroups.students')->findOrFail($id);
    
        // Check if the logged-in student is part of the project
        $loggedInStudent = Auth::guard('student')->user();
        $isInProject = $studentProject->studentGroups->pluck('students')->flatten()->contains('id', $loggedInStudent->id);
    
        if (!$isInProject) {
            abort(403, 'Unauthorized access.');
        }
    
        return view('student.studentprojectedit', compact('studentProject'));
    }
    
    public function updateStudentProject(Request $request, $id)
    {
        $request->validate([
            'sptitle' => 'required|string|max:255',
            'sp_description' => 'nullable|string',
            'visibility' => 'required|boolean',
            'image_urls' => 'nullable|array',
            'image_urls.*' => 'nullable|url',
        ]);
    
        $studentProject = StudentProject::with('projectImages')->findOrFail($id);
    
        // Check if the logged-in student is part of the project
        $loggedInStudent = Auth::guard('student')->user();
        $isInProject = $studentProject->studentGroups->pluck('students')->flatten()->contains('id', $loggedInStudent->id);
    
        if (!$isInProject) {
            abort(403, 'Unauthorized access.');
        }
    
        $studentProject->update([
            'sptitle' => $request->input('sptitle'),
            'sp_description' => $request->input('sp_description'),
            'visibility' => $request->input('visibility'),
        ]);
    
        // Handle images
        $existingImageUrls = $studentProject->projectImages->pluck('imageurl')->toArray();
        $newImageUrls = $request->input('image_urls', []);
    
        $imagesToDelete = array_diff($existingImageUrls, $newImageUrls);
        $imagesToAdd = array_diff($newImageUrls, $existingImageUrls);
    
        foreach ($imagesToDelete as $url) {
            $studentProject->projectImages()->where('imageurl', $url)->delete();
        }
    
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
    
        // Check if the logged-in student is part of the project
        $loggedInStudent = Auth::guard('student')->user();
        $isInProject = $studentProject->studentGroups->pluck('students')->flatten()->contains('id', $loggedInStudent->id);
    
        if (!$isInProject) {
            abort(403, 'Unauthorized access.');
        }
    
        $studentProject->projectImages()->delete();
        $studentProject->studentGroups()->delete();
        $studentProject->delete();
    
        return redirect()
            ->route('gueststudentprojects.show', $studentProject->project_id)
            ->with('success', 'Student project deleted successfully.');
    }

    public function yourProjects()
    {
        // Fetch the logged-in student
        $student = Auth::guard('student')->user();
    
        // Get all student projects associated with this student
        $studentProjects = $student->studentGroups()
            ->with('studentProject.project.lecturerMK.mataKuliah') // Correct relationship chain
            ->get()
            ->pluck('studentProject') // Use singular 'studentProject' relationship
            ->filter(); // Remove any null projects
    
        return view('student.yourprojects', [
            'title' => 'Your Projects',
            'studentProjects' => $studentProjects,
        ]);
    }
    

    
}
