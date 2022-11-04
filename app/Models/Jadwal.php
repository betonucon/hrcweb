<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'm_jadwal';
    public $timestamps = false;
    protected $fillable = [ 
        'group_id',
        'tanggal',
        'jadwal',

    ]; 

    function mshift(){
        return $this->belongsTo('App\Models\Shift','jadwal','id');
    }
}
