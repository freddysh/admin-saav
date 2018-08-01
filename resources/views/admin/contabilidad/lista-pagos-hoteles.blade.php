@extends('layouts.admin.contabilidad')
@section('content')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <div class="row margin-top-40">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Contabilidad</li>
            <li>Hoteles</li>
            <li class="active">Listar por fechas</li>
        </ol>
    </div>
    @if($ids == 0)
        @foreach($consulta as $consultas)
            @php $ids = explode(',', $consultas->codigos) @endphp
        @endforeach
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-right @if($codigos > 0) hide @else show @endif">
                        @foreach($ids as $id)
                            <input type="hidden" id="p_codigos" name="codigos[]" value="{{$id}}">
                        @endforeach
                        <button class="btn btn-success text-right" type="button" id="btn_guardar" onclick="guardarConsulta()">Guardar Consulta</button>
                        <i class="fa fa-spinner fa-pulse fa-3x fa-fw hide" id="btn_load"></i>
                        <span class="sr-only">Loading...</span>
                        <i class="fa fa-check fa-3x text-success hide" id="btn_check"></i>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 table-responsive">
                            <table class="table table-condensed table-bordered margin-top-20 table-hover">
                                <thead>
                                <tr>
                                    <th class="text-15 text-grey-goto ">Cotización</th>
                                    <th class="text-15 text-grey-goto text-center">Medio Pago</th>
                                    <th class="text-15 text-grey-goto text-center">#CB/CCI</th>
                                    <th class="text-15 text-grey-goto text-center">Transaccion</th>
                                    <th class="text-15 text-grey-goto text-center">Total</th>
                                    <th class="text-15 text-grey-goto text-center">Pagado</th>
                                    <th class="text-15 text-grey-goto text-center">a pagar</th>
                                    <th class="text-15 text-grey-goto text-center">Saldo</th>
                                    <th class="text-15 text-grey-goto text-center">Prox. fecha</th>
                                    <th class="text-15 text-grey-goto text-center">Operaciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ids as $listado)
                                    @php
                                        $listado_=explode('(_)',$listado);
                                        $pagado=$pagos->where('paquete_cotizaciones_id',$listado_[0])->where('proveedor_id',$listado_[1])->where('estado','1')->sum('a_cuenta');
                                    @endphp
                                    <tr>
                                        <td class="text-13 text-grey-goto">{{$listado_[4]}} <span class="text-warning">({{$listado_[5]}})</span></td>
                                        <td class="text-12 text-grey-goto col-lg-2">
                                            <select type="text" class="form-control" id="medio_{{$listado_[0]}}_{{$listado_[1]}}" @if($pagado==$listado_[2]) disabled @endif>
                                                <option value="TRANSFERENCIA">TRANSFER.</option>
                                                <option value="CHEQUE">CHEQUE</option>
                                                <option value="EFECTIVO">EFECTIVO</option>
                                            </select>
                                        </td>
                                        <td class="text-13 text-grey-goto col-lg-2"><input type="text" class="form-control" id="cuenta_{{$listado_[0]}}_{{$listado_[1]}}" @if($pagado==$listado_[2]) disabled @endif></td>
                                        <td class="text-13 text-grey-goto col-lg-2"><input type="text" class="form-control" id="transaccion_{{$listado_[0]}}_{{$listado_[1]}}" @if($pagado==$listado_[2]) disabled @endif></td>
                                        <td class="text-13 text-grey-goto text-center"><b>{{$listado_[2]}}<sub><small>$</small></sub></b></td>
                                        <td class="text-13 text-grey-goto text-center"><b>{{$pagado}}<sub><small>$</small></sub></b></td>
                                        <td class="text-13 text-grey-goto col-lg-1"><input type="text" class="form-control" value="{{$listado_[2]-$pagado}}" id="a_pagar_{{$listado_[0]}}_{{$listado_[1]}}" onkeyup="calcular_saldo('{{$listado_[2] - $pagado}}',$('#a_pagar_{{$listado_[0]}}_{{$listado_[1]}}').val(),$('#prox_fecha_{{$listado_[0]}}_{{$listado_[1]}}').val(),'{{$listado_[0]}}','{{$listado_[1]}}')" @if($pagado==$listado_[2]) disabled @endif></td>
                                        <td class="text-13 text-grey-goto text-center"><b><span id="saldo_{{$listado_[0]}}_{{$listado_[1]}}">0</span><sub><small>$</small></sub></b></td>
                                        <td class="text-13 text-grey-goto col-lg-1"><input type="date" id="prox_fecha_{{$listado_[0]}}_{{$listado_[1]}}" class="form-control" onchange="verificar_fecha('{{$listado_[2]}}',$('#a_pagar_{{$listado_[0]}}_{{$listado_[1]}}').val(),$('#prox_fecha_{{$listado_[0]}}_{{$listado_[1]}}').val(),'{{$listado_[0]}}','{{$listado_[1]}}')" @if($pagado==$listado_[2]) disabled @endif></td>
                                        <td class="text-13 text-grey-goto col-lg-2">
                                            @if($pagado==$listado_[2])
                                                <button class="btn btn-danger" id="btn_guardar_{{$listado_[0]}}_{{$listado_[1]}}">Pago realizado</button>
                                            @else
                                            <button class="btn btn-primary" id="btn_guardar_{{$listado_[0]}}_{{$listado_[1]}}" onclick="verificar_precio_fecha('{{$listado_[2]-$pagado}}',$('#a_pagar_{{$listado_[0]}}_{{$listado_[1]}}').val(),'{{$listado_[6]}}',$('#prox_fecha_{{$listado_[0]}}_{{$listado_[1]}}').val(),'{{$listado_[0]}}','{{$listado_[1]}}')">Guardar</button>
                                            <i class="fa fa-spinner fa-pulse text-18 fa-fw hide" id="btn_load_{{$listado_[0]}}_{{$listado_[1]}}"></i>
                                            <button class="btn btn-warning hide" id="btn_editar_{{$listado_[0]}}_{{$listado_[1]}}" onclick="verificar_precio_fecha_editar('{{$listado_[2]-$listado_[2]}}',$('#a_pagar_{{$listado_[0]}}_{{$listado_[1]}}').val(),'{{$listado_[6]}}',$('#prox_fecha_{{$listado_[0]}}_{{$listado_[1]}}').val(),'{{$listado_[0]}}','{{$listado_[1]}}')">Editar</button>
                                            <i class="fa fa-check text-success fa-2x hide" id="btn_chck_{{$listado_[0]}}_{{$listado_[1]}}"></i>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal_{{$listado_[0]}}_{{$listado_[1]}}">
                                                <i class="fa fa-picture-o" aria-hidden="true"></i>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="myModal_{{$listado_[0]}}_{{$listado_[1]}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel">Subir imagen</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="form_{{$listado[0]}}_{{$listado[1]}}" action="{{route('guardar_imagen_pago_hotel_path')}}">
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <label for="">Escoja una imagen</label>
                                                                        <input type="file" name="foto">
                                                                        <input type="hidden" name="id" id="foto_{{$listado[0]}}_{{$listado[1]}}" value="0">
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" onclick="uploadAjax('{{$listado[0]}}','{{$listado[1]}}')">Guardar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{csrf_field()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function uploadAjax(pqt_id,prov_id){
            $('#foto_' + pqt_id + '_' + prov_id).val(pagos_hotel_id);

            if($('#foto_' + pqt_id + '_' + prov_id).val()!='0') {

                var data = new FormData($('#form_'+pqt_id+'_'+prov_id)[0]);
                var url = "{{route('guardar_imagen_pago_hotel_path')}}";
                $.ajax({
                    url: url,
                    type: "POST",
                    dataType: 'json',
                    contentType: false,
                    data: data,
                    processData: false,
                    cache: false
                }).done(function (respuesta) {
                    alert(respuesta.mensaje);
                });
            }
            else{
                swal(
                    'MENSAJE DEL SISTEMA',
                    'Se debe de guardar el pago',
                    'warning'
                )
            }
        }
        var pagos_hotel_id=0;
        function calcular_saldo(total,acuenta,fecha,pqt_id,prov_id){

            if(parseInt(acuenta) >parseInt(total)){
//                $('#a_pagar_'+pqt_id+'_'+prov_id).val(total);
                $('#a_pagar_'+pqt_id+'_'+prov_id).css("border-bottom", "2px solid #FF0000");
            }
            else
                $('#a_pagar_'+pqt_id+'_'+prov_id).css("border-bottom", "");

            if(parseInt(acuenta) ==parseInt(total)){
                $("#prox_fecha_"+pqt_id+"_"+prov_id).attr("disabled", true);
            }
            else{
                $("#prox_fecha_"+pqt_id+"_"+prov_id).attr("disabled", false);
            }
            $('#saldo_'+pqt_id+'_'+prov_id).html(total-acuenta);
        }
        function verificar_precio_fecha(total,acuenta,fecha_serv,prox_fecha,pqt_id,prov_id){
            if(parseInt(acuenta)>parseInt(total)){
                $('#a_pagar_'+pqt_id+'_'+prov_id).val(total);
                $('#saldo_'+pqt_id+'_'+prov_id).html('0');
                $('#a_pagar_'+pqt_id+'_'+prov_id).css("border-bottom","");
            }
            else if(parseInt(acuenta)<=parseInt(total)){
//                guardamos, con saldo
                if(parseInt(acuenta)<parseInt(total)){
                    if (prox_fecha.length == 0 ){
                        swal(
                            'MENSAJE DEL SISTEMA',
                            'Ingrese la proxima fecha de pago',
                            'warning'
                        )
                        $('#prox_fecha_'+pqt_id+'_'+prov_id).css("border-bottom", "2px solid #FF0000");
                    }
                    else{
                        var datos = {
                            "tipo" : 'pago_con_saldo',
                            "pqt_id" : pqt_id,
                            "prov_id" : prov_id,
                            "total" : total,
                            "acuenta" : acuenta,
                            "fecha_serv" : fecha_serv,
                            "prox_fecha" : prox_fecha,
                            "medio" : $('#medio_'+pqt_id+'_'+prov_id).val(),
                            "cuenta" : $('#cuenta_'+pqt_id+'_'+prov_id).val(),
                            "transaccion" : $('#transaccion_'+pqt_id+'_'+prov_id).val(),
                        };
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('[name="_token"]').val()
                            }
                        });
                        $.ajax({
                            data:  datos,
                            url:   "{{route('pagar_a_cuenta_c_path')}}",
                            type:  'post',
                            beforeSend: function () {

                                $('#btn_load_'+pqt_id+'_'+prov_id).removeClass('hide');
                            },
                            success:  function (response) {
                                pagos_hotel_id=response;
                                console.log('pagos_hotel_id:'+pagos_hotel_id);
                                $('#btn_guardar_'+pqt_id+'_'+prov_id).addClass('hide');
                                $('#btn_load_'+pqt_id+'_'+prov_id).addClass('hide');
                                $('#btn_editar_'+pqt_id+'_'+prov_id).removeClass('hide');
                                $('#btn_chck_'+pqt_id+'_'+prov_id).removeClass('hide');
                            }
                        });
                    }
                }
