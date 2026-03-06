<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LecturerData
{
    public function handle(Request $request, Closure $next)
    {
        // Check if 'student' data is already shared (skip LecturerData)
        if (view()->shared('student')) {
            return $next($request); // Skip lecturer middleware
        }

        // Fetch the authenticated lecturer
        $lecturer = Auth::guard('lecturer')->user();

        if (!$lecturer) {
            return redirect()->route('lecturer.login')->with('error', 'Please log in as a lecturer.');
        }

        // Share lecturer data globally
        view()->share('lecturer', $lecturer);

        return $next($request);
    }
}
