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
            $paquete_id=0;
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
                    <div class="row">
                        <div class="col-12">
                                <ul class="nav nav-tabs nav-justified">
                                        <li class="nav-item active">
                                            <a data-toggle="tab" role="tab" aria-controls="pills-home" aria-selected="true" href="#itinerario" class="nav-link show active rounded-0">Itinerario</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="itinerario" class="tab-pane fade show active">
                                            <div class="row text-12">
                                                <div class="col-9">
                                                    <b class="text-primary">By:{{$usuario->where('id',$cotizacion->users_id)->first()->name}}</b>, 
                                                    <b class="text-primary"> <i class="fas fa-calendar"></i> {{ MisFunciones::fecha_peru($cotizacion->fecha_venta)}}</b>
                                                    <b class="text-20">|</b>
                                                    @foreach($cotizacion->cotizaciones_cliente as $clientes)
                                                        @if($clientes->estado==1)
                                                            {{--<h1 class="panel-title pull-left" style="font-size:30px;">Hidalgo <small>hidlgo@gmail.com</small></h1>--}}
                                                            <b class="text-info text-20">Cod:{{$cotizacion->codigo}}</b><b class="text-20"> | </b><b class="panel-title pull-left text-20">{{$cotizacion->nombre_pax}} x {{$cotizacion->nropersonas}} {{date_format(date_create($cotizacion->fecha), ' l jS F Y')}}</b>
                                                            <b class="text-warning padding-left-10"> (X{{$cotizacion->nropersonas}})</b>
                                                            @for($i=0;$i<$cotizacion->nropersonas;$i++)
                                                                <i class="fa fa-male fa-2x"></i>
                                                            @endfor
                                                        @endif
                                                    @endforeach
                                                    <i class="fa fa-check d-none text-success" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Hidalgo esta activo"></i>
                                                    <b class="text-success text-20">@if($cotizacion->categorizado=='C'){{'Con factura'}}@elseif($cotizacion->categorizado=='S'){{'Sin factura'}}@else{{'No esta filtrado'}}@endif</b>
                                                    
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
                                                <div class="col-3 text-right margin-top-10">
                                                    {{--  popap para subir y descargar archivos  --}}
                                                    <button class="btn btn-primary" href="#!" id="archivos" data-toggle="modal" data-target="#myModal_archivos">
                                                        <i class="fas fa-file-alt"></i>
                                                    </button>
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
                                                                        <input type="hidden" name="id" value="{{$cotizacion->id}}">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                        <button type="submit" class="btn btn-primary">Subir archivo</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>                                
                                                    @php
                                                        $nro_servicios_total=0;
                                                        $nro_servicios_reservados=0;
                                                    @endphp
                                                    @foreach($cotizacion->paquete_cotizaciones as $paquete)
                                                        @if($paquete->estado==2)
                                                        @php
                                                            $paquete_id=$paquete->id;
                                                        @endphp
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
                                                    <button class="btn btn-primary">
                                                        <span id="barra_porc">{{$porc_avance}}%</span>
                                                    </button>
                                                </div>
                                            </div>                            
                                            <table class="table table-bordered table-sm text-12">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">NOMBRES</th>
                                                    <th class="text-center">NACIONALIDAD</th>
                                                    <th class="text-center">PASAPORTE</th>
                                                    <th class="text-center">GENERO</th>
                                                    <th class="text-center">HOTEL</th>
                                                    <th class="text-center">FECHA DE NAC. | EDAD</th>
                                                    <th class="text-center d-none">RESTRICCIONES</th>
                                                    <th class="text-center">IDIOMA</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($cotizacion->cotizaciones_cliente as $coti_cliente)
                                                    @foreach($clientes1->where('id',$coti_cliente->clientes_id) as $cliente)
                                                        <tr>
                                                            <td>{{strtoupper($cliente->nombres)}} {{strtoupper($cliente->apellidos)}}</td>
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
                                                                                    <span class="text-warning">SINGLE</span>
                                                                                @endif
                                                                                @if($pqt_precio->personas_d>0)
                                                                                    | <span class="text-warning">DOBLE</span>
                                                                                @endif
                                                                                @if($pqt_precio->personas_m>0)
                                                                                    | <span class="text-warning">MATRIMONIAL</span>
                                                                                @endif
                                                                                @if($pqt_precio->personas_t>0)
                                                                                    | <span class="text-warning">TRIPLE</span>
                                                                                @endif
                                                                            @endforeach
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                {{MisFunciones::fecha_peru($cliente->fechanacimiento)}}
                                                                |
                                                                {{\Carbon\Carbon::parse($cliente->fechanacimiento)->age }} años</td>
                                                            <td class="d-none"><span class="text-11">{{strtoupper($cliente->restricciones)}}</span> </td>
                                                            <td>{{strtoupper($cotizacion->idioma_pasajeros)}}</td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                                </tbody>
                                            </table>

                                            {{-- DISEÑO DE LA NUEVA DITRIBUCION --}}
                                            <div class="row">
                                                <div class="col-6 bg-primary text-white text-center">BOLETA</div>
                                                <div class="col-6 bg-info text-white text-center">FACTURA</div>
                                            </div>
                                            @php
                                                $sumatotal_v=0;
                                                $sumatotal_v_r=0;
                                                $sumatotal_v_c=0;
                                                $sumatotal_v_boleta=0;
                                                $sumatotal_v_r_boleta=0;
                                                $sumatotal_v_c_boleta=0;
                                                $sumatotal_v_factura=0;
                                                $sumatotal_v_r_factura=0;
                                                $sumatotal_v_c_factura=0;

                                                $profit=0;
                                                $nro_c_boleta_='';
                                                $sub_monto_boleta_=0;
                                                $monto_c_boleta_=0;
                                                $monto_c_profit_=0;
                                                $nro_c_factura_='';
                                                $monto_c_factura_=0;
                                                $monto_c_vendido_=0;
                                                $facturado_estado=0;
                                            @endphp
                                            
                                        @foreach($cotizacion->paquete_cotizaciones as $paquete)
                                            @if($paquete->estado==2)
                                                @if ($paquete->facturado_estado==1)
                                                    @php
                                                        $facturado_estado=$paquete->facturado_estado;
                                                        $nro_c_boleta_=$paquete->c_nro_boleta;
                                                        $sub_monto_boleta_=$paquete->c_sub_monto_boleta;
                                                        $monto_c_boleta_=$paquete->c_monto_boleta;
                                                        $monto_c_profit_=$paquete->c_monto_profit;
                                                        $nro_c_factura_=$paquete->c_nro_factura;
                                                        $monto_c_factura_=$paquete->c_monto_factura;
                                                    @endphp
                                                @endif
                                                @if($paquete->duracion==1)
                                                    @php
                                                        $profit=$paquete->utilidad*$cotizacion->nropersonas;
                                                    @endphp   
                                                @else
                                                    @php
                                                        $nro_personas=0;
                                                        $uti=0;
                                                    @endphp
                                                    
                                                    @if($paquete->paquete_precios->count()>=1)
                                                        @foreach($paquete->paquete_precios as $precio)
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
                                                                $profit=$paquete->utilidad*$cotizacion->nropersonas;    
                                                            @endphp
                                                        @endif   
                                                    
                                                    @else
                                                        @php
                                                            $profit=$paquete->utilidad*$cotizacion->nropersonas;    
                                                        @endphp
                                                    @endif
                                                @endif

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
                                                    @php
                                                        $itinerario->hotel->count();
                                                    @endphp
                                                    <div class="row">
                                                        <div class="col-12 bg-dark">
                                                            <b class="text-white"><i class="fas fa-angle-right"></i>DAY {{$itinerario->dias}}</b>
                                                            <b class="badge badge-warning">{{date("d/m/Y",strtotime($itinerario->fecha))}}</b>
                                                            <b class="text-white">{{$itinerario->titulo}}</b>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div id="b_{{$itinerario->id}}" class="col-6">
                                                            @foreach($itinerario->itinerario_servicios->sortBy('pos')/*->whereIn('grupo',$paraBoleta)*/ as $servicios)
                                                                @if($servicios->boleta_factura=='0')
                                                                    @if (($servicios->grupo=='REPRESENT'&&($servicios->tipoServicio=='GUIDE'||$servicios->tipoServicio=='ASSISTANCE'))||($servicios->grupo=='ENTRANCES')||($servicios->grupo=='MOVILID'&&$servicios->clase=='BOLETO'))
                                                                    <div id="b_{{$itinerario->id}}_{{$servicios->id}}" class="row border-0-5 mb-0-5 text-12 @if($servicios->anulado==1) {{'alert alert-danger'}} @endif">
                                                                        <div id="icon_{{$itinerario->id}}_{{$servicios->id}}" class="col-1 pr-0">
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
                                                                        </div>
                                                                        <div id="concepto_{{$itinerario->id}}_{{$servicios->id}}" class="col-3 pr-0">
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
                                                                            <span class="small text-success">({{$destino}})</span>
                                                                        </div>
                                                                        @php
                                                                            $mate='$';
                                                                            $mate_SALE='';
                                                                            $mate_SALE_reservado='';
                                                                            $mate_SALE_contabilidad='';
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

                                                                        @php
                                                                            $mate.=" x ".$person;
                                                                        @endphp
                                                                        @if($servicios->precio_grupo==1)
                                                                            @php
                                                                                $mate_SALE.=$servicios->precio;
                                                                                $mate_SALE_reservado.=$servicios->precio_proveedor;
                                                                                $mate_SALE_contabilidad.=$servicios->precio_c;
                                                                                $sumatotal_v+=$servicios->precio;
                                                                                $sumatotal_v_r+=$servicios->precio_proveedor;
                                                                                $sumatotal_v_c+=$servicios->precio_c;
                                                                                
                                                                                $sumatotal_v_boleta+=$servicios->precio;
                                                                                $sumatotal_v_r_boleta+=$servicios->precio_proveedor;
                                                                                $sumatotal_v_c_boleta+=$servicios->precio_c;
                                                                            @endphp
                                                                        @else
                                                                            @php
                                                                                $mate_SALE.=$servicios->precio*$cotizacion->nropersonas;
                                                                                $mate_SALE_reservado.=$servicios->precio_proveedor;
                                                                                $mate_SALE_contabilidad.=$servicios->precio_c;
                                                                                $sumatotal_v+=$servicios->precio*$cotizacion->nropersonas;
                                                                                $sumatotal_v_r+=$servicios->precio_proveedor;
                                                                                $sumatotal_v_c+=$servicios->precio_c;
                                                                                $sumatotal_v_boleta+=$servicios->precio*$cotizacion->nropersonas;
                                                                                $sumatotal_v_r_boleta+=$servicios->precio_proveedor;
                                                                                $sumatotal_v_c_boleta+=$servicios->precio_c;
                                                                            @endphp
                                                                        @endif
                                                                        <div id="calculado_{{$itinerario->id}}_{{$servicios->id}}" class="col-2 pr-0">
                                                                            @if($servicios->precio_grupo==1)
                                                                                {!! $mate !!}
                                                                            @elseif($servicios->precio_grupo==0)
                                                                                {!! $mate !!}
                                                                            @endif
                                                                        </div>
                                                                        <div id="subtotal_{{$itinerario->id}}_{{$servicios->id}}" class="col-1 pr-0">{{$mate_SALE}}</div>
                                                                        <div id="subtotal_reservado_{{$itinerario->id}}_{{$servicios->id}}" class="col-1 pr-0">{{$mate_SALE_reservado}}</div>
                                                                        <div id="subtotal_c_{{$itinerario->id}}_{{$servicios->id}}" class="col-1 pr-0">{{$mate_SALE_contabilidad}}</div>
                                                                        <div id="proveedor_{{$itinerario->id}}_{{$servicios->id}}" class="col-2 pr-0">
                                                                            <span class="text-dark" id="book_proveedor_{{$servicios->id}}">
                                                                                @if($servicios->itinerario_proveedor)
                                                                                    {{$servicios->itinerario_proveedor->nombre_comercial}}
                                                                                @endif
                                                                            </span>
                                                                            @php
                                                                                $grupe='ninguno';
                                                                                $arreglito='GROUP_SIC'
                                                                            @endphp
                                                                                
                                                                            @if(!$servicios->itinerario_proveedor)
                                                                                @php
                                                                                    $grupe='ninguno';
                                                                                    $grupe=$servicios->grupo;
                                                                                @endphp
                                                                                @php
                                                                                    $arregloo[]='GROUP';
                                                                                    $arregloo[]='SIC';
                                                                                    $arregloo[]=$servicios->tipoServicio;
                                                                                    $arreglito='GROUP_SIC_'.$servicios->tipoServicio;
                                                                                @endphp                                          
                                                                            @endif
                                                                        </div>
                                                                        <div class="col-1">
                                                                        <button class="btn btn-dark btn-sm" onclick="cambiar_a('f','{{$itinerario->id}}','{{$servicios->id}}')"><i class="fas fa-arrow-circle-right"></i></button>
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                @elseif($servicios->boleta_factura=='1')
                                                                    <div id="b_{{$itinerario->id}}_{{$servicios->id}}" class="row border-0-5 mb-0-5 text-12 @if($servicios->anulado==1) {{'alert alert-danger'}} @endif">
                                                                        <div id="icon_{{$itinerario->id}}_{{$servicios->id}}" class="col-1 pr-0">
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
                                                                        </div>
                                                                        <div id="concepto_{{$itinerario->id}}_{{$servicios->id}}" class="col-3 pr-0">
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
                                                                            <span class="small text-success">({{$destino}})</span>
                                                                        </div>
                                                                        @php
                                                                            $mate='$';
                                                                            $mate_SALE='';
                                                                            $mate_SALE_reservado='';
                                                                            $mate_SALE_contabilidad='';
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

                                                                        @php
                                                                            $mate.=" x ".$person;
                                                                        @endphp
                                                                        @if($servicios->precio_grupo==1)
                                                                            @php
                                                                                $mate_SALE.=$servicios->precio;
                                                                                $mate_SALE_reservado.=$servicios->precio_proveedor;
                                                                                $mate_SALE_contabilidad.=$servicios->precio_c;
                                                                                $sumatotal_v+=$servicios->precio;
                                                                                $sumatotal_v_r+=$servicios->precio_proveedor;
                                                                                $sumatotal_v_c+=$servicios->precio_c;
                                                                                $sumatotal_v_boleta+=$servicios->precio;
                                                                                $sumatotal_v_r_boleta+=$servicios->precio_proveedor;
                                                                                $sumatotal_v_c_boleta+=$servicios->precio_c;
                                                                            @endphp
                                                                        @else
                                                                            @php
                                                                                $mate_SALE.=$servicios->precio*$cotizacion->nropersonas;
                                                                                $mate_SALE_reservado.=$servicios->precio_proveedor;
                                                                                $mate_SALE_contabilidad.=$servicios->precio_c;
                                                                                $sumatotal_v+=$servicios->precio*$cotizacion->nropersonas;
                                                                                $sumatotal_v_r+=$servicios->precio_proveedor;
                                                                                $sumatotal_v_c+=$servicios->precio_c;
                                                                                $sumatotal_v_boleta+=$servicios->precio*$cotizacion->nropersonas;
                                                                                $sumatotal_v_r_boleta+=$servicios->precio_proveedor;
                                                                                $sumatotal_v_c_boleta+=$servicios->precio_c;
                                                                            @endphp
                                                                        @endif
                                                                        <div id="calculado_{{$itinerario->id}}_{{$servicios->id}}" class="col-2 pr-0">
                                                                            @if($servicios->precio_grupo==1)
                                                                                {!! $mate !!}
                                                                            @elseif($servicios->precio_grupo==0)
                                                                                {!! $mate !!}
                                                                            @endif
                                                                        </div>
                                                                        <div id="subtotal_{{$itinerario->id}}_{{$servicios->id}}" class="col-1 pr-0">{{$mate_SALE}}</div>
                                                                        <div id="subtotal_reservado_{{$itinerario->id}}_{{$servicios->id}}" class="col-1 pr-0">
                                                                            {{$mate_SALE_reservado}}
                                                                        </div>
                                                                        <div id="subtotal_c_{{$itinerario->id}}_{{$servicios->id}}" class="col-1 pr-0">{{$mate_SALE_contabilidad}}</div>
                                                                        <div id="proveedor_{{$itinerario->id}}_{{$servicios->id}}" class="col-2 pr-0">
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
                                                                                @php
                                                                                    $arregloo[]='GROUP';
                                                                                    $arregloo[]='SIC';
                                                                                    $arregloo[]=$servicios->tipoServicio;
                                                                                    $arreglito='GROUP_SIC_'.$servicios->tipoServicio;
                                                                                @endphp
                                                                                                                                            
                                                                            @endif
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <button class="btn btn-dark btn-sm" onclick="cambiar_a('f','{{$itinerario->id}}','{{$servicios->id}}')"><i class="fas fa-arrow-circle-right"></i></button>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                            @php
                                                                $titulo_hotel_='';
                                                                $titulo_hotel='';
                                                            @endphp
                                                            @foreach($itinerario->hotel as $hotel)
                                                                <div id="hotel_{{$hotel->id}}" class="row border-0-5 mb-0-5 text-12">
                                                                    <div class="col-1 pr-0">
                                                                        <b>{{$hotel->estrellas}} <i class="fa fa-star text-warning" aria-hidden="true"></i></b>
                                                                        @php
                                                                            $titulo_hotel_='<p><b>Categoria:'.$hotel->estrellas.' <i class="fa fa-star text-warning" aria-hidden="true"></i></b></p>';
                                                                        @endphp
                                                                    </div>
                                                                    <div class="col-3 pr-0">
                                                                            @php
                                                                            $total=0;
                                                                            $total_book=0;
                                                                            $total_contabilidad=0;
                                                                            $cadena_total='';
                                                                            $cadena_total_venta='';
                                                                            $cadena_total_book='';
                                                                        $cadena_total_contabilidad='';
                                                                        @endphp
                                                                        @if($hotel->personas_s>0)
                                                                            @php
                                                                                $total+=$hotel->personas_s*$hotel->precio_s;
                                                                                $total_book+=$hotel->personas_s*$hotel->precio_s_r;
                                                                                $total_contabilidad+=$hotel->personas_s*$hotel->precio_s_c;
                                                                                $cadena_total.="<span>$".$hotel->precio_s." x ".$hotel->personas_s."</span><br>";
                                                                                $cadena_total_venta.="<span>".$hotel->personas_s*$hotel->precio_s."</span><br>";
                                                                                $cadena_total_contabilidad.="<span>".$hotel->personas_s*$hotel->precio_s_c."</span><br>";
                                                                                if($hotel->precio_s_r){
                                                                                    $cadena_total_book.="<span>".$hotel->personas_s*$hotel->precio_s_r."</span><br>";
                                                                                }
                                                                                $sumatotal_v+=$hotel->personas_s*$hotel->precio_s;
                                                                                $sumatotal_v_boleta+=$hotel->personas_s*$hotel->precio_s;
                                                                            @endphp
                                                                            <span class="margin-bottom-5"><b>{{$hotel->personas_s}}</b> <span class="stick"><i class="fa fa-bed" aria-hidden="true"></i></span></span>(<span class="small text-primary">HOTEL</span>)
                                                                            <br>
                                                                            @php
                                                                                $titulo_hotel.='<tr><td>'.$hotel->personas_s.'</td><td><span class="stick"><i class="fa fa-bed" aria-hidden="true"></i></span></span></td><td><span>$'.$hotel->precio_s.' x '.$hotel->personas_s.'</span></td><td><span>$'.$hotel->personas_s*$hotel->precio_s.'</span></td></tr>';
                                                                            @endphp
                                                                        @endif
                                                                        @if($hotel->personas_d>0)
                                                                            @php
                                                                                $total+=$hotel->personas_d*$hotel->precio_d;
                                                                                $total_book+=$hotel->personas_d*$hotel->precio_d_r;
                                                                                $total_contabilidad+=$hotel->personas_d*$hotel->precio_d_c;
                                                                                $cadena_total.="<span>$".$hotel->precio_d." x ".$hotel->personas_d." </span><br>";
                                                                                $cadena_total_venta.="<span>".$hotel->personas_d*$hotel->precio_d."</span><br>";
                                                                                $cadena_total_contabilidad.="<span>".($hotel->personas_d*$hotel->precio_d_c)."</span><br>";
                                                                                if($hotel->precio_d_r){
                                                                                $cadena_total_book.="<span>".($hotel->personas_d*$hotel->precio_d_r)."</span><br>";
                                                                                }
                                                                                $sumatotal_v+=$hotel->personas_d*$hotel->precio_d;
                                                                                $sumatotal_v_boleta+=$hotel->personas_d*$hotel->precio_d;
                                                                            @endphp
                                                                            <span class="margin-bottom-5"><b>{{$hotel->personas_d}}</b> <span class="stick"><i class="fa fa-bed" aria-hidden="true"></i> <i class="fa fa-bed" aria-hidden="true"></i></span></span>(<span class="small text-primary">HOTEL</span>)
                                                                            <br>
                                                                            @php
                                                                                $titulo_hotel.='<tr><td>'.$hotel->personas_d.'</td><td><span class="stick"><i class="fa fa-bed" aria-hidden="true"></i><i class="fa fa-bed" aria-hidden="true"></i></span></span></td><td><span>$'.$hotel->precio_d.' x '.$hotel->personas_d.'</span></td><td><span>$'.$hotel->personas_d*$hotel->precio_d.'</span></td></tr>';
                                                                            @endphp
                                                                        @endif
                                                                        @if($hotel->personas_m>0)
                                                                            @php
                                                                                $total+=$hotel->personas_m*$hotel->precio_m;
                                                                                $total_book+=$hotel->personas_m*$hotel->precio_m_r;
                                                                                $total_contabilidad+=$hotel->personas_m*$hotel->precio_m_c;
                                                                                $cadena_total.="<span>$".$hotel->precio_m." x ".($hotel->personas_m)."</span><br>";
                                                                                $cadena_total_venta.="<span>".$hotel->personas_m*$hotel->precio_m."</span><br>";
                                                                                $cadena_total_contabilidad.="<span>".($hotel->personas_m*$hotel->precio_m_c)." </span><br>";
                                                                                if($hotel->precio_m_r){
                                                                                    $cadena_total_book.="<span>".($hotel->personas_m*$hotel->precio_m_r)." </span><br>";
                                                                                }
                                                                                $sumatotal_v+=$hotel->personas_m*$hotel->precio_m;
                                                                                $sumatotal_v_boleta+=$hotel->personas_m*$hotel->precio_m;
                                                                            @endphp
                                                                            <span class="margin-bottom-5"><b>{{$hotel->personas_m}}</b> <span class="stick"><i class="fa fa-venus-mars" aria-hidden="true"></i></span></span>(<span class="small text-primary">HOTEL</span>)
                                                                            <br>
                                                                            @php
                                                                                $titulo_hotel.='<tr><td>'.$hotel->personas_m.'</td><td><span class="stick"><i class="fa fa-venus-mars" aria-hidden="true"></i></span></span></td><td><span>$'.$hotel->precio_m.' x '.$hotel->personas_m.'</span></td><td><span>$'.$hotel->personas_m*$hotel->precio_m.'</span></td></tr>';
                                                                            @endphp
                                                                        @endif
                                                                        @if($hotel->personas_t>0)
                                                                            @php
                                                                                $total+=$hotel->personas_t*$hotel->precio_t;
                                                                                $total_book+=$hotel->personas_t*$hotel->precio_t_r;
                                                                                $total_contabilidad+=$hotel->personas_t*$hotel->precio_t_c;
                                                                                $cadena_total.="<span>$".$hotel->precio_t." x ".($hotel->personas_t)."</span><br>";
                                                                                $cadena_total_venta.="<span>".$hotel->personas_t*$hotel->precio_t."</span><br>";
                                                                                $cadena_total_contabilidad.="<span>".($hotel->personas_t*$hotel->precio_t_c)."</span><br>";
                                                                                if($hotel->precio_t_r){
                                                                                    $cadena_total_book.="<span>".($hotel->personas_t*$hotel->precio_t_r)."</span><br>";
                                                                                }
                                                                                $sumatotal_v+=$hotel->personas_t*$hotel->precio_t;
                                                                                $sumatotal_v_boleta+=$hotel->personas_t*$hotel->precio_t;
                                                                            @endphp
                                                                            <span class="margin-bottom-5"><b>{{$hotel->personas_t}}</b> <span class="stick"><i class="fa fa-bed" aria-hidden="true"></i> <i class="fa fa-bed" aria-hidden="true"></i> <i class="fa fa-bed" aria-hidden="true"></i></span></span>(<span class="small text-primary">HOTEL</span>)
                                                                            @php
                                                                                $titulo_hotel.='<tr><td>'.$hotel->personas_t.'</td><td><span class="stick"><i class="fa fa-bed" aria-hidden="true"></i> <i class="fa fa-bed" aria-hidden="true"></i> <i class="fa fa-bed" aria-hidden="true"></i></span></span></td><td><span>$'.$hotel->precio_t.' x '.$hotel->personas_t.'</span></td><td><span>$'.$hotel->personas_t*$hotel->precio_t.'</span></td></tr>';
                                                                            @endphp
                                                                        @endif                    
                                                                        <span class="small text-success">({{$hotel->localizacion}})</span>
                                                                    </div>
                                                                    <div class="col-2 pr-0">
                                                                        {!! $cadena_total !!}
                                                                        <p class="d-none"><i class="fa fa-users" aria-hidden="true"></i> {{$total}}
                                                                            <a id="hpropover_{{$hotel->id}}" data-toggle="popover" title="Detalle" data-content="{{$cadena_total}}"> <i class="fa fa-calculator text-primary" aria-hidden="true"></i></a>
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-1 pr-0">
                                                                        {!! $cadena_total_venta !!}
                                                                    </div>
                                                                    <div class="col-1 pr-0">
                                                                        {!! $cadena_total_book !!}
                                                                    </div>
                                                                    <div class="col-1 pr-0">
                                                                        {!! $cadena_total_contabilidad !!}
                                                                    </div>
                                                                    @php
                                                                        $sumatotal_v_r+=$total_book;
                                                                        $sumatotal_v_r_boleta+=$total_book;
                                                                        $sumatotal_v_c+=$total_contabilidad;
                                                                        $sumatotal_v_c_boleta+=$total_contabilidad;
                                                                    @endphp
                                                                    <div class="col-2 pr-0 text-dark">
                                                                        <span class="text-dark" id="book_proveedor_hotel_{{$hotel->id}}">
                                                                            @if($hotel->proveedor)
                                                                                {{$hotel->proveedor->nombre_comercial}}
                                                                            @endif
                                                                        </span>
                                                                    </div>
                                                                    <div class="col-1">
                                                                        <button class="btn btn-dark btn-sm"><i class="fas fa-arrow-circle-right"></i></button>
                                                                    </div>
                                                                </div>
                                                            @endforeach            
                                                        </div>
                                                        <div id="f_{{$itinerario->id}}" class="col-6">
                                                            @foreach($itinerario->itinerario_servicios->sortBy('pos')/*->whereIn('grupo',$paraFactura)*/ as $servicios)
                                                                @if($servicios->boleta_factura=='0')
                                                                    @if (($servicios->grupo=='REPRESENT'&&$servicios->tipoServicio=='TRANSFER')||($servicios->grupo=='MOVILID'&&$servicios->clase=='DEFAULT')||$servicios->grupo=='TOURS'||$servicios->grupo=='FOOD'||$servicios->grupo=='TRAINS'||$servicios->grupo=='FLIGHTS'||$servicios->grupo=='OTHERS')
                                                                    <div id="f_{{$itinerario->id}}_{{$servicios->id}}"class="row border-0-5 mb-0-5 text-12 @if($servicios->anulado==1) {{'alert alert-danger'}} @endif">
                                                                        <div class="col-1 pr-0">
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
                                                                        </div>
                                                                        <div id="concepto_{{$itinerario->id}}_{{$servicios->id}}" class="col-3 pr-0">
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
                                                                            
                                                                            <span class="small text-success">({{$destino}})</span>
                                                                        </div>
                                                                            @php
                                                                                $mate='$';
                                                                                $mate_SALE='';
                                                                                $mate_SALE_reservado='';
                                                                                $mate_SALE_contabilidad='';
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

                                                                            @php
                                                                                $mate.=" x ".$person;
                                                                            @endphp
                                                                            @if($servicios->precio_grupo==1)
                                                                                @php
                                                                                    $mate_SALE.=$servicios->precio;
                                                                                    $mate_SALE_reservado.=$servicios->precio_proveedor;
                                                                                    $mate_SALE_contabilidad.=$servicios->precio_c;
                                                                                    $sumatotal_v+=$servicios->precio;
                                                                                    $sumatotal_v_r+=$servicios->precio_proveedor;
                                                                                    $sumatotal_v_c+=$servicios->precio_c;
                                                                                    $sumatotal_v_factura+=$servicios->precio;
                                                                                    $sumatotal_v_r_factura+=$servicios->precio_proveedor;
                                                                                    $sumatotal_v_c_factura+=$servicios->precio_c;
                                                                                @endphp
                                                                            @else
                                                                                @php
                                                                                    $mate_SALE.=$servicios->precio*$cotizacion->nropersonas;
                                                                                    $mate_SALE_reservado.=$servicios->precio_proveedor;
                                                                                    $mate_SALE_contabilidad.=$servicios->precio_c;
                                                                                    $sumatotal_v+=$servicios->precio*$cotizacion->nropersonas;
                                                                                    $sumatotal_v_r+=$servicios->precio_proveedor;
                                                                                    $sumatotal_v_c+=$servicios->precio_c;

                                                                                    $sumatotal_v_factura+=$servicios->precio*$cotizacion->nropersonas;;
                                                                                    $sumatotal_v_r_factura+=$servicios->precio_proveedor;
                                                                                    $sumatotal_v_c_factura+=$servicios->precio_c;
                                                                                @endphp
                                                                            @endif 
                                                                        <div id="calculado_{{$itinerario->id}}_{{$servicios->id}}" class="col-2 pr-0">
                                                                            @if($servicios->precio_grupo==1)
                                                                                {!! $mate !!}
                                                                            @elseif($servicios->precio_grupo==0)
                                                                                {!! $mate !!}
                                                                            @endif
                                                                        </div>
                                                                        <div id="subtotal_{{$itinerario->id}}_{{$servicios->id}}" class="col-1 pr-0">{{$mate_SALE}}
                                                                        </div>
                                                                        <div id="subtotal_reservado_{{$itinerario->id}}_{{$servicios->id}}" class="col-1 pr-0">
                                                                            {{$mate_SALE_reservado}}
                                                                        </div>
                                                                        <div id="subtotal_c_{{$itinerario->id}}_{{$servicios->id}}" class="col-1 pr-0">{{$mate_SALE_contabilidad}}</div>
                                                                        <div id="proveedor_{{$itinerario->id}}_{{$servicios->id}}" class="col-2 pr-0">
                                                                            <span class="text-dark" id="book_proveedor_{{$servicios->id}}">
                                                                                @if($servicios->itinerario_proveedor)
                                                                                    {{$servicios->itinerario_proveedor->nombre_comercial}}
                                                                                @endif
                                                                            </span>
                                                                            @php
                                                                                $grupe='ninguno';
                                                                                $arreglito='GROUP_SIC'
                                                                            @endphp
                                                                                
                                                                            @if(!$servicios->itinerario_proveedor)
                                                                                @php
                                                                                    $grupe='ninguno';
                                                                                    $grupe=$servicios->grupo;
                                                                                @endphp
                                                                                @php
                                                                                    $arregloo[]='GROUP';
                                                                                    $arregloo[]='SIC';
                                                                                    $arregloo[]=$servicios->tipoServicio;
                                                                                    $arreglito='GROUP_SIC_'.$servicios->tipoServicio;
                                                                                @endphp
                                                                                                                                            
                                                                            @endif
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <button class="btn btn-dark btn-sm" onclick="cambiar_a('b','{{$itinerario->id}}','{{$servicios->id}}')"><i class="fas fa-arrow-circle-left"></i></button>
                                                                        </div>
                                                                    </div>    
                                                                    @endif
                                                                @elseif($servicios->boleta_factura=='2')
                                                                    <div id="f_{{$itinerario->id}}_{{$servicios->id}}" class="row border-0-5 mb-0-5 text-12">
                                                                        <div class="col-1 pr-0">
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
                                                                        </div>
                                                                        <div class="col-3 pr-0">
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
                                                                            
                                                                            <span class="small text-success">({{$destino}})</span>
                                                                        </div>
                                                                            @php
                                                                                $mate='$';
                                                                                $mate_SALE='';
                                                                                $mate_SALE_reservado='';
                                                                                $mate_SALE_contabilidad='';
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

                                                                            @php
                                                                                $mate.=" x ".$person;
                                                                            @endphp
                                                                            @if($servicios->precio_grupo==1)
                                                                                @php
                                                                                    $mate_SALE.=$servicios->precio;
                                                                                    $mate_SALE_reservado.=$servicios->precio_proveedor;
                                                                                    $mate_SALE_contabilidad.=$servicios->precio_c;
                                                                                    $sumatotal_v+=$servicios->precio;
                                                                                    $sumatotal_v_r+=$servicios->precio_proveedor;
                                                                                    $sumatotal_v_c+=$servicios->precio_c;
                                                                                    $sumatotal_v_factura+=$servicios->precio;
                                                                                    $sumatotal_v_r_factura+=$servicios->precio_proveedor;
                                                                                    $sumatotal_v_c_factura+=$servicios->precio_c;
                                                                                @endphp
                                                                            @else
                                                                                @php
                                                                                    $mate_SALE.=$servicios->precio*$cotizacion->nropersonas;
                                                                                    $mate_SALE_reservado.=$servicios->precio_proveedor;
                                                                                    $mate_SALE_contabilidad.=$servicios->precio_c;
                                                                                    $sumatotal_v+=$servicios->precio*$cotizacion->nropersonas;
                                                                                    $sumatotal_v_r+=$servicios->precio_proveedor;
                                                                                    $sumatotal_v_c+=$servicios->precio_c;

                                                                                    $sumatotal_v_factura+=$servicios->precio*$cotizacion->nropersonas;;
                                                                                    $sumatotal_v_r_factura+=$servicios->precio_proveedor;
                                                                                    $sumatotal_v_c_factura+=$servicios->precio_c;
                                                                                @endphp
                                                                            @endif 
                                                                        <div id="calculado_{{$itinerario->id}}_{{$servicios->id}}" class="col-2 pr-0">
                                                                            @if($servicios->precio_grupo==1)
                                                                                {!! $mate !!}
                                                                            @elseif($servicios->precio_grupo==0)
                                                                                {!! $mate !!}
                                                                            @endif
                                                                        </div>
                                                                        <div id="subtotal_{{$itinerario->id}}_{{$servicios->id}}" class="col-1 pr-0">
                                                                            {{$mate_SALE}}
                                                                        </div>
                                                                        <div id="subtotal_reservado_{{$itinerario->id}}_{{$servicios->id}}" class="col-1 pr-0">
                                                                            {{$mate_SALE_reservado}}
                                                                        </div>
                                                                        <div id="subtotal_c_{{$itinerario->id}}_{{$servicios->id}}" class="col-1 pr-0">{{$mate_SALE_contabilidad}}</div>
                                                                        <div id="proveedor_{{$itinerario->id}}_{{$servicios->id}}" class="col-2 pr-0">
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
                                                                                @php
                                                                                    $arregloo[]='GROUP';
                                                                                    $arregloo[]='SIC';
                                                                                    $arregloo[]=$servicios->tipoServicio;
                                                                                    $arreglito='GROUP_SIC_'.$servicios->tipoServicio;
                                                                                @endphp
                                                                                                                                            
                                                                            @endif
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <button class="btn btn-dark btn-sm" onclick="cambiar_a('b','{{$itinerario->id}}','{{$servicios->id}}')"><i class="fas fa-arrow-circle-left"></i></button>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        @endforeach
                                        
                                        <table class="table table-bordered table-striped table-sm table-hover">
                                            <thead>
                                                <th>CATEGORIA</th>
                                                <th>NUMERO</th>
                                                <th>MONTO A CALCULAR</th>
                                                <th>MONTO VENDIDO</th>
                                            </thead>
                                            <tbody>
                                                <tr class="bg-dark text-white">
                                                    <td colspan="2"  class="text-11">
                                                        <b>SUBTOTAL PARA BOLETA</b>
                                                    </td>
                                                    <td class="text-11 text-right">
                                                        <div class="form-control">
                                                            <input type="number" name="total_c_boleta" id="total_c_boleta" value="@if($facturado_estado==1){{$sub_monto_boleta_}}@else{{$sumatotal_v_c_boleta}}@endif" readonly form="form_ingresar_factura"  required>
                                                        </div>
                                                    </td>
                                                    <td class="text-11 text-right">
                                                        <b><sup>$</sup><span id="total_c_boleta_html">{{$sumatotal_v_boleta}}</span></b>
                                                    </td>
                                                </tr>
                                                <tr class="bg-warning text-dark">
                                                    <td colspan="2" class="text-11">
                                                        <b>PROFIT POR PERSONA</b>
                                                    </td>
                                                    <td class="text-11 text-right">
                                                        <div class="form-control">
                                                        <input type="tetx" name="total_c_profit" id="total_c_profit" value="@if($facturado_estado==1){{$monto_c_profit_}}@else{{$profit}}@endif" onkeyup="calcular_venta_contabilidad('profit','{{$cotizacion->nropersonas}}')" form="form_ingresar_factura" required>
                                                        </div>
                                                    </td>
                                                    <td class="text-11 text-right">
                                                        <b><sup>$</sup><span id="total_c_profit_html">{{$profit}}</span></b>
                                                    </td>
                                                </tr>
                                                <tr class="bg-primary text-white">
                                                    <td class="text-11">
                                                        <b>TOTAL PARA BOLETA</b>
                                                    </td>
                                                    <td class="text-11">
                                                        <div class="form-control">
                                                            <input type="text" name="nro_c_boleta" placeholder="B-0001" form="form_ingresar_factura" value="@if($facturado_estado==1){{$nro_c_boleta_}}@endif" required>
                                                        </div>
                                                    </td>
                                                    <td class="text-11 text-right">
                                                        <div class="form-control">
                                                            <input type="number" name="total_c_boleta_" id="total_c_boleta_" value="@if($facturado_estado==1){{$monto_c_boleta_}}@else{{$sumatotal_v_c_boleta+$profit}}@endif" readonly form="form_ingresar_factura"  required>
                                                        </div>
                                                    </td>
                                                    <td class="text-11 text-right">
                                                        <b><sup>$</sup><span id="total_c_boleta_html">{{$sumatotal_v_boleta+$profit}}</span></b>
                                                    </td>
                                                </tr>
                                                <tr class="bg-info text-white">
                                                    <td class="text-11">
                                                        <b>TOTAL PARA FACTURA</b>
                                                    </td>
                                                    <td class="text-11">
                                                        <div class="form-control">
                                                            <input type="text" name="nro_c_factura" placeholder="F-0001" form="form_ingresar_factura" value="@if($facturado_estado==1){{$nro_c_factura_}}@endif" required>
                                                        </div>
                                                    </td>
                                                    <td  class="text-11 text-right">
                                                        <div class="form-control">
                                                            <input type="number" name="total_c_factura" id="total_c_factura" value="@if($facturado_estado==1){{$monto_c_factura_}}@else{{$sumatotal_v_c_factura}}@endif" readonly form="form_ingresar_factura" required>
                                                        </div>
                                                    </td>
                                                    <td class="text-11 text-right">
                                                        <b><sup>$</sup><span id="total_c_factura_html">{{$sumatotal_v_factura}}</span></b>
                                                    </td>
                                                </tr>
                                                <tr class="bg-success text-white">
                                                    <td colspan="2" class="text-11">
                                                        <b>TOTAL VENDIDO</b>
                                                    </td>
                                                    <td class="text-11 text-right">
                                                        <div class="form-control">
                                                            <input type="text" name="total_c_vendido" id="total_c_vendido" value="@if($facturado_estado==1){{$monto_c_boleta_+$monto_c_factura_}}@else{{$sumatotal_v_boleta+$profit+$sumatotal_v_factura}}@endif" onkeyup="calcular_venta_contabilidad('venta','{{$cotizacion->nropersonas}}')" form="form_ingresar_factura" required>
                                                        </div>
                                                    </td>
                                                    <td colspan="2" class="text-11 text-right">
                                                        <b><sup>$</sup><span id="total_c_vendido_html">{{$sumatotal_v_boleta+$profit+$sumatotal_v_factura}}</span></b>
                                                    </td>
                                                </tr>                                                    
                                            </tbody>
                                        </table>
                                        <form id="form_ingresar_factura" action="{{route('ingresar_factura_path')}}" method="post">
                                            <div class="row">
                                                <div class="col-lg-12 text-center">
                                                    <input type="hidden" name="cotizacion_id" value="{{$cotizacion->id}}">
                                                    <input type="hidden" name="paquete_id" value="{{$paquete_id}}">
                                                    <input type="hidden" name="anio" value="{{$anio}}">
                                                    <input type="hidden" name="mes" value="{{$mes}}">
                                                    <input type="hidden" name="pagina" value="{{$pagina}}">
                                                    <input type="hidden" name="filtro" value="{{$filtro}}">                                                        
                                                    @csrf
                                                    <button type="submit" class="btn btn-lg btn-success">Guardar cambios
                                                        <i class="far fa-thumbs-up" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    @if (session('msj'))
                                                        <div class="alert alert-danger">
                                                            {!! session('msj') !!}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>    
                        </div>    
                    </div> 
                    
                </div>
            </div>
        </div>
        
@stop
