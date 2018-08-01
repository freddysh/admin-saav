<div class="content-pax">
    <div class="panel panel-default">
        <div class="panel-body">
            {{--<div class="pull-left">--}}
            {{--<a href="#">--}}
            {{--<img class="media-object img-circle" src="https://lut.im/7JCpw12uUT/mY0Mb78SvSIcjvkf.png" width="50px" height="50px" style="margin-right:8px; margin-top:-5px;">--}}
            {{--</a>--}}
            {{--</div>--}}

            {{--<h4><a href="#" style="text-decoration:none;"><strong>Grupo</strong></a> – <small><small><a href="#" style="text-decoration:none; color:grey;"><i><i class="fa fa-clock-o" aria-hidden="true"></i> ghg</i></a></small></small></h4>--}}

            <div class="row">
                <div class="col-md-12">
                    <span class="pull-left pax-nav">

                        {{--<a href="?page=package" class="btn btn-link" style="text-decoration:none;"><i class="fa fa-fw fa-thumbs-o-up" aria-hidden="true"></i></a>--}}
                        {{--<a href="?page=flight" class="btn btn-link" style="text-decoration:none;"><i class="fa fa-fw fa-plane" aria-hidden="true"></i></a>--}}
                    </span>
                    <span class="pull-right">
                        {{--<a href="#" class="btn btn-link" style="text-decoration:none;"><i class="fa fa-lg fa-file-pdf-o" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Message"></i></a>--}}

                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">
                            Ver Detalle de pagos
                        </button>

                        <a href="#" class="btn btn-link" style="text-decoration:none;"><i class="fa fa-lg fa-file-pdf-o" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Message"></i></a>
                        <a href="#" class="btn btn-link" style="text-decoration:none;"><i class="fa fa-lg fa-share" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Message"></i></a>
                    </span>


                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">

                                <div class="modal-body clearfix">
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
                                                <div class="nombres"><b>NOMBRES Y APELLIDOS:</b> hida ch pmnce</div>
                                                <div class="nombres"><b>PASAPORTE:</b> 3454545</div>
                                                <div class="nacionalidad"><b>NACIONALIDAD:</b> Peru</div>
                                            </div>
                                            <div class="col-lg-12">
                                                <table class="table table-striped table-bordered table-hover table-condensed">
                                                    <caption>Detalle de pagos realizados und = unidad, Cod: codigo del paquete, Precio = precio total del paquete, Total = Pagos realizados por el cliente</caption>
                                                    <thead>
                                                    <tr>
                                                        <th>Codigo</th>
                                                        <th>Und</th>
                                                        <th>Descripcion</th>
                                                        <th>Fecha Pago</th>
                                                        <th>Pagos</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    {{--@foreach( )--}}
                                                    {{--@endforeach--}}
                                                        <tr>
                                                            <td>0545</td>
                                                            <td>1</td>
                                                            <td>titulo 2 DIAS</td>
                                                            <td>17/58/85</td>
                                                            <td class='text-right'>1250</td>
                                                        </tr>
                                                    <tr>
                                                        <td colspan="3"></td>
                                                        <td>
                                                            <li><b>TOTAL</b></li>
                                                            <li><b>PRECIO PAQUETE</b></li>
                                                            <li><b>TOTAL DEUDA</b></li>
                                                        </td>
                                                        <td class='text-right'>
                                                            <li><b></b></li>
                                                            <li></li>
                                                            <li><b></b></li>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <div class="nota">
                                                    <b class="text-success">FELICITACIONES USTED NO TIENE DEUDAS PENDIENTES..!!! (Aliste maletas rumbo al lejano Peru)</b>
                                                    <b class="text-danger">USTED TIENE UNA DEUDA PENDIENTE DE "S/. '.number_format($deuda,2,".",",").'"</b>

                                                </div>
                                            </div>
                                            <div class="col-lg-12 itinerario">
                                                <hr>
                                                <h4 class="codigo"><b>PRICE:</b></h4>
                                                <ul class="hide">
                                                    <li><b>DIA 3:</b> sdsdsd</li>";

                                                </ul>
                                                <ul>
                                                    <br>
                                                    <li><b>PRECIO POR PERSONA:</b> s/.
                                                        123
                                                    </li>
                                                    <li><b>PRECIO PARA 2 PERSONAS:</b> s/. 1234
                                                    {{--echo number_format($precioventa,2,".",",")--}}
                                                    </li>
                                                </ul>
                                            </div>
                                            <hr>
                                            <div class="col-lg-12">
                                                <table class="table">
                                                    <caption>Descripcion de la forma de pago</caption>
                                                    <thead>
                                                    <tr>
                                                        <th>Fecha</th>
                                                        <th>Descripcion de pagos</th>
                                                        <th>Monto</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td></td>
                                                        <td>
                                                            <li>fdf</li>
                                                            <li>dfdf</li>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="footer col-lg-12 clearfix">
                                                <a href="">&copy; http://gotoperu.com/</a>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <hr>
            <div class="post-content">
                <div class="row">

                    <div class="col-md-12">
                        <table class="table">
                            {{--<caption>table title and/or explanatory text</caption>--}}
                            <thead>
                            <tr>
                                <th>Fecha de Pago</th>
                                <th>Fecha Vencimiento</th>
                                <th>Medio</th>
                                <th>Transaccion</th>
                                <th>Monto</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($pagos as $pago)
                                    <form id="form_{{$pago->id}}">
                                        {{csrf_field()}}
                                        <tr>
                                            <td>
                                                <input type="date" name="" id="fecha_{{$pago->id}}" class="form-control input-sm" value="{{$pago->fecha}}">
                                            </td>
                                            <td>
                                                <input type="date" name="" id="vencimiento_{{$pago->id}}" class="form-control input-sm" value="{{$pago->vencimiento}}" readonly>
                                            </td>
                                            <td>
                                                <input type="text" name="" id="medio_{{$pago->id}}" class="form-control input-sm" value="{{$pago->medio}}">
                                            </td>
                                            <td>
                                                <input type="text" name="" id="transaccion_{{$pago->id}}" class="form-control input-sm" value="{{$pago->transaccion}}">
                                            </td>
                                            <td>
                                                <input type="text" name="" id="monto_{{$pago->id}}" class="form-control input-sm" value="{{$pago->monto}}">
                                            </td>
                                            @if($pago->estado == 1)
                                                <td><i class="fa fa-check fa-2x text-success"></i></td>
                                            @else
                                                <td id="check-payment_{{$pago->id}}" class="hide"><i class="fa fa-check fa-2x text-success"></i></td>
                                                <input type="hidden" name="" id="estado_{{$pago->id}}" value="{{$pago->estado}}">
                                                <td>
                                                    <button type="button" id="p_send_{{$pago->id}}" class="btn btn-danger btn-sm" onclick="pagar({{$pago->id}})">Crear plan de pagos</button>
                                                    <ul class="fa-ul no-padding pull-right hide" id="loader2_{{$pago->id}}">
                                                        <li><i class="fa-li fa fa-spinner fa-spin"></i> <i>Sending...</i></li>
                                                    </ul>

                                                    {{--<a href="" onclick="pagar({{$pago->id}})" id="p_send_{{$pago->id}}" class="btn btn-danger btn-sm">Pagar</a>--}}
                                                </td>
                                            @endif
                                        </tr>
                                    </form>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{--<div>--}}
            {{--<p>--}}
            {{--<input type="number" id="numero" min="0" max="120" value="0" onKeyUp="calcular()"/>--}}
            {{--<button onclick="calcular()">Calcular</button>--}}
            {{--</p>--}}
            {{--<p>Resultado: <span id="resultado"></span></p>--}}
            {{--</div>--}}
        </div>
    </div>
</div>

<script>

    function pagar(id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });

        $("#p_send_"+id).attr("disabled", true);

        var s_fecha = $('#fecha_'+id).val();
        var s_vencimiento = $('#vencimiento_'+id).val();
        var s_medio = $('#medio_'+id).val();
        var s_transaccion = $('#transaccion_'+id).val();
        var s_monto = $('#monto_'+id).val();
        var s_estado = $('#estado_'+id).val();
        var s_cotizaciones = "{{$pago->cotizaciones_id}}";


        if (s_fecha.length == 0 ){
            $('#fecha_'+id).css("border-bottom", "2px solid #FF0000");
            var send = "false";
        }else{
            var send = "true";
        }

        if(send == "true"){
            var datos = {

                "txt_fecha" : s_fecha,
                "txt_vencimiento" : s_vencimiento,
                "txt_medio" : s_medio,
                "txt_transaccion" : s_transaccion,
                "txt_monto" : s_monto,
                "txt_estado" : s_estado,
                "txt_cotizaciones" : s_cotizaciones,

            };

            $.ajax({
                data:  datos,
                url:   "payment/update/"+id,
                type:  'post',

                beforeSend: function () {
                    $('#p_send_'+id).removeClass('show');
                    $("#p_send_"+id).addClass('hide');
                    $("#loader2_"+id).removeClass('hide');
                    $("#loader2_"+id).addClass('show');
                },
                success:  function (response) {
//                    $('#p_form')[0].reset();
                    $('#p_send_'+id).removeClass('show');
                    $('#p_send_'+id).addClass('hide');
                    $("#loader2_"+id).removeClass('show');
                    $("#loader2_"+id).addClass('hide');

                    $("#check-payment_"+id).removeClass('hide');
                    $("#check-payment_"+id).addClass('show');

                    $("#p_send_"+id).removeAttr("disabled");

                    {{--var page = 'detail';--}}

                    {{--var route = '{{route('pax_show_path', $pago->cotizaciones_id)}}';--}}
                    {{--$.ajax({--}}
                        {{--data: {page: page},--}}
                        {{--url: route,--}}
                        {{--type: 'GET',--}}
                        {{--dataType: 'json',--}}
                        {{--success: function(data){--}}
                            {{--$(".content-pax").html(data);--}}

                        {{--}--}}
                    {{--});--}}

                    {{--window.location = "{{route('pax_show_path', '6?page=detail')}}";--}}
                }
            });
        } else{
            $("#p_send_"+id).removeAttr("disabled");
        }
    }

</script>