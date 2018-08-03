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
            <li class="breadcrumb-item active">Destinations</li>
        </ol>
    </nav>
    <hr>
    <div class="row margin-top-20">
        <div class="col">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_new_destination">
            <i class="fa fa-plus" aria-hidden="true"></i> New
        </button>
        <!-- Modal -->
        <div class="modal fade bd-example-modal-md" id="modal_new_destination" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <form action="{{route('destination_save_path')}}" method="post" id="destination_save_id" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New destination</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="txt_codigo" class="font-weight-bold text-secondary">Codigo</label>
                                        <input type="text" class="form-control" id="txt_codigo" name="txt_codigo" placeholder="Codigo">
                                    </div>
                                </div>
                                <div class="col-6 d-none">
                                    <div class="form-group">
                                        <label for="txt_descripcion" class="font-weight-bold text-secondary">Descripcion</label>
                                        <input type="text" class="form-control" id="txt_descripcion" name="txt_descripcion" placeholder="Descripcion">
                                    </div>
                                </div>
                                <div class="col-3 d-none">
                                    <div class="form-group">
                                        <label for="txt_pais" class="font-weight-bold text-secondary">Pais</label>
                                        <input type="text" class="form-control" id="txt_pais" name="txt_pais" placeholder="Pais" VALUE="PERÚ">
                                    </div>
                                </div>
                                <div class="col-3  d-none">
                                    <div class="form-group">
                                        <label for="txt_region" class="font-weight-bold text-secondary">Region</label>

                                        <select class="custom-select form-control" id="txt_region" name="txt_region" >
                                            <option selected>Abrir menu</option>
                                            <option value="COSTA">COSTA</option>
                                            <option value="SIERRA">SIERRA</option>
                                            <option value="SELVA">SELVA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="txt_departamento" class="font-weight-bold text-secondary">Departamento</label>
                                        <select class="custom-select form-control" id="txt_departamento" name="txt_departamento" >
                                            <option selected>Escoja un departamento</option>
                                            <option value="AMAZONAS">AMAZONAS</option>
                                            <option value="ANCASH">ANCASH</option>
                                            <option value="APURIMAC">APURIMAC</option>
                                            <option value="AREQUIPA">AREQUIPA</option>
                                            <option value="AYACUCHO">AYACUCHO</option>
                                            <option value="CAJAMARCA">CAJAMARCA</option>
                                            <option value="CALLAO">CALLAO</option>
                                            <option value="CUSCO">CUSCO</option>
                                            <option value="HUANCAVELICA">HUANCAVELICA</option>
                                            <option value="HUANUCO">HUANUCO</option>
                                            <option value="ICA">ICA</option>
                                            <option value="JUNIN">JUNIN</option>
                                            <option value="LA LIBERTAD">LA LIBERTAD</option>
                                            <option value="LAMBAYEQUE">LAMBAYEQUE</option>
                                            <option value="LIMA">LIMA</option>
                                            <option value="LORETO">LORETO</option>
                                            <option value="MADRE DE DIOS">MADRE DE DIOS</option>
                                            <option value="MOQUEGUA">MOQUEGUA</option>
                                            <option value="PASCO">PASCO</option>
                                            <option value="PIURA">PIURA</option>
                                            <option value="PUNO">PUNO</option>
                                            <option value="SAN MARTIN">SAN MARTIN</option>
                                            <option value="TACNA">TACNA</option>
                                            <option value="TUMBES">TUMBES</option>
                                            <option value="UCAYALI">UCAYALI</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="txt_destino" class="font-weight-bold text-secondary">Destino</label>
                                        <input type="text" class="form-control" id="txt_destino" name="txt_destino" placeholder="Destino">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="txt_imagen" class="font-weight-bold text-secondary">Imagen</label>
                                        <input type="file" class="form-control-file" id="txt_imagen" name="txt_imagen" placeholder="Imagen">

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
    <div class="row margin-top-20">
        <table id="example" class="table table-bordered table-sm">

            <thead>
            <tr>
                <th>Codigo</th>
                <th>Departamento</th>
                <th>Destino</th>
                <th>Imagen</th>
                <th>Operaciones</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Codigo</th>
                <th>Departamento</th>
                <th>Destino</th>
                <th>Imagen</th>
                <th>Operaciones</th>
            </tr>
            </tfoot>
            <tbody>
            @foreach($destinos as $destino)
                <tr id="lista_destinos_{{$destino->id}}">
                    <td>{{$destino->codigo}}</td>
                    <td>{{$destino->departamento}}</td>
                    <td>{{ucwords(strtolower($destino->destino))}}</td>
                    <td>
                        @if (Storage::disk('destination')->has($destino->imagen))
                            <picture>
                                <img
                                        src="{{route('destination_image_path', ['filename' => $destino->imagen])}}" width="100px" height="100px"
                                        alt="">
                            </picture>
                        @endif
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#modal_edit_destination_{{$destino->id}}">
                             <i class="fa fa-pencil-alt" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="eliminar_destino('{{$destino->id}}','{{$destino->destino}}')">
                            <i class="fas fa-trash" aria-hidden="true"></i>

                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @foreach($destinos as $destino)
            <!-- Modal -->
                <div class="modal fade bd-example-modal-md" id="modal_edit_destination_{{$destino->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <form action="{{route('destination_edit_path')}}" method="post" id="destination_edit_id" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit destination</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="txt_codigo" class="text-secondary font-weight-bold">Codigo</label>
                                                <input type="text" class="form-control" id="txt_codigo" name="txt_codigo" placeholder="Codigo" value="{{$destino->codigo}}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="txt_destino" class="text-secondary font-weight-bold">Destino</label>
                                                <input type="text" class="form-control" id="txt_destino" name="txt_destino" placeholder="Destino" value="{{$destino->destino}}">
                                            </div>
                                        </div>
                                        <div class="col-6 d-none">
                                            <div class="form-group">
                                                <label for="txt_descripcion" class="text-secondary font-weight-bold">Descripcion</label>

                                                <input type="text" class="form-control" id="txt_descripcion" name="txt_descripcion" placeholder="Descripcion" value="{{$destino->descripcion}}">
                                            </div>
                                        </div>
                                        <div class="col-3 d-none">
                                            <div class="form-group">
                                                <label for="txt_pais" class="text-secondary font-weight-bold">Pais</label>
                                                <input type="text" class="form-control" id="txt_pais" name="txt_pais" placeholder="Pais"  value="{{$destino->pais}}">
                                            </div>
                                        </div>
                                        <div class="col-3 d-none">
                                            <div class="form-group">
                                                <label for="txt_region" class="text-secondary font-weight-bold">Region</label>

                                                <select class="custom-select form-control" id="txt_region" name="txt_region" >
                                                    <option selected>Abrir menu</option>
                                                    <option value="COSTA" @if($destino->region='COSTA') selected @endif>COSTA</option>
                                                    <option value="SIERRA" @if($destino->region='SIERRA') selected @endif>SIERRA</option>
                                                    <option value="SELVA" @if($destino->region='SELVA') selected @endif> SELVA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="txt_departamento" class="text-secondary font-weight-bold">Departamento</label>
                                                <select class="custom-select form-control" id="txt_departamento" name="txt_departamento" >
                                                    <option disabled>Escoja un departamento</option>
                                                    <option value="AMAZONAS" @if($destino->departamento=='AMAZONAS') selected @endif>AMAZONAS</option>
                                                    <option value="ANCASH" @if($destino->departamento=='ANCASH') selected @endif>ANCASH</option>
                                                    <option value="APURIMAC" @if($destino->departamento=='APURIMAC') selected @endif>APURIMAC</option>
                                                    <option value="AREQUIPA" @if($destino->departamento=='AREQUIPA') selected @endif>AREQUIPA</option>
                                                    <option value="AYACUCHO" @if($destino->departamento=='AYACUCHO') selected @endif>AYACUCHO</option>
                                                    <option value="CAJAMARCA" @if($destino->departamento=='CAJAMARCA') selected @endif>CAJAMARCA</option>
                                                    <option value="CALLAO" @if($destino->departamento=='CALLAO') selected @endif>CALLAO</option>
                                                    <option value="CUSCO" @if($destino->departamento=='CUSCO') selected @endif>CUSCO</option>
                                                    <option value="HUANCAVELICA" @if($destino->departamento=='HUANCAVELICA') selected @endif>HUANCAVELICA</option>
                                                    <option value="HUANUCO" @if($destino->departamento=='HUANUCO') selected @endif>HUANUCO</option>
                                                    <option value="ICA" @if($destino->departamento=='ICA') selected @endif>ICA</option>
                                                    <option value="JUNIN" @if($destino->departamento=='JUNIN') selected @endif>JUNIN</option>
                                                    <option value="LA LIBERTAD" @if($destino->departamento=='LA LIBERTAD') selected @endif>LA LIBERTAD</option>
                                                    <option value="LAMBAYEQUE" @if($destino->departamento=='LAMBAYEQUE') selected @endif>LAMBAYEQUE</option>
                                                    <option value="LIMA" @if($destino->departamento=='LIMA') selected @endif>LIMA</option>
                                                    <option value="LORETO" @if($destino->departamento=='LORETO') selected @endif>LORETO</option>
                                                    <option value="MADRE DE DIOS" @if($destino->departamento=='MADRE DE DIOS') selected @endif>MADRE DE DIOS</option>
                                                    <option value="MOQUEGUA" @if($destino->departamento=='MOQUEGUA') selected @endif>MOQUEGUA</option>
                                                    <option value="PASCO" @if($destino->departamento=='PASCO') selected @endif>PASCO</option>
                                                    <option value="PIURA" @if($destino->departamento=='PIURA') selected @endif>PIURA</option>
                                                    <option value="PUNO" @if($destino->departamento=='PUNO') selected @endif>PUNO</option>
                                                    <option value="SAN MARTIN" @if($destino->departamento=='SAN MARTIN') selected @endif>SAN MARTIN</option>
                                                    <option value="TACNA" @if($destino->departamento=='TACNA') selected @endif>TACNA</option>
                                                    <option value="TUMBES" @if($destino->departamento=='TUMBES') selected @endif>TUMBES</option>
                                                    <option value="UCAYALI" @if($destino->departamento=='UCAYALI') selected @endif>UCAYALI</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="txt_imagen" class="text-secondary font-weight-bold">Imagen</label>

                                                @if (Storage::disk('destination')->has($destino->imagen))
                                                    <picture>
                                                        <img
                                                                src="{{route('destination_image_path', ['filename' => $destino->imagen])}}" width="60px" height="60px"
                                                                alt="">
                                                    </picture>
                                                    {{--<img src="{{ route('destination_image_path', ['filename' => $destino->imagen])}}" alt="" width="100px" height="100px">--}}
{{--                                                    <input type="file" id="file" name="file" class="dropify" data-default-file="{{ route('admin_itinerary_image_path', ['filename' => $destino->imagen])}}"/>--}}

                                                    <input type="file" class="form-control-file" id="txt_imagen" name="txt_imagen" placeholder="Imagen">
                                                @else
                                                    <input type="file" class="form-control-file" id="txt_imagen" name="txt_imagen" placeholder="Imagen">

                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    {{csrf_field()}}
                                    <input type="hidden" id="id" name="id"   value="{{$destino->id}}">
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