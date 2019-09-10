<?php

namespace App\Http\Controllers;

use App\Web;
use App\Hotel;
use App\M_Destino;
use App\P_Paquete;
use Carbon\Carbon;
use App\M_Servicio;
use App\M_Itinerario;
use App\P_Itinerario;
use App\PaquetePagina;
use Mockery\Exception;
use App\P_PaquetePrecio;
use Barryvdh\DomPDF\PDF;

use App\M_ItinerarioDestino;
use App\P_ItinerarioDestino;
use Illuminate\Http\Request;
use App\P_ItinerarioServicios;
use PhpParser\Node\Expr\Array_;
use Psy\Test\Readline\HoaConsoleTest;
use Illuminate\Support\Facades\Redirect;



class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //--
    }

    public function catalog()
    {
        return view('admin.catalog');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $webs=Web::get();
        $destinos=M_Destino::get();
        $itinerarios=M_Itinerario::get();
        $m_servicios=M_Servicio::get();
        $hotel=Hotel::get();
        $itinerarios_d=M_ItinerarioDestino::get();
        session()->put('menu-lateral', 'sales/iti/new');
//        dd($itinerarios_d);
        return view('admin.package',compact(['destinos','itinerarios','m_servicios','hotel','itinerarios_d','webs']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd('hola');
        $txt_day=strtoupper(($request->input('txt_day')));
        $txt_code=strtoupper(($request->input('txt_codigo')));
        $txta_description=$request->input('txta_description');
        $txt_title=strtoupper($txta_description);
        $search_by_code=P_Paquete::where('codigo',$txt_code)->count();
        $search_by_title=P_Paquete::where('titulo',$txt_title)->count();
        if($search_by_code>0)
            return back();
        if($search_by_title>0)
            return back();
            
//        dd('$txt_code:'.$txt_code);
        $txt_pagina=$request->input('txt_pagina');
        if(!isset($txt_pagina))
            return back();
//        $txt_title=strtoupper(($request->input('txt_title')));
        
        $txta_include=$request->input('txta_include');
        $txta_notinclude=$request->input('txta_notinclude');
        $totalItinerario=$request->input('totalItinerario');
        $itinerarios_=$request->input('itinerarios_2');

        $txt_sugerencia=$request->input('txt_sugerencia');
        $hotel_id_2=$request->input('hotel_id_2');
        $hotel_id_3=$request->input('hotel_id_3');
        $hotel_id_4=$request->input('hotel_id_4');
        $hotel_id_5=$request->input('hotel_id_5');

        $strellas_2=$request->input('strellas_2');
        $strellas_3=$request->input('strellas_3');
        $strellas_4=$request->input('strellas_4');
        $strellas_5=$request->input('strellas_5');

       //-- precio de los hoteles
        $amount_t2=$request->input('amount_t2');
        $amount_d2=$request->input('amount_d2');
        $amount_s2=$request->input('amount_s2');

        $amount_t3=$request->input('amount_t3');
        $amount_d3=$request->input('amount_d3');
        $amount_s3=$request->input('amount_s3');

        $amount_t4=$request->input('amount_t4');
        $amount_d4=$request->input('amount_d4');
        $amount_s4=$request->input('amount_s4');

        $amount_t5=$request->input('amount_t5');
        $amount_d5=$request->input('amount_d5');
        $amount_s5=$request->input('amount_s5');


        //-- recojemos los profit en dolares de cada estrella y acomodacion
        $amount_t2_a_p=$request->input('amount_d2_a_p');
        $amount_m2_a_p=$request->input('amount_m2_a_p');
        $amount_d2_a_p=$request->input('amount_d2_a_p');
        $amount_s2_a_p=$request->input('amount_s2_a_p');

        $amount_t3_a_p=$request->input('amount_d3_a_p');
        $amount_m3_a_p=$request->input('amount_m3_a_p');
        $amount_d3_a_p=$request->input('amount_d3_a_p');
        $amount_s3_a_p=$request->input('amount_s3_a_p');

        $amount_t4_a_p=$request->input('amount_d4_a_p');
        $amount_m4_a_p=$request->input('amount_m4_a_p');
        $amount_d4_a_p=$request->input('amount_d4_a_p');
        $amount_s4_a_p=$request->input('amount_s4_a_p');

        $amount_t5_a_p=$request->input('amount_d5_a_p');
        $amount_m5_a_p=$request->input('amount_m5_a_p');
        $amount_d5_a_p=$request->input('amount_d5_a_p');
        $amount_s5_a_p=$request->input('amount_s5_a_p');

        //-- precio de venta
        $amount_t2_a_v=$request->input('amount_t2_a_v');
        $amount_m2_a_v=$request->input('amount_m2_a_v');
        $amount_d2_a_v=$request->input('amount_d2_a_v');
        $amount_s2_a_v=$request->input('amount_s2_a_v');

        $amount_t3_a_v=$request->input('amount_d3_a_v');
        $amount_m3_a_v=$request->input('amount_m3_a_v');
        $amount_d3_a_v=$request->input('amount_d3_a_v');
        $amount_s3_a_v=$request->input('amount_s3_a_v');

        $amount_t4_a_v=$request->input('amount_d4_a_v');
        $amount_m4_a_v=$request->input('amount_m4_a_v');
        $amount_d4_a_v=$request->input('amount_d4_a_v');
        $amount_s4_a_v=$request->input('amount_s4_a_v');

        $amount_t5_a_v=$request->input('amount_d5_a_v');
        $amount_m5_a_v=$request->input('amount_m5_a_v');
        $amount_d5_a_v=$request->input('amount_d5_a_v');
        $amount_s5_a_v=$request->input('amount_s5_a_v');

//        $profit_2=$request->input('profitt_2');
//        $profit_3=$request->input('profitt_3');
//        $profit_4=$request->input('profitt_4');
//        $profit_5=$request->input('profitt_5');



        $plantillas= P_Paquete::where('duracion',$txt_day)->get();
        $diferencia = 4 - strlen(count($plantillas));
        $numero_con_ceros='';
        for($i = 0 ; $i < $diferencia; $i++)
        {
            $numero_con_ceros .= 0;
        }

        $numero_con_ceros.= count($plantillas);
        $plantilla_pqt= new P_Paquete();
        $plantilla_pqt->codigo='GTP'.$txt_day.$numero_con_ceros;

        // if($txt_pagina!='expedia.com')
        //     $txt_code='GTP'.$txt_day.$numero_con_ceros;

        $paquete=new P_Paquete();
        // $paquete->pagina=$txt_pagina;
        $paquete->codigo=$txt_code;
        $paquete->titulo=$txt_title;
        $paquete->duracion=$txt_day;
        $paquete->descripcion=$txta_description;
        $paquete->incluye=$txta_include;
        $paquete->noincluye=$txta_notinclude;
        $paquete->utilidad=$request->input('txt_utilidad');
        $paquete->precio_venta=$request->input('totalItinerario_venta');
        $paquete->estado=1;
        $paquete->preciocosto=$totalItinerario;
        $paquete->save();

        foreach($txt_pagina as $txt_pagina_){
            $pqt_pagina=new PaquetePagina();
            $pqt_pagina->pagina=$txt_pagina_;
            $pqt_pagina->p_paquete_id=$paquete->id;
            $pqt_pagina->save();
        }
//dd($paquete);
        if($txt_day>1) {
            $paquete_precio2 = new P_PaquetePrecio();
            $paquete_precio2->estrellas = 2;
            $paquete_precio2->precio_s = $amount_s2;
            $paquete_precio2->personas_s = 1;
            $paquete_precio2->precio_m = $amount_d2;
            $paquete_precio2->personas_m = 1;
            $paquete_precio2->precio_d = $amount_d2;
            $paquete_precio2->personas_d = 1;
            $paquete_precio2->precio_t = $amount_t2;
            $paquete_precio2->personas_t = 1;
            if ($strellas_2 == 2)
                $paquete_precio2->estado = 1;
            else
                $paquete_precio2->estado = 0;
            $paquete_precio2->utilidad_s = $amount_s2_a_p;
            $paquete_precio2->utilidad_m = $amount_m2_a_p;
            $paquete_precio2->utilidad_d = $amount_d2_a_p;
            $paquete_precio2->utilidad_t = $amount_t2_a_p;
            $paquete_precio2->p_paquete_id = $paquete->id;
            $paquete_precio2->hotel_id = $hotel_id_2;
            $paquete_precio2->save();

            $paquete_precio3 = new P_PaquetePrecio();
            $paquete_precio3->estrellas = 3;
            $paquete_precio3->precio_s = $amount_s3;
            $paquete_precio3->personas_s = 1;
            $paquete_precio3->precio_m = $amount_d3;
            $paquete_precio3->personas_m = 1;
            $paquete_precio3->precio_d = $amount_d3;
            $paquete_precio3->personas_d = 1;
            $paquete_precio3->precio_t = $amount_t3;
            $paquete_precio3->personas_t = 1;
            if ($strellas_3 == 3)
                $paquete_precio3->estado = 1;
            else
                $paquete_precio3->estado = 0;
            $paquete_precio3->utilidad_s = $amount_s3_a_p;
            $paquete_precio3->utilidad_m = $amount_m3_a_p;
            $paquete_precio3->utilidad_d = $amount_d3_a_p;
            $paquete_precio3->utilidad_t = $amount_t3_a_p;
            $paquete_precio3->p_paquete_id = $paquete->id;
            $paquete_precio3->hotel_id = $hotel_id_3;
            $paquete_precio3->save();

            $paquete_precio4 = new P_PaquetePrecio();
            $paquete_precio4->estrellas = 4;
            $paquete_precio4->precio_s = $amount_s4;
            $paquete_precio4->personas_s = 1;
            $paquete_precio4->precio_m = $amount_d4;
            $paquete_precio4->personas_m = 1;
            $paquete_precio4->precio_d = $amount_d4;
            $paquete_precio4->personas_d = 1;
            $paquete_precio4->precio_t = $amount_t4;
            $paquete_precio4->personas_t = 1;
            if ($strellas_4 == 4)
                $paquete_precio4->estado = 1;
            else
                $paquete_precio4->estado = 0;
            $paquete_precio4->utilidad_s = $amount_s4_a_p;
            $paquete_precio4->utilidad_m = $amount_m4_a_p;
            $paquete_precio4->utilidad_d = $amount_d4_a_p;
            $paquete_precio4->utilidad_t = $amount_t4_a_p;
            $paquete_precio4->p_paquete_id = $paquete->id;
            $paquete_precio4->hotel_id = $hotel_id_4;
            $paquete_precio4->save();

            $paquete_precio5 = new P_PaquetePrecio();
            $paquete_precio5->estrellas = 5;
            $paquete_precio5->precio_s = $amount_s5;
            $paquete_precio5->personas_s = 1;
            $paquete_precio5->precio_m = $amount_d5;
            $paquete_precio5->personas_m = 1;
            $paquete_precio5->precio_d = $amount_d5;
            $paquete_precio5->personas_d = 1;
            $paquete_precio5->precio_t = $amount_t5;
            $paquete_precio5->personas_t = 1;
            if ($strellas_5 == 5)
                $paquete_precio5->estado = 1;
            else
                $paquete_precio5->estado = 0;
            $paquete_precio5->utilidad_s = $amount_s5_a_p;
            $paquete_precio5->utilidad_m = $amount_m5_a_p;
            $paquete_precio5->utilidad_d = $amount_d5_a_p;
            $paquete_precio5->utilidad_t = $amount_t5_a_p;
            $paquete_precio5->p_paquete_id = $paquete->id;
            $paquete_precio5->hotel_id = $hotel_id_5;
            $paquete_precio5->save();
        }
        $dia=0;
        // dd($itinerarios_);
        foreach ($itinerarios_ as $itinerario_id){
            $dia_=$dia+1;
            $m_itineario=M_Itinerario::FindOrFail($itinerario_id);
            $p_itinerario=new P_Itinerario();
            $p_itinerario->titulo=$m_itineario->titulo;
            $p_itinerario->descripcion=$m_itineario->descripcion;
            $p_itinerario->dias=$dia_;
            $p_itinerario->precio=$m_itineario->precio;
            $p_itinerario->imagen=$m_itineario->imagen;
            $p_itinerario->imagenB=$m_itineario->imagenB;
            $p_itinerario->imagenC=$m_itineario->imagenC;
            $p_itinerario->destino_foco=$m_itineario->destino_foco;
            $p_itinerario->destino_duerme=$m_itineario->destino_duerme;
            $p_itinerario->sugerencia=$txt_sugerencia[$dia];
            $p_itinerario->estado=1;
            $p_itinerario->m_itinerario_id=$m_itineario->id;
            $p_itinerario->p_paquete_id=$paquete->id;

            $p_itinerario->save();
            $dia++;
            foreach ($m_itineario->destinos as $m_destinos){
                $p_destinos=new P_ItinerarioDestino();
                $p_destinos->codigo=$m_destinos->codigo;
                $p_destinos->destino=$m_destinos->destino;
                $p_destinos->region=$m_destinos->region;
                $p_destinos->pais=$m_destinos->pais;
                $p_destinos->descripcion=$m_destinos->descripcion;
                $p_destinos->imagen=$m_destinos->imagen;
                $p_destinos->estado=1;
                $p_destinos->p_itinerario_id=$p_itinerario->id;
                $p_destinos->save();
            }
            $st=0;
            foreach($m_itineario->itinerario_itinerario_servicios as $servicios){
                $p_servicio=new P_ItinerarioServicios();
                $p_servicio->nombre=$servicios->itinerario_servicios_servicio->nombre;
                $p_servicio->min_personas=$servicios->itinerario_servicios_servicio->min_personas;
                $p_servicio->max_personas=$servicios->itinerario_servicios_servicio->max_personas;
                $p_servicio->observacion='';
                if($servicios->itinerario_servicios_servicio->precio_grupo==1) {
                    $p_servicio->precio = round($servicios->itinerario_servicios_servicio->precio_venta / 2,2);
                    $p_servicio->precio_grupo = 1;
                }
                else{
                    $p_servicio->precio = $servicios->itinerario_servicios_servicio->precio_venta;
                    $p_servicio->precio_grupo=0;
                }
                $st+=$p_servicio->precio;
                $p_servicio->p_itinerario_id=$p_itinerario->id;
                $p_servicio->m_servicios_id=$servicios->itinerario_servicios_servicio->id;
                $p_servicio->pos=$servicios->pos;
                $p_servicio->save();
            }
            $p_itinerario->precio=$st;
            $p_itinerario->save();
        }
        return redirect()->route('show_itineraries_path');

    }
    public function itinerary_edit(Request $request)
    {
        $paquete_id=$request->input('paquete_id');
        $txt_day=strtoupper(($request->input('txt_day')));
        $txt_pagina=$request->input('txt_pagina');
        if(!isset($txt_pagina))
            return back();
        // dd($txt_pagina);
        $txt_code=strtoupper(($request->input('txt_codigo')));
        $txt_title=strtoupper(($request->input('txt_title')));
        $txta_description=$request->input('txta_description');
        $txt_title=strtoupper($txta_description);
        $txta_include=$request->input('txta_include');
        $txta_notinclude=$request->input('txta_notinclude');
        $totalItinerario=$request->input('totalItinerario');
        $itinerarios_=$request->input('itinerarios_2');
//        $txt_sugerencia=$request->input('txt_sugerencia');

        $strellas_2=$request->input('strellas_2');
        $strellas_3=$request->input('strellas_3');
        $strellas_4=$request->input('strellas_4');
        $strellas_5=$request->input('strellas_5');

        //-- precio de los hoteles
        $amount_t2=$request->input('amount_t2');
        $amount_d2=$request->input('amount_d2');
        $amount_s2=$request->input('amount_s2');

        $amount_t3=$request->input('amount_t3');
        $amount_d3=$request->input('amount_d3');
        $amount_s3=$request->input('amount_s3');

        $amount_t4=$request->input('amount_t4');
        $amount_d4=$request->input('amount_d4');
        $amount_s4=$request->input('amount_s4');

        $amount_t5=$request->input('amount_t5');
        $amount_d5=$request->input('amount_d5');
        $amount_s5=$request->input('amount_s5');

//        $profit_2=$request->input('profitt_2');
//        $profit_3=$request->input('profitt_3');
//        $profit_4=$request->input('profitt_4');
//        $profit_5=$request->input('profitt_5');

        $hotel_id_2=$request->input('hotel_id_2');
        $hotel_id_3=$request->input('hotel_id_3');
        $hotel_id_4=$request->input('hotel_id_4');
        $hotel_id_5=$request->input('hotel_id_5');

        //-- recojemos los profit en dolares de cada estrella y acomodacion
        $amount_t2_a_p=$request->input('amount_d2_a_p');
        $amount_m2_a_p=$request->input('amount_m2_a_p');
        $amount_d2_a_p=$request->input('amount_d2_a_p');
        $amount_s2_a_p=$request->input('amount_s2_a_p');

        $amount_t3_a_p=$request->input('amount_d3_a_p');
        $amount_m3_a_p=$request->input('amount_m3_a_p');
        $amount_d3_a_p=$request->input('amount_d3_a_p');
        $amount_s3_a_p=$request->input('amount_s3_a_p');

        $amount_t4_a_p=$request->input('amount_d4_a_p');
        $amount_m4_a_p=$request->input('amount_m4_a_p');
        $amount_d4_a_p=$request->input('amount_d4_a_p');
        $amount_s4_a_p=$request->input('amount_s4_a_p');

        $amount_t5_a_p=$request->input('amount_d5_a_p');
        $amount_m5_a_p=$request->input('amount_m5_a_p');
        $amount_d5_a_p=$request->input('amount_d5_a_p');
        $amount_s5_a_p=$request->input('amount_s5_a_p');

        //-- precio de venta
        $amount_t2_a_v=$request->input('amount_t2_a_v');
        $amount_m2_a_v=$request->input('amount_m2_a_v');
        $amount_d2_a_v=$request->input('amount_d2_a_v');
        $amount_s2_a_v=$request->input('amount_s2_a_v');

        $amount_t3_a_v=$request->input('amount_d3_a_v');
        $amount_m3_a_v=$request->input('amount_m3_a_v');
        $amount_d3_a_v=$request->input('amount_d3_a_v');
        $amount_s3_a_v=$request->input('amount_s3_a_v');

        $amount_t4_a_v=$request->input('amount_d4_a_v');
        $amount_m4_a_v=$request->input('amount_m4_a_v');
        $amount_d4_a_v=$request->input('amount_d4_a_v');
        $amount_s4_a_v=$request->input('amount_s4_a_v');

        $amount_t5_a_v=$request->input('amount_d5_a_v');
        $amount_m5_a_v=$request->input('amount_m5_a_v');
        $amount_d5_a_v=$request->input('amount_d5_a_v');
        $amount_s5_a_v=$request->input('amount_s5_a_v');

//        dd('profit_2:'.$profit_2.',profit_3:'.$profit_3.',profit_4:'.$profit_4.',profit_5:'.$profit_5);
//        dd($txta_include.'_'.$txta_notinclude);
        $paquete=P_Paquete::FindOrFail($paquete_id);
        // $paquete->pagina=$txt_pagina;
        $paquete->codigo=$txt_code;
        $paquete->titulo=$txt_title;
        $paquete->duracion=$txt_day;
        $paquete->descripcion=$txta_description;
        $paquete->incluye=$txta_include;
        $paquete->noincluye=$txta_notinclude;
        $paquete->utilidad=$request->input('txt_utilidad');
        $paquete->precio_venta=$request->input('totalItinerario_venta');
        $paquete->estado=1;
        $paquete->preciocosto=$totalItinerario;
        $paquete->save();
        // dd($paquete);
        $paquete_pagina=PaquetePagina::where('p_paquete_id',$paquete_id)->delete();
        foreach($txt_pagina as $txt_pagina_){
            $pqt_pagina=new PaquetePagina();
            $pqt_pagina->pagina=$txt_pagina_;
            $pqt_pagina->p_paquete_id=$paquete_id;
            $pqt_pagina->save();
        }
        $p_paquete_precio=P_PaquetePrecio::where('p_paquete_id',$paquete_id)->delete();
        $p_paquete_itinerario=P_Itinerario::where('p_paquete_id',$paquete_id)->delete();
        // dd($txt_day);
        if($txt_day>1) {
            $paquete_precio2 = new P_PaquetePrecio();
            $paquete_precio2->estrellas = 2;
            $paquete_precio2->precio_s = $amount_s2;
            $paquete_precio2->personas_s = 1;
            $paquete_precio2->precio_m = $amount_d2;
            $paquete_precio2->personas_m = 1;
            $paquete_precio2->precio_d = $amount_d2;
            $paquete_precio2->personas_d = 1;
            $paquete_precio2->precio_t = $amount_t2;
            $paquete_precio2->personas_t = 1;
            if ($strellas_2 == 2)
                $paquete_precio2->estado = 1;
            else
                $paquete_precio2->estado = 0;
            $paquete_precio2->utilidad_s = $amount_s2_a_p;
            $paquete_precio2->utilidad_m = $amount_m2_a_p;
            $paquete_precio2->utilidad_d = $amount_d2_a_p;
            $paquete_precio2->utilidad_t = $amount_t2_a_p;
            $paquete_precio2->p_paquete_id = $paquete->id;
            $paquete_precio2->hotel_id = $hotel_id_2;
            $paquete_precio2->save();

            $paquete_precio3 = new P_PaquetePrecio();
            $paquete_precio3->estrellas = 3;
            $paquete_precio3->precio_s = $amount_s3;
            $paquete_precio3->personas_s = 1;
            $paquete_precio3->precio_m = $amount_d3;
            $paquete_precio3->personas_m = 1;
            $paquete_precio3->precio_d = $amount_d3;
            $paquete_precio3->personas_d = 1;
            $paquete_precio3->precio_t = $amount_t3;
            $paquete_precio3->personas_t = 1;
            if ($strellas_3 == 3)
                $paquete_precio3->estado = 1;
            else
                $paquete_precio3->estado = 0;
            $paquete_precio3->utilidad_s = $amount_s2_a_p;
            $paquete_precio3->utilidad_m = $amount_m2_a_p;
            $paquete_precio3->utilidad_d = $amount_d2_a_p;
            $paquete_precio3->utilidad_t = $amount_t2_a_p;
            $paquete_precio3->p_paquete_id = $paquete->id;
            $paquete_precio3->hotel_id = $hotel_id_3;
            $paquete_precio3->save();

            $paquete_precio4 = new P_PaquetePrecio();
            $paquete_precio4->estrellas = 4;
            $paquete_precio4->precio_s = $amount_s4;
            $paquete_precio4->personas_s = 1;
            $paquete_precio4->precio_m = $amount_d4;
            $paquete_precio4->personas_m = 1;
            $paquete_precio4->precio_d = $amount_d4;
            $paquete_precio4->personas_d = 1;
            $paquete_precio4->precio_t = $amount_t4;
            $paquete_precio4->personas_t = 1;
            if ($strellas_4 == 4)
                $paquete_precio4->estado = 1;
            else
                $paquete_precio4->estado = 0;
            $paquete_precio4->utilidad_s = $amount_s2_a_p;
            $paquete_precio4->utilidad_m = $amount_m2_a_p;
            $paquete_precio4->utilidad_d = $amount_d2_a_p;
            $paquete_precio4->utilidad_t = $amount_t2_a_p;
            $paquete_precio4->p_paquete_id = $paquete->id;
            $paquete_precio4->hotel_id = $hotel_id_4;
            $paquete_precio4->save();

            $paquete_precio5 = new P_PaquetePrecio();
            $paquete_precio5->estrellas = 5;
            $paquete_precio5->precio_s = $amount_s5;
            $paquete_precio5->personas_s = 1;
            $paquete_precio5->precio_m = $amount_d5;
            $paquete_precio5->personas_m = 1;
            $paquete_precio5->precio_d = $amount_d5;
            $paquete_precio5->personas_d = 1;
            $paquete_precio5->precio_t = $amount_t5;
            $paquete_precio5->personas_t = 1;
            if ($strellas_5 == 5)
                $paquete_precio5->estado = 1;
            else
                $paquete_precio5->estado = 0;
            $paquete_precio5->utilidad_s = $amount_s2_a_p;
            $paquete_precio5->utilidad_m = $amount_m2_a_p;
            $paquete_precio5->utilidad_d = $amount_d2_a_p;
            $paquete_precio5->utilidad_t = $amount_t2_a_p;
            $paquete_precio5->p_paquete_id = $paquete->id;
            $paquete_precio5->hotel_id = $hotel_id_5;
            $paquete_precio5->save();

        }
        $dia = 0;
        // dd($dia);
        // dd($itinerarios_);
        if(count($itinerarios_)>0){
            foreach ($itinerarios_ as $itinerario_id){
                $dia_=$dia+1;
                $m_itineario=M_Itinerario::FindOrFail($itinerario_id);
                $p_itinerario=new P_Itinerario();
                $p_itinerario->titulo=$m_itineario->titulo;
                $p_itinerario->descripcion=$m_itineario->descripcion;
                $p_itinerario->dias=$dia_;
                $p_itinerario->precio=$m_itineario->precio;
                $p_itinerario->imagen=$m_itineario->imagen;
                $p_itinerario->imagenB=$m_itineario->imagenB;
                $p_itinerario->imagenC=$m_itineario->imagenC;
                $p_itinerario->destino_foco=$m_itineario->destino_foco;
                $p_itinerario->destino_duerme=$m_itineario->destino_duerme;
                $p_itinerario->sugerencia='';
                $p_itinerario->estado=1;
                $p_itinerario->m_itinerario_id=$m_itineario->id;
                $p_itinerario->p_paquete_id=$paquete->id;
                $p_itinerario->save();
                $dia++;
                foreach ($m_itineario->destinos as $m_destinos){
                    $p_destinos=new P_ItinerarioDestino();
                    $p_destinos->codigo=$m_destinos->codigo;
                    $p_destinos->destino=$m_destinos->destino;
                    $p_destinos->region=$m_destinos->region;
                    $p_destinos->pais=$m_destinos->pais;
                    $p_destinos->descripcion=$m_destinos->descripcion;
                    $p_destinos->imagen=$m_destinos->imagen;
                    $p_destinos->estado=1;
                    $p_destinos->p_itinerario_id=$p_itinerario->id;
                    $p_destinos->save();
                }
                $st=0;
                foreach($m_itineario->itinerario_itinerario_servicios as $servicios){
                    $p_servicio=new P_ItinerarioServicios();
                    $p_servicio->nombre=$servicios->itinerario_servicios_servicio->nombre;
                    $p_servicio->min_personas=$servicios->itinerario_servicios_servicio->min_personas;
                    $p_servicio->max_personas=$servicios->itinerario_servicios_servicio->max_personas;
                    $p_servicio->observacion='';
                    if($servicios->itinerario_servicios_servicio->precio_grupo==1) {
                        $p_servicio->precio = round($servicios->itinerario_servicios_servicio->precio_venta / 2,2);
                        $p_servicio->precio_grupo = 1;
                    }
                    else{
                        $p_servicio->precio = $servicios->itinerario_servicios_servicio->precio_venta;
                        $p_servicio->precio_grupo=0;
                    }
                    $st+=$p_servicio->precio;
                    $p_servicio->p_itinerario_id=$p_itinerario->id;
                    $p_servicio->m_servicios_id = $servicios->itinerario_servicios_servicio->id;
                    $p_servicio->save();
                }
                $p_itinerario->precio=$st;
                $p_itinerario->save();
            }
        }
//        $itineraries=P_Paquete::get();
//        return view('admin.show-itineraries',['itineraries'=>$itineraries]);
//        return redirect()->route('show_itineraries_path');
        return redirect()->route('show_itineraries_path');
        // $webs=Web::get();
        // $itineraries=P_Paquete::get();
        // $itinerarios=M_Itinerario::get();
        // session()->put('menu-lateral', 'sales/iti/list');
        // return view('admin.show-itineraries',compact(['itineraries','itinerarios','webs']));
    }
    public function itineraries()
    {
        $webs=Web::get();
        $itineraries=P_Paquete::get();
        $itinerarios=M_Itinerario::get();
        session()->put('menu-lateral', 'sales/iti/list');
        return view('admin.show-itineraries',compact(['itineraries','itinerarios','webs']));
    }
    public function show_itinerary($id)
    {
        $webs=Web::get();
        $destinos=M_Destino::get();
        $itinerarios=M_Itinerario::get();
        $m_servicios=M_Servicio::get();
        $itinerary=P_Paquete::FindOrFail($id);
        $itinerarios_d=M_ItinerarioDestino::get();
        $paquete_paginas=PaquetePagina::get();
        return view('admin.show-itinerary', ['itinerary'=>$itinerary,'destinos'=>$destinos,'itinerarios'=>$itinerarios,'m_servicios'=>$m_servicios,'paquete_id'=>$id,'itinerarios_d'=>$itinerarios_d,'webs'=>$webs,'paquete_paginas'=>$paquete_paginas,'id'=>$id]);
    }
    public function duplicate_itinerary($id)
    {
        $destinos=M_Destino::get();
        $itinerarios=M_Itinerario::get();
        $m_servicios=M_Servicio::get();
        $itinerary=P_Paquete::FindOrFail($id);
        $webs=Web::get();
        return view('admin.duplicate-itinerary',['itinerary'=>$itinerary,'destinos'=>$destinos,'itinerarios'=>$itinerarios,'m_servicios'=>$m_servicios,'paquete_id'=>$id,'grupo','webs'=>$webs]);
    }
    public function itinerary_duplicate(Request $request)
    {
//        $paquete_id=$request->input('paquete_id');

        $txt_pagina=$request->input('txt_pagina');
        $txt_day=strtoupper(($request->input('txt_day')));
        $txt_code=strtoupper(($request->input('txt_codigo')));
        $txt_title=strtoupper(($request->input('txt_title')));
        $txta_description=$request->input('txta_description');
        $txta_include=$request->input('txta_include');
        $txta_notinclude=$request->input('txta_notinclude');
        $totalItinerario=$request->input('totalItinerario');
        $itinerarios_=$request->input('itinerarios_');
        $txt_sugerencia=$request->input('txt_sugerencia');

        $strellas_2=$request->input('strellas_2');
        $strellas_3=$request->input('strellas_3');
        $strellas_4=$request->input('strellas_4');
        $strellas_5=$request->input('strellas_5');

        $amount_t2=$request->input('amount_t2');
        $amount_d2=$request->input('amount_d2');
        $amount_s2=$request->input('amount_s2');

        $amount_t3=$request->input('amount_t3');
        $amount_d3=$request->input('amount_d3');
        $amount_s3=$request->input('amount_s3');

        $amount_t4=$request->input('amount_t4');
        $amount_d4=$request->input('amount_d4');
        $amount_s4=$request->input('amount_s4');

        $amount_t5=$request->input('amount_t5');
        $amount_d5=$request->input('amount_d5');
        $amount_s5=$request->input('amount_s5');

        $profit_2=$request->input('profitt_2');
        $profit_3=$request->input('profitt_3');
        $profit_4=$request->input('profitt_4');
        $profit_5=$request->input('profitt_5');

//        dd('profit_2:'.$profit_2.',profit_3:'.$profit_3.',profit_4:'.$profit_4.',profit_5:'.$profit_5);
//        dd($txta_include.'_'.$txta_notinclude);
        $paquete=new P_Paquete();
        $paquete->pagina=$txt_pagina;
        $paquete->codigo=$txt_code;
        $paquete->titulo=$txt_title;
        $paquete->duracion=$txt_day;
        $paquete->descripcion=$txta_description;
        $paquete->incluye=$txta_include;
        $paquete->noincluye=$txta_notinclude;
        $paquete->utilidad=40;
        $paquete->estado=1;
        $paquete->preciocosto=$totalItinerario;
        $paquete->save();

        $paquete_precio2=new P_PaquetePrecio();
        $paquete_precio2->estrellas=2;
        $paquete_precio2->precio_s=$amount_s2;
        $paquete_precio2->personas_s=1;
        $paquete_precio2->precio_m=$amount_d2;
        $paquete_precio2->personas_m=1;
        $paquete_precio2->precio_d=$amount_d2;
        $paquete_precio2->personas_d=1;
        $paquete_precio2->precio_t=$amount_t2;
        $paquete_precio2->personas_t=1;
        if($strellas_2==2)
            $paquete_precio2->estado=1;
        else
            $paquete_precio2->estado=0;
        $paquete_precio2->utilidad=$profit_2;
        $paquete_precio2->p_paquete_id=$paquete->id;
        $paquete_precio2->save();

        $paquete_precio3=new P_PaquetePrecio();
        $paquete_precio3->estrellas=3;
        $paquete_precio3->precio_s=$amount_s3;
        $paquete_precio3->personas_s=1;
        $paquete_precio3->precio_m=$amount_d3;
        $paquete_precio3->personas_m=1;
        $paquete_precio3->precio_d=$amount_d3;
        $paquete_precio3->personas_d=1;
        $paquete_precio3->precio_t=$amount_t3;
        $paquete_precio3->personas_t=1;
        if($strellas_3==3)
            $paquete_precio3->estado=1;
        else
            $paquete_precio3->estado=0;
        $paquete_precio3->utilidad=$profit_3;
        $paquete_precio3->p_paquete_id=$paquete->id;
        $paquete_precio3->save();

        $paquete_precio4=new P_PaquetePrecio();
        $paquete_precio4->estrellas=4;
        $paquete_precio4->precio_s=$amount_s4;
        $paquete_precio4->personas_s=1;
        $paquete_precio4->precio_m=$amount_d4;
        $paquete_precio4->personas_m=1;
        $paquete_precio4->precio_d=$amount_d4;
        $paquete_precio4->personas_d=1;
        $paquete_precio4->precio_t=$amount_t4;
        $paquete_precio4->personas_t=1;
        if($strellas_4==4)
            $paquete_precio4->estado=1;
        else
            $paquete_precio4->estado=0;
        $paquete_precio4->utilidad=$profit_4;
        $paquete_precio4->p_paquete_id=$paquete->id;
        $paquete_precio4->save();

        $paquete_precio5=new P_PaquetePrecio();
        $paquete_precio5->estrellas=5;
        $paquete_precio5->precio_s=$amount_s5;
        $paquete_precio5->personas_s=1;
        $paquete_precio5->precio_m=$amount_d5;
        $paquete_precio5->personas_m=1;
        $paquete_precio5->precio_d=$amount_d5;
        $paquete_precio5->personas_d=1;
        $paquete_precio5->precio_t=$amount_t5;
        $paquete_precio5->personas_t=1;
        if($strellas_5==5)
            $paquete_precio5->estado=1;
        else
            $paquete_precio5->estado=0;
        $paquete_precio5->utilidad=$profit_5;
        $paquete_precio5->p_paquete_id=$paquete->id;
        $paquete_precio5->save();
        $dia=0;
        foreach ($itinerarios_ as $itinerario_id){
            $dia_=$dia+1;
            $m_itineario=M_Itinerario::FindOrFail($itinerario_id);
            $p_itinerario=new P_Itinerario();
            $p_itinerario->titulo=$m_itineario->titulo;
            $p_itinerario->descripcion=$m_itineario->descripcion;
            $p_itinerario->dias=$dia_;
            $p_itinerario->precio=$m_itineario->precio;
            $p_itinerario->imagen=$m_itineario->imagen;
            $p_itinerario->imagenB=$m_itineario->imagenB;
            $p_itinerario->imagenC=$m_itineario->imagenC;

            $p_itinerario->sugerencia=$txt_sugerencia[$dia];
            $p_itinerario->estado=1;
            $p_itinerario->p_paquete_id=$paquete->id;
            $p_itinerario->save();
            $dia++;
            foreach ($m_itineario->destinos as $m_destinos){
                $p_destinos=new P_ItinerarioDestino();
                $p_destinos->codigo=$m_destinos->codigo;
                $p_destinos->destino=$m_destinos->destino;
                $p_destinos->region=$m_destinos->region;
                $p_destinos->pais=$m_destinos->pais;
                $p_destinos->descripcion=$m_destinos->descripcion;
                $p_destinos->imagen=$m_destinos->imagen;
                $p_destinos->estado=1;
                $p_destinos->p_itinerario_id=$p_itinerario->id;
                $p_destinos->save();
            }
            $st=0;
            foreach($m_itineario->itinerario_itinerario_servicios as $servicios){
                $p_servicio=new P_ItinerarioServicios();
                $p_servicio->nombre=$servicios->itinerario_servicios_servicio->nombre;
                $p_servicio->min_personas=$servicios->itinerario_servicios_servicio->min_personas;
                $p_servicio->max_personas=$servicios->itinerario_servicios_servicio->max_personas;
                $p_servicio->observacion='';
                if($servicios->itinerario_servicios_servicio->precio_grupo==1) {
                    $p_servicio->precio = round($servicios->itinerario_servicios_servicio->precio_venta / 2,2);
                    $p_servicio->precio_grupo = 1;
                }
                else{
                    $p_servicio->precio = $servicios->itinerario_servicios_servicio->precio_venta;
                    $p_servicio->precio_grupo=0;
                }
                $st+=$p_servicio->precio;
                $p_servicio->p_itinerario_id=$p_itinerario->id;
                $p_servicio->m_servicios_id = $servicios->itinerario_servicios_servicio->id;
                $p_servicio->save();
            }
            $p_itinerario->precio=$st;
            $p_itinerario->save();
        }
//        return redirect()->route('show_itineraries_path');
        return redirect()->route('show_itineraries_path');
//        $itineraries=P_Paquete::get();
//        return view('admin.show-itineraries',['itineraries'=>$itineraries]);
    }
    public function delete(Request $request)
    {
        $paquete_id=$request->input('id');
        $eliminar=P_Paquete::FindOrFail($paquete_id)->delete();
        if($eliminar==1)
            return 1;
        else
            return 0;
    }
    public function pdf($id)
    {
        $paquetes = P_Paquete::where('id',$id)->get();
//        dd($paquetes);
        foreach ($paquetes as $paquete){
            $pdf = \PDF::loadView('admin.pdf-package', ['paquete'=>$paquete])->setPaper('a4')->setWarnings(true);
            return $pdf->download($paquete->codigo.' '.$paquete->nombre.'x'.$paquete->duracion.'.pdf');
        }
    }
    public function itinerary_plantilla_crear(Request $request)
    {
        $btn_guardar=$request->input('btn_guardar');
        $btn_cancelar=$request->input('btn_cancelar');
        $paquete_id=$request->input('paquete_id');
        $coti_id=$request->input('coti_id');
        if(isset($btn_guardar)){
        $txt_day=strtoupper(($request->input('txt_day')));
        $txt_code=strtoupper(($request->input('txt_codigo')));
//        $txt_title=strtoupper(($request->input('txt_title')));
        $txta_description=$request->input('txta_description');
        $txt_title=strtoupper($txta_description);
        $txta_include=$request->input('txta_include');
        $txta_notinclude=$request->input('txta_notinclude');
        $totalItinerario=$request->input('totalItinerario');
        $itinerarios_=$request->input('itinerarios_2');
        $txt_sugerencia=$request->input('txt_sugerencia');

        $strellas_2=$request->input('strellas_2');
        $strellas_3=$request->input('strellas_3');
        $strellas_4=$request->input('strellas_4');
        $strellas_5=$request->input('strellas_5');

        $amount_t2=$request->input('amount_t2');
        $amount_d2=$request->input('amount_d2');
        $amount_s2=$request->input('amount_s2');

        $amount_t3=$request->input('amount_t3');
        $amount_d3=$request->input('amount_d3');
        $amount_s3=$request->input('amount_s3');

        $amount_t4=$request->input('amount_t4');
        $amount_d4=$request->input('amount_d4');
        $amount_s4=$request->input('amount_s4');

        $amount_t5=$request->input('amount_t5');
        $amount_d5=$request->input('amount_d5');
        $amount_s5=$request->input('amount_s5');

        $profit_2=$request->input('profitt_2');
        $profit_3=$request->input('profitt_3');
        $profit_4=$request->input('profitt_4');
        $profit_5=$request->input('profitt_5');

        $hotel_id_2=$request->input('hotel_id_2');
        $hotel_id_3=$request->input('hotel_id_3');
        $hotel_id_4=$request->input('hotel_id_4');
        $hotel_id_5=$request->input('hotel_id_5');


//        dd('profit_2:'.$profit_2.',profit_3:'.$profit_3.',profit_4:'.$profit_4.',profit_5:'.$profit_5);
//        dd($txta_include.'_'.$txta_notinclude);
        $paquete=P_Paquete::FindOrFail($paquete_id);
        $paquete->codigo=$txt_code;
        $paquete->titulo=$txt_title;
        $paquete->duracion=$txt_day;
        $paquete->descripcion=$txta_description;
        $paquete->incluye=$txta_include;
        $paquete->noincluye=$txta_notinclude;
        $paquete->utilidad=40;
        $paquete->estado=1;
        $paquete->preciocosto=$totalItinerario;
        $paquete->save();

        $p_paquete_precio=P_PaquetePrecio::where('p_paquete_id',$paquete_id)->delete();
        $p_paquete_itinerario=P_Itinerario::where('p_paquete_id',$paquete_id)->delete();

        $paquete_precio2=new P_PaquetePrecio();
        $paquete_precio2->estrellas=2;
        $paquete_precio2->precio_s=$amount_s2;
        $paquete_precio2->personas_s=1;
        $paquete_precio2->precio_m=$amount_d2;
        $paquete_precio2->personas_m=1;
        $paquete_precio2->precio_d=$amount_d2;
        $paquete_precio2->personas_d=1;
        $paquete_precio2->precio_t=$amount_t2;
        $paquete_precio2->personas_t=1;
        if($strellas_2==2)
            $paquete_precio2->estado=1;
        else
            $paquete_precio2->estado=0;
        $paquete_precio2->utilidad=$profit_2;
        $paquete_precio2->p_paquete_id=$paquete->id;
        $paquete_precio2->hotel_id=$hotel_id_2;
        $paquete_precio2->save();

        $paquete_precio3=new P_PaquetePrecio();
        $paquete_precio3->estrellas=3;
        $paquete_precio3->precio_s=$amount_s3;
        $paquete_precio3->personas_s=1;
        $paquete_precio3->precio_m=$amount_d3;
        $paquete_precio3->personas_m=1;
        $paquete_precio3->precio_d=$amount_d3;
        $paquete_precio3->personas_d=1;
        $paquete_precio3->precio_t=$amount_t3;
        $paquete_precio3->personas_t=1;
        if($strellas_3==3)
            $paquete_precio3->estado=1;
        else
            $paquete_precio3->estado=0;
        $paquete_precio3->utilidad=$profit_3;
        $paquete_precio3->p_paquete_id=$paquete->id;
        $paquete_precio3->hotel_id=$hotel_id_3;
        $paquete_precio3->save();

        $paquete_precio4=new P_PaquetePrecio();
        $paquete_precio4->estrellas=4;
        $paquete_precio4->precio_s=$amount_s4;
        $paquete_precio4->personas_s=1;
        $paquete_precio4->precio_m=$amount_d4;
        $paquete_precio4->personas_m=1;
        $paquete_precio4->precio_d=$amount_d4;
        $paquete_precio4->personas_d=1;
        $paquete_precio4->precio_t=$amount_t4;
        $paquete_precio4->personas_t=1;
        if($strellas_4==4)
            $paquete_precio4->estado=1;
        else
            $paquete_precio4->estado=0;
        $paquete_precio4->utilidad=$profit_4;
        $paquete_precio4->p_paquete_id=$paquete->id;
        $paquete_precio4->hotel_id=$hotel_id_4;
        $paquete_precio4->save();

        $paquete_precio5=new P_PaquetePrecio();
        $paquete_precio5->estrellas=5;
        $paquete_precio5->precio_s=$amount_s5;
        $paquete_precio5->personas_s=1;
        $paquete_precio5->precio_m=$amount_d5;
        $paquete_precio5->personas_m=1;
        $paquete_precio5->precio_d=$amount_d5;
        $paquete_precio5->personas_d=1;
        $paquete_precio5->precio_t=$amount_t5;
        $paquete_precio5->personas_t=1;
        if($strellas_5==5)
            $paquete_precio5->estado=1;
        else
            $paquete_precio5->estado=0;
        $paquete_precio5->utilidad=$profit_5;
        $paquete_precio5->p_paquete_id=$paquete->id;
        $paquete_precio5->hotel_id=$hotel_id_5;
        $paquete_precio5->save();
        $dia=0;
        foreach ($itinerarios_ as $itinerario_id){
            $dia_=$dia+1;
            $m_itineario=M_Itinerario::FindOrFail($itinerario_id);
            $p_itinerario=new P_Itinerario();
            $p_itinerario->titulo=$m_itineario->titulo;
            $p_itinerario->descripcion=$m_itineario->descripcion;
            $p_itinerario->dias=$dia_;
            $p_itinerario->precio=$m_itineario->precio;
            $p_itinerario->imagen=$m_itineario->imagen;
            $p_itinerario->sugerencia=$txt_sugerencia[$dia];
            $p_itinerario->estado=1;
            $p_itinerario->p_paquete_id=$paquete->id;
            $p_itinerario->save();
            $dia++;
            foreach ($m_itineario->destinos as $m_destinos){
                $p_destinos=new P_ItinerarioDestino();
                $p_destinos->codigo=$m_destinos->codigo;
                $p_destinos->destino=$m_destinos->destino;
                $p_destinos->region=$m_destinos->region;
                $p_destinos->pais=$m_destinos->pais;
                $p_destinos->descripcion=$m_destinos->descripcion;
                $p_destinos->imagen=$m_destinos->imagen;
                $p_destinos->estado=1;
                $p_destinos->p_itinerario_id=$p_itinerario->id;
                $p_destinos->save();
            }
            $st=0;
            foreach($m_itineario->itinerario_itinerario_servicios as $servicios){
                $p_servicio=new P_ItinerarioServicios();
                $p_servicio->nombre=$servicios->itinerario_servicios_servicio->nombre;
                $p_servicio->min_personas=$servicios->itinerario_servicios_servicio->min_personas;
                $p_servicio->max_personas=$servicios->itinerario_servicios_servicio->max_personas;
                $p_servicio->observacion='';
                if($servicios->itinerario_servicios_servicio->precio_grupo==1) {
                    $p_servicio->precio = round($servicios->itinerario_servicios_servicio->precio_venta / 2,2);
                    $p_servicio->precio_grupo = 1;
                }
                else{
                    $p_servicio->precio = $servicios->itinerario_servicios_servicio->precio_venta;
                    $p_servicio->precio_grupo=0;
                }
                $st+=$p_servicio->precio;
                $p_servicio->p_itinerario_id=$p_itinerario->id;
                $p_servicio->m_servicios_id = $servicios->itinerario_servicios_servicio->id;
                $p_servicio->save();
            }
            $p_itinerario->precio=$st;
            $p_itinerario->save();
        }
        $itineraries=P_Paquete::get();
        return view('admin.show-itineraries',['itineraries'=>$itineraries]);
    }
    if(isset($btn_cancelar)){

        $paquete=P_Paquete::FindOrFail($paquete_id);
        $paquete->delete();
        return redirect()->route('cotizacion_id_show_path',$coti_id);
    }
}
    public function generar_codigo_plantilla(Request $request){
        $duracion=$request->input('duracion');
        $tipo_plantilla=$request->input('tipo_plantilla');
        $pagina=$request->input('pagina');
        $codigo='';
        if($pagina=='gotoperu.com') {
            $plantillas = P_Paquete::where('duracion', $duracion)->where('pagina', $pagina)->get();
            $nro = count($plantillas);
//        return $nro;
            $numero_con_ceros = '';
            if ($nro > 0) {
                $diferencia = 4 - strlen($nro);

                for ($i = 0; $i < $diferencia; $i++) {
                    $numero_con_ceros .= 0;
                }

                $numero_con_ceros .= $nro + 1;
            } else
                $numero_con_ceros = '0001';
            $codigo = 'GTP' . $duracion . $numero_con_ceros;
        }
        return $codigo;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function buscar_day_by_day_ajax(Request $request)
    {
        //
        $destino = $request->input('destino');
        if ($destino != 0){
            $m_destinos=M_Destino::get();
            $day_by_days = M_Itinerario::select('id','dia','titulo','resumen','descripcion','precio','imagen','imagenB','imagenC','destino_foco','destino_duerme','tipo')->where('destino_foco', $destino)->get()->sortBy('titulo');
            return view('admin.daybyday.get-day-by-day-x-destino', compact('day_by_days','destino','m_destinos'));
        }
        else {
            return '';
        }
    }
    public function buscar_day_by_day_ajax_dia(Request $request)
    {
        //
        $destino = $request->input('destino');
        
        $m_destinos=M_Destino::get();
        if ($destino != 0){
            $day_by_days = M_Itinerario::select('id','dia','titulo','resumen','descripcion','precio','imagen','imagenB','imagenC','destino_foco','destino_duerme','tipo')->where('destino_foco', $destino)->groupBy('tipo','id')->get()->sortBy('tipo');
            return view('admin.daybyday.get-day-by-day-x-destino-dia', compact('day_by_days','destino','m_destinos'));
        }
        else{
            return '';
        }
    }
    public function buscar_day_by_day_ajax_dia_edit(Request $request)
    {
        //
        // $destino = $request->input('destino');
        // $valor = $request->input('valor');
        // if ($destino != 0){
        //     $day_by_days = M_Itinerario::select('id','dia','titulo','resumen','descripcion','precio','imagen','imagenB','imagenC','destino_foco','destino_duerme','tipo')->where('destino_foco', $destino)->groupBy('tipo','id')->get()->sortBy('tipo');
        //     return view('admin.daybyday.get-day-by-day-x-destino-dia', compact('day_by_days'));
        // }


        $destino = $request->input('destino');
        $valor = $request->input('valor');
        // return $destino.'-'.$valor;
        $m_destinos=M_Destino::get();
            
        if ($destino != 0){
            if(trim($valor)==''){
                // $day_by_days = M_Itinerario::select('id','dia','titulo','resumen','descripcion','precio','imagen','imagenB','imagenC','destino_foco','destino_duerme','tipo')->where('destino_foco', $destino)->get()->sortBy('titulo');
                // return view('admin.daybyday.get-day-by-day-x-destino', compact('day_by_days','destino','m_destinos'));

                $day_by_days = M_Itinerario::select('id','dia','titulo','resumen','descripcion','precio','imagen','imagenB','imagenC','destino_foco','destino_duerme','tipo')->where('destino_foco', $destino)->groupBy('tipo','id')->get()->sortBy('tipo');
                return view('admin.daybyday.get-day-by-day-x-destino-dia', compact('day_by_days','destino','m_destinos'));
            }
            else{
                $day_by_days = M_Itinerario::select('id','dia','titulo','resumen','descripcion','precio','imagen','imagenB','imagenC','destino_foco','destino_duerme','tipo')->where('destino_foco', $destino)->where('titulo','like','%'.$valor.'%')->groupBy('tipo','id')->get()->sortBy('titulo');
                return view('admin.daybyday.get-day-by-day-x-destino-dia', compact('day_by_days','destino','m_destinos'));
            }
        }
        else{
            if(trim($valor)==''){
                $day_by_days = M_Itinerario::select('id','dia','titulo','resumen','descripcion','precio','imagen','imagenB','imagenC','destino_foco','destino_duerme','tipo')->groupBy('tipo','id')->get()->sortBy('titulo');
                return view('admin.daybyday.get-day-by-day-x-destino-dia', compact('day_by_days','destino','m_destinos'));
            }
            else{
                $day_by_days = M_Itinerario::select('id','dia','titulo','resumen','descripcion','precio','imagen','imagenB','imagenC','destino_foco','destino_duerme','tipo')->where('titulo','like','%'.$valor.'%')->groupBy('tipo','id')->get()->sortBy('titulo');
                return view('admin.daybyday.get-day-by-day-x-destino-dia', compact('day_by_days','destino','m_destinos'));
            }
        }
    }
    public function itineraries_listar_pagina(Request $request)
    {
        set_time_limit(0);
        $pagina = $request->input('pagina');
//        return $pagina;
        if($pagina=='0'){
            $itineraries =P_Paquete::get();
        }
        else{
            $itineraries = P_Paquete::whereHas('paquete_paginas', function($query) use($pagina) {
                $query->where('pagina',$pagina);
            })->get();
        }
        // if(count($itineraries)==0){
        //     $itineraries =P_Paquete::where('pagina', $pagina)->get();    
        // }
        $m_servicios=M_Servicio::get();
        // dd($itineraries);
        return view('admin.show-itinearies-pagina', compact('itineraries','m_servicios'));
    }

    public function buscar_day_by_day_ajax_valor(Request $request)
    {
        //
         
        $destino = $request->input('destino');
        $valor = $request->input('valor');
        // return $destino.'-'.$valor;
        $m_destinos=M_Destino::get();
            
        if ($destino != 0){
            if(trim($valor)==''){
                $day_by_days = M_Itinerario::select('id','dia','titulo','resumen','descripcion','precio','imagen','imagenB','imagenC','destino_foco','destino_duerme','tipo')->where('destino_foco', $destino)->get()->sortBy('titulo');
                return view('admin.daybyday.get-day-by-day-x-destino', compact('day_by_days','destino','m_destinos'));
            }
            else{
                $day_by_days = M_Itinerario::select('id','dia','titulo','resumen','descripcion','precio','imagen','imagenB','imagenC','destino_foco','destino_duerme','tipo')->where('destino_foco', $destino)->where('titulo','like','%'.$valor.'%')->get()->sortBy('titulo');
                return view('admin.daybyday.get-day-by-day-x-destino', compact('day_by_days','destino','m_destinos'));
            }
        }
        else{
            if(trim($valor)==''){
                $day_by_days = M_Itinerario::select('id','dia','titulo','resumen','descripcion','precio','imagen','imagenB','imagenC','destino_foco','destino_duerme','tipo')->get()->sortBy('titulo');
                return view('admin.daybyday.get-day-by-day-x-destino', compact('day_by_days','destino','m_destinos'));
            }
            else{
                $day_by_days = M_Itinerario::select('id','dia','titulo','resumen','descripcion','precio','imagen','imagenB','imagenC','destino_foco','destino_duerme','tipo')->where('titulo','like','%'.$valor.'%')->get()->sortBy('titulo');
                return view('admin.daybyday.get-day-by-day-x-destino', compact('day_by_days','destino','m_destinos'));
            }
        }
    }
}
