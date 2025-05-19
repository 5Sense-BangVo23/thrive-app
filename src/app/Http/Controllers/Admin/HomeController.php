<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {   
        // dd('admin dashboard');
        return view('admin.dashboard');
    }
}