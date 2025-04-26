<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentProjectsController extends Controller
{

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
    $completedProjects = [];

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
            'title' => $studentProject->sptitle,
            'projectname' => $project->projectname, // Actual project name
            'type' => $project->type,
            'coursename' => $lecturerMK->mataKuliah->namamk ?? 'Unknown',
            'tahun' => $lecturerMK->tahun ?? 'Unknown', // tahun from LecturerMK
            'image_url' => $project->projectimage ?? null, // Add placeholder logic if needed
        ];

        if ($project->status === 'Ongoing') {
            $ongoingProjects[] = $projectData;
        } elseif ($project->status === 'Finished') {
            $completedProjects[] = $projectData;
        }
    }

    return view('studentprojects', [
        'title' => 'Ongoing Projects',
        'ongoingProjects' => $ongoingProjects,
        'completedProjects' => $completedProjects,
    ]);
    }
}

