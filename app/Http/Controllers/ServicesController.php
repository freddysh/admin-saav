<?php

namespace App\Http\Controllers;

use App\Web;
use App\Hotel;
use App\M_Destino;
use App\Proveedor;
use App\GrupoOpera;
use App\M_Category;
use App\M_Producto;
use App\M_Servicio;
use App\DestinosOpera;
use App\ProveedorClases;
use App\ItinerarioServicios;
use Illuminate\Http\Request;
use App\M_ItinerarioServicio;
use Illuminate\Http\Response;
use App\P_ItinerarioServicios;
use App\PrecioHotelReserva;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class ServicesController extends Controller
{
    //
    public function index()
    {
        $destinations = M_Destino::get();
        $servicios = M_Servicio::get();
        $categorias = M_Category::get();
        $hotel = Hotel::get();
        session()->put('menu-lateral', 'Sproducts');
        $proveedores = Proveedor::get();
        $costos = M_Producto::get();
        $webs=Web::get();
        return view('admin.database.services', ['servicios' => $servicios, 'categorias' => $categorias, 'destinations' => $destinations, 'hotel' => $hotel, 'proveedores' => $proveedores, 'costos' => $costos,'webs'=>$webs]);
    }

    public function store(Request $request)
    {
        $categorias = M_Category::get();
        $webs=Web::get();
        foreach ($categorias as $categoria) {
            $cate[] = $categoria->nombre;
        }
        $posTipo = $request->input('posTipo');
        $txt_localizacion = $request->input('txt_localizacion_' . $posTipo);
        if($txt_localizacion==null)
            $txt_localizacion='';


//        dd($txt_localizacion);
        if ($posTipo == 0) {
            $nro_existe_hotel=Hotel::where('localizacion', $txt_localizacion)->count('id');
            if($nro_existe_hotel==0){
                $S_2 = $request->input('S_2');
                $D_2 = $request->input('D_2');
                $M_2 = $request->input('M_2');
                $T_2 = $request->input('T_2');
                $SS_2 = $request->input('SS_2');
                $SD_2 = $request->input('SD_2');
                $SU_2 = $request->input('SU_2');
                $JS_2 = $request->input('JS_2');

                $S_3 = $request->input('S_3');
                $D_3 = $request->input('D_3');
                $M_3 = $request->input('M_3');
                $T_3 = $request->input('T_3');
                $SS_3 = $request->input('SS_3');
                $SD_3 = $request->input('SD_3');
                $SU_3 = $request->input('SU_3');
                $JS_3 = $request->input('JS_3');

                $S_4 = $request->input('S_4');
                $D_4 = $request->input('D_4');
                $M_4 = $request->input('M_4');
                $T_4 = $request->input('T_4');
                $SS_4 = $request->input('SS_4');
                $SD_4 = $request->input('SD_4');
                $SU_4 = $request->input('SU_4');
                $JS_4 = $request->input('JS_4');

                $S_5 = $request->input('S_5');
                $D_5 = $request->input('D_5');
                $M_5 = $request->input('M_5');
                $T_5 = $request->input('T_5');
                $SS_5 = $request->input('SS_5');
                $SD_5 = $request->input('SD_5');
                $SU_5 = $request->input('SU_5');
                $JS_5 = $request->input('JS_5');

                //-- GUARDAMOS LOS DATOS DE LOS HOTELES


                $hotel_proveedor = new Hotel();
                $hotel_proveedor->localizacion = $txt_localizacion;
                $hotel_proveedor->estrellas = 2;
                $hotel_proveedor->single = $S_2;
                $hotel_proveedor->doble = $D_2;
                $hotel_proveedor->matrimonial = $M_2;
                $hotel_proveedor->triple = $T_2;
                $hotel_proveedor->superior_s = $SS_2;
                $hotel_proveedor->superior_d = $SD_2;
                $hotel_proveedor->suite = $SU_2;
                $hotel_proveedor->jr_suite = $JS_2;
                $hotel_proveedor->estado = 1;
                $hotel_proveedor->save();

                $hotel_proveedor_3 = new Hotel();
                $hotel_proveedor_3->localizacion = $txt_localizacion;
                $hotel_proveedor_3->estrellas = 3;
                $hotel_proveedor_3->single = $S_3;
                $hotel_proveedor_3->doble = $D_3;
                $hotel_proveedor_3->matrimonial = $M_3;
                $hotel_proveedor_3->triple = $T_3;
                $hotel_proveedor_3->superior_s = $SS_3;
                $hotel_proveedor_3->superior_d = $SD_3;
                $hotel_proveedor_3->suite = $SU_3;
                $hotel_proveedor_3->jr_suite = $JS_3;
                $hotel_proveedor_3->estado = 1;
                $hotel_proveedor_3->save();

                $hotel_proveedor_4 = new Hotel();
                $hotel_proveedor_4->localizacion = $txt_localizacion;
                $hotel_proveedor_4->estrellas = 4;
                $hotel_proveedor_4->single = $S_4;
                $hotel_proveedor_4->doble = $D_4;
                $hotel_proveedor_4->matrimonial = $M_4;
                $hotel_proveedor_4->triple = $T_4;
                $hotel_proveedor_4->superior_s = $SS_4;
                $hotel_proveedor_4->superior_d = $SD_4;
                $hotel_proveedor_4->suite = $SU_4;
                $hotel_proveedor_4->jr_suite = $JS_4;
                $hotel_proveedor_4->estado = 1;
                $hotel_proveedor_4->save();

                $hotel_proveedor_5 = new Hotel();
                $hotel_proveedor_5->localizacion = $txt_localizacion;
                $hotel_proveedor_5->estrellas = 5;
                $hotel_proveedor_5->single = $S_5;
                $hotel_proveedor_5->doble = $D_5;
                $hotel_proveedor_5->matrimonial = $M_5;
                $hotel_proveedor_5->triple = $T_5;
                $hotel_proveedor_5->superior_s = $SS_5;
                $hotel_proveedor_5->superior_d = $SD_5;
                $hotel_proveedor_5->suite = $SU_5;
                $hotel_proveedor_5->jr_suite = $JS_5;
                $hotel_proveedor_5->estado = 1;
                $hotel_proveedor_5->save();
                return redirect()->route('service_index_path');
            }
            else{
                return back();
            }
        } elseif ($posTipo != 0) {
            $txt_type = $request->input('txt_type_' . $posTipo);
//            $txt_acomodacion = $request->input('txt_acomodacion_' . $posTipo);
            $txt_product = $request->input('txt_product_' . $posTipo);
            $txt_price = $request->input('txt_price_' . $posTipo);
            $txt_tipo_grupo = $request->input('txt_tipo_grupo_' . $posTipo);
            $txt_salida = $request->input('txt_salida_' . $posTipo);
            $txt_ruta_salida = $request->input('txt_ruta_salida_' . $posTipo);
            $txt_llegada = $request->input('txt_llegada_' . $posTipo);
            $txt_ruta_llegada = $request->input('txt_ruta_llegada_' . $posTipo);
            $txt_min_personas = $request->input('txt_min_personas_' . $posTipo);
            $txt_max_personas = $request->input('txt_max_personas_' . $posTipo);
            $txt_codigo = $request->input('txt_codigo_' . $posTipo);
            $txt_clase = $request->input('txt_clase_' . $posTipo);

            $servicio_buscado=M_Servicio::where('localizacion',$txt_localizacion)
                                ->where('grupo',$cate[$posTipo])
                                ->where('tipoServicio',$txt_type)
                                ->where('nombre',$txt_product)
                                ->where('clase',$txt_clase)->count('id');

            if($servicio_buscado==0){
                if($cate[$posTipo]=='MOVILID') {
                    $rutaAB = $request->input('txt_ruta_salida_' . $posTipo);
                    $rutaAB = explode('-', $rutaAB);
                    $txt_ruta_salida = $rutaAB[0];
                    $txt_ruta_llegada = $rutaAB[1];
                }
                if($cate[$posTipo]=='TRAINS') {
                    $provider = $request->input('txt_provider_' . $posTipo);
                    $pro = explode('_', $provider);
                    $txt_pro_id = $pro[0];
                    $txt_pro_nombre= $pro[1];

                }
                $destino = new M_Servicio();
                $destino->grupo = $cate[$posTipo];
                $destino->localizacion = $txt_localizacion;
                $destino->tipoServicio = $txt_type;
    //            $destino->acomodacion = $txt_acomodacion;
                $destino->nombre = $txt_product;
                $destino->precio_venta = $txt_price;
                $destino->salida = $txt_salida;
                $destino->ruta_salida = $txt_ruta_salida;
                $destino->llegada = $txt_llegada;
                $destino->ruta_llegada = $txt_ruta_llegada;
                $destino->clase = $txt_clase;
                $destino->min_personas = $txt_min_personas;
                $destino->max_personas = $txt_max_personas;

                if ($txt_tipo_grupo == 'Absoluto')
                    $destino->precio_grupo = 1;
                elseif ($txt_tipo_grupo == 'Individual')
                    $destino->precio_grupo = 0;
    //        $found_destino=M_Servicio::where('nombre',$txt_product)->get();
    //        if(count($found_destino)==0)
                $pro_id= $request->input('pro_id');
                $pro_val= $request->input('pro_val');
                {
                    $destino->save();
                    $destino->codigo = $txt_codigo;
                    $destino->save();

    //                $posTipo=$request->input('posTipo');
                    if($pro_id) {
                        foreach ($pro_id as $key => $pro_id_) {
                            $proveedor = Proveedor::FindOrFail($pro_id_);
                            $new_service = new M_Producto();
                            $new_service->codigo = $destino->codigo;
                            $new_service->grupo = $destino->grupo;
                            $new_service->localizacion = $request->input('txt_localizacion_' . $posTipo);
                            $new_service->tipo_producto = $request->input('txt_type_' . $posTipo);
                            $new_service->nombre = $destino->nombre;
                            $new_service->precio_costo = $pro_val[$key];
                            $new_service->precio_grupo = $destino->precio_grupo;
                            $new_service->clase = $destino->clase;
                            $new_service->salida = $destino->salida;
                            $new_service->llegada = $destino->llegada;
                            $new_service->min_personas = $destino->min_personas;
                            $new_service->max_personas = $destino->max_personas;
                            $new_service->m_servicios_id = $destino->id;
                            $new_service->proveedor_id = $proveedor->id;
                            $new_service->save();
                        }
                    }
                    return redirect()->route('service_index_path');
                }
            }
        }
    }

    public function edit_hotel(Request $request)
    {
        $id = $request->input('id');
        $S_2 = $request->input('eS_2');
        $D_2 = $request->input('eD_2');
        $M_2 = $request->input('eM_2');
        $T_2 = $request->input('eT_2');
        $SS_2 = $request->input('eSS_2');
        $SD_2 = $request->input('eSD_2');
        $SU_2 = $request->input('eSU_2');
        $JS_2 = $request->input('eJS_2');


        $hotel_proveedor = Hotel::FindOrFail($id);
        $hotel_proveedor->single = $S_2;
        $hotel_proveedor->doble = $D_2;
        $hotel_proveedor->matrimonial = $M_2;
        $hotel_proveedor->triple = $T_2;
        $hotel_proveedor->superior_s = $SS_2;
        $hotel_proveedor->superior_d = $SD_2;
        $hotel_proveedor->suite = $SU_2;
        $hotel_proveedor->jr_suite = $JS_2;
        $hotel_proveedor->estado = 1;
        $hotel_proveedor->save();
        $destinations = M_Destino::get();
        $servicios = M_Servicio::get();
        $categorias = M_Category::get();
        $hotel = Hotel::get();
        $webs = Web::get();
        $proveedores=Proveedor::get();
        $grupo='HOTELS';
        return view('admin.database.services', ['servicios' => $servicios,'proveedores'=>$proveedores, 'categorias' => $categorias, 'destinations' => $destinations, 'hotel' => $hotel,'grupo'=>$grupo,'webs'=>$webs]);
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        $servicio = M_Servicio::FindOrFail($id);
        $nro_files_serv_usados=ItinerarioServicios::where('grupo',$servicio->grupo)
                            ->where('localizacion',$servicio->localizacion)
                            ->where('tipoServicio',$servicio->tipoServicio)
                            ->where('clase',$servicio->clase)
                            ->where('nombre',$servicio->nombre)
                            ->count('id');

        $nro_templates_serv_usados=P_ItinerarioServicios::where('m_servicios_id',$id)->count('id');
        $nro_m_itinerario_servicios_usados=M_ItinerarioServicio::where('m_servicios_id',$id)->count('id');


        // $nro_productos_usados=M_Producto::where('grupo',$servicio->grupo)
        //                     ->where('localizacion',$servicio->localizacion)
        //                     ->where('tipo_producto',$servicio->tipoServicio)
        //                     ->where('clase',$servicio->clase)
        //                     ->where('nombre',$servicio->nombre)
        //                     ->count('id');


        if($nro_files_serv_usados==0){
            if($nro_templates_serv_usados==0){
                if($nro_m_itinerario_servicios_usados==0){
                    if ($servicio->delete())
                        return '1_';
                    else
                        return '0_';
                }
                else{
                    return '2_El servicio esta siendo usado en un dia';
                }
            }
            else{
                return '2_El servicio esta siendo usado en una plantilla';
            }
        }
        else{
            return '2_El servicio esta siendo usado en una cotizacion';
        }
    }
    public function edit(Request $request)
    {
        $id = $request->input('id');
        $txt_grupo=$request->input('grupo_' . $id);
        $posTipo = $request->input('posTipo');
        $txt_localizacion = $request->input('txt_localizacion_' . $id);
        $txt_type = $request->input('txt_type_' . $id);
//        $txt_class='';
        if ($txt_grupo == 'TRAINS') {
            $prove=explode('_', $request->input('txt_provider_'.$id));
            $txt_type = $request->input('txt_class_'.$id.'_'. $prove[0]);
        }
        $txt_acomodacion = $request->input('txt_acomodacion_' . $id);
        $txt_product = $request->input('txt_product_' . $id);
        $txt_price = $request->input('txt_price_' . $id);
        $txt_tipo_grupo = $request->input('txt_tipo_grupo_' . $id);
        $txt_salida = $request->input('txt_salida_' . $id);
        $txt_ruta_salida = $request->input('txt_ruta_salida_' . $id);
        $txt_llegada = $request->input('txt_llegada_' . $id);
        $txt_ruta_llegada = $request->input('txt_ruta_llegada_' . $id);
        $txt_min_personas = $request->input('txt_min_personas_' . $id);
        $txt_max_personas = $request->input('txt_max_personas_' . $id);
        $txt_clase = $request->input('txt_clase_' . $id);

        if ($txt_grupo=='MOVILID') {
            $rutaAB = $request->input('txt_ruta_salida_' . $id);
            $rutaAB = explode('-', $rutaAB);
            $txt_ruta_salida = $rutaAB[0];
            $txt_ruta_llegada = $rutaAB[1];
        }
        $m_servicio = M_Servicio::FindOrFail($id);
        $destino = M_Servicio::FindOrFail($id);
        $destino->localizacion = $txt_localizacion;
        $destino->tipoServicio = $txt_type;
        $destino->acomodacion = $txt_acomodacion;
        $destino->nombre = $txt_product;
        $destino->precio_venta = $txt_price;
        $destino->salida = $txt_salida;
        $destino->ruta_salida = $txt_ruta_salida;
        $destino->llegada = $txt_llegada;
        $destino->ruta_llegada = $txt_ruta_llegada;
        $destino->min_personas = $txt_min_personas;
        $destino->max_personas = $txt_max_personas;
        $destino->clase = $txt_clase;

        if ($txt_tipo_grupo == 'Absoluto')
            $destino->precio_grupo = 1;
        elseif ($txt_tipo_grupo == 'Individual')
            $destino->precio_grupo = 0;
        $destino->save();

        $p_itinerario_servicios=P_ItinerarioServicios::where('m_servicios_id', $id)->get();
        foreach ($p_itinerario_servicios as $value) {
            $p_itinerario_servicios_temp=P_ItinerarioServicios::find($value->id);
            $p_itinerario_servicios_temp->nombre=$destino->nombre;
            $p_itinerario_servicios_temp->precio_grupo=$destino->precio_grupo;
            $p_itinerario_servicios_temp->precio=$destino->precio;
            $p_itinerario_servicios_temp->min_personas=$destino->min_personas;
            $p_itinerario_servicios_temp->max_personas=$destino->max_personas;
            $p_itinerario_servicios_temp->save();
        }
        // return $destino->tipoServicio;
        $costo_id= $request->input('costo_id');
        // return $costo_id;
        $costo_val= $request->input('costo_val');
        if($costo_id!=''){
            $costos_bolsa = M_Producto::where('m_servicios_id', $id)->get();
            foreach ($costos_bolsa as $costos_bolsa_) {
                if (in_array($costos_bolsa_->id, $costo_id)) {
                    foreach ($costo_id as $key => $costo_id_) {
                        // $producto = M_Producto::FindOrFail($costo_id_);
                        $producto = M_Producto::FindOrFail($costos_bolsa_->id);
                        $producto->localizacion = $destino->localizacion;
                        $producto->tipo_producto = $txt_type;
                        $producto->nombre = $destino->nombre;
                        $producto->precio_costo = $costo_val[$key];
                        $producto->precio_grupo = $destino->precio_grupo;
                        $producto->clase =$destino->clase;
                        $producto->salida = $destino->salida;
                        $producto->llegada = $destino->llegada;
                        $producto->max_personas = $destino->max_personas;
                        $producto->min_personas = $destino->min_personas;
                        $producto->save();
                        // return $producto;

                    }
                } else {
                    $producto = M_Producto::FindOrFail($costos_bolsa_->id);
                    $producto->delete();
                }
            }
            $itinerario_servs=ItinerarioServicios::where('grupo', $m_servicio->grupo)
                            ->where('grupo', $m_servicio->grupo)
                            ->where('localizacion', $m_servicio->localizacion)
                            ->where('tipoServicio', $m_servicio->tipoServicio)
                            ->where('clase', $m_servicio->clase)
                            ->where('nombre', $m_servicio->nombre)
                            ->get();
            foreach ($itinerario_servs as $value) {
                $itinerario_serv=ItinerarioServicios::find($value->id);
                $itinerario_serv->nombre=$destino->nombre;
                $itinerario_serv->precio_grupo=$destino->precio_grupo;
                $itinerario_serv->min_personas=$destino->min_personas;
                $itinerario_serv->max_personas=$destino->max_personas;
                $itinerario_serv->tipoServicio=$destino->tipoServicio;
                $itinerario_serv->localizacion=$destino->localizacion;
                $itinerario_serv->clase=$destino->clase;
                $itinerario_serv->salida=$destino->salida;
                $itinerario_serv->llegada=$destino->llegada;
                $itinerario_serv->s_p=$destino->tipoServicio;
                $itinerario_serv->save();
            }
        }
        $pro_id= $request->input('pro_id');
        $pro_val= $request->input('pro_val');
        $cadena='';
        if($pro_id!='') {
            foreach ($pro_id as $key => $pro_id_) {
                $proveedor = Proveedor::FindOrFail($pro_id_);
                $new_service = new M_Producto();
                $new_service->codigo = $destino->codigo;
                $new_service->grupo = $destino->grupo;
                $new_service->localizacion = $destino->localizacion;
                $new_service->tipo_producto = $txt_type;
                $new_service->nombre = $destino->nombre;
                $new_service->precio_costo = $pro_val[$key];
                $new_service->precio_grupo = $destino->precio_grupo;
                $new_service->clase = $destino->clase;
                $new_service->salida = $destino->salida;
                $new_service->llegada = $destino->llegada;
                $new_service->min_personas = $destino->min_personas;
                $new_service->max_personas = $destino->max_personas;
                $new_service->m_servicios_id = $destino->id;
                $new_service->proveedor_id = $proveedor->id;
                $new_service->save();
                $cadena.='_'.$pro_id_;
            }
        }
//        dd($cadena);
//        return dd($destino);
//        return json_encode(1);
        return $txt_type . '_' . $txt_min_personas . '_' . $txt_max_personas . '_' . $txt_price . '_' . $txt_product;
//        return redirect()->route('service_index_path');
    }

    public function autocomplete()
    {
        $term = Input::get('term');
        $localizacion = Input::get('localizacion');
        $grupo = Input::get('grupo');
        $results = null;
        $results = [];
        $proveedor = M_Servicio::where('codigo', 'like', '%' . $term . '%')
            ->orWhere('nombre', 'like', '%' . $term . '%')
            ->get();
        foreach ($proveedor as $query) {
            if ($grupo == $query->grupo) {
                if ($localizacion == $query->localizacion) {
                    $pre = 'Invididual';
                    if ($query->precio_grupo == 1)
                        $pre = 'Absoluto';
                    $results[] = ['id' => $query->id, 'value' => $query->codigo . ' ' . $query->nombre . ' ' . $query->tipoServicio . '->con precio ' . $pre];
                }
            }
        }
        return response()->json($results);
    }

    public function listarServicios_destino(Request $request)
    {
        // return 'hol';
        set_time_limit(0);
        $filtro = $request->input('filtro');
        $destino = $request->input('destino');
        $ruta = $request->input('ruta');
        $ruta =explode('-',$ruta);
        $tipo = $request->input('tipo');
        $id = $request->input('id');
        $destino = explode('_', $destino);
        $sericios = M_Servicio::where('grupo', $destino[1])->where('localizacion', $destino[2])->get();
        $destinations = M_Destino::get();
        $destino_escojido = M_Destino::where('destino',$destino[2])->first();
        $proveedores=Proveedor::whereHas('grupos_operados',function($query)use($id){
                        $query->where('m_category_id',$id);
                    })
                    ->orWhere('grupo',$destino[1])
                    ->whereHas('destinos_operados',function($query1)use($destino_escojido){
                        $query1->where('m_destinos_id',$destino_escojido->id);
                    })->get();

        $costos=M_Producto::get();
        $categoria_id = $id;
        $destino_operados=DestinosOpera::get();
        $grupos_operados=GrupoOpera::get();
        $categorias=M_Category::get();
    //    return  dd('holaa');
//        return view('admin.contabilidad.lista-servicios',compact(['id','destino','destinations','sericios','proveedores','costos','categoria_id','filtro']));
         return view('admin.contabilidad.lista-servicios',compact(['id','destino','destinations','sericios','proveedores','costos','categoria_id','ruta','filtro','tipo','destino_operados','grupos_operados','categorias']));
    }

    public function eliminar_servicio_hotel(Request $request)
    {
        $id = $request->input('id');
        $servicio = Hotel::FindOrFail($id);
        $nro_files_serv_usados=PrecioHotelReserva::where('hotel_id',$id)->count('id');
        if($nro_files_serv_usados==0){
            if ($servicio->delete())
                return 1;
            else
                return 0;
        }
        else
            return 2;

    }

    public function nuevo_producto()
    {
        $destinations = M_Destino::get();
        $servicios = M_Servicio::get();
        $categorias = M_Category::get();
        $hotel = Hotel::get();
        session()->put('menu-lateral', 'Sproducts');
//        $proveedores = Proveedor::get();
        $destino_escojido = M_Destino::where('destino','CUSCO')->first();
        $proveedores=Proveedor::whereHas('destinos_operados',function($query1)use($destino_escojido){
                $query1->where('m_destinos_id',$destino_escojido->id);
            })->orWhere('localizacion','CUSCO')->get();
//        dd($proveedores);
        $costos = M_Producto::get();
        $destino_operados=DestinosOpera::get();
        $webs=Web::get();
        return view('admin.database.new_service', ['servicios' => $servicios, 'categorias' => $categorias, 'destinations' => $destinations, 'hotel' => $hotel, 'proveedores' => $proveedores, 'costos' => $costos,'destino_operados'=>$destino_operados,'webs'=>$webs]);
    }
    public function listar_proveedores_service(Request $request)
    {
        $localizacion= $request->input('localizacion');
        $grupo= $request->input('grupo');
        $pos= $request->input('pos');
        $categoria= $request->input('categoria');
        $proveedores=Proveedor::where('grupo',$grupo)->get();
        $destino_escojido = M_Destino::where('destino',$localizacion)->first();
        $proveedores=Proveedor::whereHas('grupos_operados',function($query)use($categoria){
            $query->where('m_category_id',$categoria);
        })
            ->orWhere('grupo',$grupo)
            ->whereHas('destinos_operados',function($query1)use($destino_escojido){
                $query1->where('m_destinos_id',$destino_escojido->id);
            })->get();

        $cadena='';
        foreach ($proveedores as $proveedor){
//            $destino_id=M_Destino::where('destino',$localizacion)->first();
//            $destino_operado=DestinosOpera::where('proveedor_id',$proveedor->id)->where('m_destinos_id',$destino_id->id)->count();
//            if($destino_operado>0) {
                $cadena .= '<label class="text-primary display-block">
                        <input class="proveedores_' . $pos . '" type="checkbox" aria-label="..." name="proveedores_[]" value="' . $proveedor->id . '_' . $proveedor->nombre_comercial . '">
                        ' . $proveedor->nombre_comercial . '
                        </label>';
//            }
        }
        if($cadena==''){
            $cadena='<div class="alert alert-danger text-center">
                    <p class="text-16">Ups!!! No hay proveedores para este destino</p>
                    <span>Dirijase a <a target="_blank" href="'.route('provider_index_path').'">Providers</a> para ingresar nuevos proveedores</span>
                    </div>';
        }
        return $cadena;

    }
    public function eliminar_proveedores_service(Request $request)
    {
        $confirmacion= $request->input('confirmacion');
        $id= $request->input('id');
        $costo_id= $request->input('costo_id');
        $proveedor_id= $request->input('proveedor_id');

        if($confirmacion=='borrar'){
            $costo=M_Producto::FindOrFail($costo_id);
            $valor=$costo->delete();
            if($valor>0)
                return 1;
            else
                return 0;
        }
        else{
            $m_servicio=M_Servicio::find($id);
            $nro_usados=ItinerarioServicios::where('localizacion',$m_servicio->localizacion)
            ->where('grupo',$m_servicio->grupo)
            ->where('tipoServicio',$m_servicio->tipoServicio)
            ->where('clase',$m_servicio->clase)
            ->where('nombre',$m_servicio->nombre)
            ->where('proveedor_id',$proveedor_id)->count('proveedor_id');

            if($nro_usados>0){
                return 2;
            }
            elseif($nro_usados==0){
                $costo=M_Producto::FindOrFail($costo_id);
                $valor=$costo->delete();
                if($valor>0)
                    return 1;
                else
                    return 0;
            }
        }
    }

    public function listarServicios_destino_empresa(Request $request)
    {
        $proveedor_id =explode('_',$request->input('empresa_id'));
//        $clases=ProveedorClases::where('proveedor_id',$proveedor_id)->get();
//        $clases_=[];
//        foreach($clases->where('estado',1) as $clase){
//            $clases_[]=$clase->clase;
//        }
        $id = $request->input('id');

        $destino = '001_TRAINS';
        $destino = explode('_', $destino);

        $sericios = M_Servicio::where('grupo', 'TRAINS')->where('localizacion',$proveedor_id[2])->get();
        $destinations = M_Destino::get();
        return view('admin.contabilidad.lista-servicios-empresa',compact(['destino','sericios','destinations']));

    }
    public function mostrar_clases(Request $request){
        $proveedor_id=$request->input('proveedor_id');
        $pos=$request->input('pos');
        $clases=ProveedorClases::where('proveedor_id',$proveedor_id)->get();
        return view('admin.contabilidad.lista-clases',compact(['clases','pos']));
    }
    public function listar_rutas_movilidad(Request $request){
        $punto_inicio=$request->input('punto_inicio');
        $pos=$request->input('pos');
        return view('admin.contabilidad.lista-ruta',compact(['punto_inicio','pos']));
    }
    public function listarServicios_destino_show_rutas(Request $request){
        $ruta=explode('_',$request->input('destino'));
//        dd($punto_inicio);
        $punto_inicio=$ruta[2];
        $grupo=$request->input('grupo');
        $id=$request->input('id');
        $pos=$request->input('pos');
        return view('admin.contabilidad.lista-ruta-listar',compact(['punto_inicio','grupo','id','pos']));
    }


    public function listarServicios_destino_por_rutas_tipos(Request $request){
        $ruta=explode('_',$request->input('destino'));
        $punto_inicio=$ruta[2];
        $grupo=$request->input('grupo');
        $id=$request->input('id');
        $pos=$request->input('pos');
        return view('admin.contabilidad.lista-ruta-tipo-listar',compact(['punto_inicio','grupo','id','pos']));
    }

    public function listar_rutas_train_salida(Request $request){
        $punto_inicio=$request->input('punto_inicio');
        $pos=$request->input('pos');
        return view('admin.contabilidad.lista-ruta-salida',compact(['punto_inicio','pos']));
    }
    public function listar_rutas_train_llegada(Request $request){
        $punto_inicio=$request->input('punto_inicio');
        $pos=$request->input('pos');
        return view('admin.contabilidad.lista-ruta-llegada',compact(['punto_inicio','pos']));
    }
    public function listar_servicios(Request $request){
        $itinerario_id=$request->input('itinerario_id');
        $localizacion=$request->input('localizacion');
        $grupo=$request->input('grupo');
        $servicios_id=$request->input('servicios_id');

        if($grupo=='HOTELS'){
            $hotel=PrecioHotelReserva::find($servicios_id);
            $destinations=M_Destino::get();
            $hoteles=Hotel::where('localizacion','CUSCO')->get();
            return view('admin.book.mostrar-servicios-hotel',compact(['destinations','hoteles','hotel','itinerario_id']));
        }
        else{
            $m_servicios=M_Servicio::where('localizacion',$localizacion)->where('grupo',$grupo)->get();
            $destinos=M_Destino::get();
            $proveedores=Proveedor::where('grupo',$grupo)->get();
            return view('admin.book.mostrar-servicios',compact(['m_servicios','servicios_id','grupo','localizacion','destinos','itinerario_id','proveedores']));
        }
    }
    public function listar_servicios_localizacion(Request $request){
        $itinerario_id=$request->input('itinerario_id');
        $localizacion=$request->input('localizacion');
        $grupo=$request->input('grupo');
        $servicios_id=$request->input('servicios_id');
        $proveedor_id=$request->input('proveedor_id');
        $clases=ProveedorClases::where('proveedor_id',$proveedor_id)->where('estado','1')->get();
        $m_servicios=M_Servicio::where('localizacion',$localizacion)->where('grupo',$grupo)->where('estado','1')->get();
        $destinos=M_Destino::get();
        return view('admin.book.mostrar-servicios-localizacion',compact(['m_servicios','servicios_id','grupo','localizacion','destinos','itinerario_id','clases']));
    }
    public function listar_servicios_paso1(Request $request){
        $modo=$request->input('modo');
        $itinerario_id=$request->input('itinerario_id');
        $localizacion=$request->input('localizacion');
        $destino=M_Destino::find($localizacion);
        $localizacion=$destino->destino;
        $grupo=$request->input('grupo');
        $servicios_id=$request->input('servicios_id');
        $m_servicios=M_Servicio::where('localizacion',$localizacion)->where('grupo',$grupo)->where('estado','1')->get();
        $destinos=M_Destino::get();
        $proveedores=Proveedor::where('grupo',$grupo)->get();
        return view('admin.book.mostrar-servicios-paso1',compact(['m_servicios','servicios_id','grupo','localizacion','destinos','itinerario_id','proveedores','modo']));
    }
    public function listar_servicios_localizacion_paso1(Request $request){
        $itinerario_id=$request->input('itinerario_id');
        $localizacion=$request->input('localizacion');
        $grupo=$request->input('grupo');
        $servicios_id=$request->input('servicios_id');
        $proveedor_id=$request->input('proveedor_id');
        $clases=ProveedorClases::where('proveedor_id',$proveedor_id)->where('estado','1')->get();
        $m_servicios=M_Servicio::where('localizacion',$localizacion)->where('grupo',$grupo)->where('estado','1')->orderBy('nombre','asc')->get();
        $destinos=M_Destino::get();
        return view('admin.book.mostrar-servicios-localizacion-paso1',compact(['m_servicios','servicios_id','grupo','localizacion','destinos','itinerario_id','clases']));
    }
    public function nuevos_servicios($cliente_id,$cotizacion_id,$paquete_precio_id)
    {
        $cliente=Cliente::FindOrFail($cliente_id);
        $cotizaciones=Cotizacion::where('id',$cotizacion_id)->get();
        $m_servicios=M_Servicio::get();
        // return view('admin.agregar-servicio-hotel',['cliente'=>$cliente,'cotizaciones'=>$cotizaciones,/*'destinos'=>$destinos*/'m_servicios'=>$m_servicios,'paquete_precio_id'=>$pqt_id]);
        return view('admin.agregar-servicio-hotel',['cliente'=>$cliente,'cotizaciones'=>$cotizaciones,/*'destinos'=>$destinos*/'m_servicios'=>$m_servicios,'paquete_precio_id'=>$paquete_precio_id]);

    }
    public function cambiar_estado(Request $request)
    {
        $m_servicio_id= $request->input('id');
        $estado= $request->input('estado');
        $servicio=M_Servicio::find($m_servicio_id);
        if($estado==0)
            $servicio->estado=1;
        elseif($estado==1)
            $servicio->estado=0;
        if($servicio->save())
            return 1;
        else
            return 0;

    }
}
