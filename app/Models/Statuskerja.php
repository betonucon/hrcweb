<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statuskerja extends Model
{
    protected $table = 'm_status_kerja';
    public $timestamps = false;
    protected $fillable = [ 
        'status_kerja',
        'aktif',
    ]; 
}
