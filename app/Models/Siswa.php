<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswas';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $primaryKey = 'id_siswa';
    protected $fillable = [
        //'id_user',
        'nama_siswa',
        'kelas',
        'alamat'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function kehadirans(){
        return $this->hasMany(Kehadiran::class, 'id_siswa', 'id_siswa');
    }   

    public function pendaftarans(){
        return $this->hasMany(Pendaftaran::class, 'id_siswa', 'id_siswa');
    }

    public function prestasis(){
        return $this->hasMany(Prestasi::class, 'id_siswa', 'id_siswa');
    }
}

