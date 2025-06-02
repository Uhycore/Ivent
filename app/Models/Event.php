<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{

    protected $table = 'event';
    use HasFactory;

    protected $fillable = [
        'nama_event',
        'tanggal',
        'deskripsi',
        'tipe_event',
        'kuota',
        'sisa_kuota',
        'max_anggota_kelompok',
        'gambar',
        'harga_pendaftaran',
    ];


    public function pendaftarans()
    {
        // Satu event dapat memiliki banyak pendaftaran
        return $this->hasMany(Pendaftaran::class);
    }
}
