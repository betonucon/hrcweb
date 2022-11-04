<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lembur extends Model
{
    protected $table = 't_lembur';
    public $timestamps = false;
    protected $fillable = [ 
        'nik',
        'waktu_masuk',
        'jam_masuk',
        'waktu_pulang',
        'jam_pulang',
        'tanggal',
        'status_absen',
        'total',
        'group_id',
        'approve',
        'status',
        'approve_date',
        'created_at',

    ]; 
    
    function memploye(){
        return $this->belongsTo('App\Models\Employe','nik','nik');
    }
    function mstatusabsen(){
        return $this->belongsTo('App\Models\Statusabsen','status_absen','id');
    }
}
