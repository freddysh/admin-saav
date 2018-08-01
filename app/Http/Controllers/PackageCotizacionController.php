<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Cotizacion;
use App\CotizacionesCliente;
use App\Hotel;
use App\HotelProveedor;
use App\ItinerarioCotizaciones;
use App\ItinerarioDestinos;
use App\ItinerarioServicios;
use App\M_Category;
use App\M_Destino;
use App\M_Itinerario;
use App\M_Servicio;
use App\P_Itinerario;
use App\P_ItinerarioDestino;
use App\P_ItinerarioServicios;
use App\P_Paquete;
use App\P_PaquetePrecio;
use App\PaqueteCotizaciones;
use App\PaquetePrecio;
use App\PrecioHotelReserva;

use Illuminate\Http\Request;
use Mockery\Exception;
use PhpParser\Node\Expr\Array_;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Response;
use App\Http\Requests;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use App\M_ItinerarioDestino;

class PackageCotizacionController extends Controller
{
    //
    public function store(Request $request)
    {
        //-- Datos del cliente
        $cliente=new Cliente();
        $cliente->nombres=strtoupper($request->input('txt_name'));
        $cliente->email=$request->input('txt_email');
        $cliente->nacionalidad=$request->input('txt_country');
        $cliente->telefono=$request->input('txt_phone');
        $cliente->save();

        //-- Datos de la cotizacion
        $date = date_create($request->input('txt_travel_date'));
        $fecha=date_format($date, 'jS F Y');
        $cotizacion=new Cotizacion();
        $cotizacion->nombre=strtoupper($request->input('txt_name')).' x'.$request->input('txt_travellers').' '.$fecha;
//        dd($cotizacion->nombre);
        $cotizacion->nropersonas=$request->input('txt_travellers');
        $cotizacion->duracion=$request->input('txt_days');
        $cotizacion->fecha=$request->input('txt_travel_date');
        $cotizacion->star_2=$request->input('strellas_2');
        $cotizacion->star_3=$request->input('strellas_3');
        $cotizacion->star_4=$request->input('strellas_4');
        $cotizacion->star_5=$request->input('strellas_5');
        $cotizacion->estado=0;
//        $cotizacion->users_id=auth()->guard('admin')->user()->id;
        $cotizacion->users_id=1;
        $cotizacion->save();
        $cotizacionGet=Cotizacion::where('id',$cotizacion->id)->get();
//        dd($cotizacionGet);
        $cotizacion_cliente=new CotizacionesCliente();
        $cotizacion_cliente->cotizaciones_id=$cotizacion->id;
        $cotizacion_cliente->clientes_id=$cliente->id;
        $cotizacion_cliente->estado=1;
        $cotizacion_cliente->save();
        $destinos=$request->input('destinos');
        $acomodacion_s=0;
        if($request->input('acomodacion_s'))
            $acomodacion_s=$request->input('acomodacion_s');

        $acomodacion_d=0;
        if($request->input('acomodacion_d'))
            $acomodacion_d=$request->input('acomodacion_d');

        $acomodacion_m=0;
        if($request->input('acomodacion_m'))
            $acomodacion_m=$request->input('acomodacion_m');

        $acomodacion_t=0;
        if($request->input('acomodacion_t'))
            $acomodacion_t=$request->input('acomodacion_t');

//        dd($destinos);

        $p_paquete=P_Paquete::where('duracion',$request->input('txt_days'))->get();
//        dd($p_paquete);

        return view('admin.quotes-planes',['cliente'=>$cliente,'cotizacion'=>$cotizacionGet,'destinos'=>$destinos,'acomodacion_s'=>$acomodacion_s,'acomodacion_d'=>$acomodacion_d,'acomodacion_m'=>$acomodacion_m,'acomodacion_t'=>$acomodacion_t,'p_paquete'=>$p_paquete]);
    }
    public function options($cotizacion_id,$destinos1,$acomodacion)
    {
//      dd($cotizacion_id);
        $destinos1=explode('$',$destinos1);
//      dd($destinos);
        $cotizacion=Cotizacion::with('cotizaciones_cliente')->where('id',$cotizacion_id)->get();
//      dd($cotizacion);
        $destinos=M_Destino::get();
        $itinerarios=M_Itinerario::get();
        $m_servicios=M_Servicio::get();
//      dd($servicios);
        $hotel=Hotel::get();
        return view('admin.quotes-package',['destinos'=>$destinos,'itinerarios'=>$itinerarios,'m_servicios'=>$m_servicios,'destinos1'=>$destinos1,'cotizacion'=>$cotizacion,'acomodacion_'=>$acomodacion,'hotel'=>$hotel]);
    }

    public function store_package(Request $request)
    {
        $cotizacion_id=$request->input('cotizacion_id');
        $txt_day=strtoupper(($request->input('txt_day')));
        $txt_code=strtoupper(($request->input('txt_codigo')));
        $txt_title=strtoupper(($request->input('txt_title')));
        $txta_description=$request->input('txta_description');
        $txta_include=$request->input('txta_include');
        $txta_notinclude=$request->input('txta_notinclude');
        $totalItinerario=$request->input('totalItinerario');
        $itinerarios_=$request->input('itinerarios_');
        $txt_sugerencia=$request->input('txt_sugerencia');
        $nro_personas=$request->input('nro_personitas');
        $cliente_id=$request->input('cliente_id');
        $hotel_id_2=$request->input('hotel_id_2');
        $hotel_id_3=$request->input('hotel_id_3');
        $hotel_id_4=$request->input('hotel_id_4');
        $hotel_id_5=$request->input('hotel_id_5');

//        dd($itinerarios_);

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
        $acomodacion=$request->input('acomodacion');
        $acomodacion=explode('_',$acomodacion);
        $acomodacion_s=0;
        $acomodacion_d=0;
        $acomodacion_m=0;
        $acomodacion_t=0;

        if($acomodacion[0]==1)
            $acomodacion_s=1;
        if($acomodacion[1]==2)
            $acomodacion_d=1;
        if($acomodacion[2]==3)
            $acomodacion_t=1;
        if($acomodacion[3]==2)
            $acomodacion_m=1;


        $paquete=new PaqueteCotizaciones();
        $paquete->codigo=$txt_code;
        $paquete->titulo=$txt_title;
        $paquete->duracion=$txt_day;
        $paquete->descripcion=$txta_description;
        $paquete->incluye=$txta_include;
        $paquete->noincluye=$txta_notinclude;
        $paquete->utilidad=40;
        $paquete->estado=0;
        $paquete->preciocosto=$totalItinerario;
        $paquete->cotizaciones_id=$cotizacion_id;
        $paquete->save();

        $paquete_precio2=new PaquetePrecio();
        $paquete_precio2->estrellas=2;
        $paquete_precio2->precio_s=$amount_s2;
        $paquete_precio2->personas_s=$acomodacion_s;
        $paquete_precio2->precio_m=$amount_d2;
        $paquete_precio2->personas_m=$acomodacion_m;
        $paquete_precio2->precio_d=$amount_d2;
        $paquete_precio2->personas_d=$acomodacion_d;
        $paquete_precio2->precio_t=$amount_t2;
        $paquete_precio2->personas_t=$acomodacion_t;
        if($strellas_2==2)
            $paquete_precio2->estado=1;
        else
            $paquete_precio2->estado=0;
        $paquete_precio2->utilidad=$profit_2;
        $paquete_precio2->paquete_cotizaciones_id=$paquete->id;
        $paquete_precio2->hotel_id=$hotel_id_2;
        $paquete_precio2->save();

        $paquete_precio3=new PaquetePrecio();
        $paquete_precio3->estrellas=3;
        $paquete_precio3->precio_s=$amount_s3;
        $paquete_precio3->personas_s=$acomodacion_s;
        $paquete_precio3->precio_m=$amount_d3;
        $paquete_precio3->personas_m=$acomodacion_m;
        $paquete_precio3->precio_d=$amount_d3;
        $paquete_precio3->personas_d=$acomodacion_d;
        $paquete_precio3->precio_t=$amount_t3;
        $paquete_precio3->personas_t=$acomodacion_t;
        if($strellas_3==3)
            $paquete_precio3->estado=1;
        else
            $paquete_precio3->estado=0;
        $paquete_precio3->utilidad=$profit_3;
        $paquete_precio3->paquete_cotizaciones_id=$paquete->id;
        $paquete_precio3->hotel_id=$hotel_id_3;
        $paquete_precio3->save();

        $paquete_precio4=new PaquetePrecio();
        $paquete_precio4->estrellas=4;
        $paquete_precio4->precio_s=$amount_s4;
        $paquete_precio4->personas_s=$acomodacion_s;
        $paquete_precio4->precio_m=$amount_d4;
        $paquete_precio4->personas_m=$acomodacion_m;
        $paquete_precio4->precio_d=$amount_d4;
        $paquete_precio4->personas_d=$acomodacion_d;
        $paquete_precio4->precio_t=$amount_t4;
        $paquete_precio4->personas_t=$acomodacion_t;
        if($strellas_4==4)
            $paquete_precio4->estado=1;
        else
            $paquete_precio4->estado=0;
        $paquete_precio4->utilidad=$profit_4;
        $paquete_precio4->paquete_cotizaciones_id=$paquete->id;
        $paquete_precio4->hotel_id=$hotel_id_4;
        $paquete_precio4->save();

        $paquete_precio5=new PaquetePrecio();
        $paquete_precio5->estrellas=5;
        $paquete_precio5->precio_s=$amount_s5;
        $paquete_precio5->personas_s=$acomodacion_s;
        $paquete_precio5->precio_m=$amount_d5;
        $paquete_precio5->personas_m=$acomodacion_m;
        $paquete_precio5->precio_d=$amount_d5;
        $paquete_precio5->personas_d=$acomodacion_d;
        $paquete_precio5->precio_t=$amount_t5;
        $paquete_precio5->personas_t=$acomodacion_t;
        if($strellas_5==5)
            $paquete_precio5->estado=1;
        else
            $paquete_precio5->estado=0;
        $paquete_precio5->utilidad=$profit_5;
        $paquete_precio5->paquete_cotizaciones_id=$paquete->id;
        $paquete_precio5->hotel_id=$hotel_id_5;
        $paquete_precio5->save();
        $dia=0;
        $dia_texto=1;
        $coti=Cotizacion::FindOrFail($cotizacion_id);
        $fecha_viaje=date($coti->fecha);
        foreach ($itinerarios_ as $itinerario_id){
//            dd('holaaaaaaa');
            $m_itineario=M_Itinerario::FindOrFail($itinerario_id);
            $p_itinerario=new ItinerarioCotizaciones();
            $p_itinerario->titulo=$m_itineario->titulo;
            $p_itinerario->descripcion=$m_itineario->descripcion;
            $p_itinerario->dias=$dia_texto;
            $mod_date = strtotime($fecha_viaje."+ ".($dia_texto-1)." days");
            $p_itinerario->fecha=date("Y-m-d",$mod_date) ;
            $p_itinerario->precio=$m_itineario->precio;
            $p_itinerario->imagen=$m_itineario->imagen;
            $p_itinerario->observaciones=$txt_sugerencia[$dia];
            $p_itinerario->estado=1;
            $p_itinerario->paquete_cotizaciones_id=$paquete->id;
            $p_itinerario->save();
            $dia++;
            $dia_texto++;
            foreach ($m_itineario->destinos as $m_destinos){
                $p_destinos=new ItinerarioDestinos();
                $p_destinos->codigo=$m_destinos->codigo;
                $p_destinos->destino=$m_destinos->destino;
                $p_destinos->region=$m_destinos->region;
                $p_destinos->pais=$m_destinos->pais;
                $p_destinos->descripcion=$m_destinos->descripcion;
                $p_destinos->imagen=$m_destinos->imagen;
                $p_destinos->estado=1;
                $p_destinos->itinerario_cotizaciones_id=$p_itinerario->id;
                $p_destinos->save();
            }
            $st=0;
            foreach($m_itineario->itinerario_itinerario_servicios as $servicios){
                $p_servicio=new ItinerarioServicios();
                $p_servicio->nombre=$servicios->itinerario_servicios_servicio->nombre;
                $p_servicio->observacion='';
//                if($servicios->itinerario_servicios_servicio->precio_grupo==1)
//                    $p_servicio->precio=round($servicios->itinerario_servicios_servicio->precio_venta/$nro_personas);
//                else
                    $p_servicio->precio=$servicios->itinerario_servicios_servicio->precio_venta;
                $st+=$p_servicio->precio;
                $p_servicio->itinerario_cotizaciones_id=$p_itinerario->id;
//                $p_servicio->user_id=auth()->guard('admin')->user()->id;
                $p_servicio->precio_grupo=$servicios->itinerario_servicios_servicio->precio_grupo;
                $p_servicio->precio_c=0;
                $p_servicio->user_id=1;
                $p_servicio->estado=1;
                $p_servicio->m_servicios_id=$servicios->m_servicios_id;
                $p_servicio->save();
            }
            $p_itinerario->precio=$st;
            $p_itinerario->save();

        }

        $cliente=Cliente::FindOrFail($cliente_id);
        $destinos=$request->input('destinos');
        $cotizacion=Cotizacion::where('id',$cotizacion_id)->get();

        $p_paquete=P_Paquete::where('duracion',$request->input('txt_day'))->get();
//        dd($p_paquete);
        return view('admin.quotes-planes',['cliente'=>$cliente,'cotizacion'=>$cotizacion,'destinos'=>$destinos,'acomodacion_s'=>$acomodacion_s,'acomodacion_d'=>$acomodacion_d,'acomodacion_m'=>$acomodacion_m,'acomodacion_t'=>$acomodacion_t,'p_paquete'=>$p_paquete]);

//        $destinos=M_Destino::get();
//        $itinerarios=M_Itinerario::get();
//        $m_servicios=M_Servicio::get();
//        return view('admin.quotes-package',['destinos'=>$destinos,'itinerarios'=>$itinerarios,'m_servicios'=>$m_servicios,'destinos1'=>$destinos1,'cotizacion'=>$cotizacion]);

    }
    public function save_cotizacion(Request $request)
    {
        $cotizacion_id=$request->input('cotizacion_id');
        $cotizacion=Cotizacion::with('paquete_cotizaciones')->where('id',$cotizacion_id)->get();
        $cotizacion_=null;
        foreach ($cotizacion as $cotizacion1){
            $cotizacion_=$cotizacion1;
        }
        if(count($cotizacion_->paquete_cotizaciones)>0){
                $cotizacion2=Cotizacion::FindOrFail($cotizacion_id);
                $cotizacion2->estado=1;
                $cotizacion2->save();
                foreach ($cotizacion_->paquete_cotizaciones as $paquete){
                    $paquete_=PaqueteCotizaciones::FindOrFail($paquete->id);
                    $paquete_->estado=1;
                    $paquete_->save();
                }
                $destinos=M_Destino::get();
                $itinerarios=M_Itinerario::get();
                $m_servicios=M_Servicio::get();
                return view('admin.quotes-new',['destinos'=>$destinos,'itinerarios'=>$itinerarios,'m_servicios'=>$m_servicios]);
        }
        else{
            $cliente_id=$request->input('cliente_id');
            $cliente=Cliente::FindOrFail($cliente_id);
            $destinos=$request->input('destinos');
            $cotizacion=Cotizacion::where('id',$cotizacion_id)->get();
            return view('admin.quotes-planes',['cliente'=>$cliente,'cotizacion'=>$cotizacion,'destinos'=>$destinos]);

        }

    }
    public function current_cotizacion()
    {
        $cotizacion=Cotizacion::get();
        return view('admin.quotes-current',['cotizacion'=>$cotizacion]);
    }

