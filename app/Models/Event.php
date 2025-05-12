<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['nama_event', 'tanggal', 'deskripsi'];

    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class);
    }
}

