@php
    $arra_prov_pagos=[];
    function fecha_peru($fecha){
        $f1=explode('-',$fecha);
        return $f1[2].'-'.$f1[1].'-'.$f1[0];
    }
@endphp

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                        <form action="{{route('list_fechas_hotel_show_path')}}" method="post">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-9">
                                    <table class="table table-condensed table-bordered margin-top-20 table-hover">
                                        <thead>
                                        <tr>
                                            <th class="text-18 text-grey-goto text-center" colspan="2">Cotización</th>
                                            <th class="text-18 text-grey-goto text-center">Proveedor</th>
                                            <th class="text-18 text-grey-goto text-center">Fecha de Servicio</th>
                                            <th class="text-18 text-grey-goto text-center">Fecha a Pagar</th>
                                            <th class="text-18 text-grey-goto text-center">Total</th>
                                            <th class="text-18 text-grey-goto text-center">Pagado</th>
                                            <th class="text-18 text-grey-goto text-center">Saldo</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cotizacion->where('estado','2') as $cotizaciones)
                                            @foreach($cotizaciones->paquete_cotizaciones->where('estado','2') as $paquetes)
                                                @php
                                                    $arra_prov_total=[];
                                                    $arra_fecha_serv=[];
                                                    $arra_fecha_venc=[];

                                                @endphp
                                                @foreach($paquetes->itinerario_cotizaciones as $itinerario)
                                                    @php
                                                        $dia = $itinerario->dias - 1;
                                                        $fecha = date($cotizaciones->fecha);
                                                        $fecha_servicio = strtotime ( '+'.$dia.' day' , strtotime ( $fecha ) ) ;
                                                        $fecha_servicio = date ( 'Y-m-d' , $fecha_servicio );

                                                        $dia_pago = 0;
                                                        $fecha_p = date($fecha_servicio);
                                                        $fecha_pago = strtotime ( '-'.$dia_pago.' day' , strtotime ( $fecha_p ) ) ;
                                                        $fecha_pago = date ( 'Y-m-d' , $fecha_pago );
                                                    @endphp
                                                    @foreach($itinerario->hotel as $hotel)
                                                        @if(date($ini)<=$hotel->fecha_venc and $hotel->fecha_venc <= date($fin))
                                                            @php
                                                                $total_h=0;
                                                                $precio_c_confirm=0;
                                                                $precio_c_confirm2=0;
                                                            @endphp
                                                            @if(!array_key_exists($hotel->proveedor_id,$arra_fecha_serv))
                                                                @php
                                                                    $arra_fecha_serv[$hotel->proveedor_id]=$itinerario->fecha;
                                                                @endphp
                                                            @endif
                                                            @if(!array_key_exists($hotel->proveedor_id,$arra_fecha_venc))
                                                                @php
                                                                    $arra_fecha_venc[$hotel->proveedor_id]=$hotel->fecha_venc;
                                                                @endphp
                                                            @endif

                                                            @if($hotel->personas_s>0)
                                                                @php
                                                                    $precio_c_confirm++;
                                                                @endphp
                                                                @if($hotel->precio_s_c>0)
                                                                    @php
                                                                        $total_h+=$hotel->personas_s*$hotel->precio_s_c;
                                                                        $precio_c_confirm2++;
                                                                    @endphp
                                                                @endif
                                                                @if(array_key_exists($hotel->proveedor_id,$arra_prov_total))
                                                                    @php
                                                                        $arra_prov_total[$hotel->proveedor_id]+=$total_h;
                                                                    @endphp
                                                                @else
                                                                    @php
                                                                        $arra_prov_total[$hotel->proveedor_id]=$total_h;
                                                                    @endphp
                                                                @endif
                                                            @endif
                                                            @if($hotel->personas_d>0)
                                                                @php
                                                                    $precio_c_confirm++;
                                                                @endphp
                                                                @if($hotel->precio_d_c>0)
                                                                    @php
                                                                        $total_h+=$hotel->personas_d*$hotel->precio_d_c;
                                                                        $precio_c_confirm2++;
                                                                    @endphp
                                                                @endif
                                                                @if(array_key_exists($hotel->proveedor_id,$arra_prov_total))
                                                                    @php
                                                                        $arra_prov_total[$hotel->proveedor_id]+=$total_h;
                                                                    @endphp
                                                                @else
                                                                    @php
                                                                        $arra_prov_total[$hotel->proveedor_id]=$total_h;
                                                                    @endphp
                                                                @endif
                                                            @endif
                                                            @if($hotel->personas_m>0)
                                                                @php
                                                                    $precio_c_confirm++;
                                                                @endphp
                                                                @if($hotel->precio_m_c>0)
                                                                    @php
                                                                        $total_h+=$hotel->personas_m*$hotel->precio_m_c;
                                                                        $precio_c_confirm2++;
                                                                    @endphp
                                                                @endif
                                                                @if(array_key_exists($hotel->proveedor_id,$arra_prov_total))
                                                                    @php
                                                                        $arra_prov_total[$hotel->proveedor_id]+=$total_h;
                                                                    @endphp
                                                                @else
                                                                    @php
                                                                        $arra_prov_total[$hotel->proveedor_id]=$total_h;
                                                                    @endphp
                                                                @endif
                                                            @endif
                                                            @if($hotel->personas_t>0)
                                                                @php
                                                                    $precio_c_confirm++;
                                                                @endphp
                                                                @if($hotel->precio_t_c>0)
                                                                    @php
                                                                        $total_h+=$hotel->personas_t*$hotel->precio_t_c;
                                                                        $precio_c_confirm2++;
                                                                    @endphp
                                                                @endif
                                                                @if(array_key_exists($hotel->proveedor_id,$arra_prov_total))
                                                                    @php
                                                                        $arra_prov_total[$hotel->proveedor_id]+=$total_h;
                                                                    @endphp
                                                                @else
                                                                    @php
                                                                        $arra_prov_total[$hotel->proveedor_id]=$total_h;
                                                                    @endphp
                                                                @endif
                                                            @endif
                                                            @php $total = 0; $total2 = 0; $j=0;@endphp
                                                                @php $pago_a_cuenta = $total_h;@endphp
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                                @foreach($arra_prov_total as $key => $arra_prov_total_)
                                                    @php
                                                    $pagado=$pagos->where('paquete_cotizaciones_id',$paquetes->id)->where('proveedor_id',$key)->where('estado','1')->sum('a_cuenta');
                                                    @endphp
                                                    @if($pagado<$arra_prov_total_)
                                                        <tr>
                                                        @php
                                                            $titulo='';
                                                            $proveedor=''
                                                        @endphp
                                                        @foreach($cotizaciones->cotizaciones_cliente->where('estado','1') as $cliente)
                                                            @php
                                                                $titulo=$cliente->cliente->nombres.' '.$cliente->cliente->apellidos ;
                                                            @endphp
                                                        @endforeach
                                                        @foreach($proveedores->where('id',$key) as $proveedor)
                                                            @php
                                                                $proveedor=ucwords(strtolower($proveedor->nombre_comercial));
                                                            @endphp
                                                        @endforeach
                                                        <td class="text-left" colspan="2">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" onclick="if (this.checked) sumar({{$arra_prov_total_-$pagado}}); else restar({{$arra_prov_total_-$pagado}})" name="chk_id[]" value="{{$paquetes->id}}(_){{$key}}(_){{$arra_prov_total_}}(_){{$pagado}}(_){{$titulo}}(_){{$proveedor}}(_){{$arra_fecha_serv[$key]}}(_){{$arra_fecha_venc[$key]}}">
                                                                    <b class="text-primary">{{$titulo}} <span class="text-warning">x</span> {{$cotizaciones->nropersonas}} <span class="text-warning">(</span>{{$cotizaciones->duracion}} dias<span class="text-warning">)</span></b>
                                                            </label>
                                                            </div>
                                                        </td>
                                                         <td>
                                                            <b>{{$proveedor}}</b>
                                                        </td>
                                                        <td class="text-right"><b>{{fecha_peru($arra_fecha_serv[$key])}}</b></td>
                                                        <td class="text-right"><b>{{fecha_peru($arra_fecha_venc[$key])}}</b></td>
                                                        <td class="text-right"><b>{{$arra_prov_total_}}<sup><small>$USS</small></sup></b></td>
                                                        <td class="text-right">
                                                            <b>
                                                                {{$pagado}}<sup><small>$USS</small></sup>
                                                            </b>
                                                        </td>
                                                        <td class="text-right">
                                                            <b>
                                                                {{$arra_prov_total_-$pagado}}<sup><small>$USS</small></sup>
                                                            </b>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach <!-- cierre para la lsita de proveedores con sus respectivos datos -->
                                            @endforeach <!-- cierre para pqts -->
                                        @endforeach <!-- cierrempara cotis -->
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-3">
                                    <div class="card w-100">
                                        <div class="card-body text-center">
                                            <h2 class="text-40"><sup><small>$usd</small></sup><b id="s_total">Monto</b></h2>
                                            <button type="submit" class="btn btn-info display-block w-100">Seleccionar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                </div>
            </div>
        </div>
    </div>
    <script>
        var total=0;

        function sumar(valor) {
            total += valor;
            // document.formulario.total.value=total;
            document.getElementById('s_total').innerHTML   = total;
        }

        function restar(valor) {
            total-=valor;
            // document.formulario.total.value=total;
            document.getElementById('s_total').innerHTML   = total;
        }

        {{--function rango_fecha() {--}}
            {{--var ini = $('#f_ini').val();--}}
            {{--var fin = $('#f_fin').val();--}}
            {{--window.location = "{{route('list_fechas_path', ['1','2'])}}";--}}
                {{--// window.location.href--}}
        {{--}--}}
    </script>