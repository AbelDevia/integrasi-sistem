<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kambing extends Model
{
    use HasFactory;
    protected $table = 'kambing';
    protected $fillable = ['kode', 'jenis_kelamin', 'usia', 'ras'];
}
