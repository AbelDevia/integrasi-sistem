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
        Schema::table('kegiatan', function (Blueprint $table) {
            // Menambahkan kolom google_sync dengan default false
            $table->boolean('google_sync')->default(false); 
        });
    }
    
    public function down()
    {
        Schema::table('kegiatan', function (Blueprint $table) {
            // Menghapus kolom google_sync jika migrasi dirollback
            $table->dropColumn('google_sync');
        });
    }
    
};
