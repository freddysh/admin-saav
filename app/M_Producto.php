<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class M_Producto extends Model
{
    //
    protected $table = "m_producto";

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }
    public function servicio()
    {
        return $this->belongsTo(M_Servicio::class, 'm_servicios_id');
    }
}
