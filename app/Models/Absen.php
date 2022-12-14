<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    protected $table = 't_absen';
    public $timestamps = false;
    protected $guarded = ['id'];
    
    function memploye(){
        return $this->belongsTo('App\Models\Employe','nik','nik');
    }
    function mstatusabsen(){
        return $this->belongsTo('App\Models\Statusabsen','status_absen','id');
    }
}
