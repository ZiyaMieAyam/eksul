<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model{
    protected $table = 'gurus';
    protected $primaryKey = 'id_guru';
    protected $fillable = ['id_user','nama_guru','jabatan'];

    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}

