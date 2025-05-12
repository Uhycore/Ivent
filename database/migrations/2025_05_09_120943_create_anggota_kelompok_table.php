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
        Schema::create('anggota_kelompok', function (Blueprint $table) {
            $table->id();  // id sebagai primary key dengan auto increment
            $table->foreignId('kelompok_id')->constrained('kelompok')->onDelete('cascade');  // kolom kelompok_id yang merujuk ke tabel kelompok
            $table->string('nama_anggota', 100);  // kolom nama_anggota
            $table->string('no_hp', 15);  // kolom no_hp
            $table->timestamps();  // kolom created_at dan updated_at
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota_kelompok');
    }
};
