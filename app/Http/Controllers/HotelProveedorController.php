<?php

namespace App\Http\Controllers;

use App\Web;
use App\Hotel;
use App\M_Destino;
use App\Proveedor;
use App\M_Category;
use App\HotelProveedor;
use Illuminate\Http\Request;

class HotelProveedorController extends Controller
{
    //
    public function editar_hotel_proveedor($hotel_proveedor_id){
        $destinations=M_Destino::get();
        $categorias=M_Category::get();
        $hotel=HotelProveedor::FindOrFail($hotel_proveedor_id);
        $proveedor_escojido=Proveedor::FindOrFail($hotel->proveedor_id);
        $hotel_solo=Hotel::get();
        $productos=Proveedor::with(['productos'])->get();
        $webs=Web::get();
        return view('admin.database.hotel-proveedor',['destinations'=>$destinations,'categorias'=>$categorias,
            'productos'=>$productos,'hotel'=>$hotel,'hotel_solo'=>$hotel_solo,'hotel_proveedor_id'=>$hotel_proveedor_id,
            'proveedor_escojido'=>$proveedor_escojido,'webs'=>$webs]);
    }
    public function update_hotel_proveedor(Request $request)
    {
        $txt_provider_0=$request->input('txt_provider_0');
        $txt_provider_0=explode(' ',$txt_provider_0);
        $estrellas=$request->input('txt_categoria_0');
        $S_2=$request->input('S_2');
        $D_2=$request->input('D_2');
        $M_2=$request->input('M_2');
        $T_2=$request->input('T_2');

        $S_3=$request->input('S_3');
        $D_3=$request->input('D_3');
        $M_3=$request->input('M_3');
        $T_3=$request->input('T_3');;

        $S_4=$request->input('S_4');
        $D_4=$request->input('D_4');
        $M_4=$request->input('M_4');
        $T_4=$request->input('T_4');

        $S_5=$request->input('S_5');
        $D_5=$request->input('D_5');
        $M_5=$request->input('M_5');
        $T_5=$request->input('T_5');

        $SS_2=$request->input('SS_2');
        $SS_3=$request->input('SS_3');
        $SS_4=$request->input('SS_4');
        $SS_5=$request->input('SS_5');

        $SD_2=$request->input('SD_2');
        $SD_3=$request->input('SD_3');
        $SD_4=$request->input('SD_4');
        $SD_5=$request->input('SD_5');

        $SU_2=$request->input('SU_2');
        $SU_3=$request->input('SU_3');
        $SU_4=$request->input('SU_4');
        $SU_5=$request->input('SU_5');

        $JS_2=$request->input('JS_2');
        $JS_3=$request->input('JS_3');
        $JS_4=$request->input('JS_4');
        $JS_5=$request->input('JS_5');

        $hotel_id_2=$request->input('hotel_id_2');
        $hotel_id_3=$request->input('hotel_id_3');
        $hotel_id_4=$request->input('hotel_id_4');
        $hotel_id_5=$request->input('hotel_id_5');

        $hotel_pro_id_2=$request->input('hotel_pro_id_2');
        $hotel_pro_id_3=$request->input('hotel_pro_id_3');
        $hotel_pro_id_4=$request->input('hotel_pro_id_4');
        $hotel_pro_id_5=$request->input('hotel_pro_id_5');

//        if($hotel_pro_id_2>0)
//            HotelProveedor::where('id',$hotel_pro_id_2)->delete();
//
//        if($hotel_pro_id_3>0)
//            HotelProveedor::where('id',$hotel_pro_id_3)->delete();
//
//        if($hotel_pro_id_4>0)
//            HotelProveedor::where('id',$hotel_pro_id_4)->delete();
//
//        if($hotel_pro_id_5>0)
//            HotelProveedor::where('id',$hotel_pro_id_5)->delete();

        if($estrellas==2) {
            $objeto = HotelProveedor::FindOrFail($hotel_pro_id_2);
            $objeto->single = $S_2;
            $objeto->doble = $D_2;
            $objeto->matrimonial = $M_2;
            $objeto->triple = $T_2;
            $objeto->superior_s = $SS_2;
            $objeto->superior_d = $SD_2;
            $objeto->suite = $SU_2;
            $objeto->jr_suite = $JS_2;
            $objeto->save();
        }
        if($estrellas==3) {
            $objeto3 = HotelProveedor::FindOrFail($hotel_pro_id_3);
            $objeto3->single = $S_3;
            $objeto3->doble = $D_3;
            $objeto3->matrimonial = $M_3;
            $objeto3->triple = $T_3;
            $objeto3->superior_s = $SS_3;
            $objeto3->superior_d = $SD_3;
            $objeto3->suite = $SU_3;
            $objeto3->jr_suite = $JS_3;
            $objeto3->save();
        }
        if($estrellas==4) {
            $objeto4 = HotelProveedor::FindOrFail($hotel_pro_id_4);
            $objeto4->single = $S_4;
            $objeto4->doble = $D_4;
            $objeto4->matrimonial = $M_4;
            $objeto4->triple = $T_4;
            $objeto4->superior_s = $SS_4;
            $objeto4->superior_d = $SD_4;
            $objeto4->suite = $SU_4;
            $objeto4->jr_suite = $JS_4;
            $objeto4->save();
        }
        if($estrellas==5) {
            $objeto5 = HotelProveedor::FindOrFail($hotel_pro_id_5);
            $objeto5->single = $S_5;
            $objeto5->doble = $D_5;
            $objeto5->matrimonial = $M_5;
            $objeto5->triple = $T_5;
            $objeto5->superior_s = $SS_5;
            $objeto5->superior_d = $SD_5;
            $objeto5->suite = $SU_5;
            $objeto5->jr_suite = $JS_5;
            $objeto5->save();
        }
        return redirect()->route('costs_index_path');
    }
    public function delete(Request $request){
        $id=$request->input('id');
        $servicio=HotelProveedor::FindOrFail($id);
        if($servicio->delete())
            return 1;
        else
            return 0;
    }

}

