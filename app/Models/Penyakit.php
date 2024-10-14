<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
    use HasFactory;
    // Tentukan nama tabel (jika berbeda dengan nama model dalam bentuk jamak)
    protected $table = 'penyakit';

    // Tentukan kolom yang bisa diisi (mass assignment)
    protected $fillable = ['kode', 'nama', 'deskripsi', 'rekomendasi'];

    // Jika Anda tidak membutuhkan timestamps (created_at, updated_at), bisa dinonaktifkan
    // public $timestamps = false;
}
