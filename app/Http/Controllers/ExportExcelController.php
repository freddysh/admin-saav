<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportExcelController extends Controller
{
    private $desde;
    private $hasta;
    private $array_datos_cotizacion;
    private $array_datos_coti;
    private $array_hotel;

    public function __construct($desde,$hasta,$array_datos_cotizacion,$array_datos_coti,$array_hotel)
    {
        $this->desde = $desde;
        $this->hasta = $hasta;
        $this->array_datos_cotizacion = $array_datos_cotizacion;
        $this->array_datos_coti = $array_datos_coti;
        $this->array_hotel = $array_hotel;
    }

    public function view(): View
    {
        return view('admin.operaciones.operaciones-copia-excel',['desde'=>$this->desde, 'hasta'=>$this->hasta,'array_datos_cotizacion'=>$this->array_datos_cotizacion,'array_datos_coti'=>$this->array_datos_coti,'array_hotel'=>$this->array_hotel]);
//        return view('exports.xml', ['data' => $this->data]);
    }
}
