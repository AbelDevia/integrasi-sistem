<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BasisPengetahuan;
use App\Models\Penyakit;
use App\Models\Hasil; // Pastikan Anda mengimpor model Hasil
use Illuminate\Http\Request;

class ProsesApiController extends Controller
{
    // Endpoint untuk memproses forward chaining
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

            $confidence = round(($matchedGejalaCount / $totalGejalaCount) * 100, 2);

            // Simpan hasil ke tabel hasil
            Hasil::create([
                'kambing_id' => $kambingId, // ID kambing
                'penyakit_id' => $penyakitId, // ID penyakit
                'gejala' => json_encode($selectedGejala), // Simpan gejala yang dipilih
                'confidence' => $confidence, // Simpan confidence
            ]);

            $results[] = [
                'penyakit' => $penyakit->nama,
                'matched' => $matchedGejalaCount,
                'total' => $totalGejalaCount,
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