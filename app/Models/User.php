<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'id_user';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $table = 'userss';

    protected $fillable = [
        'username',
        'password',
        'role',
        'id_siswa',
        'id_guru',
        'id_pembina'
    ];

    protected $hidden = ['password','remember_token'];

    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'id_user', 'id_user');
    }

    public function guru()
    {
        return $this->hasOne(Guru::class, 'id_user', 'id_user');
    }

    public function pembina()
    {
        return $this->hasOne(Pembina::class, 'id_user', 'id_user');
    }
}
