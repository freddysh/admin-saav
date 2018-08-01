@extends('layouts.admin.admin')
@section('archivos-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">
@stop
@section('archivos-js')
    <script src="{{asset("https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js")}}"></script>
    <script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@stop
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Inventory</li>
            <li class="active">Day by Day</li>
        </ol>
    </div>
    <div class="row margin-top-20">
        <a class="btn btn-primary" href="{{route('daybyday_new_path')}}">
            New <i class="fa fa-plus-circle" aria-hidden="true"></i>
        </a>
    </div>
    <div class="divider margin-top-20"></div>
            <div>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    @php
                        $activo='active';
                    @endphp
                    @foreach($destinations as $destino)
                        <li role="presentation" class="{{$activo}}" data-toggle="tooltip" data-placement="top" title="{{$destino->destino}}"><a href="#{{$destino->id}}" aria-controls="home" role="tab" data-toggle="tab">{{$destino->codigo}}</a></li>
                        @if($activo=='active')
                            @php
                                $activo='';
                            @endphp
                        @endif
                    @endforeach
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    @php
                        $activo='active';
                    @endphp
                    @foreach($destinations as $destino)
                        <div role="tabpanel" class="tab-pane {{$activo}}" id="{{$destino->id}}">
                            <div class="margin-top-10"></div>
                            <table id="example{{$destino->id}}" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th width="100px">Titulo</th>
                                    <th width="100px">Descripcion</th>
                                    <th width="100px">Destinos</th>
                                    <th width="50px">Costo</th>
                                    <th width="50px">Operaciones</th>
                                </tr>
                                </thead>
                                {{--<tfoot>--}}
                                {{--<tr>--}}
                                    {{--<th width="20%">Titulo</th>--}}
                                    {{--<th width="20%">Descripcion</th>--}}
                                    {{--<th width="40%">Destinos</th>--}}
                                    {{--<th width="10%">Costo</th>--}}
                                    {{--<th width="10%">Operaciones</th>--}}
                                {{--</tr>--}}
                                {{--</tfoot>--}}
                                <tbody>
                                @foreach($itinerarios as $itinerario)
{{--                                @foreach($itinerarios->where('destino_foco',$destino->id) as $itinerario)--}}
                                    @php
                                        $arreglo_dest=array();
                                    @endphp
                                    @foreach($itinerario->destinos as $destinos3)
                                        @php
                                            $arreglo_dest[]=$destinos3->destino;
                                        @endphp
                                    @endforeach
                                    @if(in_array($destino->destino,$arreglo_dest))
                                        @php
                                            $servicios='';
                                        @endphp
                                        @foreach($itinerario->itinerario_itinerario_servicios as $it_iti_servicio)
                                            @php
                                            if($it_iti_servicio->itinerario_servicios_servicio->grupo!='HOTELS'){
                                                $p_venta=$it_iti_servicio->itinerario_servicios_servicio->precio_venta;
                                                if($it_iti_servicio->itinerario_servicios_servicio->precio_grupo==1)
                                                    $p_venta=round($it_iti_servicio->itinerario_servicios_servicio->precio_venta/2,2);
                                            }
                                            @endphp
                                            @if($it_iti_servicio->itinerario_servicios_servicio->grupo=='TOURS')
                                                @php
                                                    $servicios.='<p class="text-unset text-11"><b class="text-primary text-13"><i class="fa fa-map-o" aria-hidden="true"></i></b> '.$it_iti_servicio->itinerario_servicios_servicio->nombre.' '.$p_venta.'$</p>';
                                                @endphp
                                            @endif
                                            @if($it_iti_servicio->itinerario_servicios_servicio->grupo=='MOVILID')
                                                @php
                                                    $servicios.='<p class="text-unset text-11"><b class="text-primary text-13"><i class="fa fa-bus" aria-hidden="true"></i></b> '.$it_iti_servicio->itinerario_servicios_servicio->nombre.' '.$p_venta.'$</p>';
                                                @endphp
                                            @endif
                                            @if($it_iti_servicio->itinerario_servicios_servicio->grupo=='REPRESENT')
                                                @php
                                                    $servicios.='<p class="text-unset text-11"><b class="text-primary text-13"><i class="fa fa-users" aria-hidden="true"></i></b> '.$it_iti_servicio->itinerario_servicios_servicio->nombre.' '.$p_venta.'$</p>';
                                                @endphp
                                            @endif
                                            @if($it_iti_servicio->itinerario_servicios_servicio->grupo=='ENTRANCES')
                                                @php
                                                    $servicios.='<p class="text-unset text-11"><b class="text-primary text-13"><i class="fa fa-ticket" aria-hidden="true"></i></b> '.$it_iti_servicio->itinerario_servicios_servicio->nombre.' '.$p_venta.'$</p>';
                                                @endphp
                                            @endif
                                            @if($it_iti_servicio->itinerario_servicios_servicio->grupo=='FOOD')
                                                @php
                                                    $servicios.='<p class="text-unset text-11"><b class="text-primary text-13"><i class="fa fa-cutlery" aria-hidden="true"></i></b> '.$it_iti_servicio->itinerario_servicios_servicio->nombre.' '.$p_venta.'$</p>';
                                                @endphp
                                            @endif
                                            @if($it_iti_servicio->itinerario_servicios_servicio->grupo=='TRAINS')
                                                @php
                                                    $servicios.='<p class="text-unset text-11"><b class="text-primary text-13"><i class="fa fa-train" aria-hidden="true"></i></b> '.$it_iti_servicio->itinerario_servicios_servicio->nombre.' '.$p_venta.'$</p>';
                                                @endphp
                                            @endif
                                            @if($it_iti_servicio->itinerario_servicios_servicio->grupo=='FLIGHTS')
                                                @php
                                                    $servicios.='<p class="text-unset text-11"><b class="text-primary text-13"><i class="fa fa-plane" aria-hidden="true"></i></b> '.$it_iti_servicio->itinerario_servicios_servicio->nombre.' '.$p_venta.'$</p>';
                                                @endphp
                                            @endif
                                            @if($it_iti_servicio->itinerario_servicios_servicio->grupo=='OTHERS')
                                                @php
                                                    $servicios.='<p class="text-unset text-11"><b class="text-primary text-13"><i class="fa fa-question" aria-hidden="true"></i></b> '.$it_iti_servicio->itinerario_servicios_servicio->nombre.' '.$p_venta.'$</p>';
                                                @endphp
                                            @endif
                                        @endforeach
                                        <tr id="lista_itinerary_{{$itinerario->id}}">
                                        <td>{{$itinerario->titulo}}
                                            <a href="#" title="Servicios" data-toggle="popover" data-trigger="hover" data-content="{{{ $servicios }}}"><i class="fa fa-eye text-warning" aria-hidden="true"></i></a>
                                        </td>
                                        <td>{!! substr($itinerario->descripcion,0,50) !!}...</td>
                                        <td>
                                            @foreach($itinerario->destinos as $destinos)
                                                @foreach($destinations->where('destino',$destinos->destino) as $destination)
                                                    @if($itinerario->destino_foco==$destination->id)
                                                        <b>Destino: </b><label for="" class="text-10 text-green-goto">{{$destinos->destino}}</label>
                                                    @elseif($itinerario->destino_duerme==$destination->id)
                                                        | <b>Hotel: </b><label for="" class="text-10 text-green-goto">{{$destinos->destino}}</label>
                                                    @endif

                                                @endforeach
                                            @endforeach
                                            <p>
                                                <b class="text-success"><i class="fa fa-map-marker" aria-hidden="true"></i></b>
                                                @foreach($itinerario->destinos as $destinos)
                                                    <label for="" class="text-10 text-orange-goto">{{$destinos->destino}}</label> |
                                                @endforeach
                                            </p>
                                        </td>
                                        <td>
                                            <?php
                                            $total_recio_venta=0;
                                            ?>
                                            @foreach($itinerario->itinerario_itinerario_servicios as $it_iti_servicio)
                                                <?php
                                                if($it_iti_servicio->itinerario_servicios_servicio->grupo!='HOTELS'){
                                                    $p_venta=$it_iti_servicio->itinerario_servicios_servicio->precio_venta;
                                                    if($it_iti_servicio->itinerario_servicios_servicio->precio_grupo==1)
                                                        $p_venta=round($it_iti_servicio->itinerario_servicios_servicio->precio_venta/2,2);
                                                    $total_recio_venta+=$p_venta;
                                                }
                                                ?>
                                            @endforeach
                                            <label for="" class="text-16 text-green-goto">{{$total_recio_venta}}$</label>
                                        </td>
                                        <td>
                                            <a href="{{route('daybyday_new_edit_path',$itinerario->id)}}" class="btn btn-warning">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger" onclick="eliminar_itinerario('{{$itinerario->id}}','{{$itinerario->titulo}}')">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                            {{csrf_field()}}
                        </div>
                        @if($activo=='active')
                            @php
                                $activo='';
                            @endphp
                        @endif
                    @endforeach
                </div>
            </div>

    <script>
        $(document).ready(function() {
            $(document).ready(function(){
                $('[data-toggle="popover"]').popover({
                    placement : 'top',
                    trigger : 'hover',
                    html:'true'
                });
            });
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