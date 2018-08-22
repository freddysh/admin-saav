<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DestinosOpera extends Model
{
    protected $table = "destinos_opera";
    //
    public function proveedor()
    {
        return $this->belongsTo( Proveedor::class, 'proveedor_id');
    }
    public function destinos()
    {
        return $this->belongsTo(M_Destino::class, 'm_destinos_id');
    }
}
