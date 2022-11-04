<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tunjangan extends Model
{
    protected $table = 'm_tunjangan';
    public $timestamps = false;
    protected $fillable = [ 
        'tunjangan',
        'jabatan_id',
        'kategori_tunjangan_id',
        'nilai',

    ]; 

    function mkategoritunjangan(){
        return $this->belongsTo('App\Models\Kategoritunjangan','kategori_tunjangan_id','id');
    }
}
