@extends('layouts.admin.book')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white m-0">
            <li class="breadcrumb-item" aria-current="page"><a href="/">Home</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="/">Reservas</a></li>
            <li class="breadcrumb-item active">New</li>
        </ol>
    </nav>
    <hr>
    <div class="row">
        @php
            $estrellas=2;
        @endphp
        @if($cotizacion->star_2=='2')
            @php
                $estrellas=2;
            @endphp
        @elseif($cotizacion->star_3=='3')
            @php
                $estrellas=3;
            @endphp
        @elseif($cotizacion->star_4=='4')
            @php
                $estrellas=4;
            @endphp
        @elseif($cotizacion->star_5=='5')
            @php
                $estrellas=5;
            @endphp
        @endif
        <div class="col-12">
            @if ($cotizacion->anulado==0)
                <div class="alert alert-danger">
                    <strong>Alerta!</strong> El presente file ha sido anulado el {{MisFunciones::fecha_peru_hora($cotizacion->anulado_fecha)}} por 
                    {{$usuario->where('id',$cotizacion->anulado_user)->first()->name}}, por favor informar a los proveedores lo sucedido.
                </div>                    
            @endif
            
            <div class="panel panel-default">
                <div class="panel-body">
                    <ul class="nav nav-tabs nav-justified">
                        <li class="nav-item active">
                            <a data-toggle="tab" role="tab" aria-controls="pills-home" aria-selected="true" href="#itinerario" class="nav-link show active rounded-0">Itinerario</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="itinerario" class="tab-pane fade show active">
                            <div class="row">
                                <div class="col-10">
                                    <b class="text-primary">By:{{$usuario->where('id',$cotizacion->users_id)->first()->name}}</b>, 
                                    
                                    <b class="text-primary"> <i class="fas fa-calendar"></i> {{ MisFunciones::fecha_peru($cotizacion->fecha_venta)}}</b>
                                    <b class="text-15">|</b>
                                    @foreach($cotizacion->cotizaciones_cliente as $clientes)
                                        @if($clientes->estado==1)
                                            {{--<h1 class="panel-title pull-left" style="font-size:30px;">Hidalgo <small>hidlgo@gmail.com</small></h1>--}}
                                            <b class="text-info text-20">Cod:{{$cotizacion->codigo}}</b><b class="text-20"> | </b><b class="panel-title pull-left text-20">{{$cotizacion->nombre_pax}} x {{$cotizacion->nropersonas}} {{date_format(date_create($cotizacion->fecha), ' l jS F Y')}}</b>
                                            <b class="text-warning padding-left-10 d-none">
                                             (X{{$cotizacion->nropersonas}})</b>
                                            {{-- @for($i=0;$i<$cotizacion->nropersonas;$i++)
                                                <i class="fa fa-male fa-2x"></i>
                                            @endfor --}}
                                        @endif
                                    @endforeach
                                    <b class="text-success text-20 d-none">@if($cotizacion->categorizado=='C'){{'Con factura'}}@elseif($cotizacion->categorizado=='S'){{'Sin factura'}}@else{{'No esta filtrado'}}@endif</b>
                                    
                                    <div class="dropdown pull-right d-none">
                                        <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Opciones
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                            <li><a href="#"><i class="fa fa-fw fa-database" aria-hidden="true"></i> Reservar todo</a></li>
                                            <li><a href="#"><i class="fa fa-fw fa-check" aria-hidden="true"></i> Friends</a></li>
                                            <li><a href="#">Work</a></li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="#"><i class="fa fa-fw fa-plus" aria-hidden="true"></i> Add a new aspect</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-2 text-right margin-top-10">
                                   
                                    {{--  popap para subir y descargar archivos  --}}
                                    
                                    @php
                                        $nro_servicios_total=0;
                                        $nro_servicios_reservados=0;
                                    @endphp
                                    @foreach($cotizacion->paquete_cotizaciones as $paquete)
                                        @if($paquete->estado==2)
                                            @foreach($paquete->itinerario_cotizaciones as $itinerario)
                                                @php
                                                    $nro_servicios=0;
                                                @endphp
                                                @foreach($itinerario->itinerario_servicios as $servicios)
                                                    @if($servicios->proveedor_id)
                                                        @if($servicios->proveedor_id>0)
                                                            @php
                                                                $nro_servicios_reservados++;
                                                            @endphp
                                                        @endif
                                                    @endif
                                                    @php
                                                        $nro_servicios_total++;
                                                    @endphp
                                                @endforeach
                                                @foreach($itinerario->hotel as $hotel)
                                                    @if($hotel->proveedor_id)
                                                        @if($hotel->proveedor_id>0)
                                                            @php
                                                                $nro_servicios_reservados++;
                                                            @endphp
                                                        @endif
                                                    @endif
                                                    @php
                                                        $nro_servicios_total++;
                                                    @endphp
                                                @endforeach
                                            @endforeach
                                        @endif
                                    @endforeach
                                    @php
                                        $porc_avance=round($nro_servicios_reservados/$nro_servicios_total,2);
                                        $porc_avance=$porc_avance*100;
                                        $colo_progres='progress-bar-danger';
                                        if(25<$porc_avance&&$porc_avance<=50)
                                            $colo_progres='progress-bar-warning';

                                        if(50<$porc_avance&&$porc_avance<=75)
                                            $colo_progres='progress-bar-info';

                                        if(50<$porc_avance&&$porc_avance<=100)
                                            $colo_progres='progress-bar-success';

                                    @endphp
                                    <div class="btn-group">
                                        <button class="btn btn-success btn-sm" href="#!" id="archivos" data-toggle="modal" data-target="#myModal_archivos">
                                            <i class="fas fa-file-alt"></i> Archivos
                                        </button>
                                        <button class="btn btn-primary btn-sm" >
                                            <span id="barra_porc">{{$porc_avance}}%</span>
                                        </button>
                                    </div>
                                    <div class="modal fade" id="myModal_archivos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <form action="{{route('guardar_archivos_cotizacion_path')}}" method="post" enctype="multipart/form-data">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h4 class="modal-title" id="myModalLabel">Lista de archivos</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body clearfix">
                                                        <div class="col-md-12 text-left">
                                                            <div class="row">
                                                                <div class="col-md-9 ">
                                                                    <div class="form-group">
                                                                        <label for="txt_archivo" class="font-weight-bold text-secondary">Agregar archivo</label>
                                                                        <input type="file" class="form-control" id="txt_archivo" name="txt_archivo">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 ">
                                                                    <div class="form-group">
                                                                        <label for="txt_archivo" class="font-weight-bold text-secondary">Formatos admitidos</label>
                                                                    </div>
                                                                    <i class="text-unset fas fa-image"></i>
                                                                    <i class="text-primary fas fa-file-word"></i>
                                                                    <i class="text-success fas fa-file-excel"></i>
                                                                    <i class="text-danger fas fa-file-pdf"></i>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12 caja_current">
                                                                    <p><b>Listado de archivos subidos</b></p>
                                                                    <ul class="list-inline gallery">
                                                                        @foreach($cotizacion_archivos as $cotizacion_archivo)
                                                                            <li id="arch_{{$cotizacion_archivo->id}}" class="border border-secondary rounded mb-1">
                                                                                <div class="row ">
                                                                                    <div class="col-2 text-center">
                                                                                        {{--<img class="thumbnail zoom" src="https://placeimg.com/110/110/abstract/1">--}}
                                                                                        @if($cotizacion_archivo->extension=='jpg' || $cotizacion_archivo->extension=='png')
                                                                                            @if (Storage::disk('cotizacion_archivos')->has($cotizacion_archivo->imagen))
                                                                                                <img class="thumbnail zoom" width="80px" height="75px" src="{{route('cotizacion_archivos_image_path', ['filename' => $cotizacion_archivo->imagen])}}" >
                                                                                            @endif
                                                                                        @elseif($cotizacion_archivo->extension=='doc' || $cotizacion_archivo->extension=='docx')
                                                                                            <i class="text-primary fas fa-file-word fa-3x"></i>
                                                                                        @elseif($cotizacion_archivo->extension=='xls' || $cotizacion_archivo->extension=='xlsx')
                                                                                            <i class="text-success fas fa-file-excel fa-3x"></i>
                                                                                        @elseif($cotizacion_archivo->extension=='pdf' )
                                                                                            <i class="text-danger fas fa-file-pdf fa-3x"></i>
                                                                                        @elseif($cotizacion_archivo->extension=='txt' )
                                                                                            <i class="text-info fas fa-file fa-3x"></i>
                                                                                        @endif
                                                                                    </div>
                                                                                    <div class="col-10">
                                                                                        <div class="row">
                                                                                            <div class="col-12">
                                                                                                <b>Nombre:</b> {{$cotizacion_archivo->nombre}}
                                                                                            </div>
                                                                                            <div class="col-12">
                                                                                                <b>Subido el:</b> {{$cotizacion_archivo->fecha_subida}} {{$cotizacion_archivo->hora_subida}}
                                                                                            </div>
                                                                                            <div class="col-12">
                                                                                                <div class="btn-group">
                                                                                                    {{-- <div class="col-1"> --}}
                                                                                                        <a class="btn btn-primary" href="{{route('cotizacion_archivos_image_download_path',[$cotizacion_archivo->imagen])}}" target="_blank"><i class="fas fa-cloud-download-alt"></i></a>
                                                                                                    {{-- </div>
                                                                                                    <div class="col-1"> --}}
                                                                                                        <a class="btn btn-danger" href="#!" onclick="eliminar_archivo('{{$cotizacion_archivo->id}}')"><i class="fas fa-trash-alt"></i></a>
                                                                                                    {{-- </div> --}}
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <b id="rpt_book_archivo" class="text-success"></b>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        {{csrf_field()}}
                                                        <input type="hidden" name="id" value="{{$cotizacion->id}}">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-primary">Subir archivo</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{--<div class="col-md-12 margin-top-10 ">--}}
                                    {{--<input type="hidden" id="nro_servicios_reservados" value="{{$nro_servicios_reservados}}">--}}
                                    {{--<input type="hidden" id="nro_servicios_total" value="{{$nro_servicios_total}}">--}}

                                    {{--<div class="progress">--}}
                                        {{--<div id="barra_porc" class="progress-bar {{$colo_progres}} progress-bar-striped active" role="progressbar" aria-valuenow="{{$porc_avance}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$porc_avance}}%;min-width: 2em;">--}}
                                            {{--{{$porc_avance}}%--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div class="col-md-12 d-none">
                                    <span class="pull-left pax-nav">
                                        <b>Travel date: no se</b>
                                    </span>
                                    <span class="pull-right">
                                        <a href="#" class="btn btn-link" style="text-decoration:none;"><i class="fa fa-lg fa-ban" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Ignore"></i></a>
                                    </span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mb-2">
                                    <div class="btn btn-group">
                                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#multiCollapseExample1" aria-expanded="false" aria-controls="multiCollapseExample1">Notas</button>
                                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">Pasajeros</button>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="collapse multi-collapse" id="multiCollapseExample1">
                                                <div class="card card-body">
                                                    {!! $cotizacion->notas !!}
                                                </div>
                                            </div>
                                            <div class="collapse multi-collapse" id="multiCollapseExample2">
                                                <div class="card card-body">
                                                    <table class="table table-bordered table-sm">
                                                        <thead>
                                                        <tr>
                                                            <th class="text-center">NOMBRES</th>
                                                            <th class="text-center">NACIONALIDAD</th>
                                                            <th class="text-center">PASAPORTE</th>
                                                            <th class="text-center">GENERO</th>
                                                            <th class="text-center">HOTEL</th>
                                                            <th class="text-center">DD/MM/AAAA | EDAD</th>
                                                            <th class="text-center d-none">RESTRICCIONES</th>
                                                            <th class="text-center">IDIOMA</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($cotizacion->cotizaciones_cliente as $coti_cliente)
                                                            @foreach($clientes1->where('id',$coti_cliente->clientes_id) as $cliente)
                                                                <tr>
                                                                    <td><i class="fas fa-user @if($coti_cliente->estado==1) text-success @endif"></i> {{strtoupper($cliente->nombres)}} {{strtoupper($cliente->apellidos)}}</td>
                                                                    <td>{{strtoupper($cliente->nacionalidad)}}</td>
                                                                    <td>{{strtoupper($cliente->pasaporte)}} <span class="badge badge-g-yellow">{{MisFunciones::fecha_peru($cliente->expiracion)}}</span> </td>
                                                                    <td>{{strtoupper($cliente->sexo)}}</td>
                                                                    <td>
                                                                        @foreach($cotizacion->paquete_cotizaciones as $paquete)
                                                                            @if($paquete->estado==2)
                                                                                @if($paquete->paquete_precios->count()==0)
                                                                                    CTA PAXS
                                                                                @else
                                                                                    @foreach($paquete->paquete_precios as $pqt_precio)
                                                                                        @if($pqt_precio->personas_s>0)
                                                                                            <span class="">SINGLE</span>
                                                                                        @endif
                                                                                        @if($pqt_precio->personas_d>0)
                                                                                            | <span class="">DOBLE</span>
                                                                                        @endif
                                                                                        @if($pqt_precio->personas_m>0)
                                                                                            | <span class="">MATRIMONIAL</span>
                                                                                        @endif
                                                                                        @if($pqt_precio->personas_t>0)
                                                                                            | <span class="">TRIPLE</span>
                                                                                        @endif
                                                                                    @endforeach
                                                                                @endif
                                                                            @endif
                                                                        @endforeach
                                                                    </td>
                                                                    <td>
                                                                        {{MisFunciones::fecha_peru($cliente->fechanacimiento)}}
                                                                        |
                                                                        {{\Carbon\Carbon::parse($cliente->fechanacimiento)->age }} años
                                                                    </td>
                                                                    <td class="d-none"><span class="text-11">{{strtoupper($cliente->restricciones)}}</span> </td>
                                                                    <td>{{strtoupper($cotizacion->idioma_pasajeros)}}</td>
                                                                </tr>
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

                            <table class="table table-bordered table-sm table-hover">
                                <thead>
                                    <tr class="bg-primary text-white">
                                        <th colspan="10">SERVICIOS</th>
                                    </tr>
                                    <tr class="small1">
                                        <th></th>
                                        <th class="d-none">GROUP</th>
                                        <th>SERVICE</th>
                                        <th class="d-none">DESTINATION</th>
                                        <th>CALCULO</th>
                                        <th>SALES</th>
                                        <th>RESERVED</th>
                                        <th>PROVIDER</th>
                                        <th>VERIFICATION CODE</th>
                                        <th>HOUR</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                    $sumatotal_v=0;
                                    $sumatotal_v_r=0;
                                @endphp
                                @foreach($cotizacion->paquete_cotizaciones as $paquete)
                                    @if($paquete->estado==2)
                                        @foreach($paquete->itinerario_cotizaciones->sortBy('dias') as $itinerario)
                                            @php
                                                $nro_servicios=0;
                                            @endphp
                                            @foreach($itinerario->itinerario_servicios as $servicios)
                                                @if($servicios->itinerario_proveedor)
                                                    @foreach($servicios->itinerario_proveedor as $proveedor)
                                                        @php
                                                            $nro_servicios++;
                                                        @endphp
                                                    @endforeach
                                                @endif
                                            @endforeach
                                            <tr>
                                                {{--<td rowspan="{{$nro_servicios}}"><b class="text-primary">Day {{$itinerario->dias}}</b></td>--}}
                                                <td class="bg-dark text-white" colspan="12">
                                                    <div class="row align-items-center">
                                                        <div class="col-10">
                                                        <b class="px-2"><i class="fas fa-angle-right"></i> Day {{$itinerario->dias}}</b>
                                                        <b class="text-18 badge badge-g-yellow">{{date("d/m/Y",strtotime($itinerario->fecha))}}</b>
                                                        <b>{{$itinerario->titulo}}</b>
                                                        </div>
                                                        <div class="col-2 text-right">
                                                            <!-- Large modal -->
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-warning float-right btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg_{{$itinerario->id}}"><i class="far fa-comment-alt"></i></button>
                                                                <a href="{{route('servicios_add_uno_path',[$cotizacion->id,$itinerario->id,$itinerario->dias])}}"  class="btn btn-primary float-left btn-sm">
                                                                        <i class="fas fa-glass-martini"></i>
                                                                </a>
                                                            </div>
                                                            <div class="modal fade bd-example-modal-lg_{{$itinerario->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <form id="guardar_notas_{{$itinerario->id}}" action="{{route('reservas_guadar_notas_path')}}" method="post">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header bg-primary">
                                                                                <h5 class="modal-title text-white" >Notas para el dia {{$itinerario->dias}}</h5>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form>
                                                                                    <div class="form-group">
                                                                                        <label for="message-text" class="col-form-label text-grey-goto">Notas:</label>
                                                                                        <textarea class="form-control" name="txt_nota" rows="10">{{$itinerario->notas}}</textarea>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                       <span id="rpt_nota_{{$itinerario->id}}"></span>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                {{csrf_field()}}
                                                                                <input type="hidden" name="id" value="{{$itinerario->id}}">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                <button type="button" class="btn btn-primary" onclick="guardar_nota('{{$itinerario->id}}')">Guardar nota</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @foreach($itinerario->itinerario_servicios->sortBy('pos') as $servicios)
                                                <tr id="servicio_{{$servicios->id}}" class="@if($servicios->anulado==1) {{'alert alert-danger'}} @endif">
                                                    <td class="text-center">
                                                        @php
                                                            $grupe='ninguno';
                                                            $destino='ninguno';
                                                            $tipoServicio='ninguno';
                                                            $clase='ninguno';
                                                        @endphp
                                                        {{-- @foreach($m_servicios->where('id',$servicios->m_servicios_id) as $m_ser) --}}
                                                            @if($servicios->grupo)
                                                                @php
                                                                    $grupe=$servicios->grupo;
                                                                @endphp
                                                            @endif
                                                            @if($servicios->localizacion)
                                                                @php
                                                                    $destino=$servicios->localizacion;
                                                                @endphp
                                                            @endif
                                                            @if($servicios->tipoServicio)
                                                                @php
                                                                    $tipoServicio=$servicios->tipoServicio;
                                                                @endphp
                                                            @endif
                                                            @if($servicios->clase)
                                                                @php
                                                                    $clase=$servicios->clase;
                                                                @endphp
                                                            @endif
                                                        {{-- @endforeach --}}
                                                        @if($grupe=='TOURS')
                                                            <i class="fas fa-map text-info" aria-hidden="true"></i>
                                                        @endif
                                                        @if($grupe=='MOVILID')
                                                            @if($clase=='BOLETO')
                                                                <i class="fas fa-ticket-alt text-warning" aria-hidden="true"></i>
                                                            @else
                                                                <i class="fa fa-bus text-warning" aria-hidden="true"></i>
                                                            @endif
                                                        @endif
                                                        @if($grupe=='REPRESENT')
                                                            <i class="fa fa-users text-success" aria-hidden="true"></i>
                                                        @endif
                                                        @if($grupe=='ENTRANCES')
                                                            <i class="fas fa-ticket-alt text-warning" aria-hidden="true"></i>
                                                        @endif
                                                        @if($grupe=='FOOD')
                                                            <i class="fas fa-utensils text-danger" aria-hidden="true"></i>
                                                        @endif
                                                        @if($grupe=='TRAINS')
                                                            <i class="fa fa-train text-info" aria-hidden="true"></i>
                                                        @endif
                                                        @if($grupe=='FLIGHTS')
                                                            <i class="fa fa-plane text-primary" aria-hidden="true"></i>
                                                        @endif
                                                        @if($grupe=='OTHERS')
                                                            <i class="fa fa-question fa-text-success" aria-hidden="true"></i>
                                                        @endif
                                                    </td>
                                                    <td class="d-none">{{$grupe}}</td>
                                                    <td class="lefts">
                                                        <span class="small">
                                                        <b>{{$servicios->nombre}}</b>
                                                        (<span class="small text-primary">{{$tipoServicio}}</span>)
                                                        @if($grupe=='FLIGHTS')
                                                            <a href="#!" id="boton_prove_{{$servicios->id}}" data-toggle="modal" data-target="#myModal_d_f_{{$servicios->id}}">
                                                                <i class="fa fa-plus-circle fa-2x"></i>
                                                            </a>
                                                            <div class="modal fade" id="myModal_d_f_{{$servicios->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <form action="{{route('guardar_datos_flights_path')}}" method="post">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                                <h4 class="modal-title" id="myModalLabel">Agregar datos</h4>
                                                                            </div>
                                                                            <div class="modal-body clearfix">
                                                                                <div class="col-md-12">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label for="txt_aereolinea" class="font-weight-bold text-secondary">Aerolinea</label>
                                                                                            <input type="text" class="form-control" id="txt_aereolinea" name="txt_aereolinea" value="{{$servicios->aerolinea}}">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label for="txt_nro_vuelo" class="font-weight-bold text-secondary">Nro. de vuelo</label>
                                                                                            <input type="text" class="form-control" id="txt_nro_vuelo" name="txt_nro_vuelo" value="{{$servicios->nro_vuelo}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <b id="rpt_book_proveedor_{{$servicios->id}}" class="text-success"></b>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                {{csrf_field()}}
                                                                                <input type="hidden" name="id" value="{{$servicios->id}}">
                                                                                <input type="hidden" name="cotizacion_id" value="{{$cotizacion->id}}">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                                <button type="submit" class="btn btn-primary">Guardar Datos</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if($grupe=='FLIGHTS')
                                                            <br>
                                                            <b class="text-green-goto">{{$servicios->aerolinea}}/{{$servicios->nro_vuelo}}</b>
                                                        @endif
                                                        @if($grupe=='TRAINS')
                                                            <b class="text-green-goto">[Sal: {{$servicios->salida}}-Lleg: {{$servicios->llegada}}]</b>
                                                        @endif
                                                    </span>
                                                    {{-- </td>
                                                    <td> --}}
                                                    <span class="small text-success">({{$destino}})</span></td>
                                                    @php
                                                        $mate='$';
                                                        $mate_SALE='$';
                                                    @endphp
                                                    @if($servicios->precio_grupo==1)
                                                        @php
                                                            $mate.=round($servicios->precio/$cotizacion->nropersonas,2);
                                                        @endphp
                                                    @else
                                                        @php
                                                            $mate.=$servicios->precio;
                                                        @endphp
                                                    @endif
                                                    @php
                                                        $person='<b class="text-primary">'.$cotizacion->nropersonas.'<i class="fa fa-male"></i></b>';
                                                    @endphp
                                                    {{--@for($i=1;$i<=$cotizacion->nropersonas;$i++)--}}
                                                    {{--@php--}}
                                                    {{--$person.=' <i class="fa fa-male"></i>';--}}
                                                    {{--@endphp--}}
                                                    {{--@endfor--}}

                                                    @php
                                                        $mate.=" x ".$person;
                                                    @endphp
                                                    @if($servicios->precio_grupo==1)
                                                        @php
                                                            $mate_SALE.=$servicios->precio;
                                                            $sumatotal_v+=$servicios->precio;
                                                            $sumatotal_v_r+=$servicios->precio_proveedor;
                                                        @endphp
                                                    @else
                                                        @php
                                                            $mate_SALE.=$servicios->precio*$cotizacion->nropersonas;
                                                            $sumatotal_v+=$servicios->precio*$cotizacion->nropersonas;
                                                            $sumatotal_v_r+=$servicios->precio_proveedor;
                                                        @endphp
                                                    @endif

                                                    <td  class="rights">
                                                        @if($servicios->precio_grupo==1)
                                                            {!! $mate !!}
                                                        @elseif($servicios->precio_grupo==0)
                                                            {!! $mate !!}
                                                        @endif
                                                        {{--<p class="@if($servicios->precio_grupo==1){{'d-none'}}@endif"><i class="fa fa-male" aria-hidden="true"></i> {{$servicios->precio*$cotizacion->nropersonas}} $--}}
                                                        {{--<a id="ipropover_{{$servicios->id}}" data-toggle="popover" title="Detalle" data-content="{{$mate}}"> <i class="fa fa-calculator text-primary" aria-hidden="true"></i></a>--}}
                                                        {{--</p>--}}
                                                        {{--<p class="@if($servicios->precio_grupo==0){{'d-none'}}@endif"><i class="fa fa-users" aria-hidden="true"></i> {{$servicios->precio}} $--}}
                                                        {{--<a id="propover_{{$servicios->id}}" data-toggle="popover" title="Detalle" data-content="{{$mate}}"> <i class="fa fa-calculator text-primary" aria-hidden="true"></i></a>--}}
                                                        {{--</p>--}}
                                                    </td>
                                                    <td class="rights">
                                                        {{$mate_SALE}}
                                                    </td>
                                                    {{--<td class="text-right">@if($servicios->precio_grupo==1){{$servicios->precio*2}}@else {{$servicios->precio}}@endif x {{$cotizacion->nropersonas}} = @if($servicios->precio_grupo==1){{$servicios->precio*2*$cotizacion->nropersonas}}@else {{$servicios->precio*$cotizacion->nropersonas}}@endif $</td>--}}
                                                    <td class="rights" id="book_precio_asig_{{$servicios->id}}">
                                                        @if($servicios->precio_proveedor)
                                                            <span id="costo_servicio_{{$servicios->id}}">${{$servicios->precio_proveedor}}</span>
                                                            <a href="#!" id="boton_prove_costo_{{$servicios->id}}" data-toggle="modal" data-target="#myModal_costo_{{$servicios->id}}">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <div class="modal fade" id="myModal_costo_{{$servicios->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <form id="asignar_proveedor_costo_path_{{$servicios->id}}" action="{{route('asignar_proveedor_costo_path')}}" method="post">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                                <h4 class="modal-title" id="myModalLabel">
                                                                                    @if($grupe=='TOURS')
                                                                                        <i class="fas fa-map text-info" aria-hidden="true"></i>
                                                                                    @endif
                                                                                    @if($grupe=='MOVILID')
                                                                                        <i class="fa fa-bus text-warning" aria-hidden="true"></i>
                                                                                    @endif
                                                                                    @if($grupe=='REPRESENT')
                                                                                        <i class="fa fa-users text-success" aria-hidden="true"></i>
                                                                                    @endif
                                                                                    @if($grupe=='ENTRANCES')
                                                                                        <i class="fas fa-ticket-alt text-warning" aria-hidden="true"></i>
                                                                                    @endif
                                                                                    @if($grupe=='FOOD')
                                                                                        <i class="fas fa-utensils text-danger" aria-hidden="true"></i>
                                                                                    @endif
                                                                                    @if($grupe=='TRAINS')
                                                                                        <i class="fa fa-train text-info" aria-hidden="true"></i>
                                                                                    @endif
                                                                                    @if($grupe=='FLIGHTS')
                                                                                        <i class="fa fa-plane text-primary" aria-hidden="true"></i>
                                                                                    @endif
                                                                                    @if($grupe=='OTHERS')
                                                                                        <i class="fa fa-question fa-text-success" aria-hidden="true"></i>
                                                                                    @endif
                                                                                    Editar Costo</h4>
                                                                            </div>
                                                                            <div class="modal-body clearfix">
                                                                                <div class="col-md-12">

                                                                                    <div class="form-group col-md-3">
                                                                                        <label for="txt_name">Costo actual</label>
                                                                                        <input type="number" class="form-control" id="book_price_edit_{{$servicios->id}}" name="txt_costo_edit" value="{{$servicios->precio_proveedor}}">
                                                                                    </div>
                                                                                    <div class="form-group col-md-9">
                                                                                        <label for="txt_name">Justificacion</label>
                                                                                        <input type="text" class="form-control" id="txt_justificacion_{{$servicios->id}}" name="txt_justificacion" value="{{$servicios->justificacion_precio_proveedor}}">
                                                                                    </div>

                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <b id="rpt_book_proveedor_costo_{{$servicios->id}}" class="text-success"></b>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                {{csrf_field()}}
                                                                                <input type="hidden" name="id" value="{{$servicios->id}}">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                                <button type="button" class="btn btn-primary" onclick="Guardar_proveedor_costo({{$servicios->id}})">Guardar cambios</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{--@else--}}
                                                            {{--<span id="book_precio_asig_{{$servicios->id}}"></span>--}}
                                                        @endif
                                                    </td>
                                                    <td class="boton">
                                                        <b class="small" id="book_proveedor_{{$servicios->id}}">
                                                            @if($servicios->itinerario_proveedor)
                                                                {{$servicios->itinerario_proveedor->nombre_comercial}}
                                                            @endif
                                                        </b>
                                                        @php
                                                            $grupe='ninguno';
                                                            $arreglito='GROUP_SIC'
                                                        @endphp
                                                            
                                                        @if(!$servicios->itinerario_proveedor)
                                                            @php
                                                                $grupe='ninguno';
                                                                $grupe=$servicios->grupo;
                                                            @endphp
                                                            {{-- @foreach($m_servicios->where('id',$servicios->m_servicios_id) as $m_ser)
                                                                @php
                                                                    $grupe=$m_ser->grupo;
                                                                @endphp
                                                            @endforeach --}}
                                                            @php
                                                                $arregloo[]='GROUP';
                                                                $arregloo[]='SIC';
                                                                $arregloo[]=$servicios->tipoServicio;
                                                                $arreglito='GROUP_SIC_'.$servicios->tipoServicio;
                                                            @endphp
                                                            <a href="#!" id="boton_prove_{{$servicios->id}}" data-toggle="modal" data-target="#myModal_{{$servicios->id}}" onclick="call_popup_servicios('lista_proveedores_srevicios_{{$servicios->id}}','{{$servicios->id}}','{{$arreglito}}','{{$cotizacion->id}}','{{$itinerario->id}}','a')">
                                                                <i class="fa fa-plus-circle fa-2x"></i>
                                                            </a>
                                                            <a id="boton_prove_borrar_{{$servicios->id}}" href="#!" class="text-danger d-none" onclick="call_popup_servicios_borrar('e_lista_proveedores_srevicios_{{$servicios->id}}','{{$servicios->id}}','{{$arreglito}}','{{$cotizacion->id}}','{{$itinerario->id}}','e')">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                            <div class="modal fade" id="myModal_{{$servicios->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                                <div class="modal-dialog modal-lg" role="document">
                                                                    <div class="modal-content">
                                                                        <form id="asignar_proveedor_path_{{$servicios->id}}" action="{{route('asignar_proveedor_path')}}" method="post">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title" id="myModalLabel">
                                                                                    @if($grupe=='TOURS')
                                                                                        <i class="fas fa-map text-info" aria-hidden="true"></i>
                                                                                    @endif
                                                                                    @if($grupe=='MOVILID')
                                                                                        <i class="fa fa-bus text-warning" aria-hidden="true"></i>
                                                                                    @endif
                                                                                    @if($grupe=='REPRESENT')
                                                                                        <i class="fa fa-users text-success" aria-hidden="true"></i>
                                                                                    @endif
                                                                                    @if($grupe=='ENTRANCES')
                                                                                        <i class="fas fa-ticket-alt text-warning" aria-hidden="true"></i>
                                                                                    @endif
                                                                                    @if($grupe=='FOOD')
                                                                                        <i class="fas fa-utensils text-danger" aria-hidden="true"></i>
                                                                                    @endif
                                                                                    @if($grupe=='TRAINS')
                                                                                        <i class="fa fa-train text-info" aria-hidden="true"></i>
                                                                                    @endif
                                                                                    @if($grupe=='FLIGHTS')
                                                                                        <i class="fa fa-plane text-primary" aria-hidden="true"></i>
                                                                                    @endif
                                                                                    @if($grupe=='OTHERS')
                                                                                        <i class="fa fa-question fa-text-success" aria-hidden="true"></i>
                                                                                    @endif
                                                                                    Asignar proveedor</h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                            </div>
                                                                            <div class="modal-body clearfix">
                                                                                <div class="col-md-12">
                                                                                    <p class="d-none">
                                                                                        {{$productos->where('localizacion',$servicios->localizacion)->where('grupo',$servicios->grupo)->whereIn('tipo_producto',$arregloo)->where('clase',$servicios->clase)->where('nombre',$servicios->nombre)->count()}}
                                                                                    </p>
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12 bg-green-goto">
                                                                                            <b class="small text-white">{{$servicios->nombre}}</b> |
                                                                                            <span class="small badge badge-g-yellow">{{$servicios->tipoServicio}}</span> |
                                                                                            <span class="small badge badge-g-yellow">{{$servicios->localizacion}}</span> |
                                                                                            <span class="small badge badge-g-yellow">{{date("d/m/Y",strtotime($itinerario->fecha))}}</span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div id="lista_proveedores_srevicios_{{$servicios->id}}" class="row mt-1">
                                                                                        
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 px-2">
                                                                                    <div class="row">
                                                                                        <div class="col-8  bg-green-goto  text-white">
                                                                                            <label >Files que se reservaron con el proveedor</label>
                                                                                            <div class="row">
                                                                                                <div class="col-12" id="lista_servicios_asignados_{{$servicios->id}}"></div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-4  bg-green-goto text-white">
                                                                                            <div class="row">
                                                                                                <div class="col-12">
                                                                                                    <div class="form-group" id="rpt_book_proveedor_fecha_{{$servicios->id}}">
                                                                                                        <label for="exampleInputEmail1">Fecha a pagar</label>
                                                                                                        <input type="date" class="form-control" name="fecha_pagar">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-12">
                                                                                                    <label class="form-check-label">
                                                                                                        Escoja la prioridad
                                                                                                    </label>
                                                                                                    <div class="row mt-3">
                                                                                                        <div class="col-md-6">
                                                                                                            <div class="form-check ">
                                                                                                                <label class="form-check-label">
                                                                                                                    <input type="radio" class="form-check-input" name="prioridad_{{$servicios->id}}[]" value="NORMAL" checked="checked">
                                                                                                                    NORMAL
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-6">
                                                                                                            <div class="form-check">
                                                                                                                <label class="form-check-label">
                                                                                                                    <input type="radio" class="form-check-input" name="prioridad_{{$servicios->id}}[]" value="URGENTE">
                                                                                                                    URGENTE
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <b id="rpt_book_proveedor_{{$servicios->id}}" class="text-success"></b>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                {{csrf_field()}}
                                                                                <input type="hidden" name="id_" value="{{$servicios->id}}">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                                <button type="button" class="btn btn-primary" onclick="Guardar_proveedor('{{$servicios->id}}','{{route('asignar_proveedor_costo_path')}}','{{csrf_token()}}','0')">Guardar cambios</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <a id="boton_prove_{{$servicios->id}}" href="#" class="" data-toggle="modal" data-target="#myModal_{{$servicios->id}}" onclick="call_popup_servicios('e_lista_proveedores_srevicios_{{$servicios->id}}','{{$servicios->id}}','{{$arreglito}}','{{$cotizacion->id}}','{{$itinerario->id}}','e')">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <a id="boton_prove_borrar_{{$servicios->id}}" href="#!" class="text-danger" onclick="call_popup_servicios_borrar('e_lista_proveedores_srevicios_{{$servicios->id}}','{{$servicios->id}}','{{$arreglito}}','{{$cotizacion->id}}','{{$itinerario->id}}','e')">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                            <div class="modal fade" id="myModal_{{$servicios->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                                <div class="modal-dialog modal-lg" role="document">
                                                                    <div class="modal-content">
                                                                        <form id="asignar_proveedor_path_{{$servicios->id}}" action="{{route('asignar_proveedor_path')}}" method="post">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title" id="myModalLabel">
                                                                                    @if($grupe=='TOURS')
                                                                                        <i class="fas fa-map text-info" aria-hidden="true"></i>
                                                                                    @endif
                                                                                    @if($grupe=='MOVILID')
                                                                                        <i class="fa fa-bus text-warning" aria-hidden="true"></i>
                                                                                    @endif
                                                                                    @if($grupe=='REPRESENT')
                                                                                        <i class="fa fa-users text-success" aria-hidden="true"></i>
                                                                                    @endif
                                                                                    @if($grupe=='ENTRANCES')
                                                                                        <i class="fas fa-ticket-alt text-warning" aria-hidden="true"></i>
                                                                                    @endif
                                                                                    @if($grupe=='FOOD')
                                                                                        <i class="fas fa-utensils text-danger" aria-hidden="true"></i>
                                                                                    @endif
                                                                                    @if($grupe=='TRAINS')
                                                                                        <i class="fa fa-train text-info" aria-hidden="true"></i>
                                                                                    @endif
                                                                                    @if($grupe=='FLIGHTS')
                                                                                        <i class="fa fa-plane text-primary" aria-hidden="true"></i>
                                                                                    @endif
                                                                                    @if($grupe=='OTHERS')
                                                                                        <i class="fa fa-question fa-text-success" aria-hidden="true"></i>
                                                                                    @endif
                                                                                    Editar proveedor</h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                                                            </div>
                                                                            <div class="modal-body clearfix">
                                                                                <div class="row">   
                                                                                    <div class="col-12">
                                                                                        @php
                                                                                        $producto_id_=0;   
                                                                                        @endphp
                                                                                        @if ($servicios->proveedor_id>0)
                                                                                            @php
                                                                                                $producto_id_=$servicios->proveedor_id;   
                                                                                            @endphp
                                                                                        @endif
                                                                                        {{-- if($servicios->servicio) --}}
                                                                                        <div class="row">
                                                                                            <div class="col-12 bg-green-goto">
                                                                                                <b class="small text-white">{{$servicios->nombre}}</b> |
                                                                                                <span class="small badge badge-g-yellow">{{$servicios->tipoServicio}}</span> |
                                                                                                <span class="small badge badge-g-yellow">{{$servicios->localizacion}}</span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div id="e_lista_proveedores_srevicios_{{$servicios->id}}" class="row px-1 mt-1">
                                                                                        </div>                                                                                        
                                                                                    </div>
                                                                                    <div class="col-12">
                                                                                        <div class="row">
                                                                                            <div class="col-8  bg-green-goto">
                                                                                                <label>Files que se reservaron con el proveedor</label>
                                                                                                <div class="row">
                                                                                                    <div class="col-12" id="lista_servicios_asignados_{{$servicios->id}}">
                                                                                                        @php
                                                                                                            $posicion=1;
                                                                                                        @endphp
                                                                                                        @foreach($cotizaciones_list as $cotizacion_lista)
                                                                                                            @foreach($cotizacion_lista->paquete_cotizaciones as $paquete_cotizacion_lista)
                                                                                                                @foreach($paquete_cotizacion_lista->itinerario_cotizaciones->where('fecha',$itinerario->fecha) as $itinerario_cotizacion_lista)
                                                                                                                    @foreach($itinerario_cotizacion_lista->itinerario_servicios->where('proveedor_id',$servicios->proveedor_id) as $itinerario_servicio_lista)
                                                                                                                        @php
                                                                                                                            $posicion++;
                                                                                                                        @endphp
                                                                                                                        @if($itinerario_servicio_lista->hora_llegada=='')
                                                                                                                            #{{$posicion}} {{$cotizacion_lista->codigo}} | {{$cotizacion_lista->nombre_pax}}x{{$cotizacion_lista->nropersonas}} {{date_format(date_create($cotizacion_lista->fecha), 'jS M Y')}} |<span class="badge badge-dark"> Dia {{$itinerario_cotizacion_lista->dias}}: {{MisFunciones::fecha_peru($itinerario_cotizacion_lista->fecha)}} Sin hora</span><br>
                                                                                                                        @else
                                                                                                                            #{{$posicion}} {{$cotizacion_lista->codigo}} | {{$cotizacion_lista->nombre_pax}}x{{$cotizacion_lista->nropersonas}} {{date_format(date_create($cotizacion_lista->fecha), 'jS M Y')}} |<span class="badge badge-dark"> Dia {{$itinerario_cotizacion_lista->dias}}: {{MisFunciones::fecha_peru($itinerario_cotizacion_lista->fecha)}} {{$itinerario_servicio_lista->hora_llegada}}</span><br>
                                                                                                                        @endif
                                                                                                                    @endforeach
                                                                                                                @endforeach
                                                                                                            @endforeach
                                                                                                        @endforeach
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-4  bg-green-goto">
                                                                                                <div class="row">
                                                                                                    <div class="col-12">
                                                                                                        <div class="form-group" id="rpt_book_proveedor_fecha_{{$servicios->id}}">
                                                                                                            <label for="exampleInputEmail1">Fecha a pagar</label>
                                                                                                            <input type="date" class="form-control" name="fecha_pagar" value="{{$servicios->fecha_venc}}">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-12">
                                                                                                        <label class="form-check-label">
                                                                                                            Escoja la prioridad
                                                                                                        </label>
                                                                                                        <div class="row mt-3">
                                                                                                            <div class="col-md-6">
                                                                                                                <div class="form-check ">
                                                                                                                    <label class="form-check-label">
                                                                                                                        <input type="radio" class="form-check-input" name="prioridad_{{$servicios->id}}[]" value="NORMAL" @if($servicios->prioridad=='NORMAL') checked="checked" @endif>
                                                                                                                        NORMAL
                                                                                                                    </label>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-6">
                                                                                                                <div class="form-check">
                                                                                                                    <label class="form-check-label">
                                                                                                                        <input type="radio" class="form-check-input" name="prioridad_{{$servicios->id}}[]" value="URGENTE"  @if($servicios->prioridad=='URGENTE') checked="checked" @endif>
                                                                                                                        URGENTE
                                                                                                                    </label>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12">
                                                                                        <b id="rpt_book_proveedor_{{ $servicios->id }}" class="text-success"></b>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                {{csrf_field()}}
                                                                                <input type="hidden" name="id_" value="{{$servicios->id}}">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                            <button type="button" class="btn btn-primary" onclick="Guardar_proveedor('{{$servicios->id}}','{{route('asignar_proveedor_costo_path')}}','{{csrf_token()}}','{{$producto_id_}}')">Editar cambios</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td class="boton">
                                                        @php
                                                            $codigo='primary';
                                                            $icon='save';
                                                            $codigo_h='primary';
                                                            $icon_h='save';
                                                        @endphp
                                                        @if($servicios->codigo_verificacion!='')
                                                            @php
                                                                $codigo='warning';
                                                                $icon='edit';
                                                            @endphp
                                                        @endif
                                                        @if($servicios->hora_llegada!='')
                                                            @php
                                                                $codigo_h='warning';
                                                                $icon_h='edit';
                                                            @endphp
                                                        @endif
                                                        @php
                                                            $mostrar='';
                                                        @endphp
                                                        {{--@if($grupe=='ENTRANCES' || ($grupe=='MOVILID' && $clase=='BOLETO'))--}}
                                                            {{--@php--}}
                                                                {{--$mostrar='d-none';--}}
                                                            {{--@endphp--}}
                                                        {{--@endif--}}
                                                        <form id="add_cod_verif_path_{{$servicios->id}}" class="form-inline" action="{{route('add_cod_verif_path')}}" method="post">
                                                            <div class="row margin-left-0">
                                                                {{csrf_field()}}
                                                                <input type="hidden" name="id" value="{{$servicios->id}}">
                                                                <input type="hidden" name="coti_id" value="{{$cotizacion->id}}">
                                                                <div class="col-lg-12 ">
                                                                    <div class="input-group">
                                                                        <input class="form-control" type="text" id="code_{{$servicios->id}}" name="code_{{$servicios->id}}" value="{{$servicios->codigo_verificacion}}">
                                                                        <span class="input-group-btn">
                                                                        <button type="submit"  onclick="Enviar_codigo_reserva({{$servicios->id}})" id="btn_{{$servicios->id}}"  class="btn btn-{{$codigo}}"><i class="fa fa-{{$icon}}" aria-hidden="true"></i></button>
                                                                    </span>
                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </form>
                                                    </td>
                                                    <td class="boton">
                                                        <form id="add_time_path_{{$servicios->id}}" class="{{$mostrar}} form-inline" action="{{route('add_time_path')}}" method="post">
                                                            <div class="row">
                                                                {{csrf_field()}}
                                                                <input type="hidden" name="id" value="{{$servicios->id}}">
                                                                <input type="hidden" name="coti_id" value="{{$cotizacion->id}}">
                                                                <div class="col-lg-12">
                                                                    <div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
                                                                        <input class="form-control" type="text" id="hora_{{$servicios->id}}" name="hora_{{$servicios->id}}" value="{{$servicios->hora_llegada}}">
                                                                        <span class="input-group-btn">
                                                                        <button type="submit" id="btn_hora_{{$servicios->id}}" onclick="Enviar_hora_reserva({{$servicios->id}})" class="btn btn-{{$codigo_h}}"><i class="fa fa-{{$icon_h}}" aria-hidden="true"></i></button>
                                                                    </span>
                                                                    </div>
                                                                    {{--<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">--}}
                                                                    {{--<input type="text" class="form-control" value="09:30">--}}
                                                                    {{--<span class="input-group-addon">--}}
                                                                    {{--<span class="glyphicon glyphicon-time"></span>--}}
                                                                    {{--</span>--}}
                                                                    {{--</div>--}}
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </td>
                                                    <td class="d-none">
                                                        @php
                                                            $esServ='false';
                                                        @endphp
                                                        {{-- @foreach($m_servicios->where('id',$servicios->m_servicios_id) as $serv) --}}
                                                            
                                                        @if($servicios->grupo=='TOURS')
                                                            @php
                                                                $esServ='true';
                                                            @endphp
                                                        @elseif($servicios->grupo=='REPRESENT')
                                                            @if($servicios->tipoServicio=='TRANSFER')

                                                                @php
                                                                    $esServ='true';
                                                                @endphp
                                                            @endif
                                                        @endif

                                                        {{-- @endforeach --}}
                                                        @if($esServ=='true')
                                                            @if($servicios->s_p=='PC')
                                                                <a class="btn btn-success" href="{{route('sp_path',[$cotizacion->id,$servicios->id,'SIC'])}}">PC</a>
                                                            @elseif($servicios->s_p=='SIC')
                                                                <a class="btn btn-primary" href="{{route('sp_path',[$cotizacion->id,$servicios->id,'PC'])}}">SIC</a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td class="boton d-none" id="estado_proveedor_serv_{{$servicios->id}}">
                                                        @if($servicios->itinerario_proveedor)
                                                            <i class="fa fa-check  text-success"></i>
                                                        @else
                                                            <i class="fas fa-clock text-unset"></i>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @php
                                                            $localizacion='';
                                                            $grupo='';
                                                        @endphp
                                                        {{-- @foreach($m_servicios->where('id',$servicios->m_servicios_id) as $res) --}}
                                                        @php
                                                            $localizacion=$servicios->localizacion;
                                                            $grupo=$servicios->grupo;
                                                        @endphp
                                                        {{-- @endforeach --}}
                                                        <div class="btn-group">
                                                            <input type="hidden" id="serv_anulado_{{$servicios->id}}" value="@if($servicios->anulado==1){{0}}@else{{1}}@endif">
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="anular_servicio_reservas('{{$servicios->id}}','{{$servicios->nombre}}','S')">
                                                                <i class="fa fa-ban"></i>
                                                            </button>
                                                            <button id="confim_{{$servicios->id}}" type="button" class="btn btn-sm" onclick="confirmar_servicio_reservas('{{$servicios->id}}','{{$servicios->nombre}}','S')">
                                                                @if($servicios->primera_confirmada==0)
                                                                    <i class="fas fa-unlock"></i>
                                                                @elseif($servicios->primera_confirmada==1)
                                                                    <i class="fas fa-lock text-success"></i>
                                                                @endif
                                                            </button>
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="eliminar_servicio_reservas('{{$servicios->id}}','{{$servicios->nombre}}','S')">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_servicio_{{$servicios->id}}" onclick="traer_servicios('{{$itinerario->id}}','{{$servicios->id}}','{{$localizacion}}','{{$grupo}}')">
                                                                <i class="fas fa-exchange-alt" aria-hidden="true"></i>
                                                            </button>
                                                        </div>
                                                        <!-- Modal -->
                                                        <div class="modal fade bd-example-modal-lg" id="modal_servicio_{{$servicios->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <form action="{{route('cambiar_servicio_path')}}" method="post">
                                                                        {{--                                                                <form action="{{route('destination_save_path')}}" method="post" id="destination_save_id" enctype="multipart/form-data">--}}
                                                                        <div class="modal-header">

                                                                            <h5 class="modal-title" id="exampleModalLabel">Cambiar servicio <span class="text-success"><i class="fa fa-map-marker" aria-hidden="true"></i> {{$localizacion}}</span></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="panel panel-default">
                                                                                        <div id="list_servicios_grupo_{{$servicios->id}}" class="panel-body">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            {{csrf_field()}}
                                                                            <input type="hidden" id="servicio_pos_{{$servicios->id}}" name="pos" value="{{$servicios->pos}}">
                                                                            <input type="hidden" name="impu" name="impu" value="servicio_cambiar_{{$itinerario->id}}_{{$grupo}}">
                                                                            <input type="hidden" id="servicio_antiguo_{{$servicios->id}}" name="id_antiguo" value="{{$servicios->id}}">
                                                                            <input type="hidden" name="p_itinerario_id" value="{{$itinerario->id}}">
                                                                            <input type="hidden" name="cotizacion_id" value="{{$cotizacion->id}}">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            {{--{{dd($itinerario->hotel)}}--}}
                                            @php
                                                $titulo_hotel_='';
                                                $titulo_hotel='';
                                            @endphp
                                            @foreach($itinerario->hotel as $hotel)
                                                <tr id="hotel_{{$hotel->id}}" class="@if($hotel->anulado==1) {{'alert alert-danger'}} @endif">
                                                    <td class="text-center">
                                                        <b>{{$hotel->estrellas}} <i class="fa fa-star text-warning" aria-hidden="true"></i></b>
                                                        @php
                                                            $titulo_hotel_='<p><b>Categoria:'.$hotel->estrellas.' <i class="fa fa-star text-warning" aria-hidden="true"></i></b></p>';
                                                        @endphp
                                                    </td>
                                                    <td>
                                                        @php
                                                            $total=0;
                                                            $total_book=0;
                                                            $cadena_total='';
                                                            $cadena_total_book='';
                                                        $cadena_total_coti='';
                                                        @endphp
                                                        @if($hotel->personas_s>0)
                                                            @php
                                                                $total+=$hotel->personas_s*$hotel->precio_s;
                                                                $total_book+=$hotel->personas_s*$hotel->precio_s_r;
                                                                $cadena_total.="<span>$".$hotel->precio_s." x ".$hotel->personas_s."</span><br>";
                                                                $cadena_total_coti.="<span>$".$hotel->personas_s*$hotel->precio_s."</span><br>";
                                                                if($hotel->precio_s_r){
                                                                    $cadena_total_book.="<span>$".$hotel->personas_s*$hotel->precio_s_r."</span><br>";
                                                                }
                                                                $sumatotal_v+=$hotel->personas_s*$hotel->precio_s;

                                                            @endphp
                                                            <span class="margin-bottom-5"><b>{{$hotel->personas_s}}</b> <span class="stick"><i class="fa fa-bed" aria-hidden="true"></i></span></span>(<span class="small text-primary">HOTEL</span>)
                                                            <span class="small text-success">({{$hotel->localizacion}})</span><br>
                                                            @php
                                                                $titulo_hotel.='<tr><td>'.$hotel->personas_s.'</td><td><span class="stick"><i class="fa fa-bed" aria-hidden="true"></i></span></span></td><td><span>$'.$hotel->precio_s.' x '.$hotel->personas_s.'</span></td><td><span>$'.$hotel->personas_s*$hotel->precio_s.'</span></td></tr>';
                                                            @endphp
                                                        @endif
                                                        @if($hotel->personas_d>0)
                                                            @php
                                                                $total+=$hotel->personas_d*$hotel->precio_d;
                                                                $total_book+=$hotel->personas_d*$hotel->precio_d_r;
                                                                $cadena_total.="<span>$".$hotel->precio_d." x ".$hotel->personas_d." </span><br>";
                                                                $cadena_total_coti.="<span>$".($hotel->personas_d*$hotel->precio_d)."</span><br>";
                                                                if($hotel->precio_d_r){
                                                                $cadena_total_book.="<span>$".($hotel->personas_d*$hotel->precio_d_r)."</span><br>";
                                                                }
                                                                $sumatotal_v+=$hotel->personas_d*$hotel->precio_d;

                                                            @endphp
                                                            <span class="margin-bottom-5"><b>{{$hotel->personas_d}}</b> <span class="stick"><i class="fa fa-bed" aria-hidden="true"></i> <i class="fa fa-bed" aria-hidden="true"></i></span></span>(<span class="small text-primary">HOTEL</span>)
                                                            <span class="small text-success">({{$hotel->localizacion}})</span><br>
                                                            @php
                                                                $titulo_hotel.='<tr><td>'.$hotel->personas_d.'</td><td><span class="stick"><i class="fa fa-bed" aria-hidden="true"></i><i class="fa fa-bed" aria-hidden="true"></i></span></span></td><td><span>$'.$hotel->precio_d.' x '.$hotel->personas_d.'</span></td><td><span>$'.$hotel->personas_d*$hotel->precio_d.'</span></td></tr>';
                                                            @endphp
                                                        @endif
                                                        @if($hotel->personas_m>0)
                                                            @php
                                                                $total+=$hotel->personas_m*$hotel->precio_m;
                                                                $total_book+=$hotel->personas_m*$hotel->precio_m_r;
                                                                $cadena_total.="<p>$".$hotel->precio_m." x ".($hotel->personas_m)."</p><br>";
                                                                $cadena_total_coti.="<p>$".$hotel->personas_m." x ".($hotel->precio_m)." </p><br>";
                                                                if($hotel->precio_m_r){
                                                                    $cadena_total_book.="<p>$".$hotel->personas_m." x ".($hotel->precio_m_r)." </p><br>";
                                                                }
                                                                $sumatotal_v+=$hotel->personas_m*$hotel->precio_m;

                                                            @endphp
                                                            <span class="margin-bottom-5"><b>{{$hotel->personas_m}}</b> <span class="stick"><i class="fa fa-venus-mars" aria-hidden="true"></i></span></span>(<span class="small text-primary">HOTEL</span>)
                                                            <span class="small text-success">({{$hotel->localizacion}})</span><br>
                                                            @php
                                                                $titulo_hotel.='<tr><td>'.$hotel->personas_m.'</td><td><span class="stick"><i class="fa fa-venus-mars" aria-hidden="true"></i></span></span></td><td><span>$'.$hotel->precio_m.' x '.$hotel->personas_m.'</span></td><td><span>$'.$hotel->personas_m*$hotel->precio_m.'</span></td></tr>';
                                                            @endphp
                                                        @endif
                                                        @if($hotel->personas_t>0)
                                                            @php
                                                                $total+=$hotel->personas_t*$hotel->precio_t;
                                                                $total_book+=$hotel->personas_t*$hotel->precio_t_r;
                                                                $cadena_total.="<span>$".$hotel->precio_t." x ".($hotel->personas_t)."</span><br>";
                                                                $cadena_total_coti.="<span>$".$hotel->personas_t." x ".($hotel->precio_t)."</span><br>";
                                                                if($hotel->precio_t_r){
                                                                    $cadena_total_book.="<span>$".$hotel->personas_t." x ".($hotel->precio_t_r)."</span><br>";
                                                                }
                                                                $sumatotal_v+=$hotel->personas_t*$hotel->precio_t;

                                                            @endphp
                                                            <span class="margin-bottom-5"><b>{{$hotel->personas_t}}</b> <span class="stick"><i class="fa fa-bed" aria-hidden="true"></i> <i class="fa fa-bed" aria-hidden="true"></i> <i class="fa fa-bed" aria-hidden="true"></i></span></span>(<span class="small text-primary">HOTEL</span>)
                                                            @php
                                                                $titulo_hotel.='<tr><td>'.$hotel->personas_t.'</td><td><span class="stick"><i class="fa fa-bed" aria-hidden="true"></i> <i class="fa fa-bed" aria-hidden="true"></i> <i class="fa fa-bed" aria-hidden="true"></i></span></span></td><td><span>$'.$hotel->precio_t.' x '.$hotel->personas_t.'</span></td><td><span>$'.$hotel->personas_t*$hotel->precio_t.'</span></td></tr>';
                                                            @endphp
                                                            <span class="small text-success">({{$hotel->localizacion}})</span>
                                                        @endif
                                                    {{-- </td>
                                                    <td> --}}
                                                        
                                                    </td>
                                                    <td class="rights">
                                                        {!! $cadena_total !!}

                                                        <p class="d-none"><i class="fa fa-users" aria-hidden="true"></i> {{$total}}
                                                            <a id="hpropover_{{$hotel->id}}" data-toggle="popover" title="Detalle" data-content="{{$cadena_total}}"> <i class="fa fa-calculator text-primary" aria-hidden="true"></i></a>
                                                        </p>
                                                    </td>
                                                    <td class="rights">
                                                        {!! $cadena_total_coti !!}
                                                    </td>
                                                    {{--<td class="text-right">@if($servicios->precio_grupo==1){{$servicios->precio*2}}@else {{$servicios->precio}}@endif x {{$cotizacion->nropersonas}} = @if($servicios->precio_grupo==1){{$servicios->precio*2*$cotizacion->nropersonas}}@else {{$servicios->precio*$cotizacion->nropersonas}}@endif $</td>--}}
                                                    @php
                                                        $sumatotal_v_r+=$total_book
                                                    @endphp
                                                    <td id="book_precio_asig_hotel_{{$hotel->id}}"  class="rights">
                                                        @if($hotel->personas_s>0)
                                                            {{-- @if($hotel->precio_s_r>0) --}}
                                                                <p id="book_price_edit_h_s_{{$hotel->id}}">${{$hotel->precio_s_r}}</p>
                                                            {{-- @endif --}}
                                                        @endif
                                                        @if($hotel->personas_d>0)
                                                            {{-- @if($hotel->precio_d_r>0) --}}
                                                                <p id="book_price_edit_h_d_{{$hotel->id}}">${{$hotel->precio_d_r}}</p>
                                                            {{-- @endif --}}
                                                        @endif
                                                        @if($hotel->personas_m>0)
                                                            {{-- @if($hotel->precio_m_r>0) --}}
                                                                <p id="book_price_edit_h_m_{{$hotel->id}}">${{$hotel->precio_m_r}}</p>
                                                            {{-- @endif --}}
                                                        @endif
                                                        @if($hotel->personas_t>0)
                                                            {{-- @if($hotel->precio_t_r>0) --}}
                                                                <p id="book_price_edit_h_t_{{$hotel->id}}">${{$hotel->precio_t_r}}</p>
                                                            {{-- @endif --}}
                                                        @endif

                                                        {{--{!! $cadena_total_book !!}--}}
                                                        @if($hotel->proveedor)
                                                            <a href="#!" id="boton_prove_hotel_edit_cost_{{$hotel->id}}" data-toggle="modal" data-target="#myModal_edit_cost_h_{{$hotel->id}}">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <div class="modal fade" id="myModal_edit_cost_h_{{$hotel->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content text-left">
                                                                        <form id="asignar_proveedor_hotel_costo_path_{{$hotel->id}}" action="{{route('asignar_proveedor_costo_hotel')}}" method="post">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-building" aria-hidden="true"></i> Editar costo del hotel</h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                                                            </div>
                                                                            <div class="modal-body clearfix">
                                                                                <table class="table m-0">
                                                                                    @php
                                                                                        $s=0;
                                                                                        $d=0;
                                                                                        $m=0;
                                                                                        $t=0;
                                                                                    @endphp
                                                                                    @if($hotel->personas_s>0)
                                                                                        @php
                                                                                            $s=$hotel->personas_s;
                                                                                        @endphp
                                                                                        @if($hotel->precio_s_r>0)
                                                                                            <tr class="text-left">
                                                                                                <td width="100px">
                                                                                                <span class="margin-bottom-5">
                                                                                                    <b>{{$hotel->personas_s}}</b>
                                                                                                    <span class="stick">
                                                                                                        <i class="fa fa-bed" aria-hidden="true"></i>
                                                                                                    </span>
                                                                                                </span>
                                                                                                </td>
                                                                                                <td width="100px">
                                                                                                    <input type="number" class="form-control" id="book_price_edit_h_s_p_{{$hotel->id}}" name="txt_costo_edit_s" value="{{$hotel->precio_s_r}}">
                                                                                                </td>
                                                                                            </tr>
                                                                                        @endif
                                                                                    @endif
                                                                                    @if($hotel->personas_d>0)
                                                                                        @php
                                                                                            $d=$hotel->personas_d;
                                                                                        @endphp
                                                                                        @if($hotel->precio_d_r>0)
                                                                                            <tr class="text-left">
                                                                                                <td width="100px">
                                                                                            <span class="margin-bottom-5">
                                                                                                <b>{{$hotel->personas_d}}</b>
                                                                                                <span class="stick">
                                                                                                    <i class="fa fa-bed" aria-hidden="true"></i> <i class="fa fa-bed" aria-hidden="true"></i>
                                                                                                </span>
                                                                                            </span>
                                                                                                </td>
                                                                                                <td width="100px">
                                                                                                    <input type="number" class="form-control" id="book_price_edit_h_d_p_{{$hotel->id}}" name="txt_costo_edit_d" value="{{$hotel->precio_d_r}}">
                                                                                                </td>
                                                                                            </tr>
                                                                                        @endif
                                                                                    @endif
                                                                                    @if($hotel->personas_m>0)
                                                                                        @php
                                                                                            $m=$hotel->personas_m;
                                                                                        @endphp
                                                                                        @if($hotel->precio_m_r>0)
                                                                                            <tr class="text-left">
                                                                                                <td width="100px">
                                                                                                <span class="margin-bottom-5">
                                                                                                    <b>{{$hotel->personas_m}}</b>
                                                                                                    <span class="stick">
                                                                                                        <i class="fa fa-venus-mars" aria-hidden="true"></i>
                                                                                                    </span>
                                                                                                </span>
                                                                                                </td>
                                                                                                <td width="100px">
                                                                                                    <input type="number" class="form-control" id="book_price_edit_h_m_p_{{$hotel->id}}" name="txt_costo_edit_m" value="{{$hotel->precio_m_r}}">
                                                                                                </td>
                                                                                            </tr>
                                                                                        @endif
                                                                                    @endif
                                                                                    @if($hotel->personas_t>0)
                                                                                        @php
                                                                                            $t=$hotel->personas_t;
                                                                                        @endphp
                                                                                        {{-- @if($hotel->precio_t_r>0) --}}
                                                                                            <tr class="text-left">
                                                                                                <td width="100px">
                                                                                                <span class="margin-bottom-5">
                                                                                                    <b>{{$hotel->personas_t}}</b>
                                                                                                    <span class="stick">
                                                                                                        <i class="fa fa-bed" aria-hidden="true"></i> <i class="fa fa-bed" aria-hidden="true"></i>
                                                                                                    </span>
                                                                                                </span>
                                                                                                </td>
                                                                                                <td width="100px">
                                                                                                    <input type="number" class="form-control" id="book_price_edit_h_t_p_{{$hotel->id}}" name="txt_costo_edit_t" value="{{$hotel->precio_t_r}}">
                                                                                                </td>
                                                                                            </tr>
                                                                                        {{-- @endif --}}
                                                                                    @endif
                                                                                </table>
                                                                                <div class="col-md-12">
                                                                                    <b id="rpt_precio_proveedor_hotel_{{$hotel->id}}" class="text-success"></b>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                {{csrf_field()}}
                                                                                <input type="hidden" name="id" value="{{$hotel->id}}">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                                <button type="button" class="btn btn-primary" onclick="Guardar_proveedor_hotel_costo('{{$hotel->id}}','{{$s}}','{{$d}}','{{$m}}','{{$t}}')">Guardar cambios</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <p class="d-none"> {{$total_book}}
                                                            <a id="h_rpropover_{{$hotel->id}}" data-toggle="popover" title="Detalle" data-content="{{$cadena_total_book}}"> <i class="fa fa-calculator text-primary" aria-hidden="true"></i></a>
                                                        </p>
                                                    </td>
                                                    <td class="boton">
                                                        <b class="small" id="book_proveedor_hotel_{{$hotel->id}}">
                                                            @if($hotel->proveedor)
                                                                {{$hotel->proveedor->nombre_comercial}}
                                                            @endif
                                                        </b>
                                                        <a href="#!" id="boton_prove_hotel_{{$hotel->id}}" data-toggle="modal" data-target="#myModal_h_{{$hotel->id}}" onclick="call_popup('{{$hotel->estrellas}}','{{$hotel->localizacion}}','lista_proveedores_{{$hotel->id}}','{{$hotel->id}}','{{$itinerario->id}}','{{$cotizacion->id}}')">
                                                            @if($hotel->proveedor)
                                                                <i class="fa fa-edit"></i>
                                                            @else
                                                                <i class="fa fa-plus-circle fa-2x"></i>
                                                            @endif
                                                        </a>
                                                        <a id="boton_prove_borrar_h_{{$hotel->id}}" href="#!" class="text-danger @if(!$hotel->proveedor) d-none @endif " onclick="call_popup_servicios_borrar_h('{{$hotel->id}}')">
                                                                    <i class="fas fa-trash"></i>
                                                        </a>

                                                        <div class="modal fade" id="myModal_h_{{$hotel->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    @php
                                                                        $s=0;
                                                                        $d=0;
                                                                        $m=0;
                                                                        $t=0;
                                                                    @endphp
                                                                    <form id="asignar_proveedor_hotel_path_{{$hotel->id}}" action="{{route('asignar_proveedor_hotel_path')}}" method="post">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-building" aria-hidden="true"></i> Lista de proveedores para el hotel</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                                                        </div>
                                                                        <div class="modal-body clearfix">
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                        {!!$titulo_hotel_!!}
                                                                                        <table class="table table-hover table-responsive table-bordered table-stripe ">
                                                                                            <thead>
                                                                                                <tr>
                                                                                                    <th>Cantidad</th>
                                                                                                    <th>Acomodación</th>
                                                                                                    <th>Calculo</th>
                                                                                                    <th>Sale</th>
                                                                                                </tr>  
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                {!! $titulo_hotel !!}
                                                                                            </tbody>
                                                                                        </table>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <div class="row">
                                                                                        @php
                                                                                            $posicion=0
                                                                                        @endphp
                                                                                        <div class="col-12 px-3" id="lista_proveedores_{{$hotel->id}}">
                                                                                            @foreach($cotizaciones_list as $cotizacion_lista)
                                                                                                @foreach($cotizacion_lista->paquete_cotizaciones as $paquete_cotizacion_lista)
                                                                                                    @foreach($paquete_cotizacion_lista->itinerario_cotizaciones->where('fecha',$itinerario->fecha) as $itinerario_cotizacion_lista)
                                                                                                        @foreach($itinerario_cotizacion_lista->hotel->where('proveedor_id',$hotel->proveedor_id) as $itinerario_servicio_lista)
                                                                                                            @php
                                                                                                                $posicion++;
                                                                                                            @endphp
                                                                                                            @if($itinerario_servicio_lista->hora_llegada=='')
                                                                                                                #{{$posicion}} {{$cotizacion_lista->codigo}} | {{$cotizacion_lista->nombre_pax}}x{{$cotizacion_lista->nropersonas}} {{date_format(date_create($cotizacion_lista->fecha), 'jS M Y')}} |<span class="badge badge-dark"> Dia {{$itinerario_cotizacion_lista->dias}}: {{MisFunciones::fecha_peru($itinerario_cotizacion_lista->fecha)}} Sin hora</span><br>
                                                                                                            @else
                                                                                                                #{{$posicion}} {{$cotizacion_lista->codigo}} | {{$cotizacion_lista->nombre_pax}}x{{$cotizacion_lista->nropersonas}} {{date_format(date_create($cotizacion_lista->fecha), 'jS M Y')}} |<span class="badge badge-dark"> Dia {{$itinerario_cotizacion_lista->dias}}: {{MisFunciones::fecha_peru($itinerario_cotizacion_lista->fecha)}} {{$itinerario_servicio_lista->hora_llegada}}</span><br>
                                                                                                            @endif
                                                                                                        @endforeach
                                                                                                    @endforeach
                                                                                                @endforeach
                                                                                            @endforeach
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 bg-green-goto text-white">
                                                                                    <div class="row">
                                                                                        <div class="col-7 bg-green-goto">
                                                                                            <label>Files que se reservaron con el proveedor</label>
                                                                                            <div class="row">
                                                                                                <div class="col-12" id="lista_servicios_asignados_h_{{$hotel->id}}"></div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-5 bg-green-goto">                                                          
                                                                                            <div class="row">
                                                                                                <div class="col-12">
                                                                                                    <div class="form-group" id="rpt_book_proveedor_fecha_h_{{$hotel->id}}">
                                                                                                        <label for="exampleInputEmail1">Fecha a pagar</label>
                                                                                                        <input type="date" class="form-control" name="fecha_pagar" value="{{$hotel->fecha_venc}}">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-12">
                                                                                                    <label class="form-check-label">
                                                                                                        Escoja la prioridad
                                                                                                    </label>
                                                                                                    <div class="row mt-3">
                                                                                                        <div class="col-6">
                                                                                                            <div class="form-check">
                                                                                                                <label class="form-check-label">
                                                                                                                    <input type="radio" class="form-check-input" name="prioridad_{{$hotel->id}}[]" value="NORMAL" @if($hotel->prioridad=='NORMAL')checked="checked"@endif>
                                                                                                                    NORMAL
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-6">
                                                                                                            <div class="form-check">
                                                                                                                <label class="form-check-label">
                                                                                                                    <input type="radio" class="form-check-input" name="prioridad_{{$hotel->id}}[]" value="URGENTE"@if($hotel->prioridad=='URGENTE')checked="checked"@endif>
                                                                                                                    URGENTE
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <b id="rpt_book_proveedor_hotel_{{$hotel->id}}" class="text-success"></b>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            {{csrf_field()}}
                                                                            <input type="hidden" name="itinerario_paquete_id" value="{{$paquete->id}}">
                                                                            <input type="hidden" name="id" value="{{$hotel->id}}">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                            <button type="submit" class="btn btn-primary" onclick1="Guardar_proveedor_hotel('{{$hotel->id}}','{{route('asignar_proveedor_costo_hotel')}}','{{csrf_token()}}','{{$s}}','{{$d}}','{{$m}}','{{$t}}')">
                                                                                @if($hotel->proveedor)
                                                                                    Editar cambios
                                                                                @else
                                                                                    Guardar cambios
                                                                                @endif
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </td>
                                                    <td class="boton">
                                                        @php
                                                            $codigo_ho='primary';
                                                            $icon_ho='save';
                                                            $codigo_hora='primary';
                                                            $icon_hora='save';
                                                        @endphp
                                                        @if($hotel->codigo_verificacion!='')
                                                            @php
                                                                $codigo_ho='warning';
                                                                $icon_ho='edit';
                                                            @endphp
                                                        @endif
                                                        @if($hotel->hora_llegada!='')
                                                            @php
                                                                $codigo_hora='warning';
                                                                $icon_hora='edit';
                                                            @endphp
                                                        @endif
                                                        <form id="add_cod_verif_hotel_path_{{$hotel->id}}" class="form-inline" action="{{route('add_cod_verif_hotel_path')}}" method="post">
                                                            <div class="row margin-left-0">
                                                                {{csrf_field()}}
                                                                <input type="hidden" name="id" value="{{$hotel->id}}">
                                                                <input type="hidden" name="coti_id" value="{{$cotizacion->id}}">
                                                                <div class="col-lg-12">
                                                                    <div class="input-group">
                                                                        <input class="form-control" type="text" id="code_{{$hotel->id}}" name="code_{{$hotel->id}}" value="{{$hotel->codigo_verificacion}}">
                                                                        <span class="input-group-btn">
                                                                             <button type="submit" onclick="Enviar_codigo_reserva_hotel({{$hotel->id}})" id="btn_h_{{$hotel->id}}" class="btn btn-{{$codigo_ho}}"><i class="fa fa-{{$icon_ho}}" aria-hidden="true"></i></button>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </td>
                                                    <td class="boton">
                                                        <form id="add_hora_hotel_path_{{$hotel->id}}" class="form-inline" action="{{route('add_hora_hotel_path')}}" method="post">
                                                            <div class="row">
                                                                {{csrf_field()}}
                                                                <input type="hidden" name="id" value="{{$hotel->id}}">
                                                                <input type="hidden" name="coti_id" value="{{$cotizacion->id}}">
                                                                <div class="col-lg-12">
                                                                    <div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
                                                                        <input class="form-control" type="text" id="hora_{{$hotel->id}}" name="hora_{{$hotel->id}}" value="{{$hotel->hora_llegada}}">
                                                                        <span class="input-group-btn">
                                                                 <button type="submit" onclick="Enviar_hora_reserva_hotel({{$hotel->id}})" id="btn_hora_h_{{$hotel->id}}" class="btn btn-{{$codigo_hora}}"><i class="fa fa-{{$icon_hora}}" aria-hidden="true"></i></button>
                                                            </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </td>
                                                    <td class="boton d-none" id="estado_proveedor_serv_hotel_{{$hotel->id}}">
                                                        @if($hotel->proveedor)
                                                            <i class="fa fa-check fa-2x text-success"></i>
                                                        @else
                                                            <i class="fas fa-clock fa-2x text-unset"></i>
                                                        @endif
                                                    </td>
                                                    <td class="boton">
                                                        <input type="hidden" id="hotel_anulado_{{$hotel->id}}" value="@if($hotel->anulado==1){{0}}@else{{1}}@endif">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="anular_servicio_reservas('{{$hotel->id}}','Hotel {{$hotel->estrellas}} estrellas','H')">
                                                                <i class="fa fa-ban"></i>
                                                            </button>
                                                            <button id="confim_h_{{$hotel->id}}" type="button" class="btn btn-sm" onclick="confirmar_servicio_reservas('{{$hotel->id}}','Hotel {{$hotel->estrellas}} estrellas','H')">
                                                                @if($hotel->primera_confirmada==0)
                                                                    <i class="fas fa-unlock"></i>
                                                                @elseif($hotel->primera_confirmada==1)
                                                                    <i class="fas fa-lock text-success"></i>
                                                                @endif
                                                            </button>
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="eliminar_servicio_reservas('{{$hotel->id}}','Hotel {{$hotel->estrellas}} estrellas','H')">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_hotel_h_{{$hotel->id}}" onclick="traer_servicios('{{$itinerario->id}}','{{$hotel->id}}','{{$hotel->localizacion}}','HOTELS')">
                                                                <i class="fas fa-exchange-alt" aria-hidden="true"></i>
                                                            </button>
                                                        </div>
                                                        <!-- Modal -->
                                                        <div class="modal fade bd-example-modal-lg" id="modal_hotel_h_{{$hotel->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <form  id="frm_cambiar_hotel_{{$hotel->id}}" action="{{route('cambiar_hotel_reservas_path')}}" method="post">
                                                                        {{--                                                                <form action="{{route('destination_save_path')}}" method="post" id="destination_save_id" enctype="multipart/form-data">--}}
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Cambiar Hotel <span class="text-primary"><i class="fa fa-map-marker" aria-hidden="true"></i> {{$hotel->localizacion}}</span></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="panel panel-default">
                                                                                        <div id="list_servicios_h_grupo_{{$hotel->id}}" class="panel-body">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            {{csrf_field()}}
                                                                            <input type="hidden" id="servicio_pos_{{$servicios->id}}" name="pos" value="{{$servicios->pos}}">
                                                                            <input type="hidden" name="impu" name="impu" value="servicio_cambiar_{{$itinerario->id}}_{{$grupo}}">
                                                                            <input type="hidden" id="servicio_antiguo_{{$servicios->id}}" name="id_antiguo" value="{{$servicios->id}}">
                                                                            <input type="hidden" name="p_itinerario_id" value="{{$itinerario->id}}">
                                                                            <input type="hidden" name="itinerario_cotizaciones_id" value="{{$hotel->itinerario_cotizaciones_id}}">
                                                                            <input type="hidden" name="precio_hotel_reserva_id" value="{{$hotel->id}}">
                                                                            <input type="hidden" name="cotizacion_id" value="{{$cotizacion->id}}">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            <button type="button" class="btn btn-primary" onclick="preparar_envio_hotel('frm_cambiar_hotel_{{$hotel->id}}')">Save changes</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    @endif
                                @endforeach
                                </tbody>
                                <tbody class="d-none">
                                <tr>
                                    <td colspan="4"><b>Total</b></td>
                                    <td class="text-right h5 text-g-yellow"><b><sup>$</sup>{{$sumatotal_v}}</b></td>
                                    <td class="text-right h5 text-info"><b><sup>$</sup>{{$sumatotal_v_r}}</b></td>
                                </tr>
                                </tbody>
                            </table>
                            <form id="form_guardar_reserva" action="{{route('confirmar_reserva_path')}}" method="post">
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        <input type="hidden" name="cotizacion_id" value="{{$cotizacion->id}}">
                                        {{csrf_field()}}
                                        <button type="submit" class="btn btn-lg btn-success">Enviar a contabilidad
                                            <i class="far fa-thumbs-up" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="panel panel-default d-none">
                                <div class="panel-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a data-toggle="tab" href="#detalle">Detalle</a></li>
                                        <li><a data-toggle="tab" href="#resumen">Resumen</a></li>
                                        <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="detalle" class="tab-pane fade in active">

                                        </div>
                                        <div id="resumen" class="tab-pane fade ">
                                            {{--<table class="table table-bordered tb table-striped table-responsive table-hover">--}}
                                            {{--<thead>--}}
                                            {{--<tr>--}}
                                            {{--<th>GRUPO</th>--}}
                                            {{--<th>PROVEEDOR</th>--}}
                                            {{--<th>NOMBRE COMERCIAL</th>--}}
                                            {{--<th>FECHA DE SERVICIO</th>--}}
                                            {{--<th>CATEGORIA</th>--}}
                                            {{--<th>FECHA PROGRAMADA</th>--}}
                                            {{--<th>TOTAL</th>--}}
                                            {{--</tr>--}}
                                            {{--</thead>--}}
                                            {{--<tbody>--}}
                                            {{--@foreach($ItinerarioServiciosAcumPagos as $ItinerarioServiciosAcumPago)--}}
                                            {{--<tr>--}}
                                            {{--<th>{{$ItinerarioServiciosAcumPago->grupo}}</th>--}}
                                            {{--<th>--}}
                                            {{--@foreach($proveedores->where('id',$ItinerarioServiciosAcumPago->proveedor_id) as $proveedor)--}}
                                            {{--{{$proveedor->r_nombres}}--}}
                                            {{--@endforeach--}}
                                            {{--</th>--}}
                                            {{--<th>--}}
                                            {{--@foreach($proveedores->where('id',$ItinerarioServiciosAcumPago->proveedor_id) as $proveedor)--}}
                                            {{--{{$proveedor->nombre_comercial}}--}}
                                            {{--@endforeach--}}
                                            {{--</th>--}}
                                            {{--<th>{{$ItinerarioServiciosAcumPago->fecha_servicio}}</th>--}}
                                            {{--<th>--}}
                                            {{--@if($cotizacion->categorizado=='C')--}}
                                            {{--Con factura--}}
                                            {{--@else@if($cotizacion->categorizado=='S')--}}
                                            {{--sin factura--}}
                                            {{--@endif--}}
                                            {{--</th>--}}
                                            {{--<th>{{$ItinerarioServiciosAcumPago->fecha_a_pagar}}</th>--}}
                                            {{--<th>{{$ItinerarioServiciosAcumPago->a_cuenta}}</th>--}}
                                            {{--</tr>--}}
                                            {{--@endforeach--}}
                                            {{--</tbody>--}}
                                            {{--</table>--}}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
@stop
