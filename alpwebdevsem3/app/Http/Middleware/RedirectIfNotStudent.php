<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotStudent
{
    public function handle($request, Closure $next, $guard = 'student')
    {
        if (!Auth::guard($guard)->check()) {
            return redirect()->route('student.login'); // Redirect to student login
        }

        return $next($request);
    }
}
