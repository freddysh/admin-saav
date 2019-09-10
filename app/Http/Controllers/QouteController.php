<?php

namespace App\Http\Controllers;

use App\Web;
use App\Hotel;
use App\Cliente;
use App\M_Destino;
use App\P_Paquete;
use Carbon\Carbon;
use App\Cotizacion;
use App\M_Servicio;
use App\M_Itinerario;
use App\PaquetePrecio;
use App\P_PaquetePrecio;
use App\CotizacionesPagos;
use App\ItinerarioDestinos;
use App\PrecioHotelReserva;
use App\CotizacionesCliente;
use App\ItinerarioServicios;
use App\M_ItinerarioDestino;
use App\PaqueteCotizaciones;
//use Maatwebsite\Excel\Excel;
use Illuminate\Http\Request;
use App\Helpers\MisFunciones;
use App\ItinerarioCotizaciones;
use PhpParser\Node\Expr\Array_;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Validation\Validator;

class QouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.quotes');
    }

    public function proposal()
    {
        return view('admin.quotes-pdf');
    }
    public function options()
    {
        return view('admin.quotes-option');
    }
    public function pax()
    {
        $cotizacion = Cotizacion::with('cotizaciones_cliente')->get();
//        $cotizacion = CotizacionesCliente::all();
        $clients = Cliente::all();
        return view('admin.quote-pax', ['cotizacion'=>$cotizacion, 'clients'=>$clients]);
    }
    public function paxshow(Request $request, $id)
    {

        $cotizacion = Cotizacion::with('cotizaciones_cliente')->where('id', $id)->get();
        $pagos = CotizacionesPagos::where('cotizaciones_id', $id)->get();
        $count_pagos = $pagos->count();
//        dd($count_pagos)
//        dd($quote_client);
        $clients = Cliente::all();
        $paquete = PaqueteCotizaciones::where('cotizaciones_id', $id)->where('estado',2)->get();

        if ($request->ajax()){
            $url = explode('page=', $request->fullUrl())[1];
            return response()->json(view('admin.pax.'.$url.'', ['cotizacion'=>$cotizacion, 'clients'=>$clients, 'paquete'=>$paquete, 'pagos'=>$pagos, 'count_pagos'=>$count_pagos, 'id_cot'=>$id])->render());
        }

        return view('admin.quote-pax-show', ['cotizacion'=>$cotizacion, 'clients'=>$clients, 'paquete'=>$paquete, 'pagos'=>$pagos, 'count_pagos'=>$count_pagos, 'id_cot'=>$id]);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function nuevo()
    {
        $valors=M_Destino::get();
        $itinerarios=M_Itinerario::get();
        $m_servicios=M_Servicio::get();
//        dd($servicios);
        return view('admin.quotes-new',['destinos'=>$destinos,'itinerarios'=>$itinerarios,'m_servicios'=>$m_servicios]);
    }
    public function nuevo1()
    {
        $webs=Web::get();
        $destinos=M_Destino::get();
        $itinerarios=M_Itinerario::get();
        $itinerarios_d=M_ItinerarioDestino::get();
        $m_servicios=M_Servicio::get();
        $p_paquete=P_Paquete::get();
        $hotel=Hotel::get();
//        dd($servicios);
        $plan=0;
        $id=0;
        $cliente_id=0;
        $nombres='';
        $nacionalidad='';
        $email='';
        $telefono='';
        $travelers=0;
        $days=0;
        $fecha='';
        $web='gotoperu.com';
        $idioma_pasajeros='';
        $codigo= MisFunciones::generar_codigo($web);
        // dd($codigo);
        session()->put('menu-lateral', 'quotes/new');
        return view('admin.quotes-new1',['destinos'=>$destinos,'itinerarios'=>$itinerarios,'m_servicios'=>$m_servicios,'p_paquete'=>$p_paquete, 'itinerarios_d'=>$itinerarios_d,'hotel'=>$hotel,
            'plan'=>$plan,
            'coti_id'=>$id,
            'cliente_id'=>$cliente_id,
            'nombres'=>$nombres,
            'nacionalidad'=>$nacionalidad,
            'email'=>$email,
            'telefono'=>$telefono,
            'travelers'=>$travelers,
            'days'=>$days,
            'fecha'=>$fecha,
            'web'=>$web,
            'codigo'=>$codigo,
            'idioma_pasajeros'=>$idioma_pasajeros,
            'webs'=>$webs
            ]);
    }
    public function nuevo1_pagina($web)
    {
        $webs=Web::get();
        $destinos=M_Destino::get();
        $itinerarios=M_Itinerario::get();
        $itinerarios_d=M_ItinerarioDestino::get();
        $m_servicios=M_Servicio::get();
        $p_paquete=P_Paquete::get();
        $hotel=Hotel::get();
//        dd($servicios);
        $plan=0;
        $id=0;
        $cliente_id=0;
        $nombres='';
        $nacionalidad='';
        $email='';
        $telefono='';
        $travelers=0;
        $days=0;
        $fecha='';
        // $web='gotoperu.com';
        $idioma_pasajeros='';
        $codigo= MisFunciones::generar_codigo($web);
        // dd($codigo);
        session()->put('menu-lateral', 'quotes/new');
        return view('admin.quotes-new1-pagina',['destinos'=>$destinos,'itinerarios'=>$itinerarios,'m_servicios'=>$m_servicios,'p_paquete'=>$p_paquete, 'itinerarios_d'=>$itinerarios_d,'hotel'=>$hotel,
            'plan'=>$plan,
            'coti_id'=>$id,
            'cliente_id'=>$cliente_id,
            'nombres'=>$nombres,
            'nacionalidad'=>$nacionalidad,
            'email'=>$email,
            'telefono'=>$telefono,
            'travelers'=>$travelers,
            'days'=>$days,
            'fecha'=>$fecha,
            'web'=>$web,
            'codigo'=>$codigo,
            'idioma_pasajeros'=>$idioma_pasajeros,
            'webs'=>$webs
            ]);
    }
    public function ordenar_servios_db(Request $request)
    {
        $lista_servicios=$request->input('array_servicios');
        $lista_servicios=explode('_',$lista_servicios);
        $pos=1;
        foreach ($lista_servicios as $lista_servicios_){
            $temp_exp=explode('/',$lista_servicios_);
            $temp=ItinerarioServicios::Find($temp_exp[0]);
            $temp->pos=$temp_exp[1];
            $temp->save();
            $pos++;
        }
        return 1;
    }
    public function generar_codigo(Request $request)
    {
        $web=$request->input('web');
        // return $web;
        $codigo= MisFunciones::generar_codigo($web);
        return $codigo;
    }
    public function cambiar_fecha(Request $request)
    {
        $iti_id=$request->input('iti_id');
        $fecha=$request->input('fecha');
        $titulo=$request->input('titulo');     
        $nombre_dia=$request->input('nombre_dia');     
        
        $iti=ItinerarioCotizaciones::FindOrFail($iti_id);
        $iti->fecha=$fecha;
        $iti->titulo=$titulo;
        $iti->dias=$nombre_dia;
        if($iti->save())
            return '1';
        else
            return '0';
    }
    public function leads(Request $request)
    {
        $page=$request->input('page');
        $mes=$request->input('mes');
        $anio=$request->input('anio');
        $user_name=auth()->guard('admin')->user()->name;
        $user_tipo=auth()->guard('admin')->user()->tipo_user;
        if($user_tipo=='ventas')
            $cotizacion=Cotizacion::where('users_id', auth()->guard('admin')->user()->id)->where('web', $page)->whereYear('fecha_venta', $anio)->whereMonth('fecha_venta', $mes)->where('posibilidad', '100')->get();
        else
            $cotizacion=Cotizacion::where('web', $page)->whereYear('fecha_venta',$anio)->whereMonth('fecha_venta',$mes)->where('posibilidad','100')->get();
//        return dd('cotizacion:'.$cotizacion);
        session()->put('menu-lateral', 'quotes/current');
        return view('admin.quotes-sales-page-mes',['cotizacion'=>$cotizacion, 'page'=>$page,'mes'=>$mes,'anio'=>$anio,'user_name'=>$user_name,'user_tipo'=>$user_tipo]);
    }
    public function expedia()
    {
        $webs=Web::get();
        $page='expedia.com';
        return view('admin.expedia.expedia-import',compact(['webs','page']));
    }
    public function import(Request $request)
    {
        set_time_limit ( 0 );
//        $request->validate([
//            'import_file' => 'required'
//        ]);
        $validator = \Validator::make(
            [
                'file'      => $request->file('import_file'),
                'extension' => strtolower($request->file('import_file')->getClientOriginalExtension()),
            ],
            [
                'file'          => 'required',
                'extension'      => 'required|in:csv,xlsx,xls',
            ]
        );
        if($validator->fails()){
            session()->flash('msg', '<div class="alert alert-danger" role="alert">Suba un archivo Excel</div>');
            return redirect()->back();
        }
        else {
            $errores=0;
            $web = $request->input('web');
            $path = $request->file('import_file')->getRealPath();
//        dd($path);
            $data = Excel::load($path, function ($reader) {
            })->get();
            $arr = [];
            if ($data->count()) {
                //guardamos el archivo excel
                $filename = 'archivo.' . $request->file('import_file')->getClientOriginalExtension();
                Storage::disk('archivos_excel')->put($filename, File::get($request->file('import_file')));

                $totaltravelers = '';
                $codigo = '';
                $transactiondatetime = '';
                $originalBookingDate = '';
                $titulo = '';
                $notas = '';
                $nombres = '';
                $telefono = '';
                $email = '';
                $total = 0;
                $idioma = '';
                $cost = 0;
                $profit = 0;
                $fecha_llegada = '';
                $estrellas = '';
                $notas1= '';

                foreach ($data as $key => $value) {
                    $totaltravelers = $value->travelers;
                    $codigo = $value->offerid;
                    // $transactiondatetime = $value->transactiondatetime;
//                $originalBookingDate=$value->originalbookingdate;
                    $titulo = $value->activitytitle . '[' . $value->offertitle . ']';
                    $idioma = $value->language;
                    $nombres = $value->leadtraveler;
                    $telefono = $value->travelerphone;
                    $email = $value->traveleremail;
                    $total = round($value->netamount, 2);
//                $cost=round($value->netcost,2);// calculado
//                $profit=round($value->profit,2);// calculado
                    $fecha_llegada = $value->destinationarrivaldate;
                    $notas1= $value->notas;
                    $notas = 'Tickettype:<i>' . $value->tickettype . '</i><br>' .
                        'DestinationDepartureFlightDate:<i>' . $value->destinationdepartureflightdate . '</i><br>' .
                        'PickupLocation:<i>' . $value->pickuplocation . '</i><br>' .
                        'DropoffLocation:<i>' . $value->dropofflocation . '</i><br>' .
                        'DestinationArrivalFlightNumber:<i>' . $value->destinationarrivalflightnumber . '</i><br>' .
                        'DestinationArrivalFlightTime:<i>' . $value->destinationarrivalflighttime . '</i><br>' .
                        'DestinationDepartureFlightNumber:<i>' . $value->destinationdepartureflightnumber . '</i><br>' .
                        'DestinationDepartureFlightTime:<i>' . $value->destinationdepartureflighttime . '</i><br>' .
                        'Journey:<i>' . $value->journey . '</i>';

                    if (
                        trim($totaltravelers) != '' &&
                        trim($codigo) != '' &&
                        /*trim($transactiondatetime) != '' &&*/
                        trim($titulo) != '' &&
                        trim($idioma) != '' &&
                        trim($nombres) != '' &&
                        trim($telefono) != '' &&
                        trim($email) != '' &&
                        trim($total) != '' &&
                        trim($fecha_llegada) != ''
                    ) {

                        
                        $ppaquete = P_Paquete::where('codigo', $codigo)->whereHas('paquete_paginas',function($query)use($web){
                            $query->where('pagina',$web);
                        })->first();
                        
                        // if(count((array)$ppaquete)==0) {
                        //     $ppaquete = P_Paquete::where('codigo', $codigo)->where('pagina', $web)->first();
                        // }  
                        // dd($ppaquete);
                        $nro_servicios_no_existe=0;
                        if(count((array)$ppaquete)) {
                            // foreach($ppaquete as $ppaquete_){
                                foreach($ppaquete->itinerarios as $itinerarios){
                                    foreach($itinerarios->serivicios as $serivicio){
                                        $serv=M_Servicio::where('id',$serivicio->m_servicios_id)->count();
                                        if($serv==0){
                                            $nro_servicios_no_existe++;
                                        }
                                    }
                                }   
                            // }
                        }
                        if(count((array)$ppaquete)) {
                            if ($ppaquete->duracion > 1) {
                                $estrellas = 'No necesita';
                                $estrellas = $value->stars;
                                if ($estrellas == '') {
                                    $estrellas = '<b class="text-danger">Falta</b>';
                                }
                            } else {
                                $estrellas = 'No necesita';
                            }
                            if($nro_servicios_no_existe>0){
                                $errores++;
                                $codigo='<b class="text-danger">'.$codigo.'<br>No se encontraron '.$nro_servicios_no_existe.' servicios, tienes que actualizar los servicios de la plantilla</b>';
                            }
                            else{
                                $codigo='<b class="text-success">'.$codigo.'</b>';
                            }
                        }
                        else{
                            $errores++;
                            $codigo='<b class="text-danger">'.$codigo.'<br>No existe para los filtros(pagina='.$web.',codigo='.$codigo.')</b>';
                        }

                        $fecha_llegada1=explode(' ',$fecha_llegada);

                        $arr[] = ['totaltravelers' => $totaltravelers, 'codigo' => $codigo, 'estrellas' => $estrellas, 'transactiondatetime' => $transactiondatetime, 'originalBookingDate' => $originalBookingDate, 'titulo' => $titulo, 'idioma' => $idioma, 'nombres' => $nombres, 'telefono' => $telefono, 'email' => $email, 'total' => $total, 'cost' => $cost, 'profit' => $profit, 'fecha_llegada' => $fecha_llegada1[0], 'notas' => $notas1];
                    }
                }
            }
//        return redirect()->back()->withInput($request->input())->with('arr',$arr);
//        return $arr;
            $webs=Web::get();
            return view('admin.expedia.expedia-import-vista-previa', compact('arr', 'filename','web','errores','webs'));
        }
    }
    public function expedia_save(Request $request)
    {
        set_time_limit ( 0 );
        $archivo=$request->input('import_file');        
        $web=$request->input('web');
        $ruta="../storage/app/public/archivos_excel/".$archivo;

        $data = Excel::load($ruta,function($reader){})->get();
        $arr=[];
        if($data->count()){
            $totaltravelers='';
            $codigo='';
            $transactiondatetime='';
            $originalBookingDate='';
            $titulo='';
            $notas='';
            $nombres='';
            $telefono='';
            $email='';
            $total=0;
            $idioma='';
            $cost=0;
            $profit=0;
            $fecha_llegada='';
            $estrellas='';
            $notas1='';
            foreach ($data as $key => $value) {
                $totaltravelers=$value->travelers;
                $codigo=$value->offerid;
                // $transactiondatetime=$value->transactiondatetime;
//                $originalBookingDate=$value->originalbookingdate;
                $titulo=$value->activitytitle.'['.$value->offertitle.']';
                $idioma=$value->language;
                $nombres=$value->leadtraveler;
                $telefono=$value->travelerphone;
                $email=$value->traveleremail;
                $total=round($value->netamount,2);
//                $cost=round($value->netcost,2);// calculado
//                $profit=round($value->profit,2);// calculado
                $fecha_llegada=$value->destinationarrivaldate;
                $notas1=$value->notas;
                $notas='Tickettype:<i>'.$value->tickettype.'</i><br>'.
                    'DestinationDepartureFlightDate:<i>'.$value->destinationdepartureflightdate.'</i><br>'.
                    'PickupLocation:<i>'.$value->pickuplocation.'</i><br>'.
                    'DropoffLocation:<i>'.$value->dropofflocation.'</i><br>'.
                    'DestinationArrivalFlightNumber:<i>'.$value->destinationarrivalflightnumber.'</i><br>'.
                    'DestinationArrivalFlightTime:<i>'.$value->destinationarrivalflighttime.'</i><br>'.
                    'DestinationDepartureFlightNumber:<i>'.$value->destinationdepartureflightnumber.'</i><br>'.
                    'DestinationDepartureFlightTime:<i>'.$value->destinationdepartureflighttime.'</i><br>'.
                    'Journey:<i>'.$value->journey.'</i>';

                if(
                    trim($totaltravelers)!=''&&
                    trim($codigo)!=''&&/*
                    trim($transactiondatetime)!=''&&*/
                    trim($titulo)!=''&&
                    trim($idioma)!=''&&
                    trim($nombres)!=''&&
                    trim($telefono)!=''&&
                    trim($email)!=''&&
                    trim($total)!=''&&
                    trim($fecha_llegada)!='') {

                    $ppaquete = P_Paquete::where('codigo', $codigo)->whereHas('paquete_paginas',function($query)use($web){
                        $query->where('pagina',$web);
                    })->first();

                    // $ppaquete = P_Paquete::where('codigo', $codigo)->whereHas('paquete_paginas',function($query)use($web){
                    //     $query->where('pagina',$web);
                    // })->first();
                    // if(count((array)$ppaquete)==0) {
                    //     $ppaquete = P_Paquete::where('codigo', $codigo)->where('pagina', $web)->first();
                    // }
                    if (count((array)$ppaquete) > 0) {
                        if ($ppaquete->duracion > 1) {
                            $estrellas = 'No necesita';
                            $estrellas = $value->stars;
                            if ($estrellas == '') {
                                $estrellas = '<b class="text-danger">Falta</b>';
                            }
                        }
                        else
                            $estrellas = 'No necesita';

                        if ($ppaquete->duracion > 1){
                                $estrellas = $value->stars;
                                $s = $value->s;
                                $d = $value->d;
                                $m = $value->m;
                                $t = $value->t;
                            }
                        //-- creamos el codigo autogenerado                        
                        // $nro_codigo=Cotizacion::where('web','expedia.com')->count()+1;
                        // $codigo_auto='E'.$nro_codigo;

                        // $codigo_auto=MisFunciones::generar_codigo('expedia.com');
                        $codigo_auto=MisFunciones::generar_codigo($web);
                        
                        // buscamos el paquete para crear la cotizacion
                        // $ppaquete = P_Paquete::where('codigo', $codigo)->first();

                            // $f=explode(' ',$fecha_llegada);
                            // if(count($f)>1){
                            //     if(strlen($f[0]==10)){
                            //         $fech=$f[0];
                            //     }
                            // }
                            // else{

                            // }
                            $fecha_llegada1=explode(' ',$fecha_llegada);
                            // if(strlen($f[0])==2){//-- peru
                            //     $fecha_llegada=$f[2].'-'.$f[1].'-'.$f[0];
                            // }

                        $coti = new Cotizacion();
                        $coti->codigo = $codigo_auto;
                        $coti->nombre_pax = $nombres;
                        $coti->codigo_pqt = $codigo;
                        $coti->nropersonas = $totaltravelers;
                        $coti->duracion = $ppaquete->duracion;
//                        $coti->precioventa = $ppaquete->precio_venta;
                        $coti->precioventa = $total;
                        $coti->fecha = $fecha_llegada1[0];
                        $coti->posibilidad = 0;
                        $coti->estado = 1;
                        $coti->fecha_venta =date('Y-m-d'); /*$transactiondatetime*/;
                        $coti->users_id = auth()->guard('admin')->user()->id;
                        $coti->categorizado = 'N';
                        $coti->web = $web;
                        $coti->idioma_pasajeros = $idioma;
                        $coti->notas = $notas1;
                        $coti->save();
//                    //-- creamos los campos para los pasajeros
                        for ($i = 1; $i <= $totaltravelers; $i++) {
                            $cli_temp = new Cliente();
                            if ($i == 1) {
                                $cli_temp->nombres = $nombres;
                                $cli_temp->telefono = $telefono;
                                $cli_temp->email = $email;
                            } else {
                                $cli_temp->nombres = 'Traveler ' . $i;
                                $cli_temp->telefono = '';
                                $cli_temp->email = '';
                            }
                            $cli_temp->estado = 1;
                            $cli_temp->save();

                            $coti_cliente = new CotizacionesCliente();
                            $coti_cliente->cotizaciones_id = $coti->id;
                            $coti_cliente->clientes_id = $cli_temp->id;
                            if ($i == 1) {
                                $coti_cliente->estado = 1;
                            } else {
                                $coti_cliente->estado = 0;
                            }
                            $coti_cliente->save();
                        }
                        $estrellas_ = 0;
                        if ($estrellas == 2)
                            $estrellas_ = $coti->star_2 = 2;
                        if ($estrellas == 3)
                            $estrellas_ = $coti->star_3 = 3;
                        if ($estrellas == 4)
                            $estrellas_ = $coti->star_4 = 4;
                        if ($estrellas == 5)
                            $estrellas_ = $coti->star_5 = 5;
                        $pqt = new PaqueteCotizaciones();
                        $pqt->estrellas = $estrellas_;
                        $pqt->codigo = $ppaquete->codigo;
                        $pqt->titulo = $ppaquete->titulo;
                        $pqt->duracion = $ppaquete->duracion;
                        $pqt->preciocosto = $ppaquete->preciocosto;
//                        $pqt->utilidad =$ppaquete->utilidad;
                        $pqt->utilidad =number_format(number_format($total,2, '.', '')-number_format($ppaquete->preciocosto,2, '.', ''),2, '.', '');
                        $pqt->estado = 1;
                        $pqt->precioventa = number_format($total,2, '.', '');
                        $pqt->descripcion = $ppaquete->descripcion;
                        $pqt->incluye = $ppaquete->incluye;
                        $pqt->noincluye = $ppaquete->noincluye;
//                        $pqt->opcional ='';
//                        $pqt->imagen ='';
                        $pqt->posibilidad = '0';
                        $pqt->cotizaciones_id = $coti->id;
                        $pqt->plan = 'A';
                        $pqt->proceso_complete = 1;
//                        $pqt->pedir_datos ='';
                        $pqt->save();
                        if ($ppaquete->duracion > 1) {
                            $pqt_precio = P_PaquetePrecio::where('estrellas', $estrellas)->get();
                            foreach ($pqt_precio as $pqt_temp_2) {
                                $pqt_precio = new PaquetePrecio();
                                $pqt_precio->estrellas = $estrellas;
                                $pqt_precio->precio_s = $pqt_temp_2->precio_s;
                                $pqt_precio->personas_s =$s;/* $pqt_temp_2->personas_s;*/
                                $pqt_precio->precio_d = $pqt_temp_2->precio_d;
                                $pqt_precio->personas_d =$d;/* $pqt_temp_2->personas_d;*/
                                $pqt_precio->precio_m = $pqt_temp_2->precio_m;
                                $pqt_precio->personas_m =$m;/* $pqt_temp_2->personas_m;*/
                                $pqt_precio->precio_t = $pqt_temp_2->precio_t;
                                $pqt_precio->personas_t =$t; /*$pqt_temp_2->personas_t;*/
                                $pqt_precio->estado = '1';
                                $pqt_precio->paquete_cotizaciones_id = $pqt->id;
                                $pqt_precio->hotel_id = $pqt_temp_2->hotel_id;
                                $pqt_precio->utilidad_s = $pqt_temp_2->utilidad_s;
                                $pqt_precio->utilidad_d = $pqt_temp_2->utilidad_d;
                                $pqt_precio->utilidad_m = $pqt_temp_2->utilidad_m;
                                $pqt_precio->utilidad_t = $pqt_temp_2->utilidad_t;
                                $pqt_precio->utilidad_por_s = $pqt_temp_2->utilidad_por_s;
                                $pqt_precio->utilidad_por_d = $pqt_temp_2->utilidad_por_d;
                                $pqt_precio->utilidad_por_m = $pqt_temp_2->utilidad_por_m;
                                $pqt_precio->utilidad_por_t = $pqt_temp_2->utilidad_por_t;
                                $pqt_precio->save();
                            }
                        }
                        $dia = 0;
                        $dia_texto = 1;
                        $coti = Cotizacion::FindOrFail($coti->id);
                        $fecha_viaje = date($coti->fecha);
                        $st_=0;
                        foreach ($ppaquete->itinerarios as $itinerarios_) {
                            $p_itinerario = new ItinerarioCotizaciones();
                            $p_itinerario->titulo = $itinerarios_->titulo;
                            $p_itinerario->descripcion = $itinerarios_->descripcion;
                            $p_itinerario->dias = $dia_texto;
                            $mod_date = strtotime('+' . ($dia_texto - 1) . ' day', strtotime($fecha_viaje));
                            $p_itinerario->fecha = date("Y-m-d", $mod_date);
                            $p_itinerario->precio = $itinerarios_->precio;
                            $p_itinerario->imagen = $itinerarios_->imagen;
                            $p_itinerario->imagenB = $itinerarios_->imagenB;
                            $p_itinerario->imagenC = $itinerarios_->imagenC;
                            $p_itinerario->destino_foco = $itinerarios_->destino_foco;
                            $p_itinerario->destino_duerme = $itinerarios_->destino_duerme;
                            $p_itinerario->observaciones = '';
                            $p_itinerario->estado = 1;
                            $p_itinerario->paquete_cotizaciones_id = $pqt->id;
                            $p_itinerario->save();
                            $dia++;
                            $dia_texto++;
                            foreach ($itinerarios_->destinos as $m_destinos) {
                                $p_destinos = new ItinerarioDestinos();
                                $p_destinos->codigo = $m_destinos->codigo;
                                $p_destinos->destino = $m_destinos->destino;
                                $p_destinos->region = $m_destinos->region;
                                $p_destinos->pais = $m_destinos->pais;
                                $p_destinos->descripcion = $m_destinos->descripcion;
                                $p_destinos->imagen = $m_destinos->imagen;
                                $p_destinos->estado = 1;
                                $p_destinos->itinerario_cotizaciones_id = $p_itinerario->id;
                                $p_destinos->save();
                            }
                            $st = 0;
                            foreach ($itinerarios_->serivicios as $servicios) {
                                $m_serv=M_Servicio::find($servicios->m_servicios_id);
                                $p_servicio = new ItinerarioServicios();
                                $p_servicio->nombre = $servicios->nombre;
                                $p_servicio->observacion = '';
                                if ($servicios->precio_grupo == 1) {
                                    $p_servicio->precio = $servicios->precio * 2;
                                } else {
                                    $p_servicio->precio = $servicios->precio;
                                }
                                $st += $p_servicio->precio;
                                $p_servicio->itinerario_cotizaciones_id = $p_itinerario->id;
                                $p_servicio->precio_grupo = $servicios->precio_grupo;
                                $p_servicio->min_personas = $servicios->min_personas;
                                $p_servicio->max_personas = $servicios->max_personas;
                                $p_servicio->salida = $servicios->salida;
                                $p_servicio->llegada = $servicios->llegada;
                                $p_servicio->precio_c = 0;
                                $p_servicio->user_id = auth()->guard('admin')->user()->id;
                                $p_servicio->m_servicios_id = $servicios->m_servicios_id;
                                $p_servicio->pos = $servicios->pos;

                                $p_servicio->grupo = $m_serv->grupo;
                                $p_servicio->localizacion = $m_serv->localizacion;
                                $p_servicio->tipoServicio = $m_serv->tipoServicio;
                                $p_servicio->clase = $m_serv->clase;
                                
                                $p_servicio->save();
                                if ($servicios->precio_grupo == 1 && $servicios->grupo == 'MOVILID') {
                                    if ($servicios->min_personas <= $totaltravelers && $totaltravelers <= $servicios->max_personas) {
                                    } else {
                                        $servicios_list = M_Servicio::where('grupo', $servicios->grupo)
                                            ->where('localizacion', $servicios->localizacion)
                                            ->where('tipoServicio', $servicios->tipoServicio)
                                            ->where('min_personas', '<=', $totaltravelers)
                                            ->where('max_personas', '>=', $totaltravelers)
                                            ->get();
                                        foreach ($servicios_list->take(1) as $servi) {
                                            $st -= $p_servicio->precio;
                                            $p_servicio1 = ItinerarioServicios::FindOrFail($p_servicio->id);
                                            $p_servicio1->nombre = $servi->nombre;
                                            $p_servicio1->observacion = '';
                                            $p_servicio1->precio = $servi->precio_venta;
                                            $st += $p_servicio1->precio;
                                            $p_servicio1->itinerario_cotizaciones_id = $p_itinerario->id;
                                            $p_servicio1->grupo = $servi->grupo;
                                            $p_servicio1->localizacion = $servi->localizacion;
                                            $p_servicio1->tipoServicio = $servi->tipoServicio;
                                            $p_servicio1->clase = $servi->clase;
                                            $p_servicio1->precio_grupo = $servi->precio_grupo;
                                            $p_servicio1->min_personas = $servi->min_personas;
                                            $p_servicio1->max_personas = $servi->max_personas;
                                            $p_servicio1->precio_c = 0;
                                            $p_servicio1->estado = 1;
                                            $p_servicio1->salida = $servi->salida;
                                            $p_servicio1->llegada = $servi->llegada;
                                            $p_servicio1->m_servicios_id = $servi->id;
                                            $p_servicio1->save();
                                        }
                                    }
                                }
                            }
                            $p_itinerario->precio = $st;
                            $p_itinerario->save();
                            $st_+=$st;
                        }
                        $pqt->utilidad =number_format(number_format($total,2, '.', '')-number_format($st_,2, '.', ''),2, '.', '');
                        $pqt->save();
                        //-- recorremos los dias para agregar los hoteles
                        $itinerario_cotizaciones = ItinerarioCotizaciones::where('paquete_cotizaciones_id', $pqt->id)->get();
                        $nroDias = count($itinerario_cotizaciones);
                        $pos = 1;
                        if ($ppaquete->duracion > 1) {
                            $paquetePrecio = P_PaquetePrecio::where('estrellas', $estrellas)->first();
//                        $paquetePrecio=PaquetePrecio::FindOrFail($pqt_precio);
                            foreach ($itinerario_cotizaciones as $iti_coti) {
                                if ($iti_coti->destino_duerme > 0) {
                                    $temp_dest = M_Destino::findOrFail($iti_coti->destino_duerme);
                                    if ($pos < $nroDias) {
                                        $hotelesxdestinoes = Hotel::where('estrellas', $estrellas)->where('localizacion', $temp_dest->destino)->get();
                                        foreach ($hotelesxdestinoes as $hotelxdestinos) {
                                            $preio_hotel = new PrecioHotelReserva();
                                            $preio_hotel->estrellas = $estrellas;
                                            $preio_hotel->precio_s = $hotelxdestinos->single;
                                            $preio_hotel->personas_s = $paquetePrecio->personas_s;
                                            $preio_hotel->precio_d = $hotelxdestinos->doble;
                                            $preio_hotel->personas_d = $paquetePrecio->personas_d;
                                            $preio_hotel->precio_m = $hotelxdestinos->matrimonial;
                                            $preio_hotel->personas_m = $paquetePrecio->personas_m;
                                            $preio_hotel->precio_t = $hotelxdestinos->triple;
                                            $preio_hotel->personas_t = $paquetePrecio->personas_t;
                                            $preio_hotel->utilidad = $paquetePrecio->utilidad;
                                            $preio_hotel->estado = $hotelxdestinos->estado;
                                            $preio_hotel->hotel_id = $hotelxdestinos->id;
                                            $preio_hotel->itinerario_cotizaciones_id = $iti_coti->id;
                                            $preio_hotel->utilidad_s = $paquetePrecio->utilidad_s;
                                            $preio_hotel->utilidad_d = $paquetePrecio->utilidad_d;
                                            $preio_hotel->utilidad_m = $paquetePrecio->utilidad_m;
                                            $preio_hotel->utilidad_t = $paquetePrecio->utilidad_t;
                                            $preio_hotel->utilidad_por_s = $paquetePrecio->utilidad_por_s;
                                            $preio_hotel->utilidad_por_d = $paquetePrecio->utilidad_por_d;
                                            $preio_hotel->utilidad_por_m = $paquetePrecio->utilidad_por_m;
                                            $preio_hotel->utilidad_por_t = $paquetePrecio->utilidad_por_t;
                                            $preio_hotel->localizacion = $hotelxdestinos->localizacion;
                                            $preio_hotel->save();
                                        }
                                        $pos++;
                                    }
                                }
                            }
                        }
                        $arr[] = ['totaltravelers' => $totaltravelers, 'codigo' => $codigo, 'estrellas' => $estrellas, 'transactiondatetime' => $transactiondatetime, 'originalBookingDate' => $originalBookingDate, 'titulo' => $titulo, 'idioma' => $idioma, 'nombres' => $nombres, 'telefono' => $telefono, 'email' => $email, 'total' => $total, 'cost' => $cost, 'profit' => $profit, 'fecha_llegada' => $fecha_llegada1[0], 'notas' => $notas];
                    }
                }
            }
        }
//        return $arr;
        session()->flash('msg', 'OK');
//        return redirect()->back();
        $anio=date("Y");
        $mes=date("m");
        $webs=Web::get();
        $page=$web;
        return view('admin.expedia.expedia-import-vista-previa-rpt',compact(['anio','mes','webs','page']));

//        return redirect()->route('current_quote_page_path','expedia.com');
    }
    public function buscar_day_by_day(Request $request)
    {
        set_time_limit ( 0 );
        $destino=$request->input('detino');
        $valor=$request->input('detino');

        
    }
    
}
