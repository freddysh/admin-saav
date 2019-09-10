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
                    @if (Session::has('message'))
                        @php
                            $type=Session::get('alert-type');
                        @endphp
                        @switch($type)
                            @case('info')
                                
                                    <script>
                                        toastr.info('{{Session::get('message')}}')
                                    </script>
                                
                                @break
                            @case('success')
                                
                                    <script>
                                        toastr.success('{{Session::get('message')}}')
                                    </script>
                                
                                @break
                            @case('warning')
                                
                                    <script>
                                        toastr.warning('{{Session::get('message')}}')
                                    </script>
                                
                                @break
                            @case('error')
                                
                                    <script>
                                        toastr.error('{{Session::get('message')}}')
                                    </script>
                                @break
                                
                        @endswitch
                    @endif
                    <div class="row">
                        <div class="col-12 border-dark">
                            <form action="{{route('contabilidad.revisar_requerimiento_contabilidad_buscar')}}" method="post">
                                <div class="row">
                                    <div class="col-2 bg-dark">
                                        <b class="text-white">BUSCAR</b>
                                    </div>
                                    <div class="col-10 bg-dark">
                                        <div class="input-group mb-1 mt-1">
                                            <input type="text" class="form-control" name="codigo" placeholder="Codigo">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    @csrf
                                                    <button class="btn btn-dark" type="submit"><i class="fas fa-search"></i> Buscar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 borde-danger d-none">
                            <div class="row">
                                <div class="col-12 bg-danger">
                                    <b class="text-white">NUEVO</b>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    @foreach ($requerimientos_nuevo as $key => $requerimiento)
                                        <div id="fila_{{$requerimiento->id}}" class="row mb-2 border border-top-0 border-right-0 border-left-0">
                                            <div class="col-3 px-1 text-left text-11">
                                                @if(isset($requerimiento->estado))
                                                    @if($requerimiento->estado=='2')
                                                    <b class="text-success">{{$requerimiento->codigo}}</b><a href="{{route('contabilidad.operaciones_requerimiento',[$requerimiento->id,'ver'])}}" > <b><i class="fas fa-eye"></i>Ver</b></a>
                                                    @elseif($requerimiento->estado=='3'||$requerimiento->estado=='4')
                                                    <b class="text-success">{{$requerimiento->codigo}}</b><a href="{{route('contabilidad.operaciones_requerimiento',[$requerimiento->id,'pagar'])}}" > <b><i class="fas fa-eye"></i> Pagar</b></a>
                                                    @elseif($requerimiento->estado=='5')
                                                    <b class="text-success">{{$requerimiento->codigo}}</b><a href="{{route('contabilidad.operaciones_requerimiento',[$requerimiento->id,'pagar'])}}" > <b><i class="fas fa-eye"></i> Revisar</b></a>
                                                    {{-- @elseif($requerimiento->estado=='3'||$requerimiento->estado=='4')
                                                        <a href="{{route('contabilidad.operaciones_requerimiento',[$requerimiento->id,'pagar'])}}" class="btn btn-sm btn-primary">Pagar</a>
                                                    @elseif($requerimiento->estado=='5')
                                                    <a href="{{route('contabilidad.operaciones_requerimiento',[$requerimiento->id,'aprobar'])}}" class="btn btn-sm btn-success">Revisar</a> --}}
                                                    {{-- @else
                                                        <button class="btn btn-sm btn-dark">Pendiente</button>     --}}
                                                    @endif
                                                @endif
                                                {{--  <a href="#!"><b class="text-success">{{$requerimiento->codigo}}</b> <b><i class="fas fa-eye"></i></b></a>  --}}
                                            </div>
                                            <div class="col-7 px-1 text-left text-10">
                                                | <b><i class="fas fa-filter"></i></b>
                                                <span>{{$requerimiento->modo_busqueda}} </span>
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
                                            </div>
                                            <div class="col-2 text-left text-10">
                                                <a href="#!" class="text-danger pointer" onclick="borrar_items_pago('{{$requerimiento->id}}','{{$requerimiento->codigo}}')"> <i class="fas fa-trash-alt"></i> </a>
                                            </div>
                                            <div class="col-3 px-1 text-left text-12">
                                                @if(isset($requerimiento->estado))
                                                    @if($requerimiento->estado=='2')
                                                        <b class="badge badge-danger">Pendiente</b>
                                                    @elseif($requerimiento->estado=='3')
                                                        <b class="badge badge-primary">Aprobado</b>
                                                    @elseif($requerimiento->estado=='4')
                                                        <b class="badge badge-danger">Observado</b>
                                                    @elseif($requerimiento->estado=='5')
                                                        <b class="badge badge-success">Pagado</b>
                                                    @endif
                                                @endif
                                            </div>                                            
                                            <div class="col-3 px-1 text-left text-11 text-primary">
                                                <b>By 
                                                    @if(isset($requerimiento->solicitante_id)){{$usuarios->where('id',$requerimiento->solicitante_id)->first()->name}}
                                                    @else
                                                        ----
                                                    @endif
                                                </b>
                                            </div>
                                            <div class="col-4 px-0 text-center text-11">
                                                <b><i class="fas fa-calendar text-dark"></i> {{MisFunciones::fecha_peru_hora_nros($requerimiento->created_at)}}</b>
                                            </div>
                                            <div class="col-2 bg-green-goto text-white px-0 text-right text-11">
                                                <b><sup>$</sup>
                                                    @if(isset($requerimiento->monto_solicitado))
                                                        {{$requerimiento->monto_solicitado}}
                                                    @else
                                                        ----
                                                    @endif
                                                </b>                                                    
                                            </div>
                                        </div>
                                    @endforeach    
                                </div>
                            </div>
                        </div>
                        <div class="col-6  borde-info">
                            <div class="row">
                                <div class="col-12 bg-primary">
                                    <b class="text-white">APROVADO</b>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    @foreach ($requerimientos_aprovado as $key => $requerimiento)
                                        <div class="row mb-2 border border-top-0 border-right-0 border-left-0">
                                            <div class="col-2 px-1 text-left text-11">
                                                @if(isset($requerimiento->estado))
                                                    @if($requerimiento->estado=='2')
                                                    <b class="text-success">{{$requerimiento->codigo}}</b><a href="{{route('contabilidad.operaciones_requerimiento',[$requerimiento->id,'ver'])}}" > <b><i class="fas fa-eye"></i>Ver</b></a>
                                                    @elseif($requerimiento->estado=='3'||$requerimiento->estado=='4')
                                                    <b class="text-success">{{$requerimiento->codigo}}</b><a href="{{route('contabilidad.operaciones_requerimiento',[$requerimiento->id,'pagar'])}}" > <b><i class="fas fa-eye"></i> Pagar</b></a>
                                                    @elseif($requerimiento->estado=='5')
                                                    <b class="text-success">{{$requerimiento->codigo}}</b><a href="{{route('contabilidad.operaciones_requerimiento',[$requerimiento->id,'pagar'])}}" > <b><i class="fas fa-eye"></i> Revisar</b></a>
                                                    {{-- @elseif($requerimiento->estado=='3'||$requerimiento->estado=='4')
                                                        <a href="{{route('contabilidad.operaciones_requerimiento',[$requerimiento->id,'pagar'])}}" class="btn btn-sm btn-primary">Pagar</a>
                                                    @elseif($requerimiento->estado=='5')
                                                    <a href="{{route('contabilidad.operaciones_requerimiento',[$requerimiento->id,'aprobar'])}}" class="btn btn-sm btn-success">Revisar</a> --}}
                                                    {{-- @else
                                                        <button class="btn btn-sm btn-dark">Pendiente</button>     --}}
                                                    @endif
                                                @endif
                                                {{--  <a href="#!"><b class="text-success">{{$requerimiento->codigo}}</b> <b><i class="fas fa-eye"></i></b></a>  --}}
                                            </div>
                                            <div class="col-5 px-1 text-left text-10">
                                                <b><i class="fas fa-filter"></i></b>
                                                <span>{{$requerimiento->tipo_pago}} </span> 
                                                | 
                                                <b><i class="fas fa-filter"></i></b>
                                                <span>{{$requerimiento->modo_busqueda}} </span>
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
                                            </div>
                                            <div class="col-3 px-1 text-left text-12 d-none">
                                                @if(isset($requerimiento->estado))
                                                    @if($requerimiento->estado=='2')
                                                        <b class="badge badge-danger">Pendiente</b>
                                                    @elseif($requerimiento->estado=='3')
                                                        <b class="badge badge-primary">Aprobado</b>
                                                    @elseif($requerimiento->estado=='4')
                                                        <b class="badge badge-danger">Observado</b>
                                                    @elseif($requerimiento->estado=='5')
                                                        <b class="badge badge-success">Pagado</b>
                                                    @endif
                                                @endif
                                            </div>                                            
                                            <div class="col-1 px-1 text-left text-11 text-primary">
                                                <b><i class="fas fa-user"></i> 
                                                    @if(isset($requerimiento->solicitante_id)){{$usuarios->where('id',$requerimiento->solicitante_id)->first()->name}}
                                                    @else
                                                        ----
                                                    @endif
                                                </b>
                                            </div>
                                            <div class="col-2 px-0 text-center text-11">
                                                <b><i class="fas fa-calendar text-dark"></i> {{MisFunciones::fecha_peru_hora_nros($requerimiento->created_at)}}</b>
                                            </div>
                                            <div class="col-1 bg-green-goto text-white text-right text-11 px-1">
                                                <b><sup>$</sup>
                                                    @if(isset($requerimiento->monto_solicitado))
                                                        {{$requerimiento->monto_solicitado}}
                                                    @else
                                                        ----
                                                    @endif
                                                </b>                                                    
                                            </div>
                                            <div class="col-1 text-right text-12">
                                                <a href="#!" class="text-danger pointer" onclick="borrar_items_pago('{{$requerimiento->id}}','{{$requerimiento->codigo}}','{{$requerimiento->estado}}')"> <i class="fas fa-trash-alt"></i> </a>
                                            </div>
                                        </div>
                                    @endforeach    
                                </div>
                            </div>
                        </div>
                        <div class="col-6 borde-success">
                            <div class="row">
                                <div class="col-12 bg-success">
                                    <b class="text-white">PAGADO/CERRADO</b>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                        @foreach ($requerimientos_pagado as $key => $requerimiento)
                                        <div class="row mb-2 border border-top-0 border-right-0 border-left-0">
                                            <div class="col-2 px-1 text-left text-11">
                                                @if(isset($requerimiento->estado))
                                                    @if($requerimiento->estado=='2')
                                                    <b class="text-success">{{$requerimiento->codigo}}</b><a href="{{route('contabilidad.operaciones_requerimiento',[$requerimiento->id,'ver'])}}" > <b><i class="fas fa-eye"></i>Ver</b></a>
                                                    @elseif($requerimiento->estado=='3'||$requerimiento->estado=='4')
                                                    <b class="text-success">{{$requerimiento->codigo}}</b><a href="{{route('contabilidad.operaciones_requerimiento',[$requerimiento->id,'pagar'])}}" > <b><i class="fas fa-eye"></i> Pagar</b></a>
                                                    @elseif($requerimiento->estado=='5')
                                                    <b class="text-success">{{$requerimiento->codigo}}</b><a href="{{route('contabilidad.operaciones_requerimiento',[$requerimiento->id,'pagar'])}}" > <b><i class="fas fa-eye"></i> Revisar</b></a>
                                                    {{-- @elseif($requerimiento->estado=='3'||$requerimiento->estado=='4')
                                                        <a href="{{route('contabilidad.operaciones_requerimiento',[$requerimiento->id,'pagar'])}}" class="btn btn-sm btn-primary">Pagar</a>
                                                    @elseif($requerimiento->estado=='5')
                                                    <a href="{{route('contabilidad.operaciones_requerimiento',[$requerimiento->id,'aprobar'])}}" class="btn btn-sm btn-success">Revisar</a> --}}
                                                    {{-- @else
                                                        <button class="btn btn-sm btn-dark">Pendiente</button>     --}}
                                                    @endif
                                                @endif
                                                {{--  <a href="#!"><b class="text-success">{{$requerimiento->codigo}}</b> <b><i class="fas fa-eye"></i></b></a>  --}}
                                            </div>
                                            <div class="col-5 px-1 text-left text-10">
                                                <b><i class="fas fa-filter"></i></b>
                                                <span>{{$requerimiento->tipo_pago}} </span> 
                                                | 
                                                <b><i class="fas fa-filter"></i></b>
                                                <span>{{$requerimiento->modo_busqueda}} </span>
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
                                            </div>
                                            <div class="col-3 px-1 text-left text-12 d-none">
                                                @if(isset($requerimiento->estado))
                                                    @if($requerimiento->estado=='2')
                                                        <b class="badge badge-danger">Pendiente</b>
                                                    @elseif($requerimiento->estado=='3')
                                                        <b class="badge badge-primary">Aprobado</b>
                                                    @elseif($requerimiento->estado=='4')
                                                        <b class="badge badge-danger">Observado</b>
                                                    @elseif($requerimiento->estado=='5')
                                                        <b class="badge badge-success">Pagado</b>
                                                    @endif
                                                @endif
                                            </div>                                            
                                            <div class="col-1 px-1 text-left text-11 text-primary">
                                                <b><i class="fas fa-user"></i>
                                                    @if(isset($requerimiento->solicitante_id)){{$usuarios->where('id',$requerimiento->solicitante_id)->first()->name}}
                                                    @else
                                                        ----
                                                    @endif
                                                </b>
                                            </div>
                                            <div class="col-2 px-0 text-center text-11">
                                                <b><i class="fas fa-calendar text-dark"></i> {{MisFunciones::fecha_peru_hora_nros($requerimiento->created_at)}}</b>
                                            </div>
                                            <div class="col-1 bg-green-goto text-white text-right text-11 px-1">
                                                <b><sup>$</sup>
                                                    @if(isset($requerimiento->monto_solicitado))
                                                        {{$requerimiento->monto_solicitado}}
                                                    @else
                                                        ----
                                                    @endif
                                                </b>                                                    
                                            </div>
                                            <div class="col-1 text-right text-12">
                                                <a href="#!" class="text-danger pointer" onclick="borrar_items_pago('{{$requerimiento->id}}','{{$requerimiento->codigo}}','{{$requerimiento->estado}}')"> <i class="fas fa-trash-alt"></i> </a>
                                            </div>
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
@stop