<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrupoOpera extends Model
{
    //
    protected $table = "grupos_opera";
    public function proveedor_q_opera()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }
    public function categoria()
    {
        return $this->hasMany(M_Category::class, 'm_category_id');
    }
}
