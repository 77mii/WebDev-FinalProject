<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LecturerProjectsController extends Controller
{
    public function index()
    {
        // Fetch the authenticated lecturer
        $lecturer = Auth::guard('lecturer')->user();

        if (!$lecturer) {
            return redirect()->route('lecturer.login')->with('error', 'Please log in as a lecturer.');
        }

        // Fetch all projects associated with the lecturer's LecturerMKs
        $lecturerMKs = $lecturer->lecturerMKs()->with('projects')->get();

        $ongoingProjects = [];
        $completedProjects = [];

        foreach ($lecturerMKs as $lecturerMK) {
            foreach ($lecturerMK->projects as $project) {
                $projectData = [
                    'id' => $project->id,
                    'projectname' => $project->projectname,
                    'type' => $project->type,
                    'coursename' => $lecturerMK->mataKuliah->namamk ?? 'Unknown',
                    'tahun' => $lecturerMK->tahun ?? 'Unknown',
                    'image_url' => $project->projectimage ?? 'https://placehold.co/300x200',
                ];

                if ($project->status === 'Ongoing') {
                    $ongoingProjects[] = $projectData;
                } elseif ($project->status === 'Finished') {
                    $completedProjects[] = $projectData;
                }
            }
        }

        return view('lecturerprojects', [
            'title' => 'Projects Overview',
            'ongoingProjects' => $ongoingProjects,
            'completedProjects' => $completedProjects,
        ]);
    }
}
