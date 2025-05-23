<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perorangan extends Model
{
    use HasFactory;
    protected $table = 'perorangan';

    protected $fillable = ['pendaftaran_id', 'nama_lengkap', 'no_hp', 'alamat'];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }
}
