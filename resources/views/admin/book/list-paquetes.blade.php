@php
    $dato_cliente='';
@endphp
@foreach($cotizacion_cat->sortBy('fecha') as $cotizacion_cat_)
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
        @if($confirmados==$total)
            <div class="content-list-book">
                <div class="content-list-book-s">
                    <a href="{{route('book_show_path', $cotizacion_cat_->id)}}">
                        <small class="text-dark font-weight-bold">
                            <i class="fas fa-user-circle text-secondary"></i>
                            <i class="text-success">{{$cotizacion_cat_->codigo}}</i> | {{ucwords(strtolower($dato_cliente))}} X{{$cotizacion_cat_->nropersonas}}: {{$cotizacion_cat_->duracion}} days: {{strftime("%d %B, %Y", strtotime(str_replace('-','/', $cotizacion_cat_->fecha)))}}
                        </small>
                        <small class="text-primary">
                            <sup>$</sup>{{$cotizacion_cat_->precioventa}}
                        </small>
                    </a>
                    <div class="icon">
                        <a href="">Compl. {{$confirmados}} de {{$total}}</a>
                    </div>
                </div>
            </div>
        @endif
    @endif
@endforeach