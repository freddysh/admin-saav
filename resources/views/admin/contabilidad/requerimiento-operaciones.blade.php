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
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <p>
                                <b class="text-success">{{$requerimiento->codigo}}</b><b class="text-danger">|</b>
                                {{$requerimiento->modo_busqueda}}:
                                <b class="">
                                    @if($requerimiento->modo_busqueda=='ENTRE DOS FECHAS'||$requerimiento->modo_busqueda=='ENTRE DOS FECHAS URGENTES')
                                        @isset($requerimiento->fecha_ini)
                                            <i class="fas fa-calendar text-primary"></i> {{MisFunciones::fecha_peru($requerimiento->fecha_ini)}}      
                                        @endisset
                                        - 
                                        @isset($requerimiento->fecha_fin)
                                            <i class="fas fa-calendar text-primary"></i> {{MisFunciones::fecha_peru($requerimiento->fecha_fin)}}      
                                        @endisset
                                    @endif
                                </b>
                                <b class="text-danger">|</b>Creado:
                                <b>{{MisFunciones::fecha_peru_hora($requerimiento->created_at)}}</b>
                                <b class="text-danger">|</b>Por:
                                @if(isset($requerimiento->solicitante_id))
                                    <b>{{$usuarios->where('id',$requerimiento->solicitante_id)->first()->name}}</b>
                                @endif
                            </p>
                        </div>
                        <div class="col-9">
                            <table class="table table-condensed table-bordered table-hover table-sm text-11">
                                <thead>
                                    <tr>
                                        <th class="text-grey-goto text-center">Cotización</th>
                                        <th class="text-grey-goto text-center">Nro</th>
                                        <th class="text-grey-goto text-center"style="width:150px">Servicio</th>
                                        <th class="text-grey-goto text-center">Proveedor</th>
                                        <th class="text-grey-goto text-center" style="width:100px">Fecha de Servicio</th>
                                        <th class="text-grey-goto text-center" style="width:100px">Fecha a Pagar</th>
                                        <th class="text-grey-goto text-center">Total Venta</th>
                                        <th class="text-grey-goto text-center">Total Reserva</th>
                                        <th class="text-grey-goto text-center">Total Conta</th>
                                        <th class="text-grey-goto text-center">Estado</th>
                                        <th class="text-grey-goto text-center" colspan="2">Operaciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th colspan="12" class="bg-dark text-white">HOTEL</th>
                                    </tr>
                                    @php
                                        $total=0;
                                        $total_aprovado=0;
                                    @endphp
                                    @foreach($array_pagos_pendientes as $key => $array_pagos_pendiente)
                                        @if($array_pagos_pendiente['estado_contabilidad']=='3'|| $array_pagos_pendiente['estado_contabilidad']=='5')
                                            @php
                                                $total_aprovado+=$array_pagos_pendiente['monto_c'];
                                            @endphp
                                        @endif
                                        @php
                                            $total+=$array_pagos_pendiente['monto_c'];
                                        @endphp
                                        <tr id="fila_{{$key}}">
                                            <td class="text-grey-goto text-left">
                                                <div class="form-check">
                                                <input class="form-check-input d-none" type="hidden" form="enviar_requerimiento" value="{{$array_pagos_pendiente['items']}}" name="chb_h_pagos[]" id="chb_{{$key}}" onclick="if(this.checked) sumar($('#monto_c_{{$key}}').html()); else restar($('#monto_c_{{$key}}').html());" @if($array_pagos_pendiente['monto_r']>0 && $array_pagos_pendiente['monto_c']<=0) disabled @endif>
                                                    <label class="form-check-label" for="chb_{{$key}}">
                                                        <b class="text-success">{{$array_pagos_pendiente['codigo']}}</b> | <b>{{$array_pagos_pendiente['pax']}}</b><br>
                                                    @if($array_pagos_pendiente['monto_r']>0 && $array_pagos_pendiente['monto_c']<=0) <span id="warning_{{$array_pagos_pendiente['grupo']}}_{{$key}}" class="text-10 text-danger">Ingresar montos a pagar</span> @endif
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="text-grey-goto text-center">{{$array_pagos_pendiente['nro']}}<b><i class="fas fa-user text-primary"></i></b></td>
                                            <td id="titulo_{{$key}}" class="text-grey-goto text-left">{!!$array_pagos_pendiente['titulo']!!}</td>
                                            <td class="text-grey-goto text-left">{{$array_pagos_pendiente['proveedor']}}</td>
                                            <td class="text-grey-goto text-center"><i class="fas fa-calendar"></i> {{fecha_peru($array_pagos_pendiente['fecha_servicio'])}}</td>
                                            <td class="text-grey-goto text-center"><i class="fas fa-calendar"></i> {{fecha_peru($array_pagos_pendiente['fecha_pago'])}}</td>
                                            <td class="text-grey-goto text-right"><b><sup>$</sup> {{$array_pagos_pendiente['monto_v']}}</b></td>
                                            <td class="text-grey-goto text-right"><b><sup>$</sup> {{$array_pagos_pendiente['monto_r']}}</b></td>
                                        <td class="text-grey-goto text-right"><b><sup>$</sup> <span id="monto_{{$array_pagos_pendiente['grupo']}}_c_{{$key}}">{{$array_pagos_pendiente['monto_c']}}</span></b></td>
                                        <td class="text-grey-goto text-right" id="estado_view_{{$key}}">
                                            @if($array_pagos_pendiente['estado_contabilidad']=='2') 
                                            <b class="badge badge-dark">
                                                Pendiente
                                            </b>
                                            @elseif($array_pagos_pendiente['estado_contabilidad']=='3') 
                                                <b class="badge badge-primary">
                                                    Aprovado
                                                </b>
                                            @elseif($array_pagos_pendiente['estado_contabilidad']=='4') 
                                                <b class="badge badge-danger">
                                                    Observado
                                                </b>
                                            @elseif($array_pagos_pendiente['estado_contabilidad']=='5') 
                                                <b class="badge badge-success">
                                                    Pagado
                                                </b>
                                            @endif
                                        </td>
                                        <td class="text-grey-goto">
                                            @if($array_pagos_pendiente['estado_contabilidad']=='3'||$array_pagos_pendiente['estado_contabilidad']=='5')
                                                <input type="hidden" name="lista_pagar[]" form="form_" value="{{$array_pagos_pendiente['items']}}">
                                            @endif
                                            <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_{{$key}}" onclick="traer_datos_detalle('{{$key}}','{{$array_pagos_pendiente['grupo']}}','{{$array_pagos_pendiente['clase']}}','{{$array_pagos_pendiente['items_itinerario']}}','{{$array_pagos_pendiente['nro']}}','{{$operacion}}','{{$array_pagos_pendiente['estado_contabilidad']}}')">
                                                        <i class="fas fa-eye"></i>
                                            </button>    
                                                <!-- Modal -->
                                            <div class="modal fade" id="modal_{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">  
                                                    <div class="modal-content  modal-lg">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterTitle">Detalle Costos</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="form_{{$array_pagos_pendiente['grupo']}}_{{$key}}" action="{{route('contabilidad.hotel.store.revisor')}}" method="POST" > 
                                                                <div class="row">
                                                                    <input type="hidden" name="items" value="{{$array_pagos_pendiente['items']}}">
                                                                    <div id="{{$array_pagos_pendiente['grupo']}}_{{$array_pagos_pendiente['clase']}}_datos_{{$key}}" class="col">

                                                                    </div>
                                                                </div>  
                                                            </form>   
                                                        </div>
                                                        <div class="modal-footer d-none">
                                                            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary d-none">Save changes</button>
                                                        </div>
                                                    </div>                                                                 
                                                </div>
                                            </div>    
                                        </td>
                                        <td>
                                            @php
                                            $valor=2;
                                            @endphp
                                            @if($array_pagos_pendiente['estado_contabilidad']=='4'||$array_pagos_pendiente['estado_contabilidad']=='2')
                                                @php
                                                    $valor=4;
                                                @endphp
                                            @elseif($array_pagos_pendiente['estado_contabilidad']=='3')
                                                @php
                                                    $valor=3;
                                                @endphp
                                            @elseif($array_pagos_pendiente['estado_contabilidad']=='5')
                                                @php
                                                    $valor=5;
                                                @endphp
                                            @endif   
                                            
                                            <input type="hidden" id="hestado_contabilidad_{{$key}}" value="{{$valor}}">

                                            @if($operacion=='pagar'||$operacion=='aprobar')
                                        <a class="text-12 @if($operacion=='pagar') d-none @endif" id="estado_contabilidad_{{$key}}" href="#!" onclick="estado_contabilidad('{{$key}}','{{$array_pagos_pendiente['proveedor']}}','{{$array_pagos_pendiente['items']}}','HOTELS')">
                                                @if($array_pagos_pendiente['estado_contabilidad']=='3')
                                                    <i class="fas fa-toggle-on fa-3x text-primary"></i>
                                                @elseif($array_pagos_pendiente['estado_contabilidad']=='5')
                                                    <i class="fas fa-toggle-off fa-3x text-success"></i>
                                                @elseif($array_pagos_pendiente['estado_contabilidad']=='4')
                                                    <i class="fas fa-toggle-off fa-3x text-danger"></i>
                                                @elseif($array_pagos_pendiente['estado_contabilidad']=='2')
                                                    <i class="fas fa-toggle-off fa-3x text-grey-goto"></i>
                                                @endif
                                            </a>
                                            @endif
                                            @if($operacion=='pagar')
                                                @if($array_pagos_pendiente['estado_contabilidad']=='3')
                                                    <a id="btn_pagar_{{$key}}" href="#!" class="btn btn-sm btn-primary" onclick="pagar_proveedor('{{$key}}','{{$array_pagos_pendiente['proveedor']}}','{{$array_pagos_pendiente['items']}}','HOTELS')">Pagar</a>
                                                    {{-- <i class="fas fa-toggle-on fa-3x text-success"></i> --}}
                                                @elseif($array_pagos_pendiente['estado_contabilidad']=='4'||$array_pagos_pendiente['estado_contabilidad']=='2')
                                                    {{-- <a id="btn_pagar_{{$key}}" href="#!" class="btn btn-sm btn-danger" onclick="pagar_proveedor_borrar('{{$array_pagos_pendiente['items']}}','{{$key}}')">Borrar</a> --}}
                                                    <a id="btn_pagar_{{$key}}" href="#!" class="btn btn-sm btn-danger" onclick="borrar_items_pago_uno('{{$key}}','{{$array_pagos_pendiente['grupo']}}','{{$array_pagos_pendiente['items']}}','{{$array_pagos_pendiente['estado_contabilidad']}}')"> <i class="fas fa-trash"></i> </a>
                                                    {{-- <i class="fas fa-toggle-on fa-3x text-success"></i> --}}
                                                @elseif($array_pagos_pendiente['estado_contabilidad']=='5')
                                                    <a id="btn_pagar_{{$key}}" href="#!" class="btn btn-sm btn-success" onclick="pagar_proveedor('{{$key}}','{{$array_pagos_pendiente['proveedor']}}','{{$array_pagos_pendiente['items']}}','HOTELS')">Pagado</a>
                                                    {{-- <i class="fas fa-toggle-off fa-3x text-danger"></i>
                                                @elseif($array_pagos_pendiente['estado_contabilidad']=='2')
                                                    <i class="fas fa-toggle-off fa-3x text-grey-goto"></i> --}}
                                                @endif
                                            @endif
                                        </td>
                                        </tr>
                                    @endforeach

                                    @foreach($m_categories as $m_category)
                                        <tr>
                                            <th colspan="12" class="bg-dark text-white">{{$m_category->nombre}}</th>
                                        </tr>
                                        @foreach($array_pagos_pendientes_servicios as $key => $array_pagos_pendiente)
                                            @if($array_pagos_pendiente['grupo']==$m_category->nombre)
                                                @if($array_pagos_pendiente['estado_contabilidad']=='3'|| $array_pagos_pendiente['estado_contabilidad']=='5')
                                                    @php
                                                        $total_aprovado+=$array_pagos_pendiente['monto_c'];
                                                    @endphp
                                                @endif
                                                @php
                                                    $total+=$array_pagos_pendiente['monto_c'];
                                                @endphp
                                                <tr id="fila_{{$key}}">
                                                    <td class="text-grey-goto text-left">
                                                        <div class="form-check">
                                                        <input class="form-check-input d-none" type="hidden" form="enviar_requerimiento" value="{{$array_pagos_pendiente['items']}}" name="chb_h_pagos[]" id="chb_{{$key}}" onclick="if(this.checked) sumar($('#monto_c_{{$key}}').html()); else restar($('#monto_c_{{$key}}').html());" @if($array_pagos_pendiente['monto_r']>0 && $array_pagos_pendiente['monto_c']<=0) disabled @endif>
                                                            <label class="form-check-label" for="chb_{{$key}}">
                                                                <b class="text-success">{{$array_pagos_pendiente['codigo']}}</b> | <b>{{$array_pagos_pendiente['pax']}}</b><br>
                                                            @if($array_pagos_pendiente['monto_r']>0 && $array_pagos_pendiente['monto_c']<=0) <span id="warning_{{$array_pagos_pendiente['grupo']}}_{{$key}}" class="text-10 text-danger">Ingresar montos a pagar</span> @endif
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td class="text-grey-goto text-center">{{$array_pagos_pendiente['nro']}}<b><i class="fas fa-user text-primary"></i></b></td>
                                                    <td id="titulo_{{$key}}" class="text-grey-goto text-left">{!!$array_pagos_pendiente['titulo']!!}</td>
                                                    <td class="text-grey-goto text-left">{{$array_pagos_pendiente['proveedor']}}</td>
                                                    <td class="text-grey-goto text-center"><i class="fas fa-calendar"></i> {{fecha_peru($array_pagos_pendiente['fecha_servicio'])}}</td>
                                                    <td class="text-grey-goto text-center"><i class="fas fa-calendar"></i> {{fecha_peru($array_pagos_pendiente['fecha_pago'])}}</td>
                                                    <td class="text-grey-goto text-right"><b><sup>$</sup> {{$array_pagos_pendiente['monto_v']}}</b></td>
                                                    <td class="text-grey-goto text-right"><b><sup>$</sup> {{$array_pagos_pendiente['monto_r']}}</b></td>
                                                    <td class="text-grey-goto text-right"><b><sup>$</sup> <span id="monto_{{$array_pagos_pendiente['grupo']}}_c_{{$key}}">{{$array_pagos_pendiente['monto_c']}}</span></b></td>
                                                    <td class="text-grey-goto text-right" id="estado_view_{{$key}}">
                                                        @if($array_pagos_pendiente['estado_contabilidad']=='2') 
                                                        <b class="badge badge-dark">
                                                            Pendiente
                                                        </b>
                                                        @elseif($array_pagos_pendiente['estado_contabilidad']=='3') 
                                                            <b class="badge badge-primary">
                                                                Aprovado
                                                            </b>
                                                        @elseif($array_pagos_pendiente['estado_contabilidad']=='4') 
                                                            <b class="badge badge-danger">
                                                                Observado
                                                            </b>
                                                        @elseif($array_pagos_pendiente['estado_contabilidad']=='5') 
                                                            <b class="badge badge-success">
                                                                Pagado
                                                            </b>
                                                        @endif
                                                    </td>
                                                    <td class="text-grey-goto">
                                                        @if($array_pagos_pendiente['estado_contabilidad']=='3'||$array_pagos_pendiente['estado_contabilidad']=='5')
                                                            <input type="hidden" name="lista_pagar_servicios[]" form="form_" value="{{$array_pagos_pendiente['items']}}">
                                                        @endif
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_{{$key}}" onclick="traer_datos_detalle('{{$key}}','{{$array_pagos_pendiente['grupo']}}','{{$array_pagos_pendiente['clase']}}','{{$array_pagos_pendiente['items']}}','{{$array_pagos_pendiente['nro']}}','{{$operacion}}','{{$array_pagos_pendiente['estado_contabilidad']}}')">
                                                                    <i class="fas fa-eye"></i>
                                                        </button>
                                                            <!-- Modal -->
                                                        <div class="modal fade" id="modal_{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">  
                                                                <div class="modal-content  modal-lg">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Detalle Costos</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form id="form_{{$array_pagos_pendiente['grupo']}}_{{$key}}" action="{{route('contabilidad.hotel.store.revisor')}}" method="POST" > 
                                                                            <div class="row">
                                                                                <input type="hidden" name="items" value="{{$array_pagos_pendiente['items']}}">
                                                                                <div id="{{$array_pagos_pendiente['grupo']}}_{{$array_pagos_pendiente['clase']}}_datos_{{$key}}" class="col">

                                                                                </div>
                                                                            </div>  
                                                                        </form>   
                                                                    </div>
                                                                    <div class="modal-footer d-none">
                                                                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                                                                        <button type="button" class="btn btn-primary d-none">Save changes</button>
                                                                    </div>
                                                                </div>                                                                 
                                                            </div>
                                                        </div>    
                                                    </td>
                                                    <td>
                                                        @php
                                                        $valor=2;
                                                        @endphp
                                                        @if($array_pagos_pendiente['estado_contabilidad']=='4'||$array_pagos_pendiente['estado_contabilidad']=='2')
                                                            @php
                                                                $valor=4;
                                                            @endphp
                                                        @elseif($array_pagos_pendiente['estado_contabilidad']=='3')
                                                            @php
                                                                $valor=3;
                                                            @endphp
                                                        @elseif($array_pagos_pendiente['estado_contabilidad']=='5')
                                                            @php
                                                                $valor=5;
                                                            @endphp
                                                        @endif   
                                                        
                                                        <input type="hidden" id="hestado_contabilidad_{{$key}}" value="{{$valor}}">

                                                        @if($operacion=='pagar'||$operacion=='aprobar')
                                                    <a class="text-12 @if($operacion=='pagar') d-none @endif" id="estado_contabilidad_{{$key}}" href="#!" onclick="estado_contabilidad('{{$key}}','{{$array_pagos_pendiente['proveedor']}}','{{$array_pagos_pendiente['items']}}','{{$array_pagos_pendiente['grupo']}}')">
                                                            @if($array_pagos_pendiente['estado_contabilidad']=='3')
                                                                <i class="fas fa-toggle-on fa-3x text-primary"></i>
                                                            @elseif($array_pagos_pendiente['estado_contabilidad']=='5')
                                                                <i class="fas fa-toggle-off fa-3x text-success"></i>
                                                            @elseif($array_pagos_pendiente['estado_contabilidad']=='4')
                                                                <i class="fas fa-toggle-off fa-3x text-danger"></i>
                                                            @elseif($array_pagos_pendiente['estado_contabilidad']=='2')
                                                                <i class="fas fa-toggle-off fa-3x text-grey-goto"></i>
                                                            @endif
                                                        </a>
                                                        @endif
                                                        @if($operacion=='pagar')
                                                            @if($array_pagos_pendiente['estado_contabilidad']=='3')
                                                    <a id="btn_pagar_{{$key}}" href="#!" class="btn btn-sm btn-primary" onclick="pagar_proveedor('{{$key}}','{{$array_pagos_pendiente['proveedor']}}','{{$array_pagos_pendiente['items']}}','{{$array_pagos_pendiente['grupo']}}')">Pagar</a>
                                                                {{-- <i class="fas fa-toggle-on fa-3x text-success"></i> --}}
                                                            @elseif($array_pagos_pendiente['estado_contabilidad']=='4'||$array_pagos_pendiente['estado_contabilidad']=='2')
                                                                {{-- <a id="btn_pagar_{{$key}}" href="#!" class="btn btn-sm btn-danger" onclick="pagar_proveedor_borrar('{{$array_pagos_pendiente['items']}}','{{$key}}')">Borrar</a> --}}
                                                                {{-- <a id="btn_pagar_{{$key}}" href="#!" class="btn btn-sm btn-danger" onclick="borrar_items_pago_uno('{{$key}}','{{$array_pagos_pendiente['items']}}')">Borrar</a> --}}
                                                                {{-- <i class="fas fa-toggle-on fa-3x text-success"></i> --}}
                                                                <a id="btn_pagar_{{$key}}" href="#!" class="btn btn-sm btn-danger" onclick="borrar_items_pago_uno('{{$key}}','{{$array_pagos_pendiente['grupo']}}','{{$array_pagos_pendiente['items']}}','{{$array_pagos_pendiente['estado_contabilidad']}}')"> <i class="fas fa-trash"></i> </a>
                                                            @elseif($array_pagos_pendiente['estado_contabilidad']=='5')
                                                    <a id="btn_pagar_{{$key}}" href="#!" class="btn btn-sm btn-success" onclick="pagar_proveedor('{{$key}}','{{$array_pagos_pendiente['proveedor']}}','{{$array_pagos_pendiente['items']}}','{{$array_pagos_pendiente['grupo']}}')">Pagado</a>
                                                                {{-- <i class="fas fa-toggle-off fa-3x text-danger"></i>
                                                            @elseif($array_pagos_pendiente['estado_contabilidad']=='2')
                                                                <i class="fas fa-toggle-off fa-3x text-grey-goto"></i> --}}
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-3">
                            <div class="card w-100">
                                <div class="card-body text-center">
                                    <div class="row">
                                        @csrf
                                        <div class="col-6 text-left">
                                            <h2 class="text-15">Solicitado:</h2>
                                        </div>        
                                        <div class="col-6 text-right">
                                            <h2 class="text-15"><sup><small>$usd</small></sup><b id="s_total">{{$total}}</b></h2>
                                        </div>
                                        <div class="col-6 text-left">
                                            <h2 class="text-15">Aprovado:</h2>
                                        </div>
                                        <div class="col-6 text-right">
                                            <h2 class="text-15"><sup><small>$usd</small></sup><b id="s_total_aprovado">{{$total_aprovado}}</b></h2>
                                        </div>
                                    </div>
                                    @if($operacion=='pagar'||$operacion=='aprobar')
                                    <form id="form_" action="{{route('contabilidad.enviar_requerimiento_revisor')}}" method="POST">
                                        @csrf
                                        <input type="hidden" id="operacion" name="operacion" value="{{$operacion}}">
                                        <input type="hidden" name="requerimiento_id" value="{{$requerimiento->id}}">
                                        <input type="hidden" id="monto_total_aprovado" name="monto_total_aprovado" value="{{$total_aprovado}}">
                                        <input type="hidden" name="monto_aprovado" id="monto_aprovado" value="{{$total}}">
                                        <button type="button" class="btn btn-info display-block w-100" onclick="requerimiento_revisado()">@if($operacion=='aprobar') Enviar revision @elseif($operacion=='pagar') Pagar todo @endif </button>
                                    </form>
                                    <div class="row">
                                        <div class="col-12" id="rpt_">
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>                
                </div>
            </div>
        </div>
    </div>
    
@stop