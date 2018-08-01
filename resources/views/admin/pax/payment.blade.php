<div class="content-pax">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <a id="agregarCampo" class="btn btn-info" href="#">Agregar Numero de pagos <i class="fa fa-plus-circle text-25 pull-right"></i></a>
                </div>
                <div class="col-md-6">
                    <div class="text-right">
                        @foreach($cotizacion as $cotizaciones)
                        <b class="text-30 text-warning">Total: {{$cotizaciones->precioventa}}</b>
                        @endforeach
                    </div>
                </div>

            </div>

            <hr>
            <div class="post-content">

                @php
                    $total = $cotizaciones->precioventa;

                    $fecha = $cotizaciones->fecha;
                @endphp
                <form role="form" id="p_form">
                    {{csrf_field()}}
                    <div class="col-md-9 col-md-offset-2">
                        <div class="row">
                            <div class="col-md-5">
                                <b>Fecha de Vencimiento</b>
                            </div>
                            <div class="col-md-5 text-right">
                                <b>Monto ($)</b>
                            </div>
                        </div>
                        <div id="contenedor">
                            <div class="row margin-top-10 input-plus">
                                <div class="col-md-5">
                                    <div class="form-group has-warning">
                                        <input type="date" name="vencimiento[]" id="inicios" class="vencimiento2 form-control" onKeyUp="calcular()" value="">
                                        <span id="helpBlock2" class="help-block">Fecha de primer pago</span>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <input type="number" min="0" name="monto[]" class="monto2 form-control text-right" value="{{ceil($total/2)}}" readonly>
                                </div>
                                <a href="#" class="eliminar"><i class="fa fa-close fa-2x text-danger"></i></a>
                            </div>

                            <div class="row margin-top-10 input-plus">
                                <div class="col-md-5">
                                    <input type="date" name="vencimiento[]" class="vencimiento2 form-control"  readonly>
                                </div>
                                <div class="col-md-5">
                                    <input type="number" min="0" name="monto[]" class="monto2 form-control text-right" value="{{$total-ceil($total/2)}}" readonly>
                                </div>
                                <a href="#" class="eliminar"><i class="fa fa-close fa-2x text-danger"></i></a>
                            </div>
                        </div>
                        <div class="row margin-top-40">
                            <div class="col-md-10 text-right">
                                {{--<a href="" class="btn btn-primary"></a>--}}
                                <button type="button" id="p_send" class="btn btn-primary" onclick="plan()">Crear plan de pagos</button>
                                <ul class="fa-ul no-padding pull-right hide" id="loader2">
                                    <li><i class="fa-li fa fa-spinner fa-spin"></i> <i>Sending...</i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        var MaxInputs       = 5; //Número Maximo de Campos
        var contenedor       = $("#contenedor"); //ID del contenedor
        var AddButton       = $("#agregarCampo"); //ID del Botón Agregar
        var total           = "{{$total}}";
        {{--var fecha           = "{{$fecha}}";--}}

        var numero = document.getElementById("numero");


        var x = $("#contenedor .input-plus").length+1;

        $(AddButton).click(function (e) {

            {{--var inicio1 = $('#inicios').val();--}}
            {{--var fecha_fin1           = "{{str_replace('-','/',$fecha)}}";--}}

            {{--var diaEnMils1 = 1000 * 60 * 60 * 24,--}}
                {{--desde1 = new Date(inicio1.substr(0, 10)),--}}
                {{--hasta1 = new Date(fecha_fin1.substr(0, 10)),--}}
                {{--diff1 = hasta1.getTime() - desde1.getTime() + diaEnMils1;--}}

{{--//            var sum_dias= total_dias/x;--}}
{{--//            alert(inicio1+'-'+fecha_fin1+'-'+MaxInputs);--}}
            {{--if (inicio1=""){--}}
                {{--var MaxInputs = (diff1/diaEnMils1)-1;--}}
            {{--}else{--}}
                {{--var MaxInputs = 5;--}}
            {{--}--}}
            if(x <= MaxInputs) //max input box allowed
            {
//                FieldCount++;

//                alert(x);
                //agregar campo

//                var dias = parseInt(numero.value);
//                var calculado = new Date(inicio);
//                calculado.setDate(
//                    hoy.getDate() + x
//                );
//
//                var mes = calculado.getMonth() + 1;
//                var dia = calculado.getDate();
//
//                if(mes < 10){
//                    mes = '0'+mes;
//                }
//                if(dia < 10){
//                    dia = '0'+dia;
//                }
//
//                var fecha = calculado.getFullYear() + '-' +
//                    mes + '-' + dia;

//                alert(fecha);
                $(contenedor).append('<div class="row margin-top-10 input-plus"><div class="col-md-5"><input type="date" name="vencimiento[]" class="vencimiento2 form-control" readonly/></div><div class="col-md-5"><input type="number" min="0" name="monto[]" class="monto2 form-control text-right" readonly></div><a href="#" class="eliminar"><i class="fa fa-close fa-2x text-danger"></i></a></div>');

                $(".monto2").each(function (index) {
                    if(index == x-1) {
                        $(this).val(total - (Math.ceil(total / x)*(x-1)));
                    }else{
                        $(this).val(Math.ceil(total / x));
                    }
                });

                x++; //text box increment

            }
            return false;
        });


        $("body").on("click",".eliminar", function(e){ //click en eliminar campo
            var y = $("#contenedor .input-plus").length;
            if( y > 1 ) {
//                alert(y);
                $(this).parent('div').remove(); //eliminar el campo
                y--;

                $(".monto2").each(function (index) {
                    if(index == y-1) {
                        $(this).val(total - (Math.ceil(total / y)*(y-1)));
                    }else{
                        $(this).val(Math.ceil(total / y));
                    }
                });
            }
            return false;
        });
    });


    function calcular() {
//        var inicio = val()("inicios");
        var inicio = $('#inicios').val();
//        alert(inicio);
        var hoy = new Date(inicio);
//        var dias = parseInt(numero.value);

        var x = $("#contenedor .input-plus").length;
        var fecha_fin           = "{{str_replace('-','/',$fecha)}}";

//        alert(fecha_fin);

        var diaEnMils = 1000 * 60 * 60 * 24,
            desde = new Date(inicio.substr(0, 10)),
            hasta = new Date(fecha_fin.substr(0, 10)),
            diff = hasta.getTime() - desde.getTime() + diaEnMils;

        var total_dias = (diff/diaEnMils)-30;
        var sum_dias= total_dias/x;

//        alert(total_dias+'-'+x+'-'+sum_dias);
//        alert(resultado);
        var i = 1;
        var l = 0;
        $(".vencimiento2").each(function (index) {

            var resultado='';
            if(l < x-1){
                var calculado = new Date(inicio);
                var mes = calculado.getMonth() + 1;
                var dia = calculado.getDate();
//                var resultado1 = calculado.getFullYear() + '-' +
                    mes + '-' + dia;
//                console.log('fecha ini'+l+':'+resultado1+' con '+i+' dias');

                calculado.setDate(
                    hoy.getDate() + i
                );

                var mes = calculado.getMonth() + 1;
                var dia = calculado.getDate();

                if(mes < 10){
                    mes = '0'+mes;
                }
                if(dia < 10){
                    dia = '0'+dia;
                }

                 resultado = calculado.getFullYear() + '-' +
                    mes + '-' + dia;
            }else{
                var calculado = new Date(inicio);
                var mes = hoy.getMonth() + 1;
                var dia = hoy.getDate();
//                var resultado1 = hoy.getFullYear() + '-' +
                    mes + '-' + dia;
//                console.log('fecha ini'+l+':'+resultado1+' con '+total_dias+' dias');
                calculado.setDate(
                    hoy.getDate() + total_dias
                );

                var mes = calculado.getMonth() + 1;
                var dia = calculado.getDate();

                if(mes < 10){
                    mes = '0'+mes;
                }
                if(dia < 10){
                    dia = '0'+dia;
                }
                 resultado = calculado.getFullYear() + '-' +
                    mes + '-' + dia;
            }

//            i++;
//            console.log('fecha'+l+':'+resultado);
            $(this).val(resultado);
            i = i + sum_dias;
            l++;
        });
    }


    function plan(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });

        $("#p_send").attr("disabled", true);

        var s_vencimiento = document.getElementsByClassName("vencimiento2");
        var vencimiento = [];
        for (var i = 0; i < s_vencimiento.length; ++i) {
            if (typeof s_vencimiento[i].value !== "undefined") {
                vencimiento.push(s_vencimiento[i].value);
            }
        }

        s_vencimiento = vencimiento;

        var s_monto = document.getElementsByClassName("monto2");
        var monto = [];
        for (var i = 0; i < s_monto.length; ++i) {
            if (typeof s_monto[i].value !== "undefined") {
                monto.push(s_monto[i].value);
            }
        }

        s_monto = monto;

//        alert(s_vencimiento+'-'+s_monto);

        var s_inicios = $('#inicios').val();
        var s_cotizaciones = "{{$cotizaciones->id}}";



        if (s_inicios.length == 0 ){
            $('#inicios').css("border-bottom", "2px solid #FF0000");
            var send = "false";
        }else{

            var send = "true";
        }

        if(send == "true"){
            var datos = {

                "txt_vencimiento" : s_vencimiento,
                "txt_monto" : s_monto,
                "txt_cotizaciones" : s_cotizaciones,

            };
            $.ajax({
                data:  datos,
                url:   "{{route('payment_store_path')}}",
                type:  'post',

                beforeSend: function () {
                    $('#p_send').removeClass('show');
                    $("#p_send").addClass('hide');
                    $("#loader2").removeClass('hide');
                    $("#loader2").addClass('show');
                },
                success:  function (response) {
                    $('#p_form')[0].reset();
                    $('#p_send').removeClass('show');
                    $('#p_send').addClass('hide');
                    $("#loader2").removeClass('show');
                    $("#loader2").addClass('hide');

                    $("#p_send").removeAttr("disabled");

                    var page = 'detail';

                    var route = '{{route('pax_show_path', $cotizaciones->id)}}';
                    $.ajax({
                        data: {page: page},
                        url: route,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data){
                            $(".content-pax").html(data);

                        }
                    });

                    {{--window.location = "{{route('pax_show_path', '6?page=detail')}}";--}}
                }
            });
        } else{
            $("#p_send").removeAttr("disabled");
        }
    }
</script>
