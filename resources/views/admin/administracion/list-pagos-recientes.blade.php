@php
    use App\Helpers\MisFunciones;
    $dato_cliente='';
    $tiempo_dias=5;
    $color='bg-danger-goto';

    function fecha_peru($fecha){
        $fecha=explode('-',$fecha);
        return $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
    }
@endphp

    <div class="card border-secondary">
        <div class="card-header">
            <b class="text-primary"><i class="fas fa-globe"></i></b>
            <b class="text-dark">{{strtoupper($web)}}</b> | 
            <b class="text-primary"><i class="fas fa-filter"></i></b>
            <b class="text-dark">{{$filtro}}</b> [
            <b class="text-dark">{{MisFunciones::fecha_peru($f1)}}</b> - 
            <b class="text-dark">{{MisFunciones::fecha_peru($f2)}}</b>] | 
            <b class="text-primary"><i class="fas fa-search"></i></b>
            <b class="text-dark">{{$opcion}}</b>
        </div>
        <div class="card-body  text-secondary">
            <table id="example_tabla" class="table table-bordered table-striped table-responsive table-hover text-11 table-sm">
                <thead>
                    <tr>
                        <th>FILE</th>
                        <th>WEB</th>
                        <th>PRECIO VENTA</th>
                        <th>COSTO RESERVAS</th>
                        <th>COSTO CONTABILIDAD</th>
                        <th>PROFIT(VENTA-CONTABILIDAD)</th>
                        <th class=" d-none">PROX. PAGO</th>
                        <th class=" d-none">PROCESADO</th>
                        <th class=" d-none">MONTO</th>
                        {{-- <th>ESTADO</th> --}}
                        <th colspan="1" class="text-center">DETALLE</th>
                        <th>VENDEDOR</th>
                    </tr>    
                </thead>
                <tbody>
                @php
                    $nro_cotizaciones=0;
                    $total_pagados=0;
                    $total_procesados=0;
                    $total_cerrados=0;
                    $total_pendientes=0;
                    $total_pendiente=0;
                    $total_pagado_=0;

                    $total_venta=0;
                    $total_reserva=0;
                    $total_contabilidad=0;
                    
                @endphp
                @foreach($cotizaciones as $cotizacion_cat_)
                    @php
                        $s=0;
                        $d=0;
                        $m=0;
                        $t=0;
                        $nroPersonas=0;
                        $nro_dias=$cotizacion_cat_->duracion;
                        $precio_iti=0;
                        $precio_hotel_s=0;
                        $precio_hotel_d=0;
                        $precio_hotel_m=0;
                        $precio_hotel_t=0;
                        $cotizacion_id='';
                        $utilidad_s=0;
                        $utilidad_por_s=0;
                        $utilidad_d=0;
                        $utilidad_por_d=0;
                        $utilidad_m=0;
                        $utilidad_por_m=0;
                        $utilidad_t=0;
                        $utilidad_por_t=0;
                        $precio_venta_total=0;
                        $precio_reserva_total=0;
                        $precio_contabilidad_total=0;
                        
                    @endphp

                    @foreach($cotizacion_cat_->paquete_cotizaciones->take(1) as $paquete)
                        @foreach($paquete->paquete_precios as $precio)
                            @if($precio->personas_s>0)
                                @php
                                    $s=1;
                                    $utilidad_s=($precio->utilidad_s);
                                    $utilidad_por_s=$precio->utilidad_por_s;
                                @endphp
                            @endif
                            @if($precio->personas_d>0)
                                @php
                                    $d=1;
                                    $utilidad_d=($precio->utilidad_d);
                                    $utilidad_por_d=$precio->utilidad_por_d;
                                @endphp
                            @endif
                            @if($precio->personas_m>0)
                                @php
                                    $m=1;
                                    $utilidad_m=($precio->utilidad_m);
                                    $utilidad_por_m=$precio->utilidad_por_m;
                                @endphp
                            @endif
                            @if($precio->personas_t>0)
                                @php
                                    $t=1;
                                    $utilidad_t=($precio->utilidad_t);
                                    $utilidad_por_t=$precio->utilidad_por_t;
                                @endphp
                            @endif
                        @endforeach
                        @foreach($paquete->itinerario_cotizaciones as $itinerario)
                            @php
                                $rango='';
                            @endphp
                            @foreach($itinerario->itinerario_servicios as $servicios)
                                @php
                                    $preciom=0;
                                @endphp
                                @if($servicios->min_personas<= $cotizacion_cat_->nropersonas&&$cotizacion_cat_->nropersonas <=$servicios->max_personas)
                                @else
                                    @php
                                        $rango=' ';
                                    @endphp
                                @endif
                                @if($servicios->precio_grupo==1)
                                    @php
                                        $precio_iti+=round($servicios->precio/$cotizacion_cat_->nropersonas,2);
                                        $preciom=round($servicios->precio/$cotizacion_cat_->nropersonas,2);
                                        $precio_venta_total+=$servicios->precio;
                                    @endphp
                                @else
                                    @php
                                        $precio_iti+=round($servicios->precio,2);
                                        $preciom=round($servicios->precio,2);
                                        $precio_venta_total+=$cotizacion_cat_->nropersonas*$servicios->precio;
                                    @endphp
                                @endif
                                @php
                                    $precio_reserva_total+=$servicios->precio_proveedor;
                                    $precio_contabilidad_total+=$servicios->precio_c;
                                @endphp
                            @endforeach
                            @foreach($itinerario->hotel as $hotel)
                                @if($hotel->personas_s>0)
                                    @php
                                        $precio_hotel_s+=$hotel->precio_s;
                                        $precio_venta_total+=$hotel->personas_s*$hotel->precio_s;
                                        $precio_reserva_total+=$hotel->personas_s*$hotel->precio_s_r;
                                        $precio_contabilidad_total+=$hotel->personas_s*$hotel->precio_s_c;
                                    @endphp
                                @endif
                                @if($hotel->personas_d>0)
                                    @php
                                        $precio_hotel_d+=$hotel->precio_d/2;
                                        $precio_venta_total+=$hotel->personas_d*$hotel->precio_d;    $precio_reserva_total+=$hotel->personas_d*$hotel->precio_d_r;
                                        $precio_contabilidad_total+=$hotel->personas_d*$hotel->precio_d_c;
                                    
                                    @endphp
                                @endif
                                @if($hotel->personas_m>0)
                                    @php
                                        $precio_hotel_m+=$hotel->precio_m/2;
                                        $precio_venta_total+=$hotel->personas_m*$hotel->precio_m;
                                        $precio_reserva_total+=$hotel->personas_m*$hotel->precio_m_r;
                                        $precio_contabilidad_total+=$hotel->personas_m*$hotel->precio_m_c;
                                    @endphp
                                @endif
                                @if($hotel->personas_t>0)
                                    @php
                                        $precio_hotel_t+=$hotel->precio_t/3;
                                        $precio_venta_total+=$hotel->personas_t*$hotel->precio_t;    $precio_reserva_total+=$hotel->personas_t*$hotel->precio_t_r;
                                        $precio_contabilidad_total+=$hotel->personas_t*$hotel->precio_t_c;
                                    @endphp
                                @endif
                            @endforeach
                        @endforeach
                    @endforeach
                    @php
                        $precio_hotel_s+=$precio_iti;
                        $precio_hotel_d+=$precio_iti;
                        $precio_hotel_m+=$precio_iti;
                        $precio_hotel_t+=$precio_iti;
                    @endphp
                    @php
                        $valor=0;
                    @endphp
                    @if($nro_dias==1)
                        @foreach($cotizacion_cat_->paquete_cotizaciones->take(1) as $paquete)
                            @php
                                $valor=$precio_iti+$paquete->utilidad;
                                $precio_venta_total+=$cotizacion_cat_->nropersonas*$paquete->utilidad;
                            @endphp
                        @endforeach
                    @elseif($nro_dias>1)
                        @if(($s+$d+$m+$t)==0)
                            @foreach($cotizacion_cat_->paquete_cotizaciones->take(1) as $paquete)
                                @php
                                    $valor=$precio_iti+$paquete->utilidad;
                                    $precio_venta_total+=$cotizacion_cat_->nropersonas*$paquete->utilidad;
                                @endphp
                            @endforeach
                        @else
                            @if($s!=0)
                                @php
                                    $valor+=round($precio_hotel_s+$utilidad_s,2);
                                @endphp
                                @foreach($cotizacion_cat_->paquete_cotizaciones->take(1) as $paquete)
                                    @foreach($paquete->paquete_precios as $precio)
                                        @php    
                                            $precio_venta_total+=$precio->personas_s*$precio->utilidad_s;
                                        @endphp
                                    @endforeach
                                @endforeach
                            @endif
                            @if($d!=0)
                                @php
                                    $valor+=round($precio_hotel_d+$utilidad_d,2);
                                @endphp
                                @foreach($cotizacion_cat_->paquete_cotizaciones->take(1) as $paquete)
                                    @foreach($paquete->paquete_precios as $precio)
                                        @php
                                            $precio_venta_total+=$precio->personas_d*$precio->utilidad_d*2;
                                        @endphp
                                    @endforeach
                                @endforeach
                            @endif
                            @if($m!=0)
                                @php
                                    $valor+=round($precio_hotel_m+$utilidad_m,2);
                                @endphp
                                @foreach($cotizacion_cat_->paquete_cotizaciones->take(1) as $paquete)
                                    @foreach($paquete->paquete_precios as $precio)
                                        @php    
                                            $precio_venta_total+=$precio->personas_m*$precio->utilidad_m*2;
                                        @endphp
                                    @endforeach
                                @endforeach
                            @endif
                            @if($t!=0)
                                @php
                                    $valor+=round($precio_hotel_t+$utilidad_t,2);
                                @endphp
                                @foreach($cotizacion_cat_->paquete_cotizaciones->take(1) as $paquete)
                                    @foreach($paquete->paquete_precios as $precio)
                                        @php
                                            $precio_venta_total+=$precio->personas_t*$precio->utilidad_t*3;
                                        @endphp
                                    @endforeach
                                @endforeach
                            @endif
                        @endif
                    @endif
                    @php
                        $hoy=\Carbon\Carbon::now();
                        $fecha_llegada=\Carbon\Carbon::createFromFormat('Y-m-d',$cotizacion_cat_->fecha);
                        $diff_dias=$hoy->diffInDays($fecha_llegada,false);
                    @endphp
                    @if($diff_dias>$tiempo_dias)
                        @php
                            $color='bg-white';
                        @endphp
                    @endif
                    @php
                        $total=0;
                        $confirmados=0;
                        $ultimo_dia=$cotizacion_cat_->fecha;
                        $itinerario='';
                        $sumatoria=0;
                    @endphp
                    @foreach($cotizacion_cat_->paquete_cotizaciones->where('estado','2') as $pqts)
                        @php
                            $total_pagado=0;
                            $proximo_pago='No hay pagos programados';
                            $proximo_pago_procesado='No hay pagos programados';
                            $proximo_monto='';
                            $recogido=0;
                        @endphp
                        @if($pqts->pagos_cliente)
                            @foreach($pqts->pagos_cliente as $pagos_cliente)
                                @if($pagos_cliente->estado==1)
                                    @php
                                        $total_pagado+=$pagos_cliente->monto;
                                    @endphp
                                @endif
                                @if($recogido==0)
                                    @if($pagos_cliente->estado==0)
                                        @php
                                            $proximo_pago=MisFunciones::fecha_peru($pagos_cliente->fecha);
                                            $proximo_pago_procesado=MisFunciones::fecha_peru($pagos_cliente->fecha_habilitada);
                                            $proximo_monto=$pagos_cliente->monto;
                                            $recogido++;
                                        @endphp
                                    @endif
                                @endif
                            @endforeach
                        @endif
                        @foreach($pqts->itinerario_cotizaciones as $itinerarios)
                            @php
                                $ultimo_dia=$itinerarios->fecha;
                                $itinerario.='<p><b class="text-primary">Dia '.$itinerarios->dias.': </b>'.date_format(date_create($itinerarios->fecha), 'jS M Y').'</p>';
                            @endphp
                            @foreach($itinerarios->itinerario_servicios as $servicios)
                                @php
                                    $total++;
                                @endphp
                                @if($servicios->precio_grupo==1)
                                    @php
                                        $sumatoria+=$servicios->precio;
                                    @endphp
                                @else
                                    @php
                                        $sumatoria+=$servicios->precio*$cotizacion_cat_->nropersonas;
                                    @endphp
                                @endif
                            @endforeach
                            @foreach($itinerarios->hotel as $hotel)
                                @php
                                    $total++;
                                @endphp
                                @if($hotel->personas_s>0)
                                    @php
                                        $sumatoria+=$hotel->personas_s*$hotel->precio_s;
                                    @endphp
                                @endif
                                @if($hotel->personas_d>0)
                                    @php
                                        $sumatoria+=$hotel->personas_d*$hotel->precio_d*2;
                                    @endphp
                                @endif
                                @if($hotel->personas_m>0)
                                    @php
                                        $sumatoria+=$hotel->personas_m*$hotel->precio_m*2;
                                    @endphp
                                @endif
                                @if($hotel->personas_t>0)
                                    @php
                                        $sumatoria+=$hotel->personas_t*$hotel->precio_t*3;
                                    @endphp
                                @endif
                            @endforeach
                        @endforeach                    
                        @php
                            $hoy=\Carbon\Carbon::now();
                            $ultimo_dia=\Carbon\Carbon::createFromFormat('Y-m-d',$ultimo_dia);
                            $dias_restantes=$hoy->diffInDays($ultimo_dia,false);
                        @endphp
                    
                        {{-- @if($precio_venta_total-$total_pagado!=0) --}}
                            <tr>
                                <td class="text-11"><b class="text-success">{{$cotizacion_cat_->codigo}}</b> | {{strtoupper($cotizacion_cat_->nombre_pax)}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'jS M Y')}}</td>
                                <td class="text-left">{{$cotizacion_cat_->web}}</td>
                                <td class="text-right">{{number_format($precio_venta_total,2)}}</td>
                                <td class="text-right">{{number_format($precio_reserva_total,2)}}</td>
                                <td class="text-right">{{number_format($precio_contabilidad_total,2)}}</td>
                                <td class="text-right @if(($precio_venta_total-$precio_contabilidad_total)>0) text-success @else text-danger @endif">{{number_format($precio_venta_total-$precio_contabilidad_total,2)}}</td>
                                <td class="text-right d-none">{{number_format($total_pagado,2)}}</td>
                                <td class="text-right d-none">{{number_format($precio_venta_total-$total_pagado,2)}}</td>
                                <td>
                                <!-- Large modal -->
                                    <a href="#!" data-toggle="modal" data-target="#modal_detalle_pagos_{{$cotizacion_cat_->id}}">Detalle pagos</a>
                                    <div class="modal fade" id="modal_detalle_pagos_{{$cotizacion_cat_->id}}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h4 class="modal-title">Detalle pagos</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row text-15">
                                                        <div class="col-12 text-success">
                                                            <div class="row">
                                                                <div class="col-2">
                                                                    <b>Pagado:</b>
                                                                </div>
                                                                <div class="col-3 text-right">
                                                                    <b><sup>$</sup> {{number_format($total_pagado,2)}}</b>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 text-danger">
                                                            <div class="row">
                                                                <div class="col-2">
                                                                    <b>Saldo:</b>
                                                                </div>
                                                                <div class="col-3 text-right">
                                                                    <b><sup>$</sup> {{number_format($precio_venta_total-$total_pagado,2)}}</b>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>                                                    
                                                    <table class="table table-sm m-0">
                                                        <thead>
                                                            <tr>
                                                                <th style="width:150px;" class="text-left">MEDIO PAGO</th>
                                                                <th style="width:100px;" class="text-center">FECHA</th>
                                                                <th style="width:100px;" class="text-center">PROCESADO</th>
                                                                <th class="d-none" class="text-left">NOTA</th>
                                                                <th style="width:80px;" class="text-right">MONTO</th>
                                                                <th style="width:80px;" class="text-right">ESTADO</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @php
                                                            $total_pago=0;
                                                            $k1=0;
                                                        @endphp
                                                        {{-- @if($opcion=='PAGADOS') --}}
                                                            @php
                                                                $total_pago=0;
                                                            @endphp
                                                            @foreach($pqts->pagos_cliente/*->whereBetween('fecha',[$f1,$f2])*/ as $pagos_cliente)
                                                                @php
                                                                    $nro_cotizaciones++;
                                                                    $total_pago+=$pagos_cliente->monto;
                                                                    $k1++;
                                                                @endphp
                                                                <tr>
                                                                    <td style="width:150px;" class="text-left">
                                                                        @if(!empty($pagos_cliente->forma_pagos->nombre))
                                                                            {{$pagos_cliente->forma_pagos->nombre}} <span class="text-success">(+{{$pagos_cliente->forma_pagos->tiempo_proceso}} dias)<span>
                                                                        @else
                                                                            Sin valor
                                                                        @endif
                                                                    </td>
                                                                    <td style="width:100px;" class="text-center">{{MisFunciones::fecha_peru($pagos_cliente->fecha)}}</td>
                                                                    <td style="width:100px;" class="text-center">{{MisFunciones::fecha_peru($pagos_cliente->fecha_habilitada)}}</td>
                                                                    <td class="d-none" class="text-left">{{$pagos_cliente->nota}}</td>
                                                                    <td style="width:80px" class="text-right">{{$pagos_cliente->monto}}</td>
                                                                    <td style="width:80px" class="text-right">
                                                                        @if($pagos_cliente->estado=='0')
                                                                            <span class="badge badge-secondary">Pendiente</span> 
                                                                            @php
                                                                                $total_pendiente+=$pagos_cliente->monto;
                                                                            @endphp
                                                                        @else
                                                                            <span class="badge badge-success">Pagado</span>
                                                                            @php
                                                                                $total_pagado_+=$pagos_cliente->monto;
                                                                            @endphp
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            <tr><td colspan="3"><b>Total</b></td><td class="text-right"><b>{{number_format($total_pago,2)}}</b></td><td></td></tr>
                                                            @php
                                                                $total_pagados+=$total_pago;
                                                            @endphp
                                                        {{-- @elseif($opcion=='PROCESADOS')
                                                            @php
                                                                $total_pago=0;
                                                            @endphp
                                                            @foreach($pqts->pagos_cliente->whereBetween('fecha_habilitada',[$f1,$f2]) as $pagos_cliente)
                                                                @php
                                                                    $nro_cotizaciones++;
                                                                    $total_pago+=$pagos_cliente->monto;
                                                                    $k1++;
                                                                @endphp
                                                                <tr>
                                                                    <td style="width:150px;" class="text-left">{{$pagos_cliente->forma_pagos->nombre}}</td>
                                                                    <td style="width:100px;" class="text-center">{{MisFunciones::fecha_peru($pagos_cliente->fecha)}}</td>
                                                                    <td style="width:100px;" class="text-center">{{MisFunciones::fecha_peru($pagos_cliente->fecha_habilitada)}}</td>
                                                                    <td class="d-none" class="text-left">{{$pagos_cliente->nota}}</td>
                                                                    <td style="width:80px" class="text-right">{{$pagos_cliente->monto}}</td>
                                                                    <td style="width:80px" class="text-right">
                                                                        @if($pagos_cliente->estado=='0')
                                                                            <span class="badge badge-secondary">Pendiente</span> 
                                                                            @php
                                                                                $total_pendiente+=$pagos_cliente->monto;
                                                                            @endphp
                                                                        @else
                                                                        <span class="badge badge-success">Pagado</span>
                                                                        @php
                                                                                $total_pagado_+=$pagos_cliente->monto;
                                                                            @endphp
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            @php
                                                                $total_procesados+=$total_pago;
                                                            @endphp
                                                        @elseif($opcion=='CERRADOS')
                                                            @php
                                                                $total_pago=0;
                                                            @endphp
                                                            @foreach($pqts->pagos_cliente->whereBetween('fecha',[$f1,$f2])->where('estado','1') as $pagos_cliente)
                                                                @php
                                                                    $nro_cotizaciones++;
                                                                    $total_pago+=$pagos_cliente->monto;
                                                                    $k1++;
                                                                @endphp
                                                                <tr>
                                                                    <td style="width:150px;" class="text-left">
                                                                        @if(!empty($pagos_cliente->forma_pagos->nombre))
                                                                            {{$pagos_cliente->forma_pagos->nombre}}
                                                                        @else
                                                                            Sin valor
                                                                        @endif
                                                                    </td>
                                                                    <td style="width:100px;" class="text-center">{{MisFunciones::fecha_peru($pagos_cliente->fecha)}}</td>
                                                                    <td style="width:100px;" class="text-center">{{MisFunciones::fecha_peru($pagos_cliente->fecha_habilitada)}}</td>
                                                                    <td class="d-none" class="text-left">{{$pagos_cliente->nota}}</td>
                                                                    <td style="width:80px" class="text-right">{{$pagos_cliente->monto}}</td>
                                                                    <td style="width:80px" class="text-right">
                                                                        @if($pagos_cliente->estado=='0')
                                                                            <span class="badge badge-secondary">Pendiente</span>
                                                                            @php
                                                                                $total_pendiente+=$pagos_cliente->monto;
                                                                            @endphp
                                                                        @else
                                                                            <span class="badge badge-success">Pagado</span>
                                                                            @php
                                                                                $total_pagado_+=$pagos_cliente->monto;
                                                                            @endphp
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            @php
                                                                $total_cerrados+=$total_pago;
                                                            @endphp
                                                        @elseif($opcion=='PENDIENTES')
                                                            @php
                                                                $total_pago=0;
                                                            @endphp
                                                            @foreach($pqts->pagos_cliente->whereBetween('fecha',[$f1,$f2])->where('estado','0') as $pagos_cliente)
                                                                @php
                                                                    $nro_cotizaciones++;
                                                                    $total_pago+=$pagos_cliente->monto;
                                                                    $k1++;
                                                                @endphp
                                                                <tr>
                                                                    <td style="width:150px;" class="text-left">
                                                                        @if(!empty($pagos_cliente->forma_pagos->nombre))
                                                                            {{$pagos_cliente->forma_pagos->nombre}}
                                                                        @else
                                                                            Sin valor
                                                                        @endif
                                                                    </td>
                                                                    <td style="width:100px;" class="text-center">{{MisFunciones::fecha_peru($pagos_cliente->fecha)}}</td>
                                                                    <td style="width:100px;" class="text-center">{{MisFunciones::fecha_peru($pagos_cliente->fecha_habilitada)}}</td>
                                                                    <td class="d-none" class="text-left">{{$pagos_cliente->nota}}</td>
                                                                    <td style="width:80px" class="text-right">{{$pagos_cliente->monto}}</td>
                                                                    <td style="width:80px" class="text-right">
                                                                        @if($pagos_cliente->estado=='0')
                                                                            <span class="badge badge-secondary">Pendiente</span>
                                                                            @php
                                                                                $total_pendiente+=$pagos_cliente->monto;
                                                                            @endphp
                                                                        @else
                                                                            <span class="badge badge-success">Pagado</span>
                                                                            @php
                                                                                $total_pagado_+=$pagos_cliente->monto;
                                                                            @endphp
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            @php
                                                                $total_pendientes+=$total_pago;
                                                            @endphp    
                                                        @endif --}}
                                                        </tbody>
                                                        <tfoot class="d-none">
                                                            <tr>
                                                                <td>
                                                                    <b>SUMATORIA</b>   
                                                                </td>
                                                                <td>
                                                                </td>
                                                                <td><b>{{$total_pago}}</b></td>
                                                                <td></td>
                                                            </tr>
                                                        </tfoot>
                                                    </table> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class=" d-none">{{$proximo_pago}}</td>
                                <td class=" d-none">{{$proximo_pago_procesado}}</td>
                                <td class=" d-none">{{$proximo_monto}}</td>
                                <td class="d-none">
                                    <a class="btn btn-primary btn-sm" href="#!" id="archivos" data-toggle="modal" data-target="#myModal_plan_pagos_{{$pqts->id}}">Plan de pagos
                                    </a>
                                    <div class="modal fade" id="myModal_plan_pagos_{{$pqts->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog modal-md" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h4 class="modal-title" id="myModalLabel">Detalle de pagos</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body clearfix">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <table class="table table-stripe table-hover text-13">
                                                                <thead>
                                                                    <tr>
                                                                        <th>FECHA</th>
                                                                        <th>NOTA</th>
                                                                        <th>MONTO</th>
                                                                        <th>ESTADO</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="lista_pagos_{{$pqts->id}}">
                                                                @php
                                                                    $total_pago=0;
                                                                    
                                                                @endphp
                                                                {{-- @if(true) --}}
                                                                @php
                                                                    $k=0;
                                                                @endphp
                                                                @foreach($pqts->pagos_cliente as $pagos_cliente)
                                                                    @php
                                                                        $total_pago+=$pagos_cliente->monto;
                                                                        $k++;
                                                                    @endphp
                                                                    <tr id="pago_{{$pqts->id}}_{{$pagos_cliente->id}}">
                                                                        <td style="width:60px;">{{MisFunciones::fecha_peru($pagos_cliente->fecha)}}</td>
                                                                        <td style="width:100px">{{$pagos_cliente->nota}}</td>
                                                                        <td style="width:60px" class="text-right">{{$pagos_cliente->monto}}</td>
                                                                        <td style="width:40px">
                                                                            @if($pagos_cliente->estado=='0')
                                                                                <span class="badge badge-secondary">Pendiente</span> 
                                                                            @else
                                                                            <span class="badge badge-success">Pagado</span>
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                {{-- @endif --}}
                                                                    
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td colspan="2">
                                                                            <b>SUMATORIA</b>   
                                                                        </td>
                                                                        <td class="text-right"><b>{{number_format($total_pago,2)}}</b></td>
                                                                        <td></td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>   
                                                            <input type="hidden" id="nro_pagos_{{$pqts->id}}" value="1">   
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="modal-footer d-none">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                    <button type="button" class="btn btn-primary d-none">Guardar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <b><span> <i class="fas fa-user"></i> </span> {{$cotizacion_cat_->users->name}}</b>
                                </td>
                            </tr>    
                        {{-- @endif --}}
                    @endforeach
                    @php
                        $total_venta+=$precio_venta_total;
                        $total_reserva+=$precio_reserva_total;
                        $total_contabilidad+=$precio_contabilidad_total;
                    @endphp
                @endforeach  
                    <tr>
                        <td colspan="2"><b>SUMATORIA</b></td>
                        <td class="text-right"><b>{{number_format($total_venta,2)}}</b></td>
                        <td class="text-right"><b>{{number_format($total_reserva,2)}}</b></td>
                        <td class="text-right"><b>{{number_format($total_contabilidad,2)}}</b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="8"></td>
                    </tr>
                    <tr>
                        <td><b>MONTO TOTAL VENTAS</b></td>
                        <td><b>{{number_format($total_venta,2)}}</b></td>
                    </tr>
                    <tr>
                        <td><b>MONTO TOTAL CONTABILIDAD</b></td>
                        <td><b>{{number_format($total_contabilidad,2)}}</b></td>
                    </tr>
                    <tr>
                        <td><b>MONTO TOTAL PROFIT</b></td>
                        <td><b>{{number_format($total_venta-$total_contabilidad,2)}}</b></td>
                    </tr>
                </tbody>  
                <tfoot class="d-none">
                    <tr class="text-15">
                        <th><b class="badge badge-success">Pagado</b></th>
                        <th class="text-right"><b>{{$total_pagado_}}</b></th>
                    </tr>
                    <tr class="text-15">
                        <th><b class="badge badge-secondary">Pendiente</b></th>
                        <th class="text-right"><b>{{$total_pendiente}}</b></th>
                    </tr>
                    @if($opcion=='PAGADOS')
                        <tr class="text-15">
                            <th><b>TOTAL PAGADOS</b></th>
                            <th class="text-right"><b>{{$total_pagados}}</b></th>
                        </tr>
                    @elseif($opcion=='PROCESADOS')
                        <tr class="text-15">
                            <th><b>TOTAL PROCESADO</b></th>
                            <th class="text-right"><b>{{$total_procesados}}</b></th>
                        </tr>
                    @elseif($opcion=='CERRADOS')
                        <tr class="text-15">
                            <th><b>TOTAL CERRADOS</b></th>
                            <th class="text-right"><b>{{$total_cerrados}}</b></th>
                        </tr>
                    @elseif($opcion=='PENDIENTES')
                        <tr class="text-15">
                            <th><b>TOTAL PENDIENTES</b></th>
                            <th class="text-right"><b>{{$total_pendientes}}</b></th>
                        </tr>
                    @endif
                </tfoot>                
            </table>  
        </div>
    </div>


    
<script>
    $(document).ready( function () {

        var table = $('#example_tabla').DataTable( {
            "ordering": false,
            paging: false,
            dom: 'Bfrtip',
            buttons: [ 'copyHtml5', 'excelHtml5'],

        } );

        // table.buttons().container()
        //     .appendTo( '#example_tabla_wrapper .col-md-6:eq(0)' );
    } );
</script>
