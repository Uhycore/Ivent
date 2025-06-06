<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('event', function (Blueprint $table) {
            $table->id();
            $table->string('nama_event', 100);
            $table->date('tanggal');
            $table->text('deskripsi');
            $table->string('tipe_event', 20)->comment('perorangan, kelompok, semua');
            $table->integer('kuota')->comment('Kuota peserta maksimal per event');
            $table->integer('sisa_kuota')->comment('Sisa kuota peserta untuk event');
            $table->integer('max_anggota_kelompok')->nullable()->comment('Maks anggota per kelompok jika tipe_event kelompok atau semua');
            $table->string('gambar')->nullable()->comment('Path gambar event');
            $table->bigInteger('harga_pendaftaran');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event');
    }
};
