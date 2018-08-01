<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CotizacionesPagos extends Model
{
    //
    protected $table = "cotizaciones_pagos";
    public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class, 'cotizaciones_id');
    }
}
