<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();

            // Relasi ke user yang bayar (misal tabel users)
            $table->unsignedBigInteger('user_id');

            // Relasi ke event yang dibayar
            $table->unsignedBigInteger('event_id');

            $table->string('kode_transaksi')->unique();
            $table->bigInteger('jumlah_bayar');
            $table->enum('status', ['unpaid', 'paid'])->default('unpaid');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
