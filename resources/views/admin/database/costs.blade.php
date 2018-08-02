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
        <div class="col">
            <a href="{{route('mostrar_cost_new_path')}}" class="btn btn-primary btn-sm">
                <i class="fa fa-plus" aria-hidden="true"></i> New
            </a>
            @foreach($categorias->where('nombre','HOTELS') as $categoria)
                @php
                    $tipoServicio[]=$categoria->nombre;
                @endphp
            @endforeach
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
                <?php
                $pos++;
                ?>
            @endforeach
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
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
                            <a data-toggle="tab" href="#t_{{$categoria->nombre}}" class="nav-link show {{$activo_}} rounded-0" role="tab" aria-controls="pills-home" aria-selected="true">{{$categoria->nombre}}</a>
                        </li>

                    <?php
                    $pos++;
                    ?>
                @endforeach
            </ul>
            <div class="tab-content">
                <?php
                $pos=0;
                ?>
                @foreach($categorias->where('nombre','HOTELS') as $categoria)
                    <?php
                    $activo_='';
                    ?>
                    @if($pos==0)
                        <?php
                        $activo_='in active';
                        ?>
                    @endif
                    @if($categoria->nombre!='HOTELS')

                        <div id="t_{{$categoria->nombre}}" class="tab-pane show fade {{$activo_}}">

                            <div class="margin-top-20">
                                <table id="tb_{{$categoria->nombre}}" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Location</th>
                                        <th>Type</th>
                                        <th>Provider</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Operations</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Location</th>
                                        <th>Type</th>
                                        <th>Provider</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Operations</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($productos as $proveedor)
                                        @if(count($proveedor->productos)>0)
                                            @foreach($proveedor->productos  as $producto)
                                                @if($producto->grupo==$categoria->nombre)
                                                <tr id="lista_services_{{$producto->id}}">
                                                    <td><b class="text-success"><i class="fa fa-bus fa-2x" aria-hidden="true"></i></b></td>
                                                    <td>{{$producto->localizacion}}</td>
                                                    <td>{{$producto->tipo_producto}}</td>
                                                    <td><b class="bg-green-goto text-grey-goto">{{$proveedor->codigo}}</b> {{$proveedor->razon_social}}</td>
                                                    <td><b class="bg-orange-goto text-grey-goto">{{$producto->codigo}}</b>{{$producto->nombre}}</td>
                                                    <td>${{$producto->precio_costo}}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-warning"  data-toggle="modal" data-target="#modal_edit_cost_{{$producto->id}}">
                                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger" onclick="eliminar_producto('{{$producto->id}}','{{$producto->nombre}}')">
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else

                        <div id="t_{{$categoria->nombre}}" class="tab-pane show fade {{$activo_}}">
                                <div class="row mt-3">
                                    <div class="col">
                                        {{csrf_field()}}
                                        <div class="form-group">
                                            <label for="txt_codigo" class="font-weight-bold text-secondary">Location</label>

                                            <select class="form-control" name="localizacion" id="localizacion" onchange="mostrar_proveedores_cost($('#localizacion').val(),'{{$categoria->nombre}}')">
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

                                            <select class="form-control" name="estrellas" id="estrellas" onchange="mostrar_proveedores_x_estrellas_cost($('#localizacion').val(),'{{$categoria->nombre}}',$('#estrellas').val())">
                                                <option value="0">Escoja una opcion</option>
                                                <option value="2">2 Stars</option>
                                                <option value="3">3 Stars</option>
                                                <option value="4">4 Stars</option>
                                                <option value="5">5 Stars</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="caja_listado_cost_proveedores_{{$categoria->nombre}}">

                                </div>

                        </div>
                    @endif
                    <?php
                        $pos++;
                    ?>
                @endforeach
            </div>
            @php
                $pos=0;
            @endphp
            @foreach($proveedores as $proveedores_)
                @php
                    $pos++;
                    $dato=explode('_',$proveedores_);
                @endphp
                @foreach($hotel->where('localizacion',$dato[0])->where('proveedores_id',$dato[1])->where('estrellas','3') as $hotel_)
                {{--{{dd($hotel_)}}--}}
                @endforeach
                <div class="modal fade bd-example-modal-lg" id="modal_edit_cost_hotel_{{$pos}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <form action="{{route('costs_edit_hotel_path')}}" method="post" id="service_save_id" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Cost</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col"></div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                {{csrf_field()}}
                                {{--<input type="hidden" name="id" id="id" value="{{$producto->id}}">--}}
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        <?php
            $pos0=0;
            ?>
            @foreach($productos as $proveedor)
                @foreach($proveedor->productos  as $producto)
                    <!-- Modal -->
                    <div class="modal fade bd-example-modal-lg" id="modal_edit_cost_{{$producto->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <form action="{{route('costs_edit_path')}}" method="post" id="service_save_id" enctype="multipart/form-data">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Cost</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a data-toggle="tab" href="#e_{{$producto->grupo}}_{{$producto->id}}">{{$producto->grupo}}</a></li>
                                              </ul>
                                            <div class="tab-content">
                                                 <div id="e_{{$producto->grupo}}_{{$producto->id}}" class="tab-pane fade in active">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_codigo">Location</label>
                                                                {{--<input type="text" class="form-control" id="txt_localizacion_0" name="txt_localizacion_0" placeholder="Location">--}}
                                                                <select class="form-control" id="etxt_localizacion_{{$pos0}}" name="txt_localizacion_0">
                                                                    @foreach($destinations as $destination)
                                                                        <option value="{{$destination->destino}}" @if($destination->destino==$producto->localizacion) {{'selected'}} @endif>{{$destination->destino}}</option>
                                                                    @endforeach
                                                                </select>

                                                                <input type="hidden" name="tipoServicio_{{$pos0}}" id="tipoServicio_{{$pos0}}" value="{{$categoria->nombre}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_type">Type</label>
                                                                {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}

                                                                @if($producto->grupo=='HOTELS')
                                                                    <select class="form-control" id="txt_type_0" name="txt_type_0">
                                                                        <option value="2 STARS" @if($producto->tipo_producto=='2 STARS') {{'selected'}} @endif>2 STARS</option>
                                                                        <option value="3 STARS" @if($producto->tipo_producto=='3 STARS') {{'selected'}} @endif>3 STARS</option>
                                                                        <option value="4 STARS" @if($producto->tipo_producto=='4 STARS') {{'selected'}} @endif>4 STARS</option>
                                                                        <option value="5 STARS" @if($producto->tipo_producto=='5 STARS') {{'selected'}} @endif>5 STARS</option>
                                                                    </select>
                                                                @endif
                                                                @if($producto->grupo=='TOURS')
                                                                    <select class="form-control" id="txt_type_0" name="txt_type_0">
                                                                        <option value="GROUP" @if($producto->tipo_producto=='GROUP') {{'selected'}} @endif>GROUP</option>
                                                                        <option value="PRIVATE" @if($producto->tipo_producto=='PRIVATE') {{'selected'}} @endif>PRIVATE</option>
                                                                    </select>
                                                                @endif
                                                                @if($producto->grupo=='MOVILID')
                                                                    <select class="form-control" id="txt_type_0" name="txt_type_0">
                                                                        <option value="AUTO" @if($producto->tipo_producto=='AUTO') {{'selected'}} @endif>AUTO</option>
                                                                        <option value="SUV" @if($producto->tipo_producto=='SUV') {{'selected'}} @endif>SUV</option>
                                                                        <option value="VAN" @if($producto->tipo_producto=='VAN') {{'selected'}} @endif>VAN</option>
                                                                        <option value="H1" @if($producto->tipo_producto=='H1') {{'selected'}} @endif>H1</option>
                                                                        <option value="SPRINTER" @if($producto->tipo_producto=='SPRINTER') {{'selected'}} @endif>SPRINTER</option>
                                                                        <option value="BUS" @if($producto->tipo_producto=='BUS') {{'selected'}} @endif>BUS</option>
                                                                    </select>
                                                                @endif
                                                                @if($producto->grupo=='REPRESENT')
                                                                    <select class="form-control" id="txt_type_0" name="txt_type_0">
                                                                        <option value="GUIDE" @if($producto->tipo_producto=='GUIDE') {{'selected'}} @endif>GUIDE</option>
                                                                        <option value="TRANSFER" @if($producto->tipo_producto=='TRANSFER') {{'selected'}} @endif>TRANSFER</option>
                                                                        <option value="ASSISTANCE" @if($producto->tipo_producto=='ASSISTANCE') {{'selected'}} @endif>ASSISTANCE</option>
                                                                    </select>
                                                                @endif
                                                                @if($producto->grupo=='ENTRANCES')
                                                                    <select class="form-control" id="txt_type_0" name="txt_type_0">
                                                                        <option value="EXTRANJERO" @if($producto->tipo_producto=='EXTRANJERO') {{'selected'}} @endif>EXTRANJERO</option>
                                                                        <option value="NATIONAL" @if($producto->tipo_producto=='NATIONAL') {{'selected'}} @endif>NATIONAL</option>
                                                                    </select>
                                                                @endif
                                                                @if($producto->grupo=='FOOD')
                                                                    <select class="form-control" id="txt_type_0" name="txt_type_0">
                                                                        <option value="LUNCH" @if($producto->tipo_producto=='LUNCH') {{'selected'}} @endif>LUNCH</option>
                                                                        <option value="DINNER" @if($producto->tipo_producto=='DINNER') {{'selected'}} @endif>DINNER</option>
                                                                        <option value="BOX LUNCH" @if($producto->tipo_producto=='BOX LUNCH') {{'selected'}} @endif>BOX LUNCH</option>
                                                                    </select>
                                                                @endif
                                                                @if($producto->grupo=='TRAINS')
                                                                    <select class="form-control" id="txt_type_0" name="txt_type_0">
                                                                        <option value="EXPEDITION" @if($producto->tipo_producto=='EXPEDITION') {{'selected'}} @endif>EXPEDITION</option>
                                                                        <option value="VISITADOME" @if($producto->tipo_producto=='VISITADOME') {{'selected'}} @endif>VISITADOME</option>
                                                                        <option value="HIRAN BINGHAN" @if($producto->tipo_producto=='HIRAN BINGHAN') {{'selected'}} @endif>BOX LUNCH</option>
                                                                        <option value="EJECUTIVO" @if($producto->tipo_producto=='EJECUTIVO') {{'selected'}} @endif>EJECUTIVO</option>
                                                                        <option value="PRIMERA CLASE" @if($producto->tipo_producto=='PRIMERA CLASE') {{'selected'}} @endif>PRIMERA CLASE</option>
                                                                    </select>
                                                                @endif
                                                                @if($producto->grupo=='FLIGHTS')
                                                                    <select class="form-control" id="txt_type_0" name="txt_type_0">
                                                                        <option value="NATIONAL" @if($producto->tipo_producto=='NATIONAL') {{'selected'}} @endif>NATIONAL</option>
                                                                        <option value="INTERNATIONAL" @if($producto->tipo_producto=='INTERNATIONAL') {{'selected'}} @endif>INTERNATIONAL</option>
                                                                    </select>
                                                                @endif
                                                                @if($producto->grupo=='OTHERS')
                                                                    <input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type" value="{{$producto->tipo_producto}}">
                                                                @endif

                                                            </div>
                                                        </div>
                                                        @if($producto->grupo=='HOTELS')
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_type">Accommodation</label>
                                                                    {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                                    <select class="form-control" id="txt_acomodacion_0" name="txt_acomodacion_0">
                                                                        <option value="S" @if($producto->acomodacion=='S') {{'selected'}} @endif>SIMPLE</option>
                                                                        <option value="D" @if($producto->acomodacion=='D') {{'selected'}} @endif>DOBLE</option>
                                                                        <option value="M" @if($producto->acomodacion=='M') {{'selected'}} @endif>MATRIMONIAL</option>
                                                                        <option value="T" @if($producto->acomodacion=='T') {{'selected'}} @endif>TRIPLE</option>
                                                                        <option value="SS" @if($producto->acomodacion=="SS")  {{'selected'}} @endif>SUPERIOR SIMPLE</option>
                                                                        <option value="SD" @if($producto->acomodacion=="SD")  {{'selected'}} @endif>SUPERIOR DOBLE</option>
                                                                        <option value="SU" @if($producto->acomodacion=="SU")  {{'selected'}} @endif>SUITE</option>
                                                                        <option value="JS" @if($producto->acomodacion=="JR")  {{'selected'}} @endif>JR. SUITE</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <div class="col-md-4">
                                                            <div class="form-group col-md-9">
                                                                <label for="txt_precio">Provider</label>
                                                                <input type="text" class="form-control" id="e_txt_provider_{{$pos0}}" name="txt_provider_0" placeholder="Provider" value="{{$proveedor->codigo.' '.$proveedor->razon_social}}">
                                                            </div>
                                                            <div class="col-md-3 margin-top-25 ">
                                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_new_provider" onclick="pasar_pos_provider('0')">
                                                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_product">Product</label>
                                                                <input type="text" class="form-control" id="e_txt_product_{{$pos0}}" name="txt_product_0" placeholder="Product" value="{{$producto->codigo.' '.$producto->nombre}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 hide">
                                                            <div class="form-group">
                                                                <label for="txt_code">Code product</label>
                                                                <input type="text" class="form-control" id="txt_code_0" name="txt_code_0" placeholder="Code product" value="{{$producto->codigo}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_price">Price</label>
                                                                <input type="text" class="form-control" id="txt_price_0" name="txt_price_0" placeholder="Price" value="{{$producto->precio_costo}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 hide">
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
                                              </div>
                                        </div>
                                        <div class="modal-footer">
                                            {{csrf_field()}}
                                            <input type="hidden" name="posTipoEditcost_{{$producto->id}}" id="posTipoEditcost_{{$producto->id}}" value="{{$pos0}}">
                                            <input type="hidden" name="id" id="id" value="{{$producto->id}}">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                        $pos0++;
                        ?>
                @endforeach
            @endforeach

            <input type="hidden" id="localizacion1_0" name="localizacion1_0" value="CUSCO">
            <input type="hidden" id="localizacion1_1" name="localizacion1_1" value="CUSCO">
            <input type="hidden" id="localizacion1_2" name="localizacion1_2" value="CUSCO">
            <input type="hidden" id="localizacion1_3" name="localizacion1_3" value="CUSCO">
            <input type="hidden" id="localizacion1_4" name="localizacion1_4" value="CUSCO">
            <input type="hidden" id="localizacion1_5" name="localizacion1_5" value="CUSCO">
            <input type="hidden" id="localizacion1_6" name="localizacion1_6" value="CUSCO">
            <input type="hidden" id="localizacion1_7" name="localizacion1_7" value="CUSCO">
            <input type="hidden" id="localizacion1_8" name="localizacion1_8" value="CUSCO">
            <?php
            $pos0=0;
            ?>

            @foreach($productos as $proveedor)
                @foreach($proveedor->productos  as $producto)
                    <input type="hidden" id="e_localizacion_{{$pos0}}" value="CUSCO">
                    <?php
                    $pos0++;
                    ?>
                @endforeach
            @endforeach
        </div>
    </div>

    <script>
        $(document).ready(function() {
            <?php
                $i=0;
            ?>
            @foreach($tipoServicio as $tipoServicio_)
            $("select[id=txt_localizacion_{{$i}}]").change(function(){
                $('#localizacion1_{{$i}}').val($('select[id=txt_localizacion_{{$i}}]').val());
            });

            <?php
                $i++;
            ?>
            {{--$('#tb_{{$tipoServicio_}}').DataTable();--}}
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



        } );
        $(function () {
            <?php
                $i=0;
            ?>
        @foreach($tipoServicio as $tipoServicio_)
            $('#txt_provider_{{$i}}').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "buscar-proveedor",
                        dataType: "json",
                        data: {
                            term : request.term,
                            localizacion : $("#localizacion1_{{$i}}").val(),
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
            $('#e_txt_provider_{{$pos10}}').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "buscar-proveedor",
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
                            localizacion : $("#localizacion1_{{$i}}").val(),
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