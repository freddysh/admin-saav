<?php

namespace App\Http\Controllers;

use App\Web;
use App\Cliente;
use App\Proveedor;
use App\Cotizacion;
use App\M_Servicio;
use App\PrecioHotelReserva;
use App\ItinerarioServicios;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OperacionesController extends Controller
{
    //
    public function index()
    {
        set_time_limit(0);
        $desde=date('Y-m-d');
        $hasta=date('Y-m-d');
        $cotizaciones = Cotizacion::with(['paquete_cotizaciones.itinerario_cotizaciones' => function ($query) use ($desde, $hasta) {
            $query->whereBetween('fecha', array($desde, $hasta));
        }])
            ->where('confirmado_r', 'ok')
            ->get();
        $clientes2 = Cliente::get();
        $array_datos_coti= array();
        $array_datos_cotizacion= array();
        $array_hotel=array();
       
        foreach ($cotizaciones->sortby('fecha') as $cotizacion) {
            $cel='No tiene';
            foreach ($cotizacion->cotizaciones_cliente->where('estado','1') as $cotizacion_cliente) {
                if(strlen($cotizacion_cliente->cliente->telefono) > 4){
                    $cel=$cotizacion_cliente->cliente->telefono;
                }
            }
            $clientes_='<span class="text-success">'.$cotizacion->codigo.'</span> <span class="text-primary">'.$cotizacion->nombre_pax.', Cel.'.$cel.'</span> ';
            
            foreach ($cotizacion->paquete_cotizaciones->where('estado', '2') as $pqts) {
                foreach ($pqts->itinerario_cotizaciones->where('fecha','>=',$desde)->where('fecha','<=',$hasta)->sortby('fecha') as $itinerario) {
                    $key1=$cotizacion->id.'_'.$pqts->id.'_'.$itinerario->id;
                    $array_datos_coti[$key1]=Array('anulado'=>$cotizacion->anulado,'fecha'=>$itinerario->fecha,'datos'=>$itinerario->fecha.'|'.$cotizacion->nropersonas.'|'.$clientes_.'|'.$cotizacion->web.'|'.$cotizacion->idioma_pasajeros.'|'.$itinerario->notas);
                    foreach ($itinerario->itinerario_servicios->sortby('hora_llegada') as $servicio) {
                        $hora='00.00';
                        if(trim($servicio->hora_llegada)!=''){
                            $hora=str_replace(':','.',$servicio->hora_llegada);
                        }
                        $key=$cotizacion->id.'_'.$pqts->id.'_'.$itinerario->id.'_'.$hora;
                        $nombre_comercial='Sin reserva';
                        if($servicio->proveedor_id>0) {
                            // $pro1=null;
                            $pro1=Proveedor::where('id',$servicio->proveedor_id)->first();
                                if(count((array)$pro1)>0){
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
                            $horario='';
                            if($servicio->grupo=='TRAINS'){
                                $horario='['.$servicio->salida.'-'.$servicio->llegada.']<br>';
                            }
                            $clase='';
                            if($servicio->anulado=='1')
                                $clase='alert alert-danger';
                                
                            $array_datos_cotizacion[$key]['dates']= $itinerario->fecha.'_'.$hora;
                            $array_datos_cotizacion[$key]['anulado']=$cotizacion->anulado;
                            $array_datos_cotizacion[$key]['servicio'].= $servicio->grupo.'|<div class="'.$clase.'">'.$servicio->nombre.'<br>'.$horario.'<span class="text-11 text-danger">('.$servicio->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.'</p></div>%';
                        }
                        else{
                            $horario='';
                            if($servicio->grupo=='TRAINS'){
                                $horario='['.$servicio->salida.'-'.$servicio->llegada.']<br>';
                            }
                            $clase='';
                            if($servicio->anulado=='1')
                                $clase='alert alert-danger';
                            $array_datos_cotizacion[$key]=array('dates'=>$itinerario->fecha.'_'.$hora,'anulado'=>$cotizacion->anulado,'servicio'=>$servicio->grupo.'|<div class="'.$clase.'">'.$servicio->nombre.'<br>'.$horario.'<span class="text-11 text-danger">('.$servicio->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.'</p></div>%');

                        }
                    }
                    foreach ($itinerario->hotel->sortby('hora_llegada') as $hotel) {
                        $hora='00.00';
                        if(trim($hotel->hora_llegada)!='')
                            $hora=str_replace(':','.',$hotel->hora_llegada);
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
                            if(count((array)$pro1)>0){
                                if (strlen($pro1->nombre_comercial) > 0)
                                    $nombre_comercial = $pro1->nombre_comercial.', Cel:'.$pro1->telefono;
                                else
                                    $nombre_comercial = 'Sin nombre comercial';
                            }
                            else{
                                $nombre_comercial = 'Proveedor borrado de la db';
                            }
                        }
                        $key=$cotizacion->id.'_'.$pqts->id.'_'.$itinerario->id.'_'.$hora;
                        if(array_key_exists($key,$array_hotel))
                            $array_hotel[$key].=$cadena.'<br><span class="text-11 text-danger">('.$hotel->localizacion.')</span><p class="text-primary">'.$nombre_comercial.'</p>';
                        else
                            $array_hotel[$key]=$cadena.'<br><span class="text-11 text-danger">('.$hotel->localizacion.')</span><p class="text-primary">'.$nombre_comercial.'</p>';
                    }
                }
            }
        }
        $sort=array();
        foreach ($array_datos_coti as $key => $part) {
            $sort[$key] = strtotime($part['fecha']);
        }
        array_multisort($sort, SORT_ASC, $array_datos_coti);
        $sort1=array();
        foreach ($array_datos_cotizacion as $key => $part) {
            $sort1[$key] = strtotime($part['dates']);
        }
        array_multisort($sort1, SORT_ASC, $array_datos_cotizacion);
        session()->put('menu','operaciones');
        $grupo='HOTELS';
        $webs=Web::get();
        $hotel_proveedor_id = 0;
        $id=0;
        $fecha_ini = date("Y-m-d");
        $fecha_fin = date("Y-m-d");
        $web = 'gotoperu.com';
        $filtro='filtro';
        return view('admin.operaciones.operaciones-copia', compact(['desde', 'hasta', 'array_datos_cotizacion', 'array_datos_coti', 'array_hotel', 'grupo', 'webs']));
    }
    public function index_uno(){
        set_time_limit(0);
        $desde=date('Y-m-d');
        $hasta=date('Y-m-d');
        $cotizaciones = Cotizacion::with(['paquete_cotizaciones.itinerario_cotizaciones' => function ($query) use ($desde, $hasta) {
            $query->whereBetween('fecha', array($desde, $hasta));
        }])->get();
        // dd($cotizaciones);
        /*===========================================================================================*/
        $arreglo_de_datos=array();
        foreach ($cotizaciones->sortby('fecha') as $cotizacion) {
            $cel='No tiene';
            foreach ($cotizacion->cotizaciones_cliente->where('estado','1') as $cotizacion_cliente) {
                if(strlen($cotizacion_cliente->cliente->telefono) > 4){
                    $cel=$cotizacion_cliente->cliente->telefono;
                }
            }
            $clientes_='<span class="text-success">'.$cotizacion->codigo.'</span> <span class="text-primary">'.$cotizacion->nombre_pax.', Cel.'.$cel.'</span> ';
            foreach ($cotizacion->paquete_cotizaciones->where('estado', '2') as $pqts) {
                foreach ($pqts->itinerario_cotizaciones->where('fecha','>=',$desde)->where('fecha','<=',$hasta)->sortby('fecha') as $itinerario) {
                    $key1=$cotizacion->id.'_'.$pqts->id.'_'.$itinerario->id;
                    $array_datos_coti[$key1]=Array('fecha'=>$itinerario->fecha,'datos'=>$itinerario->fecha.'|'.$cotizacion->nropersonas.'|'.$clientes_.'|'.$cotizacion->web.'|'.$cotizacion->idioma_pasajeros.'|'.$itinerario->notas);
                    foreach ($itinerario->itinerario_servicios->sortby('hora_llegada') as $servicio) {
                        $hora='00.00';
                        if(trim($servicio->hora_llegada)!=''){
                            $hora=str_replace(':','.',$servicio->hora_llegada);
                        }
                        $key=$cotizacion->id.'_'.$pqts->id.'_'.$itinerario->id.'_'.$hora;
                        $nombre_comercial='Sin reserva';
                        if($servicio->proveedor_id>0) {
                            $pro1=Proveedor::where('id',$servicio->proveedor_id)->first();
                            if(count((array)$pro1)>0){
                                if (strlen($pro1->nombre_comercial) > 0)
                                    $nombre_comercial = $pro1->nombre_comercial.', Cel:'.$pro1->telefono;
                                else
                                    $nombre_comercial = 'Sin nombre comercial';
                            }
                            else{
                                $nombre_comercial = 'Proveedor borrado de la db';
                            }
                        }
                        if($this->search($arreglo_de_datos,$key,$servicio->grupo)){
                            $horario='';
                            if($servicio->grupo=='TRAINS'){
                                $horario='['.$servicio->salida.'-'.$servicio->llegada.']<br>';
                            }
                            $clase='';
                            $anulado='';
                            if($servicio->anulado=='1'){
                                $clase='alert alert-danger';
                                $anulado='<b>Anulado</b>';
                            }
                            
                            // $arreglo_de_datos[$key]['OBSERVACIONES'] = $itinerario->notas;

                            $arreglo_de_datos[$key][$servicio->grupo] .= '<div class="'.$clase.'">'.$servicio->nombre.'<br>'.$horario.'<span class="text-11 text-danger">('.$servicio->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.' ,Cod:'.$servicio->codigo_verificacion.'</p>'.$anulado.'</div>';
                        }
                        else{
                            $horario='';
                            if($servicio->grupo=='TRAINS'){
                                $horario='['.$servicio->salida.'-'.$servicio->llegada.']<br>';
                            }
                            $clase='';
                            $anulado='';
                            if($servicio->anulado=='1'){
                                $clase='alert alert-danger';
                                $anulado='<b>Anulado</b>';
                            }
                            $var_TOURS='';
                            $var_HOTELS='';
                            $var_REPRESENT='';
                            $var_MOVILID='';
                            $var_ENTRANCES='';
                            $var_FOOD='';
                            $var_TRAINS='';
                            $var_FLIGHTS='';
                            $var_OTHERS='';
                            $var_OBSERVACIONES='';
                            
                            if($servicio->grupo=='TOURS'){
                                $var_TOURS='<div class="'.$clase.'">'.$servicio->nombre.'<br>'.$horario.'<span class="text-11 text-danger">('.$servicio->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.' ,Cod:'.$servicio->codigo_verificacion.'</p>'.$anulado.'</div>';
                            }
                            if($servicio->grupo=='REPRESENT'){
                                $var_REPRESENT='<div class="'.$clase.'">'.$servicio->nombre.'<br>'.$horario.'<span class="text-11 text-danger">('.$servicio->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.' ,Cod:'.$servicio->codigo_verificacion.'</p>'.$anulado.'</div>';
                            }
                            if($servicio->grupo=='MOVILID'){
                                $var_MOVILID='<div class="'.$clase.'">'.$servicio->nombre.'<br>'.$horario.'<span class="text-11 text-danger">('.$servicio->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.' ,Cod:'.$servicio->codigo_verificacion.'</p>'.$anulado.'</div>';
                            }
                            if($servicio->grupo=='ENTRANCES'){
                                $var_ENTRANCES='<div class="'.$clase.'">'.$servicio->nombre.'<br>'.$horario.'<span class="text-11 text-danger">('.$servicio->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.' ,Cod:'.$servicio->codigo_verificacion.'</p>'.$anulado.'</div>';
                            }
                            if($servicio->grupo=='FOOD'){
                                $var_FOOD='<div class="'.$clase.'">'.$servicio->nombre.'<br>'.$horario.'<span class="text-11 text-danger">('.$servicio->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.' ,Cod:'.$servicio->codigo_verificacion.'</p>'.$anulado.'</div>';
                            }
                            if($servicio->grupo=='TRAINS'){
                                $var_TRAINS='<div class="'.$clase.'">'.$servicio->nombre.'<br>'.$horario.'<span class="text-11 text-danger">('.$servicio->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.' ,Cod:'.$servicio->codigo_verificacion.'</p>'.$anulado.'</div>';
                            }
                            if($servicio->grupo=='FLIGHTS'){
                                $var_FLIGHTS='<div class="'.$clase.'">'.$servicio->nombre.'<br>'.$horario.'<span class="text-11 text-danger">('.$servicio->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.' ,Cod:'.$servicio->codigo_verificacion.'</p>'.$anulado.'</div>';
                            }
                            if($servicio->grupo=='OTHERS'){
                                $var_OTHERS='<div class="'.$clase.'">'.$servicio->nombre.'<br>'.$horario.'<span class="text-11 text-danger">('.$servicio->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.' ,Cod:'.$servicio->codigo_verificacion.'</p>'.$anulado.'</div>';
                            }
                            

                            $arreglo_de_datos[$key] = array('FECHA'=>$itinerario->fecha,
                            'HORA'=>$hora,
                            'CODIGO'=>$cotizacion->codigo,
                            'DATOS'=>$itinerario->fecha.'|'.$cotizacion->nropersonas.'|'.$clientes_.'|'.$cotizacion->web.'|'.$cotizacion->idioma_pasajeros.'|'.$itinerario->notas,
                            'COTIZACION_STATE'=>$cotizacion->anulado,
                            'TOURS'=>$var_TOURS,'HOTELS'=>$var_HOTELS,'REPRESENT'=>$var_REPRESENT,'MOVILID'=>$var_MOVILID,'ENTRANCES'=>$var_ENTRANCES,
                            'FOOD'=>$var_FOOD,'TRAINS'=>$var_TRAINS,'FLIGHTS'=>$var_FLIGHTS,'OTHERS'=>$var_OTHERS,'OBSERVACIONES'=>$itinerario->notas);                            
                        }
                    }
                    foreach ($itinerario->hotel->sortby('hora_llegada') as $hotel) {
                        $hora='00.00';
                        if(trim($hotel->hora_llegada)!='')
                            $hora=str_replace(':','.',$hotel->hora_llegada);
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
                            if(count((array)$pro1)>0){
                                if (strlen($pro1->nombre_comercial) > 0)
                                    $nombre_comercial = $pro1->nombre_comercial.', Cel:'.$pro1->telefono;
                                else
                                    $nombre_comercial = 'Sin nombre comercial';
                            }
                            else{
                                $nombre_comercial = 'Proveedor borrado de la db';
                            }
                        }
                        $clase='';
                        $anulado='';
                        if($hotel->anulado=='1'){
                            $clase='alert alert-danger';
                            $anulado='<b>Anulado</b>';
                        }
                        $key=$cotizacion->id.'_'.$pqts->id.'_'.$itinerario->id.'_'.$hora;
                        // dd($this->search($arreglo_de_datos,$key,'HOTELS'));
                        
                        if($this->search($arreglo_de_datos,$key,'HOTELS')){
                            $arreglo_de_datos[$key]['HOTELS'].= '<div class="'.$clase.'">'.$cadena.'<br><span class="text-11 text-danger">('.$hotel->localizacion.')</span><p class="text-primary">'.$nombre_comercial.' ,Cod:'.$hotel->codigo_verificacion.'</p>'.$anulado.'</div>';
                        }
                        else{
                            $var_TOURS='';
                            $var_HOTELS='';
                            $var_REPRESENT='';
                            $var_MOVILID='';
                            $var_ENTRANCES='';
                            $var_FOOD='';
                            $var_TRAINS='';
                            $var_FLIGHTS='';
                            $var_OTHERS='';
                            $var_OBSERVACIONES='';
                            $var_HOTELS= '<div class="'.$clase.'">'.$cadena.'<br><span class="text-11 text-danger">('.$hotel->localizacion.')</span><p class="text-primary">'.$nombre_comercial.' ,Cod:'.$hotel->codigo_verificacion.'</p>'.$anulado.'</div>';

                            $arreglo_de_datos[$key] = array('FECHA'=>$itinerario->fecha,
                            'HORA'=>$hora,
                            'CODIGO'=>$cotizacion->codigo,
                            'DATOS'=>$itinerario->fecha.'|'.$cotizacion->nropersonas.'|'.$clientes_.'|'.$cotizacion->web.'|'.$cotizacion->idioma_pasajeros.'|'.$itinerario->notas,
                            'COTIZACION_STATE'=>$cotizacion->anulado,
                            'TOURS'=>$var_TOURS,'HOTELS'=>$var_HOTELS,'REPRESENT'=>$var_REPRESENT,'MOVILID'=>$var_MOVILID,'ENTRANCES'=>$var_ENTRANCES,
                            'FOOD'=>$var_FOOD,'TRAINS'=>$var_TRAINS,'FLIGHTS'=>$var_FLIGHTS,'OTHERS'=>$var_OTHERS,'OBSERVACIONES'=>$itinerario->notas);
                        }
                    }
                }
            }
        }
        $sort1=array();
        $sort2=array();
        $sort3=array();
        foreach ($arreglo_de_datos as $key => $part) {
            $sort1[$key] = strtotime($part['FECHA']);
            $sort2[$key] = strtotime($part['HORA']);
            $sort3[$key] = strtotime($part['CODIGO']);
        }
        array_multisort($sort1, SORT_ASC,$sort2, SORT_ASC,$sort3, SORT_ASC, $arreglo_de_datos);
        /*===========================================================================================*/
        // dd($arreglo_de_datos);
        $grupo='HOTELS';
        $webs=Web::get();
        return view('admin.operaciones.operaciones-copia-2', compact('desde', 'hasta','grupo','webs','arreglo_de_datos'));
    }
    public function Lista_fechas(Request $request)
    {
        set_time_limit(0);
        $desde = $request->input('txt_desde');
        $hasta = $request->input('txt_hasta');
        $cotizaciones = Cotizacion::with(['paquete_cotizaciones.itinerario_cotizaciones' => function ($query) use ($desde, $hasta) {
            $query->whereBetween('fecha', array($desde, $hasta));
        }])->get();
        $clientes2 = Cliente::get();
        $array_datos_coti = array();
        $array_datos_cotizacion = array();
        $array_hotel= array();

        foreach ($cotizaciones->sortby('fecha') as $cotizacion) {
            $cel='No tiene';
            foreach ($cotizacion->cotizaciones_cliente->where('estado','1') as $cotizacion_cliente) {
                if(strlen($cotizacion_cliente->cliente->telefono) > 4){
                    $cel=$cotizacion_cliente->cliente->telefono;
                }
            }
            $clientes_='<span class="text-success">'.$cotizacion->codigo.'</span> <span class="text-primary">'.$cotizacion->nombre_pax.', Cel.'.$cel.'</span> ';
            foreach ($cotizacion->paquete_cotizaciones->where('estado', '2') as $pqts) {
                foreach ($pqts->itinerario_cotizaciones->where('fecha','>=',$desde)->where('fecha','<=',$hasta)->sortby('fecha') as $itinerario) {
                    $key1=$cotizacion->id.'_'.$pqts->id.'_'.$itinerario->id;
                    $array_datos_coti[$key1]=Array('fecha'=>$itinerario->fecha,'datos'=>$itinerario->fecha.'|'.$cotizacion->nropersonas.'|'.$clientes_.'|'.$cotizacion->web.'|'.$cotizacion->idioma_pasajeros.'|'.$itinerario->notas);
                    foreach ($itinerario->itinerario_servicios->sortby('hora_llegada') as $servicio) {
                        $hora='00.00';
                        if(trim($servicio->hora_llegada)!=''){
                            $hora=str_replace(':','.',$servicio->hora_llegada);
                        }
                        $key=$cotizacion->id.'_'.$pqts->id.'_'.$itinerario->id.'_'.$hora;
                        $nombre_comercial='Sin reserva';
                        if($servicio->proveedor_id>0) {
                            $pro1=Proveedor::where('id',$servicio->proveedor_id)->first();
                            if(count((array)$pro1)>0){
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
                            $horario='';
                            if($servicio->grupo=='TRAINS'){
                                $horario='['.$servicio->salida.'-'.$servicio->llegada.']<br>';
                            }
                            $clase='';
                            if($servicio->anulado=='1')
                                $clase='alert alert-danger';
                            $array_datos_cotizacion[$key]['dates']= $itinerario->fecha.'_'.$hora;
                            $array_datos_cotizacion[$key]['anulado']=$cotizacion->anulado;
                            $array_datos_cotizacion[$key]['servicio'].= $servicio->grupo.'|<div class="'.$clase.'">'.$servicio->nombre.'<br>'.$horario.'<span class="text-11 text-danger">('.$servicio->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.' ,Cod:'.$servicio->codigo_verificacion.'</p></div>%';
                        }
                        else{
                            $horario='';
                            if($servicio->grupo=='TRAINS'){
                                $horario='['.$servicio->salida.'-'.$servicio->llegada.']<br>';
                            }
                            $clase='';
                            if($servicio->anulado=='1')
                                $clase='alert alert-danger';
                            $array_datos_cotizacion[$key]=array('dates'=>$itinerario->fecha.'_'.$hora,'anulado'=>$cotizacion->anulado,'servicio'=>$servicio->grupo.'|<div class="'.$clase.'">'.$servicio->nombre.'<br>'.$horario.'<span class="text-11 text-danger">('.$servicio->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.' ,Cod:'.$servicio->codigo_verificacion.'</p></div>%');
                        }
                    }
                    foreach ($itinerario->hotel->sortby('hora_llegada') as $hotel) {
                        $hora='00.00';
                        if(trim($hotel->hora_llegada)!='')
                            $hora=str_replace(':','.',$hotel->hora_llegada);
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
                            if(count((array)$pro1)>0){
                                if (strlen($pro1->nombre_comercial) > 0)
                                    $nombre_comercial = $pro1->nombre_comercial.', Cel:'.$pro1->telefono;
                                else
                                    $nombre_comercial = 'Sin nombre comercial';
                            }
                            else{
                                $nombre_comercial = 'Proveedor borrado de la db';
                            }
                        }
                        $key=$cotizacion->id.'_'.$pqts->id.'_'.$itinerario->id.'_'.$hora;
                        if(array_key_exists($key,$array_hotel))
                            $array_hotel[$key].=$cadena.'<br><span class="text-11 text-danger">('.$hotel->localizacion.')</span><p class="text-primary">'.$nombre_comercial.' ,Cod:'.$hotel->codigo_verificacion.'</p>';
                        else
                            $array_hotel[$key]=$cadena.'<br><span class="text-11 text-danger">('.$hotel->localizacion.')</span><p class="text-primary">'.$nombre_comercial.' ,Cod:'.$hotel->codigo_verificacion.'</p>';
                    }
                }
            }
        }
        $sort=array();
        foreach ($array_datos_coti as $key => $part) {
            $sort[$key] = strtotime($part['fecha']);
        }
        array_multisort($sort, SORT_ASC, $array_datos_coti);
        //-- ordenamos el multiarray
        $sort1=array();
        foreach ($array_datos_cotizacion as $key => $part) {
            $sort1[$key] = strtotime($part['dates']);
        }
        array_multisort($sort1, SORT_ASC, $array_datos_cotizacion);
        $grupo='HOTELS';
        $webs=Web::get();
        return view('admin.operaciones.operaciones-copia', compact('desde', 'hasta','array_datos_cotizacion','array_datos_coti','array_hotel','grupo','webs'));
    }
    public function Lista_fechas_uno(Request $request)
    {
        set_time_limit(0);
        $desde = $request->input('txt_desde');
        $hasta = $request->input('txt_hasta');
        $cotizaciones = Cotizacion::with(['paquete_cotizaciones.itinerario_cotizaciones' => function ($query) use ($desde, $hasta) {
            $query->whereBetween('fecha', array($desde, $hasta));
        }])->get();

        /*===========================================================================================*/
        $arreglo_de_datos=array();
        foreach ($cotizaciones->sortby('fecha') as $cotizacion) {
            $cel='No tiene';
            foreach ($cotizacion->cotizaciones_cliente->where('estado','1') as $cotizacion_cliente) {
                if(strlen($cotizacion_cliente->cliente->telefono) > 4){
                    $cel=$cotizacion_cliente->cliente->telefono;
                }
            }
            $clientes_='<span class="text-success">'.$cotizacion->codigo.'</span> <span class="text-primary">'.$cotizacion->nombre_pax.', Cel.'.$cel.'</span> ';
            foreach ($cotizacion->paquete_cotizaciones->where('estado', '2') as $pqts) {
                foreach ($pqts->itinerario_cotizaciones->where('fecha','>=',$desde)->where('fecha','<=',$hasta)->sortby('fecha') as $itinerario) {
                    $key1=$cotizacion->id.'_'.$pqts->id.'_'.$itinerario->id;
                    $array_datos_coti[$key1]=Array('fecha'=>$itinerario->fecha,'datos'=>$itinerario->fecha.'|'.$cotizacion->nropersonas.'|'.$clientes_.'|'.$cotizacion->web.'|'.$cotizacion->idioma_pasajeros.'|'.$itinerario->notas);
                    foreach ($itinerario->itinerario_servicios->sortby('hora_llegada') as $servicio) {
                        $hora='00.00';
                        if(trim($servicio->hora_llegada)!=''){
                            $hora=str_replace(':','.',$servicio->hora_llegada);
                        }
                        $key=$cotizacion->id.'_'.$pqts->id.'_'.$itinerario->id.'_'.$hora;
                        $nombre_comercial='Sin reserva';
                        if($servicio->proveedor_id>0) {
                            $pro1=Proveedor::where('id',$servicio->proveedor_id)->first();
                            if(count((array)$pro1)>0){
                                if (strlen($pro1->nombre_comercial) > 0)
                                    $nombre_comercial = $pro1->nombre_comercial.', Cel:'.$pro1->telefono;
                                else
                                    $nombre_comercial = 'Sin nombre comercial';
                            }
                            else{
                                $nombre_comercial = 'Proveedor borrado de la db';
                            }
                        }
                        if($this->search($arreglo_de_datos,$key,$servicio->grupo)){
                            $horario='';
                            if($servicio->grupo=='TRAINS'){
                                $horario='['.$servicio->salida.'-'.$servicio->llegada.']<br>';
                            }
                            $clase='';
                            $anulado='';
                            if($servicio->anulado=='1'){
                                $clase='alert alert-danger';
                                $anulado='<b>Anulado</b>';
                            }
                            
                            // $arreglo_de_datos[$key]['OBSERVACIONES'] = $itinerario->notas;

                            $arreglo_de_datos[$key][$servicio->grupo] .= '<div class="'.$clase.'">'.$servicio->nombre.'<br>'.$horario.'<span class="text-11 text-danger">('.$servicio->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.' ,Cod:'.$servicio->codigo_verificacion.'</p>'.$anulado.'</div>';
                        }
                        else{
                            $horario='';
                            if($servicio->grupo=='TRAINS'){
                                $horario='['.$servicio->salida.'-'.$servicio->llegada.']<br>';
                            }
                            $clase='';
                            $anulado='';
                            if($servicio->anulado=='1'){
                                $clase='alert alert-danger';
                                $anulado='<b>Anulado</b>';
                            }
                            $var_TOURS='';
                            $var_HOTELS='';
                            $var_REPRESENT='';
                            $var_MOVILID='';
                            $var_ENTRANCES='';
                            $var_FOOD='';
                            $var_TRAINS='';
                            $var_FLIGHTS='';
                            $var_OTHERS='';
                            $var_OBSERVACIONES='';
                            
                            if($servicio->grupo=='TOURS'){
                                $var_TOURS='<div class="'.$clase.'">'.$servicio->nombre.'<br>'.$horario.'<span class="text-11 text-danger">('.$servicio->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.' ,Cod:'.$servicio->codigo_verificacion.'</p>'.$anulado.'</div>';
                            }
                            if($servicio->grupo=='REPRESENT'){
                                $var_REPRESENT='<div class="'.$clase.'">'.$servicio->nombre.'<br>'.$horario.'<span class="text-11 text-danger">('.$servicio->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.' ,Cod:'.$servicio->codigo_verificacion.'</p>'.$anulado.'</div>';
                            }
                            if($servicio->grupo=='MOVILID'){
                                $var_MOVILID='<div class="'.$clase.'">'.$servicio->nombre.'<br>'.$horario.'<span class="text-11 text-danger">('.$servicio->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.' ,Cod:'.$servicio->codigo_verificacion.'</p>'.$anulado.'</div>';
                            }
                            if($servicio->grupo=='ENTRANCES'){
                                $var_ENTRANCES='<div class="'.$clase.'">'.$servicio->nombre.'<br>'.$horario.'<span class="text-11 text-danger">('.$servicio->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.' ,Cod:'.$servicio->codigo_verificacion.'</p>'.$anulado.'</div>';
                            }
                            if($servicio->grupo=='FOOD'){
                                $var_FOOD='<div class="'.$clase.'">'.$servicio->nombre.'<br>'.$horario.'<span class="text-11 text-danger">('.$servicio->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.' ,Cod:'.$servicio->codigo_verificacion.'</p>'.$anulado.'</div>';
                            }
                            if($servicio->grupo=='TRAINS'){
                                $var_TRAINS='<div class="'.$clase.'">'.$servicio->nombre.'<br>'.$horario.'<span class="text-11 text-danger">('.$servicio->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.' ,Cod:'.$servicio->codigo_verificacion.'</p>'.$anulado.'</div>';
                            }
                            if($servicio->grupo=='FLIGHTS'){
                                $var_FLIGHTS='<div class="'.$clase.'">'.$servicio->nombre.'<br>'.$horario.'<span class="text-11 text-danger">('.$servicio->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.' ,Cod:'.$servicio->codigo_verificacion.'</p>'.$anulado.'</div>';
                            }
                            if($servicio->grupo=='OTHERS'){
                                $var_OTHERS='<div class="'.$clase.'">'.$servicio->nombre.'<br>'.$horario.'<span class="text-11 text-danger">('.$servicio->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.' ,Cod:'.$servicio->codigo_verificacion.'</p>'.$anulado.'</div>';
                            }
                            

                            $arreglo_de_datos[$key] = array('FECHA'=>$itinerario->fecha,
                            'HORA'=>$hora,
                            'CODIGO'=>$cotizacion->codigo,
                            'DATOS'=>$itinerario->fecha.'|'.$cotizacion->nropersonas.'|'.$clientes_.'|'.$cotizacion->web.'|'.$cotizacion->idioma_pasajeros.'|'.$itinerario->notas,
                            'COTIZACION_STATE'=>$cotizacion->anulado,
                            'TOURS'=>$var_TOURS,'HOTELS'=>$var_HOTELS,'REPRESENT'=>$var_REPRESENT,'MOVILID'=>$var_MOVILID,'ENTRANCES'=>$var_ENTRANCES,
                            'FOOD'=>$var_FOOD,'TRAINS'=>$var_TRAINS,'FLIGHTS'=>$var_FLIGHTS,'OTHERS'=>$var_OTHERS,'OBSERVACIONES'=>$itinerario->notas);                            
                        }
                    }
                    foreach ($itinerario->hotel->sortby('hora_llegada') as $hotel) {
                        $hora='00.00';
                        if(trim($hotel->hora_llegada)!='')
                            $hora=str_replace(':','.',$hotel->hora_llegada);
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
                            if(count((array)$pro1)>0){
                                if (strlen($pro1->nombre_comercial) > 0)
                                    $nombre_comercial = $pro1->nombre_comercial.', Cel:'.$pro1->telefono;
                                else
                                    $nombre_comercial = 'Sin nombre comercial';
                            }
                            else{
                                $nombre_comercial = 'Proveedor borrado de la db';
                            }
                        }
                        $clase='';
                        $anulado='';
                        if($hotel->anulado=='1'){
                            $clase='alert alert-danger';
                            $anulado='<b>Anulado</b>';
                        }
                        $key=$cotizacion->id.'_'.$pqts->id.'_'.$itinerario->id.'_'.$hora;
                        if($this->search($arreglo_de_datos,$key,'HOTELS')){
                            $arreglo_de_datos[$key]['HOTELS'].= '<div class="'.$clase.'">'.$cadena.'<br><span class="text-11 text-danger">('.$hotel->localizacion.')</span><p class="text-primary">'.$nombre_comercial.' ,Cod:'.$hotel->codigo_verificacion.'</p>'.$anulado.'</div>';
                        }
                        else{
                            $var_TOURS='';
                            $var_HOTELS='';
                            $var_REPRESENT='';
                            $var_MOVILID='';
                            $var_ENTRANCES='';
                            $var_FOOD='';
                            $var_TRAINS='';
                            $var_FLIGHTS='';
                            $var_OTHERS='';
                            $var_OBSERVACIONES='';
                            $var_HOTELS= '<div class="'.$clase.'">'.$cadena.'<br><span class="text-11 text-danger">('.$hotel->localizacion.')</span><p class="text-primary">'.$nombre_comercial.' ,Cod:'.$hotel->codigo_verificacion.'</p>'.$anulado.'</div>';

                            $arreglo_de_datos[$key] = array('FECHA'=>$itinerario->fecha,
                            'HORA'=>$hora,
                            'CODIGO'=>$cotizacion->codigo,
                            'DATOS'=>$itinerario->fecha.'|'.$cotizacion->nropersonas.'|'.$clientes_.'|'.$cotizacion->web.'|'.$cotizacion->idioma_pasajeros.'|'.$itinerario->notas,
                            'COTIZACION_STATE'=>$cotizacion->anulado,
                            'TOURS'=>$var_TOURS,'HOTELS'=>$var_HOTELS,'REPRESENT'=>$var_REPRESENT,'MOVILID'=>$var_MOVILID,'ENTRANCES'=>$var_ENTRANCES,
                            'FOOD'=>$var_FOOD,'TRAINS'=>$var_TRAINS,'FLIGHTS'=>$var_FLIGHTS,'OTHERS'=>$var_OTHERS,'OBSERVACIONES'=>$itinerario->notas);
                        }
                    }
                }
            }
        }
        $sort1=array();
        $sort2=array();
        $sort3=array();
        foreach ($arreglo_de_datos as $key => $part) {
            $sort1[$key] = strtotime($part['FECHA']);
            $sort2[$key] = strtotime($part['HORA']);
            $sort3[$key] = strtotime($part['CODIGO']);
        }
        array_multisort($sort1, SORT_ASC,$sort2, SORT_ASC,$sort3, SORT_ASC, $arreglo_de_datos);
        /*===========================================================================================*/
        $grupo='HOTELS';
        $webs=Web::get();

        // dd($arreglo_de_datos);
        return view('admin.operaciones.operaciones-copia-2', compact('desde', 'hasta','grupo','webs','arreglo_de_datos'));
    }
    protected function saludo(){
		return "Saludo";
    }
    protected function search($arreglo_de_datos,$key_buscar1,$key_buscar2)
    {
        $rpt=false;
        foreach($arreglo_de_datos as $key =>$valor){
            foreach($valor as $key2 =>$valor2){
                if($key.'_'.$key2==$key_buscar1.'_'.$key_buscar2){
                    $rpt=true;
                    break 2;
                }
            }
        }
        return $rpt;
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
        set_time_limit(0);
        $cotizaciones = Cotizacion::with(['paquete_cotizaciones.itinerario_cotizaciones' => function ($query) use ($desde, $hasta) {
            $query->whereBetween('fecha', array($desde, $hasta));
        }])
            ->get();
        $clientes2 = Cliente::get();
        $array_datos_coti= array();
        $array_datos_cotizacion= array();
        $array_hotel=array();

        foreach ($cotizaciones->sortby('fecha') as $cotizacion) {
            $cel='No tiene';
            foreach ($cotizacion->cotizaciones_cliente->where('estado','1') as $cotizacion_cliente) {
                if(strlen($cotizacion_cliente->cliente->telefono) > 4){
                    $cel=$cotizacion_cliente->cliente->telefono;
                }
            }
            $clientes_='<span class="text-success">'.$cotizacion->codigo.'</span> <span class="text-primary">'.$cotizacion->nombre_pax.', Cel.'.$cel.'</span> ';
            foreach ($cotizacion->paquete_cotizaciones->where('estado', '2') as $pqts) {
                foreach ($pqts->itinerario_cotizaciones->where('fecha','>=',$desde)->where('fecha','<=',$hasta)->sortby('fecha') as $itinerario) {
                    $key1=$cotizacion->id.'_'.$pqts->id.'_'.$itinerario->id;
                    $array_datos_coti[$key1]=Array('fecha'=>$itinerario->fecha,'datos'=>$itinerario->fecha.'|'.$cotizacion->nropersonas.'|'.$clientes_.'|'.$cotizacion->web.'|'.$cotizacion->idioma_pasajeros.'|'.$itinerario->notas);
                    foreach ($itinerario->itinerario_servicios->sortby('hora_llegada') as $servicio) {
                        $hora='00.00';
                        if(trim($servicio->hora_llegada)!=''){
                            $hora=str_replace(':','.',$servicio->hora_llegada);
                        }
                        $key=$cotizacion->id.'_'.$pqts->id.'_'.$itinerario->id.'_'.$hora;
                        $nombre_comercial='Sin reserva';
                        if($servicio->proveedor_id>0) {
                            $pro1=Proveedor::where('id',$servicio->proveedor_id)->first();
                            if(count((array)$pro1)>0){
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
                            $horario='';
                            if($servicio->grupo=='TRAINS'){
                                $horario='['.$servicio->salida.'-'.$servicio->llegada.']<br>';
                            }
                            $clase='';
                            if($servicio->anulado=='1')
                                $clase='alert alert-danger';
                            $array_datos_cotizacion[$key]['dates']= $itinerario->fecha.'_'.$hora;
                            $array_datos_cotizacion[$key]['anulado']= $cotizacion->anulado;
                            $array_datos_cotizacion[$key]['servicio'].= $servicio->grupo.'|<div class="'.$clase.'">'.$servicio->nombre.'<br>'.$horario.'<span class="text-11 text-danger">('.$servicio->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.'</p></div>%';
                        }
                        else{
                            $horario='';
                            if($servicio->grupo=='TRAINS'){
                                $horario='['.$servicio->salida.'-'.$servicio->llegada.']<br>';
                            }
                            $clase='';
                            if($servicio->anulado=='1')
                                $clase='alert alert-danger';
                            $array_datos_cotizacion[$key]=array('dates'=>$itinerario->fecha.'_'.$hora,'anulado'=>$cotizacion->anulado,'servicio'=>$servicio->grupo.'|<div class="'.$clase.'">'.$servicio->nombre.'<br>'.$horario.'<span class="text-11 text-danger">('.$servicio->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.'</p></div>%');
                        }
                    }
                   foreach ($itinerario->hotel->sortby('hora_llegada') as $hotel) {
                        $hora='00.00';
                        if(trim($hotel->hora_llegada)!='')
                            $hora=str_replace(':','.',$hotel->hora_llegada);

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
                            if(count((array)$pro1)>0){
                                if (strlen($pro1->nombre_comercial) > 0)
                                    $nombre_comercial = $pro1->nombre_comercial.', Cel:'.$pro1->telefono;
                                else
                                    $nombre_comercial = 'Sin nombre comercial';
                            }
                            else{
                                $nombre_comercial = 'Proveedor borrado de la db';
                            }
                        }
                        $key=$cotizacion->id.'_'.$pqts->id.'_'.$itinerario->id.'_'.$hora;
                        
                        if(array_key_exists($key,$array_hotel))
                            $array_hotel[$key].=$cadena.'<span class="text-11 text-danger">('.$hotel->localizacion.')</span><br><span class="text-primary">'.$nombre_comercial.'</span>';
                        else
                            $array_hotel[$key]=$cadena.'<span class="text-11 text-danger">('.$hotel->localizacion.')</span><br><span class="text-primary">'.$nombre_comercial.'</span>';
                    }
                }
            }
        }

        $sort=array();
        foreach ($array_datos_coti as $key => $part) {
            $sort[$key] = strtotime($part['fecha']);
        }
        array_multisort($sort, SORT_ASC, $array_datos_coti);
        //-- ordenamos el multiarray
        $sort1=array();
        foreach ($array_datos_cotizacion as $key => $part) {
            $sort1[$key] = strtotime($part['dates']);
        }
        array_multisort($sort1, SORT_ASC, $array_datos_cotizacion);

        $pdf = \PDF::loadView('admin.operaciones.operaciones-copia-pdf', compact('desde', 'hasta','array_datos_cotizacion','array_datos_coti','array_hotel'))
        ->setPaper('a4', 'landscape')->setWarnings(false);
        return $pdf->download('Operaciones.pdf');

    }
    public function pdf_uno($desde,$hasta)
    {
        set_time_limit(0);
        // $desde=date('Y-m-d');
        // $hasta=date('Y-m-d');
        $cotizaciones = Cotizacion::with(['paquete_cotizaciones.itinerario_cotizaciones' => function ($query) use ($desde, $hasta) {
            $query->whereBetween('fecha', array($desde, $hasta));
        }])->get();
        // dd($cotizaciones);
        /*===========================================================================================*/
        $arreglo_de_datos=array();
        foreach ($cotizaciones->sortby('fecha') as $cotizacion) {
            $cel='No tiene';
            foreach ($cotizacion->cotizaciones_cliente->where('estado','1') as $cotizacion_cliente) {
                if(strlen($cotizacion_cliente->cliente->telefono) > 4){
                    $cel=$cotizacion_cliente->cliente->telefono;
                }
            }
            $clientes_='<span class="text-success">'.$cotizacion->codigo.'</span> <span class="text-primary">'.$cotizacion->nombre_pax.', Cel.'.$cel.'</span> ';
            foreach ($cotizacion->paquete_cotizaciones->where('estado', '2') as $pqts) {
                foreach ($pqts->itinerario_cotizaciones->where('fecha','>=',$desde)->where('fecha','<=',$hasta)->sortby('fecha') as $itinerario) {
                    $key1=$cotizacion->id.'_'.$pqts->id.'_'.$itinerario->id;
                    $array_datos_coti[$key1]=Array('fecha'=>$itinerario->fecha,'datos'=>$itinerario->fecha.'|'.$cotizacion->nropersonas.'|'.$clientes_.'|'.$cotizacion->web.'|'.$cotizacion->idioma_pasajeros.'|'.$itinerario->notas);
                    foreach ($itinerario->itinerario_servicios->sortby('hora_llegada') as $servicio) {
                        $hora='00.00';
                        if(trim($servicio->hora_llegada)!=''){
                            $hora=str_replace(':','.',$servicio->hora_llegada);
                        }
                        $key=$cotizacion->id.'_'.$pqts->id.'_'.$itinerario->id.'_'.$hora;
                        $nombre_comercial='Sin reserva';
                        if($servicio->proveedor_id>0) {
                            $pro1=Proveedor::where('id',$servicio->proveedor_id)->first();
                            if(count((array)$pro1)>0){
                                if (strlen($pro1->nombre_comercial) > 0)
                                    $nombre_comercial = $pro1->nombre_comercial.', Cel:'.$pro1->telefono;
                                else
                                    $nombre_comercial = 'Sin nombre comercial';
                            }
                            else{
                                $nombre_comercial = 'Proveedor borrado de la db';
                            }
                        }
                        if($this->search($arreglo_de_datos,$key,$servicio->grupo)){
                            $horario='';
                            if($servicio->grupo=='TRAINS'){
                                $horario='['.$servicio->salida.'-'.$servicio->llegada.']<br>';
                            }
                            $clase='';
                            $anulado='';
                            if($servicio->anulado=='1'){
                                $clase='alert alert-danger';
                                $anulado='<b>Anulado</b>';
                            }
                            
                            // $arreglo_de_datos[$key]['OBSERVACIONES'] = $itinerario->notas;

                            $arreglo_de_datos[$key][$servicio->grupo] .= '<div class="'.$clase.'">'.$servicio->nombre.'<br>'.$horario.'<span class="text-11 text-danger">('.$servicio->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.' ,Cod:'.$servicio->codigo_verificacion.'</p>'.$anulado.'</div>';
                        }
                        else{
                            $horario='';
                            if($servicio->grupo=='TRAINS'){
                                $horario='['.$servicio->salida.'-'.$servicio->llegada.']<br>';
                            }
                            $clase='';
                            $anulado='';
                            if($servicio->anulado=='1'){
                                $clase='alert alert-danger';
                                $anulado='<b>Anulado</b>';
                            }
                            $var_TOURS='';
                            $var_HOTELS='';
                            $var_REPRESENT='';
                            $var_MOVILID='';
                            $var_ENTRANCES='';
                            $var_FOOD='';
                            $var_TRAINS='';
                            $var_FLIGHTS='';
                            $var_OTHERS='';
                            $var_OBSERVACIONES='';
                            
                            if($servicio->grupo=='TOURS'){
                                $var_TOURS='<div class="'.$clase.'">'.$servicio->nombre.'<br>'.$horario.'<span class="text-11 text-danger">('.$servicio->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.' ,Cod:'.$servicio->codigo_verificacion.'</p>'.$anulado.'</div>';
                            }
                            if($servicio->grupo=='REPRESENT'){
                                $var_REPRESENT='<div class="'.$clase.'">'.$servicio->nombre.'<br>'.$horario.'<span class="text-11 text-danger">('.$servicio->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.' ,Cod:'.$servicio->codigo_verificacion.'</p>'.$anulado.'</div>';
                            }
                            if($servicio->grupo=='MOVILID'){
                                $var_MOVILID='<div class="'.$clase.'">'.$servicio->nombre.'<br>'.$horario.'<span class="text-11 text-danger">('.$servicio->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.' ,Cod:'.$servicio->codigo_verificacion.'</p>'.$anulado.'</div>';
                            }
                            if($servicio->grupo=='ENTRANCES'){
                                $var_ENTRANCES='<div class="'.$clase.'">'.$servicio->nombre.'<br>'.$horario.'<span class="text-11 text-danger">('.$servicio->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.' ,Cod:'.$servicio->codigo_verificacion.'</p>'.$anulado.'</div>';
                            }
                            if($servicio->grupo=='FOOD'){
                                $var_FOOD='<div class="'.$clase.'">'.$servicio->nombre.'<br>'.$horario.'<span class="text-11 text-danger">('.$servicio->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.' ,Cod:'.$servicio->codigo_verificacion.'</p>'.$anulado.'</div>';
                            }
                            if($servicio->grupo=='TRAINS'){
                                $var_TRAINS='<div class="'.$clase.'">'.$servicio->nombre.'<br>'.$horario.'<span class="text-11 text-danger">('.$servicio->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.' ,Cod:'.$servicio->codigo_verificacion.'</p>'.$anulado.'</div>';
                            }
                            if($servicio->grupo=='FLIGHTS'){
                                $var_FLIGHTS='<div class="'.$clase.'">'.$servicio->nombre.'<br>'.$horario.'<span class="text-11 text-danger">('.$servicio->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.' ,Cod:'.$servicio->codigo_verificacion.'</p>'.$anulado.'</div>';
                            }
                            if($servicio->grupo=='OTHERS'){
                                $var_OTHERS='<div class="'.$clase.'">'.$servicio->nombre.'<br>'.$horario.'<span class="text-11 text-danger">('.$servicio->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.' ,Cod:'.$servicio->codigo_verificacion.'</p>'.$anulado.'</div>';
                            }
                            

                            $arreglo_de_datos[$key] = array('FECHA'=>$itinerario->fecha,
                            'HORA'=>$hora,
                            'CODIGO'=>$cotizacion->codigo,
                            'DATOS'=>$itinerario->fecha.'|'.$cotizacion->nropersonas.'|'.$clientes_.'|'.$cotizacion->web.'|'.$cotizacion->idioma_pasajeros.'|'.$itinerario->notas,
                            'COTIZACION_STATE'=>$cotizacion->anulado,
                            'TOURS'=>$var_TOURS,'HOTELS'=>$var_HOTELS,'REPRESENT'=>$var_REPRESENT,'MOVILID'=>$var_MOVILID,'ENTRANCES'=>$var_ENTRANCES,
                            'FOOD'=>$var_FOOD,'TRAINS'=>$var_TRAINS,'FLIGHTS'=>$var_FLIGHTS,'OTHERS'=>$var_OTHERS,'OBSERVACIONES'=>$itinerario->notas);                            
                        }
                    }
                    foreach ($itinerario->hotel->sortby('hora_llegada') as $hotel) {
                        $hora='00.00';
                        if(trim($hotel->hora_llegada)!='')
                            $hora=str_replace(':','.',$hotel->hora_llegada);
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
                            if(count((array)$pro1)>0){
                                if (strlen($pro1->nombre_comercial) > 0)
                                    $nombre_comercial = $pro1->nombre_comercial.', Cel:'.$pro1->telefono;
                                else
                                    $nombre_comercial = 'Sin nombre comercial';
                            }
                            else{
                                $nombre_comercial = 'Proveedor borrado de la db';
                            }
                        }
                        $clase='';
                        $anulado='';
                        if($hotel->anulado=='1'){
                            $clase='alert alert-danger';
                            $anulado='<b>Anulado</b>';
                        }
                        $key=$cotizacion->id.'_'.$pqts->id.'_'.$itinerario->id.'_'.$hora;
                        // dd($this->search($arreglo_de_datos,$key,'HOTELS'));
                        
                        if($this->search($arreglo_de_datos,$key,'HOTELS')){
                            $arreglo_de_datos[$key]['HOTELS'].= '<div class="'.$clase.'">'.$cadena.'<br><span class="text-11 text-danger">('.$hotel->localizacion.')</span><p class="text-primary">'.$nombre_comercial.' ,Cod:'.$hotel->codigo_verificacion.'</p>'.$anulado.'</div>';
                        }
                        else{
                            $var_TOURS='';
                            $var_HOTELS='';
                            $var_REPRESENT='';
                            $var_MOVILID='';
                            $var_ENTRANCES='';
                            $var_FOOD='';
                            $var_TRAINS='';
                            $var_FLIGHTS='';
                            $var_OTHERS='';
                            $var_OBSERVACIONES='';
                            $var_HOTELS= '<div class="'.$clase.'">'.$cadena.'<br><span class="text-11 text-danger">('.$hotel->localizacion.')</span><p class="text-primary">'.$nombre_comercial.' ,Cod:'.$hotel->codigo_verificacion.'</p>'.$anulado.'</div>';

                            $arreglo_de_datos[$key] = array('FECHA'=>$itinerario->fecha,
                            'HORA'=>$hora,
                            'CODIGO'=>$cotizacion->codigo,
                            'DATOS'=>$itinerario->fecha.'|'.$cotizacion->nropersonas.'|'.$clientes_.'|'.$cotizacion->web.'|'.$cotizacion->idioma_pasajeros.'|'.$itinerario->notas,
                            'COTIZACION_STATE'=>$cotizacion->anulado,
                            'TOURS'=>$var_TOURS,'HOTELS'=>$var_HOTELS,'REPRESENT'=>$var_REPRESENT,'MOVILID'=>$var_MOVILID,'ENTRANCES'=>$var_ENTRANCES,
                            'FOOD'=>$var_FOOD,'TRAINS'=>$var_TRAINS,'FLIGHTS'=>$var_FLIGHTS,'OTHERS'=>$var_OTHERS,'OBSERVACIONES'=>$itinerario->notas);
                        }
                    }
                }
            }
        }
        $sort1=array();
        $sort2=array();
        $sort3=array();
        foreach ($arreglo_de_datos as $key => $part) {
            $sort1[$key] = strtotime($part['FECHA']);
            $sort2[$key] = strtotime($part['HORA']);
            $sort3[$key] = strtotime($part['CODIGO']);
        }
        array_multisort($sort1, SORT_ASC,$sort2, SORT_ASC,$sort3, SORT_ASC, $arreglo_de_datos);
        /*===========================================================================================*/
        // dd($arreglo_de_datos);
        $grupo='HOTELS';
        $webs=Web::get();
        // return view('admin.operaciones.operaciones-copia-2', compact('desde', 'hasta','grupo','webs','arreglo_de_datos'));

        $pdf = \PDF::loadView('admin.operaciones.operaciones-copia-2-pdf', compact('desde', 'hasta','grupo','webs','arreglo_de_datos'))
        ->setPaper('a4', 'landscape')->setWarnings(false);
        return $pdf->download($desde.'_'.$hasta.'_'.'operaciones.pdf');
        /*
        set_time_limit(0);
        $cotizaciones = Cotizacion::with(['paquete_cotizaciones.itinerario_cotizaciones' => function ($query) use ($desde, $hasta) {
            $query->whereBetween('fecha', array($desde, $hasta));
        }])
            ->get();
        $clientes2 = Cliente::get();
        $array_datos_coti= array();
        $array_datos_cotizacion= array();
        $array_hotel=array();

        foreach ($cotizaciones->sortby('fecha') as $cotizacion) {
            $cel='No tiene';
            foreach ($cotizacion->cotizaciones_cliente->where('estado','1') as $cotizacion_cliente) {
                if(strlen($cotizacion_cliente->cliente->telefono) > 4){
                    $cel=$cotizacion_cliente->cliente->telefono;
                }
            }
            $clientes_='<span class="text-success">'.$cotizacion->codigo.'</span> <span class="text-primary">'.$cotizacion->nombre_pax.', Cel.'.$cel.'</span> ';
            foreach ($cotizacion->paquete_cotizaciones->where('estado', '2') as $pqts) {
                foreach ($pqts->itinerario_cotizaciones->where('fecha','>=',$desde)->where('fecha','<=',$hasta)->sortby('fecha') as $itinerario) {
                    $key1=$cotizacion->id.'_'.$pqts->id.'_'.$itinerario->id;
                    $array_datos_coti[$key1]=Array('fecha'=>$itinerario->fecha,'datos'=>$itinerario->fecha.'|'.$cotizacion->nropersonas.'|'.$clientes_.'|'.$cotizacion->web.'|'.$cotizacion->idioma_pasajeros.'|'.$itinerario->notas);
                    foreach ($itinerario->itinerario_servicios->sortby('hora_llegada') as $servicio) {
                        $hora='00.00';
                        if(trim($servicio->hora_llegada)!=''){
                            $hora=str_replace(':','.',$servicio->hora_llegada);
                        }
                        $key=$cotizacion->id.'_'.$pqts->id.'_'.$itinerario->id.'_'.$hora;
                        $nombre_comercial='Sin reserva';
                        if($servicio->proveedor_id>0) {
                            $pro1=Proveedor::where('id',$servicio->proveedor_id)->first();
                            if(count((array)$pro1)>0){
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
                            $horario='';
                            if($servicio->grupo=='TRAINS'){
                                $horario='['.$servicio->salida.'-'.$servicio->llegada.']<br>';
                            }
                            $clase='';
                            if($servicio->anulado=='1')
                                $clase='alert alert-danger';
                            $array_datos_cotizacion[$key]['dates']= $itinerario->fecha.'_'.$hora;
                            $array_datos_cotizacion[$key]['anulado']= $cotizacion->anulado;
                            $array_datos_cotizacion[$key]['servicio'].= $servicio->grupo.'|<div class="'.$clase.'">'.$servicio->nombre.'<br>'.$horario.'<span class="text-11 text-danger">('.$servicio->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.'</p></div>%';
                        }
                        else{
                            $horario='';
                            if($servicio->grupo=='TRAINS'){
                                $horario='['.$servicio->salida.'-'.$servicio->llegada.']<br>';
                            }
                            $clase='';
                            if($servicio->anulado=='1')
                                $clase='alert alert-danger';
                            $array_datos_cotizacion[$key]=array('dates'=>$itinerario->fecha.'_'.$hora,'anulado'=>$cotizacion->anulado,'servicio'=>$servicio->grupo.'|<div class="'.$clase.'">'.$servicio->nombre.'<br>'.$horario.'<span class="text-11 text-danger">('.$servicio->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.'</p></div>%');
                        }
                    }
                   foreach ($itinerario->hotel->sortby('hora_llegada') as $hotel) {
                        $hora='00.00';
                        if(trim($hotel->hora_llegada)!='')
                            $hora=str_replace(':','.',$hotel->hora_llegada);

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
                            if(count((array)$pro1)>0){
                                if (strlen($pro1->nombre_comercial) > 0)
                                    $nombre_comercial = $pro1->nombre_comercial.', Cel:'.$pro1->telefono;
                                else
                                    $nombre_comercial = 'Sin nombre comercial';
                            }
                            else{
                                $nombre_comercial = 'Proveedor borrado de la db';
                            }
                        }
                        $key=$cotizacion->id.'_'.$pqts->id.'_'.$itinerario->id.'_'.$hora;
                        
                        if(array_key_exists($key,$array_hotel))
                            $array_hotel[$key].=$cadena.'<span class="text-11 text-danger">('.$hotel->localizacion.')</span><br><span class="text-primary">'.$nombre_comercial.'</span>';
                        else
                            $array_hotel[$key]=$cadena.'<span class="text-11 text-danger">('.$hotel->localizacion.')</span><br><span class="text-primary">'.$nombre_comercial.'</span>';
                    }
                }
            }
        }

        $sort=array();
        foreach ($array_datos_coti as $key => $part) {
            $sort[$key] = strtotime($part['fecha']);
        }
        array_multisort($sort, SORT_ASC, $array_datos_coti);
        //-- ordenamos el multiarray
        $sort1=array();
        foreach ($array_datos_cotizacion as $key => $part) {
            $sort1[$key] = strtotime($part['dates']);
        }
        array_multisort($sort1, SORT_ASC, $array_datos_cotizacion);

        $pdf = \PDF::loadView('admin.operaciones.operaciones-copia-pdf', compact('desde', 'hasta','array_datos_cotizacion','array_datos_coti','array_hotel'))
        ->setPaper('a4', 'landscape')->setWarnings(false);
        return $pdf->download('Operaciones.pdf');*/

    }
    public function excel($desde,$hasta){
        set_time_limit(0);
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
                foreach ($pqts->itinerario_cotizaciones->where('fecha','>=',$desde)->where('fecha','<=',$hasta)->sortby('fecha') as $itinerario) {
                    $key1=$cotizacion->id.'_'.$pqts->id.'_'.$itinerario->id;
                    $array_datos_coti[$key1]= $itinerario->fecha.'|'.$cotizacion->nropersonas.'|'.$clientes_.'|'.$cotizacion->web.'|'.$cotizacion->idioma_pasajeros.'|'.$itinerario->notas;
                    foreach ($itinerario->itinerario_servicios->sortby('hora_llegada') as $servicio) {
                        $hora='00.00';
                        if(trim($servicio->hora_llegada)!=''){
                            $hora=str_replace(':','.',$servicio->hora_llegada);
                        }
                        $key=$cotizacion->id.'_'.$pqts->id.'_'.$itinerario->id.'_'.$hora;
                        // $serv = M_Servicio::Find($servicio->m_servicios_id);
                        $nombre_comercial='Sin reserva';
                        if($servicio->proveedor_id>0) {
                            $pro1=Proveedor::where('id',$servicio->proveedor_id)->first();
                            if(count((array)$pro1)>0){
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
                            $clase='';
                            if($servicio->anulado=='1')
                                $clase='alert alert-danger';
                            $array_datos_cotizacion[$key].=$servicio->grupo.'|<div class="'.$clase.'">'.$servicio->nombre.'<br><span class="text-11 text-danger">('.$servicio->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.'</p></div>%';
                        }
                        else{
                            $clase='';
                            if($servicio->anulado=='1')
                                $clase='alert alert-danger';
                            $array_datos_cotizacion[$key]=$servicio->grupo.'|<div class="'.$clase.'">'.$servicio->nombre.'<br><span class="text-11 text-danger">('.$servicio->localizacion.')</span> <span class="text-11 text-danger">('.$servicio->s_p.')</span><p class="text-primary">'.$nombre_comercial.'</p></div>%';
//                            $array_datos_cotizacion[$key]='|<br><span class="text-11 text-danger">()</span> <span class="text-11 text-danger">()</span><p class="text-primary"></p>%';
                        }
                    }
                    foreach ($itinerario->hotel->sortby('hora_llegada') as $hotel) {
                        $hora='00.00';
//                        if($hotel->hora_llegada!=''){
//                            $hora=str_replace(':','.',$hotel->hora_llegada);
//                        }
                        if(trim($hotel->hora_llegada)!='')
                            $hora=str_replace(':','.',$hotel->hora_llegada);
//                            $hora=trim($servicio->hora_llegada);
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
                            if(count((array)$pro1)>0){
                                if (strlen($pro1->nombre_comercial) > 0)
                                    $nombre_comercial = $pro1->nombre_comercial.', Cel:'.$pro1->telefono;
                                else
                                    $nombre_comercial = 'Sin nombre comercial';
                            }
                            else{
                                $nombre_comercial = 'Proveedor borrado de la db';
                            }
                        }
                        $key=$cotizacion->id.'_'.$pqts->id.'_'.$itinerario->id.'_'.$hora;
//                        $key=$cotizacion->id.'_'.$pqts->id.'_'.$itinerario->id;
                        if(array_key_exists($key,$array_hotel))
                            $array_hotel[$key].=$cadena.'<br><span class="text-11 text-danger">('.$hotel->localizacion.')</span><p class="text-primary">'.$nombre_comercial.'</p>';
                        else
                            $array_hotel[$key]=$cadena.'<br><span class="text-11 text-danger">('.$hotel->localizacion.')</span><p class="text-primary">'.$nombre_comercial.'</p>';
                    }
                }
            }
        }
        Excel::create('archivo', function($excel) use($desde,$hasta,$array_datos_cotizacion,$array_datos_coti,$array_hotel) {
            $excel->sheet('New sheet', function($sheet) use ($desde,$hasta,$array_datos_cotizacion,$array_datos_coti,$array_hotel) {
                $sheet->loadView('admin.operaciones.operaciones-copia-pdf', compact('desde', 'hasta','array_datos_cotizacion','array_datos_coti','array_hotel'));
            });
        })->download('xlsx');
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
