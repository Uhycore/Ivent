<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnggotaKelompok extends Model
{
    use HasFactory;

    protected $fillable = ['kelompok_id', 'nama_anggota', 'no_hp'];

    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class);
    }
}

