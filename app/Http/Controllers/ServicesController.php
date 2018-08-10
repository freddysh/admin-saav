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
            $txt_acomodacion = $request->input('txt_acomodacion_' . $posTipo);
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
            $destino = new M_Servicio();
            $destino->grupo = $cate[$posTipo];
            $destino->localizacion = $txt_localizacion;
            $destino->tipoServicio = $txt_type;
            $destino->acomodacion = $txt_acomodacion;
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

                $posTipo=$request->input('posTipo');
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
            }
        }
//        return dd($destino);
//        return json_encode(1);
        return $txt_type . '_' . $txt_min_personas . '_' . $txt_max_personas . '_' . $txt_price . '_' . $txt_product;

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
//        $destino = $request->input('destino');
        $proveedor_id = $request->input('empresa_id');
        $clases=ProveedorClases::where('proveedor_id',$proveedor_id)->get();
        $clases_=[];
        foreach($clases->where('estado',1) as $clase){
            $clases_[]=$clase->clase;
        }
        $id = $request->input('id');


        $destino = '001_TRAINS';
        $destino = explode('_', $destino);

//        $sericios = M_Servicio::where('grupo', $destino[1])->where('localizacion', $destino[2])->get();
        $sericios = M_Servicio::where('grupo', $destino[1])->get();
        $destinations = M_Destino::get();
