<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Temployetunjangan extends Model
{
    protected $table = 't_tunjangan';
    public $timestamps = false;
    protected $fillable = [ 
        'tunjangan',
        'm_tunjangan_id',
        'jabatan_id',
        'kategori_tunjangan_id',
        'nilai',
        'nik',
        'no_ktp',
        'bulan',
        'tahun',
        'updated_at',

    ]; 

    function mkategoritunjangan(){
        return $this->belongsTo('App\Models\Kategoritunjangan','kategori_tunjangan_id','id');
    }
}
