<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    protected $table = "cotizaciones";

    protected $fillable = [
        'nropersonas','estado','id',
    ];

//    public function clientes()
//    {
//        return $this->belongsTo(Cliente::class, 'clientes_id');
//    }

    public function pagos()
    {
        return $this->hasMany(CotizacionesPagos::class, 'cotizaciones_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
//
//    public function pagos()
//    {
//        return $this->hasMany(Pago::class, 'cotizaciones_id');
//    }
//
    public function paquete_cotizaciones()
    {
        return $this->hasMany(PaqueteCotizaciones::class, 'cotizaciones_id');
    }

    public function cotizaciones_cliente()
    {
        return $this->hasMany(CotizacionesCliente::class, 'cotizaciones_id');
    }
    public function archivos()
    {
        return $this->hasMany(CotizacionArchivos::class, 'cotizaciones_id');
    }
}
