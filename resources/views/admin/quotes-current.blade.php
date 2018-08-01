@extends('layouts.admin.admin')
{{--@section('archivos-css')--}}
{{--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">--}}
{{--@stop--}}
{{--@section('archivos-js')--}}
{{--<script src="{{asset("https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js")}}"></script>--}}
{{--<script src="{{asset("https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js")}}"></script>--}}
{{--@stop--}}
@section('content')

    <div class="row margin-top-10 margin-bottom-20">
        <div class="col-md-2 no-padding">
            <a href="{{route('current_quote_page_path', 'gotoperu.com')}}" class="btn btn-block btn-default active">gotoperu.com</a>
        </div>
        <div class="col-md-2 no-padding">
            <a href="{{route('current_quote_page_path', 'gotoperu.com.pe')}}" class="btn btn-block btn-default">gotoperu.com.pe</a>
        </div>
        <div class="col-md-2 no-padding">
            <a href="{{route('current_quote_page_path', 'andesviagens.com')}}" class="btn btn-block btn-default">andesviagens.com</a>
        </div>
        <div class="col-md-2 no-padding">
            <a href="{{route('current_quote_page_path', 'machupicchu-galapagos.com')}}" class="btn btn-block btn-default">machupicchu-galapagos.com</a>
        </div>
        <div class="col-md-2 no-padding">
            <a href="{{route('current_quote_page_path', 'gotolatinamerica.com')}}" class="btn btn-block btn-default">gotolatinamerica.com</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2 no-padding">
            <div class="box-header-book">
                <h4 class="no-margin">New
                    <span>
                        <b class="label label-danger">#24</b>
                        <small><b>$9542</b></small>
                    </span>
                </h4>
            </div>
        </div>
        <div class="col-md-2 no-padding">
            <div class="box-header-book">
                <h4 class="no-margin">Proposal Sent<span><b class="label label-warning">#12</b> <small><b>$9542</b></small></span></h4>
            </div>
        </div>
        {{--<div class="col-md-2 no-padding">--}}
            {{--<div class="box-header-book border-right-0">--}}
                {{--<h4 class="no-margin">1st Follow Up<span><b class="label label-success">#12</b> <small><b>arrival date:</b> june</small></span></h4>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="col-md-2 no-padding">
            <div class="box-header-book border-right-0">
                <h4 class="no-margin">30%<span><b class="label label-info">#12</b> <small><b>$9542</b></small></span></h4>
            </div>
        </div>
        <div class="col-md-2 no-padding">
            <div class="box-header-book border-right-0">
                <h4 class="no-margin">60%<span><b class="label label-info">#12</b> <small><b>$9542</b></small></span></h4>
            </div>
        </div>
        <div class="col-md-2 no-padding">
            <div class="box-header-book border-right-0">
                <h4 class="no-margin">90%<span><b class="label label-info">#12</b> <small><b>$9542</b></small></span></h4>
            </div>
        </div>
        <div class="col-md-2 no-padding">
            <div class="box-header-book border-right-0">
                <h4 class="no-margin">Sale<span><b class="label label-success">#12</b> <small><b>$9542</b></small></span></h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class='col-md-2 no-padding box-list-book'>
            {{csrf_field()}}
            <li value="0">
                <ol class='simple_with_animation vertical no-padding no-margin'>
                    @foreach($cotizacion->sortByDesc('created_at') as $cotizacion_)
                        @if($cotizacion_->posibilidad=="0")
                            <?php
                            $date = date_create($cotizacion_->fecha);
                            $fecha=date_format($date, 'jS F Y');
                            $titulo='';
                            ?>

                            <li class="content-list-book" value="{{$cotizacion_->id}}">
                                <div class="content-list-book-s">
                                    <a href="{{route('cotizacion_id_show_path',$cotizacion_->id)}}">
                                    @foreach($cotizacion_->cotizaciones_cliente as $cliente_coti)
                                        @if($cliente_coti->estado=='1')
                                            <?php
                                            $titulo=$cliente_coti->cliente->nombres.' '.$cliente_coti->cliente->apellidos.' x '.$cotizacion_->nropersonas.' '.$fecha;
                                            ?>
                                            {{--                                                <a href="{{route('cotizacion_id_show_path',$cotizacion_->id)}}">{{$cliente_coti->cliente->nombres}} {{$cliente_coti->cliente->apellidos}} x {{$cotizacion_->nropersonas}} {{$fecha}}</a>--}}
                                            <strong>
                                                <img src="https://assets.pipedrive.com/images/icons/profile_120x120.svg" alt="">
                                                {{$cliente_coti->cliente->nombres}} {{$cliente_coti->cliente->apellidos}}: {{$cotizacion_->nropersonas}} days: {{$fecha}}
                                            </strong>
                                            <small>
                                                18987$
                                            </small>
                                        @endif
                                    @endforeach
                                    </a>
                                    <div class="icon">
                                        <a href=""><i class="fa fa-warning"></i></a>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ol>
            </li>
        </div>
        <div class='col-md-2 no-padding box-list-book'>
            <li value="1">
                <ol class='simple_with_animation vertical no-padding'>
                    @foreach($cotizacion->sortByDesc('created_at') as $cotizacion_)
                        @if($cotizacion_->posibilidad=="1")
                            <?php
                            $date = date_create($cotizacion_->fecha);
                            $fecha=date_format($date, 'jS F Y');
                            $titulo='';
                            ?>

                            <li class="content-list-book" value="{{$cotizacion_->id}}">
                                <div class="content-list-book-s">
                                    <a href="{{route('cotizacion_id_show_path',$cotizacion_->id)}}">
                                        @foreach($cotizacion_->cotizaciones_cliente as $cliente_coti)
                                            @if($cliente_coti->estado=='1')
                                                <?php
                                                $titulo=$cliente_coti->cliente->nombres.' '.$cliente_coti->cliente->apellidos.' x '.$cotizacion_->nropersonas.' '.$fecha;
                                                ?>
                                                {{--                                                <a href="{{route('cotizacion_id_show_path',$cotizacion_->id)}}">{{$cliente_coti->cliente->nombres}} {{$cliente_coti->cliente->apellidos}} x {{$cotizacion_->nropersonas}} {{$fecha}}</a>--}}
                                                <strong>
                                                    <img src="https://assets.pipedrive.com/images/icons/profile_120x120.svg" alt="">
                                                    {{$cliente_coti->cliente->nombres}} {{$cliente_coti->cliente->apellidos}}: {{$cotizacion_->nropersonas}} days: {{$fecha}}
                                                </strong>
                                                <small>
                                                    18987$
                                                </small>
                                            @endif
                                        @endforeach
                                    </a>
                                    <div class="icon">
                                        <a href=""><i class="fa fa-warning"></i></a>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ol>
            </li>
        </div>
        <div class='col-md-2 no-padding box-list-book'>
            <li value="30">
                <ol class='simple_with_animation vertical no-padding'>
                    @foreach($cotizacion->sortByDesc('created_at') as $cotizacion_)
                        @if($cotizacion_->posibilidad=="30")
                            <?php
                            $date = date_create($cotizacion_->fecha);
                            $fecha=date_format($date, 'jS F Y');
                            $titulo='';
                            ?>

                            <li class="content-list-book" value="{{$cotizacion_->id}}">
                                <div class="content-list-book-s">
                                    <a href="{{route('cotizacion_id_show_path',$cotizacion_->id)}}">
                                        @foreach($cotizacion_->cotizaciones_cliente as $cliente_coti)
                                            @if($cliente_coti->estado=='1')
                                                <?php
                                                $titulo=$cliente_coti->cliente->nombres.' '.$cliente_coti->cliente->apellidos.' x '.$cotizacion_->nropersonas.' '.$fecha;
                                                ?>
                                                {{--                                                <a href="{{route('cotizacion_id_show_path',$cotizacion_->id)}}">{{$cliente_coti->cliente->nombres}} {{$cliente_coti->cliente->apellidos}} x {{$cotizacion_->nropersonas}} {{$fecha}}</a>--}}
                                                <strong>
                                                    <img src="https://assets.pipedrive.com/images/icons/profile_120x120.svg" alt="">
                                                    {{$cliente_coti->cliente->nombres}} {{$cliente_coti->cliente->apellidos}}: {{$cotizacion_->nropersonas}} days: {{$fecha}}
                                                </strong>
                                                <small>
                                                    18987$
                                                </small>
                                            @endif
                                        @endforeach
                                    </a>
                                    <div class="icon">
                                        <a href=""><i class="fa fa-warning"></i></a>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ol>
            </li>
        </div>
        <div class='col-md-2 no-padding box-list-book'>
            <li value="60">
                <ol class='simple_with_animation vertical no-padding'>
                    @foreach($cotizacion->sortByDesc('created_at') as $cotizacion_)
                        @if($cotizacion_->posibilidad=="60")
                            <?php
                            $date = date_create($cotizacion_->fecha);
                            $fecha=date_format($date, 'jS F Y');
                            $titulo='';
                            ?>

                            <li class="content-list-book" value="{{$cotizacion_->id}}">
                                <div class="content-list-book-s">
                                    <a href="{{route('cotizacion_id_show_path',$cotizacion_->id)}}">
                                        @foreach($cotizacion_->cotizaciones_cliente as $cliente_coti)
                                            @if($cliente_coti->estado=='1')
                                                <?php
                                                $titulo=$cliente_coti->cliente->nombres.' '.$cliente_coti->cliente->apellidos.' x '.$cotizacion_->nropersonas.' '.$fecha;
                                                ?>
                                                {{--                                                <a href="{{route('cotizacion_id_show_path',$cotizacion_->id)}}">{{$cliente_coti->cliente->nombres}} {{$cliente_coti->cliente->apellidos}} x {{$cotizacion_->nropersonas}} {{$fecha}}</a>--}}
                                                <strong>
                                                    <img src="https://assets.pipedrive.com/images/icons/profile_120x120.svg" alt="">
                                                    {{$cliente_coti->cliente->nombres}} {{$cliente_coti->cliente->apellidos}}: {{$cotizacion_->nropersonas}} days: {{$fecha}}
                                                </strong>
                                                <small>
                                                    18987$
                                                </small>
                                            @endif
                                        @endforeach
                                    </a>
                                    <div class="icon">
                                        <a href=""><i class="fa fa-warning"></i></a>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ol>
            </li>
        </div>
        <div class='col-md-2 no-padding box-list-book'>
            <li value="90">
                <ol class='simple_with_animation vertical no-padding'>
                    @foreach($cotizacion->sortByDesc('created_at') as $cotizacion_)
                        @if($cotizacion_->posibilidad=="90")
                            <?php
                            $date = date_create($cotizacion_->fecha);
                            $fecha=date_format($date, 'jS F Y');
                            $titulo='';
                            ?>

                            <li class="content-list-book" value="{{$cotizacion_->id}}">
                                <div class="content-list-book-s">
                                    <a href="{{route('cotizacion_id_show_path',$cotizacion_->id)}}">
                                        @foreach($cotizacion_->cotizaciones_cliente as $cliente_coti)
                                            @if($cliente_coti->estado=='1')
                                                <?php
                                                $titulo=$cliente_coti->cliente->nombres.' '.$cliente_coti->cliente->apellidos.' x '.$cotizacion_->nropersonas.' '.$fecha;
                                                ?>
                                                {{--                                                <a href="{{route('cotizacion_id_show_path',$cotizacion_->id)}}">{{$cliente_coti->cliente->nombres}} {{$cliente_coti->cliente->apellidos}} x {{$cotizacion_->nropersonas}} {{$fecha}}</a>--}}
                                                <strong>
                                                    <img src="https://assets.pipedrive.com/images/icons/profile_120x120.svg" alt="">
                                                    {{$cliente_coti->cliente->nombres}} {{$cliente_coti->cliente->apellidos}}: {{$cotizacion_->nropersonas}} days: {{$fecha}}
                                                </strong>
                                                <small>
                                                    18987$
                                                </small>
                                            @endif
                                        @endforeach
                                    </a>
                                    <div class="icon">
                                        <a href=""><i class="fa fa-warning"></i></a>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ol>
            </li>
        </div>
        <div class='col-md-2 no-padding box-list-book'>
            <li value="100">
                <ol class='simple_with_animation vertical no-padding'>
                    @foreach($cotizacion->sortByDesc('created_at') as $cotizacion_)
                        @if($cotizacion_->posibilidad=="100")
                            <?php
                            $date = date_create($cotizacion_->fecha);
                            $fecha=date_format($date, 'jS F Y');
                            $titulo='';
                            ?>

                            <li class="content-list-book" value="{{$cotizacion_->id}}">
                                <div class="content-list-book-s">
                                    <a href="{{route('cotizacion_id_show_path',$cotizacion_->id)}}">
                                        @foreach($cotizacion_->cotizaciones_cliente as $cliente_coti)
                                            @if($cliente_coti->estado=='1')
                                                <?php
                                                $titulo=$cliente_coti->cliente->nombres.' '.$cliente_coti->cliente->apellidos.' x '.$cotizacion_->nropersonas.' '.$fecha;
                                                ?>
                                                {{--                                                <a href="{{route('cotizacion_id_show_path',$cotizacion_->id)}}">{{$cliente_coti->cliente->nombres}} {{$cliente_coti->cliente->apellidos}} x {{$cotizacion_->nropersonas}} {{$fecha}}</a>--}}
                                                <strong>
                                                    <img src="https://assets.pipedrive.com/images/icons/profile_120x120.svg" alt="">

                                                    {{$cliente_coti->cliente->nombres}} {{$cliente_coti->cliente->apellidos}}: {{$cotizacion_->nropersonas}} days: {{$fecha}}
                                                </strong>
                                                <small>
                                                    18987$
                                                </small>
                                            @endif
                                        @endforeach
                                    </a>
                                    <div class="icon">
                                        <a href=""><i class="fa fa-warning"></i></a>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ol>
            </li>
        </div>

    </div>

    <div class="row">
        {{--<div class="col-md-4 no-padding box-list-book">--}}
            {{--<div class="content-list-book">--}}
                {{--<div class="content-list-book-s">--}}
                    {{--<a href="">--}}
                        {{--<strong>--}}
                            {{--<img src="https://assets.pipedrive.com/images/icons/profile_120x120.svg" alt="">--}}
                            {{--hidalgo X 6: 6 days: 2/25/2018--}}
                        {{--</strong>--}}
                        {{--<small>--}}
                            {{--18987$--}}
                        {{--</small>--}}
                    {{--</a>--}}
                    {{--<div class="icon">--}}
                        {{--<a href=""><i class="fa fa-warning"></i></a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-md-4 no-padding box-list-book">--}}

            {{--<div class="content-list-book">--}}
                {{--<div class="content-list-book-s">--}}
                    {{--<a href="">--}}
                        {{--<strong>--}}
                            {{--<img src="https://assets.pipedrive.com/images/icons/profile_120x120.svg" alt="">--}}
                            {{--Hidalgo x2: 8 days: Jan 2018--}}
                        {{--</strong>--}}
                        {{--<small>--}}
                            {{--1800$--}}
                        {{--</small>--}}
                    {{--</a>--}}
                    {{--<div class="icon">--}}
                        {{--<a href="">10%</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="content-list-book">--}}
                {{--<div class="content-list-book-s">--}}
                    {{--<a href="">--}}
                        {{--<strong>--}}
                            {{--<img src="https://assets.pipedrive.com/images/icons/profile_120x120.svg" alt="">--}}
                            {{--Hidalgo x2: 8 days: Jan 2018--}}
                        {{--</strong>--}}
                        {{--<small>--}}
                            {{--1800$--}}
                        {{--</small>--}}
                    {{--</a>--}}
                    {{--<div class="icon">--}}
                        {{--<a href="">50%</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

        </div>
        {{--<div class="col-md-4 no-padding box-list-book border-right-0">--}}
            {{--<div class="content-list-book">--}}
                {{--<div class="content-list-book-s">--}}
                    {{--<a href="">--}}
                        {{--<strong>--}}
                            {{--<img src="https://assets.pipedrive.com/images/icons/profile_120x120.svg" alt="">--}}
                            {{--Hidalgo x2: 8 days: Jan 2018--}}
                        {{--</strong>--}}
                        {{--<small>--}}
                            {{--1800$--}}
                        {{--</small>--}}
                    {{--</a>--}}
                    {{--<div class="icon">--}}
                        {{--<a href="" class="text-success"><i class="fa fa-check"></i></a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="content-list-book">--}}
                {{--<div class="content-list-book-s">--}}
                    {{--<a href="">--}}
                        {{--<strong>--}}
                            {{--<img src="https://assets.pipedrive.com/images/icons/profile_120x120.svg" alt="">--}}
                            {{--Hidalgo x2: 8 days: Jan 2018--}}
                        {{--</strong>--}}
                        {{--<small>--}}
                            {{--1800$--}}
                        {{--</small>--}}
                    {{--</a>--}}
                    {{--<div class="icon">--}}
                        {{--<a href="" class="text-success"><i class="fa fa-check"></i></a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="content-list-book">--}}
                {{--<div class="content-list-book-s">--}}
                    {{--<a href="">--}}
                        {{--<strong>--}}
                            {{--<img src="https://assets.pipedrive.com/images/icons/profile_120x120.svg" alt="">--}}
                            {{--Hidalgo x2: 8 days: Jan 2018--}}
                        {{--</strong>--}}
                        {{--<small>--}}
                            {{--1800$--}}
                        {{--</small>--}}
                    {{--</a>--}}
                    {{--<div class="icon">--}}
                        {{--<a href="" class="text-success"><i class="fa fa-check"></i></a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="content-list-book">--}}
                {{--<div class="content-list-book-s">--}}
                    {{--<a href="">--}}
                        {{--<strong>--}}
                            {{--<img src="https://assets.pipedrive.com/images/icons/profile_120x120.svg" alt="">--}}
                            {{--Hidalgo x2: 8 days: Jan 2018--}}
                        {{--</strong>--}}
                        {{--<small>--}}
                            {{--1800$--}}
                        {{--</small>--}}
                    {{--</a>--}}
                    {{--<div class="icon">--}}
                        {{--<a href="" class="text-success"><i class="fa fa-check"></i></a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>

    <script>
        //formilario contac
        function update_p(valor){
            var s_name = $('#mi_id').val();
            alert(s_name);
        }

    </script>
    <script>
        var adjustment;

        $("ol.simple_with_animation").sortable({
            group: 'simple_with_animation',
            pullPlaceholder: false,
            // animation on drop
            onDrop: function  ($item, container, _super) {

                var $clonedItem = $('<li/>').css({height: 0});
                $item.before($clonedItem);
                $clonedItem.animate({'height': $item.height()});

                var s_cotizacion = $item.val();
                var s_porcentaje = $item.parent().parent().val();

                // alert(s_cotizacion);
                // alert(s_porcentaje);

                $item.animate($clonedItem.position(), function  () {
                    $clonedItem.detach();
                    _super($item, container);
                });

                var datos = {
                    "txt_cotizacion" : s_cotizacion,
                    "txt_porcentaje" : s_porcentaje
                };
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('[name="_token"]').val()
                    }
                });
                $.ajax({
                    data:  datos,
                    url:   "{{route('agregar_probabilidad_path')}}",
                    type:  'post',

                });


            },

            // set $item relative to cursor position
            onDragStart: function ($item, container, _super) {
                var offset = $item.offset(),
                    pointer = container.rootGroup.pointer;

                adjustment = {
                    left: pointer.left - offset.left,
                    top: pointer.top - offset.top
                };

                _super($item, container);
            },
            onDrag: function ($item, position) {
                $item.css({
                    left: position.left - adjustment.left,
                    top: position.top - adjustment.top
                });
            }
        });
    </script>
@stop
