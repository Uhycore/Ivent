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
        Schema::create('event', function (Blueprint $table) {
            $table->id();  // id sebagai primary key dengan auto increment
            $table->string('nama_event', 100);  // kolom nama_event
            $table->date('tanggal');  // kolom tanggal
            $table->text('deskripsi');  // kolom deskripsi
            $table->timestamps();  // kolom created_at dan updated_at
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event');
    }
};
