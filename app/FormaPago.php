<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormaPago extends Model
{
    //
    protected $table='forma_pago';
     
    // public function pagos_cliente()
    // {
    //     return $this->belongsTo(PaqueteCotizaciones::class, 'paquete_cotizaciones_id');
    // }
    public function paquete_pago_cliente()
    {
        return $this->hasMany(PaquetePagoCliente::class, 'forma_pago_id');
    }
}
