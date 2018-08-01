@extends('layouts.admin.admin')
@section('archivos-js')
    <script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
@stop
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Quotes</li>
            <li class="active">New</li>
        </ol>
    </div>
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
    @endphp

    @foreach($cotizaciones as $cotizacion)
        @foreach($cotizacion->cotizaciones_cliente as $coti_cliente)
            @php
                $cliente=$coti_cliente->cliente->nombres.' '.$coti_cliente->cliente->apellidos;
                $cliente_id=$coti_cliente->cliente->id;
            @endphp
        @endforeach
    @endforeach
        <div class="row">
        <div class="col-lg-6">
            <h3>{{$cliente}} {{$cliente}}</h3>
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
                <p><b>Pagina de origen {{$cotizacion->web}}</b></p>
                <b class="text-warning text-25">{{$cotizacion->nropersonas}} PAXS {{$cotizacion->star_2}}{{$cotizacion->star_3}}{{$cotizacion->star_4}}{{$cotizacion->star_5}} <i class="fa fa-star" aria-hidden="true"></i>:</b>
                @foreach($cotizacion->paquete_cotizaciones->where('id',$paquete_precio_id) as $paquete)
                    @foreach($paquete->paquete_precios as $precio)
                        <b class="text-unset text-20">
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
                @endforeach
            @endforeach
        </div>
        <div class="col-lg-6">
            <div class="col-lg-2"></div>
            <div class="col-lg-1 caja_paso_noactivo text-30 text-center">
                <a href="{{route('show_step1_path',[$cliente_id,$cotizacion_id,$paquete_id])}}" class="caja_paso_noactivo_ no_stilo">1</a>
                {{--<b>1</b>--}}
            </div>
            <div class="col-lg-1 caja_paso_activo text-30 text-center">
                <a href="#!" class="caja_paso_activo_ no_stilo">2</a>
                {{--<b>2</b>--}}
            </div>
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
                    @php
                        $paquete_precio_id1=$precio->id;
                        $paquete_precio_s=$precio->precio_s;
                        $paquete_precio_d=$precio->precio_d;
                        $paquete_precio_m=$precio->precio_m;
                        $paquete_precio_t=$precio->precio_t;
                    @endphp
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
            <div class="col-lg-6">
                <p class="text-25"><b>{{$plan[$pos_plan]}}</b></p>
                <p class="text-20"><b>{{$dias}} DAYS</b></p>
                <p class="text-20"><b>CODE:{{$codigo}}</b></p>
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                 @foreach($array_destinos as $destino)
                    @if($destino!=null)
                        {{--<div class="col-md-4">--}}
                            {{--<div class="checkbox1">--}}
                                <label class="text-green-goto text-unset">
                                    {{--<input class="destinospack" type="checkbox" name="destinos[]" checked="checked">--}}
                                    {{$destino}} <span class="text-warning">|</span>
                                </label>
                            {{--</div>--}}
                        {{--</div>--}}
                    @endif
                @endforeach
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="txt_country">Title</label>
                        <input type="text" class="form-control" id="txt_titulo" name="txt_titulo" placeholder="Titulo" value="{{$titulo}}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="txt_country">Description</label>
                        <textarea class="form-control" name="descripcion" id="descripcion" cols="10" rows="5">{{$descr}}</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="txt_country">Include</label>
                        <textarea class="form-control" name="incluye" id="incluye" cols="10" rows="5">{{$include}}</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="txt_country">not Include</label>
                        <textarea class="form-control" name="no_incluye" id="no_incluye" cols="10" rows="5">{{$no_include}}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                @php
                    $nroPersonas=0;
                    $nro_dias=0;
                    $pre_s=0;
                    $pre_d=0;
                    $pre_m=0;
                    $pre_t=0;

                    $cotizacion_id='';
                    $utilidad_s=0;
                    $utilidad_d=0;
                    $utilidad_m=0;
                    $utilidad_t=0;
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
                        @foreach($paquete->paquete_precios as $precio)
                            @if($precio->personas_s>0)
                                @php
                                    $s=1;
                                @endphp
                            @endif
                            @if($precio->personas_d>0)
                                @php
                                    $d=1;
                                @endphp
                            @endif
                            @if($precio->personas_m>0)
                                @php
                                    $m=1;
                                @endphp
                            @endif
                            @if($precio->personas_t>0)
                                @php
                                    $t=1;
                                @endphp
                            @endif
                        @endforeach
                        @php
                            $pos=0;
                        @endphp
                        @foreach($paquete->itinerario_cotizaciones as $itinerario)
                            @php
{{--                        $precio_iti+=$itinerario->precio;--}}
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
                                        $utilidad_s=intval($hotel->utilidad_s);
                                        $utilidad_por_s=$hotel->utilidad_por_s;
                                    @endphp
                                @endif
                                @if($hotel->personas_d>0)
                                    @php
                                        $precio_hotel_d=$hotel->precio_d/2;
                                        $utilidad_d=intval($hotel->utilidad_d);
                                        $utilidad_por_d=$hotel->utilidad_por_d;
                                    @endphp
                                @endif
                                @if($hotel->personas_m>0)
                                    @php
                                        $precio_hotel_m=$hotel->precio_m/2;
                                        $utilidad_m=intval($hotel->utilidad_m);
                                        $utilidad_por_m=$hotel->utilidad_por_m;
                                    @endphp
                                @endif
                                @if($hotel->personas_t>0)
                                    @php
                                        $precio_hotel_t=$hotel->precio_t/3;
                                        $utilidad_t=intval($hotel->utilidad_t);
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
                                        $precio+=round($servicios->precio/$cotizacion->nropersonas,1);
                                    @endphp
                                @else
                                    @php
                                        $precio+=round($servicios->precio,1);
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
                            @endphp

                            <div id="itinerario_" class="caja_itineario text-11">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="col-lg-12">
                                            @foreach($itinerario->itinerario_destinos as $destino)
                                                <b class="dias text-warning">{{$destino->destino}}</b> |
                                            @endforeach
                                        </div>
                                        <div class="col-lg-12">
                                            <b class="dias" id="dias_"+total_Itinerarios+>Dia :{{$itinerario->dias}}</b> {{$itinerario->titulo}}
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="col-lg-3 @if($s==0) hide @endif">
                                            <b>$ {{round($pre_s,0)}}</b>
                                        </div>
                                        <div class="col-lg-3 @if($d==0) hide @endif">
                                            <b>$ {{round($pre_d,0)}}</b>
                                        </div>
                                        <div class="col-lg-3 @if($m==0) hide @endif">
                                            <b>$ {{round($pre_m,0)}}</b>
                                        </div>
                                        <div class="col-lg-3 @if($t==0) hide @endif">
                                            <b>$ {{round($pre_t,0)}}</b>
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
                <div class="col-lg-12">
                    <div class="row ">
                        <div class="col-lg-4">
                            <b CLASS="text-warning text-15">PRICE PER PERSON</b>
                        </div>
                        {{--<div class="col-sm-6">--}}
                            <div class="col-lg-2 @if($s==0) hide @endif">
                                <b CLASS="text-unset text-15">S</b>
                            </div>
                            <div class="col-lg-2 @if($d==0) hide @endif">
                                <b CLASS="text-unset text-15">D</b>
                            </div>
                            <div class="col-lg-2 @if($m==0) hide @endif">
                                <b CLASS="text-unset text-15">M</b>
                            </div>
                            <div class="col-lg-2 @if($t==0) hide @endif">
                                <b CLASS="text-unset text-15">T</b>
                            </div>
                        {{--</div>--}}
                    </div>
                    <div class="row ">
                        <div class="col-lg-4">
                            <b CLASS="text-warning text-15">COST</b>
                        </div>
                        {{--<div class="col-sm-6">--}}
                            <div class="col-lg-2 @if($s==0) hide @endif">
                                <b CLASS="text-unset text-15">$<span name="cost_s" id="cost_s">{{ceil($prem_s)}}</span></b>
                            </div>
                            <div class="col-lg-2 @if($d==0) hide @endif">
                                <b CLASS="text-unset text-15">$<span name="cost_d" id="cost_d">{{ceil($prem_d)}}</span></b>
                            </div>
                            <div class="col-lg-2 @if($m==0) hide @endif">
                                <b CLASS="text-unset text-15">$<span name="cost_m" id="cost_m">{{ceil($prem_m)}}</span></b>
                            </div>
                            <div class="col-lg-2 @if($t==0) hide @endif">
                                <b CLASS="text-unset text-15">$<span name="cost_t" id="cost_t">{{ceil($prem_t)}}</span></b>
                            </div>
                        {{--</div>--}}
                    </div>
                    <div class="row linea text-11">
                        <div class="col-lg-4">
                            <b CLASS="text-warning text-15">PROFIT</b>
                        </div>
                        {{--<div class="col-sm-6">--}}
                            <div class="col-lg-2 @if($s==0) hide @endif">
                                <input class="form-control" type="text" name="pro_s" id="pro_s" value="{{$utilidad_s}}" onchange="variar_profit('s')">
                                <b CLASS="text-warning text-15"><span id="porc_s">{{$utilidad_por_s}}</span>%</b>
                            </div>
                            <div class="col-lg-2 @if($d==0) hide @endif">
                                <input class="form-control" type="text" name="pro_d" id="pro_d" value="{{$utilidad_d}}" onchange="variar_profit('d')">
                                <b CLASS="text-warning text-15"><span id="porc_d">{{$utilidad_por_d}}</span>%</b>
                            </div>
                            <div class="col-lg-2 @if($m==0) hide @endif">
                                <input class="form-control" type="text" name="pro_m" id="pro_m" value="{{$utilidad_m}}" onchange="variar_profit('m')">
                                <b CLASS="text-warning text-15"><span id="porc_m">{{$utilidad_por_m}}</span>%</b>
                            </div>
                            <div class="col-lg-2 @if($t==0) hide @endif">
                                <input class="form-control" type="text" name="pro_t" id="pro_t" value="{{$utilidad_t}}" onchange="variar_profit('t')">
                                <b CLASS="text-warning text-15"><span id="porc_t">{{$utilidad_por_t}}</span>%</b>
                            </div>
                        {{--</div>--}}
                    </div>
                    <div class="row ">
                        @php
                            $valor=0;
                        @endphp
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
                        <div class="col-lg-4">
                            <b CLASS="text-warning text-15">SALES</b>
                        </div>
                        <div class="col-lg-2 @if($s==0) hide @endif">
                            <input class="form-control" type="text" name="sale_s" id="sale_s" value="@if($s!=0){{round(ceil($prem_s)+$utilidad_s,2)}}@else{{0}}@endif" onchange="variar_sales('s')">
                        </div>
                        <div class="col-lg-2 @if($d==0) hide @endif">
                            <input class="form-control" type="text" name="sale_d" id="sale_d" value="@if($d!=0){{round(ceil($prem_d)+$utilidad_d,2)}}@else{{0}}@endif" onchange="variar_sales('d')">
                        </div>
                        <div class="col-lg-2 @if($m==0) hide @endif">
                            <input class="form-control" type="text" name="sale_m" id="sale_m" value="@if($m!=0){{round(ceil($prem_m)+$utilidad_m,2)}}@else{{0}}@endif" onchange="variar_sales('m')">
                        </div>
                        <div class="col-lg-2 @if($t==0) hide @endif">
                            <input class="form-control" type="text" name="sale_t" id="sale_t" value="@if($t!=0){{round(ceil($prem_t)+$utilidad_t,2)}}@else{{0}}@endif" onchange="variar_sales('t')">
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="text-center col-lg-12 total_profit">
                            <b CLASS="text-15">TOTAL SALE $<span id="total_profit">{{ceil($valor)}}</span></b>
                        </div>
                    </div>
                    <div class="row text-center margin-top-10">
                        <div class="text-center col-lg-12 ">
                            <input type="hidden" name="paquete_id" value="{{$paquete_id}}">
                            <input type="hidden" name="paquete_precio_id" value="{{$paquete_precio_id1}}">
                            <input type="hidden" name="profit_por_s" id="profit_por_s" value="40">
                            <input type="hidden" name="profit_por_d" id="profit_por_d" value="40">
                            <input type="hidden" name="profit_por_m" id="profit_por_m" value="40">
                            <input type="hidden" name="cotizacion_id" value="{{$cotizacion_id1}}">
                            <input type="hidden" name="profit_por_t" id="profit_por_t" value="40">

                            {{csrf_field()}}
                            @if($imprimir=='no')
                                <button class="btn btn-warning btn-lg" type="submit" name="create" value="create">GUARDAR {{$plan[$pos_plan]}}</button>
                                <button class="btn btn-warning btn-lg" type="submit" name="create" value="create_template">GUARDAR {{$plan[$pos_plan]}} y CREAR TEMPLATE</button>
                            @else
                                <button class="btn btn-warning btn-lg" type="submit" name="create">EDITAR {{$plan[$pos_plan]}}</button>
                                @if($imprimir=='si_create')
                                    <p><b class="text-success text-20">Gracias. Su paquete fue creado correctamente!!!</b></p>
                                @else
                                    <p><b class="text-success text-20">Gracias. Su paquete fue creado correctamente y se creo el template!!!</b></p>
                                @endif
                                <p><a class="btn btn-primary text-15" href="{{route('current_quote_page_path',$cotizacion->web)}}">Ver aqui mi paquete</a></p>
                                <a href="{{route('quotes_pdf_path',$paquete_id)}}" class="hide pull-right btn btn-default btn-lg"><i class="fa fa-download" aria-hidden="true"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
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