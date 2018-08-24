<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CotizacionArchivos extends Model
{
    protected $table = "cotizacion_archivos";
    //
    public function archivos()
    {
        return $this->belongsTo(Cotizacion::class, 'cotizaciones_id');
    }
}
