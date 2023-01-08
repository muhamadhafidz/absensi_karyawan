<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    protected $guarded = [];

    public function personalia () 
    {
        return $this->belongsTo(MasterPersonalia::class, 'master_personalia_id');
    }
}
