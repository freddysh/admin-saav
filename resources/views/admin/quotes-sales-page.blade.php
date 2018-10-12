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
@php
    function fecha_peru($fecha){
        $f=explode('-',$fecha);
        return $f[2].'-'.$f[1].'-'.$f[0];
    }
@endphp
@section('content')
    <div class="row no-gutters mb-2">
        <div class="col text-center">
            <a href="{{route('sales_quote_page_path', 'gotoperu.com')}}" class="btn btn-block btn-sm @if($page == 'gotoperu.com') btn-success @else btn-light text-secondary  @endif">gotoperu.com</a>
            @if($page == 'gotoperu.com') <i class="fas fa-sort-down fa-2x arrow-page text-success"></i>  @endif
        </div>
        <div class="col text-center">
            <a href="{{route('sales_quote_page_path', 'llama.tours')}}" class="btn btn-block btn-sm @if($page == 'llama.tours') btn-success @else btn-light text-secondary  @endif">llama.tours</a>
            @if($page == 'llama.tours') <i class="fas fa-sort-down fa-2x arrow-page text-success"></i>  @endif
        </div>
        <div class="col text-center">
            <a href="{{route('sales_quote_page_path', 'gotoperu.com.pe')}}" class="btn btn-block btn-sm @if($page == 'gotoperu.com.pe') btn-success @else  btn-light text-secondary @endif">gotoperu.com.pe</a>
            @if($page == 'gotoperu.com.pe') <i class="fas fa-sort-down fa-2x arrow-page text-success"></i>  @endif
        </div>
        <div class="col text-center">
            <a href="{{route('sales_quote_page_path', 'andesviagens.com')}}" class="btn btn-block btn-sm @if($page == 'andesviagens.com') btn-success @else  btn-light text-secondary @endif">andesviagens.com</a>
            @if($page == 'andesviagens.com') <i class="fas fa-sort-down fa-2x arrow-page text-success"></i>  @endif
        </div>
        <div class="col text-center">
            <a href="{{route('sales_quote_page_path', 'machupicchu-galapagos.com')}}" class="btn btn-block btn-sm @if($page == 'machupicchu-galapagos.com') btn-success @else  btn-light text-secondary @endif">machupicchu-galapagos.com</a>
            @if($page == 'machupicchu-galapagos.com') <i class="fas fa-sort-down fa-2x arrow-page text-success"></i>  @endif
        </div>
        <div class="col text-center">
            <a href="{{route('sales_quote_page_path', 'gotolatinamerica.com')}}" class="btn btn-block btn-sm @if($page == 'gotolatinamerica.com') btn-success @else  btn-light text-secondary @endif">gotolatinamerica.com</a>
            @if($page == 'gotolatinamerica.com') <i class="fas fa-sort-down fa-2x arrow-page text-success"></i>  @endif
        </div>
        <div class="col text-center">
            <a href="{{route('sales_quote_page_path', 'expedia.com')}}" class="btn btn-block btn-sm @if($page == 'expedia.com') btn-success @else  btn-light text-secondary @endif">expedia.com</a>
            @if($page == 'expedia.com') <i class="fas fa-sort-down fa-2x arrow-page text-success"></i>  @endif
        </div>
    </div>
    <div class="row bg-warning py-1">
        <div class="col-1 text-right">
            <span class="text-25">
                <b>Filtrar</b>
            </span>
        </div>
        @php
            $mes=date('m');
            $anio=date('Y');
        @endphp
        <div class="col-1 text-right">
            <span class="text-25">
                {{csrf_field()}}
                <input name="anio" id="anio" class="form-control" type="text" value="{{$anio}}">
            </span>
        </div>
        <div class="col-2 text-left">
            <span class="text-25">

                <select name="mes" id="" class="form-control" onchange="mostrarleads('{{$page}}',$(this).val(),$('#anio').val())">
                    <option value="01" @if($mes=='01'){{'selected'}}@endif>ENERO</option>
                    <option value="02" @if($mes=='02'){{'selected'}}@endif>FEBRERO</option>
                    <option value="03" @if($mes=='03'){{'selected'}}@endif>MARZO</option>
                    <option value="04" @if($mes=='04'){{'selected'}}@endif>ABRIL</option>
                    <option value="05" @if($mes=='05'){{'selected'}}@endif>MAYO</option>
                    <option value="06" @if($mes=='06'){{'selected'}}@endif>JUNIO</option>
                    <option value="07" @if($mes=='07'){{'selected'}}@endif>JULIO</option>
                    <option value="08" @if($mes=='08'){{'selected'}}@endif>AGOSTO</option>
                    <option value="09" @if($mes=='09'){{'selected'}}@endif>SEPTIEMBRE</option>
                    <option value="10" @if($mes=='10'){{'selected'}}@endif>OCTUBRE</option>
                    <option value="11" @if($mes=='11'){{'selected'}}@endif>NOVIEMBRE</option>
                    <option value="12" @if($mes=='12'){{'selected'}}@endif>DICIEMBRE</option>
                </select>
            </span>
        </div>
    </div>
    <div class="row">
        <div id="leads" class="col">
            <div class="row no-gutters">
                <div class="col">
                    <div class="box-header-book border-right-0">
                        <h4 class="no-margin">Sale<span><b class="label label-success">#{{$cotizacion->where('posibilidad','100')->count()}}</b> <small><b>$</b></small></span></h4>
                    </div>
                </div>
            </div>
            <div class="row no-gutters">
                <div class='col box-list-book'>
                    <li value="100">
                        <ol class='simple_with_animation vertical m-0 p-0 caja_sort'>
                            @foreach($cotizacion->sortByDesc('fecha_venta') as $cotizacion_)
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
                                @if($cotizacion_->fecha_venta)
                                @if($cotizacion_->posibilidad=="100" && $cotizacion_->whereYear('fecha_venta',$anio) && $cotizacion_->whereMonth('fecha_venta',$mes))
                                    @php
                                    $date = date_create($cotizacion_->fecha);
                                    $fecha=date_format($date, 'F jS, Y');
                                    $titulo='';
                                    @endphp
                                    <li class="content-list-book" id="content-list-{{$cotizacion_->id}}" value="{{$cotizacion_->id}}">
                                        <div class="content-list-book-s">
                                            <div class="row">
                                                <div class="col-3">
                                                    <a href="{{route('cotizacion_id_show_path',$cotizacion_->id)}}">
                                                        @foreach($cotizacion_->cotizaciones_cliente as $cliente_coti)
                                                            @if($cliente_coti->estado=='1')
                                                                <?php
                                                                $titulo=$cliente_coti->cliente->nombres.' '.$cliente_coti->cliente->apellidos.' x '.$cotizacion_->nropersonas.' '.$fecha;
                                                                ?>
                                                                <small class="text-dark font-weight-bold">
                                                                    <i class="fas fa-user-circle text-secondary"></i>
                                                                    <i class="text-primary">By {{$cotizacion_->users->name}}</i> | <i class="text-success">{{$cotizacion_->codigo}}</i> | {{$cliente_coti->cliente->nombres}} {{$cliente_coti->cliente->apellidos}} x {{$cotizacion_->nropersonas}} {{$fecha}}
                                                                </small>
                                                                <small class="text-primary">
                                                                    <sup>$</sup>{{$valor}}
                                                                </small>
                                                            @endif
                                                        @endforeach
                                                            <i class="text-danger">Confirm.: {{fecha_peru($cotizacion_->fecha_venta)}}</i>
                                                    </a>
                                                </div>
                                                <div class="col-2">
                                                    <div class="icon">
                                                        <a href="#" onclick="Eliminar_cotizacion('{{$cotizacion_->id}}','{{$titulo}}')"><i class="fa fa-trash small text-danger"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                                @endif
                            @endforeach
                        </ol>
                    </li>
                </div>
            </div>
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
            tolerance: 'pointer',
            revert: 'invalid',
            placeholder: 'span2 well placeholder tile',
            forceHelperSize: true,
            connectWith:'.caja_sort',
            // handle:'.title',
            // placeholder: ....,
            tolerance:'intersect',
            receive: function(event, ui ) {
//                console.log('id:'+ $(ui.item).val());
//                console.log('cambiar por:'+ $(this).parent().val());
                var datos = {
                    "txt_cotizacion" : $(ui.item).val(),
                    "txt_porcentaje" : $(this).parent().val()
                };
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('[name="_token"]').val()
                    }
                });
                $.ajax({
                    data:  datos,
                    url:   "{{route('agregar_probabilidad_path')}}",
                    type:  'POST',

                });


//                evento_soltar($(this));
            },
        });
        function evento_soltar(obj){
            var este =$(obj).children();
            $(este).each(function(index, element){
                var elto=$(element).val();
                console.log('id:'+elto);
            });

            var titles =$(obj).parent();
            $(titles).each(function(index, element){
                var elto=$(element).val();
                console.log('cambiar a:'+elto);
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
