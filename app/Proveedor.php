<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    //
    protected $table = "proveedor";

    public function productos()
    {
        return $this->hasMany(M_Producto::class, 'proveedor_id');
    }
    public function servicios()
    {
        return $this->hasMany(ItinerarioServicios::class, 'proveedor_id');
    }
    public function hotel()
    {
        return $this->hasMany(HotelProveedor::class, 'proveedor_id');
    }
    public function hotel_reserva()
    {
        return $this->hasMany(PrecioHotelReserva::class, 'proveedor_id');
    }
    public function clases()
    {
        return $this->hasMany(ProveedorClases::class, 'proveedor_id');
    }
    public function destinos_operados()
    {
        return $this->hasMany(DestinosOpera::class, 'proveedor_id');
    }
    public function grupos_operados()
    {
        return $this->hasMany(GrupoOpera::class, 'proveedor_id');
    }
}
