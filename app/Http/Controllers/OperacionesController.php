<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Cotizacion;
use App\ItinerarioServicios;
use App\M_Servicio;
use App\PrecioHotelReserva;
use App\Proveedor;
use Illuminate\Http\Request;

class OperacionesController extends Controller
{
    //
    public function index()
    {
        $desde=date('Y-m-d');
        $hasta=date('Y-m-d');
//        dd($desde);
//        dd($hasta);
        $cotizaciones=Cotizacion::with(['paquete_cotizaciones.itinerario_cotizaciones'=> function ($query) use ($desde,$hasta) {
            $query->whereBetween('fecha', array($desde, $hasta));
        }])
            ->where('confirmado_r','ok')
            ->get();
        $clientes2=Cliente::get();
        $m_servicios=M_Servicio::get();
        $proveedores=Proveedor::get();
        session()->put('menu','operaciones');
        return view('admin.operaciones.operaciones',compact('cotizaciones','desde','hasta','clientes2','m_servicios','proveedores'));
    }
    public function Lista_fechas(Request $request)
    {
        $desde = $request->input('txt_desde');
        $hasta = $request->input('txt_hasta');
        $cotizaciones = Cotizacion::with(['paquete_cotizaciones.itinerario_cotizaciones' => function ($query) use ($desde, $hasta) {
            $query->whereBetween('fecha', array($desde, $hasta));
        }])
            ->where('confirmado_r', 'ok')
            ->get();
        $clientes2 = Cliente::get();
        $array_datos_coti= [];
        $array_datos_cotizacion= [];
        $array_hotel=[];
        foreach ($cotizaciones->sortby('fecha') as $cotizacion) {
            $clientes_ ='';
            foreach ($cotizacion->cotizaciones_cliente->where('estado','1') as $cotizacion_cliente) {
                foreach ($clientes2->where('id', $cotizacion_cliente->clientes_id) as $cliente) {
                    $clientes_= $cliente->nombres . " " . $cliente->apellidos;
                }
            }
            foreach ($cotizacion->paquete_cotizaciones->where('estado', '2') as $pqts) {
                foreach ($pqts->itinerario_cotizaciones->sortby('fecha') as $itinerario) {
                    $key1=$cotizacion->id.'_'.$pqts->id.'_'.$itinerario->id;
                    $array_datos_coti[$key1]= $cotizacion->fecha.'|'.$cotizacion->nropersonas.'|'.$clientes_.'|'.$cotizacion->web.'|'.$cotizacion->idioma_pasajeros;
                    foreach ($itinerario->itinerario_servicios->sortby('hora_llegada') as $servicio) {
                        $hora='00.00';
                        if(trim($servicio->hora_llegada)!=''){
                            $hora=str_replace(':','.',$servicio->hora_llegada);
                        }
                        $key=$cotizacion->id.'_'.$pqts->id.'_'.$itinerario->id.'_'.$hora;
                        $serv = M_Servicio::Find($servicio->m_servicios_id);
                        $nombre_comercial='Sin reserva';
                        if($servicio->proveedor_id>0) {
                            $pro1=Proveedor::where('id',$servicio->proveedor_id)->first();
                            if(count($pro1)>0){
                                if (strlen($pro1->nombre_comercial) > 0)
                                    $nombre_comercial = $pro1->nombre_comercial.', Cel:'.$pro1->telefono;
                                else
                                    $nombre_comercial = 'Sin nombre comercial';
                            }
                            else{
                                $nombre_comercial = 'Proveedor borrado de la db';
                            }
                        }
                        if(array_key_exists($key,$array_datos_cotizacion)){
                            $array_datos_cotizacion[$key].=$serv->grupo.'|'.$servicio->nombre.'<br><span class="text-11 text-danger">('.$serv->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.'</p>%';
                        }
                        else{
                            $array_datos_cotizacion[$key]=$serv->grupo.'|'.$servicio->nombre.'<br><span class="text-11 text-danger">('.$serv->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.'</p>%';
//                            $array_datos_cotizacion[$key]='|<br><span class="text-11 text-danger">()</span> <span class="text-11 text-danger">()</span><p class="text-primary"></p>%';
                        }
                    }
                    foreach ($itinerario->hotel->sortby('hora_llegada') as $hotel) {
                        $hora='Sin_hora';
                        if($hotel->hora_llegada!=''){
                            $hora=str_replace(':','.',$hotel->hora_llegada);
                        }
                        if(trim($hotel->hora_llegada)!='')
                            $hora=trim($servicio->hora_llegada);
                        $cadena='';
                        if($hotel->personas_s>0)
                            $cadena.=$hotel->personas_s.' Single';
                        if($hotel->personas_d>0)
                            $cadena.=$hotel->personas_d.' Double';
                        if($hotel->personas_m>0)
                            $cadena.=$hotel->personas_m.' Matrimonial';
                        if($hotel->personas_t>0)
                            $cadena.=$hotel->personas_t.' Triple';
                        $nombre_comercial='Sin reserva';
                        if($hotel->proveedor_id>0) {
                            $pro1=Proveedor::where('id',$hotel->proveedor_id)->first();
                            if(count($pro1)){
                                if (strlen($pro1->nombre_comercial) > 0)
                                    $nombre_comercial = $pro1->nombre_comercial.', Cel:'.$pro1->telefono;
                                else
                                    $nombre_comercial = 'Sin nombre comercial';
                            }
                            else{
                                $nombre_comercial = 'Proveedor borrado de la db';
                            }
                        }
                        $key=$cotizacion->id.'_'.$pqts->id.'_'.$itinerario->id;
                        if(array_key_exists($key,$array_hotel))
                            $array_hotel[$key].=$cadena.'<br><span class="text-11 text-danger">('.$hotel->localizacion.')</span><p class="text-primary">'.$nombre_comercial.'</p>';
                        else
                            $array_hotel[$key]=$cadena.'<br><span class="text-11 text-danger">('.$hotel->localizacion.')</span><p class="text-primary">'.$nombre_comercial.'</p>';
                    }
                }
            }
        }
//        $array_datos_cotizacion[$key]=substr($array_datos_cotizacion[$key],0,strlen($array_datos_cotizacion[$key])-1);
//            dd($array_hotel);
//        dd($array_datos_coti);
//        dd($array_datos_cotizacion);
        return view('admin.operaciones.operaciones-copia', compact('desde', 'hasta','array_datos_cotizacion','array_datos_coti','array_hotel'));
    }
    public function sp($id1,$id,$sp)
    {
        $iti=ItinerarioServicios::FindOrFail($id);
        $iti->s_p=$sp;
        $iti->save();
        return redirect()->route('book_show_path',$id1);
    }
    public function pdf($desde,$hasta)
    {
        $cotizaciones=Cotizacion::with(['paquete_cotizaciones.itinerario_cotizaciones'=> function ($query) use ($desde,$hasta) {
            $query->whereBetween('fecha', array($desde, $hasta));
        }])
            ->where('confirmado_r','ok')
            ->get();
        $clientes2=Cliente::get();
        $m_servicios=M_Servicio::get();
        $proveedores=Proveedor::get();
        $pdf = \PDF::loadView('admin.operaciones.operaciones-pdf', compact('cotizaciones','desde','hasta','clientes2','m_servicios','proveedores'))
        ->setPaper('a4', 'landscape')->setWarnings(true);
        return $pdf->download('Operaciones'.'.pdf');

    }
    public function asignar_observacion(Request $request)
    {
        $id=$request->input('id');
        $obs=$request->input('obs');
        $iti=ItinerarioServicios::FindOrFail($id);
        $iti->obs_operaciones=$obs;
        if($iti->save())
            return 1;
        else
            return 0;
    }
    public function segunda_confirmada(Request $request)
    {
        $id=$request->input('id');
        $confi2=$request->input('confi2');
        $iti=ItinerarioServicios::FindOrFail($id);
        $iti->segunda_confirmada=$confi2;
        if($iti->save())
            return 1;
        else
            return 0;
    }
    public function segunda_confirmada_hotel(Request $request)
    {
        $id=$request->input('id');
        $confi2=$request->input('confi2');
        $iti=PrecioHotelReserva::FindOrFail($id);
        $iti->segunda_confirmada=$confi2;
        if($iti->save())
            return 1;
        else
            return 0;
    }


}
