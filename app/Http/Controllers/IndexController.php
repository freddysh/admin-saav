<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Cotizacion;
use App\CotizacionesCliente;
use App\PaqueteCotizaciones;
use App\User;
use Illuminate\Http\Request;
use App\Web;
//use ConsoleTVs\Charts\Facades\Charts;


class IndexController extends Controller
{
    //
    public function index()
    {
        // $user_name=auth()->guard('admin')->user()->name;
        // $user_tipo=auth()->guard('admin')->user()->tipo_user;
        // session()->put('menu', 'ventas');
        // $page='gotoperu.com';
        // if($user_tipo=='ventas')
        //     $cotizacion=Cotizacion::where('users_id',auth()->guard('admin')->user()->id)->where('web', $page)->get();
        // else
        //     $cotizacion=Cotizacion::where('web', $page)->get();
        // $webs=Web::get();
        // return view('admin.index',['cotizacion'=>$cotizacion, 'page'=>$page,'user_name'=>$user_name,'user_tipo'=>$user_tipo,'webs'=>$webs,'hotel_proveedor_id'=>0,'id'=>0,'fecha_ini'=>date("Y-m-d"),'fecha_fin'=>date("Y-m-d")]);

        $anio=date("Y");
        $mes=date("m");
        $page='ejemplo.com';
        $tipo_filtro='close-date';
        return redirect()->route('current_sales_type_page_path',compact(['anio','mes','page','tipo_filtro']));
    }
    public function menu(){
        $user_name=auth()->guard('admin')->user()->name;
        $user_tipo=auth()->guard('admin')->user()->tipo_user;
        session()->put('menu', 'ventas');
        $page='ejemplo.com';
        if($user_tipo=='ventas')
            $cotizacion=Cotizacion::where('users_id',auth()->guard('admin')->user()->id)->where('web', $page)->get();
        else
            $cotizacion=Cotizacion::where('web', $page)->get();

        $webs=Web::get();
        return view('admin.menu',['cotizacion'=>$cotizacion, 'page'=>$page,'user_name'=>$user_name,'user_tipo'=>$user_tipo,'webs'=>$webs]);

    }
    public function inicio()
    {
//        $mes='Septiembre';
//        $chart = Charts::create('percentage', 'justgage')
//            ->title('$68000')
//            ->elementLabel($mes)
//            ->values([25500,0,68000])
//            ->colors(['#7F8429'])
//            ->responsive(true)
//            ->height(250)
//            ->width(0);
//        $chart1 = Charts::create('percentage', 'justgage')
//            ->title('$60000')
//            ->elementLabel($mes)
//            ->values([30500,0,60000])
//            ->colors(['#e09e37'])
//            ->responsive(true)
//            ->height(250)
//            ->width(0);
//        $chart2 = Charts::create('percentage', 'justgage')
//            ->title('$1600')
//            ->elementLabel($mes)
//            ->values([500,0,1600])
//            ->colors(['#3097D1'])
//            ->responsive(true)
//            ->height(250)
//            ->width(0);
//        $chart3 = Charts::create('percentage', 'justgage')
//            ->title('$34000')
//            ->elementLabel($mes)
//            ->values([10500,0,34000])
//            ->colors(['#e91e63'])
//            ->responsive(true)
//            ->height(250)
//            ->width(0);
//
//        $chart4 = Charts::create('percentage', 'justgage')
//            ->title('$38000')
//            ->elementLabel($mes)
//            ->values([30500,0,38000])
//            ->colors(['#ff0000'])
//            ->responsive(true)
//            ->height(250)
//            ->width(0);
//        return view('admin.login',['chart' => $chart,'chart1' => $chart1,'chart2' => $chart2,'chart3' => $chart3,'chart4' => $chart4]);
        return view('admin.login');
    }
    public function ventas()
    {
//        $mes='Septiembre';
//        $chart = Charts::create('percentage', 'justgage')
//            ->title('$68000')
//            ->elementLabel($mes)
//            ->values([25500,0,68000])
//            ->colors(['#7F8429'])
//            ->responsive(true)
//            ->height(250)
//            ->width(0);
//        $chart1 = Charts::create('percentage', 'justgage')
//            ->title('$60000')
//            ->elementLabel($mes)
//            ->values([30500,0,60000])
//            ->colors(['#e09e37'])
//            ->responsive(true)
//            ->height(250)
//            ->width(0);
//        $chart2 = Charts::create('percentage', 'justgage')
//            ->title('$1600')
//            ->elementLabel($mes)
//            ->values([500,0,1600])
//            ->colors(['#3097D1'])
//            ->responsive(true)
//            ->height(250)
//            ->width(0);
//        $chart3 = Charts::create('percentage', 'justgage')
//            ->title('$34000')
//            ->elementLabel($mes)
//            ->values([10500,0,34000])
//            ->colors(['#e91e63'])
//            ->responsive(true)
//            ->height(250)
//            ->width(0);
//
//        $chart4 = Charts::create('percentage', 'justgage')
//            ->title('$38000')
//            ->elementLabel($mes)
//            ->values([30500,0,38000])
//            ->colors(['#ff0000'])
//            ->responsive(true)
//            ->height(250)
//            ->width(0);
//        return view('admin.ventas',['chart' => $chart,'chart1' => $chart1,'chart2' => $chart2,'chart3' => $chart3,'chart4' => $chart4]);
        return view('admin.ventas');

    }
    public function ventas_now(Request $request)
    {
//        $fecha=date("Y-m-d");
//        $cotizacion=Cotizacion::where('fecha_venta',$fecha)->get();
//        dd($cotizacion);
        $opcion=$request->input('opcion');
        $ventas=0;
//        dd($opcion);
        if($opcion=='Lista'){
            $opcion2=$request->input('lista');
            if($opcion2=='1') {//-- hoy dia
                $fecha = date("Y-m-d");
                $cotizacion_ = Cotizacion::with('paquete_cotizaciones')->where('fecha_venta', $fecha)->get();
//                dd($cotizacion_);
//                foreach ($cotizacion_ as $cotizacion1){
//                    $cotizacion = $cotizacion1;
//                }
//                dd($cotizacion);
                $sumatotal_v=0;
                $sumatotal_v_r=0;
                foreach ($cotizacion_ as $cotizacion) {
                    foreach ($cotizacion->paquete_cotizaciones as $paquete) {
                        if ($paquete->estado == 2) {
                            foreach ($paquete->itinerario_cotizaciones as $itinerario) {
                                foreach ($itinerario->itinerario_servicios as $servicios) {

                                    if ($servicios->precio_grupo == 1) {
                                        $sumatotal_v += $servicios->precio;
                                    } else {
                                        $sumatotal_v += $servicios->precio * $cotizacion->nropersonas;
                                    }
                                }
                                foreach ($itinerario->hotel as $hotel) {
                                    $total = 0;
                                    $total_book = 0;
                                    $cadena_total = '';
                                    $cadena_total_book = '';
                                    if ($hotel->personas_s > 0) {
                                        $total += $hotel->personas_s * $hotel->precio_s;
                                        $total_book += $hotel->personas_s * $hotel->precio_s_r;
                                        $sumatotal_v += $hotel->personas_s * $hotel->precio_s;
                                    }

                                    if ($hotel->personas_d > 0) {
                                        $total += $hotel->personas_d * $hotel->precio_d;
                                        $total_book += $hotel->personas_d * $hotel->precio_d_r;
                                        $sumatotal_v += $hotel->personas_d * $hotel->precio_d;
                                    }

                                    if ($hotel->personas_m > 0) {
                                        $total += $hotel->personas_m * $hotel->precio_m;
                                        $total_book += $hotel->personas_m * $hotel->precio_m_r;
                                        $sumatotal_v += $hotel->personas_m * $hotel->precio_m;
                                    }
                                    if ($hotel->personas_t > 0) {
                                        $total += $hotel->personas_t * $hotel->precio_t;
                                        $total_book += $hotel->personas_t * $hotel->precio_t_r;
                                        $sumatotal_v += $hotel->personas_t * $hotel->precio_t;
                                    }
                                    $sumatotal_v_r += $total_book;
                                }
                            }
                        }
                    }
                }
                $ventas=$sumatotal_v;
            }
            if($opcion2=='2'){

            }
            if($opcion2=='3'){

            }
            if($opcion2=='4'){

            }
            if($opcion2=='5'){

            }
            if($opcion2=='6'){

            }
        }
        elseif($opcion=='Custon'){

        }

//        $cotizacion=Cotizacion::get();
//        $productos=M_Producto::get();
//        $proveedores=Proveedor::get();
//        $hotel_proveedor=HotelProveedor::get();





//        $mes='Septiembre';
//        $chart = Charts::create('percentage', 'justgage')
//            ->title('$68000')
//            ->elementLabel($mes)
//            ->values([$ventas,0,68000])
//            ->colors(['#7F8429'])
//            ->responsive(true)
//            ->height(250)
//            ->width(0);
//        $chart1 = Charts::create('percentage', 'justgage')
//            ->title('$60000')
//            ->elementLabel($mes)
//            ->values([30500,0,60000])
//            ->colors(['#e09e37'])
//            ->responsive(true)
//            ->height(250)
//            ->width(0);
//        $chart2 = Charts::create('percentage', 'justgage')
//            ->title('$1600')
//            ->elementLabel($mes)
//            ->values([500,0,1600])
//            ->colors(['#3097D1'])
//            ->responsive(true)
//            ->height(250)
//            ->width(0);
//        $chart3 = Charts::create('percentage', 'justgage')
//            ->title('$34000')
//            ->elementLabel($mes)
//            ->values([10500,0,34000])
//            ->colors(['#e91e63'])
//            ->responsive(true)
//            ->height(250)
//            ->width(0);
//
//        $chart4 = Charts::create('percentage', 'justgage')
//            ->title('$38000')
//            ->elementLabel($mes)
//            ->values([30500,0,38000])
//            ->colors(['#ff0000'])
//            ->responsive(true)
//            ->height(250)
//            ->width(0);
//        return view('admin.ventas',['chart' => $chart,'chart1' => $chart1,'chart2' => $chart2,'chart3' => $chart3,'chart4' => $chart4]);
        return view('admin.ventas');

    }
    public function logeo(Request $request){
        $txt_codigo=$request->input('txt_codigo');
        $txt_password=$request->input('txt_password');



        return view('admin.book.services',['cotizacion'=>$cotizacion,'productos'=>$productos,'proveedores'=>$proveedores,'hotel_proveedor'=>$hotel_proveedor]);

    }
    public function contabilidad(){
        $cotizacion=Cotizacion::where('confirmado_r','ok')->get();
        return view('admin.contabilidad.index1',['cotizacion'=>$cotizacion]);
    }
    public function reservas(){
        $paquete_cotizacion = PaqueteCotizaciones::where('estado', 2)->get();
        $cot_cliente = CotizacionesCliente::with('cliente')->where('estado', 1)->get();
        $cliente = Cliente::get();
        $cotizacion_cat=Cotizacion::where('estado',2)
            ->whereBetween('categorizado',['C','S'])->get();
        session()->put('menu', 'ventas');
        return view('admin.book.book1', ['paquete_cotizacion'=>$paquete_cotizacion, 'cot_cliente'=>$cot_cliente, 'cliente'=>$cliente,'cotizacion_cat'=>$cotizacion_cat]);
    }


    public function crear(Request $request){
        return view('admin.crear-usuario');

    }
    public function crearp(Request $request){
        $txt_name=$request->input('txt_name');
        $email=$request->input('txt_codigo');
        $contrasena=$request->input('txt_password');
        $tipo=$request->input('tipo');

        $user=new User();
        $user->name=$txt_name;
        $user->email=$email;
        $user->tipo_user=$tipo;
        $user->password=bcrypt($contrasena);
        $user->save();
        return view('admin.crear-usuario');

    }

    public function inventory(){
        return view('admin.inventory');
    }
    public function atras(){
        return redirect()->back();
    }
}
