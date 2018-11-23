@php
    use Carbon\Carbon;
    function fecha_peru($fecha){
        if(trim($fecha)!=''){
            $fecha=explode('-',$fecha);
            return $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
        }
    }
    function fecha_peru1($fecha_){
        $f1=explode(' ',$fecha_);
        $hora=$f1[1];
        $f2=explode('-',$f1[0]);
        $fecha1=$f2[2].'-'.$f2[1].'-'.$f2[0];
        return $fecha1.' a las '.$hora;
    }
@endphp
<div class="card w-100">
    <div class="card-body">
        <ul class="nav nav-tabs nav-justified">
            <li class="nav-item active"><a data-toggle="tab" href="#hotels" class="nav-link active rounded-0">HOTELS</a></li>
            <li class="nav-item "><a data-toggle="tab" href="#tours" class="nav-link  rounded-0">TOURS</a></li>
            <li class="nav-item "><a data-toggle="tab" href="#movilid" class="nav-link  rounded-0">MOVILID</a></li>
            <li class="nav-item "><a data-toggle="tab" href="#represent" class="nav-link  rounded-0">REPRESENT</a></li>
            <li class="nav-item "><a data-toggle="tab" href="#entrances" class="nav-link  rounded-0">ENTRANCES</a></li>
            <li class="nav-item "><a data-toggle="tab" href="#food" class="nav-link  rounded-0">FOOD</a></li>
            <li class="nav-item "><a data-toggle="tab" href="#trains" class="nav-link  rounded-0">TRAINS</a></li>
            <li class="nav-item "><a data-toggle="tab" href="#flights" class="nav-link  rounded-0">FLIGHTS</a></li>
            <li class="nav-item "><a data-toggle="tab" href="#others" class="nav-link  rounded-0">OTHERS</a></li>
        </ul>
        <div class="tab-content">
            <div id="hotels" class="tab-pane fade show active">
                <table class="table table-striped table-hover table-bordered table-responsive table-condensed mt-2">
                    <thead>
                    <tr>
                        <th>FECHA USO</th>
                        <th>FECHA PAGO</th>
                        <th>HOTEL</th>
                        <th>ACOM</th>
                        <th>PAX</th>
                        <th>AD</th>
                        <th>TOTAL</th>
                        <th>SITUACION</th>
                        <th>PRIORIDAD</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="bg-dark text-white text-15" ><td colspan="9"><b>HOTEL</b></td></tr>
                    @php
                        $total_hotel=0;
                    @endphp
                    @foreach($cotizaciones as $cotizacion)
                        @foreach($cotizacion->paquete_cotizaciones as $paquete_cotizaciones)
                            @foreach($paquete_cotizaciones->itinerario_cotizaciones as $itinerario_cotizaciones)
                                @foreach($itinerario_cotizaciones->hotel as $hotel)
                                        @if($hotel->personas_s>0)
                                            @php
                                                $total_hotel+=$hotel->personas_s*$hotel->precio_s;
                                            @endphp
                                        @endif
                                        @if($hotel->personas_d>0)
                                            @php
                                                $total_hotel+=$hotel->personas_d*$hotel->precio_d;
                                            @endphp
                                        @endif
                                        @if($hotel->personas_m>0)
                                            @php
                                                $total_hotel+=$hotel->personas_m*$hotel->precio_m;
                                            @endphp
                                        @endif
                                        @if($hotel->personas_t>0)
                                            @php
                                                $total_hotel+=$hotel->personas_t*$hotel->precio_t;
                                            @endphp
                                        @endif
                                        <tr>
                                            <td>{{fecha_peru($itinerario_cotizaciones->fecha)}}</td>
                                            <td>{{fecha_peru($hotel->fecha_venc)}}</td>
                                            <td>{{$hotel->estrellas}} <i class="fas fa-star text-warning"></i></td>
                                            <td>
                                                @if($hotel->personas_s>0)
                                                    <p>{{$hotel->personas_s}} <i class="fas fa-bed"></i></p>
                                                @endif
                                                @if($hotel->personas_d>0)
                                                        <p>{{$hotel->personas_d}} <i class="fas fa-bed"></i> <i class="fas fa-bed"></i></p>
                                                @endif
                                                @if($hotel->personas_m>0)
                                                        <p>{{$hotel->personas_m}} <i class="fas fa-venus-mars"></i></p>
                                                @endif
                                                @if($hotel->personas_t>0)
                                                        <p>{{$hotel->personas_t}} <i class="fas fa-bed"></i> <i class="fas fa-bed"></i> <i class="fas fa-bed"></i></p>
                                                @endif
                                            </td>
                                            <td>
                                                @foreach($cotizacion->cotizaciones_cliente->where('estado',1) as $cotizaciones_cliente)
                                                    <b><span class="text-success">{{$cotizacion->codigo}}</span> | {{$cotizaciones_cliente->cliente->nombres}} x{{$cotizacion->nropersonas}} {{fecha_peru($cotizacion->fecha)}}</b>
                                                @endforeach
                                            </td>
                                            <td>
                                                @if($hotel->personas_s>0)
                                                    <p><b>*<sup>$</sup>{{$hotel->precio_s}}</b></p>
                                                @endif
                                                @if($hotel->personas_d>0)
                                                    <p><b>*<sup>$</sup>{{$hotel->precio_d}}</b></p>
                                                @endif
                                                @if($hotel->personas_m>0)
                                                    <p><b>*<sup>$</sup>{{$hotel->precio_m}}</b></p>
                                                @endif
                                                @if($hotel->personas_t>0)
                                                    <p><b>*<sup>$</sup>{{$hotel->precio_t}}</b></p>
                                                @endif
                                            </td>
                                            <td>
                                                @if($hotel->personas_s>0)
                                                    <p><b>*<sup>$</sup>{{$hotel->personas_s*$hotel->precio_s}}</b></p>
                                                @endif
                                                @if($hotel->personas_d>0)
                                                    <p><b>*<sup>$</sup>{{$hotel->personas_d*$hotel->precio_d}}</b></p>
                                                @endif
                                                @if($hotel->personas_m>0)
                                                    <p><b>*<sup>$</sup>{{$hotel->personas_m*$hotel->precio_m}}</b></p>
                                                @endif
                                                @if($hotel->personas_t>0)
                                                    <p><b>*<sup>$</sup>{{$hotel->personas_t*$hotel->precio_t}}</b></p>
                                                @endif
                                            </td>
                                            <td>
                                                @if($hotel->personas_s>0)
                                                    @if($hotel->proveedor_id>0)
                                                        @if($hotel->precio_s_c>0)
                                                            <p><span class="badge badge-success">SITUACION</span></p>
                                                        @else
                                                            <p><span class="badge badge-danger">PENDIENTE</span></p>
                                                        @endif
                                                    @else
                                                        <p><span class="badge badge-secondary">NO ENVIADO</span></p>
                                                    @endif
                                                @endif
                                                @if($hotel->personas_d>0)
                                                    @if($hotel->proveedor_id>0)
                                                        @if($hotel->precio_d_c>0)
                                                            <p><span class="badge badge-success">SITUACION</span></p>
                                                        @else
                                                            <p><span class="badge badge-danger">PENDIENTE</span></p>
                                                        @endif
                                                    @else
                                                        <p><span class="badge badge-secondary">NO ENVIADO</span></p>
                                                    @endif
                                                @endif
                                                @if($hotel->personas_m>0)
                                                    @if($hotel->proveedor_id>0)
                                                        @if($hotel->precio_m_c>0)
                                                            <p><span class="badge badge-success">SITUACION</span></p>
                                                        @else
                                                            <p><span class="badge badge-danger">PENDIENTE</span></p>
                                                        @endif
                                                    @else
                                                        <p><span class="badge badge-secondary">NO ENVIADO</span></p>
                                                    @endif
                                                @endif
                                                @if($hotel->personas_t>0)
                                                    @if($hotel->proveedor_id>0)
                                                        @if($hotel->precio_t_c>0)
                                                            <p><span class="badge badge-success">SITUACION</span></p>
                                                        @else
                                                            <p><span class="badge badge-danger">PENDIENTE</span></p>
                                                        @endif
                                                    @else
                                                        <p><span class="badge badge-secondary">NO ENVIADO</span></p>
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge @if($hotel->prioridad=='NORMAL') badge-success @elseif($hotel->prioridad=='URGENTE') badge-danger @endif">
                                                    {{$hotel->prioridad}}
                                                </span>
                                            </td>
                                        </tr>
                                @endforeach
                            @endforeach
                        @endforeach
                    @endforeach
                    <tr class="text-15">
                        <td colspan="6"><b>TOTAL</b></td>
                        <td colspan="3"  class="text-dark"><b><sup>$</sup>{{number_format($total_hotel,2)}}</b></td>
                    </tr>
                    <tr>
                        <td colspan="6"><b>GRAN TOTAL</b></td>
                        <td colspan="3" class=""><b><sup>$</sup>{{number_format($total_hotel,2)}}</b></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div id="tours" class="tab-pane fade show ">
                <table class="table table-striped table-hover table-bordered table-responsive table-condensed mt-2">
                    <thead>
                    <tr>
                        <th>FECHA USO</th>
                        <th>FECHA PAGO</th>
                        <th>TOURS</th>
                        <th>CLASE</th>
                        <th>AD</th>
                        <th>PAX</th>
                        <th><sup>$</sup>AD</th>
                        <th>TOTAL</th>
                        <th>SITUACION</th>
                        <th>NRO OPERACION</th>
                        <th>PRIORIDAD</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="bg-dark text-white text-15" ><td colspan="11"><b>TOURS</b></td></tr>
                    @php
                        $total_tours=0;
                    @endphp
                    @foreach($cotizaciones as $cotizacion)
                        @foreach($cotizacion->paquete_cotizaciones as $paquete_cotizaciones)
                            @foreach($paquete_cotizaciones->itinerario_cotizaciones as $itinerario_cotizaciones)
                                @foreach($itinerario_cotizaciones->itinerario_servicios as $itinerario_servicios)
                                    @if($itinerario_servicios->servicio->grupo=='TOURS')
                                        @if($itinerario_servicios->servicio->precio_grupo==1)
                                            @php
                                                $total_tours+=$itinerario_servicios->precio;
                                            @endphp
                                        @elseif($itinerario_servicios->servicio->precio_grupo==0)
                                            @php
                                                $total_tours+=$itinerario_servicios->precio*$cotizacion->nropersonas;
                                            @endphp
                                        @endif
                                        <tr>
                                            <td>{{fecha_peru($itinerario_cotizaciones->fecha)}}</td>
                                            <td>{{fecha_peru($itinerario_servicios->fecha_venc)}}</td>
                                            <td>{{$itinerario_servicios->servicio->nombre}}</td>
                                            <td>{{$itinerario_servicios->servicio->tipoServicio}}</td>
                                            {{--<td><sup class="text-success"><i class="far fa-clock"></i></sup> <span class="text-dark">{{$itinerario_servicios->salida}}</span> <span class="text-success">-</span> <span class="text-dark">{{$itinerario_servicios->llegada}}</span></td>--}}
                                            <td>{{$cotizacion->nropersonas}}</td>
                                            <td>
                                                @foreach($cotizacion->cotizaciones_cliente->where('estado',1) as $cotizaciones_cliente)
                                                    <b><span class="text-success">{{$cotizacion->codigo}}</span> | {{$cotizaciones_cliente->cliente->nombres}} x{{$cotizacion->nropersonas}} {{fecha_peru($cotizacion->fecha)}}</b>
                                                @endforeach
                                            </td>
                                            <td><sup>$</sup>{{$itinerario_servicios->precio}}</td>
                                            <td class="text-success"><sup>$</sup>
                                                @if($itinerario_servicios->servicio->precio_grupo==1)
                                                    {{number_format($itinerario_servicios->precio,2)}}
                                                @elseif($itinerario_servicios->servicio->precio_grupo==0)
                                                    {{number_format($itinerario_servicios->precio*$cotizacion->nropersonas,2)}}
                                                @endif
                                            </td>
                                            <td>
                                                @if($itinerario_servicios->liquidacion==2)
                                                    <span class="badge badge-success">SITUACION</span>
                                                @elseif($itinerario_servicios->liquidacion==1)
                                                    <span class="badge badge-danger">PENDIENTE</span>
                                                @elseif($itinerario_servicios->liquidacion==0)
                                                    <span class="badge badge-secondary">NO ENVIADO</span>
                                                @endif
                                            </td>
                                            <td>
                                                @foreach($liquidaciones->where('id',$itinerario_servicios->liquidacion_id) as $liquidacion)
                                                    @if(trim($liquidacion->nro_operacion)!='')
                                                        {{$liquidacion->nro_operacion}}
                                                    @else
                                                        {{'No tiene'}}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                <span class="badge @if($itinerario_servicios->prioridad=='NORMAL') badge-success @elseif($itinerario_servicios->prioridad=='URGENTE') badge-danger @endif">
                                                    {{$itinerario_servicios->prioridad}}
                                                </span>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        @endforeach
                    @endforeach
                    <tr class="text-15">
                        <td colspan="7"><b>TOTAL</b></td>
                        <td colspan="4"  class="text-dark"><b><sup>$</sup>{{number_format($total_tours,2)}}</b></td>
                    </tr>
                    <tr>
                        <td colspan="7"><b>GRAN TOTAL</b></td>
                        <td colspan="6" class=""><b><sup>$</sup>{{number_format($total_tours,2)}}</b></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div id="movilid" class="tab-pane fade show ">
                <table class="table table-striped table-hover table-bordered table-responsive table-condensed mt-2 ">
                    <thead>
                    <tr>
                        <th>FECHA USO</th>
                        <th>FECHA PAGO</th>
                        <th>MOVILID</th>
                        <th>CLASE</th>
                        <th>AD</th>
                        <th>PAX</th>
                        <th><sup>$</sup>AD</th>
                        <th>TOTAL</th>
                        <th>SITUACION</th>
                        <th>NRO OPERACION</th>
                        <th>PRIORIDAD</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="bg-dark text-white text-15" ><td colspan="11"><b>MOVILID</b></td></tr>
                    @php
                        $total_movilid=0;
                    @endphp
                    @foreach($cotizaciones as $cotizacion)
                        @foreach($cotizacion->paquete_cotizaciones as $paquete_cotizaciones)
                            @foreach($paquete_cotizaciones->itinerario_cotizaciones as $itinerario_cotizaciones)
                                @foreach($itinerario_cotizaciones->itinerario_servicios as $itinerario_servicios)
                                    @if($itinerario_servicios->servicio->grupo=='MOVILID'&&$itinerario_servicios->servicio->clase=='DEFAULT')
                                        @if($itinerario_servicios->servicio->precio_grupo==1)
                                            @php
                                                $total_movilid+=$itinerario_servicios->precio;
                                            @endphp
                                        @elseif($itinerario_servicios->servicio->precio_grupo==0)
                                            @php
                                                $total_movilid+=$itinerario_servicios->precio*$cotizacion->nropersonas;
                                            @endphp
                                        @endif
                                        <tr>
                                            <td>{{fecha_peru($itinerario_cotizaciones->fecha)}}</td>
                                            <td>{{fecha_peru($itinerario_servicios->fecha_venc)}}</td>
                                            <td>{{$itinerario_servicios->servicio->nombre}}</td>
                                            <td>
                                                {{$itinerario_servicios->servicio->tipoServicio}}
                                                <span class="text-success">
                                                    [{{$itinerario_servicios->servicio->min_personas}} - {{$itinerario_servicios->servicio->max_personas}}]
                                                </span>
                                            </td>
                                            {{--<td><sup class="text-success"><i class="far fa-clock"></i></sup> <span class="text-dark">{{$itinerario_servicios->salida}}</span> <span class="text-success">-</span> <span class="text-dark">{{$itinerario_servicios->llegada}}</span></td>--}}
                                            <td>{{$cotizacion->nropersonas}}</td>
                                            <td>
                                                @foreach($cotizacion->cotizaciones_cliente->where('estado',1) as $cotizaciones_cliente)
                                                    <b><span class="text-success">{{$cotizacion->codigo}}</span> | {{$cotizaciones_cliente->cliente->nombres}} x{{$cotizacion->nropersonas}} {{fecha_peru($cotizacion->fecha)}}</b>
                                                @endforeach
                                            </td>
                                            <td><sup>$</sup>{{$itinerario_servicios->precio}}</td>
                                            <td class="text-success"><sup>$</sup>
                                                @if($itinerario_servicios->servicio->precio_grupo==1)
                                                    {{number_format($itinerario_servicios->precio,2)}}
                                                @elseif($itinerario_servicios->servicio->precio_grupo==0)
                                                    {{number_format($itinerario_servicios->precio*$cotizacion->nropersonas,2)}}
                                                @endif
                                            </td>
                                            <td>
                                                @if($itinerario_servicios->liquidacion==2)
                                                    <span class="badge badge-success">SITUACION</span>
                                                @elseif($itinerario_servicios->liquidacion==1)
                                                    <span class="badge badge-danger">PENDIENTE</span>
                                                @elseif($itinerario_servicios->liquidacion==0)
                                                    <span class="badge badge-secondary">NO ENVIADO</span>
                                                @endif
                                            </td>
                                            <td>
                                                @foreach($liquidaciones->where('id',$itinerario_servicios->liquidacion_id) as $liquidacion)
                                                    @if(trim($liquidacion->nro_operacion)!='')
                                                        {{$liquidacion->nro_operacion}}
                                                    @else
                                                        {{'No tiene'}}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                <span class="badge @if($itinerario_servicios->prioridad=='NORMAL') badge-success @elseif($itinerario_servicios->prioridad=='URGENTE') badge-danger @endif">
                                                    {{$itinerario_servicios->prioridad}}
                                                </span>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        @endforeach
                    @endforeach
                    <tr class="text-15">
                        <td colspan="7"><b>TOTAL</b></td>
                        <td colspan="4"  class="text-dark"><b><sup>$</sup>{{number_format($total_movilid,2)}}</b></td>
                    </tr>
                    <tr>
                        <td colspan="7"><b>GRAN TOTAL</b></td>
                        <td colspan="6" class=""><b><sup>$</sup>{{number_format($total_movilid,2)}}</b></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div id="represent" class="tab-pane fade show ">
                <table class="table table-striped table-hover table-bordered table-responsive table-condensed mt-2 ">
                    <thead>
                    <tr>
                        <th>FECHA USO</th>
                        <th>FECHA PAGO</th>
                        <th>FOOD</th>
                        <th>CLASE</th>
                        <th>AD</th>
                        <th>PAX</th>
                        <th><sup>$</sup>AD</th>
                        <th>TOTAL</th>
                        <th>SITUACION</th>
                        <th>NRO OPERACION</th>
                        <th>PRIORIDAD</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="bg-dark text-white text-15" ><td colspan="11"><b>REPRESENT</b></td></tr>
                    @php
                        $total_represent=0;
                    @endphp
                    @foreach($cotizaciones as $cotizacion)
                        @foreach($cotizacion->paquete_cotizaciones as $paquete_cotizaciones)
                            @foreach($paquete_cotizaciones->itinerario_cotizaciones as $itinerario_cotizaciones)
                                @foreach($itinerario_cotizaciones->itinerario_servicios as $itinerario_servicios)
                                    @if($itinerario_servicios->servicio->grupo=='REPRESENT')
                                        @if($itinerario_servicios->servicio->precio_grupo==1)
                                            @php
                                                $total_represent+=$itinerario_servicios->precio;
                                            @endphp
                                        @elseif($itinerario_servicios->servicio->precio_grupo==0)
                                            @php
                                                $total_represent+=$itinerario_servicios->precio*$cotizacion->nropersonas;
                                            @endphp
                                        @endif
                                        <tr>
                                            <td>{{fecha_peru($itinerario_cotizaciones->fecha)}}</td>
                                            <td>{{fecha_peru($itinerario_servicios->fecha_venc)}}</td>
                                            <td>{{$itinerario_servicios->servicio->nombre}}</td>
                                            <td>{{$itinerario_servicios->servicio->tipoServicio}}</td>
                                            {{--<td><sup class="text-success"><i class="far fa-clock"></i></sup> <span class="text-dark">{{$itinerario_servicios->salida}}</span> <span class="text-success">-</span> <span class="text-dark">{{$itinerario_servicios->llegada}}</span></td>--}}
                                            <td>{{$cotizacion->nropersonas}}</td>
                                            <td>
                                                @foreach($cotizacion->cotizaciones_cliente->where('estado',1) as $cotizaciones_cliente)
                                                    <b><span class="text-success">{{$cotizacion->codigo}}</span> | {{$cotizaciones_cliente->cliente->nombres}} x{{$cotizacion->nropersonas}} {{fecha_peru($cotizacion->fecha)}}</b>
                                                @endforeach
                                            </td>
                                            <td><sup>$</sup>{{$itinerario_servicios->precio}}</td>
                                            <td class="text-success"><sup>$</sup>
                                                @if($itinerario_servicios->servicio->precio_grupo==1)
                                                    {{number_format($itinerario_servicios->precio,2)}}
                                                @elseif($itinerario_servicios->servicio->precio_grupo==0)
                                                    {{number_format($itinerario_servicios->precio*$cotizacion->nropersonas,2)}}
                                                @endif

                                            </td>
                                            <td>
                                                @if($itinerario_servicios->liquidacion==2)
                                                    <span class="badge badge-success">SITUACION</span>
                                                @elseif($itinerario_servicios->liquidacion==1)
                                                    <span class="badge badge-danger">PENDIENTE</span>
                                                @elseif($itinerario_servicios->liquidacion==0)
                                                    <span class="badge badge-secondary">NO ENVIADO</span>
                                                @endif
                                            </td>
                                            <td>
                                                @foreach($liquidaciones->where('id',$itinerario_servicios->liquidacion_id) as $liquidacion)
                                                    @if(trim($liquidacion->nro_operacion)!='')
                                                        {{$liquidacion->nro_operacion}}
                                                    @else
                                                        {{'No tiene'}}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                <span class="badge @if($itinerario_servicios->prioridad=='NORMAL') badge-success @elseif($itinerario_servicios->prioridad=='URGENTE') badge-danger @endif">
                                                    {{$itinerario_servicios->prioridad}}
                                                </span>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        @endforeach
                    @endforeach
                    <tr class="text-15">
                        <td colspan="7"><b>TOTAL</b></td>
                        <td colspan="4"  class="text-dark"><b><sup>$</sup>{{number_format($total_represent,2)}}</b></td>
                    </tr>
                    <tr>
                        <td colspan="7"><b>GRAN TOTAL</b></td>
                        <td colspan="6" class=""><b><sup>$</sup>{{number_format($total_represent,2)}}</b></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div id="entrances" class="tab-pane fade show ">
                <table class="table table-striped table-hover table-bordered table-responsive table-condensed mt-2 ">
                    <thead>
                        <tr>
                            <th>FECHA USO</th>
                            <th>FECHA PAGO</th>
                            <th>ENTRADA</th>
                            <th>AD</th>
                            <th>PAX</th>
                            <th><sup>$</sup>AD</th>
                            <th>TOTAL</th>
                            <th>SITUACION</th>
                            <th>NRO OPERACION</th>
                            <th>PRIORIDAD</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-dark text-white text-15" ><td colspan="10"><b>LIQUIDACION DE BOLETOS TURISTICOS</b></td></tr>
                        @php
                            $total_btg=0;
                        @endphp
                        @foreach($cotizaciones as $cotizacion)
                            @foreach($cotizacion->paquete_cotizaciones as $paquete_cotizaciones)
                                @foreach($paquete_cotizaciones->itinerario_cotizaciones as $itinerario_cotizaciones)
                                    @foreach($itinerario_cotizaciones->itinerario_servicios as $itinerario_servicios)
                                        @if($itinerario_servicios->servicio->grupo=='ENTRANCES' && $itinerario_servicios->servicio->clase=='BTG')
                                            @php
                                                $total_btg+=$itinerario_servicios->precio*$cotizacion->nropersonas;
                                            @endphp
                                        <tr>
                                            <td>{{fecha_peru($itinerario_cotizaciones->fecha)}}</td>
                                            <td>{{fecha_peru($itinerario_servicios->fecha_venc)}}</td>
                                            <td>{{$itinerario_servicios->servicio->nombre}}</td>
                                            <td>{{$cotizacion->nropersonas}}</td>
                                            <td>
                                                @foreach($cotizacion->cotizaciones_cliente->where('estado',1) as $cotizaciones_cliente)
                                                    <b>{{$cotizaciones_cliente->cliente->nombres}} x{{$cotizacion->nropersonas}} {{fecha_peru($cotizacion->fecha)}}</b>
                                                @endforeach
                                            </td>
                                            <td><sup>$</sup>{{$itinerario_servicios->precio}}</td>
                                            <td class="text-success"><sup>$</sup>{{number_format($itinerario_servicios->precio*$cotizacion->nropersonas,2)}}</td>
                                            <td>
                                                @if($itinerario_servicios->liquidacion==2)
                                                    <span class="badge badge-success">SITUACION</span>
                                                @elseif($itinerario_servicios->liquidacion==1)
                                                    <span class="badge badge-danger">PENDIENTE</span>
                                                @elseif($itinerario_servicios->liquidacion==0)
                                                    <span class="badge badge-secondary">NO ENVIADO</span>
                                                @endif
                                            </td>
                                            <td>
                                                @foreach($liquidaciones->where('id',$itinerario_servicios->liquidacion_id) as $liquidacion)
                                                    @if(trim($liquidacion->nro_operacion)!='')
                                                        {{$liquidacion->nro_operacion}}
                                                    @else
                                                        {{'No tiene'}}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                <span class="badge @if($itinerario_servicios->prioridad=='NORMAL') badge-success @elseif($itinerario_servicios->prioridad=='URGENTE') badge-danger @endif">
                                                    {{$itinerario_servicios->prioridad}}
                                                </span>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endforeach
                        <tr class="text-15">
                            <td colspan="6"><b>TOTAL</b></td>
                            <td colspan="4"  class="text-dark"><b><sup>$</sup>{{number_format($total_btg,2)}}</b></td>
                        </tr>

                        <tr class="bg-dark text-white text-15" ><td colspan="10"><b>LIQUIDACION DE INGRESO A CATEDRAL</b></td></tr>
                        @php
                            $total_cat=0;
                        @endphp
                        @foreach($cotizaciones as $cotizacion)
                            @foreach($cotizacion->paquete_cotizaciones as $paquete_cotizaciones)
                                @foreach($paquete_cotizaciones->itinerario_cotizaciones as $itinerario_cotizaciones)
                                    @foreach($itinerario_cotizaciones->itinerario_servicios as $itinerario_servicios)
                                        @if($itinerario_servicios->servicio->grupo=='ENTRANCES' && $itinerario_servicios->servicio->clase=='CAT')
                                            @php
                                                $total_cat+=$itinerario_servicios->precio*$cotizacion->nropersonas;
                                            @endphp
                                            <tr>
                                                <td>{{fecha_peru($itinerario_cotizaciones->fecha)}}</td>
                                                <td>{{fecha_peru($itinerario_servicios->fecha_venc)}}</td>
                                                <td>{{$itinerario_servicios->servicio->nombre}}</td>
                                                <td>{{$cotizacion->nropersonas}}</td>
                                                <td>
                                                    @foreach($cotizacion->cotizaciones_cliente->where('estado',1) as $cotizaciones_cliente)
                                                        <b><span class="text-success">{{$cotizacion->codigo}}</span> | {{$cotizaciones_cliente->cliente->nombres}} x{{$cotizacion->nropersonas}} {{fecha_peru($cotizacion->fecha)}}</b>
                                                    @endforeach
                                                </td>
                                                <td><sup>$</sup>{{$itinerario_servicios->precio}}</td>
                                                <td class="text-success"><sup>$</sup>{{number_format($itinerario_servicios->precio*$cotizacion->nropersonas,2)}}</td>
                                                <td>
                                                    @if($itinerario_servicios->liquidacion==2)
                                                        <span class="badge badge-success">SITUACION</span>
                                                    @elseif($itinerario_servicios->liquidacion==1)
                                                        <span class="badge badge-danger">PENDIENTE</span>
                                                    @elseif($itinerario_servicios->liquidacion==0)
                                                        <span class="badge badge-secondary">NO ENVIADO</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @foreach($liquidaciones->where('id',$itinerario_servicios->liquidacion_id) as $liquidacion)
                                                        @if(trim($liquidacion->nro_operacion)!='')
                                                            {{$liquidacion->nro_operacion}}
                                                        @else
                                                            {{'No tiene'}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <span class="badge @if($itinerario_servicios->prioridad=='NORMAL') badge-success @elseif($itinerario_servicios->prioridad=='URGENTE') badge-danger @endif">
                                                        {{$itinerario_servicios->prioridad}}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endforeach
                        <tr class="text-15">
                            <td colspan="6"><b>TOTAL</b></td>
                            <td colspan="4"  class="text-dark"><b><sup>$</sup>{{number_format($total_cat,2)}}</b></td>
                        </tr>

                        <tr class="bg-dark text-white text-15" ><td colspan="10"><b>LIQUIDACION DE INGRESO AL KORICANCHA</b></td></tr>
                        @php
                            $total_kori=0;
                        @endphp
                        @foreach($cotizaciones as $cotizacion)
                            @foreach($cotizacion->paquete_cotizaciones as $paquete_cotizaciones)
                                @foreach($paquete_cotizaciones->itinerario_cotizaciones as $itinerario_cotizaciones)
                                    @foreach($itinerario_cotizaciones->itinerario_servicios as $itinerario_servicios)
                                        @if($itinerario_servicios->servicio->grupo=='ENTRANCES' && $itinerario_servicios->servicio->clase=='KORI')
                                            @php
                                                $total_kori+=$itinerario_servicios->precio*$cotizacion->nropersonas;
                                            @endphp
                                            <tr>
                                                <td>{{fecha_peru($itinerario_cotizaciones->fecha)}}</td>
                                                <td>{{fecha_peru($itinerario_servicios->fecha_venc)}}</td>
                                                <td>{{$itinerario_servicios->servicio->nombre}}</td>
                                                <td>{{$cotizacion->nropersonas}}</td>
                                                <td>
                                                    @foreach($cotizacion->cotizaciones_cliente->where('estado',1) as $cotizaciones_cliente)
                                                        <b><span class="text-success">{{$cotizacion->codigo}}</span> | {{$cotizaciones_cliente->cliente->nombres}} x{{$cotizacion->nropersonas}} {{fecha_peru($cotizacion->fecha)}}</b>
                                                    @endforeach
                                                </td>
                                                <td><sup>$</sup>{{$itinerario_servicios->precio}}</td>
                                                <td class="text-success"><sup>$</sup>{{number_format($itinerario_servicios->precio*$cotizacion->nropersonas,2)}}</td>
                                                <td>
                                                    @if($itinerario_servicios->liquidacion==2)
                                                        <span class="badge badge-success">SITUACION</span>
                                                    @elseif($itinerario_servicios->liquidacion==1)
                                                        <span class="badge badge-danger">PENDIENTE</span>
                                                    @elseif($itinerario_servicios->liquidacion==0)
                                                        <span class="badge badge-secondary">NO ENVIADO</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @foreach($liquidaciones->where('id',$itinerario_servicios->liquidacion_id) as $liquidacion)
                                                        @if(trim($liquidacion->nro_operacion)!='')
                                                            {{$liquidacion->nro_operacion}}
                                                        @else
                                                            {{'No tiene'}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <span class="badge @if($itinerario_servicios->prioridad=='NORMAL') badge-success @elseif($itinerario_servicios->prioridad=='URGENTE') badge-danger @endif">
                                                        {{$itinerario_servicios->prioridad}}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endforeach
                        <tr class="text-15">
                            <td colspan="6"><b>TOTAL</b></td>
                            <td colspan="4"  class="text-dark"><b><sup>$</sup>{{number_format($total_kori,2)}}</b></td>
                        </tr>

                        <tr class="bg-dark text-white text-15" ><td colspan="10"><b>LIQUIDACION DE INGRESO A MACHUPICCHU</b></td></tr>
                        @php
                            $total_mapi=0;
                        @endphp
                        @foreach($cotizaciones as $cotizacion)
                            @foreach($cotizacion->paquete_cotizaciones as $paquete_cotizaciones)
                                @foreach($paquete_cotizaciones->itinerario_cotizaciones as $itinerario_cotizaciones)
                                    @foreach($itinerario_cotizaciones->itinerario_servicios as $itinerario_servicios)
                                        @if($itinerario_servicios->servicio->grupo=='ENTRANCES' && $itinerario_servicios->servicio->clase=='MAPI')
                                            @php
                                                $total_mapi+=$itinerario_servicios->precio*$cotizacion->nropersonas;
                                            @endphp
                                            <tr>
                                                <td>{{fecha_peru($itinerario_cotizaciones->fecha)}}</td>
                                                <td>{{fecha_peru($itinerario_servicios->fecha_venc)}}</td>
                                                <td>{{$itinerario_servicios->servicio->nombre}}</td>
                                                <td>{{$cotizacion->nropersonas}}</td>
                                                <td>
                                                    @foreach($cotizacion->cotizaciones_cliente->where('estado',1) as $cotizaciones_cliente)
                                                        <b><span class="text-success">{{$cotizacion->codigo}}</span> | {{$cotizaciones_cliente->cliente->nombres}} x{{$cotizacion->nropersonas}} {{fecha_peru($cotizacion->fecha)}}</b>
                                                    @endforeach
                                                </td>
                                                <td><sup>$</sup>{{$itinerario_servicios->precio}}</td>
                                                <td class="text-success"><sup>$</sup>{{number_format($itinerario_servicios->precio*$cotizacion->nropersonas,2)}}</td>
                                                <td>
                                                    @if($itinerario_servicios->liquidacion==2)
                                                        <span class="badge badge-success">SITUACION</span>
                                                    @elseif($itinerario_servicios->liquidacion==1)
                                                        <span class="badge badge-danger">PENDIENTE</span>
                                                    @elseif($itinerario_servicios->liquidacion==0)
                                                        <span class="badge badge-secondary">NO ENVIADO</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @foreach($liquidaciones->where('id',$itinerario_servicios->liquidacion_id) as $liquidacion)
                                                        @if(trim($liquidacion->nro_operacion)!='')
                                                            {{$liquidacion->nro_operacion}}
                                                        @else
                                                            {{'No tiene'}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <span class="badge @if($itinerario_servicios->prioridad=='NORMAL') badge-success @elseif($itinerario_servicios->prioridad=='URGENTE') badge-danger @endif">
                                                        {{$itinerario_servicios->prioridad}}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endforeach
                        <tr class="text-15">
                            <td colspan="6"><b>TOTAL</b></td>
                            <td colspan="4"  class="text-dark"><b><sup>$</sup>{{number_format($total_mapi,2)}}</b></td>
                        </tr>

                        <tr class="bg-dark text-white text-15" ><td colspan="10"><b>ENTRADAS OTROS</b></td></tr>
                        @php
                            $total_otros=0;
                        @endphp
                        @foreach($cotizaciones as $cotizacion)
                            @foreach($cotizacion->paquete_cotizaciones as $paquete_cotizaciones)
                                @foreach($paquete_cotizaciones->itinerario_cotizaciones as $itinerario_cotizaciones)
                                    @foreach($itinerario_cotizaciones->itinerario_servicios as $itinerario_servicios)
                                        @if($itinerario_servicios->servicio->grupo=='ENTRANCES' && $itinerario_servicios->servicio->clase=='OTROS')
                                            @php
                                                $total_otros+=$itinerario_servicios->precio*$cotizacion->nropersonas;
                                            @endphp
                                            <tr>
                                                <td>{{fecha_peru($itinerario_cotizaciones->fecha)}}</td>
                                                <td>{{fecha_peru($itinerario_servicios->fecha_venc)}}</td>
                                                <td>{{$itinerario_servicios->servicio->nombre}}</td>
                                                <td>{{$cotizacion->nropersonas}}</td>
                                                <td>
                                                    @foreach($cotizacion->cotizaciones_cliente->where('estado',1) as $cotizaciones_cliente)
                                                        <b><span class="text-success">{{$cotizacion->codigo}}</span> | {{$cotizaciones_cliente->cliente->nombres}} x{{$cotizacion->nropersonas}} {{fecha_peru($cotizacion->fecha)}}</b>
                                                    @endforeach
                                                </td>
                                                <td><sup>$</sup>{{$itinerario_servicios->precio}}</td>
                                                <td class="text-success"><sup>$</sup>{{number_format($itinerario_servicios->precio*$cotizacion->nropersonas,2)}}</td>
                                                <td>
                                                    @if($itinerario_servicios->liquidacion==2)
                                                        <span class="badge badge-success">SITUACION</span>
                                                    @elseif($itinerario_servicios->liquidacion==1)
                                                        <span class="badge badge-danger">PENDIENTE</span>
                                                    @elseif($itinerario_servicios->liquidacion==0)
                                                        <span class="badge badge-secondary">NO ENVIADO</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @foreach($liquidaciones->where('id',$itinerario_servicios->liquidacion_id) as $liquidacion)
                                                        @if(trim($liquidacion->nro_operacion)!='')
                                                            {{$liquidacion->nro_operacion}}
                                                        @else
                                                            {{'No tiene'}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <span class="badge @if($itinerario_servicios->prioridad=='NORMAL') badge-success @elseif($itinerario_servicios->prioridad=='URGENTE') badge-danger @endif">
                                                        {{$itinerario_servicios->prioridad}}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endforeach
                        <tr class="text-15">
                            <td colspan="6"><b>TOTAL</b></td>
                            <td colspan="4"  class="text-dark"><b><sup>$</sup>{{number_format($total_otros,2)}}</b></td>
                        </tr>

                        <tr class="bg-dark text-white text-15" ><td colspan="10"><b>ENTRADAS BUSES</b></td></tr>
                        @php
                            $total_buses=0;
                        @endphp
                        @foreach($cotizaciones as $cotizacion)
                            @foreach($cotizacion->paquete_cotizaciones as $paquete_cotizaciones)
                                @foreach($paquete_cotizaciones->itinerario_cotizaciones as $itinerario_cotizaciones)
                                    @foreach($itinerario_cotizaciones->itinerario_servicios as $itinerario_servicios)
                                        @if($itinerario_servicios->servicio->grupo=='MOVILID' && $itinerario_servicios->servicio->clase=='BOLETO')
                                            @php
                                                $total_buses+=$itinerario_servicios->precio*$cotizacion->nropersonas;
                                            @endphp
                                            <tr>
                                                <td>{{fecha_peru($itinerario_cotizaciones->fecha)}}</td>
                                                <td>{{fecha_peru($itinerario_servicios->fecha_venc)}}</td>
                                                <td>{{$itinerario_servicios->servicio->nombre}}</td>
                                                <td>{{$cotizacion->nropersonas}}</td>
                                                <td>
                                                    @foreach($cotizacion->cotizaciones_cliente->where('estado',1) as $cotizaciones_cliente)
                                                        <b><span class="text-success">{{$cotizacion->codigo}}</span> | {{$cotizaciones_cliente->cliente->nombres}} x{{$cotizacion->nropersonas}} {{fecha_peru($cotizacion->fecha)}}</b>
                                                    @endforeach
                                                </td>
                                                <td><sup>$</sup>{{$itinerario_servicios->precio}}</td>
                                                <td class="text-success"><sup>$</sup>{{number_format($itinerario_servicios->precio*$cotizacion->nropersonas,2)}}</td>
                                                <td>
                                                    @if($itinerario_servicios->liquidacion==2)
                                                        <span class="badge badge-success">SITUACION</span>
                                                    @elseif($itinerario_servicios->liquidacion==1)
                                                        <span class="badge badge-danger">PENDIENTE</span>
                                                    @elseif($itinerario_servicios->liquidacion==0)
                                                        <span class="badge badge-secondary">NO ENVIADO</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @foreach($liquidaciones->where('id',$itinerario_servicios->liquidacion_id) as $liquidacion)
                                                        @if(trim($liquidacion->nro_operacion)!='')
                                                            {{$liquidacion->nro_operacion}}
                                                        @else
                                                            {{'No tiene'}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <span class="badge @if($itinerario_servicios->prioridad=='NORMAL') badge-success @elseif($itinerario_servicios->prioridad=='URGENTE') badge-danger @endif">
                                                        {{$itinerario_servicios->prioridad}}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endforeach
                        <tr class="text-15">
                            <td colspan="6"><b>TOTAL</b></td>
                            <td colspan="4" class="text-dark"><b><sup>$</sup>{{number_format($total_buses,2)}}</b></td>
                        </tr>
                        <tr>
                            <td colspan="6"><b>GRAN TOTAL</b></td>
                            <td colspan="6" class=""><b><sup>$</sup>{{number_format($total_btg+$total_cat+$total_kori+$total_mapi+$total_otros+$total_buses,2)}}</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="food" class="tab-pane fade show ">
                <table class="table table-striped table-hover table-bordered table-responsive table-condensed mt-2 ">
                    <thead>
                    <tr>
                        <th>FECHA USO</th>
                        <th>FECHA PAGO</th>
                        <th>FOOD</th>
                        <th>CLASE</th>
                        <th>AD</th>
                        <th>PAX</th>
                        <th><sup>$</sup>AD</th>
                        <th>TOTAL</th>
                        <th>SITUACION</th>
                        <th>NRO OPERACION</th>
                        <th>PRIORIDAD</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="bg-dark text-white text-15" ><td colspan="11"><b>FOOD</b></td></tr>
                    @php
                        $total_food=0;
                    @endphp
                    @foreach($cotizaciones as $cotizacion)
                        @foreach($cotizacion->paquete_cotizaciones as $paquete_cotizaciones)
                            @foreach($paquete_cotizaciones->itinerario_cotizaciones as $itinerario_cotizaciones)
                                @foreach($itinerario_cotizaciones->itinerario_servicios as $itinerario_servicios)
                                    @if($itinerario_servicios->servicio->grupo=='FOOD')
                                        @if($itinerario_servicios->servicio->precio_grupo==1)
                                            @php
                                                $total_food+=$itinerario_servicios->precio;
                                            @endphp
                                        @elseif($itinerario_servicios->servicio->precio_grupo==0)
                                            @php
                                                $total_food+=$itinerario_servicios->precio*$cotizacion->nropersonas;
                                            @endphp
                                        @endif
                                        <tr>
                                            <td>{{fecha_peru($itinerario_cotizaciones->fecha)}}</td>
                                            <td>{{fecha_peru($itinerario_servicios->fecha_venc)}}</td>
                                            <td>{{$itinerario_servicios->servicio->nombre}}</td>
                                            <td>{{$itinerario_servicios->servicio->tipoServicio}}</td>
                                            {{--<td><sup class="text-success"><i class="far fa-clock"></i></sup> <span class="text-dark">{{$itinerario_servicios->salida}}</span> <span class="text-success">-</span> <span class="text-dark">{{$itinerario_servicios->llegada}}</span></td>--}}
                                            <td>{{$cotizacion->nropersonas}}</td>
                                            <td>
                                                @foreach($cotizacion->cotizaciones_cliente->where('estado',1) as $cotizaciones_cliente)
                                                    <b><span class="text-success">{{$cotizacion->codigo}}</span> | {{$cotizaciones_cliente->cliente->nombres}} x{{$cotizacion->nropersonas}} {{fecha_peru($cotizacion->fecha)}}</b>
                                                @endforeach
                                            </td>
                                            <td><sup>$</sup>{{$itinerario_servicios->precio}}</td>
                                            <td class="text-success"><sup>$</sup>
                                                @if($itinerario_servicios->servicio->precio_grupo==1)
                                                    {{number_format($itinerario_servicios->precio,2)}}
                                                @elseif($itinerario_servicios->servicio->precio_grupo==0)
                                                    {{number_format($itinerario_servicios->precio*$cotizacion->nropersonas,2)}}
                                                @endif
                                            </td>
                                            <td>
                                                @if($itinerario_servicios->liquidacion==2)
                                                    <span class="badge badge-success">SITUACION</span>
                                                @elseif($itinerario_servicios->liquidacion==1)
                                                    <span class="badge badge-danger">PENDIENTE</span>
                                                @elseif($itinerario_servicios->liquidacion==0)
                                                    <span class="badge badge-secondary">NO ENVIADO</span>
                                                @endif
                                            </td>
                                            <td>
                                                @foreach($liquidaciones->where('id',$itinerario_servicios->liquidacion_id) as $liquidacion)
                                                    @if(trim($liquidacion->nro_operacion)!='')
                                                        {{$liquidacion->nro_operacion}}
                                                    @else
                                                        {{'No tiene'}}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                <span class="badge @if($itinerario_servicios->prioridad=='NORMAL') badge-success @elseif($itinerario_servicios->prioridad=='URGENTE') badge-danger @endif">
                                                    {{$itinerario_servicios->prioridad}}
                                                </span>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        @endforeach
                    @endforeach
                    <tr class="text-15">
                        <td colspan="7"><b>TOTAL</b></td>
                        <td colspan="4"  class="text-dark"><b><sup>$</sup>{{number_format($total_food,2)}}</b></td>
                    </tr>
                    <tr>
                        <td colspan="7"><b>GRAN TOTAL</b></td>
                        <td colspan="6" class=""><b><sup>$</sup>{{number_format($total_food,2)}}</b></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div id="trains" class="tab-pane fade show ">
                <table class="table table-striped table-hover table-bordered table-responsive table-condensed mt-2 ">
                    <thead>
                    <tr>
                        <th>FECHA USO</th>
                        <th>FECHA PAGO</th>
                        <th>TREN</th>
                        <th>SAL - LLEG</th>
                        <th>AD</th>
                        <th>PAX</th>
                        <th><sup>$</sup>AD</th>
                        <th>TOTAL</th>
                        <th>SITUACION</th>
                        <th>NRO OPERACION</th>
                        <th>PRIORIDAD</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="bg-dark text-white text-15" ><td colspan="11"><b>ENTRADAS DE TRENES</b></td></tr>
                    @php
                        $total_train=0;
                    @endphp
                    @foreach($cotizaciones as $cotizacion)
                        @foreach($cotizacion->paquete_cotizaciones as $paquete_cotizaciones)
                            @foreach($paquete_cotizaciones->itinerario_cotizaciones as $itinerario_cotizaciones)
                                @foreach($itinerario_cotizaciones->itinerario_servicios as $itinerario_servicios)
                                    @if($itinerario_servicios->servicio->grupo=='TRAINS')
                                        @if($itinerario_servicios->servicio->precio_grupo==1)
                                            @php
                                                $total_train+=$itinerario_servicios->precio;
                                            @endphp
                                        @elseif($itinerario_servicios->servicio->precio_grupo==0)
                                            @php
                                                $total_train+=$itinerario_servicios->precio*$cotizacion->nropersonas;
                                            @endphp
                                        @endif
                                        <tr>
                                            <td>{{fecha_peru($itinerario_cotizaciones->fecha)}}</td>
                                            <td>{{fecha_peru($itinerario_servicios->fecha_venc)}}</td>
                                            <td>{{$itinerario_servicios->servicio->nombre}}</td>
                                            <td><sup class="text-success"><i class="far fa-clock"></i></sup> <span class="text-dark">{{$itinerario_servicios->salida}}</span> <span class="text-success">-</span> <span class="text-dark">{{$itinerario_servicios->llegada}}</span></td>
                                            <td>{{$cotizacion->nropersonas}}</td>
                                            <td>
                                                @foreach($cotizacion->cotizaciones_cliente->where('estado',1) as $cotizaciones_cliente)
                                                    <b><span class="text-success">{{$cotizacion->codigo}}</span> | {{$cotizaciones_cliente->cliente->nombres}} x{{$cotizacion->nropersonas}} {{fecha_peru($cotizacion->fecha)}}</b>
                                                @endforeach
                                            </td>
                                            <td><sup>$</sup>{{$itinerario_servicios->precio}}</td>
                                            <td class="text-success"><sup>$</sup>
                                                @if($itinerario_servicios->servicio->precio_grupo==1)
                                                    {{number_format($itinerario_servicios->precio,2)}}
                                                @elseif($itinerario_servicios->servicio->precio_grupo==0)
                                                    {{number_format($itinerario_servicios->precio*$cotizacion->nropersonas,2)}}
                                                @endif

                                            </td>
                                            <td>
                                                @if($itinerario_servicios->liquidacion==2)
                                                    <span class="badge badge-success">SITUACION</span>
                                                @elseif($itinerario_servicios->liquidacion==1)
                                                    <span class="badge badge-danger">PENDIENTE</span>
                                                @elseif($itinerario_servicios->liquidacion==0)
                                                    <span class="badge badge-secondary">NO ENVIADO</span>
                                                @endif
                                            </td>
                                            <td>
                                                @foreach($liquidaciones->where('id',$itinerario_servicios->liquidacion_id) as $liquidacion)
                                                    @if(trim($liquidacion->nro_operacion)!='')
                                                        {{$liquidacion->nro_operacion}}
                                                    @else
                                                        {{'No tiene'}}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                <span class="badge @if($itinerario_servicios->prioridad=='NORMAL') badge-success @elseif($itinerario_servicios->prioridad=='URGENTE') badge-danger @endif">
                                                    {{$itinerario_servicios->prioridad}}
                                                </span>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        @endforeach
                    @endforeach
                    <tr class="text-15">
                        <td colspan="7"><b>TOTAL</b></td>
                        <td colspan="4"  class="text-dark"><b><sup>$</sup>{{number_format($total_train,2)}}</b></td>
                    </tr>
                    <tr>
                        <td colspan="7"><b>GRAN TOTAL</b></td>
                        <td colspan="6" class=""><b><sup>$</sup>{{number_format($total_train,2)}}</b></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div id="flights" class="tab-pane fade show ">
                <table class="table table-striped table-hover table-bordered table-responsive table-condensed mt-2 ">
                    <thead>
                    <tr>
                        <th>FECHA USO</th>
                        <th>FECHA PAGO</th>
                        <th>FLIGHTS</th>
                        <th>CLASE</th>
                        <th>AD</th>
                        <th>PAX</th>
                        <th><sup>$</sup>AD</th>
                        <th>TOTAL</th>
                        <th>SITUACION</th>
                        <th>NRO OPERACION</th>
                        <th>PRIORIDAD</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="bg-dark text-white text-15" ><td colspan="11"><b>FLIGHTS</b></td></tr>
                    @php
                        $total_flight=0;
                    @endphp
                    @foreach($cotizaciones as $cotizacion)
                        @foreach($cotizacion->paquete_cotizaciones as $paquete_cotizaciones)
                            @foreach($paquete_cotizaciones->itinerario_cotizaciones as $itinerario_cotizaciones)
                                @foreach($itinerario_cotizaciones->itinerario_servicios as $itinerario_servicios)
                                    @if($itinerario_servicios->servicio->grupo=='FLIGHTS')
                                        @if($itinerario_servicios->servicio->precio_grupo==1)
                                            @php
                                                $total_flight+=$itinerario_servicios->precio;
                                            @endphp
                                        @elseif($itinerario_servicios->servicio->precio_grupo==0)
                                            @php
                                                $total_flight+=$itinerario_servicios->precio*$cotizacion->nropersonas;
                                            @endphp
                                        @endif
                                        <tr>
                                            <td>{{fecha_peru($itinerario_cotizaciones->fecha)}}</td>
                                            <td>{{fecha_peru($itinerario_servicios->fecha_venc)}}</td>
                                            <td>{{$itinerario_servicios->servicio->nombre}}</td>
                                            <td>{{$itinerario_servicios->servicio->tipoServicio}}</td>
                                            {{--<td><sup class="text-success"><i class="far fa-clock"></i></sup> <span class="text-dark">{{$itinerario_servicios->salida}}</span> <span class="text-success">-</span> <span class="text-dark">{{$itinerario_servicios->llegada}}</span></td>--}}
                                            <td>{{$cotizacion->nropersonas}}</td>
                                            <td>
                                                @foreach($cotizacion->cotizaciones_cliente->where('estado',1) as $cotizaciones_cliente)
                                                    <b><span class="text-success">{{$cotizacion->codigo}}</span> | {{$cotizaciones_cliente->cliente->nombres}} x{{$cotizacion->nropersonas}} {{fecha_peru($cotizacion->fecha)}}</b>
                                                @endforeach
                                            </td>
                                            <td><sup>$</sup>{{$itinerario_servicios->precio}}</td>
                                            <td class="text-success"><sup>$</sup>
                                                @if($itinerario_servicios->servicio->precio_grupo==1)
                                                    {{number_format($itinerario_servicios->precio,2)}}
                                                @elseif($itinerario_servicios->servicio->precio_grupo==0)
                                                    {{number_format($itinerario_servicios->precio*$cotizacion->nropersonas,2)}}
                                                @endif
                                            </td>
                                            <td>
                                                @if($itinerario_servicios->liquidacion==2)
                                                    <span class="badge badge-success">SITUACION</span>
                                                @elseif($itinerario_servicios->liquidacion==1)
                                                    <span class="badge badge-danger">PENDIENTE</span>
                                                @elseif($itinerario_servicios->liquidacion==0)
                                                    <span class="badge badge-secondary">NO ENVIADO</span>
                                                @endif
                                            </td>
                                            <td>
                                                @foreach($liquidaciones->where('id',$itinerario_servicios->liquidacion_id) as $liquidacion)
                                                    @if(trim($liquidacion->nro_operacion)!='')
                                                        {{$liquidacion->nro_operacion}}
                                                    @else
                                                        {{'No tiene'}}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                <span class="badge @if($itinerario_servicios->prioridad=='NORMAL') badge-success @elseif($itinerario_servicios->prioridad=='URGENTE') badge-danger @endif">
                                                    {{$itinerario_servicios->prioridad}}
                                                </span>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        @endforeach
                    @endforeach
                    <tr class="text-15">
                        <td colspan="7"><b>TOTAL</b></td>
                        <td colspan="4"  class="text-dark"><b><sup>$</sup>{{number_format($total_flight,2)}}</b></td>
                    </tr>
                    <tr>
                        <td colspan="7"><b>GRAN TOTAL</b></td>
                        <td colspan="6" class=""><b><sup>$</sup>{{number_format($total_flight,2)}}</b></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div id="others" class="tab-pane fade show ">
                <table class="table table-striped table-hover table-bordered table-responsive table-condensed mt-2">
                    <thead>
                    <tr>
                        <th>FECHA USO</th>
                        <th>FECHA PAGO</th>
                        <th>SERVICIO</th>
                        <th>CLASE</th>
                        <th>AD</th>
                        <th>PAX</th>
                        <th><sup>$</sup>AD</th>
                        <th>TOTAL</th>
                        <th>SITUACION</th>
                        <th>NRO OPERACION</th>
                        <th>PRIORIDAD</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="bg-dark text-white text-15" ><td colspan="11"><b>SERVICIO</b></td></tr>
                    @php
                        $total_others=0;
                    @endphp
                    @foreach($cotizaciones as $cotizacion)
                        @foreach($cotizacion->paquete_cotizaciones as $paquete_cotizaciones)
                            @foreach($paquete_cotizaciones->itinerario_cotizaciones as $itinerario_cotizaciones)
                                @foreach($itinerario_cotizaciones->itinerario_servicios as $itinerario_servicios)
                                    @if($itinerario_servicios->servicio->grupo=='OTHERS')
                                        @if($itinerario_servicios->servicio->precio_grupo==1)
                                            @php
                                                $total_others+=$itinerario_servicios->precio;
                                            @endphp
                                        @elseif($itinerario_servicios->servicio->precio_grupo==0)
                                            @php
                                                $total_others+=$itinerario_servicios->precio*$cotizacion->nropersonas;
                                            @endphp
                                        @endif
                                        <tr>
                                            <td>{{fecha_peru($itinerario_cotizaciones->fecha)}}</td>
                                            <td>{{fecha_peru($itinerario_servicios->fecha_venc)}}</td>
                                            <td>{{$itinerario_servicios->servicio->nombre}}</td>
                                            <td>{{$itinerario_servicios->servicio->tipoServicio}}</td>
                                            {{--<td><sup class="text-success"><i class="far fa-clock"></i></sup> <span class="text-dark">{{$itinerario_servicios->salida}}</span> <span class="text-success">-</span> <span class="text-dark">{{$itinerario_servicios->llegada}}</span></td>--}}
                                            <td>{{$cotizacion->nropersonas}}</td>
                                            <td>
                                                @foreach($cotizacion->cotizaciones_cliente->where('estado',1) as $cotizaciones_cliente)
                                                    <b><span class="text-success">{{$cotizacion->codigo}}</span> | {{$cotizaciones_cliente->cliente->nombres}} x{{$cotizacion->nropersonas}} {{fecha_peru($cotizacion->fecha)}}</b>
                                                @endforeach
                                            </td>
                                            <td><sup>$</sup>{{$itinerario_servicios->precio}}</td>
                                            <td class="text-success"><sup>$</sup>
                                                @if($itinerario_servicios->servicio->precio_grupo==1)
                                                    {{number_format($itinerario_servicios->precio,2)}}
                                                @elseif($itinerario_servicios->servicio->precio_grupo==0)
                                                    {{number_format($itinerario_servicios->precio*$cotizacion->nropersonas,2)}}
                                                @endif
                                            </td>
                                            <td>
                                                @if($itinerario_servicios->liquidacion==2)
                                                    <span class="badge badge-success">SITUACION</span>
                                                @elseif($itinerario_servicios->liquidacion==1)
                                                    <span class="badge badge-danger">PENDIENTE</span>
                                                @elseif($itinerario_servicios->liquidacion==0)
                                                    <span class="badge badge-secondary">NO ENVIADO</span>
                                                @endif
                                            </td>
                                            <td>
                                                @foreach($liquidaciones->where('id',$itinerario_servicios->liquidacion_id) as $liquidacion)
                                                    @if(trim($liquidacion->nro_operacion)!='')
                                                        {{$liquidacion->nro_operacion}}
                                                    @else
                                                        {{'No tiene'}}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                <span class="badge @if($itinerario_servicios->prioridad=='NORMAL') badge-success @elseif($itinerario_servicios->prioridad=='URGENTE') badge-danger @endif">
                                                    {{$itinerario_servicios->prioridad}}
                                                </span>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        @endforeach
                    @endforeach
                    <tr class="text-15">
                        <td colspan="7"><b>TOTAL</b></td>
                        <td colspan="4"  class="text-dark"><b><sup>$</sup>{{number_format($total_others,2)}}</b></td>
                    </tr>
                    <tr>
                        <td colspan="7"><b>GRAN TOTAL</b></td>
                        <td colspan="6" class=""><b><sup>$</sup>{{number_format($total_others,2)}}</b></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>