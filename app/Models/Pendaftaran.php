<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';

    protected $fillable = [
        'user_id',
        'event_id',
        'tipe_pendaftaran',
        'status',
        'tanggal_daftar',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Relasi ke Perorangan
    public function perorangan()
    {
        return $this->hasOne(Perorangan::class);
    }

    // Relasi ke Kelompok
    public function kelompok()
    {
        return $this->hasOne(Kelompok::class);
    }

    // Relasi ke Transaksi
    public function transaksi()
    {
        return $this->hasOne(Transaksi::class);
    }
}
