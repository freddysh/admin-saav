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
                        <a href="#!" name="buscar" onclick="buscar_pagos($('#todos_codigo').val(),'','TODOS','CODIGO/NOMBRE','')"><i class="fas fa-search fa-2x text-white"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div id="TODOS" class="row mt-1 no-gutters">
            <div class="col-6 border border-danger">
                <div class="row bg-danger mx-0">
                    <div class="col-12 ">
                        <div class="row p-1">
                            <div class="col-3 px-0">
                                <b class="text-14 text-white">NEW</b>
                            </div>
                            <div class="col-4">
                                @php
                                    $mostrado=0;
                                @endphp
                                <select class="form-control" name="pagina" id="pagina_nuevo">
                                    @foreach ($webs->where('estado','1') as $item)
                                        <option value="{{$item->pagina}}" @if($mostrado==0) selected @endif>{{$item->pagina}}</option>  
                                        @php
                                            $mostrado++;
                                        @endphp
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-5">
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
                                <a href="#!" name="buscar" onclick="buscar_pagos($('#nuevo_codigo').val(),'','NUEVO','CODIGO',$('#pagina_nuevo').val())"><i class="fas fa-search fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                    <div id="show-nombre-nuevo" class="col-12 d-none">
                        <div class="row px-0">
                            <div class="col-10 px-0">
                                <input form="nuevo_buscar_nombre" name="nombre_nuevo" id="nombre_nuevo" class="form-control" type="text" placeholder="Nombre">
                            </div>
                            <div class="col-2">
                                <a href="#!" name="buscar" onclick="buscar_pagos($('#nombre_nuevo').val(),'','NUEVO','NOMBRE',$('#pagina_nuevo').val())"><i class="fas fa-search fa-2x text-white"></i></a>
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
                                <a href="#!"  name="buscar" onclick="buscar_pagos($('#f_ini_nuevo').val(),$('#f_fin_nuevo').val(),'NUEVO','FECHAS',$('#pagina_nuevo').val())"><i class="fas fa-search fa-2x text-white"></i></a>
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
                                <a href="#!"  name="buscar" onclick="buscar_pagos($('#anio_nuevo').val(),$('#mes_nuevo').val(),'NUEVO','ANIO-MES',$('#pagina_nuevo').val())"><i class="fas fa-search fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12" id="NUEVO">
                        <table class="table table-bordered table-striped table-responsive table-hover text-12">
                            <thead>
                                <tr>
                                    <th>PAX. <span class="text-success">(GOTOPERU.COM)</span></th>
                                    <th>TOTAL</th>
                                    <th>PAGADO</th>
                                    <th>SALDO</th>
                                    <th style="width:230px;">PROX. PAGO</th>
                                    <th>OPER.</th>
                                </tr>    
                            </thead>
                            <tbody>
                                @foreach($cotizacion_cat->where('anulado','>',0)/*->where('web','gotoperu.com')*/->sortBy('fecha') as $cotizacion_cat_)
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
                                @endphp
                
                                @foreach($cotizacion_cat_->paquete_cotizaciones as $paquete)
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
                                                @endphp
                                            @else
                                                @php
                                                    $precio_iti+=round($servicios->precio,2);
                                                    $preciom=round($servicios->precio,2);
                                                @endphp
                                            @endif
                                        @endforeach
                                        @foreach($itinerario->hotel as $hotel)
                                            @if($hotel->personas_s>0)
                                                @php
                                                    $precio_hotel_s+=$hotel->precio_s;
                
                                                @endphp
                                            @endif
                                            @if($hotel->personas_d>0)
                                                @php
                                                    $precio_hotel_d+=$hotel->precio_d/2;
                
                                                @endphp
                                            @endif
                                            @if($hotel->personas_m>0)
                                                @php
                                                    $precio_hotel_m+=$hotel->precio_m/2;
                
                                                @endphp
                                            @endif
                                            @if($hotel->personas_t>0)
                                                @php
                                                    $precio_hotel_t+=$hotel->precio_t/3;
                
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
                                        @endphp
                                    @endforeach
                                @elseif($nro_dias>1)
                                    @if(($s+$d+$m+$t)==0)
                                        @foreach($cotizacion_cat_->paquete_cotizaciones->take(1) as $paquete)
                                            @php
                                                $valor=$precio_iti+$paquete->utilidad;
                                            @endphp
                                        @endforeach
                                    @else
                                        @if($s!=0)
                                            @php
                                                $valor+=round($precio_hotel_s+$utilidad_s,2);
                                            @endphp
                                        @endif
                                        @if($d!=0)
                                            @php
                                                $valor+=round($precio_hotel_d+$utilidad_d,2);
                                            @endphp
                                        @endif
                                        @if($m!=0)
                                            @php
                                                $valor+=round($precio_hotel_m+$utilidad_m,2);
                                            @endphp
                                        @endif
                                        @if($t!=0)
                                            @php
                                                $valor+=round($precio_hotel_t+$utilidad_t,2);
                                            @endphp
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
                                            $proximo_monto='';
                                            $recogido=0;
                                        @endphp
                                        @foreach($pqts->pagos_cliente as $pagos_cliente)
                                            @if($pagos_cliente->estado==1)
                                                @php
                                                    $total_pagado+=$pagos_cliente->monto;
                                                @endphp
                                            @endif
                                            @if($recogido==0)
                                                @if($pagos_cliente->estado==0)
                                                    @php
                                                        $proximo_pago=$pagos_cliente->fecha;
                                                        $proximo_monto=$pagos_cliente->monto;
                                                        $recogido++;
                                                    @endphp
                                                @endif
                                            @endif
                                        @endforeach
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
                                        @if($valor-$total_pagado!=0)
                                            <tr>
                                                <td class="text-11"><b class="text-success">{{$cotizacion_cat_->codigo}}</b> | {{strtoupper($cotizacion_cat_->nombre_pax)}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'jS M Y')}}</td>
                                                <td class="text-right">{{number_format($valor,0)}}</td>
                                                <td class="text-right">{{number_format($total_pagado,0)}}</td>
                                                <td class="text-right">{{number_format($valor-$total_pagado,0)}}</td>
                                                <td>{{$proximo_pago}} | {{$proximo_monto}}</td>
                                                <td>
                                                    <a class="text-primary small" href="#!" id="archivos" data-toggle="modal" data-target="#myModal_plan_pagos_{{$pqts->id}}">Detalle
                                                    </a>
                                                    <div class="modal fade" id="myModal_plan_pagos_{{$pqts->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                            {{-- <form id="guardar_paquete_pagos_{{$pqts->id}}" action="{{route('guardar.paquete.pagos')}}" method="post"> --}}
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
                                                                                            <td style="width:180px;">{{$pagos_cliente->fecha}}</td>
                                                                                            <td>{{$pagos_cliente->nota}}</td>
                                                                                            <td style="width:100px">{{$pagos_cliente->monto}}</td>
                                                                                            <td>
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
                                                                                <input type="hidden" id="nro_pagos_{{$pqts->id}}" value="1">   
                                                                            </div>
                                                                        </div> 
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                        <button type="button" class="btn btn-primary d-none">Guardar</button>
                                                                    </div>
                                                                {{-- </form> --}}
                                                            </div>
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
    <script>
        $(document).ready(function(){
            $('[data-toggle="popover"]').popover({
                html : true,
            });
        });
    </script>
@stop