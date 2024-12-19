<?php
namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Models\Hasil;
use App\Models\Kambing;
use Illuminate\Http\Request;
class HomepageController extends Controller
{
    public function index()
    {
        return view('homepage.index');
    }
    public function informasi()
    {
        return view('homepage.informasi');
    }
    public function metode()
    {
        return view('homepage.metode');
    }
    public function kontak()
    {
        return view('homepage.kontak');
    }

    public function diagnosis()
    {
        // Mengambil semua data gejala dari database
        $gejalas = Gejala::all();
        $kambings = Kambing::all();
        
        // Mengambil data hasil dari tabel hasil
        $hasil = Hasil::with(['kambing', 'penyakit'])->get(); // Mengambil hasil beserta relasi kambing dan penyakit

        // Menampilkan view untuk memilih gejala
        return view('homepage.diagnosis', compact('gejalas', 'kambings', 'hasil'));
    }
}