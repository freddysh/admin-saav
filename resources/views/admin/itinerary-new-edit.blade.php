@extends('layouts.admin.admin')
@section('archivos-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
@stop
@section('archivos-js')
    <script src="{{asset("https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js")}}"></script>
    <script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>

    {{--<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
@stop
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white m-0">
            <li class="breadcrumb-item" aria-current="page"><a href="/">Home</a></li>
            <li class="breadcrumb-item">Inventory</li>
            <li class="breadcrumb-item">Day by day</li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
    <hr>

        <form action="{{route('call_servicios_edit_path')}}" method="post" id="destination_save_id" enctype="multipart/form-data">
            <h3 class="">New Day by Day</h3>
            <div class="row pb-3">
                <div class="col-3">
                    <div class="form-group">
                        <label for="txt_filtro" class="font-weight-bold text-secondary">Fitro</label>
                        <div class="form-group">
                            <div class="form-check-inline mx-0">
                                <label class="form-check-label btn @if($itinerarios->tipo=='a') btn-primary @else btn-info @endif">
                                    <input type="radio" class="form-check-input d-none" id="in" name="tipo" value="a" @if($itinerarios->tipo=='a') checked @endif onchange="pintar('in')">IN
                                </label>
                            </div>
                            <div class="form-check-inline mx-0">
                                <label class="form-check-label btn @if($itinerarios->tipo=='b') btn-primary @else btn-info @endif">
                                    <input type="radio" class="form-check-input d-none" id="general" name="tipo" value="b" @if($itinerarios->tipo=='b') checked @endif onchange="pintar('general')">GENERAL
                                </label>
                            </div>
                            <div class="form-check-inline mx-0">
                                <label class="form-check-label btn @if($itinerarios->tipo=='c') btn-primary @else btn-info @endif">
                                    <input type="radio" class="form-check-input d-none" id="out" name="tipo" value="c" @if($itinerarios->tipo=='c') checked @endif onchange="pintar('out')">OUT
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-9">
                    <div class="form-group">
                        <label for="txt_titulo" class="font-weight-bold text-secondary">Titulo</label>
                        <input type="text" class="form-control" id="txt_titulo" name="txt_titulo" placeholder="Titulo" value="{{$itinerarios->titulo}}">
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="txt_resumen" class="font-weight-bold text-secondary">Resumen</label>
                        <textarea class="form-control textarea" name="txt_resumen" id="txt_resumen" cols="30" rows="5">{{$itinerarios->resumen}}</textarea>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="txt_descripcion" class="font-weight-bold text-secondary">Descripcion</label>
                        <textarea class="form-control textarea" name="txt_descripcion" id="txt_descripcion" cols="30" rows="5">{{$itinerarios->descripcion}}</textarea>
                    </div>
                </div>

                        <div class="col-lg-4">
                            <label for="txt_imagen" class="font-weight-bold text-secondary">Primera imagen</label>
                            @if (Storage::disk('itinerary')->has($itinerarios->imagen))
                                <picture>
                                    <img
                                            src="{{route('itinerary_image_path', ['filename' => $itinerarios->imagen])}}"  width="100" height="100">
                                </picture>
                            @endif
                            <input type="file" class="form-control form-control-file" id="txt_imagen" name="txt_imagen" placeholder="Imagen" size="2048" onchange="ValidarImagen(this,11);">
                            <span id="mensaje_file11" class="text-danger text-15"></span>
                        </div>

                            <div class="col-lg-4">
                                <label for="txt_imagen" class="font-weight-bold text-secondary">Segunda imagen</label>
                                @if (Storage::disk('itinerary')->has($itinerarios->imagenB))
                                    <picture>
                                        <img
                                                src="{{route('itinerary_image_path', ['filename' => $itinerarios->imagenB])}}"  width="100" height="100">
                                    </picture>
                                @endif
                                <input type="file" class="form-control form-control-file" id="txt_imagenB" name="txt_imagenB" placeholder="Imagen" size="2048" onchange="ValidarImagen(this,22);">
                                <span id="mensaje_file22" class="text-danger text-15"></span>
                            </div>


                            <div class="col-lg-4">
                                <label for="txt_imagen" class="font-weight-bold text-secondary">Tercera imagen</label>
                                @if (Storage::disk('itinerary')->has($itinerarios->imagenC))
                                    <picture>
                                        <img
                                                src="{{route('itinerary_image_path', ['filename' => $itinerarios->imagenC])}}"  width="100" height="100">
                                    </picture>
                                @endif
                                <input type="file" class="form-control form-control-file" id="txt_imagenC" name="txt_imagenC" placeholder="Imagen" size="2048" onchange="ValidarImagen(this,33);">
                                <span id="mensaje_file33" class="text-danger text-15"></span>
                            </div>

            </div>
            <hr>
            <div class="row my-2">
                <div class="col-12">
                    <h4 class="text-g-yellow">Origen</h4>
                </div>
            </div>
            <div class="row d-none">
                {{csrf_field()}}
                @foreach($destinations as $destino)
                <div class="col-md-3">
                    <div class="checkbox11">
                        <label class="text-primary">
                            <input class="grupo" type="checkbox" name="destinos[]" value="{{$destino->id}}_{{$destino->destino}}" onchange="filtrar_grupos()">
                            {{ucwords(strtolower($destino->destino))}}
                        </label>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row mt-3">
                <div class="col-8">
                    {{csrf_field()}}
                    <select class="form-control" name="txt_destino" id="txt_destino" onchange="limpiar_caja_servicios()">
                        @foreach($destinations as $destino)
                            <option value="{{$destino->id}}_{{$destino->destino}}">{{$destino->destino}}</option>
                        @endforeach
                    </select>
                    <div class="row mt-4">
                        @foreach($categorias as $categoria)
                            <?php
                            $tipoServicio[]=$categoria->nombre;
                            ?>
                        @endforeach
                        <div class="col-10">
                            <div class="row">
                                <div class="col-3 no-margin">
                                    <div class="list-group text-center">
                                        <a href="#!" class="list-group-item" onclick="llamar_servicios($('#txt_destino').val(),'{{$tipoServicio[1]}}')"><i class="fas fa-map fa-2x text-info"></i><b class="small d-block">{{$tipoServicio[1]}}</b></a>
                                        <a href="#!" class="list-group-item" onclick="llamar_servicios($('#txt_destino').val(),'{{$tipoServicio[2]}}')"> <i class="fa fa-bus fa-2x text-warning"></i><b class="small d-block">{{$tipoServicio[2]}}</b></a>
                                        <a href="#!" class="list-group-item" onclick="llamar_servicios($('#txt_destino').val(),'{{$tipoServicio[3]}}')"> <i class="fa fa-users fa-2x text-success"></i><b class="small d-block">{{$tipoServicio[3]}}</b></a>
                                        <a href="#!" class="list-group-item" onclick="llamar_servicios($('#txt_destino').val(),'{{$tipoServicio[4]}}')"> <i class="fas fa-ticket-alt fa-2x text-warning"></i><b class="small d-block">{{$tipoServicio[4]}}</b></a>
                                        <a href="#!" class="list-group-item" onclick="llamar_servicios($('#txt_destino').val(),'{{$tipoServicio[5]}}')"> <i class="fas fa-utensils fa-2x text-danger"></i><b class="small d-block">{{$tipoServicio[5]}}</b></a>
                                        <a href="#!" class="list-group-item" onclick="llamar_servicios($('#txt_destino').val(),'{{$tipoServicio[6]}}')"> <i class="fa fa-train fa-2x text-info"></i><b class="small d-block">{{$tipoServicio[6]}}</b></a>
                                        <a href="#!" class="list-group-item" onclick="llamar_servicios($('#txt_destino').val(),'{{$tipoServicio[7]}}')"> <i class="fa fa-plane fa-2x text-primary"></i><b class="small d-block">{{$tipoServicio[7]}}</b></a>
                                        <a href="#!" class="list-group-item" onclick="llamar_servicios($('#txt_destino').val(),'{{$tipoServicio[8]}}')"> <i class="fa fa-question fa-2x text-success"></i><b class="small d-block">{{$tipoServicio[8]}}</b></a>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="panel panel-default">
                                        <div id="list_servicios_grupo" class="panel-body"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col">
                            <div class="list-group text-center">
                                <button type="button" class="btn btn-primary  text-center" onclick="escojer_servicio()">
                                    <i class="fa fa-arrow-right  text-center" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">SERVICIOS ESCOJIDOS</div>
                        <div class="card-body">
                            <input type="hidden" id="nroServicios" value="{{count($itinerarios->itinerario_itinerario_servicios)}}">
                            <div id="caja_1" class="caja_sort ml-0">
                                @php
                                    $array_destinos=[];
                                @endphp
                                @foreach($itinerarios->itinerario_itinerario_servicios as $itinerario_itinerario_servicio)
                                <div id="elto_{{$itinerario_itinerario_servicio->m_servicios_id}}" class="col-lg-11 elemento_sort">
                                    <div class="row no-gutters">
                                        <div class="col-1 small puntero"><span class="text-unset"><i class="fa fa-arrows-alt" aria-hidden="true"></i></span></div>
                                        <div class="col-1 pos small">{{$itinerario_itinerario_servicio->pos}}</div>
                                        <div class="col-9 small">
                                            @php
                                                $servi='';
                                                $desti_id='';
                                                $desti_nombre='';
                                                $grupo='';
                                                $clase='';

                                            @endphp
                                            @foreach($services->where('id',$itinerario_itinerario_servicio->m_servicios_id) as $serv)
                                                @php
                                                    $servi=$serv->nombre;
                                                    $desti_nombre=$serv->localizacion;
                                                    $grupo=$serv->grupo;
                                                    $clase=$serv->clase;
                                                @endphp
                                            @endforeach
                                            @foreach($destinations->where('destino',$desti_nombre) as $destino)
                                                @php
                                                    $desti_id=$destino->id;
                                                    $concat=$destino->id.'_'.$destino->destino;
                                                @endphp
                                                @if(!in_array($concat,$array_destinos))
                                                    @php
                                                        $array_destinos[]=$concat;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @if($grupo=='TOURS')
                                                <i class="fas fa-map text-info" aria-hidden="true"></i>
                                            @elseif($grupo=='MOVILID')
                                                @if($clase=='BOLETO')
                                                    <i class="fas fa-ticket-alt text-warning" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-bus text-warning" aria-hidden="true"></i>
                                                @endif
                                            @elseif($grupo=='REPRESENT')
                                                <i class="fa fa-users text-success" aria-hidden="true"></i>
                                            @elseif($grupo=='ENTRANCES')
                                                <i class="fa fa-ticket text-success" aria-hidden="true"></i>
                                            @elseif($grupo=='FOOD')
                                                <i class="fas fa-utensils text-danger" aria-hidden="true"></i>
                                            @elseif($grupo=='TRAINS')
                                                <i class="fa fa-train text-info" aria-hidden="true"></i>
                                            @elseif($grupo=='FLIGHTS')
                                                <i class="fa fa-plane text-primary" aria-hidden="true"></i>
                                            @elseif($grupo=='OTHERS')
                                                <i class="fa fa-question text-success" aria-hidden="true"></i>
                                            @endif
                                            {{$servi}}
                                            <span class="text-warning"> ({{$desti_nombre}})</span>
                                            <input type="hidden" name="servicios_esc[]" value="{{$itinerario_itinerario_servicio->m_servicios_id}}"><input type="hidden" name="destinos_esc[]" value="{{$desti_id}}"></div>
                                        <div class="col-1 small puntero"><span class="text-danger float-right text-right" onclick="borrar_servicios_esc('{{$itinerario_itinerario_servicio->m_servicios_id}}','{{$servi}}')"><i class="fas fa-trash" aria-hidden="true"></i></span></div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="txt_travel_date" class="font-weight-bold text-secondary">Origen</label>
                                        <select class="form-control" name="txt_destino_foco" id="txt_destino_foco">
                                            <option value="0">Escoja un destino</option>
                                            @foreach($destinations as $destino)
                                                <option value="{{$destino->id}}" @if($itinerarios->destino_foco==$destino->id){{'selected'}}@endif>{{$destino->destino}}</option>
                                            @endforeach
                                            {{--@foreach($array_destinos as $destins)--}}
                                                {{--@php--}}
                                                    {{--$destins_=explode('_',$destins);--}}
                                                {{--@endphp--}}
                                            {{--@endforeach--}}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="txt_travel_date" class="font-weight-bold text-secondary">Destino</label>
                                        <select class="form-control" name="txt_destino_duerme" id="txt_destino_duerme">
                                            <option value="0">Escoja un destino</option>
                                            <option value="-1" @if($itinerarios->destino_duerme=='-1'){{'selected'}}@endif>NO DUERME</option>
                                            @foreach($destinations as $destino)
                                                <option value="{{$destino->id}}" @if($itinerarios->destino_duerme==$destino->id){{'selected'}}@endif>{{$destino->destino}}</option>
                                            @endforeach
                                        {{--@foreach($array_destinos as $destins)--}}
                                                {{--@php--}}
                                                    {{--$destins_=explode('_',$destins);--}}
                                                {{--@endphp--}}
                                                {{--<option value="{{$destins_[0]}}" @if($itinerarios->destino_duerme==$destins_[0]){{'selected'}}@endif>{{$destins_[1]}}</option>--}}
                                            {{--@endforeach--}}
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 text-left text-16 d-none">
                    <label class="text-green-goto">Total(cost without hotel) $<span id="total_ci_0"></span></label>
                </div>
                <div class="col-lg-12 text-right mb-5">
                    <input type="hidden" name="itinerario_id" value="{{$itinerarios->id}}">
                    <button type="submit" class="btn btn-primary">Edit changes</button>
                </div>
            </div>
            {{csrf_field()}}
            <input type="hidden" name="precio_itinerario" id="precio_itinerario_0" value="0">
        </form>

    <script>

        $(document).ready(function() {

//            calcWidth($('#title0'));

            window.onresize = function(event) {
                console.log("window resized");

                //method to execute one time after a timer

            };

            //recursively calculate the Width all titles
            function calcWidth(obj){
                console.log('se cojio:'+$(obj).attr('id'));
                console.log('---- calcWidth -----');

//              var titles =$(obj).siblings('.space').children('.route').children('.title');
                var titles =$(obj).siblings('.space').children('.route').children('.title').children('.row').children('.orden');

                $(titles).each(function(index, element){
                    var pTitleWidth = parseInt($(obj).css('width'));
                    var leftOffset = parseInt($(obj).siblings('.space').css('margin-left'));

                    var newWidth = pTitleWidth - leftOffset;
                    console.log('pTitleWidth - leftOffset='+pTitleWidth+' - '+leftOffset);
                    if ($(obj).attr('id') == 'title0'){
                        console.log("called");

                        newWidth = newWidth - 10;
                    }
                    $(element).parent('.row').parent('.title').css({
                        'width': newWidth,
                    });

                    var titulo=$(element).html();
                    var pos=(index+1);
//                    var he=$(element).parent();
//                    var brothers=$(he).siblings('.route').length;
//                    var father=$(he).parent('.space');
//                    var tios=$(father).parent('.route').siblings('.route').length;
//                    console.log('hijo:'+$(element).html()+', Pos:'+pos+' -> Hi is:'+he.attr('id')+' con '+brothers+' brothers, father:'+father.attr('id')+' and '+tios+' tios');
                    $(element).html(pos);
                    calcWidth(element);
                });

            }


            $('.space').sortable({
                connectWith:'.space',
                // handle:'.title',
                // placeholder: ....,
                tolerance:'intersect',
                over:function(event,ui){
//                     Recaculate width of all children
//                     var pTitleWidth = parseInt($(this).siblings('.title').css('width').replace('px', ''));
//
//                     if ($(this).siblings('.title').attr('id') == 'title0'){
//                     	var newWidth = (pTitleWidth-20).toString().concat('px');
//                     }
//                     else {
//                     	var newWidth = (pTitleWidth-70).toString().concat('px');
//                     }
//
//                     console.log(pTitleWidth + ', ' + newWidth);
//
//                     $(ui.item).children('.title').css({
//                     	'width': newWidth,
//                     });
//                    calcWidth($(this).siblings('.title'));
//                    console.log('holaaaaa');
                },
                receive:function(event, ui){
                    console.log('se haran cambios');
//                    calcWidth($('#title0'));
//                    calcWidth($(this).siblings('.title'));
//                    calcWidth($(this));
//                    console.log('entro a la funcion received');
                },
                stop:function(){
                    calcWidth($('#title0'));
                },
            });
            $('.space').disableSelection();
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
                var titles =$(obj).children('.elemento_sort').children('.row').children('.pos');
                $(titles).each(function(index, element){
                    var elto=$(element).html();
                    console.log('elto:'+elto);
                    var pos=(index+1);
                    $(element).html(pos);
                });
//
//              var titles =$(obj).siblings('.space').children('.route').children('.title');
//                var titles =$(obj).parent().children('.elemento_sort');

//                $(titles).each(function(index, element){
//                    var pTitleWidth = parseInt($(obj).css('width'));
//                    var leftOffset = parseInt($(obj).siblings('.space').css('margin-left'));
//
//                    var newWidth = pTitleWidth - leftOffset;
//                    console.log('pTitleWidth - leftOffset='+pTitleWidth+' - '+leftOffset);
//                    if ($(obj).attr('id') == 'title0'){
//                        console.log("called");
//
//                        newWidth = newWidth - 10;
//                    }
//                    $(element).parent('.row').parent('.title').css({
//                        'width': newWidth,
//                    });
//
//                    var titulo=$(element).html();
//                    var pos=(index+1);
////                    var he=$(element).parent();
////                    var brothers=$(he).siblings('.route').length;
////                    var father=$(he).parent('.space');
////                    var tios=$(father).parent('.route').siblings('.route').length;
////                    console.log('hijo:'+$(element).html()+', Pos:'+pos+' -> Hi is:'+he.attr('id')+' con '+brothers+' brothers, father:'+father.attr('id')+' and '+tios+' tios');
//                    $(element).html(pos);
//                    calcWidth(element);
//                });

            }
//            $('.elemento_sort').disableSelection();
            @foreach($destinations as $destino)
            $('#example{{$destino->id}}').DataTable();
            @endforeach

        } );
        function ValidarImagen(obj,nro){
            var uploadFile = obj.files[0];

            if (!window.FileReader) {
//                alert('El navegador no soporta la lectura de archivos');
                $('#mensaje_file'+nro).html('El navegador no soporta la lectura de archivos');
                $('#mensaje_file'+nro).removeClass('text-success');
                $('#mensaje_file'+nro).addClass('text-danger');
                return;
            }

            if (!(/\.(jpg|png|gif)$/i).test(uploadFile.name)) {
                $('#mensaje_file'+nro).html('El archivo a adjuntar no es una imagen');
                $('#mensaje_file'+nro).removeClass('text-success');
                $('#mensaje_file'+nro).addClass('text-danger');
//                alert('El archivo a adjuntar no es una imagen');
            }
            else {
                var img = new Image();
                img.onload = function () {
                    if (this.width.toFixed(0) != 360 && this.height.toFixed(0) != 360) {
                        $('#mensaje_file'+nro).html('Las medidas deben ser: 360 x 360, no '+this.width.toFixed(0)+'x'+this.height.toFixed(0));
                        $('#mensaje_file'+nro).removeClass('text-success');
                        $('#mensaje_file'+nro).addClass('text-danger');
//                        alert('Las medidas deben ser: 360 * 360');
                    }
                    else if (uploadFile.size > 20000000)
                    {
                        $('#mensaje_file'+nro).html('El peso de la imagen no puede exceder los 2Mb, no '+uploadFile.size);
                        $('#mensaje_file'+nro).removeClass('text-success');
                        $('#mensaje_file'+nro).addClass('text-danger');
//                         alert('El peso de la imagen no puede exceder los 200kb')
                    }
                    else {
                        $('#mensaje_file'+nro).html('Imagen correcta :)');
                        $('#mensaje_file'+nro).removeClass('text-danger');
                        $('#mensaje_file'+nro).addClass('text-success');

//                      alert('Imagen correcta :)')
                    }
                };
                img.src = URL.createObjectURL(uploadFile);
            }
        }
    </script>
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace( 'txt_descripcion' );
        CKEDITOR.replace( 'txt_resumen' );

    </script>
@stop
