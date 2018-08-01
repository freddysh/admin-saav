<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class M_Itinerario extends Model
{
    //
    protected $table = "m_itinerario";

    public function destinos()
    {
        return $this->hasMany(M_ItinerarioDestino::class, 'm_itinerario_id');
    }
    public function itinerario_itinerario_servicios()
    {
        return $this->hasMany(M_ItinerarioServicio::class, 'm_itinerario_id');
    }
}
