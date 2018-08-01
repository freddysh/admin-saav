<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItinerarioServicioProveedor extends Model
{
    protected $table = "itinerario_servicio_proveedor";

    public function servicio_proveedor()
    {
        return $this->hasMany(ItinerarioServicios::class, 'proveedor_id_nuevo');
    }
}
