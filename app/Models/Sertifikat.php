<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    protected $table = 'm_sertifikat';
    protected $fillable = [ 
            'sertifikat',
            'no_ktp',
            'file',
            'tipe',
        ]; 
    public $timestamps = false;
   
}
