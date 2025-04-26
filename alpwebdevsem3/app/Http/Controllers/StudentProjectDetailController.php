<?php

namespace App\Http\Controllers;

use App\Models\StudentProject;
use Illuminate\Http\Request;

class StudentProjectDetailController extends Controller
{
    public function show($id)
    {
        // Fetch the student project and its relationships
        $studentProject = StudentProject::with([
            'project.lecturerMK.mataKuliah',  // Project → LecturerMK → Mata Kuliah
            'project.lecturerMK.lecturer',   // Lecturer
            'projectImages',                 // Associated images
            'studentGroups.students'         // Groups and their students
        ])->findOrFail($id);

        // Fetch the big image: Take the first project image if available, else placeholder
        $bigImage = $studentProject->projectImages->first()->imageurl ?? 'https://placehold.co/1200x400';

        // Get the project title
        $projectTitle = $studentProject->project->projectname ?? 'Unknown Project';

        // Prepare data for the view
        $data = [
            'title' => $projectTitle . ' Details', // Set dynamic title
            'studentProject' => $studentProject,
            'projectType' => $studentProject->project->type ?? 'Unknown',
            'description' => $studentProject->sp_description ?? 'No description provided.',
            'matakuliahName' => $studentProject->project->lecturerMK->mataKuliah->namamk ?? 'Unknown',
            'lecturerName' => $studentProject->project->lecturerMK->lecturer->lecturername ?? 'Unknown Lecturer',
            'groupMembers' => $studentProject->studentGroups->flatMap->students, // Get all students in groups
            'images' => $studentProject->projectImages, // Project preview images
            'bigImage' => $bigImage, // The big image spanning the width
        ];

        return view('studentprojectdetail', $data);
    }
}