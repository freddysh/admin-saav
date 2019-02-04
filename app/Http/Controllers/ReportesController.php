<?php

namespace App\Http\Controllers;

use App\Web;
use App\Cliente;
use App\Proveedor;
use App\Cotizacion;
use App\M_Servicio;
use Illuminate\Http\Request;

class ReportesController extends Controller
{
    //
    public function index()
    {
        $cotizacion=Cotizacion::where('confirmado_r','ok')->get();
        session()->put('menu','reportes');
        $grupo='HOTELS';
        $webs=Web::get();
        return view('admin.reportes.reportes',compact(['cotizacion','grupo','webs']));
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
        
        $filtro = $request->input('filtro');
        $desde = $request->input('desde');
        $hasta = $request->input('hasta');

        // dd($filtro);
        $array_profit=[];
//        $cotis=Cotizacion::where('estado','2')->whereBetween('created_at',[$desde,$hasta])->get();
        $cotis=null;
        if($filtro=='fecha de cierre'){
            $cotis=Cotizacion::where('estado','2')->whereBetween('fecha_venta',[$desde,$hasta])->get();
        }
        elseif($filtro=='fecha de llegada'){
            $cotis=Cotizacion::where('estado','2')->whereBetween('fecha',[$desde,$hasta])->get();
        }

        foreach ($cotis as $coti) {
//            if($desde<=$coti->fecha_venta&&$coti->fecha_venta<=$hasta){
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
                        $nro_personas=0;
                        //-- preguntamos si tiene hotel
                        if($pqt->paquete_precios->count()>=1){
                            
                            foreach ($pqt->paquete_precios as $precio){
                                $nro_personas=$precio->personas_s+$precio->personas_d+$precio->personas_m+$precio->personas_t;
                                if($precio->personas_s>0){
                                    $uti+=$precio->utilidad_s*$precio->personas_s;
                                }
                                if($precio->personas_d>0){
                                    $uti+=$precio->utilidad_d*$precio->personas_d*2;
                                }
                                if($precio->personas_m>0){
                                    $uti+=$precio->utilidad_m*$precio->personas_m*2;
                                }
                                if($precio->personas_t>0){
                                    $uti+=$precio->utilidad_t*$precio->personas_t*3;
                                }
                            }
                            if($nro_personas>0){
                                if (!array_key_exists($coti->web, $array_profit)) {
                                    $array_profit[$coti->web]=$uti;
                                } else {
                                    $array_profit[$coti->web]+=$uti;
                                }
                            }
                            else{
                                if (!array_key_exists($coti->web, $array_profit)) {
                                    $array_profit[$coti->web]=$pqt->utilidad*$coti->nropersonas;
                                } else {
                                    $array_profit[$coti->web]+=$pqt->utilidad*$coti->nropersonas;
                                }    
                            }
                        }
                        else{
                            if (!array_key_exists($coti->web, $array_profit)) {
                                $array_profit[$coti->web]=$pqt->utilidad*$coti->nropersonas;
                            } else {
                                $array_profit[$coti->web]+=$pqt->utilidad*$coti->nropersonas;
                            }
                        }
                    }
                }
//            }
        }
//        return dd($array_profit);
        return view('admin.reportes.profit-buscar',compact(['desde','hasta','array_profit','filtro']));
    }
    public function lista_cotizaciones($web,$desde,$hasta,$filtro)
    {
        if($filtro=='fecha de cierre'){
            $cotizaciones = Cotizacion::where('web',$web)->where('estado','2')->whereBetween('fecha_venta',[$desde,$hasta])->get();
        }
        elseif($filtro=='fecha de llegada'){
            $cotizaciones = Cotizacion::where('web',$web)->where('estado','2')->whereBetween('fecha',[$desde,$hasta])->get();
        }       
        $grupo='HOTELS';
        $webs=Web::get();
        $hotel_proveedor_id=0;
        $id=0;
        $fecha_ini=$desde;
        $fecha_fin=$hasta;
        return view('admin.reportes.cotizacion-detalle',compact(['cotizaciones','desde','hasta','filtro','grupo','webs']));
    }

}
