<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelompok extends Model
{
    use HasFactory;

    protected $table = 'kelompok';

    protected $fillable = ['pendaftaran_id', 'nama_kelompok', 'no_hp_ketua', 'alamat_ketua'];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }

    public function anggota_kelompok()
    {
        return $this->hasMany(AnggotaKelompok::class);
    }
}

