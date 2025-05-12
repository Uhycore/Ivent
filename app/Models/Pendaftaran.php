<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'event_id', 'tipe_pendaftaran', 'status', 'tanggal_daftar'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function perorangan()
    {
        return $this->hasOne(Perorangan::class);
    }

    public function kelompok()
    {
        return $this->hasOne(Kelompok::class);
    }
}

