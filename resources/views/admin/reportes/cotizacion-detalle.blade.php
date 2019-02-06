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
<p class="mt-2 text-15 "><b>FILTRO POR {{strtoupper($filtro)}} DESDE:<span class="text-primary">{{fecha_peru($desde)}}</span> HASTA:<span class="text-primary">{{fecha_peru($hasta)}}</span></b></p>
    <table class="table table-condensed table-responsive table-striped table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>WEB</th>
            <th>SELLER</th>
            <th>FECHA DE CIERRE</th>
            <th>PAQUETE</th>
            <th>PROFIT</th>
        </tr>
        </thead>
        <tbody>
        @php
            $i=0;
            $profit_suma=0;
            $filt='';
        @endphp
        @if ($filtro=='fecha de cierre')
            @php
                $filt='fecha_venta';
            @endphp
        @elseif($filtro=='fecha de llegada')
            @php
                $filt='fecha';
            @endphp
        @endif
        @foreach($cotizaciones->sortby($filt) as $cotizacion)
                @php
                    $date = date_create($cotizacion->fecha);
                    $fecha=date_format($date, 'jS F Y');
                    $i++;
                    $profit=0;
                    $profit_st=0;
                @endphp
                @foreach($cotizacion->paquete_cotizaciones->where('estado',2) as $paquete_cotizaciones)
                    @if($paquete_cotizaciones->duracion==1)
                        @php
                            $profit=$paquete_cotizaciones->utilidad*$cotizacion->nropersonas;
                        @endphp
                    @else
                        @php
                            $nro_personas=0;
                            $uti=0;
                        @endphp
                        @if($paquete_cotizaciones->paquete_precios->count()>=1)
                            @foreach($paquete_cotizaciones->paquete_precios as $precio)
                                @php
                                    $nro_personas=$precio->personas_s+$precio->personas_d+$precio->personas_m+$precio->personas_t;
                                @endphp
                                @if($precio->personas_s>0)
                                    @php
                                        $uti+=$precio->utilidad_s*$precio->personas_s;
                                    @endphp
                                @endif
                                @if($precio->personas_d>0)
                                    @php
                                        $uti+=$precio->utilidad_d*$precio->personas_d*2;
                                    @endphp
                                @endif
                                @if($precio->personas_m>0)
                                    @php
                                        $uti+=$precio->utilidad_m*$precio->personas_m*2;
                                    @endphp
                                @endif
                                @if($precio->personas_t>0)
                                    @php
                                        $uti+=$precio->utilidad_t*$precio->personas_t*3;
                                    @endphp
                                @endif
                            @endforeach
                            @if($nro_personas>0)
                                @php
                                    $profit+=$uti;
                                @endphp
                            @else
                                @php
                                    $profit=$paquete_cotizaciones->utilidad*$cotizacion->nropersonas;
                                @endphp
                            @endif
                        @else
                            @php
                                $profit=$paquete_cotizaciones->utilidad*$cotizacion->nropersonas;
                            @endphp
                        @endif
                    @endif
                   
                @endforeach
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$cotizacion->web}}</td>
                    <td><span class="text-primary">By</span> {{$cotizacion->users->name}}</td>
                    <td>
                        <i class="fas fa-calendar-alt text-primary"></i> {{fecha_peru($cotizacion->fecha_venta)}}
                    </td>
                    <td>
                        {{-- @foreach($cotizacion->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente) --}}
                            <b> <span class="text-success">{{$cotizacion->codigo}}</span> | {{$cotizacion->nombre_pax}}X{{$cotizacion->nropersonas}}({{$fecha}})</b>
                        {{-- @endforeach --}}
                    </td>
                    <td class="text-right text-secondary"><b><sup>$</sup>{{number_format($profit,2)}}</b></td>
                </tr>
                @php
                    $profit_suma+=$profit;
                @endphp
        @endforeach
        <tr>
            <td colspan="5">TOTAL</td><td class="text-right text-secondary"><b><sup>$</sup>{{number_format($profit_suma,2)}}</b></td>
        </tr>
    </table>
@stop
