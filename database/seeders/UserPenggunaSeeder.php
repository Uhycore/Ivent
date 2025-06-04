<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserPenggunaSeeder extends Seeder
{
    public function run(): void
    {
        // Insert user dengan role pengguna (id = 2)
        $userId = DB::table('user')->insertGetId([
            'role_id' => 2,
            'username' => 'pengguna',
            'password' => Hash::make('12345678'),
            'email' => 'arilmubin0@gmail.com', 
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Insert ke tabel pengguna
        DB::table('pengguna')->insert([
            'user_id' => $userId,
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Contoh Alamat No. 123',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
