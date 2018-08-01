@php
    $arra_prov_pagos=[];
@endphp
{{--@foreach($pagos as $pago1)--}}
    {{--@if(array_key_exists($pago1->proveedor_id,$arra_prov_pagos))--}}
        {{--@php--}}
            {{--$arra_prov_pagos[$pago1->proveedor_id]+=$total_h;--}}
        {{--@endphp--}}
    {{--@else--}}
        {{--@php--}}
            {{--$arra_prov_pagos[$pago1->proveedor_id]=$total_h;--}}
        {{--@endphp--}}
    {{--@endif--}}
{{--@endforeach--}}

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
    {{--<div class="row">--}}
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">

                            <form action="{{route('list_fechas_rango_hotel_path')}}" method="post" class="form-inline">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="f_ini">From</label>
                                    <input type="date" class="form-control" placeholder="from" name="txt_ini" id="f_ini" required>
                                </div>
                                <div class="form-group">
                                    <label for="f_fin">To</label>
                                    <input type="date" class="form-control" placeholder="to" name="txt_fin" id="f_fin" required>
                                </div>
                                <button type="submit" class="btn btn-default">Filter</button>
                            </form>
                        </div>
                    </div><!-- /.row -->
                    {{--<hr>--}}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <form action="{{route('list_fechas_hotel_show_path')}}" method="post">
                            {{csrf_field()}}
                        <div class="col-lg-9">

                            <table class="table table-condensed table-bordered margin-top-20 table-hover">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th class="text-18 text-grey-goto text-center">Cotización</th>
                                    <th class="text-18 text-grey-goto text-center">Proveedor</th>
                                    <th class="text-18 text-grey-goto text-center">Fecha de Servicio</th>
                                    <th class="text-18 text-grey-goto text-center">Fecha a Pagar</th>
                                    <th class="text-18 text-grey-goto text-center">Cont. Price</th>
                                    <th class="text-18 text-grey-goto text-center">Pagado</th>
                                    <th class="text-18 text-grey-goto text-center">Saldo</th>
                                    {{--<th class="text-18 text-grey-goto text-center">Pagado</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                {{--@php--}}
                                        {{--$ini = date(2018-01-19);--}}
                                        {{--$fin = date('2018-01-19');--}}
                                {{--@endphp--}}
                                @foreach($cotizacion->where('estado','2') as $cotizaciones)
                                    @foreach($cotizaciones->paquete_cotizaciones->where('estado','2') as $paquetes)
                                        @php
                                            $arra_prov_total=[];
                                        @endphp
                                        @foreach($paquetes->itinerario_cotizaciones as $itinerario)
                                            @php
                                                $dia = $itinerario->dias - 1;
                                                $fecha = date($cotizaciones->fecha);
                                                $fecha_servicio = strtotime ( '+'.$dia.' day' , strtotime ( $fecha ) ) ;
                                                $fecha_servicio = date ( 'Y-m-d' , $fecha_servicio );

                                                $dia_pago = 7;
                                                $fecha_p = date($fecha_servicio);
                                                $fecha_pago = strtotime ( '-'.$dia_pago.' day' , strtotime ( $fecha_p ) ) ;
                                                $fecha_pago = date ( 'Y-m-d' , $fecha_pago );

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
                                                        @if(array_key_exists($hotel->proveedor_id,$arra_prov_total))
                                                            @php
                                                                $arra_prov_total[$hotel->proveedor_id]+=$total_h;
                                                            @endphp
                                                        @else
                                                            @php
                                                                $arra_prov_total[$hotel->proveedor_id]=$total_h;
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
                                                        @if(array_key_exists($hotel->proveedor_id,$arra_prov_total))
                                                            @php
                                                                $arra_prov_total[$hotel->proveedor_id]+=$total_h;
                                                            @endphp
                                                        @else
                                                            @php
                                                                $arra_prov_total[$hotel->proveedor_id]=$total_h;
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
                                                        @if(array_key_exists($hotel->proveedor_id,$arra_prov_total))
                                                            @php
                                                                $arra_prov_total[$hotel->proveedor_id]+=$total_h;
                                                            @endphp
                                                        @else
                                                            @php
                                                                $arra_prov_total[$hotel->proveedor_id]=$total_h;
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
                                                        @if(array_key_exists($hotel->proveedor_id,$arra_prov_total))
                                                            @php
                                                                $arra_prov_total[$hotel->proveedor_id]+=$total_h;
                                                            @endphp
                                                        @else
                                                            @php
                                                                $arra_prov_total[$hotel->proveedor_id]=$total_h;
                                                            @endphp
                                                        @endif
                                                    @endif
                                                    @php $total = 0; $total2 = 0; $j=0;@endphp
                                                    {{--@foreach($hotel->pagos->where('estado', 1) as $pagos)--}}
                                                        {{--@php $total = $total + $pagos->a_cuenta; @endphp--}}
                                                    {{--@endforeach--}}

                                                    {{--@foreach($hotel->pagos as $pagos)--}}
                                                        {{--@php $total2 = $total2 + $pagos->a_cuenta; @endphp--}}
                                                    {{--@endforeach--}}

                                                    @if($total == 0)
                                                        @php $pago_a_cuenta = $total_h;@endphp
                                                    @else
                                                        {{--@foreach($hotel->pagos->where('estado', 0) as $pagos)--}}
                                                            {{--@php $pago_a_cuenta = $pagos->a_cuenta;@endphp--}}
                                                        {{--@endforeach--}}
                                                    @endif

                                                    @if($precio_c_confirm==$precio_c_confirm2)
                                                        @if($total == 0)
                                                            @if($fecha_pago >= date($ini) AND  $fecha_pago <= date($fin))
                                                                <tr>
                                                                    <td class="text-center"><input type="checkbox"  onclick="if (this.checked) sumar({{$pago_a_cuenta}}); else restar({{$pago_a_cuenta}})" name="chk_id[]" value="{{$hotel->id}}"></td>
                                                                    @if(isset($hotel->proveedor))
                                                                        <td><b>{{ucwords(strtolower($hotel->proveedor->razon_social))}}</b></td>
                                                                    @else
                                                                        <td><b></b></td>
                                                                    @endif
                                                                    {{--<td><b>{{ucwords(strtolower($servicio->nombre))}}</b></td>--}}
                                                                    @foreach($cotizaciones->cotizaciones_cliente as $cotizaciones_clientes)
                                                                        <td><b>{{ucwords(strtolower($cotizaciones_clientes->cliente->nombres))}} X{{$cotizaciones->nropersonas}}</b></td>
                                                                    @endforeach
                                                                        <td class="text-right"><b>{{$fecha_servicio}}</b></td>
                                                                    <td class="text-right"><b>{{$fecha_pago}}</b></td>
                                                                    {{--<td class="text-right"><b><sup><small>$USS</small></sup></b></td>--}}
                                                                    <td class="text-right"><b>{{$total_h}}<sup><small>$USS</small></sup></b></td>
                                                                    {{--<td class="text-center"><button class="btn btn-primary btn-sm">Pagar</button></td>--}}
                                                                    <td class="text-right">
                                                                        <b>
                                                                            {{$total}}
                                                                        </b>

                                                                    </td>

                                                                    <td class="text-right"><b>{{$total_h}}</b></td>

                                                                </tr>
                                                            @endif
                                                        @else
                                                            @if($pagos->fecha_a_pagar >= date($ini) AND  $pagos->fecha_a_pagar <= date($fin))
                                                                @if($pagos->estado == 0)
                                                                    <tr>
                                                                        <td class="text-center"><input type="checkbox"  onclick="if (this.checked) sumar({{$pago_a_cuenta}}); else restar({{$pago_a_cuenta}})" name="chk_id[]" value="{{$hotel->id}}"></td>
                                                                        @if(isset($hotel->proveedor))
                                                                            <td><b>{{ucwords(strtolower($hotel->proveedor->razon_social))}}</b></td>
                                                                        @else
                                                                            <td><b></b></td>
                                                                        @endif
                                                                        {{--<td><b>{{ucwords(strtolower($servicio->nombre))}}</b></td>--}}
                                                                        @foreach($cotizaciones->cotizaciones_cliente as $cotizaciones_clientes)
                                                                            <td><b>{{ucwords(strtolower($cotizaciones_clientes->cliente->nombres))}} X{{$cotizaciones->nropersonas}}</b></td>
                                                                        @endforeach
                                                                        <td class="text-right"><b>{{$fecha_servicio}}</b></td>
                                                                        <td class="text-right"><b>{{$pagos->fecha_a_pagar}}</b></td>
                                                                        {{--<td class="text-right"><b><sup><small>$USS</small></sup></b></td>--}}
                                                                        <td class="text-right"><b>{{$total_h}}<sup><small>$USS</small></sup></b></td>
                                                                        {{--<td class="text-center"><button class="btn btn-primary btn-sm">Pagar</button></td>--}}
                                                                        <td class="text-right">
                                                                            <b>
                                                                                {{$total}}
                                                                            </b>
                                                                        </td>
                                                                        <td class="text-right"><b>{{$pagos->a_cuenta}}</b></td>
                                                                    </tr>
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endforeach
                                        @endforeach
                                    @endforeach
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-3">
                            <div class="panel panel-default">
                                <div class="panel-body text-center">
                                    <h2 class="text-40"><sup><small>$usd</small></sup><b id="s_total">Monto</b></h2>
                                    <button class="btn btn-info display-block w-100">Seleccionar</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                    {{--<hr>--}}
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

        {{--function rango_fecha() {--}}
            {{--var ini = $('#f_ini').val();--}}
            {{--var fin = $('#f_fin').val();--}}
            {{--window.location = "{{route('list_fechas_path', ['1','2'])}}";--}}
                {{--// window.location.href--}}
        {{--}--}}
    </script>
@stop