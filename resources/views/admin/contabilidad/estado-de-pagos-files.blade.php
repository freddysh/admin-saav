@extends('layouts.admin.book')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white m-0">
            <li class="breadcrumb-item" aria-current="page"><a href="/">Home</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="/">Contabilidad</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="/">Estado de pagos</a></li>
            <li class="breadcrumb-item active">Detalle</li>
        </ol>
    </nav>
    <hr>
    <div class="row">
        @php
            $estrellas=2;
            $arra_prov_pagos=[];
            function fecha_peru($fecha){
                $f1=explode('-',$fecha);
                return $f1[2].'-'.$f1[1].'-'.$f1[0];
            }
        @endphp
        @if($cotizacion->star_2=='2')
            @php
                $estrellas=2;
            @endphp
        @elseif($cotizacion->star_3=='3')
            @php
                $estrellas=3;
            @endphp
        @elseif($cotizacion->star_4=='4')
            @php
                $estrellas=4;
            @endphp
        @elseif($cotizacion->star_5=='5')
            @php
                $estrellas=5;
            @endphp
        @endif
        <div class="col-12">
            @if ($cotizacion->anulado==0)
                <div class="alert alert-danger">
                    <strong>Alerta!</strong> El presente file ha sido anulado el {{MisFunciones::fecha_peru_hora($cotizacion->anulado_fecha)}} por 
                    {{$usuario->where('id',$cotizacion->anulado_user)->first()->name}}, por favor informar a los proveedores lo sucedido.
                </div>                    
            @endif
            
            <div class="panel panel-default">
                <div class="panel-body">
                    <ul class="nav nav-tabs nav-justified">
                        <li class="nav-item active">
                            <a data-toggle="tab" role="tab" aria-controls="pills-home" aria-selected="true" href="#itinerario" class="nav-link show active rounded-0">Itinerario</a>
                        </li>
                        <li class="nav-item active">
                            <a data-toggle="tab" role="tab" aria-controls="pills-home" aria-selected="true" href="#consolidado" class="nav-link show rounded-0">Consolidado</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="itinerario" class="tab-pane fade show active">
                            <div class="row">
                                <div class="col-12">
                                    <b class="text-primary">By:{{$usuario->where('id',$cotizacion->users_id)->first()->name}}</b>, 
                                    
                                    <b class="text-primary"> <i class="fas fa-calendar"></i> {{ MisFunciones::fecha_peru($cotizacion->fecha_venta)}}</b>
                                    <b class="text-20">|</b>
                                    @foreach($cotizacion->cotizaciones_cliente as $clientes)
                                        @if($clientes->estado==1)
                                            <b class="text-info text-20">Cod:{{$cotizacion->codigo}}</b><b class="text-20"> | </b><b class="panel-title pull-left text-20">{{$cotizacion->nombre_pax}} x {{$cotizacion->nropersonas}} {{date_format(date_create($cotizacion->fecha), ' l jS F Y')}}</b>
                                            <b class="text-warning padding-left-10"> (X{{$cotizacion->nropersonas}})</b>
                                            @for($i=0;$i<$cotizacion->nropersonas;$i++)
                                                <i class="fa fa-male fa-2x"></i>
                                            @endfor
                                        @endif
                                    @endforeach
                                    <i class="fa fa-check d-none text-success" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Hidalgo esta activo"></i>
                                    <b class="text-success text-20">@if($cotizacion->categorizado=='C'){{'Con factura'}}@elseif($cotizacion->categorizado=='S'){{'Sin factura'}}@else{{'No esta filtrado'}}@endif</b>
                                    
                                    <div class="dropdown pull-right d-none">
                                        <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Opciones
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                            <li><a href="#"><i class="fa fa-fw fa-database" aria-hidden="true"></i> Reservar todo</a></li>
                                            <li><a href="#"><i class="fa fa-fw fa-check" aria-hidden="true"></i> Friends</a></li>
                                            <li><a href="#">Work</a></li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="#"><i class="fa fa-fw fa-plus" aria-hidden="true"></i> Add a new aspect</a></li>
                                        </ul>
                                    </div>
                                </div>
                               
                                <div class="col-md-12 d-none">
                                    <span class="pull-left pax-nav">
                                        <b>Travel date: no se</b>
                                    </span>
                                    <span class="pull-right">
                                        <a href="#" class="btn btn-link" style="text-decoration:none;"><i class="fa fa-lg fa-ban" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Ignore"></i></a>
                                    </span>
                                </div>
                            </div>
                            <table class="table table-bordered table-sm">
                                <thead>
                                <tr>
                                    <th class="text-center">NOMBRES</th>
                                    <th class="text-center">NACIONALIDAD</th>
                                    <th class="text-center">PASAPORTE</th>
                                    <th class="text-center">GENERO</th>
                                    <th class="text-center">HOTEL</th>
                                    <th class="text-center">FECHA DE NACIMIENTO(DD-MM-AAAA)</th>
                                    <th class="text-center d-none">RESTRICCIONES</th>
                                    <th class="text-center">IDIOMA</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cotizacion->cotizaciones_cliente as $coti_cliente)
                                    @foreach($clientes1->where('id',$coti_cliente->clientes_id) as $cliente)
                                        <tr>
                                            <td>{{strtoupper($cliente->nombres)}} {{strtoupper($cliente->apellidos)}}</td>
                                            <td>{{strtoupper($cliente->nacionalidad)}}</td>
                                            <td>{{strtoupper($cliente->pasaporte)}} <span class="badge badge-g-yellow">{{MisFunciones::fecha_peru($cliente->expiracion)}}</span> </td>
                                            <td>{{strtoupper($cliente->sexo)}}</td>
                                            <td>
                                                @foreach($cotizacion->paquete_cotizaciones as $paquete)
                                                    @if($paquete->estado==2)
                                                        @if($paquete->paquete_precios->count()==0)
                                                            CTA PAXS
                                                        @else
                                                            @foreach($paquete->paquete_precios as $pqt_precio)
                                                                @if($pqt_precio->personas_s>0)
                                                                    <span class="text-warning">SINGLE</span>
                                                                @endif
                                                                @if($pqt_precio->personas_d>0)
                                                                    | <span class="text-warning">DOBLE</span>
                                                                @endif
                                                                @if($pqt_precio->personas_m>0)
                                                                    | <span class="text-warning">MATRIMONIAL</span>
                                                                @endif
                                                                @if($pqt_precio->personas_t>0)
                                                                    | <span class="text-warning">TRIPLE</span>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                {{MisFunciones::fecha_peru($cliente->fechanacimiento)}} | 
                                                {{\Carbon\Carbon::parse($cliente->fechanacimiento)->age }} años</td>
                                            <td class="d-none"><span class="text-11">{{strtoupper($cliente->restricciones)}}</span> </td>
                                            <td>{{strtoupper($cotizacion->idioma_pasajeros)}}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                                </tbody>
                            </table>
                            <table class="table table-bordered table-sm table-hover">
                                <thead>
                                <tr class="small">
                                    <th style="width:40px"></th>
                                    <th class="d-none">GROUP</th>
                                    <th style="width:250px">SERVICE</th>
                                    <th style="width:100px">DESTINATION</th>
                                    <th style="width:100px">CALCULO</th>
                                    <th style="width:80px">SALES</th>
                                    <th style="width:80px">RESERVED</th>
                                    <th style="width:150px">PROVIDER</th>
                                    <th style="width:100px">VERIFICATION CODE</th>
                                    <th style="width:80px">HOUR</th>
                                    <th style="width:80px">CONFIRMADO POR RESERVA</th>
                                    <th style="width:80px">CONFIRMADO POR CONTABILIAD</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $sumatotal_v=0;
                                    $sumatotal_v_r=0;
                                @endphp
                                @foreach($cotizacion->paquete_cotizaciones as $paquete)
                                    @if($paquete->estado==2)
                                        @foreach($paquete->itinerario_cotizaciones->sortBy('dias') as $itinerario)
                                            @php
                                                $nro_servicios=0;
                                            @endphp
                                            @foreach($itinerario->itinerario_servicios as $servicios)
                                                @if($servicios->itinerario_proveedor)
                                                    @foreach($servicios->itinerario_proveedor as $proveedor)
                                                        @php
                                                            $nro_servicios++;
                                                        @endphp
                                                    @endforeach
                                                @endif
                                            @endforeach
                                            <tr>
                                                {{--<td rowspan="{{$nro_servicios}}"><b class="text-primary">Day {{$itinerario->dias}}</b></td>--}}
                                                <td class="bg-g-dark text-white" colspan="12">
                                                    <div class="row align-items-center">
                                                        <div class="col-10">
                                                        <b class="px-2"><i class="fas fa-angle-right"></i> Day {{$itinerario->dias}}</b>
                                                        <b class="text-18 badge badge-g-yellow">{{date("d/m/Y",strtotime($itinerario->fecha))}}</b>
                                                        <b>{{$itinerario->titulo}}</b>
                                                        </div>
                                                        
                                                    </div>
                                                </td>
                                            </tr>
                                            @foreach($itinerario->itinerario_servicios->sortBy('pos') as $servicios)
                                                <tr id="servicio_{{$servicios->id}}" class="@if($servicios->anulado==1) {{'alert alert-danger'}} @endif">
                                                    <td style="width:40px"  class="text-center">
                                                        @php
                                                            $grupe='ninguno';
                                                            $destino='ninguno';
                                                            $tipoServicio='ninguno';
                                                            $clase='ninguno';
                                                        @endphp
                                                            @if($servicios->grupo)
                                                                @php
                                                                    $grupe=$servicios->grupo;
                                                                @endphp
                                                            @endif
                                                            @if($servicios->localizacion)
                                                                @php
                                                                    $destino=$servicios->localizacion;
                                                                @endphp
                                                            @endif
                                                            @if($servicios->tipoServicio)
                                                                @php
                                                                    $tipoServicio=$servicios->tipoServicio;
                                                                @endphp
                                                            @endif
                                                            @if($servicios->clase)
                                                                @php
                                                                    $clase=$servicios->clase;
                                                                @endphp
                                                            @endif
                                                            
                                                        @if($grupe=='TOURS')
                                                            <i class="fas fa-map text-info" aria-hidden="true"></i>
                                                        @endif
                                                        @if($grupe=='MOVILID')
                                                            @if($clase=='BOLETO')
                                                                <i class="fas fa-ticket-alt text-warning" aria-hidden="true"></i>
                                                            @else
                                                                <i class="fa fa-bus text-warning" aria-hidden="true"></i>
                                                            @endif
                                                        @endif
                                                        @if($grupe=='REPRESENT')
                                                            <i class="fa fa-users text-success" aria-hidden="true"></i>
                                                        @endif
                                                        @if($grupe=='ENTRANCES')
                                                            <i class="fas fa-ticket-alt text-warning" aria-hidden="true"></i>
                                                        @endif
                                                        @if($grupe=='FOOD')
                                                            <i class="fas fa-utensils text-danger" aria-hidden="true"></i>
                                                        @endif
                                                        @if($grupe=='TRAINS')
                                                            <i class="fa fa-train text-info" aria-hidden="true"></i>
                                                        @endif
                                                        @if($grupe=='FLIGHTS')
                                                            <i class="fa fa-plane text-primary" aria-hidden="true"></i>
                                                        @endif
                                                        @if($grupe=='OTHERS')
                                                            <i class="fa fa-question fa-text-success" aria-hidden="true"></i>
                                                        @endif
                                                    </td>
                                                    <td class="d-none">{{$grupe}}</td>
                                                    <td  style="width:250px"  class="lefts">
                                                        <span class="small">
                                                        <b>{{$servicios->nombre}}</b>
                                                        (<span class="small text-primary">{{$tipoServicio}}</span>)
                                                        
                                                        @if($grupe=='FLIGHTS')
                                                            <br>
                                                            <b class="text-green-goto">{{$servicios->aerolinea}}/{{$servicios->nro_vuelo}}</b>
                                                        @endif
                                                        @if($grupe=='TRAINS')
                                                            <b class="text-green-goto">[Sal: {{$servicios->salida}}-Lleg: {{$servicios->llegada}}]</b>
                                                        @endif
                                                    </span>
                                                    </td>
                                                    <td style="width:100px" ><span class="small text-success">({{$destino}})</span></td>
                                                    @php
                                                        $mate='$';
                                                        $mate_SALE='$';
                                                    @endphp
                                                    @if($servicios->precio_grupo==1)
                                                        @php
                                                            $mate.=round($servicios->precio/$cotizacion->nropersonas,2);
                                                        @endphp
                                                    @else
                                                        @php
                                                            $mate.=$servicios->precio;
                                                        @endphp
                                                    @endif
                                                    @php
                                                        $person='<b class="text-primary">'.$cotizacion->nropersonas.'<i class="fa fa-male"></i></b>';
                                                    @endphp

                                                    @php
                                                        $mate.=" x ".$person;
                                                    @endphp
                                                    @if($servicios->precio_grupo==1)
                                                        @php
                                                            $mate_SALE.=$servicios->precio;
                                                            $sumatotal_v+=$servicios->precio;
                                                            $sumatotal_v_r+=$servicios->precio_proveedor;
                                                        @endphp
                                                    @else
                                                        @php
                                                            $mate_SALE.=$servicios->precio*$cotizacion->nropersonas;
                                                            $sumatotal_v+=$servicios->precio*$cotizacion->nropersonas;
                                                            $sumatotal_v_r+=$servicios->precio_proveedor;
                                                        @endphp
                                                    @endif

                                                    <td style="width:100px"  class="rights">
                                                        @if($servicios->precio_grupo==1)
                                                            {!! $mate !!}
                                                        @elseif($servicios->precio_grupo==0)
                                                            {!! $mate !!}
                                                        @endif
                                                    </td>
                                                    <td style="width:80px"  class="rights">
                                                        {{$mate_SALE}}
                                                    </td>
                                                    <td style="width:80px"  class="rights" id="book_precio_asig_{{$servicios->id}}">
                                                        @if($servicios->precio_proveedor)
                                                            <span id="costo_servicio_{{$servicios->id}}">${{$servicios->precio_proveedor}}</span>
                                                        @endif
                                                    </td>
                                                    <td style="width:150px"  class="boton">
                                                        <b class="small" id="book_proveedor_{{$servicios->id}}">
                                                            @if($servicios->itinerario_proveedor)
                                                                {{$servicios->itinerario_proveedor->nombre_comercial}}
                                                            @endif
                                                        </b>
                                                        @php
                                                            $grupe='ninguno';
                                                            $arreglito='GROUP_SIC'
                                                        @endphp
                                                            
                                                        @if(!$servicios->itinerario_proveedor)
                                                            @php
                                                                $grupe='ninguno';
                                                                $grupe=$servicios->grupo;
                                                            @endphp
                                                            @php
                                                                $arregloo[]='GROUP';
                                                                $arregloo[]='SIC';
                                                                $arregloo[]=$servicios->tipoServicio;
                                                                $arreglito='GROUP_SIC_'.$servicios->tipoServicio;
                                                            @endphp
                                                            
                                                        @else
                                                            
                                                        @endif
                                                    </td>
                                                    <td style="width:100px"  class="boton">
                                                        @php
                                                            $codigo='primary';
                                                            $icon='save';
                                                            $codigo_h='primary';
                                                            $icon_h='save';
                                                        @endphp
                                                        @if($servicios->codigo_verificacion!='')
                                                            @php
                                                                $codigo='warning';
                                                                $icon='edit';
                                                            @endphp
                                                        @endif
                                                        @if($servicios->hora_llegada!='')
                                                            @php
                                                                $codigo_h='warning';
                                                                $icon_h='edit';
                                                            @endphp
                                                        @endif
                                                        @php
                                                            $mostrar='';
                                                        @endphp
                                                        <b>{{$servicios->codigo_verificacion}}</b>
                                                    </td>
                                                    <td style="width:80px"  class="boton">
                                                        <b>{{$servicios->hora_llegada}}</b>
                                                    </td>
                                                    <td class="d-none">
                                                        @php
                                                            $esServ='false';
                                                        @endphp
                                                        {{-- @foreach($m_servicios->where('id',$servicios->m_servicios_id) as $serv) --}}
                                                            
                                                        @if($servicios->grupo=='TOURS')
                                                            @php
                                                                $esServ='true';
                                                            @endphp
                                                        @elseif($servicios->grupo=='REPRESENT')
                                                            @if($servicios->tipoServicio=='TRANSFER')

                                                                @php
                                                                    $esServ='true';
                                                                @endphp
                                                            @endif
                                                        @endif

                                                        {{-- @endforeach --}}
                                                        @if($esServ=='true')
                                                            @if($servicios->s_p=='PC')
                                                                <a class="btn btn-success" href="{{route('sp_path',[$cotizacion->id,$servicios->id,'SIC'])}}">PC</a>
                                                            @elseif($servicios->s_p=='SIC')
                                                                <a class="btn btn-primary" href="{{route('sp_path',[$cotizacion->id,$servicios->id,'PC'])}}">SIC</a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td class="boton d-none" id="estado_proveedor_serv_{{$servicios->id}}">
                                                        @if($servicios->itinerario_proveedor)
                                                            <i class="fa fa-check  text-success"></i>
                                                        @else
                                                            <i class="fas fa-clock text-unset"></i>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @php
                                                            $localizacion='';
                                                            $grupo='';
                                                            $localizacion=$servicios->localizacion;
                                                            $grupo=$servicios->grupo;
                                                        @endphp
                                                        {{-- @endforeach --}}
                                                        <div class="btn-group">
                                                            <button id="confim_{{$servicios->id}}" type="button" class="btn btn-sm" >
                                                                @if($servicios->primera_confirmada==0)
                                                                    <i class="fas fa-unlock"></i>
                                                                @elseif($servicios->primera_confirmada==1)
                                                                    <i class="fas fa-lock text-success"></i>
                                                                @endif
                                                            </button>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm">
                                                            @if($servicios->precio_confirmado_contabilidad=='1')
                                                                <i class="fas fa-lock text-success"></i>
                                                            @else
                                                                <i class="fas fa-unlock"></i>
                                                            @endif
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @php
                                                $titulo_hotel_='';
                                                $titulo_hotel='';
                                            @endphp
                                            @foreach($itinerario->hotel as $hotel)
                                                <tr id="hotel_{{$hotel->id}}">
                                                    <td style="width:40px"  class="text-center">
                                                        <b>{{$hotel->estrellas}} <i class="fa fa-star text-warning" aria-hidden="true"></i></b>
                                                        @php
                                                            $titulo_hotel_='<p><b>Categoria:'.$hotel->estrellas.' <i class="fa fa-star text-warning" aria-hidden="true"></i></b></p>';
                                                        @endphp
                                                    </td>
                                                    <td  style="width:250px" >
                                                        @php
                                                            $total=0;
                                                            $total_book=0;
                                                            $cadena_total='';
                                                            $cadena_total_book='';
                                                        $cadena_total_coti='';
                                                        @endphp
                                                        @if($hotel->personas_s>0)
                                                            @php
                                                                $total+=$hotel->personas_s*$hotel->precio_s;
                                                                $total_book+=$hotel->personas_s*$hotel->precio_s_r;
                                                                $cadena_total.="<span>$".$hotel->precio_s." x ".$hotel->personas_s."</span><br>";
                                                                $cadena_total_coti.="<span>$".$hotel->personas_s*$hotel->precio_s."</span><br>";
                                                                if($hotel->precio_s_r){
                                                                    $cadena_total_book.="<span>$".$hotel->personas_s*$hotel->precio_s_r."</span><br>";
                                                                }
                                                                $sumatotal_v+=$hotel->personas_s*$hotel->precio_s;

                                                            @endphp
                                                            <span class="margin-bottom-5"><b>{{$hotel->personas_s}}</b> <span class="stick"><i class="fa fa-bed" aria-hidden="true"></i></span></span>(<span class="small text-primary">HOTEL</span>)
                                                            <br>
                                                            @php
                                                                $titulo_hotel.='<tr><td>'.$hotel->personas_s.'</td><td><span class="stick"><i class="fa fa-bed" aria-hidden="true"></i></span></span></td><td><span>$'.$hotel->precio_s.' x '.$hotel->personas_s.'</span></td><td><span>$'.$hotel->personas_s*$hotel->precio_s.'</span></td></tr>';
                                                            @endphp
                                                        @endif
                                                        @if($hotel->personas_d>0)
                                                            @php
                                                                $total+=$hotel->personas_d*$hotel->precio_d;
                                                                $total_book+=$hotel->personas_d*$hotel->precio_d_r;
                                                                $cadena_total.="<span>$".$hotel->precio_d." x ".$hotel->personas_d." </span><br>";
                                                                $cadena_total_coti.="<span>$".($hotel->personas_d*$hotel->precio_d)."</span><br>";
                                                                if($hotel->precio_d_r){
                                                                $cadena_total_book.="<span>$".($hotel->personas_d*$hotel->precio_d_r)."</span><br>";
                                                                }
                                                                $sumatotal_v+=$hotel->personas_d*$hotel->precio_d;

                                                            @endphp
                                                            <span class="margin-bottom-5"><b>{{$hotel->personas_d}}</b> <span class="stick"><i class="fa fa-bed" aria-hidden="true"></i> <i class="fa fa-bed" aria-hidden="true"></i></span></span>(<span class="small text-primary">HOTEL</span>)
                                                            <br>
                                                            @php
                                                                $titulo_hotel.='<tr><td>'.$hotel->personas_d.'</td><td><span class="stick"><i class="fa fa-bed" aria-hidden="true"></i><i class="fa fa-bed" aria-hidden="true"></i></span></span></td><td><span>$'.$hotel->precio_d.' x '.$hotel->personas_d.'</span></td><td><span>$'.$hotel->personas_d*$hotel->precio_d.'</span></td></tr>';
                                                            @endphp
                                                        @endif
                                                        @if($hotel->personas_m>0)
                                                            @php
                                                                $total+=$hotel->personas_m*$hotel->precio_m;
                                                                $total_book+=$hotel->personas_m*$hotel->precio_m_r;
                                                                $cadena_total.="<p>$".$hotel->precio_m." x ".($hotel->personas_m)."</p><br>";
                                                                $cadena_total_coti.="<p>$".$hotel->personas_m." x ".($hotel->precio_m)." </p><br>";
                                                                if($hotel->precio_m_r){
                                                                    $cadena_total_book.="<p>$".$hotel->personas_m." x ".($hotel->precio_m_r)." </p><br>";
                                                                }
                                                                $sumatotal_v+=$hotel->personas_m*$hotel->precio_m;

                                                            @endphp
                                                            <span class="margin-bottom-5"><b>{{$hotel->personas_m}}</b> <span class="stick"><i class="fa fa-venus-mars" aria-hidden="true"></i></span></span>(<span class="small text-primary">HOTEL</span>)
                                                            <br>
                                                            @php
                                                                $titulo_hotel.='<tr><td>'.$hotel->personas_m.'</td><td><span class="stick"><i class="fa fa-venus-mars" aria-hidden="true"></i></span></span></td><td><span>$'.$hotel->precio_m.' x '.$hotel->personas_m.'</span></td><td><span>$'.$hotel->personas_m*$hotel->precio_m.'</span></td></tr>';
                                                            @endphp
                                                        @endif
                                                        @if($hotel->personas_t>0)
                                                            @php
                                                                $total+=$hotel->personas_t*$hotel->precio_t;
                                                                $total_book+=$hotel->personas_t*$hotel->precio_t_r;
                                                                $cadena_total.="<span>$".$hotel->precio_t." x ".($hotel->personas_t)."</span><br>";
                                                                $cadena_total_coti.="<span>$".$hotel->personas_t." x ".($hotel->precio_t)."</span><br>";
                                                                if($hotel->precio_t_r){
                                                                    $cadena_total_book.="<span>$".$hotel->personas_t." x ".($hotel->precio_t_r)."</span><br>";
                                                                }
                                                                $sumatotal_v+=$hotel->personas_t*$hotel->precio_t;

                                                            @endphp
                                                            <span class="margin-bottom-5"><b>{{$hotel->personas_t}}</b> <span class="stick"><i class="fa fa-bed" aria-hidden="true"></i> <i class="fa fa-bed" aria-hidden="true"></i> <i class="fa fa-bed" aria-hidden="true"></i></span></span>(<span class="small text-primary">HOTEL</span>)
                                                            @php
                                                                $titulo_hotel.='<tr><td>'.$hotel->personas_t.'</td><td><span class="stick"><i class="fa fa-bed" aria-hidden="true"></i> <i class="fa fa-bed" aria-hidden="true"></i> <i class="fa fa-bed" aria-hidden="true"></i></span></span></td><td><span>$'.$hotel->precio_t.' x '.$hotel->personas_t.'</span></td><td><span>$'.$hotel->personas_t*$hotel->precio_t.'</span></td></tr>';
                                                            @endphp
                                                        @endif
                                                    </td>
                                                    <td style="width:100px" >
                                                        <span class="small text-success">({{$hotel->localizacion}})</span>
                                                    </td>
                                                    <td style="width:100px"  class="rights">
                                                        {!! $cadena_total !!}

                                                        <p class="d-none"><i class="fa fa-users" aria-hidden="true"></i> {{$total}}
                                                            <a id="hpropover_{{$hotel->id}}" data-toggle="popover" title="Detalle" data-content="{{$cadena_total}}"> <i class="fa fa-calculator text-primary" aria-hidden="true"></i></a>
                                                        </p>
                                                    </td>
                                                    <td style="width:80px"  class="rights">
                                                        {!! $cadena_total_coti !!}
                                                    </td>
                                                    
                                                    @php
                                                        $sumatotal_v_r+=$total_book
                                                    @endphp
                                                    <td style="width:80px"  id="book_precio_asig_hotel_{{$hotel->id}}"  class="rights">
                                                        @if($hotel->personas_s>0)
                                                            @if($hotel->precio_s_r>0)
                                                                <span id="book_price_edit_h_s_{{$hotel->id}}">${{$hotel->precio_s_r}}</span><br>
                                                            @endif
                                                        @endif
                                                        @if($hotel->personas_d>0)
                                                            @if($hotel->precio_d_r>0)
                                                                <span id="book_price_edit_h_d_{{$hotel->id}}">${{$hotel->precio_d_r}}</span><br>
                                                            @endif
                                                        @endif
                                                        @if($hotel->personas_m>0)
                                                            @if($hotel->precio_m_r>0)
                                                                <span id="book_price_edit_h_m_{{$hotel->id}}">${{$hotel->precio_m_r}}</span><br>
                                                            @endif
                                                        @endif
                                                        @if($hotel->personas_t>0)
                                                            @if($hotel->precio_t_r>0)
                                                                <span id="book_price_edit_h_t_{{$hotel->id}}">${{$hotel->precio_t_r}}</span><br>
                                                            @endif
                                                        @endif

                                                        {{--{!! $cadena_total_book !!}--}}
                                                        @if($hotel->proveedor)
                                                            
                                                        @endif
                                                        <p class="d-none"> {{$total_book}}
                                                            <a id="h_rpropover_{{$hotel->id}}" data-toggle="popover" title="Detalle" data-content="{{$cadena_total_book}}"> <i class="fa fa-calculator text-primary" aria-hidden="true"></i></a>
                                                        </p>
                                                    </td>
                                                    <td style="width:150px"  class="boton">
                                                        <b class="small" id="book_proveedor_hotel_{{$hotel->id}}">
                                                            @if($hotel->proveedor)
                                                                {{$hotel->proveedor->nombre_comercial}}
                                                            @endif
                                                        </b>
                                                    
                                                    </td>
                                                    <td style="width:100px"  class="boton">
                                                        @php
                                                            $codigo_ho='primary';
                                                            $icon_ho='save';
                                                            $codigo_hora='primary';
                                                            $icon_hora='save';
                                                        @endphp
                                                        @if($hotel->codigo_verificacion!='')
                                                            @php
                                                                $codigo_ho='warning';
                                                                $icon_ho='edit';
                                                            @endphp
                                                        @endif
                                                        @if($hotel->hora_llegada!='')
                                                            @php
                                                                $codigo_hora='warning';
                                                                $icon_hora='edit';
                                                            @endphp
                                                        @endif
                                                       <div class="col-lg-12">
                                                            <b>{{$hotel->codigo_verificacion}}</b>
                                                        </div>              
                                                    </td>
                                                    <td style="width:80px"  class="boton">
                                                    <b>{{$hotel->hora_llegada}}</b>
                                                    </td>
                                                    <td class="boton d-none" id="estado_proveedor_serv_hotel_{{$hotel->id}}">
                                                        @if($hotel->proveedor)
                                                            <i class="fa fa-check fa-2x text-success"></i>
                                                        @else
                                                            <i class="fas fa-clock fa-2x text-unset"></i>
                                                        @endif
                                                    </td>
                                                    <td class="boton text-center">
                                                        <button id="confim_h_{{$hotel->id}}" type="button" class="btn btn-sm">
                                                            @if($hotel->primera_confirmada==0)
                                                                <i class="fas fa-unlock"></i>
                                                            @elseif($hotel->primera_confirmada==1)
                                                                <i class="fas fa-lock text-success"></i>
                                                            @endif
                                                        </button>
                                                        
                                                    </td>
                                                    <td>
                                                        <button id="confim_h_{{$hotel->id}}" type="button" class="btn btn-sm">
                                                        @if($hotel->precio_confirmado_contabilidad=='1')
                                                            <i class="fas fa-lock text-success"></i>
                                                        @else
                                                            <i class="fas fa-unlock"></i>
                                                        @endif
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    @endif
                                @endforeach
                                </tbody>
                                <tbody>
                                <tr>
                                    <td colspan="4"><b>Total</b></td>
                                    <td class="text-right h5 text-g-yellow"><b><sup>$</sup>{{$sumatotal_v}}</b></td>
                                    <td class="text-right h5 text-info"><b><sup>$</sup>{{$sumatotal_v_r}}</b></td>
                                </tr>
                                </tbody>
                            </table>
                            <form class="d-none" id="form_guardar_reserva" action="{{route('confirmar_reserva_path')}}" method="post">
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        <input type="hidden" name="cotizacion_id" value="{{$cotizacion->id}}">
                                        {{csrf_field()}}
                                        <button type="submit" class="btn btn-lg btn-success">Enviar a contabilidad
                                            <i class="far fa-thumbs-up" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="consolidado" class="tab-pane fade show ">
                            <div class="row">
                                <div class="col-12">
                                    <b class="text-primary">By:{{$usuario->where('id',$cotizacion->users_id)->first()->name}}</b>, 
                                    
                                    <b class="text-primary"> <i class="fas fa-calendar"></i> {{ MisFunciones::fecha_peru($cotizacion->fecha_venta)}}</b>
                                    <b class="text-20">|</b>
                                    @foreach($cotizacion->cotizaciones_cliente as $clientes)
                                        @if($clientes->estado==1)
                                            {{--<h1 class="panel-title pull-left" style="font-size:30px;">Hidalgo <small>hidlgo@gmail.com</small></h1>--}}
                                            <b class="text-info text-20">Cod:{{$cotizacion->codigo}}</b><b class="text-20"> | </b><b class="panel-title pull-left text-20">{{$cotizacion->nombre_pax}} x {{$cotizacion->nropersonas}} {{date_format(date_create($cotizacion->fecha), ' l jS F Y')}}</b>
                                            <b class="text-warning padding-left-10"> (X{{$cotizacion->nropersonas}})</b>
                                            @for($i=0;$i<$cotizacion->nropersonas;$i++)
                                                <i class="fa fa-male fa-2x"></i>
                                            @endfor
                                        @endif
                                    @endforeach
                                    <i class="fa fa-check d-none text-success" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Hidalgo esta activo"></i>
                                    <b class="text-success text-20">@if($cotizacion->categorizado=='C'){{'Con factura'}}@elseif($cotizacion->categorizado=='S'){{'Sin factura'}}@else{{'No esta filtrado'}}@endif</b>
                                    
                                    <div class="dropdown pull-right d-none">
                                        <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Opciones
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                            <li><a href="#"><i class="fa fa-fw fa-database" aria-hidden="true"></i> Reservar todo</a></li>
                                            <li><a href="#"><i class="fa fa-fw fa-check" aria-hidden="true"></i> Friends</a></li>
                                            <li><a href="#">Work</a></li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="#"><i class="fa fa-fw fa-plus" aria-hidden="true"></i> Add a new aspect</a></li>
                                        </ul>
                                    </div>
                                </div>
                               
                                <div class="col-md-12 d-none">
                                    <span class="pull-left pax-nav">
                                        <b>Travel date: no se</b>
                                    </span>
                                    <span class="pull-right">
                                        <a href="#" class="btn btn-link" style="text-decoration:none;"><i class="fa fa-lg fa-ban" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Ignore"></i></a>
                                    </span>
                                </div>
                            </div>
                            <table class="table table-bordered table-sm">
                                <thead>
                                <tr>
                                    <th class="text-center">NOMBRES</th>
                                    <th class="text-center">NACIONALIDAD</th>
                                    <th class="text-center">PASAPORTE</th>
                                    <th class="text-center">GENERO</th>
                                    <th class="text-center">HOTEL</th>
                                    <th class="text-center">EDAD</th>
                                    <th class="text-center">RESTRICCIONES</th>
                                    <th class="text-center">IDIOMA</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cotizacion->cotizaciones_cliente as $coti_cliente)
                                    @foreach($clientes1->where('id',$coti_cliente->clientes_id) as $cliente)
                                        <tr>
                                            <td>{{strtoupper($cliente->nombres)}} {{strtoupper($cliente->apellidos)}}</td>
                                            <td>{{strtoupper($cliente->nacionalidad)}}</td>
                                            <td>{{strtoupper($cliente->pasaporte)}} <span class="badge badge-g-yellow">{{MisFunciones::fecha_peru($cliente->expiracion)}}</span> </td>
                                            <td>{{strtoupper($cliente->sexo)}}</td>
                                            <td>
                                                @foreach($cotizacion->paquete_cotizaciones as $paquete)
                                                    @if($paquete->estado==2)
                                                        @if($paquete->paquete_precios->count()==0)
                                                            CTA PAXS
                                                        @else
                                                            @foreach($paquete->paquete_precios as $pqt_precio)
                                                                @if($pqt_precio->personas_s>0)
                                                                    <span class="text-warning">SINGLE</span>
                                                                @endif
                                                                @if($pqt_precio->personas_d>0)
                                                                    | <span class="text-warning">DOBLE</span>
                                                                @endif
                                                                @if($pqt_precio->personas_m>0)
                                                                    | <span class="text-warning">MATRIMONIAL</span>
                                                                @endif
                                                                @if($pqt_precio->personas_t>0)
                                                                    | <span class="text-warning">TRIPLE</span>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{\Carbon\Carbon::parse($cliente->fechanacimiento)->age }} años</td>
                                            <td><span class="text-11">{{strtoupper($cliente->restricciones)}}</span> </td>
                                            <td>{{strtoupper($cotizacion->idioma_pasajeros)}}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-12">
                                <table class="table table-condensed table-bordered  table-hover table-sm text-12">
                                                <thead>
                                                <tr>
                                                    <th class="text-grey-goto text-center">Nro</th>
                                                    <th class="text-grey-goto text-center"style="width:150px">Servicio</th>
                                                    <th class="text-grey-goto text-center">Proveedor</th>
                                                    <th class="text-grey-goto text-center" style="width:100px">Fecha de Servicio</th>
                                                    <th class="text-grey-goto text-center" style="width:100px">Fecha a Pagar</th>
                                                    <th class="text-grey-goto text-center">Total Venta</th>
                                                    <th class="text-grey-goto text-center">Total Reserva</th>
                                                    <th class="text-grey-goto text-center">Total Conta</th>
                                                    <th class="text-grey-goto text-center d-none">Saldo</th>
                                                    <th class="text-grey-goto text-center">Ope</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="bg-g-dark text-white">
                                                    <td colspan="11">
                                                    <b> HOTELES</b>
                                                        <div class="form-check d-none">
                                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="HOTELS" onclick="marcar_checked('HOTELS')">
                                                            <label class="form-check-label" for="exampleCheck1"><b> HOTELES</b></label>
                                                        </div>
                                                    </td>
                                                    </tr>
                                                    @foreach($array_pagos_pendientes as $key => $array_pagos_pendiente)
                                                        <tr>
                                                            <td class="text-grey-goto text-center">{{$array_pagos_pendiente['nro']}}<b><i class="fas fa-user text-primary"></i></b></td>
                                                            <td class="text-grey-goto text-left">{!!$array_pagos_pendiente['titulo']!!}</td>
                                                            <td class="text-grey-goto text-left">{{$array_pagos_pendiente['proveedor']}}</td>
                                                            <td class="text-grey-goto text-center"><i class="fas fa-calendar"></i> {{MisFunciones::fecha_peru($array_pagos_pendiente['fecha_servicio'])}}</td>
                                                            <td class="text-grey-goto text-center"><i class="fas fa-calendar"></i> {{MisFunciones::fecha_peru($array_pagos_pendiente['fecha_pago'])}}</td>
                                                            <td class="text-grey-goto text-right"><b><sup>$</sup> {{$array_pagos_pendiente['monto_v']}}</b></td>
                                                            <td class="text-grey-goto text-right"><b><sup>$</sup> {{$array_pagos_pendiente['monto_r']}}</b></td>
                                                            <td class="text-grey-goto text-right"><b><sup>$</sup> <span id="monto_{{$array_pagos_pendiente['grupo']}}_c_{{$key}}">{{$array_pagos_pendiente['monto_c']}}</span></b></td>
                                                            <td class="text-grey-goto text-right">{{$array_pagos_pendiente['saldo']}}</td>
                                                            <td class="text-grey-goto text-right">
                                                                <!-- Button trigger modal -->
                                                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_{{$key}}" onclick="traer_datos('{{$key}}','{{$array_pagos_pendiente['grupo']}}','{{$array_pagos_pendiente['clase']}}','{{$array_pagos_pendiente['items']}}','{{$array_pagos_pendiente['nro']}}','2')">
                                                                            <i class="fas fa-edit"></i>
                                                                </button>    
                                                                <div class="modal fade" id="modal_{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">  
                                                                        <form id="form_{{$array_pagos_pendiente['grupo']}}_{{$key}}" action="{{route('contabilidad.hotel.store')}}" method="POST" >   
                                                                            <div class="modal-content  modal-lg">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Editar Costos</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="row">
                                                                                    <div id="{{$array_pagos_pendiente['grupo']}}_{{$array_pagos_pendiente['clase']}}_datos_{{$key}}" class="col">
        
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer d-none">
                                                                                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                                                                                    <button type="button" class="btn btn-primary d-none">Save changes</button>
                                                                                </div>
                                                                            </div>   
                                                                        </form>                                                                   
                                                                    </div>
                                                                </div>
                                                                    
                                                                    {{-- <!-- Modal -->
                                                                <button type="button" class="btn btn-primary btn-sm d-none" data-toggle="modal" data-target="#modal_{{$array_pagos_pendiente['grupo']}}_{{$array_pagos_pendiente['clase']}}_nota_{{$key}}">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>    
                                                                <!-- Modal -->
                                                                <div class="modal fade" id="modal_{{$array_pagos_pendiente['grupo']}}_{{$array_pagos_pendiente['clase']}}_nota_{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">  
                                                                    <form id="form_{{$key}}" action="{{route('contabilidad.hotel.store')}}" method="POST" >   
                                                                        <div class="modal-content  modal-lg">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalCenterTitle">Editar Costos</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body text-left">
                                                                                <div class="row">
                                                                                    <div id="datos_nota_{{$key}}" class="col">
                                                                                        <div class="form-control">
                                                                                            <label for="nota_{{$key}}">Nota</label>
                                                                                            <textarea class="form-control" name="nota" id="nota_{{$key}}" cols="30" rows="10"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                                                                                <button type="button" class="btn btn-primary d-none">Save changes</button>
                                                                            </div>
                                                                        </div>   
                                                                    </form>                                                                   
                                                                </div>
                                                            </div> --}}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    {{-- servicios tours --}}
                                                    @php
                                                        $arreglo_servicios=array('0'=>'TOURS','1'=>'MOVILID','2'=>'REPRESENT','3'=>'ENTRANCES','4'=>'FOOD','5'=>'TRAINS','6'=>'FLIGHTS','7'=>'OTHERS');
                                                    @endphp
                                                    @foreach ($arreglo_servicios as $arreglo_servicio_)      
                                                        <tr class="bg-g-dark text-white"><td colspan="11"><b>{{$arreglo_servicio_}}</b></td></tr>
                                                        @foreach($array_pagos_pendientes_tours as $key => $array_pagos_pendiente)
                                                            @if($array_pagos_pendiente['grupo']==$arreglo_servicio_)
                                                            <tr>
                                                                <td class="text-grey-goto text-center">{{$array_pagos_pendiente['nro']}}<b><i class="fas fa-user text-primary"></i></b></td>
                                                                <td class="text-grey-goto text-left">{!!$array_pagos_pendiente['titulo']!!}</td>
                                                                <td class="text-grey-goto text-left">{{$array_pagos_pendiente['proveedor']}}</td>
                                                                <td class="text-grey-goto text-center"><i class="fas fa-calendar"></i> {{MisFunciones::fecha_peru($array_pagos_pendiente['fecha_servicio'])}}</td>
                                                                <td class="text-grey-goto text-center"><i class="fas fa-calendar"></i> {{MisFunciones::fecha_peru($array_pagos_pendiente['fecha_pago'])}}</td>
                                                                <td class="text-grey-goto text-right"><b><sup>$</sup> {{$array_pagos_pendiente['monto_v']}}</b></td>
                                                                <td class="text-grey-goto text-right"><b><sup>$</sup> {{$array_pagos_pendiente['monto_r']}}</b></td>
                                                                <td class="text-grey-goto text-right"><b><sup>$</sup> <span id="monto_{{$array_pagos_pendiente['grupo']}}_c_{{$key}}">{{$array_pagos_pendiente['monto_c']}}</span></b></td>
                                                                <td class="text-grey-goto text-right">{{$array_pagos_pendiente['saldo']}}</td>
                                                                <td class="text-grey-goto text-right">
                                                                    <!-- Button trigger modal -->
                                                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_{{$key}}" onclick="traer_datos('{{$key}}','{{$array_pagos_pendiente['grupo']}}','{{$array_pagos_pendiente['clase']}}','{{$array_pagos_pendiente['items']}}','{{$array_pagos_pendiente['nro']}}','2')">
                                                                                <i class="fas fa-edit"></i>
                                                                    </button>    
                                                                        <!-- Modal -->
                                                                    <div class="modal fade" id="modal_{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">  
                                                                            <form id="form_{{$array_pagos_pendiente['grupo']}}_{{$key}}" action="{{route('contabilidad.hotel.store')}}" method="POST">
                                                                                <div class="modal-content  modal-lg">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Editar Costos</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <div class="row">
                                                                                        <div id="{{$array_pagos_pendiente['grupo']}}_{{$array_pagos_pendiente['clase']}}_datos_{{$key}}" class="col">
            
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer d-none">
                                                                                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                                                                                        <button type="button" class="btn btn-primary d-none">Save changes</button>
                                                                                    </div>
                                                                                </div>   
                                                                            </form>                                                                   
                                                                        </div>
                                                                    </div>                                                                
                                                                </td>
                                                            </tr>
                                                            @endif
                                                        @endforeach
                                                    @endforeach                                                    
                                                </tbody>
                                            </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
@stop
