<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

use App\Models\Pendaftaran;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user'; // Jika nama tabel kamu bukan 'users'

    protected $fillable = ['role_id', 'username', 'password'];

    protected $hidden = ['password'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function pengguna()
    {
        return $this->hasOne(Pengguna::class);
    }


    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class);
    }
}
