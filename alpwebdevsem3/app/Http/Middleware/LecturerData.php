<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Lecturer;

class LecturerData
{
    public function handle(Request $request, Closure $next)
    {
        // Check if 'student' data is already shared (skip LecturerData)
        if (view()->shared('student')) {
            return $next($request); // Skip lecturer middleware
        }

        // Fetch lecturer data
        $lecturer = Lecturer::find(1); // Default ID for lecturer testing 30 isa

        if (!$lecturer) {
            return redirect()->route('login')->with('error', 'Lecturer not found.');
        }

        // Share lecturer data globally
        view()->share('lecturer', $lecturer);

        return $next($request);
    }
}
