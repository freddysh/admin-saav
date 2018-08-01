<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HotelProveedor extends Model
{
    //
    protected $table = "hotel_proveedor";
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }
}
