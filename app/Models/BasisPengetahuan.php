<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasisPengetahuan extends Model
{
    use HasFactory;
    protected $table = 'basis_pengetahuan';
    protected $fillable = ['gejala_id', 'penyakit_id'];

    public function gejala()
    {
        return $this->belongsTo(Gejala::class);
    }

    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class);
    }
}
