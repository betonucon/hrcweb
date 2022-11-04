<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $table = 'm_shift';
    public $timestamps = false;
    protected $fillable = [ 
        'shift',
        'masuk',
        'pulang',
        'aktif',

    ]; 
}
