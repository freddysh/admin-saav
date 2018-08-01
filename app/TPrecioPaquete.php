<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TPrecioPaquete extends Model
{
    protected $table = "tpreciopaquetes";

    public function paquete()
    {
        return $this->belongsTo(TPaquete::class, 'idpaquetes');
    }
}
