<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class P_ItinerarioServicios extends Model
{
    //
    protected $table = "p_itinerario_servicios";
    public function itinerario()
    {
        return $this->hasMany(P_Itinerario::class,'p_itinerario_id');
    }
    // public function servicio()
    // {
    //     return $this->hasMany(M_Servicio::class,'m_servicios_id');
    // }
}
