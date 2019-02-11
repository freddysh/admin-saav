@php
    $arra_prov_pagos=[];
    function fecha_peru($fecha){
        $fe='';
        if($fecha){
            $f1=explode('-',$fecha);
            $fe =$f1[2].'-'.$f1[1].'-'.$f1[0];
        }
        return $fe;
    }
@endphp

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('list_fechas_servivios_show_path')}}" method="post">
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
                                                @foreach($itinerario->itinerario_servicios as $servicio)
                                                    @if($servicio->fecha_venc)
                                                    @if($servicio->grupo==$grupo)
                                                        @if($servicio->grupo!='MOVILID')
                                                            @if(date($ini)<=$servicio->fecha_venc and $servicio->fecha_venc <= date($fin))
                                                                @php
                                                                    $total_h=0;
                                                                    $precio_c_confirm=0;
                                                                    $precio_c_confirm2=0;
                                                                @endphp
                                                                @if(!array_key_exists($servicio->proveedor_id,$arra_fecha_serv))
                                                                    @php
                                                                        $arra_fecha_serv[$servicio->proveedor_id]=$itinerario->fecha;
                                                                    @endphp
                                                                @endif
                                                                @if(!array_key_exists($servicio->proveedor_id,$arra_fecha_venc))
                                                                    @php
                                                                        $arra_fecha_venc[$servicio->proveedor_id]=$servicio->fecha_venc;
                                                                    @endphp
                                                                @endif
                                                                @php
                                                                    $total_h+=$servicio->precio_c;
                                                                @endphp
                                                                @if(array_key_exists($servicio->proveedor_id,$arra_prov_total))
                                                                    @php
                                                                        $arra_prov_total[$servicio->proveedor_id]+=$total_h;
                                                                    @endphp
                                                                @else
                                                                    @php
                                                                        $arra_prov_total[$servicio->proveedor_id]=$total_h;
                                                                    @endphp
                                                                @endif
                                                            @endif
                                                        @elseif($servicio->grupo=='MOVILID')
                                                            @if($servicio->clase!='BOLETO')
                                                                @if(date($ini)<=$servicio->fecha_venc and $servicio->fecha_venc <= date($fin))
                                                                    @php
                                                                        $total_h=0;
                                                                        $precio_c_confirm=0;
                                                                        $precio_c_confirm2=0;
                                                                    @endphp
                                                                    @if(!array_key_exists($servicio->proveedor_id,$arra_fecha_serv))
                                                                        @php
                                                                            $arra_fecha_serv[$servicio->proveedor_id]=$itinerario->fecha;
                                                                        @endphp
                                                                    @endif
                                                                    @if(!array_key_exists($servicio->proveedor_id,$arra_fecha_venc))
                                                                        @php
                                                                            $arra_fecha_venc[$servicio->proveedor_id]=$servicio->fecha_venc;
                                                                        @endphp
                                                                    @endif
                                                                    @php
                                                                        $total_h+=$servicio->precio_c;
                                                                    @endphp
                                                                    @if(array_key_exists($servicio->proveedor_id,$arra_prov_total))
                                                                        @php
                                                                            $arra_prov_total[$servicio->proveedor_id]+=$total_h;
                                                                        @endphp
                                                                    @else
                                                                        @php
                                                                            $arra_prov_total[$servicio->proveedor_id]=$total_h;
                                                                        @endphp
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif
                                                    @endif
                                                @endforeach
                                            @endforeach
                                            @foreach($arra_prov_total as $key => $arra_prov_total_)
                                                @php
                                                $pagado=$pagos->where('paquete_cotizaciones_id',$paquetes->id)->where('proveedor_id',$key)->where('estado','1')->where('grupo',$grupo)->sum('a_cuenta');
                                                @endphp
    {{--                                            @if($pagado<$arra_prov_total_)--}}
                                                    <tr>
                                                    @php
                                                        $titulo='';
                                                        $proveedor=''
                                                    @endphp
                                                    @foreach($cotizaciones->cotizaciones_cliente->where('estado','1') as $cliente)
                                                        @php
                                                            $titulo='<b class="text-primary">'.$cliente->cliente->nombres.' '.$cliente->cliente->apellidos.' <span class="text-primary">x</span> '.$cotizaciones->nropersonas.' <span class="text-primary">(</span>'.$cotizaciones->duracion.' dias<span class="text-primary">)</span></b>';
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
                                                                <input type="checkbox"  class="form-check-input" onclick="if (this.checked) sumar({{$arra_prov_total_-$pagado}},'{{$grupo}}'); else restar({{$arra_prov_total_-$pagado}},'{{$grupo}}')" name="chk_id[]" value="{{$paquetes->id}}(_){{$key}}(_){{$arra_prov_total_}}(_){{$pagado}}(_){{$titulo}}(_){{$proveedor}}(_){{$arra_fecha_serv[$key]}}(_){{$arra_fecha_venc[$key]}}">
                                                                {!! $titulo !!}
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <b>{{$proveedor}}</b>
    {{--                                                    {{$arra_grupo[$key]}}--}}
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
                                                {{--@endif--}}
                                            @endforeach <!-- cierre para la lsita de proveedores con sus respectivos datos -->
                                        @endforeach <!-- cierre para pqts -->
                                    @endforeach <!-- cierrempara cotis -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-3">
                                <div class="card w-100">
                                    <div class="card-body text-center">
                                        <input type="hidden" name="grupo" value="{{$grupo}}">
                                        <h2 class="text-40"><sup><small>$usd</small></sup><b id="s_total_{{$grupo}}">0</b></h2>
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
        function sumar(valor,grupo) {
            document.getElementById('s_total_'+grupo).innerHTML=parseFloat(document.getElementById('s_total_'+grupo).innerHTML)+valor;
        }
        function restar(valor,grupo) {
            document.getElementById('s_total_'+grupo).innerHTML=parseFloat(document.getElementById('s_total_'+grupo).innerHTML)-valor;
        }
    </script>