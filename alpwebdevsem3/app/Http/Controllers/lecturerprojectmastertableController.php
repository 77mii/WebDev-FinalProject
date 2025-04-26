<?php

// namespace App\Http\Controllers;

// use App\Models\Project;
// use Illuminate\Http\Request;
// use App\Models\LecturerMK;

// class lecturerprojectmastertableController extends Controller
// {

//     public function index()
//     {
//         $lecturer = view()->shared('lecturer');

//         if (!$lecturer) {
//             return redirect()->route('login')->with('error', 'Lecturer not found.');
//         }

//         $lecturerMKs = LecturerMK::with('mataKuliah')
//         ->where('lecturer_id', $lecturer->id)
//         ->get();

//         $Courses = [];

//         foreach ($lecturerMKs as $lecturerMK) {
//             foreach ($lecturerMK->projects  as $project) {
//                 foreach ($project->studentProjects as $studentProject) {
//                     foreach ($studentProject->studentGroups as $studentGroup) {
//                         // Course Data
//                         $courseData = [
//                             'id' => $lecturerMK->id,
//                             'class_name' => $lecturerMK->mataKuliah->namamk ?? 'Unknown Class',
//                             'program_name' => $lecturerMK->mataKuliah->namaprodi ?? 'Unknown Program',
//                             'year' => $lecturerMK->tahun ?? 'N/A',
//                             'group_name' => $studentGroup->groupname ?? 'Unknown Group',
//                             'project_name' => $project->projectname ?? 'Unknown Project',
//                             'type' => $project->type ?? 'Unknown Type',
//                             'status' => $project->status ?? 'Unknown Status',
//                             'sptitle' => $studentProject->sptitle ?? 'Unknown Title',
//                         ];

//                         $Courses[] = $courseData;
//                     }
//                 }
//             }
//         }
//         return view('lecturerprojectmastertable', [
//             'title' => 'Your Current Courses',
//             'Courses' => $Courses,
//         ]);
//     }
// }




namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\LecturerMK;

class lecturerprojectmastertableController extends Controller
{
    public function index()
    {
        $lecturer = view()->shared('lecturer');

        if (!$lecturer) {
            return redirect()->route('login')->with('error', 'Lecturer not found.');
        }

        $lecturerMKs = LecturerMK::with(['mataKuliah', 'projects.studentProjects.studentGroups'])
            ->where('lecturer_id', $lecturer->id)
            ->get();

        // Debugging: Check the retrieved data
        if ($lecturerMKs->isEmpty()) {
            dd('No LecturerMK records found for this lecturer.');
        }

        $Courses = [];

        foreach ($lecturerMKs as $lecturerMK) {
            foreach ($lecturerMK->projects as $project) {
                foreach ($project->studentProjects as $studentProject) {
                    foreach ($studentProject->studentGroups as $studentGroup) {
                        // Course Data
                        $courseData = [
                            'id' => $lecturerMK->id,
                            'class_name' => $lecturerMK->mataKuliah->namamk ?? 'Unknown Class',
                            'program_name' => $lecturerMK->mataKuliah->namaprodi ?? 'Unknown Program',
                            'year' => $lecturerMK->tahun ?? 'N/A',
                            'group_name' => $studentGroup->groupname ?? 'Unknown Group',
                            'project_name' => $project->projectname ?? 'Unknown Project',
                            'type' => $project->type ?? 'Unknown Type',
                            'status' => $project->status ?? 'Unknown Status',
                            'sptitle' => $studentProject->sptitle ?? 'Unknown Title',
                            'student_project_id' => $studentProject->id, // Add this line
                        ];

                        $Courses[] = $courseData;
                    }
                }
            }
        }
        // Debugging: Check the Courses array
        if (empty($Courses)) {
            dd('No courses found.', $lecturerMKs->toArray());
        }

        return view('lecturerprojectmastertable', [
            'title' => 'Your Current Courses',
            'Courses' => $Courses,
        ]);
    }
}
