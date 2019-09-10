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
                        <div class="col-9">
                            <div clas="row">
                                <div class="col-12">
                                    <b>
                                    <i class="fas fa-filter"></i> {{$tipo_pago}} | 
                                        @if($modo_busqueda=='ENTRE DOS FECHAS'||$modo_busqueda=='ENTRE DOS FECHAS URGENTES')
                                            <i class="fas fa-calendar"></i> {{$modo_busqueda}} [{{MisFunciones::fecha_peru($txt_ini)}} al {{MisFunciones::fecha_peru($txt_fin)}}]
                                        @else
                                        <i class="fas fa-filter"></i> {{$modo_busqueda}} | <i class="fas fa-filter"></i>{{$cod_nom}}
                                        @endif
                                    </b>
                                </div>
                            </div>
                            <table class="table table-condensed table-bordered table-hover table-sm text-12">
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
                                    <th class="text-grey-goto text-center d-none">Saldo</th>
                                    <th class="text-grey-goto text-center">Ope.</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr><td class="bg-dark text-white" colspan="11">HOTELES</td></tr>
                                    @php
                                        $total=0;
                                        $arreglo='';
                                    @endphp
                                    @foreach($array_pagos_pendientes as $key => $array_pagos_pendiente)
                                        @php
                                            $total+=$array_pagos_pendiente['monto_c'];
                                        @endphp
                                        <tr id="fila_{{$array_pagos_pendiente['grupo']}}_{{$key}}">
                                            <td class="text-grey-goto text-left"><b class="text-success">{{$array_pagos_pendiente['codigo']}}</b> | <b>{{$array_pagos_pendiente['pax']}}</b></td>
                                            <td class="text-grey-goto text-left d-none">
                                                <div class="form-check">
                                                <input type="hidden" form="enviar_requerimiento" value="{{$array_pagos_pendiente['items']}}" name="chb_h_pagos[]" id="chb_{{$key}}">
                                                </div>
                                            </td>
                                            <td class="text-grey-goto text-center">{{$array_pagos_pendiente['nro']}}<b><i class="fas fa-user text-primary"></i></b></td>
                                            <td class="text-grey-goto text-left">{!!$array_pagos_pendiente['titulo']!!}</td>
                                            <td class="text-grey-goto text-left">{{$array_pagos_pendiente['proveedor']}}</td>
                                            <td class="text-grey-goto text-center"><i class="fas fa-calendar"></i> {{fecha_peru($array_pagos_pendiente['fecha_servicio'])}}</td>
                                            <td class="text-grey-goto text-center"><i class="fas fa-calendar"></i> {{fecha_peru($array_pagos_pendiente['fecha_pago'])}}</td>
                                            <td class="text-grey-goto text-right"><b><sup>$</sup> {{$array_pagos_pendiente['monto_v']}}</b></td>
                                            <td class="text-grey-goto text-right"><b><sup>$</sup> {{$array_pagos_pendiente['monto_r']}}</b></td>
                                            <td class="text-grey-goto text-right"><b><sup>$</sup> <span id="monto_{{$array_pagos_pendiente['grupo']}}_c_{{$key}}">{{$array_pagos_pendiente['monto_c']}}</span></b></td>
                                            <td class="text-grey-goto text-right d-none">{{$array_pagos_pendiente['saldo']}}</td>
                                            <td class="text-grey-goto text-right">
                                                <!-- Button trigger modal -->
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_{{$key}}" onclick="traer_datos('{{$key}}','{{$array_pagos_pendiente['grupo']}}','{{$array_pagos_pendiente['clase']}}','{{$array_pagos_pendiente['items_itinerario']}}','{{$array_pagos_pendiente['nro']}}','{{$array_pagos_pendiente['estado_contabilidad']}}')">
                                                                <i class="fas fa-edit"></i>
                                                    </button> 
                                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_notas_{{$key}}" ><i class="fas fa-book"></i></button>

                                                    <button type="button" class="btn btn-danger btn-sm" onclick="borrar_item_pago('{{$key}}','{{$array_pagos_pendiente['grupo']}}','{{str_replace(',','_',$array_pagos_pendiente['items_itinerario'])}}')"><i class="fas fa-trash-alt"></i></button>
                                                </div>
                                                    <!-- Modal -->
                                                <div class="modal fade" id="modal_{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">  
                                                        <form id="form_{{$array_pagos_pendiente['grupo']}}_{{$key}}" action="{{route('contabilidad.hotel.store')}}" method="POST" >   
                                                            <div class="modal-content  modal-lg">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Editar Costos</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div id="{{$array_pagos_pendiente['grupo']}}_{{$array_pagos_pendiente['clase']}}_datos_{{$key}}" class="col">

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer d-none">
                                                                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                                                                    <button type="button" class="btn btn-primary d-none">Save changes</button>
                                                                </div>
                                                            </div>   
                                                        </form>                                                                   
                                                    </div>
                                                </div>    
                                                
                                                <div class="modal fade" id="modal_notas_{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                        <div class="modal-content  modal-lg">
                                                            <div class="modal-header bg-primary text-white">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">Agregar notas</h5>
                                                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body text-left">
                                                                <form id="form_notas_HOTELS_{{$key}}" action="{{route('contabilidad.hotel.store.notas')}}" method="POST" >

                                                                    <div class="row">
                                                                        <div class="form-group">
                                                                        <textarea name="notas" id="notas_{{$key}}" cols="30" rows="10" aria-describedby="Ingrese alguna observación" placeholder="Ingrese alguna observación">{{$array_pagos_pendiente['notas_cotabilidad']}}</textarea>
                                                                        </div>
                                                                        <input type="hidden" name="items[]" value="{{$array_pagos_pendiente['items']}}">
                                                                        <input type="hidden" name="grupo" value="HOTELS">
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-12" id="rpt_notas_HOTELS_{{$key}}">
                                                                        </div>
                                                                    </div> 
                                                                </form> 
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cerrar</button>
                                                                <button type="button" class="btn btn-primary" onclick="contabilidad_guardar_notas_requerimiento('{{$key}}','HOTELS')">Guardar</button>
                                                            </div>
                                                        </div>                                                                    
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @php
                                            $arreglo.=str_replace(',','_',$array_pagos_pendiente['items_itinerario']) .',';
                                        @endphp
                                    @endforeach
                                    @php
                                        $arreglo=substr($arreglo,0,strlen($arreglo)-1);
                                    @endphp
                                    @php
                                        $arreglo_servicios=array('0'=>'TOURS','1'=>'MOVILID','2'=>'REPRESENT','3'=>'ENTRANCES','4'=>'FOOD','5'=>'TRAINS','6'=>'FLIGHTS','7'=>'OTHERS');
                                    @endphp
                                     @php
                                            $total_servicio=0;
                                            $arreglo_servicio_='';
                                        @endphp
                                    @foreach($arreglo_servicios as $arreglo_servicio)
                                        <tr>
                                            <td class="bg-dark text-white" colspan="11">{{$arreglo_servicio}}</td>
                                        </tr>
                                        @foreach($array_pagos_pendientes_servicios as $key => $array_pagos_pendiente)
                                            @if($array_pagos_pendiente['grupo']==$arreglo_servicio)
                                            @php
                                                $total_servicio+=$array_pagos_pendiente['monto_c'];
                                            @endphp
                                            <tr id="fila_{{$array_pagos_pendiente['grupo']}}_{{$key}}">
                                                <td class="text-grey-goto text-left"><b class="text-success">{{$array_pagos_pendiente['codigo']}}</b> | <b>{{$array_pagos_pendiente['pax']}}</b></td>
                                                <td class="text-grey-goto text-left d-none">
                                                    <div class="form-check">
                                                    <input type="hidden" form="enviar_requerimiento" value="{{$array_pagos_pendiente['items']}}" name="chb_h_pagos_servicio[]" >
                                                    </div>
                                                </td>
                                                <td class="text-grey-goto text-center">{{$array_pagos_pendiente['nro']}}<b><i class="fas fa-user text-primary"></i></b></td>
                                                <td class="text-grey-goto text-left">{!!$array_pagos_pendiente['titulo']!!}</td>
                                                <td class="text-grey-goto text-left">{{$array_pagos_pendiente['proveedor']}}</td>
                                                <td class="text-grey-goto text-center"><i class="fas fa-calendar"></i> {{fecha_peru($array_pagos_pendiente['fecha_servicio'])}}</td>
                                                <td class="text-grey-goto text-center"><i class="fas fa-calendar"></i> {{fecha_peru($array_pagos_pendiente['fecha_pago'])}}</td>
                                                <td class="text-grey-goto text-right"><b><sup>$</sup> {{$array_pagos_pendiente['monto_v']}}</b></td>
                                                <td class="text-grey-goto text-right"><b><sup>$</sup> {{$array_pagos_pendiente['monto_r']}}</b></td>
                                                <td class="text-grey-goto text-right"><b><sup>$</sup> <span id="monto_{{$array_pagos_pendiente['grupo']}}_c_{{$key}}">{{$array_pagos_pendiente['monto_c']}}</span></b></td>
                                                <td class="text-grey-goto text-right d-none">{{$array_pagos_pendiente['saldo']}}</td>
                                                <td class="text-grey-goto text-right">
                                                    <!-- Button trigger modal -->
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_{{$key}}" onclick="traer_datos('{{$key}}','{{$array_pagos_pendiente['grupo']}}','{{$array_pagos_pendiente['clase']}}','{{$array_pagos_pendiente['items']}}','{{$array_pagos_pendiente['nro']}}','{{$array_pagos_pendiente['estado_contabilidad']}}')">
                                                                    <i class="fas fa-edit"></i>
                                                        </button> 
                                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_notas_{{$array_pagos_pendiente['grupo']}}_{{$key}}" ><i class="fas fa-book"></i></button>

                                                    <button type="button" class="btn btn-danger btn-sm" onclick="borrar_item_pago('{{$key}}','{{$array_pagos_pendiente['grupo']}}','{{str_replace(',','_',$array_pagos_pendiente['items'])}}')"><i class="fas fa-trash-alt"></i></button>
                                                    </div>
                                                        <!-- Modal -->
                                                    <div class="modal fade" id="modal_{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">  
                                                            <form id="form_{{$array_pagos_pendiente['grupo']}}_{{$key}}" action="{{route('contabilidad.hotel.store')}}" method="POST" >   
                                                                <div class="modal-content  modal-lg">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Editar Costos</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div id="{{$array_pagos_pendiente['grupo']}}_{{$array_pagos_pendiente['clase']}}_datos_{{$key}}" class="col">

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer d-none">
                                                                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                                                                        <button type="button" class="btn btn-primary d-none">Save changes</button>
                                                                    </div>
                                                                </div>   
                                                            </form>                                                                   
                                                        </div>
                                                    </div>    
                                                    
                                                    <div class="modal fade" id="modal_notas_{{$array_pagos_pendiente['grupo']}}_{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered  modal-md" role="document">
                                                            <div class="modal-content  modal-lg">
                                                                <div class="modal-header bg-primary text-white">
                                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Agregar notas</h5>
                                                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body text-left">
                                                                    <form id="form_notas_{{$array_pagos_pendiente['grupo']}}_{{$key}}" action="{{route('contabilidad.hotel.store.notas')}}" method="POST" >

                                                                        <div class="row">
                                                                            <div class="form-group">
                                                                            <textarea name="notas" id="notas_{{$key}}" cols="30" rows="10" aria-describedby="Ingrese alguna observación" placeholder="Ingrese alguna observación">{{$array_pagos_pendiente['notas_cotabilidad']}}</textarea>
                                                                            </div>
                                                                            <input type="hidden" name="items[]" value="{{$array_pagos_pendiente['items']}}">
                                                                            <input type="hidden" name="grupo" value="{{$array_pagos_pendiente['grupo']}}">
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-12" id="rpt_notas_{{$array_pagos_pendiente['grupo']}}_{{$key}}">
                                                                            </div>
                                                                        </div> 
                                                                    </form> 
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cerrar</button>
                                                                    <button type="button" class="btn btn-primary" onclick="contabilidad_guardar_notas_requerimiento('{{$key}}','{{$array_pagos_pendiente['grupo']}}')">Guardar</button>
                                                                </div>
                                                            </div>                                                                    
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php
                                                $arreglo_servicio_.=str_replace('_',',',$array_pagos_pendiente['items']) .',';
                                            @endphp
                                            @endif
                                        @endforeach
                                    @endforeach
                                    @php
                                        $arreglo_servicio_=substr($arreglo_servicio_,0,strlen($arreglo_servicio_)-1);
                                    @endphp
                                </tbody>
                            </table>
                        </div>
                        <div class="col-3">
                            <div class="card w-100">
                                <div class="card-body text-center">
                                    {{-- <input type="hidden" id="chb_h_pagos" value="{{$arreglo}}">
                                    <input type="hidden" id="chb_h_pagos_servicio" value="{{$arreglo_servicio_}}"> --}}
                                    <h2 class="text-40"><sup><small>$usd</small></sup><b id="s_total">{{$total+$total_servicio}}</b></h2>
                                    <form id="enviar_requerimiento" action="{{route('contabilidad.enviar_requerimiento')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="prueba" value="hola">
                                        <input type="hidden" name="tipo_pago" id="tipo_pago" value="{{$tipo_pago}}">
                                        <input type="hidden" name="txt_ini" id="txt_ini" value="{{$txt_ini}}">
                                        <input type="hidden" name="txt_fin" id="txt_fin" value="{{$txt_fin}}">
                                        <input type="hidden" name="modo_busqueda" id="modo_busqueda" value="{{$modo_busqueda}}">
                                        <input type="hidden" name="monto_solicitado" id="monto_solicitado" value="{{$total+$total_servicio}}">
                                        <div class="alert alert-danger">
                                        <strong>Nota: </strong>
                                        Esta acción confirmara los costos ingresados por reservas. Si esta de acuerdo proceda.
                                        </div>
                                        <button id="btn_enviar" type="submit" onclick="enviar_consulta('enviar_requerimiento')" class="btn btn-info display-block w-100">Enviar requerimiento</button>
                                    </form>
                                    <div class="row">
                                        <div id="rpt_" class="col-12">

                                        </div>
                                    </div>
                                </div>
                            </div>
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
        function eliminar_consulta(id,tipo) {
            swal({
                title: 'MENSAJE DEL SISTEMA',
                text: "La consulta se eliminara permanentemente.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('[name="_token"]').val()
                    }
                });
                $.post('{{route('consulta_delete_path')}}', 'id='+id+'&tipo='+tipo, function(data) {
                    if(data==1){
                        $("#c_"+tipo+"_"+id).remove();
                    }
                }).fail(function (data) {

                });

            })
        }
        var total=0;
        function sumar(valor) {
            console.log('valor sumar:'+valor);
            var num=parseFloat(valor);
            total +=  num;
            console.log('total:'+total);
            $('#s_total').html(total);
            // document.getElementById('s_total').innerHTML   = total;
        }
        function restar(valor) {
            console.log('valor restar:'+valor);
            var num=parseFloat(valor);
            total -=  num;
            console.log('total:'+total);
            $('#s_total').html(total);
            // document.getElementById('s_total').innerHTML   = total;
        }

    </script>
@stop