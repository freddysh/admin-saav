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
            <li class="breadcrumb-item">Database</li>
            <li class="breadcrumb-item active">Products</li>
        </ol>
    </nav>
    <hr>
    <div class="row mt-3">
        <div class="col">
        <form action="{{route('service_save_path')}}" method="post" id="service_save_id" enctype="multipart/form-data">

            <ul class="nav nav-tabs nav-justified">
                <?php
                $pos=0;
                ?>
                @foreach($categorias as $categoria)
                    <?php
                    $active='';
                    $tipoServicio[]=$categoria->nombre;
                    if($pos==0){
                        $active='active';
                    }
                    ?>
                    <li class="nav-item active">
                        <a data-toggle="tab" href="#{{$categoria->nombre}}" class="nav-link show {{$active}} rounded-0" onclick="escojerPos('{{$pos}}','{{$categoria->nombre}}')">{{$categoria->nombre}}</a>
                    </li>

                    <?php
                    $pos++;
                    ?>
                @endforeach
            </ul>
            <div class="tab-content mt-3">
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
                    <div id="{{$categoria->nombre}}" class="tab-pane fade show {{$activo}}">
                        <div class="row margin-top-10">
                            <div class="@if($categoria->nombre!='HOTELS') {{'col-lg-5'}} @else {{'col-lg-12'}} @endif  d-flex">
                                <div class="card p-2 w-100">
                                    <div class="row">
                                            @if($categoria->nombre!='HOTELS')
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="txt_codigo" class="text-secondary font-weight-bold">Codigo</label>
                                                                <?php
                                                                $auto=concatenar(substr($categoria->nombre,0,3),strval(1));
                                                                if(count($servicios->where('grupo',$categoria->nombre))>0)
                                                                    $auto=concatenar(substr($categoria->nombre,0,3),strval(count($servicios->where('grupo',$categoria->nombre))+1));
                                                                ?>
                                                                <input type="text" class="form-control" id="txt_codigo" name="txt_codigo_{{$pos}}" value="{{$auto}}" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($categoria->nombre!='TRAINS')
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        @if($categoria->nombre=='MOVILID')
                                                            <label for="txt_codigo" class="text-secondary font-weight-bold">Origen(Punto de inicio)</label>
                                                            <select class="form-control" id="txt_localizacion_{{$pos}}" name="txt_localizacion_{{$pos}}" onchange="nuevos_proveedores_movilidad_ruta('{{$pos}}','{{$categoria->id}}','{{$categoria->nombre}}')">
                                                                @foreach($destinations as $destination)
                                                                    <option value="{{$destination->destino}}">{{$destination->destino}}</option>
                                                                @endforeach
                                                            </select>
                                                        @else
                                                            <label for="txt_codigo" class="text-secondary font-weight-bold">Origen</label>
                                                            <select class="form-control" id="txt_localizacion_{{$pos}}" name="txt_localizacion_{{$pos}}" onchange="nuevos_proveedores('{{$pos}}','{{$categoria->id}}','{{$categoria->nombre}}')">
                                                                @foreach($destinations as $destination)
                                                                    <option value="{{$destination->destino}}">{{$destination->destino}}</option>
                                                                @endforeach
                                                            </select>
                                                        @endif
                                                        {{--<input type="text" class="form-control" id="txt_localizacion_0" name="txt_localizacion_0" placeholder="Location">--}}

                                                        <input type="hidden" name="tipoServicio_{{$pos}}" id="tipoServicio_{{$pos}}" value="{{$categoria->nombre}}">
                                                    </div>
                                                </div>
                                            @endif
                                            @if($categoria->nombre=='TRAINS')
                                                @php
                                                    $array_pro='';
                                                @endphp
                                                @foreach($proveedores->where('grupo','TRAINS') as $provider)
                                                    @php
                                                        $array_pro.=$provider->id.'_';
                                                    @endphp
                                                @endforeach
                                                @php
                                                    $array_pro=$array_pro.substr(0,strlen($array_pro)-1);
                                                @endphp
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="txt_codigo" class="text-secondary font-weight-bold">Origen(Punto de inicio)</label>
                                                        <select class="form-control" id="txt_localizacion_{{$pos}}" name="txt_localizacion_{{$pos}}" onchange="nuevos_proveedores_trains_ruta('{{$pos}}','{{$categoria->id}}','{{$categoria->nombre}}')">
                                                            @foreach($destinations as $destination)
                                                                <option value="{{$destination->destino}}">{{$destination->destino}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="txt_codigo" class="text-secondary font-weight-bold">Empresa</label>
                                                        {{--<input type="text" class="form-control" id="txt_localizacion_0" name="txt_localizacion_0" placeholder="Location">--}}
                                                        <select class="form-control" id="txt_provider_{{$pos}}" name="txt_provider_{{$pos}}" onchange="mostrar_class($('#txt_provider_{{$pos}}').val(),'{{$array_pro}}','{{$categoria->id}}','0',{{$pos}})">
                                                            <option value="0">Escoja una empresa</option>
                                                            @foreach($proveedores->where('grupo','TRAINS') as $provider)
                                                                <option value="{{$provider->id}}_{{$provider->nombre_comercial}}">{{$provider->nombre_comercial}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="txt_codigo" class="text-secondary font-weight-bold">Class</label>
                                                        <div id="mostrar_clase">
                                                            <select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
                                                                <option value="0">Escoja una clase</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($categoria->nombre=='MOVILID')
                                                <div class="col-6">
                                                    <label for="txt_type" class="font-weight-bold text-secondary">Clase</label>
                                                    <select class="form-control" id="txt_clase_{{$pos}}" name="txt_clase_{{$pos}}">
                                                        <option value="DEFAULT">DEFAULT</option>
                                                        <option value="BOLETO">BOLETO</option>
                                                    </select>
                                                </div>
                                            @endif
                                            @if($categoria->nombre=='ENTRANCES')
                                                <div class="col-6">
                                                    <label for="txt_type" class="font-weight-bold text-secondary">Clase</label>
                                                    <select class="form-control" id="txt_clase_{{$pos}}" name="txt_clase_{{$pos}}">
                                                        <option value="OTROS">OTROS</option>
                                                        <option value="BTG">BOLETO TURISTICO</option>
                                                        <option value="CAT">CATEDRAL</option>
                                                        <option value="KORI">KORICANCHA</option>
                                                        <option value="MAPI">MACHUPICCHU</option>
                                                    </select>
                                                </div>
                                            @endif
                                            @if($categoria->nombre=='HOTELS')
                                                <div class=" col-md-12">
                                                    <table class="table table-responsive table-striped table-condensed">
                                                        <thead>
                                                        <tr>
                                                            <th class="w-20 text-primary">ACOMODATION</th>
                                                            <th class="w-20 text-warning text-center text-15">2 <i class="fa fa-star-half-o fa-2x" aria-hidden="true"></i></th>
                                                            <th class="w-20 text-warning text-center text-15">3 <i class="fa fa-star-half-o fa-2x" aria-hidden="true"></i></th>
                                                            <th class="w-20 text-warning text-center text-15">4 <i class="fa fa-star-half-o fa-2x" aria-hidden="true"></i></th>
                                                            <th class="w-20 text-warning text-center text-15">5 <i class="fa fa-star-half-o fa-2x" aria-hidden="true"></i></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>SIMGLE</td>
                                                            <td><input type="number" name="S_2" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="S_3" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="S_4" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="S_5" class="form-control" min="0" step="0.01" value="0"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>DOUBLE</td>
                                                            <td><input type="number" name="D_2" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="D_3" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="D_4" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="D_5" class="form-control" min="0" step="0.01" value="0"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>MATRIMONIAL</td>
                                                            <td><input type="number" name="M_2" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="M_3" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="M_4" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="M_5" class="form-control" min="0" step="0.01" value="0"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>TRIPLE</td>
                                                            <td><input type="number" name="T_2" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="T_3" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="T_4" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="T_5" class="form-control" min="0" step="0.01" value="0"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>SUPERIOR SIMPLE</td>
                                                            <td><input type="number" name="SS_2" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="SS_3" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="SS_4" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="SS_5" class="form-control" min="0" step="0.01" value="0"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>SUPERIOR DOUBLE</td>
                                                            <td><input type="number" name="SD_2" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="SD_3" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="SD_4" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="SD_5" class="form-control" min="0" step="0.01" value="0"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>SUITE</td>
                                                            <td><input type="number" name="SU_2" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="SU_3" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="SU_4" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="SU_5" class="form-control" min="0" step="0.01" value="0"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>JR. SUITE</td>
                                                            <td><input type="number" name="JS_2" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="JS_3" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="JS_4" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="JS_5" class="form-control" min="0" step="0.01" value="0"></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endif
                                            @if($categoria->nombre=='TOURS')
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="txt_type" class="font-weight-bold text-secondary">Type</label>
                                                        <select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
                                                            <option value="SIC">COMPARTIDO</option>
                                                            <option value="PV">PRIVADO</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($categoria->nombre=='MOVILID')
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="txt_type" class="font-weight-bold text-secondary">Type</label>
                                                        <select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
                                                            <option value="AUTO">AUTO</option>
                                                            <option value="SUV">SUV</option>
                                                            <option value="VAN">VAN</option>
                                                            <option value="H1">H1</option>
                                                            <option value="SPRINTER">SPRINTER</option>
                                                            <option value="BUS">BUS</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif

                                            @if($categoria->nombre=='REPRESENT')
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="txt_type" class="font-weight-bold text-secondary">Type</label>
                                                        <select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
                                                            <option value="GUIDE">GUIDE</option>
                                                            <option value="TRANSFER">TRANSFER</option>
                                                            <option value="ASSISTANCE">ASSISTANCE</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($categoria->nombre=='ENTRANCES')
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="txt_type" class="font-weight-bold text-secondary">Type</label>
                                                        <select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
                                                            <option value="EXTRANJERO">EXTRANJERO</option>
                                                            <option value="NATIONAL">NATIONAL</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($categoria->nombre=='FOOD')
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="txt_type" class="font-weight-bold text-secondary">Type</label>
                                                        <select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
                                                            <option value="LUNCH">LUNCH</option>
                                                            <option value="DINNER">DINNER</option>
                                                            <option value="BOX LUNCH">BOX LUNCH</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif

                                            @if($categoria->nombre=='FLIGHTS')
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="txt_type" class="font-weight-bold text-secondary">Type</label>
                                                        <select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
                                                            <option value="NATIONAL">NATIONAL</option>
                                                            <option value="INTERNATIONAL">INTERNATIONAL</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($categoria->nombre=='OTHERS')
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="txt_type" class="font-weight-bold text-secondary">Type</label>
                                                        <input type="text" class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}" placeholder="Type">
                                                    </div>
                                                </div>
                                            @endif

                                            @if($categoria->nombre=='TRAINS')
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="txt_product" class="font-weight-bold text-secondary">Tren</label>
                                                        <input type="text" class="form-control" id="txt_product_{{$pos}}" name="txt_product_{{$pos}}" placeholder="Product">
                                                    </div>
                                                </div>
                                                @elseif($categoria->nombre=='FLIGHTS')
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="txt_product" class="font-weight-bold text-secondary">Vuelo</label>
                                                        <input type="text" class="form-control" id="txt_product_{{$pos}}" name="txt_product_{{$pos}}" placeholder="Product">
                                                    </div>
                                                </div>
                                                @elseif($categoria->nombre!='HOTELS')
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="txt_product" class="font-weight-bold text-secondary">Product</label>
                                                        <input type="text" class="form-control" id="txt_product_{{$pos}}" name="txt_product_{{$pos}}" placeholder="Product">
                                                    </div>
                                                </div>
                                            @endif


                                            <div class="col-md-4 d-none">
                                                <div class="form-group">
                                                    <label for="txt_code" class="font-weight-bold text-secondary">Code product</label>
                                                    <input type="text" class="form-control" id="txt_code_{{$pos}}" name="txt_code_{{$pos}}" placeholder="Code product">
                                                </div>
                                            </div>

                                            @if($categoria->nombre=='MOVILID')
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        {{--<input type="text" class="form-control" id="txt_ruta_salida_{{$pos}}" name="txt_ruta_salida_{{$pos}}" placeholder="ruta de salida">--}}
                                                        <div id="rutas_{{$pos}}">
                                                            <label for="txt_price" class="font-weight-bold text-secondary">Ruta</label>
                                                            <select class="form-control" id="txt_ruta_salida_{{$pos}}" name="txt_ruta_salida_{{$pos}}" required="required">
                                                                <option value="ESCOJA UNA RUTA-ESCOJA UNA RUTA">ESCOJA UNA RUTA</option>
                                                                <option value="CUSCO-AIRPORT">CUSCO-AIRPORT</option>
                                                                <option value="CUSCO-OLLANTA">CUSCO-OLLANTA</option>
                                                                <option value="CUSCO-POROY">CUSCO-POROY</option>
                                                                <option value="CUSCO-VALLE">CUSCO-VALLE</option>
                                                                <option value="CUSCO-URUBAMBA">CUSCO-URUBAMBA</option>
                                                                <option value="AIRPORT-CUSCO">AIRPORT-CUSCO</option>
                                                                <option value="POROY-CUSCO">POROY-CUSCO</option>
                                                                <option value="TOUR-TOUR">TOUR</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endif
                                            @if($categoria->nombre=='TRAINS'||$categoria->nombre=='FLIGHTS')
                                                <div class="col-6">
                                                    <div class="form-group" id="ruta_salida_{{$pos}}">
                                                        <label for="txt_price" class="font-weight-bold text-secondary">Ruta de salida</label>
                                                        {{--<input type="text" class="form-control" id="txt_ruta_salida_{{$pos}}" name="txt_ruta_salida_{{$pos}}" placeholder="ruta de salida">--}}
                                                        <select class="form-control" id="txt_ruta_salida_{{$pos}}" name="txt_ruta_salida_{{$pos}}">
                                                            <option value="POROY">POROY</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="txt_price" class="font-weight-bold text-secondary">Hora</label>
                                                        <input type="text" class="form-control" id="txt_salida_{{$pos}}" name="txt_salida_{{$pos}}" placeholder="06:30">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group" id="ruta_llegada_{{$pos}}">
                                                        <label for="txt_price" class="font-weight-bold text-secondary">Ruta de llegada</label>
                                                        {{--<input type="text" class="form-control" id="txt_ruta_salida_{{$pos}}" name="txt_ruta_salida_{{$pos}}" placeholder="ruta de salida">--}}
                                                        <select class="form-control" id="txt_ruta_llegada_{{$pos}}" name="txt_ruta_llegada_{{$pos}}">
                                                            <option value="AGUAS CALIENTES">AGUAS CALIENTES</option>
                                                            <option value="OLLANTAYTAMBO">OLLANTAYTAMBO</option>
                                                        </select>
                                                        {{--<input type="text" class="form-control" id="txt_ruta_llegada_{{$pos}}" name="txt_ruta_llegada_{{$pos}}" placeholder="ruta de llegada">--}}
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="txt_price" class="font-weight-bold text-secondary">Hora</label>
                                                        <input type="text" class="form-control" id="txt_llegada_{{$pos}}" name="txt_llegada_{{$pos}}" placeholder="06:30">
                                                    </div>
                                                </div>
                                            @endif
                                            @if($categoria->nombre!='HOTELS')
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="txt_price" class="font-weight-bold text-secondary">Price</label>
                                                        <input type="number" class="form-control" id="txt_price_{{$pos}}" name="txt_price_{{$pos}}" placeholder="Price" min="0" step="0.1">
                                                    </div>
                                                </div>
                                            @endif
                                            @if($categoria->nombre=='MOVILID')
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="txt_price" class="font-weight-bold text-secondary">Min Personas</label>
                                                        <input type="number" class="form-control" id="txt_min_personas_{{$pos}}" name="txt_min_personas_{{$pos}}" placeholder="Min" min="0">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="txt_price" class="font-weight-bold text-secondary">Max Personas</label>
                                                        <input type="number" class="form-control" id="txt_max_personas_{{$pos}}" name="txt_max_personas_{{$pos}}" placeholder="Min" min="0">
                                                    </div>
                                                </div>
                                            @endif
                                            @if($categoria->nombre=='TOURS')
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            {{--<label for="txt_code" class="font-weight-bold text-secondary">Type price</label><br>--}}
                                                            <label class="text-danger">
                                                                <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Absoluto" checked="checked">
                                                                Precio es absoluto
                                                            </label>
                                                        </div>
                                                        <div class="col-6">
                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Type price </label><br>--}}
                                                            <label class="text-danger">
                                                                <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Individual">
                                                                Precio es individual
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($categoria->nombre=='MOVILID')
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Type price </label><br>--}}
                                                            <label class="text-danger">
                                                                <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Absoluto" checked="checked">
                                                                Precio es absoluto
                                                            </label>
                                                        </div>
                                                        <div class="col-6">
                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Type price </label><br>--}}
                                                            <label class="text-danger">
                                                                <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Individual">
                                                                Precio es individual
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($categoria->nombre=='REPRESENT')
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Type price </label><br>--}}
                                                            <label class="text-danger">
                                                                <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Absoluto" checked="checked">
                                                                Precio es absoluto
                                                            </label>
                                                        </div>
                                                        <div class="col-6 d-none">
                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Type price </label><br>--}}
                                                            <label class="text-danger">
                                                                <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Individual">
                                                                Precio es individual
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($categoria->nombre=='ENTRANCES')
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-6 d-none">
                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Type price </label><br>--}}
                                                            <label class="text-danger">
                                                                <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Absoluto" >
                                                                Precio es absoluto
                                                            </label>
                                                        </div>
                                                        <div class="col-6">
                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Type price </label><br>--}}
                                                            <label class="text-danger">
                                                                <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Individual" checked="checked">
                                                                Precio es individual
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($categoria->nombre=='FOOD')
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-6 d-none">
                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Type price </label><br>--}}
                                                            <label class="text-danger">
                                                                <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Absoluto" >
                                                                Precio es absoluto
                                                            </label>
                                                        </div>
                                                        <div class="col-6">
                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Type price </label><br>--}}
                                                            <label class="text-danger">
                                                                <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Individual" checked="checked">
                                                                Precio es individual
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($categoria->nombre=='TRAINS')
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-6 d-none">
                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Type price </label><br>--}}
                                                            <label class="text-danger">
                                                                <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Absoluto" >
                                                                Precio es absoluto
                                                            </label>
                                                        </div>
                                                        <div class="col-6">
                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Type price </label><br>--}}
                                                            <label class="text-danger">
                                                                <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Individual" checked="checked">
                                                                Precio es individual
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($categoria->nombre=='FLIGHTS')
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-6 d-none">
                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Type price </label><br>--}}
                                                            <label class="text-danger">
                                                                <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Absoluto" >
                                                                Precio es absoluto
                                                            </label>
                                                        </div>
                                                        <div class="col-6">
                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Type price </label><br>--}}
                                                            <label class="text-danger">
                                                                <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Individual" checked="checked">
                                                                Precio es individual
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($categoria->nombre=='OTHERS')
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Type price </label><br>--}}
                                                            <label class="text-danger">
                                                                <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Absoluto" >
                                                                Precio es absoluto
                                                            </label>
                                                        </div>
                                                        <div class="col-6">
                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Type price </label><br>--}}
                                                            <label class="text-danger">
                                                                <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Individual" checked="checked">
                                                                Precio es individual
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                    </div>
                                </div>
                            </div>
                            <div class="@if($categoria->nombre!='HOTELS') {{'col-lg-7'}} @else {{'d-none'}} @endif ">
                                <div class="card p-2 w-100">
                                    <div class="row">
                                        <div class="col">
                                            <p><b class="text-g-green font-weight-bold">Proveedores</b></p>
                                        </div>
                                        <div class="col-1"></div>
                                        <div class="col">
                                            <p><b class="text-g-green">Proveedor/Costo</b></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div id="lista_proveedores_{{$pos}}_{{$categoria->id}}" class="col">
                                            @if($categoria->nombre!='TRAINS')
                                                @foreach($proveedores as $proveedor)
                                                    @php
                                                       $grupos_operado=$proveedor->grupos_operados->where('m_category_id',$categoria->id)->count();
                                                    @endphp
                                                    @if($grupos_operado>0)
                                                        <label class="text-primary display-block">
                                                            <input class="proveedores_{{$pos}}"  type="checkbox" aria-label="..." name="proveedores_[]" value="{{$proveedor->id}}_{{$proveedor->nombre_comercial}}">
                                                            {{strtoupper($proveedor->nombre_comercial)}}
                                                        </label>
                                                    @elseif($proveedor->grupo==$categoria->nombre)
                                                        <label class="text-primary display-block">
                                                            <input class="proveedores_{{$pos}}"  type="checkbox" aria-label="..." name="proveedores_[]" value="{{$proveedor->id}}_{{$proveedor->nombre_comercial}}">
                                                            {{strtoupper($proveedor->nombre_comercial)}}
                                                        </label>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="col-lg-1">
                                            <a href="#!" class="btn btn-primary sticky-top" onclick="Pasar_pro('0','{{$categoria->id}}',{{$pos}})">
                                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                        <div  class="col-lg">
                                            <div id="lista_costos_{{$categoria->id}}_0_{{$pos}}" class="sticky-top">
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <?php
                    $pos++;
                    ?>
                @endforeach
            </div>
            <div class="row pb-4">
                <div class="col text-right">
                    <div class="btn-save-fixed">
                        <input type="hidden" name="posTipo" id="posTipo" value="0">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
            {{csrf_field()}}
        </form>
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
                            $('#result_'+id).html('producto guardado Correctamente!');
                        if(grupo=='MOVILID')
                            $('#tipo_'+id).html(datox[0]+' ['+datox[1]+'-'+datox[2]+']');
                        else
                            $('#tipo_'+id).html(datox[0]);
                        if(grupo=='TRAINS')
                            $('#horario_'+id).html(datox[2]);
                        $('#precio_'+id).html(datox[3]);
                        $('#nombre_'+id).html(datox[4]);
                    }
                })
                return false;
            });
        }
    </script>
@stop