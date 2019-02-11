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
            <li class="breadcrumb-item active">Reportes</li>
        </ol>
    </nav>
    <hr>
    <div class="row">
        <div class="col">
            <div class="card">
                <h5 class="card-header bg-primary text-white"><i class="fas fa-coins"></i> PROFIT</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-check">
                                    <input class="form-check-input" type="radio" id="filtro1" name="filtro"  value="fecha de cierre" checked>
                                    <label class="form-check-label" for="filtro1">
                                            Buscar por fecha de cierre
                                    </label>
                            </div>
                        </div>
                        <div class="col-6">
                                <div class="form-check">
                                        <input class="form-check-input" type="radio" id="filtro2" name="filtro"  value="fecha de llegada">
                                        <label class="form-check-label" for="filtro2">
                                                Buscar por fecha de llegada
                                        </label>
                                </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-5">
                            <div class="form-group">
                                <label for="desde">Desde</label>
                                <input type="date" class="form-control" id="desde" name="desde" value="{{date("Y-m-d")}}">
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                <label for="hasta">Hasta</label>
                                <input type="date" class="form-control" id="hasta" name="hasta" value="{{date("Y-m-d")}}">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                {{csrf_field()}}
                                <button type="button" class="btn btn-primary mt-4" onclick="mostrar_reporte($('#desde').val(),$('#hasta').val())"><i class="fas fa-search"></i> Buscar </button>
                            </div>
                        </div>
                        <a href="{{route('reporte_profit_path')}}" class="btn btn-primary d-none">
                            <i class="fas fa-coins fa-4x"></i><p>Profit</p>
                        </a>
                    </div>
                    <div id="rpt_profit"></div>
                </div>
            </div>
        </div>
    </div>

    <table id="example" class="table table-striped table-bordered d-none" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>#</th>
            <th>Cotizaciones</th>
            <th>Operaciones</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>#</th>
            <th>Cotizaciones</th>
            <th>Operaciones</th>
        </tr>
        </tfoot>
        <tbody>
        @php
            $dato_cliente='';
            $i=1;
        @endphp
        @foreach($cotizacion->sortByDesc('fecha') as $cotizacion_cat_)
            @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                @if($clientes->estado==1)
                    @php
                        $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->apellidos;
                    @endphp
                @endif
            @endforeach
            <tr id="lista_categoria_{{$cotizacion_cat_->id}}">
                <td>{{$i++}}</td>
                <td>
                    <strong>
                    <img src="https://assets.pipedrive.com/images/icons/profile_120x120.svg" alt="">
                        {{ucwords(strtolower($dato_cliente))}} X{{$cotizacion_cat_->nropersonas}}: {{$cotizacion_cat_->duracion}} days: {{strftime("%d %B, %Y", strtotime(str_replace('-','/', $cotizacion_cat_->fecha)))}}
                    </strong>
                    <small>
                       $
                    </small>
                </td>
                <td class="text-center">
                    <a type="button" class="btn btn-primary btn-sm" href="{{route('ver_cotizacion_path',$cotizacion_cat_->id)}}" >
                        <i class="fa fa-eye-slash" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    <div class="row">
        <div class="col">
        <form id="archivo" action="{{route('enviar_file_path')}}" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nombre">nombre</label>
                <input type="text" name="nombre" id="nombre">
            </div>
            <div class="form-group">
                <label for="foto">File</label>
                <input type="file" name="foto" id="foto">
            </div>
            {{ csrf_field() }}
            <button class="btn btn-primary" type="button" onclick="enviar()">enviar</button>
        </form>
        </div>
    </div>  
        
    {{--<div class="row margin-top-5 hide">--}}
        {{--<div class="col-md-6 no-padding">--}}
            {{--<div class="box-header-book">--}}
                {{--<h4 class="no-margin">New--}}
                    {{--<span>--}}
                        {{--<b class="label label-danger">#{{$cotizacion->count()}}</b>--}}
                        {{--<small><b> </b>  </small>--}}
                    {{--</span>--}}
                {{--</h4>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<script>--}}
        {{--$(document).ready(function() {--}}
            {{--$('#example').DataTable();--}}
        {{--} );--}}
    {{--</script>--}}

    <script>
    function enviar(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.ajax({
            type:'POST',
            url: $('#archivo').attr('action'),
            data:$('#archivo').serialize(),
            cache:false,
            contentType: true,
            processData: false,
            success:function(data){
                console.log(data);
                // toastr.error('Validation true!', 'se pudo Añadir los datos<br>', {timeOut: 5000});
            },
            error: function(jqXHR, text, error){
                console.log('error');
                // toastr.error('Validation error!', 'No se pudo Añadir los datos<br>' + error, {timeOut: 5000});
            }
        });
    }
    </script>
@stop
