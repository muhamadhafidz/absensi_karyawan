<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $guarded = [];

    protected $dates = ['clock_in', 'clock_out'];
    
    public function personalia () 
    {
        return $this->belongsTo(MasterPersonalia::class, 'master_personalia_id');
    }
}
