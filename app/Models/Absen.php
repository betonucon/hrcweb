<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    protected $table = 't_absen';
    public $timestamps = false;
    protected $fillable = [ 
        'nik',
        'waktu',
        'tanggal',
        'status',
        'lat',
        'long',
        'jam_aktual',
        'status_absen',
        'foto',
        'alasan',
        'approve',
        'group_id',

    ]; 
    
    function memploye(){
        return $this->belongsTo('App\Models\Employe','nik','nik');
    }
    function mstatusabsen(){
        return $this->belongsTo('App\Models\Statusabsen','status_absen','id');
    }
}
