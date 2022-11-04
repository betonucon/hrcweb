<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Temployepotongan extends Model
{
    protected $table = 't_employe_potongan';
    public $timestamps = false;
    protected $fillable = [ 
        'potongan_id',
        'potongan',
        'nilai',
        'updated_at',
        'nik',
        'no_ktp',
        'kat',
        'bulan',
        'tahun',
        'tanggal',
        'mulai',
        'sampai',
    ]; 
}
