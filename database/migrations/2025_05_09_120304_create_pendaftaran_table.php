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
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();  // id sebagai primary key dengan auto increment
            $table->foreignId('user_id')->constrained('user')->onDelete('cascade');  // kolom user_id yang merujuk ke tabel user
            $table->foreignId('event_id')->constrained('event')->onDelete('cascade');  // kolom event_id yang merujuk ke tabel event
            $table->string('tipe_pendaftaran', 20);  // kolom tipe_pendaftaran (perorangan, kelompok)
            $table->string('status', 20);  // kolom status (pending, diterima, ditolak)
            $table->dateTime('tanggal_daftar');  // kolom tanggal_daftar
            $table->timestamps();  // kolom created_at dan updated_at
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
