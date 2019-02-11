@php
function fecha_peru($fecha){
$f=explode('-',$fecha);
return $f[2].'-'.$f[1].'-'.$f[0];
}
function fecha_peru_hora($fecha){
$f0=explode(' ',$fecha);
$f=explode('-',$f0[0]);

return $f[2].'-'.$f[1].'-'.$f[0].' '.$f0[1];
}
@endphp
@extends('layouts.admin.admin')
@section('archivos-css')
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
@stop
@section('archivos-js')
    <script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
@stop
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white m-0">
            <li class="breadcrumb-item" aria-current="page"><a href="/">Home</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="/">Quotes</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="/">Expedia</a></li>
            <li class="breadcrumb-item active">New</li>
        </ol>
    </nav>
    <hr>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="row">
                    <div class="col">
                        @if(Session::has('msg'))
                            @if(Session::get("msg")=='OK')
                                {{-- <div class="alert alert-success" role="alert">Archivo subido, revise su panel <a href="{{route('current_quote_page_expedia_path',[$anio,$mes,'expedia.com'])}}">EXPEDIA</a></div> --}}
                                <div class="alert alert-success" role="alert">Archivo subido, revise su panel <a href="{{route('current_sales_type_page_path',[$anio,$mes,$page,'close-date'])}}">EXPEDIA</a></div>
                            @else
                                <div class="alert alert-danger" role="alert">Error al subir el archivo</div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop