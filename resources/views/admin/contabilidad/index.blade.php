@extends('layouts.admin.contabilidad')
@section('content')

    <div class="row no-gutters">
        <div class="col-4">
            <div class="box-header-book">
                <h4 class="no-margin">New
                    <span>
                        <b class="badge badge-danger">#{{$cotizacion->count()}}</b>
                        <small><b>Travel date:</b> june</small>
                    </span>
                </h4>
            </div>
        </div>

        <div class="col-4">
            <div class="box-header-book">
                <h4 class="no-margin">Current<span><b class="badge badge-warning">#12</b> <small><b>arrival date:</b> june</small></span></h4>
            </div>
        </div>
        <div class="col-4">
            <div class="box-header-book border-right-0">
                <h4 class="no-margin">Complete<span><b class="badge badge-success">#12</b> <small><b>arrival date:</b> june</small></span></h4>
            </div>
        </div>
    </div>
    <div class="row no-gutters">
        <div class="col-4 box-list-book">
            @php
                $dato_cliente='';
            @endphp
            @foreach($cotizacion->sortByDesc('fecha') as $cotizacion_cat_)
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
                @endphp
                @foreach($cotizacion_cat_->paquete_cotizaciones->where('estado','2') as $pqts)
                    @foreach($pqts->itinerario_cotizaciones as $itinerarios)
                        @foreach($itinerarios->itinerario_servicios as $servicios)
                            @php
                                $total++;
                            @endphp
                            @if($servicios->precio_c>0)
                                @php
                                    $confirmados++;
                                @endphp
                            @elseif($servicios->precio_c==$servicios->precio_proveedor)
                                @php
                                    $confirmados++;
                                @endphp
                            @endif
                        @endforeach
                        @foreach($itinerarios->hotel as $hotel)
                            @php
                                $total++;
                            @endphp
                            @if($hotel->personas_s>0)
                                @if($hotel->precio_s_c>0)
                                    @php
                                        $confirmados++;
                                    @endphp
                                @elseif($hotel->precio_s_c==$hotel->precio_s_r)
                                    @php
                                        $confirmados++;
                                    @endphp
                                @endif
                            @endif
                            @if($hotel->personas_d>0)
                                @if($hotel->precio_d_c>0)
                                    @php
                                        $confirmados++;
                                    @endphp
                                @elseif($hotel->precio_d_c==$hotel->precio_d_r)
                                    @php
                                        $confirmados++;
                                    @endphp
                                @endif
                            @endif
                            @if($hotel->personas_m>0)
                                @if($hotel->precio_m_c>0)
                                    @php
                                        $confirmados++;
                                    @endphp
                                @elseif($hotel->precio_m_c==$hotel->precio_m_r)
                                    @php
                                        $confirmados++;
                                    @endphp
                                @endif
                            @endif
                            @if($hotel->personas_t>0)
                                @if($hotel->precio_t_c>0)
                                    @php
                                        $confirmados++;
                                    @endphp
                                @elseif($hotel->precio_t_c==$hotel->precio_t_r)
                                    @php
                                        $confirmados++;
                                    @endphp
                                @endif
                            @endif
                        @endforeach
                    @endforeach
                @endforeach
                @if($confirmados==0)
                    <div class="content-list-book">
                        <div class="content-list-book-s">
                            <a href="{{route('contabilidad_show_path', $cotizacion_cat_->id)}}">
                                <small class="font-weight-bold text-dark">
                                    <i class="fas fa-user-circle"></i>
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
        <div class="col-4 box-list-book">
            @php
                $dato_cliente='';
            @endphp
            @foreach($cotizacion->sortByDesc('fecha') as $cotizacion_cat_)
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
                @endphp
                @foreach($cotizacion_cat_->paquete_cotizaciones->where('estado','2') as $pqts)
                    @foreach($pqts->itinerario_cotizaciones as $itinerarios)
                        @foreach($itinerarios->itinerario_servicios as $servicios)
                            @php
                                $total++;
                            @endphp
                            @if($servicios->precio_c>0)
                                @php
                                    $confirmados++;
                                @endphp
                            @elseif($servicios->precio_c==$servicios->precio_proveedor)
                                @php
                                    $confirmados++;
                                @endphp
                            @endif
                        @endforeach
                            @foreach($itinerarios->hotel as $hotel)
                                @php
                                    $total++;
                                @endphp
                                @if($hotel->personas_s>0)
                                    @if($hotel->precio_s_c>0)
                                        @php
                                            $confirmados++;
                                        @endphp
                                    @elseif($hotel->precio_s_c==$hotel->precio_s_r)
                                        @php
                                            $confirmados++;
                                        @endphp
                                    @endif
                                @endif
                                @if($hotel->personas_d>0)
                                    @if($hotel->precio_d_c>0)
                                        @php
                                            $confirmados++;
                                        @endphp
                                    @elseif($hotel->precio_d_c==$hotel->precio_d_r)
                                        @php
                                            $confirmados++;
                                        @endphp
                                    @endif
                                @endif
                                @if($hotel->personas_m>0)
                                    @if($hotel->precio_m_c>0)
                                        @php
                                            $confirmados++;
                                        @endphp
                                    @elseif($hotel->precio_m_c==$hotel->precio_m_r)
                                        @php
                                            $confirmados++;
                                        @endphp
                                    @endif
                                @endif
                                @if($hotel->personas_t>0)
                                    @if($hotel->precio_t_c>0)
                                        @php
                                            $confirmados++;
                                        @endphp
                                    @elseif($hotel->precio_t_c==$hotel->precio_t_r)
                                        @php
                                            $confirmados++;
                                        @endphp
                                    @endif
                                @endif
                            @endforeach
                    @endforeach
                @endforeach
                @if(1<$confirmados &&$confirmados<$total)
                    <div class="content-list-book">
                        <div class="content-list-book-s">
                            <a href="{{route('contabilidad_show_path', $cotizacion_cat_->id)}}">
                                <small class="font-weight-bold text-dark">
                                    <i class="fas fa-user-circle"></i>
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

        <div class="col-4 box-list-book border-right-0">
            @php
                $dato_cliente='';
            @endphp
            @foreach($cotizacion->sortByDesc('fecha') as $cotizacion_cat_)
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
                @endphp
                @foreach($cotizacion_cat_->paquete_cotizaciones->where('estado','2') as $pqts)
                    @foreach($pqts->itinerario_cotizaciones as $itinerarios)
                        @foreach($itinerarios->itinerario_servicios as $servicios)
                            @php
                                $total++;
                            @endphp
                            @if($servicios->precio_c>0)
                                @php
                                    $confirmados++;
                                @endphp
                            @elseif($servicios->precio_c==$servicios->precio_proveedor)
                                @php
                                    $confirmados++;
                                @endphp
                            @endif
                        @endforeach
                            @foreach($itinerarios->hotel as $hotel)
                                @php
                                    $total++;
                                @endphp
                                @if($hotel->personas_s>0)
                                    @if($hotel->precio_s_c>0)
                                        @php
                                            $confirmados++;
                                        @endphp
                                    @elseif($hotel->precio_s_c==$hotel->precio_s_r)
                                        @php
                                            $confirmados++;
                                        @endphp
                                    @endif
                                @endif
                                @if($hotel->personas_d>0)
                                    @if($hotel->precio_d_c>0)
                                        @php
                                            $confirmados++;
                                        @endphp
                                    @elseif($hotel->precio_d_c==$hotel->precio_d_r)
                                        @php
                                            $confirmados++;
                                        @endphp
                                    @endif
                                @endif
                                @if($hotel->personas_m>0)
                                    @if($hotel->precio_m_c>0)
                                        @php
                                            $confirmados++;
                                        @endphp
                                    @elseif($hotel->precio_m_c==$hotel->precio_m_r)
                                        @php
                                            $confirmados++;
                                        @endphp
                                    @endif
                                @endif
                                @if($hotel->personas_t>0)
                                    @if($hotel->precio_t_c>0)
                                        @php
                                            $confirmados++;
                                        @endphp
                                    @elseif($hotel->precio_t_c==$hotel->precio_t_r)
                                        @php
                                            $confirmados++;
                                        @endphp
                                    @endif
                                @endif
                            @endforeach
                    @endforeach
                @endforeach
                @if($confirmados==$total)
                    <div class="content-list-book">
                        <div class="content-list-book-s">
                            <a href="{{route('contabilidad_show_path', $cotizacion_cat_->id)}}">
                                <small class="font-weight-bold text-dark">
                                    <i class="fas fa-user-circle"></i>
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
@stop