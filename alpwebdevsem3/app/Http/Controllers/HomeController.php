<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class homeController extends Controller
{
    // public function index()
    // {
    //     // Fetch ongoing projects
    //     $student = view()->shared('student');
    //     if (!$student) {
    //         return redirect()->route('login')->with('error', 'Student not found.');
    //     }
    //     $projects = Project::where('status', 'ongoing')->with('studentProjects')->get();


    //     $studentGroups = $student->studentGroups()->with('studentProject.project.lecturerMK.mataKuliah')->get();

    //     $ongoingProjects = [];

    //     foreach ($studentGroups as $group) {
    //         // Ensure the studentProject relationship exists
    //         $studentProject = $group->studentProject;
    //         if (!$studentProject || !$studentProject->project) {
    //             continue; // Skip if no project found
    //         }

    //         $project = $studentProject->project;
    //         $lecturerMK = $project->lecturerMK;

    //         // Prepare project data with ID included
    //         $projectData = [
    //             'id' => $studentProject->id, // Include ID here
    //             'title' => $studentProject->sptitle,
    //             'projectname' => $project->projectname, // Actual project name
    //             'type' => $project->type,
    //             'coursename' => $lecturerMK->mataKuliah->namamk ?? 'Unknown',
    //             'tahun' => $lecturerMK->tahun ?? 'Unknown', // tahun from LecturerMK
    //             'image_url' => $project->projectimage ?? null, // Add placeholder logic if needed
    //         ];

    //         if ($project->status === 'Ongoing') {
    //             $ongoingProjects[] = $projectData;
    //         }
    //     }



    //     return view('home', [
    //         'title' => 'Home',
    //         'projects' => $projects,
    //     ]);
    // }


    public function index()
    {
    // Fetch the globally shared student variable
    $student = view()->shared('student');

    // Ensure student exists (in case middleware doesn't set it properly)
    if (!$student) {
        return redirect()->route('login')->with('error', 'Student not found.');
    }

    // Fetch all student groups associated with the student
    $studentGroups = $student->studentGroups()->with('studentProject.project.lecturerMK.mataKuliah')->get();

    // Initialize arrays for categorizing projects
    $ongoingProjects = [];


    foreach ($studentGroups as $group) {
        // Ensure the studentProject relationship exists
        $studentProject = $group->studentProject;
        if (!$studentProject || !$studentProject->project) {
            continue; // Skip if no project found
        }

        $project = $studentProject->project;
        $lecturerMK = $project->lecturerMK;

        // Prepare project data with ID included
        $projectData = [
            'id' => $studentProject->id, // Include ID here
            'title' => $studentProject->sptitle, // Actual project title from StudentProject
            'projectname' => $project->projectname, // Actual project name from Project
            'type' => $project->type,
            'spdescription' => $studentProject->sp_description, // Actual project desc from StudentProject
            // 'description' => $project->description, // Actual project desc from Project uncomment if needed
            'coursename' => $lecturerMK->mataKuliah->namamk ?? 'Unknown',
            'tahun' => $lecturerMK->tahun ?? 'Unknown', // tahun from LecturerMK
            'image_url' => $project->projectimage ?? null, // Add placeholder logic if needed
        ];

        if ($project->status === 'Ongoing') {
            $ongoingProjects[] = $projectData;
        }
    }

    return view('home', [
        'title' => 'Home',
        'ongoingProjects' => $ongoingProjects,
    ]);
    }
}
