<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index'); // Pastikan view ini ada di resources/views/dashboard/index.blade.php
    }
}
