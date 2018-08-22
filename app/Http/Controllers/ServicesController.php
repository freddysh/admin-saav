<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\ItinerarioServicios;
use App\M_Category;
use App\M_Producto;
use App\M_Servicio;
use App\M_Destino;
use App\Proveedor;
use App\ProveedorClases;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        return view('admin.database.services', ['servicios' => $servicios, 'categorias' => $categorias, 'destinations' => $destinations, 'hotel' => $hotel, 'proveedores' => $proveedores, 'costos' => $costos]);
    }

    public function store(Request $request)
    {
        $categorias = M_Category::get();

        foreach ($categorias as $categoria) {
            $cate[] = $categoria->nombre;
        }
        $posTipo = $request->input('posTipo');
        $txt_localizacion = $request->input('txt_localizacion_' . $posTipo);
        if($txt_localizacion==null)
            $txt_localizacion='';
//        dd($txt_localizacion);
        if ($posTipo == 0) {
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

//            $destinations = M_Destino::get();
//            $servicios = M_Servicio::get();
//            $categorias = M_Category::get();
//            $hotel = Hotel::get();
//            return view('admin.database.services', ['servicios' => $servicios, 'categorias' => $categorias, 'destinations' => $destinations, 'hotel' => $hotel]);
            return redirect()->route('service_index_path');
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
        return view('admin.database.services', ['servicios' => $servicios, 'categorias' => $categorias, 'destinations' => $destinations, 'hotel' => $hotel]);
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        $servicio = M_Servicio::FindOrFail($id);
        if ($servicio->delete())
            return 1;
        else
            return 0;
    }

    public function edit(Request $request)
    {
        $id = $request->input('id');
        $txt_grupo=$request->input('grupo_' . $id);
        $posTipo = $request->input('posTipo');
        $txt_localizacion = $request->input('txt_localizacion_' . $id);
        $txt_type = $request->input('txt_type_' . $id);
//        $txt_class='';
        if($txt_grupo=='TRAINS'){
            $prove=explode('_',$request->input('txt_provider_'.$id));
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


        if($txt_grupo=='MOVILID') {
            $rutaAB = $request->input('txt_ruta_salida_' . $id);
            $rutaAB = explode('-', $rutaAB);
            $txt_ruta_salida = $rutaAB[0];
            $txt_ruta_llegada = $rutaAB[1];
        }
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

        $costo_id= $request->input('costo_id');
        $costo_val= $request->input('costo_val');
        if($costo_id!=''){
            $costos_bolsa = M_Producto::where('m_servicios_id', $id)->get();
            foreach ($costos_bolsa as $costos_bolsa_) {
                if (in_array($costos_bolsa_->id, $costo_id)) {
                    foreach ($costo_id as $key => $costo_id_) {
                        $producto = M_Producto::FindOrFail($costo_id_);
                        $producto->precio_costo = $costo_val[$key];
                        $producto->tipo_producto = $txt_type;
                        $producto->save();
                    }
                } else {
                    $producto = M_Producto::FindOrFail($costos_bolsa_->id);
                    $producto->delete();
                }
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
        $filtro = $request->input('filtro');
        $destino = $request->input('destino');
        $ruta = $request->input('ruta');
        $ruta =explode('-',$ruta);
        $tipo = $request->input('tipo');
        $id = $request->input('id');
        $destino = explode('_', $destino);
        $sericios = M_Servicio::where('grupo', $destino[1])->where('localizacion', $destino[2])->get();
        $destinations = M_Destino::get();
        $proveedores=Proveedor::get();
        $costos=M_Producto::get();
        $categoria_id = $id;
//        return view('admin.contabilidad.lista-servicios',compact(['id','destino','destinations','sericios','proveedores','costos','categoria_id','filtro']));
        return view('admin.contabilidad.lista-servicios',compact(['id','destino','destinations','sericios','proveedores','costos','categoria_id','ruta','filtro','tipo']));
    }

    public function eliminar_servicio_hotel(Request $request)
    {
        $id = $request->input('id');
        $servicio = Hotel::FindOrFail($id);
        if ($servicio->delete())
            return 1;
        else
            return 0;
    }

    public function nuevo_producto()
    {
        $destinations = M_Destino::get();
        $servicios = M_Servicio::get();
        $categorias = M_Category::get();
        $hotel = Hotel::get();
        session()->put('menu-lateral', 'Sproducts');
        $proveedores = Proveedor::get();
        $costos = M_Producto::get();
        return view('admin.database.new_service', ['servicios' => $servicios, 'categorias' => $categorias, 'destinations' => $destinations, 'hotel' => $hotel, 'proveedores' => $proveedores, 'costos' => $costos]);
    }
    public function listar_proveedores_service(Request $request)
    {
        $localizacion= $request->input('localizacion');
        $grupo= $request->input('grupo');
        $pos= $request->input('pos');
        $categoria= $request->input('categoria');
        $proveedores=null;
        if($grupo!='TRAINS')
            $proveedores=Proveedor::where('localizacion',$localizacion)->where('grupo',$grupo)->get();
        else
            $proveedores=Proveedor::where('grupo',$grupo)->get();

        $cadena='';
        foreach ($proveedores as $proveedor){
            $cadena.='<label class="text-primary display-block">
                        <input class="proveedores_'.$pos.'" type="checkbox" aria-label="..." name="proveedores_[]" value="'.$proveedor->id.'_'.$proveedor->nombre_comercial.'">
                        '.$proveedor->nombre_comercial.'
                        </label>';

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
        $costo_id= $request->input('costo_id');
        $proveedor_id= $request->input('proveedor_id');
        $nro_usados=ItinerarioServicios::where('proveedor_id',$proveedor_id)->count('proveedor_id');
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
        $m_servicios=M_Servicio::where('localizacion',$localizacion)->where('grupo',$grupo)->get();
        $destinos=M_Destino::get();
        $proveedores=Proveedor::where('grupo',$grupo)->get();
        return view('admin.book.mostrar-servicios',compact(['m_servicios','servicios_id','grupo','localizacion','destinos','itinerario_id','proveedores']));
    }
    public function listar_servicios_localizacion(Request $request){
        $itinerario_id=$request->input('itinerario_id');
        $localizacion=$request->input('localizacion');
        $grupo=$request->input('grupo');
        $servicios_id=$request->input('servicios_id');
        $proveedor_id=$request->input('proveedor_id');
        $clases=ProveedorClases::where('proveedor_id',$proveedor_id)->where('estado','1')->get();
        $m_servicios=M_Servicio::where('localizacion',$localizacion)->where('grupo',$grupo)->get();
        $destinos=M_Destino::get();
        return view('admin.book.mostrar-servicios-localizacion',compact(['m_servicios','servicios_id','grupo','localizacion','destinos','itinerario_id','clases']));
    }
    public function listar_servicios_paso1(Request $request){
        $itinerario_id=$request->input('itinerario_id');
        $localizacion=$request->input('localizacion');
        $destino=M_Destino::find($localizacion);
        $localizacion=$destino->destino;
        $grupo=$request->input('grupo');
        $servicios_id=$request->input('servicios_id');
        $m_servicios=M_Servicio::where('localizacion',$localizacion)->where('grupo',$grupo)->get();
        $destinos=M_Destino::get();
        $proveedores=Proveedor::where('grupo',$grupo)->get();
        return view('admin.book.mostrar-servicios-paso1',compact(['m_servicios','servicios_id','grupo','localizacion','destinos','itinerario_id','proveedores']));
    }
    public function listar_servicios_localizacion_paso1(Request $request){
        $itinerario_id=$request->input('itinerario_id');
        $localizacion=$request->input('localizacion');
        $grupo=$request->input('grupo');
        $servicios_id=$request->input('servicios_id');
        $proveedor_id=$request->input('proveedor_id');
        $clases=ProveedorClases::where('proveedor_id',$proveedor_id)->where('estado','1')->get();
        $m_servicios=M_Servicio::where('localizacion',$localizacion)->where('grupo',$grupo)->get();
        $destinos=M_Destino::get();
        return view('admin.book.mostrar-servicios-localizacion-paso1',compact(['m_servicios','servicios_id','grupo','localizacion','destinos','itinerario_id','clases']));
    }
    public function nuevos_servicios($cliente_id,$cotizacion_id,$paquete_precio_id)
    {
        $cliente=Cliente::FindOrFail($cliente_id);
        $cotizaciones=Cotizacion::where('id',$cotizacion_id)->get();
        $m_servicios=M_Servicio::get();
        return view('admin.agregar-servicio-hotel',['cliente'=>$cliente,'cotizaciones'=>$cotizaciones,/*'destinos'=>$destinos*/'m_servicios'=>$m_servicios,'paquete_precio_id'=>$pqt_id]);
    }
}
