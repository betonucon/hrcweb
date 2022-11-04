<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'm_unit';
    protected $guarded = ['id'];
    public $timestamps = false;
    function memploye(){
        return $this->belongsTo('App\Models\Employe','nik_atasan','nik');
    }
    function mtingkatunit(){
        return $this->belongsTo('App\Models\Tingkatanunit','tingkatan_unit_id','id');
    }
    
}
