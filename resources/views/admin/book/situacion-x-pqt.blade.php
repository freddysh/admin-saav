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
                HOTELS
            </div>
            <div id="tours" class="tab-pane fade show ">
                TOURS
            </div>
            <div id="movilid" class="tab-pane fade show ">
                MOVILID
            </div>
            <div id="represent" class="tab-pane fade show ">
                represent
            </div>
            <div id="entrances" class="tab-pane fade show ">
                <table class="table table-striped table-hover table-bordered table-responsive table-condensed mt-2">
                    <thead>
                        <tr>
                            <th>FECHA USO</th>
                            <th>FECHA PAGO</th>
                            <th>CLASE</th>
                            <th>AD</th>
                            <th>PAX</th>
                            <th><sup>$</sup>AD</th>
                            <th>TOTAL</th>
                            <th>PAGADO</th>
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
                                            <td>{{$itinerario_servicios->servicio->clase}}</td>
                                            <td>{{$cotizacion->nropersonas}}</td>
                                            <td>
                                                @foreach($cotizacion->cotizaciones_cliente->where('estado',1) as $cotizaciones_cliente)
                                                    {{$cotizaciones_cliente->cliente->nombres}} x{{$cotizacion->nropersonas}} {{fecha_peru($cotizacion->fecha)}}
                                                @endforeach
                                            </td>
                                            <td><sup>$</sup>{{$itinerario_servicios->precio}}</td>
                                            <td class="text-success"><sup>$</sup>{{number_format($itinerario_servicios->precio*$cotizacion->nropersonas,2)}}</td>
                                            <td>
                                                @if($itinerario_servicios->liquidacion==2)
                                                    <span class="badge badge-success">PAGADO</span>
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
                                                <td>{{$itinerario_servicios->servicio->clase}}</td>
                                                <td>{{$cotizacion->nropersonas}}</td>
                                                <td>
                                                    @foreach($cotizacion->cotizaciones_cliente->where('estado',1) as $cotizaciones_cliente)
                                                        {{$cotizaciones_cliente->cliente->nombres}} x{{$cotizacion->nropersonas}} {{fecha_peru($cotizacion->fecha)}}
                                                    @endforeach
                                                </td>
                                                <td><sup>$</sup>{{$itinerario_servicios->precio}}</td>
                                                <td class="text-success"><sup>$</sup>{{number_format($itinerario_servicios->precio*$cotizacion->nropersonas,2)}}</td>
                                                <td>
                                                    @if($itinerario_servicios->liquidacion==2)
                                                        <span class="badge badge-success">PAGADO</span>
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
                                                <td>{{$itinerario_servicios->servicio->clase}}</td>
                                                <td>{{$cotizacion->nropersonas}}</td>
                                                <td>
                                                    @foreach($cotizacion->cotizaciones_cliente->where('estado',1) as $cotizaciones_cliente)
                                                        {{$cotizaciones_cliente->cliente->nombres}} x{{$cotizacion->nropersonas}} {{fecha_peru($cotizacion->fecha)}}
                                                    @endforeach
                                                </td>
                                                <td><sup>$</sup>{{$itinerario_servicios->precio}}</td>
                                                <td class="text-success"><sup>$</sup>{{number_format($itinerario_servicios->precio*$cotizacion->nropersonas,2)}}</td>
                                                <td>
                                                    @if($itinerario_servicios->liquidacion==2)
                                                        <span class="badge badge-success">PAGADO</span>
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
                                                <td>{{$itinerario_servicios->servicio->clase}}</td>
                                                <td>{{$cotizacion->nropersonas}}</td>
                                                <td>
                                                    @foreach($cotizacion->cotizaciones_cliente->where('estado',1) as $cotizaciones_cliente)
                                                        {{$cotizaciones_cliente->cliente->nombres}} x{{$cotizacion->nropersonas}} {{fecha_peru($cotizacion->fecha)}}
                                                    @endforeach
                                                </td>
                                                <td><sup>$</sup>{{$itinerario_servicios->precio}}</td>
                                                <td class="text-success"><sup>$</sup>{{number_format($itinerario_servicios->precio*$cotizacion->nropersonas,2)}}</td>
                                                <td>
                                                    @if($itinerario_servicios->liquidacion==2)
                                                        <span class="badge badge-success">PAGADO</span>
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
                                                <td>{{$itinerario_servicios->servicio->clase}}</td>
                                                <td>{{$cotizacion->nropersonas}}</td>
                                                <td>
                                                    @foreach($cotizacion->cotizaciones_cliente->where('estado',1) as $cotizaciones_cliente)
                                                        {{$cotizaciones_cliente->cliente->nombres}} x{{$cotizacion->nropersonas}} {{fecha_peru($cotizacion->fecha)}}
                                                    @endforeach
                                                </td>
                                                <td><sup>$</sup>{{$itinerario_servicios->precio}}</td>
                                                <td class="text-success"><sup>$</sup>{{number_format($itinerario_servicios->precio*$cotizacion->nropersonas,2)}}</td>
                                                <td>
                                                    @if($itinerario_servicios->liquidacion==2)
                                                        <span class="badge badge-success">PAGADO</span>
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
                                                <td>{{$itinerario_servicios->servicio->clase}}</td>
                                                <td>{{$cotizacion->nropersonas}}</td>
                                                <td>
                                                    @foreach($cotizacion->cotizaciones_cliente->where('estado',1) as $cotizaciones_cliente)
                                                        {{$cotizaciones_cliente->cliente->nombres}} x{{$cotizacion->nropersonas}} {{fecha_peru($cotizacion->fecha)}}
                                                    @endforeach
                                                </td>
                                                <td><sup>$</sup>{{$itinerario_servicios->precio}}</td>
                                                <td class="text-success"><sup>$</sup>{{number_format($itinerario_servicios->precio*$cotizacion->nropersonas,2)}}</td>
                                                <td>
                                                    @if($itinerario_servicios->liquidacion==2)
                                                        <span class="badge badge-success">PAGADO</span>
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
                food
            </div>
            <div id="trains" class="tab-pane fade show ">
                trains
            </div>
            <div id="flights" class="tab-pane fade show ">
                flights
            </div>
            <div id="others" class="tab-pane fade show ">
                others
            </div>
        </div>
    </div>
</div>