//        return $sericios;
        $cadena = '';
        $cadena .= '<table id="tb_' . $destino[0] . '_' . $destino[1] . '" class="' . $destino[1] . ' table table-sm table-striped table-bordered mt-3" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Localizacion</th>
                                <th>Codigo</th>
                                <th>';
        if ($destino[1] == 'TRAINS')
            $cadena .= ' Clase';
        else
            $cadena .= ' Tipo';
        $cadena .= '</th>
                                <th>';
        if ($destino[1] == 'TRAINS')
            $cadena .= 'Ruta';
        else
            $cadena .= 'Nombre';
        $cadena .= '</th>';
        if ($destino[1] == 'TRAINS')
            $cadena .= '<th>Horario</th>';
        $cadena .= '
                                <th>Precio</th>
                                <th>Operaciones</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Codigo</th>';
        $cadena .= '<th>';
        if ($destino[1] == 'TRAINS')
            $cadena .= 'Clase';
        else
            $cadena .= 'Tipo';
        $cadena .= '</th><th>';
        if ($destino[1] == 'TRAINS')
            $cadena .= 'Ruta';
        else
            $cadena .= 'Nombre';
        $cadena .= '</th>';
        if ($destino[1] == 'TRAINS')
            $cadena .= '<th>Horario</th>';
        $cadena .= '<th>Precio</th>
                              <th>Action</th>
                              </tr>
                              </tfoot>
                              <tbody>';
        $pos = 0;
        foreach ($sericios->sortBy('localizacion') as $servicio) {
            $cadena .= '<tr class="' . $servicio->localizacion . '" id="lista_services_' . $servicio->id . '">
    <td class="text-green-goto">' . ucwords(strtolower($servicio->localizacion)) . '</td>
    <td class="text-green-goto">' . $servicio->codigo . '</td>
    <td id="tipo_' . $servicio->id . '">' . ucwords(strtolower($servicio->tipoServicio));
            if ($destino[1] == 'MOVILID')
                $cadena .= '[' . $servicio->min_personas . ' - ' . $servicio->max_personas . ']';
            $cadena .= '</td>
    <td id="nombre_' . $servicio->id . '">' . ucwords(strtolower($servicio->nombre)) . '</td>';
            if ($destino[1] == 'TRAINS')
                $cadena .= '<td id="horario_' . $servicio->id . '">' . $servicio->salida . ' - ' . $servicio->llegada . '</td>';

            $cadena .= '<td id="precio_' . $servicio->id . '" class="text-right"><sup>$</sup>' . $servicio->precio_venta . '</td>
    <td class="text-center">
        <button type="button" class="btn btn-warning btn-sm mr-2"  data-toggle="modal" data-target="#modal_edit_producto' . $servicio->id . '">
            <i class="fas fa-pencil-alt"></i>
        </button>';


            $cadena .= '<div class="modal fade bd-example-modal-lg" id="modal_edit_producto' . $servicio->id . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form action="' . route('service_edit_path') . '" method="post" id="modal_edit_producto_' . $servicio->id . '" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Service</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">';
//                                    <div class="row">
            if($destino[1]!='HOTELS'){
                $cadena .= '<div class="col-md-2">
                                <div class="form-group">
                                    <label for="txt_codigo">Codigo</label>
                                    <input type="text" class="form-control" id="txt_codigo" name="txt_codigo" value="' . $servicio->codigo . '" readonly>
                                </div>
                            </div>';
            }
            if($destino[1]!='TRAINS') {
                $cadena .= '<div class="col-md-2">
                            <div class="form-group">
                                <label for="txt_codigo">Location</label>
                                <select class="form-control" id="txt_localizacion_' . $servicio->id . '" name="txt_localizacion_' . $servicio->id . '" disabled>';

                foreach ($destinations as $destination) {
                    $cadena .= '<option value="' . $destination->destino . '"';
                    if ($servicio->localizacion == $destination->destino) {
                        $cadena .= 'selected';
                    }
                    $cadena .= '>' . $destination->destino . '</option>';
                }
                $cadena .= '</select>
                    <input type="hidden" name="tipoServicio_' . $servicio->id . '" id="tipoServicio_' . $servicio->id . '" value="' . $destino[1] . '">
                </div>
            </div>';
            }
            if($destino[1]=='TRAINS'){
                $array_pro = '';
                $proveedores = Proveedor::get();
                $proveedor_id1=0;
                if ($destino[1] == 'TRAINS') {
                    foreach ($proveedores->where('grupo', 'TRAINS') as $provider) {
                        $array_pro .= $provider->id . '_';
                        foreach ($provider->clases->where('clase',$servicio->tipoServicio) as $clase){
                            $proveedor_id1=$provider->id;
                        }
                    }

                    $array_pro = $array_pro . substr(0, strlen($array_pro) - 1);
                    $cadena .= '<div class="col-md-2">
                        <div class="form-group">
                            <label for="txt_codigo">Empresa</label>
                            <select class="form-control" id="txt_provider_' . $servicio->id . '" name="txt_provider_' . $servicio->id . '" onchange="mostrar_class($(\'#txt_provider_' . $servicio->id . '\').val(),\'' . $array_pro . '\',\''.$destino[1].'\',\''.$servicio->id.'\','. $destino[0] . ')">
                                <option value="0">Escoja una empresa</option>';
                    foreach ($proveedores->where('grupo', 'TRAINS') as $provider) {
                        $cadena.= '<option value="' . $provider->id . '_' . $provider->nombre_comercial . '"';
                        if($proveedor_id1==$provider->id)
                            $cadena.=' selected ';
                        $cadena.='>' . $provider->nombre_comercial . '</option>';
                    }
                    $cadena .= '</select>
                        </div>
                    </div>';
                }
                $vision = 0;
                foreach ($proveedores->where('grupo', 'TRAINS') as $provider){
                    $vision++;
                    $cadena .='<div id="proveedor_'.$provider->id.'" class="col-md-2';
                    if($proveedor_id1!=$provider->id){
                        $cadena .=' d-none';
                    }
                    $cadena .='">
                            <div class="form-group">
                                <label for="txt_codigo" >Class</label>
                                <select class="form-control" id="txt_class_'.$servicio->id.'" name = "txt_class_'.$servicio->id.'_'.$provider->id.'">';
                    foreach ($provider->clases->where('estado', '1') as $provider_clases) {
                        $cadena .= '<option value="'.$provider_clases->clase.'"';
                        if($servicio->tipoServicio==$provider_clases->clase)
                            $cadena.=' selected ';
                        $cadena.='>'.$provider_clases->clase.'</option>';
                    }
                    $cadena .= '</select>
                                </div>
                            </div>';
                }
            }
            if ($destino[1] == 'ENTRANCES') {
                $cadena .= '<div class="col-md-2"><div class="form-group">';
                $cadena .= '<label for="txt_type" > Clase</label >
                    <select class="form-control" id = "txt_clase_' . $servicio->id . '" name = "txt_clase_' . $servicio->id . '" >
                        <option value = "OTROS"';
                if ($servicio->clase == "OTROS") {
                    $cadena .= 'selected';
                }
                $cadena .= '>OTROS </option >
                        <option value = "BTG" ';

                if ($servicio->clase == "BTG") {
                    $cadena .= 'selected';
                }
                $cadena .= '>BOLETO TURISTICO</option>
                        <option value = "CAT"';
                if ($servicio->clase == "CAT") {
                    $cadena .= 'selected';
                }
                $cadena .= '>CATEDRAL</option>
                        <option value = "KORI"';
                if ($servicio->clase == "KORI") {
                    $cadena .= 'selected';
                }
                $cadena .= '>KORICANCHA</option>
                        <option value = "MAPI"';
                if ($servicio->clase == "MAPI") {
                    $cadena .= 'selected';
                }
                $cadena .= '>MACHUPICCHU</option >
                    </select ></div></div>';
            }
            if ($destino[1] == 'MOVILID') {
                $cadena .= '<div class="col-md-2"><div class="form-group">';
                $cadena .= '<label for="txt_type" > Clase</label >
                    <select class="form-control" id = "txt_clase_' . $servicio->id . '" name = "txt_clase_' . $servicio->id . '" >
                        <option value = "DEFAULT"';
                if ($servicio->clase == "DEFAULT") {
                    $cadena .= 'selected';
                }
                $cadena .= '>DEFAULT </option >
                        <option value = "BOLETO" ';
                if ($servicio->clase == "BOLETO") {
                    $cadena .= 'selected';
                }
                $cadena .= '>BOLETO</option>
                    </select></div></div>';
            }
//            $cadena .= '<div class="col-md-2">
//                <div class="form-group">';

            if ($destino[1] == 'TOURS') {
                $cadena .= '<div class="col-md-2">
                <div class="form-group"><label for="txt_type" > Type</label >
                    <select class="form-control" id = "txt_type_' . $servicio->id . '" name = "txt_type_' . $servicio->id . '" >
                        <option value = "GROUP"';
                if ($servicio->tipoServicio == "GROUP") {
                    $cadena .= 'selected';
                }
                $cadena .= '>GROUP </option >
                        <option value = "PRIVATE" ';
                if ($servicio->tipoServicio == "PRIVATE") {
                    $cadena .= 'selected';
                }
                $cadena .= '>PRIVATE</option >
                    </select></div></div>';
            }
            if ($servicio->grupo == 'MOVILID') {
                $cadena .= '<div class="col-md-2">
                <div class="form-group"><label for="txt_type" > Type</label >
                    <select class="form-control" id = "txt_type_' . $servicio->id . '" name = "txt_type_' . $servicio->id . '" >
                        <option value = "AUTO"';
                if ($servicio->tipoServicio == "AUTO") $cadena .= 'selected';
                $cadena .= '>AUTO </option >
                        <option value = "SUV"';
                if ($servicio->tipoServicio == "SUV") $cadena .= 'selected';
                $cadena .= '>SUV </option >
                        <option value = "VAN"';
                if ($servicio->tipoServicio == "VAN") $cadena .= 'selected';
                $cadena .= '>VAN </option >
                        <option value = "H1"';
                if ($servicio->tipoServicio == "H1") $cadena .= 'selected ';
                $cadena .= '>H1 </option >
                        <option value = "SPRINTER"';
                if ($servicio->tipoServicio == "SPRINTER") $cadena .= 'selected';
                $cadena .= '>SPRINTER </option >
                        <option value = "BUS"';
                if ($servicio->tipoServicio == "BUS") $cadena .= 'selected';
                $cadena .= '>BUS </option >
                    </select ></div></div>';
            }

            if ($servicio->grupo == 'REPRESENT') {
                $cadena .= '<div class="col-md-2">
                <div class="form-group"><label for="txt_type" > Type</label >
                <select class="form-control" id = "txt_type_' . $servicio->id . '" name = "txt_type_' . $servicio->id . '" >
                    <option value = "GUIDE"';
                if ($servicio->tipoServicio == "GUIDE") $cadena .= 'selected';
                $cadena .= '>GUIDE </option >
                    <option value = "TRANSFER"';
                if ($servicio->tipoServicio == "TRANSFER") $cadena .= 'selected';
                $cadena .= '>TRANSFER </option >
                    <option value = "ASSISTANCE"';
                if ($servicio->tipoServicio == "ASSISTANCE") $cadena .= 'selected';
                $cadena .= '>ASSISTANCE </option >
                </select ></div></div>';
            }
            if ($servicio->grupo == 'ENTRANCES') {
                $cadena .= '<div class="col-md-2">
                <div class="form-group"><label for="txt_type" > Type</label >
                    <select class="form-control" id = "txt_type_' . $servicio->id . '" name = "txt_type_' . $servicio->id . '" >
                        <option value = "EXTRANJERO"';
                if ($servicio->tipoServicio == "EXTRANJERO") $cadena .= 'selected ';
                $cadena .= '>EXTRANJERO </option >
                        <option value = "NATIONAL"';
                if ($servicio->tipoServicio == "NATIONAL") $cadena .= 'selected ';
                $cadena .= '>NATIONAL </option >
                    </select></div></div>';
            }
            if ($servicio->grupo == 'FOOD') {
                $cadena .= '<div class="col-md-2">
                <div class="form-group"><label for="txt_type" > Type</label >
                    <select class="form-control" id = "txt_type_' . $servicio->id . '" name = "txt_type_' . $servicio->id . '" >
                        <option value = "LUNCH"';
                if ($servicio->tipoServicio == "LUNCH") $cadena .= 'selected';
                $cadena .= '>LUNCH </option >
                        <option value = "DINNER';
                if ($servicio->tipoServicio == "DINNDER") $cadena .= 'selected';
                $cadena .= '>DINNER </option >
                        <option value = "BOX LUNCH';
                if ($servicio->tipoServicio == "BOX LUNCH") $cadena .= 'selected';
                $cadena .= '>BOX LUNCH </option >
                    </select ></div></div>';
            }
//            if ($servicio->grupo == 'TRAINS') {
//                $cadena .= '<label for="txt_type">Class</label>
//                        <select class="form-control" id="txt_type_' . $servicio->id . '" name="txt_type_' . $servicio->id . '">
//                        <option value="EXPEDITION"';
//                if ($servicio->tipoServicio == "EXPEDITION") $cadena .= 'selected';
//                $cadena .= '>EXPEDITION</option>
//                        <option value="VISITADOME"';
//                if ($servicio->tipoServicio == "VISITADOME") $cadena .= 'selected';
//                $cadena .= '>VISITADOME</option>
//                        <option value="EJECUTIVO"';
//                if ($servicio->tipoServicio == "EJECUTIVO") $cadena .= 'selected';
//                $cadena .= '>EJECUTIVO</option>
//                        <option value="FIRST CLASS"';
//                if ($servicio->tipoServicio == "FIRST CLASS") $cadena .= 'selected';
//                $cadena .= '>PRIMERA CLASE</option>
//                        <option value="HIRAN BINGHAN"';
//                if ($servicio->tipoServicio == "HIRAN BINGHAN") $cadena .= 'selected';
//                $cadena .= '>HIRAN BINGHAN</option>
//                        <option value="PRESIDENTIAL"';
//                if ($servicio->tipoServicio == "PRESIDENTIAL") $cadena .= 'selected';
//                $cadena .= '>PRESIDENTIAL</option>
//                    </select>';
//            }
            if ($servicio->grupo == 'FLIGHTS') {
                $cadena .= '<div class="col-md-2">
                <div class="form-group"><label for="txt_type">Type</label>
                    <select class="form-control" id="txt_type_' . $servicio->id . '" name="txt_type_' . $servicio->id . '">
                        <option value="NATIONAL"';
                if ($servicio->tipoServicio == "NATIONAL") $cadena .= 'selected';
                $cadena .= '>NATIONAL</option>
                        <option value="INTERNATIONAL';
                if ($servicio->tipoServicio == "INTERNATIONAL") $cadena .= 'selected';
                $cadena .= '>INTERNATIONAL</option>
                    </select></div></div>';
            }
            if ($servicio->grupo == 'OTHERS') {
                $cadena .= '<div class="col-md-2">
                <div class="form-group"><label for="txt_type">Type</label>
                    <input type="text" class="form-control" id="txt_type_' . $servicio->id . '" name="txt_type_' . $servicio->id . '" placeholder="Type" value="' . $servicio->tipoServicio . '"></div></div>';
            }

            $cadena .= '
            <div class="col-md-2">
                <div class="form-group">';
            if ($servicio->grupo == 'TRAINS')
                $cadena .= '<label for="txt_product">Tren</label>';
            elseif($servicio->grupo == 'FLIGHTS')
                $cadena .= '<label for="txt_product">Ruta</label>';
            else
                $cadena .= '<label for="txt_product">Product</label>';

            $cadena .= '<input type="text" class="form-control" id="txt_product_' . $servicio->id . '" name="txt_product_' . $servicio->id . '" placeholder="Product" value="' . $servicio->nombre . '">
                </div>
            </div>';
            if ($servicio->grupo == 'TRAINS' || $servicio->grupo == 'FLIGHTS') {
                $cadena .= '<div class="col-md-2">
                                <div class="form-group">
                                    <label for="txt_price">Ruta de salida</label>
                                    <select class="form-control" id="txt_ruta_salida_'.$servicio->id.'" name="txt_ruta_salida_'.$servicio->id.'">';
                if($servicio->ruta_salida=='POROY')
                    $cadena .= '<option value="POROY" selected>POROY</option>';
                else
                    $cadena .= '<option value="POROY">POROY</option>';
                if($servicio->ruta_salida=='AGUAS CALIENTES')
                    $cadena .= '<option value="AGUAS CALIENTES" selected>AGUAS CALIENTES</option>';
                else
                    $cadena .= '<option value="AGUAS CALIENTES">AGUAS CALIENTES</option>';
                if($servicio->ruta_salida=='OLLANTAYTAMBO')
                    $cadena .= '<option value="OLLANTAYTAMBO" selected>OLLANTAYTAMBO</option>';
                else
                    $cadena .= '<option value="OALLANTAYTAMBO">OLLANTAYTAMBO</option>';

                $cadena .= '</select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="txt_price" > Hora</label >
                                    <input type = "text" class="form-control" id = "txt_salida_' . $servicio->id . '" name = "txt_salida_' . $servicio->id . '" placeholder="06:30" value = "' . $servicio->salida . '" >
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="txt_price">Ruta de llegada</label>
                                    <select class="form-control" id="txt_ruta_llegada_'.$servicio->id.'" name="txt_ruta_llegada_'.$servicio->id.'">';
                if($servicio->ruta_llegada=='POROY')
                    $cadena .= '<option value="POROY" selected>POROY</option>';
                else
                    $cadena .= '<option value="POROY">POROY</option>';
                if($servicio->ruta_llegada=='AGUAS CALIENTES')
                    $cadena .= '<option value="AGUAS CALIENTES" selected>AGUAS CALIENTES</option>';
                else
                    $cadena .= '<option value="AGUAS CALIENTES">AGUAS CALIENTES</option>';
                if($servicio->ruta_llegada=='OLLANTAYTAMBO')
                    $cadena .= '<option value="OLLANTAYTAMBO" selected>OLLANTAYTAMBO</option>';
                else
                    $cadena .= '<option value="OLLANTAYTAMBO">OLLANTAYTAMBO</option>';
                $cadena .= '</select>
                                </div>
                            </div>
                            <div class="col-md-2" >            
                                <div class="form-group" >
                                    <label for="txt_price" > Hora</label >
                                    <input type = "text" class="form-control" id = "txt_llegada_' . $servicio->id . '" name = "txt_llegada_' . $servicio->id . '" placeholder="06:30"  value = "' . $servicio->llegada . '" >
                                </div>
                            </div>';
            }
//
//
            $cadena .= '<div class="col-md-2">
                <div class="form-group">
                    <label for="txt_price">Price</label>
                    <input type="number" class="form-control" id="txt_price_' . $servicio->id . '" name="txt_price_' . $servicio->id . '" placeholder="Price"  value="' . $servicio->precio_venta . '" min="0">
                </div>
            </div>';
            if ($servicio->grupo == 'MOVILID') {
                $cadena .= '<div class="col-md-2" >
                <div class="form-group" >
                    <label for="txt_price" > Min Personas </label >
                    <input type = "number" class="form-control" id = "txt_min_personas_' . $servicio->id . '" name = "txt_min_personas_' . $servicio->id . '" placeholder = "Min" min = "0" value = "' . $servicio->min_personas . '" >
                </div >
            </div >
            <div class="col-md-2" >
                <div class="form-group" >
                    <label for="txt_price" > Max Personas </label >
                    <input type = "number" class="form-control" id = "txt_max_personas_' . $servicio->id . '" name = "txt_max_personas_' . $servicio->id . '" placeholder = "Min" min = "0" value = "' . $servicio->max_personas . '" >
                </div >
            </div >';
            }
//
            if ($servicio->grupo == 'TOURS') {
                $cadena .= '<div class="col-md-6"><div class="row">';
                if ($servicio->precio_grupo == 1) {
                    $cadena .= '<div class="col-md-6" >
                        <label for="txt_price">Tipe price</label><br>
                        <label class=" text-green-goto" >
                            <input type = "radio" name = "txt_tipo_grupo_' . $servicio->id . '" value = "Absoluto" checked = "checked" >
                    Precio es absoluto
                </label >
                    </div >
                    <div class="col-md-6" >
                        <label for="txt_price">Tipe price</label><br>
                        <label class=" text-green-goto" >
                            <input type = "radio" name = "txt_tipo_grupo_' . $servicio->id . '" value = "Individual" >
                    Precio es individual
                </label >
                    </div >';
                } else {
                    $cadena .= '<div class="col-md-6" >
                        <label for="txt_price">Tipe price</label><br>
                        <label class=" text-green-goto" >
                            <input type = "radio" name = "txt_tipo_grupo_' . $servicio->id . '" value = "Absoluto" >
                    Precio es absoluto
                </label >
                    </div >
                    <div class="col-md-6" >
                        <label for="txt_price">Tipe price</label><br>
                        <label class=" text-green-goto" >
                            <input type = "radio" name = "txt_tipo_grupo_' . $servicio->id . '" value = "Individual" checked = "checked" >
                    Precio es individual
                </label >
                    </div >';
                }
                $cadena .= '</div >
            </div >';
            }
            if ($servicio->grupo == 'MOVILID') {
                $cadena .= '<div class="col-md-6"><div class="row">';
                if ($servicio->precio_grupo == 1) {
                    $cadena .= '<div class="col-md-6">
                        <label class=" text-green-goto">
                            <input type="radio" name="txt_tipo_grupo_' . $servicio->id . '" value="Absoluto" checked="checked">
                            Precio es absoluto
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class=" text-green-goto">
                            <input type="radio" name="txt_tipo_grupo_' . $servicio->id . '" value="Individual">
                            Precio es individual
                        </label>
                    </div>';
                } else {
                    $cadena .= '<div class="col-md-6">
                        <label class=" text-green-goto">
                            <input type="radio" name="txt_tipo_grupo_' . $servicio->id . '" value="Absoluto">
                            Precio es absoluto
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class=" text-green-goto">
                            <input type="radio" name="txt_tipo_grupo_' . $servicio->id . '" value="Individual" checked="checked">
                            Precio es individual
                        </label>
                    </div>';
                }
                $cadena .= ' </div>
            </div>';
            }
            if ($servicio->grupo == 'REPRESENT') {
                $cadena .= '<div class="col-md-6"><div class="row" >';
                if ($servicio->precio_grupo == 1) {
                    $cadena .= '<div class="col-md-6" >
                        <label for="txt_price">Tipe price</label><br>
                        <label class=" text-green-goto" >
                            <input type = "radio" name = "txt_tipo_grupo_' . $servicio->id . '" value = "Absoluto" checked = "checked" >
                            Precio es absoluto
                        </label >
                    </div >
                    <div class="col-md-6 hide" >
                        <label for="txt_price">Tipe price</label><br>
                        <label class=" text-green-goto" >
                            <input type = "radio" name = "txt_tipo_grupo_' . $servicio->id . '" value = "Individual" >
                            Precio es individual
                        </label >
                    </div >';
                } else {
                    $cadena .= '<div class="col-md-6" >
                        <label for="txt_price">Tipe price</label><br>
                        <label class=" text-green-goto" >
                            <input type = "radio" name = "txt_tipo_grupo_' . $servicio->id . '" value = "Absoluto" >
                            Precio es absoluto
                        </label >
                    </div >
                    <div class="col-md-6" >
                        <label for="txt_price">Tipe price</label><br>
                        <label class=" text-green-goto" >
                            <input type = "radio" name = "txt_tipo_grupo_' . $servicio->id . '" value = "Individual" checked = "checked" >
                            Precio es individual
                        </label >
                    </div >';
                }
                $cadena .= '</div >
            </div >';
            }
            if ($servicio->grupo == 'ENTRANCES') {
                $cadena .= '<div class="col-md-6"><div class="row" >';
                if ($servicio->precio_grupo == 1) {
                    $cadena .= '<div class="col-md-6" >
                        <label for="txt_price">Tipe price</label><br>
                        <label class=" text-green-goto" >
                            <input type = "radio" name = "txt_tipo_grupo_' . $servicio->id . '" value = "Absoluto" checked = "checked" >
                    Precio es absoluto
                </label >
                    </div >
                    <div class="col-md-6" >
                        <label for="txt_price">Tipe price</label><br>
                        <label class=" text-green-goto" >
                            <input type = "radio" name = "txt_tipo_grupo_' . $servicio->id . '" value = "Individual" >
                    Precio es individual
                </label >
                    </div >';
                } else {
                    $cadena .= '<div class="col-md-6 hide" >
                        <label for="txt_price">Tipe price</label><br>
                        <label class=" text-green-goto" >
                            <input type = "radio" name = "txt_tipo_grupo_' . $servicio->id . '" value = "Absoluto" >
                    Precio es absoluto
                </label >
                    </div >
                    <div class="col-md-6" >
                        <label for="txt_price">Tipe price</label><br>
                        <label class=" text-green-goto" >
                            <input type = "radio" name = "txt_tipo_grupo_' . $servicio->id . '" value = "Individual" checked = "checked" >
                    Precio es individual
                </label >
                    </div >';
                }
                $cadena .= '</div >
            </div >';
            }
            if ($servicio->grupo == 'FOOD') {
                $cadena .= '<div class="col-md-6" >
                <div class="row" >';
                if ($servicio->precio_grupo == 1) {
                    $cadena .= '<div class="col-md-6" >
                        <label for="txt_price">Tipe price</label><br>
                        <label class=" text-green-goto" >
                            <input type = "radio" name = "txt_tipo_grupo_' . $servicio->id . '" value = "Absoluto" checked = "checked" >
                    Precio es absoluto
                </label >
                    </div >
                    <div class="col-md-6" >
                        <label for="txt_price">Tipe price</label><br>
                        <label class=" text-green-goto" >
                            <input type = "radio" name = "txt_tipo_grupo_' . $servicio->id . '" value = "Individual" >
                    Precio es individual
                </label >
                    </div >';
                } else {
                    $cadena .= '<div class="col-md-6 hide" >
                        <label for="txt_price">Tipe price</label><br>
                        <label class=" text-green-goto" >
                            <input type = "radio" name = "txt_tipo_grupo_' . $servicio->id . '" value = "Absoluto" >
                    Precio es absoluto
                </label >
                    </div >
                    <div class="col-md-6" >
                        <label for="txt_price">Tipe price</label><br>
                        <label class=" text-green-goto" >
                            <input type = "radio" name = "txt_tipo_grupo_' . $servicio->id . '" value = "Individual" checked = "checked" >
                    Precio es individual
                </label >
                    </div >';
                }
                $cadena .= '</div >
            </div >';
            }
            if ($servicio->grupo == 'TRAINS') {
                $cadena .= '<div class="col-md-6"><div class="row" >';
                if ($servicio->precio_grupo == 1) {
                    $cadena .= '<div class="col-md-6" >
                        <label for="txt_price">Tipe price</label><br>
                        <label class=" text-green-goto" >
                            <input type = "radio" name = "txt_tipo_grupo_' . $servicio->id . '" value = "Absoluto" checked = "checked" >
                    Precio es absoluto
                </label >
                    </div >
                    <div class="col-md-6" >
                        <label for="txt_price">Tipe price</label><br>
                        <label class=" text-green-goto" >
                            <input type = "radio" name = "txt_tipo_grupo_' . $servicio->id . '" value = "Individual" >
                    Precio es individual
                </label >
                    </div >';
                } else {
                    $cadena .= '<div class="col-md-6 hide" >
                        <label for="txt_price">Tipe price</label><br>
                        <label class=" text-green-goto" >
                            <input type = "radio" name = "txt_tipo_grupo_' . $servicio->id . '" value = "Absoluto" >
                    Precio es absoluto
                </label >
                    </div >
                    <div class="col-md-6" >
                        <label for="txt_price">Tipe price</label><br>
                        <label class=" text-green-goto" >
                            <input type = "radio" name = "txt_tipo_grupo_' . $servicio->id . '" value = "Individual" checked = "checked" >
                    Precio es individual
                </label >
                    </div >';
                }
                $cadena .= '</div >
            </div >';
            }
            if ($servicio->grupo == 'FLIGHTS') {
                $cadena .= '<div class="col-md-6" >
                <div class="row" >';
                if ($servicio->precio_grupo == 1) {
                    $cadena .= '<div class="col-md-6" >
                        <label for="txt_price">Tipe price</label><br>
                        <label class=" text-green-goto" >
                            <input type = "radio" name = "txt_tipo_grupo_' . $servicio->id . '" value = "Absoluto" checked = "checked" >
                    Precio es absoluto
                </label >
                    </div >
                    <div class="col-md-6" >
                        <label for="txt_price">Tipe price</label><br>
                        <label class=" text-green-goto" >
                            <input type = "radio" name = "txt_tipo_grupo_' . $servicio->id . '" value = "Individual" >
                    Precio es individual
                </label >
                    </div >';
                } else {
                    $cadena .= '<div class="col-md-6 hide" >
                        <label for="txt_price">Tipe price</label><br>
                        <label class=" text-green-goto" >
                            <input type = "radio" name = "txt_tipo_grupo_' . $servicio->id . '" value = "Absoluto" >
                    Precio es absoluto
                </label >
                    </div >
                    <div class="col-md-6" >
                        <label for="txt_price">Tipe price</label><br>
                        <label class=" text-green-goto" >
                            <input type = "radio" name = "txt_tipo_grupo_' . $servicio->id . '" value = "Individual" checked = "checked" >
                    Precio es individual
                </label >
                    </div >';
                }
                $cadena .= '</div >
            </div >';
            }
            if ($servicio->grupo == 'OTHERS') {
                $cadena .= '<div class="col-md-6">
                <div class="row" >';
                if ($servicio->precio_grupo == 1) {
                    $cadena .= '<div class="col-md-6" >
                        <label for="txt_price">Tipe price</label><br>
                        <label class=" text-green-goto" >
                            <input type = "radio" name = "txt_tipo_grupo_' . $servicio->id . '" value = "Absoluto" checked = "checked" >
                    Precio es absoluto
                </label >
                    </div >
                    <div class="col-md-6" >
                        <label for="txt_price">Tipe price</label><br>
                        <label class=" text-green-goto" >
                            <input type = "radio" name = "txt_tipo_grupo_' . $servicio->id . '" value = "Individual" >
                    Precio es individual
                </label >
                    </div >';
                } else {
                    $cadena .= '<div class="col-md-6" >
                        <label for="txt_price">Tipe price</label><br>
                        <label class=" text-green-goto" >
                            <input type = "radio" name = "txt_tipo_grupo_' . $servicio->id . '" value = "Absoluto" >
                    Precio es absoluto
                </label >
                    </div >
                    <div class="col-md-6" >
                        <label for="txt_price">Tipe price</label><br>
                        <label class=" text-green-goto" >
                            <input type = "radio" name = "txt_tipo_grupo_' . $servicio->id . '" value = "Individual" checked = "checked" >
                    Precio es individual
                </label >
                    </div >';
                }
                $cadena .= '</div>
            </div>';
            }
            $pos++;

            $proveedores=Proveedor::get();
            $costos=M_Producto::get();

            $categoria_id = $request->input('id');
            $cadena .= '<div class="col-lg-12" >'.
                '<div id="lista_proveedores_'.$categoria_id.'" class="col-lg-5" style="height: 400px; overflow-y: auto;">'.
                '<p><b class="text-green-goto">Proveedores</b></p>';
            if($destino[1]!='TRAINS'){
                foreach ($proveedores->where('localizacion',$destino[2])->where('grupo',$destino[1]) as $proveedor){
                    $cadena.='<div class="checkbox1">
                                    <label class="puntero">
                                        <input class="proveedores_'.$servicio->id.'"  type="checkbox" aria-label="..." name="proveedores_[]" value="'.$proveedor->id.'_'.$proveedor->nombre_comercial.'">
                                        '.$proveedor->nombre_comercial.'
                                    </label>
                                </div>';

//                    $cadena .= '<div class="input-group">'.
//                                    '<span class="input-group-addon">'.
//                                        '<input class="proveedores_'.$servicio->id.'" type="checkbox" aria-label="..." name="proveedores_[]" value="'.$proveedor->id.'_'.$proveedor->nombre_comercial.'">'.
//                                    '</span>'.
//                                    '<input type="text"  name="proveedores_nombre[]" class="form-control" aria-label="..." value="'.$proveedor->nombre_comercial.'" readonly="">'.
//                                '</div>';
                }
            }
//            else{
//                foreach ($proveedores->where('grupo',$destino[1]) as $proveedor){
//                    $cadena.='<div class="checkbox1">
//                                    <label class="puntero">
//                                        <input class="proveedores_'.$servicio->id.'"  type="checkbox" aria-label="..." name="proveedores_[]" value="'.$proveedor->id.'_'.$proveedor->nombre_comercial.'">
//                                        '.$proveedor->nombre_comercial.'
//                                    </label>
//                                </div>';
//                }
//            }
            $cadena .= '</div>'.
                '<div class="col-lg-1">'.
                '<a href="#!" class="btn btn-primary" onclick="Pasar_pro('.$categoria_id.',\''.$destino[1].'\','.$servicio->id.')">'.
                '<i class="fa fa-arrow-right" aria-hidden="true"></i>'.
                '</a>'.
                '</div>';
            $cadena .='<div class="col-lg-6" style="height: 400px; overflow-y: auto;">'.
                '<p><b class="text-green-goto">Proveedor/Costo</b></p><div id="lista_costos_'.$destino[1].'_'.$id.'_'.$servicio->id.'">';
            foreach ($costos->where('m_servicios_id',$servicio->id)->where('grupo', $destino[1])->where('localizacion',$servicio->localizacion) as $costo){
                $cadena.= '<div id="fila_p_'.$servicio->id.'_'.$costo->id.'_'.$costo->proveedor->id.'" class="row">'.
                    '<div class="col-lg-8">'.$costo->proveedor->nombre_comercial.'</div>'.
                    '<div class="col-lg-2">'.
                    '<input name="costo_id[]" type="hidden" value="'.$costo->id.'">'.
                    '<input name="costo_val[]" type="number" class="form-control" style="width: 85px" value="'.$costo->precio_costo.'">'.
                    '</div>'.
                    '<div class="col-lg-2">'.
                    '<button type="button" class="btn btn-danger btn-sm" onclick="eliminar_proveedor_comprobando('.$servicio->id.','.$costo->id.','.$costo->proveedor->id.',\''.$costo->proveedor->nombre_comercial.'\')">'.
                    '<i class="fa fa-trash"></i>'.
                    '</button>'.
                    '</div>'.
                    '</div>';
            }
            $cadena .='</div></div>';
            $cadena .='</div>';


            $cadena .= '</div>
                        </div>
                        <div class="modal-footer">
                            ' . csrf_field() . '
                            <input type="hidden" name="id" value="' . $servicio->id . '">
                            <input type="hidden" name="posTipo" id="posTipo" value="0">
                            <input type="hidden" name="grupo_' . $servicio->id . '" id="grupo_' . $servicio->id . '" value="' . $destino[1] . '">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" onclick="editar_producto(' . $servicio->id . ')">Save changes</button>
                        </div>
                        <div id="result_' . $servicio->id . '" class="bg-success text-15 text-center"></div>
                    </form>
                </div>
            </div>
        </div>';

            $cadena .= '<button type="button" class="btn btn-danger btn-sm" onclick="eliminar_servicio(\'' . $servicio->localizacion . '\',\'' . $servicio->id . '\',\'' . $servicio->nombre . '\')">
                <i class="fa fa-trash"></i>
            </button>
    </td>
</tr>';
        }
        $cadena .= '</tbody>
</table>';
        return $cadena;
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
