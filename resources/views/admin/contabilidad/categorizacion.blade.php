@php
    function fecha_peru($fecha){
        $fecha=explode('-',$fecha);
        return $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
    }
@endphp
@extends('layouts.admin.contabilidad')
@section('archivos-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">
@stop
@section('archivos-js')
    <script src="{{asset("https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js")}}"></script>
@stop
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Contabilidad</li>
            <li class="active "><i class="fa fa-filter text-warning" aria-hidden="true"></i> Clasificacion</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12 ">
            <table class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                @php
                    $dato_cliente='';

                @endphp
                @foreach($cotizacion->where('estado','2') as $cotizacion_)
                    @php
                        $total=0;
                    @endphp
                    @foreach($cotizacion_->cotizaciones_cliente as $clientes)
                        @if($clientes->estado==1)
                            @php
                                $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->nombres;
                            @endphp
                        @endif
                    @endforeach
                        {{csrf_field()}}
                        <tr id="lista_venta_{{$cotizacion_->id}}">
                            <td class="col-lg-10">
                                <div id="detalle_{{$cotizacion_->id}}"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detalle de la venta</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                @foreach($cotizacion_->paquete_cotizaciones->where('estado','2') as $paquete)
                                                    <table>
                                                        <th>
                                                            <td colspan="2">SERVICE</td>
                                                            <td>CALCULO</td>
                                                            <td>SALES</td>
                                                        </th>
                                                        @foreach($paquete->itinerario_cotizaciones as $itinerarios)
                                                            <tr>
                                                                <td colspan="5" class="bg-grey-goto">
                                                                    <b class="text-white">Day {{$itinerarios->dias}}</b>
                                                                    <span class="badge badge-g-yellow text-15">{{fecha_peru($itinerarios->fecha)}}</span>
                                                                    <b class="text-white">{{$itinerarios->titulo}}</b>
                                                                </td>
                                                            </tr>
                                                            @foreach($itinerarios->itinerario_servicios as $servicios)
                                                                @foreach($m_servicios->where('id',$servicios->m_servicios_id) as $servicio)
                                                                    <tr>
                                                                        <td>
                                                                            @if($servicio->grupo=='TOURS')
                                                                                <i class="fas fa-map text-info"></i>
                                                                            @elseif($servicio->grupo=='MOVILID')
                                                                                <i class="fas fa-bus text-warning"></i>
                                                                            @elseif($servicio->grupo=='REPRESENT')
                                                                                <i class="fas fa-users text-success"></i>
                                                                            @elseif($servicio->grupo=='ENTRANCES')
                                                                                <i class="fas fa-ticket-alt text-warning"></i>
                                                                            @elseif($servicio->grupo=='FOOD')
                                                                                <i class="fas fa-bus text-danger"></i>
                                                                            @elseif($servicio->grupo=='TRAINS')
                                                                                <i class="fas fa-train text-info"></i>
                                                                            @elseif($servicio->grupo=='FLIGHT')
                                                                                <i class="fas fa-plain text-primary"></i>
                                                                            @elseif($servicio->grupo=='OTHERS')
                                                                                <i class="fas fa-question text-success"></i>
                                                                            @endif
                                                                        </td>
                                                                        <td>{{$servicio->nombre}} (<span class="text-primary">{{$servicio->tipoServicio}}</span>)</td>
                                                                        <td><span class="text-warning">{{$servicio->localizacion}}</span></td>
                                                                        <td>
                                                                            @if($servicio->precio_grupo=='1')
                                                                                {{round($servicios->precio/$cotizacion_->nropersonas,2)}}<sub>$</sub> <b>x</b> {{$cotizacion_->nropersonas}} <i class="fas fa-male text-primary"></i>
                                                                            @elseif($servicio->precio_grupo=='0')
                                                                                {{$servicios->precio}}<sub>$</sub> <b>x</b> {{$cotizacion_->nropersonas}} <i class="fas fa-male text-primary"></i>
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if($servicio->precio_grupo=='1')
                                                                                {{$servicios->precio}}
                                                                                @php $total+=$servicios->precio; @endphp
                                                                            @elseif($servicio->precio_grupo=='0')
                                                                                {{$servicios->precio*$cotizacion_->nropersonas}}
                                                                                @php $total+=$servicios->precio*$cotizacion_->nropersonas; @endphp
                                                                            @else
                                                                                -
                                                                            @endif
                                                                            <sub>$</sub>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endforeach
                                                            @foreach($itinerarios->hotel as $hotel)
                                                                <tr>
                                                                    <td>{{$hotel->estrellas}} <i class="fa fa-star text-warning" aria-hidden="true"></i></td>
                                                                    <td>
                                                                        @if($hotel->personas_s>0)
                                                                            <p><b>{{$hotel->personas_s}}</b><i class="fa fa-bed"></i></p>
                                                                        @endif
                                                                        @if($hotel->personas_d>0)
                                                                            <p><b>{{$hotel->personas_d}}</b><i class="fa fa-bed"></i> <i class="fa fa-bed"></i></p>
                                                                        @endif
                                                                        @if($hotel->personas_m>0)
                                                                            <p><b>{{$hotel->personas_m}}</b><i class="fa fa-bed"></i> <i class="fa fa-bed"></i></p>
                                                                        @endif
                                                                        @if($hotel->personas_t>0)
                                                                            <p><b>{{$hotel->personas_t}}</b><i class="fa fa-bed"></i> <i class="fa fa-bed"></i> <i class="fa fa-bed"></i></p>
                                                                        @endif
                                                                    <td><span class="text-warning">{{$hotel->localizacion}}</span></td>
                                                                    <td>
                                                                        @if($hotel->personas_s>0)
                                                                            <p>${{$hotel->precio_s}} x {{$hotel->personas_s}}</p>
                                                                        @endif
                                                                        @if($hotel->personas_d>0)
                                                                            <p>${{$hotel->precio_d}} x {{$hotel->personas_d}}</p>
                                                                        @endif
                                                                        @if($hotel->personas_m>0)
                                                                            <p>${{$hotel->precio_m}} x {{$hotel->personas_m}}</p>
                                                                        @endif
                                                                        @if($hotel->personas_t>0)
                                                                            <p>${{$hotel->precio_t}} x {{$hotel->personas_t}}</p>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if($hotel->personas_s>0)
                                                                            @php
                                                                                $total+=$hotel->precio_s*$hotel->personas_s;
                                                                            @endphp
                                                                            <p>${{$hotel->precio_s*$hotel->personas_s}}</p>
                                                                        @endif
                                                                        @if($hotel->personas_d>0)
                                                                            @php
                                                                                $total+=$hotel->precio_d*$hotel->personas_d;
                                                                            @endphp
                                                                            <p>${{$hotel->precio_d*$hotel->personas_d}}</p>
                                                                        @endif
                                                                        @if($hotel->personas_m>0)
                                                                            @php
                                                                                $total+=$hotel->precio_m*$hotel->personas_m;
                                                                            @endphp
                                                                            <p>${{$hotel->precio_m*$hotel->personas_m}}</p>
                                                                        @endif
                                                                        @if($hotel->personas_t>0)
                                                                            @php
                                                                                $total+=$hotel->precio_t*$hotel->personas_t;
                                                                            @endphp
                                                                            <p>${{$hotel->precio_t*$hotel->personas_t}}</p>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endforeach
                                                        @php
                                                            $profit=0;
                                                        @endphp
                                                        @foreach($paquete->paquete_precios as $pqt_precio)
                                                            @if($pqt_precio->personas_s>0)
                                                                @php
                                                                    $total+=$pqt_precio->utilidad_s;
                                                                    $profit+=$pqt_precio->utilidad_s;
                                                                @endphp
                                                            @endif
                                                            @if($pqt_precio->personas_d>0)
                                                                @php
                                                                    $total+=$pqt_precio->utilidad_d;
                                                                    $profit+=$pqt_precio->utilidad_d;
                                                                @endphp
                                                            @endif
                                                            @if($pqt_precio->personas_m>0)
                                                                @php
                                                                    $total+=$pqt_precio->utilidad_m;
                                                                    $profit+=$pqt_precio->utilidad_m;
                                                                @endphp
                                                            @endif
                                                            @if($pqt_precio->personas_t>0)
                                                                @php
                                                                    $total+=$pqt_precio->utilidad_t;
                                                                    $profit+=$pqt_precio->utilidad_t;
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                        <tr>
                                                            <td colspan="4"><b>COST</b></td>
                                                            <td class="text-right">
                                                                <b>{{$total-$profit}}<sub>$</sub></b>
                                                            </td>
                                                        </tr><tr>
                                                            <td colspan="4"><b>PROFIT</b></td>
                                                            <td class="text-right">
                                                                <b>{{$profit}}<sub>$</sub></b>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4"><b>TOTAL x {{$cotizacion_->nropersonas}} <i class="fas fa-male text-primary"></i></b></td>
                                                            <td class="text-right">
                                                                <b>{{$total}}<sub>$</sub></b>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                @endforeach
                                            </div>
                                            <div class="modal-footer d-none">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Send message</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <span class="badge badge-g-dark">Venta cerrada: {{fecha_peru($cotizacion_->fecha_venta)}}</span> {{$dato_cliente}} x {{$cotizacion_->nropersonas}} {{date_format(date_create($cotizacion_->fecha), 'l jS F Y')}}
                                <b class="badge badge-g-green">Total: {{$total}}<sub>$</sub></b>
                            <!-- Large modal -->
                                <a href="#!" class="text-primary" data-toggle="modal" data-target="#detalle_{{$cotizacion_->id}}"><i class="fas fa-eye"></i></a>
                            </td>
                            <td class="col-lg-2 text-right">
                                <button type="button" class="btn btn-primary" onclick="categorizar('{{$cotizacion_->id}}','C')">C</button>
                                <button type="button" class="btn btn-success" onclick="categorizar('{{$cotizacion_->id}}','S')">S</button>
                            </td>
                        </tr>
                @endforeach
            </table>
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-12 text-center">
                    @php
                        $arra_count_mes_c=array();
                        $arra_count_mes_s=array();
                        for ($i=1;$i<=12;$i++){
                            $arra_count_mes_c[$i]=0;
                            $arra_count_mes_s[$i]=0;
                        }
                    @endphp
                    @php
                        $total_utilidad=0;
                    @endphp
                    @foreach($cotizacion_cat as $cotizacion_cat_)
                        @foreach($cotizacion_cat_->paquete_cotizaciones as $paquete)
                            @if($paquete->estado==2)
                                @php $servicio = 0; @endphp
                                @foreach($paquete->itinerario_cotizaciones as $itinerarios)
                                    @foreach($itinerarios->itinerario_servicios as $servicios)
                                        @php
                                            $servicio+= $servicios->precio
                                        @endphp
                                    @endforeach
                                @endforeach
                                @foreach($paquete->paquete_precios as $precio)
                                    @if($precio->estado==2)
                                        @if($precio->personas_s > 0)
                                            @php
                                                $precio_s = (($precio->precio_s)* 1) * ($cotizacion_cat_->duracion - 1);
                                                $total_costo_s = $precio_s + $servicio;
                                                $total_utilidad += $total_costo_s + ($total_costo_s * (($precio->utilidad)/100));
                                            @endphp
                                        @endif
                                        @if($precio->personas_d > 0)
                                            @php
                                                $precio_d = (($precio->precio_d)* 2) * ($cotizacion_cat_->duracion - 1);
                                                $total_costo_d = $precio_d + $servicio;
                                                $total_utilidad += $total_costo_d + ($total_costo_d * (($precio->utilidad)/100));
                                            @endphp
                                        @endif
                                        @if($precio->personas_m > 0)
                                            @php
                                                $precio_m = (($precio->precio_m)* 2) * ($cotizacion_cat_->duracion - 1);
                                                $total_costo_m = $precio_m + $servicio;
                                                $total_utilidad += $total_costo_m + ($total_costo_m * (($precio->utilidad)/100));
                                            @endphp
                                        @endif
                                        @if($precio->personas_t > 0)
                                            @php
                                                $precio_t = (($precio->precio_t)* 3) * ($cotizacion_cat_->duracion - 1);
                                                $total_costo_t = $precio_t + $servicio;
                                                $total_utilidad += $total_costo_t + ($total_costo_t * (($precio->utilidad)/100));
                                            @endphp
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                        @php
                            $total_utilidad=round($total_utilidad,2);
                        @endphp
                        @if($cotizacion_cat_->categorizado=='C')
                            @php
                                $fecha=explode('-',$cotizacion_cat_->fecha);
                                $arra_count_mes_c[intval($fecha[1])]+=$total_utilidad;
                            @endphp
                        @else
                            @php
                                $fecha=explode('-',$cotizacion_cat_->fecha);
                                $arra_count_mes_s[intval($fecha[1])]+=$total_utilidad;
                            @endphp
                        @endif
                        @php
                            $total_utilidad=0;
                        @endphp
                    @endforeach


                    @php
                        $d_ene=$arra_count_mes_c[1]+$arra_count_mes_s[1];
                        $ene_c=0;
                        $ene_s=0;
                        $ene_c_p=3;
                        $ene_s_p=3;
                        if($d_ene>0){
                            $ene_c=100*round($arra_count_mes_c[1]/$d_ene,2);
                            $ene_s=100-$ene_c;
                            if($ene_c>0)
                                $ene_c_p=$ene_c;
                            if($ene_s>0)
                                $ene_s_p=$ene_s;
                        }
                        $d_feb=($arra_count_mes_c['2']+$arra_count_mes_s['2']);
                        $feb_c=0;
                        $feb_s=0;
                        $feb_c_p=3;
                        $feb_s_p=3;
                        if($d_feb>0){
                            $feb_c=100*round($arra_count_mes_c['2']/$d_feb,2);
                            $feb_s=100-$feb_c;
                            if($feb_c>0)
                                $feb_c_p=$feb_c;
                            if($feb_s>0)
                                $feb_s_p=$feb_s;
                        }
                        $d_may=($arra_count_mes_c['3']+$arra_count_mes_s['3']);
                        $mar_c=0;
                        $mar_s=0;
                        $mar_c_p=3;
                        $mar_s_p=3;
                        if($d_may>0){
                            $mar_c=100*round($arra_count_mes_c['3']/$d_may,2);
                            $mar_s=100-$mar_c;
                            if($mar_c>0)
                                $mar_c_p=$mar_c;
                            if($mar_s>0)
                                $mar_s_p=$mar_s;
                        }
                        $d_abr=$arra_count_mes_c['4']+$arra_count_mes_s['4'];
                        $abr_c=0;
                        $abr_s=0;
                        $abr_c_p=3;
                        $abr_s_p=3;
                        if($d_abr>0){
                            $abr_c=100*round($arra_count_mes_c['4']/$d_abr,2);
                            $abr_s=100-$abr_c;
                            if($abr_c>0)
                                $abr_c_p=$abr_c;
                            if($abr_s>0)
                                $abr_s_p=$abr_s;
                        }
                        $d_may=($arra_count_mes_c['5']+$arra_count_mes_s['5']);
                        $may_c=0;
                        $may_s=0;
                        $may_c_p=3;
                        $may_s_p=3;
                        if($d_may>0){
                            $may_c=100*round($arra_count_mes_c['5']/$d_may,2);
                            $may_s=100-$may_c;
                            if($may_c>0)
                                $may_c_p=$may_c;
                            if($may_s>0)
                                $may_s_p=$may_s;
                        }
                        $d_jun=($arra_count_mes_c['6']+$arra_count_mes_s['6']);
                        $jun_c=0;
                        $jun_s=0;
                        $jun_c_p=3;
                        $jun_s_p=3;
                        if($d_jun>0){
                            $jun_c=100*round($arra_count_mes_c['6']/$d_jun,2);
                            $jun_s=100-$jun_c;
                            if($jun_c>0)
                                $jun_c_p=$jun_c;
                            if($jun_s>0)
                                $jun_s_p=$jun_s;
                        }
                        $d_jul=($arra_count_mes_c['7']+$arra_count_mes_s['7']);
                        $jul_c=0;
                        $jul_s=0;
                        $jul_c_p=3;
                        $jul_s_p=3;
                        if($d_jul>0){
                            $jul_c=100*round($arra_count_mes_c['7']/$d_jul,2);
                            $jul_s=100-$jul_c;
                            if($jul_c>0)
                                $jul_c_p=$jul_c;
                            if($jul_s>0)
                                $jul_s_p=$jul_s;
                        }
                        $d_ago=($arra_count_mes_c['8']+$arra_count_mes_s['8']);
                        $ago_c=0;
                        $ago_s=0;
                        $ago_c_p=3;
                        $ago_s_p=3;
                        if($d_ago>0){
                            $ago_c=100*round($arra_count_mes_c['8']/$d_ago,2);
                            $ago_s=100-$ago_c;
                            if($ago_c>0)
                                $ago_c_p=$ago_c;
                            if($ago_s>0)
                                $ago_s_p=$ago_s;
                        }
                        $d_set=($arra_count_mes_c['9']+$arra_count_mes_s['9']);
                        $set_c=0;
                        $set_s=0;
                        $set_c_p=3;
                        $set_s_p=3;
                        if($d_set>0){
                            $set_c=100*round($arra_count_mes_c['9']/$d_set,2);
                            $set_s=100-$set_c;
                            if($set_c>0)
                                $set_c_p=$set_c;
                            if($set_s>0)
                                $set_s_p=$set_s;

                        }
                        $d_oct=($arra_count_mes_c['10']+$arra_count_mes_s['10']);
                        $oct_c=0;
                        $oct_s=0;
                        $oct_c_p=3;
                        $oct_s_p=3;
                        if($d_oct>0){
                            $oct_c=100*round($arra_count_mes_c['10']/$d_oct,2);
                            $oct_s=100-$oct_c;
                            if($oct_c>0)
                                $oct_c_p=$oct_c;
                            if($oct_s>0)
                                $oct_s_p=$oct_s;
                        }
                        $d_nov=($arra_count_mes_c['11']+$arra_count_mes_s['11']);
                        $nov_c=0;
                        $nov_s=0;
                        $nov_c_p=3;
                        $nov_s_p=3;
                        if($d_nov>0){
                            $nov_c=100*round($arra_count_mes_c['11']/$d_nov,2);
                            $nov_s=100-$nov_c;
                            if($nov_c>0)
                                $nov_c_p=$nov_c;
                            if($nov_s>0)
                                $nov_s_p=$nov_s;
                        }
                        $d_dic=($arra_count_mes_c['12']+$arra_count_mes_s['12']);
                        $dic_c=0;
                        $dic_s=0;
                        $dic_c_p=3;
                        $dic_s_p=3;
                        if($d_dic>0){
                            $dic_c=100*round($arra_count_mes_c['12']/$d_dic,2);
                            $dic_s=100-$dic_c;
                            if($dic_c>0)
                                $dic_c_p=$dic_c;
                            if($dic_s>0)
                                $dic_s_p=$dic_s;

                        }
                    @endphp
                    <div class="panel panel-primary no-margin no-padding">
                        <div class="panel-heading">
                            <h3 class="panel-title">Paquetes con factura</h3>
                        </div>
                        <div class="panel-body">
                            <div class="input-group">
                                {{--<span class="input-group-addon"><a href="{{route('contabilidad_path',[$fecha_pqt-1])}}"><i class="fa fa-step-backward fa-2x" aria-hidden="true"></i></a></span>--}}
                                <span id="anio_s" class="input-group-addon">{{$fecha_pqt}}</span>
                                {{--<span class="input-group-addon"><a href="{{route('contabilidad_path',[$fecha_pqt+1])}}"><i class="fa fa-step-forward fa-2x" aria-hidden="true"></i></a></span>--}}
                            </div>
                            <table align="center" cellpadding="0" cellspacing="0" border="0">
                                <tbody align="center">
                                <tr>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$ene_c}}%</b></div><div id="p_ene_c" class="barrasv btn-primary text-10" style="height:{{$ene_c_p}}px;" onclick="mostra_ventas('ene','c')">${{$arra_count_mes_c[1]}}</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$feb_c}}%</b></div><div id="p_feb_c" class="barrasv btn-warning text-10" style="height:{{$feb_c_p}}px;" onclick="mostra_ventas('feb','c')">${{$arra_count_mes_c[2]}}</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$mar_c}}%</b></div><div id="p_mar_c" class="barrasv btn-info text-10" style="height:{{$mar_c_p}}px;" onclick="mostra_ventas('mar','c')">${{$arra_count_mes_c[3]}}</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$abr_c}}%</b></div><div id="p_abr_c" class="barrasv btn-success text-10" style="height:{{$abr_c_p}}px;" onclick="mostra_ventas('abr','c')">${{$arra_count_mes_c[4]}}</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$may_c}}%</b></div><div id="p_may_c" class="barrasv btn-warning text-10" style="height:{{$may_c_p}}px;" onclick="mostra_ventas('may','c')">${{$arra_count_mes_c[5]}}</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$jun_c}}%</b></div><div id="p_jun_c" class="barrasv btn-info text-10" style="height:{{$jun_c_p}}px;" onclick="mostra_ventas('jun','c')">${{$arra_count_mes_c[6]}}</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$jul_c}}%</b></div><div id="p_jul_c" class="barrasv btn-warning text-10" style="height:{{$jul_c_p}}px;" onclick="mostra_ventas('jul','c')">${{$arra_count_mes_c[7]}}</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$ago_c}}%</b></div><div id="p_ago_c" class="barrasv btn-success text-10" style="height:{{$ago_c_p}}px;" onclick="mostra_ventas('ago','c')">${{$arra_count_mes_c[8]}}</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$set_c}}%</b></div><div id="p_set_c" class="barrasv btn-primary text-10" style="height:{{$set_c_p}}px;" onclick="mostra_ventas('set','c')">${{$arra_count_mes_c[9]}}</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$oct_c}}%</b></div><div id="p_oct_c" class="barrasv btn-danger text-10" style="height:{{$oct_c_p}}px;" onclick="mostra_ventas('oct','c')">${{$arra_count_mes_c[10]}}</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$nov_c}}%</b></div><div id="p_nov_c" class="barrasv btn-success text-10" style="height:{{$nov_c_p}}px;" onclick="mostra_ventas('nov','c')">${{$arra_count_mes_c[11]}}</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$dic_c}}%</b></div><div id="p_dic_c" class="barrasv btn-warning text-10" style="height:{{$dic_c_p}}px;" onclick="mostra_ventas('dic','c')">${{$arra_count_mes_c[12]}}</div></td>
                                </tr>
                                <tr>
                                    <td><b id="n_mes_ene_c" class="mes" onclick="mostra_ventas('ene','c')">Ene</b></td>
                                    <td><b id="n_mes_feb_c" class="mes" onclick="mostra_ventas('feb','c')">Feb</b></td>
                                    <td><b id="n_mes_mar_c" class="mes" onclick="mostra_ventas('mar','c')">Mar</b></td>
                                    <td><b id="n_mes_abr_c" class="mes" onclick="mostra_ventas('abr','c')">Abr</b></td>
                                    <td><b id="n_mes_may_c" class="mes" onclick="mostra_ventas('may','c')">May</b></td>
                                    <td><b id="n_mes_jun_c" class="mes" onclick="mostra_ventas('jun','c')">Jun</b></td>
                                    <td><b id="n_mes_jul_c" class="mes" onclick="mostra_ventas('jul','c')">Jul</b></td>
                                    <td><b id="n_mes_ago_c" class="mes" onclick="mostra_ventas('ago','c')">Ago</b></td>
                                    <td><b id="n_mes_set_c" class="mes" onclick="mostra_ventas('set','c')">Set</b></td>
                                    <td><b id="n_mes_oct_c" class="mes" onclick="mostra_ventas('oct','c')">Oct</b></td>
                                    <td><b id="n_mes_nov_c" class="mes" onclick="mostra_ventas('nov','c')">Nov</b></td>
                                    <td><b id="n_mes_dic_c" class="mes" onclick="mostra_ventas('dic','c')">Dic</b></td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="col-lg-12">
                                <div id="t_ene_c" class="row d-none">
                                    <h3>Lista de paquetes <span class="text-primary">Enero {{$fecha_pqt}}</span> <b class="text-success text-25">$</b><b class="text-success text-25">{{$arra_count_mes_c[1]}}</b></h3>
                                    <table id="ene_c" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Paquete</th>
                                        <th>Detalles</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cotizacion_cat as $cotizacion_cat_)
                                        @if($cotizacion_cat_->categorizado=='C')
                                            @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                                @if($clientes->estado==1)
                                                    @php
                                                        $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->nombres;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @php
                                                $fecha=explode('-',$cotizacion_cat_->fecha);
                                            @endphp
                                            @if(intval($fecha[1])==1)
                                                @php
                                                    $total_utilidad=0;
                                                @endphp
                                                @foreach($cotizacion_cat_->paquete_cotizaciones as $paquete)
                                                    @if($paquete->estado==2)
                                                        @php $servicio = 0; @endphp
                                                        @foreach($paquete->itinerario_cotizaciones as $itinerarios)
                                                            @foreach($itinerarios->itinerario_servicios as $servicios)
                                                                @php
                                                                    $servicio+= $servicios->precio
                                                                @endphp
                                                            @endforeach
                                                        @endforeach
                                                        @foreach($paquete->paquete_precios as $precio)
                                                            @if($precio->estado==2)
                                                                @if($precio->personas_s > 0)
                                                                    @php
                                                                        $precio_s = (($precio->precio_s)* 1) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_s = $precio_s + $servicio;
                                                                        $total_utilidad += $total_costo_s + ($total_costo_s * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                                @if($precio->personas_d > 0)
                                                                    @php
                                                                        $precio_d = (($precio->precio_d)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_d = $precio_d + $servicio;
                                                                        $total_utilidad += $total_costo_d + ($total_costo_d * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                                @if($precio->personas_m > 0)
                                                                    @php
                                                                        $precio_m = (($precio->precio_m)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_m = $precio_m + $servicio;
                                                                        $total_utilidad += $total_costo_m + ($total_costo_m * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                                @if($precio->personas_t > 0)
                                                                    @php
                                                                        $precio_t = (($precio->precio_t)* 3) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_t = $precio_t + $servicio;
                                                                        $total_utilidad += $total_costo_t + ($total_costo_t * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                                <tr>
                                                    <td>{{$dato_cliente}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'l jS F Y')}}</td>
                                                    <td><span class="badge text-right">$ {{$total_utilidad}}</span></td>
                                                </tr>

                                            @endif
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                </div>
                                <div id="t_feb_c" class="row d-none">
                                    <h3>Lista de paquetes <span class="text-primary">Febrero {{$fecha_pqt}}</span> <b class="text-success text-25">$</b><b class="text-success text-25">{{$arra_count_mes_c[2]}}</b></h3>
                                    <table id="feb_c" class="table table-striped table-bordered table-responsive " cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Paquete</th>
                                        <th>Detalles</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cotizacion_cat as $cotizacion_cat_)
                                        @if($cotizacion_cat_->categorizado=='C')
                                            @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                                @if($clientes->estado==1)
                                                    @php
                                                        $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->nombres;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @php
                                                $fecha=explode('-',$cotizacion_cat_->fecha);
                                            @endphp
                                            @if(intval($fecha[1])==2)
                                                @php
                                                    $total_utilidad=0;
                                                @endphp
                                                @foreach($cotizacion_cat_->paquete_cotizaciones as $paquete)
                                                    @if($paquete->estado==2)
                                                        @php $servicio = 0; @endphp
                                                        @foreach($paquete->itinerario_cotizaciones as $itinerarios)
                                                            @foreach($itinerarios->itinerario_servicios as $servicios)
                                                                @php
                                                                    $servicio+= $servicios->precio
                                                                @endphp
                                                            @endforeach
                                                        @endforeach
                                                        @foreach($paquete->paquete_precios as $precio)
                                                            @if($precio->estado==2)
                                                                @if($precio->personas_s > 0)
                                                                    @php
                                                                        $precio_s = (($precio->precio_s)* 1) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_s = $precio_s + $servicio;
                                                                        $total_utilidad += $total_costo_s + ($total_costo_s * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                                @if($precio->personas_d > 0)
                                                                    @php
                                                                        $precio_d = (($precio->precio_d)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_d = $precio_d + $servicio;
                                                                        $total_utilidad += $total_costo_d + ($total_costo_d * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                                @if($precio->personas_m > 0)
                                                                    @php
                                                                        $precio_m = (($precio->precio_m)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_m = $precio_m + $servicio;
                                                                        $total_utilidad += $total_costo_m + ($total_costo_m * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                                @if($precio->personas_t > 0)
                                                                    @php
                                                                        $precio_t = (($precio->precio_t)* 3) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_t = $precio_t + $servicio;
                                                                        $total_utilidad += $total_costo_t + ($total_costo_t * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                                <tr>
                                                    <td>{{$dato_cliente}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'l jS F Y')}}</td>
                                                    <td><span class="badge text-right">$ {{$total_utilidad}}</span></td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                </div>
                                <div id="t_mar_c" class="row d-none">
                                    <h3>Lista de paquetes <span class="text-primary">Marzo {{$fecha_pqt}}</span> <b class="text-success text-25">$</b><b class="text-success text-25">{{$arra_count_mes_c[3]}}</b></h3>
                                    <table id="mar_c" class="table table-striped table-bordered table-responsive " cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Paquete</th>
                                        <th>Detalles</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cotizacion_cat as $cotizacion_cat_)
                                        @if($cotizacion_cat_->categorizado=='C')
                                            @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                                @if($clientes->estado==1)
                                                    @php
                                                        $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->nombres;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @php
                                                $fecha=explode('-',$cotizacion_cat_->fecha);
                                            @endphp
                                            @if(intval($fecha[1])==3)
                                                @php
                                                    $total_utilidad=0;
                                                @endphp
                                                @foreach($cotizacion_cat_->paquete_cotizaciones as $paquete)
                                                    @if($paquete->estado==2)
                                                        @php $servicio = 0; @endphp
                                                        @foreach($paquete->itinerario_cotizaciones as $itinerarios)
                                                            @foreach($itinerarios->itinerario_servicios as $servicios)
                                                                @php
                                                                    $servicio+= $servicios->precio
                                                                @endphp
                                                            @endforeach
                                                        @endforeach
                                                        @foreach($paquete->paquete_precios as $precio)
                                                            @if($precio->estado==2)
                                                                @if($precio->personas_s > 0)
                                                                    @php
                                                                        $precio_s = (($precio->precio_s)* 1) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_s = $precio_s + $servicio;
                                                                        $total_utilidad += $total_costo_s + ($total_costo_s * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                                @if($precio->personas_d > 0)
                                                                    @php
                                                                        $precio_d = (($precio->precio_d)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_d = $precio_d + $servicio;
                                                                        $total_utilidad += $total_costo_d + ($total_costo_d * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                                @if($precio->personas_m > 0)
                                                                    @php
                                                                        $precio_m = (($precio->precio_m)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_m = $precio_m + $servicio;
                                                                        $total_utilidad += $total_costo_m + ($total_costo_m * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                                @if($precio->personas_t > 0)
                                                                    @php
                                                                        $precio_t = (($precio->precio_t)* 3) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_t = $precio_t + $servicio;
                                                                        $total_utilidad += $total_costo_t + ($total_costo_t * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                                <tr>
                                                    <td>{{$dato_cliente}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'l jS F Y')}}</td>
                                                    <td><span class="badge text-right">$ {{$total_utilidad}}</span></td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                </div>
                                <div id="t_abr_c" class="row d-none">
                                    <h3>Lista de paquetes <span class="text-primary">Abril {{$fecha_pqt}}</span> <b class="text-success text-25">$</b><b class="text-success text-25">{{$arra_count_mes_c[4]}}</b></h3>
                                    <table id="abr_c" class="table table-striped table-bordered table-responsive " cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Paquete</th>
                                        <th>Detalles</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cotizacion_cat as $cotizacion_cat_)
                                        @if($cotizacion_cat_->categorizado=='C')
                                            @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                                @if($clientes->estado==1)
                                                    @php
                                                        $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->nombres;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @php
                                                $fecha=explode('-',$cotizacion_cat_->fecha);
                                            @endphp
                                            @if(intval($fecha[1])==4)
                                                @php
                                                    $total_utilidad=0;
                                                @endphp
                                                @foreach($cotizacion_cat_->paquete_cotizaciones as $paquete)
                                                    @if($paquete->estado==2)
                                                        @php $servicio = 0; @endphp
                                                        @foreach($paquete->itinerario_cotizaciones as $itinerarios)
                                                            @foreach($itinerarios->itinerario_servicios as $servicios)
                                                                @php
                                                                    $servicio+= $servicios->precio
                                                                @endphp
                                                            @endforeach
                                                        @endforeach
                                                        @foreach($paquete->paquete_precios as $precio)
                                                            @if($precio->estado==2)
                                                                @if($precio->personas_s > 0)
                                                                    @php
                                                                        $precio_s = (($precio->precio_s)* 1) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_s = $precio_s + $servicio;
                                                                        $total_utilidad += $total_costo_s + ($total_costo_s * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                                @if($precio->personas_d > 0)
                                                                    @php
                                                                        $precio_d = (($precio->precio_d)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_d = $precio_d + $servicio;
                                                                        $total_utilidad += $total_costo_d + ($total_costo_d * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                                @if($precio->personas_m > 0)
                                                                    @php
                                                                        $precio_m = (($precio->precio_m)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_m = $precio_m + $servicio;
                                                                        $total_utilidad += $total_costo_m + ($total_costo_m * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                                @if($precio->personas_t > 0)
                                                                    @php
                                                                        $precio_t = (($precio->precio_t)* 3) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_t = $precio_t + $servicio;
                                                                        $total_utilidad += $total_costo_t + ($total_costo_t * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                                <tr>
                                                    <td>{{$dato_cliente}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'l jS F Y')}}</td>
                                                    <td><span class="badge text-right">$ {{$total_utilidad}}</span></td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                </div>
                                <div id="t_may_c" class="row d-none">
                                    <h3>Lista de paquetes <span class="text-primary">Mayo {{$fecha_pqt}}</span> <b class="text-success text-25">$</b><b class="text-success text-25">{{$arra_count_mes_c[5]}}</b></h3>
                                    <table id="may_c" class="table table-striped table-bordered table-responsive " cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Paquete</th>
                                        <th>Detalles</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cotizacion_cat as $cotizacion_cat_)
                                        @if($cotizacion_cat_->categorizado=='C')
                                            @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                                @if($clientes->estado==1)
                                                    @php
                                                        $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->nombres;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @php
                                                $fecha=explode('-',$cotizacion_cat_->fecha);
                                            @endphp
                                            @if(intval($fecha[1])==5)
                                                @php
                                                    $total_utilidad=0;
                                                @endphp
                                                @foreach($cotizacion_cat_->paquete_cotizaciones as $paquete)
                                                    @if($paquete->estado==2)
                                                        @php $servicio = 0; @endphp
                                                        @foreach($paquete->itinerario_cotizaciones as $itinerarios)
                                                            @foreach($itinerarios->itinerario_servicios as $servicios)
                                                                @php
                                                                    $servicio+= $servicios->precio
                                                                @endphp
                                                            @endforeach
                                                        @endforeach
                                                        @foreach($paquete->paquete_precios as $precio)
                                                            @if($precio->estado==2)
                                                                @if($precio->personas_s > 0)
                                                                    @php
                                                                        $precio_s = (($precio->precio_s)* 1) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_s = $precio_s + $servicio;
                                                                        $total_utilidad += $total_costo_s + ($total_costo_s * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                                @if($precio->personas_d > 0)
                                                                    @php
                                                                        $precio_d = (($precio->precio_d)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_d = $precio_d + $servicio;
                                                                        $total_utilidad += $total_costo_d + ($total_costo_d * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                                @if($precio->personas_m > 0)
                                                                    @php
                                                                        $precio_m = (($precio->precio_m)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_m = $precio_m + $servicio;
                                                                        $total_utilidad += $total_costo_m + ($total_costo_m * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                                @if($precio->personas_t > 0)
                                                                    @php
                                                                        $precio_t = (($precio->precio_t)* 3) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_t = $precio_t + $servicio;
                                                                        $total_utilidad += $total_costo_t + ($total_costo_t * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                                <tr>
                                                    <td>{{$dato_cliente}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'l jS F Y')}}</td>
                                                    <td><span class="badge text-right">$ {{$total_utilidad}}</span></td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                </div>
                                <div id="t_jun_c" class="row d-none">
                                    <h3>Lista de paquetes <span class="text-primary">Junio {{$fecha_pqt}}</span> <b class="text-success text-25">$</b><b class="text-success text-25">{{$arra_count_mes_c[6]}}</b></h3>
                                    <table id="jun_c" class="table table-striped table-bordered table-responsive " cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Paquete</th>
                                        <th>Detalles</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cotizacion_cat as $cotizacion_cat_)
                                        @if($cotizacion_cat_->categorizado=='C')
                                            @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                                @if($clientes->estado==1)
                                                    @php
                                                        $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->nombres;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @php
                                                $fecha=explode('-',$cotizacion_cat_->fecha);
                                            @endphp
                                            @if(intval($fecha[1])==6)
                                                @php
                                                    $total_utilidad=0;
                                                @endphp
                                                @foreach($cotizacion_cat_->paquete_cotizaciones as $paquete)
                                                    @if($paquete->estado==2)
                                                        @php $servicio = 0; @endphp
                                                        @foreach($paquete->itinerario_cotizaciones as $itinerarios)
                                                            @foreach($itinerarios->itinerario_servicios as $servicios)
                                                                @php
                                                                    $servicio+= $servicios->precio
                                                                @endphp
                                                            @endforeach
                                                        @endforeach
                                                        @foreach($paquete->paquete_precios as $precio)
                                                            @if($precio->estado==2)
                                                                @if($precio->personas_s > 0)
                                                                    @php
                                                                        $precio_s = (($precio->precio_s)* 1) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_s = $precio_s + $servicio;
                                                                        $total_utilidad += $total_costo_s + ($total_costo_s * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                                @if($precio->personas_d > 0)
                                                                    @php
                                                                        $precio_d = (($precio->precio_d)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_d = $precio_d + $servicio;
                                                                        $total_utilidad += $total_costo_d + ($total_costo_d * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                                @if($precio->personas_m > 0)
                                                                    @php
                                                                        $precio_m = (($precio->precio_m)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_m = $precio_m + $servicio;
                                                                        $total_utilidad += $total_costo_m + ($total_costo_m * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                                @if($precio->personas_t > 0)
                                                                    @php
                                                                        $precio_t = (($precio->precio_t)* 3) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_t = $precio_t + $servicio;
                                                                        $total_utilidad += $total_costo_t + ($total_costo_t * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                                <tr>
                                                    <td>{{$dato_cliente}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'l jS F Y')}}</td>
                                                    <td><span class="badge text-right">$ {{$total_utilidad}}</span></td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                </div>
                                <div id="t_jul_c" class="row d-none">
                                    <h3>Lista de paquetes <span class="text-primary">Julio {{$fecha_pqt}}</span> <b class="text-success text-25">$</b><b class="text-success text-25">{{$arra_count_mes_c[7]}}</b></h3>
                                    <table id="jul_c" class="table table-striped table-bordered table-responsive " cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Paquete</th>
                                        <th>Detalles</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cotizacion_cat as $cotizacion_cat_)
                                        @if($cotizacion_cat_->categorizado=='C')
                                            @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                                @if($clientes->estado==1)
                                                    @php
                                                        $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->nombres;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @php
                                                $fecha=explode('-',$cotizacion_cat_->fecha);
                                            @endphp
                                            @if(intval($fecha[1])==7)
                                                @php
                                                    $total_utilidad=0;
                                                @endphp
                                                @foreach($cotizacion_cat_->paquete_cotizaciones as $paquete)
                                                    @if($paquete->estado==2)
                                                        @php $servicio = 0; @endphp
                                                        @foreach($paquete->itinerario_cotizaciones as $itinerarios)
                                                            @foreach($itinerarios->itinerario_servicios as $servicios)
                                                                @php
                                                                    $servicio+= $servicios->precio
                                                                @endphp
                                                            @endforeach
                                                        @endforeach
                                                        @foreach($paquete->paquete_precios as $precio)
                                                            @if($precio->estado==2)
                                                                @if($precio->personas_s > 0)
                                                                    @php
                                                                        $precio_s = (($precio->precio_s)* 1) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_s = $precio_s + $servicio;
                                                                        $total_utilidad += $total_costo_s + ($total_costo_s * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                                @if($precio->personas_d > 0)
                                                                    @php
                                                                        $precio_d = (($precio->precio_d)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_d = $precio_d + $servicio;
                                                                        $total_utilidad += $total_costo_d + ($total_costo_d * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                                @if($precio->personas_m > 0)
                                                                    @php
                                                                        $precio_m = (($precio->precio_m)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_m = $precio_m + $servicio;
                                                                        $total_utilidad += $total_costo_m + ($total_costo_m * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                                @if($precio->personas_t > 0)
                                                                    @php
                                                                        $precio_t = (($precio->precio_t)* 3) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_t = $precio_t + $servicio;
                                                                        $total_utilidad += $total_costo_t + ($total_costo_t * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                                <tr>
                                                    <td>{{$dato_cliente}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'l jS F Y')}}</td>
                                                    <td><span class="badge text-right">$ {{$total_utilidad}}</span></td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                </div>
                                <div id="t_ago_c" class="row d-none">
                                    <h3>Lista de paquetes <span class="text-primary">Agosto {{$fecha_pqt}}</span> <b class="text-success text-25">$</b><b class="text-success text-25">{{$arra_count_mes_c[8]}}</b></h3>
                                    <table id="ago_c" class="table table-striped table-bordered table-responsive " cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Paquete</th>
                                        <th>Detalles</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cotizacion_cat as $cotizacion_cat_)
                                        @if($cotizacion_cat_->categorizado=='C')
                                            @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                                @if($clientes->estado==1)
                                                    @php
                                                        $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->nombres;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @php
                                                $fecha=explode('-',$cotizacion_cat_->fecha);
                                            @endphp
                                            @if(intval($fecha[1])==8)
                                                @php
                                                    $total_utilidad=0;
                                                @endphp
                                                @foreach($cotizacion_cat_->paquete_cotizaciones as $paquete)
                                                    @if($paquete->estado==2)
                                                        @php $servicio = 0; @endphp
                                                        @foreach($paquete->itinerario_cotizaciones as $itinerarios)
                                                            @foreach($itinerarios->itinerario_servicios as $servicios)
                                                                @php
                                                                    $servicio+= $servicios->precio
                                                                @endphp
                                                            @endforeach
                                                        @endforeach
                                                        @foreach($paquete->paquete_precios as $precio)
                                                            @if($precio->estado==2)
                                                                @if($precio->personas_s > 0)
                                                                    @php
                                                                        $precio_s = (($precio->precio_s)* 1) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_s = $precio_s + $servicio;
                                                                        $total_utilidad += $total_costo_s + ($total_costo_s * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                                @if($precio->personas_d > 0)
                                                                    @php
                                                                        $precio_d = (($precio->precio_d)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_d = $precio_d + $servicio;
                                                                        $total_utilidad += $total_costo_d + ($total_costo_d * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                                @if($precio->personas_m > 0)
                                                                    @php
                                                                        $precio_m = (($precio->precio_m)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_m = $precio_m + $servicio;
                                                                        $total_utilidad += $total_costo_m + ($total_costo_m * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                                @if($precio->personas_t > 0)
                                                                    @php
                                                                        $precio_t = (($precio->precio_t)* 3) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_t = $precio_t + $servicio;
                                                                        $total_utilidad += $total_costo_t + ($total_costo_t * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                                <tr>
                                                    <td>{{$dato_cliente}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'l jS F Y')}}</td>
                                                    <td><span class="badge text-right">$ {{$total_utilidad}}</span></td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                </div>
                                <div id="t_set_c" class="row d-none">
                                    <h3>Lista de paquetes <span class="text-primary">Septiembre {{$fecha_pqt}}</span> <b class="text-success text-25">$</b><b class="text-success text-25">{{$arra_count_mes_c[9]}}</b></h3>
                                    <table id="set_c" class="table table-striped table-bordered table-responsive " cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Paquete</th>
                                        <th>Detalles</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cotizacion_cat as $cotizacion_cat_)
                                        @if($cotizacion_cat_->categorizado=='C')
                                            @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                                @if($clientes->estado==1)
                                                    @php
                                                        $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->nombres;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @php
                                                $fecha=explode('-',$cotizacion_cat_->fecha);
                                            @endphp
                                            @if(intval($fecha[1])==9)
                                                @php
                                                    $total_utilidad=0;
                                                @endphp
                                                @foreach($cotizacion_cat_->paquete_cotizaciones as $paquete)
                                                    @if($paquete->estado==2)
                                                        @php $servicio = 0; @endphp
                                                        @foreach($paquete->itinerario_cotizaciones as $itinerarios)
                                                            @foreach($itinerarios->itinerario_servicios as $servicios)
                                                                @php
                                                                    $servicio+= $servicios->precio
                                                                @endphp
                                                            @endforeach
                                                        @endforeach
                                                        @foreach($paquete->paquete_precios as $precio)
                                                            @if($precio->estado==2)
                                                                @if($precio->personas_s > 0)
                                                                    @php
                                                                        $precio_s = (($precio->precio_s)* 1) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_s = $precio_s + $servicio;
                                                                        $total_utilidad += $total_costo_s + ($total_costo_s * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                                @if($precio->personas_d > 0)
                                                                    @php
                                                                        $precio_d = (($precio->precio_d)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_d = $precio_d + $servicio;
                                                                        $total_utilidad += $total_costo_d + ($total_costo_d * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                                @if($precio->personas_m > 0)
                                                                    @php
                                                                        $precio_m = (($precio->precio_m)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_m = $precio_m + $servicio;
                                                                        $total_utilidad += $total_costo_m + ($total_costo_m * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                                @if($precio->personas_t > 0)
                                                                    @php
                                                                        $precio_t = (($precio->precio_t)* 3) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_t = $precio_t + $servicio;
                                                                        $total_utilidad += $total_costo_t + ($total_costo_t * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                                <tr>
                                                    <td>{{$dato_cliente}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'l jS F Y')}}</td>
                                                    <td><span class="badge text-right">$ {{$total_utilidad}}</span></td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                </div>
                                <div id="t_oct_c" class="row d-none">
                                    <h3>Lista de paquetes <span class="text-primary">Octubre {{$fecha_pqt}}</span> <b class="text-success text-25">$</b><b class="text-success text-25">{{$arra_count_mes_c[10]}}</b></h3>
                                    <table id="oct_c" class="table table-striped table-bordered table-responsive " cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Paquete</th>
                                        <th>Detalles</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cotizacion_cat as $cotizacion_cat_)
                                        @if($cotizacion_cat_->categorizado=='C')
                                            @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                                @if($clientes->estado==1)
                                                    @php
                                                        $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->nombres;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @php
                                                $fecha=explode('-',$cotizacion_cat_->fecha);
                                            @endphp
                                            @if(intval($fecha[1])==10)
                                                @php
                                                    $total_utilidad=0;
                                                @endphp
                                                @foreach($cotizacion_cat_->paquete_cotizaciones as $paquete)
                                                    @if($paquete->estado==2)
                                                        @php $servicio = 0; @endphp
                                                        @foreach($paquete->itinerario_cotizaciones as $itinerarios)
                                                            @foreach($itinerarios->itinerario_servicios as $servicios)
                                                                @php
                                                                    $servicio+= $servicios->precio
                                                                @endphp
                                                            @endforeach
                                                        @endforeach
                                                        @foreach($paquete->paquete_precios as $precio)
                                                            @if($precio->estado==2)
                                                                @if($precio->personas_s > 0)
                                                                    @php
                                                                        $precio_s = (($precio->precio_s)* 1) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_s = $precio_s + $servicio;
                                                                        $total_utilidad += $total_costo_s + ($total_costo_s * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                                @if($precio->personas_d > 0)
                                                                    @php
                                                                        $precio_d = (($precio->precio_d)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_d = $precio_d + $servicio;
                                                                        $total_utilidad += $total_costo_d + ($total_costo_d * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                                @if($precio->personas_m > 0)
                                                                    @php
                                                                        $precio_m = (($precio->precio_m)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_m = $precio_m + $servicio;
                                                                        $total_utilidad += $total_costo_m + ($total_costo_m * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                                @if($precio->personas_t > 0)
                                                                    @php
                                                                        $precio_t = (($precio->precio_t)* 3) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_t = $precio_t + $servicio;
                                                                        $total_utilidad += $total_costo_t + ($total_costo_t * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                                <tr>
                                                    <td>{{$dato_cliente}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'l jS F Y')}}</td>
                                                    <td><span class="badge text-right">$ {{$total_utilidad}}</span></td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                </div>
                                <div id="t_nov_c" class="row d-none">
                                    <h3>Lista de paquetes <span class="text-primary">Noviembre {{$fecha_pqt}}</span> <b class="text-success text-25">$</b><b class="text-success text-25">{{$arra_count_mes_c[11]}}</b></h3>
                                    <table id="nov_c" class="table table-striped table-bordered table-responsive " cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Paquete</th>
                                        <th>Detalles</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cotizacion_cat as $cotizacion_cat_)
                                        @if($cotizacion_cat_->categorizado=='C')
                                            @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                                @if($clientes->estado==1)
                                                    @php
                                                        $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->nombres;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @php
                                                $fecha=explode('-',$cotizacion_cat_->fecha);
                                            @endphp
                                            @if(intval($fecha[1])==11)
                                                @php
                                                    $total_utilidad=0;
                                                @endphp
                                                @foreach($cotizacion_cat_->paquete_cotizaciones as $paquete)
                                                    @if($paquete->estado==2)
                                                        @php $servicio = 0; @endphp
                                                        @foreach($paquete->itinerario_cotizaciones as $itinerarios)
                                                            @foreach($itinerarios->itinerario_servicios as $servicios)
                                                                @php
                                                                    $servicio+= $servicios->precio
                                                                @endphp
                                                            @endforeach
                                                        @endforeach
                                                        @foreach($paquete->paquete_precios as $precio)
                                                            @if($precio->estado==2)
                                                                @if($precio->personas_s > 0)
                                                                    @php
                                                                        $precio_s = (($precio->precio_s)* 1) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_s = $precio_s + $servicio;
                                                                        $total_utilidad += $total_costo_s + ($total_costo_s * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                                @if($precio->personas_d > 0)
                                                                    @php
                                                                        $precio_d = (($precio->precio_d)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_d = $precio_d + $servicio;
                                                                        $total_utilidad += $total_costo_d + ($total_costo_d * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                                @if($precio->personas_m > 0)
                                                                    @php
                                                                        $precio_m = (($precio->precio_m)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_m = $precio_m + $servicio;
                                                                        $total_utilidad += $total_costo_m + ($total_costo_m * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                                @if($precio->personas_t > 0)
                                                                    @php
                                                                        $precio_t = (($precio->precio_t)* 3) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_t = $precio_t + $servicio;
                                                                        $total_utilidad += $total_costo_t + ($total_costo_t * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                                <tr>
                                                    <td>{{$dato_cliente}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'l jS F Y')}}</td>
                                                    <td><span class="badge text-right">$ {{$total_utilidad}}</span></td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                </div>
                                <div id="t_dic_c" class="row d-none">
                                    <h3>Lista de paquetes <span class="text-primary">Diciembre {{$fecha_pqt}}</span> <b class="text-success text-25">$</b><b class="text-success text-25">{{$arra_count_mes_c[12]}}</b></h3>
                                    <table id="dic_c" class="table table-striped table-bordered table-responsive " cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Paquete</th>
                                        <th>Detalles</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cotizacion_cat as $cotizacion_cat_)
                                        @if($cotizacion_cat_->categorizado=='C')
                                            @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                                @if($clientes->estado==1)
                                                    @php
                                                        $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->nombres;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @php
                                                $fecha=explode('-',$cotizacion_cat_->fecha);
                                            @endphp
                                            @if(intval($fecha[1])==12)
                                                @php
                                                    $total_utilidad=0;
                                                @endphp
                                                @foreach($cotizacion_cat_->paquete_cotizaciones as $paquete)
                                                    @if($paquete->estado==2)
                                                        @php $servicio = 0; @endphp
                                                        @foreach($paquete->itinerario_cotizaciones as $itinerarios)
                                                            @foreach($itinerarios->itinerario_servicios as $servicios)
                                                                @php
                                                                    $servicio+= $servicios->precio
                                                                @endphp
                                                            @endforeach
                                                        @endforeach
                                                        @foreach($paquete->paquete_precios as $precio)
                                                            @if($precio->estado==2)
                                                                @if($precio->personas_s > 0)
                                                                    @php
                                                                        $precio_s = (($precio->precio_s)* 1) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_s = $precio_s + $servicio;
                                                                        $total_utilidad += $total_costo_s + ($total_costo_s * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                                @if($precio->personas_d > 0)
                                                                    @php
                                                                        $precio_d = (($precio->precio_d)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_d = $precio_d + $servicio;
                                                                        $total_utilidad += $total_costo_d + ($total_costo_d * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                                @if($precio->personas_m > 0)
                                                                    @php
                                                                        $precio_m = (($precio->precio_m)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_m = $precio_m + $servicio;
                                                                        $total_utilidad += $total_costo_m + ($total_costo_m * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                                @if($precio->personas_t > 0)
                                                                    @php
                                                                        $precio_t = (($precio->precio_t)* 3) * ($cotizacion_cat_->duracion - 1);
                                                                        $total_costo_t = $precio_t + $servicio;
                                                                        $total_utilidad += $total_costo_t + ($total_costo_t * (($precio->utilidad)/100));
                                                                    @endphp
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                                <tr>
                                                    <td>{{$dato_cliente}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'l jS F Y')}}</td>
                                                    <td><span class="badge text-right">$ {{$total_utilidad}}</span></td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">Paquetes sin factura</h3>
                        </div>
                        <div class="panel-body">
                            <div class="input-group">
                                <span class="input-group-addon"><a href="{{route('contabilidad_path',[$fecha_pqt-1])}}"><i class="fa fa-step-backward fa-2x" aria-hidden="true"></i></a></span>
                                <span id="anio_c" class="input-group-addon">{{$fecha_pqt}}</span>
                                <span class="input-group-addon"><a href="{{route('contabilidad_path',[$fecha_pqt+1])}}"><i class="fa fa-step-forward fa-2x" aria-hidden="true"></i></a></span>
                            </div>
                            <table align="center" cellpadding="0" cellspacing="0" border="0">
                                <tbody align="center">
                                <tr>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$ene_s}}%</b></div><div id="p_ene_s" class="barrasv btn-primary text-10" style="height:{{$ene_s_p}}px;" onclick="mostra_ventas('ene','s')">${{$arra_count_mes_s[1]}}</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$feb_s}}%</b></div><div id="p_feb_s" class="barrasv btn-warning text-10" style="height:{{$feb_s_p}}px;" onclick="mostra_ventas('feb','s')">${{$arra_count_mes_s[2]}}</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$mar_s}}%</b></div><div id="p_mar_s" class="barrasv btn-info text-10" style="height:{{$mar_s_p}}px;" onclick="mostra_ventas('mar','s')">${{$arra_count_mes_s[3]}}</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$abr_s}}%</b></div><div id="p_abr_s" class="barrasv btn-success text-10" style="height:{{$abr_s_p}}px;" onclick="mostra_ventas('abr','s')">${{$arra_count_mes_s[4]}}</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$may_s}}%</b></div><div id="p_may_s" class="barrasv btn-warning text-10" style="height:{{$may_s_p}}px;" onclick="mostra_ventas('may','s')">${{$arra_count_mes_s[5]}}</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$jun_s}}%</b></div><div id="p_jun_s" class="barrasv btn-info text-10" style="height:{{$jun_s_p}}px;" onclick="mostra_ventas('jun','s')">${{$arra_count_mes_s[6]}}</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$jul_s}}%</b></div><div id="p_jul_s" class="barrasv btn-warning text-10" style="height:{{$jul_s_p}}px;" onclick="mostra_ventas('jul','s')">${{$arra_count_mes_s[7]}}</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$ago_s}}%</b></div><div id="p_ago_s" class="barrasv btn-success text-10" style="height:{{$ago_s_p}}px;" onclick="mostra_ventas('ago','s')">${{$arra_count_mes_s[8]}}</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$set_s}}%</b></div><div id="p_set_s" class="barrasv btn-primary text-10" style="height:{{$set_s_p}}px;" onclick="mostra_ventas('set','s')">${{$arra_count_mes_s[9]}}</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$oct_s}}%</b></div><div id="p_oct_s" class="barrasv btn-danger text-10" style="height:{{$oct_s_p}}px;" onclick="mostra_ventas('oct','s')">${{$arra_count_mes_s[10]}}</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$nov_s}}%</b></div><div id="p_nov_s" class="barrasv btn-success text-10" style="height:{{$nov_s_p}}px;" onclick="mostra_ventas('nov','s')">${{$arra_count_mes_s[11]}}</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$dic_s}}%</b></div><div id="p_dic_s" class="barrasv btn-warning text-10" style="height:{{$dic_s_p}}px;" onclick="mostra_ventas('dic','s')">${{$arra_count_mes_s[12]}}</div></td>
                                </tr>
                                <tr>
                                    <td><b id="n_mes_ene_s" class="mes" onclick="mostra_ventas('ene','s')">Ene</b></td>
                                    <td><b id="n_mes_feb_s" class="mes" onclick="mostra_ventas('feb','s')">Feb</b></td>
                                    <td><b id="n_mes_mar_s" class="mes" onclick="mostra_ventas('mar','s')">Mar</b></td>
                                    <td><b id="n_mes_abr_s" class="mes" onclick="mostra_ventas('abr','s')">Abr</b></td>
                                    <td><b id="n_mes_may_s" class="mes" onclick="mostra_ventas('may','s')">May</b></td>
                                    <td><b id="n_mes_jun_s" class="mes" onclick="mostra_ventas('jun','s')">Jun</b></td>
                                    <td><b id="n_mes_jul_s" class="mes" onclick="mostra_ventas('jul','s')">Jul</b></td>
                                    <td><b id="n_mes_ago_s" class="mes" onclick="mostra_ventas('ago','s')">Ago</b></td>
                                    <td><b id="n_mes_set_s" class="mes" onclick="mostra_ventas('set','s')">Set</b></td>
                                    <td><b id="n_mes_oct_s" class="mes" onclick="mostra_ventas('oct','s')">Oct</b></td>
                                    <td><b id="n_mes_nov_s" class="mes" onclick="mostra_ventas('nov','s')">Nov</b></td>
                                    <td><b id="n_mes_dic_s" class="mes" onclick="mostra_ventas('dic','s')">Dic</b></td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="col-lg-12">
                                <div id="t_ene_s" class="row d-none">
                                    <h3>Lista de paquetes <span class="text-primary">Enero {{$fecha_pqt}}</span> <b class="text-success text-25">$</b><b class="text-success text-25">{{$arra_count_mes_s[1]}}</b></h3>
                                    <table id="ene_s" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Paquete</th>
                                            <th>Detalles</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cotizacion_cat as $cotizacion_cat_)
                                            @if($cotizacion_cat_->categorizado=='S')
                                                @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                                    @if($clientes->estado==1)
                                                        @php
                                                            $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->nombres;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                @php
                                                    $fecha=explode('-',$cotizacion_cat_->fecha);
                                                @endphp
                                                @if(intval($fecha[1])==1)
                                                    @php
                                                        $total_utilidad=0;
                                                    @endphp
                                                    @foreach($cotizacion_cat_->paquete_cotizaciones as $paquete)
                                                        @if($paquete->estado==2)
                                                            @php $servicio = 0; @endphp
                                                            @foreach($paquete->itinerario_cotizaciones as $itinerarios)
                                                                @foreach($itinerarios->itinerario_servicios as $servicios)
                                                                    @php
                                                                        $servicio+= $servicios->precio
                                                                    @endphp
                                                                @endforeach
                                                            @endforeach
                                                            @foreach($paquete->paquete_precios as $precio)
                                                                @if($precio->estado==2)
                                                                    @if($precio->personas_s > 0)
                                                                        @php
                                                                            $precio_s = (($precio->precio_s)* 1) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_s = $precio_s + $servicio;
                                                                            $total_utilidad += $total_costo_s + ($total_costo_s * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                    @if($precio->personas_d > 0)
                                                                        @php
                                                                            $precio_d = (($precio->precio_d)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_d = $precio_d + $servicio;
                                                                            $total_utilidad += $total_costo_d + ($total_costo_d * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                    @if($precio->personas_m > 0)
                                                                        @php
                                                                            $precio_m = (($precio->precio_m)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_m = $precio_m + $servicio;
                                                                            $total_utilidad += $total_costo_m + ($total_costo_m * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                    @if($precio->personas_t > 0)
                                                                        @php
                                                                            $precio_t = (($precio->precio_t)* 3) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_t = $precio_t + $servicio;
                                                                            $total_utilidad += $total_costo_t + ($total_costo_t * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                    <tr>
                                                        <td>{{$dato_cliente}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'l jS F Y')}}</td>
                                                        <td><span class="badge text-right">$ {{$total_utilidad}}</span></td>
                                                    </tr>

                                                @endif
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div id="t_feb_s" class="row d-none">
                                    <h3>Lista de paquetes <span class="text-primary">Febrero {{$fecha_pqt}}</span> <b class="text-success text-25">$</b><b class="text-success text-25">{{$arra_count_mes_s[2]}}</b></h3>
                                    <table id="feb_s" class="table table-striped table-bordered table-responsive " cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Paquete</th>
                                            <th>Detalles</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cotizacion_cat as $cotizacion_cat_)
                                            @if($cotizacion_cat_->categorizado=='S')
                                                @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                                    @if($clientes->estado==1)
                                                        @php
                                                            $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->nombres;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                @php
                                                    $fecha=explode('-',$cotizacion_cat_->fecha);
                                                @endphp
                                                @if(intval($fecha[1])==2)
                                                    @php
                                                        $total_utilidad=0;
                                                    @endphp
                                                    @foreach($cotizacion_cat_->paquete_cotizaciones as $paquete)
                                                        @if($paquete->estado==2)
                                                            @php $servicio = 0; @endphp
                                                            @foreach($paquete->itinerario_cotizaciones as $itinerarios)
                                                                @foreach($itinerarios->itinerario_servicios as $servicios)
                                                                    @php
                                                                        $servicio+= $servicios->precio
                                                                    @endphp
                                                                @endforeach
                                                            @endforeach
                                                            @foreach($paquete->paquete_precios as $precio)
                                                                @if($precio->estado==2)
                                                                    @if($precio->personas_s > 0)
                                                                        @php
                                                                            $precio_s = (($precio->precio_s)* 1) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_s = $precio_s + $servicio;
                                                                            $total_utilidad += $total_costo_s + ($total_costo_s * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                    @if($precio->personas_d > 0)
                                                                        @php
                                                                            $precio_d = (($precio->precio_d)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_d = $precio_d + $servicio;
                                                                            $total_utilidad += $total_costo_d + ($total_costo_d * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                    @if($precio->personas_m > 0)
                                                                        @php
                                                                            $precio_m = (($precio->precio_m)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_m = $precio_m + $servicio;
                                                                            $total_utilidad += $total_costo_m + ($total_costo_m * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                    @if($precio->personas_t > 0)
                                                                        @php
                                                                            $precio_t = (($precio->precio_t)* 3) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_t = $precio_t + $servicio;
                                                                            $total_utilidad += $total_costo_t + ($total_costo_t * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                    <tr>
                                                        <td>{{$dato_cliente}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'l jS F Y')}}</td>
                                                        <td><span class="badge text-right">$ {{$total_utilidad}}</span></td>
                                                    </tr>
                                                @endif
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div id="t_mar_s" class="row d-none">
                                    <h3>Lista de paquetes <span class="text-primary">Marzo {{$fecha_pqt}}</span> <b class="text-success text-25">$</b><b class="text-success text-25">{{$arra_count_mes_s[3]}}</b></h3>
                                    <table id="mar_s" class="table table-striped table-bordered table-responsive " cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Paquete</th>
                                            <th>Detalles</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cotizacion_cat as $cotizacion_cat_)
                                            @if($cotizacion_cat_->categorizado=='S')
                                                @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                                    @if($clientes->estado==1)
                                                        @php
                                                            $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->nombres;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                @php
                                                    $fecha=explode('-',$cotizacion_cat_->fecha);
                                                @endphp
                                                @if(intval($fecha[1])==3)
                                                    @php
                                                        $total_utilidad=0;
                                                    @endphp
                                                    @foreach($cotizacion_cat_->paquete_cotizaciones as $paquete)
                                                        @if($paquete->estado==2)
                                                            @php $servicio = 0; @endphp
                                                            @foreach($paquete->itinerario_cotizaciones as $itinerarios)
                                                                @foreach($itinerarios->itinerario_servicios as $servicios)
                                                                    @php
                                                                        $servicio+= $servicios->precio
                                                                    @endphp
                                                                @endforeach
                                                            @endforeach
                                                            @foreach($paquete->paquete_precios as $precio)
                                                                @if($precio->estado==2)
                                                                    @if($precio->personas_s > 0)
                                                                        @php
                                                                            $precio_s = (($precio->precio_s)* 1) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_s = $precio_s + $servicio;
                                                                            $total_utilidad += $total_costo_s + ($total_costo_s * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                    @if($precio->personas_d > 0)
                                                                        @php
                                                                            $precio_d = (($precio->precio_d)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_d = $precio_d + $servicio;
                                                                            $total_utilidad += $total_costo_d + ($total_costo_d * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                    @if($precio->personas_m > 0)
                                                                        @php
                                                                            $precio_m = (($precio->precio_m)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_m = $precio_m + $servicio;
                                                                            $total_utilidad += $total_costo_m + ($total_costo_m * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                    @if($precio->personas_t > 0)
                                                                        @php
                                                                            $precio_t = (($precio->precio_t)* 3) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_t = $precio_t + $servicio;
                                                                            $total_utilidad += $total_costo_t + ($total_costo_t * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                    <tr>
                                                        <td>{{$dato_cliente}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'l jS F Y')}}</td>
                                                        <td><span class="badge text-right">$ {{$total_utilidad}}</span></td>
                                                    </tr>
                                                @endif
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div id="t_abr_s" class="row d-none">
                                    <h3>Lista de paquetes <span class="text-primary">Abril {{$fecha_pqt}}</span> <b class="text-success text-25">$</b><b class="text-success text-25">{{$arra_count_mes_s[4]}}</b></h3>
                                    <table id="abr_s" class="table table-striped table-bordered table-responsive " cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Paquete</th>
                                            <th>Detalles</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cotizacion_cat as $cotizacion_cat_)
                                            @if($cotizacion_cat_->categorizado=='S')
                                                @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                                    @if($clientes->estado==1)
                                                        @php
                                                            $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->nombres;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                @php
                                                    $fecha=explode('-',$cotizacion_cat_->fecha);
                                                @endphp
                                                @if(intval($fecha[1])==4)
                                                    @php
                                                        $total_utilidad=0;
                                                    @endphp
                                                    @foreach($cotizacion_cat_->paquete_cotizaciones as $paquete)
                                                        @if($paquete->estado==2)
                                                            @php $servicio = 0; @endphp
                                                            @foreach($paquete->itinerario_cotizaciones as $itinerarios)
                                                                @foreach($itinerarios->itinerario_servicios as $servicios)
                                                                    @php
                                                                        $servicio+= $servicios->precio
                                                                    @endphp
                                                                @endforeach
                                                            @endforeach
                                                            @foreach($paquete->paquete_precios as $precio)
                                                                @if($precio->estado==2)
                                                                    @if($precio->personas_s > 0)
                                                                        @php
                                                                            $precio_s = (($precio->precio_s)* 1) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_s = $precio_s + $servicio;
                                                                            $total_utilidad += $total_costo_s + ($total_costo_s * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                    @if($precio->personas_d > 0)
                                                                        @php
                                                                            $precio_d = (($precio->precio_d)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_d = $precio_d + $servicio;
                                                                            $total_utilidad += $total_costo_d + ($total_costo_d * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                    @if($precio->personas_m > 0)
                                                                        @php
                                                                            $precio_m = (($precio->precio_m)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_m = $precio_m + $servicio;
                                                                            $total_utilidad += $total_costo_m + ($total_costo_m * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                    @if($precio->personas_t > 0)
                                                                        @php
                                                                            $precio_t = (($precio->precio_t)* 3) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_t = $precio_t + $servicio;
                                                                            $total_utilidad += $total_costo_t + ($total_costo_t * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                    <tr>
                                                        <td>{{$dato_cliente}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'l jS F Y')}}</td>
                                                        <td><span class="badge text-right">$ {{$total_utilidad}}</span></td>
                                                    </tr>
                                                @endif
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div id="t_may_s" class="row d-none">
                                    <h3>Lista de paquetes <span class="text-primary">Mayo {{$fecha_pqt}}</span> <b class="text-success text-25">$</b><b class="text-success text-25">{{$arra_count_mes_s[5]}}</b></h3>
                                    <table id="may_s" class="table table-striped table-bordered table-responsive " cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Paquete</th>
                                            <th>Detalles</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cotizacion_cat as $cotizacion_cat_)
                                            @if($cotizacion_cat_->categorizado=='S')
                                                @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                                    @if($clientes->estado==1)
                                                        @php
                                                            $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->nombres;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                @php
                                                    $fecha=explode('-',$cotizacion_cat_->fecha);
                                                @endphp
                                                @if(intval($fecha[1])==5)
                                                    @php
                                                        $total_utilidad=0;
                                                    @endphp
                                                    @foreach($cotizacion_cat_->paquete_cotizaciones as $paquete)
                                                        @if($paquete->estado==2)
                                                            @php $servicio = 0; @endphp
                                                            @foreach($paquete->itinerario_cotizaciones as $itinerarios)
                                                                @foreach($itinerarios->itinerario_servicios as $servicios)
                                                                    @php
                                                                        $servicio+= $servicios->precio
                                                                    @endphp
                                                                @endforeach
                                                            @endforeach
                                                            @foreach($paquete->paquete_precios as $precio)
                                                                @if($precio->estado==2)
                                                                    @if($precio->personas_s > 0)
                                                                        @php
                                                                            $precio_s = (($precio->precio_s)* 1) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_s = $precio_s + $servicio;
                                                                            $total_utilidad += $total_costo_s + ($total_costo_s * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                    @if($precio->personas_d > 0)
                                                                        @php
                                                                            $precio_d = (($precio->precio_d)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_d = $precio_d + $servicio;
                                                                            $total_utilidad += $total_costo_d + ($total_costo_d * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                    @if($precio->personas_m > 0)
                                                                        @php
                                                                            $precio_m = (($precio->precio_m)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_m = $precio_m + $servicio;
                                                                            $total_utilidad += $total_costo_m + ($total_costo_m * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                    @if($precio->personas_t > 0)
                                                                        @php
                                                                            $precio_t = (($precio->precio_t)* 3) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_t = $precio_t + $servicio;
                                                                            $total_utilidad += $total_costo_t + ($total_costo_t * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                    <tr>
                                                        <td>{{$dato_cliente}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'l jS F Y')}}</td>
                                                        <td><span class="badge text-right">$ {{$total_utilidad}}</span></td>
                                                    </tr>
                                                @endif
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div id="t_jun_s" class="row d-none">
                                    <h3>Lista de paquetes <span class="text-primary">Junio {{$fecha_pqt}}</span> <b class="text-success text-25">$</b><b class="text-success text-25">{{$arra_count_mes_s[6]}}</b></h3>
                                    <table id="jun_s" class="table table-striped table-bordered table-responsive " cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Paquete</th>
                                            <th>Detalles</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cotizacion_cat as $cotizacion_cat_)
                                            @if($cotizacion_cat_->categorizado=='S')
                                                @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                                    @if($clientes->estado==1)
                                                        @php
                                                            $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->nombres;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                @php
                                                    $fecha=explode('-',$cotizacion_cat_->fecha);
                                                @endphp
                                                @if(intval($fecha[1])==6)
                                                    @php
                                                        $total_utilidad=0;
                                                    @endphp
                                                    @foreach($cotizacion_cat_->paquete_cotizaciones as $paquete)
                                                        @if($paquete->estado==2)
                                                            @php $servicio = 0; @endphp
                                                            @foreach($paquete->itinerario_cotizaciones as $itinerarios)
                                                                @foreach($itinerarios->itinerario_servicios as $servicios)
                                                                    @php
                                                                        $servicio+= $servicios->precio
                                                                    @endphp
                                                                @endforeach
                                                            @endforeach
                                                            @foreach($paquete->paquete_precios as $precio)
                                                                @if($precio->estado==2)
                                                                    @if($precio->personas_s > 0)
                                                                        @php
                                                                            $precio_s = (($precio->precio_s)* 1) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_s = $precio_s + $servicio;
                                                                            $total_utilidad += $total_costo_s + ($total_costo_s * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                    @if($precio->personas_d > 0)
                                                                        @php
                                                                            $precio_d = (($precio->precio_d)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_d = $precio_d + $servicio;
                                                                            $total_utilidad += $total_costo_d + ($total_costo_d * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                    @if($precio->personas_m > 0)
                                                                        @php
                                                                            $precio_m = (($precio->precio_m)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_m = $precio_m + $servicio;
                                                                            $total_utilidad += $total_costo_m + ($total_costo_m * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                    @if($precio->personas_t > 0)
                                                                        @php
                                                                            $precio_t = (($precio->precio_t)* 3) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_t = $precio_t + $servicio;
                                                                            $total_utilidad += $total_costo_t + ($total_costo_t * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                    <tr>
                                                        <td>{{$dato_cliente}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'l jS F Y')}}</td>
                                                        <td><span class="badge text-right">$ {{$total_utilidad}}</span></td>
                                                    </tr>
                                                @endif
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div id="t_jul_s" class="row d-none">
                                    <h3>Lista de paquetes <span class="text-primary">Julio {{$fecha_pqt}}</span> <b class="text-success text-25">$</b><b class="text-success text-25">{{$arra_count_mes_s[7]}}</b></h3>
                                    <table id="jul_s" class="table table-striped table-bordered table-responsive " cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Paquete</th>
                                            <th>Detalles</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cotizacion_cat as $cotizacion_cat_)
                                            @if($cotizacion_cat_->categorizado=='S')
                                                @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                                    @if($clientes->estado==1)
                                                        @php
                                                            $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->nombres;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                @php
                                                    $fecha=explode('-',$cotizacion_cat_->fecha);
                                                @endphp
                                                @if(intval($fecha[1])==7)
                                                    @php
                                                        $total_utilidad=0;
                                                    @endphp
                                                    @foreach($cotizacion_cat_->paquete_cotizaciones as $paquete)
                                                        @if($paquete->estado==2)
                                                            @php $servicio = 0; @endphp
                                                            @foreach($paquete->itinerario_cotizaciones as $itinerarios)
                                                                @foreach($itinerarios->itinerario_servicios as $servicios)
                                                                    @php
                                                                        $servicio+= $servicios->precio
                                                                    @endphp
                                                                @endforeach
                                                            @endforeach
                                                            @foreach($paquete->paquete_precios as $precio)
                                                                @if($precio->estado==2)
                                                                    @if($precio->personas_s > 0)
                                                                        @php
                                                                            $precio_s = (($precio->precio_s)* 1) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_s = $precio_s + $servicio;
                                                                            $total_utilidad += $total_costo_s + ($total_costo_s * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                    @if($precio->personas_d > 0)
                                                                        @php
                                                                            $precio_d = (($precio->precio_d)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_d = $precio_d + $servicio;
                                                                            $total_utilidad += $total_costo_d + ($total_costo_d * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                    @if($precio->personas_m > 0)
                                                                        @php
                                                                            $precio_m = (($precio->precio_m)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_m = $precio_m + $servicio;
                                                                            $total_utilidad += $total_costo_m + ($total_costo_m * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                    @if($precio->personas_t > 0)
                                                                        @php
                                                                            $precio_t = (($precio->precio_t)* 3) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_t = $precio_t + $servicio;
                                                                            $total_utilidad += $total_costo_t + ($total_costo_t * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                    <tr>
                                                        <td>{{$dato_cliente}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'l jS F Y')}}</td>
                                                        <td><span class="badge text-right">$ {{$total_utilidad}}</span></td>
                                                    </tr>
                                                @endif
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div id="t_ago_s" class="row d-none">
                                    <h3>Lista de paquetes <span class="text-primary">Agosto {{$fecha_pqt}}</span> <b class="text-success text-25">$</b><b class="text-success text-25">{{$arra_count_mes_s[8]}}</b></h3>
                                    <table id="ago_s" class="table table-striped table-bordered table-responsive " cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Paquete</th>
                                            <th>Detalles</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cotizacion_cat as $cotizacion_cat_)
                                            @if($cotizacion_cat_->categorizado=='S')
                                                @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                                    @if($clientes->estado==1)
                                                        @php
                                                            $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->nombres;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                @php
                                                    $fecha=explode('-',$cotizacion_cat_->fecha);
                                                @endphp
                                                @if(intval($fecha[1])==8)
                                                    @php
                                                        $total_utilidad=0;
                                                    @endphp
                                                    @foreach($cotizacion_cat_->paquete_cotizaciones as $paquete)
                                                        @if($paquete->estado==2)
                                                            @php $servicio = 0; @endphp
                                                            @foreach($paquete->itinerario_cotizaciones as $itinerarios)
                                                                @foreach($itinerarios->itinerario_servicios as $servicios)
                                                                    @php
                                                                        $servicio+= $servicios->precio
                                                                    @endphp
                                                                @endforeach
                                                            @endforeach
                                                            @foreach($paquete->paquete_precios as $precio)
                                                                @if($precio->estado==2)
                                                                    @if($precio->personas_s > 0)
                                                                        @php
                                                                            $precio_s = (($precio->precio_s)* 1) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_s = $precio_s + $servicio;
                                                                            $total_utilidad += $total_costo_s + ($total_costo_s * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                    @if($precio->personas_d > 0)
                                                                        @php
                                                                            $precio_d = (($precio->precio_d)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_d = $precio_d + $servicio;
                                                                            $total_utilidad += $total_costo_d + ($total_costo_d * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                    @if($precio->personas_m > 0)
                                                                        @php
                                                                            $precio_m = (($precio->precio_m)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_m = $precio_m + $servicio;
                                                                            $total_utilidad += $total_costo_m + ($total_costo_m * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                    @if($precio->personas_t > 0)
                                                                        @php
                                                                            $precio_t = (($precio->precio_t)* 3) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_t = $precio_t + $servicio;
                                                                            $total_utilidad += $total_costo_t + ($total_costo_t * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                    <tr>
                                                        <td>{{$dato_cliente}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'l jS F Y')}}</td>
                                                        <td><span class="badge text-right">$ {{$total_utilidad}}</span></td>
                                                    </tr>
                                                @endif
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div id="t_set_s" class="row d-none">
                                    <h3>Lista de paquetes <span class="text-primary">Septiembre {{$fecha_pqt}}</span> <b class="text-success text-25">$</b><b class="text-success text-25">{{$arra_count_mes_s[9]}}</b></h3>
                                    <table id="set_s" class="table table-striped table-bordered table-responsive " cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Paquete</th>
                                            <th>Detalles</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cotizacion_cat as $cotizacion_cat_)
                                            @if($cotizacion_cat_->categorizado=='S')
                                                @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                                    @if($clientes->estado==1)
                                                        @php
                                                            $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->nombres;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                @php
                                                    $fecha=explode('-',$cotizacion_cat_->fecha);
                                                @endphp
                                                @if(intval($fecha[1])==9)
                                                    @php
                                                        $total_utilidad=0;
                                                    @endphp
                                                    @foreach($cotizacion_cat_->paquete_cotizaciones as $paquete)
                                                        @if($paquete->estado==2)
                                                            @php $servicio = 0; @endphp
                                                            @foreach($paquete->itinerario_cotizaciones as $itinerarios)
                                                                @foreach($itinerarios->itinerario_servicios as $servicios)
                                                                    @php
                                                                        $servicio+= $servicios->precio
                                                                    @endphp
                                                                @endforeach
                                                            @endforeach
                                                            @foreach($paquete->paquete_precios as $precio)
                                                                @if($precio->estado==2)
                                                                    @if($precio->personas_s > 0)
                                                                        @php
                                                                            $precio_s = (($precio->precio_s)* 1) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_s = $precio_s + $servicio;
                                                                            $total_utilidad += $total_costo_s + ($total_costo_s * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                    @if($precio->personas_d > 0)
                                                                        @php
                                                                            $precio_d = (($precio->precio_d)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_d = $precio_d + $servicio;
                                                                            $total_utilidad += $total_costo_d + ($total_costo_d * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                    @if($precio->personas_m > 0)
                                                                        @php
                                                                            $precio_m = (($precio->precio_m)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_m = $precio_m + $servicio;
                                                                            $total_utilidad += $total_costo_m + ($total_costo_m * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                    @if($precio->personas_t > 0)
                                                                        @php
                                                                            $precio_t = (($precio->precio_t)* 3) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_t = $precio_t + $servicio;
                                                                            $total_utilidad += $total_costo_t + ($total_costo_t * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                    <tr>
                                                        <td>{{$dato_cliente}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'l jS F Y')}}</td>
                                                        <td><span class="badge text-right">$ {{$total_utilidad}}</span></td>
                                                    </tr>
                                                @endif
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div id="t_oct_s" class="row d-none">
                                    <h3>Lista de paquetes <span class="text-primary">Octubre {{$fecha_pqt}}</span> <b class="text-success text-25">$</b><b class="text-success text-25">{{$arra_count_mes_s[10]}}</b></h3>
                                    <table id="oct_s" class="table table-striped table-bordered table-responsive " cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Paquete</th>
                                            <th>Detalles</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cotizacion_cat as $cotizacion_cat_)
                                            @if($cotizacion_cat_->categorizado=='S')
                                                @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                                    @if($clientes->estado==1)
                                                        @php
                                                            $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->nombres;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                @php
                                                    $fecha=explode('-',$cotizacion_cat_->fecha);
                                                @endphp
                                                @if(intval($fecha[1])==10)
                                                    @php
                                                        $total_utilidad=0;
                                                    @endphp
                                                    @foreach($cotizacion_cat_->paquete_cotizaciones as $paquete)
                                                        @if($paquete->estado==2)
                                                            @php $servicio = 0; @endphp
                                                            @foreach($paquete->itinerario_cotizaciones as $itinerarios)
                                                                @foreach($itinerarios->itinerario_servicios as $servicios)
                                                                    @php
                                                                        $servicio+= $servicios->precio
                                                                    @endphp
                                                                @endforeach
                                                            @endforeach
                                                            @foreach($paquete->paquete_precios as $precio)
                                                                @if($precio->estado==2)
                                                                    @if($precio->personas_s > 0)
                                                                        @php
                                                                            $precio_s = (($precio->precio_s)* 1) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_s = $precio_s + $servicio;
                                                                            $total_utilidad += $total_costo_s + ($total_costo_s * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                    @if($precio->personas_d > 0)
                                                                        @php
                                                                            $precio_d = (($precio->precio_d)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_d = $precio_d + $servicio;
                                                                            $total_utilidad += $total_costo_d + ($total_costo_d * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                    @if($precio->personas_m > 0)
                                                                        @php
                                                                            $precio_m = (($precio->precio_m)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_m = $precio_m + $servicio;
                                                                            $total_utilidad += $total_costo_m + ($total_costo_m * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                    @if($precio->personas_t > 0)
                                                                        @php
                                                                            $precio_t = (($precio->precio_t)* 3) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_t = $precio_t + $servicio;
                                                                            $total_utilidad += $total_costo_t + ($total_costo_t * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                    <tr>
                                                        <td>{{$dato_cliente}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'l jS F Y')}}</td>
                                                        <td><span class="badge text-right">$ {{$total_utilidad}}</span></td>
                                                    </tr>
                                                @endif
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div id="t_nov_s" class="row d-none">
                                    <h3>Lista de paquetes <span class="text-primary">Noviembre {{$fecha_pqt}}</span> <b class="text-success text-25">$</b><b class="text-success text-25">{{$arra_count_mes_s[11]}}</b></h3>
                                    <table id="nov_s" class="table table-striped table-bordered table-responsive " cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Paquete</th>
                                            <th>Detalles</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cotizacion_cat as $cotizacion_cat_)
                                            @if($cotizacion_cat_->categorizado=='S')
                                                @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                                    @if($clientes->estado==1)
                                                        @php
                                                            $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->nombres;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                @php
                                                    $fecha=explode('-',$cotizacion_cat_->fecha);
                                                @endphp
                                                @if(intval($fecha[1])==11)
                                                    @php
                                                        $total_utilidad=0;
                                                    @endphp
                                                    @foreach($cotizacion_cat_->paquete_cotizaciones as $paquete)
                                                        @if($paquete->estado==2)
                                                            @php $servicio = 0; @endphp
                                                            @foreach($paquete->itinerario_cotizaciones as $itinerarios)
                                                                @foreach($itinerarios->itinerario_servicios as $servicios)
                                                                    @php
                                                                        $servicio+= $servicios->precio
                                                                    @endphp
                                                                @endforeach
                                                            @endforeach
                                                            @foreach($paquete->paquete_precios as $precio)
                                                                @if($precio->estado==2)
                                                                    @if($precio->personas_s > 0)
                                                                        @php
                                                                            $precio_s = (($precio->precio_s)* 1) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_s = $precio_s + $servicio;
                                                                            $total_utilidad += $total_costo_s + ($total_costo_s * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                    @if($precio->personas_d > 0)
                                                                        @php
                                                                            $precio_d = (($precio->precio_d)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_d = $precio_d + $servicio;
                                                                            $total_utilidad += $total_costo_d + ($total_costo_d * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                    @if($precio->personas_m > 0)
                                                                        @php
                                                                            $precio_m = (($precio->precio_m)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_m = $precio_m + $servicio;
                                                                            $total_utilidad += $total_costo_m + ($total_costo_m * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                    @if($precio->personas_t > 0)
                                                                        @php
                                                                            $precio_t = (($precio->precio_t)* 3) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_t = $precio_t + $servicio;
                                                                            $total_utilidad += $total_costo_t + ($total_costo_t * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                    <tr>
                                                        <td>{{$dato_cliente}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'l jS F Y')}}</td>
                                                        <td><span class="badge text-right">$ {{$total_utilidad}}</span></td>
                                                    </tr>
                                                @endif
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div id="t_dic_s" class="row d-none">
                                    <h3>Lista de paquetes <span class="text-primary">Diciembre {{$fecha_pqt}}</span> <b class="text-success text-25">$</b><b class="text-success text-25">{{$arra_count_mes_s[12]}}</b></h3>
                                    <table id="dic_s" class="table table-striped table-bordered table-responsive " cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Paquete</th>
                                            <th>Detalles</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cotizacion_cat as $cotizacion_cat_)
                                            @if($cotizacion_cat_->categorizado=='S')
                                                @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                                    @if($clientes->estado==1)
                                                        @php
                                                            $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->nombres;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                @php
                                                    $fecha=explode('-',$cotizacion_cat_->fecha);
                                                @endphp
                                                @if(intval($fecha[1])==12)
                                                    @php
                                                        $total_utilidad=0;
                                                    @endphp
                                                    @foreach($cotizacion_cat_->paquete_cotizaciones as $paquete)
                                                        @if($paquete->estado==2)
                                                            @php $servicio = 0; @endphp
                                                            @foreach($paquete->itinerario_cotizaciones as $itinerarios)
                                                                @foreach($itinerarios->itinerario_servicios as $servicios)
                                                                    @php
                                                                        $servicio+= $servicios->precio
                                                                    @endphp
                                                                @endforeach
                                                            @endforeach
                                                            @foreach($paquete->paquete_precios as $precio)
                                                                @if($precio->estado==2)
                                                                    @if($precio->personas_s > 0)
                                                                        @php
                                                                            $precio_s = (($precio->precio_s)* 1) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_s = $precio_s + $servicio;
                                                                            $total_utilidad += $total_costo_s + ($total_costo_s * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                    @if($precio->personas_d > 0)
                                                                        @php
                                                                            $precio_d = (($precio->precio_d)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_d = $precio_d + $servicio;
                                                                            $total_utilidad += $total_costo_d + ($total_costo_d * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                    @if($precio->personas_m > 0)
                                                                        @php
                                                                            $precio_m = (($precio->precio_m)* 2) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_m = $precio_m + $servicio;
                                                                            $total_utilidad += $total_costo_m + ($total_costo_m * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                    @if($precio->personas_t > 0)
                                                                        @php
                                                                            $precio_t = (($precio->precio_t)* 3) * ($cotizacion_cat_->duracion - 1);
                                                                            $total_costo_t = $precio_t + $servicio;
                                                                            $total_utilidad += $total_costo_t + ($total_costo_t * (($precio->utilidad)/100));
                                                                        @endphp
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                    <tr>
                                                        <td>{{$dato_cliente}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'l jS F Y')}}</td>
                                                        <td><span class="badge text-right">$ {{$total_utilidad}}</span></td>
                                                    </tr>
                                                @endif
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
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
            $('#ene_c').DataTable();
            $('#ene_s').DataTable();
            $('#feb_c').DataTable();
            $('#feb_s').DataTable();
            $('#mar_c').DataTable();
            $('#mar_s').DataTable();
            $('#abr_c').DataTable();
            $('#abr_s').DataTable();
            $('#may_c').DataTable();
            $('#may_s').DataTable();
            $('#jun_c').DataTable();
            $('#jun_s').DataTable();
            $('#jul_c').DataTable();
            $('#jul_s').DataTable();
            $('#ago_c').DataTable();
            $('#ago_s').DataTable();
            $('#set_c').DataTable();
            $('#set_s').DataTable();
            $('#oct_c').DataTable();
            $('#oct_s').DataTable();
            $('#nov_c').DataTable();
            $('#nov_s').DataTable();
            $('#dic_c').DataTable();
            $('#dic_s').DataTable();
            $('#new_ven').DataTable();
        } );
    </script>
@stop