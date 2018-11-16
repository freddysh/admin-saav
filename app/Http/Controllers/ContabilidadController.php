<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\ConsultaPago;
use App\ConsultaPagoHotel;
use App\Cotizacion;
use App\CotizacionesCliente;
use App\CuentasGoto;
use App\EntidadBancaria;
use App\HotelProveedor;
use App\ItinerarioCotizaciones;
use App\ItinerarioServicioProveedor;
use App\ItinerarioServicios;
use App\ItinerarioServiciosAcumPago;
use App\ItinerarioServiciosPagos;
use App\Liquidacion;
use App\M_Itinerario;
use App\M_Producto;
use App\M_Servicio;
use App\P_Itinerario;
use App\PaqueteCotizaciones;
use App\PrecioHotelReserva;
use App\PrecioHotelReservaPagos;
use App\Proveedor;
use App\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

class ContabilidadController extends Controller
{
    //
    public function index()
    {
        $cotizacion = Cotizacion::where('confirmado_r', 'ok')->get();
        session()->put('menu', 'contabilidad');
        return view('admin.contabilidad.index', ['cotizacion' => $cotizacion]);
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
        return view('admin.contabilidad.confirmar_precio', ['cotizaciones' => $cotizaciones, 'cotizacion' => $cotizacion, 'productos' => $productos, 'proveedores' => $proveedores, 'hotel_proveedor' => $hotel_proveedor, 'ItinerarioServiciosAcumPagos' => $ItinerarioServiciosAcumPagos, 'ItinerarioHotleesAcumPagos' => $ItinerarioHotleesAcumPagos, 'activado' => $activado, 'itinerario_cotis' => $itinerario_cotis, 'pqt_coti' => $pqt_coti]);
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
        return view('admin.contabilidad.pagos-pendientes',compact(['cotizacion','ini','fin','cotizaciones','servicios','servicios_movi','liquidaciones','users','consulta','consulta_serv','grupo']));
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
        if ($liquidacion->delete())
            return 1;
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
        $ini =$request->input('ini');
        $fin =$request->input('fin');
        $grupo=$request->input('grupo');
        $cotizacion=Cotizacion::get();
        $proveedores=Proveedor::where('grupo',$grupo)->get();
        return view('admin.contabilidad.lista-entrada-pendiente',compact(['cotizacion', 'ini', 'fin','proveedores','grupo','opcion']));
    }
    public function pagos_pendientes_filtro_datos_servicios_entradas_guardado_pagado($boton,$id)
    {
        $liquidacion=Liquidacion::Find($id);
//        dd($liquidacion);
        $ini=$liquidacion->ini;
        $fin=$liquidacion->fin;
        $cotizacion=null;
        $opcion=$liquidacion->opcion;
        if($opcion=='TODOS LOS PENDIENTES'){
            $cotizacion=Cotizacion::whereHas('paquete_cotizaciones.itinerario_cotizaciones',function ($query) use($id,$ini,$fin){
                $query->whereHas('itinerario_servicios',function($query)use($id,$ini,$fin){
                    $query->where('liquidacion','1');
                });
            })->get();
        }
        elseif($opcion=='ENTRE DOS FECHAS'){
            $cotizacion=Cotizacion::whereHas('paquete_cotizaciones.itinerario_cotizaciones',function ($query) use($id,$ini,$fin){
                $query->whereBetween('fecha',[$ini,$fin]);
                $query->whereHas('itinerario_servicios',function($query)use($id,$ini,$fin){
                    $query->where('liquidacion','1');
                });
            })->get();
        }

//        return dd($opcion);
//        $opcion=$request->input('opcion');
//        $ini =$request->input('ini');
//        $fin =$request->input('fin');
//        $grupo=$request->input('grupo');
//        $cotizacion=Cotizacion::get();
        $proveedores=Proveedor::where('grupo','ENTRANCES')->get();
        return view('admin.contabilidad.lista-entrada-pendiente-guardado-pagado',compact(['cotizacion', 'ini', 'fin','proveedores','liquidacion','opcion','id']));
    }
    public function pagos_pendientes_entradas_pagar(Request $request)
    {
        $liquidacion_id = $request->input('id');
        $opcion = $request->input('tipo_filtro');
        $ini = $request->input('ini');
        $fin = $request->input('fin');
        $total_entrances = $request->input('total_entrances');
        $nro_operacion = $request->input('nro_operacion');
        $guardar = $request->input('guardar');
        $pagar = $request->input('pagar');
        $itinerario_servicio_id = $request->input('itinerario_servicio_id');
        $data=Carbon::now()->subHour(5);
        $mes='00';
        if($data->month<10)
            $mes='0'.$data->month;

        if($liquidacion_id==0) {
            if (isset($guardar)) {
                $nuevaliquidacion = new Liquidacion();
                $nuevaliquidacion->ini = $ini;
                $nuevaliquidacion->fin = $fin;
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
                $liquidacion->estado = '2';
                $liquidacion->save();
                $entradas=ItinerarioServicios::where('liquidacion_id',$liquidacion_id)->get();
                foreach ($entradas as $entradas_){
                    $temp=ItinerarioServicios::Find($entradas_->id);
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

}
