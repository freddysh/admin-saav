<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TPaquete extends Model
{
    protected $table = "tpaquetes";

    public function itinerario()
    {
        return $this->hasMany(TItinerario::class, 'idpaquetes');
    }

    public function precio_paquetes()
    {
        return $this->hasMany(TPrecioPaquete::class, 'idpaquetes');
    }

    public function paquetes_destinos()
    {
        return $this->hasMany(TPaqueteDestino::class, 'idpaquetes');
    }
    public function disponibilidad()
    {
        return $this->hasMany(TDisponibilidad::class, 'idpaquete');
    }
    public function paquete_servicio_extra()
    {
        return $this->hasMany(TPaquete_servicio_extra::class, 'idpaquete');
    }


    public function paquetes_categoria()
    {
        return $this->hasMany(TPaqueteCategoria::class, 'idpaquetes');
    }

}
