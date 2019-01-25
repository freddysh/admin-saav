@extends('layouts.admin.admin')
@section('archivos-css')
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
    
@stop
@section('archivos-js')
    <script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
@stop
@section('content')
    <div class="row no-gutters mb-2">
        <div class="col text-center">
            <a href="#!" class="btn btn-block btn-sm @if($page == 'expedia.com') btn-success @else  btn-light text-secondary @endif">expedia.com</a>
            @if($page == 'expedia.com') <i class="fas fa-sort-down fa-2x arrow-page text-success"></i>  @endif
        </div>
    </div>
    <div class="row">
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
                @foreach($cotizacion->sortByDesc('fecha')/*->where('estado','!=','2')*/ as $cotizacion_)
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

    <div class="row">
        <div class="col text-right">
            <div class="btn-save-fixed btn-save-fixed-plus p-3">
                <a href="{{route("quotes_new1_expedia_path")}}" class="p-3 bg-danger rounded-circle text-white" data-toggle="tooltip" data-placement="top" title="" data-original-title="Create New Plan"><i class="fas fa-plus"></i></a>
            </div>
        </div>
    </div>
    
    </div>

@stop
