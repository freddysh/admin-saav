<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TItinerario extends Model
{
    protected $table = "titinerario";
    protected $fillable = [
        'iditinerario', 'dia', 'titulo', 'descripcion', 'imagen'
    ];
    public function paquete()
    {
        return $this->belongsTo(TPaquete::class, 'idpaquetes');
    }
}
