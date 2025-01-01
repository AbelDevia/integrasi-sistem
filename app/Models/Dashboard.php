<?php

namespace App\Models;

use App\Models\Penyakit;
use App\Models\Gejala;
use App\Models\BasisPengetahuan;
use App\Models\Kambing;
use App\Models\Kegiatan;

class Dashboard
{
    /**
     * Mendapatkan total data untuk setiap entitas.
     */
    public static function getTotals()
    {
        return [
            'total_penyakit' => Penyakit::count(),
            'total_gejala' => Gejala::count(),
            'total_basis_pengetahuan' => BasisPengetahuan::count(),
            'total_kambing' => Kambing::count(),
            'total_kegiatan' => Kegiatan::count(),
        ];
    }

    /**
     * Mendapatkan data terbaru untuk setiap entitas.
     */
    public static function getRecentData($limit = 5)
    {
        return [
            'recent_penyakit' => Penyakit::latest()->take($limit)->get(),
            'recent_gejala' => Gejala::latest()->take($limit)->get(),
            'recent_kambing' => Kambing::latest()->take($limit)->get(),
            'recent_kegiatan' => Kegiatan::latest()->take($limit)->get(),
        ];
    }
}
