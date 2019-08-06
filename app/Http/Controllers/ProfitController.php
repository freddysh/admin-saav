<?php

namespace App\Http\Controllers;

use App\Web;
use App\GoalProfit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ProfitController extends Controller
{
    //
     //
     public function show($anio)
     {
        $anios =GoalProfit::pluck('anio','anio')->sortBy('anio')->toArray();
        sort($anios);
        $profit =GoalProfit::get();
        session()->put('menu-lateral', 'Scategories');
        $webs=Web::where('estado','1')->get();
        return view('admin.database.profit',compact('profit','webs','anio','anios'));
     }
     public function store(Request $request){
        $anio=$request->input('anio');
        $webs=Web::get(); 
        foreach ($webs as $value) {
            $goal=$request->input('goal_'.$value->id);
            foreach ($goal as $key => $item) {
                $me=$key+1;
                if($me<=9){
                    $me='0'.$me; 
                }
                $buscar_profit=GoalProfit::where('pagina',$value->pagina)->where('anio',$anio)->where('mes',$me)->first();
                if(count((array)$buscar_profit)==0){
                    $profit = new GoalProfit();
                    $profit->pagina=$value->pagina;
                    $profit->mes=$me;
                    $profit->anio=$anio;
                    $profit->goal=number_format((float)$item, 2, '.', '');
                    $profit->save();
                }
            }
        }
        return redirect()->route('profits_index_path',$anio); 
     }
     public function edit(Request $request){
        //  dd($request->all());
        $id= $request->input('id');
        $pagina= $request->input('pagina');
        $anio= $request->input('anio');        
        $goals=$request->input('goal_');
        // dd($goals);
        foreach ($goals as $key => $item) {
            // dd('hola');
            $me=$key+1;
            if($me<=9){
                $me='0'.$me; 
            }
            $buscar_profit=GoalProfit::where('pagina',$pagina)->where('anio',$anio)->where('mes',$me)->first();
            if(count((array)$buscar_profit)>0){
                $profit = GoalProfit::find($buscar_profit->id);
                $profit->goal=number_format((float)$item, 2, '.', '');
                $profit->save();
            }
            else{
                $profit = new GoalProfit();
                $profit->pagina=$pagina;
                $profit->mes=$me;
                $profit->anio=$anio;
                $profit->goal=number_format((float)$item, 2, '.', '');
                $profit->save();
            }
        }
        return redirect()->route('profits_index_path',$anio);
     }
     public function delete(Request $request){
        $id= $request->input('id');
        $pagina= $request->input('pagina');
        $datos=explode('_',$id);
        $anio=$datos[2];
        
        $goal_profit=GoalProfit::where('pagina',$pagina)->where('anio',$anio)->get();
        // return response()->json($goal_profit);
        // // dd($goal_profit);
        foreach ($goal_profit as $value) {
            # code...
            $temp=GoalProfit::find($value->id);
            $temp->delete();
        } 
        return 1;
        // if($goal_profit->delete())
        //     return 1;
        // else
        //     return 0;
     }
     public function enviar_file(Request $request){
        //  return response()->json($request->file('foto'));
        
        // $file=$request->file('foto');
        // return $file->getClientOriginalName();
        $file = Input::file('foto')->getClientOriginalName(); 
        return $file;
        // $id= $request->input('id');
        // $pagina= $request->input('pagina');
        // $datos=explode('_',$id);
        // $anio=$datos[2];
        
        // $goal_profit=GoalProfit::where('pagina',$pagina)->where('anio',$anio)->get();
        // // return response()->json($goal_profit);
        // // // dd($goal_profit);
        // foreach ($goal_profit as $value) {
        //     # code...
        //     $temp=GoalProfit::find($value->id);
        //     $temp->delete();
        // } 
        // return 1;
        // if($goal_profit->delete())
        //     return 1;
        // else
        //     return 0;
     }

     
}
