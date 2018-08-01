<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItinerarioCotizaciones extends Model
{
    //
    protected $table = "itinerario_cotizaciones";

    public function paquete_cotizaciones()
    {
        return $this->belongsTo(PaqueteCotizaciones::class, 'paquete_cotizaciones_id');
    }
    public function itinerario_servicios()
    {
        return $this->hasMany(ItinerarioServicios::class, 'itinerario_cotizaciones_id');
    }
    public function itinerario_destinos()
    {
        return $this->hasMany(ItinerarioDestinos::class, 'itinerario_cotizaciones_id');
    }
    public function itinerario_hora()
    {
        return $this->hasMany(ItinerarioHora::class, 'itinerario_cotizaciones_id');
    }
    public function hotel()
    {
        return $this->hasMany(PrecioHotelReserva::class, 'itinerario_cotizaciones_id');
    }
}
