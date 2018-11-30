<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class M_Category extends Model
{
    //
    protected $table = "m_category";
    public function categoria_operada()
    {
        return $this->belongsTo(M_Category::class, 'm_category_id');
    }
}
