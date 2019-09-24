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
                    Lista de operaciones de <span class="badge badge-primary">{{MisFunciones::fecha_peru($desde)}}</span> a <span class="badge badge-primary">{{MisFunciones::fecha_peru($hasta)}}</span>
                    <a href="{{route('imprimir_operaciones_uno_path',[$desde,$hasta])}}" class="btn btn-danger btn-sm">
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
            <table id="example_tabla" class="table table-striped table-responsive table-bordered table-hover small table-sm py-0 text-11 no-padding no-margin">
                <thead>
                <tr class="bg-primary text-white">
                    <th style="width: 100px">FECHA</th>
                    <th style="width: 10px">N° PAX.</th>
                    <th style="width: 200px">CLIENTE</th>
                    <th style="width: 80px">CTA</th>
                    {{--<th style="width: 100px">ID</th>--}}
                    <th style="width: 50px">HORA</th>
                    <th style="width: 100px">TOUR</th>
                    <th style="width: 100px">REPRESENT</th>
                    <th style="width: 100px">HOTEL</th>
                    <th style="width: 100px">MOVILIDAD</th>
                    <th style="width: 100px">ENTRANCES</th>
                    <th style="width: 100px">FOOD</th>
                    <th style="width: 100px">TRAIN</th>
                    <th style="width: 100px">FLIGHT</th>
                    <th style="width: 100px">OTHERS</th>
                    <th style="width: 100px">OBSERVACIONES</th>
                </tr>
                </thead>
                <tbody >
                @foreach($arreglo_de_datos as $key => $array_datos_coti_)
                    @php
                        // $arreglo=explode('%',$array_datos_coti_['servicio']);
                        // $hora=explode('_',$key);
                        // $key1=$hora[0].'_'.$hora[1].'_'.$hora[2];
                        // $valor=explode('|',$array_datos_coti[$key1]['datos']);
                        // $valor1=explode('|',$array_datos_coti[$key1]['datos']);

                        $datos=explode('|',$array_datos_coti_['DATOS']);
                    @endphp
                    {{-- <tr class="@if($array_datos_coti_['anulado']==0) venta_anulada @endif"> --}}
                    <tr class="@if($array_datos_coti_['COTIZACION_STATE']==0) venta_anulada @endif">
                        <td style="width: 100px">{!! MisFunciones::fecha_peru($array_datos_coti_['FECHA']) !!}</td>
                        <td style="width:10px">{!!$datos[1]!!}</td>
                        <td style="width:200px">{!!$datos[2]!!}</td>
                        <td style="width:80px">{!!$datos[3]!!}</td>
                        <td style="width:50px">{!!$array_datos_coti_['HORA']!!}</td>
                        <td style="width:100px">{!!$array_datos_coti_['TOURS']!!}</td>
                        <td style="width:100px">{!!$array_datos_coti_['REPRESENT']!!}</td>
                        <td style="width:100px">{!!$array_datos_coti_['HOTELS']!!}</td>
                        <td style="width:100px">{!!$array_datos_coti_['MOVILID']!!}</td>
                        <td style="width:100px">{!!$array_datos_coti_['ENTRANCES']!!}</td>
                        <td style="width:100px">{!!$array_datos_coti_['FOOD']!!}</td>
                        <td style="width:100px">{!!$array_datos_coti_['TRAINS']!!}</td>
                        <td style="width:100px">{!!$array_datos_coti_['FLIGHTS']!!}</td>
                        <td style="width:100px">{!!$array_datos_coti_['OTHERS']!!}</td>
                        <td style="width:100px">{!!$array_datos_coti_['OBSERVACIONES']!!}</td>
                    </tr>
                @endforeach
                </tbody>
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
