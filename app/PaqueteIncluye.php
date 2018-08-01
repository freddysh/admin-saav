<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaqueteIncluye extends Model
{
    //
    protected $table = "paquete_incluye";
    public function paquete_cotizaciones()
    {
        return $this->belongsTo(PaqueteCotizaciones::class, 'paquete_cotizaciones_id');
    }
}
