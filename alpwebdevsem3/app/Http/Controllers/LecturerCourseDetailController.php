<?php

namespace App\Http\Controllers;

use App\Models\LecturerMK;
use Illuminate\Http\Request;

class LecturerCourseDetailController extends Controller
{
    public function show($id)
    {
        // Fetch the LecturerMK class with deep nested relationships including the students through student groups
        $lecturerMK = LecturerMK::with([
            'mataKuliah',
            'lecturer',
            'projects.studentProjects.studentGroups.students'
        ])->findOrFail($id);

        // Check if the class is ongoing
        $isOngoing = $lecturerMK->lmk_status === 'Ongoing';

        // Initialize an empty collection to store unique students
        $uniqueStudents = collect();

        // Fetch all projects and their nested studentProjects, then studentGroups, and then students
        foreach ($lecturerMK->projects as $project) {
            foreach ($project->studentProjects as $studentProject) {
                foreach ($studentProject->studentGroups as $studentGroup) {
                    foreach ($studentGroup->students as $student) {
                        // Use the student ID as a unique key to prevent duplicates
                        $uniqueStudents[$student->id] = [
                            'name' => $student->studentname,
                            'nim' => $student->nim
                        ];
                    }
                }
            }
        }

        // Convert the unique student collection into a regular array for passing to view
        $students = array_values($uniqueStudents->all());

        // Fetch all projects directly linked to this LecturerMK
        $projects = [];
        foreach ($lecturerMK->projects as $project) {
            $projects[] = [
                'id' => $project->id, // Project ID for the detail page
                'project_name' => $project->projectname, // Project name
                'type' => $project->type, // Project type
                'image_url' => $project->projectimage ?? 'https://placehold.co/300x200', // Project image or placeholder
            ];
        }

        // Pass data to the view
        return view('lecturercoursedetail', [
            'title' => $lecturerMK->mataKuliah->namamk ?? 'Course Detail',
            'lecturerMK' => $lecturerMK,
            'students' => $students,
            'projects' => $projects,
            'isOngoing' => $isOngoing,
        ]);
    }
}


// namespace App\Http\Controllers;

// use App\Models\LecturerMK;
// use Illuminate\Http\Request;

// class LecturerCourseDetailController extends Controller
// {
//     public function show($id)
//     {
//         // Fetch the LecturerMK class with relationships
//         $lecturerMK = LecturerMK::with(['mataKuliah', 'lecturer', 'projects'])->findOrFail($id);

//         // Check if the class is ongoing
//         $isOngoing = $lecturerMK->lmk_status === 'Ongoing';

//         // Fetch all projects directly linked to this LecturerMK
//         $projects = [];
//         foreach ($lecturerMK->projects as $project) {
//             $projects[] = [
//                 'id' => $project->id, // Project ID for the detail page
//                 'project_name' => $project->projectname, // Project name
//                 'type' => $project->type, // Project type
//                 'image_url' => $project->projectimage ?? 'https://placehold.co/300x200', // Project image or placeholder
//             ];
//         }

//         // Pass data to the view
//         return view('lecturercoursedetail', [
//             'title' => $lecturerMK->mataKuliah->namamk ?? 'Course Detail',
//             'lecturerMK' => $lecturerMK,
//             'projects' => $projects,
//             'isOngoing' => $isOngoing,
//         ]);
//     }
// }
