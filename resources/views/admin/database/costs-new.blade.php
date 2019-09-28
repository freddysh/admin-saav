@php
    $destinos_usados=array();
@endphp
@foreach($hotel_solo as $hotel_)
    @if(!in_array($hotel_->localizacion,$destinos_usados))
        @php
            $destinos_usados[]=$hotel_->localizacion;
        @endphp
    @endif
@endforeach

@extends('layouts.admin.admin')
@section('archivos-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        .ui-autocomplete {
            z-index: 5000 !important;
        }
    </style>
@stop
@section('archivos-js')
    <script src="{{asset("https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js")}}"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
@stop
@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white m-0">
            <li class="breadcrumb-item" aria-current="page"><a href="/">Home</a></li>
            <li class="breadcrumb-item">Database</li>
            <li class="breadcrumb-item active">Cost</li>
        </ol>
    </nav>
    <hr>
    <div class="row mt-3">
        <div class="col" id="modal_new_cost">

            <form  action="{{route('costs_save_path')}}" method="post" id="service_save_id" enctype="multipart/form-data">
                @foreach($categorias->where('nombre','HOTELS') as $categoria)

                <?php
                    $tipoServicio[]=$categoria->nombre;
                ?>
            @endforeach


                    <ul class="nav nav-tabs nav-justified">

                    <?php
                    $pos=0;
                    ?>
                    @foreach($categorias->where('nombre','HOTELS') as $categoria)
                        <?php
                            $activo_='';
                        ?>
                        @if($pos==0)
                            <?php
                            $activo_='active';
                            ?>
                        @endif

                            <li class="nav-item active">
                                <a data-toggle="tab" href="#{{$categoria->nombre}}" class="nav-link show {{$activo_}} rounded-0" onclick="escojerPos({{$pos}})">{{$categoria->nombre}}</a>
                            </li>

                            <?php
                            $pos++;
                            ?>
                    @endforeach
                </ul>
                <div class="tab-content">
                    <?php
                    $pos0=0;
                    ?>
                    @foreach($categorias->where('nombre','HOTELS') as $categoria)
                            <?php
                            $activo='';
                            ?>
                            @if($pos0==0)
                            <?php
                                $activo='in active';
                            ?>
                        @endif

                        <div id="{{$categoria->nombre}}" class="tab-pane fade show {{$activo}}">
                                <div class="row mt-3">
                                    @if($categoria->nombre!='HOTELS')
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="txt_codigo" class="font-weight-bold text-secondary">Location</label>

                                                {{--<input type="text" class="form-control" id="txt_localizacion_0" name="txt_localizacion_0" placeholder="Location">--}}
                                                <select class="form-control" id="txt_localizacion_{{$pos0}}" name="txt_localizacion_{{$pos0}}" onchange="mostrar_hoteles('{{$pos0}}')">
                                                    @foreach($destinations as $destination)
                                                        <option value="{{$destination->destino}}">{{$destination->destino}}</option>
                                                    @endforeach
                                                </select>

                                                <input type="hidden" name="tipoServicio_{{$pos0}}" id="tipoServicio_{{$pos0}}" value="{{$categoria->nombre}}">
                                            </div>
                                        </div>

                                    @endif
                                    @if($categoria->nombre=='HOTELS')

                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="txt_codigo" class="font-weight-bold text-secondary">Location</label>

                                                    {{--<input type="text" class="form-control" id="txt_localizacion_0" name="txt_localizacion_0" placeholder="Location">--}}
                                                    <select class="form-control" id="txt_localizacion_{{$pos0}}" name="txt_localizacion_{{$pos0}}" onchange="mostrar_hoteles('{{$pos0}}')">
                                                        <option value="0">Escoja el destino</option>
                                                        @foreach($destinations as $destination)
                                                            @if(in_array($destination->destino,$destinos_usados))
                                                                <option value="{{$destination->destino}}">{{$destination->destino}}</option>
                                                            @else
                                                                <option value="{{$destination->destino}}" disabled="disabled">{{$destination->destino}} -> agregar los producto</option>
                                                            @endif
                                                        @endforeach
                                                    </select>

                                                    <input type="hidden" name="tipoServicio_{{$pos0}}" id="tipoServicio_{{$pos0}}" value="{{$categoria->nombre}}">
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="txt_codigo" class="font-weight-bold text-secondary">Categoria</label>

                                                    {{--<input type="text" class="form-control" id="txt_localizacion_0" name="txt_localizacion_0" placeholder="Location">--}}
                                                    <select class="form-control" id="txt_categoria_{{$pos0}}" name="txt_categoria_{{$pos0}}" onchange="mostrar_hoteles_categoria('{{$pos0}}')">
                                                        <option value="2">2 Stars</option>
                                                        <option value="3">3 Stars</option>
                                                        <option value="4">4 Stars</option>
                                                        <option value="5">5 Stars</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="row">
                                                    <div class="form-group col-9">
                                                        <label for="txt_precio" class="font-weight-bold text-secondary">Provider</label>
                                                        <input type="text" class="form-control" id="txt_provider_{{$pos0}}" name="txt_provider_{{$pos0}}" placeholder="Provider" >
                                                    </div>
                                                    <div class="col mt-1 d-none">
                                                        <button type="button" class="btn btn-primary mt-4" data-toggle="modal" data-target="#modal_new_provider" onclick="pasar_pos_provider('0')">
                                                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                    @endif


                                </div>

                            <div class="row justify-content-center">
                                @if($categoria->nombre=='HOTELS')
                                    <div class="col-6">
                                        <table class="table table-bordered table-sm">
                                            <thead>
                                            <tr>
                                                <th class="text-primary">ACOMODATION</th>
                                                <th id="header_2" class="text-warning text-center">2 <i class="fa fa-star"></i></th>
                                                <th id="header_3" class="text-warning text-center d-none">3 <i class="fa fa-star"></i></th>
                                                <th id="header_4" class="text-warning text-center d-none">4 <i class="fa fa-star"></i></th>
                                                <th id="header_5" class="text-warning text-center d-none">5 <i class="fa fa-star"></i></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>SIMGLE</td>
                                                <td id="dato_s_2"><input type="number" name="S_2" id="S_2" class="form-control form-control-sm" min="0" step="0.01" value="0"></td>
                                                <td id="dato_s_3" class="d-none"><input type="number" name="S_3" id="S_3" class="form-control form-control-sm" min="0" step="0.01" value="0"></td>
                                                <td id="dato_s_4" class="d-none"><input type="number" name="S_4" id="S_4" class="form-control form-control-sm" min="0" step="0.01" value="0"></td>
                                                <td id="dato_s_5" class="d-none"><input type="number" name="S_5" id="S_5" class="form-control form-control-sm" min="0" step="0.01" value="0"></td>
                                            </tr>
                                            <tr>
                                                <td>DOUBLE</td>
                                                <td id="dato_d_2"><input type="number" name="D_2" id="D_2" class="form-control form-control-sm" min="0" step="0.01" value="0"></td>
                                                <td id="dato_d_3" class="d-none"><input type="number" name="D_3" id="D_3" class="form-control form-control-sm" min="0" step="0.01" value="0"></td>
                                                <td id="dato_d_4" class="d-none"><input type="number" name="D_4" id="D_4" class="form-control form-control-sm" min="0" step="0.01" value="0"></td>
                                                <td id="dato_d_5" class="d-none"><input type="number" name="D_5" id="D_5" class="form-control form-control-sm" min="0" step="0.01" value="0"></td>
                                            </tr>
                                            <tr>
                                                <td>MATRIMONIAL</td>
                                                <td id="dato_m_2"><input type="number" name="M_2" id="M_2" class="form-control form-control-sm" min="0" step="0.01" value="0"></td>
                                                <td id="dato_m_3" class="d-none"><input type="number" name="M_3" id="M_3" class="form-control form-control-sm" min="0" step="0.01" value="0"></td>
                                                <td id="dato_m_4" class="d-none"><input type="number" name="M_4" id="M_4" class="form-control form-control-sm" min="0" step="0.01" value="0"></td>
                                                <td id="dato_m_5" class="d-none"><input type="number" name="M_5" id="M_5" class="form-control form-control-sm" min="0" step="0.01" value="0"></td>
                                            </tr>
                                            <tr>
                                                <td>TRIPLE</td>
                                                <td id="dato_t_2"><input type="number" name="T_2" id="T_2" class="form-control form-control-sm" min="0" step="0.01" value="0"></td>
                                                <td id="dato_t_3" class="d-none"><input type="number" name="T_3" id="T_3" class="form-control form-control-sm" min="0" step="0.01" value="0"></td>
                                                <td id="dato_t_4" class="d-none"><input type="number" name="T_4" id="T_4" class="form-control form-control-sm" min="0" step="0.01" value="0"></td>
                                                <td id="dato_t_5" class="d-none"><input type="number" name="T_5" id="T_5" class="form-control form-control-sm" min="0" step="0.01" value="0"></td>
                                            </tr>
                                            <tr>
                                                <td>SUPERIOR SIMPLE</td>
                                                <td id="dato_ss_2"><input type="number" name="SS_2" id="SS_2" class="form-control form-control-sm" min="0" step="0.01" value="0"></td>
                                                <td id="dato_ss_3" class="d-none"><input type="number" name="SS_3" id="SS_3" class="form-control form-control-sm" min="0" step="0.01" value="0"></td>
                                                <td id="dato_ss_4" class="d-none"><input type="number" name="SS_4" id="SS_4" class="form-control form-control-sm" min="0" step="0.01" value="0"></td>
                                                <td id="dato_ss_5" class="d-none"><input type="number" name="SS_5" id="SS_5" class="form-control form-control-sm" min="0" step="0.01" value="0"></td>
                                            </tr>
                                            <tr>
                                                <td>SUPERIOR DOUBLE</td>
                                                <td id="dato_sd_2"><input type="number" name="SD_2" id="SD_2" class="form-control form-control-sm" min="0" step="0.01" value="0"></td>
                                                <td id="dato_sd_3" class="d-none"><input type="number" name="SD_3" id="SD_3" class="form-control form-control-sm" min="0" step="0.01" value="0"></td>
                                                <td id="dato_sd_4" class="d-none"><input type="number" name="SD_4" id="SD_4" class="form-control form-control-sm" min="0" step="0.01" value="0"></td>
                                                <td id="dato_sd_5" class="d-none"><input type="number" name="SD_5" id="SD_5" class="form-control form-control-sm" min="0" step="0.01" value="0"></td>
                                            </tr>
                                            <tr>
                                                <td>SUITE</td>
                                                <td id="dato_su_2"><input type="number" name="SU_2" id="SU_2" class="form-control form-control-sm" min="0" step="0.01" value="0"></td>
                                                <td id="dato_su_3" class="d-none"><input type="number" name="SU_3" id="SU_3" class="form-control form-control-sm" min="0" step="0.01" value="0"></td>
                                                <td id="dato_su_4" class="d-none"><input type="number" name="SU_4" id="SU_4" class="form-control form-control-sm" min="0" step="0.01" value="0"></td>
                                                <td id="dato_su_5" class="d-none"><input type="number" name="SU_5" id="SU_5" class="form-control form-control-sm" min="0" step="0.01" value="0"></td>
                                            </tr>
                                            <tr>
                                                <td>JR. SUITE</td>
                                                <td id="dato_js_2"><input type="number" name="JS_2" id="JS_2" class="form-control form-control-sm" min="0" step="0.01" value="0"></td>
                                                <td id="dato_js_3" class="d-none"><input type="number" name="JS_3" id="JS_3" class="form-control form-control-sm" min="0" step="0.01" value="0"></td>
                                                <td id="dato_js_4" class="d-none"><input type="number" name="JS_4" id="JS_4" class="form-control form-control-sm" min="0" step="0.01" value="0"></td>
                                                <td id="dato_js_5" class="d-none"><input type="number" name="JS_5" id="JS_5" class="form-control form-control-sm" min="0" step="0.01" value="0"></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                                <div class="col-6">
                                    <div class="form-group">
                                        @if($categoria->nombre=='TOURS')
                                            <label for="txt_type">Type</label>
                                            <select class="form-control" id="txt_type_0" name="txt_type_{{$pos0}}">
                                                <option value="GROUP">GROUP</option>
                                                <option value="PRIVATE">PRIVATE</option>
                                            </select>
                                        @endif
                                        @if($categoria->nombre=='MOVILID')
                                            <label for="txt_type">Type</label>
                                            <select class="form-control" id="txt_type_0" name="txt_type_{{$pos0}}">
                                                <option value="AUTO">AUTO</option>
                                                <option value="SUV">SUV</option>
                                                <option value="VAN">VAN</option>
                                                <option value="H1">H1</option>
                                                <option value="SPRINTER">SPRINTER</option>
                                                <option value="BUS">BUS</option>
                                            </select>
                                        @endif
                                        @if($categoria->nombre=='REPRESENT')
                                            <label for="txt_type">Type</label>
                                            <select class="form-control" id="txt_type_0" name="txt_type_{{$pos0}}">
                                                <option value="GUIDE">GUIDE</option>
                                                <option value="TRANSFER">TRANSFER</option>
                                                <option value="ASSISTANCE">ASSISTANCE</option>
                                            </select>
                                        @endif
                                        @if($categoria->nombre=='ENTRANCES')
                                            <label for="txt_type">Type</label>
                                            <select class="form-control" id="txt_type_0" name="txt_type_{{$pos0}}">
                                                <option value="EXTRANJERO">EXTRANJERO</option>
                                                <option value="NATIONAL">NATIONAL</option>
                                            </select>
                                        @endif
                                        @if($categoria->nombre=='FOOD')
                                            <label for="txt_type">Type</label>
                                            <select class="form-control" id="txt_type_0" name="txt_type_{{$pos0}}">
                                                <option value="LUNCH">LUNCH</option>
                                                <option value="DINNER">DINNER</option>
                                                <option value="BOX LUNCH">BOX LUNCH</option>
                                            </select>
                                        @endif
                                        @if($categoria->nombre=='TRAINS')
                                            <label for="txt_type">Type</label>
                                            <select class="form-control" id="txt_type_0" name="txt_type_{{$pos0}}">
                                                <option value="EXPEDITION">EXPEDITION</option>
                                                <option value="VISITADOME">VISITADOME</option>
                                                <option value="HIRAN BINGHAN">BOX LUNCH</option>
                                                <option value="EJECUTIVO">EJECUTIVO</option>
                                                <option value="PRIMERA CLASE">PRIMERA CLASE</option>
                                            </select>
                                        @endif
                                        @if($categoria->nombre=='FLIGHTS')
                                            <label for="txt_type">Type</label>
                                            <select class="form-control" id="txt_type_0" name="txt_type_{{$pos0}}">
                                                <option value="NATIONAL">NATIONAL</option>
                                                <option value="INTERNATIONAL">INTERNATIONAL</option>
                                            </select>
                                        @endif
                                        @if($categoria->nombre=='OTHERS')
                                            <input type="text" class="form-control" id="txt_type_0" name="txt_type_{{$pos0}}" placeholder="Type">
                                        @endif

                                    </div>
                                </div>
                                @if($categoria->nombre!='HOTELS')
                                    <div class="col-6">

                                        <div class="form-group col-md-9">
                                            <label for="txt_precio">Provider</label>
                                            <input type="text" class="form-control" id="txt_provider_{{$pos0}}" name="txt_provider_{{$pos0}}" placeholder="Provider">
                                        </div>
                                        <div class="col-md-3 margin-top-25 ">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_new_provider" onclick="pasar_pos_provider('0')">
                                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>


                                    <div class="col-6">

                                        <div class="form-group">
                                            <label for="txt_product">Product</label>
                                            <input type="text" class="form-control" id="txt_product_{{$pos0}}" name="txt_product_{{$pos0}}" placeholder="Product">
                                        </div>
                                    </div>


                                    <div class="col-6 d-none">

                                        <div class="form-group">
                                            <label for="txt_code">Code product</label>
                                            <input type="text" class="form-control" id="txt_code_0" name="txt_code_{{$pos0}}" placeholder="Code product">
                                        </div>
                                    </div>

                                    <div class="col-6">

                                        <div class="form-group">
                                            <label for="txt_price">Price</label>
                                            <input type="number" class="form-control" id="txt_price_0" name="txt_price_{{$pos0}}" placeholder="Price" min="0.00" step="0.01">
                                        </div>
                                    </div>

                                @endif
                                <div class="col-6 d-none">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class=" text-green-goto">
                                                <input type="radio" name="txt_tipo_grupo_{{$pos0}}" value="Absoluto" checked="checked">
                                                Precio es absoluto
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            <label class=" text-green-goto">
                                                <input type="radio" name="txt_tipo_grupo_{{$pos0}}" value="Individual">
                                                Precio es individual
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>

                    <?php
                    $pos0++;
                    ?>
                    @endforeach

                </div>
                {{csrf_field()}}
                <input type="hidden" name="posTipo" id="posTipo" value="0">
                <input type="hidden" name="hotel_id_2" id="hotel_id_2" value="0">
                <input type="hidden" name="hotel_id_3" id="hotel_id_3" value="0">
                <input type="hidden" name="hotel_id_4" id="hotel_id_4" value="0">
                <input type="hidden" name="hotel_id_5" id="hotel_id_5" value="0">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>

            </form>


        </div>

    </div>

    <script>
        $(document).ready(function() {

            @foreach($tipoServicio as $tipoServicio_)

            $('#tb_{{$tipoServicio_}}').DataTable();
            @endforeach
            <?php
            $pos0=0;
            ?>
            @foreach($productos as $proveedor)
                @foreach($proveedor->productos  as $producto)
                    $("select[id=etxt_localizacion_{{$pos0}}]").change(function(){
                        $('#e_localizacion_{{$pos0}}').val($('select[id=etxt_localizacion_{{$pos0}}]').val());
                     });
                <?php
                $pos0++;
                ?>
                @endforeach
            @endforeach

            <?php
                $i=0;
            ?>
        @foreach($tipoServicio as $tipoServicio_)
            @if($tipoServicio_=='HOTELS')
                $('#txt_provider_{{$i}}').autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            url: "../buscar-proveedor",
                            dataType: "json",
                            data: {
                                term : request.term,
                                localizacion : $("#txt_localizacion_{{$i}}").val(),
                                grupo : '{{$tipoServicio_}}',
                                estrellas:$("#txt_categoria_{{$i}}").val()
                            },
                            success: function(data) {
                                response(data);
                            }
                        });
                    },
                    minLength: 1
                });
            @else
                $('#txt_provider_{{$i}}').autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            url: "../buscar-proveedor",
                            dataType: "json",
                            data: {
                                term : request.term,
                                localizacion : $("#txt_localizacion_{{$i}}").val(),
                                grupo : '{{$tipoServicio_}}',
                            },
                            success: function(data) {
                                response(data);
                            }
                        });
                    },
                    minLength: 1
                });
            @endif
            <?php
                $i++;
            ?>
        @endforeach

        <?php
        $pos10=0;
        ?>
        @foreach($productos as $proveedor1)
            @foreach($proveedor1->productos  as $producto1)
            $('#e_txt_provider_{{$pos10}}').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "buscar-proveedor",
                        dataType: "json",
                        data: {
                            term : request.term,
                            localizacion : $("#e_localizacion_{{$pos10}}").val(),
                            grupo : '{{$producto1->grupo}}',
                            estrellas:$("#txt_categoria_0").val(),
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                minLength: 1
            });
            <?php
                $pos10++;
            ?>
            @endforeach
        @endforeach

        <?php
            $i=0;
        ?>
        @foreach($tipoServicio as $tipoServicio_)
            $('#txt_product_{{$i}}').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "buscar-product",
                        dataType: "json",
                        data: {
                            term : request.term,
                            localizacion : $("#localizacion_{{$i}}").val(),
                            grupo : '{{$tipoServicio_}}'
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                minLength: 1
            });
            <?php
                $i++;
            ?>
        @endforeach
        <?php
        $pos10=0;
        ?>
        @foreach($productos as $proveedor1)
            @foreach($proveedor1->productos  as $producto1)
            $('#e_txt_product_{{$pos10}}').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "buscar-product",
                        dataType: "json",
                        data: {
                            term : request.term,
                            localizacion : $("#e_localizacion_{{$pos10}}").val(),
                            grupo : '{{$producto1->grupo}}'
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                minLength: 1
            });
            <?php
            $pos10++;
            ?>
            @endforeach
        @endforeach
        });
    </script>
@stop
