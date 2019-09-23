<?php

namespace App\Http\Controllers;

use App\DestinosOpera;
use App\EntidadBancaria;
use App\GrupoOpera;
use App\M_Category;
use App\M_Destino;
use App\M_Producto;
use App\Proveedor;
use App\Web;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ProveedorController extends Controller
{
    //
    public function index()
    {
        $destinations=M_Destino::get();
        $providers=Proveedor::get();
        $categorias=M_Category::get();
        session()->put('menu-lateral', 'Sproviders');
        $entidadBancaria=EntidadBancaria::get();
        $m_categories=M_Category::where('nombre','!=','HOTELS')->get();
        $m_categoras=M_Category::get(); 
        $webs=Web::get();
        $hotel_proveedor_id=0;
        $id=0;
        $fecha_ini=date("Y-m-d");
        $fecha_fin=date("Y-m-d");
        $web= 'gotoperu.com';
        $filtro='filtro';
        return view('admin.database.provider',compact('destinations','providers','categorias','entidadBancaria','m_categories','m_categoras','webs'));
    }
    public function autocomplete()
    {
        $clave='';
//        dd($clave);
//        if ($request->ajax()) {
            $term = Input::get('term');
            $localizacion = Input::get('localizacion');
            $grupo= Input::get('grupo');
            $estrellas='';
            if($grupo=='HOTELS'){
                $estrellas= Input::get('estrellas');
            }
            $destino=M_Destino::where('destino',$localizacion)->first();

//            return ['id'=>$destino->id,'value'=>$destino->destino.''.$destino->codigo];
//            $rs =strtoupper($request->get('txt_provider_0'));
            $results = null;
            $results = [];
            $proveedor=null;
            if($grupo=='HOTELS') {
                $proveedor = Proveedor::where('codigo', 'like', '%' . $term . '%')
                    ->orWhere('nombre_comercial', 'like', '%' . $term . '%')
                    ->get();
            }
            else{
                $proveedor = Proveedor::where('codigo', 'like', '%' . $term . '%')
                    ->orWhere('nombre_comercial', 'like', '%' . $term . '%')
                    ->get();
            }
//            $queries = DB::table('users')
//                ->where('first_name', 'LIKE', '%'.$term.'%')
//                ->orWhere('last_name', 'LIKE', '%'.$term.'%')
//                ->take(5)->get();

            foreach ($proveedor as $query) {
//                $rpt1=strpos($query->codigo,$term);
//                $rpt2=strpos($query->razon_social,$term);
                if($grupo==$query->grupo){
                    if($grupo=='HOTELS') {
                        if($estrellas==$query->categoria){
                            if($query->destinos_operados->where('m_destinos_id',$destino->id)->count()>0)
                            $results[] = ['id' => $query->id, 'value' => $query->codigo.' '.$query->nombre_comercial];
                        }
                    }
                    else{
//                        if($localizacion==$query->localizacion)
                            $results[] = ['id' => $query->id, 'value' => $query->codigo.' '.$query->nombre_comercial];
                    }
                }
            }
            return response()->json($results);
//            $rs1=[];
//            $rs1[]=$localizacion;
//            $rs1[]=$grupo;
//            $rs1[]=$term;
//            return response()->json($rs1);
//        }

    }
    public function store(Request $request){
        if ($request->ajax()) {
            $txt_grupo=$request->input('txt_grupo');
            $txt_grupo_cod=substr($txt_grupo,0,1);
            $txt_localizacion=$request->input('txt_localizacion');
            $txt_localizacion_cod=substr($txt_localizacion,0,1);
            $txt_ruc=$request->input('txt_ruc');
            $txt_razon_social=strtoupper($request->input('txt_razon_social'));
            $txt_direccion=$request->input('txt_direccion');
            $txt_telefono=$request->input('txt_telefono');
            $txt_celular=$request->input('txt_celular');
            $txt_email=$request->input('txt_email');
            $txt_r_nombres=strtoupper($request->input('txt_r_nombres'));
            $txt_r_telefono=$request->input('txt_r_telefono');
            $txt_c_nombres=strtoupper($request->input('txt_c_nombres'));
            $txt_c_telefono=$request->input('txt_c_telefono');


//            echo $txt_grupo.'_'.$txt_grupo_cod.'_'.$txt_localizacion.'_'.$txt_localizacion_cod.'_'.$txt_ruc.'_'.$txt_razon_social.'_'.$txt_direccion.'_'.$txt_telefono.
//                '_'.$txt_celular.'_'.$txt_email.'_'.$txt_r_nombres.'_'.$txt_r_telefono.'_'.$txt_c_nombres.'_'.$txt_c_telefono;

            $proveedor=new Proveedor();
            $proveedor->ruc=$txt_ruc;
            $proveedor->razon_social=$txt_razon_social;
            $proveedor->direccion=$txt_direccion;
            $proveedor->telefono=$txt_telefono;
            $proveedor->celular=$txt_celular;
            $proveedor->email=$txt_email;
            $proveedor->r_nombres=$txt_r_nombres;
            $proveedor->r_telefono=$txt_r_telefono;
            $proveedor->c_nombres=$txt_c_nombres;
            $proveedor->c_telefono=$txt_c_telefono;
            $proveedor->localizacion=$txt_localizacion;
            $proveedor->grupo=$txt_grupo;
            if($proveedor->save()){
                $proveedor->codigo=$txt_grupo_cod.$txt_localizacion_cod.$proveedor->id;
                $proveedor->save();
                return '1_'.$proveedor->codigo.'_'.$proveedor->razon_social;
//                return response()->json($resp, 200);
            }
            else{
                return '0_'.$proveedor->codigo.'_'.$proveedor->razon_social;
//                return response()->json($resp, 200);
            }
        }
        else{
            return 'hola';
//            return response()->json('hola', 200);
        }
    }
    public function store_new(Request $request){

        $categorias=M_Category::get();
        foreach($categorias as $categoria){
            $tipoServicio[]=$categoria->nombre;
        }
        $nro_grupo=$request->input('posTipo');
        $txt_grupo=$tipoServicio[$nro_grupo];
        $txt_grupo_cod=substr($txt_grupo,0,2);
        $destinos_opera =$request->input('destinos_opera_'.$nro_grupo);
        $grupos_opera =$request->input('grupos_opera_'.$nro_grupo);

//        dd($grupos_opera);
        $txt_tipo_proveedor=$request->input('txt_tipo_proveedor_'.$nro_grupo);
        $txt_tipo_pago=$request->input('txt_tipo_pago_'.$nro_grupo);
        $txt_localizacion=$request->input('txt_localizacion_'.$nro_grupo);
        $txt_localizacion_cod=substr($txt_localizacion,0,1);
        $txt_categoria=$request->input('txt_categoria_'.$nro_grupo);
        $txt_ruc=$request->input('txt_ruc_'.$nro_grupo);
        $txt_razon_social=strtoupper($request->input('txt_razon_social_'.$nro_grupo));
        $txt_nombre_comercial=strtoupper($request->input('txt_nombre_comercial_'.$nro_grupo));

        $txt_direccion=$request->input('txt_direccion_'.$nro_grupo);
        $txt_r_telefono=$request->input('txt_r_telefono_'.$nro_grupo);
        $txt_r_email=$request->input('txt_r_email_'.$nro_grupo);

        $txt_c_telefono=$request->input('txt_c_telefono_'.$nro_grupo);
        $txt_c_email=$request->input('txt_c_email_'.$nro_grupo);

        $txt_o_telefono=$request->input('txt_o_telefono_'.$nro_grupo);
        $txt_o_email=$request->input('txt_o_email_'.$nro_grupo);


        $txt_plazo=$request->input('txt_plazo_'.$nro_grupo);
        $txt_desci=$request->input('txt_desci_'.$nro_grupo);

        $txt_banco_nombre_cta_corriente=$request->input('txt_banco_nombre_cta_corriente_'.$nro_grupo);
        $txt_banco_nro_cta_corriente=$request->input('txt_banco_nro_cta_corriente_'.$nro_grupo);
        $txt_banco_nombre_cta_cci=$request->input('txt_banco_nombre_cta_cci_'.$nro_grupo);
        $txt_banco_nro_cta_cci=$request->input('txt_banco_nro_cta_cci_'.$nro_grupo);

        // $buscar_pro=Proveedor::where('localizacion',$txt_localizacion)->where('ruc',$txt_ruc)->orWhere('razon_social',$txt_razon_social)->orWhere('nombre_comercial',$txt_nombre_comercial)->count();

        // if($buscar_pro==0){
            $proveedor=new Proveedor();
            $proveedor->tipo_proveedor=$txt_tipo_proveedor;
            $proveedor->tipo_pago=$txt_tipo_pago;
            $proveedor->categoria=$txt_categoria;
            $proveedor->ruc=$txt_ruc;
            $proveedor->razon_social=$txt_razon_social;
            $proveedor->nombre_comercial=$txt_nombre_comercial;
            $proveedor->direccion=$txt_direccion;

            $proveedor->r_telefono=$txt_r_telefono;
            $proveedor->r_email=$txt_r_email;

            $proveedor->c_telefono=$txt_c_telefono;
            $proveedor->c_email=$txt_c_email;

            $proveedor->o_telefono=$txt_o_telefono;
            $proveedor->o_email=$txt_o_email;

            $proveedor->localizacion=$txt_localizacion;
            $proveedor->grupo=$txt_grupo;
            $proveedor->plazo=$txt_plazo;
            $proveedor->desci=$txt_desci;

            $proveedor->banco_nombre_cta_corriente=$txt_banco_nombre_cta_corriente;
            $proveedor->banco_nro_cta_corriente=$txt_banco_nro_cta_corriente;
            $proveedor->banco_nombre_cta_cci=$txt_banco_nombre_cta_cci;
            $proveedor->banco_nro_cta_cci=$txt_banco_nro_cta_cci;

            if($proveedor->save()){
                $proveedor->codigo=$txt_grupo_cod.$proveedor->id;
                $proveedor->save();
                if(isset($destinos_opera)){
                    foreach ($destinos_opera as $destino_opera){
                    $destino_temp=new DestinosOpera();
                        $destino_temp->proveedor_id=$proveedor->id;
                        $destino_temp->m_destinos_id=$destino_opera;
                        $destino_temp->save();
                    }
                }
                if(isset($grupos_opera)) {
                    foreach ($grupos_opera as $grupo_opera_) {
                        $grupo_opera = new GrupoOpera();
                        $grupo_opera->proveedor_id = $proveedor->id;
                        $grupo_opera->m_category_id = $grupo_opera_;
                        $grupo_opera->save();
                    }
                }
                return redirect()->route('provider_index_path')->with('success','Guardado correctamente!');
                // $destinations=M_Destino::get();
                // $providers=Proveedor::get();
                // $m_categories=M_Category::get();
                // $entidadBancaria=EntidadBancaria::get();
                // return view('admin.database.provider',compact('destinations','providers','m_categories','entidadBancaria'));
            }
        // }
        // else{
        //     return redirect()->back()->with('error','Error ya existe el proveedor con localizacion:'.$txt_localizacion.'y uno de estos campos (ruc:'.$txt_ruc.',razon_social:'.$txt_razon_social.',nombre_comercial:'.$txt_nombre_comercial.')');
        // }
    }
    public function edit(Request $request)
    {
        $id = $request->input('id');
        $grupo = $request->input('posTipoEditcost_' . $id);
//        $txt_grupo=$tipoServicio[$nro_grupo];
        $txt_grupo_cod = substr($grupo, 0, 2);
        $txt_tipo_proveedor = $request->input('txt_tipo_proveedor_');
        $txt_tipo_pago = $request->input('txt_tipo_pago_');
        $txt_localizacion = $request->input('txt_localizacion_');
        $txt_categoria = $request->input('txt_categoria_');
        $txt_localizacion_cod = substr($txt_localizacion, 0, 1);
        $txt_ruc = $request->input('txt_ruc_');
        $txt_razon_social = strtoupper($request->input('txt_razon_social_'));
        $txt_nombre_comercial = strtoupper($request->input('txt_nombre_comercial_'));
        $txt_direccion = $request->input('txt_direccion_');
        $txt_r_telefono = $request->input('txt_r_telefono_');
        $txt_r_email = $request->input('txt_r_email_');

        $txt_c_telefono = $request->input('txt_c_telefono_');
        $txt_c_email = $request->input('txt_c_email_');

        $txt_o_telefono = $request->input('txt_o_telefono_');
        $txt_o_email = $request->input('txt_o_email_');

        $txt_plazo = $request->input('txt_plazo_');
        $txt_desci = $request->input('txt_desci_');
        $destinos_opera = $request->input('destinos_opera_');
        $grupos_opera = $request->input('grupos_opera_');

        $txt_banco_nombre_cta_corriente = $request->input('txt_banco_nombre_cta_corriente_');
        $txt_banco_nro_cta_corriente = $request->input('txt_banco_nro_cta_corriente_');
        $txt_banco_nombre_cta_cci = $request->input('txt_banco_nombre_cta_cci_');
        $txt_banco_nro_cta_cci = $request->input('txt_banco_nro_cta_cci_');
//dd($destinos_opera);
        // $buscar_pro=Proveedor::where('localizacion',$txt_localizacion)->where('ruc',$txt_ruc)->orWhere('razon_social',$txt_razon_social)->orWhere('nombre_comercial',$txt_nombre_comercial)->count();

        // dd('localizacion:'.$txt_localizacion.',ruc:'.$txt_ruc.',razon_social:'.$txt_razon_social.',nombre_comercial:'.$txt_nombre_comercial);
        // if($buscar_pro==0){
            if (isset($destinos_opera)){
                $existe = DestinosOpera::where('proveedor_id', $id)->delete();
                foreach ($destinos_opera as $destinos_opera_) {
                    $destino_opera = new DestinosOpera();
                    $destino_opera->proveedor_id = $id;
                    $destino_opera->m_destinos_id = $destinos_opera_;
                    $destino_opera->save();
                }
            }
            if(isset($grupos_opera)) {
                $existe1 = GrupoOpera::where('proveedor_id', $id)->delete();
                foreach ($grupos_opera as $grupo_opera_) {
                    $grupo_opera = new GrupoOpera();
                    $grupo_opera->proveedor_id = $id;
                    $grupo_opera->m_category_id = $grupo_opera_;
                    $grupo_opera->save();
                }
            }
            $proveedor=Proveedor::findOrFail($id);
            $proveedor->tipo_proveedor=$txt_tipo_proveedor;
            $proveedor->tipo_pago=$txt_tipo_pago;
            $proveedor->ruc=$txt_ruc;
            $proveedor->localizacion=$txt_localizacion;
            $proveedor->razon_social=$txt_razon_social;
            $proveedor->nombre_comercial=$txt_nombre_comercial;
            $proveedor->direccion=$txt_direccion;
            $proveedor->r_telefono=$txt_r_telefono;
            $proveedor->r_email=$txt_r_email;

            $proveedor->c_telefono=$txt_c_telefono;
            $proveedor->c_email=$txt_c_email;

            $proveedor->o_telefono=$txt_o_telefono;
            $proveedor->o_email=$txt_o_email;

            $proveedor->categoria=$txt_categoria;
            $proveedor->plazo=$txt_plazo;
            $proveedor->desci=$txt_desci;

            $proveedor->banco_nombre_cta_corriente=$txt_banco_nombre_cta_corriente;
            $proveedor->banco_nro_cta_corriente=$txt_banco_nro_cta_corriente;
            $proveedor->banco_nombre_cta_cci=$txt_banco_nombre_cta_cci;
            $proveedor->banco_nro_cta_cci=$txt_banco_nro_cta_cci;
            $proveedor->save();
            return redirect()->route('provider_index_path')->with('success','Guardado correctamente!');;
        // }
        // else{
        //     return redirect()->back();
        // }
    }
    public function delete(Request $request){
        $id=$request->input('id');
        $producto=Proveedor::FindOrFail($id);
        $producto_pro=M_Producto::where('proveedor_id',$id)->get();
        if(count($producto_pro)==0){
            if($producto->delete())
                return 1;
            else
                return 0;
        }
        else{
            return 2;
        }
    }
    public function call_providers_localizacion(Request $request){
        set_time_limit(0);
        $destino=explode('_',$request->input('destino'));
        $grupo=$request->input('grupo');
        $proveedores=Proveedor::where('grupo',$grupo)->where('localizacion',$destino[1])->get();
        $destinations=M_Destino::get();
        $destinos_opera=DestinosOpera::get();
        $entidadBancaria=EntidadBancaria::get();
        $grupos_opera=GrupoOpera::get();
        $m_categories=M_Category::where('nombre','!=','HOTELS')->get();
        return view('admin.database.get-proveedores',compact(['proveedores','destinations','grupo','destinos_opera','entidadBancaria','grupos_opera','m_categories']));
    }
    public function call_providers_localizacion_estrellas(Request $request){
        set_time_limit(0);
        $destino=explode('_',$request->input('destino'));
        $grupo=$request->input('grupo');
        $estrellas=$request->input('estrellas');

        $proveedores=Proveedor::where('grupo',$grupo)->where('categoria',$estrellas)->where('localizacion',$destino[1])->get();
        $destinations=M_Destino::get();
        $destinos_opera=DestinosOpera::get();
        $entidadBancaria=EntidadBancaria::get();
        $grupos_opera=GrupoOpera::get();
        $m_categories=M_Category::where('nombre','!=','HOTELS')->get();
        return view('admin.database.get-proveedores',compact(['proveedores','destinations','grupo','destinos_opera','entidadBancaria','grupos_opera','m_categories']));
    }
    public function modal(Request $request){
        $id=$request->input('id');
        $grupo=$request->input('grupo');
        $provider=Proveedor::findOrFail($id);
        $destinations=M_Destino::get();
        $entidadBancaria=EntidadBancaria::get();
        $m_categories=M_Category::get();
        $destinos_opera=DestinosOpera::get();
        $grupos_opera=GrupoOpera::get();
        return view('admin.database.modal-editar-proveedor',compact('id','provider','destinations','grupo','entidadBancaria','m_categories','destinos_opera','grupos_opera'));
    }

}
