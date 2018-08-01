@php
function fechaPeru($fecha){
$fecha=explode('-',$fecha);
return $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
}
@endphp
@extends('layouts.admin.contabilidad')
@section('content')
    <div class="row margin-top-5">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Contabilidad</li>
            <li class="active">Reservas confirmadas</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            @php
                                $nroPersonas=0;
                            @endphp
                            @foreach($cotizacion as $cotizaciones)
                                @php
                                    $nroPersonas=$cotizaciones->nropersonas;
                                @endphp
                                @foreach($cotizaciones->cotizaciones_cliente as $clientes)
                                    <h2 class="panel-title pull-left" style="font-size:30px;">{{$clientes->cliente->nombres}} {{$clientes->cliente->apellidos}} x {{$cotizaciones->nropersonas}} {{date_format(date_create($cotizaciones->fecha), ' l jS F Y')}}</h2>
                                    <b class="text-warning padding-left-10"> (X{{$cotizaciones->nropersonas}})</b>
                                @endforeach
                            @endforeach

                            <i class="fa fa-check text-success" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Hidalgo esta activo"></i>
                            <div class="hide dropdown pull-right">
                                <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Opciones
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <li><a href="?page=update"><i class="fa fa-fw fa-database" aria-hidden="true"></i> Actualizar Datos</a></li>
                                    <li><a href="#"><i class="fa fa-fw fa-check" aria-hidden="true"></i> Friends</a></li>
                                    <li><a href="#">Work</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#"><i class="fa fa-fw fa-plus" aria-hidden="true"></i> Add a new aspect</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class=" hide col-md-12 margin-top-20">
                            <div class="progress">

                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                    Datos del pasajero 60%
                                </div>
                            </div>
                        </div>

                        <div class="hide col-md-12">
                            <span class="pull-left pax-nav">
                                <b>Travel date: no se</b>
                            </span>
                            <span class="pull-right">
                                 <a href="#" class="btn btn-link" style="text-decoration:none;"><i class="fa fa-lg fa-ban" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Ignore"></i></a>
                            </span>
                        </div>


                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-left col-lg-6">
                        <span class="display-block margin-bottom-10">
                            <a href="{{route('contabilidad_resumen_back_path',$idcotizacion)}}" class="btn btn-info"><i class="fa fa-arrow-circle-left fa-2x"></i>
                            </a>
                        </span>
                    </div>
                    <div class="text-right col-lg-6">
                        <span class="display-block margin-bottom-10">
                            <button class="btn btn-danger"><i class="fa fa-file-pdf-o"></i>
                            </button>
                            <button class="btn btn-info"><i class="fa fa-send"></i>
                            </button>
                        </span>
                    </div>
                    <hr>


                    <div class="col-lg-12">
                        <section class="detalle-pagos">
                            <div class="col-lg-12 titulo-goto clearfix">
                                <h4 class="text-right titulo"><b>GOTOPERU</b></h4>
                            </div>
                            <div class="col-lg-12">
                                <h4 class="text-center titulo"><b>DETALLE DE PAGO</b></h4>
                            </div>
                            <div class="col-lg-12">
                                <div class="codigo">
                                    <b>GOTOID</b>
                                    005
                                    <div class="fecha pull-right"><b><?php echo date("Y-m-d h:i") ?></b></div>
                                </div>
                                <hr>
                            </div>
                            <div class="col-lg-6">
                                <div class="nombres"><b>PROVEEDOR:</b> {{$proveedor->nombre}}</div>
                                <div class="nombres"><b>RUC:</b> {{$proveedor->codigo}}</div>
                                <div class="nacionalidad"><b>DIRECCION:</b> {{$proveedor->razon_social}}</div>
                            </div>
                            <div class="col-lg-6">
                                <table class="table table-hover table-responsive table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Servicio</th>
                                        <th>Fecha de servicio</th>
                                        <th>Costo</th>
                                    </tr>
                                    <tbody>
                                    @foreach($itinerario_cotizaciones as $itinerario_cotizacion)
                                        @foreach($itinerario_cotizacion->hotel->where('proveedor_id',$proveedor->id) as $hotel)
                                            <tr>
                                                <td>
                                                    @if($hotel->personas_s>0)
                                                        <p>Single room</p>
                                                    @endif
                                                    @if($hotel->personas_d>0)
                                                            <p>Double room</p>
                                                    @endif
                                                    @if($hotel->personas_m>0)
                                                            <p>Matrimonial room</p>
                                                    @endif
                                                    @if($hotel->personas_t>0)
                                                            <p>Triple room</p>
                                                    @endif
                                                </td>
                                                <td>{{fechaPeru($itinerario_cotizacion->fecha)}}</td>
                                                <td>
                                                    @if($hotel->personas_s>0)
                                                        <p><b>${{$hotel->personas_s*$hotel->precio_s_r}}</b></p>
                                                    @endif
                                                    @if($hotel->personas_d>0)
                                                        <p><b>${{$hotel->personas_d*$hotel->precio_d_r}}</b></p>
                                                    @endif
                                                    @if($hotel->personas_m>0)
                                                        <p><b>${{$hotel->personas_m*$hotel->precio_m_r}}</b></p>
                                                    @endif
                                                    @if($hotel->personas_t>0)
                                                        <p><b>${{$hotel->personas_t*$hotel->precio_t_r}}</b></p>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                    <tr>
                                        <td colspan="2"><b>TOTAL</b></td>
                                        <td>$
                                            @if(count($total)>0)
                                                @foreach($total as $total_)
                                                    <b>{{$total_->a_cuenta}}</b>
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                    </tbody>
                                    </thead>
                                </table>
                            </div>

                            <div class="col-lg-12 margin-top-10">
                                {{--<button class="btn btn-warning btn-sm">Pagar</button> <button class="btn btn-warning btn-sm"></button>--}}
                                <table class="table table-striped table-bordered table-hover table-condensed">
                                    {{--<caption>Detalle de pagos realizados und = unidad, Cod: codigo del paquete, Precio = precio total del paquete, Total = Pagos realizados por el cliente</caption>--}}
                                    <thead>
                                    <tr>
                                        <th>Concepto</th>
                                        <th>Medio Pago</th>
                                        <th>Transaccion</th>
                                        <th>Fecha Pago</th>
                                        <th>A cuenta</th>
                                        <th>Operaciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($pagos)>0)
                                        @foreach($pagos as $pago)
                                            @if($pago->estado == 1)
                                                <tr>
                                                    <td>{{ucwords(strtolower('Servicio'))}}</td>
                                                    <td>{{$pago->medio}}</td>
                                                    <td>{{$pago->transaccion}}</td>
                                                    <td>{{$pago->fecha_a_pagar}}</td>
                                                    <td class='text-right'>
                                                        {{$pago->a_cuenta}}
                                                    </td>
                                                    <td class="text-center">
                                                        <i class="fa fa-check text-primary"></i>
                                                    </td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td>{{ucwords(strtolower('Servicio'))}}</td>
                                                    <td><input class="form-control" type="text" id="medio_1"></td>
                                                    <td><input class="form-control" type="text" id="transaccion_1"></td>
                                                    <td><input class="form-control" type="date" id="fecha_a_pagar_1" value="{{$pago->fecha_a_pagar}}" readonly="readonly"></td>
                                                    <td class='text-right'>
                                                        <input  class="form-control" type="text" id="a_cuenta_1" value="{{$pago->a_cuenta}}">
                                                    </td>
                                                    <td class="text-center">
                                                        <button id="btn_pagar_1" class="btn btn-sm btn-warning display-block" onclick="pagar_servicio_1('1',{{$pago->id}},{{$pago->paquete_cotizaciones_id}},{{$pago->proveedor_id}},$('#medio_1').val(),$('#transaccion_1').val(),$('#a_cuenta_1').val(),{{$pago->a_cuenta}},$('#fecha_a_pagar_1').val(),'{{$pago->grupo}}')"><i>Pagar</i></button>
                                                        <i class="fa fa-check text-primary hide" id="btn_check_1"></i>
                                                        <i class="fa fa-spinner fa-pulse text-18 fa-fw hide" id="btn_load_1"></i>
                                                    </td>
                                                </tr>
                                                <tr class="hide" id="caja_resto_1">
                                                    <td>{{ucwords(strtolower('Servicio'))}}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><input class="form-control" type="date" id="fecha_a_pagar_resto_1" value="{{date("Y-m-d")}}"></td>
                                                    <td class='text-right'>
                                                        <input  class="form-control" type="text" id="a_cuenta_resto_1" value="0">
                                                    </td>
                                                    <td class="text-center">
                                                        <button id="btn_guardar_resto_1" class="btn btn-sm btn-warning display-block" onclick="guardar_servicio('1',0,{{$pago->paquete_cotizaciones_id}},{{$pago->proveedor_id}},'','',$('#a_cuenta_resto_1').val(),{{$pago->a_cuenta}},$('#fecha_a_pagar_resto_1').val(),'{{$pago->grupo}}')"><i>Guardar</i></button>
                                                        <i class="fa fa-check text-primary hide" id="btn_check_resto_1"></i>
                                                        <i class="fa fa-spinner fa-pulse text-18 fa-fw hide" id="btn_load_resto_1"></i>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @else
                                        @if(count($total)>0)
                                            @foreach($total as $total_)
                                                    <tr>
                                                        <td>{{ucwords(strtolower('Servicio'))}}</td>
                                                        <td><input class="form-control" type="text" id="medio_0"></td>
                                                        <td><input class="form-control" type="text" id="transaccion_0"></td>
                                                        <td><input class="form-control" type="date" id="fecha_a_pagar_0" value="{{$total_->fecha_a_pagar}}" readonly="readonly"></td>
                                                        <td class='text-right'>
                                                            <input  class="form-control" type="text" id="a_cuenta_0" value="{{$total_->a_cuenta}}">
                                                        </td>
                                                        <td class="text-center">
                                                            <button id="btn_pagar_0" class="btn btn-sm btn-warning display-block" onclick="pagar_servicio('0',0,{{$total_->paquete_cotizaciones_id}},{{$total_->proveedor_id}},$('#medio_0').val(),$('#transaccion_0').val(),$('#a_cuenta_0').val(),{{$total_->a_cuenta}},$('#fecha_a_pagar_0').val(),'{{$total_->grupo}}')"><i>Pagar</i></button>
                                                            <i class="fa fa-check text-primary hide" id="btn_check_0"></i>
                                                            <i class="fa fa-spinner fa-pulse text-18 fa-fw hide" id="btn_load_0"></i>
                                                        </td>
                                                    </tr>
                                                    <tr class="hide" id="caja_resto_0">
                                                        <td>{{ucwords(strtolower('Servicio'))}}</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td><input class="form-control" type="date" id="fecha_a_pagar_resto_0" value="{{date("Y-m-d")}}"></td>
                                                        <td class='text-right'>
                                                            <input  class="form-control" type="text" id="a_cuenta_resto_0" value="0">
                                                        </td>
                                                        <td class="text-center">
                                                            <button id="btn_guardar_resto_0" class="btn btn-sm btn-warning display-block" onclick="guardar_servicio('0',0,{{$total_->paquete_cotizaciones_id}},{{$total_->proveedor_id}},'','',$('#a_cuenta_resto_0').val(),{{$total_->a_cuenta}},$('#fecha_a_pagar_resto_0').val(),'{{$total_->grupo}}')"><i>Guardar</i></button>
                                                            <i class="fa fa-check text-primary hide" id="btn_check_resto_0"></i>
                                                            <i class="fa fa-spinner fa-pulse text-18 fa-fw hide" id="btn_load_resto_0"></i>
                                                        </td>
                                                    </tr>
                                            @endforeach
                                        @endif
                                    @endif
                                    {{--@foreach($servicio as $servicios)--}}
                                        {{--@if($servicios->pagos->count()>0)--}}
                                            {{--@foreach($servicios->pagos as $pagos)--}}
                                                {{--@php--}}
                                                    {{--$total = $total + $pagos->a_cuenta--}}

                                                {{--@endphp--}}


                                                {{--@if($pagos->estado == 1)--}}
                                                    {{--<tr>--}}
                                                        {{--<td>0545</td>--}}
                                                        {{--<td>1</td>--}}
                                                        {{--<td>{{ucwords(strtolower($servicios->nombre))}}</td>--}}
                                                        {{--<td>{{$pagos->medio}}</td>--}}
                                                        {{--<td>{{$pagos->transaccion}}</td>--}}
                                                        {{--<td>{{$pagos->updated_at}}</td>--}}
                                                        {{--<td class='text-right'>{{$pagos->a_cuenta}}</td>--}}
                                                        {{--<td class="text-center"><i class="fa fa-check text-primary"></i></td>--}}
                                                    {{--</tr>--}}
                                                {{--@elseif($pagos->estado == 0 AND ($pagos->fecha_a_pagar=="" OR $pagos->fecha_a_pagar==NULL))--}}
                                                    {{--<tr>--}}
                                                        {{--<td>{{ucwords(strtolower($servicios->nombre))}}</td>--}}
                                                        {{--<td>{{$pagos->medio}}</td>--}}
                                                        {{--<td>{{$pagos->transaccion}}</td>--}}
                                                        {{--<td>{{$pagos->updated_at}}</td>--}}
                                                        {{--<td class="has-error"><input type="date" class="form-control input-sm"></td>--}}
                                                        {{--<td><input type="text" class="form-control input-sm text-right" value="{{$servicios->precio_c - $total}}"></td>--}}
                                                        {{--<td class="text-center"><button class="btn btn-sm btn-warning display-block"><i>Save</i></button></td>--}}
                                                    {{--</tr>--}}
                                                {{--@elseif($pagos->estado == 0 AND isset($pagos->fecha_a_pagar))--}}
                                                    {{--<tr>--}}
                                                        {{--<td>{{ucwords(strtolower($servicios->nombre))}}</td>--}}
                                                        {{--<td><input type="text" class="form-control input-sm" id="p_medio"></td>--}}
                                                        {{--<td><input type="text" class="form-control input-sm" id="p_transaccion"></td>--}}
                                                        {{--<td><input type="date" class="form-control input-sm text-right" value="{{$pagos->fecha_a_pagar}}" id="p_fecha"></td>--}}
                                                        {{--<td><input type="text" class="form-control input-sm text-right" value="{{$pagos->a_cuenta}}" id="p_pago" onkeyup="fecha_pago($('#p_pago').val(), {{$servicios->precio_c}}, {{$pagos->a_cuenta}})"></td>--}}
                                                        {{--<td class="text-center">--}}
                                                            {{--<button class="btn btn-sm btn-success display-block" id="btn_pago" onclick="pagar_proveedor({{$servicios->id}},{{$idcotizacion}},$('#p_medio').val(), $('#p_transaccion').val(), $('#p_fecha').val(), $('#p_pago').val(), {{$servicios->precio_c}},{{$total}}, {{$pagos->id}}, {{$pagos->a_cuenta}})"><i>Pagar</i></button>--}}
                                                            {{--<i class="fa fa-check text-primary hide" id="f_check"></i>--}}
                                                            {{--<i class="fa fa-spinner fa-pulse text-18 fa-fw hide" id="btn_load"></i>--}}
                                                            {{--<span class="sr-only">Loading...</span>--}}
                                                        {{--</td>--}}
                                                    {{--</tr>--}}

                                                    {{--<tr class="hide" id="i_save">--}}
                                                        {{--<td>{{ucwords(strtolower($servicios->nombre))}}</td>--}}
                                                        {{--<td></td>--}}
                                                        {{--<td></td>--}}
                                                        {{--<td class="has-error"><input type="date" class="form-control input-sm text-right" id="f_date"></td>--}}
                                                        {{--<td><input type="text" class="form-control input-sm text-right" id="f_pago" value="0" readonly="readonly"></td>--}}
                                                        {{--<td class="text-center">--}}
                                                            {{--<button class="btn btn-sm btn-warning display-block" id="f_btnpago" onclick="pagar_acuenta({{$servicios->id}},{{$idcotizacion}},$('#f_pago').val(),$('#f_date').val())"><i>Save</i></button>--}}

                                                            {{--<i class="fa fa-check text-primary hide" id="f_btncheck"></i>--}}
                                                            {{--<i class="fa fa-spinner fa-pulse text-18 fa-fw hide" id="f_btnload"></i>--}}
                                                            {{--<span class="sr-only">Loading...</span>--}}

                                                        {{--</td>--}}
                                                    {{--</tr>--}}

                                                    {{--<tr>--}}
                                                        {{--<td colspan="3"></td>--}}
                                                        {{--<td class="list-style-none">--}}
                                                            {{--<li><b>TOTAL</b></li>--}}
                                                            {{--<li><b>PRECIO SERVICIO</b></li>--}}
                                                            {{--<li><b>TOTAL DEUDA</b></li>--}}
                                                        {{--</td>--}}
                                                        {{--<td class='text-right list-style-none'>--}}

                                                            {{--<li><b>{{$total}}</b></li>--}}
                                                            {{--<li>{{$servicios->precio_c}}</li>--}}
                                                            {{--<li><b id="f_deuda">{{$pagos->a_cuenta}}</b></li>--}}
                                                        {{--</td>--}}
                                                    {{--</tr>--}}

                                                {{--@endif--}}

                                            {{--@endforeach--}}
                                        {{--@else--}}
                                            {{--<tr>--}}
                                                {{--<td>{{ucwords(strtolower($servicios->nombre))}}</td>--}}
                                                {{--<td><input type="text" class="form-control input-sm" id="p_medio"></td>--}}
                                                {{--<td><input type="text" class="form-control input-sm" id="p_transaccion"></td>--}}
                                                {{--<td><input type="date" class="form-control input-sm text-right" id="p_fecha"></td>--}}
                                                {{--<td><input type="text" class="form-control input-sm text-right" id="p_pago" value="{{$servicios->precio_c}}" onkeyup="fecha_pago($('#p_pago').val(), {{$servicios->precio_c}}, {{$total}})"></td>--}}
                                                {{--<td class="text-center">--}}
                                                    {{--<button class="btn btn-sm btn-success display-block" id="btn_pago" onclick="pagar_proveedor({{$servicios->id}},{{$idcotizacion}},$('#p_medio').val(), $('#p_transaccion').val(), $('#p_fecha').val(), $('#p_pago').val(), {{$servicios->precio_c}}, {{$total}}, 0, 0)"><i>Pagar</i></button>--}}
                                                    {{--<i class="fa fa-check text-primary hide" id="f_check"></i>--}}
                                                    {{--<i class="fa fa-spinner fa-pulse text-18 fa-fw hide" id="btn_load"></i>--}}
                                                    {{--<span class="sr-only">Loading...</span>--}}
                                                {{--</td>--}}
                                            {{--</tr>--}}

                                            {{--<tr class="hide" id="i_save">--}}
                                                {{--<td>{{ucwords(strtolower($servicios->nombre))}}</td>--}}
                                                {{--<td></td>--}}
                                                {{--<td></td>--}}
                                                {{--<td class="has-error"><input type="date" class="form-control input-sm text-right" id="f_date"></td>--}}
                                                {{--<td><input type="text" class="form-control input-sm text-right" id="f_pago" value="0" readonly="readonly"></td>--}}
                                                {{--<td class="text-center">--}}
                                                    {{--<button class="btn btn-sm btn-warning display-block" id="f_btnpago" onclick="pagar_acuenta({{$servicios->id}},{{$idcotizacion}},$('#f_pago').val(),$('#f_date').val())"><i>Save</i></button>--}}

                                                    {{--<i class="fa fa-check text-primary hide" id="f_btncheck"></i>--}}
                                                    {{--<i class="fa fa-spinner fa-pulse text-18 fa-fw hide" id="f_btnload"></i>--}}
                                                    {{--<span class="sr-only">Loading...</span>--}}

                                                {{--</td>--}}
                                            {{--</tr>--}}

                                            {{--<tr>--}}
                                                {{--<td colspan="3"></td>--}}
                                                {{--<td class="list-style-none">--}}
                                                    {{--<li><b>TOTAL</b></li>--}}
                                                    {{--<li><b>PRECIO SERVICIO</b></li>--}}
                                                    {{--<li><b>TOTAL DEUDA</b></li>--}}
                                                {{--</td>--}}
                                                {{--<td class='text-right list-style-none'>--}}

                                                    {{--<li><b>{{$total}}</b></li>--}}
                                                    {{--<li>{{$servicios->precio_c}}</li>--}}
                                                    {{--<li><b id="f_deuda">{{$servicios->precio_c-$total}}</b></li>--}}
                                                {{--</td>--}}
                                            {{--</tr>--}}

                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                    {{csrf_field()}}
                                    </tbody>
                                </table>
                            </div>
                            <div class="footer col-lg-12 clearfix">
                                <a href="">&copy; http://gotoperu.com/</a>
                            </div>
                        </section>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <script>
        function pagar_servicio(flag,iti_serv_acum_pago_id,paquete_cotizaciones_id,proveedor_id,medio,transaccion,a_cuenta,total,fecha_a_pagar_resto,grupo){
            console.log('iti_serv_acum_pago_id:'+iti_serv_acum_pago_id+',paquete_cotizaciones_id:'+paquete_cotizaciones_id+',proveedor_id:'+proveedor_id+',medio:'+medio+',transaccion:'+transaccion+',a_cuenta:'+a_cuenta+',total:'+total+',fecha_a_pagar_resto:'+fecha_a_pagar_resto+',grupo:'+grupo);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('[name="_token"]').val()
                }
            });
            //-- se realiza el pago total
            if(a_cuenta==total){
                var datos = {
                    "id" : iti_serv_acum_pago_id,
                    "paquete_cotizaciones_id" : paquete_cotizaciones_id,
                    "proveedor_id" : proveedor_id,
                    "a_cuenta" : a_cuenta,
                    "medio" : medio,
                    "transaccion" : transaccion,
                    "estado" : 1,
                    "fecha_a_pagar" : fecha_a_pagar_resto,
                    "grupo" : grupo
                };
                $.ajax({
                    data:  datos,
                    url:   "{{route('pagar_a_cuenta_hotel_path')}}",
                    type:  'post',

                    beforeSend: function () {
                        $('#btn_pagar_'+flag).addClass('hide');
                        $('#btn_load_'+flag).removeClass('hide');
                    },
                    success:  function (response) {
                        $('#btn_check_'+flag).removeClass('hide');
                        $('#btn_load_'+flag).addClass('hide');
                    }
                });
            }
            else if(a_cuenta<total){

                $('#a_cuenta_resto_'+flag).val(total-a_cuenta);
                $('#caja_resto_'+flag).removeClass('hide');
                $('#a_cuenta_'+flag).prop('readonly', true);
                $('#medio_'+flag).prop('readonly', true);
                $('#transaccion_'+flag).prop('readonly', true);
                $('#a_cuenta_resto_'+flag).prop('readonly', true);
                var datos = {
                    "id" : iti_serv_acum_pago_id,
                    "paquete_cotizaciones_id" : paquete_cotizaciones_id,
                    "proveedor_id" : proveedor_id,
                    "a_cuenta" : a_cuenta,
                    "medio" : medio,
                    "transaccion" : transaccion,
                    "estado" : 1,
                    "fecha_a_pagar" : fecha_a_pagar_resto,
                    "grupo" : grupo
                };
                $.ajax({
                    data:  datos,
                    url:   "{{route('pagar_a_cuenta_hotel_path')}}",
                    type:  'post',

                    beforeSend: function () {
                        $('#btn_pagar_'+flag).addClass('hide');
                        $('#btn_load_'+flag).removeClass('hide');
                    },
                    success:  function (response) {
                        $('#btn_check_'+flag).removeClass('hide');
                        $('#btn_load_'+flag).addClass('hide');
                    }
                });

            }
        }
        function guardar_servicio(flag,iti_serv_acum_pago_id,paquete_cotizaciones_id,proveedor_id,medio,transaccion,a_cuenta,total,fecha_a_pagar_resto,grupo){
            console.log('iti_serv_acum_pago_id:'+iti_serv_acum_pago_id+',paquete_cotizaciones_id:'+paquete_cotizaciones_id+',proveedor_id:'+proveedor_id+',medio:'+medio+',transaccion:'+transaccion+',a_cuenta:'+a_cuenta+',total:'+total+',fecha_a_pagar_resto:'+fecha_a_pagar_resto+',grupo:'+grupo);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('[name="_token"]').val()
                }
            });
            //-- se realiza el guardado del pago restante

                var datos = {
                "id" : iti_serv_acum_pago_id,
                "a_cuenta" : a_cuenta,
                "paquete_cotizaciones_id" : paquete_cotizaciones_id,
                "proveedor_id" : proveedor_id,
                "estado" : 0,
                "fecha_a_pagar" : fecha_a_pagar_resto,
                "grupo" : grupo
                };
                $.ajax({
                    data:  datos,
                    url:   "{{route('pagar_a_cuenta_hotel_path')}}",
                    type:  'post',
                    beforeSend: function () {
                        $('#btn_guardar_resto_'+flag).addClass('hide');
                        $('#btn_load_resto_'+flag).removeClass('hide');
                    },
                    success:  function (response) {
                        $('#btn_load_resto_'+flag).addClass('hide');
                        $('#btn_check_resto_'+flag).removeClass('hide');
                    }
                });

        }

        function pagar_servicio_1(flag,iti_serv_acum_pago_id,paquete_cotizaciones_id,proveedor_id,medio,transaccion,a_cuenta,total,fecha_a_pagar_resto,grupo){
            console.log('iti_serv_acum_pago_id:'+iti_serv_acum_pago_id+',paquete_cotizaciones_id:'+paquete_cotizaciones_id+',proveedor_id:'+proveedor_id+',medio:'+medio+',transaccion:'+transaccion+',a_cuenta:'+a_cuenta+',total:'+total+',fecha_a_pagar_resto:'+fecha_a_pagar_resto+',grupo:'+grupo);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('[name="_token"]').val()
                }
            });
            //-- se realiza el pago total
            if(a_cuenta==total){
                var datos = {
                    "id" : iti_serv_acum_pago_id,
                    "paquete_cotizaciones_id" : paquete_cotizaciones_id,
                    "proveedor_id" : proveedor_id,
                    "a_cuenta" : a_cuenta,
                    "medio" : medio,
                    "transaccion" : transaccion,
                    "estado" : 1,
                    "fecha_a_pagar" : fecha_a_pagar_resto,
                    "grupo" : grupo
                };
                $.ajax({
                    data:  datos,
                    url:   "{{route('pagar_a_cuenta_hotel_1_path')}}",
                    type:  'post',

                    beforeSend: function () {
                        $('#btn_pagar_'+flag).addClass('hide');
                        $('#btn_load_'+flag).removeClass('hide');
                    },
                    success:  function (response) {
                        $('#btn_check_'+flag).removeClass('hide');
                        $('#btn_load_'+flag).addClass('hide');
                    }
                });
            }
            else if(a_cuenta<total){

                $('#a_cuenta_resto_'+flag).val(total-a_cuenta);
                $('#caja_resto_'+flag).removeClass('hide');
                $('#a_cuenta_'+flag).prop('readonly', true);
                $('#medio_'+flag).prop('readonly', true);
                $('#transaccion_'+flag).prop('readonly', true);
                $('#a_cuenta_resto_'+flag).prop('readonly', true);
                var datos = {
                    "id" : iti_serv_acum_pago_id,
                    "paquete_cotizaciones_id" : paquete_cotizaciones_id,
                    "proveedor_id" : proveedor_id,
                    "a_cuenta" : a_cuenta,
                    "medio" : medio,
                    "transaccion" : transaccion,
                    "estado" : 1,
                    "fecha_a_pagar" : fecha_a_pagar_resto,
                    "grupo" : grupo
                };
                $.ajax({
                    data:  datos,
                    url:   "{{route('pagar_a_cuenta_hotel_1_path')}}",
                    type:  'post',

                    beforeSend: function () {
                        $('#btn_pagar_'+flag).addClass('hide');
                        $('#btn_load_'+flag).removeClass('hide');
                    },
                    success:  function (response) {
                        $('#btn_check_'+flag).removeClass('hide');
                        $('#btn_load_'+flag).addClass('hide');
                    }
                });

            }
        }








        function fecha_pago(pago, p_conta, total) {
            var precio = parseFloat(p_conta);
            var pago = parseFloat(pago);
            var total = parseFloat(total);
            var total1 = (precio - pago) - total;
            var total2 = total - pago;
            // alert(total);
            if(total == 0){
                if(pago <= precio){
                    document.getElementById('f_pago').value  = total1;
                    document.getElementById('f_deuda').innerHTML   = total1;
                    $('#p_pago').css("border-bottom", "");
                }else{
                    $('#p_pago').css("border-bottom", "2px solid #FF0000");
                }
            }else{
                if(pago <= precio){
                    document.getElementById('f_pago').value  = total2;
                    document.getElementById('f_deuda').innerHTML   = total2;
                    $('#p_pago').css("border-bottom", "");
                }else{
                    $('#p_pago').css("border-bottom", "2px solid #FF0000");
                }
            }
        }
        function pagar_acuenta(id, idcot, pago, fecha){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('[name="_token"]').val()
                }
            });

            $("#f_btnpago").attr("disabled", true);

            if (fecha.length == 0 ){
                $('#f_date').css("border-bottom", "2px solid #FF0000");
                var sendPay = "false";
            }else{
                sendPay = "true"
            }

            if(sendPay == "true"){
                var datos = {
                    "txt_id" : id,
                    "txt_idcot" : idcot,
                    "txt_fecha" : fecha,
                    "txt_pago" : pago
                };
                $.ajax({
                    data:  datos,
                    url:   "{{route('pay_a_cuenta_path')}}",
                    type:  'post',

                    beforeSend: function () {
                        $('#f_btnpago').addClass('hide');
                        $('#f_btnload').removeClass('hide');
                    },
                    success:  function (response) {
                        // $('#d_form')[0].reset();
                        $('#f_btncheck').removeClass('hide')
                        $('#f_btnload').addClass('hide');
                        // $('#i_save').removeClass('hide')
                    }
                });
            } else{
                $("#btn_pago").removeAttr("disabled");
            }

        }
        function pagar_proveedor(id, idcot, medio, transaccion, fecha, pago, p_conta, total, idpago, acuenta){
            var c_total = parseFloat(total);
            var c_conta = parseFloat(p_conta);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('[name="_token"]').val()
                }
            });
            $("#btn_pago").attr("disabled", true);


            if (fecha.length == 0 ){
                $('#p_fecha').css("border-bottom", "2px solid #FF0000");
                var sendPay = "false";
            }else{
                sendPay = "true"
            }
            // if (pago.length == 0 ){
            //     $('#p_pago').css("border-bottom", "2px solid #FF0000");
            //     var sendPay = "false";
            // }else{
            //     sendPay = "true"
            // }

            if(sendPay == "true"){
                if (c_conta == pago && idpago == 0){
                    var datos = {
                        "txt_id" : id,
                        "txt_idcot" : idcot,
                        "txt_medio" : medio,
                        "txt_transaccion" : transaccion,
                        "txt_fecha" : fecha,
                        "txt_pago" : pago,
                        "txt_idpago" : idpago
                    };
                    $.ajax({
                        data:  datos,
                        url:   "{{route('pay_price_conta_path')}}",
                        type:  'post',

                        beforeSend: function () {
                            $('#btn_pago').addClass('hide');
                            $('#btn_load').removeClass('hide');
                        },
                        success:  function (response) {
                            // $('#d_form')[0].reset();
                            $('#f_check').removeClass('hide')
                            $('#btn_load').addClass('hide');
                        }
                    });
                }

                if (c_conta > pago && idpago == 0){
                    var datos = {
                        "txt_id" : id,
                        "txt_idcot" : idcot,
                        "txt_medio" : medio,
                        "txt_transaccion" : transaccion,
                        "txt_fecha" : fecha,
                        "txt_pago" : pago,
                        "txt_idpago" : idpago
                    };
                    $.ajax({
                        data:  datos,
                        url:   "{{route('pay_price_conta_path')}}",
                        type:  'post',

                        beforeSend: function () {
                            $('#btn_pago').addClass('hide');
                            $('#btn_load').removeClass('hide');
                        },
                        success:  function (response) {
                            // $('#d_form')[0].reset();
                            $('#f_check').removeClass('hide');
                            $('#btn_load').addClass('hide');
                            $('#i_save').removeClass('hide');
                        }
                    });
                }

                    if (pago == acuenta && idpago > 0){
                    var datos = {
                        "txt_id" : id,
                        "txt_idcot" : idcot,
                        "txt_medio" : medio,
                        "txt_transaccion" : transaccion,
                        "txt_fecha" : fecha,
                        "txt_pago" : pago,
                        "txt_idpago" : idpago
                    };
                    $.ajax({
                        data:  datos,
                        url:   "{{route('pay_price_conta_path')}}",
                        type:  'post',

                        beforeSend: function () {
                            $('#btn_pago').addClass('hide');
                            $('#btn_load').removeClass('hide');
                        },
                        success:  function (response) {
                            // $('#d_form')[0].reset();
                            $('#f_check').removeClass('hide')
                            $('#btn_load').addClass('hide');
                        }
                    });
                }

                if (acuenta > pago && idpago > 0){
                    var datos = {
                        "txt_id" : id,
                        "txt_idcot" : idcot,
                        "txt_medio" : medio,
                        "txt_transaccion" : transaccion,
                        "txt_fecha" : fecha,
                        "txt_pago" : pago,
                        "txt_idpago" : idpago
                    };
                    $.ajax({
                        data:  datos,
                        url:   "{{route('pay_price_conta_path')}}",
                        type:  'post',

                        beforeSend: function () {
                            $('#btn_pago').addClass('hide');
                            $('#btn_load').removeClass('hide');
                        },
                        success:  function (response) {
                            // $('#d_form')[0].reset();
                            $('#f_check').removeClass('hide');
                            $('#btn_load').addClass('hide');
                            $('#i_save').removeClass('hide');
                        }
                    });
                }

            } else{
                $("#btn_pago").removeAttr("disabled");
            }

        }
    </script>
@stop