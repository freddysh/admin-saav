@extends('layouts.admin.book')
@section('content')
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
<div class="row mt-2 no-gutters">
    <div class="col-12 border border-dark">
        <div class="row bg-dark mx-0 py-1 ">
            <div class="col-12">
                <div class="row px-0">
                    <div class="col-2">
                        <b class="text-16 text-white">TODOS LOS FILES</b>
                    </div>
                    <div class="col-3">
                        <input form="nuevo_buscar_codigo" name="todos_codigo" id="todos_codigo" class="form-control" type="text" placeholder="Codigo o Nombre">
                    </div>
                    <div class="col-1">
                        {{csrf_field()}}
                        <a href="#!" name="buscar" onclick="buscar_reserva($('#todos_codigo').val(),'','TODOS','CODIGO/NOMBRE')"><i class="fas fa-search fa-2x text-white"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div id="TODOS" class="row mt-1 no-gutters">
            <div class="col-4 border border-danger">
                <div class="row bg-danger mx-0">
                    <div class="col-12 ">
                        <div class="row p-1">
                            <div class="col-3 px-0">
                                <b class="text-14 text-white">NEW</b>
                            </div>
                            <div class="col-9">
                                <select class="form-control" name="tipo_filtro" id="tipo_filtro" onchange="mostrar_filtro_reservas($(this).val(),'nuevo')">
                                    <option value="show-codigo-nuevo">Código</option>
                                    <option value="show-nombre-nuevo">Nombre</option>
                                    <option value="show-fechas-nuevo">Entre fechas</option>
                                    <option value="show-anio-mes-nuevo">Año-mes</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row bg-danger mx-0 pb-1">
                    <div id="show-codigo-nuevo" class="col-12">
                        <div class="row px-0">
                            <div class="col-10 px-0">
                                <input form="nuevo_buscar_codigo" name="nuevo_codigo" id="nuevo_codigo" class="form-control" type="text" placeholder="Codigo">
                            </div>
                            <div class="col-2">
                                {{csrf_field()}}
                                <a href="#!" name="buscar" onclick="buscar_reserva($('#nuevo_codigo').val(),'','NUEVO','CODIGO')"><i class="fas fa-search fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                    <div id="show-nombre-nuevo" class="col-12 d-none">
                        <div class="row px-0">
                            <div class="col-10 px-0">
                                <input form="nuevo_buscar_nombre" name="nombre_nuevo" id="nombre_nuevo" class="form-control" type="text" placeholder="Nombre">
                            </div>
                            <div class="col-2">
                                <a href="#!" name="buscar" onclick="buscar_reserva($('#nombre_nuevo').val(),'','NUEVO','NOMBRE')"><i class="fas fa-search fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                    <div id="show-fechas-nuevo" class="col-12 d-none">
                        <div class="row px-0">
                            <div class="col-10 px-0">
                                <div class="row">
                                    <div class="col-6 mr-0 pr-0">
                                        <input form="nuevo_buscar_fecha" class="form-control" type="date" name="f_ini" id="f_ini_nuevo">
                                    </div>
                                    <div class="col-6 ml-0 pl-0">
                                        <input form="nuevo_buscar_fecha" class="form-control" type="date" name="f_fin" id="f_fin_nuevo">
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <a href="#!"  name="buscar" onclick="buscar_reserva($('#f_ini_nuevo').val(),$('#f_fin_nuevo').val(),'NUEVO','FECHAS')"><i class="fas fa-search fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                    <div id="show-anio-mes-nuevo" class="col-12 d-none">
                        <div class="row px-0">
                            <div class="col-10 px-0">
                                <div class="row">
                                    <div class="col-4 pr-0">
                                        <input form="nuevo_buscar_anio_mes" name="anio_nuevo" id="anio_nuevo" class="form-control" type="text" value="{{date("Y")}}">
                                    </div>
                                    <div class="col-8 pl-0">
                                        <select form="nuevo_buscar_anio_mes" name="mes_nuevo" id="mes_nuevo" class="form-control">
                                            <option value="01">ENERO</option>
                                            <option value="02">FEBRERO</option>
                                            <option value="03">MARZO</option>
                                            <option value="04">ABRIL</option>
                                            <option value="05">MAYO</option>
                                            <option value="06">JUNIO</option>
                                            <option value="07">JULIO</option>
                                            <option value="08">AGOSTO</option>
                                            <option value="09">SEPTIEMBRE</option>
                                            <option value="10">OCTUBRE</option>
                                            <option value="11">NOVIEMBRE</option>
                                            <option value="12">DICIEMBRE</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <a href="#!"  name="buscar" onclick="buscar_reserva($('#anio_nuevo').val(),$('#mes_nuevo').val(),'NUEVO','ANIO-MES')"><i class="fas fa-search fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12" id="NUEVO">                        
                        @foreach($cotizaciones_new->sortBy('fecha') as $cotizacion_cat_)
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
                            {{-- @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                @if($clientes->estado==1)
                                    @php
                                        $dato_cliente=$clientes->cliente->nombres;
                                    @endphp
                                @endif
                            @endforeach --}}
                            @php
                                $total=0;
                                $confirmados=0;
                                $ultimo_dia=$cotizacion_cat_->fecha;
                                $itinerario='';
                                $precio_venta=0;
                                $precio_reservado=0;
                                $precio_pagado=0;                                
                                $nro_hoteles=0;
                                $pagados=0;
                                $con_requerimiento=0;
                                $totales=0;
                            @endphp
                            @foreach($cotizacion_cat_->paquete_cotizaciones->where('estado','2') as $pqts)
                                @if ($pqts->paquete_precios->count()==0)
                                    @php
                                        $precio_venta+=$pqts->utilidad*$cotizacion_cat_->nropersonas;    
                                    @endphp
                                @else                                
                                    @foreach($pqts->itinerario_cotizaciones->take(1) as $itinerarios)
                                        @foreach($itinerarios->hotel->take(1) as $hotel)
                                            @if($hotel->personas_s>0)
                                            @php
                                                $precio_venta+=$hotel->utilidad_s*$hotel->personas_s;
                                            @endphp
                                            @endif
                                            @if($hotel->personas_d>0)
                                            @php
                                                $precio_venta+=$hotel->utilidad_d*$hotel->personas_d*2;
                                            @endphp 
                                            @endif
                                            @if($hotel->personas_m>0)
                                            @php
                                                $precio_venta+=$hotel->utilidad_m*$hotel->personas_m*2;
                                            @endphp 
                                            @endif
                                            @if($hotel->personas_t>0)
                                            @php
                                                $precio_venta+=$hotel->utilidad_t*$hotel->personas_t*3;
                                            @endphp 
                                            @endif
                                        @endforeach       
                                    @endforeach                  
                                @endif
                                @foreach($pqts->itinerario_cotizaciones as $itinerarios)
                                    @if($itinerarios->requerimientos_id==0)
                                        @php
                                            $con_requerimiento++;
                                        @endphp
                                    @elseif($itinerarios->requerimientos_id>0)
                                        @php
                                            $con_requerimiento++;
                                        @endphp
                                    @endif
                                    @php
                                    
                                        $ultimo_dia=$itinerarios->fecha;
                                        $itinerario.='<p><b class="text-primary">Dia '.$itinerarios->dias.': </b>'.date_format(date_create($itinerarios->fecha), 'jS M Y').'</p>';
                                    @endphp
                                    @foreach($itinerarios->itinerario_servicios as $servicios)
                                        @php
                                            $total++;
                                            $precio_reservado+=$servicios->precio_proveedor;
                                            $precio_pagado+=$servicios->precio_c;
                                        @endphp
                                        @if($servicios->primera_confirmada==1)
                                            @php
                                                $confirmados++;
                                            @endphp
                                        @endif
                                        @if($servicios->precio_grupo>0)
                                            @php
                                                $precio_venta+=$servicios->precio;    
                                            @endphp
                                        @else
                                            @php
                                                $precio_venta+=$servicios->precio*$cotizacion_cat_->nropersonas;    
                                            @endphp
                                        @endif
                                    @endforeach
                                    @foreach($itinerarios->hotel as $hotel)
                                        @php
                                            $total++;
                                        @endphp
                                        @if($hotel->primera_confirmada==1)
                                            @php
                                                $confirmados++;
                                            @endphp
                                        @endif
                                        @if($hotel->personas_s>0)
                                            @php
                                                $precio_venta+=$hotel->precio_s*$hotel->personas_s; 
                                                $precio_reservado+=$hotel->precio_s_r*$hotel->personas_s;  
                                                $precio_pagado+=$hotel->precio_s_c*$hotel->personas_s;    
                                            @endphp
                                        @endif
                                        @if($hotel->personas_d>0)
                                            @php
                                                $precio_venta+=$hotel->precio_d*$hotel->personas_d;   
                                                $precio_reservado+=$hotel->precio_d_r*$hotel->personas_s;  
                                                $precio_pagado+=$hotel->precio_d_c*$hotel->personas_s; 
                                            @endphp
                                        @endif
                                        @if($hotel->personas_m>0)
                                            @php
                                                $precio_venta+=$hotel->precio_m*$hotel->personas_m;
                                                $precio_reservado+=$hotel->precio_m_r*$hotel->personas_s;  
                                                $precio_pagado+=$hotel->precio_m_c*$hotel->personas_s;    
                                            @endphp
                                        @endif
                                        @if($hotel->personas_t>0)
                                            @php
                                                $precio_venta+=$hotel->precio_t*$hotel->personas_t;  
                                                $precio_reservado+=$hotel->precio_t_r*$hotel->personas_s;  
                                                $precio_pagado+=$hotel->precio_t_c*$hotel->personas_s;  
                                            @endphp
                                        @endif
                                    @endforeach
                                @endforeach
                            @endforeach
                            @php
                                $hoy=\Carbon\Carbon::now();
                                $ultimo_dia=\Carbon\Carbon::createFromFormat('Y-m-d',$ultimo_dia);
                                $dias_restantes=$hoy->diffInDays($ultimo_dia,false);
                            @endphp
                            @if($cotizacion_cat_->anulado>0)
                                @if($total>0)
                                    @if($confirmados==0)
                                        @if($dias_restantes>=0)
                                            <div class="row mb-1 border border-top-0 border-right-0 border-left-0 mx-0 {{$color}}">
                                                <div class="col">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <b class="text-success text-12">{{$cotizacion_cat_->codigo}}</b>
                                                                    <a href="#!" title="Itinerario" data-toggle="popover" data-trigger="focus" data-content="{{$itinerario}}"> <i class="fas fa-eye text-12"></i></a>
                                                                </div>
                                                                <div class="col-2 bg-green-goto text-right text-11">
                                                                    <b class="text-white"><sup>$</sup>{{$precio_venta}}</b>
                                                                </div>
                                                                <div class="col-2 bg-g-yellow text-right text-11">
                                                                    <b class="text-white"><sup>$</sup>{{$precio_reservado}}</b>
                                                                </div>
                                                                <div class="col-2 bg-grey-goto text-right text-11">
                                                                    <b class="text-white"><sup>$</sup>{{$precio_reservado}}</b>
                                                                </div>
                                                            </div> 
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="row px-0">
                                                                <div class="col-6 text-grey-goto pr-0">
                                                                    <a href="{{route('book_show_path',$cotizacion_cat_->id)}}">
                                                                        <b class="text-10">{{strtoupper($cotizacion_cat_->nombre_pax)}}</b>
                                                                    </a>
                                                                </div>
                                                                <div class="col-1 bg-grey-goto text-center text-white mx-0 px-0">
                                                                    <b class="text-10">x{{$cotizacion_cat_->nropersonas}}</b>
                                                                </div>
                                                                <div class="col-1 bg-danger text-center text-white mx-0 px-0">
                                                                    <b class="text-10">{{$cotizacion_cat_->duracion}}d</b>
                                                                </div>
                                                                <div class="col-4 mx-0 pr-0">
                                                                    <b class="text-10">{{date_format(date_create($cotizacion_cat_->fecha), 'jS M Y')}}</b>
                                                                </div>
                                                                {{--<div class="col-1 px-0">--}}
                                                                {{--<b class="text-12">{{ round(($confirmados*100)/$total,2)}}%</b>--}}
                                                                {{--</div>--}}
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-4 border border-warning">
                <div class="row bg-warning mx-0">
                    <div class="col-12 ">
                        <div class="row p-1">
                            <div class="col-3 px-0">
                                <b class="text-14 text-white">CURRENT</b>
                            </div>
                            <div class="col-9">
                                <select class="form-control" name="tipo_filtro" id="tipo_filtro" onchange="mostrar_filtro_reservas($(this).val(),'current')">
                                    <option value="show-codigo-current">Código</option>
                                    <option value="show-nombre-current">Nombre</option>
                                    <option value="show-fechas-current">Entre fechas</option>
                                    <option value="show-anio-mes-current">Año-mes</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row bg-warning mx-0 pb-1">
                    <div id="show-codigo-current" class="col-12">
                        <div class="row px-0">
                            <div class="col-10 px-0">
                                <input form="nuevo_buscar_codigo" name="nuevo_codigo" id="current_codigo" class="form-control" type="text" placeholder="Codigo">
                            </div>
                            <div class="col-2">
                                {{csrf_field()}}
                                <a href="#!" name="buscar" onclick="buscar_reserva($('#current_codigo').val(),'','CURRENT','CODIGO')"><i class="fas fa-search fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                    <div id="show-nombre-current" class="col-12 d-none">
                        <div class="row px-0">
                            <div class="col-10 px-0">
                                <input form="nuevo_buscar_nombre" name="nombre_current" id="nombre_current" class="form-control" type="text" placeholder="Nombre">
                            </div>
                            <div class="col-2">
                                <a href="#!" name="buscar" onclick="buscar_reserva($('#nombre_current').val(),'','CURRENT','NOMBRE')"><i class="fas fa-search fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                    <div id="show-fechas-current" class="col-12 d-none">
                        <div class="row px-0">
                            <div class="col-10 px-0">
                                <div class="row">
                                    <div class="col-6 mr-0 pr-0">
                                        <input form="nuevo_buscar_fecha" class="form-control" type="date" name="f_ini" id="f_ini_current">
                                    </div>
                                    <div class="col-6 ml-0 pl-0">
                                        <input form="nuevo_buscar_fecha" class="form-control" type="date" name="f_fin" id="f_fin_current">
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <a href="#!"  name="buscar" onclick="buscar_reserva($('#f_ini_current').val(),$('#f_fin_current').val(),'CURRENT','FECHAS')"><i class="fas fa-search fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                    <div id="show-anio-mes-current" class="col-12 d-none">
                        <div class="row px-0">
                            <div class="col-10 px-0">
                                <div class="row">
                                    <div class="col-4 pr-0">
                                        <input form="nuevo_buscar_anio_mes" name="anio_current" id="anio_current" class="form-control" type="text" value="{{date("Y")}}">
                                    </div>
                                    <div class="col-8 pl-0">
                                        <select form="nuevo_buscar_anio_mes" name="mes_current" id="mes_current" class="form-control">
                                            <option value="01">ENERO</option>
                                            <option value="02">FEBRERO</option>
                                            <option value="03">MARZO</option>
                                            <option value="04">ABRIL</option>
                                            <option value="05">MAYO</option>
                                            <option value="06">JUNIO</option>
                                            <option value="07">JULIO</option>
                                            <option value="08">AGOSTO</option>
                                            <option value="09">SEPTIEMBRE</option>
                                            <option value="10">OCTUBRE</option>
                                            <option value="11">NOVIEMBRE</option>
                                            <option value="12">DICIEMBRE</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <a href="#!"  name="buscar" onclick="buscar_reserva($('#anio_current').val(),$('#mes_current').val(),'CURRENT','ANIO-MES')"><i class="fas fa-search fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12" id="CURRENT">
                        @foreach($cotizaciones_current_complete->sortBy('fecha') as $cotizacion_cat_)
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
                            @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                @if($clientes->estado==1)
                                    @php
                                        $dato_cliente=$clientes->cliente->nombres;
                                    @endphp
                                @endif
                            @endforeach
                            @php
                                $total=0;
                                $confirmados=0;
                                $ultimo_dia=$cotizacion_cat_->fecha;
                                $itinerario='';
                                $precio_venta=0;
                                $precio_reservado=0;
                                $precio_pagado=0;                                
                                $nro_hoteles=0;
                            @endphp
                            @foreach($cotizacion_cat_->paquete_cotizaciones->where('estado','2') as $pqts)
                                @if ($pqts->paquete_precios->count()==0)
                                    @php
                                        $precio_venta+=$pqts->utilidad*$cotizacion_cat_->nropersonas;    
                                    @endphp
                                @else                                
                                    @foreach($pqts->itinerario_cotizaciones->take(1) as $itinerarios)
                                        @foreach($itinerarios->hotel->take(1) as $hotel)
                                            @if($hotel->personas_s>0)
                                            @php
                                                $precio_venta+=$hotel->utilidad_s*$hotel->personas_s;
                                            @endphp
                                            @endif
                                            @if($hotel->personas_d>0)
                                            @php
                                                $precio_venta+=$hotel->utilidad_d*$hotel->personas_d*2;
                                            @endphp 
                                            @endif
                                            @if($hotel->personas_m>0)
                                            @php
                                                $precio_venta+=$hotel->utilidad_m*$hotel->personas_m*2;
                                            @endphp 
                                            @endif
                                            @if($hotel->personas_t>0)
                                            @php
                                                $precio_venta+=$hotel->utilidad_t*$hotel->personas_t*3;
                                            @endphp 
                                            @endif
                                        @endforeach       
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
                                            $precio_reservado+=$servicios->precio_proveedor;
                                            $precio_pagado+=$servicios->precio_c;
                                        @endphp
                                        @if($servicios->primera_confirmada==1)
                                            @php
                                                $confirmados++;
                                            @endphp
                                        @endif
                                        @if($servicios->precio_grupo>0)
                                            @php
                                                $precio_venta+=$servicios->precio;    
                                            @endphp
                                        @else
                                            @php
                                                $precio_venta+=$servicios->precio*$cotizacion_cat_->nropersonas;    
                                            @endphp
                                        @endif
                                    @endforeach
                                    @foreach($itinerarios->hotel as $hotel)
                                        @php
                                            $total++;
                                        @endphp
                                        @if($hotel->primera_confirmada==1)
                                            @php
                                                $confirmados++;
                                            @endphp
                                        @endif
                                        @if($hotel->personas_s>0)
                                            @php
                                                $precio_venta+=$hotel->precio_s*$hotel->personas_s; 
                                                $precio_reservado+=$hotel->precio_s_r*$hotel->personas_s;  
                                                $precio_pagado+=$hotel->precio_s_c*$hotel->personas_s;    
                                            @endphp
                                        @endif
                                        @if($hotel->personas_d>0)
                                            @php
                                                $precio_venta+=$hotel->precio_d*$hotel->personas_d;   
                                                $precio_reservado+=$hotel->precio_d_r*$hotel->personas_s;  
                                                $precio_pagado+=$hotel->precio_d_c*$hotel->personas_s; 
                                            @endphp
                                        @endif
                                        @if($hotel->personas_m>0)
                                            @php
                                                $precio_venta+=$hotel->precio_m*$hotel->personas_m;
                                                $precio_reservado+=$hotel->precio_m_r*$hotel->personas_s;  
                                                $precio_pagado+=$hotel->precio_m_c*$hotel->personas_s;    
                                            @endphp
                                        @endif
                                        @if($hotel->personas_t>0)
                                            @php
                                                $precio_venta+=$hotel->precio_t*$hotel->personas_t;  
                                                $precio_reservado+=$hotel->precio_t_r*$hotel->personas_s;  
                                                $precio_pagado+=$hotel->precio_t_c*$hotel->personas_s;  
                                            @endphp
                                        @endif
                                    @endforeach
                                @endforeach
                            @endforeach
                            @php
                                $ultimo_dia=\Carbon\Carbon::createFromFormat('Y-m-d',$ultimo_dia);
                                $dias_restantes=$hoy->diffInDays($ultimo_dia,false);
                            @endphp
                            @if($cotizacion_cat_->anulado>0)
                                @if($total>0)
                                    @if($confirmados>=1&&$confirmados<$total)
                                            @if($dias_restantes>=0)
                                                <div class="row mb-1 border border-top-0 border-right-0 border-left-0 mx-0 {{$color}}">
                                                    <div class="col">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <b class="text-success text-12">{{$cotizacion_cat_->codigo}}</b>
                                                                <a href="#!" title="Itinerario" data-toggle="popover" data-trigger="focus" data-content="{{$itinerario}}"> <i class="fas fa-eye text-12"></i></a>
                                                            </div>
                                                            <div class="col-2 bg-green-goto text-right text-11">
                                                                <b class="text-white"><sup>$</sup>{{$precio_venta}}</b>
                                                            </div>
                                                            <div class="col-2 bg-g-yellow text-right text-11">
                                                                <b class="text-white"><sup>$</sup>{{$precio_reservado}}</b>
                                                            </div>
                                                            <div class="col-2 bg-grey-goto text-right text-11">
                                                                <b class="text-white"><sup>$</sup>{{$precio_reservado}}</b>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="row px-0">
                                                                    <div class="col-6 text-grey-goto pr-0">
                                                                        <a href="{{route('book_show_path',$cotizacion_cat_->id)}}">
                                                                            <b class="text-10">{{strtoupper($cotizacion_cat_->nombre_pax)}}</b>
                                                                        </a>
                                                                    </div>
                                                                    <div class="col-1 bg-grey-goto text-center text-white mx-0 px-0">
                                                                        <b class="text-10">x{{$cotizacion_cat_->nropersonas}}</b>
                                                                    </div>
                                                                    <div class="col-1 bg-danger text-center text-white mx-0 px-0">
                                                                        <b class="text-10">{{$cotizacion_cat_->duracion}}d</b>
                                                                    </div>
                                                                    <div class="col-4 mx-0 px-0"> 
                                                                        <b class="text-10">{{date_format(date_create($cotizacion_cat_->fecha), 'jS M Y')}}</b>
                                                                        |
                                                                        <b class="text-10 text-danger">{{ round(($confirmados*100)/$total,1)}}%</b>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-4 border border-success">
                <div class="row bg-success mx-0">
                    <div class="col-12 ">
                        <div class="row p-1">
                            <div class="col-3 px-0">
                                <b class="text-14 text-white">COMPLETE</b>
                            </div>
                            <div class="col-9">
                                <select class="form-control" name="tipo_filtro" id="tipo_filtro" onchange="mostrar_filtro_reservas($(this).val(),'complete')">
                                    <option value="show-codigo-complete">Código</option>
                                    <option value="show-nombre-complete">Nombre</option>
                                    <option value="show-fechas-complete">Entre fechas</option>
                                    <option value="show-anio-mes-complete">Año-mes</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row bg-success mx-0 pb-1">
                    <div id="show-codigo-complete" class="col-12">
                        <div class="row px-0">
                            <div class="col-10 px-0">
                                <input form="nuevo_buscar_codigo" name="complete_codigo" id="complete_codigo" class="form-control" type="text" placeholder="Codigo">
                            </div>
                            <div class="col-2">
                                {{csrf_field()}}
                                <a href="#!" name="buscar" onclick="buscar_reserva($('#complete_codigo').val(),'','COMPLETE','CODIGO')"><i class="fas fa-search fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                    <div id="show-nombre-complete" class="col-12 d-none">
                        <div class="row px-0">
                            <div class="col-10 px-0">
                                <input form="nuevo_buscar_nombre" name="nombre_complete" id="nombre_complete" class="form-control" type="text" placeholder="Nombre">
                            </div>
                            <div class="col-2">
                                <a href="#!" name="buscar" onclick="buscar_reserva($('#nombre_complete').val(),'','COMPLETE','NOMBRE')"><i class="fas fa-search fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                    <div id="show-fechas-complete" class="col-12 d-none">
                        <div class="row px-0">
                            <div class="col-10 px-0">
                                <div class="row">
                                    <div class="col-6 mr-0 pr-0">
                                        <input form="nuevo_buscar_fecha" class="form-control" type="date" name="f_ini" id="f_ini_complete">
                                    </div>
                                    <div class="col-6 ml-0 pl-0">
                                        <input form="nuevo_buscar_fecha" class="form-control" type="date" name="f_fin" id="f_fin_complete">
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <a href="#!"  name="buscar" onclick="buscar_reserva($('#f_ini_complete').val(),$('#f_fin_complete').val(),'COMPLETE','FECHAS')"><i class="fas fa-search fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                    <div id="show-anio-mes-complete" class="col-12 d-none">
                        <div class="row px-0">
                            <div class="col-10 px-0">
                                <div class="row">
                                    <div class="col-4 pr-0">
                                        <input form="nuevo_buscar_anio_mes" name="anio_complete" id="anio_complete" class="form-control" type="text" value="{{date("Y")}}">
                                    </div>
                                    <div class="col-8 pl-0">
                                        <select form="nuevo_buscar_anio_mes" name="mes_complete" id="mes_complete" class="form-control">
                                            <option value="01">ENERO</option>
                                            <option value="02">FEBRERO</option>
                                            <option value="03">MARZO</option>
                                            <option value="04">ABRIL</option>
                                            <option value="05">MAYO</option>
                                            <option value="06">JUNIO</option>
                                            <option value="07">JULIO</option>
                                            <option value="08">AGOSTO</option>
                                            <option value="09">SEPTIEMBRE</option>
                                            <option value="10">OCTUBRE</option>
                                            <option value="11">NOVIEMBRE</option>
                                            <option value="12">DICIEMBRE</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <a href="#!"  name="buscar" onclick="buscar_reserva($('#anio_complete').val(),$('#mes_complete').val(),'COMPLETE','ANIO-MES')"><i class="fas fa-search fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12" id="COMPLETE">
                        @foreach($cotizaciones_current_complete->sortBy('fecha') as $cotizacion_cat_)
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
                            @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                @if($clientes->estado==1)
                                    @php
                                        $dato_cliente=$clientes->cliente->nombres;
                                    @endphp
                                @endif
                            @endforeach
                            @php
                                $total=0;
                                $confirmados=0;
                                $ultimo_dia=$cotizacion_cat_->fecha;
                                $itinerario='';
                            @endphp
                            @foreach($cotizacion_cat_->paquete_cotizaciones->where('estado','2') as $pqts)
                                @foreach($pqts->itinerario_cotizaciones as $itinerarios)
                                    @php
                                        $ultimo_dia=$itinerarios->fecha;
                                        $itinerario.='<p><b class="text-primary">Dia '.$itinerarios->dias.': </b>'.date_format(date_create($itinerarios->fecha), 'jS M Y').'</p>';
                                    @endphp
                                    @foreach($itinerarios->itinerario_servicios as $servicios)
                                        @php
                                            $total++;
                                        @endphp
                                        @if($servicios->primera_confirmada==1)
                                            @php
                                                $confirmados++;
                                            @endphp
                                        @endif
                                    @endforeach
                                    @foreach($itinerarios->hotel as $hotel)
                                        @php
                                            $total++;
                                        @endphp
                                        @if($hotel->primera_confirmada==1)
                                            @php
                                                $confirmados++;
                                            @endphp
                                        @endif
                                    @endforeach
                                @endforeach
                            @endforeach
                            @php
                                $hoy=\Carbon\Carbon::now();
                                $ultimo_dia=\Carbon\Carbon::createFromFormat('Y-m-d',$ultimo_dia);
                                $dias_restantes=$hoy->diffInDays($ultimo_dia,false);
                            @endphp
                            @if($cotizacion_cat_->anulado>0)
                                @if($total>0)
                                    @if($confirmados==$total)
                                        @if($dias_restantes>=0)
                                            <div class="row mb-1 border border-top-0 border-right-0 border-left-0 mx-0">
                                                <div class="col">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <b class="text-success text-12">{{$cotizacion_cat_->codigo}}</b>
                                                            <a href="#!" title="Itinerario" data-toggle="popover" data-trigger="focus" data-content="{{$itinerario}}"> <i class="fas fa-eye text-12"></i></a>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="row px-0">
                                                                <div class="col-6 text-grey-goto pr-0">
                                                                    <a href="{{route('book_show_path',$cotizacion_cat_->id)}}">
                                                                        <b class="text-10">{{strtoupper($cotizacion_cat_->nombre_pax)}}</b>
                                                                    </a>
                                                                </div>
                                                                <div class="col-1 bg-grey-goto text-center text-white mx-0 px-0">
                                                                    <b class="text-10">x{{$cotizacion_cat_->nropersonas}}</b>
                                                                </div>
                                                                <div class="col-1 bg-danger text-center text-white mx-0 px-0">
                                                                    <b class="text-10">{{$cotizacion_cat_->duracion}}d</b>
                                                                </div>
                                                                <div class="col-4 mx-0 pr-0">
                                                                    <b class="text-10">{{date_format(date_create($cotizacion_cat_->fecha), 'jS M Y')}}</b>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-3 border border-secondary d-none">
                <div class="row bg-secondary mx-0">
                    <div class="col-12 ">
                        <div class="row p-1">
                            <div class="col-3 px-0">
                                <b class="text-14 text-white">CLOSED</b>
                            </div>
                            <div class="col-9">
                                <select class="form-control" name="tipo_filtro" id="tipo_filtro" onchange="mostrar_filtro_reservas($(this).val(),'closed')">
                                    <option value="show-codigo-closed">Código</option>
                                    <option value="show-nombre-closed">Nombre</option>
                                    <option value="show-fechas-closed">Entre fechas</option>
                                    <option value="show-anio-mes-closed">Año-mes</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row bg-secondary mx-0 pb-1">
                    <div id="show-codigo-closed" class="col-12">
                        <div class="row px-0">
                            <div class="col-10 px-0">
                                <input form="nuevo_buscar_codigo" name="closed_codigo" id="closed_codigo" class="form-control" type="text" placeholder="Codigo">
                            </div>
                            <div class="col-2">
                                {{csrf_field()}}
                                <a href="#!" name="buscar" onclick="buscar_reserva($('#closed_codigo').val(),'','CLOSED','CODIGO')"><i class="fas fa-search fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                    <div id="show-nombre-closed" class="col-12 d-none">
                        <div class="row px-0">
                            <div class="col-10 px-0">
                                <input form="nuevo_buscar_nombre" name="closed_nombre" id="closed_nombre" class="form-control" type="text" placeholder="Nombre">
                            </div>
                            <div class="col-2">
                                <a href="#!" name="buscar" onclick="buscar_reserva($('#closed_nombre').val(),'','CLOSED','NOMBRE')"><i class="fas fa-search fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                    <div id="show-fechas-closed" class="col-12 d-none">
                        <div class="row px-0">
                            <div class="col-10 px-0">
                                <div class="row">
                                    <div class="col-6 mr-0 pr-0">
                                        <input form="nuevo_buscar_fecha" class="form-control" type="date" name="f_ini" id="f_ini_closed">
                                    </div>
                                    <div class="col-6 ml-0 pl-0">
                                        <input form="nuevo_buscar_fecha" class="form-control" type="date" name="f_fin" id="f_fin_closed">
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <a href="#!"  name="buscar" onclick="buscar_reserva($('#f_ini_closed').val(),$('#f_fin_closed').val(),'CLOSED','FECHAS')"><i class="fas fa-search fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                    <div id="show-anio-mes-closed" class="col-12 d-none">
                        <div class="row px-0">
                            <div class="col-10 px-0">
                                <div class="row">
                                    <div class="col-4 pr-0">
                                        <input form="nuevo_buscar_anio_mes" name="anio_closed" id="anio_closed" class="form-control" type="text" value="{{date("Y")}}">
                                    </div>
                                    <div class="col-8 pl-0">
                                        <select form="nuevo_buscar_anio_mes" name="mes_closed" id="mes_closed" class="form-control">
                                            <option value="01">ENERO</option>
                                            <option value="02">FEBRERO</option>
                                            <option value="03">MARZO</option>
                                            <option value="04">ABRIL</option>
                                            <option value="05">MAYO</option>
                                            <option value="06">JUNIO</option>
                                            <option value="07">JULIO</option>
                                            <option value="08">AGOSTO</option>
                                            <option value="09">SEPTIEMBRE</option>
                                            <option value="10">OCTUBRE</option>
                                            <option value="11">NOVIEMBRE</option>
                                            <option value="12">DICIEMBRE</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <a href="#!"  name="buscar" onclick="buscar_reserva($('#anio_closed').val(),$('#mes_closed').val(),'CLOSED','ANIO-MES')"><i class="fas fa-search fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12" id="CLOSED">
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
    <script>
        $(document).ready(function(){
            $('[data-toggle="popover"]').popover({
                html : true,
            });
        });
    </script>
@stop