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
        Schema::table('users', function (Blueprint $table) {
            // Menambah kolom google_token dan google_refresh_token
            $table->string('google_token')->nullable();
            $table->string('google_refresh_token')->nullable();
        });
    }

    /**
     * Membatalkan migration untuk menghapus kolom
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Menghapus kolom google_token dan google_refresh_token jika migration di-rollback
            $table->dropColumn(['google_token', 'google_refresh_token']);
        });
    }
};
