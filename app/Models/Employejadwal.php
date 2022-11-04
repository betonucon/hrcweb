<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employejadwal extends Model
{
    protected $table = 't_employe_jadwal';
    public $timestamps = false;
    protected $fillable = [ 
        'group_id',
        'tanggal',
        'jadwal',
        'nik',
        'waktu_masuk',
        'waktu_pulang',

    ]; 
}
