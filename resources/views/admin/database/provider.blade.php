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
            <li class="breadcrumb-item active">Provider</li>
        </ol>
    </nav>
    <hr>
    <div class="row mt-3">
        <div class="col">
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {!! Session::get('success') !!}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @elseif (Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {!! Session::get('error') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_new_provider">
            <i class="fa fa-plus" aria-hidden="true"></i> New

        </button>
        @foreach($m_categoras as $categoria)
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

                            <ul class="nav nav-tabs nav-justified">

                                <?php
                                $pos=0;
                                ?>
                                @foreach($tipoServicio as $tipoServicio_)
                                        <?php
                                        $activo='';
                                        if($pos==0)
                                            $activo='active';
                                        ?>

                                            <li class="nav-item active">
                                            <a data-toggle="tab" href="#t_{{$tipoServicio_}}" class="nav-link show {{$activo}} rounded-0" onclick="escojerPos('{{$pos++}}','{{$tipoServicio_}}')">{{$tipoServicio_}}</a>
                                        </li>
                                @endforeach

                            </ul>
                            <div class="tab-content mt-3">

                                <?php
                                $in_pos=0;
                                ?>
                                @foreach($tipoServicio as $tipoServicio_)
                                    <?php
                                        $in_activo='';
                                    if($in_pos==0)
                                        $in_activo='in active';
                                    ?>

                                    <div id="t_{{$tipoServicio_}}" class="tab-pane fade show {{$in_activo}}">
                                        <div class="row mt-3">
                                            <div class="col">
                                                <div class="card p-2 w-100">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="row">
                                                                        <div class="col-3">
                                                                            <div class="form-group">
                                                                                <label for="txt_codigo" class="font-weight-bold text-secondary">Codigo</label>
                                                                                <?php
                                                                                $auto=1;
                                                                                if(count($providers)>0)
                                                                                    $auto=($providers->last()->id)+1;
                                                                                ?>
                                                                                <input type="text" class="form-control" id="txt_codigo" name="txt_codigo" value="{{substr($tipoServicio_,0,2)}}{{$auto}}" readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <div class="form-group">
                                                                                <label for="txt_codigo" class="font-weight-bold text-secondary">Tipo de proveedor</label>
                                                                                <select class="form-control" id="txt_tipo_proveedor_{{$in_pos}}" name="txt_tipo_proveedor_{{$in_pos}}">
                                                                                    <option value="EXTERNO">EXTERNO</option>
                                                                                    <option value="PLANTA">PLANTA</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <div class="form-group">
                                                                                <label for="txt_codigo" class="font-weight-bold text-secondary">Forma de pago</label>
                                                                                <select class="form-control" id="txt_tipo_pago_{{$in_pos}}" name="txt_tipo_pago_{{$in_pos}}">
                                                                                    <option value="CONTADO">CONTADO</option>
                                                                                    <option value="CREDITO">CREDITO</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="txt_codigo" class="font-weight-bold text-secondary">Origen</label>
                                                                        <select class="form-control" id="txt_localizacion_{{$in_pos}}" name="txt_localizacion_{{$in_pos}}">
                                                                            @foreach($destinations as $destination)
                                                                                <option value="{{$destination->destino}}">{{$destination->destino}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                @if($tipoServicio_=='HOTELS')
                                                                    <div class="col">
                                                                        <div class="form-group">
                                                                            <label for="txt_codigo" class="font-weight-bold text-secondary">Category</label>
                                                                            <select class="form-control" id="txt_categoria_{{$in_pos}}" name="txt_categoria_{{$in_pos}}">
                                                                                <option value="2">2 Stars</option>
                                                                                <option value="3">3 Stars</option>
                                                                                <option value="4">4 Stars</option>
                                                                                <option value="5">5 Stars</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="txt_codigo" class="font-weight-bold text-secondary">Ruc</label>
                                                                        <input type="text" class="form-control" id="txt_ruc_{{$in_pos}}" name="txt_ruc_{{$in_pos}}" placeholder="Ruc">
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <label for="txt_price" class="text-secondary font-weight-bold">Plazo a pagar en dias</label>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <div class="form-group">
                                                                                <input type="text" class="form-control" id="txt_plazo_{{$in_pos}}" name="txt_plazo_{{$in_pos}}" min="0" value="0">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col">
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
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="txt_type" class="text-secondary font-weight-bold">Razon social</label>
                                                                        <input type="text" class="form-control" id="txt_razon_social_{{$in_pos}}" name="txt_razon_social_{{$in_pos}}" placeholder="Razon social">
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="txt_type" class="text-secondary font-weight-bold">Nombre comercial</label>
                                                                        <input type="text" class="form-control" id="txt_nombre_comercial_{{$in_pos}}" name="txt_nombre_comercial_{{$in_pos}}" placeholder="Nombre comercial">
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="txt_precio" class="font-weight-bold text-secondary">Direccion</label>
                                                                        <input type="text" class="form-control" id="txt_direccion_{{$in_pos}}" name="txt_direccion_{{$in_pos}}" placeholder="Direccion">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col">
                                                <div class="card bg-light w-100">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="txt_product" class="text-secondary font-weight-bold">Reservas</label>
                                                            <input type="text" class="form-control" id="txt_r_telefono_{{$in_pos}}" name="txt_r_telefono_{{$in_pos}}" placeholder="Celular">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            {{--<label for="txt_product" class="text-secondary font-weight-bold">Email Reservas</label>--}}
                                                            <input type="text" class="form-control" id="txt_r_email_{{$in_pos}}" name="txt_r_email_{{$in_pos}}" placeholder="Email">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col ">
                                                <div class="card bg-light w-100">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="txt_product" class="text-secondary font-weight-bold">Contabilidad</label>
                                                            <input type="text" class="form-control" id="txt_c_telefono_{{$in_pos}}" name="txt_c_telefono_{{$in_pos}}" placeholder="Celular">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            {{--<label for="txt_product" class="text-secondary font-weight-bold">Email Contabilidad</label>--}}
                                                            <input type="text" class="form-control" id="txt_c_email_{{$in_pos}}" name="txt_c_email_{{$in_pos}}" placeholder="Email">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col ">
                                                <div class="card bg-light w-100">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="txt_product" class="text-secondary font-weight-bold">Operaciones</label>
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
                                        <div class="row mt-3">
                                            <div class="col">
                                                <div class="card bg-light w-100">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="txt_product" class="text-secondary font-weight-bold">Cta corriente</label>
                                                            <select class="form-control" name="txt_banco_nombre_cta_corriente_{{$in_pos}}" id="txt_banco_nombre_cta_corriente_{{$in_pos}}">
                                                                <option value="0">Escoja una Entidad Bancaria</option>
                                                                @foreach($entidadBancaria as $entidadBancaria_)
                                                                    <option value="{{$entidadBancaria_->id}}">{{$entidadBancaria_->nombre}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            {{--<label for="txt_product" class="text-secondary font-weight-bold">Email Reservas</label>--}}
                                                            <input type="text" class="form-control" id="txt_banco_nro_cta_corriente_{{$in_pos}}" name="txt_banco_nro_cta_corriente_{{$in_pos}}" placeholder="Numero Cta Corriente">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="card bg-light w-100">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="txt_product" class="text-secondary font-weight-bold">Cta Interbancaria</label>
                                                            <select class="form-control" name="txt_banco_nombre_cta_cci_{{$in_pos}}" id="txt_banco_nombre_cta_cci_{{$in_pos}}">
                                                                <option value="0">Escoja una Entidad Bancaria</option>
                                                                @foreach($entidadBancaria as $entidadBancaria_)
                                                                    <option value="{{$entidadBancaria_->id}}">{{$entidadBancaria_->nombre}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            {{--<label for="txt_product" class="text-secondary font-weight-bold">Email Reservas</label>--}}
                                                            <input type="text" class="form-control" id="txt_banco_nro_cta_cci_{{$in_pos}}" name="txt_banco_nro_cta_cci_{{$in_pos}}" placeholder="Numero Cta CCI">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3 text-left">
                                            <div class="col">
                                                <div class="card p-3 bg-light">
                                                    <div class="form-group">
                                                        <label for="txt_codigo" class="text-secondary font-weight-bold">Destinos que opera</label>
                                                    </div>
                                                    <div class="row padding-10">
                                                        @foreach($destinations as $destination)
                                                            <div class="col-3 form-group form-check">
                                                                <input type="checkbox" class="form-check-input" id="destinos_opera_{{$in_pos}}_{{$destination->id}}" name="destinos_opera_{{$in_pos}}[]" value="{{$destination->id}}">
                                                                <label class="form-check-label" for="destinos_opera_{{$in_pos}}_{{$destination->id}}">{{$destination->destino}}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if($in_pos>0)
                                        <div class="row mt-3 text-left">
                                            <div class="col">
                                                <div class="card p-3 bg-light">
                                                    <div class="form-group">
                                                        <label for="txt_codigo" class="text-secondary font-weight-bold">Grupos que opera</label>
                                                    </div>
                                                    <div class="row padding-10">
                                                        @foreach($m_categories as $m_category)
                                                            <div class="col-3 form-group form-check">
                                                                <input type="checkbox" class="form-check-input" id="grupos_opera_{{$in_pos}}_{{$m_category->nombre}}" name="grupos_opera_{{$in_pos}}[]" value="{{$m_category->id}}">
                                                                <label class="form-check-label" for="grupos_opera_{{$in_pos}}_{{$m_category->nombre}}">{{$m_category->nombre}}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

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
    </div>
    <div class="row margin-top-20">
        <div class="col">
            <ul class="nav nav-tabs nav-justified">

                <?php
                $pos=0;
                ?>
                @foreach($tipoServicio as $tipoServicio_)
                        <?php
                        $activo='';
                        ?>
                        @if($pos==0)
                            <?php
                            $activo='active';
                            ?>
                        @endif
                        <li class="nav-item">
                            <a data-toggle="tab" href="#tl_{{$tipoServicio_}}" class="nav-link show {{$activo}} rounded-0" role="tab" aria-controls="pills-home" aria-selected="true">{{$tipoServicio_}}</a>
                        </li>

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

                        <?php
                        $in_activo='';
                        ?>
                        @if($in_pos==0)
                            <?php
                                $in_activo='in active';
                            ?>
                        @endif
                    <div id="tl_{{$tipoServicio_}}" class="tab-pane show fade {{$in_activo}}">
                            <div class="mt-3">
                                @if($tipoServicio_=='HOTELS')
                                    <div class="row">
                                        <div class="col">
                                            {{csrf_field()}}
                                            <div class="form-group">
                                                <label for="txt_codigo" class="font-weight-bold text-secondary">Origen</label>

                                                <select class="form-control" name="localizacion" id="localizacion" onchange="mostrar_proveedores($('#localizacion').val(),'{{$tipoServicio_}}')">
                                                    <option value="0_ninguno">Escoja un destino</option>
                                                    @foreach($destinations as $destinos)
                                                        <option value="{{$destinos->id}}_{{$destinos->destino}}">{{$destinos->destino}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="txt_codigo" class="font-weight-bold text-secondary">Estrellas</label>

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

                                        <div class="col-6">
                                            {{csrf_field()}}
                                            <div class="form-group">
                                                <label for="txt_codigo" class="font-weight-bold text-secondary">Origen</label>

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
                                <div class="row"> 
                                    <div class="col" id="caja_listado_proveedores_{{$tipoServicio_}}"></div>
                                </div>
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
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    