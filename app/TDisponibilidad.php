<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TDisponibilidad extends Model
{
    protected $table = "tdisponibilidad";

    public function paquete()

    {
        return $this->belongsTo(TPaquete::class, 'idpaquete');
    }
}
