<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vabsen extends Model
{
    protected $table = 'view_absen';
    public $timestamps = false;
    function memploye(){
        return $this->belongsTo('App\Models\Employe','nik','nik');
    }
    function mstatusabsen(){
        return $this->belongsTo('App\Models\Statusabsen','status_absen','id');
    }
}
