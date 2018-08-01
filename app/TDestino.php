<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TDestino extends Model
{
    protected $table = "tdestinos";

    public function paquetes_destinos()
    {
        return $this->hasMany(TPaqueteDestino::class, 'iddestinos');
    }
}
