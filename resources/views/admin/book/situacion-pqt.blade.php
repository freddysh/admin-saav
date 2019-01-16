@php
    use Carbon\Carbon;
    function fecha_peru($fecha){
    $fecha=explode('-',$fecha);
    return $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
    }
    function fecha_peru1($fecha_){
        $f1=explode(' ',$fecha_);
        $hora=$f1[1];
        $f2=explode('-',$f1[0]);
        $fecha1=$f2[2].'-'.$f2[1].'-'.$f2[0];
        return $fecha1.' a las '.$hora;
    }
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
            <li class="breadcrumb-item">Reservas</li>
            <li class="breadcrumb-item">Situacion servicios</li>
        </ol>
    </nav>
    <hr>
    <div class="row my-3">
        <div class="col-lg-12">
            <div class="card w-100">
                <div class="card-body">
                    <div class="row">
                        {{csrf_field()}}
                        <div class="col-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">FILTRO</span>
                                </div>
                                <select name="opcion" id="opcion" class="form-control" onchange="mostrar_filtros($(this).val())">
                                    <option value="codigo">Por codigo</option>
                                    <option value="nombre">Por nombre</option>
                                    <option value="fechas">Entre fechas</option>
                                </select>
                            </div>
                        </div>
                        <div id="file" class="col-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">FILTRO</span>
                                </div>
                                <input type="text" class="form-control" id="codigo" placeholder="Codigo/nombre">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" onclick="mostrar_busqueda_situacion_servicios($('#opcion').val(),$('#codigo').val(),'')"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div id="fechas" class="col-6 d-none">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">FECHAS</span>
                                </div>
                                <input type="date" class="form-control" name="ini" id="ini" value="{{date("Y-m-d")}}">
                                <input type="date" class="form-control" name="fin" id="fin" value="{{date("Y-m-d")}}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" onclick="mostrar_busqueda_situacion_servicios($('#opcion').val(),$('#ini').val(),$('#fin').val())"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div id="rpt_situacion_servicios" class="col">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop