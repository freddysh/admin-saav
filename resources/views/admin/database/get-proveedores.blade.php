<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-11">
                <h2 class="">LISTADO DE PROVEEDORES</h2>
            </div>
            <div class="col-1 text-right d-none">
                <div class="btn btn-group">
                    <button class="btn btn-danger">
                        <i class="fas fa-file-pdf"></i>
                    </button>
                    <button class="btn btn-success">
                        <i class="fas fa-file-excel"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <table id="example_tabla_{{ $grupo }}" class="table table-striped table-bordered table-sm small">
                    <thead>
                    <tr>
                        @if($grupo=='HOTELS')
                            <th>Cat</th>
                        @endif
                        <th>Codigo</th>
                        <th>Tipo proveedor</th>
                        <th>Forma pago</th>
                        <th>Ruc</th>
                        <th>Razon social</th>
                        <th>Nombre comercial</th>
                        <th>Reservas</th>
                        <th>Contabilidad</th>
                        <th>Operaciones</th>
                        <th>Plazo</th>
                        <th>Opciones</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($proveedores->sortBy('nombre_comercial') as $provider)
                        <tr id="lista_provider_{{$provider->id}}">
                            @if($grupo=='HOTELS')
                                <td class="text-center">{{$provider->categoria}} <i class="fas fa-star small text-g-yellow"></i></td>
                            @endif
                            <td>{{$provider->codigo}}</td>
                            <td>{{$provider->tipo_proveedor}}</td>
                            <td>{{$provider->tipo_pago}}</td>
                            <td>{{$provider->ruc}}</td>
                            <td>{{$provider->razon_social}}</td>
                            <td>{{$provider->nombre_comercial}}</td>
                            <td>
                                <b>Cel:</b>{{$provider->r_telefono}}<br>

                                <b>Email:</b><br>{{$provider->r_email}}
                            </td>
                            <td>
                                <b>Cel:</b>{{$provider->c_telefono}}<br>
                                <b>Email:</b><br>{{$provider->c_email}}
                            </td>
                            <td>
                                <b>Cel:</b>{{$provider->o_telefono}}<br>
                                <b>Email:</b><br>{{$provider->o_email}}
                            </td>
                            <td>{{$provider->plazo}} dias {{$provider->desci}}</td>
                            <td class="text-center">
                                <div class="btn btn-group">
                                    <button class="btn btn-warning"  onclick="mostrar_modal('{{ $provider->id }}','{{ $grupo }}')"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger" onclick="eliminar_provider('{{$provider->id}}','{{$provider->razon_social}}')"><i class="fa fa-trash"></i></button>
                                </div>
                                <a href="#!" class="puntero text-warning d-none">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <div id="caja_modal_{{ $provider->id }}">
                                </div>
                                <a href="!#" class="puntero text-danger d-none" >
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

    </div>
</div>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
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

            var table = $('#example_tabla_{{ $grupo }}').DataTable( {
                "ordering": false,
                paging: true,
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],
            } );

            table.buttons().container()
                .appendTo( '#example_tabla_wrapper .col-md-6:eq(0)' );
        } );
    </script>
