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
        Schema::create('admin', function (Blueprint $table) {
        $table->id();  // Auto-incrementing primary key
        $table->foreignId('user_id')->constrained('user')->onDelete('cascade');  // Foreign key user_id yang merujuk ke tabel users
        $table->timestamps();  // Created_at dan updated_at
    });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
