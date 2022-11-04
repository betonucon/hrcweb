<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employepotongan extends Model
{
    protected $table = 'm_employe_potongan';
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
