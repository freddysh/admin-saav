@php
function fecha_peru($fecha){
    if($fecha!=''){
        $f=explode('-',$fecha);
        if(strlen($f[0])==2){//-- peru
            return $fecha;
        }
        else if(strlen($f[0])==4){//-- ee.uu
            return $f[2].'-'.$f[1].'-'.$f[0];
        }
    }
    else
        return 'no hay fecha';
}

function fecha_peru_hora($fecha){
    if($fecha!=''){
        $f0=explode(' ',$fecha);
        $f=explode('-',$f0[0]);
        return $f[2].'-'.$f[1].'-'.$f[0].' '.$f0[1];
    }
    else
        return 'no hay fecha'; 
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
                    Vista previa del archivo
                </div>
                <div class="card-body">
                    <div class="row  text-center">
                        <div class="col text-center my-2">
                            <b class="text-20 badge badge-primary">{{$web}}</b>
                        </div>   
                    </div>
                    <table class="table table-striped table-bordered table-responsive table-hover table-condensed text-12">
                        <thead>
                            <th>
                                <td>TOTAL TRAVELERS</td>
                                <td>CODIGO</td>
                                <td>ESTRELLAS</td>
                                <td>TRANSACCION DATE TIME</td>
                                <td>TITULO</td>
                                <td>IDIOMA</td>
                                <td>NOMBRES</td>
                                <td>TELEFONO</td>
                                <td>EMAIL</td>
                                <td>TOTAL</td>
                                <td>FECHA LLEGADA</td>
                                <td>NOTAS</td>
                            </th>
                        </thead>
                        <tbody>
                        @php
                            $i=0;
                        @endphp
                        @foreach($arr as $arreglo)
                            @php
                                $i++;
                            @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$arreglo['totaltravelers']}}</td>
                                <td>{!! $arreglo['codigo'] !!}</td>
                                <td>{{$arreglo['estrellas']}}</td>
                                <td>{{$arreglo['transactiondatetime']}}</td>
                                <td>{{$arreglo['titulo']}}</td>
                                <td>{{$arreglo['idioma']}}</td>
                                <td>{{$arreglo['nombres']}}</td>
                                <td>{{$arreglo['telefono']}}</td>
                                <td>{{$arreglo['email']}}</td>
                                <td>{{$arreglo['total']}}</td>
                                <td>{{$arreglo['fecha_llegada']}}</td>
                                <td>{!!$arreglo['notas']!!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col">
                            <a href="{{route('quotes_new1_expedia_path')}}" class="btn btn-primary btn-block"><i class="fas fa-arrow-alt-circle-left"></i> CARGAR NUEVO ARCHIVO</a>
                        </div>
                        <div class="col">
                            <form action="{{route('quotes_new1_expedia_save_path')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <input type="hidden" name="web" value="{{$web}}">
                                <input type="hidden" name="import_file" value="{{$filename}}">
                                @if ($errores==0)
                                    <button type="submit" class="btn btn-primary btn-block">HACER RESERVA <i class="fas fa-arrow-alt-circle-right"></i></button>
                                @else
                                    <button type="button" class="btn btn-warning btn-block">TIENES QUE CORREGIR LAS OBSERVACIONES <i class="fas fa-exclamation-triangle"></i></button>    
                                @endif
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@stop