<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class   M_ItinerarioDestino extends Model
{
    protected $table = "m_itinerario_destino";

    public function itinerario()
    {
        return $this->belongsTo(M_Itinerario::class, 'm_itinerario_id');
    }
}
