@php
    $dato_cliente='';
    $tiempo_dias=5;
    $hoy=\Carbon\Carbon::now();
    $color='';

    function fecha_peru($fecha){
        $fecha=explode('-',$fecha);
        return $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
    }
@endphp
@foreach($cotizacion_cat->sortBy('fecha') as $cotizacion_cat_)
    @php
        $fecha_llegada=\Carbon\Carbon::createFromFormat('Y-m-d',$cotizacion_cat_->fecha);
        $diff_dias=$hoy->diffInDays($fecha_llegada);
    @endphp
    @if($diff_dias<=$tiempo_dias)
        @php
            $color='bg-danger-goto';
        @endphp
    @endif
    @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
        @if($clientes->estado==1)
            @php
                $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->apellidos;
            @endphp
        @endif
    @endforeach
    @php
        $total=0;
        $confirmados=0;
    @endphp
    @foreach($cotizacion_cat_->paquete_cotizaciones->where('estado','2') as $pqts)
        @foreach($pqts->itinerario_cotizaciones as $itinerarios)
            @foreach($itinerarios->itinerario_servicios as $servicios)
                @php
                    $total++;
                @endphp
                @if($servicios->primera_confirmada==1)
                    @php
                        $confirmados++;
                    @endphp
                @endif
            @endforeach
            @foreach($itinerarios->hotel as $hotel)
                @php
                    $total++;
                @endphp
                @if($hotel->primera_confirmada==1)
                    @php
                        $confirmados++;
                    @endphp
                @endif
            @endforeach
        @endforeach
    @endforeach
    @if($total>0)
        @if($columna=='NUEVO')
            @if($confirmados==0)
                <div class="row mb-1 border border-top-0 border-right-0 border-left-0 mx-0 {{$color}}">
                    <div class="col">
                        <div class="row">
                            <div class="col-12">
                                <b class="text-success text-12">{{$cotizacion_cat_->codigo}}</b>
                            </div>
                            <div class="col-12">
                                <div class="row row">
                                    <div class="col-7 text-grey-goto">
                                        <a href="{{route('book_show_path',$cotizacion_cat_->id)}}">
                                            <b class="text-11">{{strtoupper($dato_cliente)}}</b>
                                        </a>
                                    </div>
                                    <div class="col-1 bg-grey-goto text-center text-white">
                                        <b class="text-11">x{{$cotizacion_cat_->nropersonas}}</b>
                                    </div>
                                    <div class="col-1 bg-danger text-center text-white">
                                        <b class="text-11">{{$cotizacion_cat_->duracion}}d</b>
                                    </div>
                                    <div class="col-3">
                                        <b class="text-12">{{fecha_peru($cotizacion_cat_->fecha)}}</b>
                                    </div>
                                    {{--<div class="col-1 px-0">--}}
                                        {{--<b class="text-12">{{ round(($confirmados*100)/$total,2)}}%</b>--}}
                                    {{--</div>--}}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endif
        @elseif($columna=='CURRENT')
            @if($confirmados>=1&&$confirmados<$total)
                <div class="row mb-1 border border-top-0 border-right-0 border-left-0 mx-0 {{$color}}">
                    <div class="col">
                        <div class="row">
                            <div class="col-12">
                                <b class="text-success text-12">{{$cotizacion_cat_->codigo}}</b>
                            </div>
                            <div class="col-12">
                                <div class="row row">
                                    <div class="col-6 text-grey-goto">
                                        <a href="{{route('book_show_path',$cotizacion_cat_->id)}}">
                                            <b class="text-11">{{strtoupper($dato_cliente)}}</b>
                                        </a>
                                    </div>
                                    <div class="col-1 bg-grey-goto text-center text-white">
                                        <b class="text-11">x{{$cotizacion_cat_->nropersonas}}</b>
                                    </div>
                                    <div class="col-1 bg-danger text-center text-white">
                                        <b class="text-11">{{$cotizacion_cat_->duracion}}d</b>
                                    </div>
                                    <div class="col-3">
                                        <b class="text-12">{{fecha_peru($cotizacion_cat_->fecha)}}</b>
                                    </div>
                                    <div class="col-1 px-0">
                                        <b class="text-12">{{ round(($confirmados*100)/$total,2)}}%</b>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endif
        @elseif($columna=='COMPLETE')
            @if($confirmados==$total)
                <div class="row mb-1 border border-top-0 border-right-0 border-left-0 mx-0 {{$color}}">
                    <div class="col">
                        <div class="row">
                            <div class="col-12">
                                <b class="text-success text-12">{{$cotizacion_cat_->codigo}}</b>
                            </div>
                            <div class="col-12">
                                <div class="row row">
                                    <div class="col-7 text-grey-goto">
                                        <a href="{{route('book_show_path',$cotizacion_cat_->id)}}">
                                            <b class="text-11">{{strtoupper($dato_cliente)}}</b>
                                        </a>
                                    </div>
                                    <div class="col-1 bg-grey-goto text-center text-white">
                                        <b class="text-11">x{{$cotizacion_cat_->nropersonas}}</b>
                                    </div>
                                    <div class="col-1 bg-danger text-center text-white">
                                        <b class="text-11">{{$cotizacion_cat_->duracion}}d</b>
                                    </div>
                                    <div class="col-3">
                                        <b class="text-12">{{fecha_peru($cotizacion_cat_->fecha)}}</b>
                                    </div>
                                    {{--<div class="col-1 px-0">--}}
                                        {{--<b class="text-12">{{ round(($confirmados*100)/$total,2)}}%</b>--}}
                                    {{--</div>--}}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endif
        @endif
    @endif
@endforeach