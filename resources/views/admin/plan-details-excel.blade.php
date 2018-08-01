@extends('layouts.admin.admin')
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Quotes</li>
            <li class="active">Current</li>
            <li class="active">Excel</li>
        </ol>
    </div>
    {{--<form action="{{route('package_cotizacion_save_path')}}" method="post" id="package_new_path_id">--}}
    <div class="row">
        <div class="col-lg-6">
            {{--<h3>{{$cliente->nombres}} {{$cliente->apellidos}}</h3>--}}
            @php
                $s=0;
                $d=0;
                $m=0;
                $t=0;
                $utilidad_s=0;
                $utilidad_d=0;
                $utilidad_m=0;
                $utilidad_t=0;
                $utilidad_por_s=0;
                $utilidad_por_d=0;
                $utilidad_por_m=0;
                $utilidad_por_t=0;
            @endphp
            @foreach($cotizaciones as $cotizacion)
                <b class="text-warning text-25">{{$cotizacion->nropersonas}} PAXS {{$cotizacion->star_2}}{{$cotizacion->star_3}}{{$cotizacion->star_4}}{{$cotizacion->star_5}} STARS:</b>
                @foreach($cotizacion->paquete_cotizaciones->where('id',$paquete_precio_id) as $paquete)
                    @foreach($paquete->paquete_precios as $precio)
                        <b class="text-unset text-20">
                            @if($precio->personas_s>0)
                                SINGLE
                                @php
                                    $s=1;
                                    $utilidad_s=$precio->utilidad_s;
                                    $utilidad_por_s=$precio->utilidad_por_s;
                                @endphp
                            @endif
                            @if($precio->personas_d>0)
                                DOUBLE
                                @php
                                    $d=1;
                                    $utilidad_d=$precio->utilidad_d;
                                    $utilidad_por_d=$precio->utilidad_por_d;
                                @endphp
                            @endif
                            @if($precio->personas_m>0)
                                MATRIMONIAL
                                @php
                                    $m=1;
                                    $utilidad_m=$precio->utilidad_m;
                                    $utilidad_por_m=$precio->utilidad_por_m;
                                @endphp
                            @endif
                            @if($precio->personas_t>0)
                                TRIPLE
                                @php
                                    $t=1;
                                    $utilidad_t=$precio->utilidad_t;
                                    $utilidad_por_t=$precio->utilidad_por_t;
                                @endphp
                            @endif
                        </b>
                    @endforeach
                @endforeach
            @endforeach
        </div>
        <div class="col-lg-6 hide">
            <div class="col-lg-2"></div>
            <div class="col-lg-1 caja_paso_activo text-30 text-center"><b>1</b></div>
            <div class="col-lg-1 caja_paso_noactivo text-30 text-center"><b>2</b></div>
            <div class="col-lg-2"></div>
        </div>
    </div>
    @php
        $nroPersonas=0;
        $nro_dias=0;
        $precio_iti=0;
        $precio_hotel_s=0;
        $precio_hotel_d=0;
        $precio_hotel_m=0;
        $precio_hotel_t=0;
        $cotizacion_id='';

    @endphp
    @foreach($cotizaciones as $cotizacion)
        @php
            $cotizacion_id=$cotizacion->id;
        @endphp
        @foreach($cotizacion->paquete_cotizaciones->where('id',$paquete_precio_id) as $paquete)
            @foreach($paquete->itinerario_cotizaciones as $itinerario)
                <div class="row caja_items">
                    <div class="col-lg-1 caja_dia_indice">
                        DAY {{$itinerario->dias}}
                    </div>
                    <div class="col-lg-9">
                        <div class="row caja_dia">
                            <div class="col-lg-7">{{$itinerario->titulo}}</div>
                            <div class="col-lg-1 @if($s==0) hide @endif">S</div>
                            <div class="col-lg-1 @if($d==0) hide @endif">D</div>
                            <div class="col-lg-1 @if($m==0) hide @endif">M</div>
                            <div class="col-lg-1 @if($t==0) hide @endif">T</div>
                            <div class="col-lg-2 hide"></div>
                        </div>
                        <div class="row caja_detalle">
                            @php
                                $rango='';
                            @endphp

                            @foreach($itinerario->itinerario_servicios as $servicios)
                                @php
                                    $preciom=0;
                                @endphp
                                {{--@if($servicios->precio_grupo==1)--}}
                                {{--@php--}}
                                {{--$precio_iti+=($servicios->precio/2)/$cotizacion->nropersonas;--}}
                                {{--$preciom=($servicios->precio/2)/$cotizacion->nropersonas;--}}
                                {{--@endphp--}}
                                {{--@else--}}
                                @if($servicios->min_personas<= $cotizacion->nropersonas&&$cotizacion->nropersonas <=$servicios->max_personas)
                                @else
                                    @php
                                        $rango=' ';
                                    @endphp

                                @endif
                                @if($servicios->precio_grupo==1)
                                    @php
                                        $precio_iti+=round($servicios->precio/$cotizacion->nropersonas,1);
                                        $preciom=round($servicios->precio/$cotizacion->nropersonas,1);
                                    @endphp
                                @else
                                    @php
                                        $precio_iti+=round($servicios->precio,1);
                                        $preciom=round($servicios->precio,1);
                                    @endphp
                                @endif
                                {{--@endif--}}
                                <div class="row" id="lista_servicios_{{$servicios->id}}">
                                    <div class="col-lg-7">
                                        <div class="row">
                                            <div class="col-lg-10{{$rango}}">{{$servicios->nombre}}</div>

                                        </div>
                                    </div>
                                    <div class="col-lg-1 @if($s==0) hide @endif">$<input type="hidden" class="precio_servicio_s" value="{{explode('.00',$preciom)[0]}}">{{explode('.00',$preciom)[0]}}</div>
                                    <div class="col-lg-1 @if($d==0) hide @endif">$<input type="hidden" class="precio_servicio_d" value="{{explode('.00',$preciom)[0]}}">{{explode('.00',$preciom)[0]}}</div>
                                    <div class="col-lg-1 @if($m==0) hide @endif">$<input type="hidden" class="precio_servicio_d" value="{{explode('.00',$preciom)[0]}}">{{explode('.00',$preciom)[0]}}</div>
                                    <div class="col-lg-1 @if($t==0) hide @endif">$<input type="hidden" class="precio_servicio_t" value="{{explode('.00',$preciom)[0]}}">{{explode('.00',$preciom)[0]}}</div>
                                    <div class="col-lg-1 hide">
                                        <a class="btn" data-toggle="modal" data-target="#modal_new_destination1_{{$servicios->id}}">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>
                                        <!-- Modal -->
                                        <div class="modal fade bd-example-modal-lg" id="modal_new_destination1_{{$servicios->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <form action="{{route('destination_save_path')}}" method="post" id="destination_save_id" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Editar Servicio</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @php
                                                                $grupo='';
                                                                $loca='';
                                                            @endphp
                                                            @foreach($m_servicios->where('id',$servicios->m_servicios_id) as $servicio)
                                                                @php
                                                                    $grupo=$servicio->grupo;
                                                                    $loca=$servicio->localizacion;
                                                                @endphp
                                                            @endforeach
                                                            @foreach($m_servicios->where('grupo',$grupo)->where('localizacion',$loca) as $servicio)
                                                                <p>{{$servicio->nombre}} {{$servicio->tipoServicio}}</p>

                                                            @endforeach
                                                        </div>
                                                        <div class="modal-footer">
                                                            {{csrf_field()}}
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1 hide">
                                        <b class="text-danger puntero" onclick="borrar_serv_quot_paso1('{{$servicios->id}}','{{$servicios->nombre}}')">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </b>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @foreach($itinerario->hotel as $hotel)
                            @if($hotel->personas_s>0)
                                @php
                                    $precio_hotel_s+=$hotel->precio_s;
                                    $utilidad_s=intval($hotel->utilidad_s);
                                    $utilidad_por_s=$hotel->utilidad_por_s;
                                @endphp
                            @endif
                            @if($hotel->personas_d>0)
                                @php
                                    $precio_hotel_d+=$hotel->precio_d/2;
                                    $utilidad_d=intval($hotel->utilidad_d);
                                    $utilidad_por_d=$hotel->utilidad_por_d;
                                @endphp
                            @endif
                            @if($hotel->personas_m>0)
                                @php
                                    $precio_hotel_m+=$hotel->precio_m/2;
                                    $utilidad_m=intval($hotel->utilidad_m);
                                    $utilidad_por_m=$hotel->utilidad_por_m;
                                @endphp
                            @endif
                            @if($hotel->personas_t>0)
                                @php
                                    $precio_hotel_t+=$hotel->precio_t/3;
                                    $utilidad_t=intval($hotel->utilidad_t);
                                    $utilidad_por_t=$hotel->utilidad_por_t;
                                @endphp
                            @endif
                            <div class="row caja_detalle_hotel margin-bottom-15">
                                <div class="col-lg-7">
                                    <div class="row">
                                        <div class="col-lg-10">HOTEL</div>

                                    </div>
                                </div>
                                <div class="col-lg-1 @if($hotel->personas_s==0) hide @endif">${{explode('.00',$hotel->precio_s)[0]}}</div>
                                <div class="col-lg-1 @if($hotel->personas_d==0) hide @endif">${{explode('.00',$hotel->precio_d)[0]/2}}</div>
                                <div class="col-lg-1 @if($hotel->personas_m==0) hide @endif">${{explode('.00',$hotel->precio_m)[0]/2}}</div>
                                <div class="col-lg-1 @if($hotel->personas_t==0) hide @endif">${{explode('.00',$hotel->precio_t)[0]/3}}</div>
                                <input type="hidden" class="precio_servicio_s_h" value="{{explode('.00',$hotel->precio_s)[0]}}">
                                <input type="hidden" class="precio_servicio_d_h" value="{{explode('.00',$hotel->precio_d)[0]/2}}">
                                <input type="hidden" class="precio_servicio_m_h" value="{{explode('.00',$hotel->precio_m)[0]/2}}">
                                <input type="hidden" class="precio_servicio_t_h" value="{{explode('.00',$hotel->precio_t)[0]/3}}">
                                <div class="col-lg-2 hide">
                                    <a class="btn" data-toggle="modal" data-target="#modal_new_destination_{{$hotel->id}}">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </a>
                                    <!-- Modal -->
                                    <div class="modal fade bd-example-modal-lg" id="modal_new_destination_{{$hotel->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <form action="{{route('destination_save_path')}}" method="post" id="destination_save_id" enctype="multipart/form-data">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">New destination</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                    </div>
                                                    <div class="modal-footer">
                                                        {{csrf_field()}}
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="col-lg-6 hide">
                        <textarea name="" id="" cols="70" rows="8">{{$itinerario->descripcion}}</textarea>
                    </div>
                </div>
            @endforeach
        @endforeach
    @endforeach
    @php
        $precio_hotel_s+=$precio_iti;
        $precio_hotel_d+=$precio_iti;
        $precio_hotel_m+=$precio_iti;
        $precio_hotel_t+=$precio_iti;
    @endphp
    <form action="{{route('editar_cotizacion1_path')}}" method="post">
        <div class="row">
            <div class="col-lg-12 hide">
                <div class="col-lg-1">
                </div>
                <div class="col-lg-9">
                    <div class="row caja_dia">
                        <div class="col-lg-7"><b>COST</b></div>
                        <div class="col-lg-1 text-warning @if($s==0) hide @endif"><b>$<span id="cost_s">{{ceil($precio_hotel_s)}}</span></b></div>
                        <div class="col-lg-1 text-warning @if($d==0) hide @endif"><b>$<span id="cost_d">{{ceil($precio_hotel_d)}}</span></b></div>
                        <div class="col-lg-1 text-warning @if($m==0) hide @endif"><b>$<span id="cost_d">{{ceil($precio_hotel_m)}}</span></b></div>
                        <div class="col-lg-1 text-warning @if($t==0) hide @endif"><b>$<span id="cost_t">{{ceil($precio_hotel_t)}}</span></b></div>
                        <div class="col-lg-2"></div>
                    </div>
                    <div class="col-lg-12 text-right text-warninggit add -">PRICE PER PERSON</div>
                </div>
                <div class="col-lg-6 text-right hide">
                    {{csrf_field()}}
                    <input type="hidden" name="paquete_precio_id" value="{{$paquete_precio_id}}">
                    <input type="hidden" name="cotizacion_id" value="{{$cotizacion_id}}">
                    <input type="hidden" name="imprimir" value="no">
                    <button class="btn btn-warning btn-lg" type="submit" name="create">CREATE</button>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row hide">
                    <div class="col-lg-4">
                        <b CLASS="text-warning text-15">PRICE PER PERSON</b>
                    </div>
                    <div class="col-lg-3 @if($s==0) hide @endif">
                        <b CLASS="text-unset text-15">SINGLE</b>
                    </div>
                    <div class="col-lg-3 @if($d==0) hide @endif">
                        <b CLASS="text-unset text-15">DOUBLE</b>
                    </div>
                    <div class="col-lg-3 @if($m==0) hide @endif">
                        <b CLASS="text-unset text-15">MATRINONIAL</b>
                    </div>
                    <div class="col-lg-3 @if($t==0) hide @endif">
                        <b CLASS="text-unset text-15">TRIPLE</b>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-lg-1">
                        <b CLASS="text-warning text-15">COST</b>
                    </div>
                    <div class="col-lg-9">
                        <div class="col-lg-7"></div>
                        <div class="col-lg-1 @if($s==0) hide @endif">
                            <b CLASS="text-unset text-15">$<span name="cost_s" id="cost_s">{{ceil($precio_hotel_s)}}</span></b>
                        </div>
                        <div class="col-lg-1 @if($d==0) hide @endif">
                            <b CLASS="text-unset text-15">$<span name="cost_d" id="cost_d">{{ceil($precio_hotel_d)}}</span></b>
                        </div>
                        <div class="col-lg-1 @if($m==0) hide @endif">
                            <b CLASS="text-unset text-15">$<span name="cost_m" id="cost_m">{{ceil($precio_hotel_m)}}</span></b>
                        </div>
                        <div class="col-lg-1 @if($t==0) hide @endif">
                            <b CLASS="text-unset text-15">$<span name="cost_t" id="cost_t">{{ceil($precio_hotel_t)}}</span></b>
                        </div>
                    </div>
                </div>
                <div class="row linea">
                    <div class="col-lg-1">
                        <b CLASS="text-warning text-15">PROFIT</b>
                    </div>
                    <div class="col-lg-9">
                        <div class="col-lg-7"></div>
                        <div class="col-lg-1 @if($s==0) hide @endif">
                            <span name="pro_s" id="pro_s">${{round($utilidad_s,0)}}</span>
                            <p><b CLASS="text-warning text-15"><span id="porc_s">{{$utilidad_por_s}}</span>%</b></p>
                        </div>
                        <div class="col-lg-1 @if($d==0) hide @endif">
                            <span name="pro_d" id="pro_d">${{round($utilidad_d,0)}}</span>
                            <p><b CLASS="text-warning text-15"><span id="porc_d">{{$utilidad_por_d}}</span>%</b></p>
                        </div>
                        <div class="col-lg-1 @if($m==0) hide @endif">
                            <span name="pro_m" id="pro_m">${{round($utilidad_m,0)}}</span>
                            <p><b CLASS="text-warning text-15"><span id="porc_m">{{$utilidad_por_m}}</span>%</b></p>
                        </div>
                        <div class="col-lg-1 @if($t==0) hide @endif">
                            <span name="pro_t" id="pro_t" >${{round($utilidad_t,0)}}</span>
                            <p><b CLASS="text-warning text-15"><span id="porc_t">{{$utilidad_por_t}}</span>%</b></p>
                        </div>
                    </div>
                </div>
                <div class="row ">
                    @php
                        $valor=0;
                    @endphp
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
                    <div class="col-lg-1">
                        <b CLASS="text-warning text-15">SALES</b>
                    </div>
                    <div class="col-lg-9">
                        <div class="col-lg-7"></div>
                        <div class="col-lg-1 @if($s==0) hide @endif">
                            <span name="sale_s" id="sale_s"> @if($s!=0){{round(ceil($precio_hotel_s)+$utilidad_s,2)}}@else{{0}}@endif</span>
                        </div>
                        <div class="col-lg-1 @if($d==0) hide @endif">
                            <span name="sale_d" id="sale_d"> @if($d!=0){{round(ceil($precio_hotel_d)+$utilidad_d,2)}}@else{{0}}@endif</span>
                        </div>
                        <div class="col-lg-1 @if($m==0) hide @endif">
                            <span name="sale_m" id="sale_m"> @if($m!=0){{round(ceil($precio_hotel_m)+$utilidad_m,2)}}@else{{0}}@endif</span>
                        </div>
                        <div class="col-lg-1 @if($t==0) hide @endif">
                            <span name="sale_t" id="sale_t"> @if($t!=0){{round(ceil($precio_hotel_t)+$utilidad_t,2)}}@else{{0}}@endif</span>
                        </div>
                    </div>
                </div>
                <div class="row text-center">

                    <div class="text-center col-lg-12 total_profit">
                        <div class="col-lg-2"><b>TOTAL PROFIT</b></div>
                        <div class="text-15">$<b id="total_profit">{{ceil($valor)}}</b></div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function() {
            calcular_resumen();
        } );
    </script>
@stop