<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LecturerAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('lecturer.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('lecturer')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('lecturer.courses')->with('success', 'Logged in successfully!');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('lecturer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('lecturer.login')->with('success', 'Logged out successfully.');
    }
}
