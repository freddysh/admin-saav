<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItinerarioServiciosAcumPago extends Model
{
    //
    protected $table = "itinerario_servicios_acum_pago";

    public function pagos_paqt_cotizaciones()
    {
        return $this->belongsTo(PaqueteCotizaciones::class, 'paquete_cotizaciones_id');
    }

}
