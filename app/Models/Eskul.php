<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eskul extends Model
{
    protected $table = 'eskuls';
    protected $primaryKey = 'id_eskul';

    protected $fillable = [
        'id_pembina',
        'nama_eskul',
        'jadwal_eskul',
        'materi'
    ];

    public function pembina()
    {
        return $this->belongsTo(Pembina::class, 'id_pembina', 'id_pembina');
    }

    public function aktivitas()
    {
        return $this->hasMany(Aktivitas::class, 'id_eskul', 'id_eskul');
    }

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'id_eskul', 'id_eskul');
    }

    public function prestasi()
    {
        return $this->hasMany(Prestasi::class, 'id_eskul', 'id_eskul');
    }

    public function kehadiran()
    {
        return $this->hasMany(Kehadiran::class, 'id_eskul', 'id_eskul');
    }
}
