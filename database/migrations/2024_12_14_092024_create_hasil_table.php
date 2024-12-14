<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('hasil', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kambing_id')->constrained('kambing')->onDelete('cascade'); // Ubah nama tabel menjadi 'kambing'
            $table->foreignId('penyakit_id')->constrained('penyakit')->onDelete('cascade'); // Menghubungkan ke tabel penyakit
            $table->json('gejala'); // Menyimpan gejala yang dipilih dalam format JSON
            $table->decimal('confidence', 5, 2); // Persentase confidence
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hasil');
    }
};
