<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rekapabsen extends Model
{
    protected $table = 't_rekap_absen';
    public $timestamps = false;
    protected $fillable = [ 
        'nik',
        'waktu_masuk',
        'jam_masuk',
        'waktu_pulang',
        'jam_pulang',
        'tanggal',
        'status_absen',
        'telat',
        'group_id',
        'status',

    ]; 
    
    function memploye(){
        return $this->belongsTo('App\Models\Employe','nik','nik');
    }
    function mstatusabsen(){
        return $this->belongsTo('App\Models\Statusabsen','status_absen','id');
    }
}
