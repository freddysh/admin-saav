<?php

namespace App\Http\Controllers;

use App\Web;
use App\User;
use DateTime;
use App\Cliente;
use App\Proveedor;
use Carbon\Carbon;
use App\Cotizacion;
use App\GoalProfit;
use App\M_Category;
use App\M_Producto;
use App\M_Servicio;
use App\CuentasGoto;
use App\Liquidacion;
use App\ConsultaPago;
use App\M_Itinerario;
use App\P_Itinerario;
use App\Requerimiento;
use App\HotelProveedor;
use App\EntidadBancaria;
use App\ConsultaPagoHotel;
use App\CotizacionArchivos;
use App\PrecioHotelReserva;
use App\CotizacionesCliente;
use App\ItinerarioServicios;
use App\PaqueteCotizaciones;
use Illuminate\Http\Request;
use App\Helpers\MisFunciones;
use Illuminate\Http\Response;
use App\ItinerarioCotizaciones;
use App\PrecioHotelReservaPagos;
use App\ItinerarioServiciosPagos;
use App\ItinerarioServicioProveedor;
use App\ItinerarioServiciosAcumPago;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ContabilidadController extends Controller
{
    //
    public function index()
    {
        $cotizacion = Cotizacion::where('confirmado_r', 'ok')->get();
        session()->put('menu', 'contabilidad');
        $webs = Web::get();
        return view('admin.contabilidad.index', ['cotizacion' => $cotizacion,'webs'=>$webs]);
    }

    public function list_proveedores()
    {
        $pagos = ItinerarioServiciosPagos::get();
        $proveedor = ItinerarioServicioProveedor::get();
        $servicios = ItinerarioServicios::with('itinerario_servicio_proveedor')->get();

        return view('admin.contabilidad.lista-proveedor', ['proveedor' => $proveedor, 'servicios' => $servicios, 'pagos' => $pagos]);
    }

    public function rango_fecha()
    {
        $consulta = ConsultaPago::all();
        return view('admin.contabilidad.rango-fecha', ['consulta' => $consulta]);
    }

    public function list_fechas_rango()
    {
        $ini = $_POST['txt_ini'];
        $fin = $_POST['txt_fin'];

        return redirect()->route('list_fechas_path', [$ini, $fin]);
    }

    public function list_fechas($fecha_i, $fecha_f)
    {
        $ini = $fecha_i;
        $fin = $fecha_f;
        $cotizacion = Cotizacion::get();
        $pagos = ItinerarioServiciosPagos::get();
        $proveedor = ItinerarioServicioProveedor::get();
        $servicios = ItinerarioServicios::with('itinerario_servicio_proveedor')->get();

        return view('admin.contabilidad.lista-fecha', ['proveedor' => $proveedor, 'servicios' => $servicios, 'pagos' => $pagos, 'cotizacion' => $cotizacion, 'ini' => $ini, 'fin' => $fin]);
    }

    public function list_fechas_show()
    {
        $ids = 0;
        if (isset($_POST['chk_id'])) {
            $ids = $_POST['chk_id'];
        }
        $codigos = 0;
        if (isset($_POST['txt_codigos'])) {
            $codigos = $_POST['txt_codigos'];
        }
        $servicios = ItinerarioServicios::with('itinerario_servicio_proveedor')->get();
//        dd($servicios);
        $consulta = ConsultaPagoHotel::where('id', $codigos)->get();
//        dd($consulta);
        $pagos=PrecioHotelReservaPagos::get();
//        dd($pagos);
        $cuentas_goto=CuentasGoto::get();
        $entidad_bancaria=EntidadBancaria::get();
        return view('admin.contabilidad.lista-pagos-hoteles',compact(['ids','codigos','consulta','pagos','cuentas_goto','entidad_bancaria']));
    }

    public function consulta_delete(Request $request)
    {
        if($request->input('tipo')=='h')
            $consulta =ConsultaPagoHotel::FindOrFail($request->input('id'));
        elseif($request->input('tipo')=='s')
            $consulta =ConsultaPago::FindOrFail($request->input('id'));

        if($consulta->delete())
            return '1';
        else
            return '0';
//        $consulta = ConsultaPago::findOrFail($id);
//        $consulta->delete();
//        return redirect()->route('rango_fecha_path');

//        Session::flash('message', 'La consulta fue eliminada satisfactoriamente');

//        return redirect()->route('rango_fecha_path');
    }

    public function pagar_consulta()
    {
        $idservicio = $_POST['txt_idservicio'];
        $saldo = $_POST['txt_saldo'];
        $pagado = $_POST['txt_pagado'];
        $fvpago = $_POST['txt_fvpago'];
        $medio = $_POST['txt_medio'];
        $cuenta = $_POST['txt_cuenta'];
        $transaccion = $_POST['txt_transaccion'];

        $mcuenta = $_POST['txt_mcuenta'];
        $idpago = $_POST['txt_idpago'];
//        $itinerario_servicio_pago = ItinerarioServiciosPagos::where('itinerario_servicios_id', $idservicio)->get();

        $pago = $mcuenta - $saldo;


        if ($idpago == 0) {

            if ($mcuenta == $saldo) {
                $p_servicio = new ItinerarioServiciosPagos;
                $p_servicio->a_cuenta = $saldo;
                $p_servicio->medio = $medio;
                $p_servicio->cuenta = $cuenta;
                $p_servicio->transaccion = $transaccion;
                $p_servicio->estado = 1;
                $p_servicio->itinerario_servicios_id = $idservicio;
                $p_servicio->save();

                return "cuenta = 0 id = 0/" . $p_servicio->id;
            } else {

                $p_servicio_1 = new ItinerarioServiciosPagos;
                $p_servicio_1->a_cuenta = $saldo;
                $p_servicio_1->medio = $medio;
                $p_servicio_1->cuenta = $cuenta;
                $p_servicio_1->transaccion = $transaccion;
                $p_servicio_1->estado = 1;
                $p_servicio_1->itinerario_servicios_id = $idservicio;
                $p_servicio_1->save();

                $p_servicio_2 = new ItinerarioServiciosPagos;
                $p_servicio_2->a_cuenta = $pago;
                $p_servicio_2->fecha_a_pagar = $fvpago;
                $p_servicio_2->estado = 0;
                $p_servicio_2->itinerario_servicios_id = $idservicio;
                $p_servicio_2->save();

                return "cuenta <> 0 id = 0/" . $p_servicio_1->id;

            }

        } else {
            if ($mcuenta == $saldo) {
                $p_servicio_1 = ItinerarioServiciosPagos::FindOrFail($idpago);
                $p_servicio_1->a_cuenta = $saldo;
                $p_servicio_1->medio = $medio;
                $p_servicio_1->cuenta = $cuenta;
                $p_servicio_1->transaccion = $transaccion;
                $p_servicio_1->estado = 1;
                $p_servicio_1->save();

                return "cuenta = 0  id <> 0 /" . $p_servicio_1->id;
            } else {
                $p_servicio_1 = ItinerarioServiciosPagos::FindOrFail($idpago);
                $p_servicio_1->a_cuenta = $saldo;
                $p_servicio_1->medio = $medio;
                $p_servicio_1->cuenta = $cuenta;
                $p_servicio_1->transaccion = $transaccion;
                $p_servicio_1->estado = 1;
                $p_servicio_1->save();

                $p_servicio_2 = new ItinerarioServiciosPagos;
                $p_servicio_2->a_cuenta = $pago;
                $p_servicio_2->fecha_a_pagar = $fvpago;
                $p_servicio_2->estado = 0;
                $p_servicio_2->itinerario_servicios_id = $idservicio;
                $p_servicio_2->save();
                return "cuenta <> 0  id <> 0 " . $idpago . "/" . $p_servicio_1->id;
            }
        }
    }

    public function show($id)
    {
        $cotizacion = Cotizacion::FindOrFail($id);
        $cotizaciones = Cotizacion::where('id', $id)->get();
        $productos = M_Producto::get();
        $proveedores = Proveedor::get();
        $hotel_proveedor = HotelProveedor::get();
        $pqt_coti = PaqueteCotizaciones::where('cotizaciones_id', $id)->where('estado', 2)->get();
        $pqt_id = 0;
        foreach ($pqt_coti as $pqt) {
            $pqt_id = $pqt->id;
        }
        $ItinerarioServiciosAcumPagos = ItinerarioServiciosAcumPago::where('paquete_cotizaciones_id', $pqt_id)->get();
        $ItinerarioHotleesAcumPagos = PrecioHotelReservaPagos::where('paquete_cotizaciones_id', $pqt_id)->get();
        $activado = 'Detalle';
        $itinerario_cotis = ItinerarioCotizaciones::where('paquete_cotizaciones_id', $pqt_id)->get();
//        dd($ItinerarioHotleesAcumPagos);
//        dd($ItinerarioHotleesAcumPagos);
        $webs = Web::get();
        return view('admin.contabilidad.confirmar_precio', ['cotizaciones' => $cotizaciones, 'cotizacion' => $cotizacion, 'productos' => $productos, 'proveedores' => $proveedores, 'hotel_proveedor' => $hotel_proveedor, 'ItinerarioServiciosAcumPagos' => $ItinerarioServiciosAcumPagos, 'ItinerarioHotleesAcumPagos' => $ItinerarioHotleesAcumPagos, 'activado' => $activado, 'itinerario_cotis' => $itinerario_cotis, 'pqt_coti' => $pqt_coti,'webs'=>$webs,'id'=>$id]);
    }

    public function show_back($id)
    {
        $cotizacion = Cotizacion::FindOrFail($id);
        $cotizaciones = Cotizacion::where('id', $id)->get();
        $productos = M_Producto::get();
        $proveedores = Proveedor::get();
        $hotel_proveedor = HotelProveedor::get();
        $pqt_coti = PaqueteCotizaciones::where('cotizaciones_id', $id)->where('estado', 2)->get();

        $pqt_id = 0;
        foreach ($pqt_coti as $pqt) {
            $pqt_id = $pqt->id;
        }
        $ItinerarioServiciosAcumPagos = ItinerarioServiciosAcumPago::where('paquete_cotizaciones_id', $pqt_id)->get();
        $ItinerarioHotleesAcumPagos = PrecioHotelReservaPagos::where('paquete_cotizaciones_id', $pqt_id)->get();
        $activado = 'Resumen';
        $itinerario_cotis = ItinerarioCotizaciones::where('paquete_cotizaciones_id', $pqt_id)->get();
        return view('admin.contabilidad.confirmar_precio', ['cotizaciones' => $cotizaciones, 'cotizacion' => $cotizacion, 'productos' => $productos, 'proveedores' => $proveedores, 'hotel_proveedor' => $hotel_proveedor, 'ItinerarioServiciosAcumPagos' => $ItinerarioServiciosAcumPagos, 'ItinerarioHotleesAcumPagos' => $ItinerarioHotleesAcumPagos, 'activado' => $activado, 'itinerario_cotis' => $itinerario_cotis]);
    }

    public function update_price_conta()
    {
        $id = $_POST['txt_id'];
        $precio = $_POST['txt_precio'];

        $i_servicio = ItinerarioServicios::FindOrFail($id);
        $i_servicio->precio_c = $precio;

        $i_servicio->save();
        return ("ok");
    }

    public function pagar_servicios_conta($idcotizacion, $idservicio)
    {
        $cotizacion = Cotizacion::where('id', $idcotizacion)->get();
        $servicio = ItinerarioServicios::where('id', $idservicio)->get();
//        dd($cotizacion);
//        $productos=M_Producto::get();
//        $proveedores=Proveedor::get();
//        $hotel_proveedor=HotelProveedor::get();

        return view('admin.contabilidad.pagar_servicio', ['cotizacion' => $cotizacion, 'servicio' => $servicio, 'idcotizacion' => $idcotizacion]);
    }

    public function pay_price_conta()
    {
        $id = $_POST['txt_id'];
        $idpago = $_POST['txt_idpago'];
//        $idcot = $_POST['txt_idcot'];
        $medio = $_POST['txt_medio'];
        $transaccion = $_POST['txt_transaccion'];
        $fecha = $_POST['txt_fecha'];
        $pago = $_POST['txt_pago'];

        if ($idpago > 0) {
            $p_servicio = ItinerarioServiciosPagos::FindOrFail($idpago);
            $p_servicio->a_cuenta = $pago;
            $p_servicio->fecha_a_pagar = $fecha;
            $p_servicio->medio = $medio;
            $p_servicio->transaccion = $transaccion;
            $p_servicio->estado = 1;
            $p_servicio->itinerario_servicios_id = $id;

            $p_servicio->save();
            return "ok update";
        } else {
            $p_servicio = new ItinerarioServiciosPagos;
            $p_servicio->a_cuenta = $pago;
            $p_servicio->fecha_a_pagar = $fecha;
            $p_servicio->medio = $medio;
            $p_servicio->transaccion = $transaccion;
            $p_servicio->estado = 1;
            $p_servicio->itinerario_servicios_id = $id;

            $p_servicio->save();
            return "ok save";
        }

//        return redirect()->route('pagar_servicios_conta_path', [$idcot, $id]);

    }

    public function pay_a_cuenta()
    {
        $id = $_POST['txt_id'];
//        $idcot = $_POST['txt_idcot'];
        $fecha = $_POST['txt_fecha'];
        $pago = $_POST['txt_pago'];

        $p_servicio = new ItinerarioServiciosPagos;
        $p_servicio->a_cuenta = $pago;
        $p_servicio->fecha_a_pagar = $fecha;
        $p_servicio->estado = 0;
        $p_servicio->itinerario_servicios_id = $id;

        $p_servicio->save();

//        return redirect()->route('pagar_servicios_conta_path', [$idcot, $id]);
        return "ok";

    }

    public function consulta_save()
    {
        $cod = $_POST['txt_codigos'];

        $consulta = new ConsultaPago();
        $consulta->codigos = $cod;
        $consulta->save();

        return 'ok';
    }









//    public function confirmar_servicios_conta($id, $sd)
//    {
//        $cotizacion=Cotizacion::where('id', $id)->get();
////        dd($cotizacion);
//        $productos=M_Producto::get();
//        $proveedores=Proveedor::get();
//        $hotel_proveedor=HotelProveedor::get();
//
//        return view('admin.contabilidad.pagar_servicio',['cotizacion'=>$cotizacion,'productos'=>$productos,'proveedores'=>$proveedores,'hotel_proveedor'=>$hotel_proveedor]);
//    }

    public function confirmar(Request $request)
    {
        $id = $request->input('id');
        $precio = $request->input('precio');
        $fecha = $request->input('fecha');
        $servicio = ItinerarioServicios::FindOrFail($id);
        $servicio->precio_c = $precio;
        $servicio->fecha_venc = $fecha;
        if ($servicio->save()) {
            $pagos = new ItinerarioServiciosPagos();
            $pagos->a_cuenta = $precio;
            $pagos->fecha_a_pagar = $fecha;
            $pagos->estado = 0;
            $pagos->itinerario_servicios_id = $id;
            if ($pagos->save())
                return '1_' . $pagos->id;
            else
                return 0;
        } else
            return 0;
    }

    public function pagar(Request $request)
    {
        $id = $request->input('itineraio_servicios_id');
        $pago_id = $request->input('servicio_pago');
        $total = $request->input('total');
        $a_cuenta = $request->input('a_cuenta');

        $pagos = ItinerarioServiciosPagos::FindOrFail($pago_id);
        $pagos->a_cuenta = $a_cuenta;
        $pagos->fecha_a_pagar = date("Y-m-d");
        $pagos->estado = 1;
        $pagos->itinerario_servicios_id = $id;

        if ($pagos->save()) {
            if ($a_cuenta < $total) {
                $pagos2 = new ItinerarioServiciosPagos();
                $pagos2->a_cuenta = $request->input('saldo');
                $pagos2->fecha_a_pagar = $request->input('prox_fecha');
                $pagos2->estado = 0;
                $pagos2->itinerario_servicios_id = $id;
                if ($pagos2->save())
                    return 1;
                else
                    return 0;
            } else
                return 1;
        } else
            return 0;
    }

    public function listar($desde, $hasta)
    {
        $cotizaciones = Cotizacion::with(['paquete_cotizaciones.itinerario_cotizaciones.itinerario_servicios.pagos' => function ($query) use ($desde, $hasta) {
            $query->whereBetween('fecha_a_pagar', array($desde, $hasta))
                ->where('estado', 0);
        }])->get();
        return view('admin.contabilidad.lista-fecha', ['cotizaciones' => $cotizaciones, 'desde' => $desde, 'hasta' => $hasta]);
    }

    public function listar_post(Request $request)
    {
        $desde = $request->input('desde');
        $hasta = $request->input('hasta');
        $cotizaciones = Cotizacion::with(['paquete_cotizaciones.itinerario_cotizaciones.itinerario_servicios.pagos' => function ($query) use ($desde, $hasta) {
            $query->whereBetween('fecha_a_pagar', array($desde, $hasta))
                ->where('estado', 0);
        }])->get();
        return view('admin.contabilidad.lista-fecha', ['cotizaciones' => $cotizaciones, 'desde' => $desde, 'hasta' => $hasta]);
    }

    public function confirmar_h(Request $request)
    {
        $id = $request->input('id');
        $precio = $request->input('precio');
        $fecha = $request->input('fecha');
        $servicio = PrecioHotelReserva::FindOrFail($id);
        $servicio_r = PrecioHotelReserva::FindOrFail($id);
        $servicio->precio_s_c = $servicio_r->precio_s_r;
        $servicio->precio_d_c = $servicio_r->precio_d_r;
        $servicio->precio_m_c = $servicio_r->precio_m_r;
        $servicio->precio_t_c = $servicio_r->precio_t_r;
        $servicio->fecha_venc = $fecha;

        if ($servicio->save()) {
            $pagos = new PrecioHotelReservaPagos();
            $pagos->a_cuenta = $precio;
            $pagos->fecha_a_pagar = $fecha;
            $pagos->estado = 0;
            $pagos->precio_hotel_reserva_id = $id;
            if ($pagos->save())
                return '1_' . $pagos->id;
            else
                return 0;
        } else
            return 0;
    }

    public function guardar_imagen_pago(Request $request)
    {
//        dd($request->all());
        $id = $request->input('id');
        $imagen = $request->file('foto');
//        dd($request->file('input_file'));
        if ($imagen) {
            $objeto = ItinerarioServiciosPagos::FindOrFail($id);
            $filename = 'pago-servicio-' . $id . '.jpg';
            $objeto->imagen = $filename;
            $objeto->save();
            Storage::disk('imagen_pago_servicio')->put($filename, File::get($imagen));
            return json_encode(1);
        } else {
            return json_encode(0);
        }
    }

    public function getImageName($filename)
    {
        $file = Storage::disk('imagen_pago_servicio')->get($filename);
        return new Response($file, 200);
    }

    public function update_price_conta_hotel()
    {
        $id = $_POST['txt_id'];
        $i_hotel = PrecioHotelReserva::FindOrFail($id);
        if ($i_hotel->personas_s > 0) {
            $precio_s_c = $_POST['txt_precio_s'];
            $i_hotel->precio_s_c = $precio_s_c;
        }
        if ($i_hotel->personas_d > 0) {
            $precio_d_c = $_POST['txt_precio_d'];
            $i_hotel->precio_d_c = $precio_d_c;
        }
        if ($i_hotel->personas_m > 0) {
            $precio_m_c = $_POST['txt_precio_m'];
            $i_hotel->precio_m_c = $precio_m_c;
        }
        if ($i_hotel->personas_t > 0) {
            $precio_t_c = $_POST['txt_precio_t'];
            $i_hotel->precio_t_c = $precio_t_c;
        }
        $i_hotel->save();
        return ("ok");
    }

    public function pagar_servicios_conta_hotel($idcotizacion, $idhotel, $pqt_id, $prov_id)
    {
        $cotizacion = Cotizacion::where('id', $idcotizacion)->get();
        $hotel = PrecioHotelReserva::where('id', $idhotel)->get();
        $proveedores = Proveedor::get();
        $itinerarios = ItinerarioCotizaciones::where('paquete_cotizaciones_id', $pqt_id)->get();
        $noches = 0;
        foreach ($itinerarios as $iti) {
            $noches += count($iti->hotel);
        }
        $pagos = PrecioHotelReservaPagos::where('paquete_cotizaciones_id', $pqt_id)->where('proveedor_id', $prov_id)->get();
        return view('admin.contabilidad.pagar_servicio_hotel', ['cotizacion' => $cotizacion,
            'hotel' => $hotel, 'idcotizacion' => $idcotizacion, 'proveedores' => $proveedores,
            'itinerarios' => $itinerarios, 'pqt_id' => $pqt_id, 'prov_id' => $prov_id, 'noches' => $noches, 'pagos' => $pagos]);
    }

    public function pay_price_hotel_conta()
    {
        $id = $_POST['txt_id'];
        $idpago = $_POST['txt_idpago'];
        $medio = $_POST['txt_medio'];
        $transaccion = $_POST['txt_transaccion'];
        $fecha = $_POST['txt_fecha'];
        $pago = $_POST['txt_pago'];
        $idpqt = $_POST['txt_idpqt'];
        $idpro = $_POST['txt_idpro'];

        if ($idpago > 0) {
            $p_hotel_reserva = PrecioHotelReservaPagos::FindOrFail($idpago);
            $p_hotel_reserva->a_cuenta = $pago;
            $p_hotel_reserva->fecha_a_pagar = $fecha;
            $p_hotel_reserva->medio = $medio;
            $p_hotel_reserva->transaccion = $transaccion;
            $p_hotel_reserva->estado = 1;
            $p_hotel_reserva->paquete_cotizaciones_id = $idpqt;
            $p_hotel_reserva->proveedor_id = $idpro;
            $p_hotel_reserva->save();
            return "ok update";
        } else {
            $p_hotel_reserva = new PrecioHotelReservaPagos;
            $p_hotel_reserva->a_cuenta = $pago;
            $p_hotel_reserva->fecha_a_pagar = $fecha;
            $p_hotel_reserva->medio = $medio;
            $p_hotel_reserva->transaccion = $transaccion;
            $p_hotel_reserva->estado = 1;
            $p_hotel_reserva->paquete_cotizaciones_id = $idpqt;
            $p_hotel_reserva->proveedor_id = $idpro;
            $p_hotel_reserva->save();
            return "ok save";
        }

//        return redirect()->route('pagar_servicios_conta_path', [$idcot, $id]);

    }

    public function pay_a_cuenta_hotel()
    {
        $id = $_POST['txt_id'];
//        $idcot = $_POST['txt_idcot'];
        $fecha = $_POST['txt_fecha'];
        $pago = $_POST['txt_pago'];
        $idpqt = $_POST['txt_idpqt'];
        $idpro = $_POST['txt_idpro'];

        $p_hotel_reserva = new PrecioHotelReservaPagos();
        $p_hotel_reserva->a_cuenta = $pago;
        $p_hotel_reserva->fecha_a_pagar = $fecha;
        $p_hotel_reserva->estado = 0;
        $p_hotel_reserva->paquete_cotizaciones_id = $idpqt;
        $p_hotel_reserva->proveedor_id = $idpro;
        $p_hotel_reserva->save();
        return "ok";
    }

    public function rango_fecha_hotel()
    {
        $consulta = ConsultaPagoHotel::all();
        return view('admin.contabilidad.rango-fecha-hotel', ['consulta' => $consulta]);
    }

    public function list_fechas_rango_hotel()
    {
        $ini = $_POST['txt_ini'];
        $fin = $_POST['txt_fin'];
        return redirect()->route('list_fechas_hotel_path', [$ini, $fin]);
    }

    public function list_fechas_hotel($fecha_i, $fecha_f)
    {
        $ini = $fecha_i;
        $fin = $fecha_f;
        $cotizacion = Cotizacion::get();
//        $pagos = ItinerarioServiciosPagos::get();
        $pagos = PrecioHotelReservaPagos::get();
        $proveedor = ItinerarioServicioProveedor::get();//-- se estara usando ?
//        $servicios = ItinerarioServicios::with('itinerario_servicio_proveedor')->get();
        $hoteles = PrecioHotelReserva::with('proveedor')->get();
        return view('admin.contabilidad.lista-fecha-hotel', compact(['proveedor', 'hoteles', 'pagos', 'cotizacion', 'ini', 'fin']));
    }

    public function list_fechas_hotel_show()
    {
        if (isset($_POST['chk_id'])) {
            $ids = $_POST['chk_id'];
        } else {
            $ids = 0;
        }
        if (isset($_POST['txt_codigos'])) {
            $codigos = $_POST['txt_codigos'];
        } else {
            $codigos = 0;
        }

        $cotizacion = Cotizacion::get();
//        $pagos = ItinerarioServiciosPagos::get();
        $pagos = PrecioHotelReservaPagos::get();
        $proveedor = ItinerarioServicioProveedor::get();
//        $servicios = ItinerarioServicios::with('itinerario_servicio_proveedor')->get();
        $hoteles = PrecioHotelReserva::with('proveedor')->get();
        $consulta = ConsultaPagoHotel::where('id', $codigos)->get();
        return view('admin.contabilidad.lista-fecha-hotel-rango', ['proveedor' => $proveedor, 'hoteles' => $hoteles, 'pagos' => $pagos, 'cotizacion' => $cotizacion, 'ids' => $ids, 'codigos' => $codigos, 'consulta' => $consulta]);
    }

    public function getImageName_hotel($filename)
    {
        $file = Storage::disk('imagen_pago_hotel')->get($filename);
        return new Response($file, 200);
    }

    public function consulta_hotel_save(Request $request)
    {
        $cod = $request->input('codigos');
        $cod1='';
        $tamano=count($cod);
        for($i=0;$i<$tamano;$i++){
            $cod1.=$cod[$i].',';
        }
        $cod1=substr($cod1,0,strlen($cod1)-1);
        $pagar_con = $request->input('pagar_con');
//        dd($pagar_con);
        $pagar_con1='';
        $tamano=count($pagar_con);
        for($i=0;$i<$tamano;$i++){
            $pagar_con1.=$pagar_con[$i].',';
        }
        $pagar_con1=substr($pagar_con1,0,strlen($pagar_con1)-1);
//dd($pagar_con1);
        $medio_pago =$request->input('medio_pago');
        $medio_pago1='';
        $tamano=count($medio_pago);
        for($i=0;$i<$tamano;$i++){
            $medio_pago1.=$medio_pago[$i].',';
        }
        $medio_pago1=substr($medio_pago1,0,strlen($medio_pago1)-1);

        $cta_cliente =$request->input('cta_cliente');
        $cta_cliente1='';
        $tamano=count($cta_cliente);
        for($i=0;$i<$tamano;$i++){
            $cta_cliente1.=$cta_cliente[$i].'+.+';
        }
        $cta_cliente1=substr($cta_cliente1,0,strlen($cta_cliente1)-1);

        $a_pagar = $request->input('a_pagar');
        $a_pagar1='';
        $tamano=count($a_pagar);
        for($i=0;$i<$tamano;$i++){
            $a_pagar1.=$a_pagar[$i].',';
        }
        $a_pagar1=substr($a_pagar1,0,strlen($a_pagar1)-1);

        $consulta = new ConsultaPagoHotel();
        $consulta->codigos = $cod1;
        $consulta->pagar_con= $pagar_con1;
        $consulta->medio_pago = $medio_pago1;
        $consulta->cta_cliente = $cta_cliente1;
        $consulta->a_pagar=$a_pagar1;
        $consulta->save();

        return redirect()->route('pagos_pendientes_rango_fecha_path');
//        return 'ok';
    }

    public function pagar_consulta_hotel()
    {
        $idservicio = $_POST['txt_idservicio'];
        $saldo = $_POST['txt_saldo'];
        $pagado = $_POST['txt_pagado'];
        $fvpago = $_POST['txt_fvpago'];
        $medio = $_POST['txt_medio'];
        $cuenta = $_POST['txt_cuenta'];
        $transaccion = $_POST['txt_transaccion'];
        $mcuenta = $_POST['txt_mcuenta'];
        $idpago = $_POST['txt_idpago'];
        $pago = $mcuenta - $saldo;

        if ($idpago == 0) {

            if ($mcuenta == $saldo) {
                $p_servicio = new PrecioHotelReservaPagos();
                $p_servicio->a_cuenta = $saldo;
                $p_servicio->medio = $medio;
                $p_servicio->cuenta = $cuenta;
                $p_servicio->transaccion = $transaccion;
                $p_servicio->estado = 1;
                $p_servicio->precio_hotel_reserva_id = $idservicio;
                $p_servicio->save();

                return "cuenta = 0 id = 0/" . $p_servicio->id;
            } else {

                $p_servicio_1 = new PrecioHotelReservaPagos;
                $p_servicio_1->a_cuenta = $saldo;
                $p_servicio_1->medio = $medio;
                $p_servicio_1->cuenta = $cuenta;
                $p_servicio_1->transaccion = $transaccion;
                $p_servicio_1->estado = 1;
                $p_servicio_1->precio_hotel_reserva_id = $idservicio;
                $p_servicio_1->save();

                $p_servicio_2 = new PrecioHotelReservaPagos;
                $p_servicio_2->a_cuenta = $pago;
                $p_servicio_2->fecha_a_pagar = $fvpago;
                $p_servicio_2->estado = 0;
                $p_servicio_2->precio_hotel_reserva_id = $idservicio;
                $p_servicio_2->save();

                return "cuenta <> 0 id = 0/" . $p_servicio_1->id;

            }

        } else {
            if ($mcuenta == $saldo) {
                $p_servicio_1 = PrecioHotelReservaPagos::FindOrFail($idpago);
                $p_servicio_1->a_cuenta = $saldo;
                $p_servicio_1->medio = $medio;
                $p_servicio_1->cuenta = $cuenta;
                $p_servicio_1->transaccion = $transaccion;
                $p_servicio_1->estado = 1;
                $p_servicio_1->save();

                return "cuenta = 0  id <> 0 /" . $p_servicio_1->id;
            } else {
                $p_servicio_1 = PrecioHotelReservaPagos::FindOrFail($idpago);
                $p_servicio_1->a_cuenta = $saldo;
                $p_servicio_1->medio = $medio;
                $p_servicio_1->cuenta = $cuenta;
                $p_servicio_1->transaccion = $transaccion;
                $p_servicio_1->estado = 1;
                $p_servicio_1->save();

                $p_servicio_2 = new PrecioHotelReservaPagos;
                $p_servicio_2->a_cuenta = $pago;
                $p_servicio_2->fecha_a_pagar = $fvpago;
                $p_servicio_2->estado = 0;
                $p_servicio_2->precio_hotel_reserva_id = $idservicio;
                $p_servicio_2->save();

                return "cuenta <> 0  id <> 0 " . $idpago . "/" . $p_servicio_1->id;

            }
        }

    }

    public function guardar_imagen_pago_hotel(Request $request)
    {
//        dd($request->all());
        $id = $request->input('id');
        $imagen = $request->file('foto');
//        dd($request->file('input_file'));

        if ($imagen) {
            $objeto = PrecioHotelReservaPagos::FindOrFail($id);
            $filename = 'pago-hotel-' . $id . '.jpg';
            $objeto->imagen = $filename;
            $objeto->save();
            Storage::disk('imagen_pago_hotel')->put($filename, File::get($imagen));
            return json_encode(1);
        } else {
            return json_encode(0);
        }
    }

    public function list_fechas_show_hotel()
    {
        $ids = 0;
        if (isset($_POST['chk_id'])) {
            $ids = $_POST['chk_id'];
        }
//        dd($ids);
        $codigos = 0;
        if (isset($_POST['txt_codigos'])) {
            $codigos = $_POST['txt_codigos'];
        }
        $pagos=PrecioHotelReservaPagos::get();
        $consulta = ConsultaPagoHotel::where('id', $codigos)->get();
        $cuentas_goto=CuentasGoto::get();
        $entidad_bancaria=EntidadBancaria::get();

        return view('admin.contabilidad.lista-pagos-hoteles',compact(['ids','codigos','consulta','pagos','cuentas_goto','entidad_bancaria']));
    }

    public function servicios_guardar(Request $request)
    {
        $id = $request->input('id');
//        return $id;
        $valor = $request->input('valor');
        $fecha_a_pagar = $request->input('fecha');

        $isap = ItinerarioServiciosAcumPago::FindOrFail($id);
        $isap->fecha_a_pagar = $fecha_a_pagar;
        $isap->a_cuenta = $valor;
        $isap->estado = -1;
        if ($isap->save())
            return 1;
        else
            return 0;

    }

    public function entrada_pagar(Request $request)
    {
        $id = $request->input('id');
        $isap = ItinerarioServicios::FindOrFail($id);
        $isap->liquidacion = 2;
        if ($isap->save())
            return 1;
        else
            return 0;
    }

    public function pagar_servicios_conta_pagos($idcotizacion, $Iti_Serv_Acum_Pago, $proveedor_id)
    {
        $cotizacion = Cotizacion::where('id', $idcotizacion)->get();
        $pqt_c = PaqueteCotizaciones::where('cotizaciones_id', $idcotizacion)->where('estado', 2)->get();
        $pqt_coti_id = 0;
        foreach ($pqt_c as $pqt_c_) {
            $pqt_coti_id = $pqt_c_->id;
        }
        $total = ItinerarioServiciosAcumPago::where('id', $Iti_Serv_Acum_Pago)->where('estado', -1)->get();
//        dd($total);
        $pagos = ItinerarioServiciosAcumPago::where('paquete_cotizaciones_id', $pqt_coti_id)->where('proveedor_id', $proveedor_id)->whereIn('estado', [0, 1])->get();
//        dd($pagos);
        $proveedor = Proveedor::FindOrFail($proveedor_id);
        $itinerario_cotizaciones = ItinerarioCotizaciones::where('paquete_cotizaciones_id', $pqt_coti_id)->get();
        return view('admin.contabilidad.pagar_servicio-pagos', ['cotizacion' => $cotizacion, 'pagos' => $pagos, 'idcotizacion' => $idcotizacion, 'proveedor' => $proveedor, 'total' => $total, 'itinerario_cotizaciones' => $itinerario_cotizaciones]);
    }

    public function pagar_a_cuenta(Request $request)
    {
        $id = $request->input('id');
        $a_cuenta = $request->input('a_cuenta');
        $estado = $request->input('estado');
        if ($estado == 1) {
            $medio = $request->input('medio');
            $transaccion = $request->input('transaccion');

            $fecha_a_pagar = $request->input('fecha_a_pagar');
            $paquete_cotizaciones_id = $request->input('paquete_cotizaciones_id');
            $proveedor_id = $request->input('proveedor_id');
            $grupo = $request->input('grupo');

            $p_servicio = new ItinerarioServiciosAcumPago();
            $p_servicio->a_cuenta = $a_cuenta;
            $p_servicio->estado = $estado;
            $p_servicio->fecha_a_pagar = $fecha_a_pagar;
            $p_servicio->medio = $medio;
            $p_servicio->transaccion = $transaccion;
            $p_servicio->paquete_cotizaciones_id = $paquete_cotizaciones_id;
            $p_servicio->proveedor_id = $proveedor_id;
            $p_servicio->grupo = $grupo;
            $p_servicio->save();
            return "ok";
        } else if ($estado == 0) {
            $fecha_a_pagar = $request->input('fecha_a_pagar');
            $paquete_cotizaciones_id = $request->input('paquete_cotizaciones_id');
            $proveedor_id = $request->input('proveedor_id');
            $grupo = $request->input('grupo');

            $p_servicio = new ItinerarioServiciosAcumPago();
            $p_servicio->a_cuenta = $a_cuenta;
            $p_servicio->estado = $estado;
            $p_servicio->fecha_a_pagar = $fecha_a_pagar;
            $p_servicio->paquete_cotizaciones_id = $paquete_cotizaciones_id;
            $p_servicio->proveedor_id = $proveedor_id;
            $p_servicio->grupo = $grupo;
            $p_servicio->save();
            return "ok";
        }
    }

    public function pagar_a_cuenta_1(Request $request)
    {
        $id = $request->input('id');
        $a_cuenta = $request->input('a_cuenta');
        $estado = $request->input('estado');
        if ($estado == 1) {
            $medio = $request->input('medio');
            $transaccion = $request->input('transaccion');

            $fecha_a_pagar = $request->input('fecha_a_pagar');
            $paquete_cotizaciones_id = $request->input('paquete_cotizaciones_id');
            $proveedor_id = $request->input('proveedor_id');
            $grupo = $request->input('grupo');

            $p_servicio = ItinerarioServiciosAcumPago::findOrFail($id);
            $p_servicio->a_cuenta = $a_cuenta;
            $p_servicio->estado = $estado;
            $p_servicio->fecha_a_pagar = $fecha_a_pagar;
            $p_servicio->medio = $medio;
            $p_servicio->transaccion = $transaccion;
            $p_servicio->paquete_cotizaciones_id = $paquete_cotizaciones_id;
            $p_servicio->proveedor_id = $proveedor_id;
            $p_servicio->grupo = $grupo;
            $p_servicio->save();
            return "ok";
        } else if ($estado == 0) {
            $fecha_a_pagar = $request->input('fecha_a_pagar');
            $paquete_cotizaciones_id = $request->input('paquete_cotizaciones_id');
            $proveedor_id = $request->input('proveedor_id');
            $grupo = $request->input('grupo');

            $p_servicio = new ItinerarioServiciosAcumPago();
            $p_servicio->a_cuenta = $a_cuenta;
            $p_servicio->estado = $estado;
            $p_servicio->fecha_a_pagar = $fecha_a_pagar;
            $p_servicio->paquete_cotizaciones_id = $paquete_cotizaciones_id;
            $p_servicio->proveedor_id = $proveedor_id;
            $p_servicio->grupo = $grupo;
            $p_servicio->save();
            return "ok";
        }
    }

    public function hotels_guardar(Request $request)
    {
        $id = $request->input('id');
//        return $id;
        $valor = $request->input('valor');
        $fecha_a_pagar = $request->input('fecha');

        $isap = PrecioHotelReservaPagos::FindOrFail($id);
        $isap->fecha_a_pagar = $fecha_a_pagar;
        $isap->a_cuenta = $valor;
        $isap->estado = -1;
        if ($isap->save())
            return 1;
        else
            return 0;

    }

    public function pagar_hotels_conta_pagos($idcotizacion, $Iti_Serv_Acum_Pago, $proveedor_id)
    {
        $cotizacion = Cotizacion::where('id', $idcotizacion)->get();
        $pqt_c = PaqueteCotizaciones::where('cotizaciones_id', $idcotizacion)->where('estado', 2)->get();
        $pqt_coti_id = 0;
        foreach ($pqt_c as $pqt_c_) {
            $pqt_coti_id = $pqt_c_->id;
        }
        $total = PrecioHotelReservaPagos::where('id', $Iti_Serv_Acum_Pago)->where('estado', -1)->get();
//        dd($total);
        $pagos = PrecioHotelReservaPagos::where('paquete_cotizaciones_id', $pqt_coti_id)->where('proveedor_id', $proveedor_id)->whereIn('estado', [0, 1])->get();
//        dd($pagos);
        $proveedor = Proveedor::FindOrFail($proveedor_id);
        $itinerario_cotizaciones = ItinerarioCotizaciones::where('paquete_cotizaciones_id', $pqt_coti_id)->get();
        return view('admin.contabilidad.pagar_hotels-pagos', ['cotizacion' => $cotizacion, 'pagos' => $pagos, 'idcotizacion' => $idcotizacion, 'proveedor' => $proveedor, 'total' => $total, 'itinerario_cotizaciones' => $itinerario_cotizaciones]);
    }

    public function pagar_a_cuenta_hotel(Request $request)
    {
        $id = $request->input('id');
        $a_cuenta = $request->input('a_cuenta');
        $estado = $request->input('estado');
        if ($estado == 1) {
            $medio = $request->input('medio');
            $transaccion = $request->input('transaccion');

            $fecha_a_pagar = $request->input('fecha_a_pagar');
            $paquete_cotizaciones_id = $request->input('paquete_cotizaciones_id');
            $proveedor_id = $request->input('proveedor_id');
            $grupo = $request->input('grupo');

            $p_servicio = new PrecioHotelReservaPagos();
            $p_servicio->a_cuenta = $a_cuenta;
            $p_servicio->estado = $estado;
            $p_servicio->fecha_a_pagar = $fecha_a_pagar;
            $p_servicio->medio = $medio;
            $p_servicio->transaccion = $transaccion;
            $p_servicio->paquete_cotizaciones_id = $paquete_cotizaciones_id;
            $p_servicio->proveedor_id = $proveedor_id;
            $p_servicio->grupo = $grupo;
            $p_servicio->save();
            return "ok";
        } else if ($estado == 0) {
            $fecha_a_pagar = $request->input('fecha_a_pagar');
            $paquete_cotizaciones_id = $request->input('paquete_cotizaciones_id');
            $proveedor_id = $request->input('proveedor_id');
            $grupo = $request->input('grupo');

            $p_servicio = new PrecioHotelReservaPagos();
            $p_servicio->a_cuenta = $a_cuenta;
            $p_servicio->estado = $estado;
            $p_servicio->fecha_a_pagar = $fecha_a_pagar;
            $p_servicio->paquete_cotizaciones_id = $paquete_cotizaciones_id;
            $p_servicio->proveedor_id = $proveedor_id;
            $p_servicio->grupo = $grupo;
            $p_servicio->save();
            return "ok";
        }
    }

    public function pagar_a_cuenta_hotel_1(Request $request)
    {
        $id = $request->input('id');
        $a_cuenta = $request->input('a_cuenta');
        $estado = $request->input('estado');
        if ($estado == 1) {
            $medio = $request->input('medio');
            $transaccion = $request->input('transaccion');

            $fecha_a_pagar = $request->input('fecha_a_pagar');
            $paquete_cotizaciones_id = $request->input('paquete_cotizaciones_id');
            $proveedor_id = $request->input('proveedor_id');
            $grupo = $request->input('grupo');

            $p_servicio = PrecioHotelReservaPagos::findOrFail($id);
            $p_servicio->a_cuenta = $a_cuenta;
            $p_servicio->estado = $estado;
            $p_servicio->fecha_a_pagar = $fecha_a_pagar;
            $p_servicio->medio = $medio;
            $p_servicio->transaccion = $transaccion;
            $p_servicio->paquete_cotizaciones_id = $paquete_cotizaciones_id;
            $p_servicio->proveedor_id = $proveedor_id;
            $p_servicio->grupo = $grupo;
            $p_servicio->save();
            return "ok";
        } else if ($estado == 0) {
            $fecha_a_pagar = $request->input('fecha_a_pagar');
            $paquete_cotizaciones_id = $request->input('paquete_cotizaciones_id');
            $proveedor_id = $request->input('proveedor_id');
            $grupo = $request->input('grupo');

            $p_servicio = new PrecioHotelReservaPagos();
            $p_servicio->a_cuenta = $a_cuenta;
            $p_servicio->estado = $estado;
            $p_servicio->fecha_a_pagar = $fecha_a_pagar;
            $p_servicio->paquete_cotizaciones_id = $paquete_cotizaciones_id;
            $p_servicio->proveedor_id = $proveedor_id;
            $p_servicio->grupo = $grupo;
            $p_servicio->save();
            return "ok";
        }
    }

    function liquidaciones()
    {
        $cotizaciones = Cotizacion::where('liquidacion', 1)->get();
        $servicios = M_Servicio::where('grupo', 'ENTRANCES')->get();
        $servicios_movi = M_Servicio::where('grupo', 'MOVILID')->where('clase', 'BOLETO')->get();
        $liquidaciones = Liquidacion::where('estado', 1)->get();
        $users = User::get();
        return view('admin.contabilidad.liquidaciones', ['cotizaciones' => $cotizaciones, 'servicios' => $servicios, 'servicios_movi' => $servicios_movi, 'liquidaciones' => $liquidaciones, 'users' => $users]);
    }

    function ver_liquidaciones($id, $nro_cheque_s, $nro_cheque_c, $fecha_ini, $fecha_fin, $tipo_cheque)
    {
        $liquidaciones = Cotizacion::get();
        $servicios = M_Servicio::where('grupo', 'ENTRANCES')->get();
        $servicios_movi = M_Servicio::where('grupo', 'MOVILID')->where('clase', 'BOLETO')->get();
        return view('admin.contabilidad.ver-liquidacion', ['liquidaciones' => $liquidaciones, 'fecha_ini' => $fecha_ini, 'fecha_fin' => $fecha_fin, 'servicios' => $servicios, 'servicios_movi' => $servicios_movi, 'id' => $id, 'nro_cheque_s' => $nro_cheque_s, 'nro_cheque_c' => $nro_cheque_c, 'tipo_cheque' => $tipo_cheque]);
    }

    function cerrar_balance(Request $request)
    {
        $id = $request->input('id');
        $explicacion = $request->input('explicacion');
        $valor = $request->input('valor');

        $itinerario_serv_acum = ItinerarioServiciosAcumPago::FindOrFail($id);
        $itinerario_serv_acum->explicacion = $explicacion;
        $itinerario_serv_acum->balance = $valor;

        if ($itinerario_serv_acum->save())
            return 1;
        else
            return 0;

    }

    function cerrar_balance_hotel(Request $request)
    {
        $id = $request->input('id');
        $explicacion = $request->input('explicacion');
        $valor = $request->input('valor');

        $itinerario_serv_acum = PrecioHotelReservaPagos::FindOrFail($id);
        $itinerario_serv_acum->explicacion = $explicacion;
        $itinerario_serv_acum->balance = $valor;

        if ($itinerario_serv_acum->save())
            return 1;
        else
            return 0;
    }

    public function servicios_guardar_ticket(Request $request)
    {
        $id = $request->input('id');
        $valor = $request->input('valor');
        $fecha_a_pagar = $request->input('fecha');

        $isap = ItinerarioServicios::FindOrFail($id);
        $isap->fecha_venc = $fecha_a_pagar;
        $isap->precio_c = $valor;
        $isap->liquidacion = 3;
        if ($isap->save())
            return 1;
        else
            return 0;

    }

    public function precio_c_add(Request $request)
    {
        $id = $request->input('id');
        $valor = $request->input('precio_c');
        $itis = ItinerarioServicios::FindOrFail($id);
        $itis->precio_c = $valor;
        if ($itis->save())
            return 1;
        else
            return 0;

    }
    public function precio_c_hotel_add(Request $request)
    {
//        $n_u=$request->input('n_u');
        $tipo=$request->input('tipo');
        $id=$request->input('id');
        $valor=$request->input('precio_c');
//        $paquete_cotizaciones_id=$request->input('paquete_cotizaciones_id');
        $hotel=PrecioHotelReserva::FindOrFail($id);
        if($tipo=='s')
            $hotel->precio_s_c=$valor;
        elseif($tipo=='d')
            $hotel->precio_d_c=$valor;
        elseif($tipo=='m')
            $hotel->precio_m_c=$valor;
        elseif($tipo=='t')
            $hotel->precio_t_c=$valor;

        if($hotel->save())
            return 1;
        else
            return 0;
    }

    public function pagos_pendientes($grupo){
        $cotizacion=Cotizacion::get();
        $ini='';
        $fin='';
        $cotizaciones=Cotizacion::where('liquidacion',1)->get();
        $servicios=M_Servicio::where('grupo','ENTRANCES')->get();
        $servicios_movi=M_Servicio::where('grupo','MOVILID')->where('clase','BOLETO')->get();
        $liquidaciones=Liquidacion::get();
        $users=User::get();
        $consulta=ConsultaPagoHotel::get();
        $consulta_serv=ConsultaPago::get();
        $webs = Web::get();
        return view('admin.contabilidad.pagos-pendientes',compact(['cotizacion','ini','fin','cotizaciones','servicios','servicios_movi','liquidaciones','users','consulta','consulta_serv','grupo','webs']));
//        return view('admin.contabilidad.liquidaciones',['cotizaciones'=>$cotizaciones,'servicios'=>$servicios,'servicios_movi'=>$servicios_movi,'liquidaciones'=>$liquidaciones,'users'=>$users]);
    }
    public function pagos_pendientes_filtro(){
        $cotizacion=Cotizacion::get();
        $ini='';
        $fin='';
        return view('admin.contabilidad.pagos-pendientes',compact(['cotizacion','ini','fin']));
    }
//    public function list_fechas_hotel($fecha_i, $fecha_f)
//    {
//        $ini = $fecha_i;
//        $fin = $fecha_f;
//        $cotizacion=Cotizacion::get();
////        $pagos = ItinerarioServiciosPagos::get();
//        $pagos =PrecioHotelReservaPagos::get();
//        $proveedor = ItinerarioServicioProveedor::get();//-- se estara usando ?
////        $servicios = ItinerarioServicios::with('itinerario_servicio_proveedor')->get();
//        $hoteles =PrecioHotelReserva::with('proveedor')->get();
//        return view('admin.contabilidad.lista-fecha-hotel',compact(['proveedor','hoteles', 'pagos', 'cotizacion', 'ini', 'fin']));
//    }
    public function pagos_pendientes_filtro_datos(Request $request)
    {
        $ini =$request->input('ini');
        $fin =$request->input('fin');
        $cotizacion=Cotizacion::get();
        $pagos =PrecioHotelReservaPagos::get();
        $proveedor = ItinerarioServicioProveedor::get();//-- se estara usando ?
        $proveedores=Proveedor::where('grupo','HOTELS')->get();
        $hoteles =PrecioHotelReserva::with('proveedor')->get();

        return view('admin.contabilidad.lista-fecha-hotel-filtro',compact(['proveedor','hoteles', 'pagos', 'cotizacion', 'ini', 'fin','proveedores']));
    }
    public function pagos_entradas_full(Request $request)
    {
        $ini = $request->input('desde');
        $fin = $request->input('hasta');
        $id = $request->input('id');
        $s = $request->input('s');
        $c = $request->input('c');
        $tipo_pago = $request->input('tipo_pago');
        $liquidaciones = Cotizacion::get();

        foreach ($liquidaciones->where('categorizado',$tipo_pago)->sortBy('fecha') as $liquidacion){
            foreach ($liquidacion->paquete_cotizaciones->where('estado', 2) as $paquete_cotizacion) {
                foreach ($paquete_cotizacion->itinerario_cotizaciones->where('fecha', '>=', $ini)->where('fecha', '<=', $fin)->sortBy('fecha') as $itinerario_cotizacion) {
                    foreach ($itinerario_cotizacion->itinerario_servicios as $itinerario_servicio) {
                        if($itinerario_servicio->precio_proveedor>0 ||$itinerario_servicio->precio_proveedor!=''){
                            $itinerario_servicio_temp = ItinerarioServicios::FindOrFail($itinerario_servicio->id);
                            $itinerario_servicio_temp->liquidacion=2;
                            $itinerario_servicio_temp->save();
                        }
                    }
                }
            }
        }
        return redirect()->route('contabilidad_ver_liquidacion_path',[$id,$s,$c,$ini,$fin,$tipo_pago]);
    }
    public function entrada_revertir(Request $request)
    {
        $id=$request->input('id');
        $isap=ItinerarioServicios::FindOrFail($id);
        $isap->liquidacion=1;
        if($isap->save())
            return 1;
        else
            return 0;
    }
    public function guardar_codigo(Request $request){
        $id=$request->input('id');
        $tipo=$request->input('tipo');
        $nro_cheque=$request->input('nro_cheque');
        $liqu=Liquidacion::FindOrFail($id);
        if($tipo=='s')
            $liqu->nro_cheque_s=$nro_cheque;
        else
            $liqu->nro_cheque_c=$nro_cheque;

        if($liqu->save())
            return 1;
        else
            return 0;
    }
    public function pagos_pendientes_delete(Request $request)
    {
        $id = $request->input('id');
        $liquidacion =Liquidacion::FindOrFail($id);
        if ($liquidacion->delete()) {
            $temp=ItinerarioServicios::where('liquidacion_id',$id)->get();
            foreach ($temp as $temp_){
                $servicio=ItinerarioServicios::Find($temp_->id);
                $servicio->liquidacion=1;
                $servicio->liquidacion_id=0;
                $servicio->save();
            }
            return 1;
        }
        else
            return 0;
    }
    public function precio_fecha_add(Request $request)
    {
        $pqt_id=$request->input('pqt_id');
        $valor=$request->input('fecha');
        $proveedor_id=$request->input('proveedor_id');
        $iti_coti=ItinerarioCotizaciones::where('paquete_cotizaciones_id',$pqt_id)->get();
        foreach ($iti_coti as $iti_coti_){
            foreach ($iti_coti_->itinerario_servicios->where('proveedor_id',$proveedor_id) as $itinerario_servicio){
                $temp=ItinerarioServicios::find($itinerario_servicio->id);
                $temp->fecha_venc=$valor;
                $temp->save();
            }
        }
        return 1;
    }
    public function actualizar_daybyday( Request $request){
        $itinerario_id=$request->input('itinerario_id');
        $iti_nuevo_id=$request->input('iti_nuevo_id');

        $nuevo=M_Itinerario::Find($iti_nuevo_id);
        $antiguo=P_Itinerario::Find($itinerario_id);
        $antiguo->titulo=$nuevo->titulo;
        if($antiguo->save())
            return '1_'.$nuevo->titulo;
        else
            return '0_';
    }
    public function precio_fecha_hotel_add(Request $request)
    {
        $pqt_id=$request->input('pqt_id');
        $valor=$request->input('fecha');
        $proveedor_id=$request->input('proveedor_id');
        $iti_coti=ItinerarioCotizaciones::where('paquete_cotizaciones_id',$pqt_id)->get();
        foreach ($iti_coti as $iti_coti_){
            foreach ($iti_coti_->hotel->where('proveedor_id',$proveedor_id) as $hotel){
                $temp=PrecioHotelReserva::find($hotel->id);
                $temp->fecha_venc=$valor;
                $temp->save();
            }
        }
        return 1;
    }
    public function pagar_a_cuenta_c()
    {
        $tipo_pago = $_POST['tipo'];
        if($tipo_pago=='pago_total') {
            $pqt_id = $_POST['pqt_id'];
            $prov_id = $_POST['prov_id'];
            $acuenta = $_POST['acuenta'];
            $fecha_serv=$_POST['fecha_serv'];
            $medio=$_POST['medio'];
            $cuenta=$_POST['cuenta'];
            $transaccion=$_POST['transaccion'];

            $p_hotel_reserva = new PrecioHotelReservaPagos();
            $p_hotel_reserva->a_cuenta = $acuenta;
            $p_hotel_reserva->fecha_servicio = $fecha_serv;
            $p_hotel_reserva->medio = $medio;
            $p_hotel_reserva->cuenta = $cuenta;
            $p_hotel_reserva->transaccion = $transaccion;
            $p_hotel_reserva->estado = 1;
            $p_hotel_reserva->paquete_cotizaciones_id = $pqt_id;
            $p_hotel_reserva->proveedor_id = $prov_id;
            $p_hotel_reserva->grupo = 'HOTELS';
            $p_hotel_reserva->save();
            return $p_hotel_reserva->id;
        }
        else if($tipo_pago=='pago_con_saldo') {
            $pqt_id = $_POST['pqt_id'];
            $prov_id = $_POST['prov_id'];
            $total= $_POST['total'];
            $acuenta = $_POST['acuenta'];
            $fecha_serv=$_POST['fecha_serv'];
            $prox_fecha=$_POST['prox_fecha'];
            $medio=$_POST['medio'];
            $cuenta=$_POST['cuenta'];
            $transaccion=$_POST['transaccion'];

            $p_hotel_reserva = new PrecioHotelReservaPagos();
            $p_hotel_reserva->a_cuenta = $acuenta;
            $p_hotel_reserva->fecha_servicio = $fecha_serv;
            $p_hotel_reserva->medio = $medio;
            $p_hotel_reserva->cuenta = $cuenta;
            $p_hotel_reserva->transaccion = $transaccion;
            $p_hotel_reserva->estado = 1;
            $p_hotel_reserva->paquete_cotizaciones_id = $pqt_id;
            $p_hotel_reserva->proveedor_id = $prov_id;
            $p_hotel_reserva->grupo = 'HOTELS';
            $p_hotel_reserva->save();

            // guardamos el saldo
            $p_hotel_reserva_saldo = new PrecioHotelReservaPagos();
            $p_hotel_reserva_saldo->a_cuenta = $total-$acuenta;
            $p_hotel_reserva_saldo->fecha_servicio = $fecha_serv;
            $p_hotel_reserva_saldo->fecha_a_pagar= $prox_fecha;
            $p_hotel_reserva_saldo->estado = 0;
            $p_hotel_reserva_saldo->paquete_cotizaciones_id = $pqt_id;
            $p_hotel_reserva_saldo->proveedor_id = $prov_id;
            $p_hotel_reserva_saldo->grupo = 'HOTELS';
            $p_hotel_reserva_saldo->save();
            return $p_hotel_reserva->id.'_'.$p_hotel_reserva_saldo->id;
        }
    }
    public function pagar_a_cuenta_c_editar()
    {
        $pagos_hotel_id = $_POST['pagos_hotel_id'];
        $pagos_hotel_id=explode('_',$pagos_hotel_id);
        foreach ($pagos_hotel_id as $pagos_hotel_id_){
            $temp=PrecioHotelReservaPagos::find($pagos_hotel_id_);
            $temp->delete();
        }

        $tipo_pago = $_POST['tipo'];
        if($tipo_pago=='pago_total') {
            $pqt_id = $_POST['pqt_id'];
            $prov_id = $_POST['prov_id'];
            $acuenta = $_POST['acuenta'];
            $fecha_serv=$_POST['fecha_serv'];
            $medio=$_POST['medio'];
            $cuenta=$_POST['cuenta'];
            $transaccion=$_POST['transaccion'];

            $p_hotel_reserva = new PrecioHotelReservaPagos();
            $p_hotel_reserva->a_cuenta = $acuenta;
            $p_hotel_reserva->fecha_servicio = $fecha_serv;
            $p_hotel_reserva->medio = $medio;
            $p_hotel_reserva->cuenta = $cuenta;
            $p_hotel_reserva->transaccion = $transaccion;
            $p_hotel_reserva->estado = 1;
            $p_hotel_reserva->paquete_cotizaciones_id = $pqt_id;
            $p_hotel_reserva->proveedor_id = $prov_id;
            $p_hotel_reserva->grupo = 'HOTELS';
            $p_hotel_reserva->save();
            return $p_hotel_reserva->id;
        }
        else if($tipo_pago=='pago_con_saldo') {
            $pqt_id = $_POST['pqt_id'];
            $prov_id = $_POST['prov_id'];
            $total= $_POST['total'];
            $acuenta = $_POST['acuenta'];
            $fecha_serv=$_POST['fecha_serv'];
            $prox_fecha=$_POST['prox_fecha'];
            $medio=$_POST['medio'];
            $cuenta=$_POST['cuenta'];
            $transaccion=$_POST['transaccion'];

            $p_hotel_reserva = new PrecioHotelReservaPagos();
            $p_hotel_reserva->a_cuenta = $acuenta;
            $p_hotel_reserva->fecha_servicio = $fecha_serv;
            $p_hotel_reserva->medio = $medio;
            $p_hotel_reserva->cuenta = $cuenta;
            $p_hotel_reserva->transaccion = $transaccion;
            $p_hotel_reserva->estado = 1;
            $p_hotel_reserva->paquete_cotizaciones_id = $pqt_id;
            $p_hotel_reserva->proveedor_id = $prov_id;
            $p_hotel_reserva->grupo = 'HOTELS';
            $p_hotel_reserva->save();

            // guardamos el saldo
            $p_hotel_reserva_saldo = new PrecioHotelReservaPagos();
            $p_hotel_reserva_saldo->a_cuenta = $total-$acuenta;
            $p_hotel_reserva_saldo->fecha_servicio = $fecha_serv;
            $p_hotel_reserva_saldo->fecha_a_pagar= $prox_fecha;
            $p_hotel_reserva_saldo->estado = 0;
            $p_hotel_reserva_saldo->paquete_cotizaciones_id = $pqt_id;
            $p_hotel_reserva_saldo->proveedor_id = $prov_id;
            $p_hotel_reserva_saldo->grupo = 'HOTELS';
            $p_hotel_reserva_saldo->save();
            return $p_hotel_reserva->id.'_'.$p_hotel_reserva_saldo->id;
        }
    }
    public function pagos_pendientes_filtro_datos_servicios(Request $request)
    {
        $ini =$request->input('ini');
        $fin =$request->input('fin');
        $grupo=$request->input('grupo');
        $cotizacion=Cotizacion::get();
        $pagos =ItinerarioServiciosAcumPago::where('grupo',$grupo)->where('estado','1')->get();
        $proveedores=Proveedor::where('grupo',$grupo)->get();
        return view('admin.contabilidad.lista-fecha-servicios-filtro',compact(['pagos', 'cotizacion', 'ini', 'fin','proveedores','grupo']));
    }
    public function list_fechas_show_servicios()
    {
        $grupo = $_POST['grupo'];
        $ids = 0;
        if (isset($_POST['chk_id'])) {
            $ids = $_POST['chk_id'];
        }
        $codigos = 0;
        if (isset($_POST['txt_codigos'])) {
            $codigos = $_POST['txt_codigos'];
        }
        $pagos=ItinerarioServiciosAcumPago::get();
        $consulta = ConsultaPago::where('id', $codigos)->get();
        $cuentas_goto=CuentasGoto::get();
        $entidad_bancaria=EntidadBancaria::get();
        return view('admin.contabilidad.lista-pagos-servicios',compact(['ids','codigos','consulta','pagos','grupo','cuentas_goto','entidad_bancaria']));

    }
    public function pagar_a_cuenta_c_serv()
    {
        $tipo_pago = $_POST['tipo'];
        if($tipo_pago=='pago_total') {
            $pqt_id = $_POST['pqt_id'];
            $prov_id = $_POST['prov_id'];
            $acuenta = $_POST['acuenta'];
            $fecha_serv=$_POST['fecha_serv'];
            $medio=$_POST['medio'];
            $cuenta=$_POST['cuenta'];
            $transaccion=$_POST['transaccion'];
            $grupo=$_POST['grupo'];
            $p_hotel_reserva = new ItinerarioServiciosAcumPago();
            $p_hotel_reserva->a_cuenta = $acuenta;
            $p_hotel_reserva->fecha_servicio = $fecha_serv;
            $p_hotel_reserva->medio = $medio;
            $p_hotel_reserva->cuenta = $cuenta;
            $p_hotel_reserva->transaccion = $transaccion;
            $p_hotel_reserva->estado = 1;
            $p_hotel_reserva->paquete_cotizaciones_id = $pqt_id;
            $p_hotel_reserva->proveedor_id = $prov_id;
            $p_hotel_reserva->grupo = $grupo;
            $p_hotel_reserva->save();
            return $p_hotel_reserva->id;
        }
        else if($tipo_pago=='pago_con_saldo') {
            $pqt_id = $_POST['pqt_id'];
            $prov_id = $_POST['prov_id'];
            $total= $_POST['total'];
            $acuenta = $_POST['acuenta'];
            $fecha_serv=$_POST['fecha_serv'];
            $prox_fecha=$_POST['prox_fecha'];
            $medio=$_POST['medio'];
            $cuenta=$_POST['cuenta'];
            $transaccion=$_POST['transaccion'];
            $grupo=$_POST['grupo'];
            $p_hotel_reserva = new ItinerarioServiciosAcumPago();
            $p_hotel_reserva->a_cuenta = $acuenta;
            $p_hotel_reserva->fecha_servicio = $fecha_serv;
            $p_hotel_reserva->medio = $medio;
            $p_hotel_reserva->cuenta = $cuenta;
            $p_hotel_reserva->transaccion = $transaccion;
            $p_hotel_reserva->estado = 1;
            $p_hotel_reserva->paquete_cotizaciones_id = $pqt_id;
            $p_hotel_reserva->proveedor_id = $prov_id;
            $p_hotel_reserva->grupo = $grupo;
            $p_hotel_reserva->save();

            // guardamos el saldo
            $p_hotel_reserva_saldo = new ItinerarioServiciosAcumPago();
            $p_hotel_reserva_saldo->a_cuenta = $total-$acuenta;
            $p_hotel_reserva_saldo->fecha_servicio = $fecha_serv;
            $p_hotel_reserva_saldo->fecha_a_pagar= $prox_fecha;
            $p_hotel_reserva_saldo->estado = 0;
            $p_hotel_reserva_saldo->paquete_cotizaciones_id = $pqt_id;
            $p_hotel_reserva_saldo->proveedor_id = $prov_id;
            $p_hotel_reserva_saldo->grupo = $grupo;
            $p_hotel_reserva_saldo->save();
            return $p_hotel_reserva->id.'_'.$p_hotel_reserva_saldo->id;
        }
    }
    public function pagar_a_cuenta_c_serv_editar()
    {
        $pagos_hotel_id = $_POST['pagos_hotel_id'];
        $pagos_hotel_id=explode('_',$pagos_hotel_id);
        foreach ($pagos_hotel_id as $pagos_hotel_id_){
            $temp=ItinerarioServiciosAcumPago::find($pagos_hotel_id_);
            $temp->delete();
        }

        $tipo_pago = $_POST['tipo'];
        if($tipo_pago=='pago_total') {
            $pqt_id = $_POST['pqt_id'];
            $prov_id = $_POST['prov_id'];
            $acuenta = $_POST['acuenta'];
            $fecha_serv=$_POST['fecha_serv'];
            $medio=$_POST['medio'];
            $cuenta=$_POST['cuenta'];
            $transaccion=$_POST['transaccion'];
            $grupo=$_POST['grupo'];
            $p_hotel_reserva = new ItinerarioServiciosAcumPago();
            $p_hotel_reserva->a_cuenta = $acuenta;
            $p_hotel_reserva->fecha_servicio = $fecha_serv;
            $p_hotel_reserva->medio = $medio;
            $p_hotel_reserva->cuenta = $cuenta;
            $p_hotel_reserva->transaccion = $transaccion;
            $p_hotel_reserva->estado = 1;
            $p_hotel_reserva->paquete_cotizaciones_id = $pqt_id;
            $p_hotel_reserva->proveedor_id = $prov_id;
            $p_hotel_reserva->grupo = $grupo;
            $p_hotel_reserva->save();
            return $p_hotel_reserva->id;
        }
        else if($tipo_pago=='pago_con_saldo') {
            $pqt_id = $_POST['pqt_id'];
            $prov_id = $_POST['prov_id'];
            $total= $_POST['total'];
            $acuenta = $_POST['acuenta'];
            $fecha_serv=$_POST['fecha_serv'];
            $prox_fecha=$_POST['prox_fecha'];
            $medio=$_POST['medio'];
            $cuenta=$_POST['cuenta'];
            $transaccion=$_POST['transaccion'];
            $grupo=$_POST['grupo'];
            $p_hotel_reserva = new ItinerarioServiciosAcumPago();
            $p_hotel_reserva->a_cuenta = $acuenta;
            $p_hotel_reserva->fecha_servicio = $fecha_serv;
            $p_hotel_reserva->medio = $medio;
            $p_hotel_reserva->cuenta = $cuenta;
            $p_hotel_reserva->transaccion = $transaccion;
            $p_hotel_reserva->estado = 1;
            $p_hotel_reserva->paquete_cotizaciones_id = $pqt_id;
            $p_hotel_reserva->proveedor_id = $prov_id;
            $p_hotel_reserva->grupo = $grupo;
            $p_hotel_reserva->save();

            // guardamos el saldo
            $p_hotel_reserva_saldo = new ItinerarioServiciosAcumPago();
            $p_hotel_reserva_saldo->a_cuenta = $total-$acuenta;
            $p_hotel_reserva_saldo->fecha_servicio = $fecha_serv;
            $p_hotel_reserva_saldo->fecha_a_pagar= $prox_fecha;
            $p_hotel_reserva_saldo->estado = 0;
            $p_hotel_reserva_saldo->paquete_cotizaciones_id = $pqt_id;
            $p_hotel_reserva_saldo->proveedor_id = $prov_id;
            $p_hotel_reserva_saldo->grupo = $grupo;
            $p_hotel_reserva_saldo->save();
            return $p_hotel_reserva->id.'_'.$p_hotel_reserva_saldo->id;
        }
    }
    public function guardar_imagen_pago_serv(Request $request)
    {
        $id =explode('_',$request->input('id'));
        $imagen = $request->file('foto');
        if ($imagen) {
            $objeto =ItinerarioServiciosAcumPago::FindOrFail($id[0]);
            $filename = 'pago-serv-' . $id[0] . '.jpg';
            $objeto->imagen = $filename;
            $objeto->save();
            Storage::disk('imagen_pago_servicio')->put($filename, File::get($imagen));
            return json_encode(1);
        } else {
            return json_encode(0);
        }
    }
    public function consulta_serv_save(Request $request)
    {
        $grupo = $request->input('grupo');
        $cod = $request->input('codigos');
        $cod1='';
        $tamano=count($cod);
        for($i=0;$i<$tamano;$i++){
            $cod1.=$cod[$i].',';
        }
        $cod1=substr($cod1,0,strlen($cod1)-1);
        $pagar_con = $request->input('pagar_con');
        $pagar_con1='';
        $tamano=count($pagar_con);
        for($i=0;$i<$tamano;$i++){
            $pagar_con1.=$pagar_con[$i].',';
        }
        $pagar_con1=substr($pagar_con1,0,strlen($pagar_con1)-1);
        $medio_pago =$request->input('medio_pago');
        $medio_pago1='';
        $tamano=count($medio_pago);
        for($i=0;$i<$tamano;$i++){
            $medio_pago1.=$medio_pago[$i].',';
        }
        $medio_pago1=substr($medio_pago1,0,strlen($medio_pago1)-1);

        $cta_cliente =$request->input('cta_cliente');
        $cta_cliente1='';
        $tamano=count($cta_cliente);
        for($i=0;$i<$tamano;$i++){
            $cta_cliente1.=$cta_cliente[$i].'+.+';
        }
        $cta_cliente1=substr($cta_cliente1,0,strlen($cta_cliente1)-1);

        $a_pagar = $request->input('a_pagar');
        $a_pagar1='';
        $tamano=count($a_pagar);
        for($i=0;$i<$tamano;$i++){
            $a_pagar1.=$a_pagar[$i].',';
        }
        $a_pagar1=substr($a_pagar1,0,strlen($a_pagar1)-1);

        $consulta = new ConsultaPago();
        $consulta->codigos = $cod1;
        $consulta->pagar_con= $pagar_con1;
        $consulta->medio_pago = $medio_pago1;
        $consulta->cta_cliente = $cta_cliente1;
        $consulta->a_pagar=$a_pagar1;
        $consulta->grupo=$grupo;
        $consulta->save();

        return redirect()->route('pagos_pendientes_rango_fecha_path',$grupo);
    }
    public function list_fechas_serv_show()
    {
        $grupo = $_POST['grupo'];
        $ids = 0;
        if (isset($_POST['chk_id'])) {
            $ids = $_POST['chk_id'];
        }
        $codigos = 0;
        if (isset($_POST['txt_codigos'])) {
            $codigos = $_POST['txt_codigos'];
        }
        $servicios = ItinerarioServicios::with('itinerario_servicio_proveedor')->get();
        $consulta = ConsultaPago::where('id', $codigos)->get();
        $pagos=ItinerarioServiciosAcumPago::get();
        return view('admin.contabilidad.lista-pagos-servicios',compact(['ids','codigos','consulta','pagos','grupo']));
    }
    public function pagar_a_banco(Request $request)
    {
        $grupo=$request->input('grupo');
        if($grupo!='HOTELS')
            $grupo='_'.$grupo;
        else
            $grupo='';
        $cta_goto=explode('_',$request->input('cta_goto'));
        $paquete_cotizaciones_id=$request->input('paquete_cotizaciones_id');
        $proveedor_id=$request->input('proveedor_id');
        $proveedor=Proveedor::Find($proveedor_id);
        $msj='';
        if($proveedor->banco_nombre_cta_corriente>0){
            if($cta_goto[1]==$proveedor->banco_nombre_cta_corriente){
                $banco=EntidadBancaria::Find($proveedor->banco_nombre_cta_corriente);
                $msj='<input form="frm_guardar'.$grupo.'" type="text" class="form-control" name="cta_cliente[]" id="cta_'.$paquete_cotizaciones_id.'_'.$proveedor_id.'" value="'.$banco->nombre.', Cta: '.$proveedor->banco_nro_cta_corriente.'">';
//                  $msj='Cta: '.$proveedor->banco_nro_cta_corriente.'<input type="text" class="form-control" name="cta_cliente[]" id="cta_'.$paquete_cotizaciones_id.'_'.$proveedor_id.'_[]" value="'.$proveedor->banco_nro_cta_corriente.'">';
            }
            elseif($proveedor->banco_nombre_cta_cci>0){
                $banco=EntidadBancaria::Find($proveedor->banco_nombre_cta_cci);
                $msj='<input form="frm_guardar'.$grupo.'" type="text" class="form-control" name="cta_cliente[]" id="cta_'.$paquete_cotizaciones_id.'_'.$proveedor_id.'" value="'.$banco->nombre.', CCI: '.$proveedor->banco_nro_cta_cci.'">';
//                $msj='CCI: '.$proveedor->banco_nro_cta_cci.'<input type="text" class="form-control" name="cta_cliente[]" id="cta_'.$paquete_cotizaciones_id.'_'.$proveedor_id.'_[]" value="'.$proveedor->banco_nro_cta_cci.'">';
            }
            else{
                $msj='<span class="text-danger">El proverdor no tiene CCI</span>';
            }
        }
        else{
            $msj='<span class="text-danger">El proverdor no tiene Cta corriente</span>';
        }
        return $msj;
    }
    public function consulta_h_pdf($id)
    {
        $ids = 0;
        if (isset($_POST['chk_id'])) {
            $ids = $_POST['chk_id'];
        }
//        $codigos = 0;
//        if (isset($_POST['txt_codigos'])) {
            $codigos =$id;
//        }
        $servicios = ItinerarioServicios::with('itinerario_servicio_proveedor')->get();
        $consulta = ConsultaPagoHotel::where('id', $codigos)->get();
        $pagos=PrecioHotelReservaPagos::get();
        $cuentas_goto=CuentasGoto::get();
        $entidad_bancaria=EntidadBancaria::get();
//        return view('admin.contabilidad.lista-pagos-hoteles-pdf',compact(['ids','codigos','consulta','pagos','cuentas_goto','entidad_bancaria']));

        $pdf = \PDF::loadView('admin.contabilidad.lista-pagos-hoteles-pdf',compact(['ids','codigos','consulta','pagos','cuentas_goto','entidad_bancaria']))->setPaper('a4','landscape')->setWarnings(true);
        return $pdf->download('Consulta_'.$id.'.pdf');



//        $paquetes = PaqueteCotizaciones::with('paquete_precios')->get()->where('id', $id);
//        foreach ($paquetes as $paquetes2){
//            $paquete = PaqueteCotizaciones::with('paquete_precios')->get()->where('id', $id);
//            $cotizacion = Cotizacion::where('id',$paquetes2->cotizaciones_id)->get();
//            $cotizacion1='';
//            foreach ($cotizacion as $cotizacion_){
//                $cotizacion1=$cotizacion_;
//            }
//            $ee=CotizacionesCliente::with('cliente')->get();
////            dd($ee);
//            $pdf = \PDF::loadView('admin.contabilidad.pdf-consulta', ['paquete'=>$paquete, 'cotizacion'=>$cotizacion])->setPaper('a4')->setWarnings(true);
//            return $pdf->download($cotizacion1->nombre.'.pdf');
//            \File::delete('pdf/proposals_'.$id.'.pdf');
//        }
    }

    public function consulta_s_pdf($id,$grupo)
    {
        $ids = 0;
        if (isset($_POST['chk_id'])) {
            $ids = $_POST['chk_id'];
        }
//        $codigos = 0;
//        if (isset($_POST['txt_codigos'])) {
        $codigos =$id;
//        }
        $servicios = ItinerarioServicios::with('itinerario_servicio_proveedor')->get();
        $consulta = ConsultaPago::where('id', $codigos)->get();
        $pagos=PrecioHotelReservaPagos::get();
        $cuentas_goto=CuentasGoto::get();
        $entidad_bancaria=EntidadBancaria::get();
//        return view('admin.contabilidad.lista-pagos-hoteles-pdf',compact(['ids','codigos','consulta','pagos','cuentas_goto','entidad_bancaria']));

//        $pdf = \PDF::loadView('admin.contabilidad.lista-pagos-hoteles-pdf',compact(['ids','codigos','consulta','pagos','cuentas_goto','entidad_bancaria']))->setPaper('a4','landscape')->setWarnings(true);
        $pdf = \PDF::loadView('admin.contabilidad.lista-pagos-servicios-pdf',compact(['ids','codigos','consulta','pagos','cuentas_goto','entidad_bancaria','grupo']))->setPaper('a4','landscape')->setWarnings(true);
//        return view('admin.contabilidad.lista-pagos-servicios-pdf',compact(['ids','codigos','consulta','pagos','cuentas_goto','entidad_bancaria']));
        return $pdf->download('Consulta_'.$id.'.pdf');



//        $paquetes = PaqueteCotizaciones::with('paquete_precios')->get()->where('id', $id);
//        foreach ($paquetes as $paquetes2){
//            $paquete = PaqueteCotizaciones::with('paquete_precios')->get()->where('id', $id);
//            $cotizacion = Cotizacion::where('id',$paquetes2->cotizaciones_id)->get();
//            $cotizacion1='';
//            foreach ($cotizacion as $cotizacion_){
//                $cotizacion1=$cotizacion_;
//            }
//            $ee=CotizacionesCliente::with('cliente')->get();
////            dd($ee);
//            $pdf = \PDF::loadView('admin.contabilidad.pdf-consulta', ['paquete'=>$paquete, 'cotizacion'=>$cotizacion])->setPaper('a4')->setWarnings(true);
//            return $pdf->download($cotizacion1->nombre.'.pdf');
//            \File::delete('pdf/proposals_'.$id.'.pdf');
//        }
    }
    public function pagos_pendientes_filtro_datos_servicios_entradas(Request $request)
    {
        $opcion=$request->input('opcion');
        $nombre=$request->input('nombre');
        $codigo=$request->input('codigo');
        $ini =$request->input('ini');
        $fin =$request->input('fin');
        $grupo=$request->input('grupo');
        $cotizacion_codigo_o_nombre=null;
        $cotizacion=Cotizacion::get();
        $proveedores=Proveedor::where('grupo', $grupo)->get();

        if($opcion=='POR CODIGO'){
            $cotizacion_codigo_o_nombre=Cotizacion::where('codigo', $codigo)->get();
        }
        elseif($opcion=='POR NOMBRE'){
            $cotizacion_codigo_o_nombre=Cotizacion::where('nombre_pax', $nombre)->get();
            // $cotizacion_codigo_o_nombre=Cotizacion::whereHas('cotizaciones_cliente', function($query)use($nombre){
            //     $query->whereHas('cliente', function($query1)use($nombre){
            //         $query1->where('nombres','like','%'.$nombre.'%');
            //     });
            // })->get();
        }
        // dd($cotizacion_codigo_o_nombre);
        return view('admin.contabilidad.lista-entrada-pendiente',compact(['cotizacion', 'cotizacion_codigo_o_nombre', 'ini', 'fin','proveedores','grupo','opcion','nombre','codigo']));
    }
    public function pagos_pendientes_filtro_datos_servicios_entradas_guardado_pagado($boton,$id)
    {
        $liquidacion=Liquidacion::Find($id);
        $ini=$liquidacion->ini;
        $fin=$liquidacion->fin;
        $cotizacion=null;
        $cotizacion_codigo_o_nombre=null;
        $opcion=$liquidacion->opcion;
        $codigo=$liquidacion->nombre_codigo;
        
        // dd($codigo);
        $prioridad='';
        if($opcion=='TODOS LOS PENDIENTES'){
            $prioridad='NORMAL';
        }
        elseif($opcion=='TODOS LOS URGENTES'){
            $prioridad='URGENTE';
        }

        if($opcion=='POR CODIGO'){
            $cotizacion_codigo_o_nombre=Cotizacion::where('codigo',$codigo)
            ->whereHas('paquete_cotizaciones.itinerario_cotizaciones', function ($query) use($id, $ini, $fin, $boton){
                $query->whereHas('itinerario_servicios',function($query)use($id,$ini,$fin,$boton){
                    if($boton=='pagado')
                        $query->where('liquidacion','2')->where('liquidacion_id',$id);
                    elseif($boton=='guardado')
                        $query->where('liquidacion','1');
                });
            })->get();
        }
        elseif($opcion=='POR NOMBRE'){
            $cotizacion_codigo_o_nombre=Cotizacion::whereHas('cotizaciones_cliente', function ($query) use($codigo){
                $query->where('estado','1')->whereHas('cliente',function($query1)use($codigo){
                    $query1->where('nombres',$codigo);
                });
            })
            ->whereHas('paquete_cotizaciones.itinerario_cotizaciones', function ($query) use($id, $ini, $fin, $boton){
                $query->whereHas('itinerario_servicios',function($query)use($id,$ini,$fin,$boton){
                    if($boton=='pagado')
                        $query->where('liquidacion','2')->where('liquidacion_id',$id);
                    elseif($boton=='guardado')
                        $query->where('liquidacion','1');
                });
            })->get();
        }
        elseif($opcion=='TODOS LOS PENDIENTES'||$opcion=='TODOS LOS URGENTES'){
            $cotizacion=Cotizacion::whereHas('paquete_cotizaciones.itinerario_cotizaciones', function ($query) use($id, $ini, $fin, $boton){
                $query->whereHas('itinerario_servicios',function($query)use($id,$ini,$fin,$boton){
                    if($boton=='pagado')
                        $query->where('liquidacion','2')->where('liquidacion_id',$id);
                    elseif($boton=='guardado')
                        $query->where('liquidacion','1');

                });
            })->get();
        }
        elseif($opcion=='ENTRE DOS FECHAS'||$opcion=='ENTRE DOS FECHAS URGENTES'){
            $cotizacion=Cotizacion::whereHas('paquete_cotizaciones.itinerario_cotizaciones',function ($query) use($id,$ini,$fin,$boton){
                $query->whereBetween('fecha',[$ini,$fin]);
                $query->whereHas('itinerario_servicios',function($query)use($id,$ini,$fin,$boton){
                    if($boton=='pagado')
                        $query->where('liquidacion','2')->where('liquidacion_id',$id);
                    elseif($boton=='guardado')
                        $query->where('liquidacion','1');
                });
            })->get();
        }
    //    return dd($cotizacion);
//        return dd($opcion);
//        $opcion=$request->input('opcion');
//        $ini =$request->input('ini');
//        $fin =$request->input('fin');
//        $grupo=$request->input('grupo');
//        $cotizacion=Cotizacion::get();
        $proveedores=Proveedor::where('grupo','ENTRANCES')->get();
        return view('admin.contabilidad.lista-entrada-pendiente-guardado-pagado',compact(['cotizacion', 'ini', 'fin','proveedores','liquidacion','opcion','id','boton','prioridad','cotizacion_codigo_o_nombre']));
    }
    public function pagos_pendientes_entradas_pagar(Request $request)
    {
        $liquidacion_id = $request->input('id');
        $opcion = $request->input('tipo_filtro');
        $ini = $request->input('ini');
        $fin = $request->input('fin');
        $codigo=$request->input('codigo');
        $nombre=$request->input('nombre');
        $total_entrances = $request->input('total_entrances');
        $nro_operacion = $request->input('nro_operacion');
        $guardar = $request->input('guardar');
        $pagar = $request->input('pagar');
        $itinerario_servicio_id = $request->input('itinerario_servicio_id');
        $data=Carbon::now()->subHour(5);
        $mes='00';
        $nombre_codigo='';
        if($opcion=='POR NOMBRE')
            $nombre_codigo=$nombre;
        else
            $nombre_codigo=$codigo;
        
        if($data->month<10)
            $mes='0'.$data->month;

        if($liquidacion_id==0) {
            if (isset($guardar)) {
                $nuevaliquidacion = new Liquidacion();
                $nuevaliquidacion->ini = $ini;
                $nuevaliquidacion->fin = $fin;
                $nuevaliquidacion->nombre_codigo = $nombre_codigo;
                $nuevaliquidacion->user_id = auth()->guard('admin')->user()->id;
                $nuevaliquidacion->total = $total_entrances;
                $nuevaliquidacion->opcion = $opcion;
                $nuevaliquidacion->nro_operacion = $nro_operacion;
                $nuevaliquidacion->nro_cheque_s = '';
                $nuevaliquidacion->nro_cheque_c = '';
                $nuevaliquidacion->created_at = $data->format('Y-m-d h:i:s');
                $nuevaliquidacion->estado = '1';
                $nuevaliquidacion->save();
                foreach ($itinerario_servicio_id as $id) {
                    $temp = ItinerarioServicios::Find($id);
                    $temp->liquidacion_id = $nuevaliquidacion->id;
                    $temp->save();
                }
            }elseif (isset($pagar)) {
                $liquidacion = new Liquidacion();
                $liquidacion->ini = $ini;
                $liquidacion->fin = $fin;
                $liquidacion->nombre_codigo = $nombre_codigo;
                $liquidacion->user_id = auth()->guard('admin')->user()->id;
                $liquidacion->total = $total_entrances;
                $liquidacion->opcion = $opcion;
                $liquidacion->nro_operacion = $nro_operacion;
                $liquidacion->nro_cheque_s = '';
                $liquidacion->nro_cheque_c = '';
                $liquidacion->updated_at = $data->format('Y-m-d h:i:s');
                $liquidacion->estado = '2';
                $liquidacion->save();
                foreach ($itinerario_servicio_id as $id) {
                    $temp = ItinerarioServicios::Find($id);
                    $temp->liquidacion = '2';
                    $temp->liquidacion_id = $liquidacion->id;
                    $temp->save();
                }
            }
        }
        elseif($liquidacion_id>0){
            if (isset($guardar)) {
                $nuevaliquidacion = Liquidacion::Find($liquidacion_id);
                $nuevaliquidacion->user_id = auth()->guard('admin')->user()->id;
                $nuevaliquidacion->total = $total_entrances;
                $nuevaliquidacion->nro_operacion = $nro_operacion;
                $nuevaliquidacion->nro_cheque_s = '';
                $nuevaliquidacion->nro_cheque_c = '';
                $nuevaliquidacion->nombre_codigo = $nombre_codigo;
                $nuevaliquidacion->save();
                $entradas=ItinerarioServicios::where('liquidacion_id',$liquidacion_id)->get();
                foreach ($entradas as $entradas_){
                    $temp=ItinerarioServicios::Find($entradas_->id);
                    $temp->liquidacion_id=0;
                    $temp->save();
                }
                foreach ($itinerario_servicio_id as $id) {
                    $temp = ItinerarioServicios::Find($id);
                    $temp->liquidacion_id = $liquidacion_id;
                    $temp->save();
                }
            }elseif (isset($pagar)) {
                $liquidacion = Liquidacion::Find($liquidacion_id);
                $liquidacion->user_id = auth()->guard('admin')->user()->id;
                $liquidacion->total = $total_entrances;
                $liquidacion->nro_operacion = $nro_operacion;
                $liquidacion->nro_cheque_s = '';
                $liquidacion->nro_cheque_c = '';
                $liquidacion->nombre_codigo = $nombre_codigo;
                $liquidacion->estado = '2';
                $liquidacion->save();
                $entradas=ItinerarioServicios::where('liquidacion_id',$liquidacion_id)->get();
                foreach ($entradas as $entradas_){
                    $temp=ItinerarioServicios::Find($entradas_->id);
                    $temp->liquidacion=1;
                    $temp->liquidacion_id=0;
                    $temp->save();
                }
                foreach ($itinerario_servicio_id as $id) {
                    $temp = ItinerarioServicios::Find($id);
                    $temp->liquidacion = '2';
                    $temp->liquidacion_id = $liquidacion_id;
                    $temp->save();
                }
            }
        }
        return redirect()->route('pagos_pendientes_rango_fecha_path','ENTRANCES');
    }
    public function consulta_entradas_pdf($liquidacion_id)
    {
        $cotizaciones=Cotizacion::whereHas('paquete_cotizaciones',function($query)use($liquidacion_id){
            $query->whereHas('itinerario_cotizaciones',function($query)use($liquidacion_id){
                $query->whereHas('itinerario_servicios',function($query)use($liquidacion_id){
                    $query->where('liquidacion_id',$liquidacion_id);
                });
            });
        })->get();
        $liquidacion=Liquidacion::Find($liquidacion_id);
        $pdf = \PDF::loadView('admin.contabilidad.reporte-entradas-pdf',compact(['cotizaciones','liquidacion','liquidacion_id']))->setPaper('a4','landscape')->setWarnings(true);
        return $pdf->download('Reporte_entradas_'.$liquidacion_id.'.pdf');
    }
    public function pagos_pendientes_general(){
        // $cotizacion=Cotizacion::get();
        $ini='';
        $fin='';
        $grupo='HOTELS';
        // $cotizaciones=Cotizacion::where('liquidacion',1)->get();
        // $servicios=M_Servicio::where('grupo','ENTRANCES')->get();
        // $servicios_movi=M_Servicio::where('grupo','MOVILID')->where('clase','BOLETO')->get();
        // $liquidaciones=Liquidacion::get();
        // $users=User::get();
        // $consulta=ConsultaPagoHotel::get();
        // $consulta_serv=ConsultaPago::get();
        $webs = Web::get();
        return view('admin.contabilidad.pagos-pendientes-general',compact(['cotizacion','ini','fin','cotizaciones','servicios','servicios_movi','liquidaciones','users','consulta','consulta_serv','grupo','webs']));
//        return view('admin.contabilidad.liquidaciones',['cotizaciones'=>$cotizaciones,'servicios'=>$servicios,'servicios_movi'=>$servicios_movi,'liquidaciones'=>$liquidaciones,'users'=>$users]);
    }
    public function pagos_pendientes_general_filtro_datos(Request $request)
    {
        $opcion=$request->input('opcion');
        
        // dd($opcion);
        $nombre=$request->input('nombre');
        $codigo=$request->input('codigo');
        $ini =$request->input('ini');
        $fin =$request->input('fin');
        $grupo=$request->input('grupo');
        $cotizaciones=[];

        $prioridad='';
        if($opcion=='TODOS LOS PENDIENTES'){
            $prioridad='NORMAL';
        }
        elseif($opcion=='TODOS LOS URGENTES'){
            $prioridad='URGENTE';
        }

        if($opcion=='POR CODIGO'){
            $cotizaciones=Cotizacion::where('codigo',$codigo)->where('estado','2')
            ->whereHas('paquete_cotizaciones.itinerario_cotizaciones.hotel', function ($query) use($ini, $fin){
                        $query->where('proveedor_id','!=','')
                        ->where('requerimientos_id','0');
            })->get();
        }
        elseif($opcion=='POR NOMBRE'){
            $cotizaciones=Cotizacion::where('nombre_pax',$nombre)->where('estado','2')
            ->whereHas('paquete_cotizaciones.itinerario_cotizaciones.hotel', function ($query) use($ini, $fin){
                        $query->where('proveedor_id','!=','')
                        ->where('requerimientos_id','0');
            })->get();
        }
        elseif($opcion=='TODOS LOS URGENTES'||$opcion=='TODOS LOS PENDIENTES'){
            $cotizaciones=Cotizacion::where('estado','2')
            ->whereHas('paquete_cotizaciones.itinerario_cotizaciones.hotel', function ($query) use($ini, $fin,$prioridad){
                        $query->where('proveedor_id','!=','')
                        ->where('requerimientos_id','0')
                        ->where('prioridad',$prioridad);
            })->get();            
        }
        elseif($opcion=='ENTRE DOS FECHAS'){
            $cotizaciones=Cotizacion::where('estado','2')
            ->whereHas('paquete_cotizaciones.itinerario_cotizaciones.hotel', function ($query) use($ini, $fin){
                        $query->where('proveedor_id','!=','')
                        ->whereBetween('fecha_venc', array($ini, $fin))
                        ->where('requerimientos_id','0');
            })->get();
        }
        elseif($opcion=='ENTRE DOS FECHAS URGENTES'){
            $cotizaciones=Cotizacion::where('estado','2')
            ->whereHas('paquete_cotizaciones.itinerario_cotizaciones.hotel', function ($query) use($ini, $fin){
                        $query->where('proveedor_id','!=','')
                        ->whereBetween('fecha_venc', array($ini, $fin))
                        ->where('requerimientos_id','0')
                        ->where('prioridad','URGENTE');
            })->get();
        }

        $array_pagos_pendientes = array();
        foreach ($cotizaciones as $cotizacion){
            foreach ($cotizacion->paquete_cotizaciones as $paquete_cotizaciones){
                foreach ($paquete_cotizaciones->itinerario_cotizaciones as $itinerario_cotizaciones){
                    foreach ($itinerario_cotizaciones->hotel->where('proveedor_id','!=','')/*->whereBetween('fecha_venc', array($ini, $fin))*/->where('requerimientos_id','0') as $hotel){
                        $key=$cotizacion->id.'_'.$hotel->proveedor_id;
                        $monto_r=0;
                        $monto_v=0;
                        $monto_c=0;
                        $text_hotel='';
                        if($hotel->personas_s>0){
                            $monto_r+=$hotel->personas_s*$hotel->precio_s_r;
                            $monto_v+=$hotel->personas_s*$hotel->precio_s;
                            $monto_c+=$hotel->personas_s*$hotel->precio_s_c;
                            $text_hotel.='| <b class="text-primary">'.$hotel->personas_s.'<i class="fas fa-bed"></i></b>';
                        }
                        if($hotel->personas_d>0){
                            $monto_r+=$hotel->personas_d*$hotel->precio_d_r;
                            $monto_v+=$hotel->personas_d*$hotel->precio_d;
                            $monto_c+=$hotel->personas_d*$hotel->precio_d_c;
                            $text_hotel.='| <b class="text-primary">'.$hotel->personas_d.'<i class="fas fa-bed"></i><i class="fas fa-bed"></i></b>';
                        }
                        if($hotel->personas_m>0){
                            $monto_r+=$hotel->personas_m*$hotel->precio_m_r;
                            $monto_v+=$hotel->personas_m*$hotel->precio_m;
                            $monto_c+=$hotel->personas_m*$hotel->precio_m_c;
                            $text_hotel.='| <b class="text-primary">'.$hotel->personas_m.'<i class="fas fa-transgender"></i></b>';
                        }
                        if($hotel->personas_t>0){
                            $monto_r+=$hotel->personas_t*$hotel->precio_t_r;
                            $monto_v+=$hotel->personas_t*$hotel->precio_t;
                            $monto_c+=$hotel->personas_t*$hotel->precio_t_c;
                            $text_hotel.='| <b class="text-primary">'.$hotel->personas_t.'<i class="fas fa-bed"></i><i class="fas fa-bed"></i><i class="fas fa-bed"></i></b>';
                        }
                        if(array_key_exists($key,$array_pagos_pendientes)){
                            // dd($array_pagos_pendientes);
                            $array_pagos_pendientes[$key]['monto_r']+= $monto_r;
                            $array_pagos_pendientes[$key]['monto_v']+= $monto_v;
                            $array_pagos_pendientes[$key]['monto_c']+= $monto_c;
                            $array_pagos_pendientes[$key]['items'].= ','.$itinerario_cotizaciones->id;
                        }else{
                            // $proveedor='';
                            // if($hotel->proveedor_id>0){
                                $proveedor_=Proveedor::where('id',$hotel->proveedor_id)->first();
                                if(count((array)$proveedor_)>0)
                                    $proveedor=$proveedor_->nombre_comercial;
                            // }
                            // $fecha_venc='';
                            // if($hotel->fecha_venc)
                            //     $fecha_venc=$hotel->fecha_venc;
                                    
                            $array_pagos_pendientes[$key]=array('proveedor'=>$proveedor,
                                                            'items'=>$itinerario_cotizaciones->id,
                                                            'codigo'=>$cotizacion->codigo,                                
                                                            'pax'=>$cotizacion->nombre_pax,
                                                            'nro'=>$cotizacion->nropersonas,
                                                            'fecha_servicio'=>$itinerario_cotizaciones->fecha,
                                                            'fecha_pago'=>$hotel->fecha_venc,
                                                            'titulo'=> $text_hotel,
                                                            'monto_r'=>$monto_r,
                                                            'monto_v'=>$monto_v,
                                                            'monto_c'=>$monto_c,
                        'saldo'=>'');
                        }                        
                    }
                }
            }   
        }
        $sort1=array();
        $sort_codigo=array();
        
        foreach ($array_pagos_pendientes as $key => $part) {
            $sort1[$key] = strtotime($part['fecha_pago']);
            $sort_codigo[$key] = $part['codigo'];
        }
        array_multisort($sort1, SORT_ASC,$sort_codigo, SORT_ASC, $array_pagos_pendientes);
        
        // dd($array_pagos_pendientes);
        
        return view('admin.contabilidad.lista-fecha-hotel-filtro-general',compact(['proveedor','array_pagos_pendientes', 'pagos', 'cotizacion', 'ini', 'fin','proveedores']));
    }
    public function traer_datos(Request $request){

        $estado_contabilidad='4';
        // if(!isset($request->input('estado_contabilidad'))){
            $estado_contabilidad=$request->input('estado_contabilidad');
        // }

        $operacion=$request->input('operacion');
        $view=$request->input('view');
        $clave=$request->input('clave');
        $grupo=$request->input('grupo');
        $nro_personas=$request->input('nro_personas');
        $lista_items=explode(',',$request->input('lista_items'));
        // $consulta=null;
        // if($grupo=='HOTELS'){
            $consulta=ItinerarioCotizaciones::whereIn('id',$lista_items)->get();
        // }
        // else
        //     $consulta=ItinerarioCotizaciones::whereIn('id',$lista_items)->get();
        //return dd($consulta);
        return view('admin.contabilidad.lista-items',compact(['consulta','grupo','clave','nro_personas','view','operacion','estado_contabilidad']));
    }
    public function hotel_store(Request $request){    
        $clave=$request->input('clave');    
        $hotel_id_s=$request->input('hotel_id_s');
        $hotel_id_d=$request->input('hotel_id_d');
        $hotel_id_m=$request->input('hotel_id_m');
        $hotel_id_t=$request->input('hotel_id_t');
        $nro_personas_s=$request->input('personas_s');
        $nro_personas_d=$request->input('personas_d');
        $nro_personas_m=$request->input('personas_m');
        $nro_personas_t=$request->input('personas_t');
        $precio_s=$request->input('precio_s_c_'.$clave);
        $precio_d=$request->input('precio_d_c_'.$clave);
        $precio_m=$request->input('precio_m_c_'.$clave);
        $precio_t=$request->input('precio_t_c_'.$clave);
        $total=$request->input('precio_total_'.$clave);
        // dd($total);
        // if(isset($hotel_id_s)){   
            if(!empty($hotel_id_s)){
                foreach($hotel_id_s as $key => $hotel_id){
                    $hotel=PrecioHotelReserva::FindOrFail($hotel_id);
                    $hotel->precio_s_c=round($precio_s[$key],2)/$hotel->personas_s;
                    $hotel->fecha_venc=$request->input('fecha_venc');
                    $hotel->save();
                }
            }
        // }
        
        // if(isset($hotel_id_d)){   
            if(!empty($hotel_id_d)){
                foreach($hotel_id_d as $key => $hotel_id){
                    $hotel=PrecioHotelReserva::FindOrFail($hotel_id);
                    $hotel->precio_d_c=round($precio_d[$key],2)/$hotel->personas_d;
                    $hotel->fecha_venc=$request->input('fecha_venc');
                    $hotel->save();
                }
            }
        // }
        // if(isset($hotel_id_m)){     
            if(!empty($hotel_id_m)){
                foreach($hotel_id_m as $key => $hotel_id){
                    $hotel=PrecioHotelReserva::FindOrFail($hotel_id);
                    $hotel->precio_m_c=round($precio_m[$key],2)/$hotel->personas_m;
                    $hotel->fecha_venc=$request->input('fecha_venc');
                    $hotel->save();
                }
            }
        // }
        // if(isset($hotel_id_t)){       
            if(!empty($hotel_id_t)){
                foreach($hotel_id_t as $key => $hotel_id){
                    $hotel=PrecioHotelReserva::FindOrFail($hotel_id);
                    $hotel->precio_t_c=round($precio_t[$key],2)/$hotel->personas_t;
                    $hotel->fecha_venc=$request->input('fecha_venc');
                    $hotel->save();
                }
            }
        // }
       return response()->json(['mensaje'=>'<div class="alert alert-success text-left"><strong>Good!!!</strong> Datos guardados correctamente</div>','total'=>$total]);
    }
    
    public function ingresos(){        
        // return view('admin.contabilidad.ingresos');
        $paquete_cotizacion = PaqueteCotizaciones::get();
		$cot_cliente = CotizacionesCliente::with('cliente')->where('estado', 1)->get();
		$cliente = Cliente::get();
		$cotizacion_cat=Cotizacion::where('estado','2')->get();
		$webs=Web::get();
        return view('admin.contabilidad.ingresos-nueva', ['paquete_cotizacion'=>$paquete_cotizacion, 'cot_cliente'=>$cot_cliente, 'cliente'=>$cliente,'cotizacion_cat'=>$cotizacion_cat,'webs'=>$webs]);

    }
    public function list_pagos(Request $request)
	{
		$valor1 =strtoupper(trim($request->input('valor1')));
		$valor2 =strtoupper(trim($request->input('valor2')));
		$campo = $request->input('campo');
        $columna= $request->input('columna');
        $pagina= $request->input('pagina');
        $cotizacion_cat =null;
        $webs=Web::where('estado','1')->get();
		if($campo=='CODIGO/NOMBRE'){
			if(trim($valor1)==''){
				$cotizacion_cat =Cotizacion::get();
			}
			elseif(trim($valor1)!=''){
				// $cotizacion_cat =Cotizacion::whereHas('cotizaciones_cliente',function($query)use ($valor1){
				// 	$query->where('estado','1');
				// 	$query->whereHas('cliente',function ($query)use ($valor1){
				// 		$query->where('nombres','like','%'.$valor1.'%')->orwhere('apellidos','like','%'.$valor1.'%');
				// 	});
				// })
				// 	->orWhere('codigo','like','%'.$valor1.'%')->get();
				$cotizacion_cat =Cotizacion::where('nombre_pax','like','%'.$valor1.'%')
					->orWhere('codigo','like','%'.$valor1.'%')->where('estado','2')->get();
			}
			// return dd($cotizacion_cat);
			return view('admin.contabilidad.list-pagos-todos',compact('cotizacion_cat','columna','webs'));
		}
		elseif($campo=='CODIGO'){
			if(trim($valor1)==''){
				$cotizacion_cat =Cotizacion::get();
			}
			elseif(trim($valor1)!=''){
				$cotizacion_cat =Cotizacion::where('codigo', 'like', '%'.$valor1.'%')->where('estado','2')->where('web',$pagina)->get();
			}
			return view('admin.contabilidad.list-pagos', compact('cotizacion_cat', 'columna','webs','pagina'));
		}
		elseif($campo=='NOMBRE'){
			if(trim($valor1)==''){
				$cotizacion_cat =Cotizacion::get();
			}
			elseif(trim($valor1)!=''){
				$cotizacion_cat =Cotizacion::where('nombre_pax', 'like', '%'.$valor1.'%')->where('estado','2')->where('web',$pagina)->get();
				// $cotizacion_cat =Cotizacion::whereHas('cotizaciones_cliente',function($query)use ($valor1){
				// 	$query->where('estado','1');
				// 	$query->whereHas('cliente',function ($query)use ($valor1){
				// 		$query->where('nombres','like','%'.$valor1.'%')->orwhere('apellidos','like','%'.$valor1.'%');
				// 	});
				// })->get();
			}
			return view('admin.contabilidad.list-pagos',compact('cotizacion_cat','columna','webs','pagina'));
		}
		elseif($campo=='FECHAS'){
			$cotizacion_cat =Cotizacion::whereBetween('fecha', [$valor1, $valor2])->where('estado','2')->where('web',$pagina)->get();
			return view('admin.contabilidad.list-pagos', compact('cotizacion_cat', 'columna','webs','pagina'));
		}
		elseif( $campo == 'ANIO-MES' ) {
			$cotizacion_cat =Cotizacion::whereYear('fecha', $valor1)->whereMonth('fecha', $valor2)->where('estado','2')->where('web',$pagina)->get();
			return view('admin.contabilidad.list-pagos', compact('cotizacion_cat', 'columna','webs','pagina'));
		}
    }
    
    public function pagos_recientes(Request $request)
	{
        $filtro=$request->input('filtro');
        $f1=$request->input('f1');
        $f2=$request->input('f2');
        $today=Carbon::now();
        $mes='';
        if($filtro=='ULTIMOS 7 DIAS'){
            $f1=$today->subDays(7)->toDateString();
            $f2=$today->now()->toDateString();
        }
        if($filtro=='ULTIMOS 30 DIAS'){
            $f1=$today->subDays(30)->toDateString();
            $f2=$today->now()->toDateString();
        }
        if($filtro=='ESTE MES'){
            $mes=$today->month;
        }
        if($filtro=='ENTRE FECHAS'){
            $f1=$f1;
            $f2=$f2;
        }
        
        $cotizaciones=null;
        if($filtro=='ESTE MES'){
            $cotizaciones=Cotizacion::where('anulado','>','0')
            ->whereHas('paquete_cotizaciones',function($q) use ($mes) {
                $q->whereHas('pagos_cliente',function($q1) use ($mes){
                    $q1->where('estado','1')
                    ->whereMonth('fecha',$mes);
                });
            })->get();
        }
        else{
            $cotizaciones=Cotizacion::where('anulado','>','0')
            ->whereHas('paquete_cotizaciones',function($q) use ($f1,$f2){
                $q->whereHas('pagos_cliente',function($q1) use ($f1,$f2){
                    $q1->where('estado','1')
                    ->whereBetween('fecha',[$f1,$f2]);
                });
            })->get();
        }
        // dd('filtro:'.$filtro.',mes:'.$mes.',f1:'.$f1.',f2:'.$f2);
        // dd($cotizaciones);
        $pagina='';
        return view('admin.contabilidad.list-pagos-recientes',compact('cotizaciones','pagina'));
    }
 
    public function preparar_requerimiento(Request $request)
	{
        $txt_ini=$request->input('txt_ini');
        $txt_fin=$request->input('txt_fin');
        // dd($request->all());
        $arreglo_h=$request->input('arreglo_h');
        $modo_busqueda=$request->input('tipo_filtro');

        
        $chb_h_pagos=$request->input('chb_h_pagos');
        $arreglo=array();
        if(!is_array($chb_h_pagos)){
            
        // dd($chb_h_pagos);
            $chb_h_pagos1=$chb_h_pagos;
            $chb_h_pagos1=explode(',',$chb_h_pagos1);
            $key=$request->input('key');
            foreach($chb_h_pagos1 as $chb_h_pago){
                if($chb_h_pago!=$key){
                    array_push($arreglo,$chb_h_pago);
                    // $arreglo[]=$chb_h_pago;
                    // $arreglo[]=array($chb_h_pago);
                }
            }
            $chb_h_pagos=$arreglo;
            // dd($arreglo);
            
        // dd($arreglo);
        }

        if(isset($chb_h_pagos)){
            $lista_cotizaciones=[];
            
            $lista_cotizaciones_proveedor=[];
            foreach($chb_h_pagos as $chb_h_pago){
                $valor=explode('_',$chb_h_pago);
                $cotizacion_id=$valor[0];
                $proveedor_id=$valor[1];
                
                if(!array_key_exists($cotizacion_id,$lista_cotizaciones)){
                    $lista_cotizaciones[]=$cotizacion_id;
                }
                if(array_key_exists($cotizacion_id,$lista_cotizaciones_proveedor)){
                    $lista_cotizaciones_proveedor[$cotizacion_id]['proveedores'].= ','.$proveedor_id;                    
                }else{         
                    $lista_cotizaciones_proveedor[$cotizacion_id]=array('proveedores'=>$proveedor_id);
                }
            }
            // dd($lista_cotizaciones_proveedor['405']['proveedores']);
            $cotizaciones=Cotizacion::whereIn('id',$lista_cotizaciones)->get();
            $array_pagos_pendientes = [];
            $key='';
            foreach ($cotizaciones as $cotizacion){
                foreach ($cotizacion->paquete_cotizaciones as $paquete_cotizaciones){
                    foreach ($paquete_cotizaciones->itinerario_cotizaciones as $itinerario_cotizaciones){     

                        // dd($itinerario_cotizaciones->hotel->where('proveedor_id','153'));
// dd($lista_cotizaciones_proveedor[$cotizacion->id]['proveedores']);
                        foreach ($itinerario_cotizaciones->hotel->whereIn('proveedor_id',explode(',',$lista_cotizaciones_proveedor[$cotizacion->id]['proveedores']))/*->where('primera_confirmada','1')*/ as $hotel){
                            $key=$cotizacion->id.'_'.$hotel->proveedor_id;
                            $monto_r=0;
                            $monto_v=0;
                            $monto_c=0;
                            $text_hotel='';
                            if($hotel->personas_s>0){
                                $monto_r+=$hotel->personas_s*$hotel->precio_s_r;
                                $monto_v+=$hotel->personas_s*$hotel->precio_s;
                                $monto_c+=$hotel->personas_s*$hotel->precio_s_c;
                                $text_hotel.='| <b class="text-primary">'.$hotel->personas_s.'<i class="fas fa-bed"></i></b>';
                            }
                            if($hotel->personas_d>0){
                                $monto_r+=$hotel->personas_d*$hotel->precio_d_r;
                                $monto_v+=$hotel->personas_d*$hotel->precio_d;
                                $monto_c+=$hotel->personas_d*$hotel->precio_d_c;
                                $text_hotel.='| <b class="text-primary">'.$hotel->personas_d.'<i class="fas fa-bed"></i><i class="fas fa-bed"></i></b>';
                            }
                            if($hotel->personas_m>0){
                                $monto_r+=$hotel->personas_m*$hotel->precio_m_r;
                                $monto_v+=$hotel->personas_m*$hotel->precio_m;
                                $monto_c+=$hotel->personas_m*$hotel->precio_m_c;
                                $text_hotel.='| <b class="text-primary">'.$hotel->personas_m.'<i class="fas fa-transgender"></i></b>';
                            }
                            if($hotel->personas_t>0){
                                $monto_r+=$hotel->personas_t*$hotel->precio_t_r;
                                $monto_v+=$hotel->personas_t*$hotel->precio_t;
                                $monto_c+=$hotel->personas_t*$hotel->precio_t_c;
                                $text_hotel.='| <b class="text-primary">'.$hotel->personas_t.'<i class="fas fa-bed"></i><i class="fas fa-bed"></i><i class="fas fa-bed"></i></b>';
                            }
                            if(array_key_exists($key,$array_pagos_pendientes)){
                                // dd($array_pagos_pendientes);
                                $array_pagos_pendientes[$key]['monto_r']+= $monto_r;
                                $array_pagos_pendientes[$key]['monto_v']+= $monto_v;
                                $array_pagos_pendientes[$key]['monto_c']+= $monto_c;
                                $array_pagos_pendientes[$key]['items'].= ','.$hotel->id;
                                $array_pagos_pendientes[$key]['items_itinerario'].= ','.$itinerario_cotizaciones->id;
                                $array_pagos_pendientes[$key]['notas_cotabilidad']= $hotel->notas_contabilidad;
                            }else{
                                // $proveedor='';
                                // if($hotel->proveedor_id>0){
                                    $proveedor_=Proveedor::where('id',$hotel->proveedor_id)->first();
                                    if(count((array)$proveedor_)>0)
                                        $proveedor=$proveedor_->nombre_comercial;
                                // }
                                // $fecha_venc='';
                                // if($hotel->fecha_venc)
                                //     $fecha_venc=$hotel->fecha_venc;
                                        
                                $array_pagos_pendientes[$key]=array('proveedor'=>$proveedor,
                                                                'items'=>$hotel->id,
                                                                'items_itinerario'=>$itinerario_cotizaciones->id,
                                                                'codigo'=>$cotizacion->codigo,                                
                                                                'pax'=>$cotizacion->nombre_pax,
                                                                'nro'=>$cotizacion->nropersonas,
                                                                'fecha_servicio'=>$itinerario_cotizaciones->fecha,
                                                                'fecha_pago'=>$hotel->fecha_venc,
                                                                'titulo'=> $text_hotel,
                                                                'notas_cotabilidad'=> $hotel->notas_contabilidad,
                                                                'monto_r'=>$monto_r,
                                                                'monto_v'=>$monto_v,
                                                                'monto_c'=>$monto_c,
                            'saldo'=>'');
                            }                        
                        }
                    }
                }   
            }

            
            $sort1=array();
            $sort_codigo=array();
            
            foreach ($array_pagos_pendientes as $key => $part) {
                $sort1[$key] = strtotime($part['fecha_pago']);
                $sort_codigo[$key] = $part['codigo'];
            }
            array_multisort($sort1, SORT_ASC,$sort_codigo, SORT_ASC, $array_pagos_pendientes);
            // dd($array_pagos_pendientes);
        // dd($chb_h_pagos);
        // dd($arreglo_h);
        // dd($array_pagos_pendientes);
        $ini='';
        $fin='';
        $grupo='HOTELS';
        $webs = Web::get();
        // return view('admin.contabilidad.requerimiento-preparado',compact(['array_pagos_pendientes']));
        return view('admin.contabilidad.requerimiento-preparado',compact(['proveedor','array_pagos_pendientes', 'pagos', 'cotizacion', 'txt_ini', 'txt_fin','proveedores','webs','grupo','modo_busqueda']));
        }
    }
    public function hotel_store_notas(Request $request){
        try{       
            $notas=$request->input('notas');
            $items_cadena=$request->input('items');
            $items=explode(',',$items_cadena);
            if(isset($items)){
                foreach($items as $item){
                    $hotel=PrecioHotelReserva::FindOrFail($item);
                    $hotel->notas_contabilidad=$notas;
                    $hotel->save();
                }
                return response()->json(['mensaje'=>'<div class="alert alert-success text-left"><strong>Good!</strong> Notas guardadas correctamente</div>','total'=>1]);    
            }
        }
        catch (Exception $e){
            return response()->json(['mensaje'=>'<div class="alert alert-danger text-left"><strong>Opps!</strong> hubo un error al ingresar las notas, vuelva a intentarlo ('.$e.')</div>','total'=>1]);    
        }
    }
    public function hotel_store_notas_revisor(Request $request){
        try{       
            if($request->input('operacion')=='ver'||$request->input('operacion')=='pagar'){
                $clave=$request->input('clave');    
                $hotel_id_s=$request->input('hotel_id_s');
                $hotel_id_d=$request->input('hotel_id_d');
                $hotel_id_m=$request->input('hotel_id_m');
                $hotel_id_t=$request->input('hotel_id_t');
                $nro_personas_s=$request->input('personas_s');
                $nro_personas_d=$request->input('personas_d');
                $nro_personas_m=$request->input('personas_m');
                $nro_personas_t=$request->input('personas_t');
                $precio_s=$request->input('precio_s_c_'.$clave);
                $precio_d=$request->input('precio_d_c_'.$clave);
                $precio_m=$request->input('precio_m_c_'.$clave);
                $precio_t=$request->input('precio_t_c_'.$clave);
                $total=$request->input('precio_total_'.$clave);

                // $s_total=0;
                // $s_total_aprovado=0;
                

                // dd($total);
                // if(isset($hotel_id_s)){   
                    if(!empty($hotel_id_s)){
                        foreach($hotel_id_s as $key => $hotel_id){
                            $hotel=PrecioHotelReserva::FindOrFail($hotel_id);
                            $hotel->precio_s_c=round($precio_s[$key],2)/$hotel->personas_s;
                            if($hotel->fecha_venc!=$request->input('fecha_venc')){
                                $hotel->requerimientos_id=0;
                            }
                            $hotel->fecha_venc=$request->input('fecha_venc');
                            $hotel->save();
                        }
                    }
                // }
                
                // if(isset($hotel_id_d)){   
                    if(!empty($hotel_id_d)){
                        foreach($hotel_id_d as $key => $hotel_id){
                            $hotel=PrecioHotelReserva::FindOrFail($hotel_id);
                            $hotel->precio_d_c=round($precio_d[$key],2)/$hotel->personas_d;
                            if($hotel->fecha_venc!=$request->input('fecha_venc')){
                                $hotel->requerimientos_id=0;
                            }
                            $hotel->fecha_venc=$request->input('fecha_venc');
                            $hotel->save();
                        }
                    }
                // }
                // if(isset($hotel_id_m)){     
                    if(!empty($hotel_id_m)){
                        foreach($hotel_id_m as $key => $hotel_id){
                            $hotel=PrecioHotelReserva::FindOrFail($hotel_id);
                            $hotel->precio_m_c=round($precio_m[$key],2)/$hotel->personas_m;
                            if($hotel->fecha_venc!=$request->input('fecha_venc')){
                                $hotel->requerimientos_id=0;
                            }
                            $hotel->fecha_venc=$request->input('fecha_venc');
                            $hotel->save();
                        }
                    }
                // }
                // if(isset($hotel_id_t)){       
                    if(!empty($hotel_id_t)){
                        foreach($hotel_id_t as $key => $hotel_id){
                            $hotel=PrecioHotelReserva::FindOrFail($hotel_id);
                            $hotel->precio_t_c=round($precio_t[$key],2)/$hotel->personas_t;
                            if($hotel->fecha_venc!=$request->input('fecha_venc')){
                                $hotel->requerimientos_id=0;
                            }
                            $hotel->fecha_venc=$request->input('fecha_venc');
                            $hotel->save();
                        }
                    }
                    
                    //-- haremos la sumatoria para hallar los valores de 's_total','s_total_aprovador'
  
                    return response()->json(['mensaje'=>'<div class="alert alert-success text-left"><strong>Good!</strong> Datos guardadas correctamente</div>','total'=>1,'estado'=>'1']);
            }
            else if($request->input('operacion')=='aprobar'){
                $notas=$request->input('notas');
                $items_cadena=$request->input('items');
                $items=explode(',',$items_cadena);
                if(isset($items)){
                    foreach($items as $item){
                        $hotel=PrecioHotelReserva::FindOrFail($item);
                        $hotel->notas_contabilidad_aprovador=$notas;
                        $hotel->save();
                    }
                    return response()->json(['mensaje'=>'<div class="alert alert-success text-left"><strong>Good!</strong> Notas guardadas correctamente</div>','total'=>1,'estado'=>'1']);
                }
            }

            
        }
        catch (Exception $e){
            return response()->json(['mensaje'=>'<div class="alert alert-danger text-left"><strong>Opps!</strong> hubo un error al ingresar las notas, vuelva a intentarlo ('.$e.')</div>','total'=>1,'estado'=>'2']);    
        }
    }
    public function enviar_requerimiento(Request $request){
        try{       
            $chb_h_pagos=$request->input('chb_h_pagos');
            $fecha_ini=$request->input('txt_ini');
            $fecha_fin=$request->input('txt_fin');
            $modo_busqueda=$request->input('modo_busqueda');
            $monto_solicitado=$request->input('monto_solicitado');
            
            if(isset($chb_h_pagos)){
                $codigo=MisFunciones::requerimiento_nuevo_codigo(10);
                $data=Carbon::now()->subHour(5);
                $requerimiento=new Requerimiento();
                $requerimiento->codigo=$codigo;
                $requerimiento->modo_busqueda=$modo_busqueda;
                $requerimiento->servicio='HOTEL';
                $requerimiento->fecha_ini=$fecha_ini;
                $requerimiento->fecha_fin=$fecha_fin;
                $requerimiento->solicitante_id=auth()->guard('admin')->user()->id;;
                $requerimiento->monto_solicitado=$monto_solicitado;
                $requerimiento->estado=2;
                $requerimiento->updated_at=$data->year.'-'.$data->month.'-'.$data->day;
                $requerimiento->save();
                foreach($chb_h_pagos as $chb_h_pago){
                    $valor=explode(',',$chb_h_pago);
                    $hoteles=PrecioHotelReserva::whereIn('id',$valor)->get();
                    foreach($hoteles as $hotel){
                        $hot=PrecioHotelReserva::find($hotel->id);
                        if(!$hot->requerimientos_id>0){
                            $hot->estado_contabilidad=2;
                            $hot->requerimientos_id=$requerimiento->id;
                            $hot->save();
                        }
                    }
                }

                $mensajes = array('message'=>'Datos guardados correctamente, con codigo:'.$codigo.'.','alert-type'=>'success');
                return redirect()->route('contabilidad.revisar_requerimiento')->with($mensajes);    
            }
            else{
                return response()->json(['mensaje'=>'<div class="alert alert-danger text-left"><strong>Opps!</strong> no tenemos pagos para guardar, por favor vuelva a filtrar.</div>','total'=>1]);
            }
        }
        catch (Exception $e){
            return response()->json(['mensaje'=>'<div class="alert alert-danger text-left"><strong>Opps!</strong> hubo un error al ingresar los datos, vuelva a intentarlo ('.$e.')</div>','total'=>1]);    
        }
    }

    public function revisar_requerimiento(){
        $requerimientos=Requerimiento::paginate(10);
        $requerimientos_nuevo=Requerimiento::where('estado','2')->get();
        $requerimientos_aprovado=Requerimiento::whereIn('estado',['3','4'])->get();
        $requerimientos_pagado=[];
        $webs = Web::get();
        $usuarios=User::get();
        return view('admin.contabilidad.revisar-requerimiento',compact('requerimientos_nuevo','requerimientos_aprovado','requerimientos_pagado','requerimientos','webs','usuarios'));
    }
    public function revisar_requerimiento_contabilidad_buscar(Request $request){
        
        $codigo=$request->input('codigo');
        $codigo=trim($codigo);
        $requerimientos_nuevo=[];
        $requerimientos_aprovado=[];
        $requerimientos_pagado=[];
        if($codigo!=''){
            $requerimientos_nuevo=Requerimiento::where('estado','2')->where('codigo',$codigo)->get();
            $requerimientos_aprovado=Requerimiento::whereIn('estado',['3','4'])->where('codigo',$codigo)->get();
            $requerimientos_pagado=Requerimiento::where('estado','5')->where('codigo',$codigo)->get();
        }
        else{
            $requerimientos_nuevo=Requerimiento::where('estado','2')->get();
            $requerimientos_aprovado=Requerimiento::whereIn('estado',['3','4'])->get();
            $requerimientos_pagado=[];
        }
        // dd($requerimientos);
        $webs = Web::get();
        $usuarios=User::get();
        return view('admin.contabilidad.revisar-requerimiento',compact('requerimientos_nuevo','requerimientos_aprovado','requerimientos_pagado','webs','usuarios'));
    }
    public function revisar_requerimiento_revisor(){
        $requerimientos_nuevo=Requerimiento::where('estado','2')->get();
        $requerimientos_aprovado=Requerimiento::whereIn('estado',['3','4'])->get();
        $requerimientos_pagado=[];
        // dd($requerimientos);
        $webs = Web::get();
        $usuarios=User::get();
        return view('admin.contabilidad.revisar-requerimiento-revisor',compact('requerimientos_nuevo','requerimientos_aprovado','requerimientos_pagado','webs','usuarios'));
    }
    public function revisar_requerimiento_revisor_buscar(Request $request){
        
        $codigo=$request->input('codigo');
        $codigo=trim($codigo);
        $requerimientos_nuevo=[];
        $requerimientos_aprovado=[];
        $requerimientos_pagado=[];
        if($codigo!=''){
            $requerimientos_nuevo=Requerimiento::where('estado','2')->where('codigo',$codigo)->get();
            $requerimientos_aprovado=Requerimiento::whereIn('estado',['3','4'])->where('codigo',$codigo)->get();
            $requerimientos_pagado=Requerimiento::where('estado','5')->where('codigo',$codigo)->get();
        }
        else{
            $requerimientos_nuevo=Requerimiento::where('estado','2')->get();
            $requerimientos_aprovado=Requerimiento::whereIn('estado',['3','4'])->get();
            $requerimientos_pagado=[];
        }
        // dd($requerimientos);
        $webs = Web::get();
        $usuarios=User::get();
        return view('admin.contabilidad.revisar-requerimiento-revisor',compact('requerimientos_nuevo','requerimientos_aprovado','requerimientos_pagado','webs','usuarios'));
    }
    public function operaciones_requerimiento($requerimiento_id,$operacion){
        // $requerimiento=Requerimiento::find($requerimiento_id);
        $cotizaciones=Cotizacion::whereHas('paquete_cotizaciones.itinerario_cotizaciones.hotel',function($query) use($requerimiento_id){
            $query->where('proveedor_id','!=','')
            ->where('requerimientos_id',$requerimiento_id);
        })->get();
        // $cotizaciones=Cotizacion::whereIn('id',$lista_cotizaciones)->get();
        $array_pagos_pendientes = [];
        $key='';
        foreach ($cotizaciones as $cotizacion){
            foreach ($cotizacion->paquete_cotizaciones as $paquete_cotizaciones){
                foreach ($paquete_cotizaciones->itinerario_cotizaciones as $itinerario_cotizaciones){     

                    foreach($itinerario_cotizaciones->hotel->where('requerimientos_id',$requerimiento_id) /*->whereIn('proveedor_id',explode(',',$lista_cotizaciones_proveedor[$cotizacion->id]['proveedores']))*/ as $hotel){
                        $key=$cotizacion->id.'_'.$hotel->proveedor_id;
                        $monto_r=0;
                        $monto_v=0;
                        $monto_c=0;
                        $text_hotel='';
                        if($hotel->personas_s>0){
                            $monto_r+=$hotel->personas_s*$hotel->precio_s_r;
                            $monto_v+=$hotel->personas_s*$hotel->precio_s;
                            $monto_c+=$hotel->personas_s*$hotel->precio_s_c;
                            $text_hotel.='| <b class="text-primary">'.$hotel->personas_s.'<i class="fas fa-bed"></i></b>';
                        }
                        if($hotel->personas_d>0){
                            $monto_r+=$hotel->personas_d*$hotel->precio_d_r;
                            $monto_v+=$hotel->personas_d*$hotel->precio_d;
                            $monto_c+=$hotel->personas_d*$hotel->precio_d_c;
                            $text_hotel.='| <b class="text-primary">'.$hotel->personas_d.'<i class="fas fa-bed"></i><i class="fas fa-bed"></i></b>';
                        }
                        if($hotel->personas_m>0){
                            $monto_r+=$hotel->personas_m*$hotel->precio_m_r;
                            $monto_v+=$hotel->personas_m*$hotel->precio_m;
                            $monto_c+=$hotel->personas_m*$hotel->precio_m_c;
                            $text_hotel.='| <b class="text-primary">'.$hotel->personas_m.'<i class="fas fa-transgender"></i></b>';
                        }
                        if($hotel->personas_t>0){
                            $monto_r+=$hotel->personas_t*$hotel->precio_t_r;
                            $monto_v+=$hotel->personas_t*$hotel->precio_t;
                            $monto_c+=$hotel->personas_t*$hotel->precio_t_c;
                            $text_hotel.='| <b class="text-primary">'.$hotel->personas_t.'<i class="fas fa-bed"></i><i class="fas fa-bed"></i><i class="fas fa-bed"></i></b>';
                        }
                        if(array_key_exists($key,$array_pagos_pendientes)){
                            // dd($array_pagos_pendientes);
                            $array_pagos_pendientes[$key]['monto_r']+= $monto_r;
                            $array_pagos_pendientes[$key]['monto_v']+= $monto_v;
                            $array_pagos_pendientes[$key]['monto_c']+= $monto_c;
                            $array_pagos_pendientes[$key]['items'].= ','.$hotel->id;
                            $array_pagos_pendientes[$key]['items_itinerario'].= ','.$itinerario_cotizaciones->id;
                            $array_pagos_pendientes[$key]['notas_cotabilidad']= $hotel->notas_contabilidad;
                            $array_pagos_pendientes[$key]['estado_contabilidad']= $hotel->estado_contabilidad;
                        }else{
                            // $proveedor='';
                            // if($hotel->proveedor_id>0){
                                $proveedor_=Proveedor::where('id',$hotel->proveedor_id)->first();
                                if(count((array)$proveedor_)>0)
                                    $proveedor=$proveedor_->nombre_comercial;
                            // }
                            // $fecha_venc='';
                            // if($hotel->fecha_venc)
                            //     $fecha_venc=$hotel->fecha_venc;
                                    
                            $array_pagos_pendientes[$key]=array('proveedor'=>$proveedor,
                                                            'items'=>$hotel->id,
                                                            'items_itinerario'=>$itinerario_cotizaciones->id,
                                                            'codigo'=>$cotizacion->codigo,                                
                                                            'pax'=>$cotizacion->nombre_pax,
                                                            'nro'=>$cotizacion->nropersonas,
                                                            'fecha_servicio'=>$itinerario_cotizaciones->fecha,
                                                            'fecha_pago'=>$hotel->fecha_venc,
                                                            'titulo'=> $text_hotel,
                                                            'notas_cotabilidad'=> $hotel->notas_contabilidad,
                                                            'monto_r'=>$monto_r,
                                                            'monto_v'=>$monto_v,
                                                            'monto_c'=>$monto_c,
                                                            'estado_contabilidad'=>$hotel->estado_contabilidad,
                                                            'saldo'=>'');
                        }                        
                    }
                }
            }   
        }

        
        $sort1=array();
        $sort_codigo=array();
        
        foreach ($array_pagos_pendientes as $key => $part) {
            $sort1[$key] = strtotime($part['fecha_pago']);
            $sort_codigo[$key] = $part['codigo'];
        }
        array_multisort($sort1, SORT_ASC,$sort_codigo, SORT_ASC, $array_pagos_pendientes);
        $ini='';
        $fin='';
        $grupo='HOTELS';
        $webs = Web::get();
        $requerimiento=Requerimiento::find($requerimiento_id);
        $usuarios=User::get();
        // return view('admin.contabilidad.requerimiento-preparado',compact(['array_pagos_pendientes']));
        return view('admin.contabilidad.requerimiento-operaciones',compact(['proveedor','array_pagos_pendientes', 'pagos', 'cotizacion', 'txt_ini', 'txt_fin','proveedores','webs','grupo','modo_busqueda','requerimiento','usuarios','operacion']));

// dd($cotizaciones);
    

                    // dd($itinerario_cotizaciones->hotel->where('proveedor_id','153'));
// dd($lista_cotizaciones_proveedor[$cotizacion->id]['proveedores']);
                    // foreach ($itinerario_cotizaciones->hotel

        // dd($requerimiento);
        
        
        // dd($requerimientos);
        // $webs = Web::get();
        // $usuarios=User::get();
        // return view('admin.contabilidad.revisar-requerimiento',compact('requerimientos','webs','usuarios'));

    }
    
    public function operaciones_requerimiento_estado_contabiliadad(Request $request){

        $id=$request->input('id');
        $id=explode('_',$id);
        $cotizacion=$id[0];
        $proveedor=$id[1];
        $valor=$request->input('valor');
        $hoteles=$request->input('hoteles');
        $hoteles=explode(',',$hoteles);
        $requerimientos_id=0;
        foreach($hoteles as $hotel){
            $oHotel=PrecioHotelReserva::find($hotel);
            $oHotel->estado_contabilidad=$valor;
            $oHotel->save();
            $requerimientos_id=$oHotel->requerimientos_id;
        }
        if($valor=='5'){
            $cotizaciones=Cotizacion::whereHas('paquete_cotizaciones.itinerario_cotizaciones.hotel',function($query) use ($requerimientos_id){
                $query->where('requerimientos_id',$requerimientos_id);
            });
            $total=0;
            $total_pagados=0;
            foreach($cotizaciones as $cotizacion){
                foreach($cotizacion->paquete_cotizaciones as $paquete_cotizacion){
                    foreach($paquete_cotizacion->itinerario_cotizaciones as $itinerario_cotizacion){
                        foreach($itinerario_cotizacion->hotel as $hotel){
                            if($hotel->requerimientos_id==$requerimientos_id){
                                if($hotel->estado_contabilidad==5){
                                    $total_pagados++;    
                                }
                                $total++;
                            }
                        }
                    }
                }
            }
            if($total_pagados==$total){
                $requerimiento=Requerimiento::find($requerimientos_id);
                $requerimiento->estado=5;
                $requerimiento->save();
            }
            else{
                $requerimiento=Requerimiento::find($requerimientos_id);
                $requerimiento->estado=6;
                $requerimiento->save();
            }
        }
        return '1';

    }
    
    public function enviar_requerimiento_revisor(Request $request){
        try {
            //code...
            $data=Carbon::now()->subHour(5);
            $operacion=$request->input('operacion');
            $requerimientos_id=$request->input('requerimiento_id');
            $requerimiento=Requerimiento::find($requerimientos_id);
            if($operacion=='pagar'){
                $requerimiento->estado=5;
                $lista_pagar=$request->input('lista_pagar');
                $texto='';
                if(isset($lista_pagar)){
                    //dd($lista_pagar);
                    foreach($lista_pagar as $hoteles){
                        $hoteles=explode(',',$hoteles);
                        // echo var_dump($hoteles);
                        if(is_array($hoteles)){
                            // $texto.='_'.$hoteles.toString();
                            if(count($hoteles)>0){
                                foreach($hoteles as $hotelito){
                                    // $texto.='_'.$hotelito;
                                    $oHotel=PrecioHotelReserva::find($hotelito);
                                    $oHotel->estado_contabilidad='5';
                                    $oHotel->save();
                                }
                            }
                        }
                        else{
                        }                                        
                    }
                }
                $cotizaciones=Cotizacion::whereHas('paquete_cotizaciones.itinerario_cotizaciones.hotel',function($query) use ($requerimientos_id){
                    $query->where('requerimientos_id',$requerimientos_id);
                });
                $total=0;
                $total_pagados=0;
                foreach($cotizaciones as $cotizacion){
                    foreach($cotizacion->paquete_cotizaciones as $paquete_cotizacion){
                        foreach($paquete_cotizacion->itinerario_cotizaciones as $itinerario_cotizacion){
                            foreach($itinerario_cotizacion->hotel as $hotel){
                                if($hotel->requerimientos_id==$requerimientos_id){
                                    if($hotel->estado_contabilidad==5){
                                        $total_pagados++;    
                                    }
                                    $total++;
                                }
                            }
                        }
                    }
                }
                if($total_pagados==$total){                    
                    $requerimiento->estado=5;
                }
                else{
                    $requerimiento->estado=6;
                }
            }
            else{
                $requerimiento->estado=3;
                $requerimiento->revisador_id=auth()->guard('admin')->user()->id;
                $requerimiento->revisador_fecha=$data->year.'-'.$data->month.'-'.$data->day;
            }
            
            if($requerimiento->save()){
                return response()->json(['mensaje'=>'<div class="alert alert-success text-left"><strong>Good!</strong> Datos guardado correctamente.</div>','operacion'=>$operacion]);
            }
            else{
                return response()->json(['mensaje'=>'<div class="alert alert-danger text-left"><strong>Opps!</strong> Hubo un error al guardar los datos.</div>','operacion'=>$operacion]);
            }

        }catch (Exception $e){
            return response()->json(['mensaje'=>'<div class="alert alert-danger text-left"><strong>Opps!</strong> hubo un error al guardar los datos, vuelva a intentarlo ('.$e.')</div>']);
        }
    }
    public function codigo(Request $request){
        try {
            //code...
            $codigo=$request->input('codigo');
            $requerimiento=Requerimiento::where('codigo',$codigo)->get();

        }catch (Exception $e){
            // return response()->json(['mensaje'=>'<div class="alert alert-danger text-left"><strong>Opps!</strong> hubo un error al guardar los datos, vuelva a intentarlo ('.$e.')</div>']);
        }
    }
    public function requerimientos_borrar_lista(Request $request){
        try {
            //code...
            $key=$request->input('key');
            $requerimiento=Requerimiento::find($key);

            if($requerimiento->delete()){
                $cotizaciones=Cotizacion::whereHas('paquete_cotizaciones.itinerario_cotizaciones.hotel',function($query) use($key){
                    $query->where('proveedor_id','!=','')
                    ->where('requerimientos_id',$key);
                })->get();

                foreach($cotizaciones as $cotizacion){
                    foreach($cotizacion->paquete_cotizaciones as $paquete_cotizacion){
                        foreach($paquete_cotizacion->itinerario_cotizaciones as $itinerario_cotizacion){
                            foreach($itinerario_cotizacion->hotel as $hotel){
                                if($hotel->requerimientos_id==$key){
                                    $hotelito=PrecioHotelReserva::find($hotel->id);
                                    $hotelito->requerimientos_id=0;
                                    $hotelito->notas_contabilidad='';
                                    $hotelito->notas_contabilidad_revisor='';
                                    $hotelito->estado_contabilidad=0;
                                    $hotelito->save();
                                }
                            }   
                        }   
                    }   
                }
                return response()->json(['mensaje'=>'<div class="alert alert-danger text-left"><strong>Good!</strong>Datos guardados correctamente.</div>','mensaje_toastr'=>'<strong>Good!</strong>Datos guardados correctamente.','estado'=>1]);
            }
            else{
                return response()->json(['mensaje'=>'<div class="alert alert-danger text-left"><strong>Opps!</strong> hubo un error al guardar los datos, vuelva a intentarlo ('.$e.')</div>','mensaje_toastr'=>'<strong>Opps!</strong> hubo un error al guardar los datos, vuelva a intentarlo ('.$e.')','estado'=>0]);
            }

        }catch (Exception $e){
            return response()->json(['mensaje'=>'<div class="alert alert-danger text-left"><strong>Opps!</strong>Hubo un error al guardar los datos, vuelva a intentarlo ('.$e.')</div>','mensaje_toastr'=>'<strong>Opps!</strong>Hubo un error al guardar los datos, vuelva a intentarlo ('.$e.')','estado'=>0]);
        }
    }
    public function requerimientos_borrar_lista_uno(Request $request){
        try {
            //code...
            
            $grupo=$request->input('grupo');
            $hoteles=explode(',',$grupo);
            $hotelitos=PrecioHotelReserva::whereIn('id',$hoteles)->get();
            foreach($hotelitos as $hotel){
                    $hotelito=PrecioHotelReserva::find($hotel->id);
                    $hotelito->requerimientos_id=0;
                    $hotelito->notas_contabilidad='';
                    $hotelito->notas_contabilidad_aprovador='';
                    $hotelito->estado_contabilidad=0;
                    $hotelito->save();
            }
            
            // $key=$request->input('key');
            // $requerimiento=Requerimiento::find($key);
            // if($requerimiento->delete()){
            //     $cotizaciones=Cotizacion::whereHas('paquete_cotizaciones.itinerario_cotizaciones.hotel',function($query) use($key){
            //         $query->where('proveedor_id','!=','')
            //         ->where('requerimientos_id',$key);
            //     })->get();

            //     foreach($cotizaciones as $cotizacion){
            //         foreach($cotizacion->paquete_cotizaciones as $paquete_cotizacion){
            //             foreach($paquete_cotizacion->itinerario_cotizaciones as $itinerario_cotizacion){
            //                 foreach($itinerario_cotizacion->hotel as $hotel){
            //                     if($hotel->requerimientos_id==$key){
            //                         $hotelito=PrecioHotelReserva::find($key);
            //                         $hotelito->requerimientos_id=0;
            //                         $hotelito->notas_contabilidad='';
            //                         $hotelito->notas_contabilidad_revisor='';
            //                         $hotelito->estado_contabilidad=0;
            //                         $hotelito->save();
            //                     }
            //                 }   
            //             }   
            //         }   
            //     }
                return response()->json(['mensaje'=>'<div class="alert alert-danger text-left"><strong>Good!</strong>Datos guardados correctamente.</div>','mensaje_toastr'=>'<strong>Good!</strong>Datos guardados correctamente.','estado'=>1]);
            // }
            // else{
            //     return response()->json(['mensaje'=>'<div class="alert alert-danger text-left"><strong>Opps!</strong> hubo un error al guardar los datos, vuelva a intentarlo ('.$e.')</div>','mensaje_toastr'=>'<strong>Opps!</strong> hubo un error al guardar los datos, vuelva a intentarlo ('.$e.')','estado'=>0]);
            // }

        }catch (Exception $e){
            return response()->json(['mensaje'=>'<div class="alert alert-danger text-left"><strong>Opps!</strong>Hubo un error al guardar los datos, vuelva a intentarlo ('.$e.')</div>','mensaje_toastr'=>'<strong>Opps!</strong>Hubo un error al guardar los datos, vuelva a intentarlo ('.$e.')','estado'=>0]);
        }
    }
    
    public function estado_de_pagos(){
        
// dd('holi');
        set_time_limit(0);
        $cotizaciones_new=Cotizacion::where('estado',2)
        ->whereBetween('categorizado',['C','S'])
        /*->whereHas('paquete_cotizaciones.itinerario_cotizaciones.hotel',function($query){
            $query->where('requerimientos_id','==','0');
        })
        ->whereHas('paquete_cotizaciones.itinerario_cotizaciones.itinerario_servicios',function($query){
            $query->where('requerimientos_id','==','0');
        })*/
        ->get();

        $cotizaciones_current_complete=Cotizacion::where('estado',2)
        ->whereBetween('categorizado',['C','S'])
        /*->whereHas('paquete_cotizaciones.itinerario_cotizaciones.hotel',function($query){
            $query->where('requerimientos_id','>','0');
        })
        ->whereHas('paquete_cotizaciones.itinerario_cotizaciones.itinerario_servicios',function($query){
            $query->where('requerimientos_id','>','0');
        })*/
        ->get();
        // dd($cotizaciones);
		// $paquete_cotizacion = PaqueteCotizaciones::where('estado', 2)->get();
		// $cot_cliente = CotizacionesCliente::with('cliente')->where('estado', 1)->get();
		// $cliente = Cliente::get();
		// $cotizacion_cat=Cotizacion::where('estado',2)
        //     ->whereBetween('categorizado',['C','S'])->get();
		// session()->put('menu', 'reservas');
		$webs=Web::get();
		return view('admin.contabilidad.estado-de-pagos',compact('cotizaciones_new','webs','cotizaciones_current_complete'));
    }
    
    public function contabilidad_facturacion_path($anio,$mes,$page,$tipo_filtro)
    {
        $user_name=auth()->guard('admin')->user()->name;
        $user_tipo=auth()->guard('admin')->user()->tipo_user;
        // if($user_tipo=='ventas') {
        //     $cotizacion = Cotizacion::where('web', $page)->where('users_id', auth()->guard('admin')->user()->id)->get();
        // }
        // else {
        //     $cotizacion = Cotizacion::where('web', $page)->get();
        // }
        $filtro_sale='fecha_venta';
        if($tipo_filtro=='arrival-date'){
            $filtro_sale='fecha';
        }

        if($user_tipo=='ventas') {
            if($tipo_filtro=='arrival-date'){
                $cotizacion = Cotizacion::where('web', $page)->whereYear($filtro_sale,$anio)->whereMonth($filtro_sale,$mes)->where('users_id', auth()->guard('admin')->user()->id)->get();
            }
            else{
                $cotizacion = Cotizacion::where('web', $page)->whereYear($filtro_sale,$anio)->whereMonth($filtro_sale,$mes)->where('users_id', auth()->guard('admin')->user()->id)->get();
            }
            
        }
        else {
            if($tipo_filtro=='arrival-date'){
                $cotizacion = Cotizacion::where('web', $page)->whereYear($filtro_sale,$anio)->whereMonth($filtro_sale,$mes)->get();
            }
            else{
                $cotizacion = Cotizacion::where('web', $page)->whereYear($filtro_sale,$anio)->whereMonth($filtro_sale,$mes)->get();
            }
        }
        // dd($cotizacion);
        session()->put('menu-lateral', 'quotes/current');
        $webs=Web::get();
        
        $goal= GoalProfit::where('pagina',$page)->where('anio',$anio)->where('mes',$mes)->get()->first();
        $profit_tope =0;
        if(count((array)$goal)>0)
            $profit_tope =$goal->goal;
        
        $profit_suma=0;
        // profit alcanzado
        foreach ($cotizacion->sortByDesc($filtro_sale) as $cotizacion_){
            $profit=0;
            $profit_st=0;
            foreach($cotizacion_->paquete_cotizaciones->take(1) as $paquete_cotizaciones){
                if($paquete_cotizaciones->duracion==1){
                    $profit=$paquete_cotizaciones->utilidad*$cotizacion_->nropersonas;
                }                    
                else{
                    $nro_personas=0;
                    $uti=0;
                    
                    if($paquete_cotizaciones->paquete_precios->count()>=1){
                        foreach($paquete_cotizaciones->paquete_precios as $precio){
                            $nro_personas=$precio->personas_s+$precio->personas_d+$precio->personas_m+$precio->personas_t;
                            if($precio->personas_s>0)
                                $uti+=$precio->utilidad_s*$precio->personas_s;
                            
                            if($precio->personas_d>0)
                                    $uti+=$precio->utilidad_d*$precio->personas_d*2;
                            
                            if($precio->personas_m>0)
                                    $uti+=$precio->utilidad_m*$precio->personas_m*2;
                            
                            if($precio->personas_t>0)
                                $uti+=$precio->utilidad_t*$precio->personas_t*3;
                        
                        }

                        if($nro_personas>0)
                            $profit+=$uti;
                        else
                            $profit=$paquete_cotizaciones->utilidad*$cotizacion_->nropersonas;
                            
                    }
                    else
                        $profit=$paquete_cotizaciones->utilidad*$cotizacion_->nropersonas;
                    
                }
            }            
            $profit_suma+=$profit;
        }
        $profit_alcanzado = $profit_suma;
        
        $profit_suma_anio_pasado=0;
        // profit alcanzado anio pasado
        $cotizacion_anio_pasado=null;
        $anio_pasado=$anio-1;
        // dd($anio_pasado);
        // if($user_tipo=='ventas') {
        //     $cotizacion_anio_pasado = Cotizacion::where('web', $page)->whereYear($filtro_sale,$anio_pasado)->whereMonth($filtro_sale,$mes)->where('users_id', auth()->guard('admin')->user()->id)->get();
        // }
        // else {
            $cotizacion_anio_pasado = Cotizacion::where('web', $page)->whereYear($filtro_sale,$anio_pasado)->whereMonth($filtro_sale,$mes)->get();
        // }
        // dd($cotizacion_anio_pasado);
        foreach ($cotizacion_anio_pasado->sortByDesc($filtro_sale) as $cotizacion_){
            $profit=0;
            $profit_st=0;
            foreach($cotizacion_->paquete_cotizaciones->take(1) as $paquete_cotizaciones){
                if($paquete_cotizaciones->duracion==1){
                    $profit=$paquete_cotizaciones->utilidad*$cotizacion_->nropersonas;
                }                    
                else{
                    $nro_personas=0;
                    $uti=0;
                    
                    if($paquete_cotizaciones->paquete_precios->count()>=1){
                        foreach($paquete_cotizaciones->paquete_precios as $precio){
                            $nro_personas=$precio->personas_s+$precio->personas_d+$precio->personas_m+$precio->personas_t;
                            if($precio->personas_s>0)
                                $uti+=$precio->utilidad_s*$precio->personas_s;
                            
                            if($precio->personas_d>0)
                                    $uti+=$precio->utilidad_d*$precio->personas_d*2;
                            
                            if($precio->personas_m>0)
                                    $uti+=$precio->utilidad_m*$precio->personas_m*2;
                            
                            if($precio->personas_t>0)
                                $uti+=$precio->utilidad_t*$precio->personas_t*3;
                        
                        }

                        if($nro_personas>0)
                            $profit+=$uti;
                        else
                            $profit=$paquete_cotizaciones->utilidad*$cotizacion_->nropersonas;
                            
                    }
                    else
                        $profit=$paquete_cotizaciones->utilidad*$cotizacion_->nropersonas;
                    
                }
            }            
            $profit_suma_anio_pasado+=$profit;
        }
        $profit_anio_pasado = $profit_suma_anio_pasado;

        // if($page=='expedia.com'){
        //     return view('admin.quotes-current-page-expedia',['cotizacion'=>$cotizacion, 'page'=>$page,'user_name'=>$user_name,'user_tipo'=>$user_tipo,'anio'=>$anio,'mes'=>$mes,'webs'=>$webs]);
        // }
        // else{
            return view('admin.contabilidad.contabilidad-facturacion',['cotizacion'=>$cotizacion, 'page'=>$page,'user_name'=>$user_name,'user_tipo'=>$user_tipo,'anio'=>$anio,'mes'=>$mes,'webs'=>$webs,'profit_tope'=>$profit_tope,'profit_alcanzado'=>$profit_alcanzado,'profit_anio_pasado'=>$profit_anio_pasado,'tipo_filtro'=>$tipo_filtro]);
        // }
    }
    public function show_cotizacion_id($id)
	{
		set_time_limit(0);
		$clientes1=Cliente::get();
		$cotizacion=Cotizacion::FindOrFail($id);
		$productos=M_Producto::get();
		$proveedores=Proveedor::get();
		$hotel_proveedor=HotelProveedor::get();
		$m_servicios=M_Servicio::get();
		$pqt_coti=PaqueteCotizaciones::where('cotizaciones_id',$id)->where('estado',2)->get();
		$pqt_id=0;
		foreach ($pqt_coti as $pqt){
			$pqt_id=$pqt->id;
		}
		$ItinerarioServiciosAcumPagos=ItinerarioServiciosAcumPago::where('paquete_cotizaciones_id',$pqt_id)->get();
		$ItinerarioHotleesAcumPagos=PrecioHotelReservaPagos::where('paquete_cotizaciones_id',$pqt_id)->get();
		$cotizacion_archivos=CotizacionArchivos::where('cotizaciones_id',$id)->get();
		$usuario=User::get();
        $webs=Web::get();
        $paraBoleta=M_Category::where('tipo','BOLETA')->pluck('nombre')->toArray();
        // dd($paraBoleta);
        $paraFactura=M_Category::where('tipo','FACTURA')->pluck('nombre')->toArray();;
		return view('admin.contabilidad.contabilidad-facturacion-details',['cotizacion'=>$cotizacion,'productos'=>$productos,'proveedores'=>$proveedores,'hotel_proveedor'=>$hotel_proveedor,'m_servicios'=>$m_servicios,'ItinerarioServiciosAcumPagos'=>$ItinerarioServiciosAcumPagos,'ItinerarioHotleesAcumPagos'=>$ItinerarioHotleesAcumPagos,'clientes1'=>$clientes1,'cotizacion_archivos'=>$cotizacion_archivos,'usuario'=>$usuario,'webs'=>$webs,'id'=>$id,'paraBoleta'=>$paraBoleta,'paraFactura'=>$paraFactura]);
	}
}