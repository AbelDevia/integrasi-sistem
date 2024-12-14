<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Models\Hasil;
use App\Models\Kambing;
use Illuminate\Http\Request;

class ProsesController extends Controller
{
    public function index()
    {
        // Mengambil semua data gejala dari database
        $gejalas = Gejala::all();
        $kambings = Kambing::all();
        
        // Mengambil data hasil dari tabel hasil
        $hasil = Hasil::with(['kambing', 'penyakit'])->get(); // Mengambil hasil beserta relasi kambing dan penyakit

        // Menampilkan view untuk memilih gejala
        return view('dashboard.proses.index', compact('gejalas', 'kambings', 'hasil'));
    }
}
