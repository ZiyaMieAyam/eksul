<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $table = 'prestasis';
    protected $primaryKey = 'id_prestasi';
    protected $keyType = 'int';

    protected $fillable = [
        'id_siswa',
        'id_eskul',
        'nama_prestasi',
        'tanggal_diraih',
        'tingkat',
        'bukti',
        'status',
    ];

    protected $attributes = [
        'status' => 'Pending',
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
