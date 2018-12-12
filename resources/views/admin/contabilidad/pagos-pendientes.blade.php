@php
    use Carbon\Carbon;
    // function fecha_peru($fecha){
    // $fecha=explode('-',$fecha);
    // return $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
    // }
    // function MisFunciones::fecha_peru_hora($fecha_){
    //     $f1=explode(' ',$fecha_);
    //     $hora=$f1[1];
    //     $f2=explode('-',$f1[0]);
    //     $fecha1=$f2[2].'-'.$f2[1].'-'.$f2[0];
    //     return $fecha1.' a las '.$hora;
    // }
@endphp
@extends('layouts.admin.contabilidad')
@section('archivos-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">
    <style>
        .fixed {
            position: fixed;
            background: whitesmoke;
            top: 250px;
            right: 0;
            width: 300px;
        }
    </style>
@stop
@section('archivos-js')
    <script src="{{asset("https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js")}}"></script>
@stop
@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white m-0">
            <li class="breadcrumb-item" aria-current="page"><a href="/">Home</a></li>
            <li class="breadcrumb-item">Contabilidad</li>
            <li class="breadcrumb-item">Operaciones</li>
            <li class="breadcrumb-item active">Pagos pendientes</li>
        </ol>
    </nav>
    <hr>
    <div class="row my-3">
        <div class="col-lg-12">
            <div class="card w-100">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-justified">
                        <li class="nav-item @if($grupo=='HOTELS'){{'active'}}@endif"><a data-toggle="tab" href="#home" class="nav-link @if($grupo=='HOTELS'){{'active'}}@endif rounded-0">HOTELS</a></li>
                        <li class="nav-item @if($grupo=='TOURS'){{'active'}}@endif"><a data-toggle="tab" href="#menu1" class="nav-link @if($grupo=='TOURS'){{'active'}}@endif rounded-0">TOURS</a></li>
                        <li class="nav-item @if($grupo=='MOVILID'){{'active'}}@endif"><a data-toggle="tab" href="#menu2" class="nav-link @if($grupo=='MOVILID'){{'active'}}@endif rounded-0">MOVILID</a></li>
                        <li class="nav-item @if($grupo=='REPRESENT'){{'active'}}@endif"><a data-toggle="tab" href="#menu3" class="nav-link @if($grupo=='REPRESENT'){{'active'}}@endif rounded-0">REPRESENT</a></li>
                        <li class="nav-item @if($grupo=='ENTRANCES'){{'active'}}@endif"><a data-toggle="tab" href="#menu4" class="nav-link @if($grupo=='ENTRANCES'){{'active'}}@endif rounded-0">ENTRANCES</a></li>
                        <li class="nav-item @if($grupo=='FOOD'){{'active'}}@endif"><a data-toggle="tab" href="#menu5" class="nav-link @if($grupo=='FOOD'){{'active'}}@endif rounded-0">FOOD</a></li>
                        <li class="nav-item @if($grupo=='TRAINS'){{'active'}}@endif"><a data-toggle="tab" href="#menu6" class="nav-link @if($grupo=='TRAINS'){{'active'}}@endif rounded-0">TRAINS</a></li>
                        <li class="nav-item @if($grupo=='FLIGHTS'){{'active'}}@endif"><a data-toggle="tab" href="#menu7" class="nav-link @if($grupo=='FLIGHTS'){{'active'}}@endif rounded-0">FLIGHTS</a></li>
                        <li class="nav-item @if($grupo=='OTHERS'){{'active'}}@endif"><a data-toggle="tab" href="#menu8" class="nav-link @if($grupo=='OTHERS'){{'active'}}@endif rounded-0">OTHERS</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="home" class="tab-pane fade @if($grupo=='HOTELS'){{'show active'}}@endif">
                            <div class="row mt-3">

                                <div class="col-12">
                                    <div class="card w-100">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12 form-inline">
                                                    @php
                                                        $ToDay=new Carbon();
                                                    @endphp
                                                    {{--<form action="{{route('list_fechas_rango_hotel_path')}}" method="post" class="form-inline">--}}
                                                    {{csrf_field()}}
                                                    <div class="form-group">
                                                        <label for="f_ini" class="text-secondary font-weight-bold pr-2">From </label>
                                                        <input type="date" class="form-control" placeholder="from" name="txt_ini" id="f_ini" value="{{$ToDay->toDateString()}}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="f_fin" class="text-secondary font-weight-bold px-2"> To </label>
                                                        <input type="date" class="form-control" placeholder="to" name="txt_fin" id="f_fin" value="{{$ToDay->toDateString()}}" required>
                                                    </div>
                                                    <button type="button" class="btn btn-default mx-2 mx-2" onclick="buscar_hoteles_pagos_pendientes($('#f_ini').val(),$('#f_fin').val())">Filtrar</button>
                                                    {{--</form>--}}
                                                </div>
                                            </div><!-- /.row -->
                                            {{--<hr>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-12" id="rpt_hotel">
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-12">
                                    <div class="card w-100">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h2>Consultas Guardadas(HOTELS)</h2>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-4 col-md-offset-4 text-center">
                                                    @if(Session::has('message'))
                                                        <div class="alert alert-danger" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            {{Session::get('message')}}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                @foreach($consulta as $consultas)
                                                    <div id="c_h_{{$consultas->id}}" class="col-md-2 text-center">
                                                        <form action="{{route('list_fechas_show_path')}}" method="post">
                                                            {{csrf_field()}}
                                                            <input type="hidden" name="txt_codigos" value="{{$consultas->id}}">
                                                            <a href="javascript:;" onclick="parentNode.submit();">
                                                                <img src="{{asset('images/database.png')}}" alt="" class="img-responsive" width="100px" height="100px">
                                                                {{--{{strftime("%B, %d", strtotime(str_replace('-','/', $disponibilidad->fecha_disponibilidad)))}} <span class="blue-text">${{$disponibilidad->precio_d}}</span>--}}
                                                                <br><span class="font-weight-bold text-18">Creado:{{MisFunciones::fecha_peru_hora($consultas->updated_at)}}</span>
                                                            </a>
                                                            <p>
                                                                {{--<a href="#" class="display-block text-danger" data-toggle="modal" data-target="#eliminar_{{$consultas->id}}"><i class="fa fa-trash fa-2x"></i></a>--}}
                                                                <a href="{{route('descargar_consulta_h_path',$consultas->id)}}" class="btn btn-danger"><i class="fas fa-file-pdf fa-2x"></i></a>
                                                                <a href="#" class="btn btn-danger" onclick="eliminar_consulta('{{$consultas->id}}','h')"><i class="fa fa-trash fa-2x"></i></a>
                                                            </p>
                                                        </form>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="menu1" class="tab-pane fade @if($grupo=='TOURS'){{'show active'}}@endif">
                            <div class="row mt-3 my-3">
                                <div class="col-md-12">
                                    <div class="card w-100">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12 form-inline">
                                                    @php
                                                    $ToDay=new Carbon();
                                                    @endphp
                                                    {{csrf_field()}}
                                                    <div class="form-group">
                                                        <label for="f_ini" class="text-secondary font-weight-bold pr-2">From </label>
                                                        <input type="date" class="form-control" name="f_ini_TOURS" id="f_ini_TOURS" value="{{$ToDay->toDateString()}}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="f_fin" class="text-secondary font-weight-bold px-2"> To </label>
                                                        <input type="date" class="form-control" name="f_fin_TOURS" id="f_fin_TOURS" value="{{$ToDay->toDateString()}}" required>
                                                    </div>
                                                    <button type="button" class="btn btn-default mx-2" onclick="buscar_servicios_pagos_pendientes($('#f_ini_TOURS').val(),$('#f_fin_TOURS').val(),'TOURS')">Filtrar</button>
                                                </div>
                                            </div><!-- /.row -->
                                            {{--<hr>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" id="rpt_TOURS">
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-12">
                                    <div class="card w-100">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h2>Consultas Guardadas(TOURS)</h2>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-4 col-md-offset-4 text-center">
                                                    @if(Session::has('message'))
                                                        <div class="alert alert-danger" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            {{Session::get('message')}}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                @foreach($consulta_serv->where('grupo','TOURS') as $consultas)
                                                    <div id="c_s_{{$consultas->id}}" class="col-md-2 text-center">
                                                        <form action="{{route('list_fechas_servivios_show_path')}}" method="post">
                                                            {{csrf_field()}}
                                                            <input type="hidden" name="grupo" value="TOURS">
                                                            <input type="hidden" name="txt_codigos" value="{{$consultas->id}}">
                                                            <a href="javascript:;" onclick="parentNode.submit();">
                                                                <img src="{{asset('images/database.png')}}" alt="" class="img-responsive" width="100px" height="100px">
                                                                {{--{{strftime("%B, %d", strtotime(str_replace('-','/', $disponibilidad->fecha_disponibilidad)))}} <span class="blue-text">${{$disponibilidad->precio_d}}</span>--}}
                                                                <br><span class="font-weight-bold text-18">Creado:{{MisFunciones::fecha_peru_hora($consultas->updated_at)}}</span>
                                                            </a>
                                                            <p>
                                                                {{--<a href="#" class="display-block text-danger" data-toggle="modal" data-target="#eliminar_{{$consultas->id}}"><i class="fa fa-trash fa-2x"></i></a>--}}
                                                                <a href="{{route('descargar_consulta_s_path',[$consultas->id,'TOURS'])}}" class="btn btn-danger"><i class="fas fa-file-pdf fa-2x"></i></a>
                                                                <a href="#" class="btn btn-danger" onclick="eliminar_consulta('{{$consultas->id}}','s')"><i class="fa fa-trash fa-2x"></i></a>
                                                            </p>
                                                        </form>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="menu2" class="tab-pane fade @if($grupo=='MOVILID'){{'show active'}}@endif">
                            <div class="row mt-3 my-3">
                                <div class="col-md-12">
                                    <div class="card w-100">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12 form-inline">
                                                    @php
                                                        $ToDay=new Carbon();
                                                    @endphp
                                                    {{csrf_field()}}
                                                    <div class="form-group">
                                                        <label for="f_ini" class="text-secondary font-weight-bold pr-2">From </label>
                                                        <input type="date" class="form-control" name="f_ini_MOVILID" id="f_ini_MOVILID" value="{{$ToDay->toDateString()}}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="f_fin" class="text-secondary font-weight-bold px-2"> To </label>
                                                        <input type="date" class="form-control" name="f_fin_MOVILID" id="f_fin_MOVILID" value="{{$ToDay->toDateString()}}" required>
                                                    </div>
                                                    <button type="button" class="btn btn-default mx-2" onclick="buscar_servicios_pagos_pendientes($('#f_ini_MOVILID').val(),$('#f_fin_MOVILID').val(),'MOVILID')">Filtrar</button>
                                                </div>
                                            </div><!-- /.row -->
                                            {{--<hr>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" id="rpt_MOVILID">
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-12">
                                    <div class="card w-100">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h2>Consultas Guardadas(MOVILID)</h2>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-4 col-md-offset-4 text-center">
                                                    @if(Session::has('message'))
                                                        <div class="alert alert-danger" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            {{Session::get('message')}}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                @foreach($consulta_serv->where('grupo','MOVILID') as $consultas)
                                                    <div id="c_s_{{$consultas->id}}" class="col-md-2 text-center">
                                                        <form action="{{route('list_fechas_servivios_show_path')}}" method="post">
                                                            {{csrf_field()}}
                                                            <input type="hidden" name="grupo" value="MOVILID">
                                                            <input type="hidden" name="txt_codigos" value="{{$consultas->id}}">
                                                            <a href="javascript:;" onclick="parentNode.submit();">
                                                                <img src="{{asset('images/database.png')}}" alt="" class="img-responsive" width="100px" height="100px">
                                                                {{--{{strftime("%B, %d", strtotime(str_replace('-','/', $disponibilidad->fecha_disponibilidad)))}} <span class="blue-text">${{$disponibilidad->precio_d}}</span>--}}
                                                                <br><span class="font-weight-bold text-18">Creado:{{MisFunciones::fecha_peru_hora($consultas->updated_at)}}</span>
                                                            </a>
                                                            <p>
                                                                {{--<a href="#" class="display-block text-danger" data-toggle="modal" data-target="#eliminar_{{$consultas->id}}"><i class="fa fa-trash fa-2x"></i></a>--}}
                                                                <a href="{{route('descargar_consulta_s_path',[$consultas->id,'MOVILID'])}}" class="btn btn-danger"><i class="fas fa-file-pdf fa-2x"></i></a>
                                                                <a href="#" class="btn btn-danger" onclick="eliminar_consulta('{{$consultas->id}}','s')"><i class="fa fa-trash fa-2x"></i></a>
                                                            </p>
                                                        </form>
                                                    </div>
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="menu3" class="tab-pane fade @if($grupo=='REPRESENT'){{'show active'}}@endif">
                            <div class="row mt-3 my-3">
                                <div class="col-md-12">
                                    <div class="card w-100">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12 form-inline">
                                                    @php
                                                        $ToDay=new Carbon();
                                                    @endphp
                                                    {{csrf_field()}}
                                                    <div class="form-group">
                                                        <label for="f_ini" class="text-secondary font-weight-bold pr-2">From </label>
                                                        <input type="date" class="form-control" name="f_ini_REPRESENT" id="f_ini_REPRESENT" value="{{$ToDay->toDateString()}}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="f_fin" class="text-secondary font-weight-bold px-2"> To </label>
                                                        <input type="date" class="form-control" name="f_fin_REPRESENT" id="f_fin_REPRESENT" value="{{$ToDay->toDateString()}}" required>
                                                    </div>
                                                    <button type="button" class="btn btn-default mx-2" onclick="buscar_servicios_pagos_pendientes($('#f_ini_REPRESENT').val(),$('#f_fin_REPRESENT').val(),'REPRESENT')">Filtrar</button>
                                                </div>
                                            </div><!-- /.row -->
                                            {{--<hr>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" id="rpt_REPRESENT">
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-12">
                                    <div class="card w-100">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h2>Consultas Guardadas(REPRESENT)</h2>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-4 col-md-offset-4 text-center">
                                                    @if(Session::has('message'))
                                                        <div class="alert alert-danger" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            {{Session::get('message')}}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                @foreach($consulta_serv->where('grupo','REPRESENT') as $consultas)
                                                    <div id="c_s_{{$consultas->id}}" class="col-md-2 text-center">
                                                        <form action="{{route('list_fechas_servivios_show_path')}}" method="post">
                                                            {{csrf_field()}}
                                                            <input type="hidden" name="grupo" value="REPRESENT">
                                                            <input type="hidden" name="txt_codigos" value="{{$consultas->id}}">
                                                            <a href="javascript:;" onclick="parentNode.submit();">
                                                                <img src="{{asset('images/database.png')}}" alt="" class="img-responsive" width="100px" height="100px">
                                                                {{--{{strftime("%B, %d", strtotime(str_replace('-','/', $disponibilidad->fecha_disponibilidad)))}} <span class="blue-text">${{$disponibilidad->precio_d}}</span>--}}
                                                                <br><span class="font-weight-bold text-18">Creado:{{MisFunciones::fecha_peru_hora($consultas->updated_at)}}</span>
                                                            </a>
                                                            <p>
                                                                {{--<a href="#" class="display-block text-danger" data-toggle="modal" data-target="#eliminar_{{$consultas->id}}"><i class="fa fa-trash fa-2x"></i></a>--}}
                                                                <a href="{{route('descargar_consulta_s_path',[$consultas->id,'REPRESENT'])}}" class="btn btn-danger"><i class="fas fa-file-pdf fa-2x"></i></a>
                                                                <a href="#" class="btn btn-danger" onclick="eliminar_consulta('{{$consultas->id}}','s')"><i class="fa fa-trash fa-2x"></i></a>
                                                            </p>
                                                        </form>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="menu4" class="tab-pane fade @if($grupo=='ENTRANCES'){{'show active'}}@endif">
                            <div class="row mt-3 my-3">
                                <div class="col-md-12">
                                    <div class="card w-100">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-2">
                                                    @php
                                                        $ToDay=new Carbon();
                                                    @endphp
                                                    {{csrf_field()}}
                                                    <div class="form-group">
                                                        <label for="tipo_filtro" class="text-secondary font-weight-bold pr-2">Escoja una opcion </label>
                                                        <select form="form_guardar" name="tipo_filtro" id="tipo_filtro" class="form-control" onchange="mostrar_opcion($(this).val())">
                                                            <option value="POR CODIGO">POR CODIGO</option>
                                                            <option value="POR NOMBRE">POR NOMBRE</option>
                                                            <option value="TODOS LOS PENDIENTES">TODOS LOS PENDIENTES</option>
                                                            <option value="TODOS LOS URGENTES">TODOS LOS URGENTES</option>
                                                            <option value="ENTRE DOS FECHAS">ENTRE DOS FECHAS</option>
                                                            <option value="ENTRE DOS FECHAS URGENTES">ENTRE DOS FECHAS URGENTES</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div id=bloque_filtros class="col-4">
                                                    <div class="row">
                                                        @php
                                                            $ToDay=new Carbon();
                                                        @endphp
                                                        {{csrf_field()}}
                                                        <div class="col d-none" id="nombre">
                                                            <label for="nombre_form" class="text-secondary font-weight-bold pr-2">Nombre </label>
                                                            <input type="text" class="form-control" form="form_guardar" name="nombre_form" id="nombre_form" value="" placeholder="Ingrese el nombre de la venta">
                                                        </div>
                                                        <div class="col " id="codigo">
                                                            <label for="codigo_form" class="text-secondary font-weight-bold pr-2">Codigo </label>
                                                            <input type="text" class="form-control" form="form_guardar" name="codigo_form" id="codigo_form" value="" placeholder="Ingrese el codigo de la venta">
                                                        </div>
                                                        <div class="col-6 d-none" id="from">
                                                            <label for="f_ini" class="text-secondary font-weight-bold pr-2">From </label>
                                                            <input type="date" class="form-control" form="form_guardar" name="f_ini_ENTRADA" id="f_ini_ENTRADA" value="{{$ToDay->toDateString()}}" required>
                                                        </div>
                                                        <div class="col-6 d-none" id="to">
                                                            <label for="f_fin" class="text-secondary font-weight-bold px-2"> To </label>
                                                            <input type="date" class="form-control" form="form_guardar" name="f_fin_ENTRADA" id="f_fin_ENTRADA" value="{{$ToDay->toDateString()}}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-2 mt-4">
                                                    <button type="button" class="btn btn-primary mt-2 mx-2 btn-block" onclick="buscar_servicios_pagos_pendientes_entradas($('#tipo_filtro').val(),$('#nombre_form').val(),$('#codigo_form').val(),$('#f_ini_ENTRADA').val(),$('#f_fin_ENTRADA').val(),'ENTRANCES')"><i class="fas fa-search"></i> Filtrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" id="rpt_ENTRANCES">
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-12">
                                    <div class="card w-100">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h2>Consultas Guardadas(ENTRANCES)</h2>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-4 col-md-offset-4 text-center">
                                                    @if(Session::has('message'))
                                                        <div class="alert alert-danger" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            {{Session::get('message')}}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <table class="table table-condensed table-responsive table-striped table-hover">
                                                        <thead>
                                                            <th>
                                                                <td>FECHA</td>
                                                                <td>LIQUIDACION</td>
                                                                <td>TOTAL</td>
                                                                <td>ESTADO</td>
                                                                <td>OPERACIONES</td>
                                                                <td>DESCARGAR</td>
                                                                <td>ELIMINAR</td>
                                                            </th>
                                                        </thead>
                                                        <tbody>
                                                        @php
                                                            $pos=0;
                                                        @endphp
                                                        @foreach($liquidaciones as $liquidaciones_)
                                                            @php
                                                                $pos++;
                                                            @endphp
                                                            <tr id="lista_liquidaciones_{{$liquidaciones_->id}}">
                                                                <td>{{$pos}}</td>
                                                                <td>{{MisFunciones::fecha_peru_hora($liquidaciones_->created_at)}}</td>
                                                                <td>LIQUIDACION</td>
                                                                <td><span><sup>$</sup>{{$liquidaciones_->total}}</span></td>
                                                                <td>
                                                                    @if($liquidaciones_->estado=='1')
                                                                        <span class="badge badge-warning">PENDIENTE <i class="fas fa-eye"></i></span>
                                                                    @elseif($liquidaciones_->estado=='2')
                                                                        <span class="badge badge-success">PAGADO <i class="fas fa-check"></i></span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if($liquidaciones_->estado=='1')
                                                                        <a href="{{route('pagos_pendientes_rango_fecha_filtro_servicios_entrada_guardado_pagado_path',['guardado',$liquidaciones_->id])}}" class="btn btn-warning btn-sm">Pagar</a>
                                                                    @elseif($liquidaciones_->estado=='2')
                                                                        <a href="{{route('pagos_pendientes_rango_fecha_filtro_servicios_entrada_guardado_pagado_path',['pagado',$liquidaciones_->id])}}" class="btn btn-primary btn-sm">Revisar</a>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <a href="{{route('descargar_consulta_entradas_path',$liquidaciones_->id)}}" class="text-danger"><i class="fas fa-file-pdf"></i></a>
                                                                </td>
                                                                <td>
                                                                    <a href="#!" class="text-danger" onclick="eliminar_liquidacion('{{$liquidaciones_->id}}','{{MisFunciones::fecha_peru_hora($liquidaciones_->created_at)}}')"><i class="fa fa-trash"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 d-none">
                                <table id="lista_liquidaciones"  class="table table-bordered table-striped table-responsive table-hover">
                                    <thead>
                                    <tr>
                                        <th class="d-none">ID</th>
                                        <th>DESDE</th>
                                        <th>HASTA</th>
                                        <th>ENVIADO POR</th>
                                        <th>TOTAL</th>
                                        <th>PAGADO</th>
                                        <th>SALDO</th>
                                        <th>ESTADO</th>
                                        <th>OPERACIONES</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($liquidaciones->where('estado',1)->sortByDesc('id') as $liquidacion)
                                        @php
                                            $total=0;
                                            $total_pagado=0;
                                            $total_monto=0;
                                            $total_pagado_monto=0;
                                        @endphp
                                        @foreach($cotizaciones as $cotizacion)
                                            @foreach($cotizacion->paquete_cotizaciones->where('estado',2) as $paquete_cotizaciones)
                                                @foreach($paquete_cotizaciones->itinerario_cotizaciones->where('fecha','>=',$liquidacion->ini)->where('fecha','<=',$liquidacion->fin)->sortBy('fecha') as $itinerario_cotizacion)
                                                    @foreach($itinerario_cotizacion->itinerario_servicios as $itinerario_servicio)
                                                        @foreach($servicios->where('id',$itinerario_servicio->m_servicios_id) as $serv)
                                                            @if($serv->clase=='BTG' || $serv->clase=='CAT'||$serv->clase=='KORI'||$serv->clase=='MAPI'||$serv->clase=='OTROS')
                                                                @php
                                                                    $total+=1;
                                                                    $total_monto+=$itinerario_servicio->precio_proveedor;
                                                                @endphp
                                                                @if($itinerario_servicio->liquidacion==2)
                                                                    @php
                                                                        $total_pagado+=1;
                                                                        $total_pagado_monto+=$itinerario_servicio->precio_proveedor;
                                                                    @endphp
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                        @foreach($servicios_movi->where('id',$itinerario_servicio->m_servicios_id) as $serv)
                                                            @if($serv->clase=='BOLETO')
                                                                @php
                                                                    $total+=1;
                                                                    $total_monto+=$itinerario_servicio->precio_proveedor;
                                                                @endphp
                                                                @if($itinerario_servicio->liquidacion==2)
                                                                    @php
                                                                        $total_pagado+=1;
                                                                        $total_pagado_monto+=$itinerario_servicio->precio_proveedor;
                                                                    @endphp
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                        <tr id="lista_liquidaciones_{{$liquidacion->id}}">
                                            <td class="d-none">{{$liquidacion->id}}</td>
                                            <td>{{MisFunciones::fecha_peru($liquidacion->ini)}}</td>
                                            <td>{{MisFunciones::fecha_peru($liquidacion->fin)}}</td>
                                            <td>
                                                @foreach($users->where('id',$liquidacion->user_id) as $user)
                                                    {{$user->name}} {{$liquidacion->tipo_user}}
                                                @endforeach
                                            </td>
                                            <td>{{$total_monto}}$</td>
                                            <td>{{$total_pagado_monto}}$</td>
                                            <td>{{$total_monto-$total_pagado_monto}}$</td>

                                            <td>
                                                @if($total==0)
                                                    @php
                                                        $total=1;
                                                    @endphp
                                                @endif
                                                @php
                                                    $pagado_porc=round(($total_pagado/$total)*100,2);
                                                    $color_porc='progress-bar-danger';
                                                @endphp
                                                @if(25<$pagado_porc&&$pagado_porc<=50)
                                                    @php
                                                        $color_porc='progress-bar-warning';
                                                    @endphp
                                                @endif
                                                @if(50<$pagado_porc&&$pagado_porc<=75)
                                                    @php
                                                        $color_porc='progress-bar-info';
                                                    @endphp
                                                @endif
                                                @if(75<$pagado_porc&&$pagado_porc<=100)
                                                    @php
                                                        $color_porc='progress-bar-success';
                                                    @endphp
                                                @endif
                                                <div class="progress">
                                                    <div class="progress-bar {{$color_porc}} progress-bar-striped" role="progressbar" aria-valuenow="{{$pagado_porc}}" aria-valuemin="0" aria-valuemax="100"  style="min-width: 3em; width: {{$pagado_porc}}%">
                                                        {{$pagado_porc}}%
                                                    </div>
                                                </div>
                                            </td>
                                            @php
                                                $nro_cheque_s='Ninguno';
                                                $nro_cheque_c='Ninguno';

                                            @endphp
                                            @if(strlen($liquidacion->nro_cheque_s)>0 || $liquidacion->nro_cheque_s || $liquidacion->nro_cheque_s!='')
                                                @php
                                                    $nro_cheque_s=$liquidacion->nro_cheque_s;
                                                @endphp
                                            @endif
                                            @if(strlen($liquidacion->nro_cheque_c)>0 || $liquidacion->nro_cheque_c || $liquidacion->nro_cheque_c!='')
                                                @php
                                                    $nro_cheque_c=$liquidacion->nro_cheque_c;
                                                @endphp
                                            @endif
                                            <td>
                                                <a href="{{route('contabilidad_ver_liquidacion_path',[$liquidacion->id,$nro_cheque_s,$nro_cheque_c,$liquidacion->ini,$liquidacion->fin,'C'])}}" class="btn btn-primary"><i class="fa fa-eye-slash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="menu5" class="tab-pane fade @if($grupo=='FOOD'){{'show active'}}@endif">
                            <div class="row mt-3 my-3">
                                <div class="col-md-12">
                                    <div class="card w-100">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12 form-inline">
                                                    @php
                                                        $ToDay=new Carbon();
                                                    @endphp
                                                    {{csrf_field()}}
                                                    <div class="form-group">
                                                        <label for="f_ini" class="text-secondary font-weight-bold pr-2">From </label>
                                                        <input type="date" class="form-control" name="f_ini_FOOD" id="f_ini_FOOD" value="{{$ToDay->toDateString()}}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="f_fin" class="text-secondary font-weight-bold px-2"> To </label>
                                                        <input type="date" class="form-control" name="f_fin_FOOD" id="f_fin_FOOD" value="{{$ToDay->toDateString()}}" required>
                                                    </div>
                                                    <button type="button" class="btn btn-default mx-2" onclick="buscar_servicios_pagos_pendientes($('#f_ini_FOOD').val(),$('#f_fin_FOOD').val(),'FOOD')">Filtrar</button>
                                                </div>
                                            </div><!-- /.row -->
                                            {{--<hr>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" id="rpt_FOOD">
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-12">
                                    <div class="card w-100">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h2>Consultas Guardadas(FOOD)</h2>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-4 col-md-offset-4 text-center">
                                                    @if(Session::has('message'))
                                                        <div class="alert alert-danger" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            {{Session::get('message')}}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                @foreach($consulta_serv->where('grupo','FOOD') as $consultas)
                                                    <div id="c_s_{{$consultas->id}}" class="col-md-2 text-center">
                                                        <form action="{{route('list_fechas_servivios_show_path')}}" method="post">
                                                            {{csrf_field()}}
                                                            <input type="hidden" name="grupo" value="FOOD">
                                                            <input type="hidden" name="txt_codigos" value="{{$consultas->id}}">
                                                            <a href="javascript:;" onclick="parentNode.submit();">
                                                                <img src="{{asset('images/database.png')}}" alt="" class="img-responsive" width="100px" height="100px">
                                                                {{--{{strftime("%B, %d", strtotime(str_replace('-','/', $disponibilidad->fecha_disponibilidad)))}} <span class="blue-text">${{$disponibilidad->precio_d}}</span>--}}
                                                                <br><span class="font-weight-bold text-18">Creado:{{MisFunciones::fecha_peru_hora($consultas->updated_at)}}</span>
                                                            </a>
                                                            <p>
                                                                {{--<a href="#" class="display-block text-danger" data-toggle="modal" data-target="#eliminar_{{$consultas->id}}"><i class="fa fa-trash fa-2x"></i></a>--}}
                                                                <a href="{{route('descargar_consulta_s_path',[$consultas->id,'FOOD'])}}" class="btn btn-danger"><i class="fas fa-file-pdf fa-2x"></i></a>
                                                                <a href="#" class="btn btn-danger" onclick="eliminar_consulta('{{$consultas->id}}','s')"><i class="fa fa-trash fa-2x"></i></a>
                                                            </p>
                                                        </form>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="menu6" class="tab-pane fade @if($grupo=='TRAINS'){{'show active'}}@endif">
                            <div class="row mt-3 my-3">
                                <div class="col-md-12">
                                    <div class="card w-100">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12 form-inline">
                                                    @php
                                                        $ToDay=new Carbon();
                                                    @endphp
                                                    {{csrf_field()}}
                                                    <div class="form-group">
                                                        <label for="f_ini" class="text-secondary font-weight-bold pr-2">From </label>
                                                        <input type="date" class="form-control" name="f_ini_TRAINS" id="f_ini_TRAINS" value="{{$ToDay->toDateString()}}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="f_fin" class="text-secondary font-weight-bold px-2"> To </label>
                                                        <input type="date" class="form-control" name="f_fin_TRAINS" id="f_fin_TRAINS" value="{{$ToDay->toDateString()}}" required>
                                                    </div>
                                                    <button type="button" class="btn btn-default mx-2" onclick="buscar_servicios_pagos_pendientes($('#f_ini_TRAINS').val(),$('#f_fin_TRAINS').val(),'TRAINS')">Filtrar</button>
                                                </div>
                                            </div><!-- /.row -->
                                            {{--<hr>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" id="rpt_TRAINS">
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-12">
                                    <div class="card w-100">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h2>Consultas Guardadas(TRAINS)</h2>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-4 col-md-offset-4 text-center">
                                                    @if(Session::has('message'))
                                                        <div class="alert alert-danger" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            {{Session::get('message')}}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                @foreach($consulta_serv->where('grupo','TRAINS') as $consultas)
                                                    <div id="c_s_{{$consultas->id}}" class="col-md-2 text-center">
                                                        <form action="{{route('list_fechas_servivios_show_path')}}" method="post">
                                                            {{csrf_field()}}
                                                            <input type="hidden" name="grupo" value="TRAINS">
                                                            <input type="hidden" name="txt_codigos" value="{{$consultas->id}}">
                                                            <a href="javascript:;" onclick="parentNode.submit();">
                                                                <img src="{{asset('images/database.png')}}" alt="" class="img-responsive" width="100px" height="100px">
                                                                {{--{{strftime("%B, %d", strtotime(str_replace('-','/', $disponibilidad->fecha_disponibilidad)))}} <span class="blue-text">${{$disponibilidad->precio_d}}</span>--}}
                                                                <br><span class="font-weight-bold text-18">Creado:{{MisFunciones::fecha_peru_hora($consultas->updated_at)}}</span>
                                                            </a>
                                                            <p>
                                                                {{--<a href="#" class="display-block text-danger" data-toggle="modal" data-target="#eliminar_{{$consultas->id}}"><i class="fa fa-trash fa-2x"></i></a>--}}
                                                                <a href="{{route('descargar_consulta_s_path',[$consultas->id,'TRAINS'])}}" class="btn btn-danger"><i class="fas fa-file-pdf fa-2x"></i></a>
                                                                <a href="#" class="btn btn-danger" onclick="eliminar_consulta('{{$consultas->id}}','s')"><i class="fa fa-trash fa-2x"></i></a>
                                                            </p>
                                                        </form>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="menu7" class="tab-pane fade @if($grupo=='FLIGHTS'){{'show active'}}@endif">
                            <div class="row mt-3 my-3">
                                <div class="col-md-12">
                                    <div class="card w-100">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12 form-inline">
                                                    @php
                                                        $ToDay=new Carbon();
                                                    @endphp
                                                    {{csrf_field()}}
                                                    <div class="form-group">
                                                        <label for="f_ini" class="text-secondary font-weight-bold pr-2">From </label>
                                                        <input type="date" class="form-control" name="f_ini_FLIGHTS" id="f_ini_FLIGHTS" value="{{$ToDay->toDateString()}}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="f_fin" class="text-secondary font-weight-bold px-2"> To </label>
                                                        <input type="date" class="form-control" name="f_fin_FLIGHTS" id="f_fin_FLIGHTS" value="{{$ToDay->toDateString()}}" required>
                                                    </div>
                                                    <button type="button" class="btn btn-default mx-2" onclick="buscar_servicios_pagos_pendientes($('#f_ini_FLIGHTS').val(),$('#f_fin_FLIGHTS').val(),'FLIGHTS')">Filtrar</button>
                                                </div>
                                            </div><!-- /.row -->
                                            {{--<hr>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" id="rpt_FLIGHTS">
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-12">
                                    <div class="card w-100">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h2>Consultas Guardadas(FLIGHTS)</h2>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-4 col-md-offset-4 text-center">
                                                    @if(Session::has('message'))
                                                        <div class="alert alert-danger" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            {{Session::get('message')}}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                @foreach($consulta_serv->where('grupo','FLIGHTS') as $consultas)
                                                    <div id="c_s_{{$consultas->id}}" class="col-md-2 text-center">
                                                        <form action="{{route('list_fechas_servivios_show_path')}}" method="post">
                                                            {{csrf_field()}}
                                                            <input type="hidden" name="grupo" value="FLIGHTS">
                                                            <input type="hidden" name="txt_codigos" value="{{$consultas->id}}">
                                                            <a href="javascript:;" onclick="parentNode.submit();">
                                                                <img src="{{asset('images/database.png')}}" alt="" class="img-responsive" width="100px" height="100px">
                                                                {{--{{strftime("%B, %d", strtotime(str_replace('-','/', $disponibilidad->fecha_disponibilidad)))}} <span class="blue-text">${{$disponibilidad->precio_d}}</span>--}}
                                                                <br><span class="font-weight-bold text-18">Creado:{{MisFunciones::fecha_peru_hora($consultas->updated_at)}}</span>
                                                            </a>
                                                            <p>
                                                                {{--<a href="#" class="display-block text-danger" data-toggle="modal" data-target="#eliminar_{{$consultas->id}}"><i class="fa fa-trash fa-2x"></i></a>--}}
                                                                <a href="{{route('descargar_consulta_s_path',[$consultas->id,'FLIGHTS'])}}" class="btn btn-danger"><i class="fas fa-file-pdf fa-2x"></i></a>
                                                                <a href="#" class="btn btn-danger" onclick="eliminar_consulta('{{$consultas->id}}','s')"><i class="fa fa-trash fa-2x"></i></a>
                                                            </p>
                                                        </form>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="menu8" class="tab-pane fade @if($grupo=='OTHERS'){{'show active'}}@endif">
                            <div class="row mt-3 my-3">
                                <div class="col-md-12">
                                    <div class="card w-100">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12 form-inline">
                                                    @php
                                                        $ToDay=new Carbon();
                                                    @endphp
                                                    {{csrf_field()}}
                                                    <div class="form-group">
                                                        <label for="f_ini" class="text-secondary font-weight-bold pr-2">From </label>
                                                        <input type="date" class="form-control" name="f_ini_OTHERS" id="f_ini_OTHERS" value="{{$ToDay->toDateString()}}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="f_fin" class="text-secondary font-weight-bold px-2"> To </label>
                                                        <input type="date" class="form-control" name="f_fin_OTHERS" id="f_fin_OTHERS" value="{{$ToDay->toDateString()}}" required>
                                                    </div>
                                                    <button type="button" class="btn btn-default mx-2" onclick="buscar_servicios_pagos_pendientes($('#f_ini_OTHERS').val(),$('#f_fin_OTHERS').val(),'OTHERS')">Filtrar</button>
                                                </div>
                                            </div><!-- /.row -->
                                            {{--<hr>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" id="rpt_OTHERS">
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-12">
                                    <div class="card w-100">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h2>Consultas Guardadas(OTHERS)</h2>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-4 col-md-offset-4 text-center">
                                                    @if(Session::has('message'))
                                                        <div class="alert alert-danger" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            {{Session::get('message')}}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                @foreach($consulta_serv->where('grupo','OTHERS') as $consultas)
                                                    <div id="c_s_{{$consultas->id}}" class="col-md-2 text-center">
                                                        <form action="{{route('list_fechas_servivios_show_path')}}" method="post">
                                                            {{csrf_field()}}
                                                            <input type="hidden" name="grupo" value="OTHERS">
                                                            <input type="hidden" name="txt_codigos" value="{{$consultas->id}}">
                                                            <a href="javascript:;" onclick="parentNode.submit();">
                                                                <img src="{{asset('images/database.png')}}" alt="" class="img-responsive" width="100px" height="100px">
                                                                {{--{{strftime("%B, %d", strtotime(str_replace('-','/', $disponibilidad->fecha_disponibilidad)))}} <span class="blue-text">${{$disponibilidad->precio_d}}</span>--}}
                                                                <br><span class="font-weight-bold text-18">Creado:{{MisFunciones::fecha_peru_hora($consultas->updated_at)}}</span>
                                                            </a>
                                                            <p>
                                                                {{--<a href="#" class="display-block text-danger" data-toggle="modal" data-target="#eliminar_{{$consultas->id}}"><i class="fa fa-trash fa-2x"></i></a>--}}
                                                                <a href="{{route('descargar_consulta_s_path',[$consultas->id,'OTHERS'])}}" class="btn btn-danger"><i class="fas fa-file-pdf fa-2x"></i></a>
                                                                <a href="#" class="btn btn-danger" onclick="eliminar_consulta('{{$consultas->id}}','s')"><i class="fa fa-trash fa-2x"></i></a>
                                                            </p>
                                                        </form>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {

            $(document).on('click keyup','.mis-checkboxes',function() {
                calcular();
            });

        });

        function calcular() {
            var tot = $('#total_entrances');
            var itinerario_servicio_id='';
            tot.val(0);
            $('.mis-checkboxes').each(function() {
                if($(this).hasClass('mis-checkboxes')) {
                    itinerario_servicio_id='#precio_'+$(this).attr('value');
                    // console.log('lectura del valor de '+$(this).attr('value')+' :'+$(itinerario_servicio_id).val());
                    tot.val(($(this).is(':checked') ? parseFloat($(itinerario_servicio_id).val()) : 0) + parseFloat(tot.val()));
                }
                else {
                    tot.val(parseFloat(tot.val()) + (isNaN(parseFloat($(this).val())) ? 0 : parseFloat($(this).val())));
                }
            });
            var totalParts = parseFloat(tot.val()).toFixed(2).split('.');
            tot.val(totalParts[0].replace(/\B(?=(\d{3})+(?!\d))/g, "") + '.' +  (totalParts.length > 1 ? totalParts[1] : '00'));
        }
        function eliminar_consulta(id,tipo) {
            // alert('holaaa');
            swal({
                title: 'MENSAJE DEL SISTEMA',
                text: "La consulta se eliminara permanentemente.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('[name="_token"]').val()
                    }
                });
                $.post('{{route('consulta_delete_path')}}', 'id='+id+'&tipo='+tipo, function(data) {
//                $.post('/admin/destination/delete', 'id='+id, function(data) {
                    if(data==1){
                        // $("#lista_destinos_"+id).remove();
                        $("#c_"+tipo+"_"+id).remove();
                    }
                }).fail(function (data) {

                });

            })
        }
        var total=0;
        function sumar(valor) {
            total += valor;
            document.getElementById('s_total').innerHTML   = total;
        }
        function restar(valor) {
            total-=valor;
            document.getElementById('s_total').innerHTML   = total;
        }

//        $(document).ready(function() {
//            $('#lista_liquidaciones').DataTable({
//                "order": [[ 0, "desc" ]]
//            });
//        });
    </script>
@stop