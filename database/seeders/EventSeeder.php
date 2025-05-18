<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('event')->insert([
            [
                'nama_event' => 'Lomba Perorangan 2025',
                'tanggal' => '2025-06-30',
                'deskripsi' => 'Lomba untuk peserta perorangan.',
                'tipe_event' => 'perorangan',
                'kuota' => 100,
                'max_anggota_kelompok' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_event' => 'Festival Kelompok IT',
                'tanggal' => '2025-07-15',
                'deskripsi' => 'Festival khusus untuk kelompok.',
                'tipe_event' => 'kelompok',
                'kuota' => 20,
                'max_anggota_kelompok' => 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_event' => 'Open Competition Semua',
                'tanggal' => '2025-08-10',
                'deskripsi' => 'Event terbuka untuk perorangan dan kelompok.',
                'tipe_event' => 'semua',
                'kuota' => 150,
                'max_anggota_kelompok' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
