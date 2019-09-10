@php
    function fecha_peru($fecha){
        $fecha_temp='';
        $fecha_temp=explode('-',$fecha);
        return $fecha_temp[2].'/'.$fecha_temp[1].'/'.$fecha_temp[0];
    }
@endphp
@extends('layouts.admin.operaciones')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white m-0">
            <li class="breadcrumb-item" aria-current="page"><a href="/">Home</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="/">Operaciones</a></li>
            <li class="breadcrumb-item active">List</li>
        </ol>
    </nav>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="{{route('operaciones_lista_path')}}" method="post">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="txt_desde" class="font-weight-bold text-secondary">Desde</label>
                                    <input type="date" class="form-control" id="txt_desde" name="txt_desde" required="required" value="{{$desde}}">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="txt_hasta" class="font-weight-bold text-secondary">Hasta</label>
                                    <input type="date" class="form-control" id="txt_hasta" name="txt_hasta" required="required" value="{{$hasta}}">
                                </div>
                            </div>
                            <div class="col-2 mt-4">
                                {{csrf_field()}}
                                <input type="submit" class="btn btn-primary btn-lg" name="Buscar">
                            </div>


                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card w-100">
                <!-- Default panel contents -->
                <div class="card-header">
                    Lista de operaciones de <span class="badge badge-primary">{{fecha_peru($desde)}}</span> a <span class="badge badge-primary">{{fecha_peru($hasta)}}</span>
                    <a href="{{route('imprimir_operaciones_path',[$desde,$hasta])}}" class="btn btn-danger btn-sm">
                        <i class="fas fa-file-pdf"></i>
                    </a>
                    <a href="{{route('imprimir_operaciones_excel_path',[$desde,$hasta])}}" class="btn btn-success btn-sm d-none">
                        <i class="fas fa-file-excel"></i>
                    </a>
                </div>
                <!-- Table -->
                <div class="row d-none">
                    <div class="col">
                        <label for="cliente">Cliente:</label>
                        <input class="form-control" id="cliente" type="text" placeholder="Nombre del cliente">
                    </div>
                    <div class="col">
                        <label for="proveedor">Proveedor:</label>
                        <input class="form-control" id="proveedor" type="text" placeholder="Ingrese el proveedor">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table id="example_tabla" class="table table-striped table-responsive table-bordered table-hover small table-sm py-0 text-11 table-condensed no-padding no-margin">
                <thead>
                <tr class="bg-primary text-white">
                    <th>FECHA</th>
                    <th>N° PAX.</th>
                    <th>CLIENTE</th>
                    <th>CTA</th>
                    {{--<th>ID</th>--}}
                    <th>HORA</th>
                    <th>TOUR</th>
                    <th>REPRESENT</th>
                    <th>HOTEL</th>
                    <th>MOVILIDAD</th>
                    <th>ENTRANCES</th>
                    <th>FOOD</th>
                    <th>TRAIN</th>
                    <th>FLIGHT</th>
                    <th>OTHERS</th>
                    <th>OBSERVACIONES</th>
                </tr>
                </thead>
                <tbody >
                @foreach($array_datos_cotizacion as $key => $array_datos_coti_)
                    @php
                        $arreglo=explode('%',$array_datos_coti_['servicio']);
                        $hora=explode('_',$key);
                        // $key1=substr($key,0,strlen($key)-6);
                        $key1=$hora[0].'_'.$hora[1].'_'.$hora[2];
                        $valor=explode('|',$array_datos_coti[$key1]['datos']);
                        $valor1=explode('|',$array_datos_coti[$key1]['datos']);
                    @endphp
                    <tr class="@if($array_datos_coti_['anulado']==0) venta_anulada @endif">
                        
                        <td>{{fecha_peru($valor[0])}}</td>
                        <td>{{$valor[1]}}</td>
                        <td>{!!$valor[2]!!}</td>
                        {{--<td>{{$valor[3]}}</td>--}}
                        <td>
                            {{substr($valor[3],0,8)}}/<br>{{substr($valor[4],0,3)}}
                        </td>
                        {{--<td>{{$valor[4]}}</td>--}}
                        <td>{{$hora[3]}}</td>
                        <td>
                            @foreach($arreglo as $arre)
                                @php
                                    $valor =explode('|',$arre);
                                @endphp

                                @if('TOURS'==$valor[0])
                                    {!! $valor[1] !!}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($arreglo as $arre)
                                @php
                                    $valor =explode('|',$arre);
                                @endphp

                                @if('REPRESENT'==$valor[0])
                                    {!! $valor[1] !!}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @if(array_key_exists($key,$array_hotel))
                                {!! $array_hotel[$key] !!}
                            @else
                                @foreach ($array_hotel as $clavesita => $item)
                                   @if(substr($key,0,strlen($key)-5)==substr($clavesita,0,strlen($clavesita)-5))
                                    {!! $item !!}
                                   @endif
                                @endforeach
                                {{--  {!! $array_hotel[$key] !!}  --}}
                            @endif
                        </td>
                        <td>
                            @foreach($arreglo as $arre)
                                @php
                                    $valor =explode('|',$arre);
                                @endphp

                                @if('MOVILID'==$valor[0])
                                    {!! $valor[1] !!}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($arreglo as $arre)
                                @php
                                    $valor =explode('|',$arre);
                                @endphp

                                @if('ENTRANCES'==$valor[0])
                                    {!! $valor[1] !!}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($arreglo as $arre)
                                @php
                                    $valor =explode('|',$arre);
                                @endphp

                                @if('FOOD'==$valor[0])
                                    {!! $valor[1] !!}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($arreglo as $arre)
                                @php
                                    $valor =explode('|',$arre);
                                @endphp

                                @if('TRAINS'==$valor[0])
                                    {!! $valor[1] !!}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($arreglo as $arre)
                                @php
                                    $valor =explode('|',$arre);
                                @endphp

                                @if('FLIGHTS'==$valor[0])
                                    {!! $valor[1] !!}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($arreglo as $arre)
                                @php
                                    $valor =explode('|',$arre);
                                @endphp

                                @if('OTHERS'==$valor[0])
                                    {!! $valor[1] !!}
                                @endif
                            @endforeach
                        </td>
                        <td>{!!$valor1[5]!!}</td>
                    </tr>
                @endforeach
                </tbody>
                {{--<tfoot>--}}
                {{--<tr class="bg-primary text-white">--}}
                    {{--<th>FECHA</th>--}}
                    {{--<th>N° PAX.</th>--}}
                    {{--<th>CLIENTE</th>--}}
                    {{--<th>CTA</th>--}}
                    {{--<th>ID</th>--}}
                    {{--<th>HORA</th>--}}
                    {{--<th>TOUR</th>--}}
                    {{--<th>REPRESENT</th>--}}
                    {{--<th>HOTEL</th>--}}
                    {{--<th>MOVILIDAD</th>--}}
                    {{--<th>ENTRANCES</th>--}}
                    {{--<th>FOOD</th>--}}
                    {{--<th>TRAIN</th>--}}
                    {{--<th>FLIGHT</th>--}}
                    {{--<th>OTHERS</th>--}}
                    {{--<th>OBSERVACIONES</th>--}}
                {{--</tr>--}}
                {{--</tfoot>--}}
            </table>
        </div>
    </div>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>

    <script>
        $(document).ready( function () {
            // $('#example_tabla').DataTable({
            //     paging: false,
            //     dom: 'Bfrtip',
            //     buttons: [
            //         'copyHtml5',
            //         'excelHtml5',
            //     ]
            // });

            var table = $('#example_tabla').DataTable( {
                "ordering": false,
                paging: false,
                dom: 'Bfrtip',
                buttons: [ 'copyHtml5', 'excelHtml5'],

            } );

            table.buttons().container()
                .appendTo( '#example_tabla_wrapper .col-md-6:eq(0)' );
        } );
    </script>
@stop
