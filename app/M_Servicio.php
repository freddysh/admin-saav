<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class M_Servicio extends Model
{

    //
    protected $table = "m_servicios";

    public function servicio_itinerario_servicios()
    {
        return $this->hasMany(M_ItinerarioServicio::class, 'm_servicios_id');
    }
    public function producto()
    {
        return $this->hasMany(M_Producto::class, 'm_servicios_id');
    }
    public function servicio_proveedor()
    {
        return $this->hasMany(ItinerarioServicios::class, 'm_servicios_id');
    }
    // public function p_itinerario_serv_servicio()
    // {
    //     return $this->belongsTo(P_ItinerarioServicios::class,'m_servicios_id');
    // }
//    public function itinerario_servicios()
//    {
//        return $this->belongsTo(ItinerarioServicios::class, 'm_servicios_id');
//    }
}
