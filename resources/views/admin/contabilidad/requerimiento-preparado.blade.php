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
                                                    <th class="text-grey-goto text-center">Saldo</th>
                                                    <th class="text-grey-goto text-center">Operaciones</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $total=0;
                                                    @endphp
                                                    @foreach($array_pagos_pendientes as $key => $array_pagos_pendiente)
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
                                                            <td class="text-grey-goto text-right">{{$array_pagos_pendiente['saldo']}}</td>
                                                            <td class="text-grey-goto text-right">
                                                                <!-- Button trigger modal -->
                                                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_{{$key}}" onclick="traer_datos('{{$key}}','HOTELS','{{$array_pagos_pendiente['items_itinerario']}}','{{$array_pagos_pendiente['nro']}}')">
                                                                            <i class="fas fa-edit"></i>
                                                                </button>    
                                                                    <!-- Modal -->
                                                                <div class="modal fade" id="modal_{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">  
                                                                        <form id="form_{{$key}}" action="{{route('contabilidad.hotel.store')}}" method="POST" >   
                                                                            <div class="modal-content  modal-lg">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Editar Costos</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="row">
                                                                                        <div id="datos_{{$key}}" class="col">
        
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
                                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_notas_{{$key}}" ><i class="fas fa-book"></i></button>
                                                                <div class="modal fade" id="modal_notas_{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">  
                                                                        <form id="form_notas_{{$key}}" action="{{route('contabilidad.hotel.store.notas')}}" method="POST" >   
                                                                            <div class="modal-content  modal-lg">
                                                                                <div class="modal-header bg-primary text-white">
                                                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Agregar notas</h5>
                                                                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body text-left">
                                                                                    <div class="row">
                                                                                        <div class="form-group">
                                                                                            <label class="d-none" for="notas_{{$key}}">Notas</label>
                                                                                        <textarea name="notas" id="notas_{{$key}}" cols="30" rows="10" aria-describedby="Ingrese alguna observación" placeholder="Ingrese alguna observación">{{$array_pagos_pendiente['notas_cotabilidad']}}</textarea>
                                                                                        </div>
                                                                                        <input type="hidden" name="items" value="{{$array_pagos_pendiente['items']}}">
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-12" id="rpt_notas_{{$key}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cerrar</button>
                                                                                    <button type="button" class="btn btn-primary" onclick="contabilidad_guardar_notas_requerimiento('{{$key}}','HOTELS')">Guardar</button>
                                                                                </div>
                                                                            </div>   
                                                                        </form>                                                                   
                                                                    </div>
                                                                </div>  
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-3">
                                            <div class="card w-100">
                                                <div class="card-body text-center">
                                                    <h2 class="text-40"><sup><small>$usd</small></sup><b id="s_total">{{$total}}</b></h2>
                                                    <form id="enviar_requerimiento" action="{{route('contabilidad.enviar_requerimiento')}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="prueba" value="hola">
                                                        <input type="hidden" name="txt_ini" value="{{$txt_ini}}">
                                                        <input type="hidden" name="txt_fin" value="{{$txt_fin}}">
                                                        <input type="hidden" name="modo_busqueda" value="{{$modo_busqueda}}">
                                                        <input type="hidden" name="monto_solicitado" value="{{$total}}">
                                                        
                                                        <button type="submit" class="btn btn-info display-block w-100">Enviar requerimiento</button>
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