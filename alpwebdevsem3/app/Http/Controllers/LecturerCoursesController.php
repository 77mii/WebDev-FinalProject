<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LecturerMK;

class LecturerCoursesController extends Controller
{
    public function index()
    {
        // Fetch the globally shared lecturer variable
        $lecturer = view()->shared('lecturer');

        // Ensure lecturer exists
        if (!$lecturer) {
            return redirect()->route('login')->with('error', 'Lecturer not found.');
        }

        // Fetch LecturerMKs related to the lecturer with MataKuliah details
        $lecturerMKs = LecturerMK::with('mataKuliah')
            ->where('lecturer_id', $lecturer->id)
            ->get();

        // Initialize arrays for categorizing courses
        $ongoingCourses = [];
        $completedCourses = [];

        foreach ($lecturerMKs as $lecturerMK) {
            // Course Data
            $courseData = [
                'id' => $lecturerMK->id,
                'class_name' => $lecturerMK->mataKuliah->namamk ?? 'Unknown Class',
                'program_name' => $lecturerMK->mataKuliah->namaprodi ?? 'Unknown Program',
                'year' => $lecturerMK->tahun ?? 'N/A',
                'image_url' => $lecturerMK->lmk_image ?? 'https://placehold.co/300x200',
            ];

            // Categorize courses
            if ($lecturerMK->lmk_status === 'Ongoing') {
                $ongoingCourses[] = $courseData;
            } elseif ($lecturerMK->lmk_status === 'Finished') {
                $completedCourses[] = $courseData;
            }
        }

        return view('lecturercourses', [
            'title' => 'Lecturer Courses',
            'ongoingCourses' => $ongoingCourses,
            'completedCourses' => $completedCourses,
        ]);
    }
}
