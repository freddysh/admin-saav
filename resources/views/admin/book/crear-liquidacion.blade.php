@php
function fecha_peru($fecha){
$fecha=explode('-',$fecha);
return $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
}
@endphp
@extends('layouts.admin.book')
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Reservas</li>
            <li>Liquidacion</li>
            <li class="active">Crear Liquidacion</li>
        </ol>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="{{route('filtrar_liquidacion_reservas_path')}}" method="post">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="txt_name">Desde:</label>
                        <input type="date" class="form-control" id="fecha_ini" name="fecha_ini" value="{{$fecha_ini}}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="txt_name">Hasta:</label>
                        <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="{{$fecha_fin}}">
                    </div>
                </div>
                <div class="col-lg-3 margin-top-25">
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-primary" id="buscar" name="buscar">Buscar</button>
                </div>
            </form>
            <form action="{{route('guardar_liquidacion_reservas_path')}}" method="post">
                <div class="col-lg-12">
                    <h4>LIQUIDACION DE BOLETOS TURISTICOS</h4>
                    <table  class="table table-bordered table-striped table-responsive table-hover">
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
                        <tr>
                            <td colspan="5"><b>Total</b></td>
                            <td>$
                                {{$total_BTG}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-12">
                    <h4>LIQUIDACION DE INGRESOS A CATEDRAL</h4>
                    <table class="table table-bordered table-striped table-responsive table-hover">
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
                        <tr>
                            <td colspan="5"><b>Total</b></td>
                            <td>$
                                {{$total_CAT}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-12">
                    <h4>LIQUIDACION DE INGRESOS AL KORICANCHA</h4>
                    <table class="table table-bordered table-striped table-responsive table-hover">
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
                        <tr>
                            <td colspan="5"><b>Total</b></td>
                            <td>$
                                {{$total_KORI}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-12">
                    <h4>LIQUIDACION DE ENTRADAS A MACHUPICCHU</h4>
                    <table class="table table-bordered table-striped table-responsive table-hover">
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
                        <tr>
                            <td colspan="5"><b>Total</b></td>
                            <td>$
                                {{$total_MAPI}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-12">
                    <h4>LIQUIDACION DE ENTRADAS OTROS</h4>
                    <table class="table table-bordered table-striped table-responsive table-hover">
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
                        <tr>
                            <td colspan="5"><b>Total</b></td>
                            <td>$
                                {{$total_OTROS}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-12">
                    <h4>LIQUIDACION DE BUSES</h4>
                    <table class="table table-bordered table-striped table-responsive table-hover">
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
                <div class="col-lg-12">
                    <div class="col-lg-12 text-right">
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
            </form>
        </div>
    </div>
@stop