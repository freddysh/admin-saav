<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntidadBancaria extends Model
{
    //
    protected $table = "entidad_bancaria";
    public function cta_goto()
    {
        return $this->belongsTo( CuentasGoto::class, 'entidad_bancaria_id');
    }
}
