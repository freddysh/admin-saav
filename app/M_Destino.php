<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class M_Destino extends Model
{
    //
    protected $table = "m_destino";
    public function destinos_opera()
    {
        return $this->hasMany(DestinosOpera::class, 'm_destinos_id');
    }
}
