<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pembina;
use App\Models\Eskul;

class Aktivitas extends Model
{
    protected $table = 'aktivitass';
    protected $primaryKey = 'id_aktivitas';
    protected $keyType = 'int';

    protected $fillable = [
        'id_pembina',
        'id_eskul',
        'tanggal_aktivitas',
        'jam',
        'jenis_aktivitas',
        'tempat',
    ];

    public function pembina()
    {
        return $this->belongsTo(Pembina::class, 'id_pembina', 'id_pembina');
    }

    public function eskul()
    {
        return $this->belongsTo(Eskul::class, 'id_eskul', 'id_eskul');
    }
}
