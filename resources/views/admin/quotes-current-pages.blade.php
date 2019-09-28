@extends('layouts.admin.admin')
@section('archivos-css')
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />

@stop
@section('archivos-js')
    <script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
@stop
@section('content')
    <div class="row mt-2">
        <div class="col-12 text-12">
            <div class="row">
                <div class="col-3">
                    <b class="text-20 text-green-goto">{{strtoupper($page)}}</b> <b class="text-20 text-green-goto">{{$anio}}</b>
                </div>
                <div class="col-8 px-0">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        @php
                            $mes_[1]='JAN';
                            $mes_[2]='FEB';
                            $mes_[3]='MARCH';
                            $mes_[4]='APRIL';
                            $mes_[5]='MAY';
                            $mes_[6]='JUNE';
                            $mes_[7]='JULY';
                            $mes_[8]='AUG';
                            $mes_[9]='SEPT';
                            $mes_[10]='OCT';
                            $mes_[11]='NOV';
                            $mes_[12]='DIC';
                            $mess='01';
                            $messs=$mes;
                        @endphp
                        @if($mes<=9)
                            @php
                                $messs=substr($mes,1,strlen($mes));
                            @endphp
                        @endif
                        @for($i=1;$i<=12;$i++)
                            @if($i<=9)
                                @php
                                    $mess='0'.$i;
                                @endphp
                            @else
                                @php
                                    $mess=$i;
                                @endphp
                            @endif
                            <a href="{{route('current_sales_type_page_path',[$anio,$mess,$page,$tipo_filtro])}}" class="btn btn-outline-secondary @if($mes==$mess) active @endif">{{$mes_[$i]}}</a>
                        @endfor
                    </div>
                </div>
                <div class="col-1">
                    @if ($page=='expedia.com')
                        <a href="{{route('quotes_new1_expedia_path')}}" class="btn btn-primary"><i class="fas fa-plus"></i> NEW</a>
                    @else
                        <a href="{{route('quotes_new1_pagina_path',$page)}}" class="btn btn-primary"><i class="fas fa-plus"></i> NEW</a>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <div class="btn-group btn-block" role="group" aria-label="Basic example">
                        <a href="{{route('current_sales_type_page_path',[$anio,$mes,$page,'close-date'])}}" class="btn @if($tipo_filtro=='close-date') btn-primary @else btn-outline-primary @endif">CLOSE DATE</a>
                        <a href="{{route('current_sales_type_page_path',[$anio,$mes,$page,'arrival-date'])}}" class="btn @if($tipo_filtro=='arrival-date') btn-primary @else btn-outline-primary @endif">ARRIVAL DATE</a>
                    </div>
                </div>
                <div class="col-8">
                    @if ($profit_tope==0)
                        @php
                            $profit_tope=1;
                        @endphp
                    @endif
                    @php
                        $ancho_monto=($profit_alcanzado/$profit_tope)*100;
                    @endphp
                    @if ($ancho_monto>100)
                        @php
                            $ancho_monto=100;
                        @endphp
                    @endif
                    <div class="row border">
                        <div class="col-1 bg-secondary"><b>PROFIT GOAL</b></div>
                        <div class="col-10 px-0">
                            <div class="progress1"  style="height: 40px;">
                                <div class="progress-bar @if($profit_alcanzado<$profit_tope) bg-info @else bg-success @endif progress-bar-striped" role="progressbar" style="width: {{$ancho_monto}}%;height: 40px;" aria-valuenow="{{($profit_alcanzado/$profit_tope)*100}}" aria-valuemin="0" aria-valuemax="{{$profit_tope}}"><b class="text-black-50"><sup>$</sup>{{$profit_alcanzado}} ({{number_format(($profit_alcanzado/$profit_tope)*100,2)}}%)</b></div>
                            </div>
                        </div>
                        <div class="col-1 bg-secondary px-0 text-center pt-2">
                            <b class="text-dark mt-4"><sup>$</sup>{{$profit_tope}}</b>
                        </div>
                    </div>
                </div>
                <div class="col-1">
                    <b class="text-dark">
                        {{ $mes_[$messs]}} {{date("Y")-1}} <br> <sup>$</sup>{{number_format($profit_anio_pasado,2)}}
                    </b>
                </div>
            </div>
        </div>
        <div id="ventas_profit" class="col-12">
            <table class="table table-striped table-bordered  table-condensed text-12">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>CLOSE DATE</th>
                        <th>ARRIVAL DATE</th>
                        <th>CODE</th>
                        <th>PAX</th>
                        <th>#</th>
                        {{-- <th>PROGRAM</th> --}}
                        <th>#DAYS</th>
                        <th>MEMBER</th>
                        <th>PROFIT</th>
                        <th>ESTATE</th>
                        <th>OPERATIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $profit_suma=0;
                        $orden='fecha_venta';
                        $pos=1;
                    @endphp
                    @if ($tipo_filtro=='arrival-date')
                        @php
                            $orden='fecha';
                        @endphp
                    @endif
                    @foreach ($cotizacion->sortByDesc($orden) as $cotizacion_)
                        @php
                        $date = date_create($cotizacion_->fecha);
                        $fecha=date_format($date, 'jS F Y');
                        $i++;
                        $profit=0;
                        $profit_st=0;
                        $titulo=$cotizacion_->nombre_pax.'x'.$cotizacion_->nropersonas.' '.$cotizacion_->fecha;
                        @endphp
                        @foreach($cotizacion_->paquete_cotizaciones->take(1) as $paquete_cotizaciones)
                            @if($paquete_cotizaciones->duracion==1)
                                @php
                                    $profit=$paquete_cotizaciones->utilidad*$cotizacion_->nropersonas;
                                @endphp
                            @else
                                @php
                                    $nro_personas=0;
                                    $uti=0;
                                @endphp
                                @if($paquete_cotizaciones->paquete_precios->count()>=1)
                                    @foreach($paquete_cotizaciones->paquete_precios as $precio)
                                        @php
                                            $nro_personas=$precio->personas_s+$precio->personas_d+$precio->personas_m+$precio->personas_t;
                                        @endphp
                                        @if($precio->personas_s>0)
                                            @php
                                                $uti+=$precio->utilidad_s*$precio->personas_s;
                                            @endphp
                                        @endif
                                        @if($precio->personas_d>0)
                                            @php
                                                $uti+=$precio->utilidad_d*$precio->personas_d*2;
                                            @endphp
                                        @endif
                                        @if($precio->personas_m>0)
                                            @php
                                                $uti+=$precio->utilidad_m*$precio->personas_m*2;
                                            @endphp
                                        @endif
                                        @if($precio->personas_t>0)
                                            @php
                                                $uti+=$precio->utilidad_t*$precio->personas_t*3;
                                            @endphp
                                        @endif
                                    @endforeach
                                    @if($nro_personas>0)
                                        @php
                                            $profit+=$uti;
                                        @endphp
                                    @else
                                        @php
                                            $profit=$paquete_cotizaciones->utilidad*$cotizacion_->nropersonas;
                                        @endphp
                                    @endif
                                @else
                                    @php
                                        $profit=$paquete_cotizaciones->utilidad*$cotizacion_->nropersonas;
                                    @endphp
                                @endif
                            @endif
                        @endforeach
                        <tr id="content-list-{{$cotizacion_->id}}">
                            <td>{{$pos}}</td>
                            <td>{{$cotizacion_->fecha_venta}} </td>
                            <td>{{$cotizacion_->fecha}} </td>
                            <td>{{$cotizacion_->codigo}} </td>
                            <td>{{strtoupper($cotizacion_->nombre_pax)}} </td>
                            <td>{{$cotizacion_->nropersonas}}<i class="fas fa-user text-primary"></i></td>
                            {{-- <td>PROGRAM</td> --}}
                            <td>{{$cotizacion_->duracion}} </td>
                            <td><span class="text-primary">By</span> {{$cotizacion_->users->name}} </td>
                            <td><b><sup>$</sup>{{number_format($profit,2)}}</b></td>
                            <td>
                                <span class="badge @if($cotizacion_->estado==2) badge-success @else badge-dark @endif">@if($cotizacion_->estado==2) Confirmado @else Sin confirmar @endif</span>
                            </td>
                            <td>
                            <a class="text-18" href="{{route('cotizacion_id_show_path',$cotizacion_->id)}}"><i class="fas fa-eye"></i></a>
                            <input type="hidden" id="hanulado_{{$cotizacion_->id}}" value="{{$cotizacion_->anulado}}">
                            <a class="text-18" id="anulado_{{$cotizacion_->id}}" href="#" onclick="Anular_cotizacion('{{$cotizacion_->id}}','{{$titulo}}')">
                                @if($cotizacion_->anulado==1)
                                    <i class="fas fa-check-circle text-success"></i>
                                @elseif($cotizacion_->anulado==0)
                                    <i class="fas fa-times-circle text-grey-goto"></i>
                                @endif
                            </a>
                            <a class="text-18" href="#!" onclick="Eliminar_cotizacion('{{$cotizacion_->id}}','{{$titulo}}')"><i class="fa fa-trash text-danger"></i></a>
                            </td>
                        </tr>
                        @php
                            $profit_suma+=$profit;
                            $pos++;
                        @endphp
                    @endforeach

                </body>
            </table>
        </div>
    </div>


    <div class="row no-gutters mb-2 d-none">
        <div class="col text-center">
            <a href="#!" class="btn btn-block btn-sm  btn-success">{{$page}}</a>
            <i class="fas fa-sort-down fa-2x arrow-page text-success"></i>
        </div>
    </div>
    <div class="row d-none">
        <div id="list-example" class="list-group">
            <div class="list-group-item list-group-item-action">
                <form action="{{route('current_quote_page_expedia_post_path')}}" method="post">
                    <div class="col-auto">
                        <label class="sr-only" for="anio">Año</label>
                        <div class="input-group mb-2">
                            {{csrf_field()}}
                            <input type="text" class="form-control" id="anio_" name="anio" placeholder="Año" value="{{$anio}}">
                            <input type="hidden" name="mes" value="{{$mes}}">
                            <input type="hidden" name="page" value="{{$page}}">
                            <div class="input-group-prepend">
                                <button type="submit" class="btn btn-primary input-group-text"><i class="fas fa-search"></i> </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            @php
                $mes_[1]='ENERO';
                $mes_[2]='FEBRERO';
                $mes_[3]='MARZO';
                $mes_[4]='ABRIL';
                $mes_[5]='MAYO';
                $mes_[6]='JUNIO';
                $mes_[7]='JULIO';
                $mes_[8]='AGOSTO';
                $mes_[9]='SETIEMBRE';
                $mes_[10]='OCTUBRE';
                $mes_[11]='NOVIEMBRE';
                $mes_[12]='DICIEMBRE';
                $mess='01';
            @endphp
            @for($i=1;$i<=12;$i++)
                @if($i<=9)
                    @php
                        $mess='0'.$i;
                    @endphp
                @else
                    @php
                        $mess=$i;
                    @endphp
                @endif
                @php
                    $nro=0;
                @endphp
                @foreach($cotizacion->sortByDesc('fecha_venta')/*->where('estado','!=','2')*/ as $cotizacion_)
                    @php
                        $f1=explode('-',$cotizacion_->fecha);
                    @endphp
                    @if($f1[0]==$anio && $f1[1]==$mess)
                        @foreach($cotizacion_->paquete_cotizaciones/*->where('estado','!=','2')*/->take(1) as $paquete)
                            @php
                                $nro++;
                            @endphp
                        @endforeach
                    @endif
                @endforeach
                <a class="@if($i==$mes) active @endif list-group-item list-group-item-action" href="{{route('current_quote_page_expedia_path',[$anio,$mess,$page])}}"><b>{{$mes_[$i]}} <span class="badge badge-info">{{$nro}}</span> </b> <i class="fas fa-arrow-circle-right"></i></a>
            @endfor
        </div>
        <div id="no" class="card col">
            @foreach($cotizacion->sortByDesc('fecha')->sortBy('estado')/*->where('estado','!=','2')*/ as $cotizacion_)
                @php
                    $f1=explode('-',$cotizacion_->fecha);
                @endphp
                @if($f1[0]==$anio && $f1[1]==$mes)
                    @php
                    $s=0;
                    $d=0;
                    $m=0;
                    $t=0;
                    $nroPersonas=0;
                    $nro_dias=$cotizacion_->duracion;
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
                    @foreach($cotizacion_->paquete_cotizaciones/*->where('estado','!=','2')*/->take(1) as $paquete)
                        @foreach($paquete->paquete_precios as $precio)
                            @if($precio->personas_s>0)
                                @php
                                    $s=1;
                                    $utilidad_s=intval($precio->utilidad_s);
                                    $utilidad_por_s=$precio->utilidad_por_s;
                                @endphp
                            @endif
                            @if($precio->personas_d>0)
                                @php
                                    $d=1;
                                    $utilidad_d=intval($precio->utilidad_d);
                                    $utilidad_por_d=$precio->utilidad_por_d;
                                @endphp
                            @endif
                            @if($precio->personas_m>0)
                                @php
                                    $m=1;
                                    $utilidad_m=intval($precio->utilidad_m);
                                    $utilidad_por_m=$precio->utilidad_por_m;
                                @endphp
                            @endif
                            @if($precio->personas_t>0)
                                @php
                                    $t=1;
                                    $utilidad_t=intval($precio->utilidad_t);
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
                                @if($servicios->min_personas<= $cotizacion_->nropersonas&&$cotizacion_->nropersonas <=$servicios->max_personas)
                                @else
                                    @php
                                        $rango=' ';
                                    @endphp
                                @endif
                                @if($servicios->precio_grupo==1)
                                    @php
                                        $precio_iti+=round($servicios->precio/$cotizacion_->nropersonas,1);
                                        $preciom=round($servicios->precio/$cotizacion_->nropersonas,1);
                                    @endphp
                                @else
                                    @php
                                        $precio_iti+=round($servicios->precio,1);
                                        $preciom=round($servicios->precio,1);
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
                        $valor=0;
                    @endphp
                    @if($nro_dias==1)
                        @foreach($cotizacion_->paquete_cotizaciones->take(1) as $paquete)
                            @php
                                $valor=$precio_iti+$paquete->utilidad;
                            @endphp
                        @endforeach
                    @elseif($nro_dias>1)
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
                    {{--  @if($cotizacion_->posibilidad=="0")  --}}
                        @php
                            $date = date_create($cotizacion_->fecha);
                            $fecha=date_format($date, 'F jS, Y');
                            $titulo='';
                        @endphp
                        <div class="row">
                            <div class="col-8">
                                <a href="{{route('cotizacion_id_show_path',$cotizacion_->id)}}">
                                    {{--  @foreach($cotizacion_->cotizaciones_cliente as $cliente_coti)
                                        @if($cliente_coti->estado=='1')  --}}
                                            @php
                                                $titulo=$cotizacion_->nombre_pax.' x '.$cotizacion_->nropersonas.' '.$fecha;
                                            @endphp
                                            <b class="text-dark font-weight-bold text-15">
                                                <i class="fas fa-user-circle text-success"></i>
                                                <i class="text-primary">By {{$cotizacion_->users->name}}</i> | <i class="text-success">{{$cotizacion_->codigo}}</i> | {{$cotizacion_->nombre_pax}} x {{$cotizacion_->nropersonas}} {{$fecha}}
                                                <span class="text-primary">
                                                    <sup>$</sup>{{$valor}}
                                                </span>
                                            </b>
                                        {{--  @endif
                                    @endforeach  --}}
                                </a>
                            </div>
                            <div class="col-1"><span class="badge badge-dark">{{$cotizacion_->posibilidad}}%</span></div>
                            <div class="col-1"><span class="badge @if($cotizacion_->estado==2) badge-success @else badge-dark @endif">@if($cotizacion_->estado==2) Confirmado @else Sin confirmar @endif</span></div>
                            <div class="col-2">
                                <div class="icon">
                                    <a href="#" onclick="Eliminar_cotizacion('{{$cotizacion_->id}}','{{$titulo}}')"><i class="fa fa-trash text-danger"></i></a>
                                </div>
                            </div>
                        </div>
                        <hr>
                    {{--  @endif  --}}
                @endif
            @endforeach
        </div>
    </div>

    <div class="row d-none">
        <div class="col text-right">
            <div class="btn-save-fixed btn-save-fixed-plus p-3">
                <a href="{{route("quotes_new1_expedia_path")}}" class="p-3 bg-danger rounded-circle text-white" data-toggle="tooltip" data-placement="top" title="" data-original-title="Create New Plan"><i class="fas fa-plus"></i></a>
            </div>
        </div>
    </div>

    </div>
<script>
    // $(function() {
    //     var progressed = 15;
    //     var interval = setInterval(function() {
    //       progressed += 25;
    //       $("#moving-progress-bar")
    //       .css("width", progressed)
    //       .attr("aria-valuenow", progressed)
    //       .text("$"+progressed + " progress");
    //       if (progressed >= {{$profit_alcanzado}})
    //           clearInterval(interval);
    //   }, {{$profit_tope}});
    // });
    $(function() {
        //   $("#moving-progress-bar")
        //   .css("width", {{$profit_alcanzado}})
        //   .attr("aria-valuenow", {{$profit_alcanzado}})
        //   .text("$"+{{$profit_alcanzado}} + " progress");
    });
</script>

@stop
