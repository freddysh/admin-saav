<?php
namespace App\Helpers;

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
}
