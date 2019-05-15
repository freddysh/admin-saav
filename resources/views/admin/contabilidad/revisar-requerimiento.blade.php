@php
    use Carbon\Carbon;
    $arra_prov_pagos=[];
    function fecha_peru($fecha){
        $f1=explode('-',$fecha);
        return $f1[2].'-'.$f1[1].'-'.$f1[0];
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
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-9">
                                            <table class="table table-condensed table-bordered margin-top-20 table-hover table-sm text-12">
                                                <thead>
                                                    <tr>
                                                        <th class="text-grey-goto text-center">Nro</th>
                                                        <th class="text-grey-goto text-center">Modo de busqueda</th>
                                                        <th class="text-grey-goto text-center">Fecha Solicitada</th>
                                                        <th class="text-grey-goto text-center">Monto solicitado</th>
                                                        <th class="text-grey-goto text-center">Monto aprobado</th>
                                                        <th class="text-grey-goto text-center">Solicitante</th>
                                                        <th class="text-grey-goto text-center">Aprovo</th>
                                                        <th class="text-grey-goto text-center">Estado</th>
                                                        <th class="text-grey-goto text-center">Operaciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $i=0;
                                                    @endphp
                                                    @foreach($requerimientos as $key => $requerimiento)
                                                    @php
                                                        $i++;
                                                    @endphp
                                                    <tr>
                                                        <td>{{$i}}</td>
                                                        <td>{{$requerimiento->modo_busqueda}}</td>
                                                        <td>{{$requerimiento->created_at}}</td>
                                                        <td>{{$requerimiento->monto_solicitado}}</td>
                                                        <td>{{$requerimiento->monto_aprobado}}</td>
                                                        <td>{{$requerimiento->monto_aprobado}}</td>
                                                        <td>{{$requerimiento->monto_aprobado}}</td>
                                                        <td>
                                                            @if($requerimiento->estado=='2')
                                                                <b class="badge badge-danger">Pendiente</b>
                                                            @elseif($requerimiento->estado=='3')
                                                                <b class="badge badge-danger">Aprobado 100%</b>
                                                            @elseif($requerimiento->estado=='4')
                                                                <b class="badge badge-danger">Observado</b>
                                                            @elseif($requerimiento->estado=='5')
                                                                <b class="badge badge-danger">Pagado</b>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($requerimiento->estado=='3'||$requerimiento->estado=='4')
                                                                <button class="btn btn-sm btn-success">Pagar</button>    
                                                            @elseif($requerimiento->estado=='5')
                                                                <button class="btn btn-sm btn-primary">Revisar</button>    
                                                            {{-- @else
                                                                <button class="btn btn-sm btn-dark">Pendiente</button>     --}}
                                                            @endif
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
                </div>
            </div>
        </div>
    </div>
@stop