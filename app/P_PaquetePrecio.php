<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class P_PaquetePrecio extends Model
{
    //
    protected $table = "p_paquete_precio";
    public function paquete()
    {
        return $this->belongsTo(P_Paquete::class,'p_paquete_id');
    }
}
