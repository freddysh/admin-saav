@extends('layouts.admin.admin')
@section('archivos-js')
    <script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
@stop
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white m-0">
            <li class="breadcrumb-item" aria-current="page"><a href="/">Home</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="/">Qoutes</a></li>
            <li class="breadcrumb-item active">New</li>
        </ol>
    </nav>
    <hr>
    {{--<form action="{{route('package_cotizacion_save_path')}}" method="post" id="package_new_path_id">--}}
    @php
        $cliente='';
        $paquete_id=$paquete_precio_id;
        $paquete_precio_id1=0;
        $paquete_precio_s=0;
        $paquete_precio_d=0;
        $paquete_precio_m=0;
        $paquete_precio_t=0;
        $titulo='';
        $descr='';
        $include='';
        $no_include='';
        $cliente_id=0;
        $duracion=0;
    @endphp

    @foreach($cotizaciones as $cotizacion)
        @php
            $cliente=$cotizacion->nombre_pax;
        @endphp
        @foreach($cotizacion->cotizaciones_cliente->where('estado','1') as $coti_cliente)
            @php
                // $cliente=$coti_cliente->cliente->nombres.' '.$coti_cliente->cliente->apellidos;
                $cliente_id=$coti_cliente->cliente->id;
            @endphp
        @endforeach
    @endforeach
        <div class="row align-items-center">
        <div class="col-6">
            <h3>{{$cliente}}</h3>
            @php
                $s=0;
                $d=0;
                $m=0;
                $t=0;
            @endphp
            @foreach($cotizaciones as $cotizacion)
                @php
                    $cotizacion_id=$cotizacion->id;
                @endphp
                <p class="text-18">Web:<b class="text-info">{{$cotizacion->web}}</b> | Codigo:<b class="text-info">{{$cotizacion->codigo}}</b> | Idioma:<b class="text-info">{{$cotizacion->idioma_pasajeros}}</b></p>
                <b class="text-warning h2">{{$cotizacion->nropersonas}} PAXS {{$cotizacion->star_2}}{{$cotizacion->star_3}}{{$cotizacion->star_4}}{{$cotizacion->star_5}} <i class="fa fa-star" aria-hidden="true"></i>:</b>
                @foreach($cotizacion->paquete_cotizaciones->where('id',$paquete_precio_id) as $paquete)
                    @php
                    $duracion=$paquete->duracion;
                    @endphp
                    @if($paquete->duracion==1)
                        <b class="text-secondary h2"> SIN HOTEL</b>
                    @else
                        @foreach($paquete->paquete_precios as $precio)
                            <b class="text-secondary h2">
                                @if($precio->personas_s>0)
                                    SINGLE
                                    @php
                                        $s=1;
                                    @endphp
                                @endif
                                @if($precio->personas_d>0)
                                    DOUBLE
                                    @php
                                        $d=1;
                                    @endphp
                                @endif
                                @if($precio->personas_m>0)
                                    MATRIMONIAL
                                    @php
                                        $m=1;
                                    @endphp
                                @endif
                                @if($precio->personas_t>0)
                                    TRIPLE
                                    @php
                                        $t=1;
                                    @endphp
                                @endif
                            </b>
                        @endforeach
                        @if(($s+$d+$m+$t)==0)
                            <b class="text-secondary h2"> SIN HOTEL</b>
                        @endif
                    @endif
                @endforeach
            @endforeach
        </div>
        <div class="col-6">
            <div class="row align-items-center">
                <div class="col-6">
                    <div class="row">
                        <div class="col caja_paso_noactivo text-30 text-center">
                            <a href="{{route('show_current_paquete_edit_path',$paquete_id)}}" class="caja_paso_noactivo_ no_stilo">1</a>
                            
                            {{-- <a href="{{route('show_step1_path',[$cliente_id,$cotizacion_id,$paquete_id,'nuevo'])}}" class="caja_paso_noactivo_ no_stilo">1</a> --}}
                            {{--<b>1</b>--}}
                        </div>
                        <div class="col caja_paso_activo text-30 text-center">
                            <a href="#!" class="caja_paso_activo_ no_stilo">2</a>
                            {{--<b>2</b>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    @php
        $nroPersonas=0;
        $nro_dias=0;
        $precio_iti=0;
        $precio_hotel_s=0;
        $precio_hotel_d=0;
        $precio_hotel_m=0;
        $precio_hotel_t=0;
        $plan[1]='PLAN A';
        $plan[2]='PLAN B';
        $plan[3]='PLAN C';
        $plan[4]='PLAN D';
        $plan[5]='PLAN E';
        $plan[6]='PLAN F';
        $plan[7]='PLAN G';
        $pos_plan=1;
        $dias=1;
        $codigo='';
        $destinos1=array();
        $cotizacion_id1=0;
    @endphp
    {{--{{dd($cotizaciones)}}--}}
    <form action="{{route('save_new_package_path')}}" method="post">
        @foreach($cotizaciones as $cotizacion)
            @php
                $cotizacion_id1=$cotizacion->id;
                $pos_plan=count($cotizacion->paquete_cotizaciones);
                $dias=$cotizacion->duracion;
            @endphp
            @foreach($cotizacion->paquete_cotizaciones->where('id',$paquete_precio_id) as $paquete)
                @php
                    $titulo=$paquete->titulo;
                    $descr=$paquete->descripcion;
                    $include=$paquete->incluye;
                    $no_include=$paquete->noincluye;
                @endphp
                @foreach($paquete->paquete_precios as $precio)
                    @if(($precio->personas_s+$precio->personas_d+$precio->personas_m+$precio->personas_t)>0)
                        @php
                            $paquete_precio_id1=$precio->id;
                            $paquete_precio_s=$precio->precio_s;
                            $paquete_precio_d=$precio->precio_d;
                            $paquete_precio_m=$precio->precio_m;
                            $paquete_precio_t=$precio->precio_t;
                        @endphp
                    @endif
                @endforeach
                @php
                    $codigo=$paquete->codigo
                @endphp
                @php
                    $array_destinos[]=null
                @endphp
                @foreach($paquete->itinerario_cotizaciones as $itinerarios_destino)
                    @foreach($itinerarios_destino->itinerario_destinos as $destino)
                        @if(in_array($destino->destino,$array_destinos))
                        @else
                            @php
                                $array_destinos[]=$destino->destino;
                            @endphp
                        @endif
                    @endforeach
                @endforeach

            @endforeach
        @endforeach
        <div class="row">
            <div class="col text-center">
                <p class="text-center h2 text-g-green"><b>{{$plan[$pos_plan]}}</b></p>
                <p class="text-center m-0"><b>{{$codigo}} | {{$dias}} DAYS</b></p>
                {{--<p class="text-20"><b></b></p>--}}
                {{--<i class="fa fa-map-marker-alt" aria-hidden="true"></i>--}}
                @foreach($array_destinos as $destino)
                    @if($destino!=null)
                        {{--<div class="col-md-4">--}}
                        {{--<div class="checkbox1">--}}
                        <small class="text-primary">
                            {{--<input class="destinospack" type="checkbox" name="destinos[]" checked="checked">--}}
                            {{ucwords(strtolower($destino))}} <span class="text-warning">|</span>
                        </small>
                        {{--</div>--}}
                        {{--</div>--}}
                    @endif
                @endforeach
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="txt_country" class="font-weight-bold text-secondary">Title</label>
                            <input type="text" class="form-control" id="txt_titulo" name="txt_titulo" placeholder="Titulo" value="{{$titulo}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="txt_country" class="font-weight-bold text-secondary">Description</label>
                            <textarea class="form-control" name="descripcion" id="descripcion" cols="10" rows="5">{{$descr}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="txt_country" class="font-weight-bold text-secondary">Include</label>
                            <textarea class="form-control" name="incluye" id="incluye" cols="10" rows="5">{{$include}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                    <div class="form-group">
                        <label for="txt_country" class="font-weight-bold text-secondary">not Include</label>
                        <textarea class="form-control" name="no_incluye" id="no_incluye" cols="10" rows="5">{{$no_include}}</textarea>
                    </div>
                </div>
                </div>

            </div>
            <div class="col-lg-6 py-1">
                <div class="sticky-top py-4">
                @php
                    $nroPersonas=0;
                    $nro_dias=0;
                    $pre_sh=0;
                    $pre_s=0;
                    $pre_d=0;
                    $pre_m=0;
                    $pre_t=0;
                    $cotizacion_id='';
                    $utilidad=0;
                    $utilidad_s=0;
                    $utilidad_d=0;
                    $utilidad_m=0;
                    $utilidad_t=0;
                    $prem_sh=0;
                    $prem_s=0;
                    $prem_d=0;
                    $prem_m=0;
                    $prem_t=0;
                    $utilidad_por_s=0;
                    $utilidad_por_d=0;
                    $utilidad_por_m=0;
                    $utilidad_por_t=0;
                @endphp
                @foreach($cotizaciones as $cotizacion)
                    @foreach($cotizacion->paquete_cotizaciones->where('id',$paquete_precio_id) as $paquete)
                        {{--@foreach($paquete->paquete_precios as $precio)--}}
                            {{--@if($precio->personas_s>0)--}}
                                {{--@php--}}
                                    {{--$s=1;--}}
                                {{--@endphp--}}
                            {{--@endif--}}
                            {{--@if($precio->personas_d>0)--}}
                                {{--@php--}}
                                    {{--$d=1;--}}
                                {{--@endphp--}}
                            {{--@endif--}}
                            {{--@if($precio->personas_m>0)--}}
                                {{--@php--}}
                                    {{--$m=1;--}}
                                {{--@endphp--}}
                            {{--@endif--}}
                            {{--@if($precio->personas_t>0)--}}
                                {{--@php--}}
                                    {{--$t=1;--}}
                                {{--@endphp--}}
                            {{--@endif--}}
                        {{--@endforeach--}}
                        @if($duracion==1||($s+$d+$m+$t)==0)
                            @php
                                $utilidad=$paquete->utilidad;
                            @endphp
                        @endif
                        @php
                            $pos=0;
                        @endphp
                        @foreach($paquete->itinerario_cotizaciones->sortBy('dias') as $itinerario)
                            @php
                            $precio_hotel_s=0;
                            $precio_hotel_d=0;
                            $precio_hotel_m=0;
                            $precio_hotel_t=0;
                            @endphp
                            @foreach($itinerario->hotel as $hotel)
                                @php
                                    $pos++;
                                @endphp
                                @if($hotel->personas_s>0)
                                    @php
                                        $precio_hotel_s=$hotel->precio_s;
                                        $utilidad_s=$hotel->utilidad_s;
                                        $utilidad_por_s=$hotel->utilidad_por_s;
                                    @endphp
                                @endif
                                @if($hotel->personas_d>0)
                                    @php
                                        $precio_hotel_d=$hotel->precio_d/2;
                                        $utilidad_d=$hotel->utilidad_d;
                                        $utilidad_por_d=$hotel->utilidad_por_d;
                                    @endphp
                                @endif
                                @if($hotel->personas_m>0)
                                    @php
                                        $precio_hotel_m=$hotel->precio_m/2;
                                        $utilidad_m=$hotel->utilidad_m;
                                        $utilidad_por_m=$hotel->utilidad_por_m;
                                    @endphp
                                @endif
                                @if($hotel->personas_t>0)
                                    @php
                                        $precio_hotel_t=$hotel->precio_t/3;
                                        $utilidad_t=$hotel->utilidad_t;
                                        $utilidad_por_t=$hotel->utilidad_por_t;
                                    @endphp
                                @endif
                            @endforeach
                            @php
                                $precio=0;
                            @endphp
                            @foreach($itinerario->itinerario_servicios as $servicios)
                                @if($servicios->precio_grupo==1)
                                    @php
                                        $precio+=round($servicios->precio/$cotizacion->nropersonas,2);
                                    @endphp
                                @else
                                    @php
                                        $precio+=round($servicios->precio,2);
                                    @endphp
                                @endif
                            @endforeach
                            @php
                                $precio_iti+=$precio;
                                $pre_s=$precio+$precio_hotel_s;
                                $prem_s+=$pre_s;

                                $pre_d=$precio+$precio_hotel_d;
                                $prem_d+=$pre_d;

                                $pre_m=$precio+$precio_hotel_m;
                                $prem_m+=$pre_m;

                                $pre_t=$precio+$precio_hotel_t;
                                $prem_t+=$pre_t;
                                $pre_sh=$precio;
                                $prem_sh+=$pre_sh;
                            @endphp
                            <div id="itinerario_" class="bg-dark text-white p-2 rounded small mb-2">
                                   
                                <div class="row">
                                    <div class="col-7">
                                        <div class="row">
                                            <div class="col-12">
                                                @foreach($itinerario->itinerario_destinos as $destino)
                                                    <b class="dias text-warning">{{ucwords(strtolower($destino->destino))}}</b> |
                                                @endforeach
                                            </div>
                                            <div class="col-12">
                                                <b class="dias" id="dias_"+total_Itinerarios+>Dia {{$itinerario->dias}}: </b> {{ucwords(strtolower($itinerario->titulo))}}
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="col text-right">
                                        <div class="row">
                                            <div class="col @if($duracion>1) @if($s==0) d-none @endif @else d-none @endif">
                                                <b><sup>$</sup> {{round($pre_s,2)}}</b>
                                            </div>
                                            <div class="col @if($duracion>1) @if($d==0) d-none @endif @else d-none @endif">
                                                <b><sup>$</sup> {{round($pre_d,2)}}</b>
                                            </div>
                                            <div class="col @if($duracion>1) @if($m==0) d-none @endif @else d-none @endif">
                                                <b><sup>$</sup> {{round($pre_m,2)}}</b>
                                            </div>
                                            <div class="col @if($duracion>1) @if($t==0) d-none @endif @else d-none @endif">
                                                <b><sup>$</sup> {{round($pre_t,2)}}</b>
                                            </div>
                                            <div class="col @if($duracion==1||($duracion>1&&($s+$d+$m+$t)==0)) nada @else d-none @endif">
                                                <b><sup>$</sup> {{round($pre_sh,2)}}</b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @foreach($itinerario->itinerario_destinos as $destinos)
                                @php
                                    $destinos1[]=$destinos->destino;
                                @endphp
                            @endforeach
                        @endforeach
                    @endforeach
                @endforeach

                @php
                    $precio_hotel_s+=$precio_iti;
                    $precio_hotel_d+=$precio_iti;
                    $precio_hotel_m+=$precio_iti;
                    $precio_hotel_t+=$precio_iti;
                @endphp

                <div class="col-12">
                    <div class="row text-right">
                        <div class="col-7 text-left">
                            <b class="">PRICE PER PERSON</b>
                        </div>
                        {{--<div class="col-sm-6">--}}
                            <div class="col @if($duracion>1) @if($s==0) d-none @endif @else d-none @endif">
                                <b class="text-secondary">S</b>
                            </div>
                            <div class="col @if($duracion>1) @if($d==0) d-none @endif @else d-none @endif">
                                <b class="text-secondary">D</b>
                            </div>
                            <div class="col @if($duracion>1) @if($m==0) d-none @endif @else d-none @endif">
                                <b class="text-secondary">M</b>
                            </div>
                            <div class="col @if($duracion>1) @if($t==0) d-none @endif @else d-none @endif">
                                <b class="text-secondary">T</b>
                            </div>
                            <div class="col @if($duracion==1||($duracion>1&&($s+$d+$m+$t)==0)) nada @else d-none @endif">
                                <b class="text-secondary">SIN HOTEL</b>
                            </div>
                        {{--</div>--}}
                    </div>
                    <div class="row text-right">
                        <div class="col-7 text-left">
                            <b class="text-warning">COST</b>
                        </div>
                        {{--<div class="col-sm-6">--}}
                            <div class="col @if($duracion>1) @if($s==0) d-none @endif @else d-none @endif">
                                <b class="text-secondary"><sup>$</sup><span name="cost_s" id="cost_s">{{round($prem_s,2)}}</span></b>
                            </div>
                            <div class="col @if($duracion>1) @if($d==0) d-none @endif @else d-none @endif">
                                <b class="text-secondary"><sup>$</sup><span name="cost_d" id="cost_d">{{round($prem_d,2)}}</span></b>
                            </div>
                            <div class="col @if($duracion>1) @if($m==0) d-none @endif @else d-none @endif">
                                <b class="text-secondary"><sup>$</sup><span name="cost_m" id="cost_m">{{round($prem_m,2)}}</span></b>
                            </div>
                            <div class="col @if($duracion>1) @if($t==0) d-none @endif @else d-none @endif">
                                <b class="text-secondary"><sup>$</sup><span name="cost_t" id="cost_t">{{round($prem_t,2)}}</span></b>
                            </div>
                            <div class="col @if($duracion==1||($duracion>1&&($s+$d+$m+$t)==0)) nada @else d-none @endif">
                                <b class="text-secondary"><sup>$</sup><span name="cost_sh" id="cost_sh">{{round($prem_sh,2)}}</span></b>
                            </div>
                        {{--</div>--}}
                    </div>
                    <div class="row text-right">
                        <div class="col-7 text-left">
                            <b class="text-secondary">PROFIT</b>
                        </div>
                        {{--<div class="col-sm-6">--}}
                            <div class="col @if($duracion>1) @if($s==0) d-none @endif @else d-none @endif">
                                <input class="form-control text-right" type="text" name="pro_s" id="pro_s" value="{{$utilidad_s}}" onchange="variar_profit('s')">
                                <b class="text-secondary"><span id="porc_s">{{$utilidad_por_s}}</span>%</b>
                            </div>
                            <div class="col @if($duracion>1) @if($d==0) d-none @endif @else d-none @endif">
                                <input class="form-control text-right" type="text" name="pro_d" id="pro_d" value="{{$utilidad_d}}" onchange="variar_profit('d')">
                                <b class="text-secondary"><span id="porc_d">{{$utilidad_por_d}}</span>%</b>
                            </div>
                            <div class="col @if($duracion>1) @if($m==0) d-none @endif @else d-none @endif">
                                <input class="form-control text-right" type="text" name="pro_m" id="pro_m" value="{{$utilidad_m}}" onchange="variar_profit('m')">
                                <b class="text-secondary"><span id="porc_m">{{$utilidad_por_m}}</span>%</b>
                            </div>
                            <div class="col @if($duracion>1) @if($t==0) d-none @endif @else d-none @endif">
                                <input class="form-control text-right" type="text" name="pro_t" id="pro_t" value="{{$utilidad_t}}" onchange="variar_profit('t')">
                                <b class="text-secondary"><span id="porc_t">{{$utilidad_por_t}}</span>%</b>
                            </div>
                            <div class="col @if($duracion==1||($duracion>1&&($s+$d+$m+$t)==0)) nada @else d-none @endif">
                                <input class="form-control text-right" type="text" name="pro_sh" id="pro_sh" value="{{$utilidad}}" onchange="variar_profit('sh')">
                                <b class="text-secondary"><span id="porc_sh">{{round(($utilidad*100)/($prem_sh),2)}}</span>%</b>
                            </div>
                        {{--</div>--}}
                    </div>
                    <hr>
                    <div class="row ">
                        @php
                            $valor=0;
                        @endphp
                        @if($duracion==1)
                            @php
                                $valor+=round($prem_sh+$utilidad,2);
                            @endphp
                        @else
                            @if(($s+$d+$m+$t)==0)
                                @php
                                    $valor+=round($prem_sh+$utilidad,2);
                                @endphp
                            @else
                                @if($s!=0)
                                    @php
                                        $valor+=round($prem_s+$utilidad_s,2);
                                    @endphp
                                @endif
                                @if($d!=0)
                                    @php
                                        $valor+=round($prem_d+$utilidad_d,2);
                                    @endphp
                                @endif
                                @if($m!=0)
                                    @php
                                        $valor+=round($prem_m+$utilidad_m,2);
                                    @endphp
                                @endif
                                @if($t!=0)
                                    @php
                                        $valor+=round($prem_t+$utilidad_t,2);
                                    @endphp
                                @endif
                            @endif
                        @endif


                        <div class="col-7">
                            <b class="text-warning text-15">SALES</b>
                        </div>
                        <div class="col @if($duracion>1) @if($s==0) d-none @endif @else d-none @endif">
                            <input class="form-control text-right" type="text" name="sale_s" id="sale_s" value="@if($s!=0){{round(round($prem_s,2)+$utilidad_s,2)}}@else{{0}}@endif" onchange="variar_sales('s')">
                        </div>
                        <div class="col @if($duracion>1) @if($d==0) d-none @endif @else d-none @endif">
                            <input class="form-control text-right" type="text" name="sale_d" id="sale_d" value="@if($d!=0){{round(round($prem_d,2)+$utilidad_d,2)}}@else{{0}}@endif" onchange="variar_sales('d')">
                        </div>
                        <div class="col @if($duracion>1) @if($m==0) d-none @endif @else d-none @endif">
                            <input class="form-control text-right" type="text" name="sale_m" id="sale_m" value="@if($m!=0){{round(round($prem_m,2)+$utilidad_m,2)}}@else{{0}}@endif" onchange="variar_sales('m')">
                        </div>
                        <div class="col @if($duracion>1) @if($t==0) d-none @endif @else d-none @endif">
                            <input class="form-control text-right" type="text" name="sale_t" id="sale_t" value="@if($t!=0){{round(round($prem_t,2)+$utilidad_t,2)}}@else{{0}}@endif" onchange="variar_sales('t')">
                        </div>
                        <div class="col @if($duracion==1||($duracion>1&&($s+$d+$m+$t)==0)) nada @else d-none @endif">
                            <input class="form-control text-right" type="text" name="sale_sh" id="sale_sh" value="@if($duracion==1||($duracion>1&&$s==0&&$s==0&&$d==0&&$m==0&&$t==0)){{round(round($prem_sh,2)+$utilidad,2)}}@else{{0}}@endif" onchange="variar_sales('sh')">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <div class="alert alert-primary  clearfix">
                                <b class="h5 float-left">TOTAL SALE </b>
                                <span id="total_profit" class="float-right"><sup>$</sup>{{round($valor,2)}}</span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row text-right mt-4">
                        <div class="text-center col-12 ">
                            <input type="hidden" id="dias" value="{{$dias}}">
                            <input type="hidden" name="paquete_id" value="{{$paquete_id}}">
                            <input type="hidden" name="paquete_precio_id" value="{{$paquete_precio_id1}}">
                            <input type="hidden" name="profit_por_s" id="profit_por_s" value="40">
                            <input type="hidden" name="profit_por_d" id="profit_por_d" value="40">
                            <input type="hidden" name="profit_por_m" id="profit_por_m" value="40">
                            <input type="hidden" name="cotizacion_id" value="{{$cotizacion_id1}}">
                            <input type="hidden" name="profit_por_t" id="profit_por_t" value="40">
                            <input type="hidden" name="profit_por_sh" id="profit_por_sh" value="40">
                            <input type="hidden" name="profit_sh" id="profit_sh" value="{{$utilidad}}">
                            <input type="hidden" name="impri" id="impri" value="{{$imprimir}}">
                            <input type="hidden" name="origen" id="origen" value="{{$origen}}">

                            {{csrf_field()}}
                            @if($imprimir=='no')
                                <button class="btn btn-warning" type="submit" name="create" value="create">GUARDAR {{$plan[$pos_plan]}}</button>
                                <button class="btn btn-success" type="submit" name="create" value="create_template">GUARDAR {{$plan[$pos_plan]}} y CREAR TEMPLATE</button>
                            @else
                                <button class="btn btn-warning" type="submit" name="create" value="create">EDITAR {{$plan[$pos_plan]}}</button>
                                @if($imprimir=='si_create')
                                    <p><b class="text-success text-20">Gracias. Su paquete fue creado correctamente!!!</b></p>
                                @else
                                    <p><b class="text-success text-20">Gracias. Su paquete fue creado correctamente y se creo el template!!!</b></p>
                                @endif
                                <p><a class="btn btn-primary text-15" href="{{route('cotizacion_id_show_path',$cotizacion->id)}}">Ver aqui mi paquete</a></p>
                                <a href="{{route('quotes_pdf_path',$paquete_id)}}" class="hide pull-right btn btn-default btn-lg"><i class="fa fa-download" aria-hidden="true"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div></div>

    </form>
    <script>
        $(document).ready(function() {
            calcular_resumen();
        } );
        CKEDITOR.replace( 'descripcion' );
        CKEDITOR.replace( 'incluye' );
        CKEDITOR.replace( 'no_incluye' );

    </script>
@stop