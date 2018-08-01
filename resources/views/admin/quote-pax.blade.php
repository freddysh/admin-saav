@extends('layouts.admin.admin')
@section('archivos-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">
@stop
@section('archivos-js')
    <script src="{{asset("https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js")}}"></script>
@stop
@section('content')

    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Database</li>
            <li class="active">Destination</li>
        </ol>
    </div>
    <div class="row margin-top-20">
        <table id="cliente" class="table table-striped table-bordered table-responsive table-hover" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>N°Personas</th>
                <th>Duración</th>
                <th>Fecha de viaje</th>
            </tr>
            </thead>
            {{--<tfoot>--}}
            {{--<tr>--}}
                {{--<th>Nombres</th>--}}
                {{--<th>Apellidos</th>--}}
                {{--<th>Nacionalidad</th>--}}
                {{--<th>Email</th>--}}
            {{--</tr>--}}
            {{--</tfoot>--}}
            <tbody>
            @foreach($cotizacion->sortBy('fecha') as $cotizaciones)
                @foreach($cotizaciones->cotizaciones_cliente as $coti_cliente)
                    {{--@foreach($coti_cliente->cliente as $cliente)--}}
                        {{--{{$cliente}}--}}
                    {{--@endforeach--}}
                    @foreach($clients->where('id', $coti_cliente->clientes_id) as $cliente)
{{--                        {{$cliente->nombres}}--}}
                        <tr onClick="CrearEnlace('{{route('pax_show_path', $cotizaciones->id)}}');" class="clickable">
                            <td>{{ucwords(strtolower($cliente->nombres))}}</td>
                            <td>{{$cliente->apellidos}}</td>
                            <td>
                                <span class="text-warning">(X{{$cotizaciones->nropersonas}})</span>
                                @for($i = 0; $i < $cotizaciones->nropersonas; $i++)
                                <i class="fa fa-male fa-2x"></i>
                                @endfor
                            </td>
                            <td>{{$cotizaciones->duracion}} days</td>
                            <td>{{$cotizaciones->fecha}}</td>
                        </tr>
                    @endforeach
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
    {{--<script>--}}
        {{--$(document).ready(function() {--}}
            {{--$('#client').DataTable();--}}
        {{--} );--}}
    {{--</script>--}}
    <script type="text/javascript" language="javascript">
        jQuery(document).ready(function () {
            $("#cliente").dataTable();
        });
        function CrearEnlace(url) {
            location.href=url;
        }
    </script>
@stop