<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoFormaPago extends Model
{
    //
    protected $table='tipo_forma_pago';
    
    // public function pagos_cliente()
    // {
    //     return $this->belongsTo(PaqueteCotizaciones::class, 'paquete_cotizaciones_id');
    // }
    public function paquete_tipo_pago_cliente()
    {
        return $this->hasMany(PaquetePagoCliente::class, 'tipo_forma_pago_id');
    }
}
