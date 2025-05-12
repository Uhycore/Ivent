<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role', function (Blueprint $table) {
            $table->id();  // id sebagai primary key dengan auto increment
            $table->string('role_name', 50);  // kolom untuk nama role dengan panjang 50 karakter
            $table->timestamps();  // untuk kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role');  // menghapus tabel role jika rollback dilakukan
    }
}
