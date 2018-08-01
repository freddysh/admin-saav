<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItinerarioServiciosPagos extends Model
{
    //
    protected $table = "itinerario_servicios_pago";
    public function servicio()
    {
        return $this->belongsTo(ItinerarioServicios::class, 'itinerario_servicios_id');
    }
}
