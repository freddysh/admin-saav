@extends('layouts.quotes_pdf')
@php
    function fecha_peru($fecha){
        $fecha_temp='';
        $fecha_temp=explode('-',$fecha);
        return $fecha_temp[2].'/'.$fecha_temp[1].'/'.$fecha_temp[0];
    }
@endphp
@section('content')
    <div class="caja no-margin">
        <div class="text-12">
            Lista de operaciones de <span class="bg-primary">{{fecha_peru($desde)}}</span> a <span class="bg-primary">{{fecha_peru($hasta)}}</span>
        </div>
        <table class="table text-08">
                <thead>
                <tr class="bg-primary text-white">
                    <th width="50px">FECHA</th>
                    <th width="10px" class="center">PAX</th>
                    <th width="50px">CLIENTE</th>
                    <th width="50px">CTA</th>
                    {{--<th width="10px">ID</th>--}}
                    <th width="15px">HORA</th>
                    <th width="80px">TOUR</th>
                    <th width="80px">REPRESENT</th>
                    <th width="80px">HOTEL</th>
                    <th width="80px">MOVILIDAD</th>
                    <th width="80px">ENTRANCES</th>
                    <th width="80px">FOOD</th>
                    <th width="80px">TRAIN</th>
                    <th width="40px">FLIGHT</th>
                    <th width="80px">OTHERS</th>
                    <th width="80px">OBSERVACIONES</th>
                </tr>
                </thead>
                <tbody >
                @foreach($array_datos_cotizacion as $key => $array_datos_coti_)
                    @php
                        $arreglo=explode('%',$array_datos_coti_['servicio']);
                        $hora=explode('_',$key);
                        // $key1=substr($key,0,strlen($key)-6);
                        $key1=$hora[0].'_'.$hora[1].'_'.$hora[2];
                        $valor=explode('|',$array_datos_coti[$key1]['datos']);
                        $valor1=explode('|',$array_datos_coti[$key1]['datos']);
                    @endphp
                    <tr class="@if($array_datos_coti_['anulado']==0) venta_anulada @endif">
                        
                        <td width="50px">{{fecha_peru($valor[0])}}</td>
                        <td width="10px">{{$valor[1]}}</td>
                        <td width="50px">{!!$valor[2]!!}</td>
                        <td width="50px">
                            {{substr($valor[3],0,8)}}/<br>{{substr($valor[4],0,3)}}
                        </td>
                        {{--<td width="10px">--}}
                            {{--{{substr($valor[4],0,3)}}--}}
                        {{--</td>--}}
                        <td width="15px">{{$hora[3]}}</td>
                        <td width="80px">
                            @foreach($arreglo as $arre)
                                @php
                                    $valor =explode('|',$arre);
                                @endphp

                                @if('TOURS'==$valor[0])
                                    {!! $valor[1] !!}
                                @endif
                            @endforeach
                        </td>
                        <td width="80px">
                            @foreach($arreglo as $arre)
                                @php
                                    $valor =explode('|',$arre);
                                @endphp

                                @if('REPRESENT'==$valor[0])
                                    {!! $valor[1] !!}
                                @endif
                            @endforeach
                        </td>
                        <td width="80px">
                            @foreach($array_hotel as $key_ => $array_hotel_)
                                @if($key_==$key)
                                    {!! $array_hotel_ !!}
                                @endif
                            @endforeach
                        </td>
                        <td width="80px">
                            @foreach($arreglo as $arre)
                                @php
                                    $valor =explode('|',$arre);
                                @endphp

                                @if('MOVILID'==$valor[0])
                                    {!! $valor[1] !!}
                                @endif
                            @endforeach
                        </td>
                        <td width="80px">
                            @foreach($arreglo as $arre)
                                @php
                                    $valor =explode('|',$arre);
                                @endphp

                                @if('ENTRANCES'==$valor[0])
                                    {!! $valor[1] !!}
                                @endif
                            @endforeach
                        </td>
                        <td width="80px">
                            @foreach($arreglo as $arre)
                                @php
                                    $valor =explode('|',$arre);
                                @endphp

                                @if('FOOD'==$valor[0])
                                    {!! $valor[1] !!}
                                @endif
                            @endforeach
                        </td>
                        <td width="80px">
                            @foreach($arreglo as $arre)
                                @php
                                    $valor =explode('|',$arre);
                                @endphp

                                @if('TRAINS'==$valor[0])
                                    {!! $valor[1] !!}
                                @endif
                            @endforeach
                        </td>
                        <td width="40px">
                            @foreach($arreglo as $arre)
                                @php
                                    $valor =explode('|',$arre);
                                @endphp

                                @if('FLIGHTS'==$valor[0])
                                    {!! $valor[1] !!}
                                @endif
                            @endforeach
                        </td>
                        <td width="80px">
                            @foreach($arreglo as $arre)
                                @php
                                    $valor =explode('|',$arre);
                                @endphp

                                @if('OTHERS'==$valor[0])
                                    {!! $valor[1] !!}
                                @endif
                            @endforeach
                        </td>
                        <td width="80px">{!! $valor1[5] !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
    </div>
@stop
