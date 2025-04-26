<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Lecturer;

class UserDataMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Option to quickly switch user (testing purposes)
        $quickSwitchStudentID = 1; // Replace 1 with desired student ID
        $quickSwitchLecturerID = 1; // Replace 1 with desired lecturer ID

        // Default to null values
        $student = null;
        $lecturer = null;

        if (Auth::check()) {
            $user = Auth::user();

            // Check for user role
            if ($user->role === 'student') {
                $student = Student::find($user->id);
            } elseif ($user->role === 'lecturer') {
                $lecturer = Lecturer::find($user->id);
            }
        } else {
            // Quick-switch logic for testing (static user IDs)
            $student = Student::find($quickSwitchStudentID);
            $lecturer = Lecturer::find($quickSwitchLecturerID);
        }

        // Share data globally
        if ($student) {
            view()->share('student', $student);
        } elseif ($lecturer) {
            view()->share('lecturer', $lecturer);
        }

        return $next($request);
    }
}
