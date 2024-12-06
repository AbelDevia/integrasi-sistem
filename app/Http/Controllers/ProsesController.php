<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use Illuminate\Http\Request;

class ProsesController extends Controller
{
    public function index()
    {
        // Mengambil semua data gejala dari database
        $gejalas = Gejala::all();

        // Menampilkan view untuk memilih gejala
        return view('dashboard.proses.index', compact('gejalas'));
    }
}
