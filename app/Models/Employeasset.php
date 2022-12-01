<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employeasset extends Model
{
    protected $table = 'm_employe_asset';
    public $timestamps = false;
    protected $guarded = ['id'];
    
    function memploye(){
        return $this->belongsTo('App\Models\Employe','nik','nik');
    }
    
}