//                guardamos sin salgo
                else if(parseInt(acuenta)<=parseInt(total)){
                    var datos = {
                        "tipo" : 'pago_total',
                        "pqt_id" : pqt_id,
                        "prov_id" : prov_id,
                        "acuenta" : acuenta,
                        "fecha_serv" : fecha_serv,
                        "medio" : $('#medio_'+pqt_id+'_'+prov_id).val(),
                        "cuenta" : $('#cuenta_'+pqt_id+'_'+prov_id).val(),
                        "transaccion" : $('#transaccion_'+pqt_id+'_'+prov_id).val(),
                    };
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('[name="_token"]').val()
                        }
                    });
                    $.ajax({
                        data:  datos,
                        url:   "{{route('pagar_a_cuenta_c_path')}}",
                        type:  'post',
                        beforeSend: function () {

                            $('#btn_load_'+pqt_id+'_'+prov_id).removeClass('hide');
                        },
                        success:  function (response) {
                            pagos_hotel_id=response;
                            $('#btn_guardar_'+pqt_id+'_'+prov_id).addClass('hide');
                            $('#btn_load_'+pqt_id+'_'+prov_id).addClass('hide');
                            $('#btn_editar_'+pqt_id+'_'+prov_id).removeClass('hide');
                            $('#btn_chck_'+pqt_id+'_'+prov_id).removeClass('hide');
                        }
                    });
                }
            }
        }
        function verificar_fecha(total,acuenta,fecha,pqt_id,prov_id){
            if(parseInt(acuenta)<parseInt(total)){
                if (fecha.length == 0 ){
                    $('#prox_fecha_'+pqt_id+'_'+prov_id).css("border-bottom", "2px solid #FF0000");
                }
                else{
                    $('#prox_fecha_'+pqt_id+'_'+prov_id).css("border-bottom", "");
                }
            }
        }
        function verificar_precio_fecha_editar(total,acuenta,fecha_serv,prox_fecha,pqt_id,prov_id){
            if(parseInt(acuenta)>parseInt(total)){
                $('#a_pagar_'+pqt_id+'_'+prov_id).val(total);
                $('#saldo_'+pqt_id+'_'+prov_id).html(0);
                $('#a_pagar_'+pqt_id+'_'+prov_id).css("border-bottom","");
            }
            else if(parseInt(acuenta)<=parseInt(total)){
//                guardamos, con saldo
                if(parseInt(acuenta)<parseInt(total)){
                    if (prox_fecha.length == 0 ){
                        swal(
                            'MENSAJE DEL SISTEMA',
                            'Ingrese la proxima fecha de pago',
                            'warning'
                        )
                        $('#prox_fecha_'+pqt_id+'_'+prov_id).css("border-bottom", "2px solid #FF0000");
                    }
                    else{
                        var datos = {
                            "pagos_hotel_id" : pagos_hotel_id,
                            "tipo" : 'pago_con_saldo',
                            "pqt_id" : pqt_id,
                            "prov_id" : prov_id,
                            "total" : total,
                            "acuenta" : acuenta,
                            "fecha_serv" : fecha_serv,
                            "prox_fecha" : prox_fecha,
                            "medio" : $('#medio_'+pqt_id+'_'+prov_id).val(),
                            "cuenta" : $('#cuenta_'+pqt_id+'_'+prov_id).val(),
                            "transaccion" : $('#transaccion_'+pqt_id+'_'+prov_id).val(),
                        };
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('[name="_token"]').val()
                            }
                        });
                        $.ajax({
                            data:  datos,
                            url:   "{{route('pagar_a_cuenta_c_editar_path')}}",
                            type:  'post',
                            beforeSend: function () {
                                $('#btn_load_'+pqt_id+'_'+prov_id).removeClass('hide');
                            },
                            success:  function (response) {
                                pagos_hotel_id=response;
                                $('#btn_guardar_'+pqt_id+'_'+prov_id).addClass('hide');
                                $('#btn_load_'+pqt_id+'_'+prov_id).addClass('hide');
                                $('#btn_editar_'+pqt_id+'_'+prov_id).removeClass('hide');
                                $('#btn_chck_'+pqt_id+'_'+prov_id).removeClass('hide');
                            }
                        });
                    }
                }
