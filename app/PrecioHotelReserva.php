<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrecioHotelReserva extends Model
{
    //
    protected $table = "precio_hotel_reserva";

    public function itinerario_dia()
    {
        return $this->belongsTo(ItinerarioCotizaciones::class, 'itinerario_cotizaciones_id');
    }
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }
//    public function pagos()
//    {
//        return $this->hasMany(PrecioHotelReservaPagos::class, 'precio_hotel_reserva_id');
//    }
}
