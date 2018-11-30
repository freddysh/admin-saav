@extends('.layouts.admin.admin')
@section('archivos-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        .ui-autocomplete {
            z-index: 5000 !important;
        }
        /**THE SAME CSS IS USED IN ALL 3 DEMOS**/
        /**gallery margins**/
        ul.gallery{
            margin-left: 3vw;
            margin-right:3vw;
        }

        .zoom {
            -webkit-transition: all 0.35s ease-in-out;
            -moz-transition: all 0.35s ease-in-out;
            transition: all 0.35s ease-in-out;
            cursor: -webkit-zoom-in;
            cursor: -moz-zoom-in;
            cursor: zoom-in;
        }

        .zoom:hover,
        .zoom:active,
        .zoom:focus {
            /**adjust scale to desired size,
            add browser prefixes**/
            -ms-transform: scale(2.5);
            -moz-transform: scale(2.5);
            -webkit-transform: scale(2.5);
            -o-transform: scale(2.5);
            transform: scale(2.5);
            position:relative;
            z-index:100;
        }

        /**To keep upscaled images visible on mobile,
        increase left & right margins a bit**/
        @media only screen and (max-width: 768px) {
            ul.gallery {
                margin-left: 15vw;
                margin-right: 15vw;
            }

            /**TIP: Easy escape for touch screens,
            give gallery's parent container a cursor: pointer.**/
            .DivName {cursor: pointer}
        }
    </style>
