<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    protected $table = 'kehadirans';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $primaryKey = 'id_kehadiran';
    protected $fillable = [
        'id_siswa',
        'id_eskul',
        'tanggal',  
        'status',
        'poin',
    ];  

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    public function eskul()
    {
        return $this->belongsTo(Eskul::class, 'id_eskul', 'id_eskul');
    }
}
