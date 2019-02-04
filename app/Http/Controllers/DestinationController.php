<?php

namespace App\Http\Controllers;

use App\Web;
use App\M_Destino;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DestinationController extends Controller
{
    //
    public function index(){
        $destinos=M_Destino::get();
        $webs=Web::get();
        session()->put('menu-lateral', 'sales/iti/destinations');
        return view('admin.database.destination',['destinos'=>$destinos,'webs'=>$webs]);
    }
    public function store(Request $request){
        $txt_codigo=strtoupper($request->input('txt_codigo'));
        $txt_destino=strtoupper($request->input('txt_destino'));
        $txt_descripcion=$request->input('txt_descripcion');
        $txt_pais=strtoupper($request->input('txt_pais'));
        $txt_region=strtoupper($request->input('txt_region'));
        $txt_departamento=strtoupper($request->input('txt_departamento'));
        $txt_imagen=$request->file('txt_imagen');
        $destino=new M_Destino();
        $destino->codigo=$txt_codigo;
        $destino->destino=$txt_destino;
        $destino->departamento=$txt_departamento;
        $destino->region=$txt_region;
        $destino->pais=$txt_pais;
        $destino->descripcion=$txt_descripcion;
        $destino->imagen=$txt_imagen;
        $destino->estado=1;
        $destino->save();
        if($txt_imagen){
            $filename ='destination-'.$destino->id.'.jpg';
            $destino->imagen=$filename;
            $destino->save();
            Storage::disk('destination')->put($filename,  File::get($txt_imagen));
        }
        $destinos=M_Destino::get();
        $webs=Web::get();
        return view('admin.database.destination',['destinos'=>$destinos,'webs'=>$webs]);
    }
    public function delete(Request $request){
        $id=$request->input('id');
        $destino=M_Destino::FindOrFail($id);
        if($destino->delete())
            return 1;
        else
            return 0;
    }
    public function edit(Request $request){
        $id=$request->input('id');
        $txt_codigo=strtoupper($request->input('txt_codigo'));
        $txt_destino=strtoupper($request->input('txt_destino'));
        $txt_descripcion=$request->input('txt_descripcion');
        $txt_pais=strtoupper($request->input('txt_pais'));
        $txt_region=strtoupper($request->input('txt_region'));
        $txt_departamento=strtoupper($request->input('txt_departamento'));
        $txt_imagen=$request->file('txt_imagen');
        $destino= M_Destino::FindOrFail($id);
        $destino->codigo=$txt_codigo;
        $destino->destino=$txt_destino;
        $destino->departamento=$txt_departamento;
        $destino->region=$txt_region;
        $destino->pais=$txt_pais;
        $destino->descripcion=$txt_descripcion;
        $destino->imagen=$txt_imagen;
        $destino->estado=1;
        $destino->save();
        if($txt_imagen){
            $filename ='destination-'.$destino->id.'.jpg';
            $destino->imagen=$filename;
            $destino->save();
            Storage::disk('destination')->put($filename,  File::get($txt_imagen));
        }
        $destinos=M_Destino::get();
        $webs=Web::get();
        return view('admin.database.destination',['destinos'=>$destinos,'webs'=>$webs]);
    }
    public function getDestinarionImageName($filename){
//        return Storage::setVisibility($filename, 'public');
//        Storage::getVisibility($filename);
//        return $filename;
        $file = Storage::disk('destination')->get($filename);
        return new Response($file, 200);
    }
    public function getItineraryImage($filename){
        $file = Storage::disk('destination')->get($filename);
        return new Response($file, 200);
    }
}
