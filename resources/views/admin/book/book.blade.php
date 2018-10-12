@extends('layouts.admin.book')
@section('content')

    <div class="row no-gutters">
        <div class="col-3">
            <div class="box-header-book">
                <h4 class="no-margin">New
                    <span>
                        <b class="badge badge-danger">#24</b>

                        <small><b>Travel date:</b> june</small>
                    </span>
                </h4>
            </div>
        </div>

        <div class="col-3">
            <div class="box-header-book">
                <h4 class="no-margin">Current<span><b class="badge badge-g-yellow">#12</b> <small><b>arrival date:</b> june</small></span></h4>

            </div>
        </div>
        <div class="col-3">
            <div class="box-header-book border-right-0">
                <h4 class="no-margin">Complete<span><b class="badge badge-success">#12</b> <small><b>arrival date:</b> june</small></span></h4>

            </div>
        </div>
        <div class="col-3">
            <div class="box-header-book border-right-0">
                <h4 class="no-margin">closed<span><b class="badge badge-success">#12</b> <small><b>arrival date:</b> june</small></span></h4>

            </div>
        </div>
    </div>
    <div class="row no-gutters">
        <div class="col-3 box-list-book">
            <div class="row">
                <div class="col">
                    <div class="row bg-warning py-1 mx-1">
                        <div class="col-3 text-left">
                            <span class="text-25">
                                <b>Filtrar</b>
                            </span>
                        </div>
                        <div class="col-9 text-right">
                            <span class="text-25">
                                {{csrf_field()}}
                                <input name="codigo_nuevo" id="codigo_nuevo" class="form-control" type="text" placeholder="Codigo" onkeyup="buscar_x_codigo_nuevo($(this).val())">
                            </span>
                        </div>
                    </div>

                </div>
            </div>
            <div id="nuevos">
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
                    @if($confirmados==0)
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
                @endforeach
            </div>
        </div>
        <div class="col-3 box-list-book">
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
                @if(1<=$confirmados && $confirmados<$total)
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
            @endforeach
        </div>
        <div class="col-3 box-list-book">
            <div class="row">
                <div class="col">
                    <div class="row bg-warning py-1 mx-1">
                        <div class="col text-left">
                            <span class="text-25">
                                <b>Filtrar</b>
                            </span>
                        </div>
                        <div class="col text-right">
                            <span class="text-25">
                                {{csrf_field()}}
                                <input name="anio" id="anio" class="form-control" type="text" value="2018">
                            </span>
                        </div>
                        <div class="col text-left">
                            <span class="text-25">
                                <select name="mes" id="" class="form-control" onchange="mostrarreservas($(this).val(),$('#anio').val())">
                                    <option value="01">ENERO</option>
                                    <option value="02">FEBRERO</option>
                                    <option value="03">MARZO</option>
                                    <option value="04">ABRIL</option>
                                    <option value="05">MAYO</option>
                                    <option value="06">JUNIO</option>
                                    <option value="07">JULIO</option>
                                    <option value="08">AGOSTO</option>
                                    <option value="09">SEPTIEMBRE</option>
                                    <option value="10" selected="">OCTUBRE</option>
                                    <option value="11">NOVIEMBRE</option>
                                    <option value="12">DICIEMBRE</option>
                                </select>
                            </span>
                        </div>
                    </div>

                </div>
            </div>
            <div id="reservas">
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
                @endforeach
            </div>
        </div>

    </div>


@stop