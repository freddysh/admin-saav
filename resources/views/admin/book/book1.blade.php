@extends('layouts.admin.book1')
@section('content')
    <div class="row">
        <div class="col-md-4 no-padding">
            <div class="box-header-book">
                <h4 class="no-margin">New
                    <span>
                        <b class="label label-danger">#24</b>
                        <small><b>Travel date:</b> june</small>
                    </span>
                </h4>
            </div>
        </div>
        <div class="col-md-4 no-padding">
            <div class="box-header-book">
                <h4 class="no-margin">Current<span><b class="label label-warning">#12</b> <small><b>arrival date:</b> june</small></span></h4>
            </div>
        </div>
        <div class="col-md-4 no-padding">
            <div class="box-header-book border-right-0">
                <h4 class="no-margin">Complete<span><b class="label label-success">#12</b> <small><b>arrival date:</b> june</small></span></h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 no-padding box-list-book">
            @foreach($cotizacion_cat->sortByDesc('fecha') as $cotizacion_cat_)
                @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                    @if($clientes->estado==1)
                        @php
                            $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->apellidos;
                        @endphp
                    @endif
                @endforeach
                <div class="content-list-book">
                    <div class="content-list-book-s">
                        <a href="{{route('book_show_path', $cotizacion_cat_->id)}}">
                            <strong>
                                <img src="https://assets.pipedrive.com/images/icons/profile_120x120.svg" alt="">
                                {{ucwords(strtolower($dato_cliente))}} X{{$cotizacion_cat_->nropersonas}}: {{$cotizacion_cat_->duracion}} days: {{strftime("%d %B, %Y", strtotime(str_replace('-','/', $cotizacion_cat_->fecha)))}}
                            </strong>
                            <small>
                                {{$cotizacion_cat_->precioventa}}$
                            </small>
                        </a>
                        <div class="icon">
                            <a href=""><i class="fa fa-warning"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
            {{--@foreach($paquete_cotizacion as $paquete_cotizaciones)--}}
            {{--@foreach($cot_cliente->where('cotizaciones_id', $paquete_cotizaciones->cotizaciones_id) as $cot_clientes)--}}
            {{--@foreach($cliente->where('id', $cot_clientes->clientes_id) as $clientes)--}}
            {{--<div class="content-list-book">--}}
            {{--<div class="content-list-book-s">--}}
            {{--<a href="{{route('book_show_path', $paquete_cotizaciones->id)}}">--}}
            {{--<strong>--}}
            {{--<img src="https://assets.pipedrive.com/images/icons/profile_120x120.svg" alt="">--}}
            {{--{{ucwords(strtolower($clientes->nombres))}} X{{$paquete_cotizaciones->cotizaciones->nropersonas}}: {{$paquete_cotizaciones->cotizaciones->duracion}} days: {{strftime("%d %B, %Y", strtotime(str_replace('-','/', $paquete_cotizaciones->cotizaciones->fecha)))}}--}}
            {{--</strong>--}}
            {{--<small>--}}
            {{--{{$paquete_cotizaciones->cotizaciones->precioventa}}$--}}
            {{--</small>--}}
            {{--</a>--}}
            {{--<div class="icon">--}}
            {{--<a href=""><i class="fa fa-warning"></i></a>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--@endforeach--}}
            {{--@endforeach--}}
            {{--@endforeach--}}
        </div>
        <div class="col-md-4 no-padding box-list-book">

            <div class="content-list-book">
                <div class="content-list-book-s">
                    <a href="">
                        <strong>
                            <img src="https://assets.pipedrive.com/images/icons/profile_120x120.svg" alt="">
                            Hidalgo x2: 8 days: Jan 2018
                        </strong>
                        <small>
                            1800$
                        </small>
                    </a>
                    <div class="icon">
                        <a href="">10%</a>
                    </div>
                </div>
            </div>

            <div class="content-list-book">
                <div class="content-list-book-s">
                    <a href="">
                        <strong>
                            <img src="https://assets.pipedrive.com/images/icons/profile_120x120.svg" alt="">
                            Hidalgo x2: 8 days: Jan 2018
                        </strong>
                        <small>
                            1800$
                        </small>
                    </a>
                    <div class="icon">
                        <a href="">50%</a>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-4 no-padding box-list-book border-right-0">
            <div class="content-list-book">
                <div class="content-list-book-s">
                    <a href="">
                        <strong>
                            <img src="https://assets.pipedrive.com/images/icons/profile_120x120.svg" alt="">
                            Hidalgo x2: 8 days: Jan 2018
                        </strong>
                        <small>
                            1800$
                        </small>
                    </a>
                    <div class="icon">
                        <a href="" class="text-success"><i class="fa fa-check"></i></a>
                    </div>
                </div>
            </div>
            <div class="content-list-book">
                <div class="content-list-book-s">
                    <a href="">
                        <strong>
                            <img src="https://assets.pipedrive.com/images/icons/profile_120x120.svg" alt="">
                            Hidalgo x2: 8 days: Jan 2018
                        </strong>
                        <small>
                            1800$
                        </small>
                    </a>
                    <div class="icon">
                        <a href="" class="text-success"><i class="fa fa-check"></i></a>
                    </div>
                </div>
            </div>
            <div class="content-list-book">
                <div class="content-list-book-s">
                    <a href="">
                        <strong>
                            <img src="https://assets.pipedrive.com/images/icons/profile_120x120.svg" alt="">
                            Hidalgo x2: 8 days: Jan 2018
                        </strong>
                        <small>
                            1800$
                        </small>
                    </a>
                    <div class="icon">
                        <a href="" class="text-success"><i class="fa fa-check"></i></a>
                    </div>
                </div>
            </div>
            <div class="content-list-book">
                <div class="content-list-book-s">
                    <a href="">
                        <strong>
                            <img src="https://assets.pipedrive.com/images/icons/profile_120x120.svg" alt="">
                            Hidalgo x2: 8 days: Jan 2018
                        </strong>
                        <small>
                            1800$
                        </small>
                    </a>
                    <div class="icon">
                        <a href="" class="text-success"><i class="fa fa-check"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop