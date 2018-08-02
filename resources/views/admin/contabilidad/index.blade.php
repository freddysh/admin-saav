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
                @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                    @if($clientes->estado==1)
                        @php
                            $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->apellidos;
                        @endphp
                    @endif
                @endforeach
                <div class="content-list-book">
                    <div class="content-list-book-s">
                        <a href="{{route('contabilidad_show_path', $cotizacion_cat_->id)}}">
                            <small class="font-weight-bold text-dark">
                                <i class="fas fa-user-circle"></i>
                                {{ucwords(strtolower($dato_cliente))}} X{{$cotizacion_cat_->nropersonas}}: {{$cotizacion_cat_->duracion}} days: {{strftime("%d %B, %Y", strtotime(str_replace('-','/', $cotizacion_cat_->fecha)))}}
                            </small>
                            <small class="text-primary">
                                <sup>$</sup>{{$cotizacion_cat_->precioventa}}
                            </small>
                        </a>
                        <div class="icon">
                            <a href=""><i class="fas fa-exclamation-triangle"></i></a>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="col-4 box-list-book">

            <div class="content-list-book">
                <div class="content-list-book-s">
                    <a href="">
                        <small class="font-weight-bold text-dark">
                            <i class="fas fa-user-circle"></i>
                            Hidalgo x2: 8 days: Jan 2018
                        </small>
                        <small class="text-primary">
                            <sup>$</sup>1800
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

                        <small class="font-weight-bold text-dark">
                            <i class="fas fa-user-circle"></i>
                            Hidalgo x2: 8 days: Jan 2018
                        </small>
                        <small class="text-primary">
                            <sup>$</sup>1800

                        </small>
                    </a>
                    <div class="icon">
                        <a href="">50%</a>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-4 box-list-book border-right-0">
            <div class="content-list-book">
                <div class="content-list-book-s">
                    <a href="">
                        <small class="font-weight-bold text-dark">
                            <i class="fas fa-user-circle"></i>
                            Hidalgo x2: 8 days: Jan 2018
                        </small>
                        <small class="text-primary">
                            <sup>$</sup>1800

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

                        <small class="font-weight-bold text-dark">
                            <i class="fas fa-user-circle"></i>
                            Hidalgo x2: 8 days: Jan 2018
                        </small>
                        <small class="text-primary">
                            <sup>$</sup>1800

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

                        <small class="font-weight-bold text-dark">
                            <i class="fas fa-user-circle"></i>
                            Hidalgo x2: 8 days: Jan 2018
                        </small>
                        <small class="text-primary">
                            <sup>$</sup>1800

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
                        <small class="font-weight-bold text-dark">
                            <i class="fas fa-user-circle"></i>
                            Hidalgo x2: 8 days: Jan 2018
                        </small>
                        <small class="text-primary">
                            <sup>$</sup>1800

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