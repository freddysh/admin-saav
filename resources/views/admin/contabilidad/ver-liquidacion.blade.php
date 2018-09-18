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
            <li>Contabilidad</li>
            <li>Operaciones</li>
            <li>Pagos pendientes</li>
            <li class="active">Entrances</li>
        </ol>
    </div>
    <div class="card w-100">
        <div class="card-body">
            {{--<form action="{{route('guardar_liquidacion_reservas_path')}}" method="post">--}}
            <div class="col-lg-12">
                <h4 class="text-unset">LIQUIDACION DESDE: <span class="text-green-goto">{{fecha_peru($fecha_ini)}}</span> - HASTA: <span class="text-green-goto">{{fecha_peru($fecha_fin)}}</span></h4>
                <hr>
            </div>
            <ul class="nav nav-tabs nav-justified">
                <li class="nav-item @if($tipo_cheque=='C'){{'active'}}@endif"><a data-toggle="tab" href="#confactura" class="nav-link rounded-0 @if($tipo_cheque=='C'){{'active show'}}@endif">CON FACTURA</a></li>
                <li class="nav-item @if($tipo_cheque=='S'){{'active'}}@endif" ><a data-toggle="tab" href="#sinfactura" class="nav-link rounded-0 @if($tipo_cheque=='S'){{'active show'}}@endif">SIN FACTURA</a></li>
            </ul>
            <div class="tab-content">
                <div id="confactura" class="tab-pane fade @if($tipo_cheque=='C') active show @endif">
                    <div class="col-lg-12">
                        <h4>LIQUIDACION DE BOLETOS TURISTICOS</h4>
                        <table  class="table table-bordered table-striped table-responsive table-hover">
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
                                $no_reservados=0;
                            @endphp
                            @foreach($liquidaciones->where('categorizado','C')->sortBy('fecha') as $liquidacion)
                                @foreach($liquidacion->paquete_cotizaciones->where('estado',2) as $paquete_cotizacion)
                                    @foreach($paquete_cotizacion->itinerario_cotizaciones->where('fecha','>=',$fecha_ini)->where('fecha','<=',$fecha_fin)->sortBy('fecha') as $itinerario_cotizacion)
                                        @foreach($itinerario_cotizacion->itinerario_servicios->where('liquidacion','!=','0') as $itinerario_servicio)
                                            @foreach($servicios->where('id',$itinerario_servicio->m_servicios_id)->where('clase','BTG') as $servicio)
                                                @if(!in_array($liquidacion->id,$array_cotizaciones))
                                                    @php
                                                        $array_cotizaciones[]=$liquidacion->id;
                                                    @endphp
                                                @endif
                                                <tr>
                                                    <td id="fecha_{{$itinerario_servicio->id}}"  @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        <input type="hidden" name="servicio_liquidacion[]" value="{{$itinerario_servicio->id}}">
                                                        {{fecha_peru($itinerario_cotizacion->fecha)}}</td>
                                                    <td id="clase_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>{{$servicio->clase}}</td>
                                                    <td id="servicio_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>{{$itinerario_servicio->nombre}}</td>
                                                    <td id="ad_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>{{$liquidacion->nropersonas}}</td>
                                                    <td id="pax_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        @foreach($liquidacion->cotizaciones_cliente as $cotizaciones_cliente)
                                                            {{$cotizaciones_cliente->cliente->nombres}} x {{$liquidacion->nropersonas}}
                                                        @endforeach
                                                    </td>
                                                    <td id="ads_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>${{$itinerario_servicio->precio_proveedor/$liquidacion->nropersonas}}</td>
                                                    <td id="total_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        ${{$itinerario_servicio->precio_proveedor}}
                                                        @if($itinerario_servicio->precio_proveedor==0 || $itinerario_servicio->precio_proveedor=='')
                                                            @php
                                                                $no_reservados++;
                                                            @endphp
                                                        @endif
                                                        @php
                                                            $total_BTG+=$itinerario_servicio->precio_proveedor;
                                                        @endphp
                                                    </td>
                                                    <td id="categoria_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        @if($liquidacion->categorizado=='S')
                                                            {{'Sin factura'}}
                                                        @elseif($liquidacion->categorizado=='C')
                                                            {{'Con factura'}}
                                                        @endif
                                                    </td>
                                                    <td id="estado_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        @if($itinerario_servicio->liquidacion==1)
                                                            <button id="btn_pagar_{{$itinerario_servicio->id}}" class="btn btn-primary" onclick="pagar_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Pagar</button>
                                                            <i id="check_{{$itinerario_servicio->id}}" class="fa fa-check-square-o text-success fa-2x hide"></i>
                                                            <button id="btn_revertir_{{$itinerario_servicio->id}}" class="btn btn-warning hide" onclick="revertir_pago_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Revertir</button>
                                                        @elseif($itinerario_servicio->liquidacion==2)
                                                            <button id="btn_pagar_{{$itinerario_servicio->id}}" class="btn btn-primary hide" onclick="pagar_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Pagar</button>
                                                            <i id="check_{{$itinerario_servicio->id}}" class="fa fa-check-square-o text-success fa-2x"></i>
                                                            <button id="btn_revertir_{{$itinerario_servicio->id}}" class="btn btn-warning" onclick="revertir_pago_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Revertir</button>
                                                        @endif
                                                        @if($itinerario_servicio->precio_proveedor==0 || $itinerario_servicio->precio_proveedor=='')
                                                            <p class="text-danger">Falta asignar proveedor para realizar el pago</p>
                                                            @endifclass="text-danger">Falta asignar proveedor para realizar el pago</p>
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
                    <div class="col-lg-12">
                        <h4>LIQUIDACION DE INGRESOS A CATEDRAL</h4>
                        <table class="table table-bordered table-striped table-responsive table-hover">
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
                            @foreach($liquidaciones->where('categorizado','C')->sortBy('fecha') as $liquidacion)
                                @foreach($liquidacion->paquete_cotizaciones->where('estado',2) as $paquete_cotizacion)
                                    @foreach($paquete_cotizacion->itinerario_cotizaciones->where('fecha','>=',$fecha_ini)->where('fecha','<=',$fecha_fin)->sortBy('fecha') as $itinerario_cotizacion)
                                        @foreach($itinerario_cotizacion->itinerario_servicios->where('liquidacion','!=','0') as $itinerario_servicio)
                                            @foreach($servicios->where('id',$itinerario_servicio->m_servicios_id)->where('clase','CAT') as $servicio)
                                                @if(!in_array($liquidacion->id,$array_cotizaciones))
                                                    @php
                                                        $array_cotizaciones[]=$liquidacion->id;
                                                    @endphp
                                                @endif
                                                <tr>
                                                    <td id="fecha_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        <input type="hidden" name="servicio_liquidacion[]" value="{{$itinerario_servicio->id}}">
                                                        {{fecha_peru($itinerario_cotizacion->fecha)}}
                                                    </td>
                                                    <td id="clase_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>{{$servicio->clase}}</td>
                                                    <td id="servicio_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>{{$itinerario_servicio->nombre}}</td>
                                                    <td id="ad_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>{{$liquidacion->nropersonas}}</td>
                                                    <td id="pax_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        @foreach($liquidacion->cotizaciones_cliente as $cotizaciones_cliente)
                                                            {{$cotizaciones_cliente->cliente->nombres}} x {{$liquidacion->nropersonas}}
                                                        @endforeach
                                                    </td>
                                                    <td id="ads_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>${{$itinerario_servicio->precio_proveedor/$liquidacion->nropersonas}}</td>
                                                    <td id="total_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        ${{$itinerario_servicio->precio_proveedor}}
                                                        @if($itinerario_servicio->precio_proveedor==0 || $itinerario_servicio->precio_proveedor=='')
                                                            @php
                                                                $no_reservados++;
                                                            @endphp
                                                        @endif
                                                        @php
                                                            $total_CAT+=$itinerario_servicio->precio_proveedor;
                                                        @endphp
                                                    </td>
                                                    <td id="categoria_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        @if($liquidacion->categorizado=='S')
                                                            {{'Sin factura'}}
                                                        @elseif($liquidacion->categorizado=='C')
                                                            {{'Con factura'}}
                                                        @endif
                                                    </td>
                                                    <td id="estado_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        @if($itinerario_servicio->liquidacion==1)
                                                            <button id="btn_pagar_{{$itinerario_servicio->id}}" class="btn btn-primary" onclick="pagar_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Pagar</button>
                                                            <i id="check_{{$itinerario_servicio->id}}" class="fa fa-check-square-o text-success fa-2x hide"></i>
                                                            <button id="btn_revertir_{{$itinerario_servicio->id}}" class="btn btn-warning hide" onclick="revertir_pago_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Revertir</button>
                                                        @elseif($itinerario_servicio->liquidacion==2)
                                                            <button id="btn_pagar_{{$itinerario_servicio->id}}" class="btn btn-primary hide" onclick="pagar_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Pagar</button>
                                                            <i id="check_{{$itinerario_servicio->id}}" class="fa fa-check-square-o text-success fa-2x"></i>
                                                            <button id="btn_revertir_{{$itinerario_servicio->id}}" class="btn btn-warning" onclick="revertir_pago_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Revertir</button>
                                                        @endif
                                                        @if($itinerario_servicio->precio_proveedor==0 || $itinerario_servicio->precio_proveedor=='')
                                                            <p class="text-danger">Falta asignar proveedor para realizar el pago</p>
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
                    <div class="col-lg-12">
                        <h4>LIQUIDACION DE INGRESOS AL KORICANCHA</h4>
                        <table class="table table-bordered table-striped table-responsive table-hover">
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
                            @foreach($liquidaciones->where('categorizado','C')->sortBy('fecha') as $liquidacion)
                                @foreach($liquidacion->paquete_cotizaciones->where('estado',2) as $paquete_cotizacion)
                                    @foreach($paquete_cotizacion->itinerario_cotizaciones->where('fecha','>=',$fecha_ini)->where('fecha','<=',$fecha_fin)->sortBy('fecha') as $itinerario_cotizacion)
                                        @foreach($itinerario_cotizacion->itinerario_servicios->where('liquidacion','!=','0') as $itinerario_servicio)
                                            @foreach($servicios->where('id',$itinerario_servicio->m_servicios_id)->where('clase','KORI') as $servicio)
                                                @if(!in_array($liquidacion->id,$array_cotizaciones))
                                                    @php
                                                        $array_cotizaciones[]=$liquidacion->id;
                                                    @endphp
                                                @endif
                                                <tr>
                                                    <td id="fecha_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        <input type="hidden" name="servicio_liquidacion[]" value="{{$itinerario_servicio->id}}">
                                                        {{fecha_peru($itinerario_cotizacion->fecha)}}
                                                    </td>
                                                    <td id="clase_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>{{$servicio->clase}}</td>
                                                    <td id="servicio_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>{{$itinerario_servicio->nombre}}</td>
                                                    <td id="ad_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>{{$liquidacion->nropersonas}}</td>
                                                    <td id="pax_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        @foreach($liquidacion->cotizaciones_cliente as $cotizaciones_cliente)
                                                            {{$cotizaciones_cliente->cliente->nombres}} x {{$liquidacion->nropersonas}}
                                                        @endforeach
                                                    </td>
                                                    <td id="ads_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>${{$itinerario_servicio->precio_proveedor/$liquidacion->nropersonas}}</td>
                                                    <td id="total_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        ${{$itinerario_servicio->precio_proveedor}}
                                                        @if($itinerario_servicio->precio_proveedor==0 || $itinerario_servicio->precio_proveedor=='')
                                                            @php
                                                                $no_reservados++;
                                                            @endphp
                                                        @endif
                                                        @php
                                                            $total_KORI+=$itinerario_servicio->precio_proveedor;
                                                        @endphp
                                                    </td>
                                                    <td id="categoria_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        @if($liquidacion->categorizado=='S')
                                                            {{'Sin factura'}}
                                                        @elseif($liquidacion->categorizado=='C')
                                                            {{'Con factura'}}
                                                        @endif
                                                    </td>
                                                    <td id="estado_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        @if($itinerario_servicio->liquidacion==1)
                                                            <button id="btn_pagar_{{$itinerario_servicio->id}}" class="btn btn-primary" onclick="pagar_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Pagar</button>
                                                            <i id="check_{{$itinerario_servicio->id}}" class="fa fa-check-square-o text-success fa-2x hide"></i>
                                                            <button id="btn_revertir_{{$itinerario_servicio->id}}" class="btn btn-warning hide" onclick="revertir_pago_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Revertir</button>
                                                        @elseif($itinerario_servicio->liquidacion==2)
                                                            <button id="btn_pagar_{{$itinerario_servicio->id}}" class="btn btn-primary hide" onclick="pagar_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Pagar</button>
                                                            <i id="check_{{$itinerario_servicio->id}}" class="fa fa-check-square-o text-success fa-2x"></i>
                                                            <button id="btn_revertir_{{$itinerario_servicio->id}}" class="btn btn-warning" onclick="revertir_pago_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Revertir</button>
                                                        @endif
                                                        @if($itinerario_servicio->precio_proveedor==0 || $itinerario_servicio->precio_proveedor=='')
                                                            <p class="text-danger">Falta asignar proveedor para realizar el pago</p>
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
                    <div class="col-lg-12">
                        <h4>LIQUIDACION DE ENTRADAS A MACHUPICCHU</h4>
                        <table class="table table-bordered table-striped table-responsive table-hover">
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
                            @foreach($liquidaciones->where('categorizado','C')->sortBy('fecha') as $liquidacion)
                                @foreach($liquidacion->paquete_cotizaciones->where('estado',2) as $paquete_cotizacion)
                                    @foreach($paquete_cotizacion->itinerario_cotizaciones->where('fecha','>=',$fecha_ini)->where('fecha','<=',$fecha_fin)->sortBy('fecha') as $itinerario_cotizacion)
                                        @foreach($itinerario_cotizacion->itinerario_servicios->where('liquidacion','!=','0') as $itinerario_servicio)
                                            @foreach($servicios->where('id',$itinerario_servicio->m_servicios_id)->where('clase','MAPI') as $servicio)
                                                @if(!in_array($liquidacion->id,$array_cotizaciones))
                                                    @php
                                                        $array_cotizaciones[]=$liquidacion->id;
                                                    @endphp
                                                @endif
                                                <tr>
                                                    <td id="fecha_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        <input type="hidden" name="servicio_liquidacion[]" value="{{$itinerario_servicio->id}}">
                                                        {{fecha_peru($itinerario_cotizacion->fecha)}}
                                                    </td>
                                                    <td id="clase_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>{{$servicio->clase}}</td>
                                                    <td id="servicio_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>{{$itinerario_servicio->nombre}}</td>
                                                    <td id="ad_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>{{$liquidacion->nropersonas}}</td>
                                                    <td id="pax_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        @foreach($liquidacion->cotizaciones_cliente as $cotizaciones_cliente)
                                                            {{$cotizaciones_cliente->cliente->nombres}} x {{$liquidacion->nropersonas}}
                                                        @endforeach
                                                    </td>
                                                    <td id="ads_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>${{$itinerario_servicio->precio_proveedor/$liquidacion->nropersonas}}</td>
                                                    <td id="total_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        ${{$itinerario_servicio->precio_proveedor}}
                                                        @if($itinerario_servicio->precio_proveedor==0 || $itinerario_servicio->precio_proveedor=='')
                                                            @php
                                                                $no_reservados++;
                                                            @endphp
                                                        @endif
                                                        @php
                                                            $total_MAPI+=$itinerario_servicio->precio_proveedor;
                                                        @endphp
                                                    </td>
                                                    <td id="categoria_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        @if($liquidacion->categorizado=='S')
                                                            {{'Sin factura'}}
                                                        @elseif($liquidacion->categorizado=='C')
                                                            {{'Con factura'}}
                                                        @endif
                                                    </td>
                                                    <td id="estado_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        @if($itinerario_servicio->liquidacion==1)
                                                            <button id="btn_pagar_{{$itinerario_servicio->id}}" class="btn btn-primary" onclick="pagar_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Pagar</button>
                                                            <i id="check_{{$itinerario_servicio->id}}" class="fa fa-check-square-o text-success fa-2x hide"></i>
                                                            <button id="btn_revertir_{{$itinerario_servicio->id}}" class="btn btn-warning hide" onclick="revertir_pago_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Revertir</button>
                                                        @elseif($itinerario_servicio->liquidacion==2)
                                                            <button id="btn_pagar_{{$itinerario_servicio->id}}" class="btn btn-primary hide" onclick="pagar_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Pagar</button>
                                                            <i id="check_{{$itinerario_servicio->id}}" class="fa fa-check-square-o text-success fa-2x"></i>
                                                            <button id="btn_revertir_{{$itinerario_servicio->id}}" class="btn btn-warning" onclick="revertir_pago_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Revertir</button>
                                                        @endif
                                                        @if($itinerario_servicio->precio_proveedor==0 || $itinerario_servicio->precio_proveedor=='')
                                                            <p class="text-danger">Falta asignar proveedor para realizar el pago</p>
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
                    <div class="col-lg-12">
                        <h4>LIQUIDACION DE ENTRADAS A OTROS LUGARES</h4>
                        <table class="table table-bordered table-striped table-responsive table-hover">
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
                            @foreach($liquidaciones->where('categorizado','C')->sortBy('fecha') as $liquidacion)
                                @foreach($liquidacion->paquete_cotizaciones->where('estado',2) as $paquete_cotizacion)
                                    @foreach($paquete_cotizacion->itinerario_cotizaciones->where('fecha','>=',$fecha_ini)->where('fecha','<=',$fecha_fin)->sortBy('fecha') as $itinerario_cotizacion)
                                        @foreach($itinerario_cotizacion->itinerario_servicios->where('liquidacion','!=','0') as $itinerario_servicio)
                                            @foreach($servicios->where('id',$itinerario_servicio->m_servicios_id)->where('clase','OTROS') as $servicio)
                                                @if(!in_array($liquidacion->id,$array_cotizaciones))
                                                    @php
                                                        $array_cotizaciones[]=$liquidacion->id;
                                                    @endphp
                                                @endif
                                                <tr>
                                                    <td id="fecha_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        <input type="hidden" name="servicio_liquidacion[]" value="{{$itinerario_servicio->id}}">
                                                        {{fecha_peru($itinerario_cotizacion->fecha)}}
                                                    </td>
                                                    <td id="clase_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>{{$servicio->clase}}</td>
                                                    <td id="servicio_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>{{$itinerario_servicio->nombre}}</td>
                                                    <td id="ad_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>{{$liquidacion->nropersonas}}</td>
                                                    <td id="pax_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        @foreach($liquidacion->cotizaciones_cliente as $cotizaciones_cliente)
                                                            {{$cotizaciones_cliente->cliente->nombres}} x {{$liquidacion->nropersonas}}
                                                        @endforeach
                                                    </td>
                                                    <td id="ads_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>${{$itinerario_servicio->precio_proveedor/$liquidacion->nropersonas}}</td>
                                                    <td id="total_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        ${{$itinerario_servicio->precio_proveedor}}
                                                        @if($itinerario_servicio->precio_proveedor==0 || $itinerario_servicio->precio_proveedor=='')
                                                            @php
                                                                $no_reservados++;
                                                            @endphp
                                                        @endif
                                                        @php
                                                            $total_OTROS+=$itinerario_servicio->precio_proveedor;
                                                        @endphp
                                                    </td>
                                                    <td id="categoria_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        @if($liquidacion->categorizado=='S')
                                                            {{'Sin factura'}}
                                                        @elseif($liquidacion->categorizado=='C')
                                                            {{'Con factura'}}
                                                        @endif
                                                    </td>
                                                    <td id="estado_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        @if($itinerario_servicio->liquidacion==1)
                                                            <button id="btn_pagar_{{$itinerario_servicio->id}}" class="btn btn-primary" onclick="pagar_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Pagar</button>
                                                            <i id="check_{{$itinerario_servicio->id}}" class="fa fa-check-square-o text-success fa-2x hide"></i>
                                                            <button id="btn_revertir_{{$itinerario_servicio->id}}" class="btn btn-warning hide" onclick="revertir_pago_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Revertir</button>
                                                        @elseif($itinerario_servicio->liquidacion==2)
                                                            <button id="btn_pagar_{{$itinerario_servicio->id}}" class="btn btn-primary hide" onclick="pagar_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Pagar</button>
                                                            <i id="check_{{$itinerario_servicio->id}}" class="fa fa-check-square-o text-success fa-2x"></i>
                                                            <button id="btn_revertir_{{$itinerario_servicio->id}}" class="btn btn-warning" onclick="revertir_pago_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Revertir</button>
                                                        @endif
                                                        @if($itinerario_servicio->precio_proveedor==0 || $itinerario_servicio->precio_proveedor=='')
                                                            <p class="text-danger">Falta asignar proveedor para realizar el pago</p>
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
                    <div class="col-lg-12">
                        <h4>LIQUIDACION DE BUSES</h4>
                        <table class="table table-bordered table-striped table-responsive table-hover">
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
                            @foreach($liquidaciones->where('categorizado','C')->sortBy('fecha') as $liquidacion)
                                @foreach($liquidacion->paquete_cotizaciones->where('estado',2) as $paquete_cotizacion)
                                    @foreach($paquete_cotizacion->itinerario_cotizaciones->where('fecha','>=',$fecha_ini)->where('fecha','<=',$fecha_fin)->sortBy('fecha') as $itinerario_cotizacion)
                                        @foreach($itinerario_cotizacion->itinerario_servicios->where('liquidacion','!=','0') as $itinerario_servicio)
                                            @foreach($servicios_movi->where('id',$itinerario_servicio->m_servicios_id) as $servicio)
                                                @if(!in_array($liquidacion->id,$array_cotizaciones))
                                                    @php
                                                        $array_cotizaciones[]=$liquidacion->id;
                                                    @endphp
                                                @endif
                                                <tr>
                                                    <td id="fecha_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        <input type="hidden" name="servicio_liquidacion[]" value="{{$itinerario_servicio->id}}">
                                                        {{fecha_peru($itinerario_cotizacion->fecha)}}
                                                    </td>
                                                    <td id="clase_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>{{$servicio->clase}}</td>
                                                    <td id="servicio_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>{{$itinerario_servicio->nombre}}</td>
                                                    <td id="ad_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>{{$liquidacion->nropersonas}}</td>
                                                    <td id="pax_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        @foreach($liquidacion->cotizaciones_cliente as $cotizaciones_cliente)
                                                            {{$cotizaciones_cliente->cliente->nombres}} x {{$liquidacion->nropersonas}}
                                                        @endforeach
                                                    </td>
                                                    <td id="ads_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>${{$itinerario_servicio->precio_proveedor/$liquidacion->nropersonas}}</td>
                                                    <td id="total_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        ${{$itinerario_servicio->precio_proveedor}}
                                                        @if($itinerario_servicio->precio_proveedor==0 || $itinerario_servicio->precio_proveedor=='')
                                                            @php
                                                                $no_reservados++;
                                                            @endphp
                                                        @endif
                                                        @php
                                                            $total_BUSES+=$itinerario_servicio->precio_proveedor;
                                                        @endphp
                                                    </td>
                                                    <td id="categoria_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        @if($liquidacion->categorizado=='S')
                                                            {{'Sin factura'}}
                                                        @elseif($liquidacion->categorizado=='C')
                                                            {{'Con factura'}}
                                                        @endif
                                                    </td>
                                                    <td id="estado_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        @if($itinerario_servicio->liquidacion==1)
                                                            <button id="btn_pagar_{{$itinerario_servicio->id}}" class="btn btn-primary" onclick="pagar_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Pagar</button>
                                                            <i id="check_{{$itinerario_servicio->id}}" class="fa fa-check-square-o text-success fa-2x hide"></i>
                                                            <button id="btn_revertir_{{$itinerario_servicio->id}}" class="btn btn-warning hide" onclick="revertir_pago_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Revertir</button>
                                                        @elseif($itinerario_servicio->liquidacion==2)
                                                            <button id="btn_pagar_{{$itinerario_servicio->id}}" class="btn btn-primary hide" onclick="pagar_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Pagar</button>
                                                            <i id="check_{{$itinerario_servicio->id}}" class="fa fa-check-square-o text-success fa-2x"></i>
                                                            <button id="btn_revertir_{{$itinerario_servicio->id}}" class="btn btn-warning" onclick="revertir_pago_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Revertir</button>
                                                        @endif
                                                        @if($itinerario_servicio->precio_proveedor==0 || $itinerario_servicio->precio_proveedor=='')
                                                            <p class="text-danger">Falta asignar proveedor para realizar el pago</p>
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
                    <div class="col-lg-12 text-right padding-15">
                        <h2 class="text-grey-goto">
                            TOTAL: ${{($total_BTG+$total_CAT+$total_KORI+$total_MAPI+$total_BUSES)}}
                        </h2>
                    </div>
                    <div class="col-lg-12 text-right">
                        <div class="row">
                            <div class="col-lg-6">
                                {{--<form action="">--}}
                                <div class="row">
                                    <div class="col-lg-9">
                                        <div class="form-group">
                                            <label for="txt_name">Ingrese el nro opreracion <span class="text-danger">(Cta. Banco BCP)</span></label>
                                            <input type="text" class="form-control" id="nro_cheque_c" name="nro_cheque_c" value="{{$nro_cheque_c}}" required="required">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 margin-top-20">
                                        <button type="submit" class="btn btn-primary btn-lg" onclick="guardar_cta_c()">Guardar Cta</button>
                                    </div>
                                </div>
                                {{--</form>--}}
                            </div>
                            <div class="col-lg-6">
                                <form id="form_pagar_entradas_full" action="{{route('contabilidad_entradas_pagar_todo_path')}}" method="post" >
                                    {{csrf_field()}}
                                    <input type="hidden" name="tipo_pago" value="C">
                                    <input type="hidden" name="desde" value="{{$fecha_ini}}">
                                    <input type="hidden" name="hasta" value="{{$fecha_fin}}">
                                    <input type="hidden" name="id" id="id" value="{{$id}}">
                                    <input type="hidden" name="s" id="s" value="{{$nro_cheque_s}}">
                                    <input type="hidden" name="c" id="c" value="{{$nro_cheque_c}}">
                                    <button type="submit" class="btn btn-primary btn-lg" onclick="verificar_reservados({{$no_reservados}})">Pagar todo</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="sinfactura" class="tab-pane fade @if($tipo_cheque=='S') active show @endif">
                    <div class="col-lg-12">
                        <h4>LIQUIDACION DE BOLETOS TURISTICOS</h4>
                        <table  class="table table-bordered table-striped table-responsive table-hover">
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
                                $no_reservados=0;
                            @endphp
                            @foreach($liquidaciones->where('categorizado','S')->sortBy('fecha') as $liquidacion)
                                @foreach($liquidacion->paquete_cotizaciones->where('estado',2) as $paquete_cotizacion)
                                    @foreach($paquete_cotizacion->itinerario_cotizaciones->where('fecha','>=',$fecha_ini)->where('fecha','<=',$fecha_fin)->sortBy('fecha') as $itinerario_cotizacion)
                                        @foreach($itinerario_cotizacion->itinerario_servicios->where('liquidacion','!=','0') as $itinerario_servicio)
                                            @foreach($servicios->where('id',$itinerario_servicio->m_servicios_id)->where('clase','BTG') as $servicio)
                                                @if(!in_array($liquidacion->id,$array_cotizaciones))
                                                    @php
                                                        $array_cotizaciones[]=$liquidacion->id;
                                                    @endphp
                                                @endif
                                                <tr>
                                                    <td id="fecha_{{$itinerario_servicio->id}}"  @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        <input type="hidden" name="servicio_liquidacion[]" value="{{$itinerario_servicio->id}}">
                                                        {{fecha_peru($itinerario_cotizacion->fecha)}}</td>
                                                    <td id="clase_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>{{$servicio->clase}}</td>
                                                    <td id="servicio_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>{{$itinerario_servicio->nombre}}</td>
                                                    <td id="ad_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>{{$liquidacion->nropersonas}}</td>
                                                    <td id="pax_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        @foreach($liquidacion->cotizaciones_cliente as $cotizaciones_cliente)
                                                            {{$cotizaciones_cliente->cliente->nombres}} x {{$liquidacion->nropersonas}}
                                                        @endforeach
                                                    </td>
                                                    <td id="ads_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>${{$itinerario_servicio->precio_proveedor/$liquidacion->nropersonas}}</td>
                                                    <td id="total_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        ${{$itinerario_servicio->precio_proveedor}}
                                                        @if($itinerario_servicio->precio_proveedor==0 || $itinerario_servicio->precio_proveedor=='')
                                                            @php
                                                                $no_reservados++;
                                                            @endphp
                                                        @endif
                                                        @php
                                                            $total_BTG+=$itinerario_servicio->precio_proveedor;
                                                        @endphp
                                                    </td>
                                                    <td id="categoria_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        @if($liquidacion->categorizado=='S')
                                                            {{'Sin factura'}}
                                                        @elseif($liquidacion->categorizado=='C')
                                                            {{'Con factura'}}
                                                        @endif
                                                    </td>
                                                    <td id="estado_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        @if($itinerario_servicio->liquidacion==1)
                                                            <button id="btn_pagar_{{$itinerario_servicio->id}}" class="btn btn-primary" onclick="pagar_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Pagar</button>
                                                            <i id="check_{{$itinerario_servicio->id}}" class="fa fa-check-square-o text-success fa-2x hide"></i>
                                                            <button id="btn_revertir_{{$itinerario_servicio->id}}" class="btn btn-warning hide" onclick="revertir_pago_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Revertir</button>
                                                        @elseif($itinerario_servicio->liquidacion==2)
                                                            <button id="btn_pagar_{{$itinerario_servicio->id}}" class="btn btn-primary hide" onclick="pagar_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Pagar</button>
                                                            <i id="check_{{$itinerario_servicio->id}}" class="fa fa-check-square-o text-success fa-2x"></i>
                                                            <button id="btn_revertir_{{$itinerario_servicio->id}}" class="btn btn-warning" onclick="revertir_pago_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Revertir</button>
                                                        @endif
                                                        @if($itinerario_servicio->precio_proveedor==0 || $itinerario_servicio->precio_proveedor=='')
                                                            <p class="text-danger">Falta asignar proveedor para realizar el pago</p>
                                                            @endifclass="text-danger">Falta asignar proveedor para realizar el pago</p>
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
                    <div class="col-lg-12">
                        <h4>LIQUIDACION DE INGRESOS A CATEDRAL</h4>
                        <table class="table table-bordered table-striped table-responsive table-hover">
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
                            @foreach($liquidaciones->where('categorizado','S')->sortBy('fecha') as $liquidacion)
                                @foreach($liquidacion->paquete_cotizaciones->where('estado',2) as $paquete_cotizacion)
                                    @foreach($paquete_cotizacion->itinerario_cotizaciones->where('fecha','>=',$fecha_ini)->where('fecha','<=',$fecha_fin)->sortBy('fecha') as $itinerario_cotizacion)
                                        @foreach($itinerario_cotizacion->itinerario_servicios->where('liquidacion','!=','0') as $itinerario_servicio)
                                            @foreach($servicios->where('id',$itinerario_servicio->m_servicios_id)->where('clase','CAT') as $servicio)
                                                @if(!in_array($liquidacion->id,$array_cotizaciones))
                                                    @php
                                                        $array_cotizaciones[]=$liquidacion->id;
                                                    @endphp
                                                @endif
                                                <tr>
                                                    <td id="fecha_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        <input type="hidden" name="servicio_liquidacion[]" value="{{$itinerario_servicio->id}}">
                                                        {{fecha_peru($itinerario_cotizacion->fecha)}}
                                                    </td>
                                                    <td id="clase_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>{{$servicio->clase}}</td>
                                                    <td id="servicio_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>{{$itinerario_servicio->nombre}}</td>
                                                    <td id="ad_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>{{$liquidacion->nropersonas}}</td>
                                                    <td id="pax_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        @foreach($liquidacion->cotizaciones_cliente as $cotizaciones_cliente)
                                                            {{$cotizaciones_cliente->cliente->nombres}} x {{$liquidacion->nropersonas}}
                                                        @endforeach
                                                    </td>
                                                    <td id="ads_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>${{$itinerario_servicio->precio_proveedor/$liquidacion->nropersonas}}</td>
                                                    <td id="total_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        ${{$itinerario_servicio->precio_proveedor}}
                                                        @if($itinerario_servicio->precio_proveedor==0 || $itinerario_servicio->precio_proveedor=='')
                                                            @php
                                                                $no_reservados++;
                                                            @endphp
                                                        @endif
                                                        @php
                                                            $total_CAT+=$itinerario_servicio->precio_proveedor;
                                                        @endphp
                                                    </td>
                                                    <td id="categoria_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        @if($liquidacion->categorizado=='S')
                                                            {{'Sin factura'}}
                                                        @elseif($liquidacion->categorizado=='C')
                                                            {{'Con factura'}}
                                                        @endif
                                                    </td>
                                                    <td id="estado_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        @if($itinerario_servicio->liquidacion==1)
                                                            <button id="btn_pagar_{{$itinerario_servicio->id}}" class="btn btn-primary" onclick="pagar_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Pagar</button>
                                                            <i id="check_{{$itinerario_servicio->id}}" class="fa fa-check-square-o text-success fa-2x hide"></i>
                                                            <button id="btn_revertir_{{$itinerario_servicio->id}}" class="btn btn-warning hide" onclick="revertir_pago_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Revertir</button>
                                                        @elseif($itinerario_servicio->liquidacion==2)
                                                            <button id="btn_pagar_{{$itinerario_servicio->id}}" class="btn btn-primary hide" onclick="pagar_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Pagar</button>
                                                            <i id="check_{{$itinerario_servicio->id}}" class="fa fa-check-square-o text-success fa-2x"></i>
                                                            <button id="btn_revertir_{{$itinerario_servicio->id}}" class="btn btn-warning" onclick="revertir_pago_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Revertir</button>
                                                        @endif
                                                        @if($itinerario_servicio->precio_proveedor==0 || $itinerario_servicio->precio_proveedor=='')
                                                            <p class="text-danger">Falta asignar proveedor para realizar el pago</p>
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
                    <div class="col-lg-12">
                        <h4>LIQUIDACION DE INGRESOS AL KORICANCHA</h4>
                        <table class="table table-bordered table-striped table-responsive table-hover">
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
                            @foreach($liquidaciones->where('categorizado','S')->sortBy('fecha') as $liquidacion)
                                @foreach($liquidacion->paquete_cotizaciones->where('estado',2) as $paquete_cotizacion)
                                    @foreach($paquete_cotizacion->itinerario_cotizaciones->where('fecha','>=',$fecha_ini)->where('fecha','<=',$fecha_fin)->sortBy('fecha') as $itinerario_cotizacion)
                                        @foreach($itinerario_cotizacion->itinerario_servicios->where('liquidacion','!=','0') as $itinerario_servicio)
                                            @foreach($servicios->where('id',$itinerario_servicio->m_servicios_id)->where('clase','KORI') as $servicio)
                                                @if(!in_array($liquidacion->id,$array_cotizaciones))
                                                    @php
                                                        $array_cotizaciones[]=$liquidacion->id;
                                                    @endphp
                                                @endif
                                                <tr>
                                                    <td id="fecha_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        <input type="hidden" name="servicio_liquidacion[]" value="{{$itinerario_servicio->id}}">
                                                        {{fecha_peru($itinerario_cotizacion->fecha)}}
                                                    </td>
                                                    <td id="clase_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>{{$servicio->clase}}</td>
                                                    <td id="servicio_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>{{$itinerario_servicio->nombre}}</td>
                                                    <td id="ad_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>{{$liquidacion->nropersonas}}</td>
                                                    <td id="pax_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        @foreach($liquidacion->cotizaciones_cliente as $cotizaciones_cliente)
                                                            {{$cotizaciones_cliente->cliente->nombres}} x {{$liquidacion->nropersonas}}
                                                        @endforeach
                                                    </td>
                                                    <td id="ads_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>${{$itinerario_servicio->precio_proveedor/$liquidacion->nropersonas}}</td>
                                                    <td id="total_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        ${{$itinerario_servicio->precio_proveedor}}
                                                        @if($itinerario_servicio->precio_proveedor==0 || $itinerario_servicio->precio_proveedor=='')
                                                            @php
                                                                $no_reservados++;
                                                            @endphp
                                                        @endif
                                                        @php
                                                            $total_KORI+=$itinerario_servicio->precio_proveedor;
                                                        @endphp
                                                    </td>
                                                    <td id="categoria_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        @if($liquidacion->categorizado=='S')
                                                            {{'Sin factura'}}
                                                        @elseif($liquidacion->categorizado=='C')
                                                            {{'Con factura'}}
                                                        @endif
                                                    </td>
                                                    <td id="estado_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        @if($itinerario_servicio->liquidacion==1)
                                                            <button id="btn_pagar_{{$itinerario_servicio->id}}" class="btn btn-primary" onclick="pagar_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Pagar</button>
                                                            <i id="check_{{$itinerario_servicio->id}}" class="fa fa-check-square-o text-success fa-2x hide"></i>
                                                            <button id="btn_revertir_{{$itinerario_servicio->id}}" class="btn btn-warning hide" onclick="revertir_pago_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Revertir</button>
                                                        @elseif($itinerario_servicio->liquidacion==2)
                                                            <button id="btn_pagar_{{$itinerario_servicio->id}}" class="btn btn-primary hide" onclick="pagar_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Pagar</button>
                                                            <i id="check_{{$itinerario_servicio->id}}" class="fa fa-check-square-o text-success fa-2x"></i>
                                                            <button id="btn_revertir_{{$itinerario_servicio->id}}" class="btn btn-warning" onclick="revertir_pago_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Revertir</button>
                                                        @endif
                                                        @if($itinerario_servicio->precio_proveedor==0 || $itinerario_servicio->precio_proveedor=='')
                                                            <p class="text-danger">Falta asignar proveedor para realizar el pago</p>
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
                    <div class="col-lg-12">
                        <h4>LIQUIDACION DE ENTRADAS A MACHUPICCHU</h4>
                        <table class="table table-bordered table-striped table-responsive table-hover">
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
                            @foreach($liquidaciones->where('categorizado','S')->sortBy('fecha') as $liquidacion)
                                @foreach($liquidacion->paquete_cotizaciones->where('estado',2) as $paquete_cotizacion)
                                    @foreach($paquete_cotizacion->itinerario_cotizaciones->where('fecha','>=',$fecha_ini)->where('fecha','<=',$fecha_fin)->sortBy('fecha') as $itinerario_cotizacion)
                                        @foreach($itinerario_cotizacion->itinerario_servicios->where('liquidacion','!=','0') as $itinerario_servicio)
                                            @foreach($servicios->where('id',$itinerario_servicio->m_servicios_id)->where('clase','MAPI') as $servicio)
                                                @if(!in_array($liquidacion->id,$array_cotizaciones))
                                                    @php
                                                        $array_cotizaciones[]=$liquidacion->id;
                                                    @endphp
                                                @endif
                                                <tr>
                                                    <td id="fecha_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        <input type="hidden" name="servicio_liquidacion[]" value="{{$itinerario_servicio->id}}">
                                                        {{fecha_peru($itinerario_cotizacion->fecha)}}
                                                    </td>
                                                    <td id="clase_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>{{$servicio->clase}}</td>
                                                    <td id="servicio_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>{{$itinerario_servicio->nombre}}</td>
                                                    <td id="ad_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>{{$liquidacion->nropersonas}}</td>
                                                    <td id="pax_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        @foreach($liquidacion->cotizaciones_cliente as $cotizaciones_cliente)
                                                            {{$cotizaciones_cliente->cliente->nombres}} x {{$liquidacion->nropersonas}}
                                                        @endforeach
                                                    </td>
                                                    <td id="ads_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>${{$itinerario_servicio->precio_proveedor/$liquidacion->nropersonas}}</td>
                                                    <td id="total_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        ${{$itinerario_servicio->precio_proveedor}}
                                                        @if($itinerario_servicio->precio_proveedor==0 || $itinerario_servicio->precio_proveedor=='')
                                                            @php
                                                                $no_reservados++;
                                                            @endphp
                                                        @endif
                                                        @php
                                                            $total_MAPI+=$itinerario_servicio->precio_proveedor;
                                                        @endphp
                                                    </td>
                                                    <td id="categoria_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        @if($liquidacion->categorizado=='S')
                                                            {{'Sin factura'}}
                                                        @elseif($liquidacion->categorizado=='C')
                                                            {{'Con factura'}}
                                                        @endif
                                                    </td>
                                                    <td id="estado_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        @if($itinerario_servicio->liquidacion==1)
                                                            <button id="btn_pagar_{{$itinerario_servicio->id}}" class="btn btn-primary" onclick="pagar_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Pagar</button>
                                                            <i id="check_{{$itinerario_servicio->id}}" class="fa fa-check-square-o text-success fa-2x hide"></i>
                                                            <button id="btn_revertir_{{$itinerario_servicio->id}}" class="btn btn-warning hide" onclick="revertir_pago_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Revertir</button>
                                                        @elseif($itinerario_servicio->liquidacion==2)
                                                            <button id="btn_pagar_{{$itinerario_servicio->id}}" class="btn btn-primary hide" onclick="pagar_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Pagar</button>
                                                            <i id="check_{{$itinerario_servicio->id}}" class="fa fa-check-square-o text-success fa-2x"></i>
                                                            <button id="btn_revertir_{{$itinerario_servicio->id}}" class="btn btn-warning" onclick="revertir_pago_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Revertir</button>
                                                        @endif
                                                        @if($itinerario_servicio->precio_proveedor==0 || $itinerario_servicio->precio_proveedor=='')
                                                            <p class="text-danger">Falta asignar proveedor para realizar el pago</p>
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
                    <div class="col-lg-12">
                        <h4>LIQUIDACION DE ENTRADAS A OTROS LUGARES</h4>
                        <table class="table table-bordered table-striped table-responsive table-hover">
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
                            @foreach($liquidaciones->where('categorizado','S')->sortBy('fecha') as $liquidacion)
                                @foreach($liquidacion->paquete_cotizaciones->where('estado',2) as $paquete_cotizacion)
                                    @foreach($paquete_cotizacion->itinerario_cotizaciones->where('fecha','>=',$fecha_ini)->where('fecha','<=',$fecha_fin)->sortBy('fecha') as $itinerario_cotizacion)
                                        @foreach($itinerario_cotizacion->itinerario_servicios->where('liquidacion','!=','0') as $itinerario_servicio)
                                            @foreach($servicios->where('id',$itinerario_servicio->m_servicios_id)->where('clase','OTROS') as $servicio)
                                                @if(!in_array($liquidacion->id,$array_cotizaciones))
                                                    @php
                                                        $array_cotizaciones[]=$liquidacion->id;
                                                    @endphp
                                                @endif
                                                <tr>
                                                    <td id="fecha_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        <input type="hidden" name="servicio_liquidacion[]" value="{{$itinerario_servicio->id}}">
                                                        {{fecha_peru($itinerario_cotizacion->fecha)}}
                                                    </td>
                                                    <td id="clase_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>{{$servicio->clase}}</td>
                                                    <td id="servicio_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>{{$itinerario_servicio->nombre}}</td>
                                                    <td id="ad_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>{{$liquidacion->nropersonas}}</td>
                                                    <td id="pax_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        @foreach($liquidacion->cotizaciones_cliente as $cotizaciones_cliente)
                                                            {{$cotizaciones_cliente->cliente->nombres}} x {{$liquidacion->nropersonas}}
                                                        @endforeach
                                                    </td>
                                                    <td id="ads_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>${{$itinerario_servicio->precio_proveedor/$liquidacion->nropersonas}}</td>
                                                    <td id="total_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        ${{$itinerario_servicio->precio_proveedor}}
                                                        @if($itinerario_servicio->precio_proveedor==0 || $itinerario_servicio->precio_proveedor=='')
                                                            @php
                                                                $no_reservados++;
                                                            @endphp
                                                        @endif
                                                        @php
                                                            $total_OTROS+=$itinerario_servicio->precio_proveedor;
                                                        @endphp
                                                    </td>
                                                    <td id="categoria_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        @if($liquidacion->categorizado=='S')
                                                            {{'Sin factura'}}
                                                        @elseif($liquidacion->categorizado=='C')
                                                            {{'Con factura'}}
                                                        @endif
                                                    </td>
                                                    <td id="estado_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        @if($itinerario_servicio->liquidacion==1)
                                                            <button id="btn_pagar_{{$itinerario_servicio->id}}" class="btn btn-primary" onclick="pagar_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Pagar</button>
                                                            <i id="check_{{$itinerario_servicio->id}}" class="fa fa-check-square-o text-success fa-2x hide"></i>
                                                            <button id="btn_revertir_{{$itinerario_servicio->id}}" class="btn btn-warning hide" onclick="revertir_pago_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Revertir</button>
                                                        @elseif($itinerario_servicio->liquidacion==2)
                                                            <button id="btn_pagar_{{$itinerario_servicio->id}}" class="btn btn-primary hide" onclick="pagar_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Pagar</button>
                                                            <i id="check_{{$itinerario_servicio->id}}" class="fa fa-check-square-o text-success fa-2x"></i>
                                                            <button id="btn_revertir_{{$itinerario_servicio->id}}" class="btn btn-warning" onclick="revertir_pago_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Revertir</button>
                                                        @endif
                                                        @if($itinerario_servicio->precio_proveedor==0 || $itinerario_servicio->precio_proveedor=='')
                                                            <p class="text-danger">Falta asignar proveedor para realizar el pago</p>
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
                    <div class="col-lg-12">
                        <h4>LIQUIDACION DE BUSES</h4>
                        <table class="table table-bordered table-striped table-responsive table-hover">
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
                            @foreach($liquidaciones->where('categorizado','S')->sortBy('fecha') as $liquidacion)
                                @foreach($liquidacion->paquete_cotizaciones->where('estado',2) as $paquete_cotizacion)
                                    @foreach($paquete_cotizacion->itinerario_cotizaciones->where('fecha','>=',$fecha_ini)->where('fecha','<=',$fecha_fin)->sortBy('fecha') as $itinerario_cotizacion)
                                        @foreach($itinerario_cotizacion->itinerario_servicios->where('liquidacion','!=','0') as $itinerario_servicio)
                                            @foreach($servicios_movi->where('id',$itinerario_servicio->m_servicios_id) as $servicio)
                                                @if(!in_array($liquidacion->id,$array_cotizaciones))
                                                    @php
                                                        $array_cotizaciones[]=$liquidacion->id;
                                                    @endphp
                                                @endif
                                                <tr>
                                                    <td id="fecha_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        <input type="hidden" name="servicio_liquidacion[]" value="{{$itinerario_servicio->id}}">
                                                        {{fecha_peru($itinerario_cotizacion->fecha)}}
                                                    </td>
                                                    <td id="clase_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>{{$servicio->clase}}</td>
                                                    <td id="servicio_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>{{$itinerario_servicio->nombre}}</td>
                                                    <td id="ad_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>{{$liquidacion->nropersonas}}</td>
                                                    <td id="pax_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        @foreach($liquidacion->cotizaciones_cliente as $cotizaciones_cliente)
                                                            {{$cotizaciones_cliente->cliente->nombres}} x {{$liquidacion->nropersonas}}
                                                        @endforeach
                                                    </td>
                                                    <td id="ads_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>${{$itinerario_servicio->precio_proveedor/$liquidacion->nropersonas}}</td>
                                                    <td id="total_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        ${{$itinerario_servicio->precio_proveedor}}
                                                        @if($itinerario_servicio->precio_proveedor==0 || $itinerario_servicio->precio_proveedor=='')
                                                            @php
                                                                $no_reservados++;
                                                            @endphp
                                                        @endif
                                                        @php
                                                            $total_BUSES+=$itinerario_servicio->precio_proveedor;
                                                        @endphp
                                                    </td>
                                                    <td id="categoria_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        @if($liquidacion->categorizado=='S')
                                                            {{'Sin factura'}}
                                                        @elseif($liquidacion->categorizado=='C')
                                                            {{'Con factura'}}
                                                        @endif
                                                    </td>
                                                    <td id="estado_{{$itinerario_servicio->id}}" @if($itinerario_servicio->liquidacion==2) class="alert alert-success"  @else class="alert alert-danger" @endif>
                                                        @if($itinerario_servicio->liquidacion==1)
                                                            <button id="btn_pagar_{{$itinerario_servicio->id}}" class="btn btn-primary" onclick="pagar_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Pagar</button>
                                                            <i id="check_{{$itinerario_servicio->id}}" class="fa fa-check-square-o text-success fa-2x hide"></i>
                                                            <button id="btn_revertir_{{$itinerario_servicio->id}}" class="btn btn-warning hide" onclick="revertir_pago_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Revertir</button>
                                                        @elseif($itinerario_servicio->liquidacion==2)
                                                            <button id="btn_pagar_{{$itinerario_servicio->id}}" class="btn btn-primary hide" onclick="pagar_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Pagar</button>
                                                            <i id="check_{{$itinerario_servicio->id}}" class="fa fa-check-square-o text-success fa-2x"></i>
                                                            <button id="btn_revertir_{{$itinerario_servicio->id}}" class="btn btn-warning" onclick="revertir_pago_entrada('{{$itinerario_servicio->id}}','{{$itinerario_servicio->precio_proveedor}}')">Revertir</button>
                                                        @endif
                                                        @if($itinerario_servicio->precio_proveedor==0 || $itinerario_servicio->precio_proveedor=='')
                                                            <p class="text-danger">Falta asignar proveedor para realizar el pago</p>
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
                    <div class="col-lg-12 text-right padding-15">
                        <h2 class="text-grey-goto">
                            TOTAL: ${{($total_BTG+$total_CAT+$total_KORI+$total_MAPI+$total_BUSES)}}
                        </h2>
                    </div>
                    <div class="col-lg-12 text-right">
                        <div class="row">
                            <div class="col-lg-6">
                                {{--<form action="">--}}
                                    <div class="row">
                                        <div class="col-lg-9">
                                            <div class="form-group">
                                                <label for="txt_name">Ingrese el nro de operacion <span class="text-danger">(Cta. Banco continental)</span></label>
                                                <input type="text" class="form-control" id="nro_cheque_s" name="nro_cheque_s" value="{{$nro_cheque_s}}" required="required">
                                            </div>

                                        </div>
                                        <div class="col-lg-3 margin-top-20">
                                            <button type="submit" class="btn btn-primary btn-lg" onclick="guardar_cta()">Guardar Cta</button>
                                        </div>
                                    </div>
                                {{--</form>--}}
                            </div>
                            <div class="col-lg-6">
                                <form id="form_pagar_entradas_full" action="{{route('contabilidad_entradas_pagar_todo_path')}}" method="post" >
                                    {{csrf_field()}}
                                    <input type="hidden" name="tipo_pago" value="S">
                                    <input type="hidden" name="desde" value="{{$fecha_ini}}">
                                    <input type="hidden" name="hasta" value="{{$fecha_fin}}">
                                    <input type="hidden" name="id" id="id" value="{{$id}}">
                                    <input type="hidden" name="s" id="s" value="{{$nro_cheque_s}}">
                                    <input type="hidden" name="c" id="c" value="{{$nro_cheque_c}}">
                                    <button type="submit" class="btn btn-primary btn-lg" onclick="verificar_reservados({{$no_reservados}})">Pagar todo</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{--</form>--}}
        </div>
    </div>
@stop