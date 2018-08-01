<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProveedorClases extends Model
{
    //
    protected $table = "proveedor_clase";

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }
}