    public function current_cotizacion_page($page)
    {
        $cotizacion=Cotizacion::where('web', $page)->get();
        session()->put('menu-lateral', 'quotes/current');
        return view('admin.quotes-current-page',['cotizacion'=>$cotizacion, 'page'=>$page]);
    }
    
    public function autocomplete()
    {
        $term = Input::get('term');
        $results = null;
        $results = [];
        $proveedor = Cotizacion::where('nombre', 'like', '%' . $term . '%')->get();
        foreach ($proveedor as $query) {
            $results[] = ['id' => $query->id, 'value' => $query->nombre];
        }
        return response()->json($results);
    }
    public function show_cotizacion( Request $request)
    {
        $txt_name=$request->input('txt_name');
        $cotizacion=Cotizacion::where('nombre',$txt_name)->get();
        return view('admin.quotes-current',['cotizacion'=>$cotizacion]);
    }
    public function show_cotizacion_id($cotizacion_id)
    {
        $cotizacion=Cotizacion::where('id',$cotizacion_id)->get();
        return view('admin.quotes-current-details',['cotizacion'=>$cotizacion]);
    }

    public function show_paxs()
    {
        $destinos=M_Destino::get();
        return view('admin.database.destination1',['destinos'=>$destinos]);
    }
    public function activar_package( Request $request)
    {
        $package_id=$request->input('paquete_id');
        $cotizacion_id=$request->input('cotizacion_id');
        $cotizacion1=Cotizacion::FindOrFail($cotizacion_id);
        $cotizacion1->estado=2;
        $cotizacion1->save();
        $patCotizaciones=PaqueteCotizaciones::FindOrFail($package_id);
        $patCotizaciones->estado=2;
        $patCotizaciones->save();
//        $txt_name=$request->input('coti_nombre');

//        $cotizacion=Cotizacion::where('nombre',$txt_name)->get();
//        return view('admin.quotes-current',['cotizacion'=>$cotizacion]);
        return 1;
    }
    public function pdf($id)
    {
        $paquetes = PaqueteCotizaciones::with('paquete_precios')->get()->where('id', $id);
        foreach ($paquetes as $paquetes2){
            $paquete = PaqueteCotizaciones::with('paquete_precios')->get()->where('id', $id);
            $cotizacion = Cotizacion::where('id',$paquetes2->cotizaciones_id)->get();
            $cotizacion1='';
            foreach ($cotizacion as $cotizacion_){
                $cotizacion1=$cotizacion_;
            }
            $ee=CotizacionesCliente::with('cliente')->get();
//            dd($ee);
            $pdf = \PDF::loadView('admin.pdf-proposal', ['paquete'=>$paquete, 'cotizacion'=>$cotizacion])->setPaper('a4')->setWarnings(true);
            return $pdf->download($cotizacion1->nombre.'.pdf');
//            \File::delete('pdf/proposals_'.$id.'.pdf');
        }
    }
    public function getItineraryImageName($filename){
        $file = Storage::disk('itinerary')->get($filename);
        return new Response($file, 200);
    }
    public function probabilidad(Request $request)
    {
        try {
        $cotizacion_id=$request->input('txt_cotizacion');
        $proba=$request->input('txt_porcentaje');
        $coti1=Cotizacion::FindOrFail($cotizacion_id);
        $coti1->posibilidad=$proba;
        $coti1->save();
//        $cotizacion=Cotizacion::get();
//        return view('admin.quotes-current',['cotizacion'=>$cotizacion]);
        return 'Thank you.';
        }
        catch (Exception $e){
            return $e;
        }

    }
    public function plan($id){
        $paquetes = PaqueteCotizaciones::with('paquete_precios')->get()->where('id', $id);
        foreach ($paquetes as $paquetes2){
            $paquete = PaqueteCotizaciones::with('paquete_precios')->get()->where('id', $id);
            $cotizacion = Cotizacion::where('id',$paquetes2->cotizaciones_id)->get();
            $cotizacion1='';
            foreach ($cotizacion as $cotizacion_){
                $cotizacion1=$cotizacion_;
            }
            return view('admin.plan-details', ['paquete'=>$paquete, 'cotizacion'=>$cotizacion]);
        }
    }
    public function plan_excel($id){
        $paquetes = PaqueteCotizaciones::with('paquete_precios')->get()->where('id', $id);
        foreach ($paquetes as $paquetes2){
            $paquete = PaqueteCotizaciones::with('paquete_precios')->get()->where('id', $id);
            $cotizacion = Cotizacion::where('id',$paquetes2->cotizaciones_id)->get();
            $cotizacion1='';
            foreach ($cotizacion as $cotizacion_){
                $cotizacion1=$cotizacion_;
            }
        $m_servicios=M_Servicio::get();
        return view('admin.plan-details-excel',['cotizaciones'=>$cotizacion,'m_servicios'=>$m_servicios,'paquete_precio_id'=>$id]);
        }
    }
    public function escojer_precio_paquete(Request $request){
        $pos=$request->input('pos');
        $s=$request->input('s_'.$pos);
        $d=$request->input('d_'.$pos);
        $m=$request->input('m_'.$pos);
        $t=$request->input('t_'.$pos);

        $precio_paquete_id=$request->input('precio_paquete_id_'.$pos);
//        dd($precio_paquete_id);
        $paquetePrecio=PaquetePrecio::FindOrFail($precio_paquete_id);
        $paquetesPrecio=PaquetePrecio::where('paquete_cotizaciones_id',$paquetePrecio->paquete_cotizaciones_id)->get();
        foreach ($paquetesPrecio as $paquetePrecio_){
            $paquetePrecio_temp=PaquetePrecio::FindOrFail($paquetePrecio_->id);
            $paquetePrecio_temp->estado=1;
            $paquetePrecio_temp->save();
        }
        $paquetePrecio->personas_s=$s;
        $paquetePrecio->personas_d=$d;
        $paquetePrecio->personas_m=$m;
        $paquetePrecio->personas_t=$t;
        $paquetePrecio->estado=2;
        $paquetePrecio->save();
//        dd($paquetePrecio->id);
        //-- recorremos los dias para agregar los hoteles
//        $itinerario_cotizaciones=ItinerarioCotizaciones::where('paquete_cotizaciones_id',$paquetePrecio->paquete_cotizaciones_id)->get();
//        $nroDias=count($itinerario_cotizaciones);
////        dd($nroDias);
//        $pos=1;
//        foreach ($itinerario_cotizaciones as $itinerario_cotizacion) {
//            if ($pos < $nroDias){
//                $preio_hotel = new PrecioHotelReserva();
//                $preio_hotel->estrellas = $paquetePrecio->estrellas;
//                $preio_hotel->precio_s = $paquetePrecio->precio_s;
//                $preio_hotel->personas_s = $paquetePrecio->personas_s;
//                $preio_hotel->precio_d = $paquetePrecio->precio_d;
//                $preio_hotel->personas_d = $paquetePrecio->personas_d;
//                $preio_hotel->precio_m = $paquetePrecio->precio_m;
//                $preio_hotel->personas_m = $paquetePrecio->personas_m;
//                $preio_hotel->precio_t = $paquetePrecio->precio_t;
//                $preio_hotel->personas_t = $paquetePrecio->personas_t;
//                $preio_hotel->utilidad = $paquetePrecio->utilidad;
//                $preio_hotel->estado = $paquetePrecio->estado;
//                $preio_hotel->hotel_id = $paquetePrecio->hotel_id;
//                $preio_hotel->itinerario_cotizaciones_id = $itinerario_cotizacion->id;
//                $preio_hotel->save();
//                $pos++;
//            }
//        }

        $paquete=PaqueteCotizaciones::where('id',$paquetePrecio->paquete_cotizaciones_id)->get();
        foreach ($paquete as $paquete_){
            $paquete1=PaqueteCotizaciones::FindOrFail($paquete_->id);
            $paquete1->estado=2;
            $paquete1->save();

            $cotizaciones=Cotizacion::FindOrFail($paquete1->cotizaciones_id);
            $cotizaciones->estado=2;
            $cotizaciones->categorizado='N';
            $cotizaciones->fecha_venta=date("Y-m-d");
            $cotizaciones->save();
            $cotizacion=Cotizacion::where('id',$cotizaciones->id)->get();
        return redirect()->route('cotizacion_id_show_path',[$cotizaciones->id]);
        }

    }
    public function cargar_paquete_enlatados(Request $request){
        $p_paquete_ids=$request->input('paquetes');
        $p_cotizacion_id=$request->input('p_cotizacion_id');
        $cotizaion=Cotizacion::FindOrFail($p_cotizacion_id);
        $datos=$request->input('datos');

        $datos=explode('_',$datos);
        $acomodacion_s=$datos[1];
        $acomodacion_d=$datos[2];
        $acomodacion_t=$datos[3];
        $acomodacion_m=$datos[4];
        $destinos=explode('$',$datos[0]);

        $estrella[2]=0;
        $estrella[3]=0;
        $estrella[4]=0;
        $estrella[5]=0;

        $estrella[2]=$cotizaion->star_2;
        $estrella[3]=$cotizaion->star_3;
        $estrella[4]=$cotizaion->star_4;
        $estrella[5]=$cotizaion->star_5;

        foreach ($p_paquete_ids as $p_paquete_id){
            $p_paquete=P_Paquete::where('id',$p_paquete_id)->get();
            foreach ($p_paquete as $p_paquete_){
                //-- creamos el nuevo paquete para la cotizacion
                $new_paquete=new PaqueteCotizaciones();
                $new_paquete->codigo=$p_paquete_->codigo;
                $new_paquete->titulo=$p_paquete_->titulo;
                $new_paquete->duracion=$p_paquete_->duracion;
                $new_paquete->preciocosto=$p_paquete_->preciocosto;
                $new_paquete->utilidad=$p_paquete_->utilidad;
                $new_paquete->precioventa=$p_paquete_->precioventa;
                $new_paquete->descripcion=$p_paquete_->descripcion;
                $new_paquete->incluye=$p_paquete_->incluye;
                $new_paquete->noincluye=$p_paquete_->noincluye;
                $new_paquete->opcional=$p_paquete_->opcional;
                $new_paquete->imagen=$p_paquete_->imagen;
                $new_paquete->posibilidad=$p_paquete_->posibilidad;
                $new_paquete->estado=1;
                $new_paquete->cotizaciones_id=$p_cotizacion_id;
                $new_paquete->save();
                $coti=Cotizacion::FindOrFail($p_cotizacion_id);
                $fecha_viaje=date($coti->fecha);
//                dd($new_paquete);
                foreach ($p_paquete_->itinerarios as $p_itinerario){
//                    dd($p_itinerario);
//                    dd($new_paquete->id);
                    $new_itinerario=new ItinerarioCotizaciones();
                    $new_itinerario->titulo=$p_itinerario->titulo;
                    $new_itinerario->descripcion=$p_itinerario->descripcion;
                    $new_itinerario->dias=$p_itinerario->dias;
                    $mod_date = strtotime($fecha_viaje."+ ".($p_itinerario->dias-1)." days");
                    $p_itinerario->fecha=date("Y-m-d",$mod_date) ;
                    $new_itinerario->precio=$p_itinerario->precio;
                    $new_itinerario->imagen=$p_itinerario->imagen;
                    $new_itinerario->estado=1;
                    $new_itinerario->paquete_cotizaciones_id=$new_paquete->id;
                    $new_itinerario->save();
                    foreach ($p_itinerario->destinos as $p_destino){
                        $new_destino=new ItinerarioDestinos();
                        $new_destino->codigo=$p_destino->codigo;
                        $new_destino->destino=$p_destino->destino;
                        $new_destino->region=$p_destino->region;
                        $new_destino->departamento=$p_destino->departamento;
                        $new_destino->pais=$p_destino->pais;
                        $new_destino->descripcion=$p_destino->descripcion;
                        $new_destino->imagen=$p_destino->imagen;
                        $new_destino->estado=1;
                        $new_destino->itinerario_cotizaciones_id=$new_itinerario->id;
                        $new_destino->save();
                    }
                    foreach ($p_itinerario->serivicios as $serivicio){
                        $new_servicio=new ItinerarioServicios();
                        $new_servicio->nombre=$serivicio->nombre;
                        $new_servicio->observacion=$serivicio->observacion;
                        if($serivicio->precio_grupo==1) {
                            $new_servicio->min_personas=$serivicio->min_personas;
                            $new_servicio->max_personas=$serivicio->max_personas;
//                            $new_servicio->precio = round($serivicio->precio / $cotizaion->nropersonas,2);
                            $new_servicio->precio = $serivicio->precio;
                            if($serivicio->min_personas<=$cotizaion->nropersonas && $cotizaion->nropersonas<=$serivicio->max_personas){
                                $new_servicio->estado_error=0;
                            }
                            else{
                                $new_servicio->mensaje_error='Borre este servicio, agrege uno de acuerdo a la cantidad('.$cotizaion->nropersonas.') de pasajero';
                                $new_servicio->estado_error=1;
                            }
                        }else{
                            $new_servicio->estado_error=0;
                            $new_servicio->precio = $serivicio->precio;
                        }
                        $new_servicio->itinerario_cotizaciones_id=$new_itinerario->id;
                        $new_servicio->precio_c=0;
//                        $new_servicio->user_id=auth()->guard('admin')->user()->id;
                        $new_servicio->precio_grupo=$serivicio->precio_grupo;
                        $new_servicio->user_id=1;
                        $new_servicio->m_servicios_id=$serivicio->m_servicios_id;
                        $new_servicio->save();
                    }
                }
                foreach ($p_paquete_->precios as $precios){
                    $new_paquete_precio=new PaquetePrecio();
                    $new_paquete_precio->estrellas=$precios->estrellas;
                    $new_paquete_precio->precio_s=$precios->precio_s;
                    $new_paquete_precio->personas_s=$acomodacion_s;
                    $new_paquete_precio->precio_d=$precios->precio_d;
                    $new_paquete_precio->personas_d=$acomodacion_d;
                    $new_paquete_precio->precio_m=$precios->precio_m;
                    $new_paquete_precio->personas_m=$acomodacion_m;
                    $new_paquete_precio->precio_t=$precios->precio_t;
                    $new_paquete_precio->personas_t=$acomodacion_t;
                    $new_paquete_precio->utilidad=$precios->utilidad;
                    $new_paquete_precio->paquete_cotizaciones_id=$new_paquete->id;
                    $new_paquete_precio->hotel_id=$precios->hotel_id;
                    if($estrella[$precios->estrellas]==$precios->estrellas)
                        if($precios->estado==1)
                            $new_paquete_precio->estado=1;
                        else
                            $new_paquete_precio->estado=0;
                    else
                        $new_paquete_precio->estado=0;

                    $new_paquete_precio->save();
                }
            }
        }
        $request->input('paquetes');
        $cliente_id=$request->input('cliente_id_');
        $cliente=Cliente::FindOrFail($cliente_id);
        $cotizacion=Cotizacion::where('id',$p_cotizacion_id)->get();
        $p_paquete=P_Paquete::where('duracion',$request->input('txt_day_'))->get();
        return view('admin.quotes-planes',['cliente'=>$cliente,'cotizacion'=>$cotizacion,'destinos'=>$destinos,'acomodacion_s'=>$acomodacion_s,'acomodacion_d'=>$acomodacion_d,'acomodacion_m'=>$acomodacion_m,'acomodacion_t'=>$acomodacion_t,'p_paquete'=>$p_paquete]);
    }
    public function plan_newpackage($id){
        $paquetes = PaqueteCotizaciones::with('paquete_precios')->get()->where('id', $id);
        foreach ($paquetes as $paquetes2){
            $paquete = PaqueteCotizaciones::with('paquete_precios')->get()->where('id', $id);
            $cotizacion = Cotizacion::where('id',$paquetes2->cotizaciones_id)->get();
            $cotizacion1='';
            foreach ($cotizacion as $cotizacion_){
                $cotizacion1=$cotizacion_;
            }
            $m_servicio=M_Servicio::get();
            return view('admin.new_plan-details', ['paquete'=>$paquete, 'cotizacion'=>$cotizacion,'m_servicio'=>$m_servicio]);
        }
    }
    public function contabilidad($fecha)
    {
        $cotizacion=Cotizacion::where('estado',2)->where('categorizado','N')->get();
        $cotizacion_cat=Cotizacion::whereYear('fecha',$fecha)->where('estado',2)
            ->whereBetween('categorizado',['C','S'])->get();


//        año actual
//        $cotizacion=Cotizacion::whereYear('updated_at',Date("Y"))->where('estado',2)->get();
//        todos
//        $cotizacion=Cotizacion::where('estado',2)->wherenot('categorizado',null)->get();
//        $cotizacion_cat=Cotizacion::whereYear('fecha',$fecha)->where('estado',2)
//            ->whereBetween('categorizado',['C','S'])->get();
//        $cotizacion_cat=Cotizacion::whereYear('fecha',$fecha_c)->where('estado',2)->where('categorizado','C')->get();
//        $cotizacion_cat_s=Cotizacion::whereYear('fecha',$fecha_s)->where('estado',2)->where('categorizado','S')->get();

        //        dd($cotizacion_cat);
//        dd($cotizacion);
        return view('admin.contabilidad.categorizacion',['cotizacion'=>$cotizacion,'cotizacion_cat'=>$cotizacion_cat,'fecha_pqt'=>$fecha]);
    }
    public function categorizar(Request $request)
    {
        $id = $request->input('id');
        $categoria = $request->input('cate');
        $cotizacion=Cotizacion::FindOrFail($id);
        $cotizacion->categorizado=$categoria;
//        $fecha=$request->input('fecha');
//        $cotizacion=Cotizacion::where('estado',2)->where('categorizado',null)->get();
//        $cotizacion_cat=Cotizacion::whereYear('fecha',$fecha)->where('estado',2)->whereNotNull('categorizado')->get();

//        return redirect()->route('contabilidad_path',$fecha);
//return 1;

        if($cotizacion->save())
            return 1;
        else
            return0;

    }
    public function delete(Request $request){
        $id = $request->input('id');
        $cotizacion=Cotizacion::FindOrFail($id);

        if($cotizacion->delete())
            return 1;
        else
            return 0;
    }
    public function nuevo_paquete(Request $request)
    {
        $plan=$request->input('plan1');
        $cotizacion_id=0;
        $cliente_id=0;
        $estrela = $request->input('estrellas_from');
        $date = date_create($request->input('txt_date1'));
        $fecha = date_format($date, 'jS F Y');
        if($plan=='0') {
            $cliente = new Cliente();
            $cliente->nombres = strtoupper($request->input('txt_name1'));
            $cliente->email = $request->input('txt_email1');
            $cliente->nacionalidad = $request->input('txt_country1');
            $cliente->telefono = $request->input('txt_phone1');
            $cliente->save();

            //-- Datos de la cotizacion
            $cotizacion = new Cotizacion();
            $cotizacion->nombre = strtoupper($request->input('txt_name1')) . ' x' . $request->input('txt_travelers1') . ' ' . $fecha;
            $cotizacion->nropersonas = $request->input('txt_travelers1');
            $cotizacion->duracion = $request->input('txt_days1');
            $cotizacion->fecha = $request->input('txt_date1');
            if($estrela==2)
                $cotizacion->star_2=2;
            if($estrela==3)
                $cotizacion->star_3=3;
            if($estrela==4)
                $cotizacion->star_4=4;
            if($estrela==5)
                $cotizacion->star_5=5;

            $cotizacion->estado=0;
            $cotizacion->users_id=auth()->guard('admin')->user()->id;
            $cotizacion->posibilidad =0;
            $cotizacion->web=$request->input('web1');
            $cotizacion->save();
            $cotizacionGet=Cotizacion::where('id',$cotizacion->id)->get();
            $cotizacion_cliente=new CotizacionesCliente();
            $cotizacion_cliente->cotizaciones_id=$cotizacion->id;
            $cotizacion_cliente->clientes_id=$cliente->id;
            $cotizacion_cliente->estado=1;
            $cotizacion_cliente->save();
            $cotizacion_id=$cotizacion->id;
            $cliente_id=$cliente->id;
        }
        else{
            $cotizacion_id=$request->input('cotizacion_id_1');
            $cliente_id=$request->input('cliente_id_1');
        }

        $txt_day=$request->input('txt_days1');
        $txt_code=strtoupper('GTP-'.$txt_day.'00');
        $txt_title=strtoupper('New package');
        $txta_description='';
        $txta_include='';
        $txta_notinclude='';
        $totalItinerario=$request->input('totalItinerario');
        $itinerarios_=$request->input('itinerarios_2');
        $txt_sugerencia='';
        $nro_personas=$request->input('txt_travelers1');

        $hotel_id_2=0;
        $hotel_id_3=0;
        $hotel_id_4=0;
        $hotel_id_5=0;
        $strellas_2=0;
        $strellas_3=0;
        $strellas_4=0;
        $strellas_5=0;
        $txt_title='';
        $precioCosto=0;
        $amount_s2=0;
        $amount_d2=0;
        $amount_t2=0;
        $amount_s3=0;
        $amount_d3=0;
        $amount_t3=0;
        $amount_s4=0;
        $amount_d4=0;
        $amount_t4=0;
        $amount_s5=0;
        $amount_d5=0;
        $amount_t5=0;

        $profit_2=0;
        $profit_3=0;
        $profit_4=0;
        $profit_5=0;
        if($estrela==2){
            $hotel_id_2=$request->input('hotel_id_2');
            $strellas_2=2;
        }
        if($estrela==3) {
            $hotel_id_3 = $request->input('hotel_id_3');
            $strellas_3=3;
        }
        if($estrela==4) {
            $hotel_id_4 = $request->input('hotel_id_4');
            $strellas_4=4;
        }
        if($estrela==5) {
            $hotel_id_5 = $request->input('hotel_id_5');
            $strellas_5=5;
        }
//        dd($itinerarios_);

//        $strellas_2=$request->input('strellas_2');
//        $strellas_3=$request->input('strellas_3');
//        $strellas_4=$request->input('strellas_4');
//        $strellas_5=$request->input('strellas_5');

        $amount_t2=$request->input('h2_t_');
        $amount_d2=$request->input('h2_d_');
        $amount_s2=$request->input('h2_s_');

        $amount_t3=$request->input('h3_t_');
        $amount_d3=$request->input('h3_d_');
        $amount_s3=$request->input('h3_s_');

        $amount_t4=$request->input('h4_t_');
        $amount_d4=$request->input('h4_d_');
        $amount_s4=$request->input('h4_s_');

        $amount_t5=$request->input('h5_t_');
        $amount_d5=$request->input('h5_d_');
        $amount_s5=$request->input('h5_s_');

        $profit_2=40;
        $profit_3=40;
        $profit_4=40;
        $profit_5=40;

//        $acomodacion=$request->input('acomodacion');
//        $acomodacion=explode('_',$acomodacion);


        $acomodacion_s=0;
        $acomodacion_d=0;
        $acomodacion_m=0;
        $acomodacion_t=0;

        $acomodacion_s=$request->input('a_s');
        $acomodacion_d=$request->input('a_d');
        $acomodacion_m=$request->input('a_m');
        $acomodacion_t=$request->input('a_t');


        $paquete=new PaqueteCotizaciones();
        $paquete->codigo=$txt_code;
        $paquete->titulo=$txt_title;
        $paquete->duracion=$txt_day;
        $paquete->descripcion=$txta_description;
        $paquete->incluye=$txta_include;
        $paquete->noincluye=$txta_notinclude;
        $paquete->utilidad=40;
        $paquete->estado=0;
        $paquete->preciocosto=$totalItinerario;
        $paquete->cotizaciones_id=$cotizacion_id;
        $paquete->proceso_complete=0;
        $paquete->save();
        $paquete_precio_id=0;
        if($estrela==2) {
            $paquete_precio2 = new PaquetePrecio();
            $paquete_precio2->estrellas = 2;
            $paquete_precio2->precio_s = $amount_s2;
            $paquete_precio2->personas_s = $acomodacion_s;
            $paquete_precio2->precio_m = $amount_d2;
            $paquete_precio2->personas_m = $acomodacion_m;
            $paquete_precio2->precio_d = $amount_d2;
            $paquete_precio2->personas_d = $acomodacion_d;
            $paquete_precio2->precio_t = $amount_t2;
            $paquete_precio2->personas_t = $acomodacion_t;
            if ($strellas_2 == 2)
                $paquete_precio2->estado = 1;
            else
                $paquete_precio2->estado = 0;
            $paquete_precio2->utilidad = $profit_2;
            $paquete_precio2->paquete_cotizaciones_id = $paquete->id;
            $paquete_precio2->hotel_id = $hotel_id_2;
            $paquete_precio2->save();
            $paquete_precio_id=$paquete_precio2->id;
        }
        if($estrela==3) {
            $paquete_precio3 = new PaquetePrecio();
            $paquete_precio3->estrellas = 3;
            $paquete_precio3->precio_s = $amount_s3;
            $paquete_precio3->personas_s = $acomodacion_s;
            $paquete_precio3->precio_m = $amount_d3;
            $paquete_precio3->personas_m = $acomodacion_m;
            $paquete_precio3->precio_d = $amount_d3;
            $paquete_precio3->personas_d = $acomodacion_d;
            $paquete_precio3->precio_t = $amount_t3;
            $paquete_precio3->personas_t = $acomodacion_t;
            if ($strellas_3 == 3)
                $paquete_precio3->estado = 1;
            else
                $paquete_precio3->estado = 0;
            $paquete_precio3->utilidad = $profit_3;
            $paquete_precio3->paquete_cotizaciones_id = $paquete->id;
            $paquete_precio3->hotel_id = $hotel_id_3;
            $paquete_precio3->save();
            $paquete_precio_id=$paquete_precio3->id;
        }
        if($estrela==4) {
            $paquete_precio4 = new PaquetePrecio();
            $paquete_precio4->estrellas = 4;
            $paquete_precio4->precio_s = $amount_s4;
            $paquete_precio4->personas_s = $acomodacion_s;
            $paquete_precio4->precio_m = $amount_d4;
            $paquete_precio4->personas_m = $acomodacion_m;
            $paquete_precio4->precio_d = $amount_d4;
            $paquete_precio4->personas_d = $acomodacion_d;
            $paquete_precio4->precio_t = $amount_t4;
            $paquete_precio4->personas_t = $acomodacion_t;
            if ($strellas_4 == 4)
                $paquete_precio4->estado = 1;
            else
                $paquete_precio4->estado = 0;
            $paquete_precio4->utilidad = $profit_4;
            $paquete_precio4->paquete_cotizaciones_id = $paquete->id;
            $paquete_precio4->hotel_id = $hotel_id_4;
            $paquete_precio4->save();
            $paquete_precio_id=$paquete_precio4->id;
        }
        if($estrela==5) {
            $paquete_precio5=new PaquetePrecio();
            $paquete_precio5->estrellas=5;
            $paquete_precio5->precio_s=$amount_s5;
            $paquete_precio5->personas_s=$acomodacion_s;
            $paquete_precio5->precio_m=$amount_d5;
            $paquete_precio5->personas_m=$acomodacion_m;
            $paquete_precio5->precio_d=$amount_d5;
            $paquete_precio5->personas_d=$acomodacion_d;
            $paquete_precio5->precio_t=$amount_t5;
            $paquete_precio5->personas_t=$acomodacion_t;
            if($strellas_5==5)
                $paquete_precio5->estado=1;
            else
                $paquete_precio5->estado=0;
            $paquete_precio5->utilidad=$profit_5;
            $paquete_precio5->paquete_cotizaciones_id=$paquete->id;
            $paquete_precio5->hotel_id=$hotel_id_5;
            $paquete_precio5->save();
            $paquete_precio_id=$paquete_precio5->id;
        }
        $dia=0;
        $dia_texto=1;
        $coti=Cotizacion::FindOrFail($cotizacion_id);
        $fecha_viaje=date($coti->fecha);
//        dd($itinerarios_);
        foreach ($itinerarios_ as $itinerario_id){
//            $itinerario_id=explode('//',$itinerario_id_);
//            $itinerario_id=$itinerario_id[0];
//            dd($itinerario_id);
            $m_itineario=M_Itinerario::FindOrFail($itinerario_id);
            $p_itinerario=new ItinerarioCotizaciones();
            $p_itinerario->titulo=$m_itineario->titulo;
            $p_itinerario->descripcion=$m_itineario->descripcion;
            $p_itinerario->dias=$dia_texto;
            $mod_date = strtotime($fecha_viaje."+ ".($dia_texto-1)." days");
            $p_itinerario->fecha=date("Y-m-d",$mod_date) ;
            $p_itinerario->precio=$m_itineario->precio;
            $p_itinerario->imagen=$m_itineario->imagen;
            $p_itinerario->imagenB=$m_itineario->imagenB;
            $p_itinerario->imagenC=$m_itineario->imagenC;
            $p_itinerario->destino_foco=$m_itineario->destino_foco;
            $p_itinerario->destino_duerme=$m_itineario->destino_duerme;
            $p_itinerario->observaciones='';
            $p_itinerario->estado=1;
            $p_itinerario->paquete_cotizaciones_id=$paquete->id;
            $p_itinerario->save();
            $dia++;
            $dia_texto++;
            foreach ($m_itineario->destinos as $m_destinos){
                $p_destinos=new ItinerarioDestinos();
                $p_destinos->codigo=$m_destinos->codigo;
                $p_destinos->destino=$m_destinos->destino;
                $p_destinos->region=$m_destinos->region;
                $p_destinos->pais=$m_destinos->pais;
                $p_destinos->descripcion=$m_destinos->descripcion;
                $p_destinos->imagen=$m_destinos->imagen;
                $p_destinos->estado=1;
                $p_destinos->itinerario_cotizaciones_id=$p_itinerario->id;
                $p_destinos->save();
            }
            $st=0;
            foreach($m_itineario->itinerario_itinerario_servicios as $servicios){
                $p_servicio=new ItinerarioServicios();
                $p_servicio->nombre=$servicios->itinerario_servicios_servicio->nombre;
                $p_servicio->observacion='';
                $p_servicio->precio=$servicios->itinerario_servicios_servicio->precio_venta;
                $st+=$p_servicio->precio;
                $p_servicio->itinerario_cotizaciones_id=$p_itinerario->id;
                $p_servicio->user_id=auth()->guard('admin')->user()->id;
                $p_servicio->precio_grupo=$servicios->itinerario_servicios_servicio->precio_grupo;
                $p_servicio->min_personas=$servicios->itinerario_servicios_servicio->min_personas;
                $p_servicio->max_personas=$servicios->itinerario_servicios_servicio->max_personas;
                $p_servicio->precio_c=0;
//                $p_servicio->user_id=1;
                $p_servicio->estado=1;
                $p_servicio->salida=$servicios->itinerario_servicios_servicio->salida;
                $p_servicio->llegada=$servicios->itinerario_servicios_servicio->llegada;
                $p_servicio->clase=$servicios->itinerario_servicios_servicio->clase;
                $p_servicio->m_servicios_id=$servicios->m_servicios_id;
                $p_servicio->pos=$servicios->pos;
                $p_servicio->save();
                if($servicios->itinerario_servicios_servicio->precio_grupo==1 && $servicios->itinerario_servicios_servicio->grupo=='MOVILID'){
                    if($servicios->itinerario_servicios_servicio->min_personas<=$nro_personas&&$nro_personas<=$servicios->itinerario_servicios_servicio->max_personas)
                    {

                    }
                    else{
                        $servicios_list=M_Servicio::where('grupo',$servicios->itinerario_servicios_servicio->grupo)
                            ->where('localizacion',$servicios->itinerario_servicios_servicio->localizacion)
//                            ->where('tipoServicio',$servicios->itinerario_servicios_servicio->tipoServicio)
                            ->where('min_personas','<=',$nro_personas)
                            ->where('max_personas','>=',$nro_personas)
                            ->get();
                        foreach($servicios_list->take(1) as $servi){
                            $st-=$p_servicio->precio;
                            $p_servicio1=ItinerarioServicios::FindOrFail($p_servicio->id);
                            $p_servicio1->nombre=$servi->nombre;
                            $p_servicio1->observacion='';
                            $p_servicio1->precio=$servi->precio_venta;
                            $st+=$p_servicio1->precio;
                            $p_servicio1->itinerario_cotizaciones_id=$p_itinerario->id;
                            $p_servicio1->precio_grupo=$servi->precio_grupo;
                            $p_servicio1->min_personas=$servi->min_personas;
                            $p_servicio1->max_personas=$servi->max_personas;
                            $p_servicio1->precio_c=0;
                            $p_servicio1->estado=1;
                            $p_servicio1->salida=$servi->salida;
                            $p_servicio1->llegada=$servi->llegada;
                            $p_servicio1->m_servicios_id=$servi->id;
                            $p_servicio1->save();
                        }
                    }
                }
            }
            $p_itinerario->precio=$st;
            $p_itinerario->save();
        }
//-- recorremos los dias para agregar los hoteles
        $itinerario_cotizaciones=ItinerarioCotizaciones::where('paquete_cotizaciones_id',$paquete->id)->get();
//        dd($itinerario_cotizaciones);
        $nroDias=count($itinerario_cotizaciones);
//        dd($nroDias);
        $pos=1;
        $paquetePrecio=PaquetePrecio::FindOrFail($paquete_precio_id);
        foreach ($itinerario_cotizaciones as $itinerario_cotizacion){
            if($itinerario_cotizacion->destino_duerme>0){
            $temp_dest=M_Destino::findOrFail($itinerario_cotizacion->destino_duerme);
            if ($pos < $nroDias){
                $hotelesxdestinoes=Hotel::where('estrellas',$estrela)->where('localizacion',$temp_dest->destino)->get();
                foreach ($hotelesxdestinoes as $hotelxdestinos){
                    $preio_hotel = new PrecioHotelReserva();
                    $preio_hotel->estrellas = $estrela;
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
                    $preio_hotel->itinerario_cotizaciones_id = $itinerario_cotizacion->id;
                    $preio_hotel->utilidad_s=$paquetePrecio->utilidad_s;
                    $preio_hotel->utilidad_d=$paquetePrecio->utilidad_d;
                    $preio_hotel->utilidad_m=$paquetePrecio->utilidad_m;
                    $preio_hotel->utilidad_t=$paquetePrecio->utilidad_t;
                    $preio_hotel->utilidad_por_s=$paquetePrecio->utilidad_por_s;
                    $preio_hotel->utilidad_por_d=$paquetePrecio->utilidad_por_d;
                    $preio_hotel->utilidad_por_m=$paquetePrecio->utilidad_por_m;
                    $preio_hotel->utilidad_por_t=$paquetePrecio->utilidad_por_t;
                    $preio_hotel->localizacion=$hotelxdestinos->localizacion;
                    $preio_hotel->save();
                }
                $pos++;
            }
            }
        }

     return redirect()->route('show_step1_path',[$cliente_id,$cotizacion_id,$paquete->id]);
    }
    public function nuevo_paquete_(Request $request)
    {

        $plan=$request->input('plan');
        $cotizacion_id=0;
        $cliente_id=0;
        $estrela = $request->input('estrellas_from_');
        $date = date_create($request->input('txt_date1_'));
        $fecha = date_format($date, 'jS F Y');
        $acomodacion_s=0;
        if($request->input('a_s_'))
            $acomodacion_s=$request->input('a_s_');

        $acomodacion_d=0;
        if($request->input('a_d_'))
            $acomodacion_d=$request->input('a_d_');

        $acomodacion_m=0;
        if($request->input('a_m_'))
            $acomodacion_m=$request->input('a_m_');

        $acomodacion_t=0;
        if($request->input('a_t_'))
            $acomodacion_t=$request->input('a_t_');

        if($plan=='0'){
            $cliente = new Cliente();
            $cliente->nombres = strtoupper($request->input('txt_name1_'));
            $cliente->email = $request->input('txt_email1_');
            $cliente->nacionalidad = $request->input('txt_country1_');
            $cliente->telefono = $request->input('txt_phone1_');
            $cliente->save();

            //-- Datos de la cotizacion

            $cotizacion_plantilla = new Cotizacion();
            $cotizacion_plantilla->nombre = strtoupper($request->input('txt_name1_')) . ' x' . $request->input('txt_travelers1_') . ' ' . $fecha;
            $cotizacion_plantilla->nropersonas = $request->input('txt_travelers1_');
            $cotizacion_plantilla->duracion = $request->input('txt_days1_');
            $cotizacion_plantilla->fecha = $request->input('txt_date1_');

            if ($estrela == 2)
                $cotizacion_plantilla->star_2 = 2;
            if ($estrela == 3)
                $cotizacion_plantilla->star_3 = 3;
            if ($estrela == 4)
                $cotizacion_plantilla->star_4 = 4;
            if ($estrela == 5)
                $cotizacion_plantilla->star_5 = 5;

            $cotizacion_plantilla->estado = 0;
            $cotizacion_plantilla->users_id = auth()->guard('admin')->user()->id;
            $cotizacion_plantilla->posibilidad =0;
            $cotizacion_plantilla->web=$request->input('web_');
            $cotizacion_plantilla->save();

            $cotizacion_cliente = new CotizacionesCliente();
            $cotizacion_cliente->cotizaciones_id = $cotizacion_plantilla->id;
            $cotizacion_cliente->clientes_id = $cliente->id;
            $cotizacion_cliente->estado = 1;
            $cotizacion_cliente->save();
            $cotizacion_id=$cotizacion_plantilla->id;
            $cliente_id=$cliente->id;

        }
        else{
            $cotizacion_id=$request->input('cotizacion_id_');
            $cliente_id=$request->input('cliente_id_');

        }

        $p_paquete_id=$request->input('pqt_id');
        $p_paquete=P_Paquete::where('id',$p_paquete_id)->get();
//        dd($p_paquete);
        $nro_personas=$request->input('txt_travelers1_');
        $txt_day=$request->input('txt_days1_');

        $txt_code=strtoupper('GTP-'.$txt_day.'00');
        $txta_description='';
        $txta_include='';
        $txta_notinclude='';

        $hotel_id_2=0;
        $hotel_id_3=0;
        $hotel_id_4=0;
        $hotel_id_5=0;
        $strellas_2=0;
        $strellas_3=0;
        $strellas_4=0;
        $strellas_5=0;
        $txt_title='';
        $precioCosto=0;
        $amount_s2=0;
        $amount_d2=0;
        $amount_t2=0;
        $amount_s3=0;
        $amount_d3=0;
        $amount_t3=0;
        $amount_s4=0;
        $amount_d4=0;
        $amount_t4=0;
        $amount_s5=0;
        $amount_d5=0;
        $amount_t5=0;

        $profit_2=0;
        $profit_3=0;
        $profit_4=0;
        $profit_5=0;
        foreach($p_paquete as $p_paquete_){
            $txt_title=strtoupper($p_paquete_->titulo);
            $txta_description=$p_paquete_->descripcion;
            $txta_include=$p_paquete_->incluye;
            $txta_notinclude=$p_paquete_->noincluye;

            foreach($p_paquete_->precios as $p_precio){
                if($p_precio->estrellas==2){
                    $hotel_id_2=$p_precio->hotel_id;
                    $strellas_2=2;
                    $amount_t2=$p_precio->precio_t;
                    $amount_d2=$p_precio->precio_d;
                    $amount_s2=$p_precio->precio_s;
                    $profit_2=$p_precio->utilidad;
                }
                if($p_precio->estrellas==3){
                    $hotel_id_3=$p_precio->hotel_id;
                    $strellas_3=3;
                    $amount_t3=$p_precio->precio_t;
                    $amount_d3=$p_precio->precio_d;
                    $amount_s3=$p_precio->precio_s;
                    $profit_3=$p_precio->utilidad;
                }
                if($p_precio->estrellas==4){
                    $hotel_id_4=$p_precio->hotel_id;
                    $strellas_4=4;
                    $amount_t4=$p_precio->precio_t;
                    $amount_d4=$p_precio->precio_d;
                    $amount_s4=$p_precio->precio_s;
                    $profit_4=$p_precio->utilidad;
                }
                if($p_precio->estrellas==5){
                    $hotel_id_5=$p_precio->hotel_id;
                    $strellas_5=5;
                    $amount_t5=$p_precio->precio_t;
                    $amount_d5=$p_precio->precio_d;
                    $amount_s5=$p_precio->precio_s;
                    $profit_5=$p_precio->utilidad;
                }
            }
            $precioCosto=$p_paquete_->preciocosto;
        }
//
        $paquete=new PaqueteCotizaciones();
        $paquete->codigo=$txt_code;
        $paquete->titulo=$txt_title;
        $paquete->duracion=$txt_day;
        $paquete->descripcion=$txta_description;
        $paquete->incluye=$txta_include;
        $paquete->noincluye=$txta_notinclude;
        $paquete->utilidad=40;
        $paquete->estado=0;
        $paquete->preciocosto=$precioCosto;
        $paquete->cotizaciones_id=$cotizacion_id;
        $paquete->estrellas=$estrela;
        $paquete->proceso_complete=1;
        $paquete->save();
        $paquete_precio_id=0;

//        dd($paquete);
//        dd($estrela);
        if($estrela==2) {
            $paquete_precio2 = new PaquetePrecio();
            $paquete_precio2->estrellas = 2;
            $paquete_precio2->precio_s = $amount_s2;
            $paquete_precio2->personas_s = $acomodacion_s;
            $paquete_precio2->precio_m = $amount_d2;
            $paquete_precio2->personas_m = $acomodacion_m;
            $paquete_precio2->precio_d = $amount_d2;
            $paquete_precio2->personas_d = $acomodacion_d;
            $paquete_precio2->precio_t = $amount_t2;
            $paquete_precio2->personas_t = $acomodacion_t;
            if ($strellas_2 == 2)
                $paquete_precio2->estado = 1;
            else
                $paquete_precio2->estado = 0;
            $paquete_precio2->utilidad = $profit_2;
            $paquete_precio2->paquete_cotizaciones_id = $paquete->id;
            $paquete_precio2->hotel_id = $hotel_id_2;
            $paquete_precio2->save();
            $paquete_precio_id=$paquete_precio2->id;
        }
        if($estrela==3) {
            $paquete_precio3 = new PaquetePrecio();
            $paquete_precio3->estrellas = 3;
            $paquete_precio3->precio_s = $amount_s3;
            $paquete_precio3->personas_s = $acomodacion_s;
            $paquete_precio3->precio_m = $amount_d3;
            $paquete_precio3->personas_m = $acomodacion_m;
            $paquete_precio3->precio_d = $amount_d3;
            $paquete_precio3->personas_d = $acomodacion_d;
            $paquete_precio3->precio_t = $amount_t3;
            $paquete_precio3->personas_t = $acomodacion_t;
            if ($strellas_3 == 3)
                $paquete_precio3->estado = 1;
            else
                $paquete_precio3->estado = 0;
            $paquete_precio3->utilidad = $profit_3;
            $paquete_precio3->paquete_cotizaciones_id = $paquete->id;
            $paquete_precio3->hotel_id = $hotel_id_3;
            $paquete_precio3->save();
            $paquete_precio_id=$paquete_precio3->id;
        }
        if($estrela==4) {
            $paquete_precio4 = new PaquetePrecio();
            $paquete_precio4->estrellas = 4;
            $paquete_precio4->precio_s = $amount_s4;
            $paquete_precio4->personas_s = $acomodacion_s;
            $paquete_precio4->precio_m = $amount_d4;
            $paquete_precio4->personas_m = $acomodacion_m;
            $paquete_precio4->precio_d = $amount_d4;
            $paquete_precio4->personas_d = $acomodacion_d;
            $paquete_precio4->precio_t = $amount_t4;
            $paquete_precio4->personas_t = $acomodacion_t;
            if ($strellas_4 == 4)
                $paquete_precio4->estado = 1;
            else
                $paquete_precio4->estado = 0;
            $paquete_precio4->utilidad = $profit_4;
            $paquete_precio4->paquete_cotizaciones_id = $paquete->id;
            $paquete_precio4->hotel_id = $hotel_id_4;
            $paquete_precio4->save();
            $paquete_precio_id=$paquete_precio4->id;
        }
        if($estrela==5) {
            $paquete_precio5=new PaquetePrecio();
            $paquete_precio5->estrellas=5;
            $paquete_precio5->precio_s=$amount_s5;
            $paquete_precio5->personas_s=$acomodacion_s;
            $paquete_precio5->precio_m=$amount_d5;
            $paquete_precio5->personas_m=$acomodacion_m;
            $paquete_precio5->precio_d=$amount_d5;
            $paquete_precio5->personas_d=$acomodacion_d;
            $paquete_precio5->precio_t=$amount_t5;
            $paquete_precio5->personas_t=$acomodacion_t;
            if($strellas_5==5)
                $paquete_precio5->estado=1;
            else
                $paquete_precio5->estado=0;
            $paquete_precio5->utilidad=$profit_5;
            $paquete_precio5->paquete_cotizaciones_id=$paquete->id;
            $paquete_precio5->hotel_id=$hotel_id_5;
            $paquete_precio5->save();
            $paquete_precio_id=$paquete_precio5->id;
        }
        $dia=0;
        $dia_texto=1;
        $coti=Cotizacion::FindOrFail($cotizacion_id);
//        dd($coti);

        $fecha_viaje=date($coti->fecha);
        foreach($p_paquete as $p_paquete_){
            foreach($p_paquete_->itinerarios as $itinerarios_){

                $p_itinerario=new ItinerarioCotizaciones();
                $p_itinerario->titulo=$itinerarios_->titulo;
                $p_itinerario->descripcion=$itinerarios_->descripcion;
                $p_itinerario->dias=$dia_texto;
                $mod_date = strtotime( '+'.($dia_texto-1).' day' , strtotime ( $fecha_viaje ) ) ;
                $p_itinerario->fecha=date("Y-m-d",$mod_date) ;
                $p_itinerario->precio=$itinerarios_->precio;
                $p_itinerario->imagen=$itinerarios_->imagen;
                $p_itinerario->imagenB=$itinerarios_->imagenB;
                $p_itinerario->imagenC=$itinerarios_->imagenC;
                $p_itinerario->destino_foco=$itinerarios_->destino_foco;
                $p_itinerario->destino_duerme=$itinerarios_->destino_duerme;
                $p_itinerario->observaciones='';
                $p_itinerario->estado=1;
                $p_itinerario->paquete_cotizaciones_id=$paquete->id;
                $p_itinerario->save();
                $dia++;
                $dia_texto++;
                foreach ($itinerarios_->destinos as $m_destinos){
                    $p_destinos=new ItinerarioDestinos();
                    $p_destinos->codigo=$m_destinos->codigo;
                    $p_destinos->destino=$m_destinos->destino;
                    $p_destinos->region=$m_destinos->region;
                    $p_destinos->pais=$m_destinos->pais;
                    $p_destinos->descripcion=$m_destinos->descripcion;
                    $p_destinos->imagen=$m_destinos->imagen;
                    $p_destinos->estado=1;
                    $p_destinos->itinerario_cotizaciones_id=$p_itinerario->id;
                    $p_destinos->save();
                }
                $st=0;
                foreach($itinerarios_->serivicios as $servicios){
                    $p_servicio=new ItinerarioServicios();
                    $p_servicio->nombre=$servicios->nombre;
                    $p_servicio->observacion='';
                    if($servicios->precio_grupo==1){
                        $p_servicio->precio=$servicios->precio*2;
                    }
                    else {
                        $p_servicio->precio = $servicios->precio;
                    }
                    $st+=$p_servicio->precio;
                    $p_servicio->itinerario_cotizaciones_id=$p_itinerario->id;
                    $p_servicio->precio_grupo=$servicios->precio_grupo;
                    $p_servicio->min_personas=$servicios->min_personas;
                    $p_servicio->max_personas=$servicios->max_personas;
                    $p_servicio->salida=$servicios->salida;
                    $p_servicio->llegada=$servicios->llegada;
                    $p_servicio->precio_c=0;
//                    $p_servicio->user_id=1;
                    $p_servicio->user_id=auth()->guard('admin')->user()->id;
                    $p_servicio->m_servicios_id=$servicios->m_servicios_id;
                    $p_servicio->pos=$servicios->pos;
                    $p_servicio->save();
                    if($servicios->precio_grupo==1 && $servicios->grupo=='MOVILID'){
                        if($servicios->min_personas<=$nro_personas&&$nro_personas<=$servicios->max_personas)
                        {}
                        else{
                            $servicios_list=M_Servicio::where('grupo',$servicios->grupo)
                                ->where('localizacion',$servicios->localizacion)
                                ->where('tipoServicio',$servicios->tipoServicio)
                                ->where('min_personas','<=',$nro_personas)
                                ->where('max_personas','>=',$nro_personas)
                                ->get();
                            foreach($servicios_list->take(1) as $servi){
                                $st-=$p_servicio->precio;
                                $p_servicio1=ItinerarioServicios::FindOrFail($p_servicio->id);
                                $p_servicio1->nombre=$servi->nombre;
                                $p_servicio1->observacion='';
                                $p_servicio1->precio=$servi->precio_venta;
                                $st+=$p_servicio1->precio;
                                $p_servicio1->itinerario_cotizaciones_id=$p_itinerario->id;
                                $p_servicio1->precio_grupo=$servi->precio_grupo;
                                $p_servicio1->min_personas=$servi->min_personas;
                                $p_servicio1->max_personas=$servi->max_personas;
                                $p_servicio1->precio_c=0;
                                $p_servicio1->estado=1;
                                $p_servicio1->salida=$servi->salida;
                                $p_servicio1->llegada=$servi->llegada;
                                $p_servicio1->m_servicios_id=$servi->id;
                                $p_servicio1->save();
                            }
                        }
                    }
                }
                $p_itinerario->precio=$st;
                $p_itinerario->save();
            }
        }
////-- recorremos los dias para agregar los hoteles
        $itinerario_cotizaciones=ItinerarioCotizaciones::where('paquete_cotizaciones_id',$paquete->id)->get();
        $nroDias=count($itinerario_cotizaciones);
        $pos=1;
        $paquetePrecio=PaquetePrecio::FindOrFail($paquete_precio_id);
        foreach ($itinerario_cotizaciones as $iti_coti) {
            if($iti_coti->destino_duerme>0){
                $temp_dest=M_Destino::findOrFail($iti_coti->destino_duerme);
                if ($pos < $nroDias){
                    $hotelesxdestinoes=Hotel::where('estrellas',$estrela)->where('localizacion',$temp_dest->destino)->get();
                    foreach ($hotelesxdestinoes as $hotelxdestinos){
                        $preio_hotel = new PrecioHotelReserva();
                        $preio_hotel->estrellas = $estrela;
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
                        $preio_hotel->utilidad_s=$paquetePrecio->utilidad_s;
                        $preio_hotel->utilidad_d=$paquetePrecio->utilidad_d;
                        $preio_hotel->utilidad_m=$paquetePrecio->utilidad_m;
                        $preio_hotel->utilidad_t=$paquetePrecio->utilidad_t;
                        $preio_hotel->utilidad_por_s=$paquetePrecio->utilidad_por_s;
                        $preio_hotel->utilidad_por_d=$paquetePrecio->utilidad_por_d;
                        $preio_hotel->utilidad_por_m=$paquetePrecio->utilidad_por_m;
                        $preio_hotel->utilidad_por_t=$paquetePrecio->utilidad_por_t;
                        $preio_hotel->localizacion=$hotelxdestinos->localizacion;
                        $preio_hotel->save();
//                        dd($preio_hotel);
                    }
                $pos++;
            }
            }
        }

//        dd($paquete->id);
        return redirect()->route('show_step1_path',[$cliente_id,$cotizacion_id,$paquete->id]);
    }
    public function editar_cotizacion1(Request $request){
        $cotizacion_id=$request->input('cotizacion_id');
        $paquete_precio_id=$request->input('paquete_precio_id');

        $cotizaciones=Cotizacion::where('id',$cotizacion_id)->get();
        $imprimir=$request->input('imprimir');

        return view('admin.package-prepare',['cotizaciones'=>$cotizaciones,'paquete_precio_id'=>$paquete_precio_id,'imprimir'=>$imprimir]);

    }
    public function guardar_paquete(Request $request){
        $cotizacion_id=$request->input('cotizacion_id');
        $paquete_id=$request->input('paquete_id');
        $paquete_precio_id=$request->input('paquete_precio_id');
        $txt_titulo=strtoupper($request->input('txt_titulo'));
        $descripcion=$request->input('descripcion');
        $incluye=$request->input('incluye');
        $no_incluye=$request->input('no_incluye');
        $pro_s=$request->input('pro_s');
        $pro_d=$request->input('pro_d');
        $pro_m=$request->input('pro_m');
        $pro_t=$request->input('pro_t');

        $profit_por_s=$request->input('profit_por_s');
        $profit_por_d=$request->input('profit_por_d');
        $profit_por_m=$request->input('profit_por_m');
        $profit_por_t=$request->input('profit_por_t');

        $cotizacion=Cotizacion::findOrFail($cotizacion_id);
        $cotizacion->estado=1;
        $cotizacion->save();

        $paquete=PaqueteCotizaciones::FindOrFail($paquete_id);
        $paquete->titulo=$txt_titulo;
        $paquete->descripcion=$descripcion;
        $paquete->incluye=$incluye;
        $paquete->noincluye=$no_incluye;
        $paquete->estado=1;
        $paquete->proceso_complete=2;
        $paquete->save();

        $paquete_precio=PaquetePrecio::FindOrFail($paquete_precio_id);
        $paquete_precio->utilidad_s=$pro_s;
        $paquete_precio->utilidad_d=$pro_d;
        $paquete_precio->utilidad_m=$pro_m;
        $paquete_precio->utilidad_t=$pro_t;

        $paquete_precio->utilidad_por_s=$profit_por_s;
        $paquete_precio->utilidad_por_d=$profit_por_d;
        $paquete_precio->utilidad_por_m=$profit_por_m;
        $paquete_precio->utilidad_por_t=$profit_por_t;
        $paquete_precio->save();

        $itinerarios=ItinerarioCotizaciones::where('paquete_cotizaciones_id',$paquete_id)->get();
        foreach ($itinerarios as $itinerario){
            foreach ($itinerario->hotel as $hotel){
                $hotel1=PrecioHotelReserva::FindOrFail($hotel->id);
                $hotel1->utilidad_s=$pro_s;
                $hotel1->utilidad_d=$pro_d;
                $hotel1->utilidad_m=$pro_m;
                $hotel1->utilidad_t=$pro_t;

                $hotel1->utilidad_por_s=$profit_por_s;
                $hotel1->utilidad_por_d=$profit_por_d;
                $hotel1->utilidad_por_m=$profit_por_m;
                $hotel1->utilidad_por_t=$profit_por_t;
                $hotel1->save();
            }
        }
        $paquete_precio_id=$request->input('paquete_precio_id');
        $cotizaciones=Cotizacion::where('id',$cotizacion_id)->get();
        $imprimir='si_create';
        $btn=$request->input('create');
//        dd($btn);

        if($btn=='create'){
            return view('admin.package-prepare',['cotizaciones'=>$cotizaciones,'paquete_precio_id'=>$paquete_id,'imprimir'=>$imprimir]);
        }
        elseif($btn=='create_template'){
            $imprimir='si_create_temp';
            $coti_id=$cotizacion_id;
            $id=$paquete_id;
            $ogiginal_pqts=PaqueteCotizaciones::where('id',$id)->get();
            $new_pqt_id=0;
            foreach($ogiginal_pqts as $ogiginal_pqt){
                $plantillas= P_Paquete::where('duracion',$ogiginal_pqt->duracion)->get();
                $nro=count($plantillas);
                $numero_con_ceros = '';
                if($nro>0) {
                    $diferencia = 4 - strlen(count($plantillas));

                    for ($i = 0; $i < $diferencia; $i++) {
                        $numero_con_ceros .= 0;
                    }

                    $numero_con_ceros .= count($plantillas);
                }
                else
                    $numero_con_ceros ='001';

                $plantilla_pqt= new P_Paquete();
                $plantilla_pqt->codigo='GTP'.$ogiginal_pqt->duracion.$numero_con_ceros;
                $plantilla_pqt->titulo=$plantilla_pqt->titulo;
                $plantilla_pqt->duracion=$ogiginal_pqt->duracion;
                $plantilla_pqt->precio_venta=$ogiginal_pqt->precioventa;
                $plantilla_pqt->utilidad=$ogiginal_pqt->utilidad;
                $plantilla_pqt->preciocosto=$ogiginal_pqt->preciocosto;
                $plantilla_pqt->descripcion=$ogiginal_pqt->descripcion;
                $plantilla_pqt->incluye=$ogiginal_pqt->incluye;
                $plantilla_pqt->noincluye=$ogiginal_pqt->noincluye;
                $plantilla_pqt->opcional=$ogiginal_pqt->opcional;
                $plantilla_pqt->estado=1;
                $plantilla_pqt->save();
                $new_pqt_id=$plantilla_pqt->id;
                foreach ($ogiginal_pqt->paquete_precios as $paquete_precio){
                    $plantilla_ppqt=new P_PaquetePrecio();
                    $plantilla_ppqt->estrellas=$paquete_precio->estrellas;
                    $plantilla_ppqt->precio_s=$paquete_precio->precio_s;
                    $plantilla_ppqt->personas_s=1;
                    $plantilla_ppqt->precio_d=$paquete_precio->precio_d;
                    $plantilla_ppqt->personas_d=1;
                    $plantilla_ppqt->precio_m=$paquete_precio->precio_m;
                    $plantilla_ppqt->personas_m=1;
                    $plantilla_ppqt->precio_t=$paquete_precio->precio_t;
                    $plantilla_ppqt->personas_t=1;
                    $plantilla_ppqt->estado=1;
                    $plantilla_ppqt->utilidad=$paquete_precio->utilidad;
                    $plantilla_ppqt->p_paquete_id=$plantilla_pqt->id;
                    $plantilla_ppqt->hotel_id=$paquete_precio->hotel_id;
                    $plantilla_ppqt->utilidad_s=$paquete_precio->utilidad_s;
                    $plantilla_ppqt->utilidad_d=$paquete_precio->utilidad_d;
                    $plantilla_ppqt->utilidad_m=$paquete_precio->utilidad_m;
                    $plantilla_ppqt->utilidad_t=$paquete_precio->utilidad_t;
                    $plantilla_ppqt->utilidad_por_s=$paquete_precio->utilidad_por_s;
                    $plantilla_ppqt->utilidad_por_d=$paquete_precio->utilidad_por_d;
                    $plantilla_ppqt->utilidad_por_m=$paquete_precio->utilidad_por_m;
                    $plantilla_ppqt->utilidad_por_t=$paquete_precio->utilidad_por_t;
                    $plantilla_ppqt->save();
                }
                foreach ($ogiginal_pqt->itinerario_cotizaciones as $itinerario_cotizacion){
                    $plantilla_piti=new P_Itinerario();
                    $plantilla_piti->titulo=$itinerario_cotizacion->titulo;
                    $plantilla_piti->descripcion=$itinerario_cotizacion->descripcion;
                    $plantilla_piti->dias=$itinerario_cotizacion->dias;
                    $plantilla_piti->fecha=$itinerario_cotizacion->fecha;
                    $plantilla_piti->precio=$itinerario_cotizacion->precio;
                    $plantilla_piti->imagen=$itinerario_cotizacion->imagen;
                    $plantilla_piti->sugerencia='';
                    $plantilla_piti->estado=1;
                    $plantilla_piti->p_paquete_id=$plantilla_pqt->id;
                    $plantilla_piti->save();
                    foreach ($itinerario_cotizacion->itinerario_servicios as $itinerario_servicios){
                        $plantilla_pitis=new P_ItinerarioServicios();
                        $plantilla_pitis->nombre=$itinerario_servicios->nombre;
                        $plantilla_pitis->observacion=$itinerario_servicios->observacion;
                        $plantilla_pitis->precio=$itinerario_servicios->precio;
                        $plantilla_pitis->precio_grupo=$itinerario_servicios->precio_grupo;
                        $plantilla_pitis->min_personas=$itinerario_servicios->min_personas;
                        $plantilla_pitis->max_personas=$itinerario_servicios->max_personas;
                        $plantilla_pitis->p_itinerario_id=$plantilla_piti->id;
                        $plantilla_pitis->m_servicios_id=$itinerario_servicios->m_servicios_id;
                        $plantilla_pitis->save();
                    }
                    foreach ($itinerario_cotizacion->itinerario_destinos as $itinerario_destino){
                        $plantilla_pitid=new P_ItinerarioDestino();
                        $plantilla_pitid->codigo=$itinerario_destino->codigo;
                        $plantilla_pitid->destino=$itinerario_destino->destino;
                        $plantilla_pitid->region=$itinerario_destino->region;
                        $plantilla_pitid->pais=$itinerario_destino->pais;
                        $plantilla_pitid->descripcion=$itinerario_destino->descripcion;
                        $plantilla_pitid->imagen=$itinerario_destino->imagen;
                        $plantilla_pitid->estado=1;
                        $plantilla_pitid->p_itinerario_id=$plantilla_piti->id;
                        $plantilla_pitid->save();
                    }
                }
            }
            return view('admin.package-prepare',['cotizaciones'=>$cotizaciones,'paquete_precio_id'=>$paquete_id,'imprimir'=>$imprimir]);
        }

    }
    public function delete_servicio_quotes_paso1(Request $request){
        $id = $request->input('id');
        $objeto=ItinerarioServicios::FindOrFail($id);
        if($objeto->delete())
            return 1;
        else
            return 0;
    }
    public function cotizacion_cliente_autocomplete(){
        $term=Input::get('term');
        $result=array();
//        $datos=Cotizacion::with(['cotizaciones_cliente.cliente'=>function($query) use ($term){
//            $query->where('nombres','LIKE','%'.$term.'%');
//        }])->get();
//        foreach ($datos as $cotizacion){
//            foreach ($cotizacion->cotizaciones_cliente as $cotizacion_cliente){
//                foreach ($cotizacion_cliente->cliente as $cliente){
//                    $result[]=['id'=>$cotizacion->id,'value'=>$cliente->nombres.' x '.$cotizacion->nropersonas.' '.$cotizacion->fecha];
//                }
//            }
//        }



        $clientes=Cliente::where('nombres','LIKE','%'.$term.'%')
            ->orwhere('apellidos','LIKE','%'.$term.'%')
            ->get();
        foreach ($clientes as $cliente){
            $result[]=['id'=>$cliente->id,'value'=>$cliente->nombres.' '.$cliente->apellidos];
        }
        return $result;

//        $objeto=M_Itinerario::with(['destinos'=> function ($query) use ($arreglo) {
//            $query->whereIn('destino', $arreglo);
//        }])
//            ->get();
    }
    public function mostrar_datos_cliente(Request $request){
        $cliente=trim($request->input('id'));
        $cliente=Cliente::where('nombres',$cliente)->get();
//        return $cliente;
        $cliente1='';
        $datos_enviar='';
        foreach($cliente->take(1) as $cliente2){
            $cliente1=$cliente2->id;
            $datos_enviar=$cliente2->nacionalidad.'_'.$cliente2->email.'_'.$cliente2->telefono.'_';
        }

        $datos=Cotizacion::with(['cotizaciones_cliente'=>function($query) use ($cliente1){
            $query->where('clientes_id','=', $cliente1)
                ->where('estado', '1')->get();
        }])->get();
//
//        return $datos;
        if(count($datos)>0){
            foreach($datos as $dato_cliente){
                foreach($dato_cliente->cotizaciones_cliente as $dato){
                    if($dato->clientes_id==$cliente1 && $dato->estado='1')
                    $datos_enviar.=$dato_cliente->nropersonas.'_'.$dato_cliente->duracion.'_'.$dato_cliente->fecha.'_'.$dato_cliente->id.'_'.$cliente1;
                }
            }
            return '1_'.$datos_enviar;
        }

        else
            return '0_';
    }
    public function nuevo_plan_cotizacion($id)
    {
        $datos=Cotizacion::where('id',$id)->get();
//        dd($datos);
        $plan=1;
        $cliente_id=0;
        $nombres='';
        $nacionalidad='';
        $email='';
        $telefono='';
        $travelers=0;
        $days=0;
        $fecha='';
        $web='gotoperu.com';
        foreach($datos as $dato){
            $travelers=$dato->nropersonas;
            $days=$dato->duracion;
            $fecha=$dato->fecha;
            $web=$dato->web;
            foreach($dato->cotizaciones_cliente as $cotizaciones_cliente){
                $cliente_id=$cotizaciones_cliente->cliente->id;
                $nombres=$cotizaciones_cliente->cliente->nombres;
                $nacionalidad=$cotizaciones_cliente->cliente->nacionalidad;
                $email=$cotizaciones_cliente->cliente->email;
                $telefono=$cotizaciones_cliente->cliente->telefono;
            }
        }

        $destinos=M_Destino::get();
        $itinerarios=M_Itinerario::get();
        $itinerarios_d=M_ItinerarioDestino::get();
        $m_servicios=M_Servicio::get();
        $p_paquete=P_Paquete::get();
        $hotel=Hotel::get();
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
            'web'=>$web]);
    }
    public function show_step1($cliente_id, $cotizacion_id,$pqt_id)
    {
        $cliente=Cliente::FindOrFail($cliente_id);
        $cotizaciones=Cotizacion::where('id',$cotizacion_id)->get();
        $m_servicios=M_Servicio::get();

        return view('admin.package-details1',['cliente'=>$cliente,'cotizaciones'=>$cotizaciones,/*'destinos'=>$destinos*/'m_servicios'=>$m_servicios,'paquete_precio_id'=>$pqt_id]);
    }
    public function show_step1_editar($cliente_id, $cotizacion_id,$pqt_id)
    {
        $cliente=Cliente::FindOrFail($cliente_id);
        $cotizaciones=Cotizacion::where('id',$cotizacion_id)->get();
        $m_servicios=M_Servicio::get();
        return view('admin.package-details1-edit',['cliente'=>$cliente,'cotizaciones'=>$cotizaciones,/*'destinos'=>$destinos*/'m_servicios'=>$m_servicios,'paquete_precio_id'=>$pqt_id]);
    }
    public function show_step1_ser($cliente_id, $cotizacion_id,$pqt_id,$id_serv)
    {
        $cliente=Cliente::FindOrFail($cliente_id);
        $cotizaciones=Cotizacion::where('id',$cotizacion_id)->get();
        $m_servicios=M_Servicio::get();
        return view('admin.package-details1',['cliente'=>$cliente,'cotizaciones'=>$cotizaciones,/*'destinos'=>$destinos*/'m_servicios'=>$m_servicios,'paquete_precio_id'=>$pqt_id, 'id_serv'=>$id_serv]);
    }
    public function show_step1_ser_edit($cliente_id, $cotizacion_id,$pqt_id,$id_serv)
    {
        $cliente=Cliente::FindOrFail($cliente_id);
        $cotizaciones=Cotizacion::where('id',$cotizacion_id)->get();
        $m_servicios=M_Servicio::get();
        return view('admin.package-details1-edit',['cliente'=>$cliente,'cotizaciones'=>$cotizaciones,/*'destinos'=>$destinos*/'m_servicios'=>$m_servicios,'paquete_precio_id'=>$pqt_id, 'id_serv'=>$id_serv]);
    }


    public function show_step2($cotizacion_id, $paquete_precio_id,$imprimir)
    {
        $cotizaciones=Cotizacion::where('id',$cotizacion_id)->get();
        $pqt=PaqueteCotizaciones::FindOrFail($paquete_precio_id);
        $pqt->proceso_complete=1;
        $pqt->save();
        return view('admin.package-prepare',['cotizaciones'=>$cotizaciones,'paquete_precio_id'=>$paquete_precio_id,'imprimir'=>$imprimir]);
    }
    public function show_step2_edit($cotizacion_id, $paquete_precio_id,$imprimir)
    {
        return redirect()->route('cotizacion_id_show_path',$cotizacion_id);
    }
    public function step1_edit(Request $request, $id)
    {
        $id_cotizacion = $request->get('id_cotizacion');
        $id_client = $request->get('id_client');
        $id_paquete = $request->get('id_paquete');
//dd($request->get('op_services'));
        $m_servicios = M_Servicio::where('id', $request->get('op_services'))->get();
        $servicios = ItinerarioServicios::findOrFail($id);
        foreach ($m_servicios as $m_servicio){
            $servicios->nombre = $m_servicio->nombre;
            $servicios->precio = $m_servicio->precio_venta;
            $servicios->precio_grupo = $m_servicio->precio_grupo;
//            $servicios->tipoServicio = $m_servicio->tipoServicio;
//            $servicios->localizacion = $m_servicio->localizacion;
//            $servicios->grupo = $m_servicio->grupo;
//            $servicios->clase = $m_servicio->clase;
//            $servicios->salida = $m_servicio->salida;
//            $servicios->llegada = $m_servicio->llegada;
            $servicios->m_servicios_id = $m_servicio->id;
            $servicios->min_personas = $m_servicio->min_personas;
            $servicios->max_personas = $m_servicio->max_personas;
            $servicios->clase = $m_servicio->clase;
            $servicios->save();
        }
        return redirect()->route('show_step1_ser_path', [$id_client,$id_cotizacion,$id_paquete,$id]);
    }
    public function step1_edit_edit(Request $request, $id)
    {
        $id_cotizacion = $request->get('id_cotizacion');
        $id_client = $request->get('id_client');
        $id_paquete = $request->get('id_paquete');
//dd($request->get('op_services'));
        $m_servicios = M_Servicio::where('id', $request->get('op_services'))->get();
        $servicios = ItinerarioServicios::findOrFail($id);
        foreach ($m_servicios as $m_servicio){
            $servicios->nombre = $m_servicio->nombre;
            $servicios->precio = $m_servicio->precio_venta;
            $servicios->precio_grupo = $m_servicio->precio_grupo;
//            $servicios->tipoServicio = $m_servicio->tipoServicio;
//            $servicios->localizacion = $m_servicio->localizacion;
//            $servicios->grupo = $m_servicio->grupo;
//            $servicios->clase = $m_servicio->clase;
//            $servicios->salida = $m_servicio->salida;
//            $servicios->llegada = $m_servicio->llegada;
            $servicios->m_servicios_id = $m_servicio->id;
            $servicios->min_personas = $m_servicio->min_personas;
            $servicios->max_personas = $m_servicio->max_personas;
            $servicios->clase = $m_servicio->clase;
            $servicios->save();
        }
        return redirect()->route('show_step1_ser_edit_path', [$id_client,$id_cotizacion,$id_paquete,$id]);
    }
    public function delete_hotel_quotes_paso1(Request $request){
        $id = $request->input('id');
        $objeto=PrecioHotelReserva::FindOrFail($id);
        $itinerario_cotizaciones_id=$objeto->itinerario_cotizaciones_id;
        $localizacion=$objeto->localizacion;
        if($objeto->delete()){
            $ItinerarioDestinos=ItinerarioDestinos::where('itinerario_cotizaciones_id',$itinerario_cotizaciones_id)
                ->where('destino',$localizacion)->get();
            foreach($ItinerarioDestinos as $ItinerarioDestino){
                $temp=ItinerarioDestinos::FindOrFail($ItinerarioDestino->id);
                $temp->delete();
            }
            return 1;
        }
        else
            return 0;
    }
    public function escojer_pqt($id){
        $coti_pqt=PaqueteCotizaciones::FindORFail($id);

        $cotizaciones=Cotizacion::where('id',$coti_pqt->cotizaciones_id)->get();
        foreach ($cotizaciones as $cotizacion){
            foreach ($cotizacion->paquete_cotizaciones as $paquete_cotizacion){
                $coti_pqt=PaqueteCotizaciones::FindOrFail($paquete_cotizacion->id);
                $coti_pqt->estado=1;
                $coti_pqt->save();
                foreach ($paquete_cotizacion->paquete_precios as $paquete_precio){
                    $pqt_precio=PaquetePrecio::FindOrFail($paquete_precio->id);
                    $pqt_precio->estado=1;
                    $pqt_precio->save();
                }
            }
        }

        $paquetesPrecio=PaquetePrecio::where('paquete_cotizaciones_id',$id)->get();
        foreach ($paquetesPrecio as $paquetePrecio_){
            $paquetePrecio_temp=PaquetePrecio::FindOrFail($paquetePrecio_->id);
            $paquetePrecio_temp->estado=1;
            $paquetePrecio_temp->save();
        }
        $paquetesPrecio1=PaquetePrecio::where('paquete_cotizaciones_id',$id)->get();
        foreach ($paquetesPrecio1 as $paquetesPrecio1_){
            $paquetePrecio_temp1=PaquetePrecio::FindOrFail($paquetesPrecio1_->id);
            $paquetePrecio_temp1->estado=2;
            $paquetePrecio_temp1->save();
        }

        $pqts=PaqueteCotizaciones::where('id',$id)->get();
        foreach ($pqts as $pqt){
            $pqtTemp=PaqueteCotizaciones::findOrFail($pqt->id);
            $pqtTemp->estado=1;
            $pqtTemp->save();
        }
        $coti_pqt=PaqueteCotizaciones::FindORFail($id);


        $coti=Cotizacion::FindOrFail($coti_pqt->cotizaciones_id);
        $coti->estado=2;
        $coti->categorizado='N';
        $coti->fecha_venta=date("Y-m-d");
        $coti->save();
        $pqt=PaqueteCotizaciones::FindOrFail($id);
        $pqt->estado=2;
        $pqt->save();
        return redirect()->route('cotizacion_id_show_path',$coti->id);
    }
    public function add_cod_verif(Request $request)
    {
        $coti_id=$request->input('coti_id');
        $id=$request->input('id');
        $codigo=$request->input('code_'.$id);
        $servicio=ItinerarioServicios::FindOrFail($id);
        $servicio->codigo_verificacion=$codigo;
        if($servicio->save())
            return 1;
        else
            return 0;
//        return redirect()->route('book_show_path',$coti_id);
    }
    public function add_time(Request $request)
    {
        $coti_id=$request->input('coti_id');
        $id=$request->input('id');
        $codigo=$request->input('hora_'.$id);
        $servicio=ItinerarioServicios::FindOrFail($id);
        $servicio->hora_llegada=$codigo;
        if($servicio->save())
            return 1;
        else
            return 0;
//        return redirect()->route('book_show_path',$coti_id);
    }
    public function add_cod_hotel_verif(Request $request)
    {
        $coti_id=$request->input('coti_id');
        $id=$request->input('id');
        $codigo=$request->input('code_'.$id);
        $hotel=PrecioHotelReserva::FindOrFail($id);
        $hotel->codigo_verificacion=$codigo;

        if($hotel->save())
            return 1;
        else
            return 0;
//        return redirect()->route('book_show_path',$coti_id);

    }
    public function add_hora_hotel_verif(Request $request)
    {
        $coti_id=$request->input('coti_id');
        $id=$request->input('id');
        $codigo=$request->input('hora_'.$id);
        $hotel=PrecioHotelReserva::FindOrFail($id);
        $hotel->hora_llegada=$codigo;
        if($hotel->save())
            return 1;
        else
            return 0;
//        return redirect()->route('book_show_path',$coti_id);
    }
    public function clonar_plan($id,$coti_id)
    {
        $ogiginal_pqts=PaqueteCotizaciones::where('id',$id)->get();
        $new_pqt_id=0;
        foreach($ogiginal_pqts as $ogiginal_pqt){
            $plantillas= P_Paquete::where('duracion',$ogiginal_pqt->duracion)->get();
            $nro=count($plantillas);
            $numero_con_ceros = '';
            if($nro>0) {
                $diferencia = 4 - strlen(count($plantillas));

                for ($i = 0; $i < $diferencia; $i++) {
                    $numero_con_ceros .= 0;
                }

                $numero_con_ceros .= count($plantillas);
            }
            else
                $numero_con_ceros ='001';

            $plantilla_pqt= new P_Paquete();
            $plantilla_pqt->codigo='GTP'.$ogiginal_pqt->duracion.$numero_con_ceros;
            $plantilla_pqt->titulo=$plantilla_pqt->titulo;
            $plantilla_pqt->duracion=$ogiginal_pqt->duracion;
            $plantilla_pqt->precio_venta=$ogiginal_pqt->precioventa;
            $plantilla_pqt->utilidad=$ogiginal_pqt->utilidad;
            $plantilla_pqt->preciocosto=$ogiginal_pqt->preciocosto;
            $plantilla_pqt->descripcion=$ogiginal_pqt->descripcion;
            $plantilla_pqt->incluye=$ogiginal_pqt->incluye;
            $plantilla_pqt->noincluye=$ogiginal_pqt->noincluye;
            $plantilla_pqt->opcional=$ogiginal_pqt->opcional;
            $plantilla_pqt->estado=1;
            $plantilla_pqt->save();
            $new_pqt_id=$plantilla_pqt->id;
            foreach ($ogiginal_pqt->paquete_precios as $paquete_precio){
                $plantilla_ppqt=new P_PaquetePrecio();
                $plantilla_ppqt->estrellas=$paquete_precio->estrellas;
                $plantilla_ppqt->precio_s=$paquete_precio->precio_s;
                $plantilla_ppqt->personas_s=1;
                $plantilla_ppqt->precio_d=$paquete_precio->precio_d;
                $plantilla_ppqt->personas_d=1;
                $plantilla_ppqt->precio_m=$paquete_precio->precio_m;
                $plantilla_ppqt->personas_m=1;
                $plantilla_ppqt->precio_t=$paquete_precio->precio_t;
                $plantilla_ppqt->personas_t=1;
                $plantilla_ppqt->estado=1;
                $plantilla_ppqt->utilidad=$paquete_precio->utilidad;
                $plantilla_ppqt->p_paquete_id=$plantilla_pqt->id;
                $plantilla_ppqt->hotel_id=$paquete_precio->hotel_id;
                $plantilla_ppqt->utilidad_s=$paquete_precio->utilidad_s;
                $plantilla_ppqt->utilidad_d=$paquete_precio->utilidad_d;
                $plantilla_ppqt->utilidad_m=$paquete_precio->utilidad_m;
                $plantilla_ppqt->utilidad_t=$paquete_precio->utilidad_t;
                $plantilla_ppqt->utilidad_por_s=$paquete_precio->utilidad_por_s;
                $plantilla_ppqt->utilidad_por_d=$paquete_precio->utilidad_por_d;
                $plantilla_ppqt->utilidad_por_m=$paquete_precio->utilidad_por_m;
                $plantilla_ppqt->utilidad_por_t=$paquete_precio->utilidad_por_t;
                $plantilla_ppqt->save();
            }
            foreach ($ogiginal_pqt->itinerario_cotizaciones as $itinerario_cotizacion){
                $plantilla_piti=new P_Itinerario();
                $plantilla_piti->titulo=$itinerario_cotizacion->titulo;
                $plantilla_piti->descripcion=$itinerario_cotizacion->descripcion;
                $plantilla_piti->dias=$itinerario_cotizacion->dias;
                $plantilla_piti->fecha=$itinerario_cotizacion->fecha;
                $plantilla_piti->precio=$itinerario_cotizacion->precio;
                $plantilla_piti->imagen=$itinerario_cotizacion->imagen;
                $plantilla_piti->sugerencia='';
                $plantilla_piti->estado=1;
                $plantilla_piti->p_paquete_id=$plantilla_pqt->id;
                $plantilla_piti->save();
                foreach ($itinerario_cotizacion->itinerario_servicios as $itinerario_servicios){
                    $plantilla_pitis=new P_ItinerarioServicios();
                    $plantilla_pitis->nombre=$itinerario_servicios->nombre;
                    $plantilla_pitis->observacion=$itinerario_servicios->observacion;
                    $plantilla_pitis->precio=$itinerario_servicios->precio;
                    $plantilla_pitis->precio_grupo=$itinerario_servicios->precio_grupo;
                    $plantilla_pitis->min_personas=$itinerario_servicios->min_personas;
                    $plantilla_pitis->max_personas=$itinerario_servicios->max_personas;
                    $plantilla_pitis->p_itinerario_id=$plantilla_piti->id;
                    $plantilla_pitis->m_servicios_id=$itinerario_servicios->m_servicios_id;
                    $plantilla_pitis->save();
                }
                foreach ($itinerario_cotizacion->itinerario_destinos as $itinerario_destino){
                    $plantilla_pitid=new P_ItinerarioDestino();
                    $plantilla_pitid->codigo=$itinerario_destino->codigo;
                    $plantilla_pitid->destino=$itinerario_destino->destino;
                    $plantilla_pitid->region=$itinerario_destino->region;
                    $plantilla_pitid->pais=$itinerario_destino->pais;
                    $plantilla_pitid->descripcion=$itinerario_destino->descripcion;
                    $plantilla_pitid->imagen=$itinerario_destino->imagen;
                    $plantilla_pitid->estado=1;
                    $plantilla_pitid->p_itinerario_id=$plantilla_piti->id;
                    $plantilla_pitid->save();
                }
            }
        }
        return redirect()->route('generar_pantilla_id_path',[$coti_id,$new_pqt_id]);
    }
    public function clonar_plan_id($coti_id,$new_pqt_id){
        $destinos=M_Destino::get();
        $itinerarios=M_Itinerario::get();
        $m_servicios=M_Servicio::get();
        $itinerary=P_Paquete::FindOrFail($new_pqt_id);
        $hotel=Hotel::get();
        $itinerarios_d=M_ItinerarioDestino::get();
        return view('admin.show-plantilla-edit',['itinerary'=>$itinerary,'destinos'=>$destinos,'itinerarios'=>$itinerarios,'m_servicios'=>$m_servicios,'paquete_id'=>$new_pqt_id,'hotel'=>$hotel,'coti_id'=>$coti_id,'itinerarios_d'=>$itinerarios_d]);
    }
    public function poner_ceros($numero){
        $diferencia = 4 - strlen($numero);
        $numero_con_ceros='';
        for($i = 0 ; $i < $diferencia; $i++)
        {
            $numero_con_ceros .= 0;
        }

        $numero_con_ceros.= $numero;
        return $numero_con_ceros;
    }
    public function step1_edit_hotel(Request $request, $id){
        $id_cotizacion = $request->get('id_cotizacion');
        $id_client = $request->get('id_client');
        $id_paquete = $request->get('id_paquete');
        $precio_s=$request->input('precio_s');
        $precio_d=$request->input('precio_d');
        $precio_m=$request->input('precio_m');
        $precio_t=$request->input('precio_t');
        $precio_hotel_reserva=PrecioHotelReserva::FindOrFail($id);
        $precio_hotel_reserva->precio_s=$precio_s;
        $precio_hotel_reserva->precio_d=ceil($precio_d*2);
        $precio_hotel_reserva->precio_m=ceil($precio_m*2);
        $precio_hotel_reserva->precio_t=ceil($precio_t*3);
        $precio_hotel_reserva->save();
        return redirect()->route('show_step1_ser_path', [$id_client,$id_cotizacion,$id_paquete,$id]);
    }
    public function editar_daybyday($id){
        $destinations=M_Destino::get();
        $services=M_Servicio::get();
//        $itinerarios=M_Itinerario::get();
        $categorias=M_Category::get();
        $itinerario=M_Itinerario::FindOrFail($id);
//        $itinerarioArray=M_Itinerario::with('itinerario_itinerario_servicios')->where('id',$id)->get();
        $servicios=array();
//        foreach ($itinerarioArray->itinerario_itinerario_servicios as $items){
//            $servicios[]=$items->m_servicios_id;
//        }
        return view('admin.itinerary-edit',['destinations'=>$destinations,'services'=>$services,'categorias'=>$categorias,'itinerario'=>$itinerario,'servicios'=>$servicios]);
    }
    public function plan_total($id){
        $paquetes = PaqueteCotizaciones::with('paquete_precios')->get()->where('id', $id);
        foreach ($paquetes as $paquetes2){
            $paquete = PaqueteCotizaciones::with('paquete_precios')->get()->where('id', $id);
            $cotizacion = Cotizacion::where('id',$paquetes2->cotizaciones_id)->get();
            $cotizacion1='';
            foreach ($cotizacion as $cotizacion_){
                $cotizacion1=$cotizacion_;
            }
            $m_servicios=M_Servicio::get();
            return view('admin.plan-details-total',['cotizaciones'=>$cotizacion,'m_servicios'=>$m_servicios,'paquete_precio_id'=>$id]);
        }
    }
    public function show_current_paquete_edit($pqt_id)
    {
        $cotis=PaqueteCotizaciones::FindOrFail($pqt_id);
        $cotizacion_id=$cotis->cotizaciones_id;
        $cotizaciones_clientes=CotizacionesCliente::where('cotizaciones_id',$cotizacion_id)->get();
        $cliente_id=0;
//        dd($cotizaciones_clientes);

        foreach ($cotizaciones_clientes as $cli){
            $cliente_id=$cli->clientes_id;
        }
//        dd($cotizacion_id);
//        dd($pqt_id);
//        dd($cliente_id);
//      $cliente=Cliente::FindOrFail($cliente_id);
//      $cotizaciones=Cotizacion::where('id',$cotizacion_id)->get();
//      $m_servicios=M_Servicio::get();
//      return view('admin.package-details1',['cliente'=>$cliente,'cotizaciones'=>$cotizaciones,/*'destinos'=>$destinos*/'m_servicios'=>$m_servicios,'paquete_precio_id'=>$pqt_id]);


        return redirect()->route('show_step1_editar_path',[$cliente_id,$cotizacion_id,$pqt_id]);
    }
    public function show_step2_post(Request $request)
    {
        $cotizacion_id=$request->input('cotizacion_id');
        $paquete_precio_id=$request->input('paquete_precio_id');
        $imprimir=$request->input('imprimir');

        $cotizaciones=Cotizacion::where('id',$cotizacion_id)->get();
        $pqt=PaqueteCotizaciones::FindOrFail($paquete_precio_id);
        $pqt->proceso_complete=1;
        $pqt->save();

        $itis=explode('_',$request->input('itis'));
        foreach ($itis as $iti){
            $temp=ItinerarioCotizaciones::FindOrFail($iti);
            $temp->descripcion=$request->input('txt_descr_'.$iti);
            $temp->save();
        }

        return view('admin.package-prepare',['cotizaciones'=>$cotizaciones,'paquete_precio_id'=>$paquete_precio_id,'imprimir'=>$imprimir]);
    }
}