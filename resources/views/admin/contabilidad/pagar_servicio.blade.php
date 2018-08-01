@extends('layouts.admin.contabilidad')
@section('content')
    <div class="row margin-top-40">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Contabilidad</li>
            <li class="active">Reservas confirmadas</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            @foreach($cotizacion as $cotizaciones)
                                @foreach($cotizaciones->cotizaciones_cliente as $clientes)
                                    <h2 class="panel-title pull-left" style="font-size:30px;">{{$clientes->cliente->nombres}} {{$clientes->cliente->apellidos}} x {{$cotizaciones->nropersonas}} {{date_format(date_create($cotizaciones->fecha), ' l jS F Y')}}</h2>
                                    <b class="text-warning padding-left-10"> (X{{$cotizaciones->nropersonas}})</b>
                                @endforeach
                            @endforeach

                            <i class="fa fa-check text-success" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Hidalgo esta activo"></i>
                            <div class="dropdown pull-right">
                                <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Opciones
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <li><a href="?page=update"><i class="fa fa-fw fa-database" aria-hidden="true"></i> Actualizar Datos</a></li>
                                    <li><a href="#"><i class="fa fa-fw fa-check" aria-hidden="true"></i> Friends</a></li>
                                    <li><a href="#">Work</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#"><i class="fa fa-fw fa-plus" aria-hidden="true"></i> Add a new aspect</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-12 margin-top-20">
                            <div class="progress">

                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                    Datos del pasajero 60%
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <span class="pull-left pax-nav">
                                <b>Travel date: no se</b>
                            </span>
                            <span class="pull-right">
                                 <a href="#" class="btn btn-link" style="text-decoration:none;"><i class="fa fa-lg fa-ban" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Ignore"></i></a>
                            </span>
                        </div>


                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4 class="text-right">
                        <a href="#" style="text-decoration:none;">
                            <span class="display-block margin-bottom-10"><button class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> </button> <button class="btn btn-info"><i class="fa fa-mail-forward"></i> </button></span>
                            {{--<strong class="text-warning text-25">Cusco Catedral</strong>--}}
                        </a>
                    </h4>
                    <hr>


                    <div class="col-lg-12">
                        <section class="detalle-pagos">
                            <div class="col-lg-12 titulo-goto clearfix">
                                <h4 class="text-right titulo"><b>GOTOPERU</b></h4>
                            </div>
                            <div class="col-lg-12">
                                <h4 class="text-center titulo"><b>DETALLE DE PAGO</b></h4>
                            </div>
                            <div class="col-lg-12">
                                <div class="codigo">
                                    <b>GOTOID</b>
                                    005
                                    <div class="fecha pull-right"><b><?php echo date("Y-m-d h:i") ?></b></div>
                                </div>
                                <hr>
                            </div>
                            <div class="col-lg-12">
                                @foreach($servicio as $servicios)
                                    <div class="nombres"><b>PROVEEDOR:</b> {{$servicios->itinerario_proveedor->nombre}}</div>
                                    <div class="nombres"><b>RUC:</b> {{$servicios->itinerario_proveedor->codigo}}</div>
                                    <div class="nacionalidad"><b>DIRECCION:</b> {{$servicios->itinerario_proveedor->razon_social}}</div>
                                @endforeach
                            </div>
                            <div class="col-lg-12 margin-top-10">
                                {{--<button class="btn btn-warning btn-sm">Pagar</button> <button class="btn btn-warning btn-sm"></button>--}}
                                <table class="table table-striped table-bordered table-hover table-condensed">
                                    {{--<caption>Detalle de pagos realizados und = unidad, Cod: codigo del paquete, Precio = precio total del paquete, Total = Pagos realizados por el cliente</caption>--}}
                                    <thead>
                                    <tr>
                                        {{--<th>Codigo</th>--}}
                                        {{--<th>Und</th>--}}
                                        <th>Concepto</th>
                                        <th>Medio Pago</th>
                                        <th>Transaccion</th>
                                        <th>Fecha Pago</th>
                                        <th>Pagos</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {{--<tr>--}}
                                        {{--<td>{{$servicios->pagos->id}}</td>--}}
                                        {{--<td><input type="text" class="form-control input-sm"></td>--}}
                                        {{--<td><input type="text" class="form-control input-sm"></td>--}}
                                        {{--<td><input type="date" class="form-control input-sm text-right" value=""></td>--}}
                                        {{--<td><input type="text" class="form-control input-sm text-right" value=""></td>--}}
                                        {{--<td class="text-center"><button class="btn btn-sm btn-success display-block"><i>Pagar</i></button></td>--}}
                                    {{--</tr>--}}

                                    @php $total=0; @endphp
                                    @foreach($servicio as $servicios)
                                        @if($servicios->pagos->count()>0)
                                            @foreach($servicios->pagos as $pagos)
                                                @php
                                                    $total = $total + $pagos->a_cuenta

                                                @endphp


                                                @if($pagos->estado == 1)
                                                    <tr>
                                                        {{--<td>0545</td>--}}
                                                        {{--<td>1</td>--}}
                                                        <td>{{ucwords(strtolower($servicios->nombre))}}</td>
                                                        <td>{{$pagos->medio}}</td>
                                                        <td>{{$pagos->transaccion}}</td>
                                                        <td>{{$pagos->updated_at}}</td>
                                                        <td class='text-right'>{{$pagos->a_cuenta}}</td>
                                                        <td class="text-center"><i class="fa fa-check text-primary"></i></td>
                                                    </tr>
                                                @elseif($pagos->estado == 0 AND ($pagos->fecha_a_pagar=="" OR $pagos->fecha_a_pagar==NULL))
                                                    <tr>
                                                        <td>{{ucwords(strtolower($servicios->nombre))}}</td>
                                                        <td>{{$pagos->medio}}</td>
                                                        <td>{{$pagos->transaccion}}</td>
                                                        <td>{{$pagos->updated_at}}</td>
                                                        <td class="has-error"><input type="date" class="form-control input-sm"></td>
                                                        <td><input type="text" class="form-control input-sm text-right" value="{{$servicios->precio_c - $total}}"></td>
                                                        <td class="text-center"><button class="btn btn-sm btn-warning display-block"><i>Save</i></button></td>
                                                    </tr>
                                                @elseif($pagos->estado == 0 AND isset($pagos->fecha_a_pagar))
                                                    <tr>
                                                        <td>{{ucwords(strtolower($servicios->nombre))}}</td>
                                                        <td><input type="text" class="form-control input-sm" id="p_medio"></td>
                                                        <td><input type="text" class="form-control input-sm" id="p_transaccion"></td>
                                                        <td><input type="date" class="form-control input-sm text-right" value="{{$pagos->fecha_a_pagar}}" id="p_fecha"></td>
                                                        <td><input type="text" class="form-control input-sm text-right" value="{{$pagos->a_cuenta}}" id="p_pago" onkeyup="fecha_pago($('#p_pago').val(), {{$servicios->precio_c}}, {{$pagos->a_cuenta}})"></td>
                                                        <td class="text-center">
                                                            <button class="btn btn-sm btn-success display-block" id="btn_pago" onclick="pagar_proveedor({{$servicios->id}},{{$idcotizacion}},$('#p_medio').val(), $('#p_transaccion').val(), $('#p_fecha').val(), $('#p_pago').val(), {{$servicios->precio_c}},{{$total}}, {{$pagos->id}}, {{$pagos->a_cuenta}})"><i>Pagar</i></button>
                                                            <i class="fa fa-check text-primary hide" id="f_check"></i>
                                                            <i class="fa fa-spinner fa-pulse text-18 fa-fw hide" id="btn_load"></i>
                                                            <span class="sr-only">Loading...</span>
                                                        </td>
                                                    </tr>

                                                    <tr class="hide" id="i_save">
                                                        <td>{{ucwords(strtolower($servicios->nombre))}}</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td class="has-error"><input type="date" class="form-control input-sm text-right" id="f_date"></td>
                                                        <td><input type="text" class="form-control input-sm text-right" id="f_pago" value="0" readonly="readonly"></td>
                                                        <td class="text-center">
                                                            <button class="btn btn-sm btn-warning display-block" id="f_btnpago" onclick="pagar_acuenta({{$servicios->id}},{{$idcotizacion}},$('#f_pago').val(),$('#f_date').val())"><i>Save</i></button>

                                                            <i class="fa fa-check text-primary hide" id="f_btncheck"></i>
                                                            <i class="fa fa-spinner fa-pulse text-18 fa-fw hide" id="f_btnload"></i>
                                                            <span class="sr-only">Loading...</span>

                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="3"></td>
                                                        <td class="list-style-none">
                                                            {{--<li><b>TOTAL</b></li>--}}
                                                            <li><b>PRECIO SERVICIO</b></li>
                                                            <li><b>TOTAL DEUDA</b></li>
                                                        </td>
                                                        <td class='text-right list-style-none'>

                                                            {{--<li><b>{{$total}}</b></li>--}}
                                                            <li>{{$servicios->precio_c}}</li>
                                                            <li><b id="f_deuda">{{$pagos->a_cuenta}}</b></li>
                                                        </td>
                                                    </tr>

                                                @endif

                                            @endforeach
                                        @else
                                            <tr>
                                                <td>{{ucwords(strtolower($servicios->nombre))}}</td>
                                                <td><input type="text" class="form-control input-sm" id="p_medio"></td>
                                                <td><input type="text" class="form-control input-sm" id="p_transaccion"></td>
                                                <td><input type="date" class="form-control input-sm text-right" id="p_fecha"></td>
                                                <td><input type="text" class="form-control input-sm text-right" id="p_pago" value="{{$servicios->precio_c}}" onkeyup="fecha_pago($('#p_pago').val(), {{$servicios->precio_c}}, {{$total}})"></td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-success display-block" id="btn_pago" onclick="pagar_proveedor({{$servicios->id}},{{$idcotizacion}},$('#p_medio').val(), $('#p_transaccion').val(), $('#p_fecha').val(), $('#p_pago').val(), {{$servicios->precio_c}}, {{$total}}, 0, 0)"><i>Pagar</i></button>
                                                    <i class="fa fa-check text-primary hide" id="f_check"></i>
                                                    <i class="fa fa-spinner fa-pulse text-18 fa-fw hide" id="btn_load"></i>
                                                    <span class="sr-only">Loading...</span>
                                                </td>
                                            </tr>

                                            <tr class="hide" id="i_save">
                                                <td>{{ucwords(strtolower($servicios->nombre))}}</td>
                                                <td></td>
                                                <td></td>
                                                <td class="has-error"><input type="date" class="form-control input-sm text-right" id="f_date"></td>
                                                <td><input type="text" class="form-control input-sm text-right" id="f_pago" value="0" readonly="readonly"></td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-warning display-block" id="f_btnpago" onclick="pagar_acuenta({{$servicios->id}},{{$idcotizacion}},$('#f_pago').val(),$('#f_date').val())"><i>Save</i></button>

                                                    <i class="fa fa-check text-primary hide" id="f_btncheck"></i>
                                                    <i class="fa fa-spinner fa-pulse text-18 fa-fw hide" id="f_btnload"></i>
                                                    <span class="sr-only">Loading...</span>

                                                </td>
                                            </tr>

                                            <tr>
                                                <td colspan="3"></td>
                                                <td class="list-style-none">
                                                    {{--<li><b>TOTAL</b></li>--}}
                                                    <li><b>PRECIO SERVICIO</b></li>
                                                    <li><b>TOTAL DEUDA</b></li>
                                                </td>
                                                <td class='text-right list-style-none'>

                                                    {{--<li><b>{{$total}}</b></li>--}}
                                                    <li>{{$servicios->precio_c}}</li>
                                                    <li><b id="f_deuda">{{$servicios->precio_c-$total}}</b></li>
                                                </td>
                                            </tr>

                                        @endif
                                    @endforeach
                                    {{csrf_field()}}
                                    </tbody>
                                </table>
                                {{--<div class="nota">--}}
                                    {{--<b class="text-success">FELICITACIONES USTED NO TIENE DEUDAS PENDIENTES..!!! (Aliste maletas rumbo al lejano Peru)</b>--}}
                                    {{--<b class="text-danger">USTED TIENE UNA DEUDA PENDIENTE DE "S/. '.number_format($deuda,2,".",",").'"</b>--}}
                                {{--</div>--}}
                            </div>
                            {{--<div class="col-lg-12 itinerario">--}}
                                {{--<hr>--}}
                                {{--<h4 class="codigo"><b>PRICE:</b></h4>--}}
                                {{--<ul class="hide">--}}
                                    {{--<li><b>DIA 3:</b> sdsdsd</li>";--}}

                                {{--</ul>--}}
                                {{--<ul>--}}
                                    {{--<br>--}}
                                    {{--<li><b>PRECIO POR PERSONA:</b> s/.--}}
                                        {{--123--}}
                                    {{--</li>--}}
                                    {{--<li><b>PRECIO PARA 2 PERSONAS:</b> s/. 1234--}}
                                        {{--echo number_format($precioventa,2,".",",")--}}
                                    {{--</li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                            {{--<hr>--}}
                            {{--<div class="col-lg-12">--}}
                                {{--<table class="table">--}}
                                    {{--<caption>Descripcion de la forma de pago</caption>--}}
                                    {{--<thead>--}}
                                    {{--<tr>--}}
                                        {{--<th>Fecha</th>--}}
                                        {{--<th>Descripcion de pagos</th>--}}
                                        {{--<th>Monto</th>--}}
                                    {{--</tr>--}}
                                    {{--</thead>--}}
                                    {{--<tbody>--}}
                                    {{--<tr>--}}
                                        {{--<td></td>--}}
                                        {{--<td>--}}
                                            {{--<li>fdf</li>--}}
                                            {{--<li>dfdf</li>--}}
                                        {{--</td>--}}
                                        {{--<td></td>--}}
                                    {{--</tr>--}}
                                    {{--</tbody>--}}
                                {{--</table>--}}
                            {{--</div>--}}
                            <div class="footer col-lg-12 clearfix">
                                <a href="">&copy; http://gotoperu.com/</a>
                            </div>
                        </section>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <script>
        function fecha_pago(pago, p_conta, total) {
            var precio = parseFloat(p_conta);
            var pago = parseFloat(pago);
            var total = parseFloat(total);
            var total1 = (precio - pago) - total;
            var total2 = total - pago;
            // alert(total);
            if(total == 0){
                if(pago <= precio){
                    document.getElementById('f_pago').value  = total1;
                    document.getElementById('f_deuda').innerHTML   = total1;
                    $('#p_pago').css("border-bottom", "");
                }else{
                    $('#p_pago').css("border-bottom", "2px solid #FF0000");
                }
            }else{
                if(pago <= precio){
                    document.getElementById('f_pago').value  = total2;
                    document.getElementById('f_deuda').innerHTML   = total2;
                    $('#p_pago').css("border-bottom", "");
                }else{
                    $('#p_pago').css("border-bottom", "2px solid #FF0000");
                }
            }
        }
        function pagar_acuenta(id, idcot, pago, fecha){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('[name="_token"]').val()
                }
            });

            $("#f_btnpago").attr("disabled", true);

            if (fecha.length == 0 ){
                $('#f_date').css("border-bottom", "2px solid #FF0000");
                var sendPay = "false";
            }else{
                sendPay = "true"
            }

            if(sendPay == "true"){
                var datos = {
                    "txt_id" : id,
                    "txt_idcot" : idcot,
                    "txt_fecha" : fecha,
                    "txt_pago" : pago
                };
                $.ajax({
                    data:  datos,
                    url:   "{{route('pay_a_cuenta_path')}}",
                    type:  'post',

                    beforeSend: function () {
                        $('#f_btnpago').addClass('hide');
                        $('#f_btnload').removeClass('hide');
                    },
                    success:  function (response) {
                        // $('#d_form')[0].reset();
                        $('#f_btncheck').removeClass('hide')
                        $('#f_btnload').addClass('hide');
                        // $('#i_save').removeClass('hide')
                    }
                });
            } else{
                $("#btn_pago").removeAttr("disabled");
            }

        }
        function pagar_proveedor(id, idcot, medio, transaccion, fecha, pago, p_conta, total, idpago, acuenta){
            var c_total = parseFloat(total);
            var c_conta = parseFloat(p_conta);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('[name="_token"]').val()
                }
            });
            $("#btn_pago").attr("disabled", true);


            if (fecha.length == 0 ){
                $('#p_fecha').css("border-bottom", "2px solid #FF0000");
                var sendPay = "false";
            }else{
                sendPay = "true"
            }
            // if (pago.length == 0 ){
            //     $('#p_pago').css("border-bottom", "2px solid #FF0000");
            //     var sendPay = "false";
            // }else{
            //     sendPay = "true"
            // }

            if(sendPay == "true"){
                if (c_conta == pago && idpago == 0){
                    var datos = {
                        "txt_id" : id,
                        "txt_idcot" : idcot,
                        "txt_medio" : medio,
                        "txt_transaccion" : transaccion,
                        "txt_fecha" : fecha,
                        "txt_pago" : pago,
                        "txt_idpago" : idpago
                    };
                    $.ajax({
                        data:  datos,
                        url:   "{{route('pay_price_conta_path')}}",
                        type:  'post',

                        beforeSend: function () {
                            $('#btn_pago').addClass('hide');
                            $('#btn_load').removeClass('hide');
                        },
                        success:  function (response) {
                            // $('#d_form')[0].reset();
                            $('#f_check').removeClass('hide')
                            $('#btn_load').addClass('hide');
                        }
                    });
                }

                if (c_conta > pago && idpago == 0){
                    var datos = {
                        "txt_id" : id,
                        "txt_idcot" : idcot,
                        "txt_medio" : medio,
                        "txt_transaccion" : transaccion,
                        "txt_fecha" : fecha,
                        "txt_pago" : pago,
                        "txt_idpago" : idpago
                    };
                    $.ajax({
                        data:  datos,
                        url:   "{{route('pay_price_conta_path')}}",
                        type:  'post',

                        beforeSend: function () {
                            $('#btn_pago').addClass('hide');
                            $('#btn_load').removeClass('hide');
                        },
                        success:  function (response) {
                            // $('#d_form')[0].reset();
                            $('#f_check').removeClass('hide');
                            $('#btn_load').addClass('hide');
                            $('#i_save').removeClass('hide');
                        }
                    });
                }

                    if (pago == acuenta && idpago > 0){
                    var datos = {
                        "txt_id" : id,
                        "txt_idcot" : idcot,
                        "txt_medio" : medio,
                        "txt_transaccion" : transaccion,
                        "txt_fecha" : fecha,
                        "txt_pago" : pago,
                        "txt_idpago" : idpago
                    };
                    $.ajax({
                        data:  datos,
                        url:   "{{route('pay_price_conta_path')}}",
                        type:  'post',

                        beforeSend: function () {
                            $('#btn_pago').addClass('hide');
                            $('#btn_load').removeClass('hide');
                        },
                        success:  function (response) {
                            // $('#d_form')[0].reset();
                            $('#f_check').removeClass('hide')
                            $('#btn_load').addClass('hide');
                        }
                    });
                }

                if (acuenta > pago && idpago > 0){
                    var datos = {
                        "txt_id" : id,
                        "txt_idcot" : idcot,
                        "txt_medio" : medio,
                        "txt_transaccion" : transaccion,
                        "txt_fecha" : fecha,
                        "txt_pago" : pago,
                        "txt_idpago" : idpago
                    };
                    $.ajax({
                        data:  datos,
                        url:   "{{route('pay_price_conta_path')}}",
                        type:  'post',

                        beforeSend: function () {
                            $('#btn_pago').addClass('hide');
                            $('#btn_load').removeClass('hide');
                        },
                        success:  function (response) {
                            // $('#d_form')[0].reset();
                            $('#f_check').removeClass('hide');
                            $('#btn_load').addClass('hide');
                            $('#i_save').removeClass('hide');
                        }
                    });
                }

            } else{
                $("#btn_pago").removeAttr("disabled");
            }

        }
    </script>
@stop