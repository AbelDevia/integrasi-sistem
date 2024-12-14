<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan konvensi Laravel
    protected $table = 'hasil';

    // Tentukan kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'kambing_id',
        'penyakit_id',
        'gejala',
        'confidence',
    ];

    // Relasi dengan model Kambing
    public function kambing()
    {
        return $this->belongsTo(Kambing::class);
    }

    // Relasi dengan model Penyakit
    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class);
    }
}
