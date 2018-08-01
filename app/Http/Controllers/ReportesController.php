<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Cotizacion;
use App\M_Servicio;
use App\Proveedor;
use Illuminate\Http\Request;

class ReportesController extends Controller
{
    //
    public function index()
    {
        $cotizacion=Cotizacion::where('confirmado_r','ok')->get();
        session()->put('menu','reportes');
        return view('admin.reportes.reportes',['cotizacion'=>$cotizacion]);
    }

    public function view($id)
    {
        $cotizacion = Cotizacion::FindOrFail($id);
        return view('admin.reportes.view',['cotizacion'=>$cotizacion]);
    }

}
