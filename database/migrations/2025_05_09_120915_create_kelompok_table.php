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
        Schema::create('kelompok', function (Blueprint $table) {
            $table->id();  // id sebagai primary key dengan auto increment
            $table->foreignId('pendaftaran_id')->constrained('pendaftaran')->onDelete('cascade');  // kolom pendaftaran_id yang merujuk ke tabel pendaftaran
            $table->string('nama_kelompok', 100);  // kolom nama_kelompok
            $table->string('no_hp_ketua', 15);  // kolom no_hp_ketua
            $table->text('alamat_ketua');  // kolom alamat_ketua
            $table->timestamps();  // kolom created_at dan updated_at
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelompok');
    }
};
