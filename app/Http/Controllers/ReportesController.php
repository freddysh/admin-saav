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
    public function profit()
    {
        return view('admin.reportes.profit');
    }
    public function profit_buscar(Request $request)
    {
        $desde = $request->input('desde');
        $hasta = $request->input('hasta');

        $array_profit=[];
        $cotis=Cotizacion::where('estado','2')->get();

        foreach ($cotis as $coti) {
            foreach ($coti->paquete_cotizaciones->where('estado', '2') as $pqt) {
                if ($pqt->duracion == 1) {
                    if (!array_key_exists($coti->web, $array_profit)) {
                        $array_profit[$coti->web]=$pqt->utilidad*$coti->nropersonas;
                    } else {
                        $array_profit[$coti->web]+=$pqt->utilidad*$coti->nropersonas;
                    }
                }
                else{
                    $uti=0;
                    foreach ($pqt->paquete_precios as $precio){
                        if($precio->personas_s>0){
                            $uti+=$precio->utilidad_s*$precio->personas_s;
                        }
                        if($precio->personas_d>0){
                            $uti+=$precio->utilidad_d*$precio->personas_d;
                        }
                        if($precio->personas_m>0){
                            $uti+=$precio->utilidad_m*$precio->personas_m;
                        }
                        if($precio->personas_t>0){
                            $uti+=$precio->utilidad_t*$precio->personas_t;
                        }
                    }
                    if (!array_key_exists($coti->web, $array_profit)) {
                        $array_profit[$coti->web]=$uti;
                    } else {
                        $array_profit[$coti->web]+=$uti;
                    }
                }
            }
        }
//        return dd($array_profit);
        return view('admin.reportes.profit-buscar',compact(['desde','hasta','array_profit']));
    }

}
