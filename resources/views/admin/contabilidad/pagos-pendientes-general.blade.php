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
                        <div class="row mt-3">
                                <div class="col-12">
                                    <div class="card w-100">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12 form-inline">
                                                    @php
                                                        $ToDay=new Carbon();
                                                    @endphp
                                                    {{--<form action="{{route('list_fechas_rango_hotel_path')}}" method="post" class="form-inline">--}}
                                                    {{csrf_field()}}
                                                    <div class="form-group">
                                                        <label for="f_ini" class="text-secondary font-weight-bold pr-2">From </label>
                                                        <input type="date" class="form-control" placeholder="from" name="txt_ini" id="f_ini" value="{{$ToDay->toDateString()}}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="f_fin" class="text-secondary font-weight-bold px-2"> To </label>
                                                        <input type="date" class="form-control" placeholder="to" name="txt_fin" id="f_fin" value="{{$ToDay->toDateString()}}" required>
                                                    </div>
                                                    <button type="button" class="btn btn-default mx-2 mx-2" onclick="buscar_pagos_pendientes($('#f_ini').val(),$('#f_fin').val())">Filtrar</button>
                                                    {{--</form>--}}
                                                </div>
                                            </div><!-- /.row -->
                                            {{--<hr>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-12" id="rpt_hotel">
                                               
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-12">
                                    <div class="card w-100">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h2>Consultas Guardadas(HOTELS)</h2>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-4 col-md-offset-4 text-center">
                                                    @if(Session::has('message'))
                                                        <div class="alert alert-danger" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            {{Session::get('message')}}
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
            total += valor;
            document.getElementById('s_total').innerHTML   = total;
        }
        function restar(valor) {
            total-=valor;
            document.getElementById('s_total').innerHTML   = total;
        }

    </script>
@stop