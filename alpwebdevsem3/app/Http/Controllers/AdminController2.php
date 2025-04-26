<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use App\Models\MataKuliah;
use App\Models\LecturerMK;
use App\Models\Student;
use App\Models\StudentProject;
use App\Models\StudentGroup;
use App\Models\ProjectImage;
use App\Models\Project;
use Illuminate\Http\Request;

class AdminController2 extends Controller
{
    /**
     * Show form to add a new course (LecturerMK) with lecturer selection.
     */
    public function createCourseAdmin2()
    {
        $lecturers = Lecturer::orderBy('lecturername', 'asc')->get();
        $matakuliah = MataKuliah::orderBy('namamk', 'asc')->get();

        return view('admin.addcourse2', compact('lecturers', 'matakuliah'));
    }

    /**
     * Store a new course (LecturerMK) with lecturer and MataKuliah association.
     */
    public function storeLecturermkWithLecturer2(Request $request)
    {
        $validatedData = $request->validate([
            'lecturer_id' => 'required|exists:lecturers,id',
            'mk_id' => 'required|exists:mata_kuliahs,id',
            'tahun' => 'required|string',
            'semester' => 'required|string',
            'lmk_status' => 'required|in:Ongoing,Finished',
            'lmk_image' => 'nullable|url',
            'additional_lecturers' => 'nullable|string',
            'visibility' => 'required|boolean',
        ]);

        LecturerMK::create($validatedData);

        return redirect()->route('guestcourses.index')
        ->with('success', 'Course added successfully!');
    }

    /**
     * Show form to add a new MataKuliah with lecturer association.
     */
    public function createMatakuliah2()
    {
        $lecturers = Lecturer::orderBy('lecturername', 'asc')->get();

        return view('admin.addmatakuliah2', compact('lecturers'));
    }

    /**
     * Store a new MataKuliah and optionally associate it with a LecturerMK.
     */
    public function storeMatakuliah2(Request $request)
    {
        $validatedData = $request->validate([
            'namamk' => 'required|string|max:255',
            'description' => 'nullable|string',
            'lecturer_id' => 'required|exists:lecturers,id',
            'tahun' => 'required|string',
            'semester' => 'required|string',
            'lmk_status' => 'required|in:Ongoing,Finished',
            'lmk_image' => 'nullable|url',
            'additional_lecturers' => 'nullable|string',
            'visibility' => 'required|boolean',
        ]);

        $matakuliah = MataKuliah::create([
            'namamk' => $validatedData['namamk'],
            'description' => $validatedData['description'],
            'smallimage' => 'https://via.placeholder.com/640x480.png/0011cc?text=project+Image+voluptatem',
            'longimage' => 'https://via.placeholder.com/640x480.png/0011cc?text=project+Image+voluptatem',
        ]);

        LecturerMK::create([
            'lecturer_id' => $validatedData['lecturer_id'],
            'mk_id' => $matakuliah->id,
            'tahun' => $validatedData['tahun'],
            'semester' => $validatedData['semester'],
            'lmk_status' => $validatedData['lmk_status'],
            'lmk_image' => $validatedData['lmk_image'],
            'additional_lecturers' => $validatedData['additional_lecturers'],
            'visibility' => $validatedData['visibility'],
        ]);

        return redirect()->route('guestcourses.index')
        ->with('success', 'MataKuliah and Course added successfully!');
    }

    public function createStudentProjectWithLecturerMK()
    {
        // Fetch all LecturerMKs and Students for selection
        $lecturerMKs = LecturerMK::with(['mataKuliah', 'lecturer'])->get();
        $students = Student::orderBy('studentname')->get();

        return view('admin.addstudentproject2', compact('lecturerMKs', 'students'));
    }

    public function storeStudentProjectWithLecturerMK(Request $request)
    {
        $validatedData = $request->validate([
            'lecturermk_id' => 'required|exists:lecturer_mks,id',
            'sptitle' => 'required|string|max:255',
            'sp_description' => 'nullable|string',
            'file_type' => 'required|string|max:255',
            'project_id' => 'required|exists:projects,id',
            'visibility' => 'required|boolean',
            'image_urls' => 'nullable|array',
            'image_urls.*' => 'url',
            'groupname' => 'required|string|max:255',
            'students' => 'nullable|array',
            'students.*' => 'exists:students,id',
        ]);
    
        // Create the StudentProject
        $studentProject = StudentProject::create([
            'sptitle' => $validatedData['sptitle'],
            'sp_description' => $validatedData['sp_description'],
            'file_type' => $validatedData['file_type'],
            'project_id' => $validatedData['project_id'],
            'visibility' => $validatedData['visibility'],
        ]);
    
        // Create the Group and Associate Students
        $group = $studentProject->studentGroups()->create([
            'groupname' => $validatedData['groupname'],
        ]);
    
        if (!empty($validatedData['students'])) {
            $group->students()->attach($validatedData['students']);
        }
    
        // Add Images
        if (!empty($validatedData['image_urls'])) {
            foreach ($validatedData['image_urls'] as $url) {
                if (!empty($url)) {
                    $studentProject->projectImages()->create([
                        'imageurl' => $url,
                    ]);
                }
            }
        }
    
        // Redirect to guestprojects
        return redirect()
            ->route('guestprojects.index')
            ->with('success', 'Student Project created successfully!');
    }
    
    
    public function getProjectsByLecturerMK($lmk_id)
    {
        $projects = Project::where('lmk_id', $lmk_id)->get();
    
        if ($projects->isEmpty()) {
            return response()->json(['error' => 'No projects found for this LecturerMK.'], 404);
        }
    
        return response()->json($projects);
    }
    

}
