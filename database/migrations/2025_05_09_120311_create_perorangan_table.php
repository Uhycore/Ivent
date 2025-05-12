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
        Schema::create('perorangan', function (Blueprint $table) {
            $table->id();  // id sebagai primary key dengan auto increment
            $table->foreignId('pendaftaran_id')->constrained('pendaftaran')->onDelete('cascade');  // kolom pendaftaran_id yang merujuk ke tabel pendaftaran
            $table->string('nama_lengkap', 100);  // kolom nama_lengkap
            $table->string('no_hp', 15);  // kolom no_hp
            $table->text('alamat');  // kolom alamat
            $table->timestamps();  // kolom created_at dan updated_at
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perorangan');
    }
};
