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
    public function forma_pagos()
    {
        return $this->belongsTo(FormaPago::class, 'forma_pago_id');
    }
    public function tipo_forma_pagos()
    {
        return $this->belongsTo(TipoFormaPago::class, 'tipo_forma_pago_id');
    }
}
