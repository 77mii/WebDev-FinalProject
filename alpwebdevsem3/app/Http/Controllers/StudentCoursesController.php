<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentCoursesController extends Controller
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

        // Initialize arrays for categorizing courses
        $ongoingCourses = collect();
        $completedCourses = collect();

        // Use a collection to track unique LecturerMK IDs
        $seenLecturerMKs = collect();

        foreach ($studentGroups as $group) {
            // Ensure the studentProject and project relationship exist
            $studentProject = $group->studentProject;
            if (!$studentProject || !$studentProject->project || !$studentProject->project->lecturerMK) {
                continue; // Skip if any relationship is missing
            }

            $lecturerMK = $studentProject->project->lecturerMK;

            // Check if the LecturerMK ID has already been seen
            if ($seenLecturerMKs->contains($lecturerMK->id)) {
                continue; // Skip duplicate LecturerMK
            }

            // Mark this LecturerMK as seen
            $seenLecturerMKs->push($lecturerMK->id);

            // Prepare course data
            $courseData = [
                'id' => $lecturerMK->id,
                'image_url' => $lecturerMK->lmk_image ?? 'https://placehold.co/300x200', // Placeholder if no image
                'class_name' => $lecturerMK->mataKuliah->namamk ?? 'Unknown Class',
                'program_name' => $lecturerMK->mataKuliah->namaprodi ?? 'Unknown Program',
                'year' => $lecturerMK->tahun ?? 'Unknown Year',
            ];

            // Categorize based on lmk_status
            if ($lecturerMK->lmk_status === 'Ongoing') {
                $ongoingCourses->push($courseData);
            } elseif ($lecturerMK->lmk_status === 'Finished') {
                $completedCourses->push($courseData);
            }
        }

        // Return view with categorized data
        return view('studentcourses', [
            'title' => 'Ongoing Courses',
            'ongoingCourses' => $ongoingCourses,
            'completedCourses' => $completedCourses,
        ]);
    }
}
