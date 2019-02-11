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
                    <form action="{{route('profit_save_path')}}" method="post" id="destination_save_id" enctype="multipart/form-data">
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
                                                <th colspan="14" class="text-center">
                                                    <div class="row">
                                                        <div class="col-1 mt-2">
                                                            <b class="text-primary">AÑO:</b>
                                                        </div>
                                                        <div class="col-2">
                                                            <input class="form-control" type="text" name="anio" value="{{$anio}}">
                                                        </div>
                                                    </div>
                                                </th>
                                            </tr>
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
                                                    <div class="form-control1"><input style="width:60px" type="number" min="0" name="goal_{{$item->id}}[]"></div>
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
            @foreach ($anios as $anio_)
                @foreach ($webs as $item)
                
                    <tr id="lista_profit_{{$anio_}}_{{$item->id}}">
                        <td>{{$ii}}</td>
                        <td>{{$anio_}}</td>
                        <td>{{$item->pagina}}</td>
                        @for ($i = 1; $i <=12; $i++)
                            @php
                                $goal=$profit->where('pagina',$item->pagina)->where('anio',$anio_)->where('mes',$i)->first();
                            @endphp
                            @if (strlen($goal)!='')
                                <td><sup>$</sup>{{$goal->goal}}</td>    
                            @else
                                <td></td>        
                            @endif
                        @endfor
                        <td class="text-center">
                            <button type="button" class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#modal_edit_categoria_{{$anio_}}_{{$item->id}}">
                                <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                            </button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="eliminar_profit('lista_profit_{{$anio_}}_{{$item->id}}','{{$item->pagina}}')">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade bd-example-modal-lg" id="modal_edit_categoria_{{$anio_}}_{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <form action="{{route('profit_edit_path')}}" method="post" id="destination_edit_id" enctype="multipart/form-data">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Profit</h5>
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
                                                                    <th colspan="14" class="text-center">
                                                                        <div class="row">
                                                                            <div class="col-1 mt-2">
                                                                                <b class="text-primary">AÑO:</b>
                                                                            </div>
                                                                            <div class="col-2">
                                                                                <input class="form-control" type="text" name="anio" value="{{$anio_}}" disabled>
                                                                            </div>
                                                                        </div>
                                                                    </th>
                                                                </tr>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Pagina</th>
                                                                    @for ($i = 1; $i <=12; $i++)
                                                                        <th>{{$messes[$i]}}</th>       
                                                                    @endfor
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            @php $iii=1;@endphp                       
                                                                <tr id="lista_categoria_">
                                                                    <td>{{$iii}}</td>
                                                                    <td>{{$item->pagina}}</td>
                                                                    @for ($i = 1; $i <=12; $i++)    
                                                                        @php
                                                                            $goal=$profit->where('pagina',$item->pagina)->where('anio',$anio_)->where('mes',$i)->first();
                                                                            $goal_1=0
                                                                        @endphp
                                                                        @if ($goal)
                                                                            @php
                                                                                $goal_1=$goal->goal; 
                                                                            @endphp
                                                                        @else
                                                                            @php
                                                                                $goal_1=0;    
                                                                            @endphp
                                                                        @endif
                                                                        <td>
                                                                            <div class="form-control1">
                                                                            <input style="width:60px" type="number" min="0" name="goal_[]" value="{{$goal_1}}">
                                                                            </div>
                                                                        </td>        
                                                                    @endfor                                                        
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                {{csrf_field()}}
                                                <input type="hidden" id="id" name="id"  value="{{$item->id}}">
                                                <input type="hidden" id="pagina" name="pagina"  value="{{$item->pagina}}">
                                                <input type="hidden" id="anio" name="anio"  value="{{$anio_}}">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @php $ii++; @endphp    
                @endforeach
                
            @endforeach


           
            </tbody>
        </table>
    </div>
    <script>
        // $(document).ready(function() {
        //     $('#example').DataTable();
        // });
    </script>
@stop