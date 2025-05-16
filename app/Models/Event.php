<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{

    protected $table = 'event';
    use HasFactory;

    protected $fillable = ['nama_event', 'tanggal', 'deskripsi'];

    public function pendaftarans()
    {
        // Satu event dapat memiliki banyak pendaftaran
        return $this->hasMany(Pendaftaran::class);
    }
}

