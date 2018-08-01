@extends('layouts.admin.admin')
@section('archivos-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">
@stop
@section('archivos-js')
    <script src="{{asset("https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js")}}"></script>
@stop
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Quotes</li>
            <li class="active">Current</li>
        </ol>
    </div>
    @foreach($paquete as $paquete)
        <div class="text-center ">
            @foreach($cotizacion as $cotizaciones)
                @php $pasajeros = $cotizaciones->nropersonas; @endphp
                @php
                    $date = date_create($cotizaciones->fecha);
                    $fecha=date_format($date, 'jS F Y');
                @endphp
                @foreach($cotizaciones->cotizaciones_cliente as $cliente_cotizaciones)
                    @if($cliente_cotizaciones->estado == 1)
                        @foreach($cotizaciones->cotizaciones_cliente as $cliente_coti)
                            @if($cliente_coti->estado=='1')
                                <b class="text-30 text-green-goto">{{$cliente_coti->cliente->nombres}} {{$cliente_coti->cliente->apellidos}} x {{$cotizaciones->nropersonas}} {{$fecha}}</b>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            @endforeach
        </div>
        <div class="text-center">
            <h2><b class="text-orange-goto">Package Travel: {{$paquete->titulo}}</b></h2>
            <p class="text-grey-goto"><b>Package Code:</b> {{$paquete->codigo}} | <b>Package Duration:</b> {{$paquete->duracion}} | <b>Numero de pasajeros:</b> {{$pasajeros}}</p>
        </div>
        <div>
            <h3 class="text-orange-goto">Outline</h3>
            @foreach($paquete->itinerario_cotizaciones->sortBy('dias') as $itinerario)
                <span class="text-13">Day {{$itinerario->dias}} - {{$itinerario->titulo}}</span><br>
            @endforeach
        </div>
        <div>
            <h3 class="text-orange-goto">Incluye</h3>
            <p>{{$paquete->incluye}}</p>
            <h3 class="text-orange-goto">No Incluye</h3>
            <p>{{$paquete->noincluye}}</p>
        </div>

        <div>
            <h3 class="no-margin text-orange-goto">Itinerary for days</h3>
            @foreach($paquete->itinerario_cotizaciones->sortBy('dias') as $itinerario)
                <h4 class="text-green-goto">Day {{$itinerario->dias}}: {{date("d-m-Y",strtotime($itinerario->fecha))}} - {{$itinerario->titulo}}</h4>
                <p>{{$itinerario->descripcion}}</p>
                @if (Storage::disk('itinerary')->has($itinerario->imagen))
                    <img
                            src="{{route('itinerary_image_path', ['filename' => $itinerario->imagen])}}" class="responsive-img" alt="" width="60%" height="60%">
                @endif
                <h4>Servicios:</h4>
                <table id="example0" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th data-field="id">Concepto</th>
                        <th data-field="name">Observaciones</th>
                        <th data-field="name">Errores</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($itinerario->itinerario_servicios as $servicios)
                        <tr>
                            <td class="text-align-left">{{$servicios->nombre}}</td>
                            <td>{{$servicios->observacion}}</td>
                            <td>
                                @if($servicios->estado_error==1)
                                    {{$servicios->mensaje_error}}
                                    {{--<a href="#" class="text-danger"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a>--}}
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal_edit_cost_hotel_{{$servicios->id}}">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </button>
                                    <div class="modal fade bd-example-modal-lg" id="modal_edit_cost_hotel_{{$servicios->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-ms" role="document">
                                            <div class="modal-content">
                                                <form action="{{route('costs_edit_hotel_path')}}" method="post" id="service_save_id" enctype="multipart/form-data">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Service</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        @php
                                                            $valor='%'.$servicios->nombre.'%';
                                                        @endphp
                                                        {{--{{$servicios->nombre}}--}}
                                                        @foreach($m_servicio->where as $servicio)
                                                            <label for="rb_"><input type="radio" name="rb_[]" id="rb_">{{$servicio->localizacion}} {{$servicio->nombre}} {{$servicio->tipoServicio}} ${{$servicio->precio_venta}}<span class="text-primary">{{$servicio->min_personas}} - {{$servicio->max_personas}}</span></label>
                                                        @endforeach
                                                        <div class="row">
                                                            <div class="col-lg-6"></div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        {{csrf_field()}}
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                @else
                                    <a href="#" class="text-success"><i class="fa fa-check fa-2x" aria-hidden="true"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            @endforeach
        </div>

        <div>
            <h3 class="text-orange-goto"><b>Destinos incluidos:</b></h3>
            @php
                $array_destinos[]=null
            @endphp
            @foreach($paquete->itinerario_cotizaciones as $itinerarios_destino)
                @foreach($itinerarios_destino->itinerario_destinos as $destino)
                    @if(in_array($destino->destino,$array_destinos))
                    @else
                        @php
                            $array_destinos[]=$destino->destino;
                        @endphp
                    @endif
                @endforeach
            @endforeach
            <ul>
                @foreach($array_destinos as $destino)
                    @if($destino!=null)
                    <li>{{$destino}}</li>
                    @endif
                @endforeach
            </ul>
        </div>

        <div>
            <h3  class="text-orange-goto"><b>Precios:</b></h3>
            <p>Los precios son por persona. La cotizacion fue realizado para <b class="text-22 text-green-goto">{{$pasajeros}} personas</b>.</p>
            @php $servicio = 0;$total=0; @endphp
            @foreach($paquete->itinerario_cotizaciones as $paquete_itinerario)
                @foreach($paquete_itinerario->itinerario_servicios as $orden_cotizaciones)
                    @php
                        $total = $orden_cotizaciones->precio + $servicio;
                        $servicio = $total;
                    @endphp
                @endforeach
            @endforeach
            @foreach($paquete->paquete_precios as $precio_paquete2)
                @if($paquete->estado==2)
                    @if($precio_paquete2->estado == 2)
                        <div>
                            <h5 class="no-margin"><b>CATEGORIA: {{$precio_paquete2->estrellas}} ESTRELLAS</b></h5>
                            <table class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Acomodacion</th>
                                    <th class="text-right">Total ($)</th>
                                </tr>
                                @if($precio_paquete2->personas_s > 0)
                                    <tr>
                                        <td class="text-left"><b>Simple</b></td>
                                        <td class="text-right">
                                            @php
                                                $precio_s = (($precio_paquete2->precio_s)* 1) * ($paquete->duracion - 1);
                                                $total_costo = $precio_s + $total;
                                                $total_utilidad = $total_costo + ($total_costo * (($precio_paquete2->utilidad)/100));
                                            @endphp
                                            {{number_format(ceil($total_utilidad), 2, '.', '')}}
                                        </td>
                                        {{--@if($paquete->estado==1)--}}
                                            {{--@if($precio_paquete2->estado==2)--}}
                                                {{--<td rowspan="3" class="text-center"><a href="#" class="text-success"><i class="fa fa-check-square-o fa-5x" aria-hidden="true"></i></a></td>--}}
                                            {{--@else--}}
                                                {{--<td rowspan="3" class="text-center"><a href="#" class="text-muted"><i class="fa fa-pencil-square-o fa-5x" aria-hidden="true"></i></a></td>--}}
                                            {{--@endif--}}
                                        {{--@else--}}
                                            {{--@if($precio_paquete2->estado==2)--}}
                                                {{--<td rowspan="3" class="text-center"><a href="#" class="text-success"><i class="fa fa-check-square-o fa-5x" aria-hidden="true"></i></a></td>--}}
                                            {{--@else--}}
                                                {{--<td rowspan="3" class="text-center"><a href="#" class="text-muted"><i class="fa fa-window-close-o fa-5x" aria-hidden="true"></i></a></td>--}}
                                            {{--@endif--}}
                                        {{--@endif--}}
                                    </tr>
                                @else
                                    @php
                                        $precio_s = 0;
                                    @endphp
                                @endif
                                @if($precio_paquete2->personas_d > 0)
                                    <tr>
                                        <td class="text-left"><b>Doble</b></td>
                                        <td class="text-right">
                                            @php
                                                $precio_d = ceil(($precio_paquete2->precio_d)* (1/2)) * ($paquete->duracion - 1);
                                                $total_costo = $precio_d + $total;
                                                $total_utilidad = $total_costo + ($total_costo * (($precio_paquete2->utilidad)/100));
                                            @endphp
                                            {{number_format(ceil($total_utilidad), 2, '.', '')}}
                                        </td>
                                    </tr>
                                @else
                                    @php
                                        $precio_d = 0;
                                    @endphp
                                @endif
                                @if($precio_paquete2->personas_m > 0)
                                    <tr>
                                        <td class="text-left"><b>Matrimonial</b></td>
                                        <td class="text-right">
                                            @php
                                                $precio_m = ceil(($precio_paquete2->precio_m)* (1/2)) * ($paquete->duracion - 1);
                                                $total_costo = $precio_m + $total;
                                                $total_utilidad = $total_costo + ($total_costo * (($precio_paquete2->utilidad)/100));
                                            @endphp
                                            {{number_format(ceil($total_utilidad), 2, '.', '')}}
                                        </td>
                                    </tr>
                                @else
                                    @php
                                        $precio_m = 0;
                                    @endphp
                                @endif
                                @if($precio_paquete2->personas_t > 0)
                                    <tr>
                                        <td class="text-left"><b>Triple</b></td>
                                        <td class="text-right">
                                            @php
                                                $precio_t = ceil(($precio_paquete2->precio_t)* (1/3)) * ($paquete->duracion - 1);
                                                $total_costo = $precio_t + $total;
                                                $total_utilidad = $total_costo + ($total_costo * (($precio_paquete2->utilidad)/100));
                                            @endphp
                                            {{number_format(ceil($total_utilidad), 2, '.', '')}}
                                        </td>
                                    </tr>
                                @else
                                    @php
                                        $precio_t = 0;
                                    @endphp
                                @endif
                                </thead>
                            </table>
                        </div>
                    @endif
                @else
                    @if($precio_paquete2->estado == 1)
                        <div>
                            <h5 class="no-margin"><b>CATEGORIA: {{$precio_paquete2->estrellas}} ESTRELLAS</b></h5>
                            <table class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Acomodacion</th>
                                    <th class="text-right">Total ($)</th>
                                </tr>
                                @if($precio_paquete2->personas_s > 0)
                                    <tr>
                                        <td class="text-left"><b>Simple</b></td>
                                        <td class="text-right">
                                            @php
                                                $precio_s = (($precio_paquete2->precio_s)* 1) * ($paquete->duracion - 1);
                                                $total_costo = $precio_s + $total;
                                                $total_utilidad = $total_costo + ($total_costo * (($precio_paquete2->utilidad)/100));
                                            @endphp
                                            {{number_format(ceil($total_utilidad), 2, '.', '')}}
                                        </td>
                                        {{--@if($paquete->estado==1)--}}
                                            {{--@if($precio_paquete2->estado==2)--}}
                                                {{--<td rowspan="3" class="text-center"><a href="#" class="text-success"><i class="fa fa-check-square-o fa-5x" aria-hidden="true"></i></a></td>--}}
                                            {{--@else--}}
                                                {{--<td rowspan="3" class="text-center"><a href="#" class="text-muted"><i class="fa fa-pencil-square-o fa-5x" aria-hidden="true"></i></a></td>--}}
                                            {{--@endif--}}
                                        {{--@else--}}
                                            {{--@if($precio_paquete2->estado==2)--}}
                                                {{--<td rowspan="3" class="text-center"><a href="#" class="text-success"><i class="fa fa-check-square-o fa-5x" aria-hidden="true"></i></a></td>--}}
                                            {{--@else--}}
                                                {{--<td rowspan="3" class="text-center"><a href="#" class="text-muted"><i class="fa fa-window-close-o fa-5x" aria-hidden="true"></i></a></td>--}}
                                            {{--@endif--}}
                                        {{--@endif--}}
                                    </tr>
                                @else
                                    @php
                                        $precio_s = 0;
                                    @endphp
                                @endif

                                @if($precio_paquete2->personas_d > 0)
                                    <tr>
                                        <td class="text-left"><b>Doble</b></td>
                                        <td class="text-right">
                                            @php
                                                $precio_d = ceil(($precio_paquete2->precio_d)* (1/2)) * ($paquete->duracion - 1);
                                                $total_costo = $precio_d + $total;
                                                $total_utilidad = $total_costo + ($total_costo * (($precio_paquete2->utilidad)/100));
                                            @endphp
                                            {{number_format(ceil($total_utilidad), 2, '.', '')}}
                                        </td>
                                    </tr>
                                @else
                                    @php
                                        $precio_d = 0;
                                    @endphp
                                @endif
                                @if($precio_paquete2->personas_m > 0)
                                    <tr>
                                        <td class="text-left"><b>Matrimonial</b></td>
                                        <td class="text-right">
                                            @php
                                                $precio_m = ceil(($precio_paquete2->precio_m)* (1/2)) * ($paquete->duracion - 1);
                                                $total_costo = $precio_m + $total;
                                                $total_utilidad = $total_costo + ($total_costo * (($precio_paquete2->utilidad)/100));
                                            @endphp
                                            {{number_format(ceil($total_utilidad), 2, '.', '')}}
                                        </td>
                                    </tr>
                                @else
                                    @php
                                        $precio_m = 0;
                                    @endphp
                                @endif
                                @if($precio_paquete2->personas_t > 0)
                                    <tr>
                                        <td class="text-left"><b>Triple</b></td>
                                        <td class="text-right">
                                            @php
                                                $precio_t = ceil(($precio_paquete2->precio_t)* (1/3)) * ($paquete->duracion - 1);
                                                $total_costo = $precio_t + $total;
                                                $total_utilidad = $total_costo + ($total_costo * (($precio_paquete2->utilidad)/100));
                                            @endphp
                                            {{number_format(ceil($total_utilidad), 2, '.', '')}}
                                        </td>
                                    </tr>
                                @else
                                    @php
                                        $precio_t = 0;
                                    @endphp
                                @endif
                                </thead>
                            </table>
                        </div>
                    @endif
                @endif
            @endforeach
        </div>
    @endforeach

@stop