

@php
$total=0;
@endphp
@foreach ($cotizaciones->sortByDesc('fecha') as $cotizacion)
    @foreach ($cotizacion->paquete_cotizaciones as $paquete_cotizaciones)
        @foreach ($paquete_cotizaciones->itinerario_cotizaciones->sortByDesc('fecha') as $itinerario_cotizaciones)
            @foreach ($itinerario_cotizaciones->itinerario_servicios as $itinerario_servicio)
                @php
                    $total=$total+1;
                @endphp
                @if($dato1<=$itinerario_servicio->fecha_venc && $itinerario_servicio->fecha_venc<=$dato2)
                   <p class="text-success">{{$itinerario_servicio->fecha_venc}}</p>
                @else
                    <p class="text-danger">{{$itinerario_servicio->fecha_venc}}</p>
                @endif
            @endforeach
        @endforeach
    @endforeach
@endforeach
<p>{{$total}}</p>