@stop
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white m-0">
            <li class="breadcrumb-item" aria-current="page"><a href="/">Home</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="/">Qoutes</a></li>
            <li class="breadcrumb-item active">Current Planes</li>
        </ol>
    </nav>
    <hr>
    <div class="row">
        <div class="col">
            @foreach($cotizacion as $cotizacion1)
                @php
                    $cotizacion_=$cotizacion1;
                @endphp
            @endforeach
            <a href="{{route('new_plan_cotizacion_path',$cotizacion_->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Nuevo Plan</a>
        </div>
    </div>
    <form class="d-none"  action="{{route('cotizacion_show_path')}}" method="post" id="package_new_path_id">
        <div class="row">
            <div class="col">
                <h4 class="font-montserrat text-orange-goto"><span class="label bg-orange-goto">1</span> Search client</h4>
                <div class="divider margin-bottom-20"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="txt_name">Name</label>
                    <input type="text" class="form-control" id="txt_name" name="txt_name" placeholder="Name" required>
                </div>
            </div>
            <div class="col-md-3 text-center margin-top-20">
                {{csrf_field()}}
                <button type="submit" class="btn btn-lg btn-primary">Search <i class="fa fa-search-plus" aria-hidden="true"></i></button>
            </div>
        </div>

    </form>

    <div id="lista_cotizacione" class="row">
        @php
        $planes[]='A';
        $planes[]='B';
        $planes[]='C';
        $planes[]='D';
        $planes[]='E';
        $planes[]='F';
        $planes[]='G';
        $planes[]='H';
        $planes[]='I';
        $planes[]='K';
        $planes[]='L';
        $planes[]='M';
        $planes[]='N';
        $planes[]='O';
        $planes[]='P';
        $planes[]='Q';
        $planes[]='R';
        $planes[]='S';
        $pos_plan=0;
        $cotizacion_=null;
        @endphp
        @if($cotizacion!=null)
            @foreach($cotizacion as $cotizacion1)
                @php
                $cotizacion_=$cotizacion1;
                @endphp
            @endforeach
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

                @foreach($cotizacion_->paquete_cotizaciones->take(1) as $paquete)
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
                            @if($servicios->min_personas<= $cotizacion_->nropersonas&&$cotizacion_->nropersonas <=$servicios->max_personas)
                            @else
                                @php
                                    $rango=' ';
                                @endphp
                            @endif
                            @if($servicios->precio_grupo==1)
                                @php
                                    $precio_iti+=round($servicios->precio/$cotizacion_->nropersonas,2);
                                    $preciom=round($servicios->precio/$cotizacion_->nropersonas,2);
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
                    @foreach($cotizacion_->paquete_cotizaciones->take(1) as $paquete)
                        @php
                            $valor=$precio_iti+$paquete->utilidad;
                        @endphp
                    @endforeach
                @elseif($nro_dias>1)
                    @if(($s+$d+$m+$t)==0)
                        @foreach($cotizacion_->paquete_cotizaciones->take(1) as $paquete)
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
            <table class="table table-striped table-bordered table-hover table-responsive my-5">
                <thead>
                <th>
                    <td>PLAN</td>
                    <td>FILE</td>
                    <td>TOTAL</td>
                    <td>DETALLE</td>
                    <td>EDITAR</td>
                    <td>PDF</td>
                    <td>LINK</td>
                    <td>CREAR TEMPLATE</td>
                    <td>AGREGAR ARCHIVOS</td>
                    <td>AGREGAR NOTAS</td>
                    <td>PEDIR DATOS</td>
                    <td>REVISAR DATOS</td>
                    <td>ESTADO</td>
                </th>
                </thead>
                <tbody>


            @foreach($cotizacion_->paquete_cotizaciones as $paquete)
                <tr>
                    <td></td>
                    <td>PLAN {{$planes[$pos_plan]}}</td>
                    <td>
                        @php
                            $date = date_create($cotizacion_->fecha);
                            $fecha=date_format($date, 'jS F Y');
                            $titulo='';
                            $name='';
                            $email='';
                        @endphp
                        @foreach($cotizacion_->cotizaciones_cliente as $cliente_coti)
                            @if($cliente_coti->estado=='1')
                                @php
                                    $name=$cliente_coti->cliente->nombres.' '.$cliente_coti->cliente->apellidos;
                                    $email=$cliente_coti->cliente->email;
                                    $titulo=$cliente_coti->cliente->nombres.' '.$cliente_coti->cliente->apellidos.' x '.$cotizacion_->nropersonas.' '.$fecha;
                                @endphp
                                <small>
                                    <b><i class="text-success"> {{$cotizacion_->codigo}}</i> | {{$cliente_coti->cliente->nombres}}X{{$cotizacion_->nropersonas}}</b> ({{$fecha}})
                                </small>
                            @endif
                        @endforeach
                    </td>
                    <td><small class="display-block text-primary"><sup>$</sup>{{$valor}}</small></td>
                    <td><a class="text-primary" href="#!" data-toggle="tooltip" data-placement="top" title="Detalles"><b><i class="fa fa-eye" aria-hidden="true"></i></b></a></td>
                    <td><a class="text-warning" href="{{route('show_current_paquete_edit_path',[$paquete->id])}}" data-toggle="tooltip" data-placement="top" title="Edit Plan"><b><i class="fa fa-edit" aria-hidden="true"></i></b></a></td>
                    <td><a class="text-danger" href="{{route('quotes_pdf_path',$paquete->id)}}" data-toggle="tooltip" data-placement="top" title="Export PDF"><b><i class="fas fa-file-pdf" aria-hidden="true"></i></b></a></td>
                    <td><a class="text-primary" target="_blank" href="http://yourtrip.gotoperu.com.pe/coti/{{$cotizacion_->id}}-{{$paquete->id}}" data-toggle="tooltip" data-placement="top" title="Generate Link"><b><i class="fa fa-link" aria-hidden="true"></i></b></a></td>
                    <td><a href="{{route('generar_pantilla1_path',[$paquete->id,$cotizacion_->id])}}" class="text-success small"><i class="fas fa-plus-circle" aria-hidden="true"></i> Create Template</a></td>
                    <td>
                        <botton class="btn btn-primary" href="#!" id="archivos" data-toggle="modal" data-target="#myModal_archivos">
                            <i class="fas fa-file-alt"></i>
                        </botton>
                        <div class="modal fade" id="myModal_archivos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <form action="{{route('guardar_archivos_cotizacion_path')}}" method="post" enctype="multipart/form-data">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">Agregar archivos</h4>
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
                                                        <i class="text-unset fas fa-image fa-2x"></i>
                                                        <i class="text-primary fas fa-file-word fa-2x"></i>
                                                        <i class="text-success fas fa-file-excel fa-2x"></i>
                                                        <i class="text-danger fas fa-file-pdf fa-2x"></i>
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
                                                                                    <div class="row">
                                                                                        <div class="col-1">
                                                                                            <a class="btn btn-primary" href="{{route('cotizacion_archivos_image_download_path',[$cotizacion_archivo->imagen])}}" target="_blank"><i class="fas fa-cloud-download-alt"></i></a>
                                                                                        </div>
                                                                                        <div class="col-1">
                                                                                            <a class="btn btn-danger" href="#!" onclick="eliminar_archivo('{{$cotizacion_archivo->id}}')"><i class="fas fa-trash-alt"></i></a>
                                                                                        </div>
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
                                            <input type="hidden" name="id" value="{{$cotizacion_->id}}">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Subir archivo</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <a href="#!" class="text-unset small" data-toggle="modal" data-target="#Modal_notas_{{$paquete->id}}">
                            <i class="fas fa-list-alt" aria-hidden="true"></i>Agregar notas
                        </a>
                        <div class="modal fade" id="Modal_notas_{{$paquete->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <form id="ingresar_notas_{{$paquete->id}}" action="{{route('package_cotizacion_notas_path')}}" method="post">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Agregar notas</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-auto">
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">Notas Generales</div>
                                                    </div>
                                                    <textarea class="form-control" id="r_dir_notas" name="r_dir_notas" cols="30" rows="10">{{$cotizacion_->notas}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <b id="response_notas_{{$paquete->id}}" class="text-22"></b>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="cotizacion_id" value="{{$cotizacion_->id}}">
                                            <input type="hidden" name="pqt_id" value="{{$paquete->id}}">
                                            {{csrf_field()}}
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" onclick="ingresar_notas('{{$paquete->id}}')">Guardar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </td>
                    <td>
                        <a id="pedir_datos_{{$paquete->id}}" href="#!" class="@if($paquete->pedir_datos>0) {{'text-succcess'}} @else {{'text-primary'}}@endif small" data-toggle="modal" data-target="#Modal_pedir_info_{{$paquete->id}}">
                            <i class="fas fa-list-alt" aria-hidden="true"></i>Pedir Datos
                        </a>
                        <div class="modal fade" id="Modal_pedir_info_{{$paquete->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form id="ask_request_{{$paquete->id}}" action="{{route('package_cotizacion_ask_information_path')}}" method="post">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Request Information</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-auto">
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">Name</div>
                                                    </div>
                                                    <input type="text" class="form-control" id="r_name" name="r_name" value="{{$name}}">
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">Email</div>
                                                    </div>
                                                    <input type="text" class="form-control" id="r_email" name="r_email" value="{{$email}}">
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <b id="response_{{$paquete->id}}" class="text-22"></b>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            {{--<input type="hidden" name="estado" value="0">--}}
                                            <input type="hidden" name="cotizacion_id" value="{{$cotizacion_->id}}">
                                            <input type="hidden" name="pqt_id" value="{{$paquete->id}}">
                                            {{--                                                            <input type="hidden" id="pedir_datos_{{$paquete->id}}" name="pedir_datos" value="@if($paquete->pedir_datos>0){{'0'}}@else{{'1'}}@endif">--}}
                                            {{csrf_field()}}
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" onclick="enviar_ask_request('{{$paquete->id}}')">Send</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <a href="http://yourtrip.gotoperu.com.pe/booking_information_full/{{$cotizacion_->id}}-{{$paquete->id}}" class="text-unset small" target="_blank"><i class="fas fa-users" aria-hidden="true"></i> Revisar Datos</a>
                    </td>
                    <td>

                        @if($paquete->estado==2)
                            <input type="hidden" id="confirmado" value="1">
                            <a id="caja_confirmar" href="#!" class="text-success small" onclick="confirmar_enviar_email($('#confirmado').val(),'{{$paquete->id}}')"><i class="fas fa-check" aria-hidden="true"></i> Confirmado</a>
                            {{--<a href="{{route('escojer_pqt_plan',$paquete->id)}}" class="pull-right btn btn-success btn-sm"><i class="fa fa-check" aria-hidden="true"></i></a>--}}
                        @else
                            <input type="hidden" id="confirmado" value="2">
                            <a id="caja_confirmar" href="#!" class="text-primary small" onclick="confirmar_enviar_email($('#confirmado').val(),'{{$paquete->id}}')"><i class="fas fa-check" aria-hidden="true"></i> Confirmar</a>
                            {{--<a href="{{route('escojer_pqt_plan',$paquete->id)}}" class="pull-right btn btn-default btn-sm"><i class="fa fa-check" aria-hidden="true"></i></a>--}}
                        @endif
                    </td>
                </tr>

                    @php
                        $servicio = 0;
                        $st_precio=0;
                    @endphp
                    @foreach($paquete->itinerario_cotizaciones as $paquete_itinerario)
                        @foreach($paquete_itinerario->itinerario_servicios as $orden_cotizaciones)
                            @php
                                $total = $orden_cotizaciones->precio + $servicio;
                                $servicio = $total;
                            @endphp
                        @endforeach
                    @endforeach
                <div class="modal fade bd-example-modal-lg" id="modal_planes_{{$paquete->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <form action="{{route('escojer_precio_paquete_path')}}" method="post" id="destination_edit_id" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        <?php
                                        $date = date_create($cotizacion_->fecha);
                                        $fecha=date_format($date, 'jS F Y');
                                        $name='';
                                        $email='';
                                        ?>
                                        @foreach($cotizacion_->cotizaciones_cliente as $cliente_coti)
                                            @if($cliente_coti->estado=='1')
                                                @php
                                                    $name=$cliente_coti->cliente->nombres.' '.$cliente_coti->cliente->apellidos;
                                                    $email=$cliente_coti->cliente->email;
                                                @endphp
                                                <b class="text-primary">{{$cliente_coti->cliente->nombres}} {{$cliente_coti->cliente->apellidos}} x {{$cotizacion_->nropersonas}} {{$fecha}} del plan {{$planes[$pos_plan]}}</b>
                                            @endif
                                        @endforeach

                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txt_codigo">Category</label>
                                                <select class="form-control" id="categoria" name="categoria">
                                                    @php
                                                        $array_acomodacion=array();
                                                    @endphp
                                                    @if($cotizacion_->star_2==2)
                                                        <option value="2">2 STARS</option>
                                                    @endif
                                                    @if($cotizacion_->star_3==3)
                                                        <option value="3">3 STARS</option>
                                                    @endif
                                                    @if($cotizacion_->star_4==4)
                                                        <option value="4">4 STARS</option>
                                                    @endif
                                                    @if($cotizacion_->star_5==5)
                                                        <option value="5">5 STARS</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txt_codigo">Travelers </label>
                                                <input type="number" class="form-control" id="travelers" name="travelers" min="0" value="{{$cotizacion_->nropersonas}}">
                                            </div>
                                        </div>
                                        <div class="col-md-3 margin-top-25">
                                            <button type="button" class="btn btn-primary" onclick="mostrar_categoria('{{$paquete->id}}')">Show</button>
                                        </div>
                                    </div>
                                    @php
                                        $array_2='';
                                        $array_3='';
                                        $array_4='';
                                        $array_5='';
                                    @endphp
                                    @foreach($paquete->paquete_precios as $precio_paquete2)
                                        @if($precio_paquete2->estado == 1)
                                            <div id="star_{{$precio_paquete2->estrellas}}" class="hide">
                                                <h5 class="no-margin"><b>CATEGORIA: {{$precio_paquete2->estrellas}} ESTRELLAS</b></h5>
                                                <table class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                                                    <thead>
                                                    <tr>
                                                        <th>Nro</th>
                                                        <th>Acomodacion</th>
                                                        <th class="text-right">Total ($)</th>
                                                    </tr>

                                                    @if($precio_paquete2->personas_s > 0)
                                                        @if($precio_paquete2->estrellas==2)
                                                            @php
                                                                $array_2.='1_';
                                                            @endphp
                                                        @endif
                                                        @if($precio_paquete2->estrellas==3)
                                                            @php
                                                                $array_3.='1_';
                                                            @endphp
                                                        @endif
                                                        @if($precio_paquete2->estrellas==4)
                                                            @php
                                                                $array_4.='1_';
                                                            @endphp
                                                        @endif
                                                        @if($precio_paquete2->estrellas==5)
                                                            @php
                                                                $array_5.='1_';
                                                            @endphp
                                                        @endif
                                                        <tr width="50px">
                                                            <td class="col-md-1"><input class="form-control" type="number" name="s_{{$precio_paquete2->estrellas}}" id="s_{{$precio_paquete2->estrellas}}" min="0"></td>
                                                            <td class="text-left"><b>Simple</b></td>
                                                            <td class="text-right">
                                                                @php
                                                                    $precio_s = (($precio_paquete2->precio_s)* 1) * ($paquete->duracion - 1);
                                                                    $total_costo = $precio_s + $total;
                                                                    $total_utilidad = $total_costo + ($total_costo * (($precio_paquete2->utilidad)/100));
                                                                @endphp
                                                                <span id="detalle_p_s_{{$precio_paquete2->estrellas}}"></span>
                                                                <span class="hide" id="hp_s_{{$precio_paquete2->estrellas}}">{{number_format(ceil($total_utilidad), 2, '.', '')}}</span>
                                                                <span id="p_s_{{$precio_paquete2->estrellas}}">{{number_format(ceil($total_utilidad), 2, '.', '')}}</span>
                                                            </td>

                                                        </tr>
                                                    @else
                                                        @php
                                                            $precio_s = 0;
                                                        @endphp
                                                    @endif
                                                    @if($precio_paquete2->personas_d > 0)
                                                        @if($precio_paquete2->estrellas==2)
                                                            @php
                                                                $array_2.='2_';
                                                            @endphp
                                                        @endif
                                                        @if($precio_paquete2->estrellas==3)
                                                            @php
                                                                $array_3.='2_';
                                                            @endphp
                                                        @endif
                                                        @if($precio_paquete2->estrellas==4)
                                                            @php
                                                                $array_4.='2_';
                                                            @endphp
                                                        @endif
                                                        @if($precio_paquete2->estrellas==5)
                                                            @php
                                                                $array_5.='2_';
                                                            @endphp
                                                        @endif
                                                        <tr>
                                                            <td ><input class="form-control" type="number" name="d_{{$precio_paquete2->estrellas}}" id="d_{{$precio_paquete2->estrellas}}" min="0"></td>

                                                            <td class="text-left"><b>Doble</b></td>
                                                            <td class="text-right">
                                                                @php
                                                                    $precio_d = ceil(($precio_paquete2->precio_d)* (1/2)) * ($paquete->duracion - 1);
                                                                    $total_costo = $precio_d + $total;
                                                                    $total_utilidad = $total_costo + ($total_costo * (($precio_paquete2->utilidad)/100));
                                                                @endphp
                                                                <span id="detalle_p_d_{{$precio_paquete2->estrellas}}"></span>
                                                                <span class="hide" id="hp_d_{{$precio_paquete2->estrellas}}">{{number_format(ceil($total_utilidad), 2, '.', '')}}</span>
                                                                <span id="p_d_{{$precio_paquete2->estrellas}}">{{number_format(ceil($total_utilidad), 2, '.', '')}}</span>
                                                            </td>
                                                        </tr>
                                                    @else
                                                        @php
                                                            $precio_d = 0;
                                                        @endphp
                                                    @endif
                                                    @if($precio_paquete2->personas_m > 0)
                                                        @if($precio_paquete2->estrellas==2)
                                                            @php
                                                                $array_2.='4_';
                                                            @endphp
                                                        @endif
                                                        @if($precio_paquete2->estrellas==3)
                                                            @php
                                                                $array_3.='4_';
                                                            @endphp
                                                        @endif
                                                        @if($precio_paquete2->estrellas==4)
                                                            @php
                                                                $array_4.='4_';
                                                            @endphp
                                                        @endif
                                                        @if($precio_paquete2->estrellas==5)
                                                            @php
                                                                $array_5.='4_';
                                                            @endphp
                                                        @endif
                                                        <tr>
                                                            <td ><input class="form-control" type="number" name="m_{{$precio_paquete2->estrellas}}" id="m_{{$precio_paquete2->estrellas}}" min="0"></td>

                                                            <td class="text-left"><b>Matrimonial</b></td>
                                                            <td class="text-right">
                                                                @php
                                                                    $precio_m = ceil(($precio_paquete2->precio_d)* (1/2)) * ($paquete->duracion - 1);
                                                                    $total_costo = $precio_m + $total;
                                                                    $total_utilidad = $total_costo + ($total_costo * (($precio_paquete2->utilidad)/100));
                                                                @endphp
                                                                <span id="detalle_p_m_{{$precio_paquete2->estrellas}}"></span>
                                                                <span class="hide" id="hp_m_{{$precio_paquete2->estrellas}}">{{number_format(ceil($total_utilidad), 2, '.', '')}}</span>
                                                                <span id="p_m_{{$precio_paquete2->estrellas}}">{{number_format(ceil($total_utilidad), 2, '.', '')}}</span>
                                                            </td>
                                                        </tr>
                                                    @else
                                                        @php
                                                            $precio_m = 0;
                                                        @endphp
                                                    @endif
                                                    @if($precio_paquete2->personas_t > 0)
                                                        @if($precio_paquete2->estrellas==2)
                                                            @php
                                                                $array_2.='3_';
                                                            @endphp
                                                        @endif
                                                        @if($precio_paquete2->estrellas==3)
                                                            @php
                                                                $array_3.='3_';
                                                            @endphp
                                                        @endif
                                                        @if($precio_paquete2->estrellas==4)
                                                            @php
                                                                $array_4.='3_';
                                                            @endphp
                                                        @endif
                                                        @if($precio_paquete2->estrellas==5)
                                                            @php
                                                                $array_5.='3_';
                                                            @endphp
                                                        @endif
                                                        <tr>
                                                            <td><input class="form-control" type="number" name="t_{{$precio_paquete2->estrellas}}" id="t_{{$precio_paquete2->estrellas}}" min="0"></td>

                                                            <td class="text-left"><b>Triple</b></td>
                                                            <td class="text-right">
                                                                @php
                                                                    $precio_t = ceil(($precio_paquete2->precio_t)* (1/3)) * ($paquete->duracion - 1);
                                                                    $total_costo = $precio_t + $total;
                                                                    $total_utilidad = $total_costo + ($total_costo * (($precio_paquete2->utilidad)/100));
                                                                @endphp
                                                                <span id="detalle_p_t_{{$precio_paquete2->estrellas}}"></span>
                                                                <span class="hide" id="hp_t_{{$precio_paquete2->estrellas}}">{{number_format(ceil($total_utilidad), 2, '.', '')}}</span>
                                                                <span id="p_t_{{$precio_paquete2->estrellas}}">{{number_format(ceil($total_utilidad), 2, '.', '')}}</span>
                                                            </td>
                                                        </tr>
                                                    @else
                                                        @php
                                                            $precio_t = 0;
                                                        @endphp
                                                    @endif
                                                    </thead>
                                                </table>
                                                <div class="text-right">
                                                    <b class="text-25">Precio del paquete: $<span id="total_{{$precio_paquete2->estrellas}}" class=" text-success"></span></b>
                                                </div>
                                                <input type="hidden" id="precio_paquete_id" name="precio_paquete_id_{{$precio_paquete2->estrellas}}"   value="{{$precio_paquete2->id}}">
                                            </div>
                                        @endif
                                    @endforeach

                                </div>
                                <div class="modal-footer">
                                    <input type="text" name="plan_{{$paquete->id}}_2" id="plan_{{$paquete->id}}_2" value="{{$array_2}}">
                                    <input type="text" name="plan_{{$paquete->id}}_3" id="plan_{{$paquete->id}}_3" value="{{$array_3}}">
                                    <input type="text" name="plan_{{$paquete->id}}_4" id="plan_{{$paquete->id}}_4" value="{{$array_4}}">
                                    <input type="text" name="plan_{{$paquete->id}}_5" id="plan_{{$paquete->id}}_5" value="{{$array_5}}">
                                    {{csrf_field()}}
                                    <input type="hidden" id="pos" name="pos" value="0">

                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                    <?php
                    $pos_plan++;
                    ?>
            @endforeach
                </tbody>
            </table>
            <input type="hidden" name="nro_planes" id="nro_planes" value="{{$pos_plan}}">
        @endif
    </div>

    <script>
        function confirmar_enviar_email(valor,id){
           $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('[name="_token"]').val()
                }
            });
            $.ajax({
                type: 'GET',
                url: "{{route('escojer_pqt_plan')}}",
                data: 'id='+id+'&valor='+valor,
                // Mostramos un mensaje con la respuesta de PHP
                beforeSend: function(data1){
                    $('#caja_confirmar').html('<i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i><span class="sr-only">Loading...</span>');
                },
                success: function(data) {
                    console.log(data);
                    if(data==1) {
                        if (valor == '2') {
                            $('#caja_confirmar').removeClass('text-primary');
                            $('#caja_confirmar').addClass('text-success');
                            $('#caja_confirmar').html('<i class="fas fa-check" aria-hidden="true"></i> Confirmado');
                            $('#confirmado').val('1');
                        }
                        else {
                            $('#caja_confirmar').removeClass('text-success');
                            $('#caja_confirmar').addClass('text-primary');
                            $('#caja_confirmar').html('<i class="fas fa-check" aria-hidden="true"></i> Confirmar');
                            $('#confirmado').val('2');
                        }
                    }
                }
            })
        }
        $(function () {
            $('#txt_name').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "buscar-cotizacion",
                        dataType: "json",
                        data: {
                            term : request.term
                            {{--localizacion : $("#localizacion1_{{$i}}").val(),--}}
                            {{--grupo : '{{$tipoServicio_}}'--}}
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                minLength: 1
            });
        });
    </script>
@stop
