<?php

namespace App\Http\Controllers;

use App\Models\BasisPengetahuan;
use App\Models\Gejala;
use App\Models\Hasil;
use App\Models\Kambing;
use App\Models\Penyakit;
use Illuminate\Http\Request;

class ProsesController extends Controller
{
    public function index()
    {
        // Mengambil semua data gejala dari database
        $gejalas = Gejala::all();
        $kambings = Kambing::all();
        
        // Mengambil data hasil dari tabel hasil, diurutkan dari yang terbaru
        $hasil = Hasil::with(['kambing', 'penyakit'])
                      ->orderBy('created_at', 'desc') // Mengurutkan data berdasarkan waktu terbaru
                      ->paginate(10); // Memastikan hasil dipaginasi untuk efisiensi
    
        // Menampilkan view untuk memilih gejala
        return view('dashboard.proses.index', compact('gejalas', 'kambings', 'hasil'));
    }
    

    public function calculate(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'kambing' => 'required|exists:kambing,id', // Validasi ID kambing
            'gejala' => 'required|array|min:1', // Wajib ada array gejala
            'gejala.*' => 'exists:gejala,id',  // Gejala harus ada di tabel gejala
        ]);
    
        $selectedGejala = $validated['gejala'];
        $kambingId = $validated['kambing']; // Ambil ID kambing dari request
    
        // Ambil data basis pengetahuan
        $basisPengetahuans = BasisPengetahuan::with(['penyakit', 'gejala'])->get();
    
        // Kelompokkan aturan berdasarkan penyakit
        $aturan = [];
        foreach ($basisPengetahuans as $bp) {
            $penyakitId = $bp->penyakit_id;
            if (!isset($aturan[$penyakitId])) {
                $aturan[$penyakitId] = [
                    'total_gejala' => 0,
                    'matched_gejala' => 0,
                    'key_gejala' => [],
                ];
            }
            $aturan[$penyakitId]['total_gejala']++;
        }
    
        // Periksa gejala yang cocok dengan basis pengetahuan
        foreach ($basisPengetahuans as $bp) {
            if (in_array($bp->gejala_id, $selectedGejala)) {
                $penyakitId = $bp->penyakit_id;
                $jenis = $bp->relasi_gejala; // "OR" atau "AND"
                $keyGejala = $bp->key_gejala;
    
                if ($jenis === 'OR') {
                    if (!in_array($keyGejala, $aturan[$penyakitId]['key_gejala'])) {
                        $aturan[$penyakitId]['key_gejala'][] = $keyGejala;
                        $aturan[$penyakitId]['matched_gejala']++;
                    }
                } else { // "AND"
                    $aturan[$penyakitId]['matched_gejala']++;
                }
            }
        }
    
        // Hitung persentase kecocokan
        $results = [];
        foreach ($aturan as $penyakitId => $data) {
            $confidence = round(($data['matched_gejala'] / $data['total_gejala']) * 100, 2);
            $penyakit = Penyakit::find($penyakitId);
    
            // Simpan hasil ke tabel hasil
            Hasil::create([
                'kambing_id' => $kambingId,
                'penyakit_id' => $penyakitId,
                'gejala' => json_encode($selectedGejala),
                'confidence' => $confidence,
            ]);
    
            $results[] = [
                'penyakit' => $penyakit->nama,
                'matched' => $data['matched_gejala'],
                'total' => $data['total_gejala'],
                'confidence' => $confidence,
            ];
        }
    
        // Urutkan berdasarkan confidence tertinggi
        usort($results, function ($a, $b) {
            return $b['confidence'] <=> $a['confidence'];
        });
    
        // Kembalikan hasil dalam format JSON
        return response()->json([
            'success' => true,
            'data' => $results,
        ], 200);
    }
    
}
