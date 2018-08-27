<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Cotizacion;
use App\ItinerarioServicios;
use App\M_Servicio;
use App\PrecioHotelReserva;
use App\Proveedor;
use Illuminate\Http\Request;

class OperacionesController extends Controller
{
    //
    public function index()
    {
        $desde=date('Y-m-d');
        $hasta=date('Y-m-d');
//        dd($desde);
//        dd($hasta);
        $cotizaciones=Cotizacion::with(['paquete_cotizaciones.itinerario_cotizaciones'=> function ($query) use ($desde,$hasta) {
            $query->whereBetween('fecha', array($desde, $hasta));
        }])
            ->where('confirmado_r','ok')
            ->get();
        $clientes2=Cliente::get();
        $m_servicios=M_Servicio::get();
        $proveedores=Proveedor::get();
        session()->put('menu','operaciones');
        return view('admin.operaciones.operaciones',compact('cotizaciones','desde','hasta','clientes2','m_servicios','proveedores'));
    }
    public function Lista_fechas(Request $request)
    {
        $desde = $request->input('txt_desde');
        $hasta = $request->input('txt_hasta');
//        dd($desde);
//        dd($hasta);

        $cotizaciones = Cotizacion::with(['paquete_cotizaciones.itinerario_cotizaciones' => function ($query) use ($desde, $hasta) {
            $query->whereBetween('fecha', array($desde, $hasta));
        }])
            ->where('confirmado_r', 'ok')
            ->get();
        $clientes2 = Cliente::get();
        $m_servicios = M_Servicio::get();
        $proveedores = Proveedor::get();
        return view('admin.operaciones.operaciones', compact('cotizaciones', 'desde', 'hasta', 'clientes2', 'm_servicios', 'proveedores'));
        foreach ($cotizaciones->sortby('fecha') as $cotizacion) {
            $clientes_ = [];
            $array_itinerario_hora = [];
            foreach ($cotizacion->cotizaciones_cliente as $cotizacion_cliente) {
                foreach ($clientes2->where('id', $cotizacion_cliente->clientes_id) as $cliente) {
                    $clientes_[] = $cliente->nombres . " " . $cliente->apellidos;
                }
            }
            foreach ($cotizacion->paquete_cotizaciones->where('estado', '2') as $pqts) {
                foreach ($pqts->itinerario_cotizaciones->sortby('fecha') as $itinerario) {
                    foreach ($itinerario->itinerario_servicios->sortby('hora_llegada') as $servicio) {
                        $array_itinerario_hora[$itinerario.'_'.$servicio->servicio->grupo.'_'.$servicio->hora_llegada]='';
                    }
                }
            }
        }
    }
    public function sp($id1,$id,$sp)
    {
        $iti=ItinerarioServicios::FindOrFail($id);
        $iti->s_p=$sp;
        $iti->save();
        return redirect()->route('book_show_path',$id1);
    }
    public function pdf($desde,$hasta)
    {
        $cotizaciones=Cotizacion::with(['paquete_cotizaciones.itinerario_cotizaciones'=> function ($query) use ($desde,$hasta) {
            $query->whereBetween('fecha', array($desde, $hasta));
        }])
            ->where('confirmado_r','ok')
            ->get();
        $clientes2=Cliente::get();
        $m_servicios=M_Servicio::get();
        $proveedores=Proveedor::get();
        $pdf = \PDF::loadView('admin.operaciones.operaciones-pdf', compact('cotizaciones','desde','hasta','clientes2','m_servicios','proveedores'))
        ->setPaper('a4', 'landscape')->setWarnings(true);
        return $pdf->download('Operaciones'.'.pdf');

    }
    public function asignar_observacion(Request $request)
    {
        $id=$request->input('id');
        $obs=$request->input('obs');
        $iti=ItinerarioServicios::FindOrFail($id);
        $iti->obs_operaciones=$obs;
        if($iti->save())
            return 1;
        else
            return 0;
    }
    public function segunda_confirmada(Request $request)
    {
        $id=$request->input('id');
        $confi2=$request->input('confi2');
        $iti=ItinerarioServicios::FindOrFail($id);
        $iti->segunda_confirmada=$confi2;
        if($iti->save())
            return 1;
        else
            return 0;
    }
    public function segunda_confirmada_hotel(Request $request)
    {
        $id=$request->input('id');
        $confi2=$request->input('confi2');
        $iti=PrecioHotelReserva::FindOrFail($id);
        $iti->segunda_confirmada=$confi2;
        if($iti->save())
            return 1;
        else
            return 0;
    }


}
