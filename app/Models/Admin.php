<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    // Menghubungkan dengan tabel 'admin'
    protected $table = 'admin';

    // Kolom yang bisa diisi secara mass-assignment
    protected $fillable = ['user_id'];

    // Relasi dengan tabel 'user' (setiap admin memiliki satu user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
