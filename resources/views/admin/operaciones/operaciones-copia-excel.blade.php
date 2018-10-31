@extends('layouts.quotes_pdf')
@php
    function fecha_peru($fecha){
        $fecha_temp='';
        $fecha_temp=explode('-',$fecha);
        return $fecha_temp[2].'/'.$fecha_temp[1].'/'.$fecha_temp[0];
    }
@endphp
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card w-100">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    Lista de operaciones de <span class="bg-primary text-15">{{fecha_peru($desde)}}</span> a <span class="bg-primary text-15">{{fecha_peru($hasta)}}</span>
                </div>
                <!-- Table -->
                <table class="table table-striped table-responsive table-bordered table-hover small table-sm py-0">
                    <thead>
                    <tr class="bg-primary text-white">
                        <td>FECHA</td>
                        <td>N° PAX.</td>
                        <td>CLIENTE</td>
                        <td>CTA</td>
                        <td>ID</td>
                        <td>HORA</td>
                        <td>TOUR</td>
                        <td>REPRESENT</td>
                        <td>HOTEL</td>
                        <td>MOVILIDAD</td>
                        <td>ENTRANCES</td>
                        <td>FOOD</td>
                        <td>TRAIN</td>
                        <td>FLIGHT</td>
                        <td>OTHERS</td>
                        <td>OBSERVACIONES</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($array_datos_cotizacion as $key => $array_datos_coti_)
                        @php
                            $arreglo=explode('%',$array_datos_coti_);
                        @endphp
                        <tr>
                            @php
                                $key1=substr($key,0,strlen($key)-6);
                                $valor=explode('|',$array_datos_coti[$key1]);
                                $valor1=explode('|',$array_datos_coti[$key1]);
                                $hora=explode('_',$key);
                            @endphp
                            <td>{{fecha_peru($valor[0])}}</td>
                            <td>{{$valor[1]}}</td>
                            <td>{{$valor[2]}}</td>
                            <td>{{$valor[3]}}</td>
                            <td>{{$valor[4]}}</td>
                            <td>{{$hora[3]}}</td>
                            <td>
                                @foreach($arreglo as $arre)
                                    @php
                                        $valor =explode('|',$arre);
                                    @endphp

                                    @if('TOURS'==$valor[0])
                                        {!! $valor[1] !!}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach($arreglo as $arre)
                                    @php
                                        $valor =explode('|',$arre);
                                    @endphp

                                    @if('REPRESENT'==$valor[0])
                                        {!! $valor[1] !!}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @if(array_key_exists($key,$array_hotel))
                                    {!! $array_hotel[$key] !!}
                                @endif
                            </td>
                            <td>
                                @foreach($arreglo as $arre)
                                    @php
                                        $valor =explode('|',$arre);
                                    @endphp

                                    @if('MOVILID'==$valor[0])
                                        {!! $valor[1] !!}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach($arreglo as $arre)
                                    @php
                                        $valor =explode('|',$arre);
                                    @endphp

                                    @if('ENTRANCES'==$valor[0])
                                        {!! $valor[1] !!}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach($arreglo as $arre)
                                    @php
                                        $valor =explode('|',$arre);
                                    @endphp

                                    @if('FOOD'==$valor[0])
                                        {!! $valor[1] !!}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach($arreglo as $arre)
                                    @php
                                        $valor =explode('|',$arre);
                                    @endphp

                                    @if('TRAINS'==$valor[0])
                                        {!! $valor[1] !!}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach($arreglo as $arre)
                                    @php
                                        $valor =explode('|',$arre);
                                    @endphp

                                    @if('FLIGHTS'==$valor[0])
                                        {!! $valor[1] !!}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach($arreglo as $arre)
                                    @php
                                        $valor =explode('|',$arre);
                                    @endphp

                                    @if('OTHERS'==$valor[0])
                                        {!! $valor[1] !!}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{$valor1[5]}}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
