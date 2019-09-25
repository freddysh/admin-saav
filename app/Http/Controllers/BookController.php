<?php
namespace App\Http\Controllers;

use App\Web;
use App\User;
use App\Hotel;
use App\Cliente;
use App\M_Destino;
use App\Proveedor;
use Carbon\Carbon;
use App\Cotizacion;
use App\M_Category;
use App\M_Producto;
use App\M_Servicio;
use App\Liquidacion;
use App\HotelProveedor;
use App\ProveedorClases;
use App\CotizacionArchivos;
use App\ItinerarioDestinos;
use App\PrecioHotelReserva;
use App\CotizacionesCliente;
use App\ItinerarioServicios;
use App\PaqueteCotizaciones;
use Illuminate\Http\Request;
use App\Helpers\MisFunciones;
use Illuminate\Http\Response;
use App\ItinerarioCotizaciones;
use App\PrecioHotelReservaPagos;
use App\ItinerarioServicioProveedor;
use App\ItinerarioServiciosAcumPago;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(){
		
		set_time_limit(0);
		$paquete_cotizacion = PaqueteCotizaciones::where('estado', 2)->get();
		$cot_cliente = CotizacionesCliente::with('cliente')->where('estado', 1)->get();
		$cliente = Cliente::get();
		$cotizacion_cat=Cotizacion::where('estado',2)
			->whereBetween('categorizado',['C','S'])->get();
		session()->put('menu', 'reservas');
		$webs=Web::get();
		return view('admin.book.book', ['paquete_cotizacion'=>$paquete_cotizacion, 'cot_cliente'=>$cot_cliente, 'cliente'=>$cliente,'cotizacion_cat'=>$cotizacion_cat,'webs'=>$webs]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function crear_liquidacion(){
		$fecha_ini=date("Y-m-d");
		$fecha_fin=date("Y-m-d");
		$nro_ini=Liquidacion::where('ini','<=',$fecha_ini)->where('fin','>=',$fecha_ini)->count();
		$nro_fin=Liquidacion::where('fin','<=',$fecha_fin)->where('fin','>=',$fecha_fin)->count();
		$webs=Web::get();
		if($nro_ini>0 ||$nro_fin>0){
			return view('admin.book.crear-liquidacion',['mensaje'=>'1','fecha_ini'=>$fecha_ini,'fecha_fin'=>$fecha_fin,'nro_ini'=>$nro_ini,'nro_fin'=>$nro_fin,'webs'=>$webs,'hotel_proveedor_id'=>0,'id'=>0]);
		}
		else{
			$liquidaciones=Cotizacion::where('liquidacion',0)->get();
			$servicios=M_Servicio::where('grupo','ENTRANCES')->get();
			$servicios_movi=M_Servicio::where('grupo','MOVILID')->where('clase','BOLETO')->get();
			return view('admin.book.crear-liquidacion',['liquidaciones'=>$liquidaciones,'fecha_ini'=>$fecha_ini,'fecha_fin'=>$fecha_fin,'servicios'=>$servicios,'servicios_movi'=>$servicios_movi,'mensaje'=>'0','webs'=>$webs
			]);
		}

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
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
		set_time_limit(0);
		$clientes1=Cliente::get();
		$cotizacion=Cotizacion::FindOrFail($id);
		$productos=M_Producto::get();
		$proveedores=Proveedor::get();
		$hotel_proveedor=HotelProveedor::get();
		$m_servicios=M_Servicio::get();
		$pqt_coti=PaqueteCotizaciones::where('cotizaciones_id',$id)->where('estado',2)->get();
		$pqt_id=0;
		foreach ($pqt_coti as $pqt){
			$pqt_id=$pqt->id;
		}
		$ItinerarioServiciosAcumPagos=ItinerarioServiciosAcumPago::where('paquete_cotizaciones_id',$pqt_id)->get();
		$ItinerarioHotleesAcumPagos=PrecioHotelReservaPagos::where('paquete_cotizaciones_id',$pqt_id)->get();
		$cotizacion_archivos=CotizacionArchivos::where('cotizaciones_id',$id)->get();
		$usuario=User::get();
		$webs=Web::get();
		$cotizaciones_list=Cotizacion::get();
		return view('admin.book.services',['cotizacion'=>$cotizacion,'productos'=>$productos,'proveedores'=>$proveedores,'hotel_proveedor'=>$hotel_proveedor,'m_servicios'=>$m_servicios,'ItinerarioServiciosAcumPagos'=>$ItinerarioServiciosAcumPagos,'ItinerarioHotleesAcumPagos'=>$ItinerarioHotleesAcumPagos,'clientes1'=>$clientes1,'cotizacion_archivos'=>$cotizacion_archivos,'usuario'=>$usuario,'webs'=>$webs,'id'=>$id,'cotizaciones_list'=>$cotizaciones_list]);
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
	function asignar_proveedor(Request $request){
		$id_='prioridad_'.$request->input('id_');
		$fecha_pagar=$request->input('fecha_pagar');
		$prioridad=$request->input($id_)[0];
		$dat=$request->input('precio')[0];
		$dato=explode('_',$dat);
		$itinerario=ItinerarioServicios::FindOrFail($dato[1]);
		$proveedor=Proveedor::FindOrFail($dato[2]);
		// $itinerario_serv_pro=new ItinerarioServicioProveedor();
		// $itinerario_serv_pro->codigo=$proveedor->codigo;
		// $itinerario_serv_pro->grupo=$proveedor->grupo;
		// $itinerario_serv_pro->localizacion=$proveedor->localizacion;
		// $itinerario_serv_pro->nombre=$itinerario->nombre;
		// $itinerario_serv_pro->proveedor_razon_social=$proveedor->razon_social;
		// $itinerario_serv_pro->ruc=$proveedor->ruc;
		// $itinerario_serv_pro->razon_social=$proveedor->razon_social;
		// $itinerario_serv_pro->direccion=$proveedor->direccion;
		// $itinerario_serv_pro->telefono=$proveedor->telefono;
		// $itinerario_serv_pro->celular=$proveedor->celular;
		// $itinerario_serv_pro->email=$proveedor->email;
		// $itinerario_serv_pro->r_nombres=$proveedor->r_nombres;
		// $itinerario_serv_pro->r_telefono=$proveedor->r_telefono;
		// $itinerario_serv_pro->c_nombres=$proveedor->c_nombres;
		// $itinerario_serv_pro->c_telefono=$proveedor->c_telefono;
		// $itinerario_serv_pro->save();

		$itinerario1=ItinerarioServicios::FindOrFail($dato[1]);
		$itinerario1->precio_proveedor=$dato[3];
		$itinerario1->precio_c=$dato[3];
		$itinerario1->proveedor_id=$dato[2];
		// $itinerario1->proveedor_id_nuevo=$itinerario_serv_pro->id;
		$itinerario1->fecha_venc=$fecha_pagar;
		$itinerario1->prioridad=$prioridad;
		// $m_servicio=M_Servicio::find($itinerario1->m_servicios_id);

		// if(($m_servicio->grupo=='MOVILID' && $m_servicio->clase=='BOLETO') || $m_servicio->grupo=='ENTRANCES'){
			$itinerario1->liquidacion=1;
		// }

		// return $itinerario1->liquidacion;
		// return $itinerario1->save();
		if($itinerario1->save())
			return 1;
		else
			return 0;
	}
	function asignar_proveedor_hotel(Request $request){
		$id1=$request->input('id');
		$fecha_pagar=$request->input('fecha_pagar');
		$itinerario_paquete_id=$request->input('itinerario_paquete_id');
		$id_='prioridad_'.$request->input('id');
		$prioridad=$request->input($id_)[0];
		$key_dias_afectados='dias_afectados_'.$request->input('id');
		$dias_afectados=$request->input($key_dias_afectados);
		$dat=$request->input('precio');
		$dato=explode('_',$dat);
		$hotel_proveedor=HotelProveedor::FindOrFail($dato[3]);
		$id=$request->input('id');
		$precio_s_r=$hotel_proveedor->single;
		$precio_d_r=$hotel_proveedor->doble;
		$precio_m_r=$hotel_proveedor->matrimonial;
		$precio_t_r=$hotel_proveedor->triple;
		
		// agregamos el proveedor
		$hotel=PrecioHotelReserva::Find($id1);
		// preguntamos si existe un proveedor asignado
		if($hotel_proveedor->estrellas==$hotel->estrellas){
			if($hotel->personas_s>0){
				$hotel->precio_s_r=$precio_s_r;
				$hotel->precio_s_c=$precio_s_r;
			}
			if($hotel->personas_d>0){
				$hotel->precio_d_r=$precio_d_r;
				$hotel->precio_d_c=$precio_d_r;
			}
			if($hotel->personas_m>0){
				$hotel->precio_m_r=$precio_m_r;
				$hotel->precio_m_c=$precio_m_r;
			}
			if($hotel->personas_t>0){
				$hotel->precio_t_r=$precio_t_r;
				$hotel->precio_t_c=$precio_t_r;
			}
			$hotel->prioridad=$prioridad;
			$hotel->fecha_venc=$fecha_pagar;
			$hotel->proveedor_id=$hotel_proveedor->proveedor_id;
			$hotel->liquidacion=1;
			$hotel->save();
		}

		// verificamos si existe un registro con los datos del proveedor escojido
		$valor=$hotel_proveedor->proveedor_id;
		$itinerario_cotizaciones=ItinerarioCotizaciones::where('paquete_cotizaciones_id',$itinerario_paquete_id)
			->whereHas('hotel',function($query)use ($valor){
			$query->where('proveedor_id',$valor);
		})->get();
		// dd($itinerario_cotizaciones);
		$nro_hoteles_con_mismo_proveedor=$itinerario_cotizaciones->count();	
		$encontrado=false;
		$posicion=1;
		$primera_fecha=$fecha_pagar;
		foreach($itinerario_cotizaciones as $itinerario_cotizacion){
			foreach($itinerario_cotizacion->hotel as $hotel_){
				// $arreglo_hotel_proveedor_asignado[] =$hotel->id;	
				if($posicion==1){
					$primera_fecha=$hotel_->fecha_venc;
				}			
				if(!$encontrado){
					if($hotel->id==$hotel_->id){
						$encontrado=true;
					}
					$posicion++;
					// $fecha_pagar=$hotel->fecha_venc;
				}
			}
		}
		
		if($nro_hoteles_con_mismo_proveedor>1){
			if($posicion==1){
				foreach($itinerario_cotizaciones as $itinerario_cotizacion){
					foreach($itinerario_cotizacion->hotel as $hotel_){
						$temp=PrecioHotelReserva::Find($hotel_->id);
						$temp->fecha_venc=$fecha_pagar;
						$temp->save();
					}
				}
			}
			elseif($posicion>1){
				foreach($itinerario_cotizaciones as $itinerario_cotizacion){
					foreach($itinerario_cotizacion->hotel as $hotel_){
						$temp=PrecioHotelReserva::Find($hotel_->id);
						$temp->fecha_venc=$primera_fecha;
						$temp->save();
					}
				}
			}
		}
		


/*
		$valor=$hotel_proveedor->proveedor_id;
		
		// if($hotel->proveedor_id>0){
		/*	if($hotel->proveedor_id!=$hotel_proveedor->proveedor_id){
				$arreglo=ItinerarioCotizaciones::where('paquete_cotizaciones_id',$itinerario_paquete_id)
					->whereHas('hotel',function($query)use ($valor){
					$query->where('proveedor_id',$valor);
				})->pluck('id')->toArray();
				$arreglo2=ItinerarioCotizaciones::where('paquete_cotizaciones_id',$itinerario_paquete_id)
					->whereHas('hotel',function($query)use ($valor){
					$query->where('proveedor_id',$valor);
				})->get();
				if(array_search($hotel->id, $arreglo)==0){
					if($hotel_proveedor->estrellas==$hotel->estrellas){
						if($hotel->personas_s>0){
							$hotel->precio_s_r=$precio_s_r;
							$hotel->precio_s_c=$precio_s_r;
						}
						if($hotel->personas_d>0){
							$hotel->precio_d_r=$precio_d_r;
							$hotel->precio_d_c=$precio_d_r;
						}
						if($hotel->personas_m>0){
							$hotel->precio_m_r=$precio_m_r;
							$hotel->precio_m_c=$precio_m_r;
						}
						if($hotel->personas_t>0){
							$hotel->precio_t_r=$precio_t_r;
							$hotel->precio_t_c=$precio_t_r;
						}
						$hotel->prioridad=$prioridad;
						$hotel->fecha_venc=$fecha_pagar;
						$hotel->proveedor_id=$hotel_proveedor->proveedor_id;
						$hotel->liquidacion=1;
						$hotel->save();
					}
					// buscamos la fecvha de pago segun dia dia que se lleva
					$itinerario=ItinerarioCotizaciones::find($hotel->itinerario_cotizaciones_id);
					$fecha_uso=$itinerario->fecha;
					$fecha= Carbon::createFromFormat('Y-m-d',$fecha_uso);
					$proveedor=Proveedor::find($hotel_proveedor->proveedor_id);
					$str_fecha='aaaa-mm-dd';
					if(strlen($proveedor->plazo)>0 && strlen($proveedor->desci)>0) {
						if ($proveedor->desci == 'antes')
							$fecha->subDays($proveedor->plazo);
						else
							$fecha->addDays($proveedor->plazo);

						$str_fecha= $fecha->toDateString();
					}

					foreach($arreglo2 as $arreglo2_){
						$hotel_=PrecioHotelReserva::Find($arreglo2_->id);
						$hotel_->fecha_venc=$str_fecha;
						$hotel_->save();
					}
					
				}
			}
		// }
		// else{*/
			// if($hotel_proveedor->estrellas==$hotel->estrellas){
			// 	if($hotel->personas_s>0){
			// 		$hotel->precio_s_r=$precio_s_r;
			// 		$hotel->precio_s_c=$precio_s_r;
			// 	}
			// 	if($hotel->personas_d>0){
			// 		$hotel->precio_d_r=$precio_d_r;
			// 		$hotel->precio_d_c=$precio_d_r;
			// 	}
			// 	if($hotel->personas_m>0){
			// 		$hotel->precio_m_r=$precio_m_r;
			// 		$hotel->precio_m_c=$precio_m_r;
			// 	}
			// 	if($hotel->personas_t>0){
			// 		$hotel->precio_t_r=$precio_t_r;
			// 		$hotel->precio_t_c=$precio_t_r;
			// 	}
			// 	$hotel->prioridad=$prioridad;
			// 	$hotel->fecha_venc=$fecha_pagar;
			// 	$hotel->proveedor_id=$hotel_proveedor->proveedor_id;
			// 	$hotel->liquidacion=1;
			// 	$hotel->save();
			// }

			// RECORREMOS TODAS LAS RESERVAS QUE TIENE EL MISMO HOTEL

		// verificamos si existe un registro con os datos del proveedor escojido
		
		/*}*/
		
		return redirect()->back();
}
	function asignar_proveedor_costo(Request $request){
		$txt_costo_edit=$request->input('txt_costo_edit');
		$txt_justificacion=$request->input('txt_justificacion');
		$id=$request->input('id');
		$iti=ItinerarioServicios::FindOrFail($id);
		$iti->precio_proveedor=$txt_costo_edit;
		$iti->justificacion_precio_proveedor=$txt_justificacion;
		if($iti->save())
			return 1;
		else
			return 0;
	}
	public function confirmar(Request $request){
		$cotizacion_id=$request->input('cotizacion_id');
		$coti=Cotizacion::FindOrFail($cotizacion_id);
		$coti->confirmado_r='ok';
		$coti->save();
		$cotizacion=Cotizacion::FindOrFail($cotizacion_id);
		$productos=M_Producto::get();
		$proveedores=Proveedor::get();
		$hotel_proveedor=HotelProveedor::get();
		$m_servicios=M_Servicio::get();
//        dd($cotizacion_id);
		//-- guardaremos los servicios por grupo y proveedor siempre que se haya terminado de guardar todo
		$paquete_cotizacion=PaqueteCotizaciones::with('itinerario_cotizaciones')->where('cotizaciones_id',$cotizacion_id)->where('estado',2)->get();
//        dd($paquete_cotizacion);
		$array_servicios=[];
		$array_servicios_grupo=[];
		$array_servicios_fecha=[];
		$array_hotel=[];
		$array_hotel_fecha=[];

//        dd('hola');
		foreach ($paquete_cotizacion as $pqt){
			foreach ($pqt->itinerario_cotizaciones as $itinerario_cotizaciones){
				foreach ($itinerario_cotizaciones->itinerario_servicios as $itinerario_servicios){
					if($itinerario_servicios->grupo!='ENTRANCES'){
						if($itinerario_servicios->grupo=='MOVILID'){
							if($itinerario_servicios->clase!='BOLETO'){
								$ids=$itinerario_servicios->grupo.'_'.$itinerario_servicios->proveedor_id;
								if(!array_key_exists($ids,$array_servicios)) {
									if ($itinerario_servicios->precio_grupo == 1) {
										$array_servicios[$ids] = $itinerario_servicios->precio_proveedor;
										$array_servicios_grupo[$ids]=$itinerario_servicios->grupo;
									}
									elseif ($itinerario_servicios->precio_grupo == 0) {
										$array_servicios[$ids] = $itinerario_servicios->precio_proveedor;/* * $coti->nropersonas;*/
										$array_servicios_grupo[$ids]=$itinerario_servicios->grupo;
									}
									$array_servicios_fecha[$ids]=$itinerario_cotizaciones->fecha;
								}
								else{
									if ($itinerario_servicios->precio_grupo == 1) {
										$array_servicios[$ids] += $itinerario_servicios->precio_proveedor;
										$array_servicios_grupo[$ids]=$itinerario_servicios->grupo;
									}
									elseif ($itinerario_servicios->precio_grupo == 0) {
										$array_servicios[$ids] += $itinerario_servicios->precio_proveedor;/* * $coti->nropersonas;*/
										$array_servicios_grupo[$ids]=$itinerario_servicios->grupo;
									}
								}
							}
						}
						else{
							$ids=$itinerario_servicios->grupo.'_'.$itinerario_servicios->proveedor_id;
							if(!array_key_exists($ids,$array_servicios)) {
								if ($itinerario_servicios->precio_grupo == 1) {
									$array_servicios[$ids] = $itinerario_servicios->precio_proveedor;
									$array_servicios_grupo[$ids]=$itinerario_servicios->grupo;
								}
								elseif ($itinerario_servicios->precio_grupo == 0) {
									$array_servicios[$ids] = $itinerario_servicios->precio_proveedor;/* * $coti->nropersonas;*/
									$array_servicios_grupo[$ids]=$itinerario_servicios->grupo;
								}
								$array_servicios_fecha[$ids]=$itinerario_cotizaciones->fecha;
							}
							else{
								if ($itinerario_servicios->precio_grupo == 1) {
									$array_servicios[$ids] += $itinerario_servicios->precio_proveedor;
									$array_servicios_grupo[$ids]=$itinerario_servicios->grupo;
								}
								elseif ($itinerario_servicios->precio_grupo == 0) {
									$array_servicios[$ids] += $itinerario_servicios->precio_proveedor; /* * $coti->nropersonas;*/
									$array_servicios_grupo[$ids]=$itinerario_servicios->grupo;
								}
							}
						}
					}
					else{
						$iti_temp=ItinerarioServicios::findOrfail($itinerario_servicios->id);
						$iti_temp->fecha_uso=$itinerario_cotizaciones->fecha;
						$fecha= Carbon::createFromFormat('Y-m-d',$itinerario_cotizaciones->fecha);
						if(count((array)$itinerario_servicios->proveedor_id)>0){
							$proveedor=Proveedor::FindOrFail($itinerario_servicios->proveedor_id);
							if($proveedor->desci='antes')
								$fecha->subDays($proveedor->plazo);
							else
								$fecha->addDays($proveedor->plazo);
						}
						$iti_temp->fecha_venc=$fecha->toDateString();
						// $iti_temp->save();
					}
				}
				$sutbTotal=0;
				foreach ($itinerario_cotizaciones->hotel as $hotel){
					if($hotel->personas_s>0)
						$sutbTotal+=$hotel->personas_s*$hotel->precio_s_r;
					if($hotel->personas_d>0)
						$sutbTotal+=$hotel->personas_d*$hotel->precio_d_r;
					if($hotel->personas_m>0)
						$sutbTotal+=$hotel->personas_m*$hotel->precio_m_r;
					if($hotel->personas_t>0)
						$sutbTotal+=$hotel->personas_t*$hotel->precio_t_r;
					if(!array_key_exists($hotel->proveedor_id,$array_hotel)) {
						$array_hotel[$hotel->proveedor_id] = $sutbTotal;
						$array_hotel_fecha[$hotel->proveedor_id]=$itinerario_cotizaciones->fecha;
					}
					else{
						$array_hotel[$hotel->proveedor_id] += $sutbTotal;
					}
				}
			}
		}
		$pqt_coti=0;
		foreach ($paquete_cotizacion as $paquete_cotizacion_){
			$pqt_coti=$paquete_cotizacion_->id;
		}
		//-- agregarmos para itinerario_servicios_acum_pago
		$id='';

		foreach ($array_servicios as $key => $array_servicio) {
			$proveedor_id = explode('_', $key);
			if($proveedor_id[1]> 0) {
				$itinerario_servicios_acum_pago_=ItinerarioServiciosAcumPago::where('proveedor_id',$proveedor_id[1])
					->where('paquete_cotizaciones_id',$pqt_coti)
					->where('grupo',$array_servicios_grupo[$key])
					->whereIn('estado',[-2,-1])->get();
//                dd($itinerario_servicios_acum_pago_);
				if(count((array)$itinerario_servicios_acum_pago_)>0) {
					foreach ($itinerario_servicios_acum_pago_->take(1) as $itinerario_servicios_acum_pago_0){
						$itinerario_servicios_acum_pago_1=ItinerarioServiciosAcumPago::findOrFail($itinerario_servicios_acum_pago_0->id);
						$itinerario_servicios_acum_pago_1->a_cuenta = $array_servicio;
						$itinerario_servicios_acum_pago_1->save();
					}
				}
				else{
					$proveedor=Proveedor::FindOrFail($proveedor_id[1]);

					$fecha= Carbon::createFromFormat('Y-m-d',$array_servicios_fecha[$key]);
					if(count((array)$proveedor)>0) {
						if ($proveedor->desci = 'antes')
							$fecha->subDays($proveedor->plazo);
						else
							$fecha->addDays($proveedor->plazo);
					}
					$itinerario_servicios_acum_pago=new ItinerarioServiciosAcumPago();
					$itinerario_servicios_acum_pago->a_cuenta=$array_servicio;
					$itinerario_servicios_acum_pago->estado=-2;
					$itinerario_servicios_acum_pago->proveedor_id=$proveedor_id[1];
					$itinerario_servicios_acum_pago->paquete_cotizaciones_id=$pqt_coti;
					$itinerario_servicios_acum_pago->grupo=$array_servicios_grupo[$key];
					$itinerario_servicios_acum_pago->fecha_servicio=$array_servicios_fecha[$key];
					$itinerario_servicios_acum_pago->fecha_a_pagar=$fecha;
					$itinerario_servicios_acum_pago->save();
				}
			}
		}
		//-- agregarmos para itinerario_servicios_acum_pago
		foreach ($array_hotel as $key => $array_hotel_){
			if($key>0){
				$precio_hotel_reserv_=PrecioHotelReservaPagos::where('proveedor_id',$key)
					->where('paquete_cotizaciones_id',$pqt_coti)
					->whereIn('estado',[-2,-1])->get();
				if(count((array)$precio_hotel_reserv_)>0){
					foreach ($precio_hotel_reserv_ as $precio_hotel_reserv_0) {
						$precio_hotel_reserv_1 = PrecioHotelReservaPagos::FindOrFail($precio_hotel_reserv_0->id);
						$precio_hotel_reserv_1->a_cuenta = $array_hotel_;
						$precio_hotel_reserv_1->save();
					}
				}
				else
				{

					$proveedor=Proveedor::FindOrFail($key);
					$fecha= Carbon::createFromFormat('Y-m-d',$array_hotel_fecha[$key]);
					if(count((array)$proveedor)>0) {
						if ($proveedor->desci = 'antes')
							$fecha->subDays($proveedor->plazo);
						else
							$fecha->addDays($proveedor->plazo);
					}
					$precio_hotel_reserv=new PrecioHotelReservaPagos();
					$precio_hotel_reserv->a_cuenta=$array_hotel_;
					$precio_hotel_reserv->estado=-2;
					$precio_hotel_reserv->proveedor_id=$key;
					$precio_hotel_reserv->paquete_cotizaciones_id=$pqt_coti;
					$precio_hotel_reserv->grupo='HOTELS';
					$precio_hotel_reserv->fecha_servicio=$array_hotel_fecha[$key];
					$precio_hotel_reserv->fecha_a_pagar=$fecha;
					$precio_hotel_reserv->save();
				}
			}
		}
		return redirect()->route('book_show_path',$cotizacion_id);
	}
	function crear_liquidacion_storage(Request $request){
		$fecha_ini=$request->input('fecha_ini');
		$fecha_fin=$request->input('fecha_fin');
		$nro_ini=Liquidacion::where('ini','<=',$fecha_ini)->where('fin','>=',$fecha_ini)->count();
		$nro_fin=Liquidacion::where('fin','<=',$fecha_fin)->where('fin','>=',$fecha_fin)->count();
		$webs=Web::get();
		if($nro_ini>0 ||$nro_fin>0){
			return view('admin.book.crear-liquidacion',['mensaje'=>'1','fecha_ini'=>$fecha_ini,'fecha_fin'=>$fecha_fin,'nro_ini'=>$nro_ini,'nro_fin'=>$nro_fin,'webs'=>$webs,'hotel_proveedor_id'=>0,'id'=>0,'fecha_ini'=>date("Y-m-d"),'fecha_fin'=>date("Y-m-d")]);
		}
		else{
			$liquidaciones=Cotizacion::get();
			$servicios=M_Servicio::where('grupo','ENTRANCES')->get();
			$servicios_movi=M_Servicio::where('grupo','MOVILID')->where('clase','BOLETO')->get();
			return view('admin.book.crear-liquidacion',['liquidaciones'=>$liquidaciones,'fecha_ini'=>$fecha_ini,'fecha_fin'=>$fecha_fin,'servicios'=>$servicios,'servicios_movi'=>$servicios_movi,'mensaje'=>'0','webs'=>$webs]);
		}
	}
	function guardar_liquidacion_storage(Request $request){
		set_time_limit(0);
		$cotis=$request->input('cotis');
		$cotizaciones_ids=explode('_',$cotis);
		if(count($cotizaciones_ids)>0) {
			//-- se guardara el rango de fechas donde se envia la liquidacion semanal
			$fecha_ini = $request->input('desde');
			$fecha_fin = $request->input('hasta');
			$liquidaciones = new Liquidacion();
			$liquidaciones->ini = $fecha_ini;
			$liquidaciones->fin = $fecha_fin;
			$liquidaciones->user_id = auth()->guard('admin')->user()->id;
			$liquidaciones->estado = 1;
			$liquidaciones->save();
			//-- se cmbiara como estado =1 los servicios(entrances,tikects) para ser liquidados por contablidad
			$servicio_liquidacion = $request->input('servicio_liquidacion');
			foreach ($servicio_liquidacion as $servicio_liquidacion_) {
				$iti_servicio = ItinerarioServicios::findOrfail($servicio_liquidacion_);
				$iti_servicio->liquidacion = 1;
				$iti_servicio->save();
			}
			foreach ($cotizaciones_ids as $cotizaciones_id) {
				$cotizacion_temp = Cotizacion::findOrfail($cotizaciones_id);
				$cotizacion_temp->liquidacion = 1;
				$cotizacion_temp->save();
			}
			return redirect()->route('liquidaciones_hechas_path');
		}
	}
	function liquidaciones(){
		$cotizaciones=Cotizacion::where('liquidacion',1)->get();
		$servicios=M_Servicio::where('grupo','ENTRANCES')->get();
		$servicios_movi=M_Servicio::where('grupo','MOVILID')->where('clase','BOLETO')->get();
		$liquidaciones=Liquidacion::where('estado',1)->get();
		$users=User::get();
		$webs=Web::get();
		return view('admin.book.liquidaciones',['cotizaciones'=>$cotizaciones,'servicios'=>$servicios,'servicios_movi'=>$servicios_movi,'liquidaciones'=>$liquidaciones,'users'=>$users,'webs'=>$webs]);
	}
	function ver_liquidaciones($fecha_ini,$fecha_fin){
		$liquidaciones=Cotizacion::get();
		$servicios=M_Servicio::where('grupo','ENTRANCES')->get();
		$servicios_movi=M_Servicio::where('grupo','MOVILID')->where('clase','BOLETO')->get();
		$webs=Web::get();
		return view('admin.book.ver-liquidacion',['liquidaciones'=>$liquidaciones,'fecha_ini'=>$fecha_ini,'fecha_fin'=>$fecha_fin,'servicios'=>$servicios,'servicios_movi'=>$servicios_movi,'webs'=>$webs]);
	}
	function nuevo_servicio_uno($cotizaciones_id,$itinerartio_cotis_id,$dia){
			$destinations=M_Destino::get();
			$services=M_Servicio::get();
			$categorias=M_Category::get();
			$pro_clase=ProveedorClases::get();
			$servicios=array();
			$webs=Web::get();
			return view('admin.book.agregar_servicio_dia_uno',['destinations'=>$destinations,'services'=>$services,'categorias'=>$categorias,'itinerartio_cotis_id'=>$itinerartio_cotis_id,'servicios'=>$servicios,'dia'=>$dia,'cotizaciones_id'=>$cotizaciones_id,'pro_clase'=>$pro_clase,'webs'=>$webs]);
	}
	public function nuevo_servicio_add(Request $request){
		$origen=$request->input('origen');
		$cotizaciones_id=$request->input('cotizaciones_id');

		$txt_id=$request->input('itinerario_id');
		$destinos=$request->input('destinos');
		$servicios=$request->input('servicios'.$txt_id);
		
		foreach ($destinos as $destino){
			$dato=explode('_',$destino);
			$valorBuscado=ItinerarioDestinos::where('destino',$dato[1])->where('itinerario_cotizaciones_id',$dato[2])->count('id');
			if($valorBuscado==0){
				$m_Destino=M_Destino::FindOrFail($dato[0]);
				$nuevo_iti_destino=new ItinerarioDestinos();
				$nuevo_iti_destino->codigo=$m_Destino->codigo;
				$nuevo_iti_destino->destino=$m_Destino->destino;
				$nuevo_iti_destino->region=$m_Destino->region;
				$nuevo_iti_destino->departamento=$m_Destino->departamento;
				$nuevo_iti_destino->pais=$m_Destino->pais;
				$nuevo_iti_destino->descripcion=$m_Destino->descripcion;
				$nuevo_iti_destino->imagen=$m_Destino->imagen;
				$nuevo_iti_destino->estado=$m_Destino->estado;
				$nuevo_iti_destino->itinerario_cotizaciones_id=$dato[2];
				$nuevo_iti_destino->save();
			}
		}
		foreach ($servicios as $servicio){
			$dato=explode('_',$servicio);
			$m_servicio=M_Servicio::FindOrFail($dato[2]);
			$p_servicio=new ItinerarioServicios();
			$p_servicio->nombre=$m_servicio->nombre;
			$p_servicio->observacion='';
			$p_servicio->precio=$m_servicio->precio_venta;
			$p_servicio->itinerario_cotizaciones_id=$txt_id;
			$p_servicio->user_id=auth()->guard('admin')->user()->id;
			$p_servicio->precio_grupo=$m_servicio->precio_grupo;
			$p_servicio->min_personas=$m_servicio->min_personas;
			$p_servicio->max_personas=$m_servicio->max_personas;
			$p_servicio->precio_c=0;
			$p_servicio->estado=1;
			$p_servicio->salida=$m_servicio->salida;
			$p_servicio->llegada=$m_servicio->llegada;
			$p_servicio->clase=$m_servicio->clase;
			$p_servicio->m_servicios_id=$m_servicio->id;
			$p_servicio->justificacion_precio_proveedor='';
			$p_servicio->grupo=$m_servicio->grupo;
			$p_servicio->localizacion=$m_servicio->localizacion;
			$p_servicio->tipoServicio=$m_servicio->tipoServicio;
			$p_servicio->save();
		}
		
		if($origen=='reservas')
			return redirect()->route('book_show_path',$cotizaciones_id);
		elseif($origen=='ventas') {
			$itineario = ItinerarioCotizaciones::Find($txt_id);

			$clientes = CotizacionesCliente::where('cotizaciones_id', $cotizaciones_id)->where('estado', '1')->get();
			$cliente = 0;
			foreach ($clientes as $cliente_) {
				$cliente = $cliente_->clientes_id;
			}
			return redirect()->route('show_step1_path', [$cliente, $cotizaciones_id, $itineario->paquete_cotizaciones_id]);
		}
	}
	public function nuevo_servicio_add_uno(Request $request){
		$cotizaciones_id=$request->input('cotizaciones_id');
		$txt_id=$request->input('itinerario_id');		
		$servicios_reservas=$request->input('servicios');
		foreach ($servicios_reservas as $servicio){
			$dato=explode('_',$servicio);
			$m_servicio=M_Servicio::FindOrFail($dato[2]);
			$p_servicio=new ItinerarioServicios();
			$p_servicio->nombre=$m_servicio->nombre;
			$p_servicio->observacion='';
			$p_servicio->precio=$m_servicio->precio_venta;
			$p_servicio->itinerario_cotizaciones_id=$txt_id;
			$p_servicio->user_id=auth()->guard('admin')->user()->id;
			$p_servicio->precio_grupo=$m_servicio->precio_grupo;
			$p_servicio->min_personas=$m_servicio->min_personas;
			$p_servicio->max_personas=$m_servicio->max_personas;
			$p_servicio->precio_c=0;
			$p_servicio->estado=1;
			$p_servicio->salida=$m_servicio->salida;
			$p_servicio->llegada=$m_servicio->llegada;
			$p_servicio->clase=$m_servicio->clase;
			$p_servicio->m_servicios_id=$m_servicio->id;
			$p_servicio->justificacion_precio_proveedor='';
			$p_servicio->grupo=$m_servicio->grupo;
			$p_servicio->localizacion=$m_servicio->localizacion;
			$p_servicio->tipoServicio=$m_servicio->tipoServicio;
			$p_servicio->save();
		}
		
		return redirect()->route('book_show_path',$cotizaciones_id);
		
	}
	public function eliminar_servicio_reservas(Request $request)
	{
		$id = $request->input('id');
		$servicio =ItinerarioServicios::FindOrFail($id);
		if ($servicio->delete())
			return 1;
		else
			return 0;
	}
	function asignar_proveedor_observacion(Request $request){
		$txt_observacion_hoja_ruta=$request->input('txt_observacion_hoja_ruta');
		$id=$request->input('id');
		$iti=ItinerarioServicios::FindOrFail($id);
		$iti->observacion_hoja_ruta=$txt_observacion_hoja_ruta;
		if($iti->save())
			return 1;
		else
			return 0;
	}
	public function envio_servicio_reservas(Request $request)
	{
		$id = $request->input('id');
		$estado = $request->input('estado');
		$servicio =ItinerarioServicios::FindOrFail($id);
		$servicio->confimacion_envio=$estado;
		if ($servicio->save())
			return 1;
		else
			return 0;
	}
	public function change_service(Request $request)
	{
		$pos = $request->input('pos');
		$impu= $request->input('impu');
		$id_antiguo= $request->input('id_antiguo');
		$id_nuevo= $request->input($impu);
		$p_itinerario_id=$request->input('p_itinerario_id');
		$cotizacion_id=$request->input('cotizacion_id');


		$new_id=0;

		foreach ($id_nuevo as $id_nuevo_){
			$new_id=$id_nuevo_;
		}
//        dd($new_id);
		$servicio_antiguo =ItinerarioServicios::FindOrFail($id_antiguo);
		$servicio_antiguo->delete();
		$servicios=M_Servicio::FindOrFail($new_id);
//
		$p_servicio=new ItinerarioServicios();
		$p_servicio->nombre=$servicios->nombre;
		$p_servicio->observacion='';
		$p_servicio->precio=$servicios->precio_venta;
		$p_servicio->itinerario_cotizaciones_id=$p_itinerario_id;
		$p_servicio->user_id=auth()->guard('admin')->user()->id;
		$p_servicio->precio_grupo=$servicios->precio_grupo;
		$p_servicio->min_personas=$servicios->min_personas;
		$p_servicio->max_personas=$servicios->max_personas;
		$p_servicio->precio_c=0;
		$p_servicio->estado=1;
		$p_servicio->salida=$servicios->salida;
		$p_servicio->llegada=$servicios->llegada;
		$p_servicio->grupo=$servicios->grupo;
		$p_servicio->tipoServicio=$servicios->tipoServicio;
		$p_servicio->localizacion=$servicios->localizacion;
		$p_servicio->clase=$servicios->clase;
		$p_servicio->m_servicios_id=$servicios->id;
		$p_servicio->pos=$pos;
		$p_servicio->save();
		return redirect()->route('book_show_path',$cotizacion_id);

	}
	function nuevo_servicio_ventas($cotizaciones_id,$itinerartio_cotis_id,$dia){
		$destinations=M_Destino::get();
		$services=M_Servicio::get();
		$categorias=M_Category::get();
		$servicios=array();
		return view('admin.book.agregar_servicio_dia_ventas',['destinations'=>$destinations,'services'=>$services,'categorias'=>$categorias,'itinerartio_cotis_id'=>$itinerartio_cotis_id,'servicios'=>$servicios,'dia'=>$dia,'cotizaciones_id'=>$cotizaciones_id]);

	}
	function asignar_proveedor_costo_hotel(Request $request){
		$id=$request->input('id');
		$hotel=PrecioHotelReserva::Find($id);
		if($hotel->personas_s>0){
			$hotel->precio_s_r=$request->input('txt_costo_edit_s');
			$hotel->precio_s_c=$request->input('txt_costo_edit_s');
		}
		if($hotel->personas_d>0){
			$hotel->precio_d_r=$request->input('txt_costo_edit_d');			
			$hotel->precio_d_c=$request->input('txt_costo_edit_d');
		}
		if($hotel->personas_m>0){
			$hotel->precio_m_r=$request->input('txt_costo_edit_m');			
			$hotel->precio_m_c=$request->input('txt_costo_edit_m');
		}
		if($hotel->personas_t>0){
			$hotel->precio_t_r=$request->input('txt_costo_edit_t');			
			$hotel->precio_t_c=$request->input('txt_costo_edit_t');
		}

		if($hotel->save())
			return 1;
		else
			return 0;
	}
	function guardar_datos(Request $request){
		$cotizacion_id=$request->input('cotizacion_id');
		$id=$request->input('id');
		$aerolinea=$request->input('txt_aereolinea');
		$nro_vuelo=$request->input('txt_nro_vuelo');
		$servicio= ItinerarioServicios::Find($id);
		$servicio->aerolinea=$aerolinea;
		$servicio->nro_vuelo=$nro_vuelo;
		$servicio->save();
		return redirect()->route('book_show_path',$cotizacion_id);
	}

	public function confirmar_servicio_reservas(Request $request)
	{
		$id = $request->input('id');
		$servicio =ItinerarioServicios::FindOrFail($id);
		$cadena='';
		if ($servicio->primera_confirmada==0) {
			$servicio->primera_confirmada = 1;
			$cadena='1_';
		}else {
			$servicio->primera_confirmada = 0;
			$cadena='0_';
		}
		if($servicio->save()){
			$cadena.='1';
		}
		else{
			$cadena.='0';
		}
		return $cadena;
	}
	public function confirmar_hotel_reservas(Request $request)
	{
		$id = $request->input('id');
		$hotel =PrecioHotelReserva::FindOrFail($id);
		$cadena='';
		if ($hotel->primera_confirmada==0) {
			$hotel->primera_confirmada = 1;
			$cadena='1_';
		}else {
			$hotel->primera_confirmada = 0;
			$cadena='0_';
		}
		if($hotel->save()){
			$cadena.='1';
		}
		else{
			$cadena.='0';
		}
		return $cadena;
	}
	public function eliminar_hotel_reservas(Request $request)
	{
		$id = $request->input('id');
		$hotel =PrecioHotelReserva::FindOrFail($id);
		if($hotel->delete())
			return 1;
		else
			return 0;
	}
	public function guardar_archivos(Request $request){
		$txt_cotizacion_id=strtoupper($request->input('id'));
		$txt_imagen=$request->file('txt_archivo');
		$archivos=new CotizacionArchivos();
		$archivos->cotizaciones_id=$txt_cotizacion_id;
		$archivos->save();
		if($txt_imagen){
			$data=Carbon::now()->subHour(5);
			$dia=$data->day;
			$mes=$data->month;
			$anio=$data->year;
			$hora=$data->hour;
			$minuto=$data->minute;
			$segundo=$data->second;

			if($dia<=9)
				$dia='0'.$dia;
			if($mes<=9)
				$mes='0'.$mes;
			if($hora<=9)
				$hora='0'.$hora;
			if($minuto<=9)
				$minuto='0'.$minuto;
			if($segundo<=9)
				$segundo='0'.$segundo;


//            $data->addHour(5);
			$filename ='archivo-'.$archivos->id.'.'.$txt_imagen->getClientOriginalExtension();
			$archivos->imagen=$filename;
			$archivos->extension=$txt_imagen->getClientOriginalExtension();
			$archivos->nombre=$txt_imagen->getClientOriginalName();
			$archivos->fecha_subida=$dia.'-'.$mes.'-'.$anio;
			$archivos->hora_subida=$hora.':'.$minuto.':'.$segundo;
			$archivos->save();
			Storage::disk('cotizacion_archivos')->put($filename,  File::get($txt_imagen));
		}
		return redirect()->back();
//        return redirect()->route('book_show_path',$txt_cotizacion_id);
	}

	public function getCotiArchivosImageName($filename){
		$file = Storage::disk('cotizacion_archivos')->get($filename);
		return new Response($file, 200);
	}
	public function downloadCotiArchivos($archivo){
		$ruta="../storage/app/public/cotizacion_archivos/".$archivo;
		return response()->download($ruta);
	}
	public function eliminar_archivo(Request $request){
		$archivo_id=$request->input('id');
		$archivo=CotizacionArchivos::find($archivo_id);
		if($archivo->delete()){
			Storage::disk('cotizacion_archivos')->delete($archivo->imagen);
			return 1;
		}
		else{
			return 0;
		}
	}
	public function guardar_notas(Request $request){
		$id=$request->input('id');
		$nota=$request->input('txt_nota');
		$iti=ItinerarioCotizaciones::find($id);
		$iti->notas=$nota;
		if($iti->save()){
			return 1;
		}
		else{
			return 0;
		}
	}
	public function anular_servicio_reservas(Request $request)
	{
		$id = $request->input('id');
		$estado = $request->input('estado');
		// dd($estado);
		$servicio =ItinerarioServicios::FindOrFail($id);
		$servicio->anulado=$estado;
		if ($servicio->save())
			return 1;
		else
			return 0;
	}
	public function anular_hotel_reservas(Request $request)
	{
		$id = $request->input('id');
		$estado = $request->input('estado');
		$hotel =PrecioHotelReserva::FindOrFail($id);
		$hotel->anulado=$estado;
		if($hotel->save())
			return 1;
		else
			return 0;
	}
	public function list_paquetes(Request $request)
	{
		$valor1 =strtoupper(trim($request->input('valor1')));
		$valor2 =strtoupper(trim($request->input('valor2')));
		$campo = $request->input('campo');
		$columna= $request->input('columna');
		$cotizacion_cat =null;
		if($campo=='CODIGO/NOMBRE'){
			if(trim($valor1)==''){
				$cotizacion_cat =Cotizacion::get();
			}
			elseif(trim($valor1)!=''){
				// $cotizacion_cat =Cotizacion::whereHas('cotizaciones_cliente',function($query)use ($valor1){
				// 	$query->where('estado','1');
				// 	$query->whereHas('cliente',function ($query)use ($valor1){
				// 		$query->where('nombres','like','%'.$valor1.'%')->orwhere('apellidos','like','%'.$valor1.'%');
				// 	});
				// })
				// 	->orWhere('codigo','like','%'.$valor1.'%')->get();
				$cotizacion_cat =Cotizacion::where('nombre_pax','like','%'.$valor1.'%')
					->orWhere('codigo','like','%'.$valor1.'%')->get();
			}
			// return dd($cotizacion_cat);
			return view('admin.book.list-paquetes-todos',compact('cotizacion_cat','columna'));
		}
		elseif($campo=='CODIGO'){
			if(trim($valor1)==''){
				$cotizacion_cat =Cotizacion::get();
			}
			elseif(trim($valor1)!=''){
				$cotizacion_cat =Cotizacion::where('codigo', 'like', '%'.$valor1.'%')->get();
			}
			return view('admin.book.list-paquetes', compact('cotizacion_cat', 'columna'));
		}
		elseif($campo=='NOMBRE'){
			if(trim($valor1)==''){
				$cotizacion_cat =Cotizacion::get();
			}
			elseif(trim($valor1)!=''){
				$cotizacion_cat =Cotizacion::where('nombre_pax', 'like', '%'.$valor1.'%')->get();
				// $cotizacion_cat =Cotizacion::whereHas('cotizaciones_cliente',function($query)use ($valor1){
				// 	$query->where('estado','1');
				// 	$query->whereHas('cliente',function ($query)use ($valor1){
				// 		$query->where('nombres','like','%'.$valor1.'%')->orwhere('apellidos','like','%'.$valor1.'%');
				// 	});
				// })->get();
			}
			return view('admin.book.list-paquetes',compact('cotizacion_cat','columna'));
		}
		elseif($campo=='FECHAS'){
			$cotizacion_cat =Cotizacion::whereBetween('fecha', [$valor1, $valor2])->get();
			return view('admin.book.list-paquetes', compact('cotizacion_cat', 'columna'));
		}
		elseif( $campo == 'ANIO-MES' ) {
			$cotizacion_cat =Cotizacion::whereYear('fecha', $valor1)->whereMonth('fecha', $valor2)->get();
			return view('admin.book.list-paquetes', compact('cotizacion_cat', 'columna'));
		}
	}
	public function list_paquetes_codigo(Request $request)
	{
//        return 'hola';
		$codigo = $request->input('codigo');
		$cotizacion_cat =Cotizacion::where('codigo', $codigo)->get();
//        dd($anio);
		return view('admin.book.list-paquetes', compact('cotizacion_cat'));
	}
	public function situacion_servicios(){
		$webs=Web::get();
		return view('admin.book.situacion-pqt',['webs'=>$webs]);
	}
	public function situacion_servicios_hoteles(Request $request)
	{
		set_time_limit(0);
		$opcion = $request->input('opcion');
		$dato1 = $request->input('dato1');//-- nombre, codigo, fecha-desde
		$dato2 = $request->input('dato2');//-- fecha-hasta
//        dd($dato1.'_'.$dato2);
		$proveedores=Proveedor::get();
		$array_cotizaciones_hotel = array();
		$array_cotizaciones_tours = array();
		$array_cotizaciones_movilid = array();
		$array_cotizaciones_represent = array();
		$array_cotizaciones_entrances = array();
		$array_cotizaciones_food = array();
		$array_cotizaciones_trains = array();
		$array_cotizaciones_flights = array();
		$array_cotizaciones_others = array();
		$liquidaciones=Liquidacion::get();
		if($opcion=='codigo'||$opcion=='nombre'){
			if($opcion=='codigo'){
				$cotizaciones = Cotizacion::where('codigo', $dato1)->get();
			}
			elseif($opcion=='nombre'){
				$cotizaciones = Cotizacion::where('nombre_pax', $dato1)->get();
				// $cotizaciones=Cotizacion::whereHas('cotizaciones_cliente',function($query)use($dato1){
                //     $query->whereHas('cliente',function($query)use($dato1){
                //         $query->where('nombres',$dato1);
                //     });
				// })->get();
			}
			$datos_cliente='';
			foreach($cotizaciones as $cotizacion){
				$datos_cliente=$cotizacion->nombre_pax.'X'.$cotizacion->nropersonas.' '.MisFunciones::fecha_peru($cotizacion->fecha);
				// foreach($cotizacion->cotizaciones_cliente->where('estado','1') as $coti_cliente){
				// 	$datos_cliente=$coti_cliente->cliente->nombres.'X'.$cotizacion->nropersonas.' '.MisFunciones::fecha_peru($cotizacion->fecha);
				// }
				foreach($cotizacion->paquete_cotizaciones as $paquete_cotizaciones){
					foreach($paquete_cotizaciones->itinerario_cotizaciones as $itinerario_cotizaciones){
						$proveedor='';
						foreach($itinerario_cotizaciones->hotel->where('anulado',0) as $hotel){
							if($hotel->proveedor_id>0){
								$proveedor=Proveedor::Find($hotel->proveedor_id)->nombre_comercial;  
							}
							$personas_s=0;
							$personas_d=0;
							$personas_m=0;
							$personas_t=0;
							
							$precio_s=0;
							$precio_d=0;
							$precio_m=0;
							$precio_t=0;

							$precio_total_=0;	
							if($hotel->personas_s>0){
								$personas_s=$hotel->personas_s;
								if($hotel->precio_s_r>0){
									$precio_s=$hotel->precio_s_r;
								}
							}
							if($hotel->personas_d>0){
								$personas_d=$hotel->personas_d;
								if($hotel->precio_d_r>0){
									$precio_d=$hotel->precio_d_r;
								}
							}
							if($hotel->personas_m>0){
								$personas_m=$hotel->personas_m;
								if($hotel->precio_m_r>0){
									$precio_m=$hotel->precio_m_r;
								}
							}
							if($hotel->personas_t>0){
								$personas_t=$hotel->personas_t;
								if($hotel->precio_t_r>0){
									$precio_t=$hotel->precio_t_r;
								}
							}
							$situacion='';
							if($hotel->primera_confirmada==0)
								$situacion='NO ENVIADO';
							elseif($hotel->primera_confirmada==1){
								if($hotel->liquidacion==0)
									$situacion='NO ENVIADO';
								elseif($hotel->liquidacion==1)
									$situacion='POR PAGAR';
								elseif($hotel->liquidacion==2)
									$situacion='PAGADO';
							}

							$fecha_venc='';
							if(trim($hotel->fecha_venc)!='')
								$fecha_venc=$hotel->fecha_venc;	
							$array_cotizaciones_hotel[]=array(
								'estrellas'=>$hotel->estrellas,
								'fecha_uso'=>$itinerario_cotizaciones->fecha,
								'fecha_venc'=>$fecha_venc,
								'personas_s'=>$personas_s,
								'personas_d'=>$personas_d,
								'personas_m'=>$personas_m,
								'personas_t'=>$personas_t,
								'precio_s'=>$precio_s,
								'precio_d'=>$precio_d,
								'precio_m'=>$precio_m,
								'precio_t'=>$precio_t,
								'pax'=>$datos_cliente,
								'proveedor'=>$proveedor,
								'situacion'=>$situacion,
								'proridad'=>$hotel->prioridad);	
								
						}
						foreach($itinerario_cotizaciones->itinerario_servicios as $itinerario_servicios){
							if($itinerario_servicios->grupo=='TOURS'){
								if($itinerario_servicios->proveedor_id>0){
									$proveedor=Proveedor::Find($itinerario_servicios->proveedor_id)->nombre_comercial;  
								}
								$precio=0;
								$precio_ads=0;
								$precio_total_=0;
								if($itinerario_servicios->precio_grupo==1){
									if($itinerario_servicios->precio>0)
										$precio_total_=$itinerario_servicios->precio;
										$precio_ads=$itinerario_servicios->precio/$cotizacion->nropersonas;
								}
								elseif($itinerario_servicios->precio_grupo==0){
									if($itinerario_servicios->precio>0)
										$precio_total_=$itinerario_servicios->precio*$cotizacion->nropersonas;
										$precio_ads=$itinerario_servicios->precio;
								}
								$situacion='';
								if($itinerario_servicios->primera_confirmada==0)
									$situacion='NO ENVIADO';
								elseif($itinerario_servicios->primera_confirmada==1){
									if($itinerario_servicios->liquidacion==0)
										$situacion='NO ENVIADO';
									elseif($itinerario_servicios->liquidacion==1)
										$situacion='POR PAGAR';
									elseif($itinerario_servicios->liquidacion==2)
										$situacion='PAGADO';
								}

								$fecha_venc='';
								if(trim($itinerario_servicios->fecha_venc)!='')
									$fecha_venc=$itinerario_servicios->fecha_venc;
								$array_cotizaciones_tours[]=array('fecha_uso'=>$itinerario_cotizaciones->fecha,
															'fecha_venc'=>$fecha_venc,
															'nombre'=>$itinerario_servicios->nombre,
															'clase'=>$itinerario_servicios->tipoServicio,
															'ad'=>$cotizacion->nropersonas,
															'pax'=>$datos_cliente,
															'proveedor'=>$proveedor,
															'ads'=>number_format($precio_ads,2),
															'total'=>number_format($precio_total_,2),
															'situacion'=>$situacion,
															'proridad'=>$itinerario_servicios->prioridad);
							}
							elseif($itinerario_servicios->grupo=='MOVILID' && $itinerario_servicios->clase=='DEFAULT'){
								if($itinerario_servicios->proveedor_id>0){
									$proveedor=Proveedor::Find($itinerario_servicios->proveedor_id)->nombre_comercial;  
								}
								$precio=0;
								$precio_ads=0;
								$precio_total_=0;
								if($itinerario_servicios->precio_grupo==1){
									if($itinerario_servicios->precio>0)
										$precio_total_=$itinerario_servicios->precio;
										$precio_ads=$itinerario_servicios->precio/$cotizacion->nropersonas;
								}
								elseif($itinerario_servicios->precio_grupo==0){
									if($itinerario_servicios->precio>0)
										$precio_total_=$itinerario_servicios->precio*$cotizacion->nropersonas;
										$precio_ads=$itinerario_servicios->precio;
								}
								
								$situacion='';
								if($itinerario_servicios->primera_confirmada==0)
									$situacion='NO ENVIADO';
								elseif($itinerario_servicios->primera_confirmada==1){
									if($itinerario_servicios->liquidacion==0)
										$situacion='NO ENVIADO';
									elseif($itinerario_servicios->liquidacion==1)
										$situacion='POR PAGAR';
									elseif($itinerario_servicios->liquidacion==2)
										$situacion='PAGADO';
								}
									$fecha_venc='';
									if(trim($itinerario_servicios->fecha_venc)!='')
									$fecha_venc=$itinerario_servicios->fecha_venc;
									$array_cotizaciones_movilid[]=array('fecha_uso'=>$itinerario_cotizaciones->fecha,
																'fecha_venc'=>$fecha_venc,
																'nombre'=>$itinerario_servicios->nombre,
																'clase'=>$itinerario_servicios->tipoServicio.'_'.$itinerario_servicios->min_personas.'-'.$itinerario_servicios->max_personas,
																'ad'=>$cotizacion->nropersonas,
																'pax'=>$datos_cliente,
																'proveedor'=>$proveedor,
																'ads'=>number_format($precio_ads,2),
																'total'=>number_format($precio_total_,2),
																'situacion'=>$situacion,
																'proridad'=>$itinerario_servicios->prioridad);
							}
							elseif($itinerario_servicios->grupo=='REPRESENT'){
								if($itinerario_servicios->proveedor_id>0){
									$proveedor=Proveedor::Find($itinerario_servicios->proveedor_id)->nombre_comercial;  
								}
								$precio=0;
								$precio_ads=0;
								$precio_total_=0;
								if($itinerario_servicios->precio_grupo==1){
									if($itinerario_servicios->precio>0)
										$precio_total_=$itinerario_servicios->precio;
										$precio_ads=$itinerario_servicios->precio/$cotizacion->nropersonas;
								}
								elseif($itinerario_servicios->precio_grupo==0){
									if($itinerario_servicios->precio>0)
										$precio_total_=$itinerario_servicios->precio*$cotizacion->nropersonas;
										$precio_ads=$itinerario_servicios->precio;
								}
								
								$situacion='';
								if($itinerario_servicios->primera_confirmada==0)
									$situacion='NO ENVIADO';
								elseif($itinerario_servicios->primera_confirmada==1){
									if($itinerario_servicios->liquidacion==0)
										$situacion='NO ENVIADO';
									elseif($itinerario_servicios->liquidacion==1)
										$situacion='POR PAGAR';
									elseif($itinerario_servicios->liquidacion==2)
										$situacion='PAGADO';
								}
									$fecha_venc='';
									if(trim($itinerario_servicios->fecha_venc)!='')
									$fecha_venc=$itinerario_servicios->fecha_venc;
									$array_cotizaciones_represent[]=array('fecha_uso'=>$itinerario_cotizaciones->fecha,
																'fecha_venc'=>$fecha_venc,
																'nombre'=>$itinerario_servicios->nombre,
																'clase'=>$itinerario_servicios->tipoServicio.'_'.$itinerario_servicios->min_personas.'-'.$itinerario_servicios->max_personas,
																'ad'=>$cotizacion->nropersonas,
																'pax'=>$datos_cliente,
																'proveedor'=>$proveedor,
																'ads'=>number_format($precio_ads,2),
																'total'=>number_format($precio_total_,2),
																'situacion'=>$situacion,
																'proridad'=>$itinerario_servicios->prioridad);
							}
							elseif($itinerario_servicios->grupo=='ENTRANCES'||($itinerario_servicios->grupo=='MOVILID' && $itinerario_servicios->clase=='BOLETO')){
								$proveedor='';
								if($itinerario_servicios->proveedor_id>0){
									$proveedor=Proveedor::Find($itinerario_servicios->proveedor_id)->nombre_comercial;  
								}
								$precio=0;
								$precio_ads=0;
								$precio_total_=0;
								if($itinerario_servicios->precio_grupo==1){
									if($itinerario_servicios->precio>0)
										$precio_total_=$itinerario_servicios->precio;
										$precio_ads=$itinerario_servicios->precio/$cotizacion->nropersonas;
								}
								elseif($itinerario_servicios->precio_grupo==0){
									if($itinerario_servicios->precio>0)
										$precio_total_=$itinerario_servicios->precio*$cotizacion->nropersonas;
										$precio_ads=$itinerario_servicios->precio;
								}
								
								$situacion='';
								if($itinerario_servicios->primera_confirmada==0)
									$situacion='NO ENVIADO';
								elseif($itinerario_servicios->primera_confirmada==1){
									if($itinerario_servicios->liquidacion==0)
										$situacion='NO ENVIADO';
									elseif($itinerario_servicios->liquidacion==1)
										$situacion='POR PAGAR';
									elseif($itinerario_servicios->liquidacion==2)
										$situacion='PAGADO';
								}
									$fecha_venc='';
									if(trim($itinerario_servicios->fecha_venc)!='')
									$fecha_venc=$itinerario_servicios->fecha_venc;
									$array_cotizaciones_entrances[]=array('fecha_uso'=>$itinerario_cotizaciones->fecha,
																'fecha_venc'=>$fecha_venc,
																'nombre'=>$itinerario_servicios->nombre,
																'clase'=>$itinerario_servicios->clase,
																'ad'=>$cotizacion->nropersonas,
																'pax'=>$datos_cliente,
																'proveedor'=>$proveedor,
																'ads'=>number_format($precio_ads,2),
																'total'=>number_format($precio_total_,2),
																'situacion'=>$situacion,
																'proridad'=>$itinerario_servicios->prioridad);
							}
							elseif($itinerario_servicios->grupo=='FOOD'){
								if($itinerario_servicios->proveedor_id>0){
									$proveedor=Proveedor::Find($itinerario_servicios->proveedor_id)->nombre_comercial;  
								}
								$precio=0;
								$precio_ads=0;
								$precio_total_=0;
								if($itinerario_servicios->precio_grupo==1){
									if($itinerario_servicios->precio>0)
										$precio_total_=$itinerario_servicios->precio;
										$precio_ads=$itinerario_servicios->precio/$cotizacion->nropersonas;
								}
								elseif($itinerario_servicios->precio_grupo==0){
									if($itinerario_servicios->precio>0)
										$precio_total_=$itinerario_servicios->precio*$cotizacion->nropersonas;
										$precio_ads=$itinerario_servicios->precio;
								}
								
								$situacion='';
								if($itinerario_servicios->primera_confirmada==0)
									$situacion='NO ENVIADO';
								elseif($itinerario_servicios->primera_confirmada==1){
									if($itinerario_servicios->liquidacion==0)
										$situacion='NO ENVIADO';
									elseif($itinerario_servicios->liquidacion==1)
										$situacion='POR PAGAR';
									elseif($itinerario_servicios->liquidacion==2)
										$situacion='PAGADO';
								}
									$fecha_venc='';
									if(trim($itinerario_servicios->fecha_venc)!='')
									$fecha_venc=$itinerario_servicios->fecha_venc;
									$array_cotizaciones_food[]=array('fecha_uso'=>$itinerario_cotizaciones->fecha,
																'fecha_venc'=>$fecha_venc,
																'nombre'=>$itinerario_servicios->nombre,
																'clase'=>$itinerario_servicios->tipoServicio,
																'ad'=>$cotizacion->nropersonas,
																'pax'=>$datos_cliente,
																'proveedor'=>$proveedor,
																'ads'=>number_format($precio_ads,2),
																'total'=>number_format($precio_total_,2),
																'situacion'=>$situacion,
																'proridad'=>$itinerario_servicios->prioridad);
							}
							elseif($itinerario_servicios->grupo=='TRAINS'){
								if($itinerario_servicios->proveedor_id>0){
									$proveedor=Proveedor::Find($itinerario_servicios->proveedor_id)->nombre_comercial;  
								}
								$precio=0;
								$precio_ads=0;
								$precio_total_=0;
								if($itinerario_servicios->precio_grupo==1){
									if($itinerario_servicios->precio>0)
										$precio_total_=$itinerario_servicios->precio;
										$precio_ads=$itinerario_servicios->precio/$cotizacion->nropersonas;
								}
								elseif($itinerario_servicios->precio_grupo==0){
									if($itinerario_servicios->precio>0)
										$precio_total_=$itinerario_servicios->precio*$cotizacion->nropersonas;
										$precio_ads=$itinerario_servicios->precio;
								}
								
								$situacion='';
								if($itinerario_servicios->primera_confirmada==0)
									$situacion='NO ENVIADO';
								elseif($itinerario_servicios->primera_confirmada==1){
									if($itinerario_servicios->liquidacion==0)
										$situacion='NO ENVIADO';
									elseif($itinerario_servicios->liquidacion==1)
										$situacion='POR PAGAR';
									elseif($itinerario_servicios->liquidacion==2)
										$situacion='PAGADO';
								}
									$fecha_venc='';
									if(trim($itinerario_servicios->fecha_venc)!='')
									$fecha_venc=$itinerario_servicios->fecha_venc;
									$array_cotizaciones_trains[]=array('fecha_uso'=>$itinerario_cotizaciones->fecha,
																'fecha_venc'=>$fecha_venc,
																'nombre'=>$itinerario_servicios->nombre,
																'horario'=>$itinerario_servicios->salida.'_'.$itinerario_servicios->llegada,
																'ad'=>$cotizacion->nropersonas,
																'pax'=>$datos_cliente,
																'proveedor'=>$proveedor,
																'ads'=>number_format($precio_ads,2),
																'total'=>number_format($precio_total_,2),
																'situacion'=>$situacion,
																'proridad'=>$itinerario_servicios->prioridad);
							}
							elseif($itinerario_servicios->grupo=='FLIGHTS'){
								if($itinerario_servicios->proveedor_id>0){
									$proveedor=Proveedor::Find($itinerario_servicios->proveedor_id)->nombre_comercial;  
								}
								$precio=0;
								$precio_ads=0;
								$precio_total_=0;
								if($itinerario_servicios->precio_grupo==1){
									if($itinerario_servicios->precio>0)
										$precio_total_=$itinerario_servicios->precio;
										$precio_ads=$itinerario_servicios->precio/$cotizacion->nropersonas;
								}
								elseif($itinerario_servicios->precio_grupo==0){
									if($itinerario_servicios->precio>0)
										$precio_total_=$itinerario_servicios->precio*$cotizacion->nropersonas;
										$precio_ads=$itinerario_servicios->precio;
								}
								
								$situacion='';
								if($itinerario_servicios->primera_confirmada==0)
									$situacion='NO ENVIADO';
								elseif($itinerario_servicios->primera_confirmada==1){
									if($itinerario_servicios->liquidacion==0)
										$situacion='NO ENVIADO';
									elseif($itinerario_servicios->liquidacion==1)
										$situacion='POR PAGAR';
									elseif($itinerario_servicios->liquidacion==2)
										$situacion='PAGADO';
								}
									$fecha_venc='';
									if(trim($itinerario_servicios->fecha_venc)!='')
									$fecha_venc=$itinerario_servicios->fecha_venc;
									$array_cotizaciones_flights[]=array('fecha_uso'=>$itinerario_cotizaciones->fecha,
																'fecha_venc'=>$fecha_venc,
																'nombre'=>$itinerario_servicios->nombre,
																'aerolinea'=>$itinerario_servicios->aerolinea.'_'.$itinerario_servicios->nro_vuelo,
																'ad'=>$cotizacion->nropersonas,
																'pax'=>$datos_cliente,
																'proveedor'=>$proveedor,
																'ads'=>number_format($precio_ads,2),
																'total'=>number_format($precio_total_,2),
																'situacion'=>$situacion,
																'proridad'=>$itinerario_servicios->prioridad);
							}
							elseif($itinerario_servicios->grupo=='OTHERS'){
								if($itinerario_servicios->proveedor_id>0){
									$proveedor=Proveedor::Find($itinerario_servicios->proveedor_id)->nombre_comercial;  
								}
								$precio=0;
								$precio_ads=0;
								$precio_total_=0;
								if($itinerario_servicios->precio_grupo==1){
									if($itinerario_servicios->precio>0)
										$precio_total_=$itinerario_servicios->precio;
										$precio_ads=$itinerario_servicios->precio/$cotizacion->nropersonas;
								}
								elseif($itinerario_servicios->precio_grupo==0){
									if($itinerario_servicios->precio>0)
										$precio_total_=$itinerario_servicios->precio*$cotizacion->nropersonas;
										$precio_ads=$itinerario_servicios->precio;
								}
								
								$situacion='';
								if($itinerario_servicios->primera_confirmada==0)
									$situacion='NO ENVIADO';
								elseif($itinerario_servicios->primera_confirmada==1){
									if($itinerario_servicios->liquidacion==0)
										$situacion='NO ENVIADO';
									elseif($itinerario_servicios->liquidacion==1)
										$situacion='POR PAGAR';
									elseif($itinerario_servicios->liquidacion==2)
										$situacion='PAGADO';
								}
									$fecha_venc='';
									if(trim($itinerario_servicios->fecha_venc)!='')
									$fecha_venc=$itinerario_servicios->fecha_venc;
									$array_cotizaciones_others[]=array('fecha_uso'=>$itinerario_cotizaciones->fecha,
																'fecha_venc'=>$fecha_venc,
																'nombre'=>$itinerario_servicios->nombre,
																'clase'=>$itinerario_servicios->clase,
																'ad'=>$cotizacion->nropersonas,
																'pax'=>$datos_cliente,
																'proveedor'=>$proveedor,
																'ads'=>number_format($precio_ads,2),
																'total'=>number_format($precio_total_,2),
																'situacion'=>$situacion,
																'proridad'=>$itinerario_servicios->prioridad);
							}
						}
					}
				}
			}
			
			$sort_hotel=array();
			foreach ($array_cotizaciones_hotel as $key => $part) {
				$sort_hotel[$key] = strtotime($part['fecha_venc']);
			}
			array_multisort($sort_hotel, SORT_ASC, $array_cotizaciones_hotel);

			$sort_tours=array();
			foreach ($array_cotizaciones_tours as $key => $part) {
				$sort_tours[$key] = strtotime($part['fecha_venc']);
			}
			array_multisort($sort_tours, SORT_ASC, $array_cotizaciones_tours);

			$sort_movilid=array();
			foreach ($array_cotizaciones_movilid as $key => $part) {
				$sort_movilid[$key] = strtotime($part['fecha_venc']);
			}
			array_multisort($sort_movilid, SORT_ASC, $array_cotizaciones_movilid);
		
			$sort_represent=array();
			foreach ($array_cotizaciones_represent as $key => $part) {
				$sort_represent[$key] = strtotime($part['fecha_venc']);
			}
			array_multisort($sort_represent, SORT_ASC, $array_cotizaciones_represent);

			$sort_entrances=array();
			foreach ($array_cotizaciones_entrances as $key => $part) {
				$sort_entrances[$key] = strtotime($part['fecha_venc']);
			}
			array_multisort($sort_entrances, SORT_ASC, $array_cotizaciones_entrances);

			$sort_food=array();
			foreach ($array_cotizaciones_food as $key => $part) {
				$sort_food[$key] = strtotime($part['fecha_venc']);
			}
			array_multisort($sort_food, SORT_ASC, $array_cotizaciones_food);
		
			$sort_trains=array();
			foreach ($array_cotizaciones_trains as $key => $part) {
				$sort_trains[$key] = strtotime($part['fecha_venc']);
			}
			array_multisort($sort_trains, SORT_ASC, $array_cotizaciones_trains);

			$sort_flights=array();
			foreach ($array_cotizaciones_flights as $key => $part) {
				$sort_flights[$key] = strtotime($part['fecha_venc']);
			}
			array_multisort($sort_flights, SORT_ASC, $array_cotizaciones_flights);

			$sort_others=array();
			foreach ($array_cotizaciones_others as $key => $part) {
				$sort_others[$key] = strtotime($part['fecha_venc']);
			}
			array_multisort($sort_others, SORT_ASC, $array_cotizaciones_others);
			return view('admin.book.situacion-x-pqt',compact(['array_cotizaciones_hotel','array_cotizaciones_tours','array_cotizaciones_movilid',
			'array_cotizaciones_represent','array_cotizaciones_represent','array_cotizaciones_entrances','array_cotizaciones_food',
			'array_cotizaciones_trains','array_cotizaciones_flights','array_cotizaciones_others']));

		}
		elseif($opcion=='fechas'){
			$cotizaciones=Cotizacion::whereHas('paquete_cotizaciones',function($query3)use($dato1,$dato2){
				$query3->whereHas('itinerario_cotizaciones',function($query2)use($dato1,$dato2){
					//-- para buscar por fecha de uso
//                    $query->whereBetween('fecha',[$dato1,$dato2]);
//                    $query2->with('itinerario_servicios')
					$query2->whereHas('itinerario_servicios',function($query1)use($dato1,$dato2){
						//-- para buscar por fecha de vencimiento

						$query1->whereNotNull('fecha_venc')
							->whereBetween('fecha_venc',[new Carbon($dato1),new Carbon($dato2)]);
					});
				});
			})->get();
			$datos_cliente='';
			foreach($cotizaciones as $cotizacion){
				$datos_cliente='';
				foreach($cotizacion->cotizaciones_cliente->where('estado','1') as $coti_cliente){
					$datos_cliente=$coti_cliente->cliente->nombres.'X'.$cotizacion->nropersonas.' '.MisFunciones::fecha_peru($cotizacion->fecha);
				}
				foreach($cotizacion->paquete_cotizaciones as $paquete_cotizaciones){
					foreach($paquete_cotizaciones->itinerario_cotizaciones as $itinerario_cotizaciones){
						$proveedor='';
						foreach($itinerario_cotizaciones->hotel as $hotel){
							if($dato1<=$hotel->fecha_venc&&$hotel->fecha_venc<=$dato2){
								if($hotel->proveedor_id>0){
									$proveedor=Proveedor::Find($hotel->proveedor_id)->nombre_comercial;  
								}
								$personas_s=0;
								$personas_d=0;
								$personas_m=0;
								$personas_t=0;
								
								$precio_s=0;
								$precio_d=0;
								$precio_m=0;
								$precio_t=0;

								$precio_total_=0;	
								if($hotel->personas_s>0){
									$personas_s=$hotel->personas_s;
									if($hotel->precio_s_r>0){
										$precio_s=$hotel->precio_s_r;
									}
								}
								if($hotel->personas_d>0){
									$personas_d=$hotel->personas_d;
									if($hotel->precio_d_r>0){
										$precio_d=$hotel->precio_d_r;
									}
								}
								if($hotel->personas_m>0){
									$personas_m=$hotel->personas_m;
									if($hotel->precio_m_r>0){
										$precio_m=$hotel->precio_m_r;
									}
								}
								if($hotel->personas_t>0){
									$personas_t=$hotel->personas_t;
									if($hotel->precio_t_r>0){
										$precio_t=$hotel->precio_t_r;
									}
								}
								$situacion='';
								if($hotel->primera_confirmada==0)
									$situacion='NO ENVIADO';
								elseif($hotel->primera_confirmada==1){
									if($hotel->liquidacion==0)
										$situacion='NO ENVIADO';
									elseif($hotel->liquidacion==1)
										$situacion='POR PAGAR';
									elseif($hotel->liquidacion==2)
										$situacion='PAGADO';
								}
								$fecha_venc='';
								if(trim($hotel->fecha_venc)!='')
									$fecha_venc=$hotel->fecha_venc;
								$array_cotizaciones_hotel[]=array(
									'estrellas'=>$hotel->estrellas,
									'fecha_uso'=>$itinerario_cotizaciones->fecha,
									'fecha_venc'=>$fecha_venc,
									'personas_s'=>$personas_s,
									'personas_d'=>$personas_d,
									'personas_m'=>$personas_m,
									'personas_t'=>$personas_t,
									'precio_s'=>$precio_s,
									'precio_d'=>$precio_d,
									'precio_m'=>$precio_m,
									'precio_t'=>$precio_t,
									'pax'=>$datos_cliente,
									'proveedor'=>$proveedor,
									'situacion'=>$situacion,
									'proridad'=>$hotel->prioridad);	
									
							
							}
						}
						foreach($itinerario_cotizaciones->itinerario_servicios as $itinerario_servicios){
							if($dato1<=$itinerario_servicios->fecha_venc&&$itinerario_servicios->fecha_venc<=$dato2){
								if($itinerario_servicios->grupo=='TOURS'){
									if($itinerario_servicios->proveedor_id>0){
										$proveedor=Proveedor::Find($itinerario_servicios->proveedor_id)->nombre_comercial;  
									}
									$precio=0;
									$precio_ads=0;
									$precio_total_=0;
									if($itinerario_servicios->precio_grupo==1){
										if($itinerario_servicios->precio>0)
											$precio_total_=$itinerario_servicios->precio;
											$precio_ads=$itinerario_servicios->precio/$cotizacion->nropersonas;
									}
									elseif($itinerario_servicios->precio_grupo==0){
										if($itinerario_servicios->precio>0)
											$precio_total_=$itinerario_servicios->precio*$cotizacion->nropersonas;
											$precio_ads=$itinerario_servicios->precio;
									}
									$situacion='';
									if($itinerario_servicios->primera_confirmada==0)
										$situacion='NO ENVIADO';
									elseif($itinerario_servicios->primera_confirmada==1){
										if($itinerario_servicios->liquidacion==0)
											$situacion='NO ENVIADO';
										elseif($itinerario_servicios->liquidacion==1)
											$situacion='POR PAGAR';
										elseif($itinerario_servicios->liquidacion==2)
											$situacion='PAGADO';
									}
									$fecha_venc='';
									if(trim($itinerario_servicios->fecha_venc)!='')
										$fecha_venc=$itinerario_servicios->fecha_venc;

									$array_cotizaciones_tours[]=array('fecha_uso'=>$itinerario_cotizaciones->fecha,
																'fecha_venc'=>$fecha_venc,
																'nombre'=>$itinerario_servicios->nombre,
																'clase'=>$itinerario_servicios->tipoServicio,
																'ad'=>$cotizacion->nropersonas,
																'pax'=>$datos_cliente,
																'proveedor'=>$proveedor,
																'ads'=>number_format($precio_ads,2),
																'total'=>number_format($precio_total_,2),
																'situacion'=>$situacion,
																'proridad'=>$itinerario_servicios->prioridad);
								}
								elseif($itinerario_servicios->grupo=='MOVILID' && $itinerario_servicios->clase=='DEFAULT'){
									if($itinerario_servicios->proveedor_id>0){
										$proveedor=Proveedor::Find($itinerario_servicios->proveedor_id)->nombre_comercial;  
									}
									$precio=0;
									$precio_ads=0;
									$precio_total_=0;
									if($itinerario_servicios->precio_grupo==1){
										if($itinerario_servicios->precio>0)
											$precio_total_=$itinerario_servicios->precio;
											$precio_ads=$itinerario_servicios->precio/$cotizacion->nropersonas;
									}
									elseif($itinerario_servicios->precio_grupo==0){
										if($itinerario_servicios->precio>0)
											$precio_total_=$itinerario_servicios->precio*$cotizacion->nropersonas;
											$precio_ads=$itinerario_servicios->precio;
									}
									
									$situacion='';
									if($itinerario_servicios->primera_confirmada==0)
										$situacion='NO ENVIADO';
									elseif($itinerario_servicios->primera_confirmada==1){
										if($itinerario_servicios->liquidacion==0)
											$situacion='NO ENVIADO';
										elseif($itinerario_servicios->liquidacion==1)
											$situacion='POR PAGAR';
										elseif($itinerario_servicios->liquidacion==2)
											$situacion='PAGADO';
									}		
									$fecha_venc='';
									if(trim($itinerario_servicios->fecha_venc)!='')
									$fecha_venc=$itinerario_servicios->fecha_venc;
									$array_cotizaciones_movilid[]=array('fecha_uso'=>$itinerario_cotizaciones->fecha,
																'fecha_venc'=>$fecha_venc,
																'nombre'=>$itinerario_servicios->nombre,
																'clase'=>$itinerario_servicios->tipoServicio.'_'.$itinerario_servicios->min_personas.'-'.$itinerario_servicios->max_personas,
																'ad'=>$cotizacion->nropersonas,
																'pax'=>$datos_cliente,
																'proveedor'=>$proveedor,
																'ads'=>number_format($precio_ads,2),
																'total'=>number_format($precio_total_,2),
																'situacion'=>$situacion,
																'proridad'=>$itinerario_servicios->prioridad);
								}
								elseif($itinerario_servicios->grupo=='REPRESENT'){
									if($itinerario_servicios->proveedor_id>0){
										$proveedor=Proveedor::Find($itinerario_servicios->proveedor_id)->nombre_comercial;  
									}
									$precio=0;
									$precio_ads=0;
									$precio_total_=0;
									if($itinerario_servicios->precio_grupo==1){
										if($itinerario_servicios->precio>0)
											$precio_total_=$itinerario_servicios->precio;
											$precio_ads=$itinerario_servicios->precio/$cotizacion->nropersonas;
									}
									elseif($itinerario_servicios->precio_grupo==0){
										if($itinerario_servicios->precio>0)
											$precio_total_=$itinerario_servicios->precio*$cotizacion->nropersonas;
											$precio_ads=$itinerario_servicios->precio;
									}
									
									$situacion='';
									if($itinerario_servicios->primera_confirmada==0)
										$situacion='NO ENVIADO';
									elseif($itinerario_servicios->primera_confirmada==1){
										if($itinerario_servicios->liquidacion==0)
											$situacion='NO ENVIADO';
										elseif($itinerario_servicios->liquidacion==1)
											$situacion='POR PAGAR';
										elseif($itinerario_servicios->liquidacion==2)
											$situacion='PAGADO';
									}
									$fecha_venc='';
									if(trim($itinerario_servicios->fecha_venc)!='')
									$fecha_venc=$itinerario_servicios->fecha_venc;
									$array_cotizaciones_represent[]=array('fecha_uso'=>$itinerario_cotizaciones->fecha,
																'fecha_venc'=>$fecha_venc,
																'nombre'=>$itinerario_servicios->nombre,
																'clase'=>$itinerario_servicios->tipoServicio.'_'.$itinerario_servicios->min_personas.'-'.$itinerario_servicios->max_personas,
																'ad'=>$cotizacion->nropersonas,
																'pax'=>$datos_cliente,
																'proveedor'=>$proveedor,
																'ads'=>number_format($precio_ads,2),
																'total'=>number_format($precio_total_,2),
																'situacion'=>$situacion,
																'proridad'=>$itinerario_servicios->prioridad);
								}
								elseif($itinerario_servicios->grupo=='ENTRANCES'||($itinerario_servicios->grupo=='MOVILID' && $itinerario_servicios->clase=='BOLETO')){
									$proveedor='';
									if($itinerario_servicios->proveedor_id>0){
										$proveedor=Proveedor::Find($itinerario_servicios->proveedor_id)->nombre_comercial;  
									}
									$precio=0;
									$precio_ads=0;
									$precio_total_=0;
									if($itinerario_servicios->precio_grupo==1){
										if($itinerario_servicios->precio>0)
											$precio_total_=$itinerario_servicios->precio;
											$precio_ads=$itinerario_servicios->precio/$cotizacion->nropersonas;
									}
									elseif($itinerario_servicios->precio_grupo==0){
										if($itinerario_servicios->precio>0)
											$precio_total_=$itinerario_servicios->precio*$cotizacion->nropersonas;
											$precio_ads=$itinerario_servicios->precio;
									}
									
									$situacion='';
									if($itinerario_servicios->primera_confirmada==0)
										$situacion='NO ENVIADO';
									elseif($itinerario_servicios->primera_confirmada==1){
										if($itinerario_servicios->liquidacion==0)
											$situacion='NO ENVIADO';
										elseif($itinerario_servicios->liquidacion==1)
											$situacion='POR PAGAR';
										elseif($itinerario_servicios->liquidacion==2)
											$situacion='PAGADO';
									}
									$fecha_venc='';
									if(trim($itinerario_servicios->fecha_venc)!='')
									$fecha_venc=$itinerario_servicios->fecha_venc;
									$array_cotizaciones_entrances[]=array('fecha_uso'=>$itinerario_cotizaciones->fecha,
																'fecha_venc'=>$fecha_venc,
																'nombre'=>$itinerario_servicios->nombre,
																'clase'=>$itinerario_servicios->clase,
																'ad'=>$cotizacion->nropersonas,
																'pax'=>$datos_cliente,
																'proveedor'=>$proveedor,
																'ads'=>number_format($precio_ads,2),
																'total'=>number_format($precio_total_,2),
																'situacion'=>$situacion,
																'proridad'=>$itinerario_servicios->prioridad);
								}
								elseif($itinerario_servicios->grupo=='FOOD'){
									if($itinerario_servicios->proveedor_id>0){
										$proveedor=Proveedor::Find($itinerario_servicios->proveedor_id)->nombre_comercial;  
									}
									$precio=0;
									$precio_ads=0;
									$precio_total_=0;
									if($itinerario_servicios->precio_grupo==1){
										if($itinerario_servicios->precio>0)
											$precio_total_=$itinerario_servicios->precio;
											$precio_ads=$itinerario_servicios->precio/$cotizacion->nropersonas;
									}
									elseif($itinerario_servicios->precio_grupo==0){
										if($itinerario_servicios->precio>0)
											$precio_total_=$itinerario_servicios->precio*$cotizacion->nropersonas;
											$precio_ads=$itinerario_servicios->precio;
									}
									
									$situacion='';
									if($itinerario_servicios->primera_confirmada==0)
										$situacion='NO ENVIADO';
									elseif($itinerario_servicios->primera_confirmada==1){
										if($itinerario_servicios->liquidacion==0)
											$situacion='NO ENVIADO';
										elseif($itinerario_servicios->liquidacion==1)
											$situacion='POR PAGAR';
										elseif($itinerario_servicios->liquidacion==2)
											$situacion='PAGADO';
									}
									$fecha_venc='';
									if(trim($itinerario_servicios->fecha_venc)!='')
									$fecha_venc=$itinerario_servicios->fecha_venc;
									$array_cotizaciones_food[]=array('fecha_uso'=>$itinerario_cotizaciones->fecha,
																'fecha_venc'=>$fecha_venc,
																'nombre'=>$itinerario_servicios->nombre,
																'clase'=>$itinerario_servicios->tipoServicio,
																'ad'=>$cotizacion->nropersonas,
																'pax'=>$datos_cliente,
																'proveedor'=>$proveedor,
																'ads'=>number_format($precio_ads,2),
																'total'=>number_format($precio_total_,2),
																'situacion'=>$situacion,
																'proridad'=>$itinerario_servicios->prioridad);
								}
								elseif($itinerario_servicios->grupo=='TRAINS'){
									if($itinerario_servicios->proveedor_id>0){
										$proveedor=Proveedor::Find($itinerario_servicios->proveedor_id)->nombre_comercial;  
									}
									$precio=0;
									$precio_ads=0;
									$precio_total_=0;
									if($itinerario_servicios->precio_grupo==1){
										if($itinerario_servicios->precio>0)
											$precio_total_=$itinerario_servicios->precio;
											$precio_ads=$itinerario_servicios->precio/$cotizacion->nropersonas;
									}
									elseif($itinerario_servicios->precio_grupo==0){
										if($itinerario_servicios->precio>0)
											$precio_total_=$itinerario_servicios->precio*$cotizacion->nropersonas;
											$precio_ads=$itinerario_servicios->precio;
									}
									
									$situacion='';
									if($itinerario_servicios->primera_confirmada==0)
										$situacion='NO ENVIADO';
									elseif($itinerario_servicios->primera_confirmada==1){
										if($itinerario_servicios->liquidacion==0)
											$situacion='NO ENVIADO';
										elseif($itinerario_servicios->liquidacion==1)
											$situacion='POR PAGAR';
										elseif($itinerario_servicios->liquidacion==2)
											$situacion='PAGADO';
									}
									$fecha_venc='';
									if(trim($itinerario_servicios->fecha_venc)!='')
									$fecha_venc=$itinerario_servicios->fecha_venc;
									$array_cotizaciones_trains[]=array('fecha_uso'=>$itinerario_cotizaciones->fecha,
																'fecha_venc'=>$fecha_venc,
																'nombre'=>$itinerario_servicios->nombre,
																'horario'=>$itinerario_servicios->salida.'_'.$itinerario_servicios->llegada,
																'ad'=>$cotizacion->nropersonas,
																'pax'=>$datos_cliente,
																'proveedor'=>$proveedor,
																'ads'=>number_format($precio_ads,2),
																'total'=>number_format($precio_total_,2),
																'situacion'=>$situacion,
																'proridad'=>$itinerario_servicios->prioridad);
								}
								elseif($itinerario_servicios->grupo=='FLIGHTS'){
									if($itinerario_servicios->proveedor_id>0){
										$proveedor=Proveedor::Find($itinerario_servicios->proveedor_id)->nombre_comercial;  
									}
									$precio=0;
									$precio_ads=0;
									$precio_total_=0;
									if($itinerario_servicios->precio_grupo==1){
										if($itinerario_servicios->precio>0)
											$precio_total_=$itinerario_servicios->precio;
											$precio_ads=$itinerario_servicios->precio/$cotizacion->nropersonas;
									}
									elseif($itinerario_servicios->precio_grupo==0){
										if($itinerario_servicios->precio>0)
											$precio_total_=$itinerario_servicios->precio*$cotizacion->nropersonas;
											$precio_ads=$itinerario_servicios->precio;
									}
									
									$situacion='';
									if($itinerario_servicios->primera_confirmada==0)
										$situacion='NO ENVIADO';
									elseif($itinerario_servicios->primera_confirmada==1){
										if($itinerario_servicios->liquidacion==0)
											$situacion='NO ENVIADO';
										elseif($itinerario_servicios->liquidacion==1)
											$situacion='POR PAGAR';
										elseif($itinerario_servicios->liquidacion==2)
											$situacion='PAGADO';
									}
									$fecha_venc='';
									if(trim($itinerario_servicios->fecha_venc)!='')
									$fecha_venc=$itinerario_servicios->fecha_venc;
									$array_cotizaciones_flights[]=array('fecha_uso'=>$itinerario_cotizaciones->fecha,
																'fecha_venc'=>$fecha_venc,
																'nombre'=>$itinerario_servicios->nombre,
																'aerolinea'=>$itinerario_servicios->aerolinea.'_'.$itinerario_servicios->nro_vuelo,
																'ad'=>$cotizacion->nropersonas,
																'pax'=>$datos_cliente,
																'proveedor'=>$proveedor,
																'ads'=>number_format($precio_ads,2),
																'total'=>number_format($precio_total_,2),
																'situacion'=>$situacion,
																'proridad'=>$itinerario_servicios->prioridad);
								}
								elseif($itinerario_servicios->grupo=='OTHERS'){
									if($itinerario_servicios->proveedor_id>0){
										$proveedor=Proveedor::Find($itinerario_servicios->proveedor_id)->nombre_comercial;  
									}
									$precio=0;
									$precio_ads=0;
									$precio_total_=0;
									if($itinerario_servicios->precio_grupo==1){
										if($itinerario_servicios->precio>0)
											$precio_total_=$itinerario_servicios->precio;
											$precio_ads=$itinerario_servicios->precio/$cotizacion->nropersonas;
									}
									elseif($itinerario_servicios->precio_grupo==0){
										if($itinerario_servicios->precio>0)
											$precio_total_=$itinerario_servicios->precio*$cotizacion->nropersonas;
											$precio_ads=$itinerario_servicios->precio;
									}
									
									$situacion='';
									if($itinerario_servicios->primera_confirmada==0)
										$situacion='NO ENVIADO';
									elseif($itinerario_servicios->primera_confirmada==1){
										if($itinerario_servicios->liquidacion==0)
											$situacion='NO ENVIADO';
										elseif($itinerario_servicios->liquidacion==1)
											$situacion='POR PAGAR';
										elseif($itinerario_servicios->liquidacion==2)
											$situacion='PAGADO';
									}
									$fecha_venc='';
									if(trim($itinerario_servicios->fecha_venc)!='')
									$fecha_venc=$itinerario_servicios->fecha_venc;
									$array_cotizaciones_others[]=array('fecha_uso'=>$itinerario_cotizaciones->fecha,
																'fecha_venc'=>$fecha_venc,
																'nombre'=>$itinerario_servicios->nombre,
																'clase'=>$itinerario_servicios->clase,
																'ad'=>$cotizacion->nropersonas,
																'pax'=>$datos_cliente,
																'proveedor'=>$proveedor,
																'ads'=>number_format($precio_ads,2),
																'total'=>number_format($precio_total_,2),
																'situacion'=>$situacion,
																'proridad'=>$itinerario_servicios->prioridad);
								}
							}
						}
					}
				}
			}
			// dd($array_cotizaciones_hotel);
			$sort_hotel=array();
			foreach ($array_cotizaciones_hotel as $key => $part) {
				$sort_hotel[$key] = strtotime($part['fecha_venc']);
			}
			array_multisort($sort_hotel, SORT_ASC, $array_cotizaciones_hotel);

			$sort_tours=array();
			foreach ($array_cotizaciones_tours as $key => $part) {
				$sort_tours[$key] = strtotime($part['fecha_venc']);
			}
			array_multisort($sort_tours, SORT_ASC, $array_cotizaciones_tours);

			$sort_movilid=array();
			foreach ($array_cotizaciones_movilid as $key => $part) {
				$sort_movilid[$key] = strtotime($part['fecha_venc']);
			}
			array_multisort($sort_movilid, SORT_ASC, $array_cotizaciones_movilid);
		
			$sort_represent=array();
			foreach ($array_cotizaciones_represent as $key => $part) {
				$sort_represent[$key] = strtotime($part['fecha_venc']);
			}
			array_multisort($sort_represent, SORT_ASC, $array_cotizaciones_represent);

			$sort_entrances=array();
			foreach ($array_cotizaciones_entrances as $key => $part) {
				$sort_entrances[$key] = strtotime($part['fecha_venc']);
			}
			array_multisort($sort_entrances, SORT_ASC, $array_cotizaciones_entrances);

			$sort_food=array();
			foreach ($array_cotizaciones_food as $key => $part) {
				$sort_food[$key] = strtotime($part['fecha_venc']);
			}
			array_multisort($sort_food, SORT_ASC, $array_cotizaciones_food);
		
			$sort_trains=array();
			foreach ($array_cotizaciones_trains as $key => $part) {
				$sort_trains[$key] = strtotime($part['fecha_venc']);
			}
			array_multisort($sort_trains, SORT_ASC, $array_cotizaciones_trains);

			$sort_flights=array();
			foreach ($array_cotizaciones_flights as $key => $part) {
				$sort_flights[$key] = strtotime($part['fecha_venc']);
			}
			array_multisort($sort_flights, SORT_ASC, $array_cotizaciones_flights);

			$sort_others=array();
			foreach ($array_cotizaciones_others as $key => $part) {
				$sort_others[$key] = strtotime($part['fecha_venc']);
			}
			array_multisort($sort_others, SORT_ASC, $array_cotizaciones_others);
			// dd($array_cotizaciones_tours);
			return view('admin.book.situacion-x-pqt-fechas',compact(['array_cotizaciones_hotel','array_cotizaciones_tours','array_cotizaciones_movilid',
			'array_cotizaciones_represent','array_cotizaciones_represent','array_cotizaciones_entrances','array_cotizaciones_food',
			'array_cotizaciones_trains','array_cotizaciones_flights','array_cotizaciones_others']));

			// return view('admin.book.situacion-x-pqt-fechas',compact(['cotizaciones','liquidaciones','dato1','dato2','proveedores']));
		}

//        return dd($cotizaciones);

//        $cotizacion_cat =Cotizacion::where('codigo',$codigo)->get();
//        return view('admin.book.list-paquetes',compact('cotizacion_cat'));
	}
	public function traer_lista_proveedores(Request $request){
        $estrellas=$request->input('estrellas');
		$localizacion=$request->input('localizacion');
		$hotel_id=$request->input('hotel_id');
		$itinerario_cotizaciones_id=$request->input('itinerario_cotizaciones_id');

		$cotizacion_id=$request->input('cotizacion_id');
		
		$hotel_proveedor=HotelProveedor::where('estrellas',$estrellas)->where('localizacion',$localizacion)->get();
		$hotel=PrecioHotelReserva::find($hotel_id);
        return view('admin.book.traer-lista-proveedores-hotel',compact('hotel_proveedor','hotel','itinerario_cotizaciones_id','cotizacion_id'));
	}
	public function traer_lista_proveedores_servicios(Request $request){
		$action = $request->input('action');
		$cotizacion_id = $request->input('cotizacion_id');
		$servicio_id=$request->input('servicio_id');
		$arregloo=$request->input('arreglo');
		$arregloo=explode('_',$arregloo);
		// dd($arregloo);
		$itinerario_id = $request->input('itinerario_id');
		$cotizacion=Cotizacion::find($cotizacion_id);
		$servicios=ItinerarioServicios::find($servicio_id);

		if($action=='a'){
			$productos=M_Producto::where('localizacion',$servicios->localizacion)->where('grupo',$servicios->grupo)->whereIn('tipo_producto',$arregloo)->where('clase',$servicios->clase)->where('nombre',$servicios->nombre)->get();
		}
		else if($action=='e'){
			$productos=M_Producto::where('localizacion',$servicios->localizacion)->where('grupo',$servicios->grupo)->where('tipo_producto',$servicios->tipoServicio)->where('clase',$servicios->clase)->where('nombre',$servicios->nombre)->get();
		}
		return view('admin.book.traer-lista-proveedores-servicios',compact('productos','cotizacion','servicios','itinerario_id','action'));	
	}
	public function traer_lista_proveedores_servicios_borrar(Request $request){
		$action = $request->input('action');
		$cotizacion_id = $request->input('cotizacion_id');
		$servicio_id=$request->input('servicio_id');
		$arregloo=$request->input('arreglo');
		$arregloo=explode('_',$arregloo);
		// dd($arregloo);
		$itinerario_id = $request->input('itinerario_id');
		$cotizacion=Cotizacion::find($cotizacion_id);
		$servicios=ItinerarioServicios::find($servicio_id);
		$servicios->precio_proveedor=null;
		$servicios->precio_c=0;
		$servicios->estado_contabilidad=0;
		$servicios->notas_contabilidad='';
		$servicios->notas_contabilidad_aprovador='';
		$servicios->precio_confirmado_contabilidad=0;		
		$servicios->proveedor_id=0;
		$servicios->fecha_venc=null;
		// $servicios->codigo_verificacion=null;
		$servicios->prioridad='NORMAL ';
		$servicios->boleta_factura=0;
		$servicios->requerimientos_id=0;
		$servicios->estado_contabilidad=0;
		$servicios->save();

		return response()->json(['mensaje'=>'1']);

		// if($action=='a'){
		// 	$productos=M_Producto::where('localizacion',$servicios->localizacion)->where('grupo',$servicios->grupo)->whereIn('tipo_producto',$arregloo)->where('clase',$servicios->clase)->where('nombre',$servicios->nombre)->get();
		// }
		// else if($action=='e'){
		// 	$productos=M_Producto::where('localizacion',$servicios->localizacion)->where('grupo',$servicios->grupo)->where('tipo_producto',$servicios->tipoServicio)->where('clase',$servicios->clase)->where('nombre',$servicios->nombre)->get();
		// }
		// return view('admin.book.traer-lista-proveedores-servicios',compact('productos','cotizacion','servicios','itinerario_id','action'));	
	}
	public function traer_lista_proveedores_servicios_borrar_hotel(Request $request){
		$hotel_id = $request->input('hotel_id');
		$hotel=PrecioHotelReserva::find($hotel_id);
		$hotel->precio_s_r=null;
		$hotel->precio_s_c=null;
		$hotel->precio_d_r=null;
		$hotel->precio_d_c=null;
		$hotel->precio_m_r=null;
		$hotel->precio_m_c=null;
		$hotel->precio_t_r=null;
		$hotel->precio_t_c=null;
		$hotel->estado_contabilidad=0;
		$hotel->notas_contabilidad=null;
		$hotel->notas_contabilidad_aprovador=null;
		$hotel->precio_confirmado_contabilidad=0;
		$hotel->proveedor_id=0;
		$hotel->fecha_venc=null;
		// $hotel->codigo_verificacion=null;
		$hotel->prioridad='NORMAL';
		$hotel->requerimientos_id=0;
		$hotel->estado_contabilidad=0;
		$hotel->save();

		return response()->json(['mensaje'=>'1']);

		// if($action=='a'){
		// 	$productos=M_Producto::where('localizacion',$servicios->localizacion)->where('grupo',$servicios->grupo)->whereIn('tipo_producto',$arregloo)->where('clase',$servicios->clase)->where('nombre',$servicios->nombre)->get();
		// }
		// else if($action=='e'){
		// 	$productos=M_Producto::where('localizacion',$servicios->localizacion)->where('grupo',$servicios->grupo)->where('tipo_producto',$servicios->tipoServicio)->where('clase',$servicios->clase)->where('nombre',$servicios->nombre)->get();
		// }
		// return view('admin.book.traer-lista-proveedores-servicios',compact('productos','cotizacion','servicios','itinerario_id','action'));	
	}

}
