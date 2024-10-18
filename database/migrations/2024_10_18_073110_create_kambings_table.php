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
        Schema::create('kambing', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->enum('jenis_kelamin', ['Jantan', 'Betina']);
            $table->integer('usia')->comment('Usia dalam bulan');
            $table->string('ras');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kambings');
    }
};
