@extends('layouts.admin.admin')
@section('archivos-js')
    <script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
@stop
@section('content')
    @php
        function fecha_peru($fecha1){
        $f1=explode('-',$fecha1);
        return $f1[2].'-'.$f1[1].'-'.$f1[0];
        }
    @endphp
    @if(isset($id_serv))
        @php
            $id_serv=$id_serv;
        @endphp
    @else
        @php
            $id_serv='';
        @endphp
    @endif
    <script type="text/JavaScript">
        window.onload=new function() {if (window.location.href.indexOf('#')==-1) window.location.href='#lista_servicios_{{$id_serv}}';}
    </script>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white m-0">
            <li class="breadcrumb-item" aria-current="page"><a href="/">Home</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="/">Qoutes</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
    <hr>
    {{--<form action="{{route('package_cotizacion_save_path')}}" method="post" id="package_new_path_id">--}}
    <div class="row align-items-center">
        <div class="col-6">
            <h3>{{$cliente->nombres}} {{$cliente->apellidos}}</h3>
            @php
                $s=0;
                $d=0;
                $m=0;
                $t=0;
                $duracion=0;
                $utilidad=0;
                $utilidad_s=0;
                $utilidad_d=0;
                $utilidad_m=0;
                $utilidad_t=0;

            @endphp
            @foreach($cotizaciones as $cotizacion)
                @foreach($cotizacion->paquete_cotizaciones->where('id',$paquete_precio_id) as $paquete)
                    @php
                        $duracion=$paquete->duracion;
                        $utilidad=$paquete->utilidad;

                    @endphp
                    <p class="text-18">Web:<b class="text-info">{{$cotizacion->web}}</b> | Codigo:<b class="text-info">{{$cotizacion->codigo}}</b> | Idioma:<b class="text-info">{{$cotizacion->idioma_pasajeros}}</b></p>
                    <b class="text-secondary h2">{{$cotizacion->nropersonas}} PAXS</b><b class="text-warning h2"> | </b><b class="text-secondary h2">@if($duracion>1) {{$cotizacion->star_2}}{{$cotizacion->star_3}}{{$cotizacion->star_4}}{{$cotizacion->star_5}} STARS @else SIN HOTEL @endif</b><b class="text-warning h2"> | </b>
                    @if($duracion>1)
                        @foreach($paquete->paquete_precios as $precio)
                            <b class="text-secondary h3">
                                @if($precio->personas_s>0)
                                    <b class="badge badge-g-yellow">SINGLE</b>
                                    @php
                                        $utilidad_s=$precio->utilidad_s;
                                        $s=1;
                                    @endphp
                                @endif
                                @if($precio->personas_d>0)
                                    <b class="badge badge-g-yellow">DOUBLE</b>
                                    @php
                                        $utilidad_d=$precio->utilidad_d;
                                        $d=1;
                                    @endphp
                                @endif
                                @if($precio->personas_m>0)
                                    <b class="badge badge-g-yellow">MATRIMONIAL</b>
                                    @php
                                        $utilidad_m=$precio->utilidad_m;
                                        $m=1;
                                    @endphp
                                @endif
                                @if($precio->personas_t>0)
                                    <b class="badge badge-g-yellow">TRIPLE</b>
                                    @php
                                        $utilidad_t=$precio->utilidad_t;
                                        $t=1;
                                    @endphp
                                @endif
                            </b>
                        @endforeach
                    @endif
                @endforeach
            @endforeach
        </div>
        <div class="col-2 text-right">
            <div class="row">
                <div class="col  text-30 ">
                    {{--                            <a href="{{route('agregar_servicios_paso1_path',[$cliente,$cotizacion_id,$paquete_precio_id])}}" class="btn btn-primary"><i class="fas fa-plus"></i> Agregar servicio</a>--}}
                    <a href="#!" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onclick="mostrarservicios()">
                        <i class="fa fa-cubes fa-4x"></i><br> Agregar servicio
                    </a>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <form action="{{route('agregar_nuevo_servicio_path')}}" method="post">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">AGREGAR NUEVO SERVICO</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="dia">Ingrese el dia</label>
                                                    <select class="form-control" name="dia" id="dia">
                                                        @foreach($cotizaciones as $cotizacion)
                                                            @foreach($cotizacion->paquete_cotizaciones->where('id',$paquete_precio_id) as $paquete)
                                                                @foreach($paquete->itinerario_cotizaciones as $itinerario)
                                                                    <option value="{{$itinerario->id}}">DIA {{$itinerario->dias}}</option>
                                                                @endforeach
                                                            @endforeach
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                {{csrf_field()}}
                                                <select class="form-control" name="txt_destino" id="txt_destino" onchange="limpiar_caja_servicios()">
                                                    @foreach($destinations as $destino)
                                                        <option value="{{$destino->id}}_{{$destino->destino}}">{{$destino->destino}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="row mt-4">
                                                    @foreach($categorias as $categoria)
                                                        <?php
                                                        $tipoServicio[]=$categoria->nombre;
                                                        ?>
                                                    @endforeach
                                                    <div class="col-10">
                                                        <div class="row text-left">
                                                            <div class="col-3 m-0">
                                                                <div class="list-group text-center">
                                                                    <a href="#!" class="list-group-item" onclick="llamar_servicios($('#txt_destino').val(),'{{$tipoServicio[1]}}')"> <i class="fas fa-map  text-info"></i><b class="small d-block">{{$tipoServicio[1] }}</b></a>
                                                                    <a href="#!" class="list-group-item" onclick="llamar_servicios($('#txt_destino').val(),'{{$tipoServicio[2]}}')"> <i class="fa fa-bus  text-warning"></i><b class="small d-block">{{$tipoServicio[2]}}</b></a>
                                                                    <a href="#!" class="list-group-item" onclick="llamar_servicios($('#txt_destino').val(),'{{$tipoServicio[3]}}')"> <i class="fa fa-users  text-success"></i><b class="small d-block">{{$tipoServicio[3]}}</b></a>
                                                                    <a href="#!" class="list-group-item" onclick="llamar_servicios($('#txt_destino').val(),'{{$tipoServicio[4]}}')"> <i class="fas fa-ticket-alt  text-warning"></i><b class="small d-block">{{$tipoServicio[4]}}</b></a>
                                                                    <a href="#!" class="list-group-item" onclick="llamar_servicios($('#txt_destino').val(),'{{$tipoServicio[5]}}')"> <i class="fas fa-utensils  text-danger"></i><b class="small d-block">{{$tipoServicio[5]}}</b></a>
                                                                    <a href="#!" class="list-group-item" onclick="llamar_servicios($('#txt_destino').val(),'{{$tipoServicio[6]}}')"> <i class="fa fa-train  text-info"></i><b class="small d-block">{{$tipoServicio[6]}}</b></a>
                                                                    <a href="#!" class="list-group-item" onclick="llamar_servicios($('#txt_destino').val(),'{{$tipoServicio[7]}}')"> <i class="fa fa-plane  text-primary"></i><b class="small d-block">{{$tipoServicio[7]}}</b></a>
                                                                    <a href="#!" class="list-group-item" onclick="llamar_servicios($('#txt_destino').val(),'{{$tipoServicio[8]}}')"> <i class="fa fa-question  text-success"></i><b class="small d-block">{{$tipoServicio[8]}}</b></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-9">
                                                                <div class="panel panel-default">
                                                                    <div id="list_servicios_grupo" class="panel-body"></div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        {{csrf_field()}}
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" >Agregar servicio</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-2 text-left">
            <div class="row ">
                <div class="col  text-30">
                    <a href="#!" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_h" onclick="mostrarservicios()">
                        <i class="fa fa-h-square fa-4x" aria-hidden="true"></i> <br> Agregar Hotel
                    </a>
                    <div class="modal fade" id="exampleModal_h" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <form action="{{route('agregar_nuevo_hotel_path')}}" method="post">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">AGREGAR NUEVO HOTEL</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="dia">Ingrese el dia</label>
                                                    <select class="form-control" name="dia" id="dia">
                                                        @foreach($cotizaciones as $cotizacion)
                                                            @foreach($cotizacion->paquete_cotizaciones->where('id',$paquete_precio_id) as $paquete)
                                                                @foreach($paquete->itinerario_cotizaciones as $itinerario)
                                                                    <option value="{{$itinerario->id}}">DIA {{$itinerario->dias}}</option>
                                                                @endforeach
                                                            @endforeach
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                {{csrf_field()}}
                                                <select class="form-control" name="txt_destino" id="txt_destino" onchange="llamar_hoteles($(this).val(),'n','{{$itinerario->id}}')">
                                                    @foreach($destinations as $destino)
                                                        <option value="{{$destino->id}}_{{$destino->destino}}">{{$destino->destino}}</option>
                                                    @endforeach
                                                </select>
                                                <div id="lista_hoteles_n_{{$itinerario->id}}" class="row mt-4">
                                                    @foreach($hoteles as $hotel)
                                                        <div class="col">
                                                            <input type="hidden" name="hotel_id_{{$hotel->estrellas}}" value="{{$hotel->id}}">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" id="customRadio{{$hotel->estrellas}}" name="categoria_[]" class="custom-control-input" value="{{$hotel->estrellas}}">
                                                                <label class="custom-control-label" for="customRadio{{$hotel->estrellas}}">{{$hotel->estrellas}} <i class="fas fa-star text-warning"></i></label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        {{csrf_field()}}
                                        @foreach($cotizaciones as $cotizacion)
                                            @foreach($cotizacion->paquete_cotizaciones->where('id',$paquete_precio_id) as $paquete)
                                                @foreach($paquete->paquete_precios as $hotel)
                                                    <input type="hidden" name="pqt_precio" value="{{$hotel->id}}">
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" >Agregar servicio</button>
                                    </div>
                                </form>
                            </div>
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
    $cotizacion_id='';
    $utilidad=0;
    @endphp
        @foreach($cotizaciones as $cotizacion)
            @php
                $cotizacion_id=$cotizacion->id;
            @endphp
            @foreach($cotizacion->paquete_cotizaciones->where('id',$paquete_precio_id) as $paquete)
                @if($paquete->id==$paquete_precio_id)
                    @php
                        $utilidad=$paquete->utilidad;
                        $itis='';
                    @endphp
                    @foreach($paquete->itinerario_cotizaciones as $itinerario)
                        <div class="row">
                            <div class="col-1">
                                <b class="text-g-dark">DAY {{$itinerario->dias}}</b>
                            </div>
                            <div class="col-5">
                                <div class="row bg-g-dark rounded text-white">
                                    <div class="col-6">
                                        <b id="iti_fecha_b_{{$itinerario->id}}" class="badge badge-g-yellow">{{fecha_peru($itinerario->fecha)}}</b>
                                        <b>{{ ucwords(strtolower($itinerario->titulo))}}</b>
                                        <!-- Button trigger modal -->
                                        <a href="#!" class="text-warning" data-toggle="modal" data-target="#exampleModal_{{$itinerario->id}}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal_{{$itinerario->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Editar fecha</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="fecha_{{$itinerario->id}}">Ingrese la nueva fecha</label>
                                                            <input type="date" class="form-control" id="fecha_{{$itinerario->id}}" name="iti_fecha" value="{{$itinerario->fecha}}">
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <span id="rp_cambio_fecha_{{$itinerario->id}}"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        {{csrf_field()}}

                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary" onclick="modificar_fecha($('#fecha_{{$itinerario->id}}').val(),'{{$itinerario->id}}','e')">Guardar cambios</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col @if($s==0) d-none @endif">S</div>
                                    <div class="col @if($d==0) d-none @endif">D</div>
                                    <div class="col @if($m==0) d-none @endif">M</div>
                                    <div class="col @if($t==0) d-none @endif">T</div>
                                    @if($s==0&&$d==0&&$m==0&&$t==0)<div class="col">SIN HOTEL</div>@endif

                                    {{--<div class="col-2 d-none"></div>--}}
                                </div>
                                <div class="row caja_detalle">
                                    <div class="col caja_sort_{{$itinerario->dias}}">
                                    @foreach($itinerario->itinerario_servicios->sortBy('pos') as $servicios)
                                        @php
                                            $rango='';
                                            $preciom=0;
                                        @endphp
                                        {{--@if($servicios->precio_grupo==1)--}}
                                            {{--@php--}}
                                                {{--$precio_iti+=($servicios->precio/2)/$cotizacion->nropersonas;--}}
                                                {{--$preciom=($servicios->precio/2)/$cotizacion->nropersonas;--}}
                                            {{--@endphp--}}
                                        {{--@else--}}
                                        @if($servicios->min_personas<= $cotizacion->nropersonas&&$cotizacion->nropersonas <=$servicios->max_personas)

                                        @elseif($servicios->servicio->precio_grupo=='1')
                                            @if($servicios->servicio->grupo=='MOVILID')
                                                @php
                                                    $rango=' text-danger';
                                                @endphp
                                            @endif
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
                                        <div class="row card_servicios_{{$itinerario->dias}} card_servicios" id="lista_servicios_{{$servicios->id}}" data-value="{{$servicios->id}}">
                                            <div class="col-6">
                                                <div class="row">
                                                    <div class="col-10{{$rango}}">
                                                        @if($servicios->servicio->grupo=='TOURS')
                                                            <b class="text-primary text-13"><i class="fa fa-map-o" aria-hidden="true"></i></b>
                                                        @endif
                                                        @if($servicios->servicio->grupo=='MOVILID')
                                                            <b class="text-primary text-13"><i class="fa fa-bus" aria-hidden="true"></i></b>
                                                        @endif
                                                        @if($servicios->servicio->grupo=='REPRESENT')
                                                            <b class="text-primary text-13"><i class="fa fa-users" aria-hidden="true"></i></b>
                                                        @endif
                                                        @if($servicios->servicio->grupo=='ENTRANCES')
                                                            <b class="text-primary text-13"><i class="fa fa-ticket" aria-hidden="true"></i></b>
                                                        @endif
                                                        @if($servicios->servicio->grupo=='FOOD')
                                                            <b class="text-primary text-13"><i class="fa fa-cutlery" aria-hidden="true"></i></b>
                                                        @endif
                                                        @if($servicios->servicio->grupo=='TRAINS')
                                                            <b class="text-primary text-13"><i class="fa fa-train" aria-hidden="true"></i></b>
                                                        @endif
                                                        @if($servicios->servicio->grupo=='FLIGHTS')
                                                            <b class="text-primary text-13"><i class="fa fa-plane" aria-hidden="true"></i></b>
                                                        @endif
                                                        @if($servicios->servicio->grupo=='OTHERS')
                                                            <b class="text-primary text-13"><i class="fa fa-question" aria-hidden="true"></i></b>
                                                        @endif
                                                        <span>{{ucwords(strtolower($servicios->nombre))}}</span>
                                                        @if($servicios->servicio->grupo=='MOVILID')
                                                                <b class="text-primary text-12">{{$servicios->servicio->tipoServicio}} [{{$servicios->min_personas}} - {{$servicios->max_personas}}] p.p.</b>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col @if($s==0) d-none @endif">$<input type="hidden" class="precio_servicio_s" value="{{explode('.00',$preciom)[0]}}">{{explode('.00',$preciom)[0]}}</div>
                                            <div class="col @if($d==0) d-none @endif">$<input type="hidden" class="precio_servicio_d" value="{{explode('.00',$preciom)[0]}}">{{explode('.00',$preciom)[0]}}</div>
                                            <div class="col @if($m==0) d-none @endif">$<input type="hidden" class="precio_servicio_m" value="{{explode('.00',$preciom)[0]}}">{{explode('.00',$preciom)[0]}}</div>
                                            <div class="col @if($t==0) d-none @endif">$<input type="hidden" class="precio_servicio_t" value="{{explode('.00',$preciom)[0]}}">{{explode('.00',$preciom)[0]}}</div>
                                            <div class="col @if($s==0&&$d==0&&$m==0&&$t==0) @else d-none @endif">$<input type="hidden" class="precio_servicio_sh" value="{{explode('.00',$preciom)[0]}}">{{explode('.00',$preciom)[0]}}</div>
                                            <div class="col-2">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <a class="btn py-0 text-primary" data-toggle="modal" data-target="#modal_new_destination1_{{$servicios->id}}" onclick="traer_servicios_paso1('{{$itinerario->id}}','{{$servicios->id}}','{{$itinerario->destino_foco}}','{{$servicios->servicio->grupo}}','edit')">
                                                            <i class="fas fa-exchange-alt text-success" aria-hidden="true"></i>
                                                        </a>
                                                        <!-- Modal -->
                                                        <div class="modal fade bd-example-modal-lg" id="modal_new_destination1_{{$servicios->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <form action="{{route('step1_edit_path', $servicios->id)}}" method="post" enctype="multipart/form-data">
                                                                        <input type="hidden" name="_method" value="patch">
                                                                        <input type="hidden" name="id_cotizacion" value="{{$cotizacion->id}}">
                                                                        <input type="hidden" name="id_client" value="{{$cliente->id}}">
                                                                        <input type="hidden" name="id_paquete" value="{{$paquete->id}}">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Editar Servicio</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div id="list_servicios_grupo_{{$servicios->id}}">
                                                                            </div>
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
                                                    <div class="col-6">
                                                        <b class="text-danger puntero" onclick="borrar_serv_quot_paso1('{{$servicios->id}}','{{$servicios->nombre}}')">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    </div>
                                </div>
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
                                    <div id="caja_detalle_{{$hotel->id}}" class="row caja_detalle_hotel margin-bottom-15">
                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col-10 text-12">HOTEL | <span class="text-11">{{strtoupper($hotel->estrellas) }}STARS</span> | <span class="text-11">{{$hotel->localizacion}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col @if($hotel->personas_s==0) d-none @endif">${{round(explode('.00',$hotel->precio_s)[0],2)}}</div>
                                        <div class="col @if($hotel->personas_d==0) d-none @endif">${{round(explode('.00',$hotel->precio_d)[0]/2,2)}}</div>
                                        <div class="col @if($hotel->personas_m==0) d-none @endif">${{round(explode('.00',$hotel->precio_m)[0]/2,2)}}</div>
                                        <div class="col @if($hotel->personas_t==0) d-none @endif">${{round(explode('.00',$hotel->precio_t)[0]/3,2)}}</div>
                                        <input type="hidden" class="precio_servicio_s_h" value="{{explode('.00',$hotel->precio_s)[0]}}">
                                        <input type="hidden" class="precio_servicio_d_h" value="{{explode('.00',$hotel->precio_d)[0]/2}}">
                                        <input type="hidden" class="precio_servicio_m_h" value="{{explode('.00',$hotel->precio_m)[0]/2}}">
                                        <input type="hidden" class="precio_servicio_t_h" value="{{explode('.00',$hotel->precio_t)[0]/3}}">
                                        <div class="col-2">
                                            <div class="row">
                                                <div class="col-4">
                                                    <a class="btn py-0" data-toggle="modal" data-target="#modal_new_destinationh_{{$hotel->id}}">
                                                        <i class="fas fa-pencil-alt text-primary" aria-hidden="true"></i>
                                                    </a>
                                                    <div class="modal fade bd-example-modal-m" id="modal_new_destinationh_{{$hotel->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-m" role="document">
                                                            <div class="modal-content">
                                                                <form action="{{route('step1_edit_hotel_path', $hotel->id)}}" method="post" enctype="multipart/form-data">
                                                                    <input type="hidden" name="_method" value="patch">
                                                                    <input type="hidden" name="id_cotizacion" value="{{$cotizacion->id}}">
                                                                    <input type="hidden" name="id_client" value="{{$cliente->id}}">
                                                                    <input type="hidden" name="id_paquete" value="{{$paquete->id}}">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Editar Precio hotel</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row  caja_dia">
                                                                            <div class="col-lg-4">
                                                                                <div class="row">
                                                                                    <div class="col-lg-10">Acomodacion</div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-2 @if($hotel->personas_s==0) hide @endif">S</div>
                                                                            <div class="col-lg-2 @if($hotel->personas_d==0) hide @endif">D</div>
                                                                            <div class="col-lg-2 @if($hotel->personas_m==0) hide @endif">M</div>
                                                                            <div class="col-lg-2 @if($hotel->personas_t==0) hide @endif">T</div>
                                                                        </div>
                                                                        <div class="row  caja_detalle_hotel">
                                                                            <div class="col-lg-4">
                                                                                <div class="row">
                                                                                    <div class="col-lg-10">HOTEL</div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-2 @if($hotel->personas_s==0) hide @endif">
                                                                                <input class="form-control" type="number" name="precio_s" value="{{explode('.00',$hotel->precio_s)[0]/1}}">
                                                                            </div>
                                                                            <div class="col-lg-2 @if($hotel->personas_d==0) hide @endif">
                                                                                <input class="form-control" type="number" name="precio_d" value="{{explode('.00',$hotel->precio_d)[0]/2}}">
                                                                            </div>
                                                                            <div class="col-lg-2 @if($hotel->personas_m==0) hide @endif">
                                                                                <input class="form-control" type="number" name="precio_m" value="{{explode('.00',$hotel->precio_m)[0]/2}}">
                                                                            </div>
                                                                            <div class="col-lg-2 @if($hotel->personas_t==0) hide @endif">
                                                                                <input class="form-control" type="number" name="precio_t" value="{{explode('.00',$hotel->precio_t)[0]/3}}">
                                                                            </div>
                                                                        </div>
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
                                                <div class="col-4">
                                                    <a class="btn py-0" data-toggle="modal" data-target="#modal_cambiar_{{$hotel->id}}">
                                                        <i class="fas fa-exchange-alt text-success" aria-hidden="true"></i>
                                                    </a>
                                                    <div class="modal fade bd-example-modal-m" id="modal_cambiar_{{$hotel->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-m" role="document">
                                                            <div class="modal-content">
                                                                <form action="{{route('cambiar_hotel_path')}}" method="post" enctype="multipart/form-data">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Editar hotel</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="col">
                                                                            {{csrf_field()}}
                                                                            <select class="form-control" name="txt_destino" id="txt_destino" onchange="llamar_hoteles($(this).val(),'ch','{{$itinerario->id}}')">
                                                                                @foreach($destinations as $destino)
                                                                                    <option value="{{$destino->id}}_{{$destino->destino}}">{{$destino->destino}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            <div id="lista_hoteles_ch_{{$itinerario->id}}" class="row mt-4">
                                                                                @foreach($hoteles as $hotel_)
                                                                                    <div class="col">
                                                                                        <input type="hidden" name="hotel_id_{{$hotel_->estrellas}}" value="{{$hotel_->id}}">
                                                                                        <div class="custom-control custom-radio">
                                                                                            <input type="radio" id="customRadio_{{$itinerario->id}}_{{$hotel_->estrellas}}" name="categoria_[]" class="custom-control-input" value="{{$hotel_->estrellas}}">
                                                                                            <label class="custom-control-label" for="customRadio_{{$itinerario->id}}_{{$hotel_->estrellas}}">{{$hotel_->estrellas}} <i class="fas fa-star text-warning"></i></label>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        {{csrf_field()}}
                                                                        <input type="hidden" name="itinerario_cotizaciones_id" value="{{$hotel->itinerario_cotizaciones_id}}">
                                                                        <input type="hidden" name="precio_hotel_reserva_id" value="{{$hotel->id}}">

                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <b class="text-right text-danger puntero" onclick="borrar_hotel_quot_paso1('{{$hotel->id}}','{{$itinerario->dias}}')">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </b>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <div class="col-lg-6">
                                <textarea form="step1" name="txt_descr_{{$itinerario->id}}"  id="txt_descr_{{$itinerario->id}}" cols="70" rows="8">{!! $itinerario->descripcion !!}</textarea>
                            </div>
                        </div>
                        <hr>
                        @php
                            $itis.=$itinerario->id.'_';
                        @endphp
                    @endforeach
                @endif
            @endforeach
        @endforeach
        @php
            $itis=substr($itis,0,strlen($itis)-1);
            $precio_hotel_s+=$precio_iti;
            $precio_hotel_d+=$precio_iti;
            $precio_hotel_m+=$precio_iti;
            $precio_hotel_t+=$precio_iti;
        @endphp
    {{--<form action="{{route('show_step2_path',[$cotizacion_id,$paquete_precio_id,'no'])}}" method="get">--}}
        <div class="row">
            <div class="col-6">
                <div class="row">
                    <div class="col-12">
                        <div class="row bg-g-dark text-white rounded py-2">
                            <div class="col-lg-8"><b>COST</b></div>
                            <div class="col text-warning @if($s==0) d-none @endif"><b>$<span id="cost_s">{{ceil($precio_hotel_s)}}</span></b></div>
                            <div class="col text-warning @if($d==0) d-none @endif"><b>$<span id="cost_d">{{ceil($precio_hotel_d)}}</span></b></div>
                            <div class="col text-warning @if($m==0) d-none @endif"><b>$<span id="cost_d">{{ceil($precio_hotel_m)}}</span></b></div>
                            <div class="col text-warning @if($t==0) d-none @endif"><b>$<span id="cost_t">{{ceil($precio_hotel_t)}}</span></b></div>
                            <div class="col text-warning @if($s==0&&$d==0&&$m==0&&$t==0) @else d-none @endif"><b>$<span id="cost_sh">{{ceil($precio_iti)}}</span></b></div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row bg-g-dark text-white rounded py-2">
                            <div class="col-lg-8"><b>PROFIT</b></div>
                            <div class="col text-warning @if($s==0) d-none @endif"><b>$<span id="cost_s">{{ceil($utilidad_s)}}</span></b></div>
                            <div class="col text-warning @if($d==0) d-none @endif"><b>$<span id="cost_d">{{ceil($utilidad_d)}}</span></b></div>
                            <div class="col text-warning @if($m==0) d-none @endif"><b>$<span id="cost_d">{{ceil($utilidad_m)}}</span></b></div>
                            <div class="col text-warning @if($t==0) d-none @endif"><b>$<span id="cost_t">{{ceil($utilidad_t)}}</span></b></div>
                            <div class="col text-warning @if($s==0&&$d==0&&$m==0&&$t==0) @else d-none @endif"><b>$<span id="cost_sh">{{ceil($utilidad)}}</span></b></div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row bg-g-dark text-white rounded py-2">
                            <div class="col-lg-8"><b>SALE</b></div>
                            <div class="col text-warning @if($s==0) d-none @endif"><b>$<span id="cost_s">{{ceil($precio_hotel_s+$utilidad_s)}}</span></b></div>
                            <div class="col text-warning @if($d==0) d-none @endif"><b>$<span id="cost_d">{{ceil($precio_hotel_d+$utilidad_d)}}</span></b></div>
                            <div class="col text-warning @if($m==0) d-none @endif"><b>$<span id="cost_d">{{ceil($precio_hotel_m+$utilidad_m)}}</span></b></div>
                            <div class="col text-warning @if($t==0) d-none @endif"><b>$<span id="cost_t">{{ceil($precio_hotel_t+$utilidad_t)}}</span></b></div>
                            <div class="col text-warning @if($s==0&&$d==0&&$m==0&&$t==0) @else d-none @endif"><b>$<span id="cost_sh">{{ceil($precio_iti+$utilidad)}}</span></b></div>
                        </div>
                        <div class="row">
                            <div class="col text-right">PRICE PER PERSON</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="col text-right">
                    <form id="step1" action="{{route('show_step2_post_path')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="cotizacion_id" value="{{$cotizacion_id}}">
                        <input type="hidden" name="paquete_precio_id" value="{{$paquete_precio_id}}">
                        <input type="hidden" name="imprimir" value="si">
                        <input type="hidden" name="itis" value="{{$itis}}">
                        <button class="btn btn-success btn-lg" type="submit">EDIT</button>
                    </form>
                </div>
            </div>
        </div>
    <script>
        $(document).ready(function() {
            calcular_resumen();
            @foreach($cotizaciones as $cotizacion)
                @foreach($cotizacion->paquete_cotizaciones->where('id',$paquete_precio_id) as $paquete)
                    @if($paquete->id==$paquete_precio_id)
                        @foreach($paquete->itinerario_cotizaciones as $itinerario)
                            CKEDITOR.replace('txt_descr_{{$itinerario->id}}');

                            $('.caja_sort_{{$itinerario->dias}}').sortable({
                                connectWith:'.caja_sort_{{$itinerario->dias}}',
                                tolerance:'intersect',
                                stop:function(){
                                    ordenar_en_db($(this),{{$itinerario->dias}});
                                },
                            });
                        @endforeach
                    @endif
                @endforeach
            @endforeach

            function ordenar_en_db(obj,dia){
//                console.log('se cojio el:'+$(obj).attr('id'));
                var titles =$(obj).children('.card_servicios_'+dia);
//                console.log($(titles).data('value'));
                var array_servicios='';
                $(titles).each(function(index, element){
                    var elto=$(element).data('value');
                    array_servicios+=elto+'/'+index+'_';
                    console.log('elto:'+elto);
                });
                array_servicios=array_servicios.substring(0,array_servicios.length-1);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('[name="_token"]').val()
                    }
                });
                $.post('{{route('ordenar_servicios_db_path')}}','array_servicios='+array_servicios, function(data) {
                    console.log('data'+data);
                }).fail(function (data) {
                });
            }
        } );
    </script>
@stop