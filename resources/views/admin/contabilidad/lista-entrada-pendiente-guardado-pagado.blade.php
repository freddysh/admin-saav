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
                        <div class="col-10">
                            <b>{{$opcion}}</b>
                            <b class="text-unset @if($opcion=='TODOS LOS PENDIENTES') d-none @endif">LIQUIDACION DESDE: <span class="text-green-goto">{{MisFunciones::fecha_peru($ini)}}</span> - HASTA: <span class="text-green-goto">{{MisFunciones::fecha_peru($fin)}}</span></b>
                            <div class="row">
                                <div class="col-12">
                                    @php
                                        $total=0;
                                    @endphp
                                    <table class="table table-bordered table-striped table-responsive table-hover table-condensed">
                                        <thead>
                                            <tr>
                                                <th width="150px">FECHA USO</th>
                                                <th width="150px">FECHA DE PAGO</th>
                                                <th width="40px">CLASE</th>
                                                <th width="250px">SERVICIO</th>
                                                <th width="30px">AD</th>
                                                <th width="300px">PAX</th>
                                                <th width="50px">$ AD</th>
                                                <th width="50px">TOTAL</th>
                                                <th width="50px">PRIORIDAD</th>
                                                <th width="50px">OPER.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <tr><td colspan="9" class="bg-grey-goto text-white"><b>LIQUIDACION DE BOLETOS TURISTICOS</b></td></tr>
                                        @if($opcion=='POR CODIGO'|| $opcion=='POR NOMBRE')
                                            @foreach($cotizacion_codigo_o_nombre->sortBy('fecha') as $cotizacion_)
                                                @foreach($cotizacion_->paquete_cotizaciones as $paquete_cotizaciones)
                                                    @foreach($paquete_cotizaciones->itinerario_cotizaciones->sortBy('fecha') as $itinerario_cotizaciones)
                                                        @foreach($itinerario_cotizaciones->itinerario_servicios->whereIn('liquidacion',array(1,2)) as $itinerario_servicios)
                                                            @if($itinerario_servicios->servicio->grupo=='ENTRANCES' && $itinerario_servicios->servicio->clase=='BTG')
                                                                @if($boton=='pagado')
                                                                    @if($itinerario_servicios->liquidacion_id==$id)
                                                                        @php
                                                                            $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                                        @endphp
                                                                        <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                            <td>
                                                                                <label class="text-primary">
                                                                                    <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}" @if($itinerario_servicios->liquidacion_id==$id){{'checked="checked"'}}@endif>
                                                                                    <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                                    <b>{{MisFunciones::fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                                </label>
                                                                            </td>
                                                                            <td>
                                                                                <b>{{MisFunciones::fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                            </td>
                                                                            <td>{{$itinerario_servicios->servicio->clase}}</td>
                                                                            <td>{{$itinerario_servicios->nombre}}</td>
                                                                            <td>{{$cotizacion_->nropersonas}}</td>
                                                                            <td>
                                                                                <b>
                                                                                    @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                                        {{$cotizaciones_cliente->cliente->nombres}} {{$cotizaciones_cliente->cliente->apellidos}}x{{$cotizacion_->nropersonas}} {{MisFunciones::fecha_peru($cotizacion_->fecha)}}
                                                                                    @endforeach
                                                                                </b>
                                                                            </td>
                                                                            <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                            <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                            <td class="text-right">
                                                                                <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                                    {{$itinerario_servicios->prioridad}}
                                                                                </b>
                                                                            </td>
                                                                            <td>
                                                                                <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                @elseif($boton=='guardado')
                                                                    @php
                                                                        $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                                    @endphp
                                                                    <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                        <td>
                                                                            <label class="text-primary">
                                                                                <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}" @if($itinerario_servicios->liquidacion_id==$id){{'checked="checked"'}}@endif>
                                                                                <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                                <b>{{MisFunciones::fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <b>{{MisFunciones::fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                        </td>
                                                                        <td>{{$itinerario_servicios->servicio->clase}}</td>
                                                                        <td>{{$itinerario_servicios->nombre}}</td>
                                                                        <td>{{$cotizacion_->nropersonas}}</td>
                                                                        <td>
                                                                            <b>
                                                                                @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                                    {{$cotizaciones_cliente->cliente->nombres}} {{$cotizaciones_cliente->cliente->apellidos}}x{{$cotizacion_->nropersonas}} {{MisFunciones::fecha_peru($cotizacion_->fecha)}}
                                                                                @endforeach
                                                                            </b>
                                                                        </td>
                                                                        <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                        <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                        <td class="text-right">
                                                                            <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                                {{$itinerario_servicios->prioridad}}
                                                                            </b>
                                                                        </td>
                                                                        <td>
                                                                            <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        @else
                                            @foreach($cotizacion->sortBy('fecha') as $cotizacion_)
                                                @foreach($cotizacion_->paquete_cotizaciones as $paquete_cotizaciones)
                                                    @foreach($paquete_cotizaciones->itinerario_cotizaciones->sortBy('fecha') as $itinerario_cotizaciones)
                                                        @foreach($itinerario_cotizaciones->itinerario_servicios->whereIn('liquidacion',array(1,2)) as $itinerario_servicios)
                                                            @if($itinerario_servicios->servicio->grupo=='ENTRANCES' && $itinerario_servicios->servicio->clase=='BTG')
                                                                @if($boton=='pagado')
                                                                    @if($itinerario_servicios->liquidacion_id==$id)
                                                                        @php
                                                                            $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                                        @endphp
                                                                        <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                            <td>
                                                                                <label class="text-primary">
                                                                                    <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}" @if($itinerario_servicios->liquidacion_id==$id){{'checked="checked"'}}@endif>
                                                                                    <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                                    <b>{{MisFunciones::fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                                </label>
                                                                            </td>
                                                                            <td>
                                                                                <b>{{MisFunciones::fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                            </td>
                                                                            <td>{{$itinerario_servicios->servicio->clase}}</td>
                                                                            <td>{{$itinerario_servicios->nombre}}</td>
                                                                            <td>{{$cotizacion_->nropersonas}}</td>
                                                                            <td>
                                                                                <b>
                                                                                    @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                                        {{$cotizaciones_cliente->cliente->nombres}} {{$cotizaciones_cliente->cliente->apellidos}}x{{$cotizacion_->nropersonas}} {{MisFunciones::fecha_peru($cotizacion_->fecha)}}
                                                                                    @endforeach
                                                                                </b>
                                                                            </td>
                                                                            <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                            <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                            <td class="text-right">
                                                                                <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                                    {{$itinerario_servicios->prioridad}}
                                                                                </b>
                                                                            </td>
                                                                            <td>
                                                                                <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                @elseif($boton=='guardado')
                                                                    @if ($itinerario_servicios->prioridad== $prioridad)
                                                                        @php
                                                                            $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                                        @endphp
                                                                        <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                            <td>
                                                                                <label class="text-primary">
                                                                                    <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}" @if($itinerario_servicios->liquidacion_id==$id){{'checked="checked"'}}@endif>
                                                                                    <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                                    <b>{{MisFunciones::fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                                </label>
                                                                            </td>
                                                                            <td>
                                                                                <b>{{MisFunciones::fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                            </td>
                                                                            <td>{{$itinerario_servicios->servicio->clase}}</td>
                                                                            <td>{{$itinerario_servicios->nombre}}</td>
                                                                            <td>{{$cotizacion_->nropersonas}}</td>
                                                                            <td>
                                                                                <b>
                                                                                    @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                                        {{$cotizaciones_cliente->cliente->nombres}} {{$cotizaciones_cliente->cliente->apellidos}}x{{$cotizacion_->nropersonas}} {{MisFunciones::fecha_peru($cotizacion_->fecha)}}
                                                                                    @endforeach
                                                                                </b>
                                                                            </td>
                                                                            <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                            <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                            <td class="text-right">
                                                                                <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                                    {{$itinerario_servicios->prioridad}}
                                                                                </b>
                                                                            </td>
                                                                            <td>
                                                                                <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        @endif
                                        <tr>
                                            <td colspan="7">
                                                <b>TOTAL</b>
                                            </td>
                                            <td class="text-right">
                                                <b>{{$total}}</b>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr><td colspan="9" class="bg-grey-goto text-white"><b>LIQUIDACION DE INGRESO A CATEDRAL</b></td></tr>
                                        @php
                                            $total=0;
                                        @endphp
                                        @if($opcion=='POR CODIGO'|| $opcion=='POR NOMBRE')
                                            @foreach($cotizacion_codigo_o_nombre->sortBy('fecha') as $cotizacion_)
                                                @foreach($cotizacion_->paquete_cotizaciones as $paquete_cotizaciones)
                                                    @foreach($paquete_cotizaciones->itinerario_cotizaciones->sortBy('fecha') as $itinerario_cotizaciones)
                                                        @foreach($itinerario_cotizaciones->itinerario_servicios->whereIn('liquidacion',array(1,2)) as $itinerario_servicios)
                                                            @if($itinerario_servicios->servicio->grupo=='ENTRANCES' && $itinerario_servicios->servicio->clase=='CAT')
                                                                @if($boton=='pagado')
                                                                    @if($itinerario_servicios->liquidacion_id==$id)
                                                                        @php
                                                                            $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                                        @endphp
                                                                        <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                            <td>
                                                                                <label class="text-primary">
                                                                                    <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}" @if($itinerario_servicios->liquidacion_id==$id){{'checked="checked"'}}@endif>
                                                                                    <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                                    <b>{{MisFunciones::fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                                </label>
                                                                            </td>
                                                                            <td>
                                                                                <b>{{MisFunciones::fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                            </td>
                                                                            <td>{{$itinerario_servicios->servicio->clase}}</td>
                                                                            <td>{{$itinerario_servicios->nombre}}</td>
                                                                            <td>{{$cotizacion_->nropersonas}}</td>
                                                                            <td>
                                                                                <b>
                                                                                    @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                                        {{$cotizaciones_cliente->cliente->nombres}} {{$cotizaciones_cliente->cliente->apellidos}}x{{$cotizacion_->nropersonas}} {{MisFunciones::fecha_peru($cotizacion_->fecha)}}
                                                                                    @endforeach
                                                                                </b>
                                                                            </td>
                                                                            <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                            <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                            <td class="text-right">
                                                                                <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                                    {{$itinerario_servicios->prioridad}}
                                                                                </b>
                                                                            </td>
                                                                            <td>
                                                                                <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                @elseif($boton=='guardado')
                                                                    @php
                                                                        $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                                    @endphp
                                                                    <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                        <td>
                                                                            <label class="text-primary">
                                                                                <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}" @if($itinerario_servicios->liquidacion_id==$id){{'checked="checked"'}}@endif>
                                                                                <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                                <b>{{MisFunciones::fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <b>{{MisFunciones::fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                        </td>
                                                                        <td>{{$itinerario_servicios->servicio->clase}}</td>
                                                                        <td>{{$itinerario_servicios->nombre}}</td>
                                                                        <td>{{$cotizacion_->nropersonas}}</td>
                                                                        <td>
                                                                            <b>
                                                                                @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                                    {{$cotizaciones_cliente->cliente->nombres}} {{$cotizaciones_cliente->cliente->apellidos}}x{{$cotizacion_->nropersonas}} {{MisFunciones::fecha_peru($cotizacion_->fecha)}}
                                                                                @endforeach
                                                                            </b>
                                                                        </td>
                                                                        <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                        <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                        <td class="text-right">
                                                                            <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                                {{$itinerario_servicios->prioridad}}
                                                                            </b>
                                                                        </td>
                                                                        <td>
                                                                            <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                                
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        @else
                                            @foreach($cotizacion->sortBy('fecha') as $cotizacion_)
                                                @foreach($cotizacion_->paquete_cotizaciones as $paquete_cotizaciones)
                                                    @foreach($paquete_cotizaciones->itinerario_cotizaciones->sortBy('fecha') as $itinerario_cotizaciones)
                                                        @foreach($itinerario_cotizaciones->itinerario_servicios->whereIn('liquidacion',array(1,2)) as $itinerario_servicios)
                                                            @if($itinerario_servicios->servicio->grupo=='ENTRANCES' && $itinerario_servicios->servicio->clase=='CAT')
                                                                @if($boton=='pagado')
                                                                    @if($itinerario_servicios->liquidacion_id==$id)
                                                                        @php
                                                                            $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                                        @endphp
                                                                        <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                            <td>
                                                                                <label class="text-primary">
                                                                                    <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}" @if($itinerario_servicios->liquidacion_id==$id){{'checked="checked"'}}@endif>
                                                                                    <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                                    <b>{{MisFunciones::fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                                </label>
                                                                            </td>
                                                                            <td>
                                                                                <b>{{MisFunciones::fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                            </td>
                                                                            <td>{{$itinerario_servicios->servicio->clase}}</td>
                                                                            <td>{{$itinerario_servicios->nombre}}</td>
                                                                            <td>{{$cotizacion_->nropersonas}}</td>
                                                                            <td>
                                                                                <b>
                                                                                    @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                                        {{$cotizaciones_cliente->cliente->nombres}} {{$cotizaciones_cliente->cliente->apellidos}}x{{$cotizacion_->nropersonas}} {{MisFunciones::fecha_peru($cotizacion_->fecha)}}
                                                                                    @endforeach
                                                                                </b>
                                                                            </td>
                                                                            <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                            <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                            <td class="text-right">
                                                                                <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                                    {{$itinerario_servicios->prioridad}}
                                                                                </b>
                                                                            </td>
                                                                            <td>
                                                                                <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                @elseif($boton=='guardado')
                                                                    @if ($itinerario_servicios->prioridad== $prioridad)  
                                                                        @php
                                                                            $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                                        @endphp
                                                                        <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                            <td>
                                                                                <label class="text-primary">
                                                                                    <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}" @if($itinerario_servicios->liquidacion_id==$id){{'checked="checked"'}}@endif>
                                                                                    <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                                    <b>{{MisFunciones::fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                                </label>
                                                                            </td>
                                                                            <td>
                                                                                <b>{{MisFunciones::fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                            </td>
                                                                            <td>{{$itinerario_servicios->servicio->clase}}</td>
                                                                            <td>{{$itinerario_servicios->nombre}}</td>
                                                                            <td>{{$cotizacion_->nropersonas}}</td>
                                                                            <td>
                                                                                <b>
                                                                                    @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                                        {{$cotizaciones_cliente->cliente->nombres}} {{$cotizaciones_cliente->cliente->apellidos}}x{{$cotizacion_->nropersonas}} {{MisFunciones::fecha_peru($cotizacion_->fecha)}}
                                                                                    @endforeach
                                                                                </b>
                                                                            </td>
                                                                            <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                            <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                            <td class="text-right">
                                                                                <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                                    {{$itinerario_servicios->prioridad}}
                                                                                </b>
                                                                            </td>
                                                                            <td>
                                                                                <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        @endif
                                        <tr>
                                            <td colspan="7">
                                                <b>TOTAL</b>
                                            </td>
                                            <td class="text-right">
                                                <b>{{$total}}</b>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr><td colspan="9" class="bg-grey-goto text-white"><b>LIQUIDACION DE INGRESO AL KORICANCHA</b></td></tr>
                                        @php
                                            $total=0;
                                        @endphp
                                        @if($opcion=='POR CODIGO'|| $opcion=='POR NOMBRE')
                                            @foreach($cotizacion_codigo_o_nombre->sortBy('fecha') as $cotizacion_)
                                                @foreach($cotizacion_->paquete_cotizaciones as $paquete_cotizaciones)
                                                    @foreach($paquete_cotizaciones->itinerario_cotizaciones->sortBy('fecha') as $itinerario_cotizaciones)
                                                        @foreach($itinerario_cotizaciones->itinerario_servicios->whereIn('liquidacion',array(1,2)) as $itinerario_servicios)
                                                            @if($itinerario_servicios->servicio->grupo=='ENTRANCES' && $itinerario_servicios->servicio->clase=='KORI')
                                                                @if($boton=='pagado')
                                                                    @if($itinerario_servicios->liquidacion_id==$id)
                                                                        @php
                                                                            $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                                        @endphp
                                                                        <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                            <td>
                                                                                <label class="text-primary">
                                                                                    <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}" @if($itinerario_servicios->liquidacion_id==$id){{'checked="checked"'}}@endif>
                                                                                    <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                                    <b>{{MisFunciones::fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                                </label>
                                                                            </td>
                                                                            <td>
                                                                                <b>{{MisFunciones::fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                            </td>
                                                                            <td>{{$itinerario_servicios->servicio->clase}}</td>
                                                                            <td>{{$itinerario_servicios->nombre}}</td>
                                                                            <td>{{$cotizacion_->nropersonas}}</td>
                                                                            <td>
                                                                                <b>
                                                                                    @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                                        {{$cotizaciones_cliente->cliente->nombres}} {{$cotizaciones_cliente->cliente->apellidos}}x{{$cotizacion_->nropersonas}} {{MisFunciones::fecha_peru($cotizacion_->fecha)}}
                                                                                    @endforeach
                                                                                </b>
                                                                            </td>
                                                                            <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                            <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                            <td class="text-right">
                                                                                <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                                    {{$itinerario_servicios->prioridad}}
                                                                                </b>
                                                                            </td>
                                                                            <td>
                                                                                <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                @elseif($boton=='guardado')
                                                                    @php
                                                                        $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                                    @endphp
                                                                    <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                        <td>
                                                                            <label class="text-primary">
                                                                                <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}" @if($itinerario_servicios->liquidacion_id==$id){{'checked="checked"'}}@endif>
                                                                                <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                                <b>{{MisFunciones::fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <b>{{MisFunciones::fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                        </td>
                                                                        <td>{{$itinerario_servicios->servicio->clase}}</td>
                                                                        <td>{{$itinerario_servicios->nombre}}</td>
                                                                        <td>{{$cotizacion_->nropersonas}}</td>
                                                                        <td>
                                                                            <b>
                                                                                @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                                    {{$cotizaciones_cliente->cliente->nombres}} {{$cotizaciones_cliente->cliente->apellidos}}x{{$cotizacion_->nropersonas}} {{MisFunciones::fecha_peru($cotizacion_->fecha)}}
                                                                                @endforeach
                                                                            </b>
                                                                        </td>
                                                                        <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                        <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                        <td class="text-right">
                                                                            <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                                {{$itinerario_servicios->prioridad}}
                                                                            </b>
                                                                        </td>
                                                                        <td>
                                                                            <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                @endif    
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        @else
                                            @foreach($cotizacion->sortBy('fecha') as $cotizacion_)
                                                @foreach($cotizacion_->paquete_cotizaciones as $paquete_cotizaciones)
                                                    @foreach($paquete_cotizaciones->itinerario_cotizaciones->sortBy('fecha') as $itinerario_cotizaciones)
                                                        @foreach($itinerario_cotizaciones->itinerario_servicios->whereIn('liquidacion',array(1,2)) as $itinerario_servicios)
                                                            @if($itinerario_servicios->servicio->grupo=='ENTRANCES' && $itinerario_servicios->servicio->clase=='KORI')
                                                                @if($boton=='pagado')
                                                                    @if($itinerario_servicios->liquidacion_id==$id)
                                                                        @php
                                                                            $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                                        @endphp
                                                                        <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                            <td>
                                                                                <label class="text-primary">
                                                                                    <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}" @if($itinerario_servicios->liquidacion_id==$id){{'checked="checked"'}}@endif>
                                                                                    <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                                    <b>{{MisFunciones::fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                                </label>
                                                                            </td>
                                                                            <td>
                                                                                <b>{{MisFunciones::fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                            </td>
                                                                            <td>{{$itinerario_servicios->servicio->clase}}</td>
                                                                            <td>{{$itinerario_servicios->nombre}}</td>
                                                                            <td>{{$cotizacion_->nropersonas}}</td>
                                                                            <td>
                                                                                <b>
                                                                                    @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                                        {{$cotizaciones_cliente->cliente->nombres}} {{$cotizaciones_cliente->cliente->apellidos}}x{{$cotizacion_->nropersonas}} {{MisFunciones::fecha_peru($cotizacion_->fecha)}}
                                                                                    @endforeach
                                                                                </b>
                                                                            </td>
                                                                            <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                            <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                            <td class="text-right">
                                                                                <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                                    {{$itinerario_servicios->prioridad}}
                                                                                </b>
                                                                            </td>
                                                                            <td>
                                                                                <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                @elseif($boton=='guardado')
                                                                    @if ($itinerario_servicios->prioridad== $prioridad)
                                                                        @php
                                                                            $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                                        @endphp
                                                                        <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                            <td>
                                                                                <label class="text-primary">
                                                                                    <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}" @if($itinerario_servicios->liquidacion_id==$id){{'checked="checked"'}}@endif>
                                                                                    <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                                    <b>{{MisFunciones::fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                                </label>
                                                                            </td>
                                                                            <td>
                                                                                <b>{{MisFunciones::fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                            </td>
                                                                            <td>{{$itinerario_servicios->servicio->clase}}</td>
                                                                            <td>{{$itinerario_servicios->nombre}}</td>
                                                                            <td>{{$cotizacion_->nropersonas}}</td>
                                                                            <td>
                                                                                <b>
                                                                                    @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                                        {{$cotizaciones_cliente->cliente->nombres}} {{$cotizaciones_cliente->cliente->apellidos}}x{{$cotizacion_->nropersonas}} {{MisFunciones::fecha_peru($cotizacion_->fecha)}}
                                                                                    @endforeach
                                                                                </b>
                                                                            </td>
                                                                            <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                            <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                            <td class="text-right">
                                                                                <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                                    {{$itinerario_servicios->prioridad}}
                                                                                </b>
                                                                            </td>
                                                                            <td>
                                                                                <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        @endif
                                        <tr>
                                            <td colspan="7">
                                                <b>TOTAL</b>
                                            </td>
                                            <td class="text-right">
                                                <b>{{$total}}</b>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr><td colspan="9" class="bg-grey-goto text-white"><b>LIQUIDACION DE INGRESO A MACHUPICCHU</b></td></tr>
                                        @php
                                            $total=0;
                                        @endphp
                                        @if($opcion=='POR CODIGO'|| $opcion=='POR NOMBRE')
                                            @foreach($cotizacion_codigo_o_nombre->sortBy('fecha') as $cotizacion_)
                                                @foreach($cotizacion_->paquete_cotizaciones as $paquete_cotizaciones)
                                                    @foreach($paquete_cotizaciones->itinerario_cotizaciones->sortBy('fecha') as $itinerario_cotizaciones)
                                                        @foreach($itinerario_cotizaciones->itinerario_servicios->whereIn('liquidacion',array(1,2)) as $itinerario_servicios)
                                                            @if($itinerario_servicios->servicio->grupo=='ENTRANCES' && $itinerario_servicios->servicio->clase=='MAPI')
                                                                @if($boton=='pagado')
                                                                    @if($itinerario_servicios->liquidacion_id==$id)
                                                                        @php
                                                                            $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                                        @endphp
                                                                        <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                            <td>
                                                                                <label class="text-primary">
                                                                                    <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}" @if($itinerario_servicios->liquidacion_id==$id){{'checked="checked"'}}@endif>
                                                                                    <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                                    <b>{{MisFunciones::fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                                </label>
                                                                            </td>
                                                                            <td>
                                                                                <b>{{MisFunciones::fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                            </td>
                                                                            <td>{{$itinerario_servicios->servicio->clase}}</td>
                                                                            <td>{{$itinerario_servicios->nombre}}</td>
                                                                            <td>{{$cotizacion_->nropersonas}}</td>
                                                                            <td>
                                                                                <b>
                                                                                    @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                                        {{$cotizaciones_cliente->cliente->nombres}} {{$cotizaciones_cliente->cliente->apellidos}}x{{$cotizacion_->nropersonas}} {{MisFunciones::fecha_peru($cotizacion_->fecha)}}
                                                                                    @endforeach
                                                                                </b>
                                                                            </td>
                                                                            <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                            <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                            <td class="text-right">
                                                                                <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                                    {{$itinerario_servicios->prioridad}}
                                                                                </b>
                                                                            </td>
                                                                            <td>
                                                                                <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                @elseif($boton=='guardado')
                                                                    @php
                                                                        $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                                    @endphp
                                                                    <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                        <td>
                                                                            <label class="text-primary">
                                                                                <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}" @if($itinerario_servicios->liquidacion_id==$id){{'checked="checked"'}}@endif>
                                                                                <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                                <b>{{MisFunciones::fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <b>{{MisFunciones::fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                        </td>
                                                                        <td>{{$itinerario_servicios->servicio->clase}}</td>
                                                                        <td>{{$itinerario_servicios->nombre}}</td>
                                                                        <td>{{$cotizacion_->nropersonas}}</td>
                                                                        <td>
                                                                            <b>
                                                                                @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                                    {{$cotizaciones_cliente->cliente->nombres}} {{$cotizaciones_cliente->cliente->apellidos}}x{{$cotizacion_->nropersonas}} {{MisFunciones::fecha_peru($cotizacion_->fecha)}}
                                                                                @endforeach
                                                                            </b>
                                                                        </td>
                                                                        <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                        <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                        <td class="text-right">
                                                                            <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                                {{$itinerario_servicios->prioridad}}
                                                                            </b>
                                                                        </td>
                                                                        <td>
                                                                            <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                                
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        @else
                                            @foreach($cotizacion->sortBy('fecha') as $cotizacion_)
                                                @foreach($cotizacion_->paquete_cotizaciones as $paquete_cotizaciones)
                                                    @foreach($paquete_cotizaciones->itinerario_cotizaciones->sortBy('fecha') as $itinerario_cotizaciones)
                                                        @foreach($itinerario_cotizaciones->itinerario_servicios->whereIn('liquidacion',array(1,2)) as $itinerario_servicios)
                                                            @if($itinerario_servicios->servicio->grupo=='ENTRANCES' && $itinerario_servicios->servicio->clase=='MAPI')
                                                                @if($boton=='pagado')
                                                                    @if($itinerario_servicios->liquidacion_id==$id)
                                                                        @php
                                                                            $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                                        @endphp
                                                                        <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                            <td>
                                                                                <label class="text-primary">
                                                                                    <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}" @if($itinerario_servicios->liquidacion_id==$id){{'checked="checked"'}}@endif>
                                                                                    <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                                    <b>{{MisFunciones::fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                                </label>
                                                                            </td>
                                                                            <td>
                                                                                <b>{{MisFunciones::fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                            </td>
                                                                            <td>{{$itinerario_servicios->servicio->clase}}</td>
                                                                            <td>{{$itinerario_servicios->nombre}}</td>
                                                                            <td>{{$cotizacion_->nropersonas}}</td>
                                                                            <td>
                                                                                <b>
                                                                                    @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                                        {{$cotizaciones_cliente->cliente->nombres}} {{$cotizaciones_cliente->cliente->apellidos}}x{{$cotizacion_->nropersonas}} {{MisFunciones::fecha_peru($cotizacion_->fecha)}}
                                                                                    @endforeach
                                                                                </b>
                                                                            </td>
                                                                            <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                            <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                            <td class="text-right">
                                                                                <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                                    {{$itinerario_servicios->prioridad}}
                                                                                </b>
                                                                            </td>
                                                                            <td>
                                                                                <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                @elseif($boton=='guardado')
                                                                    @if ($itinerario_servicios->prioridad== $prioridad)
                                                                        @php
                                                                            $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                                        @endphp
                                                                        <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                            <td>
                                                                                <label class="text-primary">
                                                                                    <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}" @if($itinerario_servicios->liquidacion_id==$id){{'checked="checked"'}}@endif>
                                                                                    <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                                    <b>{{MisFunciones::fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                                </label>
                                                                            </td>
                                                                            <td>
                                                                                <b>{{MisFunciones::fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                            </td>
                                                                            <td>{{$itinerario_servicios->servicio->clase}}</td>
                                                                            <td>{{$itinerario_servicios->nombre}}</td>
                                                                            <td>{{$cotizacion_->nropersonas}}</td>
                                                                            <td>
                                                                                <b>
                                                                                    @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                                        {{$cotizaciones_cliente->cliente->nombres}} {{$cotizaciones_cliente->cliente->apellidos}}x{{$cotizacion_->nropersonas}} {{MisFunciones::fecha_peru($cotizacion_->fecha)}}
                                                                                    @endforeach
                                                                                </b>
                                                                            </td>
                                                                            <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                            <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                            <td class="text-right">
                                                                                <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                                    {{$itinerario_servicios->prioridad}}
                                                                                </b>
                                                                            </td>
                                                                            <td>
                                                                                <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        @endif
                                        <tr>
                                            <td colspan="7">
                                                <b>TOTAL</b>
                                            </td>
                                            <td class="text-right">
                                                <b>{{$total}}</b>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr><td colspan="9" class="bg-grey-goto text-white"><b>ENTRADAS OTROS</b></td></tr>
                                        @php
                                            $total=0;
                                        @endphp
                                        @if($opcion=='POR CODIGO'|| $opcion=='POR NOMBRE')
                                            @foreach($cotizacion_codigo_o_nombre->sortBy('fecha') as $cotizacion_)
                                                @foreach($cotizacion_->paquete_cotizaciones as $paquete_cotizaciones)
                                                    @foreach($paquete_cotizaciones->itinerario_cotizaciones->sortBy('fecha') as $itinerario_cotizaciones)
                                                        @foreach($itinerario_cotizaciones->itinerario_servicios->whereIn('liquidacion',array(1,2)) as $itinerario_servicios)
                                                            @if($itinerario_servicios->servicio->grupo=='ENTRANCES' && $itinerario_servicios->servicio->clase=='OTROS')
                                                                @if($boton=='pagado')
                                                                    @if($itinerario_servicios->liquidacion_id==$id)
                                                                        @php
                                                                            $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                                        @endphp
                                                                        <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                            <td>
                                                                                <label class="text-primary">
                                                                                    <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}" @if($itinerario_servicios->liquidacion_id==$id){{'checked="checked"'}}@endif>
                                                                                    <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                                    <b>{{MisFunciones::fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                                </label>
                                                                            </td>
                                                                            <td>
                                                                                <b>{{MisFunciones::fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                            </td>
                                                                            <td>{{$itinerario_servicios->servicio->clase}}</td>
                                                                            <td>{{$itinerario_servicios->nombre}}</td>
                                                                            <td>{{$cotizacion_->nropersonas}}</td>
                                                                            <td>
                                                                                <b>
                                                                                    @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                                        {{$cotizaciones_cliente->cliente->nombres}} {{$cotizaciones_cliente->cliente->apellidos}}x{{$cotizacion_->nropersonas}} {{MisFunciones::fecha_peru($cotizacion_->fecha)}}
                                                                                    @endforeach
                                                                                </b>
                                                                            </td>
                                                                            <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                            <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                            <td class="text-right">
                                                                                <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                                    {{$itinerario_servicios->prioridad}}
                                                                                </b>
                                                                            </td>
                                                                            <td>
                                                                                <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                            </td>
                                                                        </tr>
                                                                    @endif  
                                                                @elseif($boton=='guardado')
                                                                    @php
                                                                        $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                                    @endphp
                                                                    <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                        <td>
                                                                            <label class="text-primary">
                                                                                <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}" @if($itinerario_servicios->liquidacion_id==$id){{'checked="checked"'}}@endif>
                                                                                <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                                <b>{{MisFunciones::fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <b>{{MisFunciones::fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                        </td>
                                                                        <td>{{$itinerario_servicios->servicio->clase}}</td>
                                                                        <td>{{$itinerario_servicios->nombre}}</td>
                                                                        <td>{{$cotizacion_->nropersonas}}</td>
                                                                        <td>
                                                                            <b>
                                                                                @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                                    {{$cotizaciones_cliente->cliente->nombres}} {{$cotizaciones_cliente->cliente->apellidos}}x{{$cotizacion_->nropersonas}} {{MisFunciones::fecha_peru($cotizacion_->fecha)}}
                                                                                @endforeach
                                                                            </b>
                                                                        </td>
                                                                        <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                        <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                        <td class="text-right">
                                                                            <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                                {{$itinerario_servicios->prioridad}}
                                                                            </b>
                                                                        </td>
                                                                        <td>
                                                                            <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                @endif                                                                
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        @else    
                                            @foreach($cotizacion->sortBy('fecha') as $cotizacion_)
                                                @foreach($cotizacion_->paquete_cotizaciones as $paquete_cotizaciones)
                                                    @foreach($paquete_cotizaciones->itinerario_cotizaciones->sortBy('fecha') as $itinerario_cotizaciones)
                                                        @foreach($itinerario_cotizaciones->itinerario_servicios->whereIn('liquidacion',array(1,2)) as $itinerario_servicios)
                                                            @if($itinerario_servicios->servicio->grupo=='ENTRANCES' && $itinerario_servicios->servicio->clase=='OTROS')
                                                                @if($boton=='pagado')
                                                                    @if($itinerario_servicios->liquidacion_id==$id)
                                                                        @php
                                                                            $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                                        @endphp
                                                                        <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                            <td>
                                                                                <label class="text-primary">
                                                                                    <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}" @if($itinerario_servicios->liquidacion_id==$id){{'checked="checked"'}}@endif>
                                                                                    <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                                    <b>{{MisFunciones::fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                                </label>
                                                                            </td>
                                                                            <td>
                                                                                <b>{{MisFunciones::fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                            </td>
                                                                            <td>{{$itinerario_servicios->servicio->clase}}</td>
                                                                            <td>{{$itinerario_servicios->nombre}}</td>
                                                                            <td>{{$cotizacion_->nropersonas}}</td>
                                                                            <td>
                                                                                <b>
                                                                                    @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                                        {{$cotizaciones_cliente->cliente->nombres}} {{$cotizaciones_cliente->cliente->apellidos}}x{{$cotizacion_->nropersonas}} {{MisFunciones::fecha_peru($cotizacion_->fecha)}}
                                                                                    @endforeach
                                                                                </b>
                                                                            </td>
                                                                            <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                            <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                            <td class="text-right">
                                                                                <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                                    {{$itinerario_servicios->prioridad}}
                                                                                </b>
                                                                            </td>
                                                                            <td>
                                                                                <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                @elseif($boton=='guardado')
                                                                    @if ($itinerario_servicios->prioridad== $prioridad)
                                                                        @php
                                                                            $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                                        @endphp
                                                                        <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                            <td>
                                                                                <label class="text-primary">
                                                                                    <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}" @if($itinerario_servicios->liquidacion_id==$id){{'checked="checked"'}}@endif>
                                                                                    <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                                    <b>{{MisFunciones::fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                                </label>
                                                                            </td>
                                                                            <td>
                                                                                <b>{{MisFunciones::fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                            </td>
                                                                            <td>{{$itinerario_servicios->servicio->clase}}</td>
                                                                            <td>{{$itinerario_servicios->nombre}}</td>
                                                                            <td>{{$cotizacion_->nropersonas}}</td>
                                                                            <td>
                                                                                <b>
                                                                                    @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                                        {{$cotizaciones_cliente->cliente->nombres}} {{$cotizaciones_cliente->cliente->apellidos}}x{{$cotizacion_->nropersonas}} {{MisFunciones::fecha_peru($cotizacion_->fecha)}}
                                                                                    @endforeach
                                                                                </b>
                                                                            </td>
                                                                            <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                            <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                            <td class="text-right">
                                                                                <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                                    {{$itinerario_servicios->prioridad}}
                                                                                </b>
                                                                            </td>
                                                                            <td>
                                                                                <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        @endif
                                        <tr>
                                            <td colspan="7">
                                                <b>TOTAL</b>
                                            </td>
                                            <td class="text-right">
                                                <b>{{$total}}</b>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr><td colspan="9" class="bg-grey-goto text-white"><b>ENTRADAS BUSES</b></td></tr>
                                        @php
                                            $total=0;
                                        @endphp
                                        @if($opcion=='POR CODIGO'|| $opcion=='POR NOMBRE')
                                            @foreach($cotizacion_codigo_o_nombre->sortBy('fecha') as $cotizacion_)
                                                @foreach($cotizacion_->paquete_cotizaciones as $paquete_cotizaciones)
                                                    @foreach($paquete_cotizaciones->itinerario_cotizaciones->sortBy('fecha') as $itinerario_cotizaciones)
                                                        @foreach($itinerario_cotizaciones->itinerario_servicios->whereIn('liquidacion',array(1,2)) as $itinerario_servicios)
                                                            @if($itinerario_servicios->servicio->grupo=='MOVILID' && $itinerario_servicios->servicio->clase=='BOLETO')
                                                                @if($boton=='pagado')
                                                                    @if($itinerario_servicios->liquidacion_id==$id)
                                                                        @php
                                                                            $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                                        @endphp
                                                                        <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                            <td>
                                                                                <label class="text-primary">
                                                                                    <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}" @if($itinerario_servicios->liquidacion_id==$id){{'checked="checked"'}}@endif>
                                                                                    <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                                    <b>{{MisFunciones::fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                                </label>
                                                                            </td>
                                                                            <td>
                                                                                <b>{{MisFunciones::fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                            </td>
                                                                            <td>{{$itinerario_servicios->servicio->clase}}</td>
                                                                            <td>{{$itinerario_servicios->nombre}}</td>
                                                                            <td>{{$cotizacion_->nropersonas}}</td>
                                                                            <td>
                                                                                <b>
                                                                                    @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                                        {{$cotizaciones_cliente->cliente->nombres}} {{$cotizaciones_cliente->cliente->apellidos}}x{{$cotizacion_->nropersonas}} {{MisFunciones::fecha_peru($cotizacion_->fecha)}}
                                                                                    @endforeach
                                                                                </b>
                                                                            </td>
                                                                            <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                            <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                            <td class="text-right">
                                                                                <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                                    {{$itinerario_servicios->prioridad}}
                                                                                </b>
                                                                            </td>
                                                                            <td>
                                                                                <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                @elseif($boton=='guardado')
                                                                    {{--  @if ($itinerario_servicios->prioridad== $prioridad)  --}}
                                                                        @php
                                                                            $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                                        @endphp
                                                                        <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                            <td>
                                                                                <label class="text-primary">
                                                                                    <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}" @if($itinerario_servicios->liquidacion_id==$id){{'checked="checked"'}}@endif>
                                                                                    <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                                    <b>{{MisFunciones::fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                                </label>
                                                                            </td>
                                                                            <td>
                                                                                <b>{{MisFunciones::fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                            </td>
                                                                            <td>{{$itinerario_servicios->servicio->clase}}</td>
                                                                            <td>{{$itinerario_servicios->nombre}}</td>
                                                                            <td>{{$cotizacion_->nropersonas}}</td>
                                                                            <td>
                                                                                <b>
                                                                                    @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                                        {{$cotizaciones_cliente->cliente->nombres}} {{$cotizaciones_cliente->cliente->apellidos}}x{{$cotizacion_->nropersonas}} {{MisFunciones::fecha_peru($cotizacion_->fecha)}}
                                                                                    @endforeach
                                                                                </b>
                                                                            </td>
                                                                            <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                            <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                            <td class="text-right">
                                                                                <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                                    {{$itinerario_servicios->prioridad}}
                                                                                </b>
                                                                            </td>
                                                                            <td>
                                                                                <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                            </td>
                                                                        </tr>
                                                                    {{--  @endif  --}}
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        @else
                                            @foreach($cotizacion->sortBy('fecha') as $cotizacion_)
                                                @foreach($cotizacion_->paquete_cotizaciones as $paquete_cotizaciones)
                                                    @foreach($paquete_cotizaciones->itinerario_cotizaciones->sortBy('fecha') as $itinerario_cotizaciones)
                                                        @foreach($itinerario_cotizaciones->itinerario_servicios->whereIn('liquidacion',array(1,2)) as $itinerario_servicios)
                                                            @if($itinerario_servicios->servicio->grupo=='MOVILID' && $itinerario_servicios->servicio->clase=='BOLETO')
                                                                @if($boton=='pagado')
                                                                    @if($itinerario_servicios->liquidacion_id==$id)
                                                                        @php
                                                                            $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                                        @endphp
                                                                        <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                            <td>
                                                                                <label class="text-primary">
                                                                                    <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}" @if($itinerario_servicios->liquidacion_id==$id){{'checked="checked"'}}@endif>
                                                                                    <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                                    <b>{{MisFunciones::fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                                </label>
                                                                            </td>
                                                                            <td>
                                                                                <b>{{MisFunciones::fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                            </td>
                                                                            <td>{{$itinerario_servicios->servicio->clase}}</td>
                                                                            <td>{{$itinerario_servicios->nombre}}</td>
                                                                            <td>{{$cotizacion_->nropersonas}}</td>
                                                                            <td>
                                                                                <b>
                                                                                    @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                                        {{$cotizaciones_cliente->cliente->nombres}} {{$cotizaciones_cliente->cliente->apellidos}}x{{$cotizacion_->nropersonas}} {{MisFunciones::fecha_peru($cotizacion_->fecha)}}
                                                                                    @endforeach
                                                                                </b>
                                                                            </td>
                                                                            <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                            <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                            <td class="text-right">
                                                                                <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                                    {{$itinerario_servicios->prioridad}}
                                                                                </b>
                                                                            </td>
                                                                            <td>
                                                                                <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                @elseif($boton=='guardado')
                                                                    @if ($itinerario_servicios->prioridad== $prioridad)
                                                                        @php
                                                                            $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                                        @endphp
                                                                        <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                            <td>
                                                                                <label class="text-primary">
                                                                                    <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}" @if($itinerario_servicios->liquidacion_id==$id){{'checked="checked"'}}@endif>
                                                                                    <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                                    <b>{{MisFunciones::fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                                </label>
                                                                            </td>
                                                                            <td>
                                                                                <b>{{MisFunciones::fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                            </td>
                                                                            <td>{{$itinerario_servicios->servicio->clase}}</td>
                                                                            <td>{{$itinerario_servicios->nombre}}</td>
                                                                            <td>{{$cotizacion_->nropersonas}}</td>
                                                                            <td>
                                                                                <b>
                                                                                    @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                                        {{$cotizaciones_cliente->cliente->nombres}} {{$cotizaciones_cliente->cliente->apellidos}}x{{$cotizacion_->nropersonas}} {{MisFunciones::fecha_peru($cotizacion_->fecha)}}
                                                                                    @endforeach
                                                                                </b>
                                                                            </td>
                                                                            <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                            <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                            <td class="text-right">
                                                                                <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                                    {{$itinerario_servicios->prioridad}}
                                                                                </b>
                                                                            </td>
                                                                            <td>
                                                                                <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        @endif
                                        <tr>
                                            <td colspan="7">
                                                <b>TOTAL</b>
                                            </td>
                                            <td class="text-right">
                                                <b>{{$total}}</b>
                                            </td>
                                            <td></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-2 fixed">
                            <form id="form_guardar" action="{{route('pagar_entradas_path')}}" method="post">
                                <div class="form-group">
                                    <label for="total_entrances" class="text-secondary font-weight-bold pr-2">TOTAL </label>
                                    <input type="text" class="form-control" id="total_entrances" name="total_entrances" value="{{$liquidacion->total}}">
                                </div>
                                <div class="form-group">
                                    <label for="nro_operacion">Nro de operacion</label>
                                    <input type="text" class="form-control" id="nro_operacion" name="nro_operacion" aria-describedby="Nro operacion" placeholder="Nro operacion" value="{{$liquidacion->nro_operacion}}">
                                </div>
                                <input type="hidden" name="ini" value="{{$ini}}">
                                <input type="hidden" name="fin" value="{{$fin}}">
                                <input type="hidden" name="id" value="{{$liquidacion->id}}">

                                {{csrf_field()}}
                                @if($boton=='guardado')
                                    <button type="submit" name="guardar" class="form-control btn btn-success btn-block" value="Guardar"><i class="fas fa-save"></i> Guardar para despues</button>
                                @endif
                                <button type="submit" name="pagar" class="form-control btn btn-primary btn-block" value="Pagar"><i class="fas fa-coins"></i> Pagar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {

            $(document).on('click keyup','.mis-checkboxes',function() {
                calcular();
            });

        });

        function calcular() {
            var tot = $('#total_entrances');
            var itinerario_servicio_id='';
            tot.val(0);
            $('.mis-checkboxes').each(function() {
                if($(this).hasClass('mis-checkboxes')) {
                    itinerario_servicio_id='#precio_'+$(this).attr('value');
                    // console.log('lectura del valor de '+$(this).attr('value')+' :'+$(itinerario_servicio_id).val());
                    tot.val(($(this).is(':checked') ? parseFloat($(itinerario_servicio_id).val()) : 0) + parseFloat(tot.val()));
                }
                else {
                    tot.val(parseFloat(tot.val()) + (isNaN(parseFloat($(this).val())) ? 0 : parseFloat($(this).val())));
                }
            });
            var totalParts = parseFloat(tot.val()).toFixed(2).split('.');
            tot.val(totalParts[0].replace(/\B(?=(\d{3})+(?!\d))/g, "") + '.' +  (totalParts.length > 1 ? totalParts[1] : '00'));
        }

    </script>
@stop