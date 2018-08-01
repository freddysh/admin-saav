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
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Database</li>
            <li class="active">Products</li>
        </ol>
    </div>
    <div class="row margin-top-20">
        <a href="{{route('nuevo_producto_path')}}" class="btn btn-primary">
            New <i class="fa fa-plus-circle" aria-hidden="true"></i>
        </a>
 </div>
    <div class="row margin-top-20">
        <ul class="nav nav-tabs">
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
                <li class="{{$activo}}"><a data-toggle="tab" href="#t_{{$categoria->nombre}}" onclick="escojerPos({{$pos}},'{{$categoria->nombre}}')">{{$categoria->nombre}}</a></li>
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
                <div id="t_{{$categoria->nombre}}" class="tab-pane fade {{$activo}}">

                    @if($categoria->nombre!='HOTELS')
                        @if($categoria->nombre=='TRAINS')
                            <div class="hide col-lg-2 no-padding">
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
                            <div class="hide col-lg-8">
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
                                <div class="col-lg-6 hide" id="vuelta_{{$categoria->nombre}}">
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
                            <div class="col-lg-3">
                                <div class="padding-left-0">
                                    <select name="empresa_{{$categoria->id}}" id="empresa_{{$categoria->id}}" class="form-control" onchange="mostrar_tabla_empresa('{{$categoria->nombre}}','{{$categoria->id}}',$('#empresa_{{$categoria->id}}').val())">
                                        <option value="0">Escoja una empresa</option>
                                        @foreach($proveedores->where('grupo','TRAINS') as $pro)
                                            <option value="{{$pro->id}}">{{$pro->nombre_comercial}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="padding-left-0">
                                    <select name="Destinos_{{$categoria->nombre}}" id="Destinos_{{$categoria->nombre}}" class="form-control" onchange="mostrar_tabla_destino('{{$categoria->nombre}}','{{$categoria->id}}')">
                                        <option value="0">Escoja la localizacion</option>
                                        @foreach($destinations as $destination)
                                            <option value="{{$destination->id}}_{{$categoria->nombre}}_{{$destination->destino}}">{{$destination->destino}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div id="tb_datos_{{$categoria->nombre}}">
                            </div>
                        @elseif($categoria->nombre=='MOVILID')
                            <div class="col-lg-3">
                                <div class="padding-left-0">
                                    <label>Localizacion</label>
                                    <select name="Destinos_{{$categoria->nombre}}" id="Destinos_{{$categoria->nombre}}" class="form-control" onchange="mostrar_tabla_destino_ruta('{{$categoria->nombre}}','{{$categoria->id}}','{{$pos}}')">
                                        <option value="0">Escoja la localizacion</option>
                                        @foreach($destinations as $destination)
                                            <option value="{{$destination->id}}_{{$categoria->nombre}}_{{$destination->destino}}">{{$destination->destino}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3" id="mostra_rutas_movilid">
                                <label>Ruta</label>
                                <select class="form-control" id="txt_ruta_{{$pos}}" name="txt_ruta_{{$pos}}" onchange="mostrar_tabla_destino_ruta_datos('{{$categoria->nombre}}','{{$categoria->id}}',$('#txt_ruta_{{$pos}}').val())">
                                    <option value="ESCOJA UNA RUTA-ESCOJA UNA RUTA">ESCOJA UNA RUTA</option>
                                </select>
                            </div>
                            <div class="col-lg-3" id="mostra_tipo_{{$categoria->nombre}}">
                                <label>Tipo</label>
                                <select class="form-control" id="txt_tipo_{{$pos}}" name="txt_tipo_{{$pos}}" onchange="mostrar_tabla_destino_ruta_tipo_datos('{{$categoria->nombre}}','{{$categoria->id}}',$('#txt_ruta_{{$pos}}').val())">
                                    <option value="ESCOJA UN TIPO-ESCOJA UN TIPO">ESCOJA EL TIPO</option>
                                </select>
                            </div>
                            <div id="tb_datos_{{$categoria->nombre}}">
                            </div>
                        @else
                            <div class="col-lg-12">
                                <div class="col-lg-4 padding-left-0">
                                    <select name="Destinos_{{$categoria->nombre}}" id="Destinos_{{$categoria->nombre}}" class="form-control" onchange="mostrar_tabla_destino('{{$categoria->nombre}}','{{$categoria->id}}')">
                                        <option value="0">Escoja la localizacion</option>
                                        @foreach($destinations as $destination)
                                            <option value="{{$destination->id}}_{{$categoria->nombre}}_{{$destination->destino}}">{{$destination->destino}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div id="tb_datos_{{$categoria->nombre}}">
                            </div>
                        @endif
                    @else

                        <table id="tb_{{$categoria->nombre}}" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Localizacion</th>
                                <th>Estrellas</th>
                                <th>Operaciones</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Localizacion</th>
                                <th>Estrellas</th>
                                <th>Operaciones</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($hotel->sortBy('localizacion') as $hotel_)
                                <tr id="lista_services_h_{{$hotel_->id}}">
                                    <td class="text-green-goto">{{$hotel_->localizacion}}</td>
                                    <td class="text-green-goto">{{$hotel_->estrellas}} <b class="text-warning"><i class="fa fa-star-half-o fa-2x" aria-hidden="true"></i></b></td>
                                    <td>
                                        <button type="button" class="btn btn-warning"  data-toggle="modal" data-target="#modal_edit_destination_h_{{$hotel_->id}}">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger" onclick="eliminar_servicio_h('{{$hotel_->id}}','{{$hotel_->nombre}}')">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
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
                                                <div class="col-lg-6">
                                                    <table class="table table-responsive table-striped table-condensed">
                                                        <thead>
                                                        <tr>
                                                            <th class="col-lg-2 text-primary">ACOMODATION</th>
                                                            <th class="col-lg-2 text-warning text-center text-15">{{$hotel_->estrellas}} <i class="fa fa-star-half-o fa-2x" aria-hidden="true"></i></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>SIMGLE</td>
                                                            <td><input type="number" name="eS_2" class="form-control" min="0" step="0.01" value="{{$hotel_->single}}"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>DOUBLE</td>
                                                            <td><input type="number" name="eD_2" class="form-control" min="0" step="0.01" value="{{$hotel_->doble}}"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>MATRIMONIAL</td>
                                                            <td><input type="number" name="eM_2" class="form-control" min="0" step="0.01" value="{{$hotel_->matrimonial}}"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>TRIPLE</td>
                                                            <td><input type="number" name="eT_2" class="form-control" min="0" step="0.01" value="{{$hotel_->triple}}"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>SUPERIOR SIMPLE</td>
                                                            <td><input type="number" name="eSS_2" class="form-control" min="0" step="0.01" value="{{$hotel_->superior_s}}"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>SUPERIOR DOUBLE</td>
                                                            <td><input type="number" name="eSD_2" class="form-control" min="0" step="0.01" value="{{$hotel_->superior_d}}"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>SUITE</td>
                                                            <td><input type="number" name="eSU_2" class="form-control" min="0" step="0.01" value="{{$hotel_->suite}}"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>JR. SUITE</td>
                                                            <td><input type="number" name="eJS_2" class="form-control" min="0" step="0.01" value="{{$hotel_->jr_suite}}"></td>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            {{csrf_field()}}
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
        function editar_producto(id){
            $('#modal_edit_producto_'+id).submit(function() {
                // Enviamos el formulario usando AJAX
                var grupo=$('#grupo_'+id).val();
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: new FormData($("#modal_edit_producto_"+id)[0]),
                    cache: false,
                    contentType: false,
                    processData: false,
                    // Mostramos un mensaje con la respuesta de PHP
                    success:  function (response) {
                    var datox=response.split('_');
                    console.log(datox);
// if(response==1){
//                            $('#result_'+id).removeClass('text-danger');
//                            $('#result_'+id).addClass('text-success');
                        $('#result_'+id).html('Producto guardado Correctamente!');
                        swal(
                            'Genial...',
                            'Producto guardado Correctamente!',
                            'success'
                        )
                        if(grupo=='MOVILID')
                            $('#tipo_'+id).html(datox[0]+' ['+datox[1]+'-'+datox[2]+']');
                        else
                            $('#tipo_'+id).html(datox[0]);

                        if(grupo=='TRAINS')
                            $('#horario_'+id).html(datox[2]);
                        $('#precio_'+id).html(datox[3]);
                        $('#nombre_'+id).html(datox[4]);

//                        }
//                        else{
//                            $('#result_'+id).removeClass('text-success');
//                            $('#result_'+id).addClass('text-danger');
//                            $('#result_'+id).html('Error al guardar la imagen, intentelo de nuevo');
//                        }
                    }
                })
                // esto es para que no se reenvie el formulario
                return false;
            });
        }
    </script>
@stop