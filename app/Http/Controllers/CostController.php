<?php

namespace App\Http\Controllers;

use App\Web;
use App\Hotel;
use App\M_Destino;
use App\Proveedor;
use App\M_Category;
use App\M_Producto;
use App\M_Servicio;
use App\HotelProveedor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class CostController extends Controller
{
    //
    public function index(){
        $valor='';
        $productos_hotels=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','HOTELS');}])->get();
        $productos_tours=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','TOURS');}])->get();
        $productos_transp=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','TRANSPORTATION');}])->get();
        $productos_guides=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','GUIDES_ASSIST');}])->get();
        $productos_entrances=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','ENTRANCES');}])->get();
        $productos_food=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','FOOD');}])->get();
        $productos_trains=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','TRAINS');}])->get();
        $productos_travels=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','TRAVELS');}])->get();
        $productos_others=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','OTHERS');}])->get();
        $destinations=M_Destino::get();
        $categorias=M_Category::get();
        $hotel=HotelProveedor::get();
        $hotel_solo=Hotel::get();

        $proveedores=[];
        foreach ($hotel as $hotel_){
            if(!in_array($hotel_->localizacion.'_'.$hotel_->proveedor_id,$proveedores)){
                $proveedores[]=$hotel_->localizacion.'_'.$hotel_->proveedor_id;
            }
        }
//        dd($array);
        $proveedor_db=Proveedor::get();
        $productos=Proveedor::with(['productos'])->get();
//        dd($productos_hotels);
        $webs=Web::get();
        session()->put('menu-lateral', 'Scosts');
        return view('admin.database.costs',['productos_hotels'=>$productos_hotels,
            'productos_tours'=>$productos_tours,'productos_transp'=>$productos_transp,
            'productos_guides'=>$productos_guides,'productos_entrances'=>$productos_entrances,
            'productos_food'=>$productos_food,'productos_trains'=>$productos_trains,
            'productos_travels'=>$productos_travels,'productos_others'=>$productos_others,
            'destinations'=>$destinations,'categorias'=>$categorias,
            'productos'=>$productos,'hotel'=>$hotel,'proveedores'=>$proveedores,'hotel_solo'=>$hotel_solo,'proveedor_db'=>$proveedor_db,'webs'=>$webs]);
    }
    public function new_(){
        $valor='';
        $productos_hotels=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','HOTELS');}])->get();
        $productos_tours=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','TOURS');}])->get();
        $productos_transp=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','TRANSPORTATION');}])->get();
        $productos_guides=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','GUIDES_ASSIST');}])->get();
        $productos_entrances=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','ENTRANCES');}])->get();
        $productos_food=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','FOOD');}])->get();
        $productos_trains=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','TRAINS');}])->get();
        $productos_travels=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','TRAVELS');}])->get();
        $productos_others=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','OTHERS');}])->get();
        $destinations=M_Destino::get();
        $categorias=M_Category::get();
        $hotel=HotelProveedor::get();
        $hotel_solo=Hotel::get();

        $proveedores=[];
        foreach ($hotel as $hotel_){
            if(!in_array($hotel_->localizacion.'_'.$hotel_->proveedor_id,$proveedores)){
                $proveedores[]=$hotel_->localizacion.'_'.$hotel_->proveedor_id;
            }
        }
//        dd($array);
        $proveedor_db=Proveedor::get();
        $productos=Proveedor::with(['productos'])->get();
//        dd($productos_hotels);
        $webs=Web::get();
        session()->put('menu-lateral', 'Scosts');
        return view('admin.database.costs-new',['productos_hotels'=>$productos_hotels,
            'productos_tours'=>$productos_tours,'productos_transp'=>$productos_transp,
            'productos_guides'=>$productos_guides,'productos_entrances'=>$productos_entrances,
            'productos_food'=>$productos_food,'productos_trains'=>$productos_trains,
            'productos_travels'=>$productos_travels,'productos_others'=>$productos_others,
            'destinations'=>$destinations,'categorias'=>$categorias,
            'productos'=>$productos,'hotel'=>$hotel,'proveedores'=>$proveedores,'hotel_solo'=>$hotel_solo,'proveedor_db'=>$proveedor_db,'webs'=>$webs]);
    }
    public function store(Request $request){
        $categorias=M_Category::get();
        foreach($categorias as $categoria){
            $tipoServicio[]=$categoria->nombre;
        }

        $posTipo=$request->input('posTipo');
//        dd($posTipo);
        if($posTipo!=0){
//        $posTipo=0;
        $localizacion='txt_localizacion_'.$posTipo;
        $type='txt_type_'.$posTipo;
        $provider='txt_provider_'.$posTipo;
        $product='txt_product_'.$posTipo;
        $code='txt_code_'.$posTipo;
        $price='txt_price_'.$posTipo;
        $acomodacion='txt_acomodacion_'.$posTipo;
        $tipo_grupo='txt_tipo_grupo_'.$posTipo;
        $txt_tipo_grupo=$request->input($tipo_grupo);

        if($txt_tipo_grupo=='Absoluto')
            $txt_price_chb=1;
        else
            $txt_price_chb=0;

        $txt_acomodacion=$request->input($acomodacion);
        if(strlen($txt_acomodacion)>0)
            $txt_acomodacion=$txt_acomodacion;
        else
            $txt_acomodacion='';

        $txt_localizacion=strtoupper($request->input($localizacion));
        $txt_type=$request->input($type);
        $txt_provider=explode(' ',$request->input($provider));
        $txt_product=explode(' ',strtoupper($request->input($product)));
        $txt_code=$txt_product[0];
        $txt_price=$request->input($price);

        $proveedor=Proveedor::where('codigo',$txt_provider[0])->get();
        $prod=M_Servicio::where('codigo',$txt_product[0])->get();
//        dd($proveedor);
        if(count($proveedor)>0) {
            $proveedor_id=0;
            foreach ($proveedor as $pro){
                $proveedor_id=$pro->id;
            }
            $prod__precio_g=0;
            $prod_nombre='';
            $pro_id=0;
            foreach ($prod as $pro){
                $prod__precio_g=$pro->precio_grupo;
                $prod_nombre=$pro->nombre;
                $pro_id=$pro->id;
            }
            $producto = new M_Producto();
            $producto->codigo = $txt_code;
            $producto->grupo = $tipoServicio[$posTipo];
            $producto->localizacion = $txt_localizacion;
            $producto->tipo_producto = $txt_type;
            $producto->nombre = $prod_nombre;
            $producto->descripcion = '';
            $producto->precio_costo = $txt_price;
            $producto->acomodacion = $txt_acomodacion;
            $producto->precio_grupo = $prod__precio_g;
            $producto->proveedor_id = $proveedor_id;
            $producto->m_servicios_id = $pro_id;
            $producto->save();

            return redirect()->route('costs_index_path');
        }
        }
        else{
            $categoria='txt_categoria_'.$posTipo;
            $txt_categoria=$request->input($categoria);
            $localizacion='txt_localizacion_'.$posTipo;
            $txt_localizacion=strtoupper($request->input($localizacion));
            $provider='txt_provider_'.$posTipo;
            $txt_provider=explode(' ',$request->input($provider));
            $proveedor=Proveedor::where('codigo',$txt_provider[0])->get();
            $proveedor_id=0;
            if(count($proveedor)>0) {
                foreach ($proveedor->take(1) as $pro){
                    $proveedor_id=$pro->id;
                }


                if($txt_categoria=='2') {
                $S_2 = $request->input('S_2');
                $D_2 = $request->input('D_2');
                $M_2 = $request->input('M_2');
                $T_2 = $request->input('T_2');
                $SS_2 = $request->input('SS_2');
                $SD_2 = $request->input('SD_2');
                $SU_2 = $request->input('SU_2');
                $JS_2 = $request->input('JS_2');
            }
            if($txt_categoria=='3') {
                $S_3 = $request->input('S_3');
                $D_3 = $request->input('D_3');
                $M_3 = $request->input('M_3');
                $T_3 = $request->input('T_3');
                $SS_3 = $request->input('SS_3');
                $SD_3 = $request->input('SD_3');
                $SU_3 = $request->input('SU_3');
                $JS_3 = $request->input('JS_3');

            }
            if($txt_categoria=='4') {
                $S_4 = $request->input('S_4');
                $D_4 = $request->input('D_4');
                $M_4 = $request->input('M_4');
                $T_4 = $request->input('T_4');
                $SS_4 = $request->input('SS_4');
                $SD_4 = $request->input('SD_4');
                $SU_4 = $request->input('SU_4');
                $JS_4 = $request->input('JS_4');
            }
            if($txt_categoria=='5') {
                $S_5 = $request->input('S_5');
                $D_5 = $request->input('D_5');
                $M_5 = $request->input('M_5');
                $T_5 = $request->input('T_5');
                $SS_5 = $request->input('SS_5');
                $SD_5 = $request->input('SD_5');
                $SU_5 = $request->input('SU_5');
                $JS_5 = $request->input('JS_5');
            }
            if($txt_categoria=='2') {
                $hotel_proveedor = new HotelProveedor();
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
                $hotel_proveedor->proveedor_id = $proveedor_id;
                $hotel_proveedor->estado = 1;
                $hotel_proveedor->hotel_id = $request->input('hotel_id_2');
                $hotel_proveedor->save();
            }
            if($txt_categoria=='3') {
                $hotel_proveedor_3 = new HotelProveedor();
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
                $hotel_proveedor_3->proveedor_id = $proveedor_id;
                $hotel_proveedor_3->estado = 1;
                $hotel_proveedor_3->hotel_id = $request->input('hotel_id_3');
                $hotel_proveedor_3->save();
//                dd($hotel_proveedor_3);
            }
            if($txt_categoria=='4') {
                $hotel_proveedor_4 = new HotelProveedor();
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
                $hotel_proveedor_4->proveedor_id = $proveedor_id;
                $hotel_proveedor_4->estado = 1;
                $hotel_proveedor_4->hotel_id = $request->input('hotel_id_4');
                $hotel_proveedor_4->save();
            }
            if($txt_categoria=='5') {
                $hotel_proveedor_5 = new HotelProveedor();
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
                $hotel_proveedor_5->proveedor_id = $proveedor_id;
                $hotel_proveedor_5->estado = 1;
                $hotel_proveedor_5->hotel_id = $request->input('hotel_id_5');
                $hotel_proveedor_5->save();
            }
            return redirect()->route('costs_index_path');
            }
        }
    }
    public function delete(Request $request){
        $id=$request->input('id');
        $producto=M_Producto::FindOrFail($id);
        if($producto->delete())
            return 1;
        else
            return 0;
    }
    public function edit(Request $request){
        $categorias=M_Category::get();
        foreach($categorias as $categoria){
            $tipoServicio[]=$categoria->nombre;
        }

//        $posTipo=$request->input('posTipo');
        $id=$request->input('id');
        $posTipo=0;
        $localizacion='txt_localizacion_'.$posTipo;
        $type='txt_type_'.$posTipo;
        $provider='txt_provider_'.$posTipo;
        $product='txt_product_'.$posTipo;
        $code='txt_code_'.$posTipo;
        $price='txt_price_'.$posTipo;
        $acomodacion='txt_acomodacion_'.$posTipo;
        $tipo_grupo='txt_tipo_grupo_'.$posTipo;
        $txt_tipo_grupo=$request->input($tipo_grupo);

        if($txt_tipo_grupo=='Absoluto')
            $txt_price_chb=1;
        else
            $txt_price_chb=0;

        $txt_acomodacion=$request->input($acomodacion);
        if(strlen($txt_acomodacion)>0)
            $txt_acomodacion=$txt_acomodacion;
        else
            $txt_acomodacion='';

        $txt_localizacion=strtoupper($request->input($localizacion));
        $txt_type=$request->input($type);
        $txt_provider=explode(' ',$request->input($provider));
        $txt_product=explode(' ',strtoupper($request->input($product)));
        $txt_code=$txt_product[0];
        $txt_price=$request->input($price);

        $proveedor=Proveedor::where('codigo',$txt_provider[0])->get();
        $prod=M_Servicio::where('codigo',$txt_product[0])->get();

//        dd($proveedor);
        if(count($proveedor)>0) {
            $proveedor_id=0;
            foreach ($proveedor as $pro){
                $proveedor_id=$pro->id;
            }
            $prod__precio_g=0;
            $prod_nombre='';
            foreach ($prod as $pro){
                $prod__precio_g=$pro->precio_grupo;
                $prod_nombre=$pro->nombre;
            }
            $producto = M_Producto::FindOrFail($id);
            $producto->codigo = $txt_code;
//            $producto->grupo = $tipoServicio[$posTipo];
            $producto->localizacion = $txt_localizacion;
            $producto->tipo_producto = $txt_type;
            $producto->nombre = $prod_nombre;
            $producto->descripcion = '';
            $producto->precio_costo = $txt_price;
            $producto->acomodacion = $txt_acomodacion;
            $producto->precio_grupo = $prod__precio_g;
            $producto->proveedor_id = $proveedor_id;
            $producto->save();

            return redirect()->route('costs_index_path');
        }
    }
    public function mostrar_hotel(Request $request){
        $localizacion=strtoupper($request->input('loca'));
        $hotel=Hotel::where('localizacion',$localizacion)->get();
        $cadena='';
        foreach ($hotel as $hotel_){
            $cadena.=$hotel_->id.'_'.$hotel_->single.'_'.$hotel_->doble.'_'.$hotel_->matrimonial.'_'.$hotel_->triple.'_'.$hotel_->superior_s.'_'.$hotel_->superior_d.'_'.$hotel_->suite.'_'.$hotel_->jr_suite.'_';
        }
        return $cadena;
    }
    public function call_cost_providers_localizacion(Request $request){
        $destino=explode('_',$request->input('destino'));
        $grupo=$request->input('grupo');
        $hotel=HotelProveedor::where('localizacion',$destino[1])->get();
        // $proveedores=Proveedor::where('localizacion',$destino[1])->where('grupo',$grupo)->get();
        $destinations=M_Destino::get();
        return view('admin.database.get-hotel-proveedores',compact(['destinations','grupo','hotel']));
    }
    public function call_cost_providers_localizacion_estrellas(Request $request){
        $destino=explode('_',$request->input('destino'));
        $grupo=$request->input('grupo');
        $estrellas=$request->input('estrellas');
        $hotel=HotelProveedor::where('localizacion',$destino[1])->get();
//        $proveedores=Proveedor::where('localizacion',$destino[1])->where('grupo',$grupo)->get();
        $destinations=M_Destino::get();
        return view('admin.database.get-hotel-proveedores-estrellas',compact(['destinations','grupo','hotel','estrellas']));
    }

}
