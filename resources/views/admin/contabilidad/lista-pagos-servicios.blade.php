@extends('layouts.admin.contabilidad')
@section('content')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <div class="row margin-top-40">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Contabilidad</li>
            <li>Servicios</li>
            <li class="active">Listar por fechas</li>
        </ol>
    </div>
    @php
        $pagar_con='';
        $medio_pago='';
        $cta_cliente='';
        $a_pagar='';
    @endphp
    @if($ids == 0)
        @foreach($consulta as $consultas)
            @php
                $ids = explode(',', $consultas->codigos);
                $pagar_con=explode(',', $consultas->pagar_con);
                $medio_pago=explode(',', $consultas->medio_pago);
                $cta_cliente=explode('+.+', $consultas->cta_cliente);
                $a_pagar=explode(',', $consultas->a_pagar);
            @endphp
        @endforeach
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-right @if($codigos > 0) d-none @else show @endif">
                        <form id="frm_guardar_{{$grupo}}" name="frm_guardar_{{$grupo}}" action="{{route('consulta_serv_save_path')}}" method="post" enctype="multipart/form-data">
                            @foreach($ids as $id)
                                <input type="hidden" id="p_codigos" name="codigos[]" value="{{$id}}">
                            @endforeach
                            {{csrf_field()}}
                            <input type="hidden" name="grupo" value="{{$grupo}}">
                            <button class="btn btn-success text-right" type="submit">Guardar Consulta</button>
                            <i class="fa fa-spinner fa-pulse fa-3x fa-fw d-none" id="btn_load"></i>
                            <span class="sr-only">Loading...</span>
                            <i class="fa fa-check fa-3x text-success d-none" id="btn_check"></i>
                        </form>
                    </div>
                    <div class="row">
                        <div class="col table-responsive">
                            <table class="table table-condensed table-bordered margin-top-20 table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-15 text-grey-goto ">Cotización</th>
                                        <th class="text-15 text-grey-goto ">Pagar con</th>
                                        <th class="text-15 text-grey-goto text-center">Medio Pago</th>
                                        <th class="text-15 text-grey-goto text-center">#CB/CCI</th>
                                        <th class="text-15 text-grey-goto text-center">Total</th>
                                        <th class="text-15 text-grey-goto text-center">Pagado</th>
                                        <th class="text-15 text-grey-goto text-center" width="110px">a pagar</th>
                                        <th class="text-15 text-grey-goto text-center">Saldo</th>
                                        <th class="text-15 text-grey-goto text-center">Prox. fecha</th>
                                        <th class="text-15 text-grey-goto text-center">Transaccion</th>
                                        <th class="text-15 text-grey-goto text-center">Operaciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                    $pos=-1;
                                @endphp
                                @foreach($ids as $listado)
                                    @php
                                        $pos++;
                                        $listado_=explode('(_)',$listado);
                                        $pagado=$pagos->where('paquete_cotizaciones_id',$listado_[0])->where('proveedor_id',$listado_[1])->where('estado','1')->sum('a_cuenta');
                                    @endphp
                                    <tr>
                                        <td class="text-12 text-grey-goto">{!! $listado_[4] !!} | <b class="text-unset">{{$listado_[5]}}</b></td>
                                        <td class="text-12 text-grey-goto">
                                            <select form="frm_guardar_{{$grupo}}" type="text" class="form-control" id="pargarcon_{{$listado_[0]}}_{{$listado_[1]}}[]" name="pagar_con[]" onchange="mostrar_banco_proveedor($(this).val(),'{{$listado_[0]}}','{{$listado_[1]}}','{{$grupo}}')">
                                                <option value="0">Escoja un banco</option>
                                                @foreach($cuentas_goto as $cuenta_goto)
                                                    @php
                                                        $banco='';
                                                    @endphp
                                                    @foreach($entidad_bancaria->where('id',$cuenta_goto->entidad_bancaria_id) as $banco_)
                                                        @php
                                                            $banco=$banco_->nombre;
                                                        @endphp
                                                    @endforeach
                                                    <option value="{{$cuenta_goto->id}}_{{$cuenta_goto->entidad_bancaria_id}}" @if($pagar_con!='') @if($cuenta_goto->id.'_'.$cuenta_goto->entidad_bancaria_id==$pagar_con[$pos]) {{'selected'}}@endif @endif>{{$banco}} [{{$cuenta_goto->banco_nro_cta}}]</option>

                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="text-12 text-grey-goto">
                                            <select form="frm_guardar_{{$grupo}}" type="text" class="form-control" name="medio_pago[]" id="medio_{{$listado_[0]}}_{{$listado_[1]}}" @if($pagado==$listado_[2]) disabled @endif>
                                                <option value="TRANSFERENCIA" @if($medio_pago!='') @if('TRANSFERENCIA'==$medio_pago[$pos]) {{'selected'}}@endif @endif>TRANSFER.</option>
                                                <option value="CHEQUE" @if($medio_pago!='') @if('CHEQUE'==$medio_pago[$pos]) {{'selected'}}@endif @endif>CHEQUE</option>
                                                <option value="EFECTIVO" @if($medio_pago!='') @if('EFECTIVO'==$medio_pago[$pos]) {{'selected'}}@endif @endif>EFECTIVO</option>
                                            </select>
                                        </td>
                                        <td class="text-13 text-grey-goto">
                                            <span id="cb_cci_{{$listado_[0]}}_{{$listado_[1]}}">
                                                <input form="frm_guardar_{{$grupo}}" type="text" class="form-control" name="cta_cliente[]" id="cta_{{$listado_[0]}}_{{$listado_[1]}}" value="@if($cta_cliente!='') {{$cta_cliente[$pos]}} @endif">
                                            </span>
                                        </td>
{{--                                        <td class="text-13 text-grey-goto"><input type="text" class="form-control" id="cuenta_{{$listado_[0]}}_{{$listado_[1]}}" @if($pagado==$listado_[2]) disabled @endif></td>--}}
                                        <td class="text-13 text-grey-goto"><b>{{$listado_[2]}}<sub><small>$</small></sub></b></td>
                                        <td class="text-13 text-grey-goto"><b>{{$pagado}}<sub><small>$</small></sub></b></td>
                                        {{--<td class="text-13 text-grey-goto col-lg-1"><input type="text" class="form-control" value="{{$listado_[2]-$pagado}}" id="a_pagar_{{$listado_[0]}}_{{$listado_[1]}}" onkeyup="calcular_saldo('{{$listado_[2] - $pagado}}',$('#a_pagar_{{$listado_[0]}}_{{$listado_[1]}}').val(),$('#prox_fecha_{{$listado_[0]}}_{{$listado_[1]}}').val(),'{{$listado_[0]}}','{{$listado_[1]}}')" @if($pagado==$listado_[2]) disabled @endif></td>--}}
                                        <td class="text-13 text-grey-goto">
                                            <input form="frm_guardar_{{$grupo}}" type="text" step="0.01" min="0" class="form-control" value="@if($a_pagar!=''){{$a_pagar[$pos]}}@else{{$listado_[2]-$pagado}}@endif" name="a_pagar[]" id="a_pagar_{{$listado_[0]}}_{{$listado_[1]}}" onkeyup="calcular_saldo('{{$listado_[2] - $pagado}}',$('#a_pagar_{{$listado_[0]}}_{{$listado_[1]}}').val(),$('#prox_fecha_{{$listado_[0]}}_{{$listado_[1]}}').val(),'{{$listado_[0]}}','{{$listado_[1]}}')" @if($pagado==$listado_[2]) disabled @endif>
                                        </td>
                                        <td class="text-13 text-grey-goto"><b><span id="saldo_{{$listado_[0]}}_{{$listado_[1]}}">@if($a_pagar!=''){{$listado_[2]-$a_pagar[$pos]}}@else {{0}} @endif</span><sub><small>$</small></sub></b></td>
                                        <td class="text-13 text-grey-goto"><input type="date" id="prox_fecha_{{$listado_[0]}}_{{$listado_[1]}}" class="form-control" onchange="verificar_fecha('{{$listado_[2]}}',$('#a_pagar_{{$listado_[0]}}_{{$listado_[1]}}').val(),$('#prox_fecha_{{$listado_[0]}}_{{$listado_[1]}}').val(),'{{$listado_[0]}}','{{$listado_[1]}}')" @if($pagado==$listado_[2]) disabled @endif></td>
                                        <td class="text-13 text-grey-goto"><input form="frm_guardar_{{$grupo}}" type="text" class="form-control" id="transaccion_{{$listado_[0]}}_{{$listado_[1]}}" @if($pagado==$listado_[2]) disabled @endif></td>
                                        <td class="text-13 text-grey-goto">
                                            @if($pagado==$listado_[2])
                                                <button class="btn btn-danger" id="btn_guardar_{{$listado_[0]}}_{{$listado_[1]}}">Pago realizado</button>
                                            @else
                                            <button class="btn btn-primary" id="btn_guardar_{{$listado_[0]}}_{{$listado_[1]}}" onclick="verificar_precio_fecha('{{$listado_[2]-$pagado}}',$('#a_pagar_{{$listado_[0]}}_{{$listado_[1]}}').val(),'{{$listado_[6]}}',$('#prox_fecha_{{$listado_[0]}}_{{$listado_[1]}}').val(),'{{$listado_[0]}}','{{$listado_[1]}}')">Guardar</button>
                                            <i class="fa fa-spinner fa-pulse text-18 fa-fw d-none" id="btn_load_{{$listado_[0]}}_{{$listado_[1]}}"></i>
                                            <button class="btn btn-warning d-none" id="btn_editar_{{$listado_[0]}}_{{$listado_[1]}}" onclick="verificar_precio_fecha_editar('{{$listado_[2]-$listado_[2]}}',$('#a_pagar_{{$listado_[0]}}_{{$listado_[1]}}').val(),'{{$listado_[6]}}',$('#prox_fecha_{{$listado_[0]}}_{{$listado_[1]}}').val(),'{{$listado_[0]}}','{{$listado_[1]}}')">Editar</button>
                                            <i class="fa fa-check text-success fa-2x d-none" id="btn_chck_{{$listado_[0]}}_{{$listado_[1]}}"></i>
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
                                                            <form id="form_{{$listado[0]}}_{{$listado[1]}}" action="{{route('guardar_imagen_pago_serv_path')}}">
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
                var url = "{{route('guardar_imagen_pago_serv_path')}}";
                $.ajax({
                    url: url,
                    type: "POST",
                    dataType: 'json',
                    contentType: false,
                    data: data,
                    processData: false,
                    cache: false
                }).done(function (respuesta) {
                    if(respuesta=='1'){
                        swal(
                            'MENSAJE DEL SISTEMA',
                            'Imagen guardada correctamente',
                            'success'
                        )
                    }
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
//            if(validarSiNumero(acuenta)){
                if(parseInt(acuenta) >parseInt(total)){
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
                $('#saldo_'+pqt_id+'_'+prov_id).html(Math.round((total-acuenta) * 100) / 100);
//            }
//            else{
//                console.log('no numero:'+acuenta);
//            }
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
                            "grupo" : "{{$grupo}}",
                        };
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('[name="_token"]').val()
                            }
                        });
                        $.ajax({
                            data:  datos,
                            url:   "{{route('pagar_a_cuenta_c_serv_path')}}",
                            type:  'post',
                            beforeSend: function () {

                                $('#btn_load_'+pqt_id+'_'+prov_id).removeClass('d-none');
                            },
                            success:  function (response) {
                                pagos_hotel_id=response;
                                $('#btn_guardar_'+pqt_id+'_'+prov_id).addClass('d-none');
                                $('#btn_load_'+pqt_id+'_'+prov_id).addClass('d-none');
                                $('#btn_editar_'+pqt_id+'_'+prov_id).removeClass('d-none');
                                $('#btn_chck_'+pqt_id+'_'+prov_id).removeClass('d-none');
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
                        "grupo" : "{{$grupo}}",
                    };
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('[name="_token"]').val()
                        }
                    });
                    $.ajax({
                        data:  datos,
                        url:   "{{route('pagar_a_cuenta_c_serv_path')}}",
                        type:  'post',
                        beforeSend: function () {

                            $('#btn_load_'+pqt_id+'_'+prov_id).removeClass('d-none');
                        },
                        success:  function (response) {
                            pagos_hotel_id=response;
                            $('#btn_guardar_'+pqt_id+'_'+prov_id).addClass('d-none');
                            $('#btn_load_'+pqt_id+'_'+prov_id).addClass('d-none');
                            $('#btn_editar_'+pqt_id+'_'+prov_id).removeClass('d-none');
                            $('#btn_chck_'+pqt_id+'_'+prov_id).removeClass('d-none');
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
                            "grupo" : "{{$grupo}}",
                        };
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('[name="_token"]').val()
                            }
                        });
                        $.ajax({
                            data:  datos,
                            url:   "{{route('pagar_a_cuenta_c_serv_editar_path')}}",
                            type:  'post',
                            beforeSend: function () {
                                $('#btn_load_'+pqt_id+'_'+prov_id).removeClass('d-none');
                            },
                            success:  function (response) {
                                pagos_hotel_id=response;
                                $('#btn_guardar_'+pqt_id+'_'+prov_id).addClass('d-none');
                                $('#btn_load_'+pqt_id+'_'+prov_id).addClass('d-none');
                                $('#btn_editar_'+pqt_id+'_'+prov_id).removeClass('d-none');
                                $('#btn_chck_'+pqt_id+'_'+prov_id).removeClass('d-none');
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
                        "grupo" : "{{$grupo}}",
                    };
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('[name="_token"]').val()
                        }
                    });
                    $.ajax({
                        data:  datos,
                        url:   "{{route('pagar_a_cuenta_c_serv_editar_path')}}",
                        type:  'post',
                        beforeSend: function () {
                            $('#btn_load_'+pqt_id+'_'+prov_id).removeClass('d-none');
                        },
                        success:  function (response) {
                            pagos_hotel_id=response;
                            $('#btn_guardar_'+pqt_id+'_'+prov_id).addClass('d-none');
                            $('#btn_load_'+pqt_id+'_'+prov_id).addClass('d-none');
                            $('#btn_editar_'+pqt_id+'_'+prov_id).removeClass('d-none');
                            $('#btn_chck_'+pqt_id+'_'+prov_id).removeClass('d-none');
                        }
                    });
                }
            }
        }
        function guardarConsulta(grupo) {
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
                    "txt_codigos" : codigos,
                    "grupo":grupo
                };
                $.ajax({
                    data:  datos,
                    url:   "{{route('consulta_serv_save_path')}}",
                    type:  'post',
                    beforeSend: function () {
                        $('#btn_guardar').addClass('d-none');
                        $('#btn_load').removeClass('d-none');
                    },
                    success:  function (response) {
                        // $('#d_form')[0].reset();
                        $('#btn_load').addClass('d-none');
                        $('#btn_check').removeClass('d-none');
                        // $('#i_save').removeClass('d-none');
                    }
                });
            } else{
                $("#btn_guardar").removeAttr("disabled");
            }


        }
    </script>
@stop