<?php
namespace App\Helpers;

use App\Cotizacion;

class MisFunciones{
    public static function fecha_peru($fecha){
        if(trim($fecha)!=''){
            $fecha=explode('-',$fecha);
            return $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
        }
    }
    public static function fecha_peru_hora($fecha_hora){
        if(trim($fecha_hora)!=''){
            $fecha=explode(' ',$fecha_hora);
            $fecha1=explode('-',$fecha[0]);
            return $fecha1[2].'-'.$fecha1[1].'-'.$fecha1[0].' '.$fecha;
        }
    }
    public static function fecha_string($fecha){
        if(trim($fecha)!=''){
            $fecha=explode('-',$fecha);
            return $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
        }
    }
    public static function generar_codigo($web)
    {
        $precodigo=array(
            "gotoperu.com"=>"G",
            "llama.tours"=>"LLA",
            "gotoperu.com.pe"=>"GP",
            "andesviagens.com"=>"AV",
            "machupicchu-galapagos.com"=>"MP",
            "gotolatinamerica.com"=>"GL",
            "expedia.com"=>"E",

        );
        // $nro_codigo=Cotizacion::where('web',$web)->count()+1;
        $codigo_db =Cotizacion::where('web',$web)->orderBy('id', 'DESC')->first()->codigo;
        // $codigoo=$codigo_db ->last()->pluck('codigo');
        $nro_codigo = str_replace($precodigo[$web], "", $codigo_db);
        $nro=intval($nro_codigo)+1;
        $codigo=$precodigo[$web].$nro;
        return $codigo;
    }
}
