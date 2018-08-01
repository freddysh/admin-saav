<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaqueteServicio extends Model
{
    //
    protected $table = "paquete_servicio";
    public function paquete_cotizaciones()
    {
        return $this->hasMany(PaqueteCotizaciones::class, 'paquete_cotizaciones_id');
    }
}
