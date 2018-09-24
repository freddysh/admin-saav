@extends('layouts.admin.admin')
@section('archivos-css')
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
    <style>
        body.dragging, body.dragging * {
        cursor: move !important;
        }

        .dragged {
        position: absolute;
        opacity: 0.5;
        z-index: 2000;
        }

        ol.caja_sort li.placeholder {
        position: relative;
        /** More li styles **/
        }
        ol.caja_sort li.placeholder:before {
        position: absolute;
        /** Define arrowhead **/
        }
    </style>
@stop
@section('archivos-js')
    <script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
@stop
@section('content')
    <div class="row no-gutters mb-2">
        <div class="col text-center">
            <a href="{{route('current_quote_page_path', 'gotoperu.com')}}" class="btn btn-block btn-sm @if($page == 'gotoperu.com') btn-success @endif">gotoperu.com</a>
            <i class="fas fa-sort-down fa-2x arrow-page text-success"></i>
        </div>
        <div class="col">
            <a href="{{route('current_quote_page_path', 'gotoperu.com.pe')}}" class="btn btn-block btn-sm text-secondary @if($page == 'gotoperu.com.pe') btn-light text-secondary @endif">gotoperu.com.pe</a>
        </div>
        <div class="col">
            <a href="{{route('current_quote_page_path', 'andesviagens.com')}}" class="btn btn-block btn-sm text-secondary @if($page == 'andesviagens.com') btn-light text-secondary @endif">andesviagens.com</a>
        </div>
        <div class="col">
            <a href="{{route('current_quote_page_path', 'machupicchu-galapagos.com')}}" class="btn btn-block btn-sm text-secondary @if($page == 'machupicchu-galapagos.com') btn-light text-secondary @endif">machupicchu-galapagos.com</a>
        </div>
        <div class="col">
            <a href="{{route('current_quote_page_path', 'gotolatinamerica.com')}}" class="btn btn-block btn-sm text-secondary @if($page == 'gotolatinamerica.com') btn-light text-secondary @endif">gotolatinamerica.com</a>
        </div>
        <div class="col">
            <a href="{{route('current_quote_page_path', 'expedia.com')}}" class="btn btn-block btn-sm text-secondary @if($page == 'expedia.com') btn-light text-secondary @endif">expedia.com</a>
        </div>
    </div>
    <div class="row no-gutters">
        <div class="col">
            <div class="box-header-book">
                <h4 class="no-margin">New
                    <span>
                        <b class="label label-danger">#{{$cotizacion->count()}}</b>
                        <small><b>$9542</b></small>
                    </span>
                </h4>
            </div>
        </div>
        <div class="col">
            <div class="box-header-book">
                <h4 class="no-margin">Proposal Sent<span><b class="label label-warning">#12</b> <small><b>$9542</b></small></span></h4>
            </div>
        </div>
        <div class="col">
            <div class="box-header-book border-right-0">
                <h4 class="no-margin">30%<span><b class="label label-info">#12</b> <small><b>$9542</b></small></span></h4>
            </div>
        </div>

        <div class="col">

            <div class="box-header-book border-right-0">
                <h4 class="no-margin">60%<span><b class="label label-info">#12</b> <small><b>$9542</b></small></span></h4>
            </div>
        </div>
        <div class="col">
            <div class="box-header-book border-right-0">
                <h4 class="no-margin">90%<span><b class="label label-info">#12</b> <small><b>$9542</b></small></span></h4>
            </div>
        </div>
        <div class="col">
            <div class="box-header-book border-right-0">
                <h4 class="no-margin">Sale<span><b class="label label-success">#12</b> <small><b>$9542</b></small></span></h4>
            </div>
        </div>
    </div>
    <div class="row no-gutters">
        <div class='col box-list-book d-none'>
            <div class="swiper-container swiper-container-current">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        {{csrf_field()}}

                        <div class="py-4"></div>
                    </div>
                </div>
                <!-- Add Scroll Bar -->
                <div class="swiper-scrollbar"></div>
            </div>
        </div>
        <div class='col box-list-book'>
            <li value="0">
                <ol class='simple_with_animation vertical m-0 p-0 caja_sort'>
                    @foreach($cotizacion->sortByDesc('created_at') as $cotizacion_)
                        @php
                            $s=0;
                            $d=0;
                            $m=0;
                            $t=0;
                            $nroPersonas=0;
                            $nro_dias=0;
                            $precio_iti=0;
                            $precio_hotel_s=0;
                            $precio_hotel_d=0;
                            $precio_hotel_m=0;
                            $precio_hotel_t=0;
                            $cotizacion_id='';
                            $utilidad_s=0;
                            $utilidad_por_s=0;
                            $utilidad_d=0;
                            $utilidad_por_d=0;
                            $utilidad_m=0;
                            $utilidad_por_m=0;
                            $utilidad_t=0;
                            $utilidad_por_t=0;
                        @endphp

                        @foreach($cotizacion_->paquete_cotizaciones->take(1) as $paquete)
                            @foreach($paquete->paquete_precios as $precio)
                                @if($precio->personas_s>0)
                                    @php
                                        $s=1;
                                        $utilidad_s=intval($precio->utilidad_s);
                                        $utilidad_por_s=$precio->utilidad_por_s;
                                    @endphp
                                @endif
                                @if($precio->personas_d>0)
                                    @php
                                        $d=1;
                                        $utilidad_d=intval($precio->utilidad_d);
                                        $utilidad_por_d=$precio->utilidad_por_d;
                                    @endphp
                                @endif
                                @if($precio->personas_m>0)
                                    @php
                                        $m=1;
                                        $utilidad_m=intval($precio->utilidad_m);
                                        $utilidad_por_m=$precio->utilidad_por_m;
                                    @endphp
                                @endif
                                @if($precio->personas_t>0)
                                    @php
                                        $t=1;
                                        $utilidad_t=intval($precio->utilidad_t);
                                        $utilidad_por_t=$precio->utilidad_por_t;
                                    @endphp
                                @endif
                            @endforeach
                            @foreach($paquete->itinerario_cotizaciones as $itinerario)
                                @php
                                    $rango='';
                                @endphp
                                @foreach($itinerario->itinerario_servicios as $servicios)
                                    @php
                                        $preciom=0;
                                    @endphp
                                    @if($servicios->min_personas<= $cotizacion_->nropersonas&&$cotizacion_->nropersonas <=$servicios->max_personas)
                                    @else
                                        @php
                                            $rango=' ';
                                        @endphp
                                    @endif
                                    @if($servicios->precio_grupo==1)
                                        @php
                                            $precio_iti+=round($servicios->precio/$cotizacion_->nropersonas,1);
                                            $preciom=round($servicios->precio/$cotizacion_->nropersonas,1);
                                        @endphp
                                    @else
                                        @php
                                            $precio_iti+=round($servicios->precio,1);
                                            $preciom=round($servicios->precio,1);
                                        @endphp
                                    @endif
                                @endforeach
                                @foreach($itinerario->hotel as $hotel)
                                    @if($hotel->personas_s>0)
                                        @php
                                            $precio_hotel_s+=$hotel->precio_s;

                                        @endphp
                                    @endif
                                    @if($hotel->personas_d>0)
                                        @php
                                            $precio_hotel_d+=$hotel->precio_d/2;

                                        @endphp
                                    @endif
                                    @if($hotel->personas_m>0)
                                        @php
                                            $precio_hotel_m+=$hotel->precio_m/2;

                                        @endphp
                                    @endif
                                    @if($hotel->personas_t>0)
                                        @php
                                            $precio_hotel_t+=$hotel->precio_t/3;

                                        @endphp
                                    @endif
                                @endforeach
                            @endforeach
                        @endforeach
                        @php
                            $precio_hotel_s+=$precio_iti;
                            $precio_hotel_d+=$precio_iti;
                            $precio_hotel_m+=$precio_iti;
                            $precio_hotel_t+=$precio_iti;
                        @endphp
                        @php
                            $valor=0;
                        @endphp
                        @if($s!=0)
                            @php
                                $valor+=round($precio_hotel_s+$utilidad_s,2);
                            @endphp
                        @endif
                        @if($d!=0)
                            @php
                                $valor+=round($precio_hotel_d+$utilidad_d,2);
                            @endphp
                        @endif
                        @if($m!=0)
                            @php
                                $valor+=round($precio_hotel_m+$utilidad_m,2);
                            @endphp
                        @endif
                        @if($t!=0)
                            @php
                                $valor+=round($precio_hotel_t+$utilidad_t,2);
                            @endphp
                        @endif
                        @if($cotizacion_->posibilidad=="0")
                            <?php
                            $date = date_create($cotizacion_->fecha);
                            $fecha=date_format($date, 'F jS, Y');
                            $titulo='';
                            ?>

                            <li class="content-list-book" id="content-list-{{$cotizacion_->id}}" value="{{$cotizacion_->id}}">
                                <div class="content-list-book-s">
                                    <a href="{{route('cotizacion_id_show_path',$cotizacion_->id)}}">
                                        @foreach($cotizacion_->cotizaciones_cliente as $cliente_coti)
                                            @if($cliente_coti->estado=='1')
                                                <?php
                                                $titulo=$cliente_coti->cliente->nombres.' '.$cliente_coti->cliente->apellidos.' x '.$cotizacion_->nropersonas.' '.$fecha;
                                                ?>
                                                <small class="text-dark font-weight-bold">
                                                    <i class="fas fa-user-circle text-secondary"></i>
                                                    <i class="text-success">{{$cotizacion_->codigo}}</i> | {{$cliente_coti->cliente->nombres}} {{$cliente_coti->cliente->apellidos}} x {{$cotizacion_->nropersonas}} {{$fecha}}
                                                </small>
                                                <small class="text-primary">
                                                    <sup>$</sup>{{$valor}}
                                                </small>
                                            @endif
                                        @endforeach
                                    </a>
                                    <div class="icon">
                                        <a href="#" onclick="Eliminar_cotizacion('{{$cotizacion_->id}}','{{$titulo}}')"><i class="fa fa-trash small text-danger"></i></a>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ol>
            </li>
        </div>
        <div class='col box-list-book'>
            <li value="1">
                <ol class='simple_with_animation vertical no-padding caja_sort'>
                    @foreach($cotizacion->sortByDesc('created_at') as $cotizacion_)
                        @if($cotizacion_->posibilidad=="1")
                            <?php
                            $date = date_create($cotizacion_->fecha);
                            $fecha=date_format($date, 'jS F Y');
                            $titulo='';
                            ?>

                            <li class="content-list-book" id="content-list-{{$cotizacion_->id}}" value="{{$cotizacion_->id}}">
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
                                                    <i class="text-success">{{$cotizacion_->codigo}}</i> | {{$cliente_coti->cliente->nombres}} {{$cliente_coti->cliente->apellidos}}: {{$cotizacion_->nropersonas}} days: {{$fecha}}
                                                </strong>
                                                <small>
                                                    18987$
                                                </small>
                                            @endif
                                        @endforeach
                                    </a>
                                    <div class="icon">
                                        <a href="#" onclick="Eliminar_cotizacion('{{$cotizacion_->id}}','{{$titulo}}')"><i class="fa fa-trash text-danger"></i></a>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ol>
            </li>
        </div>
        <div class='col box-list-book'>
            <li value="30">
                <ol class='simple_with_animation vertical no-padding caja_sort'>
                    @foreach($cotizacion->sortByDesc('created_at') as $cotizacion_)
                        @if($cotizacion_->posibilidad=="30")
                            <?php
                            $date = date_create($cotizacion_->fecha);
                            $fecha=date_format($date, 'jS F Y');
                            $titulo='';
                            ?>

                            <li class="content-list-book" id="content-list-{{$cotizacion_->id}}" value="{{$cotizacion_->id}}">
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
                                                    <i class="text-success">{{$cotizacion_->codigo}}</i> | {{$cliente_coti->cliente->nombres}} {{$cliente_coti->cliente->apellidos}}: {{$cotizacion_->nropersonas}} days: {{$fecha}}
                                                </strong>
                                                <small>
                                                    18987$
                                                </small>
                                            @endif
                                        @endforeach
                                    </a>
                                    <div class="icon">
                                        <a href="#" onclick="Eliminar_cotizacion('{{$cotizacion_->id}}','{{$titulo}}')"><i class="fa fa-trash text-danger"></i></a>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ol>
            </li>
        </div>
        <div class='col box-list-book'>
            <li value="60">
                <ol class='simple_with_animation vertical no-padding caja_sort'>
                    @foreach($cotizacion->sortByDesc('created_at') as $cotizacion_)
                        @if($cotizacion_->posibilidad=="60")
                            <?php
                            $date = date_create($cotizacion_->fecha);
                            $fecha=date_format($date, 'jS F Y');
                            $titulo='';
                            ?>

                            <li class="content-list-book" id="content-list-{{$cotizacion_->id}}" value="{{$cotizacion_->id}}">
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
                                                    <i class="text-success">{{$cotizacion_->codigo}}</i> | {{$cliente_coti->cliente->nombres}} {{$cliente_coti->cliente->apellidos}}: {{$cotizacion_->nropersonas}} days: {{$fecha}}
                                                </strong>
                                                <small>
                                                    18987$
                                                </small>
                                            @endif
                                        @endforeach
                                    </a>
                                    <div class="icon">
                                        <a href="#" onclick="Eliminar_cotizacion('{{$cotizacion_->id}}','{{$titulo}}')"><i class="fa fa-trash text-danger"></i></a>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ol>
            </li>
        </div>
        <div class='col box-list-book'>
            <li value="90">
                <ol class='simple_with_animation vertical no-padding caja_sort'>
                    @foreach($cotizacion->sortByDesc('created_at') as $cotizacion_)
                        @if($cotizacion_->posibilidad=="90")
                            <?php
                            $date = date_create($cotizacion_->fecha);
                            $fecha=date_format($date, 'jS F Y');
                            $titulo='';
                            ?>

                            <li class="content-list-book" id="content-list-{{$cotizacion_->id}}" value="{{$cotizacion_->id}}">
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
                                                    <i class="text-success">{{$cotizacion_->codigo}}</i> | {{$cliente_coti->cliente->nombres}} {{$cliente_coti->cliente->apellidos}}: {{$cotizacion_->nropersonas}} days: {{$fecha}}
                                                </strong>
                                                <small>
                                                    18987$
                                                </small>
                                            @endif
                                        @endforeach
                                    </a>
                                    <div class="icon">
                                        <a href="#" onclick="Eliminar_cotizacion('{{$cotizacion_->id}}','{{$titulo}}')"><i class="fa fa-trash text-danger"></i></a>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ol>
            </li>
        </div>
        <div class='col box-list-book'>
            <li value="100">
                <ol class='simple_with_animation vertical no-padding caja_sort'>
                    @foreach($cotizacion->sortByDesc('created_at') as $cotizacion_)
                        @if($cotizacion_->posibilidad=="100")
                            <?php
                            $date = date_create($cotizacion_->fecha);
                            $fecha=date_format($date, 'jS F Y');
                            $titulo='';
                            ?>

                            <li class="content-list-book" id="content-list-{{$cotizacion_->id}}" value="{{$cotizacion_->id}}">
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

                                                    <i class="text-success">{{$cotizacion_->codigo}}</i> | {{$cliente_coti->cliente->nombres}} {{$cliente_coti->cliente->apellidos}}: {{$cotizacion_->nropersonas}} days: {{$fecha}}
                                                </strong>
                                                <small>
                                                    18987$
                                                </small>
                                            @endif
                                        @endforeach
                                    </a>
                                    <div class="icon">
                                        <a href="#" onclick="Eliminar_cotizacion('{{$cotizacion_->id}}','{{$titulo}}')"><i class="fa fa-trash text-danger"></i></a>
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
        <div class="col text-right">
            <div class="btn-save-fixed btn-save-fixed-plus p-3">
                <a href="{{route("quotes_new1_path")}}" class="p-3 bg-danger rounded-circle text-white" data-toggle="tooltip" data-placement="top" title="" data-original-title="Create New Plan"><i class="fas fa-plus"></i></a>
            </div>
        </div>
    </div>
    <div class="row">



    </div>
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
        $('.caja_sort').sortable({
            connectWith:'.caja_sort',
            // handle:'.title',
            // placeholder: ....,
            tolerance:'intersect',
            stop:function(){
                calcular_ancho($(this));
            },
        });
        function calcular_ancho(obj){
            console.log('se cojio el:'+$(obj).attr('id'));
            var titles =$(obj).children('.content-list-book').children('.content-list-book-s').children().children().children('.dias_iti_c2');
            $(titles).each(function(index, element){
                var elto=$(element).html();
                console.log('elto:'+elto);
                var pos=(index+1);
                $(element).html('Dia '+pos+':');
            });

        }
        $("ol.simple_with_animation").sortable({
            group: 'simple_with_animation',
            pullPlaceholder: false,
            tolerance: 6,
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
