<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class P_Paquete extends Model
{
    //
    protected $table = "p_paquete";
    public function precios()
    {
        return $this->hasMany(P_PaquetePrecio::class,'p_paquete_id');
    }
    public function itinerarios()
    {
        return $this->hasMany(P_Itinerario::class,'p_paquete_id');
    }
}
