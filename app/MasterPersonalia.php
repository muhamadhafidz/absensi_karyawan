<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterPersonalia extends Model
{
    protected $guarded = [];

    public function jabatan () 
    {
        return $this->belongsTo(MasterJabatan::class, 'master_jabatan_id');
    }

    public function divisi () 
    {
        return $this->belongsTo(MasterDivision::class, 'master_division_id');
    }

    public function user () 
    {
        return $this->hasOne(User::class, 'master_personalia_id');
    }
    
    public function izin () 
    {
        return $this->hasMany(Izin::class, 'master_personalia_id');
    }

    public function penggajian () 
    {
        return $this->hasMany(Penggajian::class, 'master_personalia_id');
    }

    public function absensi () 
    {
        return $this->hasMany(Absensi::class, 'master_personalia_id');
    }

    
}
