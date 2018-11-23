<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liquidacion extends Model
{
    //
    protected $table = "liquidacion";
    public function itinerario_servicio()
    {
        return $this->hasMany(ItinerarioServicios::class, 'liquidacion_id');
    }
}
