@php
    use Carbon\Carbon;
    function fecha_peru($fecha){
        if(trim($fecha)!=''){
            $fecha=explode('-',$fecha);
            return $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
        }
        else{
            return '0000-00-00';
        }
    }
    function fecha_peru1($fecha_){
        if(trim($fecha)!=''){
            $f1=explode(' ',$fecha_);
            $hora=$f1[1];
            $f2=explode('-',$f1[0]);
            $fecha1=$f2[2].'-'.$f2[1].'-'.$f2[0];
            return $fecha1.' a las '.$hora;
        }
        else{
            return '0000-00-00';
        }
    }
@endphp
@extends('layouts.quotes_pdf')
@section('content')
    <h1>LISTADO DE ENTRADAS A COMPRAR</h1>
    <p>
        <b>
            @if($liquidacion->opcion=='ENTRE DOS FECHAS')
                {{$liquidacion->opcion}} DESDE:{{$liquidacion->ini}} HASTA:{{$liquidacion->fin}}
            @elseif($liquidacion->opcion=='ENTRE DOS FECHAS URGENTES')
                {{$liquidacion->opcion}} DESDE:{{$liquidacion->ini}} HASTA:{{$liquidacion->fin}}
            @else
                {{$liquidacion->opcion}}
            @endif
        </b>
    </p>
    <table>
        <thead>
            <tr>
                <th>FECHA DE USO</th>
                <th>FECHA DE PAGO</th>
                <th>CLASE</th>
                <th>SERVICIO</th>
                <th>AD</th>
                <th>PAX</th>
                <th>$ AD</th>
                <th>$ TOTAL</th>
                <th>PRIORIDAD</th>
            </tr>
        </thead>
        <tbody>
        <tr class="mb-1">
            <td colspan="9"><b>LIQUIDACION DE BOLETOS TURISTICOS</b></td>
        </tr>
        @foreach($cotizaciones->sortBy('fecha') as $cotizacion_)
            @foreach($cotizacion_->paquete_cotizaciones as $pqts)
                @foreach($pqts->itinerario_cotizaciones->sortBy('fecha') as $itinerarios)
                    @foreach($itinerarios->itinerario_servicios->whereIn('liquidacion',array(1,2))->where('liquidacion_id',$liquidacion_id) as $itinerario_servicios)
                        @if($itinerario_servicios->servicio->grupo=='ENTRANCES' && $itinerario_servicios->servicio->clase=='BTG')
                            <tr>
                                <td>{{fecha_peru($itinerarios->fecha)}}</td>
                                <td>{{fecha_peru($itinerario_servicios->fecha_venc)}}</td>
                                <td>{{$itinerario_servicios->servicio->clase}}</td>
                                <td>{{$itinerario_servicios->nombre}}</td>
                                <td>{{$cotizacion_->nropersonas}}</td>
                                <td>
                                    <b>
                                        @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                        {{$cotizaciones_cliente->cliente->nombres}} {{$cotizaciones_cliente->cliente->apellidos}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
                                    @endforeach
                                    </b>
                                </td>
                                <td class="text-center">{{$itinerario_servicios->precio}}</td>
                                <td class="text-center">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                <td>
                                    @if($itinerario_servicios->prioridad=='NORMAL')
                                        <span class="azul">NORMAL</span>
                                    @elseif($itinerario_servicios->prioridad=='URGENTE')
                                        <span class="rojo">URGENTE</span>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
            @endforeach
        @endforeach
        <tr class="mb-1">
            <td colspan="9"><b>LIQUIDACION DE INGRESO A CATEDRAL</b></td>
        </tr>
        @foreach($cotizaciones->sortBy('fecha') as $cotizacion_)
            @foreach($cotizacion_->paquete_cotizaciones as $pqts)
                @foreach($pqts->itinerario_cotizaciones->sortBy('fecha') as $itinerarios)
                    @foreach($itinerarios->itinerario_servicios->whereIn('liquidacion',array(1,2))->where('liquidacion_id',$liquidacion_id) as $itinerario_servicios)
                        @if($itinerario_servicios->servicio->grupo=='ENTRANCES' && $itinerario_servicios->servicio->clase=='CAT')
                            <tr>
                                <td>{{fecha_peru($itinerarios->fecha)}}</td>
                                <td>{{fecha_peru($itinerario_servicios->fecha_venc)}}</td>
                                <td>{{$itinerario_servicios->servicio->clase}}</td>
                                <td>{{$itinerario_servicios->nombre}}</td>
                                <td>{{$cotizacion_->nropersonas}}</td>
                                <td>
                                    <b>
                                        @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                          {{$cotizaciones_cliente->cliente->nombres}} {{$cotizaciones_cliente->cliente->apellidos}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
                                        @endforeach
                                    </b>
                                </td>
                                <td class="text-center">{{$itinerario_servicios->precio}}</td>
                                <td class="text-center">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                <td>
                                    @if($itinerario_servicios->prioridad=='NORMAL')
                                        <span class="azul">NORMAL</span>
                                    @elseif($itinerario_servicios->prioridad=='URGENTE')
                                        <span class="rojo">URGENTE</span>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
            @endforeach
        @endforeach
        <tr class="mb-1">
            <td colspan="9"><b>LIQUIDACION DE INGRESO AL KORICANCHA</b></td>
        </tr>
        @foreach($cotizaciones->sortBy('fecha') as $cotizacion_)
            @foreach($cotizacion_->paquete_cotizaciones as $pqts)
                @foreach($pqts->itinerario_cotizaciones->sortBy('fecha') as $itinerarios)
                    @foreach($itinerarios->itinerario_servicios->whereIn('liquidacion',array(1,2))->where('liquidacion_id',$liquidacion_id) as $itinerario_servicios)
                        @if($itinerario_servicios->servicio->grupo=='ENTRANCES' && $itinerario_servicios->servicio->clase=='KORI')
                            <tr>
                                <td>{{fecha_peru($itinerarios->fecha)}}</td>
                                <td>{{fecha_peru($itinerario_servicios->fecha_venc)}}</td>
                                <td>{{$itinerario_servicios->servicio->clase}}</td>
                                <td>{{$itinerario_servicios->nombre}}</td>
                                <td>{{$cotizacion_->nropersonas}}</td>
                                <td>

                                    <b>
                                        @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                        {{$cotizaciones_cliente->cliente->nombres}} {{$cotizaciones_cliente->cliente->apellidos}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
                                    @endforeach
                                    </b>
                                </td>
                                <td class="text-center">{{$itinerario_servicios->precio}}</td>
                                <td class="text-center">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                <td>
                                    @if($itinerario_servicios->prioridad=='NORMAL')
                                        <span class="azul">NORMAL</span>
                                    @elseif($itinerario_servicios->prioridad=='URGENTE')
                                        <span class="rojo">URGENTE</span>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
            @endforeach
        @endforeach
        <tr class="mb-1">
            <td colspan="9"><b>LIQUIDACION DE INGRESO A MACHUPICCHU</b></td>
        </tr>
        @foreach($cotizaciones->sortBy('fecha') as $cotizacion_)
            @foreach($cotizacion_->paquete_cotizaciones as $pqts)
                @foreach($pqts->itinerario_cotizaciones->sortBy('fecha') as $itinerarios)
                    @foreach($itinerarios->itinerario_servicios->whereIn('liquidacion',array(1,2))->where('liquidacion_id',$liquidacion_id) as $itinerario_servicios)
                        @if($itinerario_servicios->servicio->grupo=='ENTRANCES' && $itinerario_servicios->servicio->clase=='MAPI')
                            <tr>
                                <td>{{fecha_peru($itinerarios->fecha)}}</td>
                                <td>{{fecha_peru($itinerario_servicios->fecha_venc)}}</td>
                                <td>{{$itinerario_servicios->servicio->clase}}</td>
                                <td>{{$itinerario_servicios->nombre}}</td>
                                <td>{{$cotizacion_->nropersonas}}</td>
                                <td>
                                    <b>
                                        @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                        {{$cotizaciones_cliente->cliente->nombres}} {{$cotizaciones_cliente->cliente->apellidos}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
                                    @endforeach
                                    </b>
                                </td>
                                <td class="text-center">{{$itinerario_servicios->precio}}</td>
                                <td class="text-center">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                <td>
                                    @if($itinerario_servicios->prioridad=='NORMAL')
                                        <span class="azul">NORMAL</span>
                                    @elseif($itinerario_servicios->prioridad=='URGENTE')
                                        <span class="rojo">URGENTE</span>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
            @endforeach
        @endforeach
        <tr class="mb-1">
            <td colspan="9"><b>ENTRADAS OTROS</b></td>
        </tr>
        @foreach($cotizaciones->sortBy('fecha') as $cotizacion_)
            @foreach($cotizacion_->paquete_cotizaciones as $pqts)
                @foreach($pqts->itinerario_cotizaciones->sortBy('fecha') as $itinerarios)
                    @foreach($itinerarios->itinerario_servicios->whereIn('liquidacion',array(1,2))->where('liquidacion_id',$liquidacion_id) as $itinerario_servicios)
                        @if($itinerario_servicios->servicio->grupo=='ENTRANCES' && $itinerario_servicios->servicio->clase=='OTROS')
                            <tr>
                                <td>{{fecha_peru($itinerarios->fecha)}}</td>
                                <td>{{fecha_peru($itinerario_servicios->fecha_venc)}}</td>
                                <td>{{$itinerario_servicios->servicio->clase}}</td>
                                <td>{{$itinerario_servicios->nombre}}</td>
                                <td>{{$cotizacion_->nropersonas}}</td>
                                <td>
                                    <b>
                                        @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                        {{$cotizaciones_cliente->cliente->nombres}} {{$cotizaciones_cliente->cliente->apellidos}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
                                    @endforeach
                                    </b>
                                </td>
                                <td class="text-center">{{$itinerario_servicios->precio}}</td>
                                <td class="text-center">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                <td>
                                    @if($itinerario_servicios->prioridad=='NORMAL')
                                        <span class="azul">NORMAL</span>
                                    @elseif($itinerario_servicios->prioridad=='URGENTE')
                                        <span class="rojo">URGENTE</span>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
            @endforeach
        @endforeach
        <tr class="mb-1">
            <td colspan="9"><b>ENTRADAS BUSES</b></td>
        </tr>
        @foreach($cotizaciones->sortBy('fecha') as $cotizacion_)
            @foreach($cotizacion_->paquete_cotizaciones as $pqts)
                @foreach($pqts->itinerario_cotizaciones->sortBy('fecha') as $itinerarios)
                    @foreach($itinerarios->itinerario_servicios->whereIn('liquidacion',array(1,2))->where('liquidacion_id',$liquidacion_id) as $itinerario_servicios)
                        @if($itinerario_servicios->servicio->grupo=='MOVILID' && $itinerario_servicios->servicio->clase=='BOLETO')
                            <tr>
                                <td>{{fecha_peru($itinerarios->fecha)}}</td>
                                <td>{{fecha_peru($itinerario_servicios->fecha_venc)}}</td>
                                <td>{{$itinerario_servicios->servicio->clase}}</td>
                                <td>{{$itinerario_servicios->nombre}}</td>
                                <td>{{$cotizacion_->nropersonas}}</td>
                                <td>
                                    <b>
                                        @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                        {{$cotizaciones_cliente->cliente->nombres}} {{$cotizaciones_cliente->cliente->apellidos}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
                                    @endforeach
                                    </b>
                                </td>
                                <td class="text-center">{{$itinerario_servicios->precio}}</td>
                                <td class="text-center">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                <td>
                                    @if($itinerario_servicios->prioridad=='NORMAL')
                                        <span class="azul">NORMAL</span>
                                    @elseif($itinerario_servicios->prioridad=='URGENTE')
                                        <span class="rojo">URGENTE</span>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
            @endforeach
        @endforeach
        <tr class="my-1">
            <td colspan="7"><b>TOTAL</b></td>
            <td class="text-center"><b><sup>$</sup> {{$liquidacion->total}}</b></td>
        </tr>
        </tbody>
    </table>
@stop