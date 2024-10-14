<?php

namespace App\Http\Controllers;

use App\Models\Penyakit;
use Illuminate\Http\Request;

class PenyakitController extends Controller
{
    public function index()
    {
        // Mengambil semua data penyakit
        $penyakits = Penyakit::all();
        return view('dashboard.penyakit.index', compact('penyakits'));
    }
}
