@php
    use App\Helpers\MisFunciones;
    $dato_cliente='';
    $tiempo_dias=5;
    $color='bg-danger-goto';

    function fecha_peru($fecha){
        $fecha=explode('-',$fecha);
        return $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
    }
@endphp
@foreach($cotizacion_cat->sortBy('fecha') as $cotizacion_cat_)
    @php
        $hoy=\Carbon\Carbon::now();
        $fecha_llegada=\Carbon\Carbon::createFromFormat('Y-m-d',$cotizacion_cat_->fecha);
        $diff_dias=$hoy->diffInDays($fecha_llegada,false);
    @endphp
    @if($diff_dias>$tiempo_dias)
        @php
            $color='bg-white';
        @endphp
    @endif
    {{-- @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
        @if($clientes->estado==1) --}}
            @php
                $dato_cliente=$cotizacion_cat_->nombre_pax;
            @endphp
        {{-- @endif
    @endforeach --}}
    @php
        $total=0;
        $confirmados=0;
        $ultimo_dia=$cotizacion_cat_->fecha;
        $itinerario='';
    @endphp
    @foreach($cotizacion_cat_->paquete_cotizaciones->where('estado','2') as $pqts)
        @foreach($pqts->itinerario_cotizaciones as $itinerarios)
            @php
                $ultimo_dia=$itinerarios->fecha;
                $itinerario.='<p><b class="text-primary">Dia '.$itinerarios->dias.': </b>'.date_format(date_create($itinerarios->fecha), 'jS M Y').'</p>';
            @endphp
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
    @php
        $hoy=\Carbon\Carbon::now();
        $ultimo_dia=\Carbon\Carbon::createFromFormat('Y-m-d',$ultimo_dia);
        $dias_restantes=$hoy->diffInDays($ultimo_dia,false);
    @endphp
    @if($total>0)
        @if($columna=='NUEVO')
            @if($cotizacion_cat_->anulado>0)
                @if($confirmados==0)
                    @if($dias_restantes>=0)
                        <div class="row mb-1 border border-top-0 border-right-0 border-left-0 mx-0 {{$color}}">
                            <div class="col">
                                <div class="row">
                                    <div class="col-12">
                                        <b class="text-success text-12">{{$cotizacion_cat_->codigo}}</b>
                                        <a href="#!" title="Itinerario" data-toggle="popover" data-trigger="focus" data-content="{{$itinerario}}"> <i class="fas fa-eye text-12"></i></a>
                                    </div>
                                    <div class="col-12">
                                        <div class="row px-0">
                                            <div class="col-6 text-grey-goto pr-0">
                                                <a href="{{route('book_show_path',$cotizacion_cat_->id)}}">
                                                    <b class="text-10">{{strtoupper($dato_cliente)}}</b>
                                                </a>
                                            </div>
                                            <div class="col-1 bg-grey-goto text-center text-white mx-0 px-0">
                                                <b class="text-10">x{{$cotizacion_cat_->nropersonas}}</b>
                                            </div>
                                            <div class="col-1 bg-danger text-center text-white mx-0 px-0">
                                                <b class="text-10">{{$cotizacion_cat_->duracion}}d</b>
                                            </div>
                                            <div class="col-4 mx-0 pr-0">
                                                <b class="text-10">{{date_format(date_create($cotizacion_cat_->fecha), 'jS M Y')}}</b>
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
        @elseif($columna=='CURRENT')
            @if($cotizacion_cat_->anulado>0)
                @if($confirmados>=1&&$confirmados<$total)
                    @if($dias_restantes>=0)
                        <div class="row mb-1 border border-top-0 border-right-0 border-left-0 mx-0 {{$color}}">
                            <div class="col">
                                <div class="row">
                                    <div class="col-10">
                                        <b class="text-success text-12">{{$cotizacion_cat_->codigo}}</b>
                                        <a href="#!" title="Itinerario" data-toggle="popover" data-trigger="focus" data-content="{{$itinerario}}"> <i class="fas fa-eye text-12"></i></a>
                                    </div>
                                    <div class="col-2 col-1 bg-grey-goto text-center text-white mx-0 px-0">
                                        <b class="text-12">{{ round(($confirmados*100)/$total,1)}}%</b>
                                    </div>
                                    <div class="col-12">
                                        <div class="row px-0">
                                            <div class="col-6 text-grey-goto pr-0">
                                                <a href="{{route('book_show_path',$cotizacion_cat_->id)}}">
                                                    <b class="text-10">{{strtoupper($dato_cliente)}}</b>
                                                </a>
                                            </div>
                                            <div class="col-1 bg-grey-goto text-center text-white mx-0 px-0">
                                                <b class="text-10">x{{$cotizacion_cat_->nropersonas}}</b>
                                            </div>
                                            <div class="col-1 bg-danger text-center text-white mx-0 px-0">
                                                <b class="text-10">{{$cotizacion_cat_->duracion}}d</b>
                                            </div>
                                            <div class="col-4 mx-0 pr-0">
                                                <b class="text-10">{{date_format(date_create($cotizacion_cat_->fecha), 'jS M Y')}}</b>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            @endif
        @elseif($columna=='COMPLETE')
            @if($cotizacion_cat_->anulado>0)
                @if($confirmados==$total)
                    @if($dias_restantes>=0)
                        <div class="row mb-1 border border-top-0 border-right-0 border-left-0 mx-0">
                            <div class="col">
                                <div class="row">
                                    <div class="col-12">
                                        <b class="text-success text-12">{{$cotizacion_cat_->codigo}}</b>
                                        <a href="#!" title="Itinerario" data-toggle="popover" data-trigger="focus" data-content="{{$itinerario}}"> <i class="fas fa-eye text-12"></i></a>
                                    </div>
                                    <div class="col-12">
                                        <div class="row px-0">
                                            <div class="col-6 text-grey-goto pr-0">
                                                <a href="{{route('book_show_path',$cotizacion_cat_->id)}}">
                                                    <b class="text-10">{{strtoupper($dato_cliente)}}</b>
                                                </a>
                                            </div>
                                            <div class="col-1 bg-grey-goto text-center text-white mx-0 px-0">
                                                <b class="text-10">x{{$cotizacion_cat_->nropersonas}}</b>
                                            </div>
                                            <div class="col-1 bg-danger text-center text-white mx-0 px-0">
                                                <b class="text-10">{{$cotizacion_cat_->duracion}}d</b>
                                            </div>
                                            <div class="col-4 mx-0 pr-0">
                                                <b class="text-10">{{date_format(date_create($cotizacion_cat_->fecha), 'jS M Y')}}</b>
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
        @elseif($columna=='CLOSED')
            {{--@if($confirmados==$total)--}}
                @if($dias_restantes<0||$cotizacion_cat_->anulado==0)
                    <div class="row mb-1 border border-top-0 border-right-0 border-left-0 mx-0">
                        <div class="col">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <b class="text-success text-12">{{$cotizacion_cat_->codigo}}</b>
                                            <a href="#!" title="Itinerario" data-toggle="popover" data-trigger="focus" data-content="{{$itinerario}}"> <i class="fas fa-eye text-12"></i></a>
                                        </div>
                                        <div class="col-6 text-right">    
                                            @if($cotizacion_cat_->anulado==0)
                                                <span class="badge badge-warning text-11">Anulado el {{MisFunciones::fecha_peru_hora($cotizacion_cat_->anulado_fecha)}}</span>
                                            @endif
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="col-12">
                                    <div class="row px-0">
                                        <div class="col-6 text-grey-goto pr-0">
                                            <a href="{{route('book_show_path',$cotizacion_cat_->id)}}">
                                                <b class="text-10">{{strtoupper($dato_cliente)}}</b>
                                            </a>
                                        </div>
                                        <div class="col-1 bg-grey-goto text-center text-white mx-0 px-0">
                                            <b class="text-10">x{{$cotizacion_cat_->nropersonas}}</b>
                                        </div>
                                        <div class="col-1 bg-danger text-center text-white mx-0 px-0">
                                            <b class="text-10">{{$cotizacion_cat_->duracion}}d</b>
                                        </div>
                                        <div class="col-4 mx-0 pr-0">
                                            <b class="text-10">{{date_format(date_create($cotizacion_cat_->fecha), 'jS M Y')}}</b>
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
            {{--@endif--}}
        @endif
    @endif
@endforeach
<script>
    $(document).ready(function(){
        $('[data-toggle="popover"]').popover({
            html : true,
        });
    });
</script>