<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class P_ItinerarioDestino extends Model
{
    //
    protected $table = "p_itinerario_destinos";
    public function itinerario()
    {
        return $this->belongsTo(P_Itinerario::class,'p_itinerario_id');
    }
}
