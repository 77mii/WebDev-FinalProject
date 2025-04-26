<?php

namespace App\Http\Controllers;

use App\Models\StudentProject;
use Illuminate\Http\Request;

class LecturerStudentProjectDetailController extends Controller
{
    public function show($id)
    {
        // Fetch the student project and its relationships
        $studentProject = StudentProject::with([
            'project.lecturerMK.mataKuliah',
            'project.lecturerMK.lecturer',
            'projectImages',
            'studentGroups.students',
        ])->findOrFail($id);

        // Fetch the main image for display
        $mainImage = $studentProject->projectImages->first()->imageurl ?? 'https://placehold.co/1200x400';

        return view('lecturerstudentprojectdetail', [
            'title' => $studentProject->sptitle ?? 'Student Project Detail',
            'studentProject' => $studentProject,
            'mainImage' => $mainImage,
        ]);
    }
}
