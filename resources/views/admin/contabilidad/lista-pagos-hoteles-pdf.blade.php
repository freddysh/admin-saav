@extends('layouts.quotes_pdf')
@section('content')
    @php
    function fecha_peru($fecha_){
        $f1=explode(' ',$fecha_);
        $hora=$f1[1];
        $f2=explode('-',$f1[0]);
        $fecha1=$f2[2].'-'.$f2[1].'-'.$f2[0];
        return $fecha1.' a las '.$hora;
    }
        $pagar_con='';
        $medio_pago='';
        $cta_cliente='';
        $a_pagar='';
        $fecha='';
    @endphp
    @if($ids == 0)
        @foreach($consulta as $consultas)
            @php
                $ids = explode(',', $consultas->codigos);
                $pagar_con=explode(',', $consultas->pagar_con);
                $medio_pago=explode(',', $consultas->medio_pago);
                $cta_cliente=explode('+.+', $consultas->cta_cliente);
                $a_pagar=explode(',', $consultas->a_pagar);
                $fecha=$consultas->created_at;
            @endphp
        @endforeach
    @endif
    <div class="row">
        <div class="col-md-12 text-center">
            <b class="text-20">LISTADO PARA PAGOS A HOTELES</b><br>
            <b>Fecha consulta: {{fecha_peru($fecha)}}</b>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 table-responsive">
                            <table class="table table-condensed table-bordered margin-top-20 table-hover">
                                <thead>
                                <tr class="bg-primary">
                                    <th class="text-15 text-grey-goto text-center">Cotización</th>
                                    <th class="text-15 text-grey-goto text-center">Pagar con</th>
                                    <th class="text-15 text-grey-goto text-center">Medio Pago</th>
                                    <th class="text-15 text-grey-goto text-center">#CB/CCI</th>
                                    <th class="text-15 text-grey-goto text-center">Total</th>
                                    <th class="text-15 text-grey-goto text-center">Pagado</th>
                                    <th class="text-15 text-grey-goto text-center">a pagar</th>
                                    <th class="text-15 text-grey-goto text-center">Saldo</th>
                                    <th class="text-15 text-grey-goto text-center">Transferencia</th>
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
                                        <td class="text-13 text-grey-goto">{{$listado_[4]}} <span class="text-primary">({{$listado_[5]}})</span></td>
                                        <td class="text-12 text-grey-goto ">
                                        @foreach($cuentas_goto as $cuenta_goto)
                                            @php
                                                $banco='';
                                            @endphp
                                            @foreach($entidad_bancaria->where('id',$cuenta_goto->entidad_bancaria_id) as $banco_)
                                                @php
                                                    $banco=$banco_->nombre;
                                                @endphp
                                            @endforeach

                                            @if($cuenta_goto->id.'_'.$cuenta_goto->entidad_bancaria_id==$pagar_con[$pos])
                                                {{$banco}} [{{$cuenta_goto->banco_nro_cta}}]
                                            @endif
                                        @endforeach
                                        </td>
                                        <td class="text-12 text-grey-goto ">
                                            @if($medio_pago!='') {{$medio_pago[$pos]}} @endif
                                        </td>
                                        <td class="text-13 text-grey-goto ">
                                            <span id="cb_cci_{{$listado_[0]}}_{{$listado_[1]}}">
                                                @if($cta_cliente!='') {{$cta_cliente[$pos]}} @endif
                                            </span>
                                        </td>
                                        <td class="text-13 text-grey-goto text-center"><b>{{$listado_[2]}}<sub><small>$</small></sub></b></td>
                                        <td class="text-13 text-grey-goto text-center"><b>{{$pagado}}<sub><small>$</small></sub></b></td>
                                        <td class="text-13 text-grey-goto text-center">
                                            <b>@if($a_pagar!='') {{$a_pagar[$pos]}}@endif<sub><small>$</small></sub></b>
                                        </td>
                                        <td class="text-13 text-grey-goto text-center"><b><span id="saldo_{{$listado_[0]}}_{{$listado_[1]}}">@if($a_pagar!=''){{$listado_[2]-$a_pagar[$pos]}}@else {{$listado_[2]}} @endif</span><sub><small>$</small></sub></b></td>
                                        <td></td>
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

                                $('#btn_load_'+pqt_id+'_'+prov_id).removeClass('d-none');
                            },
                            success:  function (response) {
                                pagos_hotel_id=response;
                                console.log('pagos_hotel_id:'+pagos_hotel_id);
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
        function guardarConsulta() {
//            $.ajaxSetup({
//                headers: {
//                    'X-CSRF-TOKEN': $('[name="_token"]').val()
//                }
//            });

//            $("#btn_guardar").attr("disabled", true);
//            var codigos = document.getElementsByName('codigos[]');
//            var pagar_con= document.getElementsByName('pagar_con').value;

//            console.log('pagar_con:'+pagar_con);
//            var medio_pago= document.getElementsByName('medio_pago[]');
//            var cta_cliente= document.getElementsByName('cta_cliente[]');
//            var a_pagar= document.getElementsByName('a_pagar[]');


            {{--var $codigos = "";--}}
            {{--for (var i = 0, l = codigos.length; i < l; i++) {--}}
                {{--$codigos += codigos[i].value+',';--}}
            {{--}--}}

            {{--codigos = $codigos.substring(0,$codigos.length-1);--}}


            {{--if (codigos.length == 0 ){--}}
                {{--// $('#f_date').css("border-bottom", "2px solid #FF0000");--}}
                var sendCon = "false";
            {{--}else{--}}
                sendCon = "true"
            {{--}--}}

            if(sendCon == "true"){
//                var datos = {
//                    "txt_codigos" : codigos,
//                    "txt_pagar_con" : pagar_con,
////                    "txt_medio_pago" : medio_pago,
////                    "txt_cta_cliente" : cta_cliente,
////                    "txt_a_pagar" : a_pagar,
//
//                };
                $.ajax({
                    data: $('#frm_guardar').serialize(),
                    url:   $('#frm_guardar').attr('action'),
                    type: $('#frm_guardar').attr('method'),
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
            }else{
                $("#btn_guardar").removeAttr("disabled");
            }


        }
    </script>
@stop