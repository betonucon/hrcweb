<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    protected $table = 'm_employe';
    protected $guarded = ['id'];
    public $timestamps = false;
    function mjabatan(){
        return $this->belongsTo('App\Models\Jabatan','jabatan_id','id');
    }
    function mgroup(){
        return $this->belongsTo('App\Models\Group','group_id','id');
    }
    function mpendidikan(){
        return $this->belongsTo('App\Models\Pendidikan','pendidikan_id','id');
    }
}
