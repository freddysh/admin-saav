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
                           
                            <table class="table table-condensed table-bordered margin-top-20 table-hover table-sm text-12">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th class="text-center">Nro</th>
                                        <th class="text-center">Filtro</th>
                                        <th class="text-center">Fecha Solicitada</th>
                                        <th class="text-center">Solicitado por</th>
                                        <th class="text-center">Monto solicitado</th>
                                        <th class="text-center">Aprovado por</th>
                                        <th class="text-center">Monto aprobado</th>
                                        <th class="text-center">Estado</th>
                                        <th class="text-center">Operaciones</th>
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
                                        <td>
                                            {{$requerimiento->modo_busqueda}}
                                            <span class="">
                                                @if($requerimiento->modo_busqueda=='ENTRE DOS FECHAS'||$requerimiento->modo_busqueda=='ENTRE DOS FECHAS URGENTES')
                                                    @isset($requerimiento->fecha_ini)
                                                        <i class="fas fa-calendar text-primary"></i> {{MisFunciones::fecha_peru($requerimiento->fecha_ini)}}      
                                                    @endisset
                                                    - 
                                                    @isset($requerimiento->fecha_fin)
                                                        <i class="fas fa-calendar text-primary"></i> {{MisFunciones::fecha_peru($requerimiento->fecha_fin)}}      
                                                    @endisset
                                                @endif
                                            </span>
                                        </td>
                                        <td>{{MisFunciones::fecha_peru_hora($requerimiento->created_at)}}</td>
                                        <td>@if(isset($requerimiento->solicitante_id)){{$usuarios->where('id',$requerimiento->solicitante_id)->first()->name }}@endif</td>
                                        <td class="text-right">@if(isset($requerimiento->monto_solicitado))<b class="text-success"><sup>$</sup>{{$requerimiento->monto_solicitado}}</b>@else ----- @endif</td>
                                        <td>@if(isset($requerimiento->revisador_id)){{$usuarios->where('id',$requerimiento->revisador_id)->first()->name}}@elseif($requerimiento->estado=='2') ----- @endif</td>
                                        <td class="text-right">@if(isset($requerimiento->monto_aprobado))<b class="text-success"><sup>$</sup>{{$requerimiento->monto_aprobado}}</b>@else ----- @endif</td>
                                        <td>
                                            @if(isset($requerimiento->estado))
                                                @if($requerimiento->estado=='2')
                                                    <b class="badge badge-danger">Pendiente</b>
                                                @elseif($requerimiento->estado=='3')
                                                    <b class="badge badge-primary">Aprobado 100%</b>
                                                @elseif($requerimiento->estado=='4')
                                                    <b class="badge badge-danger">Observado</b>
                                                @elseif($requerimiento->estado=='5')
                                                    <b class="badge badge-success">Pagado</b>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($requerimiento->estado))
                                                @if($requerimiento->estado=='2')
                                                    <a href="{{route('contabilidad.operaciones_requerimiento',[$requerimiento->id,'ver'])}}" class="btn btn-sm btn-warning">Ver</a>    
                                                @elseif($requerimiento->estado=='3'||$requerimiento->estado=='4')
                                                    <a href="{{route('contabilidad.operaciones_requerimiento',[$requerimiento->id,'pagar'])}}" class="btn btn-sm btn-primary">Pagar</a>    
                                                @elseif($requerimiento->estado=='5')
                                                <a href="{{route('contabilidad.operaciones_requerimiento',[$requerimiento->id,'revisar'])}}" class="btn btn-sm btn-success">Revisar</a>    
                                                {{-- @else
                                                    <button class="btn btn-sm btn-dark">Pendiente</button>     --}}
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $requerimientos->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop