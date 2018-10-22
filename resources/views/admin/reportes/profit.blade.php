@php
    function fecha_peru($fecha){
        $fecha_temp='';
        $fecha_temp=explode('-',$fecha);
        return $fecha_temp[2].'/'.$fecha_temp[1].'/'.$fecha_temp[0];
    }
@endphp

@extends('layouts.admin.reportes')
@section('archivos-js')
    <script src="{{asset("https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js")}}"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
@stop
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white m-0">
            <li class="breadcrumb-item" aria-current="page"><a href="/">Home</a></li>
            <li class="breadcrumb-item ">Reportes</li>
            <li class="breadcrumb-item active">Profit</li>
        </ol>
    </nav>
    <hr>
    <div class="row">
        <div class="col">
            <form action="{{route('reporte_profit_buscar_path')}}" method="post" class="row">
                <div class="form-group col">
                    <label for="desde">Desde</label>
                    <input type="date" class="form-control" id="desde" name="desde" value="{{date("Y-m-d")}}">
                </div>
                <div class="form-group col">
                    <label for="hasta">Hasta</label>
                    <input type="date" class="form-control" id="hasta" name="hasta" value="{{date("Y-m-d")}}">
                </div>
                <div class="form-group col">
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-primary mt-4"><i class="fas fa-search"></i> Buscar</button>
                </div>
            </form>

        </div>
    </div>

@stop
