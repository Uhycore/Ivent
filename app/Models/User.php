<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    // Menghubungkan dengan tabel 'users' (Laravel secara default akan mencari tabel users)
    protected $table = 'user';

    // Kolom yang bisa diisi secara mass-assignment
    protected $fillable = ['role_id', 'username', 'password'];

    // Relasi dengan tabel 'roles' (satu user memiliki satu role)
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Relasi dengan tabel 'admin' (satu user bisa memiliki satu admin)
    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    // Relasi dengan tabel 'pengguna' (satu user bisa memiliki satu pengguna)
    public function pengguna()
    {
        return $this->hasOne(Pengguna::class);
    }

    // Relasi dengan tabel 'pendaftaran' (satu user bisa memiliki banyak pendaftaran)
    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class);
    }
}
