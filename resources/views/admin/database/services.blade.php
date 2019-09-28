@php
    function concatenar($texto,$nro){
        $top=4-strlen($nro);
        $valor='';
        for($i=0;$i<$top;$i++){
            $valor.='0';
        }
        return $texto.$valor.$nro;
    }
    $destinos_usados=array();
@endphp
@foreach($hotel as $hotel_)
    @if(!in_array($hotel_->localizacion,$destinos_usados))
        @php
            $destinos_usados[]=$hotel_->localizacion;
        @endphp
    @endif
@endforeach
@extends('layouts.admin.admin')
@section('archivos-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">
@stop
@section('archivos-js')
    <script src="{{asset("https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js")}}"></script>
@stop
@section('content')
    @php

    $todo_destinos='';
    @endphp
    @foreach($destinations as $destination)
        @php
            $todo_destinos.=$destination->id.'_';
        @endphp
    @endforeach
    @php
        $todo_destinos=substr($todo_destinos,0,strlen($todo_destinos)-1);
    @endphp
    <input type="hidden" name="todos_destinos" id="todos_destinos" value="{{$todo_destinos}}">


    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white m-0">
            <li class="breadcrumb-item" aria-current="page"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Products</li>
        </ol>
    </nav>
    <hr>

    <div class="row">
        <div class="col">
            <a href="{{route('nuevo_producto_path')}}" class="btn btn-primary btn-sm">
                <i class="fa fa-plus" aria-hidden="true"></i> New
            </a>
            @csrf
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <ul class="nav nav-tabs nav-justified">
                <?php
                $pos=0;
                ?>
                @foreach($categorias as $categoria)
                    <?php
                    $activo='';
                    ?>
                    @if($pos==0)
                        <?php
                        $activo='active';
                        ?>
                    @endif
                    <li class="nav-item active">
                        <a data-toggle="tab" href="#t_{{$categoria->nombre}}" class="nav-link show {{$activo}} rounded-0" role="tab" aria-controls="pills-home" aria-selected="true" onclick="escojerPos('{{$pos}}','{{$categoria->nombre}}')">{{$categoria->nombre}}</a>
                    </li>
                    <?php
                    $pos++;
                    ?>
                @endforeach
            </ul>
            <div class="tab-content margin-top-20">

            <?php
            $pos=0;
            ?>
            @foreach($categorias as $categoria)
                <?php
                $activo='';
                ?>
                @if($pos==0)
                    <?php
                    $activo='in active';
                    ?>
                @endif
                <div id="t_{{$categoria->nombre}}" class="tab-pane fade show {{$activo}}">

                    @if($categoria->nombre!='HOTELS')
                        @if($categoria->nombre=='TRAINS')
                            <div class="row">
                                <div class="col-2 d-none">
                                    <div class="estilo_form clearfix text-10">
                                        <label class="">
                                            <input type="radio" name="ida" id="id" value="ida" onclick="mostrar_info('ida_{{$categoria->nombre}}')" checked="checked">
                                            Ida
                                        </label>
                                    </div>
                                    <div class="estilo_form clearfix text-10">
                                        <label class="">
                                            <input type="radio" name="ida" id="id" value="ida" onclick="mostrar_info('ida_{{$categoria->nombre}}')">
                                            Ida y vuelta
                                        </label>
                                    </div>
                                </div>
                                <div class="col-8 d-none">
                                    <div class="col-lg-6" id="ida_{{$categoria->nombre}}">
                                        <div class="form-group">
                                            <label for="">Escoja el destino de ida</label>
                                            <select name="Destinos_ida_{{$categoria->nombre}}" id="Destinos_ida_{{$categoria->nombre}}" class="form-control" onchange="mostrar_tabla_destino_ida('{{$categoria->nombre}}','{{$categoria->id}}')">
                                                <option value="0">Escoja el destino</option>
                                                <option value="POROY">POROY</option>
                                                <option value="AGUAS CALIENTES">AGUAS CALIENTES</option>
                                                <option value="OLLANTAYTAMBO">OLLANTAYTAMBO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 d-none" id="vuelta_{{$categoria->nombre}}">
                                        <div class="form-group">
                                            <label for="">Escoja el destino de vuelta</label>
                                            <select name="Destinos_vuelta_{{$categoria->nombre}}" id="Destinos_vuelta_{{$categoria->nombre}}" class="form-control" onchange="mostrar_tabla_destino_ida('{{$categoria->nombre}}','{{$categoria->id}}')">
                                                <option value="0">Escoja el destino</option>
                                                <option value="POROY">POROY</option>
                                                <option value="AGUAS CALIENTES">AGUAS CALIENTES</option>
                                                <option value="OLLANTAYTAMBO">OLLANTAYTAMBO</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col d-none">
                                    <div class="padding-left-0">
                                        {{--<select name="empresa_{{$categoria->id}}" id="empresa_{{$categoria->id}}" class="form-control" onchange="mostrar_tabla_empresa('{{$categoria->nombre}}','{{$categoria->id}}',$('#empresa_{{$categoria->id}}').val())">--}}
                                        <select name="empresa_{{$categoria->id}}" id="empresa_{{$categoria->id}}" class="form-control" onchange="mostrar_tabla_destino('{{$categoria->nombre}}','{{$categoria->id}}')">
                                            <option value="0">Escoja una empresa</option>
                                            @foreach($proveedores->where('grupo','TRAINS') as $pro)
                                                <option value="{{$pro->id}}">{{$pro->nombre_comercial}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="padding-left-0">
                                        {{--<select name="Destinos_{{$categoria->nombre}}" id="Destinos_{{$categoria->nombre}}" class="form-control" onchange="mostrar_tabla_empresa('{{$categoria->nombre}}','{{$categoria->id}}',$(this).val())">--}}
                                        <select name="Destinos_{{$categoria->nombre}}" id="Destinos_{{$categoria->nombre}}" class="form-control" onchange="mostrar_tabla_destino('{{$categoria->nombre}}','{{$categoria->id}}')">
                                            <option value="0">Escoja el origen</option>
                                            @foreach($destinations as $destination)
                                                <option value="{{$destination->id}}_{{$categoria->nombre}}_{{$destination->destino}}">{{$destination->destino}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                            </div>
                        <div class="row">
                            <div class="col">
                                <div id="tb_datos_{{$categoria->nombre}}">
                                </div>
                            </div>
                        </div>

                        @elseif($categoria->nombre=='MOVILID')
                            <div class="row">
                                <div class="col">
                                    <div class="">
                                        <label>Origen</label>
                                        <select name="Destinos_{{$categoria->nombre}}" id="Destinos_{{$categoria->nombre}}" class="form-control" onchange="mostrar_tabla_destino_ruta('{{$categoria->nombre}}','{{$categoria->id}}','{{$pos}}','','','normal')">
                                            <option value="0">Escoja el origen</option>
                                            @foreach($destinations as $destination)
                                                <option value="{{$destination->id}}_{{$categoria->nombre}}_{{$destination->destino}}">{{$destination->destino}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col" id="mostra_rutas_movilid">
                                    <label>Ruta</label>
                                    <select class="form-control" id="txt_ruta_{{$pos}}" name="txt_ruta_{{$pos}}" onchange="mostrar_tabla_destino_ruta('{{$categoria->nombre}}','{{$categoria->id}}','{{$pos}}',$('#txt_ruta_{{$pos}}').val(),'','ruta')">
                                        <option value="ESCOJA UNA RUTA-ESCOJA UNA RUTA">ESCOJA UNA RUTA</option>
                                    </select>
                                </div>
                                <div class="col" id="mostra_tipo_{{$categoria->nombre}}">
                                    <label>Tipo</label>
                                    <select class="form-control" id="txt_tipo_{{$pos}}" name="txt_tipo_{{$pos}}" onchange="mostrar_tabla_destino_ruta('{{$categoria->nombre}}','{{$categoria->id}}','{{$pos}}',$('#txt_ruta_{{$pos}}').val(),$('#txt_tipo_{{$pos}}').val(),'tipo')">
                                        <option value="ESCOJA UN TIPO-ESCOJA UN TIPO">ESCOJA EL TIPO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div id="tb_datos_{{$categoria->nombre}}">

                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col">
                                    <div class="col-lg-4 padding-left-0">
                                        <select name="Destinos_{{$categoria->nombre}}" id="Destinos_{{$categoria->nombre}}" class="form-control" onchange="mostrar_tabla_destino('{{$categoria->nombre}}','{{$categoria->id}}')">
                                            <option value="0">Escoja el origen</option>
                                            @foreach($destinations as $destination)
                                                <option value="{{$destination->id}}_{{$categoria->nombre}}_{{$destination->destino}}">{{$destination->destino}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        <div class="row">
                            <div class="col">
                                <div id="tb_datos_{{$categoria->nombre}}">
                                </div>
                            </div>
                        </div>
                        @endif
                    @else
                        <div class="row">
                            <div class="col">
                                <table id="tb_{{$categoria->nombre}}" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Origen</th>
                                        <th>Estrellas</th>
                                        <th>Operaciones</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Origen</th>
                                        <th>Estrellas</th>
                                        <th>Operaciones</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($hotel->sortBy('localizacion') as $hotel_)
                                        <tr id="lista_services_h_{{$hotel_->id}}">
                                            <td class="text-green-goto">{{ucwords(strtolower($hotel_->localizacion))}}</td>
                                            <td class="text-green-goto">{{$hotel_->estrellas}} <b class="text-warning"><i class="fa fa-star" aria-hidden="true"></i></b></td>
                                            <td class="text-right">
                                                <button type="button" class="btn btn-sm btn-warning"  data-toggle="modal" data-target="#modal_edit_destination_h_{{$hotel_->id}}">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger" onclick="eliminar_servicio_h('{{$hotel_->id}}','{{$hotel_->nombre}}')">
                                                    <i class="fas fa-trash" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @foreach($hotel->sortBy('localizacion') as $hotel_)
                            <div class="modal fade bd-example-modal-sm" id="modal_edit_destination_h_{{$hotel_->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-md" role="document">
                                    <div class="modal-content">
                                        <form action="{{route('hotel_edit_path')}}" method="post" id="service_save_id" enctype="multipart/form-data">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Hotel</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <table class="table table-bordered table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-primary text-center py-2" colspan="2">ACOMODATION <span class="text-warning display-block">{{$hotel_->estrellas}} <i class="fa fa-star"></i></span></th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td>Simgle</td>
                                                                <td><input type="number" name="eS_2" class="form-control form-control-sm text-right" min="0" step="0.01" value="{{$hotel_->single}}"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Double</td>
                                                                <td><input type="number" name="eD_2" class="form-control form-control-sm text-right" min="0" step="0.01" value="{{$hotel_->doble}}"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Matrimonial</td>
                                                                <td><input type="number" name="eM_2" class="form-control form-control-sm text-right" min="0" step="0.01" value="{{$hotel_->matrimonial}}"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Triple</td>
                                                                <td><input type="number" name="eT_2" class="form-control form-control-sm text-right" min="0" step="0.01" value="{{$hotel_->triple}}"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Superior Simple</td>
                                                                <td><input type="number" name="eSS_2" class="form-control form-control-sm text-right" min="0" step="0.01" value="{{$hotel_->superior_s}}"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Superior Double</td>
                                                                <td><input type="number" name="eSD_2" class="form-control form-control-sm text-right" min="0" step="0.01" value="{{$hotel_->superior_d}}"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Suite</td>
                                                                <td><input type="number" name="eSU_2" class="form-control form-control-sm text-right" min="0" step="0.01" value="{{$hotel_->suite}}"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Jr. Suite</td>
                                                                <td><input type="number" name="eJS_2" class="form-control form-control-sm text-right" min="0" step="0.01" value="{{$hotel_->jr_suite}}"></td>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                {{ csrf_field()}}
                                                <input type="hidden" name="id" value="{{$hotel_->id}}">
                                                <input type="hidden" name="posTipo" id="posTipo" value="0">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        @endforeach

                    @endif
                </div>
                <?php
                $pos++;
                ?>
            @endforeach
        </div>

        </div>
        </div>

    </div>
    <script>
        $(document).ready(function() {
            @foreach($destinations as $destination)
                @foreach($categorias as $categoria)
                $('#tb_{{$destination->id}}_{{$categoria->nombre}}').DataTable();
                @endforeach
            @endforeach
            @foreach($categorias as $categoria)
                $('#tb_{{$categoria->nombre}}').DataTable();
            @endforeach
        } );

    </script>
@stop
