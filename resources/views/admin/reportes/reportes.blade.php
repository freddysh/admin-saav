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
@stop
@section('content')
    <table id="example" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>#</th>
            <th>Cotizaciones</th>
            <th class="col-lg-1">Operaciones</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>#</th>
            <th>Cotizaciones</th>
            <th class="col-lg-1">Operaciones</th>
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
                <td class="col-lg-1">
                    <a type="button" class="btn btn-primary" href="{{route('ver_cotizacion_path',$cotizacion_cat_->id)}}" >
                        <i class="fa fa-eye-slash" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


    <div class="row margin-top-5 hide">
        <div class="col-md-6 no-padding">
            <div class="box-header-book">
                <h4 class="no-margin">New
                    <span>
                        <b class="label label-danger">#{{$cotizacion->count()}}</b>
                        <small><b> </b>  </small>
                    </span>
                </h4>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
@stop