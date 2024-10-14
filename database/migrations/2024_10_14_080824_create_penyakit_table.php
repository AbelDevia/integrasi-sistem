<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penyakit', function (Blueprint $table) {
            $table->id(); // Kolom id otomatis sebagai primary key dan auto increment
            $table->string('kode')->unique(); // Kode penyakit, unik
            $table->string('nama'); // Nama penyakit
            $table->text('deskripsi'); // Deskripsi penyakit
            $table->text('rekomendasi'); // Rekomendasi penanganan
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyakit');
    }
};
