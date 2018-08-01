<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class P_Itinerario extends Model
{
    //
    protected $table = "p_itinerario";
    public function paquete()
    {
        return $this->belongsTo(P_Paquete::class,'p_paquete_id');
    }
    public function destinos()
    {
        return $this->hasMany(P_ItinerarioDestino::class,'p_itinerario_id');
    }
    public function serivicios()
    {
        return $this->hasMany(P_ItinerarioServicios::class,'p_itinerario_id');
    }
}
