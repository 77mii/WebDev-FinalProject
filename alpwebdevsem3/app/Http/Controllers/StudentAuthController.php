<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;

class StudentAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('student.login'); // Updated path
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('student')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('student.your.projects')->with('success', 'Logged in successfully!');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('student')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('student.login')->with('success', 'Logged out successfully.');
    }

    public function showRegistrationForm()
{
    return view('student.register');
}

public function register(Request $request)
{
    // Validate input
    $request->validate([
        'studentname' => 'required|string|max:255',
        'email' => 'required|email|unique:students,email',
        'password' => 'required|confirmed|min:8',
        'nim' => 'required|string|max:20|unique:students,nim',
        'pfp' => 'nullable|url', // Ensure pfp is a valid URL
    ]);

    // Create student with the provided data
    Student::create([
        'studentname' => $request->studentname,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'nim' => $request->nim,
        'pfp' => $request->pfp, // Store the URL directly
    ]);

    // Redirect to login page with success message
    return redirect()->route('student.login')->with('success', 'Registration successful! Please login.');
}

}
