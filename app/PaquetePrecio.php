<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaquetePrecio extends Model
{
    //
    protected $table = "paquete_precio";
    public function paquete_cotizaciones()
    {
        return $this->belongsTo(PaqueteCotizaciones::class, 'paquete_cotizaciones_id');
    }
}
