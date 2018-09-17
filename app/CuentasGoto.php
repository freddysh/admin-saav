<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CuentasGoto extends Model
{
    //
    protected $table = "cuentas_goto";
    public function banco()
    {
        return $this->hasMany( EntidadBancaria::class, 'entidad_bancaria_id');
    }
}
