<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BasisPengetahuan;
use App\Models\Penyakit;
use Illuminate\Http\Request;

class ProsesApiController extends Controller
{
    // Endpoint untuk memproses forward chaining
    public function calculate(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'gejala' => 'required|array|min:1', // Wajib ada array gejala
            'gejala.*' => 'exists:gejala,id',  // Gejala harus ada di tabel gejala
        ]);

        $selectedGejala = $validated['gejala'];

        // Ambil data basis pengetahuan berdasarkan gejala yang dipilih
        $basisPengetahuans = BasisPengetahuan::with('penyakit')
            ->whereIn('gejala_id', $selectedGejala)
            ->get()
            ->groupBy('penyakit_id');

        // Mengolah hasil diagnosis
        $results = [];
        foreach ($basisPengetahuans as $penyakitId => $pengetahuans) {
            $penyakit = Penyakit::find($penyakitId);
            $matchedGejalaCount = $pengetahuans->count();
            $totalGejalaCount = BasisPengetahuan::where('penyakit_id', $penyakitId)->count();

            $results[] = [
                'penyakit' => $penyakit->nama,
                'matched' => $matchedGejalaCount,
                'total' => $totalGejalaCount,
                'confidence' => round(($matchedGejalaCount / $totalGejalaCount) * 100, 2),
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
