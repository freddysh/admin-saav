@php
    function fecha_peru($fecha){
        $f=explode('-',$fecha);
        return $f[2].'-'.$f[1].'-'.$f[0];
    }
@endphp
    <div class="row no-gutters">
        <div class="col">
            <div class="box-header-book border-right-0">
                <h4 class="no-margin">Sale<span><b class="label label-success">#{{$cotizacion->count()}}</b> <small><b>$</b></small></span></h4>
            </div>
        </div>
    </div>
    <div class="row no-gutters">
        <div class='col box-list-book'>
            <li value="100">
                <ol class='simple_with_animation vertical m-0 p-0 caja_sort'>
                    @foreach($cotizacion->sortByDesc('fecha_venta') as $cotizacion_)
                        @php
                            $s=0;
                            $d=0;
                            $m=0;
                            $t=0;
                            $nroPersonas=0;
                            $nro_dias=0;
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

                        @foreach($cotizacion_->paquete_cotizaciones->take(1) as $paquete)
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
                        @endphp
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
                        @php
                        $date = date_create($cotizacion_->fecha);
                        $fecha=date_format($date, 'F jS, Y');
                        $titulo='';
                        @endphp
                        <li class="content-list-book" id="content-list-{{$cotizacion_->id}}" value="{{$cotizacion_->id}}">
                            <div class="content-list-book-s">
                                <div class="row">
                                    <div class="col-3">
                                        <a href="{{route('cotizacion_id_show_path',$cotizacion_->id)}}">
                                            @foreach($cotizacion_->cotizaciones_cliente as $cliente_coti)
                                                @if($cliente_coti->estado=='1')
                                                    <?php
                                                    $titulo=$cliente_coti->cliente->nombres.' '.$cliente_coti->cliente->apellidos.' x '.$cotizacion_->nropersonas.' '.$fecha;
                                                    ?>
                                                    <small class="text-dark font-weight-bold">
                                                        <i class="fas fa-user-circle text-secondary"></i>
                                                        <i class="text-primary">By {{$cotizacion_->users->name}}</i> | <i class="text-success">{{$cotizacion_->codigo}}</i> | {{$cliente_coti->cliente->nombres}} {{$cliente_coti->cliente->apellidos}} x {{$cotizacion_->nropersonas}} {{$fecha}}
                                                    </small>
                                                    <small class="text-primary">
                                                        <sup>$</sup>{{$valor}}
                                                    </small>
                                                @endif
                                            @endforeach
                                                <i class="text-danger">Confirm.: {{fecha_peru($cotizacion_->fecha_venta)}}</i>
                                        </a>
                                    </div>
                                    <div class="col-2">
                                        <div class="icon">
                                            <a href="#" onclick="Eliminar_cotizacion('{{$cotizacion_->id}}','{{$titulo}}')"><i class="fa fa-trash small text-danger"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ol>
            </li>
        </div>
    </div>
