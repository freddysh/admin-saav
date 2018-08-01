<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrecioHotelReservaPagos extends Model
{
    protected $table = "precio_hotel_reserva_pago";
    public function pqt_hotel_pago()
    {
        return $this->belongsTo(PaqueteCotizaciones::class, 'paquete_cotizaciones_id');
    }
}
