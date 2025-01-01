<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;

class DashboardController extends Controller
{
    public function index()
    {
        $data = array_merge(
            Dashboard::getTotals(),
            Dashboard::getRecentData()
        );

        return view('dashboard.index', compact('data'));
    }
}
