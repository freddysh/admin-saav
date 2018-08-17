@php
function fecha_peru($fecha){
$fecha=explode('-',$fecha);
return $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
}
@endphp
@extends('layouts.admin.book')
@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white m-0">
            <li class="breadcrumb-item" aria-current="page"><a href="/">Home</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="/">Reservas</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="/">Liquidacion</a></li>
            <li class="breadcrumb-item active">Crear Liquidacion</li>
        </ol>
    </nav>
    <hr>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('filtrar_liquidacion_reservas_path')}}" method="post">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="txt_name" class="font-weight-bold text-secondary">Desde:</label>
                                    <input type="date" class="form-control" id="fecha_ini" name="fecha_ini" value="{{$fecha_ini}}">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="txt_name" class="font-weight-bold text-secondary">Hasta:</label>
                                    <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="{{$fecha_fin}}">
                                </div>
                            </div>
                            <div class="col-3 mt-4">
                                {{csrf_field()}}
                                <button type="submit" class="btn btn-primary btn-lg" id="buscar" name="buscar">Buscar</button>
                            </div>
                        </div>
                    </form>
                    <hr>
                    @if($mensaje=='0')
                        <form action="{{route('guardar_liquidacion_reservas_path')}}" method="post">
                            <div class="row">
                            <div class="col-12">
                                <h5 class="text-secondary"><i class="fas fa-angle-right text-primary"></i> BOLETOS TURISTICOS</h5>
                                <table  class="table table-bordered table-sm table-hover small">
                                    <thead>
                                    <tr>
                                        <th>FECHA</th>
                                        <th>CLASE</th>
                                        <th>SERVICIO</th>
                                        <th>AD</th>
                                        <th>PAX</th>
                                        <th>$ AD</th>
                                        <th>TOTAL</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $total_BTG=0;
                                        $array_cotizaciones=[];
                                    @endphp
                                    @foreach($liquidaciones->sortBy('fecha') as $liquidacion)
                                        @foreach($liquidacion->paquete_cotizaciones->where('estado',2) as $paquete_cotizacion)
                                            @foreach($paquete_cotizacion->itinerario_cotizaciones->where('fecha','>=',$fecha_ini)->where('fecha','<=',$fecha_fin)->sortBy('fecha') as $itinerario_cotizacion)
                                                @foreach($itinerario_cotizacion->itinerario_servicios->where('liquidacion','0') as $itinerario_servicio)
                                                    @foreach($servicios->where('id',$itinerario_servicio->m_servicios_id)->where('clase','BTG') as $servicio)
                                                        @if(!in_array($liquidacion->id,$array_cotizaciones))
                                                            @php
                                                                $array_cotizaciones[]=$liquidacion->id;
                                                            @endphp
                                                        @endif
                                                        <tr>
                                                            <td>
                                                                <input type="hidden" name="servicio_liquidacion[]" value="{{$itinerario_servicio->id}}">
                                                                {{fecha_peru($itinerario_cotizacion->fecha)}}</td>
                                                            <td>{{$servicio->clase}}</td>
                                                            <td>{{$itinerario_servicio->nombre}}</td>
                                                            <td>{{$liquidacion->nropersonas}}</td>
                                                            <td>
                                                                @foreach($liquidacion->cotizaciones_cliente as $cotizaciones_cliente)
                                                                    {{$cotizaciones_cliente->cliente->nombres}} x {{$liquidacion->nropersonas}}
                                                                @endforeach
                                                            </td>
                                                            <td>${{$itinerario_servicio->precio_proveedor/$liquidacion->nropersonas}}</td>
                                                            <td>
                                                                ${{$itinerario_servicio->precio_proveedor}}
                                                                @php
                                                                    $total_BTG+=$itinerario_servicio->precio_proveedor;
                                                                @endphp
                                                            </td>
                                                            <td>
                                                                @if($liquidacion->categorizado=='S')
                                                                    {{'Sin factura'}}
                                                                @elseif($liquidacion->categorizado=='C')
                                                                    {{'Con factura'}}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                    <tr class="bg-light">
                                        <td colspan="5"><b>Total</b></td>
                                        <td>$
                                            {{$total_BTG}}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12">
                                <h5 class="text-secondary"><i class="fas fa-angle-right text-primary"></i> INGRESOS A CATEDRAL</h5>
                                <table class="table table-bordered table-sm table-hover">
                                    <thead>
                                    <tr>
                                        <th>FECHA</th>
                                        <th>CLASE</th>
                                        <th>SERVICIO</th>
                                        <th>AD</th>
                                        <th>PAX</th>
                                        <th>$ AD</th>
                                        <th>TOTAL</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $total_CAT=0;
                                    @endphp
                                    @foreach($liquidaciones->sortBy('fecha') as $liquidacion)
                                        @foreach($liquidacion->paquete_cotizaciones->where('estado',2) as $paquete_cotizacion)
                                            @foreach($paquete_cotizacion->itinerario_cotizaciones->where('fecha','>=',$fecha_ini)->where('fecha','<=',$fecha_fin)->sortBy('fecha') as $itinerario_cotizacion)
                                                @foreach($itinerario_cotizacion->itinerario_servicios->where('liquidacion','0') as $itinerario_servicio)
                                                    @foreach($servicios->where('id',$itinerario_servicio->m_servicios_id)->where('clase','CAT') as $servicio)
                                                        @if(!in_array($liquidacion->id,$array_cotizaciones))
                                                            @php
                                                                $array_cotizaciones[]=$liquidacion->id;
                                                            @endphp
                                                        @endif
                                                        <tr>
                                                            <td>
                                                                <input type="hidden" name="servicio_liquidacion[]" value="{{$itinerario_servicio->id}}">
                                                                {{fecha_peru($itinerario_cotizacion->fecha)}}
                                                            </td>
                                                            <td>{{$servicio->clase}}</td>
                                                            <td>{{$itinerario_servicio->nombre}}</td>
                                                            <td>{{$liquidacion->nropersonas}}</td>
                                                            <td>
                                                                @foreach($liquidacion->cotizaciones_cliente as $cotizaciones_cliente)
                                                                    {{$cotizaciones_cliente->cliente->nombres}} x {{$liquidacion->nropersonas}}
                                                                @endforeach
                                                            </td>
                                                            <td>${{$itinerario_servicio->precio_proveedor/$liquidacion->nropersonas}}</td>
                                                            <td>
                                                                ${{$itinerario_servicio->precio_proveedor}}
                                                                @php
                                                                    $total_CAT+=$itinerario_servicio->precio_proveedor;
                                                                @endphp
                                                            </td>
                                                            <td>
                                                                @if($liquidacion->categorizado=='S')
                                                                    {{'Sin factura'}}
                                                                @elseif($liquidacion->categorizado=='C')
                                                                    {{'Con factura'}}
                                                                @endif
                                                            </td>
                                                        </tr>

                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        @endforeach

                                    @endforeach
                                    <tr class="bg-light">
                                        <td colspan="5"><b>Total</b></td>
                                        <td>$
                                            {{$total_CAT}}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12">
                                <h5 class="text-secondary"><i class="fas fa-angle-right text-primary"></i> INGRESOS AL KORICANCHA</h5>
                                <table class="table table-bordered table-sm table-hover">
                                    <thead>
                                    <tr>
                                        <th>FECHA</th>
                                        <th>CLASE</th>
                                        <th>SERVICIO</th>
                                        <th>AD</th>
                                        <th>PAX</th>
                                        <th>$ AD</th>
                                        <th>TOTAL</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $total_KORI=0;
                                    @endphp
                                    @foreach($liquidaciones->sortBy('fecha') as $liquidacion)
                                        @foreach($liquidacion->paquete_cotizaciones->where('estado',2) as $paquete_cotizacion)
                                            @foreach($paquete_cotizacion->itinerario_cotizaciones->where('fecha','>=',$fecha_ini)->where('fecha','<=',$fecha_fin)->sortBy('fecha') as $itinerario_cotizacion)
                                                @foreach($itinerario_cotizacion->itinerario_servicios->where('liquidacion','0') as $itinerario_servicio)
                                                    @foreach($servicios->where('id',$itinerario_servicio->m_servicios_id)->where('clase','KORI') as $servicio)
                                                        @if(!in_array($liquidacion->id,$array_cotizaciones))
                                                            @php
                                                                $array_cotizaciones[]=$liquidacion->id;
                                                            @endphp
                                                        @endif
                                                        <tr>

                                                            <td>
                                                                <input type="hidden" name="servicio_liquidacion[]" value="{{$itinerario_servicio->id}}">
                                                                {{fecha_peru($itinerario_cotizacion->fecha)}}
                                                            </td>
                                                            <td>{{$servicio->clase}}</td>

                                                            <td>{{$itinerario_servicio->nombre}}</td>
                                                            <td>{{$liquidacion->nropersonas}}</td>
                                                            <td>
                                                                @foreach($liquidacion->cotizaciones_cliente as $cotizaciones_cliente)
                                                                    {{$cotizaciones_cliente->cliente->nombres}} x {{$liquidacion->nropersonas}}
                                                                @endforeach

                                                            </td>
                                                            <td>${{$itinerario_servicio->precio_proveedor/$liquidacion->nropersonas}}</td>
                                                            <td>
                                                                ${{$itinerario_servicio->precio_proveedor}}
                                                                @php

                                                                    $total_KORI+=$itinerario_servicio->precio_proveedor;
                                                                @endphp
                                                            </td>
                                                            <td>
                                                                @if($liquidacion->categorizado=='S')
                                                                    {{'Sin factura'}}
                                                                @elseif($liquidacion->categorizado=='C')
                                                                    {{'Con factura'}}
                                                                @endif
                                                            </td>
                                                        </tr>

                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        @endforeach

                                    @endforeach
                                    <tr class="bg-light">
                                        <td colspan="5"><b>Total</b></td>
                                        <td>$
                                            {{$total_KORI}}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12">
                                <h5 class="text-secondary"><i class="fas fa-angle-right text-primary"></i> ENTRADAS A MACHUPICCHU</h5>
                                <table class="table table-bordered table-sm table-hover">
                                    <thead>
                                    <tr>
                                        <th>FECHA</th>
                                        <th>CLASE</th>
                                        <th>SERVICIO</th>
                                        <th>AD</th>
                                        <th>PAX</th>
                                        <th>$ AD</th>
                                        <th>TOTAL</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $total_MAPI=0;
                                    @endphp
                                    @foreach($liquidaciones->sortBy('fecha') as $liquidacion)
                                        @foreach($liquidacion->paquete_cotizaciones->where('estado',2) as $paquete_cotizacion)
                                            @foreach($paquete_cotizacion->itinerario_cotizaciones->where('fecha','>=',$fecha_ini)->where('fecha','<=',$fecha_fin)->sortBy('fecha') as $itinerario_cotizacion)
                                                @foreach($itinerario_cotizacion->itinerario_servicios->where('liquidacion','0') as $itinerario_servicio)
                                                    @foreach($servicios->where('id',$itinerario_servicio->m_servicios_id)->where('clase','MAPI') as $servicio)
                                                        @if(!in_array($liquidacion->id,$array_cotizaciones))
                                                            @php
                                                                $array_cotizaciones[]=$liquidacion->id;
                                                            @endphp
                                                        @endif
                                                        <tr>
                                                            <td>
                                                                <input type="hidden" name="servicio_liquidacion[]" value="{{$itinerario_servicio->id}}">
                                                                {{fecha_peru($itinerario_cotizacion->fecha)}}
                                                            </td>
                                                            <td>{{$servicio->clase}}</td>
                                                            <td>{{$itinerario_servicio->nombre}}</td>
                                                            <td>{{$liquidacion->nropersonas}}</td>
                                                            <td>
                                                                @foreach($liquidacion->cotizaciones_cliente as $cotizaciones_cliente)
                                                                    {{$cotizaciones_cliente->cliente->nombres}} x {{$liquidacion->nropersonas}}
                                                                @endforeach
                                                            </td>
                                                            <td>${{$itinerario_servicio->precio_proveedor/$liquidacion->nropersonas}}</td>
                                                            <td>
                                                                ${{$itinerario_servicio->precio_proveedor}}
                                                                @php
                                                                    $total_MAPI+=$itinerario_servicio->precio_proveedor;
                                                                @endphp
                                                            </td>
                                                            <td>
                                                                @if($liquidacion->categorizado=='S')
                                                                    {{'Sin factura'}}
                                                                @elseif($liquidacion->categorizado=='C')
                                                                    {{'Con factura'}}
                                                                @endif
                                                            </td>

                                                        </tr>

                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        @endforeach

                                    @endforeach
                                    <tr class="bg-light">
                                        <td colspan="5"><b>Total</b></td>
                                        <td>$
                                            {{$total_MAPI}}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12">
                                <h5 class="text-secondary"><i class="fas fa-angle-right text-primary"></i> ENTRADAS OTROS</h5>
                                <table class="table table-bordered table-sm table-hover">
                                    <thead>
                                    <tr>
                                        <th>FECHA</th>
                                        <th>CLASE</th>
                                        <th>SERVICIO</th>
                                        <th>AD</th>
                                        <th>PAX</th>
                                        <th>$ AD</th>
                                        <th>TOTAL</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $total_OTROS=0;
                                    @endphp
                                    @foreach($liquidaciones->sortBy('fecha') as $liquidacion)
                                        @foreach($liquidacion->paquete_cotizaciones->where('estado',2) as $paquete_cotizacion)
                                            @foreach($paquete_cotizacion->itinerario_cotizaciones->where('fecha','>=',$fecha_ini)->where('fecha','<=',$fecha_fin)->sortBy('fecha') as $itinerario_cotizacion)
                                                @foreach($itinerario_cotizacion->itinerario_servicios->where('liquidacion','0') as $itinerario_servicio)
                                                    @foreach($servicios->where('id',$itinerario_servicio->m_servicios_id)->where('clase','OTROS') as $servicio)
                                                        @if(!in_array($liquidacion->id,$array_cotizaciones))
                                                            @php
                                                                $array_cotizaciones[]=$liquidacion->id;
                                                            @endphp
                                                        @endif
                                                        <tr>
                                                            <td>
                                                                <input type="hidden" name="servicio_liquidacion[]" value="{{$itinerario_servicio->id}}">
                                                                {{fecha_peru($itinerario_cotizacion->fecha)}}
                                                            </td>
                                                            <td>{{$servicio->clase}}</td>
                                                            <td>{{$itinerario_servicio->nombre}}</td>
                                                            <td>{{$liquidacion->nropersonas}}</td>
                                                            <td>
                                                                @foreach($liquidacion->cotizaciones_cliente as $cotizaciones_cliente)
                                                                    {{$cotizaciones_cliente->cliente->nombres}} x {{$liquidacion->nropersonas}}
                                                                @endforeach
                                                            </td>
                                                            <td>${{$itinerario_servicio->precio_proveedor/$liquidacion->nropersonas}}</td>
                                                            <td>
                                                                ${{$itinerario_servicio->precio_proveedor}}
                                                                @php
                                                                    $total_MAPI+=$itinerario_servicio->precio_proveedor;
                                                                @endphp
                                                            </td>
                                                            <td>
                                                                @if($liquidacion->categorizado=='S')
                                                                    {{'Sin factura'}}
                                                                @elseif($liquidacion->categorizado=='C')
                                                                    {{'Con factura'}}
                                                                @endif
                                                            </td>

                                                        </tr>

                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        @endforeach

                                    @endforeach
                                    <tr class="bg-light">
                                        <td colspan="5"><b>Total</b></td>
                                        <td>$
                                            {{$total_OTROS}}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12">
                                <h5 class="text-secondary"><i class="fas fa-angle-right text-primary"></i> BUSES</h5>
                                <table class="table table-bordered table-sm table-hover">
                                    <thead>
                                    <tr>
                                        <th>FECHA</th>
                                        <th>CLASE</th>
                                        <th>SERVICIO</th>
                                        <th>AD</th>
                                        <th>PAX</th>
                                        <th>$ AD</th>
                                        <th>TOTAL</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $total_BUSES=0;
                                    @endphp
                                    @foreach($liquidaciones->sortBy('fecha') as $liquidacion)
                                        @foreach($liquidacion->paquete_cotizaciones->where('estado',2) as $paquete_cotizacion)
                                            @foreach($paquete_cotizacion->itinerario_cotizaciones->where('fecha','>=',$fecha_ini)->where('fecha','<=',$fecha_fin)->sortBy('fecha') as $itinerario_cotizacion)
                                                @foreach($itinerario_cotizacion->itinerario_servicios->where('liquidacion','0') as $itinerario_servicio)
                                                    @foreach($servicios_movi->where('id',$itinerario_servicio->m_servicios_id) as $servicio)
                                                        @if(!in_array($liquidacion->id,$array_cotizaciones))
                                                            @php
                                                                $array_cotizaciones[]=$liquidacion->id;
                                                            @endphp
                                                        @endif
                                                        <tr>
                                                            <td>
                                                                <input type="hidden" name="servicio_liquidacion[]" value="{{$itinerario_servicio->id}}">
                                                                {{fecha_peru($itinerario_cotizacion->fecha)}}
                                                            </td>
                                                            <td>{{$servicio->clase}}</td>
                                                            <td>{{$itinerario_servicio->nombre}}</td>
                                                            <td>{{$liquidacion->nropersonas}}</td>
                                                            <td>
                                                                @foreach($liquidacion->cotizaciones_cliente as $cotizaciones_cliente)
                                                                    {{$cotizaciones_cliente->cliente->nombres}} x {{$liquidacion->nropersonas}}
                                                                @endforeach
                                                            </td>
                                                            <td>${{$itinerario_servicio->precio_proveedor/$liquidacion->nropersonas}}</td>
                                                            <td>
                                                                ${{$itinerario_servicio->precio_proveedor}}
                                                                @php
                                                                    $total_BUSES+=$itinerario_servicio->precio_proveedor;
                                                                @endphp
                                                            </td>
                                                            <td>
                                                                @if($liquidacion->categorizado=='S')
                                                                    {{'Sin factura'}}
                                                                @elseif($liquidacion->categorizado=='C')
                                                                    {{'Con factura'}}
                                                                @endif
                                                            </td>

                                                        </tr>

                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        @endforeach

                                    @endforeach
                                    <tr>
                                        <td colspan="6"><b>Total</b></td>
                                        <td>$
                                            {{$total_BUSES}}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12">

                                <div class="col-12 text-right">
                                    {{csrf_field()}}
                                    <input type="hidden" name="desde" value="{{$fecha_ini}}">
                                    <input type="hidden" name="hasta" value="{{$fecha_fin}}">
                                    @php
                                        $cotisa='';
                                    @endphp
                                    @foreach($array_cotizaciones as $array_cotizacion)
                                        @php
                                            $cotisa.=$array_cotizacion.'_';
                                        @endphp
                                    @endforeach
                                    @php
                                        $cotisa=substr($cotisa,0,strlen($cotisa)-1);
                                    @endphp
                                    <input type="hidden" name="cotis" value="{{$cotisa}}">

                                    <button type="submit" class="btn btn-primary" id="buscar" name="buscar">Enviar liquidacion</button>
                                </div>
                            </div>
                            </div>
                        </form>
                    @elseif($mensaje=='1')
                        @if($nro_ini>0)
                        <div class="alert alert-danger" role="alert">
                            <strong>Ups!</strong> La fecha de inicio "{{$fecha_ini}}" esta en una liquidacion enviada.
                        </div>
                        @elseif($nro_fin>0)
                            <div class="alert alert-danger" role="alert">
                                <strong>Ups!</strong> La fecha final "{{$fecha_fin}}" esta en una liquidacion enviada.
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop