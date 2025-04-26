<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class LecturerProjectDetailController extends Controller
{
    public function show($id)
    {
        // Fetch the project and relationships
        $project = Project::with([
            'lecturerMK.mataKuliah',           // To get program name, semester, class name, and year
            'lecturerMK.lecturer',             // Main lecturer name
            'studentProjects.projectImages',   // Fetch images for each student project
            'studentProjects.studentGroups',   // Corrected: plural form
        ])->findOrFail($id);
    
        // Prepare student projects data
        $studentProjects = [];
        foreach ($project->studentProjects as $studentProject) {
            $studentProjects[] = [
                'id' => $studentProject->id, // Add the Student Project ID here
                'image_url' => $studentProject->projectImages->first()->imageurl ?? 'https://placehold.co/300x200',
                'group_name' => $studentProject->studentGroups->first()->groupname ?? 'Unknown Group',
                'sp_title' => $studentProject->sptitle ?? 'No Title',
            ];
        }
    
        return view('lecturerprojectdetail', [
            'title' => $project->projectname . ' - ' . $project->type,
            'project' => $project,
            'studentProjects' => $studentProjects,
        ]);
    }
}
