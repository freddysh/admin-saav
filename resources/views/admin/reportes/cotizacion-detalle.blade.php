@php
    function fecha_peru($fecha){
        $fecha_temp='';
        $fecha_temp=explode('-',$fecha);
        return $fecha_temp[2].'/'.$fecha_temp[1].'/'.$fecha_temp[0];
    }
@endphp

@extends('layouts.admin.reportes')
@section('archivos-js')
    {{--<script src="{{asset("https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js")}}"></script>--}}
    {{--<script src="{{asset("https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js")}}"></script>--}}
    {{--<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>--}}
@stop
@section('content')
    <table class="table table-condensed table-responsive table-striped table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>WEB</th>
            <th>SELLER</th>
            <th>PAQUETE</th>
            <th>PROFIT</th>
        </tr>
        </thead>
        <tbody>
        @php
            $i=0;
            $profit_suma=0;
        @endphp
        @foreach($cotizaciones->sortby('fecha_venta') as $cotizacion)
                @php
                    $date = date_create($cotizacion->fecha);
                    $fecha=date_format($date, 'jS F Y');
                    $i++;
                    $profit=0;
                @endphp
                @foreach($cotizacion->paquete_cotizaciones as $paquete_cotizaciones)
                    @php
                        $profit=0;
                    @endphp
                    @if($paquete_cotizaciones->duracion==1)
                        @php
                            $profit=$paquete_cotizaciones->utilidad*$cotizacion->nropersonas;
                        @endphp
                    @else
                        @foreach($paquete_cotizaciones->paquete_precios as $precio)
                            @if($precio->personas_s>0)
                                @php
                                    $profit+=$precio->utilidad_s*$precio->personas_s;
                                @endphp
                            @endif
                            @if($precio->personas_d>0)
                                @php
                                    $profit+=$precio->utilidad_d*$precio->personas_d;
                                @endphp
                            @endif
                            @if($precio->personas_m>0)
                                @php
                                    $profit+=$precio->utilidad_m*$precio->personas_m;
                                @endphp
                            @endif
                            @if($precio->personas_t>0)
                                @php
                                    $profit+=$precio->utilidad_t*$precio->personas_t;
                                @endphp
                            @endif
                        @endforeach
                    @endif
                @endforeach
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$cotizacion->web}}</td>
                    <td><i class="fas fa-users text-primary"></i>{{$cotizacion->users->name}}</td>
                    <td>
                        @foreach($cotizacion->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                            <b> <span class="text-success">{{$cotizacion->codigo}}</span> | {{$cotizaciones_cliente->cliente->nombres}}X{{$cotizacion->nropersonas}}({{$fecha}})</b>
                        @endforeach
                    </td>
                    <td><b><sup>$</sup>{{number_format($profit,2)}}</b></td>
                </tr>
                @php
                    $profit_suma+=$profit;
                @endphp
        @endforeach
        <tr>
            <td colspan="4">TOTAL</td><td><b><sup>$</sup>{{number_format($profit_suma,2)}}</b></td>
        </tr>
    </table>
@stop
