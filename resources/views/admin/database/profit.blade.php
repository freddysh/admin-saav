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
            <li class="breadcrumb-item active">Profit</li>
        </ol>
    </nav>
    <hr>
    <div class="row mt-3">
        @php
            $messes[1]='JAN';
            $messes[2]='FEB';
            $messes[3]='MARCH';
            $messes[4]='APRIL';
            $messes[5]='MAY';
            $messes[6]='JUNE';
            $messes[7]='JULY';
            $messes[8]='AUG';
            $messes[9]='SEPT';
            $messes[10]='OCT';
            $messes[11]='NOV';
            $messes[12]='DEC';
        @endphp
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
                            <h5 class="modal-title" id="exampleModalLabel">New profit</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <table id="example" class="table table-sm table-responsive text-12">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Pagina</th>
                                                @for ($i = 1; $i <=12; $i++)
                                                    <th>{{$messes[$i]}}</th>       
                                                @endfor
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @php $ii=1;@endphp                                    
                                        @foreach ($webs as $item)
                                            <tr id="lista_categoria_">
                                                <td>{{$ii}}</td>
                                                <td>{{$item->pagina}}</td>
                                                @for ($i = 1; $i <=12; $i++)    
                                                    <td>
                                                    <div class="form-control1"><input style="width:50px" type="text" name="goal_{{$item->pagina}}[]"></div>
                                                    </td>        
                                                @endfor                                                        
                                            </tr>
                                            @php $ii++; @endphp
                                        @endforeach
                                        </tbody>
                                    </table>
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
        <table id="example" class="table table-sm table-responsive table-condensed">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Año</th>
                    <th>Pagina</th>
                    @for ($i = 1; $i <=12; $i++)
                        <th>{{$messes[$i]}}</th>       
                    @endfor
                    <th>Operaciones</th>
                </tr>
            </thead>
            <tbody>
            @php $ii=1;@endphp

            @foreach ($webs as $item)
                <tr id="lista_categoria_">
                    <td>{{$ii}}</td>
                    <td>{{$anio}}</td>
                    <td>{{$item->pagina}}</td>
                    @for ($i = 1; $i <=12; $i++)
                        @php
                            $goal=$profit->where('pagina',$item->pagina)->where('mes',$i)->first();
                        @endphp
                        @if (strlen($goal)!='')
                            <td><sup>$</sup>{{$goal->goal}}</td>    
                        @else
                            <td></td>        
                        @endif
                    @endfor
                    <td class="text-center">
                        <button type="button" class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#modal_edit_categoria_{{$anio}}_{{$item->pagina}}">
                            <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="eliminar_categoria1('{{$anio}}','{{$item->pagina}}')">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>
                @php $ii++; @endphp
            @endforeach


           
            </tbody>
        </table>
        {{-- @foreach($categorias as $categoria)
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
        @endforeach --}}
    </div>
    <script>
        // $(document).ready(function() {
        //     $('#example').DataTable();
        // });
    </script>
@stop