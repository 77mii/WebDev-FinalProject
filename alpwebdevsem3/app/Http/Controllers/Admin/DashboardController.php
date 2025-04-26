<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // return the same view as guest but with admin-specific layout
        return view('admin', ['title' => 'Admin Dashboard']);
    }
}
