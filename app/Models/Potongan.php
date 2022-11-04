<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Potongan extends Model
{
    protected $table = 'm_potongan';
    public $timestamps = false;
    protected $fillable = [ 
        'potongan',
        'nilai',
    ]; 
}
