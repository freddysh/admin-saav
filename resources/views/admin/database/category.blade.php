@extends('layouts.admin.admin')
@section('archivos-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">
@stop
@section('archivos-js')
    <script src="{{asset("https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js")}}"></script>
@stop
@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white m-0">
            <li class="breadcrumb-item" aria-current="page"><a href="/">Home</a></li>
            <li class="breadcrumb-item">Database</li>
            <li class="breadcrumb-item active">Category</li>
        </ol>
    </nav>
    <hr>
    <div class="row mt-3">
        <div class="col">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_new_destination">
            <i class="fa fa-plus" aria-hidden="true"></i> New

        </button>

        <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" id="modal_new_destination" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form action="{{route('category_save_path')}}" method="post" id="destination_save_id" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tipo">Tipo</label>
                                        <select class="form-control" name="tipo" id="tipo">
                                            <option value="FACTURA">FACTURA</option>
                                            <option value="BOLETA" >BOLETA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">

                                        <label for="txt_nombre" class="font-weight-bold text-secondary">Nombre</label>

                                        <input type="text" class="form-control" id="txt_nombre" name="txt_nombre" placeholder="Nombre de la categoria" required>
                                    </div>
                                </div>
                                <div class="col-md-2 d-none">
                                    <div class="form-group">

                                        <label  for="txt_imagen" class="font-weight-bold text-secondary">Periodo de pago</label>

                                        <input class="form-control" type="number" name="periodo" min="1" >
                                    </div>
                                </div>
                                <div class="col-md-3 d-none">
                                    <div class="form-group">
                                        <label for="tipo_periodo" class="font-weight-bold text-secondary mt-3"></label>
                                        <select class="custom-select form-control" id="tipo_periodo" name="tipo_periodo"  >
                                            <option value="Antes">Antes</option>
                                            <option value="Despues">Despues</option>
                                        </select>
                                    </div>
                                </div>
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

        </div>
    </div>
    <hr>
    <div class="row mt-3">
        <table id="example" class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>tipo</th>
                    <th>Nombre</th>
                    <th>Periodo pago</th>
                    <th>Operaciones</th>
                </tr>

            </thead>
            <tfoot>
            <tr>
                <th>#</th>
                <th>tipo</th>
                <th>Nombre</th>
                <th>Periodo pago</th>
                <th>Operaciones</th>
            </tr>
            </tfoot>
            <tbody>
            <?php $i=1;?>
            @foreach($categorias as $categoria)
                <tr id="lista_categoria_{{$categoria->id}}">
                    <td>{{$i++}}</td>
                    <td>{{ucwords(strtolower($categoria->tipo))}}</td>
                    <td>{{ucwords(strtolower($categoria->nombre))}}</td>
                    <td>{{$categoria->periodo}} {{$categoria->tipo_periodo}}</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#modal_edit_categoria_{{$categoria->id}}">
                            <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="eliminar_categoria1('{{$categoria->id}}','{{$categoria->nombre}}')">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @foreach($categorias as $categoria)
        <!-- Modal -->
            <div class="modal fade bd-example-modal-lg" id="modal_edit_categoria_{{$categoria->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <form action="{{route('category_edit_path')}}" method="post" id="destination_edit_id" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit categoria</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                        <label for="txt_tipo_{{$categoria->id}}">Tipo</label>
                                            <select class="form-control" name="txt_tipo" id="txt_tipo_{{$categoria->id}}">
                                                <option value="FACTURA" @if($categoria->tipo=='FACTURA') selected @endif>FACTURA</option>
                                                <option value="BOLETA" @if($categoria->tipo=='BOLETA') selected @endif>BOLETA</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="txt_nombre">Nombre</label>
                                            <input type="text" class="form-control" id="txt_nombre" name="txt_nombre" placeholder="Codigo" value="{{$categoria->nombre}}">
                                        </div>
                                    </div>
                                    <div class="col-md-2 d-none">
                                        <div class="form-group">
                                            <label  for="txt_imagen">Periodo de pago</label>
                                            <input class="form-control" type="number" name="periodo" min="1"  value="{{$categoria->periodo}}" >
                                        </div>
                                    </div>
                                    <div class="col-md-3 d-none">
                                        <div class="form-group margin-top-25">
                                            <select class="custom-select form-control" id="tipo_periodo" name="tipo_periodo" >
                                                <option @if($categoria->tipo_periodo=='Antes') {{selected}}@endif value="Antes">Antes</option>
                                                <option @if($categoria->tipo_periodo=='Despues') {{selected}}@endif value="Despues">Despues</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                {{csrf_field()}}
                                <input type="hidden" id="id" name="id"   value="{{$categoria->id}}">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
@stop