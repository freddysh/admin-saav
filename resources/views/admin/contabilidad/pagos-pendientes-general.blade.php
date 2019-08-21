@php
    use Carbon\Carbon;
    // function fecha_peru($fecha){
    // $fecha=explode('-',$fecha);
    // return $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
    // }
    // function MisFunciones::fecha_peru_hora($fecha_){
    //     $f1=explode(' ',$fecha_);
    //     $hora=$f1[1];
    //     $f2=explode('-',$f1[0]);
    //     $fecha1=$f2[2].'-'.$f2[1].'-'.$f2[0];
    //     return $fecha1.' a las '.$hora;
    // }
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
            <li class="breadcrumb-item">Accounting</li>
            <li class="breadcrumb-item active">requerimientos</li>
        </ol>
    </nav>
    <hr>
    <div class="row my-3">
        <div class="col-lg-12">
            <div class="card w-100">
                <div class="card-body">
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="tipo_pago" class="text-secondary font-weight-bold pr-2">Forma de pago</label>
                                    <select form="preparar_requerimiento" name="tipo_pago" id="tipo_pago" class="form-control">
                                        <option value="TODOS">TODOS</option>
                                        <option value="CONTADO">CONTADO</option>
                                        <option value="CREDITO">CREDITO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                @php
                                    $ToDay=new Carbon();
                                @endphp
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="tipo_filtro" class="text-secondary font-weight-bold pr-2">Escoja una opcion </label>
                                    <select form="preparar_requerimiento" name="tipo_filtro" id="tipo_filtro" class="form-control" onchange="mostrar_opcion($(this).val())">
                                        <option value="POR CODIGO">POR CODIGO</option>
                                        <option value="POR NOMBRE">POR NOMBRE</option>
                                        <option value="TODOS LOS PENDIENTES">TODOS LOS PENDIENTES</option>
                                        <option value="TODOS LOS URGENTES">TODOS LOS URGENTES</option>
                                        <option value="ENTRE DOS FECHAS">ENTRE DOS FECHAS</option>
                                        <option value="ENTRE DOS FECHAS URGENTES">ENTRE DOS FECHAS URGENTES</option>
                                    </select>
                                </div>
                            </div>
                            <div id=bloque_filtros class="col-6">
                                <div class="row">
                                    @php
                                        $ToDay=new Carbon();
                                    @endphp
                                    {{csrf_field()}}
                                    <div class="col d-none" id="nombre">
                                        <label for="nombre_form" class="text-secondary font-weight-bold pr-2">Nombre </label>
                                        <input type="text" class="form-control" form="preparar_requerimiento" name="nombre_form" id="nombre_form" value="" placeholder="Ingrese el nombre de la venta">
                                    </div>
                                    <div class="col " id="codigo">
                                        <label for="codigo_form" class="text-secondary font-weight-bold pr-2">Codigo </label>
                                        <input type="text" class="form-control" form="preparar_requerimiento" name="codigo_form" id="codigo_form" value="" placeholder="Ingrese el codigo de la venta">
                                    </div>
                                    <div class="col-6 d-none" id="from">
                                        <label for="f_ini" class="text-secondary font-weight-bold pr-2">From </label>
                                        <input type="date" class="form-control" form="preparar_requerimiento" name="txt_ini" id="f_ini_ENTRADA" value="{{$ToDay->toDateString()}}" required>
                                    </div>
                                    <div class="col-6 d-none" id="to">
                                        <label for="f_fin" class="text-secondary font-weight-bold px-2"> To </label>
                                        <input type="date" class="form-control" form="preparar_requerimiento" name="txt_fin" id="f_fin_ENTRADA" value="{{$ToDay->toDateString()}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 mt-4">
                                <button type="button" class="btn btn-primary mt-2 mx-2 btn-block" onclick="buscar_pagos_pendientes($('#tipo_pago').val(),$('#tipo_filtro').val(),$('#nombre_form').val(),$('#codigo_form').val(),$('#f_ini_ENTRADA').val(),$('#f_fin_ENTRADA').val(),'ENTRANCES')"><i class="fas fa-search"></i> Filtrar</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12" id="rpt_hotel">
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
        function sumar(valor) {
            var total=parseFloat($('#s_total').html());
            console.log('valor sumar:'+valor);
            var num=parseFloat(valor);
            total +=  num;
            console.log('total:'+total);
            $('#s_total').html(total);
            // document.getElementById('s_total').innerHTML   = total;
        }
        function restar(valor) {
            var total=parseFloat($('#s_total').html());
            console.log('valor restar:'+valor);
            var num=parseFloat(valor);
            total -=  num;
            console.log('total:'+total);
            $('#s_total').html(total);
            // document.getElementById('s_total').innerHTML   = total;
        }

    </script>
@stop