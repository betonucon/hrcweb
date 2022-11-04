<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    protected $table = 't_cuti';
    public $timestamps = false;
    protected $fillable = [ 
        'nik',
        'bulan',
        'tahun',
        'cuti',
    ]; 
}
