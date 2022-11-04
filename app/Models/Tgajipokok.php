<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tgajipokok extends Model
{
    protected $table = 't_gaji_pokok';
    public $timestamps = false;
    protected $fillable = [ 
        'nik',
        'no_ktp',
        'nilai',
        'bulan',
        'tahun',
        'updated_at',

    ]; 

    function mkategoritunjangan(){
        return $this->belongsTo('App\Models\Kategoritunjangan','kategori_tunjangan_id','id');
    }
}
