<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LecturerMK;
use App\Models\Project;
use App\Models\Lecturer;
use App\Models\Student;
use App\Models\StudentProject;

class GuestController extends Controller
{
    public function index()
    {
        // Fetch 5 random student projects with related data
        $studentProjects = StudentProject::with(['project.lecturerMK.mataKuliah', 'studentGroups'])->inRandomOrder()->limit(5)->get();

        return view('guest', [
            'title' => 'Welcome to the Project Portal',
            'studentProjects' => $studentProjects,
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $studentProjects = StudentProject::where('sptitle', 'LIKE', "%{$query}%")
            ->with(['project.lecturerMK.mataKuliah', 'studentGroups'])
            ->get();

        return view('guest', [
            'title' => 'Search Results',
            'studentProjects' => $studentProjects,
        ]);
    }

    public function search2(Request $request)
    {
        $query = $request->input('query');
        
        // Fetch matching student projects
        $studentProjects = StudentProject::where('sptitle', 'LIKE', "%{$query}%")
            ->with(['project.lecturerMK.mataKuliah', 'studentGroups'])
            ->get();
    
        // Return the guestprojects view with the search results
        return view('guestprojects', [
            'title' => 'Search Results',
            'studentProjects' => $studentProjects,
        ]);
    }
    
    

    public function filter(Request $request)
    {
        $filter = $request->input('filter');
        $order = $request->input('order', 'asc'); // Default to ascending order
    
        $studentProjects = StudentProject::query()
            ->with(['project.lecturerMK.mataKuliah', 'studentGroups']) // Load related data for display
            ->join('projects', 'student_projects.project_id', '=', 'projects.id')
            ->join('lecturer_mks', 'projects.lmk_id', '=', 'lecturer_mks.id')
            ->leftJoin('mata_kuliahs', 'lecturer_mks.mk_id', '=', 'mata_kuliahs.id')
            ->when($filter == 'title', function ($query) use ($order) {
                return $query->orderBy('student_projects.sptitle', $order);
            })
            ->when($filter == 'semester', function ($query) use ($order) {
                return $query->orderBy('lecturer_mks.semester', $order);
            })
            ->when($filter == 'year', function ($query) use ($order) {
                return $query->orderBy('lecturer_mks.tahun', $order);
            })
            ->when($filter == 'course', function ($query) use ($order) {
                return $query->orderBy('mata_kuliahs.namamk', $order);
            })
            ->select('student_projects.*') // Ensure only StudentProject fields are selected
            ->get();
    
        return view('guestprojects', [
            'title' => 'Filtered Results',
            'studentProjects' => $studentProjects,
        ]);
    }

    public function searchCourses(Request $request)
    {
        $query = $request->input('query');
    
        // Search for courses based on the course name (namamk) in MataKuliah
        $courses = LecturerMK::with('mataKuliah')
            ->whereHas('mataKuliah', function ($q) use ($query) {
                $q->where('namamk', 'LIKE', "%{$query}%");
            })
            ->get();
    
        return view('guestcourses', [
            'title' => 'Search Results',
            'courses' => $courses,
        ]);
    }
    

    public function getFilterOptions()
    {
        // Get distinct semesters, years, and courses
        $semesters = LecturerMK::distinct('semester')->pluck('semester');
        $years = LecturerMK::distinct('tahun')->pluck('tahun');
        $courses = MataKuliah::distinct('namamk')->pluck('namamk');

        return response()->json([
            'semesters' => $semesters,
            'years' => $years,
            'courses' => $courses,
        ]);
    }
    

    public function showStudentProject($id)
    {
        // Fetch the student project with necessary relationships
        $studentProject = StudentProject::with([
            'project.lecturerMK.mataKuliah',  // For course name, semester, and year
            'project.lecturerMK.lecturer',   // For lecturer name
            'projectImages',                 // For associated images
            'studentGroups.students'         // For group members
        ])->findOrFail($id);

        // Prepare the big image (first image or placeholder)
        $bigImage = $studentProject->projectImages->first()?->imageurl ?? 'https://placehold.co/1200x400';

        // Get additional data from relationships
        $matakuliahName = $studentProject->project->lecturerMK->mataKuliah->namamk ?? 'Unknown Course';
        $semester = $studentProject->project->lecturerMK->semester ?? 'Unknown Semester';
        $tahun = $studentProject->project->lecturerMK->tahun ?? 'Unknown Year';
        $lecturerName = $studentProject->project->lecturerMK->lecturer->lecturername ?? 'Unknown Lecturer';

        // Prepare data for the view
        return view('gueststudentprojectdetail', [
            'title' => $studentProject->sptitle . ' Details', // Add "Details" to the title
            'studentProject' => $studentProject,
            'bigImage' => $bigImage,
            'matakuliahName' => $matakuliahName,
            'semester' => $semester,
            'tahun' => $tahun,
            'lecturerName' => $lecturerName,
            'images' => $studentProject->projectImages,
            'groupMembers' => $studentProject->studentGroups->flatMap->students,
        ]);
    }

    // public function getAllStudentProjects()
    // {
    //     // Fetch all student projects with related data
    //     $studentProjects = StudentProject::with(['project.lecturerMK.mataKuliah', 'studentGroups'])->inRandomOrder()->get();

    //     return view('guestprojects', [
    //         'title' => 'All Projects',
    //         'studentProjects' => $studentProjects,
    //     ]);
    // }
    public function getAllStudentProjects()
    {
        // Fetch all visible student projects with related data
        $studentProjects = StudentProject::with(['project.lecturerMK.mataKuliah', 'studentGroups'])
            ->where('visibility', 1) // Ensure only visible projects are fetched
            ->inRandomOrder()
            ->get();

        return view('guestprojects', [
            'title' => 'All Projects',
            'studentProjects' => $studentProjects,
        ]);
    }

    public function getAllCourses()
    {
        // Fetch all visible courses with related data in random order
        $courses = LecturerMK::with(['mataKuliah', 'lecturer'])
            ->where('visibility', 1) // Ensure only visible courses are fetched
            ->inRandomOrder()
            ->get();
    
        return view('guestcourses', [
            'title' => 'All Courses',
            'courses' => $courses,
        ]);
    }

    public function getCourseDetail($id)
    {
        // Fetch the course with related data
        $course = LecturerMK::with(['mataKuliah', 'lecturer', 'projects.studentProjects'])
            ->findOrFail($id);

        return view('guestcoursedetail', [
            'title' => 'Course Detail',
            'course' => $course,
        ]);
    }

    public function showAllStudentProjectCourse($id)
    {
        // Fetch the project with related student projects based on course
        $project = Project::with('studentProjects.projectImages', 'studentProjects.studentGroups.students')
            ->findOrFail($id);

            return view('gueststudentprojects', [
                'title' => $project->projectname . ' - ' . $project->type, // Combine projectname and type
                'project' => $project,
            ]);
    }

    public function getAllLecturers()
    {
        // Fetch all lecturers in random order
        $lecturers = Lecturer::inRandomOrder()->get();

        return view('guestlecturers', [
            'title' => 'All Lecturers',
            'lecturers' => $lecturers,
        ]);
    }

    public function getLecturerDetails($id)
    {
        // Fetch the lecturer with related data
        $lecturer = Lecturer::with('lecturerMKs.mataKuliah')->findOrFail($id);

        return view('guestlecturerdetail', [
            'title' => 'Lecturer Detail',
            'lecturer' => $lecturer,
        ]);
    }

    public function showStudentDetails($id)
    {
        // Fetch the student with related data
        $student = Student::with('studentGroups.studentProject')->findOrFail($id);

        return view('gueststudentdetails', [
            'title' => 'Student Detail',
            'student' => $student,
        ]);
    }

    public function getStudents()
    {
        // Fetch all students in random order
        $students = Student::inRandomOrder()->get();

        return view('gueststudents', [
            'title' => 'All Students',
            'students' => $students,
        ]);
    }
}
