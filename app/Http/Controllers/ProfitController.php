<?php

namespace App\Http\Controllers;

use App\Web;
use Illuminate\Http\Request;
use App\GoalProfit;

class ProfitController extends Controller
{
    //
     //
     public function show($anio)
     {
         $profit =GoalProfit::where('anio',$anio)->get();
         session()->put('menu-lateral', 'Scategories');
         $webs=Web::get();
         return view('admin.database.profit', ['profit' => $profit,'webs'=>$webs,'anio'=>$anio]);
     }
     public function store(Request $request){
         $txt_nombre=strtoupper($request->input('txt_nombre'));
         $periodo=strtoupper($request->input('periodo'));
         $tipo_periodo=strtoupper($request->input('tipo_periodo'));
         $categoria=new M_Category();
         $categoria->nombre=$txt_nombre;
 //        $categoria->periodo=$periodo;
 //        $categoria->tipo_periodo=$tipo_periodo;
         $categoria->save();
         $webs=Web::get();
         $categorias=M_Category::get();
         return view('admin.database.category',['categorias'=>$categorias,'webs'=>$webs]);
 
     }
     public function edit(Request $request){
         $txt_id=strtoupper($request->input('id'));
         $txt_nombre=strtoupper($request->input('txt_nombre'));
         $periodo=strtoupper($request->input('periodo'));
         $tipo_periodo=strtoupper($request->input('tipo_periodo'));
         $categoria=M_Category::FindOrFail($txt_id);
         $categoria->nombre=$txt_nombre;
 //        $categoria->periodo=$periodo;
 //        $categoria->tipo_periodo=$tipo_periodo;
         $categoria->save();
         $webs=Web::get();
         $categorias=M_Category::get();
         return view('admin.database.category',['categorias'=>$categorias,'webs'=>$webs]);
     }
     public function delete(Request $request){
         $id=$request->input('id');
         $categoria=M_Category::FindOrFail($id);
         if($categoria->delete())
             return 1;
         else
             return 0;
     }
}
