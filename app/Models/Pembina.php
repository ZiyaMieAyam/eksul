<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembina extends Model
{
    protected $table = 'pembinas';
    protected $primaryKey = 'id_pembina';
    protected $keyType = 'int';

    protected $fillable = [
        'id_user',
        'nip',
        'nama_pembina',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'id_user', 'id_user');
    }

    public function eskuls()
    {
        return $this->hasMany(Eskul::class, 'id_pembina', 'id_pembina');
    }

    public function aktivitas()
    {
        return $this->hasMany(Aktivitas::class, 'id_pembina', 'id_pembina');
    }
}
