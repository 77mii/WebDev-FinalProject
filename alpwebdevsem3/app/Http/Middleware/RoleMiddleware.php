<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Check for the shared 'student' or 'lecturer' variable
        $student = view()->shared('student');
        $lecturer = view()->shared('lecturer');

        // Role-based logic
        if ($role === 'student' && !$student) {
            abort(403, 'Unauthorized - Student Access Only');
        }

        if ($role === 'lecturer' && !$lecturer) {
            abort(403, 'Unauthorized - Lecturer Access Only');
        }

        return $next($request);
    }
}
