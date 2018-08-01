@extends('layouts.admin.admin')
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
            <li class="active">Provider</li>
        </ol>
    </div>
    <div class="row margin-top-20">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_new_provider">
            New <i class="fa fa-plus-circle" aria-hidden="true"></i>
        </button>
        @foreach($categorias as $categoria)
            <?php
                $tipoServicio[]=$categoria->nombre;
            ?>
        @endforeach

        {{-- primer popup --}}
        <div class="modal fade bd-example-modal-lg" id="modal_new_provider" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form  id="service_save_id" method="post" enctype="multipart/form-data" action="{{route('provider_new_path')}}">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New provider</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <ul class="nav nav-tabs">
                                <?php
                                $pos=0;
                                ?>
                                @foreach($tipoServicio as $tipoServicio_)
                                        <?php
                                        $activo='';
                                        if($pos==0)
                                            $activo='active';
                                        ?>
                                        <li class="{{$activo}}"><a data-toggle="tab" href="#t_{{$tipoServicio_}}" onclick="escojerPos({{$pos++}},'{{$tipoServicio_}}')">{{$tipoServicio_}}</a></li>
                                @endforeach

                            </ul>
                            <div class="tab-content">
                                <?php
                                $in_pos=0;
                                ?>
                                @foreach($tipoServicio as $tipoServicio_)
                                    <?php
                                        $in_activo='';
                                    if($in_pos==0)
                                        $in_activo='in active';
                                    ?>
                                    <div id="t_{{$tipoServicio_}}" class="tab-pane fade {{$in_activo}}">
                                        <div class="row margin-top-20">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="col-lg-12">
                                                        <div class="estilo_form_new clearfix">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_codigo">Codigo</label>
                                                                    <?php
                                                                    $auto=1;
                                                                    if(count($providers)>0)
                                                                        $auto=($providers->last()->id)+1;
                                                                    ?>
                                                                    <input type="text" class="form-control" id="txt_codigo" name="txt_codigo" value="{{substr($tipoServicio_,0,2)}}{{$auto}}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_codigo">Location</label>
                                                                    <select class="form-control" id="txt_localizacion_{{$in_pos}}" name="txt_localizacion_{{$in_pos}}">
                                                                        @foreach($destinations as $destination)
                                                                            <option value="{{$destination->destino}}">{{$destination->destino}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            @if($tipoServicio_=='HOTELS')
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_codigo">Categoria</label>
                                                                    <select class="form-control" id="txt_categoria_{{$in_pos}}" name="txt_categoria_{{$in_pos}}">
                                                                        <option value="2">2 Stars</option>
                                                                        <option value="3">3 Stars</option>
                                                                        <option value="4">4 Stars</option>
                                                                        <option value="5">5 Stars</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            @endif
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_codigo">Ruc</label>
                                                                    <input type="text" class="form-control" id="txt_ruc_{{$in_pos}}" name="txt_ruc_{{$in_pos}}" placeholder="Ruc">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_type">Razon social</label>
                                                                    <input type="text" class="form-control" id="txt_razon_social_{{$in_pos}}" name="txt_razon_social_{{$in_pos}}" placeholder="Razon social">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_type">Nombre comercial</label>
                                                                    <input type="text" class="form-control" id="txt_nombre_comercial_{{$in_pos}}" name="txt_nombre_comercial_{{$in_pos}}" placeholder="Nombre comercial">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="form-group">
                                                                    <label for="txt_precio">Direccion</label>
                                                                    <input type="text" class="form-control" id="txt_direccion_{{$in_pos}}" name="txt_direccion_{{$in_pos}}" placeholder="Direccion">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="txt_price">Plazo a pagar en dias</label>
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <input type="text" class="col-lg-1 form-control" id="txt_plazo_{{$in_pos}}" name="txt_plazo_{{$in_pos}}" min="0" value="0">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-5  no-padding">
                                                                        <div class="form-group">
                                                                            <select class="form-control" id="txt_desci_{{$in_pos}}" name="txt_desci_{{$in_pos}}">
                                                                                <option value="antes">Antes</option>
                                                                                <option value="despues">Despues</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="col-md-4">
                                                        <div class="estilo_form_new clearfix">
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label for="txt_product">Reservas</label>
                                                                    <input type="text" class="form-control" id="txt_r_telefono_{{$in_pos}}" name="txt_r_telefono_{{$in_pos}}" placeholder="Celular">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    {{--<label for="txt_product">Email Reservas</label>--}}
                                                                    <input type="text" class="form-control" id="txt_r_email_{{$in_pos}}" name="txt_r_email_{{$in_pos}}" placeholder="Email">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 ">
                                                        <div class="estilo_form_new clearfix">
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label for="txt_product">Contabilidad</label>
                                                                    <input type="text" class="form-control" id="txt_c_telefono_{{$in_pos}}" name="txt_c_telefono_{{$in_pos}}" placeholder="Celular">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    {{--<label for="txt_product">Email Contabilidad</label>--}}
                                                                    <input type="text" class="form-control" id="txt_c_email_{{$in_pos}}" name="txt_c_email_{{$in_pos}}" placeholder="Email">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 ">
                                                        <div class="estilo_form_new clearfix">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="txt_product">Operaciones</label>
                                                                    <input type="text" class="form-control" id="txt_o_telefono_{{$in_pos}}" name="txt_o_telefono_{{$in_pos}}" placeholder="Celular">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    {{--<label for="txt_product">Email Operaciones</label>--}}
                                                                    <input type="text" class="form-control" id="txt_o_email_{{$in_pos}}" name="txt_o_email_{{$in_pos}}" placeholder="Email">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        $in_pos++;
                                    ?>
                                @endforeach
                            </div>
                        </div>
                        <div class="modal-footer">
                            {{csrf_field()}}
                            <input type="hidden" name="posTipo" id="posTipo" value="0">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <div class="row margin-top-20">
        <div class="col-lg-12">
            <ul class="nav nav-tabs">
                <?php
                $pos=0;
                ?>
                @foreach($tipoServicio as $tipoServicio_)
                    <?php
                    $activo='';
//                    if($pos==0)
//                        $activo='active';
//                    ?>
                    <li class="{{$activo}}"><a data-toggle="tab" href="#tl_{{$tipoServicio_}}">{{$tipoServicio_}}</a></li>
                <?php
                    $pos++;
                ?>
                @endforeach
            </ul>
            <div class="tab-content">
                <?php
                $in_pos=0;
                ?>
                @foreach($tipoServicio as $tipoServicio_)
                    @php
                        $in_activo='';
{{--                    if($in_pos==0)--}}
{{--                    $in_activo='in active';--}}
                    @endphp
                    <div id="tl_{{$tipoServicio_}}" class="tab-pane fade {{$in_activo}}">
                            <div class="margin-top-20">
                                @if($tipoServicio_=='HOTELS')
                                    <div class="row">
                                        <div class="col-lg-2">
                                            {{csrf_field()}}
                                            <div class="form-group">
                                                <label for="txt_codigo">Location</label>
                                                <select class="form-control" name="localizacion" id="localizacion" onchange="mostrar_proveedores($('#localizacion').val(),'{{$tipoServicio_}}')">
                                                    <option value="0_ninguno">Escoja un destino</option>
                                                    @foreach($destinations as $destinos)
                                                        <option value="{{$destinos->id}}_{{$destinos->destino}}">{{$destinos->destino}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label for="txt_codigo">Estrellas</label>
                                                <select class="form-control" name="estrellas" id="estrellas" onchange="mostrar_proveedores_x_estrellas($('#localizacion').val(),'{{$tipoServicio_}}',$('#estrellas').val())">
                                                    <option value="0">Escoja una opcion</option>
                                                    <option value="2">2 Stars</option>
                                                    <option value="3">3 Stars</option>
                                                    <option value="4">4 Stars</option>
                                                    <option value="5">5 Stars</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col-lg-2">
                                            {{csrf_field()}}
                                            <div class="form-group">
                                                <label for="txt_codigo">Location</label>
                                                <select class="form-control" name="localizacion" id="localizacion" onchange="mostrar_proveedores($(this).val(),'{{$tipoServicio_}}')">
                                                    <option value="0_ninguno">Escoja un destino</option>
                                                    @foreach($destinations as $destinos)
                                                        <option value="{{$destinos->id}}_{{$destinos->destino}}">{{$destinos->destino}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div id="caja_listado_proveedores_{{$tipoServicio_}}"></div>
                             </div>
                        </div>
                    @php
                    $in_pos++;
                    @endphp
                @endforeach
            </div>
        </div>
    </div>
@stop