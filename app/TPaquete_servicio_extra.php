<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TPaquete_servicio_extra extends Model
{
    //
    protected $table = "tpaquete_servicio_extra";


    public function paquete()

    {
        return $this->belongsTo(TPaquete::class,'idpaquete');
    }
    public function servicio_extra()
    {
        return $this->belongsTo(ServicioExtra::class,'idservicio_extra');
//        return $this->hasMany(ServicioExtra::class, 'idservicio_extra');
    }
}
