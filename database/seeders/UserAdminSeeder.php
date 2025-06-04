<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserAdminSeeder extends Seeder
{
    public function run(): void
    {
        // Waktu sekarang
        $now = Carbon::now();

        // 1. Tambah user (admin)
        $userId = DB::table('user')->insertGetId([
            'role_id'    => 1,
            'username'   => 'admin',
            'password'   => Hash::make('12345678'),
            'email'      => 'admin@gmail.com',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // 2. Tambah ke tabel admin
        DB::table('admin')->insert([
            'user_id'    => $userId,

            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
