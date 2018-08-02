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
            <li class="breadcrumb-item">Reservas</li>
            <li class="breadcrumb-item active">Ver Liquidacion</li>
        </ol>
    </nav>
    <hr>
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="{{route('guardar_liquidacion_reservas_path')}}" method="post">
                <div class="row">
                    <div class="col-12">
                    <h4 class="text-unset">LIQUIDACION DESDE: <span class="text-green-goto">{{fecha_peru($fecha_ini)}}</span> - HASTA: <span class="text-green-goto">{{fecha_peru($fecha_fin)}}</span></h4>
                    <hr>
                    <h5 class="text-secondary mt-4"><i class="fas fa-angle-right text-primary"></i> LIQUIDACION DE BOLETOS TURISTICOS</h5>
                    <table  class="table table-bordered table-sm table-hover">

                        <thead>
                        <tr>
                            <th width="75px">FECHA</th>
                            <th width="60px">CLASE</th>
                            <th width="250px">SERVICIO</th>
                            <th width="50px">AD</th>
                            <th width="180px">PAX</th>
                            <th width="50px">$ AD</th>
                            <th width="50px">TOTAL</th>
                            <th width="60px">CATEGORIA</th>
                            <th width="300px">ESTADO</th>
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
                                    @foreach($itinerario_cotizacion->itinerario_servicios as $itinerario_servicio)
                                        @foreach($servicios->where('id',$itinerario_servicio->m_servicios_id)->where('clase','BTG') as $servicio)
                                            @if(!in_array($liquidacion->id,$array_cotizaciones))
                                                @php
                                                    $array_cotizaciones[]=$liquidacion->id;
                                                @endphp
                                            @endif
                                            <tr>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>
                                                    <input type="hidden" name="servicio_liquidacion[]" value="{{$itinerario_servicio->id}}">
                                                    {{fecha_peru($itinerario_cotizacion->fecha)}}</td>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>{{$servicio->clase}}</td>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>{{$itinerario_servicio->nombre}}</td>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>{{$liquidacion->nropersonas}}</td>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>
                                                    @foreach($liquidacion->cotizaciones_cliente as $cotizaciones_cliente)
                                                        {{$cotizaciones_cliente->cliente->nombres}} x {{$liquidacion->nropersonas}}
                                                    @endforeach
                                                </td>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>${{$itinerario_servicio->precio_proveedor/$liquidacion->nropersonas}}</td>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>
                                                    ${{$itinerario_servicio->precio_proveedor}}
                                                    @php
                                                        $total_BTG+=$itinerario_servicio->precio_proveedor;
                                                    @endphp
                                                </td>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>
                                                    @if($liquidacion->categorizado=='S')
                                                        {{'Sin factura'}}
                                                    @elseif($liquidacion->categorizado=='C')
                                                    {{'Con factura'}}
                                                    @endif
                                                </td>

                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success text-center"  @else class="bg-danger" @endif>
                                                    @if($itinerario_servicio->liquidacion==1)
                                                        <i class="far fa-clock text-white"></i>
                                                    @elseif($itinerario_servicio->liquidacion==2)
                                                        <i class="fas fa-check text-white"></i>
                                                    @endif
                                                    @if($itinerario_servicio->precio_proveedor==0 || $itinerario_servicio->precio_proveedor=='')
                                                            <span class="text-white">Falta asignar proveedor para realizar el pago</span>

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
                                {{$total_BTG}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                    <div class="col-12">
                    <h5 class="text-secondary mt-4"><i class="fas fa-angle-right text-primary"></i> LIQUIDACION DE INGRESOS A CATEDRAL</h5>
                    <table class="table table-bordered table-sm table-hover">

                        <thead>
                        <tr>
                            <th width="75px">FECHA</th>
                            <th width="60px">CLASE</th>
                            <th width="250px">SERVICIO</th>
                            <th width="50px">AD</th>
                            <th width="180px">PAX</th>
                            <th width="50px">$ AD</th>
                            <th width="50px">TOTAL</th>
                            <th width="60px">CATEGORIA</th>
                            <th width="300px">ESTADO</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $total_CAT=0;
                        @endphp
                        @foreach($liquidaciones->sortBy('fecha') as $liquidacion)
                            @foreach($liquidacion->paquete_cotizaciones->where('estado',2) as $paquete_cotizacion)
                                @foreach($paquete_cotizacion->itinerario_cotizaciones->where('fecha','>=',$fecha_ini)->where('fecha','<=',$fecha_fin)->sortBy('fecha') as $itinerario_cotizacion)
                                    @foreach($itinerario_cotizacion->itinerario_servicios as $itinerario_servicio)
                                        @foreach($servicios->where('id',$itinerario_servicio->m_servicios_id)->where('clase','CAT') as $servicio)
                                            @if(!in_array($liquidacion->id,$array_cotizaciones))
                                                @php
                                                    $array_cotizaciones[]=$liquidacion->id;
                                                @endphp
                                            @endif
                                            <tr>
                                            <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>
                                                <input type="hidden" name="servicio_liquidacion[]" value="{{$itinerario_servicio->id}}">
                                                {{fecha_peru($itinerario_cotizacion->fecha)}}
                                            </td>
                                            <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>{{$servicio->clase}}</td>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>{{$itinerario_servicio->nombre}}</td>
                                            <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>{{$liquidacion->nropersonas}}</td>
                                            <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>
                                            @foreach($liquidacion->cotizaciones_cliente as $cotizaciones_cliente)
                                            {{$cotizaciones_cliente->cliente->nombres}} x {{$liquidacion->nropersonas}}
                                            @endforeach
                                            </td>
                                            <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>${{$itinerario_servicio->precio_proveedor/$liquidacion->nropersonas}}</td>
                                            <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>
                                                ${{$itinerario_servicio->precio_proveedor}}
                                                @php
                                                    $total_CAT+=$itinerario_servicio->precio_proveedor;
                                                @endphp
                                            </td>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>
                                                    @if($liquidacion->categorizado=='S')
                                                        {{'Sin factura'}}
                                                    @elseif($liquidacion->categorizado=='C')
                                                    {{'Con factura'}}
                                                    @endif
                                                </td>

                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success text-center"  @else class="bg-danger" @endif>
                                                    @if($itinerario_servicio->liquidacion==1)
                                                        <i class="far fa-clock text-white"></i>
                                                    @elseif($itinerario_servicio->liquidacion==2)
                                                        <i class="fas fa-check text-white"></i>
                                                    @endif
                                                    @if($itinerario_servicio->precio_proveedor==0 || $itinerario_servicio->precio_proveedor=='')
                                                            <span class="text-white">Falta asignar proveedor para realizar el pago</span>

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
                                {{$total_CAT}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                    <div class="col-12">
                    <h5 class="text-secondary mt-4"><i class="fas fa-angle-right text-primary"></i> LIQUIDACION DE INGRESOS AL KORICANCHA</h5>
                    <table class="table table-bordered table-sm table-hover">

                        <thead>
                        <tr>
                            <th width="75px">FECHA</th>
                            <th width="60px">CLASE</th>
                            <th width="250px">SERVICIO</th>
                            <th width="50px">AD</th>
                            <th width="180px">PAX</th>
                            <th width="50px">$ AD</th>
                            <th width="50px">TOTAL</th>
                            <th width="60px">CATEGORIA</th>
                            <th width="300px">ESTADO</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $total_KORI=0;
                        @endphp
                        @foreach($liquidaciones->sortBy('fecha') as $liquidacion)
                            @foreach($liquidacion->paquete_cotizaciones->where('estado',2) as $paquete_cotizacion)
                                @foreach($paquete_cotizacion->itinerario_cotizaciones->where('fecha','>=',$fecha_ini)->where('fecha','<=',$fecha_fin)->sortBy('fecha') as $itinerario_cotizacion)
                                    @foreach($itinerario_cotizacion->itinerario_servicios as $itinerario_servicio)
                                        @foreach($servicios->where('id',$itinerario_servicio->m_servicios_id)->where('clase','KORI') as $servicio)
                                            @if(!in_array($liquidacion->id,$array_cotizaciones))
                                                @php
                                                    $array_cotizaciones[]=$liquidacion->id;
                                                @endphp
                                            @endif
                                            <tr>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>
                                                    <input type="hidden" name="servicio_liquidacion[]" value="{{$itinerario_servicio->id}}">
                                                    {{fecha_peru($itinerario_cotizacion->fecha)}}
                                                </td>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>{{$servicio->clase}}</td>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>{{$itinerario_servicio->nombre}}</td>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>{{$liquidacion->nropersonas}}</td>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>
                                                    @foreach($liquidacion->cotizaciones_cliente as $cotizaciones_cliente)
                                                        {{$cotizaciones_cliente->cliente->nombres}} x {{$liquidacion->nropersonas}}
                                                    @endforeach
                                                </td>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>${{$itinerario_servicio->precio_proveedor/$liquidacion->nropersonas}}</td>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>
                                                    ${{$itinerario_servicio->precio_proveedor}}
                                                    @php
                                                        $total_KORI+=$itinerario_servicio->precio_proveedor;
                                                    @endphp
                                                </td>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>
                                                    @if($liquidacion->categorizado=='S')
                                                        {{'Sin factura'}}
                                                    @elseif($liquidacion->categorizado=='C')
                                                    {{'Con factura'}}
                                                    @endif
                                                </td>

                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success text-center"  @else class="bg-danger" @endif>
                                                    @if($itinerario_servicio->liquidacion==1)
                                                        <i class="far fa-clock text-white"></i>
                                                    @elseif($itinerario_servicio->liquidacion==2)
                                                        <i class="fas fa-check text-white"></i>
                                                    @endif
                                                    @if($itinerario_servicio->precio_proveedor==0 || $itinerario_servicio->precio_proveedor=='')
                                                            <span class="text-white">Falta asignar proveedor para realizar el pago</span>

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
                                {{$total_KORI}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                    <div class="col-12">
                    <h5 class="text-secondary mt-4"><i class="fas fa-angle-right text-primary"></i> LIQUIDACION DE ENTRADAS A MACHUPICCHU</h5>
                    <table class="table table-bordered table-sm table-hover">

                        <thead>
                        <tr>
                            <th width="75px">FECHA</th>
                            <th width="60px">CLASE</th>
                            <th width="250px">SERVICIO</th>
                            <th width="50px">AD</th>
                            <th width="180px">PAX</th>
                            <th width="50px">$ AD</th>
                            <th width="50px">TOTAL</th>
                            <th width="60px">CATEGORIA</th>
                            <th width="300px">ESTADO</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $total_MAPI=0;
                        @endphp
                        @foreach($liquidaciones->sortBy('fecha') as $liquidacion)
                            @foreach($liquidacion->paquete_cotizaciones->where('estado',2) as $paquete_cotizacion)
                                @foreach($paquete_cotizacion->itinerario_cotizaciones->where('fecha','>=',$fecha_ini)->where('fecha','<=',$fecha_fin)->sortBy('fecha') as $itinerario_cotizacion)
                                    @foreach($itinerario_cotizacion->itinerario_servicios as $itinerario_servicio)
                                        @foreach($servicios->where('id',$itinerario_servicio->m_servicios_id)->where('clase','MAPI') as $servicio)
                                            @if(!in_array($liquidacion->id,$array_cotizaciones))
                                                @php
                                                    $array_cotizaciones[]=$liquidacion->id;
                                                @endphp
                                            @endif
                                            <tr>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>
                                                    <input type="hidden" name="servicio_liquidacion[]" value="{{$itinerario_servicio->id}}">
                                                    {{fecha_peru($itinerario_cotizacion->fecha)}}
                                                </td>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>{{$servicio->clase}}</td>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>{{$itinerario_servicio->nombre}}</td>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>{{$liquidacion->nropersonas}}</td>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>
                                                    @foreach($liquidacion->cotizaciones_cliente as $cotizaciones_cliente)
                                                        {{$cotizaciones_cliente->cliente->nombres}} x {{$liquidacion->nropersonas}}
                                                    @endforeach
                                                </td>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>${{$itinerario_servicio->precio_proveedor/$liquidacion->nropersonas}}</td>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>
                                                    ${{$itinerario_servicio->precio_proveedor}}
                                                    @php
                                                        $total_MAPI+=$itinerario_servicio->precio_proveedor;
                                                    @endphp
                                                </td>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>
                                                    @if($liquidacion->categorizado=='S')
                                                        {{'Sin factura'}}
                                                    @elseif($liquidacion->categorizado=='C')
                                                        {{'Con factura'}}
                                                    @endif
                                                </td>

                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success text-center"  @else class="bg-danger" @endif>
                                                    @if($itinerario_servicio->liquidacion==1)
                                                        <i class="far fa-clock text-white"></i>
                                                    @elseif($itinerario_servicio->liquidacion==2)
                                                        <i class="fas fa-check text-white"></i>
                                                    @endif
                                                    @if($itinerario_servicio->precio_proveedor==0 || $itinerario_servicio->precio_proveedor=='')
                                                            <span class="text-white">Falta asignar proveedor para realizar el pago</span>

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
                                {{$total_MAPI}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                    <div class="col-12">
                    <h5 class="text-secondary mt-4"><i class="fas fa-angle-right text-primary"></i> LIQUIDACION DE ENTRADAS A OTROS LUGARES</h5>
                    <table class="table table-bordered table-sm table-hover">

                        <thead>
                        <tr>
                            <th width="75px">FECHA</th>
                            <th width="60px">CLASE</th>
                            <th width="250px">SERVICIO</th>
                            <th width="50px">AD</th>
                            <th width="180px">PAX</th>
                            <th width="50px">$ AD</th>
                            <th width="50px">TOTAL</th>
                            <th width="60px">CATEGORIA</th>
                            <th width="300px">ESTADO</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $total_OTROS=0;
                        @endphp
                        @foreach($liquidaciones->sortBy('fecha') as $liquidacion)
                            @foreach($liquidacion->paquete_cotizaciones->where('estado',2) as $paquete_cotizacion)
                                @foreach($paquete_cotizacion->itinerario_cotizaciones->where('fecha','>=',$fecha_ini)->where('fecha','<=',$fecha_fin)->sortBy('fecha') as $itinerario_cotizacion)
                                    @foreach($itinerario_cotizacion->itinerario_servicios as $itinerario_servicio)
                                        @foreach($servicios->where('id',$itinerario_servicio->m_servicios_id)->where('clase','OTROS') as $servicio)
                                            @if(!in_array($liquidacion->id,$array_cotizaciones))
                                                @php
                                                    $array_cotizaciones[]=$liquidacion->id;
                                                @endphp
                                            @endif
                                            <tr>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>
                                                    <input type="hidden" name="servicio_liquidacion[]" value="{{$itinerario_servicio->id}}">
                                                    {{fecha_peru($itinerario_cotizacion->fecha)}}
                                                </td>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>{{$servicio->clase}}</td>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>{{$itinerario_servicio->nombre}}</td>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>{{$liquidacion->nropersonas}}</td>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>
                                                    @foreach($liquidacion->cotizaciones_cliente as $cotizaciones_cliente)
                                                        {{$cotizaciones_cliente->cliente->nombres}} x {{$liquidacion->nropersonas}}
                                                    @endforeach
                                                </td>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>${{$itinerario_servicio->precio_proveedor/$liquidacion->nropersonas}}</td>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>
                                                    ${{$itinerario_servicio->precio_proveedor}}
                                                    @php
                                                        $total_OTROS+=$itinerario_servicio->precio_proveedor;
                                                    @endphp
                                                </td>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>
                                                    @if($liquidacion->categorizado=='S')
                                                        {{'Sin factura'}}
                                                    @elseif($liquidacion->categorizado=='C')
                                                        {{'Con factura'}}
                                                    @endif
                                                </td>

                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success text-center"  @else class="bg-danger" @endif>
                                                    @if($itinerario_servicio->liquidacion==1)
                                                        <i class="far fa-clock text-white"></i>
                                                    @elseif($itinerario_servicio->liquidacion==2)
                                                        <i class="fas fa-check text-white"></i>
                                                    @endif
                                                    @if($itinerario_servicio->precio_proveedor==0 || $itinerario_servicio->precio_proveedor=='')
                                                            <span class="text-white">Falta asignar proveedor para realizar el pago</span>

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
                                {{$total_OTROS}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                    <div class="col-12">
                    <h5 class="text-secondary mt-4"><i class="fas fa-angle-right text-primary"></i> LIQUIDACION DE BUSES</h5>
                    <table class="table table-bordered table-sm table-hover">

                        <thead>
                        <tr>
                            <th width="75px">FECHA</th>
                            <th width="60px">CLASE</th>
                            <th width="250px">SERVICIO</th>
                            <th width="50px">AD</th>
                            <th width="180px">PAX</th>
                            <th width="50px">$ AD</th>
                            <th width="50px">TOTAL</th>
                            <th width="60px">CATEGORIA</th>
                            <th width="300px">ESTADO</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $total_BUSES=0;
                        @endphp
                        @foreach($liquidaciones->sortBy('fecha') as $liquidacion)
                            @foreach($liquidacion->paquete_cotizaciones->where('estado',2) as $paquete_cotizacion)
                                @foreach($paquete_cotizacion->itinerario_cotizaciones->where('fecha','>=',$fecha_ini)->where('fecha','<=',$fecha_fin)->sortBy('fecha') as $itinerario_cotizacion)
                                    @foreach($itinerario_cotizacion->itinerario_servicios as $itinerario_servicio)
                                        @foreach($servicios_movi->where('id',$itinerario_servicio->m_servicios_id) as $servicio)
                                            @if(!in_array($liquidacion->id,$array_cotizaciones))
                                                @php
                                                    $array_cotizaciones[]=$liquidacion->id;
                                                @endphp
                                            @endif
                                            <tr>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>
                                                    <input type="hidden" name="servicio_liquidacion[]" value="{{$itinerario_servicio->id}}">
                                                    {{fecha_peru($itinerario_cotizacion->fecha)}}
                                                </td>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>{{$servicio->clase}}</td>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>{{$itinerario_servicio->nombre}}</td>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>{{$liquidacion->nropersonas}}</td>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>
                                                    @foreach($liquidacion->cotizaciones_cliente as $cotizaciones_cliente)
                                                        {{$cotizaciones_cliente->cliente->nombres}} x {{$liquidacion->nropersonas}}
                                                    @endforeach
                                                </td>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>${{$itinerario_servicio->precio_proveedor/$liquidacion->nropersonas}}</td>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>
                                                    ${{$itinerario_servicio->precio_proveedor}}
                                                    @php
                                                        $total_BUSES+=$itinerario_servicio->precio_proveedor;
                                                    @endphp
                                                </td>
                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success"  @else class="bg-danger" @endif>
                                                    @if($liquidacion->categorizado=='S')
                                                        {{'Sin factura'}}
                                                    @elseif($liquidacion->categorizado=='C')
                                                        {{'Con factura'}}
                                                    @endif
                                                </td>

                                                <td @if($itinerario_servicio->liquidacion==2) class="bg-success text-center"  @else class="bg-danger"  @endif>
                                                    @if($itinerario_servicio->liquidacion==1)
                                                        <i class="far fa-clock text-white"></i>
                                                    @elseif($itinerario_servicio->liquidacion==2)
                                                        <i class="fas fa-check text-white"></i>
                                                    @endif
                                                    @if($itinerario_servicio->precio_proveedor==0 || $itinerario_servicio->precio_proveedor=='')
                                                            <span class="text-white">Falta asignar proveedor para realizar el pago</span>

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

                    <div class="col-12 text-right">

                        <h2 class="text-grey-goto">
                            TOTAL: ${{($total_BTG+$total_CAT+$total_KORI+$total_MAPI+$total_BUSES)}}
                        </h2>
                    </div>

                    <div class="col-lg-12 text-right d-none">

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
                            $cotisa=substr($array_cotizacion,0,strlen($array_cotizacion));
                        @endphp
                        <input type="hidden" name="cotis" value="{{$cotisa}}">
                        <button type="submit" class="btn btn-primary" id="buscar" name="buscar">Enviar liquidacion</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <script>
        $(function () {
            $('#propover_exam').popover()
        })
    </script>

@stop