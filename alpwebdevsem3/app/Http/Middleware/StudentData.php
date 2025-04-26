<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentData
{
    public function handle(Request $request, Closure $next)
    {
        // Fetch a student by ID (replace '1' with dynamic logic if needed)
        $student = Student::find(1);

    // Debug: Check if the student is retrieved
    // if ($student) {
    //     logger('Middleware executed: Student found - ' . $student->name);
    //     dd($student); // This will dump the student and stop execution
    // } else {
    //     logger('Middleware executed: No student found');
    // }

        // Share student data globally with views
        view()->share('student', $student);

        return $next($request);
    }
}
