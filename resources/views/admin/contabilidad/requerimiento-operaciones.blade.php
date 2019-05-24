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
                            <div class="card">
                                <div class="card-body">
                                        {{-- <form action="{{route('list_fechas_hotel_show_path')}}" method="post"> --}}
                                            {{-- {{csrf_field()}} --}}
                                    <div class="row">
                                        <div class="col-9">
                                            <table class="table table-condensed table-bordered margin-top-20 table-hover table-sm text-12">
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
                                                    @php
                                                        $total=0;
                                                        $total_aprovado=0;
                                                    @endphp
                                                    @foreach($array_pagos_pendientes as $key => $array_pagos_pendiente)
                                                        @if($array_pagos_pendiente['estado_contabilidad']=='3')
                                                            @php
                                                                $total_aprovado+=$array_pagos_pendiente['monto_c'];
                                                            @endphp
                                                        @endif
                                                    @php
                                                        $total+=$array_pagos_pendiente['monto_c'];
                                                    @endphp
                                                        <tr>
                                                            <td class="text-grey-goto text-left">
                                                                <div class="form-check">
                                                                <input class="form-check-input d-none" type="hidden" form="enviar_requerimiento" value="{{$array_pagos_pendiente['items']}}" name="chb_h_pagos[]" id="chb_{{$key}}" onclick="if(this.checked) sumar($('#monto_c_{{$key}}').html()); else restar($('#monto_c_{{$key}}').html());" @if($array_pagos_pendiente['monto_r']>0 && $array_pagos_pendiente['monto_c']<=0) disabled @endif>
                                                                    <label class="form-check-label" for="chb_{{$key}}">
                                                                        <b class="text-success">{{$array_pagos_pendiente['codigo']}}</b> | <b>{{$array_pagos_pendiente['pax']}}</b><br>
                                                                    @if($array_pagos_pendiente['monto_r']>0 && $array_pagos_pendiente['monto_c']<=0) <span id="warning_{{$key}}" class="text-10 text-danger">Ingresar montos a pagar</span> @endif
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td class="text-grey-goto text-center">{{$array_pagos_pendiente['nro']}}<b><i class="fas fa-user text-primary"></i></b></td>
                                                            <td class="text-grey-goto text-left">{!!$array_pagos_pendiente['titulo']!!}</td>
                                                            <td class="text-grey-goto text-left">{{$array_pagos_pendiente['proveedor']}}</td>
                                                            <td class="text-grey-goto text-center"><i class="fas fa-calendar"></i> {{fecha_peru($array_pagos_pendiente['fecha_servicio'])}}</td>
                                                            <td class="text-grey-goto text-center"><i class="fas fa-calendar"></i> {{fecha_peru($array_pagos_pendiente['fecha_pago'])}}</td>
                                                            <td class="text-grey-goto text-right"><b><sup>$</sup> {{$array_pagos_pendiente['monto_v']}}</b></td>
                                                            <td class="text-grey-goto text-right"><b><sup>$</sup> {{$array_pagos_pendiente['monto_r']}}</b></td>
                                                            <td class="text-grey-goto text-right"><b><sup>$</sup> <span id="monto_c_{{$key}}">{{$array_pagos_pendiente['monto_c']}}</span></b></td>
                                                        <td class="text-grey-goto text-right" id="estado_view_{{$key}}">
                                                                @if($array_pagos_pendiente['estado_contabilidad']=='2') 
                                                                <b class="badge badge-dark">
                                                                    Pendiente
                                                                </b>
                                                                @elseif($array_pagos_pendiente['estado_contabilidad']=='3') 
                                                                    <b class="badge badge-success">
                                                                        Aprovado
                                                                    </b>
                                                                @elseif($array_pagos_pendiente['estado_contabilidad']=='4') 
                                                                    <b class="badge badge-danger">
                                                                        Observado
                                                                    </b>
                                                                @elseif($array_pagos_pendiente['estado_contabilidad']=='5') 
                                                                    <b class="badge badge-primary">
                                                                        Pagado
                                                                    </b>
                                                                @endif
                                                            </td>
                                                            {{-- <td class="text-grey-goto text-right">{{$array_pagos_pendiente['saldo']}}</td> --}}
                                                            <td class="text-grey-goto">
                                                                <!-- Button trigger modal -->
                                                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_{{$key}}" onclick="traer_datos_detalle('{{$key}}','HOTELS','{{$array_pagos_pendiente['items_itinerario']}}','{{$array_pagos_pendiente['nro']}}')">
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
                                                                                <form id="form_{{$key}}" action="{{route('contabilidad.hotel.store.revisor')}}" method="POST" > 
                                                                                    <div class="row">
                                                                                            <input type="hidden" name="items" value="{{$array_pagos_pendiente['items']}}">
                                                                                        <div id="datos_{{$key}}" class="col">
        
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
                                                                @endif   
                                                                
                                                                <input type="hidden" id="hestado_contabilidad_{{$key}}" value="{{$valor}}">
                                                            <a class="text-12" id="estado_contabilidad_{{$key}}" href="#" onclick="estado_contabilidad('{{$key}}','{{$array_pagos_pendiente['proveedor']}}','{{$array_pagos_pendiente['items']}}')">
                                                                    @if($array_pagos_pendiente['estado_contabilidad']=='3'||$array_pagos_pendiente['estado_contabilidad']=='5')
                                                                        <i class="fas fa-toggle-on fa-3x text-success"></i>
                                                                    @elseif($array_pagos_pendiente['estado_contabilidad']=='4')
                                                                        <i class="fas fa-toggle-off fa-3x text-danger"></i>
                                                                    @elseif($array_pagos_pendiente['estado_contabilidad']=='2')
                                                                        <i class="fas fa-toggle-off fa-3x text-grey-goto"></i>
                                                                    @endif
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-3">
                                            <div class="card w-100">
                                                <div class="card-body text-center">
                                                    <div class="row">
                                                        <div class="col-6 text-left">
                                                            <h2 class="text-20">Solicitado:</h2>
                                                        </div>        
                                                        <div class="col-6 text-right">
                                                            <h2 class="text-20"><sup><small>$usd</small></sup><b id="s_total">{{$total}}</b></h2>
                                                        </div>
                                                        <div class="col-6 text-left">
                                                            <h2 class="text-20">Aprovado:</h2>
                                                        </div>
                                                        <div class="col-6 text-right">
                                                            <h2 class="text-20"><sup><small>$usd</small></sup><b id="s_total_aprovado">{{$total_aprovado}}</b></h2>
                                                        </div>
                                                    </div>
                                                    <form id="enviar_requerimiento" action="{{route('contabilidad.enviar_requerimiento')}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="prueba" value="hola">
                                                        {{--  <input type="hidden" name="txt_ini" value="{{$txt_ini}}">
                                                        <input type="hidden" name="txt_fin" value="{{$txt_fin}}">
                                                        <input type="hidden" name="modo_busqueda" value="{{$modo_busqueda}}">  --}}
                                                        <input type="hidden" name="monto_solicitado" value="{{$total}}">
                                                        
                                                        <input type="hidden" name="monto_aprovado" id="monto_aprovado" value="{{$total}}">
                                                        <button type="submit" class="btn btn-info display-block w-100">Enviar revision</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        {{-- </form> --}}
                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@stop