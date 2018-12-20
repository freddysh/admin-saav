<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaquetePagina extends Model
{
    //
    protected $table = "paquete_pagina";
    public function paquete()
    {
        return $this->belongsTo(P_Paquete::class, 'p_paquete_id');
    }
}
