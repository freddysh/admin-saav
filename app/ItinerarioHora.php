<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItinerarioHora extends Model
{
    //
    protected $table = "itinerario_hora";
    public function itinerario_cotizaciones()
    {
        return $this->belongsTo(ItinerarioCotizaciones::class, 'itinerario_cotizaciones_id');
    }
}
