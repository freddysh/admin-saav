@extends('layouts.admin.admin')
@section('archivos-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">
@stop
@section('archivos-js')
    <script src="{{asset("https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js")}}"></script>
    <script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
@stop
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white m-0">
            <li class="breadcrumb-item" aria-current="page"><a href="/">Home</a></li>
            <li class="breadcrumb-item">Inventory</li>
            <li class="breadcrumb-item active">Day by Day</li>
        </ol>
    </nav>
    <hr>
    <div class="row margin-top-20">
        <div class="col">
            <a class="btn btn-primary btn-sm" href="{{route('daybyday_new_path')}}">
                <i class="fa fa-plus" aria-hidden="true"></i> New
            </a>
        </div>
    </div>
    <div class="row mt-3">
            <div class="col">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-justified">
                    @php
                        $activo='active';
                    @endphp
                    @foreach($destinations as $destino)
                            <li class="nav-item active">
                            <a href="#{{$destino->id}}" class="nav-link show small p-2 {{$activo}} rounded-0" aria-controls="home" role="tab" data-toggle="tab">{{$destino->codigo}}</a>
                        </li>
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
                        <div role="tabpanel" class="tab-pane show {{$activo}}" id="{{$destino->id}}">
                            <div class="row mt-3">
                                <div class="col">
                                    <table id="example{{$destino->id}}" class="table table-bordered table-sm" cellspacing="0" width="100%">
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
                                                            $servicios.='<p class="text-unset text-11"><b class="text-primary text-13"><i class="fa fa-map"></i></b> '.$it_iti_servicio->itinerario_servicios_servicio->nombre.' '.$p_venta.'$</p>';
                                                        @endphp
                                                    @endif
                                                    @if($it_iti_servicio->itinerario_servicios_servicio->grupo=='MOVILID')
                                                        @php
                                                            $servicios.='<p class="text-unset text-11"><b class="text-primary text-13"><i class="fa fa-bus"></i></b> '.$it_iti_servicio->itinerario_servicios_servicio->nombre.' '.$p_venta.'$</p>';
                                                        @endphp
                                                    @endif
                                                    @if($it_iti_servicio->itinerario_servicios_servicio->grupo=='REPRESENT')
                                                        @php
                                                            $servicios.='<p class="text-unset text-11"><b class="text-primary text-13"><i class="fa fa-users"></i></b> '.$it_iti_servicio->itinerario_servicios_servicio->nombre.' '.$p_venta.'$</p>';
                                                        @endphp
                                                    @endif
                                                    @if($it_iti_servicio->itinerario_servicios_servicio->grupo=='ENTRANCES')
                                                        @php
                                                            $servicios.='<p class="text-unset text-11"><b class="text-primary text-13"><i class="fas fa-ticket-alt"></i></b> '.$it_iti_servicio->itinerario_servicios_servicio->nombre.' '.$p_venta.'$</p>';
                                                        @endphp
                                                    @endif
                                                    @if($it_iti_servicio->itinerario_servicios_servicio->grupo=='FOOD')
                                                        @php
                                                            $servicios.='<p class="text-unset text-11"><b class="text-primary text-13"><i class="fa fa-cutlery"></i></b> '.$it_iti_servicio->itinerario_servicios_servicio->nombre.' '.$p_venta.'$</p>';
                                                        @endphp
                                                    @endif
                                                    @if($it_iti_servicio->itinerario_servicios_servicio->grupo=='TRAINS')
                                                        @php
                                                            $servicios.='<p class="text-unset text-11"><b class="text-primary text-13"><i class="fa fa-train"></i></b> '.$it_iti_servicio->itinerario_servicios_servicio->nombre.' '.$p_venta.'$</p>';
                                                        @endphp
                                                    @endif
                                                    @if($it_iti_servicio->itinerario_servicios_servicio->grupo=='FLIGHTS')
                                                        @php
                                                            $servicios.='<p class="text-unset text-11"><b class="text-primary text-13"><i class="fa fa-plane"></i></b> '.$it_iti_servicio->itinerario_servicios_servicio->nombre.' '.$p_venta.'$</p>';
                                                        @endphp
                                                    @endif
                                                    @if($it_iti_servicio->itinerario_servicios_servicio->grupo=='OTHERS')
                                                        @php
                                                            $servicios.='<p class="text-unset text-11"><b class="text-primary text-13"><i class="fa fa-question"></i></b> '.$it_iti_servicio->itinerario_servicios_servicio->nombre.' '.$p_venta.'$</p>';
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                <tr id="lista_itinerary_{{$itinerario->id}}">
                                                <td class="text-capitalize">
                                                    <span>
                                                        {{strtolower($itinerario->titulo)}}
                                                        <a href="#" title="Servicios" data-toggle="popover" data-trigger="hover" data-content="{{{ $servicios }}}" class="float-right"><i class="far fa-eye text-secondary" aria-hidden="true"></i></a>
                                                    </span>
                                                </td>
                                                <td>{!! substr($itinerario->descripcion,0,50) !!}...</td>
                                                <td>
                                                    @foreach($itinerario->destinos as $destinos)
                                                        @foreach($destinations->where('destino',$destinos->destino) as $destination)
                                                            @if($itinerario->destino_foco==$destination->id)
                                                                <p class="m-0"><b><i class="fas fa-map-pin"></i> <span class="text-g-yellow">{{ucwords(strtolower($destinos->destino))}}</span></b></p>
                                                            @elseif($itinerario->destino_duerme==$destination->id)
                                                                <p class="m-0"><b><i class="fas fa-h-square"></i> <span class="text-g-yellow">{{ucwords(strtolower($destinos->destino))}}</span></b></p>
                                                            @endif

                                                        @endforeach
                                                    @endforeach
                                                    <p class="small text-secondary">
                                                        <b class="text-"><i class="fa fa-map-marker-alt"></i></b>
                                                        @foreach($itinerario->destinos as $destinos)
                                                            {{ucwords(strtolower($destinos->destino))}} |
                                                        @endforeach
                                                    </p>
                                                </td>
                                                <td class="text-right">
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
                                                    <p class="font-weight-bold"><sup>$</sup>{{$total_recio_venta}}</p>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{route('daybyday_new_edit_path',$itinerario->id)}}" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="eliminar_itinerario('{{$itinerario->id}}','{{$itinerario->titulo}}')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{csrf_field()}}
                                </div>
                            </div>
                        </div>
                        @if($activo=='active')
                            @php
                                $activo='';
                            @endphp
                        @endif
                    @endforeach
                </div>
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