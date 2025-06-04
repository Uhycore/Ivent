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
        Schema::create('user', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->foreignId('role_id')->constrained('role');  // Foreign key role_id yang merujuk ke tabel roles
            $table->string('username')->unique();  // Username dengan unique constraint
            $table->string('password');  // Password
            $table->string('email')->unique();  // Email dengan unique constraint
            $table->timestamps();  // Created_at dan updated_at
        });
    }




    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