//                guardamos sin salgo
                else if(parseInt(acuenta)<=parseInt(total)){
                    var datos = {
                        "pagos_hotel_id" : pagos_hotel_id,
                        "tipo" : 'pago_total',
                        "pqt_id" : pqt_id,
                        "prov_id" : prov_id,
                        "acuenta" : acuenta,
                        "fecha_serv" : fecha_serv,
                        "medio" : $('#medio_'+pqt_id+'_'+prov_id).val(),
                        "cuenta" : $('#cuenta_'+pqt_id+'_'+prov_id).val(),
                        "transaccion" : $('#transaccion_'+pqt_id+'_'+prov_id).val(),
                    };
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('[name="_token"]').val()
                        }
                    });
                    $.ajax({
                        data:  datos,
                        url:   "{{route('pagar_a_cuenta_c_editar_path')}}",
                        type:  'post',
                        beforeSend: function () {
                            $('#btn_load_'+pqt_id+'_'+prov_id).removeClass('hide');
                        },
                        success:  function (response) {
                            pagos_hotel_id=response;
                            $('#btn_guardar_'+pqt_id+'_'+prov_id).addClass('hide');
                            $('#btn_load_'+pqt_id+'_'+prov_id).addClass('hide');
                            $('#btn_editar_'+pqt_id+'_'+prov_id).removeClass('hide');
                            $('#btn_chck_'+pqt_id+'_'+prov_id).removeClass('hide');
                        }
                    });
                }
            }
        }
        function guardarConsulta() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('[name="_token"]').val()
                }
            });

            $("#btn_guardar").attr("disabled", true);
            var codigos = document.getElementsByName('codigos[]');
            var $codigos = "";
            for (var i = 0, l = codigos.length; i < l; i++) {
                $codigos += codigos[i].value+',';
            }

            codigos = $codigos.substring(0,$codigos.length-1);


            if (codigos.length == 0 ){
                // $('#f_date').css("border-bottom", "2px solid #FF0000");
                var sendCon = "false";
            }else{
                sendCon = "true"
            }

            if(sendCon == "true"){
                var datos = {
                    "txt_codigos" : codigos
                };
                $.ajax({
                    data:  datos,
                    url:   "{{route('consulta_hotel_save_path')}}",
                    type:  'post',
                    beforeSend: function () {
                        $('#btn_guardar').addClass('hide');
                        $('#btn_load').removeClass('hide');
                    },
                    success:  function (response) {
                        // $('#d_form')[0].reset();
                        $('#btn_load').addClass('hide');
                        $('#btn_check').removeClass('hide');
                        // $('#i_save').removeClass('hide');
                    }
                });
            } else{
                $("#btn_guardar").removeAttr("disabled");
            }


        }
    </script>
@stop