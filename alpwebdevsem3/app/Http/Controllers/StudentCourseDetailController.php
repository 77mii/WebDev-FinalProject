<?php

namespace App\Http\Controllers;

use App\Models\LecturerMK;
use Illuminate\Http\Request;

class StudentCourseDetailController extends Controller
{
    public function show($id)
    {
        // Fetch the globally shared student variable
        $student = view()->shared('student');

        if (!$student) {
            return redirect()->route('login')->with('error', 'Student not found.');
        }

        // Fetch the selected LecturerMK with relationships
        $lecturerMK = LecturerMK::with(['mataKuliah', 'lecturer'])->findOrFail($id);

        // Initialize an array to hold student's projects for this class
        $studentProjects = [];

        // Fetch all student groups and projects for the current class
        $studentGroups = $student->studentGroups()->with('studentProject.project')->get();

        foreach ($studentGroups as $group) {
            $studentProject = $group->studentProject;

            // Check if the student project is linked to the current LecturerMK
            if (
                $studentProject &&
                $studentProject->project &&
                $studentProject->project->lmk_id === $lecturerMK->id
            ) {
                // Fetch the first image associated with the student project
                $imageUrl = $studentProject->projectImages->first()->imageurl 
                    ?? 'https://placehold.co/300x200';

                // Add project details to the array
                $studentProjects[] = [
                    'sp_id' => $studentProject->id, // Add the ID of the StudentProject
                    'sp_title' => $studentProject->sptitle, // Biggest title
                    'project_type' => $studentProject->project->type, // Project type
                    'project_name' => $studentProject->project->projectname, // Project name
                    'image_url' => $imageUrl, // First image from projectImages
                ];
            }
        }

        // Pass the class and projects to the view
        return view('studentcoursedetail', [
            'title' => $lecturerMK->mataKuliah->namamk ?? 'Course Details',
            'lecturerMK' => $lecturerMK,
            'projects' => $studentProjects,
        ]);
    }
}
