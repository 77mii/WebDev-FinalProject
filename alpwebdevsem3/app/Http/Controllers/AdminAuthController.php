<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    /**
     * Show the Admin login form.
     */
    public function showLoginForm()
    {
        return view('login'); // Now looking for 'resources/views/login.blade.php'
    }

    /**
     * Handle Admin login.
     */
    public function login(Request $request)
    {
        // Validate the incoming data
        $credentials = $request->validate([
            'username' => 'required|string',  // Validate username instead of email
            'password' => 'required|string',
        ]);

        // Attempt to log in using the username and password
        if (Auth::guard('admin')->attempt(['username' => $credentials['username'], 'password' => $credentials['password']], $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function showRegistrationForm()
    {
        return view('register'); // Looking for the register view in the root views folder
    }

    /**
     * Handle Admin registration.
     */
    public function register(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email'    => 'required|email|unique:admins,email',
            'password' => 'required|string|confirmed|min:8',
            'admin_code' => 'required|string', // Validate the admin code
        ]);
    
        // Check the admin code
        if ($validated['admin_code'] !== 'admin12345') {
            return back()->withErrors(['admin_code' => 'The provided admin code is incorrect.']);
        }
    
        // Create a new admin user
        $admin = Admin::create([
            'username' => $validated['username'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
    
        // Log the admin in after registration
        Auth::guard('admin')->login($admin);
    
        // Redirect to the dashboard after successful registration
        return redirect()->route('admin.dashboard');
    }

    /**
     * Handle Admin logout.
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('guest.index');
    }
}

