@extends('layouts.admin.contabilidad')
@section('content')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <div class="row margin-top-40">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Contabilidad</li>
            <li>Hoteles</li>
            <li class="active">Listar por fechas</li>
        </ol>
    </div>

    @if($ids == 0)
        @foreach($consulta as $consultas)
            @php $ids = explode(',', $consultas->codigos) @endphp
        @endforeach
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-body">
                    <div class="text-right @if($codigos > 0) hide @else show @endif">
                        @foreach($ids as $id)
                            <input type="hidden" id="p_codigos" name="codigos[]" value="{{$id}}">
                        @endforeach
                        <button class="btn btn-success text-right" type="button" id="btn_guardar" onclick="guardarConsulta()">Guardar Consulta</button>
                            <i class="fa fa-spinner fa-pulse fa-3x fa-fw hide" id="btn_load"></i>
                            <span class="sr-only">Loading...</span>
                        <i class="fa fa-check fa-3x text-success hide" id="btn_check"></i>
                            <hr>
                    </div>
                    <div class="row">
                        {{--<form action="{{route('list_fechas_show_path')}}" method="post">--}}
                            {{csrf_field()}}
                            <div class="col-lg-12 table-responsive">
                                <table class="table table-condensed table-bordered margin-top-20 table-hover">
                                    <thead>
                                    <tr>
                                        {{--<th></th>--}}
                                        <th class="text-18 text-grey-goto text-center">Proveedor</th>
                                        {{--<th class="text-18 text-grey-goto text-center">Servicio</th>--}}
                                        <th class="text-18 text-grey-goto text-center">Cotización</th>
                                        {{--<th class="text-18 text-grey-goto text-center">Fecha de Servicio</th>--}}
                                        <th class="text-18 text-grey-goto text-center">Cont. Price</th>
                                        {{--<th class="text-18 text-grey-goto text-center">Pagado</th>--}}
                                        <th class="text-18 text-grey-goto text-center">Saldo</th>
                                        {{--<th class="text-18 text-grey-goto text-center">Fecha a Pagar</th>--}}
                                        <th class="text-18 text-grey-goto text-center">Medio Pago</th>
                                        <th class="text-18 text-grey-goto text-center">#CB/CCI</th>
                                        <th class="text-18 text-grey-goto text-center">Transacción</th>
                                        {{--<th class="text-18 text-grey-goto text-center">#Comprobante</th>--}}
                                        <th class="text-18 text-grey-goto text-center hide" id="p_tfecha">Nueva fecha</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {{--@php--}}
                                    {{--$ini = date(2018-01-19);--}}
                                    {{--$fin = date('2018-01-19');--}}
                                    {{--@endphp--}}
                                    {{csrf_field()}}
                                    @php $x=0; $y=0; $z=0;@endphp
                                    @foreach($cotizacion as $cotizaciones)
                                        @foreach($cotizaciones->paquete_cotizaciones as $paquetes)
                                            @foreach($paquetes->itinerario_cotizaciones as $itinerario)
                                                @php
                                                    $dia = $itinerario->dias - 1;
                                                    $fecha = date($cotizaciones->fecha);
                                                    $fecha_servicio = strtotime ( '+'.$dia.' day' , strtotime ( $fecha ) ) ;
                                                    $fecha_servicio = date ( 'Y-m-j' , $fecha_servicio );

                                                    $dia_pago = 7;
                                                    $fecha_p = date($fecha_servicio);
                                                    $fecha_pago = strtotime ( '-'.$dia_pago.' day' , strtotime ( $fecha_p ) ) ;
                                                    $fecha_pago = date ( 'Y-m-j' , $fecha_pago );

                                                @endphp


                                                @foreach($itinerario->hotel as $hotel)
                                                    @php
                                                        $total_h=0;
                                                        $precio_c_confirm=0;
                                                        $precio_c_confirm2=0;
                                                    @endphp
                                                    @if($hotel->personas_s>0)
                                                        @php
                                                            $precio_c_confirm++;
                                                        @endphp
                                                        @if($hotel->precio_s_c>0)
                                                            @php
                                                                $total_h+=$hotel->personas_s*$hotel->precio_s_c;
                                                                $precio_c_confirm2++;
                                                            @endphp
                                                        @endif
                                                    @endif
                                                    @if($hotel->personas_d>0)
                                                        @php
                                                            $precio_c_confirm++;
                                                        @endphp
                                                        @if($hotel->precio_d_c>0)
                                                            @php
                                                                $total_h+=$hotel->personas_d*$hotel->precio_d_c;
                                                                $precio_c_confirm2++;
                                                            @endphp
                                                        @endif
                                                    @endif
                                                    @if($hotel->personas_m>0)
                                                        @php
                                                            $precio_c_confirm++;
                                                        @endphp
                                                        @if($hotel->precio_m_c>0)
                                                            @php
                                                                $total_h+=$hotel->personas_m*$hotel->precio_m_c;
                                                                $precio_c_confirm2++;
                                                            @endphp
                                                        @endif
                                                    @endif
                                                    @if($hotel->personas_t>0)
                                                        @php
                                                            $precio_c_confirm++;
                                                        @endphp
                                                        @if($hotel->precio_t_c>0)
                                                            @php
                                                                $total_h+=$hotel->personas_t*$hotel->precio_t_c;
                                                                $precio_c_confirm2++;
                                                            @endphp
                                                        @endif
                                                    @endif
                                                    @foreach($ids as $id)
                                                        @if($hotel->id == $id)
                                                            @php $total = 0; $j=0; $x++;@endphp
                                                                @foreach($hotel->pagos->where('estado', 1) as $pagos)
                                                                    @php $total = $total + $pagos->a_cuenta; @endphp
                                                                @endforeach
                                                                @if($precio_c_confirm==$precio_c_confirm2)
                                                                    <tr>
                                                                        @if($total == 0)
                                                                            @php $pago_a_cuenta = $hotel->precio_c;@endphp
                                                                        @else
                                                                            @foreach($hotel->pagos->where('estado', 0) as $pagos)
                                                                                @php $pago_a_cuenta = $pagos->a_cuenta;@endphp
                                                                            @endforeach

                                                                        @endif
                                                                        {{--<td class="text-center"><input type="checkbox" checked  onclick="if (this.checked) sumar({{$pago_a_cuenta}}); else restar({{$pago_a_cuenta}})" name="chk_id[]" value="{{$servicio->id}}"></td>--}}
                                                                        @if(isset($hotel->proveedor))
                                                                            <td><b>{{ucwords(strtolower($hotel->proveedor->razon_social))}}</b></td>
                                                                        @else
                                                                            <td><b></b></td>
                                                                        @endif
                                                                        {{--<td><b>{{ucwords(strtolower($servicio->nombre))}}</b></td>--}}
                                                                            <td class="hide"><input type="text" id="id_servicio_{{$x}}" value="{{$hotel->id}}"></td>
                                                                        @foreach($cotizaciones->cotizaciones_cliente as $cotizaciones_clientes)
                                                                            <td><b>{{ucwords(strtolower($cotizaciones_clientes->cliente->nombres))}} X{{$cotizaciones->nropersonas}}</b></td>
                                                                        @endforeach
{{--                                                                        <td class="text-right"><b>{{$fecha_servicio}}</b></td>--}}

                                                                        {{--<td class="text-right"><b><sup><small>$USS</small></sup></b></td>--}}
                                                                        <td class="text-right">
                                                                            <li class="list-style-none font-weight-bold" id="p_conta_{{$x}}" value="{{$total_h}}">
                                                                                {{$total_h}}<sup><small>$USS</small></sup>
                                                                            </li>
                                                                        </td>
                                                                        {{--<td class="text-center"><button class="btn btn-primary btn-sm">Pagar</button></td>--}}
                                                                        <td class="text-right list-style-none hide">
                                                                            <li id="p_pagado_{{$x}}" value="{{$total}}">
                                                                                {{$total}}
                                                                            </li>
                                                                        </td>

                                                                        @if($total == 0)
                                                                                <input type="hidden" value="0" id="id_pago_{{$x}}">
                                                                                <input type="hidden" value="{{$total_h}}" id="p_mcuenta_{{$x}}">
                                                                                <input type="hidden" value="{{$total_h}}" id="m_memory_{{$x}}">
                                                                                {{--@php echo input $servicio->precio_c; @endphp--}}
                                                                                <td><input type="text" class="form-control input-sm text-right" value="{{$total_h}}" onchange="accionSaldo({{$x}}, {{$total_h}})" id="p_saldo_{{$x}}"></td>
{{--                                                                                <td class="text-right"><b>{{$fecha_pago}}</b></td>--}}
                                                                                @php  $y = $y +$total_h; @endphp
                                                                        @elseif($total == $total_h)
                                                                            <input type="hidden" value="0" id="id_pago_{{$x}}">
                                                                            <input type="hidden" value="{{$total_h}}" id="p_mcuenta_{{$x}}">
                                                                            <input type="hidden" value="{{$total_h}}" id="m_memory_{{$x}}">
                                                                            {{--@php echo input $servicio->precio_c; @endphp--}}
                                                                            <td><input type="text" class="form-control input-sm text-right" value="{{$total_h-$total}}" onchange="accionSaldo({{$x}}, {{$total_h}})" id="p_saldo_{{$x}}" readonly="readonly"></td>
                                                                            @php  $y = $y +$total_h; @endphp

                                                                        @else
                                                                                <input type="hidden" value="{{$pagos->id}}" id="id_pago_{{$x}}">
{{--                                                                                @php echo $pagos->a_cuenta; @endphp--}}
                                                                                <input type="hidden" value="{{$pagos->a_cuenta}}" id="p_mcuenta_{{$x}}">
                                                                                <input type="hidden" value="{{$pagos->a_cuenta}}" id="m_memory_{{$x}}">
                                                                                <td><input type="text" class="form-control input-sm text-right" value="{{$pagos->a_cuenta}}" onchange="accionSaldo({{$x}}, {{$pagos->a_cuenta}})" id="p_saldo_{{$x}}"></td>
                                                                                {{--<td class="text-right"><b>{{$pagos->fecha_a_pagar}}</b></td>--}}
                                                                                @php  $z = $z + $pagos->a_cuenta; @endphp
                                                                        @endif


                                                                        <td>
                                                                            @php
                                                                                $bloquear='';
                                                                            @endphp
                                                                            @if($total == $total_h)
                                                                                @php
                                                                                    $bloquear=' readonly="readonly"';
                                                                                @endphp
                                                                            @endif
                                                                            <select class="form-control input-sm" onchange="medio({{$x}})" id="p_medio_{{$x}}" {{$bloquear}}>
                                                                                <option value="0">--Seleccione--</option>
                                                                                <option value="Cheque">Cheque</option>
                                                                                <option value="Efectivo">Efectivo</option>
                                                                                <option value="BPC">Transferencia BCP</option>
                                                                                <option value="Otros">Transferencia Otros</option>
                                                                            </select>
                                                                        </td>
                                                                            <td>
                                                                                <input type="text" class="form-control input-sm text-right" id="p_cuenta_{{$x}}"{{$bloquear}}>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" class="form-control input-sm text-right" id="p_transa_{{$x}}"{{$bloquear}}>
                                                                            </td>
                                                                            {{--<td>--}}
                                                                                {{--<input type="text" class="form-control input-sm">--}}
                                                                            {{--</td>--}}
                                                                            <td class="has-error hide" id="p_fpago_{{$x}}">
                                                                                <input type="date" class="form-control input-sm text-right" id="p_fvpago_{{$x}}">
                                                                            </td>
                                                                            <td class="text-center">
                                                                                {{--<button class="btn btn-info btn-sm">Pagar</button>--}}
                                                                                @if($total == 0)
                                                                                    <button class="btn btn-primary btn-sm" type="button" id="p_bpagar_{{$x}}"  onclick="pagarTotal({{$x}})">Pagar</button>
                                                                                    <button type="button" class="btn btn-info btn-sm hide" data-toggle="modal" data-target="#modal_{{$x}}" id="btn_modal_{{$x}}">
                                                                                        <i class="fa fa-upload" aria-hidden="true"></i>
                                                                                    </button>
                                                                                    <!-- Modal -->
                                                                                    <div class="modal fade" id="modal_{{$x}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                                                        <div class="modal-dialog" role="document">
                                                                                            <div class="modal-content">
                                                                                                <form id="guardar_imagen_pago_2{{$x}}" name="guardar_imagen_pago_2{{$x}}" action="{{route('guardar_imagen_pago_hotel_path')}}" enctype="multipart/form-data" method="post">
                                                                                                    <div class="modal-header">
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                                                        <h4 class="modal-title" id="myModalLabel">Subir Imagen</h4>
                                                                                                    </div>
                                                                                                    <div class="modal-body">
                                                                                                        <div class="row">
                                                                                                            <div class="col-xs-12 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                                                                                                                <div id="image-preview{{$x}}" class="input-group image-preview">
                                                                                                                    <input id="image-preview-filename{{$x}}" type="text" class="form-control image-preview-filename" disabled="disabled">
                                                                                                                    <span class="input-group-btn">
                                                                                                                        <button id="image-preview-clear{{$x}}" type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                                                                                                            <span class="glyphicon glyphicon-remove"></span> Clear
                                                                                                                        </button>
                                                                                                                        <div id="image-preview-input{{$x}}" class="btn btn-default image-preview-input">
                                                                                                                            <span class="glyphicon glyphicon-folder-open"></span>
                                                                                                                            <span id="image-preview-input-title{{$x}}" class="image-preview-input-title">Buscar</span>
                                                                                                                            <input type="file" accept="image/png, image/jpeg, image/gif" name="foto" id="foto{{$x}}"/>
                                                                                                                        </div>
                                                                                                                    </span>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-xs-12 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                                                                                                                <span id="result_{{$x}}" class="text-15 text-success"></span>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="modal-footer">
                                                                                                        {{csrf_field()}}
                                                                                                        <input type="text" id="response_{{$x}}" name="id">
                                                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                                        <button type="submit" class="btn btn-primary" onclick="guardar_imagen_pago_2({{$x}})">Guardar Imagen</button>
                                                                                                    </div>
                                                                                                </form>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                @else
                                                                                    @if($pagos->estado == 1)
                                                                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_{{$x}}">
                                                                                            <i class="fa fa-image" aria-hidden="true"></i>
                                                                                        </button>
                                                                                        <!-- Modal -->
                                                                                        <div class="modal fade" id="modal_{{$x}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                                                            <div class="modal-dialog" role="document">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header">
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                                                        <h4 class="modal-title" id="myModalLabel">Imagenes de los pagos realizados</h4>
                                                                                                    </div>
                                                                                                    <div class="modal-body">
                                                                                                        <div class="row">
                                                                                                            <div class="col-lg-12">
                                                                                                                <div class="row">
                                                                                                                @foreach($hotel->pagos->where('estado', 1) as $pagos)
                                                                                                                    @if (Storage::disk('imagen_pago_hotel')->has($pagos->imagen))
                                                                                                                        <div class="col-lg-3">
                                                                                                                            <div class="img-hover">
                                                                                                                                <img class="img-responsive img-rounded"
                                                                                                                                     src="{{route('pago_hotel_image_path', ['filename' => $pagos->imagen])}}"  width="160" height="160">
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    @endif
                                                                                                                @endforeach
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="modal-footer">
                                                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                                        <button type="button" class="hide btn btn-primary">Guardar Imagen</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        @else
                                                                                        <button class="btn btn-primary btn-sm" type="button" id="p_bpagar_{{$x}}"  onclick="pagarTotal({{$x}})">Pagar</button>
                                                                                    @endif
                                                                                @endif
                                                                                <button class="btn btn-warning btn-sm hide" type="button" id="p_bsave_{{$x}}" onclick="pagarGuardar({{$x}})">Pagar & Guardar</button>
                                                                                <i class="fa fa-spinner fa-pulse fa-1x fa-fw hide" id="p_bload_{{$x}}"></i>
                                                                                <span class="sr-only">Loading...</span>
                                                                                <i class="fa fa-check fa-1x hide text-success" id="p_bcheck_{{$x}}"></i>


                                                                                <button type="button" class="btn btn-info btn-sm hide" data-toggle="modal" data-target="#modal_{{$x}}" id="btn_modal_{{$x}}">
                                                                                    <i class="fa fa-upload" aria-hidden="true"></i>
                                                                                </button>
                                                                                <!-- Modal -->
                                                                                <div class="modal fade" id="modal_{{$x}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                                                    <div class="modal-dialog" role="document">
                                                                                        <div class="modal-content">
                                                                                            <form id="guardar_imagen_pago_2{{$x}}" name="guardar_imagen_pago_2{{$x}}" action="{{route('guardar_imagen_pago_hotel_path')}}" enctype="multipart/form-data" method="post">
                                                                                                <div class="modal-header">
                                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                                                    <h4 class="modal-title" id="myModalLabel">Subir Imagen</h4>
                                                                                                </div>
                                                                                                <div class="modal-body">
                                                                                                    <div class="row">
                                                                                                        <div class="col-xs-12 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                                                                                                            <div id="image-preview{{$x}}" class="input-group image-preview">
                                                                                                                <input id="image-preview-filename{{$x}}" type="text" class="form-control image-preview-filename" disabled="disabled">
                                                                                                                <span class="input-group-btn">
                                                                                                                    <button id="image-preview-clear{{$x}}" type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                                                                                                        <span class="glyphicon glyphicon-remove"></span> Clear
                                                                                                                    </button>
                                                                                                                    <div id="image-preview-input{{$x}}" class="btn btn-default image-preview-input">
                                                                                                                        <span class="glyphicon glyphicon-folder-open"></span>
                                                                                                                        <span id="image-preview-input-title{{$x}}" class="image-preview-input-title">Buscar</span>
                                                                                                                        <input type="file" accept="image/png, image/jpeg, image/gif" name="foto" id="foto{{$x}}"/>
                                                                                                                    </div>
                                                                                                                </span>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-xs-12 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                                                                                                            <span id="result_{{$x}}" class="text-15 text-success"></span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="modal-footer">
                                                                                                    {{csrf_field()}}
                                                                                                    <input type="text" id="response_{{$x}}" name="id">
                                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                                    <button type="submit" class="btn btn-primary" onclick="guardar_imagen_pago_2({{$x}})">Guardar hImagen</button>
                                                                                                    {{--<button type="submit" class="btn btn-primary">Guardar hImagen</button>--}}
                                                                                                </div>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>


                                                                            </td>
                                                                    </tr>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endforeach

                                            @endforeach
                                        @endforeach
                                    @endforeach
                                    <tr>
                                        <td colspan="3"></td>
                                        <td class="text-right text-18 text-success font-weight-bold list-style-none">
                                            <li id="s_total" value="{{$y+$z}}"><sup><small>$usd</small></sup><b>{{$y+$z}}</b></li>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        {{--</form>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var total=0;

        function sumar(valor) {
            total += valor;
            // document.formulario.total.value=total;
            document.getElementById('s_total').innerHTML   = total;
        }

        function restar(valor) {
            total-=valor;
            // document.formulario.total.value=total;
            document.getElementById('s_total').innerHTML   = total;
        }

        function accionSaldo(id, saldo) {
            var p_saldo =  parseFloat($('#p_saldo_'+id).val());
            var p_conta = parseFloat($('#p_conta_'+id).val());
            var p_pagado = parseFloat($('#p_pagado_'+id).val());
            var s_total = parseFloat($('#s_total').val());
            var saldo = parseFloat(saldo);

            var m_memory = parseFloat($('#m_memory_'+id).val());

            var total_t=0;

            // var total2 = p_conta - p_saldo;

            if(p_saldo > saldo){
                $('#p_saldo_'+id).css("border-bottom", "2px solid #FF0000");
                $('#p_fpago_'+id).addClass('hide');
                $('#p_bsave_'+id).addClass('hide');
                $('#p_bpagar_'+id).removeClass('hide');
                $('#p_tfecha').addClass('hide');

                $('#s_total').css("color", "#FF0000");
                // var total_t = (s_total - p_saldo) + p_saldo;

            }else{
                $('#p_bsave_'+id).removeClass('hide');
                $('#p_bpagar_'+id).addClass('hide');
                $('#p_fpago_'+id).removeClass('hide');
                $('#p_tfecha').removeClass('hide');
                $('#s_total').css("color", "");

                total_t += (s_total - m_memory) + p_saldo;
                document.getElementById('s_total').innerHTML  = total_t;
                document.getElementById('m_memory_'+id).value = p_saldo;
                document.getElementById('s_total').value = total_t;

                // console.log(s_total+'-'+m_memory+'+'+p_saldo+'='+total_t);
            }
            // p_tfecha
            if(p_saldo == saldo){
                $('#p_saldo_'+id).css("border-bottom", "");
                $('#p_fpago_'+id).addClass('hide');

                $('#p_bsave_'+id).addClass('hide');
                $('#p_bpagar_'+id).removeClass('hide');

                $('#p_tfecha').addClass('hide');

                var total_t = s_total;

            }


            // document.getElementById('p_pagado_'+id).innerHTML   = total2 ;
            // document.getElementById('p_pagado_'+id).value   = total2 ;

        }

        function medio(id) {
            var opcion = document.getElementById("p_medio_"+id).value;
            // var seleccionado = opcion.options[opcion.selectedIndex].value;
            document.getElementById('p_cuenta_'+id).value = opcion;
            // alert(seleccionado);
        }

        function guardarConsulta() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('[name="_token"]').val()
                }
            });

            $("#btn_guardar").attr("disabled", true);
            var codigos = document.getElementsByName('codigos[]');
            var $codigos = "";
            for (var i = 0, l = codigos.length; i < l; i++) {
                $codigos += codigos[i].value+',';
            }

            codigos = $codigos.substring(0,$codigos.length-1);


            if (codigos.length == 0 ){
                // $('#f_date').css("border-bottom", "2px solid #FF0000");
                var sendCon = "false";
            }else{
                sendCon = "true"
            }

            if(sendCon == "true"){
                var datos = {
                    "txt_codigos" : codigos
                };
                $.ajax({
                    data:  datos,
                    url:   "{{route('consulta_hotel_save_path')}}",
                    type:  'post',
                    beforeSend: function () {
                        $('#btn_guardar').addClass('hide');
                        $('#btn_load').removeClass('hide');
                    },
                    success:  function (response) {
                        // $('#d_form')[0].reset();
                        $('#btn_load').addClass('hide');
                        $('#btn_check').removeClass('hide');
                        // $('#i_save').removeClass('hide');
                    }
                });
            } else{
                $("#btn_guardar").removeAttr("disabled");
            }


        }

        function pagarGuardar(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('[name="_token"]').val()
                }
            });

            var id_servicio = parseFloat($('#id_servicio_'+id).val());
            var p_saldo =  parseFloat($('#p_saldo_'+id).val());
            var p_pagado = parseFloat($('#p_pagado_'+id).val());
            var p_mcuenta = parseFloat($('#p_mcuenta_'+id).val());

            var medio = document.getElementById("p_medio_"+id).value;
            var cuenta = $('#p_cuenta_'+id).val();
            var transaccion = $('#p_transa_'+id).val();
            var fvpago = $('#p_fvpago_'+id).val();

            var id_pago = $('#id_pago_'+id).val();

            // var id_servicio = parseFloat($('#id_servicio_'+id).val());
            // console.log(p_pagado+'-'+p_conta+'-'+p_saldo+'-'+id_servicio);

            $("#p_bsave_"+id).attr("disabled", true);

            if (fvpago.length == 0 ){
                $('#p_fvpago_'+id).css("border-bottom", "2px solid #FF0000");
                var sendPay = "false";
            }else{
                sendPay = "true"
            }

            if(sendPay == "true"){
                var datos = {
                    "txt_idservicio" : id_servicio,
                    "txt_saldo" : p_saldo,
                    "txt_pagado" : p_pagado,
                    "txt_fvpago" : fvpago,
                    "txt_medio" : medio,
                    "txt_cuenta" : cuenta,
                    "txt_mcuenta" : p_mcuenta,
                    "txt_transaccion" : transaccion,
                    "txt_idpago" : id_pago
                };
                $.ajax({
                    data:  datos,
                    url:   "{{route('pagar_consulta_hotel_path')}}",
                    type:  'post',

                    beforeSend: function () {
                        $('#p_bsave_'+id).addClass('hide');
                        $('#p_bload_'+id).removeClass('hide');
                    },
                    success:  function (response) {
                        response=response.split('/');
                        $('#response_'+id).val(response[1]);
                        // $('#d_form')[0].reset();
                        $('#p_bcheck_'+id).removeClass('hide')
                        $('#p_bload_'+id).addClass('hide');
                        $('#p_fpago_'+id).addClass('hide');
                        $('#p_tfecha').addClass('hide');
                        $('#btn_modal_'+id).removeClass('hide');

                    }
                });
            } else{
                $("#p_bsave_"+id).removeAttr("disabled");
            }

        }

        function pagarTotal(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('[name="_token"]').val()
                }
            });

            var id_servicio = parseFloat($('#id_servicio_'+id).val());
            var p_saldo =  parseFloat($('#p_saldo_'+id).val());
            var p_pagado = parseFloat($('#p_pagado_'+id).val());
            var p_mcuenta = parseFloat($('#p_mcuenta_'+id).val());

            var medio = document.getElementById("p_medio_"+id).value;
            var cuenta = $('#p_cuenta_'+id).val();
            var transaccion = $('#p_transa_'+id).val();
            var fvpago = $('#p_fvpago_'+id).val();

            var id_pago = $('#id_pago_'+id).val();

            // var id_servicio = parseFloat($('#id_servicio_'+id).val());
            // console.log(p_pagado+'-'+p_conta+'-'+p_saldo+'-'+id_servicio);

            $("#p_bpagar_"+id).attr("disabled", true);

            if (cuenta.length == 0 ){
                $('#p_cuenta_'+id).css("border-bottom", "2px solid #FF0000");
                var sendPay = "false";
            }else{
                sendPay = "true";
            }

            if(sendPay == "true"){

                var datos = {
                    "txt_idservicio" : id_servicio,
                    "txt_saldo" : p_saldo,
                    "txt_pagado" : p_pagado,
                    "txt_fvpago" : fvpago,
                    "txt_medio" : medio,
                    "txt_cuenta" : cuenta,
                    "txt_mcuenta" : p_mcuenta,
                    "txt_transaccion" : transaccion,
                    "txt_idpago" : id_pago
                };
                $.ajax({
                    data:  datos,
                    url:   "{{route('pagar_consulta_hotel_path')}}",
                    type:  'post',

                    beforeSend: function () {
                        $('#p_bpagar_'+id).addClass('hide');
                        $('#p_bload_'+id).removeClass('hide');
                    },
                    success:  function (response) {
                        // $('#d_form')[0].reset();}
                        response=response.split('/');
                        $('#response_'+id).val(response[1]);
                        $('#p_bcheck_'+id).removeClass('hide')
                        $('#p_bload_'+id).addClass('hide');
                        $('#p_fpago_'+id).addClass('hide');
                        $('#p_tfecha').addClass('hide');
                        $('#btn_modal_'+id).removeClass('hide');
                    }
                });
            } else{
                $("#p_bpagar_"+id).removeAttr("disabled");
            }

        }


        $(document).on('click', '#close-preview', function(){
            $('.image-preview').popover('hide');
            // Hover befor close the preview
            $('.image-preview').hover(
                function () {
                    $('.image-preview').popover('show');
                },
                function () {
                    $('.image-preview').popover('hide');
                }
            );
        });

        $(function() {
            // Create the close button
            var closebtn = $('<button/>', {
                type:"button",
                text: 'x',
                id: 'close-preview',
                style: 'font-size: initial;',
            });
            closebtn.attr("class","close pull-right");
            // Set the popover default content
            $('.image-preview').popover({
                trigger:'manual',
                html:true,
                title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
                content: "There's no image",
                placement:'bottom'
            });
            // Clear event
//            $('.image-preview-clear').click(function(){
//                $('.image-preview').attr("data-content","").popover('hide');
//                $('.image-preview-filename').val("");
//                $('.image-preview-clear').hide();
//                $('.image-preview-input input:file').val("");
//                $(".image-preview-input-title").text("Browse");
//            });
//            // Create the preview image
//            $(".image-preview-input input:file").change(function (){
//                var img = $('<img/>', {
//                    id: 'dynamic',
//                    width:250,
//                    height:200
//                });
//                var file = this.files[0];
//                var reader = new FileReader();
//                // Set preview image into the popover data-content
//                reader.onload = function (e) {
//                    $(".image-preview-input-title").text("Change");
//                    $(".image-preview-clear").show();
//                    $(".image-preview-filename").val(file.name);
//                    img.attr('src', e.target.result);
//                    $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
//                }
//                reader.readAsDataURL(file);
//            });
            @for($idi=1;$idi<=$x;$idi++)
                $('#image-preview-clear{{$idi}}').click(function(){
                    $('#image-preview{{$idi}}').attr("data-content","").popover('hide');
                    $('#image-preview-filename{{$idi}}').val("");
                    $('#image-preview-clear{{$idi}}').hide();
                    $('#image-preview-input{{$idi}} input:file').val("");
                    $("#image-preview-input-title{{$idi}}").text("Browse");
                });
                // Create the preview image
                $("#image-preview-input{{$idi}} input:file").change(function (){
                    var img = $('<img/>', {
                        id: 'dynamic',
                        width:250,
                        height:200
                    });
                    var file = this.files[0];
                    var reader = new FileReader();
                    // Set preview image into the popover data-content
                    reader.onload = function (e) {
                        $("#image-preview-input-title{{$idi}}").text("Change");
                        $("#image-preview-clear{{$idi}}").show();
                        $("#image-preview-filename{{$idi}}").val(file.name);
                        img.attr('src', e.target.result);
                        $("#image-preview{{$idi}}").attr("data-content",$(img)[0].outerHTML).popover("show");
                    }
                    reader.readAsDataURL(file);
                });
            @endfor
        });
        function guardar_imagen_pago_2(id){
            $('#guardar_imagen_pago_2'+id).submit(function() {
                // Enviamos el formulario usando AJAX
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
//                    data: $(this).serialize(),
                    data: new FormData($("#guardar_imagen_pago_2"+id)[0]),
                    cache: false,
                    contentType: false,
                    processData: false,
                    // Mostramos un mensaje con la respuesta de PHP
                    success:  function (response) {
                        if(response==1){
                            $('#result_'+id).removeClass('text-danger');
                            $('#result_'+id).addClass('text-success');
                            $('#result_'+id).html('imagen guardada Correctamente!');
                        }
                        else{
                            $('#result_'+id).removeClass('text-success');
                            $('#result_'+id).addClass('text-danger');
                            $('#result_'+id).html('Error al guardar la imagen, intentelo de nuevo');
                        }
                    }
                })
                // esto es para que no se reenvie el formulario
                return false;
            });
        }
    </script>
@stop