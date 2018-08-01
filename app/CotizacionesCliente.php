<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CotizacionesCliente extends Model
{
    //
    protected $table = "cotizaciones_cliente";
    public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class, 'cotizaciones_id');
    }
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'clientes_id');
    }
}
