<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employedokumen extends Model
{
    protected $table = 'm_dokumen_employe';
    public $timestamps = false;
    protected $fillable = [ 
        'dokumen_id',
        'no_ktp',
        'file',
    ]; 
}
