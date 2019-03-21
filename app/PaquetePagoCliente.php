<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaquetePagoCliente extends Model
{
    //
    protected $table='paquete_pagos_cliente';
    
    public function pagos_cliente()
    {
        return $this->belongsTo(PaqueteCotizaciones::class, 'paquete_cotizaciones_id');
    }
}
