<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Cotizacion;
use App\CotizacionesCliente;
use App\CotizacionesPagos;
use App\Hotel;
use App\ItinerarioCotizaciones;
use App\ItinerarioServicios;
use App\M_Destino;
use App\M_Itinerario;
use App\M_ItinerarioDestino;
use App\M_Servicio;
use App\P_Paquete;
use App\PaqueteCotizaciones;
use Illuminate\Http\Request;
//use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Expr\Array_;

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
        $destinos=M_Destino::get();
        $itinerarios=M_Itinerario::get();
        $m_servicios=M_Servicio::get();
//        dd($servicios);
        return view('admin.quotes-new',['destinos'=>$destinos,'itinerarios'=>$itinerarios,'m_servicios'=>$m_servicios]);
    }
    public function nuevo1()
    {
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
        $nro_codigo=Cotizacion::where('web',$web)->count()+1;
        $codigo='G'.$nro_codigo;
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
            'idioma_pasajeros'=>$idioma_pasajeros
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
        $precodigo=array(
            "gotoperu.com"=>"G",
            "gotoperu.com.pe"=>"GP",
            "andesviagens.com"=>"AV",
            "machupicchu-galapagos.com"=>"MP",
            "gotolatinamerica.com"=>"GL",
            "expedia.com"=>"E",

        );
        $web=$request->input('web');
        $nro_codigo=Cotizacion::where('web',$web)->count()+1;
        $codigo=$precodigo[$web].$nro_codigo;
        return $codigo;
    }
    public function cambiar_fecha(Request $request)
    {
        $iti_id=$request->input('iti_id');
        $fecha=$request->input('fecha');
        $iti=ItinerarioCotizaciones::FindOrFail($iti_id);
        $iti->fecha=$fecha;
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
            $cotizacion=Cotizacion::where('users_id',auth()->guard('admin')->user()->id)->where('web', $page)->whereYear('fecha_venta',$anio)->whereMonth('fecha_venta',$mes)->where('posibilidad','100')->get();
        else
        $cotizacion=Cotizacion::where('web', $page)->whereYear('fecha_venta',$anio)->whereMonth('fecha_venta',$mes)->where('posibilidad','100')->get();


        session()->put('menu-lateral', 'quotes/current');
        return view('admin.quotes-sales-page-mes',['cotizacion'=>$cotizacion, 'page'=>$page,'mes'=>$mes,'anio'=>$anio,'user_name'=>$user_name,'user_tipo'=>$user_tipo]);

    }
    public function expedia()
    {

        return view('admin.expedia.expedia-import');
    }
    public function import(Request $request)
    {
        set_time_limit ( 0 );
        $request->validate([
            'import_file' => 'required'
        ]);
        $path = $request->file('import_file')->getRealPath();
//        dd($path);
        $data = Excel::load($path,function($reader){})->get();
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
            $cost=0;
            $profit=0;
            $fecha_llegada='';
            foreach ($data as $key => $value) {
                $totaltravelers=$value->totaltravelers;
                $codigo=$value->code;
                $transactiondatetime=$value->transactiondatetime;
                $originalBookingDate=$value->originalbookingdate;
                $titulo=$value->activitytitle.'['.$value->offertitle.']';
                $nombres=$value->leadtraveler;
                $telefono=$value->travelerphone;
                $email=$value->traveleremail;
                $total=round($value->netamount,2);
                $cost=round($value->netcost,2);
                $profit=round($value->profit,2);
                $fecha_llegada=$value->destinationarrivaldate;
                $notas='Tickettype:'.$value->tickettype.'<br>'.
                    'DestinationDepartureFlightDate:'.$value->destinationdepartureflightdate.'<br>'.
                    'PickupLocation:'.$value->pickuplocation.'<br>'.
                    'DropoffLocation:'.$value->dropofflocation.'<br>'.
                    'DestinationArrivalFlightNumber:'.$value->destinationarrivalflightnumber.'<br>'.
                    'DestinationArrivalFlightTime:'.$value->destinationarrivalflighttime.'<br>'.
                    'DestinationDepartureFlightNumber:'.$value->destinationdepartureflightnumber.'<br>'.
                    'DestinationDepartureFlightTime:'.$value->destinationdepartureflighttime.'<br>'.
                    'Journey:'.$value->journey;

                if(
                    trim($totaltravelers)!=''&&
                    trim($codigo)!=''&&
                    trim($transactiondatetime)!=''&&
                    trim($originalBookingDate)!=''&&
                    trim($titulo)!=''&&
                    trim($nombres)!=''&&
                    trim($telefono)!=''&&
                    trim($email)!=''&&
                    trim($total)!=''&&
                    trim($cost)!=''&&
                    trim($profit)!=''&&
                    trim($fecha_llegada)!=''){

                    $coti=new Cotizacion();
                    $coti->save();
                    for($i=1;$i<=$totaltravelers;$i++){
                        $cli_temp=new Cliente();
                        $cli_temp->nombres=$nombres;
                        $cli_temp->telefono=$telefono;
                        $cli_temp->email=$email;
                        $cli_temp->estado=1;
                        $cli_temp->save();

                        $coti_cliente=new CotizacionesCliente();
                        $coti_cliente->cotizaciones_id=$coti->id;
                        $coti_cliente->clientes_id=$cli_temp->id;
                        if($i==1) {
                            $coti_cliente->estado = 1;
                        }
                        else{
                            $coti_cliente->estado = 0;
                        }
                        $coti_cliente->save();
                    }
                    $coti->codigo='';
                    $coti->nropersonas=$totaltravelers;
                    $coti->duracion='';
                    $coti->precioventa='';
                    $coti->fecha=$fecha_llegada;
                    $coti->posibilidad=100;
                    $coti->estado=1;
                    $coti->fecha_venta=$transactiondatetime;
                    $coti->users_id==auth()->guard('admin')->user()->id;
                    
                    $coti->precioventa=$transactiondatetime;
                    $coti->fecha_venta=$transactiondatetime;
                    $coti->fecha_venta=$transactiondatetime;
                    $coti->fecha_venta=$transactiondatetime;
                    $coti->fecha_venta=$transactiondatetime;
                    $coti->fecha_venta=$transactiondatetime;
                    $coti->fecha_venta=$transactiondatetime;

                    $arr[] = ['$codigo'=>$codigo,'$transactiondatetime' => $transactiondatetime,'$originalBookingDate' => $originalBookingDate,'$titulo' => $titulo, '$nombres' => $nombres, '$telefono' => $telefono, '$email' => $email, '$total' => $total, '$cost' => $cost, '$profit' => $profit, '$fecha_llegada' => $fecha_llegada, '$notas' => $notas];
                }
            }
        }
        return $arr;
    }
}
