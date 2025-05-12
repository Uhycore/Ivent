<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    // Menghubungkan dengan tabel 'pengguna'
    protected $table = 'pengguna';

    // Kolom yang bisa diisi secara mass-assignment
    protected $fillable = ['user_id', 'no_hp', 'alamat'];

    // Relasi dengan tabel 'user' (setiap pengguna memiliki satu user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
