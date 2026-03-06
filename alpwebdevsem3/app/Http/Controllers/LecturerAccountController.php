<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LecturerAccountController extends Controller
{
    public function showAccount()
    {
        $lecturer = Auth::guard('lecturer')->user();

        return view('lecturer.account', compact('lecturer'));
    }
}
