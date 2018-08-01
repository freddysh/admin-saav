@extends('.layouts.admin')
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
            <li>Database</li>
            <li class="active">Destination</li>
        </ol>
    </div>
    <div class="row margin-top-20">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_new_destination">
            New <i class="fa fa-plus-circle" aria-hidden="true"></i>
        </button>

        <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" id="modal_new_destination" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
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
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txt_codigo">Codigo</label>
                                        <input type="text" class="form-control" id="txt_codigo" name="txt_codigo" placeholder="Codigo">
                                    </div>
                                </div>
                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label for="txt_destino">Destino</label>
                                        <input type="text" class="form-control" id="txt_destino" name="txt_destino" placeholder="Destino">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txt_descripcion">Descripcion</label>
                                        <input type="text" class="form-control" id="txt_descripcion" name="txt_descripcion" placeholder="Descripcion">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txt_pais">Pais</label>
                                        <input type="text" class="form-control" id="txt_pais" name="txt_pais" placeholder="Pais" VALUE="PERÚ">
                                    </div>
                                </div>
                                <div class="col-md-3 hide">
                                    <div class="form-group">
                                        <label for="txt_region">Region</label>
                                        <select class="custom-select form-control" id="txt_region" name="txt_region" >
                                            <option selected>Abrir menu</option>
                                            <option value="COSTA">COSTA</option>
                                            <option value="SIERRA">SIERRA</option>
                                            <option value="SELVA">SELVA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txt_departamento">Departamento</label>
                                        <select class="custom-select form-control" id="txt_departamento" name="txt_departamento" >
                                            <option selected>Abrir menu</option>
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
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txt_imagen">Imagen</label>
                                        <input type="file" class="form-control" id="txt_imagen" name="txt_imagen" placeholder="Imagen">
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
    <div class="row margin-top-20">
        <table id="example" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Codigo</th>
                <th>Destino</th>
                <th>Descripcion</th>
                <th>Pais</th>
                <th>Region</th>
                <th>Departamento</th>
                <th>Imagen</th>
                <th>Operaciones</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Codigo</th>
                <th>Destino</th>
                <th>Descripcion</th>
                <th>Pais</th>
                <th>Region</th>
                <th>Departamento</th>
                <th>Imagen</th>
                <th>Operaciones</th>
            </tr>
            </tfoot>
            <tbody>
            @foreach($destinos as $destino)
                <tr id="lista_destinos_{{$destino->id}}">
                    <td>{{$destino->codigo}}</td>
                    <td>{{$destino->destino}}</td>
                    <td>{{$destino->descripcion}}</td>
                    <td>{{$destino->pais}}</td>
                    <td>{{$destino->region}}</td>
                    <td>{{$destino->departamento}}</td>
                    <td>
                        @if (Storage::disk('destination')->has($destino->imagen))
                            <picture>
                                <img
                                        src="{{route('destination_image_path', ['filename' => $destino->imagen])}}" width="100px" height="100px"
                                        alt="">
                            </picture>
                        @endif
                    </td>
                    <td>
                        <button type="button" class="btn btn-warning"  data-toggle="modal" data-target="#modal_edit_destination_{{$destino->id}}">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btn btn-danger" onclick="eliminar_destino('{{$destino->id}}','{{$destino->destino}}')">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @foreach($destinos as $destino)
        <!-- Modal -->
            <div class="modal fade bd-example-modal-lg" id="modal_edit_destination_{{$destino->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
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
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="txt_codigo">Codigo</label>
                                            <input type="text" class="form-control" id="txt_codigo" name="txt_codigo" placeholder="Codigo" value="{{$destino->codigo}}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="txt_destino">Destino</label>
                                            <input type="text" class="form-control" id="txt_destino" name="txt_destino" placeholder="Destino" value="{{$destino->destino}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="txt_descripcion">Descripcion</label>
                                            <input type="text" class="form-control" id="txt_descripcion" name="txt_descripcion" placeholder="Descripcion" value="{{$destino->descripcion}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="txt_pais">Pais</label>
                                            <input type="text" class="form-control" id="txt_pais" name="txt_pais" placeholder="Pais"  value="{{$destino->pais}}">
                                        </div>
                                    </div>
                                    <div class="col-md-3 hide">
                                        <div class="form-group">
                                            <label for="txt_region">Region</label>
                                            <select class="custom-select form-control" id="txt_region" name="txt_region" >
                                                <option selected>Abrir menu</option>
                                                <option value="COSTA" @if($destino->region='COSTA') selected @endif>COSTA</option>
                                                <option value="SIERRA" @if($destino->region='SIERRA') selected @endif>SIERRA</option>
                                                <option value="SELVA" @if($destino->region='SELVA') selected @endif> SELVA</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="txt_departamento">Departamento</label>
                                            <select class="custom-select form-control" id="txt_departamento" name="txt_departamento" >
                                                <option disabled>Abrir menu</option>
                                                <option value="AMAZONAS" @if($destino->region='AMAZONAS') selected @endif>AMAZONAS</option>
                                                <option value="ANCASH" @if($destino->region='ANCASH') selected @endif>ANCASH</option>
                                                <option value="APURIMAC" @if($destino->region='APURIMAC') selected @endif>APURIMAC</option>
                                                <option value="AREQUIPA" @if($destino->region='AREQUIPA') selected @endif>AREQUIPA</option>
                                                <option value="AYACUCHO" @if($destino->region='AYACUCHO') selected @endif>AYACUCHO</option>
                                                <option value="CAJAMARCA" @if($destino->region='CAJAMARCA') selected @endif>CAJAMARCA</option>
                                                <option value="CALLAO" @if($destino->region='CALLAO') selected @endif>CALLAO</option>
                                                <option value="CUSCO" @if($destino->region='CUSCO') selected @endif>CUSCO</option>
                                                <option value="HUANCAVELICA" @if($destino->region='HUANCAVELICA') selected @endif>HUANCAVELICA</option>
                                                <option value="HUANUCO" @if($destino->region='HUANUCO') selected @endif>HUANUCO</option>
                                                <option value="ICA" @if($destino->region='ICA') selected @endif>ICA</option>
                                                <option value="JUNIN" @if($destino->region='JUNIN') selected @endif>JUNIN</option>
                                                <option value="LA LIBERTAD" @if($destino->region='LA LIBERTAD') selected @endif>LA LIBERTAD</option>
                                                <option value="LAMBAYEQUE" @if($destino->region='LAMBAYEQUE') selected @endif>LAMBAYEQUE</option>
                                                <option value="LIMA" @if($destino->region='LIMA') selected @endif>LIMA</option>
                                                <option value="LORETO" @if($destino->region='LORETO') selected @endif>LORETO</option>
                                                <option value="MADRE DE DIOS" @if($destino->region='MADRE DE DIOS') selected @endif>MADRE DE DIOS</option>
                                                <option value="MOQUEGUA" @if($destino->region='MOQUEGUA') selected @endif>MOQUEGUA</option>
                                                <option value="PASCO" @if($destino->region='PASCO') selected @endif>PASCO</option>
                                                <option value="PIURA" @if($destino->region='PIURA') selected @endif>PIURA</option>
                                                <option value="PUNO" @if($destino->region='PUNO') selected @endif>PUNO</option>
                                                <option value="SAN MARTIN" @if($destino->region='SAN MARTIN') selected @endif>SAN MARTIN</option>
                                                <option value="TACNA" @if($destino->region='TACNA') selected @endif>TACNA</option>
                                                <option value="TUMBES" @if($destino->region='TUMBES') selected @endif>TUMBES</option>
                                                <option value="UCAYALI" @if($destino->region='UCAYALI') selected @endif>UCAYALI</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="txt_imagen">Imagen</label>
                                            @if (Storage::disk('destination')->has($destino->imagen))
                                                <picture>
                                                    <img
                                                            src="{{route('destination_image_path', ['filename' => $destino->imagen])}}" width="60px" height="60px"
                                                            alt="">
                                                </picture>
                                                {{--<img src="{{ route('destination_image_path', ['filename' => $destino->imagen])}}" alt="" width="100px" height="100px">--}}
                                                {{--                                                    <input type="file" id="file" name="file" class="dropify" data-default-file="{{ route('admin_itinerary_image_path', ['filename' => $destino->imagen])}}"/>--}}
                                                <input type="file" class="form-control" id="txt_imagen" name="txt_imagen" placeholder="Imagen">
                                            @else
                                                <input type="file" class="form-control" id="txt_imagen" name="txt_imagen" placeholder="Imagen">
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