<table id="tb_{{$destino[0]}}_{{$destino[1]}}" class="{{$destino[1]}} table table-striped table-bordered table-sm mt-3"  width="100%" cellspacing="0">
    <thead>
    <tr>
        <th>Origen</th>
        <th>Codigo</th>
        @if($destino[1] == 'MOVILID')
            <th>Ruta</th>
        @endif
        <th>
            @if ($destino[1] == 'TRAINS')
              {{'Clase'}}
            @else
                {{'Tipo'}}
            @endif
        </th>
        <th>
            @if ($destino[1] == 'TRAINS')
                {{'Ruta'}}
            @else
                {{'Nombre'}}
            @endif
        </th>
        @if($destino[1] == 'TRAINS')
            <th>Horario</th>
        @endif
        <th>Precio</th>
        <th>Proveedores</th>
        <th class="text-center">Action</th>
    </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Origen</th>
            <th>Codigo</th>
                <th>
                @if ($destino[1] == 'TRAINS')
                {{'Clase'}}
                @else
                    {{'Tipo'}}
                @endif
                </th>
                <th>
                @if ($destino[1] == 'TRAINS')
                    {{'Ruta'}}
                @else
                    {{'Nombre'}}
                @endif
                </th>
            @if ($destino[1] == 'TRAINS')
                <th>Horario</th>
            @endif
            <th>Precio</th>
            <th>Proveedores</th>
            <th class="text-center">Action</th>
        </tr>
    </tfoot>
    <tbody>
    @php
        $pos = 0;
        $nro_proveedores=0;
    @endphp
    @if($filtro=='normal')
        @foreach ($sericios as $servicio)
            <tr class="{{$servicio->localizacion}}" id="lista_services_{{$servicio->id}}">
                <td class="text-g-green">{{ucwords(strtolower($servicio->localizacion))}}</td>
                <td class="text-g-green">{{$servicio->codigo}}</td>
                @if($destino[1] == 'MOVILID')
                <td class="text-g-green">{{ucwords(strtolower($servicio->ruta_salida))}}-{{ucwords(strtolower($servicio->ruta_llegada))}}
                @endif
                <td id="tipo_{{$servicio->id}}">{{ucwords(strtolower($servicio->tipoServicio))}}
                    @if ($destino[1] == 'MOVILID')
                    [{{$servicio->min_personas}} - {{$servicio->max_personas}}]
                    @endif
                </td>
                <td id="nombre_{{$servicio->id}}">{{ucwords(strtolower($servicio->nombre))}}</td>
                @if ($destino[1] == 'TRAINS')
                    <td id="horario_{{$servicio->id}}">{{$servicio->salida}} - {{$servicio->llegada}}</td>
                @endif
                <td id="precio_{{$servicio->id}}" class="text-right"><sup>$</sup>{{$servicio->precio_venta}}</td>
                <td>
                    @php
                    $nro_proveedores=0;
                        $nro_proveedores=$costos->where('grupo',$servicio->grupo)->where('localizacion',$servicio->localizacion)->where('tipo_producto',$servicio->tipoServicio)->where('clase',$servicio->clase)->where('nombre',$servicio->nombre)->count('proveedor_id');
                    @endphp
                    {{$nro_proveedores}} <i class="fas fa-users text-primary"></i>
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#modal_edit_producto{{$servicio->id}}">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <div class="modal fade bd-example-modal-lg" id="modal_edit_producto{{$servicio->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg-x" role="document">
                            <div class="modal-content">
                                <form id="frm_modal_edit_producto_{{$servicio->id}}" action="{{route('service_edit_path')}}" method="post">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Service</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row margin-top-10">
                                            <div class="col-5 d-flex">
                                                <div class="card p-2 text-left w-100">
                                                    <div class="row">

                                                        @if($destino[1]!='HOTELS')
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label for="txt_codigo" class="text-secondary font-weight-bold">Codigo</label>
                                                                            <input type="text" class="form-control" id="txt_codigo" name="txt_codigo" value="{{$servicio->codigo}}" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        {{--@if($destino[1]!='TRAINS')--}}
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    @if($destino[1]=='MOVILID')
                                                                        <label for="txt_codigo" class="text-secondary font-weight-bold">Origen</label>
                                                                        <select class="form-control" id="txt_localizacion_{{$servicio->id}}" name="txt_localizacion_{{$servicio->id}}" onchange="nuevos_proveedores_movilidad_ruta_edit('{{$servicio->id}}','{{$destino[0]}}','{{$destino[1]}}')">
                                                                            @foreach ($destinations as $destination)
                                                                                <option value="{{$destination->destino}}"
                                                                                @if ($servicio->localizacion == $destination->destino)
                                                                                    {{'selected'}}
                                                                                        @endif
                                                                                >{{$destination->destino}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    @else
                                                                        <label for="txt_codigo" class="font-weight-bold text-secondary">Origen</label>
                                                                        <select class="form-control" id="txt_localizacion_{{$servicio->id}}" name="txt_localizacion_{{$servicio->id}}"  onchange="nuevos_proveedores('{{$servicio->id}}','{{$destino[0]}}','{{$destino[1]}}')">
                                                                            @foreach ($destinations as $destination)
                                                                                <option value="{{$destination->destino}}"
                                                                                @if ($servicio->localizacion == $destination->destino)
                                                                                    {{'selected'}}
                                                                                        @endif
                                                                                >{{$destination->destino}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    @endif

                                                                    <input type="hidden" name="tipoServicio_{{$servicio->id}}" id="tipoServicio_{{$servicio->id}}" value="{{$destino[1]}}">
                                                                </div>
                                                            </div>
                                                        {{--@endif--}}
                                                        @if($destino[1]=='TRAINS')
                                                            @php
                                                                $array_pro = '';
                                                                $proveedor_id1=0;
                                                            @endphp
                                                            @if($destino[1] == 'TRAINS')
                                                                @foreach($proveedores->where('grupo', 'TRAINS') as $provider)
                                                                    @php
                                                                        $array_pro .= $provider->id . '_';
                                                                    @endphp
                                                                    @foreach($provider->clases->where('clase',$servicio->tipoServicio) as $clase)
                                                                        @php
                                                                            $proveedor_id1=$provider->id;
                                                                        @endphp
                                                                    @endforeach
                                                                @endforeach
                                                                @php
                                                                    $array_pro = $array_pro . substr(0, strlen($array_pro) - 1);
                                                                @endphp
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label for="txt_codigo" class="text-secondary font-weight-bold">Empresa</label>
                                                                        <select class="form-control" id="txt_provider_{{$servicio->id}}" name="txt_provider_{{$servicio->id}}" onchange="mostrar_class($('#txt_provider_{{$servicio->id}}').val(),'{{$array_pro}}','{{$destino[1]}}','{{$id}}','{{$servicio->id}}')">
                                                                            <option value="0">Escoja una empresa</option>';
                                                                            @foreach ($proveedores->where('grupo', 'TRAINS') as $provider)
                                                                                <option value="{{$provider->id}}_{{$provider->nombre_comercial}}"
                                                                                @if($proveedor_id1==$provider->id)
                                                                                    {{' selected '}}
                                                                                @endif
                                                                                >{{$provider->nombre_comercial}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @php
                                                                $vision = 0;
                                                            @endphp
                                                            @foreach ($proveedores->where('grupo', 'TRAINS') as $provider)
                                                                @php
                                                                    $vision++;
                                                                @endphp
                                                                <div id="proveedor_{{$provider->id}}_{{$servicio->id}}" class="col-6
                                                                    @if($proveedor_id1!=$provider->id)
                                                                    {{' d-none'}}
                                                                    @endif
                                                                        ">
                                                                    <div class="form-group">
                                                                        <label for="txt_codigo" >Class</label>
                                                                        <select class="form-control" id="txt_class_{{$servicio->id}}" name = "txt_class_{{$servicio->id}}_{{$provider->id}}">
                                                                            @foreach ($provider->clases->where('estado', '1') as $provider_clases)
                                                                                <option value="{{$provider_clases->clase}}"
                                                                                @if($servicio->tipoServicio==$provider_clases->clase)
                                                                                    {{' selected '}}
                                                                                        @endif
                                                                                >{{$provider_clases->clase}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                        @if($destino[1] == 'ENTRANCES')
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="txt_type" class="text-secondary font-weight-bold"> Clase</label >

                                                                    <select class="form-control" id = "txt_clase_{{$servicio->id}}" name = "txt_clase_{{$servicio->id}}">
                                                                        <option value = "OTROS"
                                                                        @if ($servicio->clase == "OTROS")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >OTROS </option >
                                                                        <option value = "BTG"

                                                                        @if ($servicio->clase == "BTG")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >BOLETO TURISTICO</option>
                                                                        <option value = "CAT"
                                                                        @if ($servicio->clase == "CAT")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >CATEDRAL</option>
                                                                        <option value = "KORI"
                                                                        @if ($servicio->clase == "KORI")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >KORICANCHA</option>
                                                                        <option value = "MAPI"
                                                                        @if ($servicio->clase == "MAPI")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >MACHUPICCHU</option >
                                                                    </select >
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($destino[1] == 'MOVILID')
                                                            <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label for="txt_type" class="text-secondary font-weight-bold"> Clase</label >
                                                                        <select class="form-control" id = "txt_clase_{{$servicio->id}}" name = "txt_clase_{{$servicio->id}}">
                                                                            <option value = "DEFAULT"
                                                                            @if ($servicio->clase == "DEFAULT")
                                                                                {{'selected'}}
                                                                                    @endif
                                                                            >DEFAULT </option >
                                                                            <option value = "BOLETO"
                                                                            @if ($servicio->clase == "BOLETO")
                                                                                {{'selected'}}
                                                                                    @endif
                                                                            >BOLETO</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                        @endif
                                                        @if ($destino[1] == 'TOURS')
                                                            <div class="col-6">
                                                                <div class="form-group"><label for="txt_type" class="text-secondary font-weight-bold"> Type</label >
                                                                    <select class="form-control" id = "txt_type_{{$servicio->id}}" name = "txt_type_{{$servicio->id}}" >
                                                                        <option value = "SIC"
                                                                        @if ($servicio->tipoServicio == "COMPARTIDO")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >COMPARTIDO </option >
                                                                        <option value = "PV"
                                                                        @if ($servicio->tipoServicio == "PRIVADO")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >PRIVADO</option >
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($servicio->grupo == 'MOVILID')
                                                            <div class="col-6">
                                                                <div class="form-group"><label for="txt_type" class="text-secondary font-weight-bold"> Type</label >
                                                                    <select class="form-control" id = "txt_type_{{$servicio->id}}" name = "txt_type_{{$servicio->id}}" >
                                                                        <option value = "AUTO"
                                                                        @if ($servicio->tipoServicio == "AUTO")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >AUTO </option >
                                                                        <option value = "SUV"
                                                                        @if ($servicio->tipoServicio == "SUV")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >SUV </option >
                                                                        <option value = "VAN"
                                                                        @if ($servicio->tipoServicio == "VAN")
                                                                            {{'selected'}}
                                                                        @endif
                                                                        >VAN </option >
                                                                        <option value = "H1"
                                                                        @if ($servicio->tipoServicio == "H1")
                                                                            {{'selected '}}
                                                                                @endif
                                                                        >H1 </option >
                                                                        <option value = "SPRINTER"
                                                                        @if ($servicio->tipoServicio == "SPRINTER")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >SPRINTER </option >
                                                                        <option value = "BUS"
                                                                        @if ($servicio->tipoServicio == "BUS")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >BUS </option >
                                                                    </select >
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($servicio->grupo == 'REPRESENT')
                                                            <div class="col-6">
                                                                <div class="form-group"><label for="txt_type" class="text-secondary font-weight-bold"> Type</label >

                                                                    <select class="form-control" id = "txt_type_{{$servicio->id}}" name = "txt_type_{{$servicio->id}}" >
                                                                        <option value = "GUIDE"
                                                                        @if ($servicio->tipoServicio == "GUIDE") {{'selected'}}@endif
                                                                        >GUIDE </option >
                                                                        <option value = "TRANSFER"
                                                                        @if ($servicio->tipoServicio == "TRANSFER") {{'selected'}}@endif
                                                                        >TRANSFER </option >
                                                                        <option value = "ASSISTANCE"
                                                                        @if ($servicio->tipoServicio == "ASSISTANCE") {{'selected'}}@endif
                                                                        >ASSISTANCE </option >
                                                                    </select >
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($servicio->grupo == 'ENTRANCES')
                                                            <div class="col-6">
                                                                <div class="form-group"><label for="txt_type" class="text-secondary font-weight-bold"> Type</label >

                                                                    <select class="form-control" id = "txt_type_{{$servicio->id}}" name = "txt_type_{{$servicio->id}}" >
                                                                        <option value = "EXTRANJERO"
                                                                        @if ($servicio->tipoServicio == "EXTRANJERO") {{'selected '}}@endif
                                                                        >EXTRANJERO </option >
                                                                        <option value = "NATIONAL"
                                                                        @if ($servicio->tipoServicio == "NATIONAL") {{'selected '}}@endif
                                                                        >NATIONAL </option >
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($servicio->grupo == 'FOOD')
                                                            <div class="col-6">
                                                                <div class="form-group"><label for="txt_type" class="text-secondary font-weight-bold"> Type</label >

                                                                    <select class="form-control" id = "txt_type_{{$servicio->id}}" name = "txt_type_{{$servicio->id}}" >
                                                                        <option value = "LUNCH"
                                                                        @if ($servicio->tipoServicio == "LUNCH") {{'selected'}}@endif
                                                                        >LUNCH </option >
                                                                        <option value = "DINNER"
                                                                        @if ($servicio->tipoServicio == "DINNDER") {{'selected'}}@endif
                                                                        >DINNER </option >
                                                                        <option value = "BOX LUNCH"
                                                                        @if ($servicio->tipoServicio == "BOX LUNCH") {{'selected'}}@endif
                                                                        >BOX LUNCH </option >
                                                                    </select >
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if($servicio->grupo == 'FLIGHTS')
                                                            <div class="col-6">

                                                                <div class="form-group"><label for="txt_type">Type</label>
                                                                    <select class="form-control" id="txt_type_{{$servicio->id}}" name="txt_type_{{$servicio->id}}">
                                                                        <option value="NATIONAL"
                                                                        @if ($servicio->tipoServicio == "NATIONAL") {{'selected'}}@endif
                                                                        >NATIONAL</option>
                                                                        <option value="INTERNATIONAL"
                                                                        @if ($servicio->tipoServicio == "INTERNATIONAL") {{'selected'}}@endif
                                                                        >INTERNATIONAL</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($servicio->grupo == 'OTHERS')
                                                            <div class="col-6">

                                                                <div class="form-group"><label for="txt_type">Type</label>
                                                                    <input type="text" class="form-control" id="txt_type_{{$servicio->id}}" name="txt_type_{{$servicio->id}}" placeholder="Type" value="{{$servicio->tipoServicio}}">
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                @if ($servicio->grupo == 'TRAINS')
                                                                    <label for="txt_product" class="text-secondary font-weight-bold">Tren</label>
                                                                @elseif($servicio->grupo == 'FLIGHTS')
                                                                    <label for="txt_product" class="text-secondary font-weight-bold">Ruta</label>
                                                                @else
                                                                    <label for="txt_product" class="text-secondary font-weight-bold">Product</label>

                                                                @endif
                                                                <input type="text" class="form-control" id="txt_product_{{$servicio->id}}" name="txt_product_{{$servicio->id}}" placeholder="Product" value="{{$servicio->nombre}}">
                                                            </div>
                                                        </div>
                                                        @if($destino[1]=='MOVILID')
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <div id="rutas_{{$servicio->id}}">
                                                                        <label for="txt_price" class="font-weight-bold text-secondary">Ruta</label>

                                                                        <select class="form-control" id="txt_ruta_salida_{{$servicio->id}}" name="txt_ruta_salida_{{$servicio->id}}" required="required">
                                                                            <option value="ESCOJA UNA RUTA-ESCOJA UNA RUTA">ESCOJA UNA RUTA</option>
                                                                            @if($servicio->ruta_salida=='CUSCO'&&$servicio->ruta_llegada=='AIRPORT')
                                                                                <option value="CUSCO-AIRPORT" selected>CUSCO-AIRPORT</option>
                                                                            @else
                                                                                <option value="CUSCO-AIRPORT">CUSCO-AIRPORT</option>
                                                                            @endif
                                                                            @if($servicio->ruta_salida=='CUSCO'&&$servicio->ruta_llegada=='OLLANTA')
                                                                                <option value="CUSCO-OLLANTA" selected>CUSCO-OLLANTA</option>
                                                                            @else
                                                                                <option value="CUSCO-OLLANTA">CUSCO-OLLANTA</option>
                                                                            @endif
                                                                            @if($servicio->ruta_salida=='CUSCO'&&$servicio->ruta_llegada=='POROY')
                                                                                <option value="CUSCO-POROY" selected>CUSCO-POROY</option>
                                                                            @else
                                                                                <option value="CUSCO-POROY">CUSCO-POROY</option>
                                                                            @endif
                                                                            @if($servicio->ruta_salida=='CUSCO'&&$servicio->ruta_llegada=='STATION')
                                                                                <option value="CUSCO-STATION" selected>CUSCO-STATION</option>
                                                                            @else
                                                                                <option value="CUSCO-STATION">CUSCO-STATION</option>
                                                                            @endif
                                                                            @if($servicio->ruta_salida=='CUSCO'&&$servicio->ruta_llegada=='VALLE')
                                                                                <option value="CUSCO-VALLE" selected>CUSCO-VALLE</option>
                                                                            @else
                                                                                <option value="CUSCO-VALLE">CUSCO-VALLE</option>
                                                                            @endif
                                                                            @if($servicio->ruta_salida=='AIRPORT'&&$servicio->ruta_llegada=='CUSCO')
                                                                                <option value="AIRPORT-CUSCO" selected>AIRPORT-CUSCO</option>
                                                                            @else
                                                                                <option value="AIRPORT-CUSCO">AIRPORT-CUSCO</option>
                                                                            @endif
                                                                            @if($servicio->ruta_salida=='POROY'&&$servicio->ruta_llegada=='CUSCO')
                                                                                <option value="POROY-CUSCO" selected>POROY-CUSCO</option>
                                                                            @else
                                                                                <option value="POROY-CUSCO">POROY-CUSCO</option>
                                                                            @endif
                                                                            @if($servicio->ruta_salida=='STATION'&&$servicio->ruta_llegada=='CUSCO')
                                                                                <option value="STATION-CUSCO" selected>STATION-CUSCO</option>
                                                                            @else
                                                                                <option value="STATION-CUSCO">STATION-CUSCO</option>
                                                                            @endif
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($servicio->grupo == 'TRAINS' || $servicio->grupo == 'FLIGHTS')
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="txt_price" class="font-weight-bold text-secondary">Ruta de salida</label>

                                                                    <select class="form-control" id="txt_ruta_salida_{{$servicio->id}}" name="txt_ruta_salida_{{$servicio->id}}">
                                                                        @if($servicio->ruta_salida=='POROY')
                                                                            <option value="POROY" selected>POROY</option>
                                                                        @else
                                                                            <option value="POROY">POROY</option>
                                                                        @endif
                                                                        @if($servicio->ruta_salida=='AGUAS CALIENTES')
                                                                            <option value="AGUAS CALIENTES" selected>AGUAS CALIENTES</option>
                                                                        @else
                                                                            <option value="AGUAS CALIENTES">AGUAS CALIENTES</option>
                                                                        @endif
                                                                        @if($servicio->ruta_salida=='OLLANTAYTAMBO')
                                                                            <option value="OLLANTAYTAMBO" selected>OLLANTAYTAMBO</option>
                                                                        @else
                                                                            <option value="OALLANTAYTAMBO">OLLANTAYTAMBO</option>
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="txt_price" class="font-weight-bold text-secondary"> Hora</label >
                                                                    <input type = "text" class="form-control" id = "txt_salida_{{$servicio->id}}" name = "txt_salida_{{$servicio->id}}" placeholder="06:30" value = "{{$servicio->salida}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="txt_price" class="font-weight-bold text-secondary">Ruta de llegada</label>

                                                                    <select class="form-control" id="txt_ruta_llegada_{{$servicio->id}}" name="txt_ruta_llegada_{{$servicio->id}}">
                                                                        @if($servicio->ruta_llegada=='POROY')
                                                                            <option value="POROY" selected>POROY</option>
                                                                        @else
                                                                            <option value="POROY">POROY</option>
                                                                        @endif
                                                                        @if($servicio->ruta_llegada=='AGUAS CALIENTES')
                                                                            <option value="AGUAS CALIENTES" selected>AGUAS CALIENTES</option>
                                                                        @else
                                                                            <option value="AGUAS CALIENTES">AGUAS CALIENTES</option>
                                                                        @endif
                                                                        @if($servicio->ruta_llegada=='OLLANTAYTAMBO')
                                                                            <option value="OLLANTAYTAMBO" selected>OLLANTAYTAMBO</option>
                                                                        @else
                                                                            <option value="OLLANTAYTAMBO">OLLANTAYTAMBO</option>
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-6" >
                                                                <div class="form-group" >
                                                                    <label for="txt_price" class="font-weight-bold text-secondary"> Hora</label>

                                                                    <input type = "text" class="form-control" id = "txt_llegada_{{$servicio->id}}" name = "txt_llegada_{{$servicio->id}}" placeholder="06:30"  value = "{{$servicio->llegada}}" >
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="txt_price" class="text-secondary font-weight-bold">Price</label>

                                                                <input type="number" class="form-control" id="txt_price_{{$servicio->id}}" name="txt_price_{{$servicio->id}}" placeholder="Price"  value="{{$servicio->precio_venta}}" min="0">
                                                            </div>
                                                        </div>
                                                        @if ($servicio->grupo == 'MOVILID')
                                                            <div class="col-6" >
                                                                <div class="form-group" >
                                                                    <label for="txt_price" class="text-secondary font-weight-bold"> Min Personas </label >
                                                                    <input type = "number" class="form-control" id = "txt_min_personas_{{$servicio->id}}" name = "txt_min_personas_{{$servicio->id}}" placeholder = "Min" min = "0" value = "{{$servicio->min_personas}}">
                                                                </div >
                                                            </div >
                                                            <div class="col-6" >
                                                                <div class="form-group" >
                                                                    <label for="txt_price" class="text-secondary font-weight-bold"> Max Personas </label >

                                                                    <input type = "number" class="form-control" id = "txt_max_personas_{{$servicio->id}}" name = "txt_max_personas_{{$servicio->id}}" placeholder = "Min" min = "0" value = "{{$servicio->max_personas}}" >
                                                                </div >
                                                            </div >
                                                        @endif
                                                        @if ($servicio->grupo == 'TOURS')
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    @if ($servicio->precio_grupo == 1)
                                                                        {{--<div class="col-12">--}}
                                                                            {{--<label for="txt_price" class="text-secondary font-weight-bold">Type price</label><br>--}}
                                                                        {{--</div>--}}
                                                                        <div class="col-6">
                                                                            <label class=" text-g-green" >

                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" checked = "checked" >
                                                                                Precio es absoluto
                                                                            </label >
                                                                        </div >

                                                                        <div class="col-6">
                                                                            {{--<label for="txt_price" class="text-secondary font-weight-bold">Tipe price</label><br>--}}
                                                                            <label class=" text-g-green" >

                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" >
                                                                                Precio es individual
                                                                            </label >
                                                                        </div >
                                                                    @else

                                                                        {{--<div class="col-6">--}}
                                                                            {{--<label for="txt_price" class="text-secondary font-weight-bold">Type price</label><br>--}}
                                                                        {{--</div>--}}
                                                                        <div class="col-6">
                                                                            {{--<label for="txt_price" class="text-secondary font-weight-bold">Tipe price</label><br>--}}
                                                                            <label class="text-danger" >

                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" >
                                                                                Precio es absoluto
                                                                            </label >
                                                                        </div >

                                                                        <div class="col-6">
                                                                            {{--<label for="txt_price" class="text-secondary font-weight-bold">Tipe price</label><br>--}}
                                                                            <label class="text-danger" >

                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" checked = "checked" >
                                                                                Precio es individual
                                                                            </label >
                                                                        </div >
                                                                    @endif
                                                                </div >
                                                            </div >
                                                        @endif
                                                        @if ($servicio->grupo == 'MOVILID')
                                                        <div class="col-12">
                                                            <div class="row">
                                                                @if ($servicio->precio_grupo == 1)
                                                                    <div class="col-6">
                                                                        <label class="text-danger">
                                                                            <input type="radio" name="txt_tipo_grupo_{{$servicio->id}}" value="Absoluto" checked="checked">
                                                                            Precio es absoluto
                                                                        </label>
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <label class="text-danger">

                                                                            <input type="radio" name="txt_tipo_grupo_{{$servicio->id}}" value="Individual">
                                                                            Precio es individual
                                                                        </label>
                                                                    </div>
                                                                @else

                                                                    <div class="col-6">
                                                                        <label class="text-danger">
                                                                            <input type="radio" name="txt_tipo_grupo_{{$servicio->id}}" value="Absoluto">
                                                                            Precio es absoluto
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <label class="text-danger">
                                                                            <input type="radio" name="txt_tipo_grupo_{{$servicio->id}}" value="Individual" checked="checked">
                                                                            Precio es individual
                                                                        </label>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if ($servicio->grupo == 'REPRESENT')
                                                        <div class="col-12">
                                                            <div class="row" >
                                                                @if ($servicio->precio_grupo == 1)
                                                                    <div class="col-6" >
                                                                        {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                        <label class="text-danger" >

                                                                            <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" checked = "checked" >
                                                                            Precio es absoluto
                                                                        </label >
                                                                    </div>

                                                                    <div class="col-6 d-none" >
                                                                        {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                        <label class="text-danger">

                                                                            <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" >
                                                                            Precio es individual
                                                                        </label >
                                                                    </div>
                                                                @else

                                                                    <div class="col-6" >
                                                                        {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                        <label class=" text-danger" >

                                                                            <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" >
                                                                            Precio es absoluto
                                                                        </label >
                                                                    </div >
                                                                    <div class="col-6" >
                                                                        {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                        <label class=" text-danger" >
                                                                            <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" checked = "checked" >
                                                                            Precio es individual
                                                                        </label >
                                                                    </div >
                                                                @endif
                                                            </div >
                                                        </div>
                                                        @endif
                                                        @if ($servicio->grupo == 'ENTRANCES')
                                                        <div class="col-12">
                                                            <div class="row" >
                                                                @if ($servicio->precio_grupo == 1)
                                                                    <div class="col-6" >
                                                                        {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                        <label class=" text-danger" >
                                                                            <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" checked = "checked" >
                                                                            Precio es absoluto
                                                                        </label >
                                                                    </div >
                                                                    <div class="col-6" >
                                                                        {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                        <label class=" text-danger" >
                                                                            <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" >
                                                                            Precio es individual
                                                                        </label >
                                                                    </div >
                                                                @else
                                                                    <div class="col-6 d-none" >
                                                                        {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                        <label class=" text-danger" >
                                                                            <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" >
                                                                            Precio es absoluto
                                                                        </label >
                                                                    </div >

                                                                    <div class="col-6" >
                                                                        {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                        <label class=" text-danger" >
                                                                            <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" checked = "checked" >
                                                                            Precio es individual
                                                                        </label >
                                                                    </div >
                                                                @endif
                                                            </div >
                                                        </div >
                                                        @endif
                                                        @if ($servicio->grupo == 'FOOD')
                                                            <div class="col-12" >
                                                                <div class="row" >
                                                                    @if ($servicio->precio_grupo == 1)
                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" checked = "checked" >
                                                                                Precio es absoluto
                                                                            </label >
                                                                        </div >
                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" >
                                                                                Precio es individual
                                                                            </label >
                                                                        </div >
                                                                    @else
                                                                        <div class="col-6 d-none" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" >
                                                                                Precio es absoluto
                                                                            </label >
                                                                        </div >
                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" checked = "checked" >
                                                                                Precio es individual
                                                                            </label >
                                                                        </div >
                                                                    @endif
                                                                </div >
                                                            </div >
                                                        @endif
                                                        @if ($servicio->grupo == 'TRAINS')
                                                            <div class="col-12">
                                                                <div class="row" >
                                                                    @if ($servicio->precio_grupo == 1)
                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" checked = "checked" >
                                                                                Precio es absoluto
                                                                            </label >
                                                                        </div>

                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger">
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" >
                                                                                Precio es individual
                                                                            </label>
                                                                        </div >
                                                                    @else

                                                                        <div class="col-md-6 d-none" >
                                                                            <label for="txt_price">Tipe price</label><br>
                                                                            <label class=" text-green-goto" ></label>
                                                                        </div>
                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger">

                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" checked = "checked" >
                                                                                Precio es individual
                                                                            </label >
                                                                        </div>
                                                                    @endif
                                                                </div >
                                                            </div >
                                                        @endif
                                                        @if ($servicio->grupo == 'FLIGHTS')

                                                            <div class="col-12" >
                                                                <div class="row" >
                                                                    @if ($servicio->precio_grupo == 1)
                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >

                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" checked = "checked" >
                                                                                Precio es absoluto
                                                                            </label >
                                                                        </div >
                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" >
                                                                                Precio es individual
                                                                            </label >
                                                                        </div >
                                                                    @else
                                                                        <div class="col-6 d-none" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" >
                                                                                Precio es absoluto
                                                                            </label >
                                                                        </div >

                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" checked = "checked" >
                                                                                Precio es individual
                                                                            </label >
                                                                        </div >
                                                                    @endif
                                                                </div >
                                                            </div >
                                                        @endif
                                                        @if ($servicio->grupo == 'OTHERS')
                                                            <div class="col-12">
                                                                <div class="row" >
                                                                    @if ($servicio->precio_grupo == 1)
                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" checked = "checked" >
                                                                                Precio es absoluto
                                                                            </label >
                                                                        </div >

                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >

                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" >
                                                                                Precio es individual
                                                                            </label >
                                                                        </div >
                                                                    @else

                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >

                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" >
                                                                                Precio es absoluto
                                                                            </label >
                                                                        </div >

                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" checked = "checked" >
                                                                                Precio es individual
                                                                            </label >
                                                                        </div >
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @php
                                                            $pos++;
                                                        @endphp

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col d-flex">
                                                <div class="card p-2 text-left w-100">
                                                    <div class="row">
                                                        <div class="col">
                                                            <p><b class="text-g-green font-weight-bold">Proveedores</b></p>
                                                        </div>
                                                        <div class="col-1"></div>
                                                        <div class="col-7">
                                                            <p><b class="text-g-green">Proveedor/Costo</b></p>
                                                        </div>
                                                    </div>
                                                    <div class="row align-items-center">
                                                        <div id="lista_proveedores_{{$servicio->id}}_{{$destino[0]}}" class="col">
                                                            @if($destino[1]!='TRAINS')
                                                                @foreach($proveedores as $proveedor)
                                                                    <div class="">
                                                                        <label class="text-primary">
                                                                            <input class="proveedores_{{$servicio->id}}" type="checkbox" aria-label="..." name="proveedores_[]" value="{{$proveedor->id}}_{{$proveedor->nombre_comercial}}">
                                                                             {{strtoupper($proveedor->nombre_comercial)}}
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="col-1">
                                                            <a href="#!" class="btn btn-primary" onclick="Pasar_pro('{{$categoria_id}}','{{$destino[1]}}','{{$servicio->id}}')">
                                                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                                            </a>
                                                        </div>
                                                        <div class="col-7">
                                                            @php
                                                                $proveedor_costito=0;
                                                            @endphp
                                                            <div id="lista_costos_{{$destino[1]}}_{{$id}}_{{$servicio->id}}">
                                                                @foreach ($costos->where('m_servicios_id',$servicio->id)->where('grupo', $destino[1])->where('localizacion',$servicio->localizacion)->unique() as $costo)
                                                                    <div id="fila_p_{{$servicio->id}}_{{$costo->id}}_{{$costo->proveedor->id}}" class="row align-items-center">
                                                                        <div class="col-5">
                                                                            <i class="fas fa-check text-success"></i>
                                                                            <span class="fila_proveedores_{{$servicio->id}}_{{$destino[1]}}">{{ucwords(strtolower($costo->proveedor->nombre_comercial))}}</span>
                                                                        </div>
                                                                        <div class="col">
                                                                            <input name="costo_id[]" type="hidden" value="{{$costo->id}}">
                                                                            <input name="costo_val[]" type="number" class="form-control form-control-sm my-2" value="{{$costo->precio_costo}}">
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <button type="button" class="btn btn-danger btn-sm" onclick="eliminar_proveedor_comprobando('{{$servicio->id}}','{{$costo->id}}','{{$costo->proveedor->id}}','{{$costo->proveedor->nombre_comercial}}')">
                                                                                <i class="fas fa-trash" aria-hidden="true"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    @php
                                                                        $proveedor_costito=$costo->id;
                                                                    @endphp
                                                                @endforeach
                                                                @php
                                                                    $nro_tresnes=$costos->where('m_servicios_id',$servicio->id)->where('grupo', $destino[1])->where('localizacion',$servicio->localizacion)->count();
                                                                @endphp
                                                                {{--@if($nro_tresnes>0)--}}
                                                                        {{--<div id="fila_p_{{$servicio->id}}_{{$costo->id}}_{{$costo->proveedor->id}}" class="row align-items-center">--}}
                                                                            {{--<div class="col-5">--}}
                                                                                {{--<i class="fas fa-check text-success"></i>--}}
                                                                                {{--<span class="fila_proveedores_{{$servicio->id}}_{{$destino[1]}}">{{ucwords(strtolower($costo->proveedor->nombre_comercial))}}</span>--}}
                                                                            {{--</div>--}}
                                                                            {{--<div class="col">--}}
                                                                                {{--<input name="costo_id[]" type="hidden" value="{{$costo->id}}">--}}
                                                                                {{--<input name="costo_val[]" type="number" class="form-control form-control-sm my-2" value="{{$costo->precio_costo}}">--}}
                                                                            {{--</div>--}}
                                                                            {{--<div class="col-3">--}}
                                                                                {{--<button type="button" class="btn btn-danger btn-sm" onclick="eliminar_proveedor_comprobando('{{$servicio->id}}','{{$costo->id}}','{{$costo->proveedor->id}}','{{$costo->proveedor->nombre_comercial}}')">--}}
                                                                                    {{--<i class="fas fa-trash" aria-hidden="true"></i>--}}
                                                                                {{--</button>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div>--}}
                                                                {{--@endif--}}
                                                            </div>
                                                            <input type="hidden" id="id_lista_costos_{{ $destino[1]}}_{{ $id}}_{{$servicio->id}}" value="{{ $proveedor_costito }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        {{csrf_field()}}
                                        <input type="hidden" name="id" value="{{$servicio->id}}">
                                        <input type="hidden" name="posTipo" id="posTipo" value="0">
                                        <input type="hidden" name="grupo_{{$servicio->id}}" id="grupo_{{$servicio->id}}" value="{{$destino[1]}}">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="editar_producto('{{$servicio->id}}')">Save changes</button>
                                    </div>
                                    <div id="result_{{$servicio->id}}" class="bg-success text-15 text-center"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm" onclick="eliminar_servicio('{{$servicio->localizacion}}','{{$servicio->id}}','{{$servicio->nombre}}')">
                        <i class="fa fa-trash"></i>
                    </button>
                    {{ csrf_field() }}
                    <input type="hidden" id="estado_servicio_{{$servicio->id}}" value="{{$servicio->estado}}">
                    <button id="btn_{{$servicio->id}}" type="button" class="btn btn-sm" onclick="cambiar_estado('{{$servicio->nombre}}','estado_servicio_','{{$servicio->id}}')">
                        @if($servicio->estado==0)
                            <i class="fas fa-toggle-off text-unset"></i>
                        @elseif($servicio->estado==1)
                            <i class="fas fa-toggle-on text-success"></i>
                        @endif
                        
                    </button>
                </td>
            </tr>
        @endforeach
    @elseif($filtro=='Movilidad-ruta')
        @foreach ($sericios->where('ruta_salida',$ruta[0])->where('ruta_llegada',$ruta[1]) as $servicio)
            <tr class="{{$servicio->localizacion}}" id="lista_services_{{$servicio->id}}">
                <td class="text-g-green">{{ucwords(strtolower($servicio->localizacion))}}</td>
                <td class="text-g-green">{{$servicio->codigo}}</td>
                @if($destino[1] == 'MOVILID')
                    <td class="text-g-green">{{ucwords(strtolower($servicio->ruta_salida))}}-{{ucwords(strtolower($servicio->ruta_llegada))}}
                @endif
                <td id="tipo_{{$servicio->id}}">{{ucwords(strtolower($servicio->tipoServicio))}}
                    @if ($destino[1] == 'MOVILID')
                        [{{$servicio->min_personas}} - {{$servicio->max_personas}}]
                    @endif
                </td>
                <td id="nombre_{{$servicio->id}}">{{ucwords(strtolower($servicio->nombre))}}</td>
                @if ($destino[1] == 'TRAINS')
                    <td id="horario_{{$servicio->id}}">{{$servicio->salida}} - {{$servicio->llegada}}</td>
                @endif
                <td id="precio_{{$servicio->id}}" class="text-right"><sup>$</sup>{{$servicio->precio_venta}}</td>
                <td>
                    @php
                        $nro_proveedores=$costos->where('grupo',$servicio->grupo)->where('localizacion',$servicio->localizacion)->where('tipo_producto',$servicio->tipoServicio)->where('clase',$servicio->clase)->where('nombre',$servicio->nombre)->count('proveedor_id');
                    @endphp
                    {{$nro_proveedores}} <i class="fas fa-users text-primary"></i>
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#modal_edit_producto{{$servicio->id}}">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <div class="modal fade bd-example-modal-lg" id="modal_edit_producto{{$servicio->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg-x" role="document">
                            <div class="modal-content">
                                <form id="frm_modal_edit_producto_{{$servicio->id}}" action="{{route('service_edit_path')}}" method="post">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Service</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row margin-top-10">
                                            <div class="col-5 d-flex">
                                                <div class="card p-2 text-left w-100">
                                                    <div class="row">

                                                        @if($destino[1]!='HOTELS')
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label for="txt_codigo" class="text-secondary font-weight-bold">Codigo</label>
                                                                            <input type="text" class="form-control" id="txt_codigo" name="txt_codigo" value="{{$servicio->codigo}}" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        {{--@if($destino[1]!='TRAINS')--}}
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                @if($destino[1]=='MOVILID')
                                                                    <label for="txt_codigo" class="text-secondary font-weight-bold">Origen</label>
                                                                    <select class="form-control" id="txt_localizacion_{{$servicio->id}}" name="txt_localizacion_{{$servicio->id}}" onchange="nuevos_proveedores_movilidad_ruta_edit('{{$servicio->id}}','{{$destino[0]}}','{{$destino[1]}}')">
                                                                        @foreach ($destinations as $destination)
                                                                            <option value="{{$destination->destino}}"
                                                                            @if ($servicio->localizacion == $destination->destino)
                                                                                {{'selected'}}
                                                                                    @endif
                                                                            >{{$destination->destino}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                @else
                                                                    <label for="txt_codigo" class="font-weight-bold text-secondary">Location</label>
                                                                    <select class="form-control" id="txt_localizacion_{{$servicio->id}}" name="txt_localizacion_{{$servicio->id}}"  onchange="nuevos_proveedores('{{$servicio->id}}','{{$destino[0]}}','{{$destino[1]}}')">
                                                                        @foreach ($destinations as $destination)
                                                                            <option value="{{$destination->destino}}"
                                                                            @if ($servicio->localizacion == $destination->destino)
                                                                                {{'selected'}}
                                                                                    @endif
                                                                            >{{$destination->destino}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                @endif

                                                                <input type="hidden" name="tipoServicio_{{$servicio->id}}" id="tipoServicio_{{$servicio->id}}" value="{{$destino[1]}}">
                                                            </div>
                                                        </div>
                                                        {{--@endif--}}
                                                        @if($destino[1]=='TRAINS')
                                                            @php
                                                                $array_pro = '';
                                                                $proveedor_id1=0;
                                                            @endphp
                                                            @if($destino[1] == 'TRAINS')
                                                                @foreach($proveedores->where('grupo', 'TRAINS') as $provider)
                                                                    @php
                                                                        $array_pro .= $provider->id . '_';
                                                                    @endphp
                                                                    @foreach($provider->clases->where('clase',$servicio->tipoServicio) as $clase)
                                                                        @php
                                                                            $proveedor_id1=$provider->id;
                                                                        @endphp
                                                                    @endforeach
                                                                @endforeach
                                                                @php
                                                                    $array_pro = $array_pro . substr(0, strlen($array_pro) - 1);
                                                                @endphp
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label for="txt_codigo" class="text-secondary font-weight-bold">Empresa</label>
                                                                        <select class="form-control" id="txt_provider_{{$servicio->id}}" name="txt_provider_{{$servicio->id}}" onchange="mostrar_class($('#txt_provider_{{$servicio->id}}').val(),'{{$array_pro}}','{{$destino[1]}}','{{$id}}','{{$servicio->id}}')">
                                                                            <option value="0">Escoja una empresa</option>';
                                                                            @foreach ($proveedores->where('grupo', 'TRAINS') as $provider)
                                                                                <option value="{{$provider->id}}_{{$provider->nombre_comercial}}"
                                                                                @if($proveedor_id1==$provider->id)
                                                                                    {{' selected '}}
                                                                                        @endif
                                                                                >{{$provider->nombre_comercial}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @php
                                                                $vision = 0;
                                                            @endphp
                                                            @foreach ($proveedores->where('grupo', 'TRAINS') as $provider)
                                                                @php
                                                                    $vision++;
                                                                @endphp
                                                                <div id="proveedor_{{$provider->id}}_{{$servicio->id}}" class="col-6
                                                                @if($proveedor_id1!=$provider->id)
                                                                {{' d-none'}}
                                                                @endif
                                                                        ">
                                                                    <div class="form-group">
                                                                        <label for="txt_codigo" >Class</label>
                                                                        <select class="form-control" id="txt_class_{{$servicio->id}}" name = "txt_class_{{$servicio->id}}_{{$provider->id}}">
                                                                            @foreach ($provider->clases->where('estado', '1') as $provider_clases)
                                                                                <option value="{{$provider_clases->clase}}"
                                                                                @if($servicio->tipoServicio==$provider_clases->clase)
                                                                                    {{' selected '}}
                                                                                        @endif
                                                                                >{{$provider_clases->clase}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                        @if($destino[1] == 'ENTRANCES')
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="txt_type" class="text-secondary font-weight-bold"> Clase</label >

                                                                    <select class="form-control" id = "txt_clase_{{$servicio->id}}" name = "txt_clase_{{$servicio->id}}">
                                                                        <option value = "OTROS"
                                                                        @if ($servicio->clase == "OTROS")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >OTROS </option >
                                                                        <option value = "BTG"

                                                                        @if ($servicio->clase == "BTG")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >BOLETO TURISTICO</option>
                                                                        <option value = "CAT"
                                                                        @if ($servicio->clase == "CAT")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >CATEDRAL</option>
                                                                        <option value = "KORI"
                                                                        @if ($servicio->clase == "KORI")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >KORICANCHA</option>
                                                                        <option value = "MAPI"
                                                                        @if ($servicio->clase == "MAPI")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >MACHUPICCHU</option >
                                                                    </select >
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($destino[1] == 'MOVILID')
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="txt_type" class="text-secondary font-weight-bold"> Clase</label >
                                                                    <select class="form-control" id = "txt_clase_{{$servicio->id}}" name = "txt_clase_{{$servicio->id}}">
                                                                        <option value = "DEFAULT"
                                                                        @if ($servicio->clase == "DEFAULT")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >DEFAULT </option >
                                                                        <option value = "BOLETO"
                                                                        @if ($servicio->clase == "BOLETO")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >BOLETO</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($destino[1] == 'TOURS')
                                                            <div class="col-6">
                                                                <div class="form-group"><label for="txt_type" class="text-secondary font-weight-bold"> Type</label >
                                                                    <select class="form-control" id = "txt_type_{{$servicio->id}}" name = "txt_type_{{$servicio->id}}" >
                                                                        <option value = "GROUP"
                                                                        @if ($servicio->tipoServicio == "GROUP")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >GROUP </option >
                                                                        <option value = "PRIVATE"
                                                                        @if ($servicio->tipoServicio == "PRIVATE")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >PRIVATE</option >
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($servicio->grupo == 'MOVILID')
                                                            <div class="col-6">
                                                                <div class="form-group"><label for="txt_type" class="text-secondary font-weight-bold"> Type</label >

                                                                    <select class="form-control" id = "txt_type_{{$servicio->id}}" name = "txt_type_{{$servicio->id}}" >
                                                                        <option value = "AUTO"
                                                                        @if ($servicio->tipoServicio == "AUTO")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >AUTO </option >
                                                                        <option value = "SUV"
                                                                        @if ($servicio->tipoServicio == "SUV")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >SUV </option >
                                                                        <option value = "VAN"
                                                                        @if ($servicio->tipoServicio == "VAN")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >VAN </option >
                                                                        <option value = "H1"
                                                                        @if ($servicio->tipoServicio == "H1")
                                                                            {{'selected '}}
                                                                                @endif
                                                                        >H1 </option >
                                                                        <option value = "SPRINTER"
                                                                        @if ($servicio->tipoServicio == "SPRINTER")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >SPRINTER </option >
                                                                        <option value = "BUS"
                                                                        @if ($servicio->tipoServicio == "BUS")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >BUS </option >
                                                                    </select >
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($servicio->grupo == 'REPRESENT')
                                                            <div class="col-6">
                                                                <div class="form-group"><label for="txt_type" class="text-secondary font-weight-bold"> Type</label >

                                                                    <select class="form-control" id = "txt_type_{{$servicio->id}}" name = "txt_type_{{$servicio->id}}" >
                                                                        <option value = "GUIDE"
                                                                        @if ($servicio->tipoServicio == "GUIDE") {{'selected'}}@endif
                                                                        >GUIDE </option >
                                                                        <option value = "TRANSFER"
                                                                        @if ($servicio->tipoServicio == "TRANSFER") {{'selected'}}@endif
                                                                        >TRANSFER </option >
                                                                        <option value = "ASSISTANCE"
                                                                        @if ($servicio->tipoServicio == "ASSISTANCE") {{'selected'}}@endif
                                                                        >ASSISTANCE </option >
                                                                    </select >
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($servicio->grupo == 'ENTRANCES')
                                                            <div class="col-6">
                                                                <div class="form-group"><label for="txt_type" class="text-secondary font-weight-bold"> Type</label >

                                                                    <select class="form-control" id = "txt_type_{{$servicio->id}}" name = "txt_type_{{$servicio->id}}" >
                                                                        <option value = "EXTRANJERO"
                                                                        @if ($servicio->tipoServicio == "EXTRANJERO") {{'selected '}}@endif
                                                                        >EXTRANJERO </option >
                                                                        <option value = "NATIONAL"
                                                                        @if ($servicio->tipoServicio == "NATIONAL") {{'selected '}}@endif
                                                                        >NATIONAL </option >
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($servicio->grupo == 'FOOD')
                                                            <div class="col-6">
                                                                <div class="form-group"><label for="txt_type" class="text-secondary font-weight-bold"> Type</label >

                                                                    <select class="form-control" id = "txt_type_{{$servicio->id}}" name = "txt_type_{{$servicio->id}}" >
                                                                        <option value = "LUNCH"
                                                                        @if ($servicio->tipoServicio == "LUNCH") {{'selected'}}@endif
                                                                        >LUNCH </option >
                                                                        <option value = "DINNER"
                                                                        @if ($servicio->tipoServicio == "DINNDER") {{'selected'}}@endif
                                                                        >DINNER </option >
                                                                        <option value = "BOX LUNCH"
                                                                        @if ($servicio->tipoServicio == "BOX LUNCH") {{'selected'}}@endif
                                                                        >BOX LUNCH </option >
                                                                    </select >
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if($servicio->grupo == 'FLIGHTS')
                                                            <div class="col-6">

                                                                <div class="form-group"><label for="txt_type">Type</label>
                                                                    <select class="form-control" id="txt_type_{{$servicio->id}}" name="txt_type_{{$servicio->id}}">
                                                                        <option value="NATIONAL"
                                                                        @if ($servicio->tipoServicio == "NATIONAL") {{'selected'}}@endif
                                                                        >NATIONAL</option>
                                                                        <option value="INTERNATIONAL"
                                                                        @if ($servicio->tipoServicio == "INTERNATIONAL") {{'selected'}}@endif
                                                                        >INTERNATIONAL</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($servicio->grupo == 'OTHERS')
                                                            <div class="col-6">

                                                                <div class="form-group"><label for="txt_type">Type</label>
                                                                    <input type="text" class="form-control" id="txt_type_{{$servicio->id}}" name="txt_type_{{$servicio->id}}" placeholder="Type" value="{{$servicio->tipoServicio}}">
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                @if ($servicio->grupo == 'TRAINS')
                                                                    <label for="txt_product" class="text-secondary font-weight-bold">Tren</label>
                                                                @elseif($servicio->grupo == 'FLIGHTS')
                                                                    <label for="txt_product" class="text-secondary font-weight-bold">Ruta</label>
                                                                @else
                                                                    <label for="txt_product" class="text-secondary font-weight-bold">Product</label>

                                                                @endif
                                                                <input type="text" class="form-control" id="txt_product_{{$servicio->id}}" name="txt_product_{{$servicio->id}}" placeholder="Product" value="{{$servicio->nombre}}">
                                                            </div>
                                                        </div>
                                                        @if($destino[1]=='MOVILID')
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <div id="rutas_{{$servicio->id}}">
                                                                        <label for="txt_price" class="font-weight-bold text-secondary">Ruta</label>

                                                                        <select class="form-control" id="txt_ruta_salida_{{$servicio->id}}" name="txt_ruta_salida_{{$servicio->id}}" required="required">
                                                                            <option value="ESCOJA UNA RUTA-ESCOJA UNA RUTA">ESCOJA UNA RUTA</option>
                                                                            @if($servicio->ruta_salida=='CUSCO'&&$servicio->ruta_llegada=='AIRPORT')
                                                                                <option value="CUSCO-AIRPORT" selected>CUSCO-AIRPORT</option>
                                                                            @else
                                                                                <option value="CUSCO-AIRPORT">CUSCO-AIRPORT</option>
                                                                            @endif
                                                                            @if($servicio->ruta_salida=='CUSCO'&&$servicio->ruta_llegada=='OLLANTA')
                                                                                <option value="CUSCO-OLLANTA" selected>CUSCO-OLLANTA</option>
                                                                            @else
                                                                                <option value="CUSCO-OLLANTA">CUSCO-OLLANTA</option>
                                                                            @endif
                                                                            @if($servicio->ruta_salida=='CUSCO'&&$servicio->ruta_llegada=='POROY')
                                                                                <option value="CUSCO-POROY" selected>CUSCO-POROY</option>
                                                                            @else
                                                                                <option value="CUSCO-POROY">CUSCO-POROY</option>
                                                                            @endif
                                                                            @if($servicio->ruta_salida=='CUSCO'&&$servicio->ruta_llegada=='STATION')
                                                                                <option value="CUSCO-STATION" selected>CUSCO-STATION</option>
                                                                            @else
                                                                                <option value="CUSCO-STATION">CUSCO-STATION</option>
                                                                            @endif
                                                                            @if($servicio->ruta_salida=='CUSCO'&&$servicio->ruta_llegada=='VALLE')
                                                                                <option value="CUSCO-VALLE" selected>CUSCO-VALLE</option>
                                                                            @else
                                                                                <option value="CUSCO-VALLE">CUSCO-VALLE</option>
                                                                            @endif
                                                                            @if($servicio->ruta_salida=='AIRPORT'&&$servicio->ruta_llegada=='CUSCO')
                                                                                <option value="AIRPORT-CUSCO" selected>AIRPORT-CUSCO</option>
                                                                            @else
                                                                                <option value="AIRPORT-CUSCO">AIRPORT-CUSCO</option>
                                                                            @endif
                                                                            @if($servicio->ruta_salida=='POROY'&&$servicio->ruta_llegada=='CUSCO')
                                                                                <option value="POROY-CUSCO" selected>POROY-CUSCO</option>
                                                                            @else
                                                                                <option value="POROY-CUSCO">POROY-CUSCO</option>
                                                                            @endif
                                                                            @if($servicio->ruta_salida=='STATION'&&$servicio->ruta_llegada=='CUSCO')
                                                                                <option value="STATION-CUSCO" selected>STATION-CUSCO</option>
                                                                            @else
                                                                                <option value="STATION-CUSCO">STATION-CUSCO</option>
                                                                            @endif
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($servicio->grupo == 'TRAINS' || $servicio->grupo == 'FLIGHTS')
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="txt_price" class="font-weight-bold text-secondary">Ruta de salida</label>

                                                                    <select class="form-control" id="txt_ruta_salida_{{$servicio->id}}" name="txt_ruta_salida_{{$servicio->id}}">
                                                                        @if($servicio->ruta_salida=='POROY')
                                                                            <option value="POROY" selected>POROY</option>
                                                                        @else
                                                                            <option value="POROY">POROY</option>
                                                                        @endif
                                                                        @if($servicio->ruta_salida=='AGUAS CALIENTES')
                                                                            <option value="AGUAS CALIENTES" selected>AGUAS CALIENTES</option>
                                                                        @else
                                                                            <option value="AGUAS CALIENTES">AGUAS CALIENTES</option>
                                                                        @endif
                                                                        @if($servicio->ruta_salida=='OLLANTAYTAMBO')
                                                                            <option value="OLLANTAYTAMBO" selected>OLLANTAYTAMBO</option>
                                                                        @else
                                                                            <option value="OALLANTAYTAMBO">OLLANTAYTAMBO</option>
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="txt_price" class="font-weight-bold text-secondary"> Hora</label >
                                                                    <input type = "text" class="form-control" id = "txt_salida_{{$servicio->id}}" name = "txt_salida_{{$servicio->id}}" placeholder="06:30" value = "{{$servicio->salida}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="txt_price" class="font-weight-bold text-secondary">Ruta de llegada</label>

                                                                    <select class="form-control" id="txt_ruta_llegada_{{$servicio->id}}" name="txt_ruta_llegada_{{$servicio->id}}">
                                                                        @if($servicio->ruta_llegada=='POROY')
                                                                            <option value="POROY" selected>POROY</option>
                                                                        @else
                                                                            <option value="POROY">POROY</option>
                                                                        @endif
                                                                        @if($servicio->ruta_llegada=='AGUAS CALIENTES')
                                                                            <option value="AGUAS CALIENTES" selected>AGUAS CALIENTES</option>
                                                                        @else
                                                                            <option value="AGUAS CALIENTES">AGUAS CALIENTES</option>
                                                                        @endif
                                                                        @if($servicio->ruta_llegada=='OLLANTAYTAMBO')
                                                                            <option value="OLLANTAYTAMBO" selected>OLLANTAYTAMBO</option>
                                                                        @else
                                                                            <option value="OLLANTAYTAMBO">OLLANTAYTAMBO</option>
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-6" >
                                                                <div class="form-group" >
                                                                    <label for="txt_price" class="font-weight-bold text-secondary"> Hora</label>

                                                                    <input type = "text" class="form-control" id = "txt_llegada_{{$servicio->id}}" name = "txt_llegada_{{$servicio->id}}" placeholder="06:30"  value = "{{$servicio->llegada}}" >
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="txt_price" class="text-secondary font-weight-bold">Price</label>

                                                                <input type="number" class="form-control" id="txt_price_{{$servicio->id}}" name="txt_price_{{$servicio->id}}" placeholder="Price"  value="{{$servicio->precio_venta}}" min="0">
                                                            </div>
                                                        </div>
                                                        @if ($servicio->grupo == 'MOVILID')
                                                            <div class="col-6" >
                                                                <div class="form-group" >
                                                                    <label for="txt_price" class="text-secondary font-weight-bold"> Min Personas </label >
                                                                    <input type = "number" class="form-control" id = "txt_min_personas_{{$servicio->id}}" name = "txt_min_personas_{{$servicio->id}}" placeholder = "Min" min = "0" value = "{{$servicio->min_personas}}">
                                                                </div >
                                                            </div >
                                                            <div class="col-6" >
                                                                <div class="form-group" >
                                                                    <label for="txt_price" class="text-secondary font-weight-bold"> Max Personas </label >

                                                                    <input type = "number" class="form-control" id = "txt_max_personas_{{$servicio->id}}" name = "txt_max_personas_{{$servicio->id}}" placeholder = "Min" min = "0" value = "{{$servicio->max_personas}}" >
                                                                </div >
                                                            </div >
                                                        @endif
                                                        @if ($servicio->grupo == 'TOURS')
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    @if ($servicio->precio_grupo == 1)
                                                                        {{--<div class="col-12">--}}
                                                                        {{--<label for="txt_price" class="text-secondary font-weight-bold">Type price</label><br>--}}
                                                                        {{--</div>--}}
                                                                        <div class="col-6">
                                                                            <label class=" text-g-green" >

                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" checked = "checked" >
                                                                                Precio es absoluto
                                                                            </label >
                                                                        </div >

                                                                        <div class="col-6">
                                                                            {{--<label for="txt_price" class="text-secondary font-weight-bold">Tipe price</label><br>--}}
                                                                            <label class=" text-g-green" >

                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" >
                                                                                Precio es individual
                                                                            </label >
                                                                        </div >
                                                                    @else

                                                                        {{--<div class="col-6">--}}
                                                                        {{--<label for="txt_price" class="text-secondary font-weight-bold">Type price</label><br>--}}
                                                                        {{--</div>--}}
                                                                        <div class="col-6">
                                                                            {{--<label for="txt_price" class="text-secondary font-weight-bold">Tipe price</label><br>--}}
                                                                            <label class="text-danger" >

                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" >
                                                                                Precio es absoluto
                                                                            </label >
                                                                        </div >

                                                                        <div class="col-6">
                                                                            {{--<label for="txt_price" class="text-secondary font-weight-bold">Tipe price</label><br>--}}
                                                                            <label class="text-danger" >

                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" checked = "checked" >
                                                                                Precio es individual
                                                                            </label >
                                                                        </div >
                                                                    @endif
                                                                </div >
                                                            </div >
                                                        @endif
                                                        @if ($servicio->grupo == 'MOVILID')
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    @if ($servicio->precio_grupo == 1)
                                                                        <div class="col-6">
                                                                            <label class="text-danger">
                                                                                <input type="radio" name="txt_tipo_grupo_{{$servicio->id}}" value="Absoluto" checked="checked">
                                                                                Precio es absoluto
                                                                            </label>
                                                                        </div>

                                                                        <div class="col-6">
                                                                            <label class="text-danger">

                                                                                <input type="radio" name="txt_tipo_grupo_{{$servicio->id}}" value="Individual">
                                                                                Precio es individual
                                                                            </label>
                                                                        </div>
                                                                    @else

                                                                        <div class="col-6">
                                                                            <label class="text-danger">
                                                                                <input type="radio" name="txt_tipo_grupo_{{$servicio->id}}" value="Absoluto">
                                                                                Precio es absoluto
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <label class="text-danger">
                                                                                <input type="radio" name="txt_tipo_grupo_{{$servicio->id}}" value="Individual" checked="checked">
                                                                                Precio es individual
                                                                            </label>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($servicio->grupo == 'REPRESENT')
                                                            <div class="col-12">
                                                                <div class="row" >
                                                                    @if ($servicio->precio_grupo == 1)
                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class="text-danger" >

                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" checked = "checked" >
                                                                                Precio es absoluto
                                                                            </label >
                                                                        </div>

                                                                        <div class="col-6 d-none" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class="text-danger">

                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" >
                                                                                Precio es individual
                                                                            </label >
                                                                        </div>
                                                                    @else

                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >

                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" >
                                                                                Precio es absoluto
                                                                            </label >
                                                                        </div >
                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" checked = "checked" >
                                                                                Precio es individual
                                                                            </label >
                                                                        </div >
                                                                    @endif
                                                                </div >
                                                            </div>
                                                        @endif
                                                        @if ($servicio->grupo == 'ENTRANCES')
                                                            <div class="col-12">
                                                                <div class="row" >
                                                                    @if ($servicio->precio_grupo == 1)
                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" checked = "checked" >
                                                                                Precio es absoluto
                                                                            </label >
                                                                        </div >
                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" >
                                                                                Precio es individual
                                                                            </label >
                                                                        </div >
                                                                    @else
                                                                        <div class="col-6 d-none" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" >
                                                                                Precio es absoluto
                                                                            </label >
                                                                        </div >

                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" checked = "checked" >
                                                                                Precio es individual
                                                                            </label >
                                                                        </div >
                                                                    @endif
                                                                </div >
                                                            </div >
                                                        @endif
                                                        @if ($servicio->grupo == 'FOOD')
                                                            <div class="col-12" >
                                                                <div class="row" >
                                                                    @if ($servicio->precio_grupo == 1)
                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" checked = "checked" >
                                                                                Precio es absoluto
                                                                            </label >
                                                                        </div >
                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" >
                                                                                Precio es individual
                                                                            </label >
                                                                        </div >
                                                                    @else
                                                                        <div class="col-6 d-none" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" >
                                                                                Precio es absoluto
                                                                            </label >
                                                                        </div >
                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" checked = "checked" >
                                                                                Precio es individual
                                                                            </label >
                                                                        </div >
                                                                    @endif
                                                                </div >
                                                            </div >
                                                        @endif
                                                        @if ($servicio->grupo == 'TRAINS')
                                                            <div class="col-12">
                                                                <div class="row" >
                                                                    @if ($servicio->precio_grupo == 1)
                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" checked = "checked" >
                                                                                Precio es absoluto
                                                                            </label >
                                                                        </div>

                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger">
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" >
                                                                                Precio es individual
                                                                            </label>
                                                                        </div >
                                                                    @else

                                                                        <div class="col-md-6 d-none" >
                                                                            <label for="txt_price">Tipe price</label><br>
                                                                            <label class=" text-green-goto" ></label>
                                                                        </div>
                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger">

                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" checked = "checked" >
                                                                                Precio es individual
                                                                            </label >
                                                                        </div>
                                                                    @endif
                                                                </div >
                                                            </div >
                                                        @endif
                                                        @if ($servicio->grupo == 'FLIGHTS')

                                                            <div class="col-12" >
                                                                <div class="row" >
                                                                    @if ($servicio->precio_grupo == 1)
                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >

                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" checked = "checked" >
                                                                                Precio es absoluto
                                                                            </label >
                                                                        </div >
                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" >
                                                                                Precio es individual
                                                                            </label >
                                                                        </div >
                                                                    @else
                                                                        <div class="col-6 d-none" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" >
                                                                                Precio es absoluto
                                                                            </label >
                                                                        </div >

                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" checked = "checked" >
                                                                                Precio es individual
                                                                            </label >
                                                                        </div >
                                                                    @endif
                                                                </div >
                                                            </div >
                                                        @endif
                                                        @if ($servicio->grupo == 'OTHERS')
                                                            <div class="col-12">
                                                                <div class="row" >
                                                                    @if ($servicio->precio_grupo == 1)
                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" checked = "checked" >
                                                                                Precio es absoluto
                                                                            </label >
                                                                        </div >

                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >

                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" >
                                                                                Precio es individual
                                                                            </label >
                                                                        </div >
                                                                    @else

                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >

                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" >
                                                                                Precio es absoluto
                                                                            </label >
                                                                        </div >

                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" checked = "checked" >
                                                                                Precio es individual
                                                                            </label >
                                                                        </div >
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @php
                                                            $pos++;
                                                        @endphp

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col d-flex">
                                                <div class="card p-2 text-left w-100">
                                                    <div class="row">
                                                        <div class="col">
                                                            <p><b class="text-g-green font-weight-bold">Proveedores</b></p>
                                                        </div>
                                                        <div class="col-1"></div>
                                                        <div class="col-7">
                                                            <p><b class="text-g-green">Proveedor/Costo</b></p>
                                                        </div>
                                                    </div>
                                                    <div class="row align-items-center">
                                                        <div id="lista_proveedores_{{$servicio->id}}_{{$destino[0]}}" class="col">
                                                            @if($destino[1]!='TRAINS')
                                                                @foreach ($proveedores as $proveedor)
                                                                    <div class="">
                                                                        <label class="text-primary">
                                                                            <input class="proveedores_{{$servicio->id}}" type="checkbox" aria-label="..." name="proveedores_[]" value="{{$proveedor->id}}_{{$proveedor->nombre_comercial}}">
                                                                            {{strtoupper($proveedor->nombre_comercial)}}
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="col-1">
                                                            <a href="#!" class="btn btn-primary" onclick="Pasar_pro('{{$categoria_id}}','{{$destino[1]}}','{{$servicio->id}}')">
                                                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                                            </a>
                                                        </div>
                                                        <div class="col-7">
                                                            @php
                                                                $proveedor_costito=0;
                                                            @endphp
                                                            <div id="lista_costos_{{$destino[1]}}_{{$id}}_{{$servicio->id}}">
                                                                @foreach ($costos->where('m_servicios_id',$servicio->id)->where('grupo', $destino[1])->where('localizacion',$servicio->localizacion)->unique() as $costo)
                                                                    <div id="fila_p_{{$servicio->id}}_{{$costo->id}}_{{$costo->proveedor->id}}" class="row align-items-center">
                                                                        <div class="col-5">
                                                                            <i class="fas fa-check text-success"></i>
                                                                            <span class="fila_proveedores_{{$servicio->id}}_{{$destino[1]}}">{{ucwords(strtolower($costo->proveedor->nombre_comercial))}}</span>
                                                                        </div>
                                                                        <div class="col">
                                                                            <input name="costo_id[]" type="hidden" value="{{$costo->id}}">
                                                                            <input name="costo_val[]" type="number" class="form-control form-control-sm my-2" value="{{$costo->precio_costo}}">
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <button type="button" class="btn btn-danger btn-sm" onclick="eliminar_proveedor_comprobando('{{$servicio->id}}','{{$costo->id}}','{{$costo->proveedor->id}}','{{$costo->proveedor->nombre_comercial}}')">
                                                                                <i class="fas fa-trash" aria-hidden="true"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    @php
                                                                        $proveedor_costito=$costo->id;
                                                                    @endphp
                                                                @endforeach
                                                                @php
                                                                    $nro_tresnes=$costos->where('m_servicios_id',$servicio->id)->where('grupo', $destino[1])->where('localizacion',$servicio->localizacion)->count();
                                                                @endphp
                                                                {{--@if($nro_tresnes>0)--}}
                                                                {{--<div id="fila_p_{{$servicio->id}}_{{$costo->id}}_{{$costo->proveedor->id}}" class="row align-items-center">--}}
                                                                {{--<div class="col-5">--}}
                                                                {{--<i class="fas fa-check text-success"></i>--}}
                                                                {{--<span class="fila_proveedores_{{$servicio->id}}_{{$destino[1]}}">{{ucwords(strtolower($costo->proveedor->nombre_comercial))}}</span>--}}
                                                                {{--</div>--}}
                                                                {{--<div class="col">--}}
                                                                {{--<input name="costo_id[]" type="hidden" value="{{$costo->id}}">--}}
                                                                {{--<input name="costo_val[]" type="number" class="form-control form-control-sm my-2" value="{{$costo->precio_costo}}">--}}
                                                                {{--</div>--}}
                                                                {{--<div class="col-3">--}}
                                                                {{--<button type="button" class="btn btn-danger btn-sm" onclick="eliminar_proveedor_comprobando('{{$servicio->id}}','{{$costo->id}}','{{$costo->proveedor->id}}','{{$costo->proveedor->nombre_comercial}}')">--}}
                                                                {{--<i class="fas fa-trash" aria-hidden="true"></i>--}}
                                                                {{--</button>--}}
                                                                {{--</div>--}}
                                                                {{--</div>--}}
                                                                {{--@endif--}}
                                                            </div>
                                                            <input type="hidden" id="id_lista_costos_{{ $destino[1]}}_{{ $id}}_{{$servicio->id}}" value="{{ $proveedor_costito }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        {{csrf_field()}}
                                        <input type="hidden" name="id" value="{{$servicio->id}}">
                                        <input type="hidden" name="posTipo" id="posTipo" value="0">
                                        <input type="hidden" name="grupo_{{$servicio->id}}" id="grupo_{{$servicio->id}}" value="{{$destino[1]}}">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="editar_producto('{{$servicio->id}}')">Save changes</button>
                                    </div>
                                    <div id="result_{{$servicio->id}}" class="bg-success text-15 text-center"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm" onclick="eliminar_servicio('{{$servicio->localizacion}}','{{$servicio->id}}','{{$servicio->nombre}}')">
                        <i class="fa fa-trash"></i>
                    </button>
                    {{ csrf_field() }}
                    <input type="hidden" id="estado_servicio_{{$servicio->id}}" value="{{$servicio->estado}}">
                    <button id="btn_{{$servicio->id}}" type="button" class="btn btn-sm" onclick="cambiar_estado('{{$servicio->nombre}}','estado_servicio_','{{$servicio->id}}')">
                        @if($servicio->estado==0)
                            <i class="fas fa-toggle-off text-unset"></i>
                        @elseif($servicio->estado==1)
                            <i class="fas fa-toggle-on text-success"></i>
                        @endif
                        
                    </button>
                </td>
            </tr>
        @endforeach
    @elseif($filtro=='Movilidad-ruta-tipo')
        @foreach ($sericios->where('ruta_salida',$ruta[0])->where('ruta_llegada',$ruta[1])->where('tipoServicio',$tipo) as $servicio)
            <tr class="{{$servicio->localizacion}}" id="lista_services_{{$servicio->id}}">
                <td class="text-g-green">{{ucwords(strtolower($servicio->localizacion))}}</td>
                <td class="text-g-green">{{$servicio->codigo}}</td>
                @if($destino[1] == 'MOVILID')
                    <td class="text-g-green">{{ucwords(strtolower($servicio->ruta_salida))}}-{{ucwords(strtolower($servicio->ruta_llegada))}}
                @endif
                <td id="tipo_{{$servicio->id}}">{{ucwords(strtolower($servicio->tipoServicio))}}
                    @if ($destino[1] == 'MOVILID')
                        [{{$servicio->min_personas}} - {{$servicio->max_personas}}]
                    @endif
                </td>
                <td id="nombre_{{$servicio->id}}">{{ucwords(strtolower($servicio->nombre))}}</td>
                @if ($destino[1] == 'TRAINS')
                    <td id="horario_{{$servicio->id}}">{{$servicio->salida}} - {{$servicio->llegada}}</td>
                @endif
                <td id="precio_{{$servicio->id}}" class="text-right"><sup>$</sup>{{$servicio->precio_venta}}</td>
                <td>
                    @php
                        $nro_proveedores=$costos->where('grupo',$servicio->grupo)->where('localizacion',$servicio->localizacion)->where('tipo_producto',$servicio->tipoServicio)->where('clase',$servicio->clase)->where('nombre',$servicio->nombre)->count('proveedor_id');
                    @endphp
                    {{$nro_proveedores}} <i class="fas fa-users text-primary"></i>
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#modal_edit_producto{{$servicio->id}}">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <div class="modal fade bd-example-modal-lg" id="modal_edit_producto{{$servicio->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg-x" role="document">
                            <div class="modal-content">
                                <form id="frm_modal_edit_producto_{{$servicio->id}}" action="{{route('service_edit_path')}}" method="post">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Service</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row margin-top-10">
                                            <div class="col-5 d-flex">
                                                <div class="card p-2 text-left w-100">
                                                    <div class="row">

                                                        @if($destino[1]!='HOTELS')
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label for="txt_codigo" class="text-secondary font-weight-bold">Codigo</label>
                                                                            <input type="text" class="form-control" id="txt_codigo" name="txt_codigo" value="{{$servicio->codigo}}" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        {{--@if($destino[1]!='TRAINS')--}}
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                @if($destino[1]=='MOVILID')
                                                                    <label for="txt_codigo" class="text-secondary font-weight-bold">Origen</label>
                                                                    <select class="form-control" id="txt_localizacion_{{$servicio->id}}" name="txt_localizacion_{{$servicio->id}}" onchange="nuevos_proveedores_movilidad_ruta_edit('{{$servicio->id}}','{{$destino[0]}}','{{$destino[1]}}')">
                                                                        @foreach ($destinations as $destination)
                                                                            <option value="{{$destination->destino}}"
                                                                            @if ($servicio->localizacion == $destination->destino)
                                                                                {{'selected'}}
                                                                                    @endif
                                                                            >{{$destination->destino}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                @else
                                                                    <label for="txt_codigo" class="font-weight-bold text-secondary">Location</label>
                                                                    <select class="form-control" id="txt_localizacion_{{$servicio->id}}" name="txt_localizacion_{{$servicio->id}}"  onchange="nuevos_proveedores('{{$servicio->id}}','{{$destino[0]}}','{{$destino[1]}}')">
                                                                        @foreach ($destinations as $destination)
                                                                            <option value="{{$destination->destino}}"
                                                                            @if ($servicio->localizacion == $destination->destino)
                                                                                {{'selected'}}
                                                                                    @endif
                                                                            >{{$destination->destino}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                @endif

                                                                <input type="hidden" name="tipoServicio_{{$servicio->id}}" id="tipoServicio_{{$servicio->id}}" value="{{$destino[1]}}">
                                                            </div>
                                                        </div>
                                                        {{--@endif--}}
                                                        @if($destino[1]=='TRAINS')
                                                            @php
                                                                $array_pro = '';
                                                                $proveedor_id1=0;
                                                            @endphp
                                                            @if($destino[1] == 'TRAINS')
                                                                @foreach($proveedores->where('grupo', 'TRAINS') as $provider)
                                                                    @php
                                                                        $array_pro .= $provider->id . '_';
                                                                    @endphp
                                                                    @foreach($provider->clases->where('clase',$servicio->tipoServicio) as $clase)
                                                                        @php
                                                                            $proveedor_id1=$provider->id;
                                                                        @endphp
                                                                    @endforeach
                                                                @endforeach
                                                                @php
                                                                    $array_pro = $array_pro . substr(0, strlen($array_pro) - 1);
                                                                @endphp
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label for="txt_codigo" class="text-secondary font-weight-bold">Empresa</label>
                                                                        <select class="form-control" id="txt_provider_{{$servicio->id}}" name="txt_provider_{{$servicio->id}}" onchange="mostrar_class($('#txt_provider_{{$servicio->id}}').val(),'{{$array_pro}}','{{$destino[1]}}','{{$id}}','{{$servicio->id}}')">
                                                                            <option value="0">Escoja una empresa</option>';
                                                                            @foreach ($proveedores->where('grupo', 'TRAINS') as $provider)
                                                                                <option value="{{$provider->id}}_{{$provider->nombre_comercial}}"
                                                                                @if($proveedor_id1==$provider->id)
                                                                                    {{' selected '}}
                                                                                        @endif
                                                                                >{{$provider->nombre_comercial}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @php
                                                                $vision = 0;
                                                            @endphp
                                                            @foreach ($proveedores->where('grupo', 'TRAINS') as $provider)
                                                                @php
                                                                    $vision++;
                                                                @endphp
                                                                <div id="proveedor_{{$provider->id}}_{{$servicio->id}}" class="col-6
                                                                @if($proveedor_id1!=$provider->id)
                                                                {{' d-none'}}
                                                                @endif
                                                                        ">
                                                                    <div class="form-group">
                                                                        <label for="txt_codigo" >Class</label>
                                                                        <select class="form-control" id="txt_clase_{{$servicio->id}}" name = "txt_clase_{{$servicio->id}}_{{$provider->id}}">
                                                                            @foreach ($provider->clases->where('estado', '1') as $provider_clases)
                                                                                <option value="{{$provider_clases->clase}}"
                                                                                @if($servicio->tipoServicio==$provider_clases->clase)
                                                                                    {{' selected '}}
                                                                                        @endif
                                                                                >{{$provider_clases->clase}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                        @if($destino[1] == 'ENTRANCES')
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="txt_type" class="text-secondary font-weight-bold"> Clase</label >

                                                                    <select class="form-control" id = "txt_clase_{{$servicio->id}}" name = "txt_clase_{{$servicio->id}}">
                                                                        <option value = "OTROS"
                                                                        @if ($servicio->clase == "OTROS")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >OTROS </option >
                                                                        <option value = "BTG"

                                                                        @if ($servicio->clase == "BTG")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >BOLETO TURISTICO</option>
                                                                        <option value = "CAT"
                                                                        @if ($servicio->clase == "CAT")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >CATEDRAL</option>
                                                                        <option value = "KORI"
                                                                        @if ($servicio->clase == "KORI")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >KORICANCHA</option>
                                                                        <option value = "MAPI"
                                                                        @if ($servicio->clase == "MAPI")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >MACHUPICCHU</option >
                                                                    </select >
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($destino[1] == 'MOVILID')
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="txt_type" class="text-secondary font-weight-bold"> Clase</label >
                                                                    <select class="form-control" id = "txt_clase_{{$servicio->id}}" name = "txt_clase_{{$servicio->id}}">
                                                                        <option value = "DEFAULT"
                                                                        @if ($servicio->clase == "DEFAULT")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >DEFAULT </option >
                                                                        <option value = "BOLETO"
                                                                        @if ($servicio->clase == "BOLETO")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >BOLETO</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($destino[1] == 'TOURS')
                                                            <div class="col-6">
                                                                <div class="form-group"><label for="txt_type" class="text-secondary font-weight-bold"> Type</label >
                                                                    <select class="form-control" id = "txt_type_{{$servicio->id}}" name = "txt_type_{{$servicio->id}}" >
                                                                        <option value = "GROUP"
                                                                        @if ($servicio->tipoServicio == "GROUP")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >GROUP </option >
                                                                        <option value = "PRIVATE"
                                                                        @if ($servicio->tipoServicio == "PRIVATE")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >PRIVATE</option >
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($servicio->grupo == 'MOVILID')
                                                            <div class="col-6">
                                                                <div class="form-group"><label for="txt_type" class="text-secondary font-weight-bold"> Type</label >

                                                                    <select class="form-control" id = "txt_type_{{$servicio->id}}" name = "txt_type_{{$servicio->id}}" >
                                                                        <option value = "AUTO"
                                                                        @if ($servicio->tipoServicio == "AUTO")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >AUTO </option >
                                                                        <option value = "SUV"
                                                                        @if ($servicio->tipoServicio == "SUV")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >SUV </option >
                                                                        <option value = "VAN"
                                                                        @if ($servicio->tipoServicio == "VAN")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >VAN </option >
                                                                        <option value = "H1"
                                                                        @if ($servicio->tipoServicio == "H1")
                                                                            {{'selected '}}
                                                                                @endif
                                                                        >H1 </option >
                                                                        <option value = "SPRINTER"
                                                                        @if ($servicio->tipoServicio == "SPRINTER")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >SPRINTER </option >
                                                                        <option value = "BUS"
                                                                        @if ($servicio->tipoServicio == "BUS")
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >BUS </option >
                                                                    </select >
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($servicio->grupo == 'REPRESENT')
                                                            <div class="col-6">
                                                                <div class="form-group"><label for="txt_type" class="text-secondary font-weight-bold"> Type</label >

                                                                    <select class="form-control" id = "txt_type_{{$servicio->id}}" name = "txt_type_{{$servicio->id}}" >
                                                                        <option value = "GUIDE"
                                                                        @if ($servicio->tipoServicio == "GUIDE") {{'selected'}}@endif
                                                                        >GUIDE </option >
                                                                        <option value = "TRANSFER"
                                                                        @if ($servicio->tipoServicio == "TRANSFER") {{'selected'}}@endif
                                                                        >TRANSFER </option >
                                                                        <option value = "ASSISTANCE"
                                                                        @if ($servicio->tipoServicio == "ASSISTANCE") {{'selected'}}@endif
                                                                        >ASSISTANCE </option >
                                                                    </select >
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($servicio->grupo == 'ENTRANCES')
                                                            <div class="col-6">
                                                                <div class="form-group"><label for="txt_type" class="text-secondary font-weight-bold"> Type</label >

                                                                    <select class="form-control" id = "txt_type_{{$servicio->id}}" name = "txt_type_{{$servicio->id}}" >
                                                                        <option value = "EXTRANJERO"
                                                                        @if ($servicio->tipoServicio == "EXTRANJERO") {{'selected '}}@endif
                                                                        >EXTRANJERO </option >
                                                                        <option value = "NATIONAL"
                                                                        @if ($servicio->tipoServicio == "NATIONAL") {{'selected '}}@endif
                                                                        >NATIONAL </option >
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($servicio->grupo == 'FOOD')
                                                            <div class="col-6">
                                                                <div class="form-group"><label for="txt_type" class="text-secondary font-weight-bold"> Type</label >

                                                                    <select class="form-control" id = "txt_type_{{$servicio->id}}" name = "txt_type_{{$servicio->id}}" >
                                                                        <option value = "LUNCH"
                                                                        @if ($servicio->tipoServicio == "LUNCH") {{'selected'}}@endif
                                                                        >LUNCH </option >
                                                                        <option value = "DINNER"
                                                                        @if ($servicio->tipoServicio == "DINNDER") {{'selected'}}@endif
                                                                        >DINNER </option >
                                                                        <option value = "BOX LUNCH"
                                                                        @if ($servicio->tipoServicio == "BOX LUNCH") {{'selected'}}@endif
                                                                        >BOX LUNCH </option >
                                                                    </select >
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if($servicio->grupo == 'FLIGHTS')
                                                            <div class="col-6">

                                                                <div class="form-group"><label for="txt_type">Type</label>
                                                                    <select class="form-control" id="txt_type_{{$servicio->id}}" name="txt_type_{{$servicio->id}}">
                                                                        <option value="NATIONAL"
                                                                        @if ($servicio->tipoServicio == "NATIONAL") {{'selected'}}@endif
                                                                        >NATIONAL</option>
                                                                        <option value="INTERNATIONAL"
                                                                        @if ($servicio->tipoServicio == "INTERNATIONAL") {{'selected'}}@endif
                                                                        >INTERNATIONAL</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($servicio->grupo == 'OTHERS')
                                                            <div class="col-6">

                                                                <div class="form-group"><label for="txt_type">Type</label>
                                                                    <input type="text" class="form-control" id="txt_type_{{$servicio->id}}" name="txt_type_{{$servicio->id}}" placeholder="Type" value="{{$servicio->tipoServicio}}">
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                @if ($servicio->grupo == 'TRAINS')
                                                                    <label for="txt_product" class="text-secondary font-weight-bold">Tren</label>
                                                                @elseif($servicio->grupo == 'FLIGHTS')
                                                                    <label for="txt_product" class="text-secondary font-weight-bold">Ruta</label>
                                                                @else
                                                                    <label for="txt_product" class="text-secondary font-weight-bold">Product</label>

                                                                @endif
                                                                <input type="text" class="form-control" id="txt_product_{{$servicio->id}}" name="txt_product_{{$servicio->id}}" placeholder="Product" value="{{$servicio->nombre}}">
                                                            </div>
                                                        </div>
                                                        @if($destino[1]=='MOVILID')
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <div id="rutas_{{$servicio->id}}">
                                                                        <label for="txt_price" class="font-weight-bold text-secondary">Ruta</label>

                                                                        <select class="form-control" id="txt_ruta_salida_{{$servicio->id}}" name="txt_ruta_salida_{{$servicio->id}}" required="required">
                                                                            <option value="ESCOJA UNA RUTA-ESCOJA UNA RUTA">ESCOJA UNA RUTA</option>
                                                                            @if($servicio->ruta_salida=='CUSCO'&&$servicio->ruta_llegada=='AIRPORT')
                                                                                <option value="CUSCO-AIRPORT" selected>CUSCO-AIRPORT</option>
                                                                            @else
                                                                                <option value="CUSCO-AIRPORT">CUSCO-AIRPORT</option>
                                                                            @endif
                                                                            @if($servicio->ruta_salida=='CUSCO'&&$servicio->ruta_llegada=='OLLANTA')
                                                                                <option value="CUSCO-OLLANTA" selected>CUSCO-OLLANTA</option>
                                                                            @else
                                                                                <option value="CUSCO-OLLANTA">CUSCO-OLLANTA</option>
                                                                            @endif
                                                                            @if($servicio->ruta_salida=='CUSCO'&&$servicio->ruta_llegada=='POROY')
                                                                                <option value="CUSCO-POROY" selected>CUSCO-POROY</option>
                                                                            @else
                                                                                <option value="CUSCO-POROY">CUSCO-POROY</option>
                                                                            @endif
                                                                            @if($servicio->ruta_salida=='CUSCO'&&$servicio->ruta_llegada=='STATION')
                                                                                <option value="CUSCO-STATION" selected>CUSCO-STATION</option>
                                                                            @else
                                                                                <option value="CUSCO-STATION">CUSCO-STATION</option>
                                                                            @endif
                                                                            @if($servicio->ruta_salida=='CUSCO'&&$servicio->ruta_llegada=='VALLE')
                                                                                <option value="CUSCO-VALLE" selected>CUSCO-VALLE</option>
                                                                            @else
                                                                                <option value="CUSCO-VALLE">CUSCO-VALLE</option>
                                                                            @endif
                                                                            @if($servicio->ruta_salida=='AIRPORT'&&$servicio->ruta_llegada=='CUSCO')
                                                                                <option value="AIRPORT-CUSCO" selected>AIRPORT-CUSCO</option>
                                                                            @else
                                                                                <option value="AIRPORT-CUSCO">AIRPORT-CUSCO</option>
                                                                            @endif
                                                                            @if($servicio->ruta_salida=='POROY'&&$servicio->ruta_llegada=='CUSCO')
                                                                                <option value="POROY-CUSCO" selected>POROY-CUSCO</option>
                                                                            @else
                                                                                <option value="POROY-CUSCO">POROY-CUSCO</option>
                                                                            @endif
                                                                            @if($servicio->ruta_salida=='STATION'&&$servicio->ruta_llegada=='CUSCO')
                                                                                <option value="STATION-CUSCO" selected>STATION-CUSCO</option>
                                                                            @else
                                                                                <option value="STATION-CUSCO">STATION-CUSCO</option>
                                                                            @endif
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($servicio->grupo == 'TRAINS' || $servicio->grupo == 'FLIGHTS')
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="txt_price" class="font-weight-bold text-secondary">Ruta de salida</label>

                                                                    <select class="form-control" id="txt_ruta_salida_{{$servicio->id}}" name="txt_ruta_salida_{{$servicio->id}}">
                                                                        @if($servicio->ruta_salida=='POROY')
                                                                            <option value="POROY" selected>POROY</option>
                                                                        @else
                                                                            <option value="POROY">POROY</option>
                                                                        @endif
                                                                        @if($servicio->ruta_salida=='AGUAS CALIENTES')
                                                                            <option value="AGUAS CALIENTES" selected>AGUAS CALIENTES</option>
                                                                        @else
                                                                            <option value="AGUAS CALIENTES">AGUAS CALIENTES</option>
                                                                        @endif
                                                                        @if($servicio->ruta_salida=='OLLANTAYTAMBO')
                                                                            <option value="OLLANTAYTAMBO" selected>OLLANTAYTAMBO</option>
                                                                        @else
                                                                            <option value="OALLANTAYTAMBO">OLLANTAYTAMBO</option>
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="txt_price" class="font-weight-bold text-secondary"> Hora</label >
                                                                    <input type = "text" class="form-control" id = "txt_salida_{{$servicio->id}}" name = "txt_salida_{{$servicio->id}}" placeholder="06:30" value = "{{$servicio->salida}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="txt_price" class="font-weight-bold text-secondary">Ruta de llegada</label>

                                                                    <select class="form-control" id="txt_ruta_llegada_{{$servicio->id}}" name="txt_ruta_llegada_{{$servicio->id}}">
                                                                        @if($servicio->ruta_llegada=='POROY')
                                                                            <option value="POROY" selected>POROY</option>
                                                                        @else
                                                                            <option value="POROY">POROY</option>
                                                                        @endif
                                                                        @if($servicio->ruta_llegada=='AGUAS CALIENTES')
                                                                            <option value="AGUAS CALIENTES" selected>AGUAS CALIENTES</option>
                                                                        @else
                                                                            <option value="AGUAS CALIENTES">AGUAS CALIENTES</option>
                                                                        @endif
                                                                        @if($servicio->ruta_llegada=='OLLANTAYTAMBO')
                                                                            <option value="OLLANTAYTAMBO" selected>OLLANTAYTAMBO</option>
                                                                        @else
                                                                            <option value="OLLANTAYTAMBO">OLLANTAYTAMBO</option>
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-6" >
                                                                <div class="form-group" >
                                                                    <label for="txt_price" class="font-weight-bold text-secondary"> Hora</label>

                                                                    <input type = "text" class="form-control" id = "txt_llegada_{{$servicio->id}}" name = "txt_llegada_{{$servicio->id}}" placeholder="06:30"  value = "{{$servicio->llegada}}" >
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="txt_price" class="text-secondary font-weight-bold">Price</label>

                                                                <input type="number" class="form-control" id="txt_price_{{$servicio->id}}" name="txt_price_{{$servicio->id}}" placeholder="Price"  value="{{$servicio->precio_venta}}" min="0">
                                                            </div>
                                                        </div>
                                                        @if ($servicio->grupo == 'MOVILID')
                                                            <div class="col-6" >
                                                                <div class="form-group" >
                                                                    <label for="txt_price" class="text-secondary font-weight-bold"> Min Personas </label >
                                                                    <input type = "number" class="form-control" id = "txt_min_personas_{{$servicio->id}}" name = "txt_min_personas_{{$servicio->id}}" placeholder = "Min" min = "0" value = "{{$servicio->min_personas}}">
                                                                </div >
                                                            </div >
                                                            <div class="col-6" >
                                                                <div class="form-group" >
                                                                    <label for="txt_price" class="text-secondary font-weight-bold"> Max Personas </label >

                                                                    <input type = "number" class="form-control" id = "txt_max_personas_{{$servicio->id}}" name = "txt_max_personas_{{$servicio->id}}" placeholder = "Min" min = "0" value = "{{$servicio->max_personas}}" >
                                                                </div >
                                                            </div >
                                                        @endif
                                                        @if ($servicio->grupo == 'TOURS')
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    @if ($servicio->precio_grupo == 1)
                                                                        {{--<div class="col-12">--}}
                                                                        {{--<label for="txt_price" class="text-secondary font-weight-bold">Type price</label><br>--}}
                                                                        {{--</div>--}}
                                                                        <div class="col-6">
                                                                            <label class=" text-g-green" >

                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" checked = "checked" >
                                                                                Precio es absoluto
                                                                            </label >
                                                                        </div >

                                                                        <div class="col-6">
                                                                            {{--<label for="txt_price" class="text-secondary font-weight-bold">Tipe price</label><br>--}}
                                                                            <label class=" text-g-green" >

                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" >
                                                                                Precio es individual
                                                                            </label >
                                                                        </div >
                                                                    @else

                                                                        {{--<div class="col-6">--}}
                                                                        {{--<label for="txt_price" class="text-secondary font-weight-bold">Type price</label><br>--}}
                                                                        {{--</div>--}}
                                                                        <div class="col-6">
                                                                            {{--<label for="txt_price" class="text-secondary font-weight-bold">Tipe price</label><br>--}}
                                                                            <label class="text-danger" >

                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" >
                                                                                Precio es absoluto
                                                                            </label >
                                                                        </div >

                                                                        <div class="col-6">
                                                                            {{--<label for="txt_price" class="text-secondary font-weight-bold">Tipe price</label><br>--}}
                                                                            <label class="text-danger" >

                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" checked = "checked" >
                                                                                Precio es individual
                                                                            </label >
                                                                        </div >
                                                                    @endif
                                                                </div >
                                                            </div >
                                                        @endif
                                                        @if ($servicio->grupo == 'MOVILID')
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    @if ($servicio->precio_grupo == 1)
                                                                        <div class="col-6">
                                                                            <label class="text-danger">
                                                                                <input type="radio" name="txt_tipo_grupo_{{$servicio->id}}" value="Absoluto" checked="checked">
                                                                                Precio es absoluto
                                                                            </label>
                                                                        </div>

                                                                        <div class="col-6">
                                                                            <label class="text-danger">

                                                                                <input type="radio" name="txt_tipo_grupo_{{$servicio->id}}" value="Individual">
                                                                                Precio es individual
                                                                            </label>
                                                                        </div>
                                                                    @else

                                                                        <div class="col-6">
                                                                            <label class="text-danger">
                                                                                <input type="radio" name="txt_tipo_grupo_{{$servicio->id}}" value="Absoluto">
                                                                                Precio es absoluto
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <label class="text-danger">
                                                                                <input type="radio" name="txt_tipo_grupo_{{$servicio->id}}" value="Individual" checked="checked">
                                                                                Precio es individual
                                                                            </label>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($servicio->grupo == 'REPRESENT')
                                                            <div class="col-12">
                                                                <div class="row" >
                                                                    @if ($servicio->precio_grupo == 1)
                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class="text-danger" >

                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" checked = "checked" >
                                                                                Precio es absoluto
                                                                            </label >
                                                                        </div>

                                                                        <div class="col-6 d-none" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class="text-danger">

                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" >
                                                                                Precio es individual
                                                                            </label >
                                                                        </div>
                                                                    @else

                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >

                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" >
                                                                                Precio es absoluto
                                                                            </label >
                                                                        </div >
                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" checked = "checked" >
                                                                                Precio es individual
                                                                            </label >
                                                                        </div >
                                                                    @endif
                                                                </div >
                                                            </div>
                                                        @endif
                                                        @if ($servicio->grupo == 'ENTRANCES')
                                                            <div class="col-12">
                                                                <div class="row" >
                                                                    @if ($servicio->precio_grupo == 1)
                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" checked = "checked" >
                                                                                Precio es absoluto
                                                                            </label >
                                                                        </div >
                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" >
                                                                                Precio es individual
                                                                            </label >
                                                                        </div >
                                                                    @else
                                                                        <div class="col-6 d-none" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" >
                                                                                Precio es absoluto
                                                                            </label >
                                                                        </div >

                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" checked = "checked" >
                                                                                Precio es individual
                                                                            </label >
                                                                        </div >
                                                                    @endif
                                                                </div >
                                                            </div >
                                                        @endif
                                                        @if ($servicio->grupo == 'FOOD')
                                                            <div class="col-12" >
                                                                <div class="row" >
                                                                    @if ($servicio->precio_grupo == 1)
                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" checked = "checked" >
                                                                                Precio es absoluto
                                                                            </label >
                                                                        </div >
                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" >
                                                                                Precio es individual
                                                                            </label >
                                                                        </div >
                                                                    @else
                                                                        <div class="col-6 d-none" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" >
                                                                                Precio es absoluto
                                                                            </label >
                                                                        </div >
                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" checked = "checked" >
                                                                                Precio es individual
                                                                            </label >
                                                                        </div >
                                                                    @endif
                                                                </div >
                                                            </div >
                                                        @endif
                                                        @if ($servicio->grupo == 'TRAINS')
                                                            <div class="col-12">
                                                                <div class="row" >
                                                                    @if ($servicio->precio_grupo == 1)
                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" checked = "checked" >
                                                                                Precio es absoluto
                                                                            </label >
                                                                        </div>

                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger">
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" >
                                                                                Precio es individual
                                                                            </label>
                                                                        </div >
                                                                    @else

                                                                        <div class="col-md-6 d-none" >
                                                                            <label for="txt_price">Tipe price</label><br>
                                                                            <label class=" text-green-goto" ></label>
                                                                        </div>
                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger">

                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" checked = "checked" >
                                                                                Precio es individual
                                                                            </label >
                                                                        </div>
                                                                    @endif
                                                                </div >
                                                            </div >
                                                        @endif
                                                        @if ($servicio->grupo == 'FLIGHTS')

                                                            <div class="col-12" >
                                                                <div class="row" >
                                                                    @if ($servicio->precio_grupo == 1)
                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >

                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" checked = "checked" >
                                                                                Precio es absoluto
                                                                            </label >
                                                                        </div >
                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" >
                                                                                Precio es individual
                                                                            </label >
                                                                        </div >
                                                                    @else
                                                                        <div class="col-6 d-none" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" >
                                                                                Precio es absoluto
                                                                            </label >
                                                                        </div >

                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" checked = "checked" >
                                                                                Precio es individual
                                                                            </label >
                                                                        </div >
                                                                    @endif
                                                                </div >
                                                            </div >
                                                        @endif
                                                        @if ($servicio->grupo == 'OTHERS')
                                                            <div class="col-12">
                                                                <div class="row" >
                                                                    @if ($servicio->precio_grupo == 1)
                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" checked = "checked" >
                                                                                Precio es absoluto
                                                                            </label >
                                                                        </div >

                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >

                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" >
                                                                                Precio es individual
                                                                            </label >
                                                                        </div >
                                                                    @else

                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >

                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Absoluto" >
                                                                                Precio es absoluto
                                                                            </label >
                                                                        </div >

                                                                        <div class="col-6" >
                                                                            {{--<label for="txt_price" class="font-weight-bold text-secondary">Tipe price</label><br>--}}
                                                                            <label class=" text-danger" >
                                                                                <input type = "radio" name = "txt_tipo_grupo_{{$servicio->id}}" value = "Individual" checked = "checked" >
                                                                                Precio es individual
                                                                            </label >
                                                                        </div >
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @php
                                                            $pos++;
                                                        @endphp

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col d-flex">
                                                <div class="card p-2 text-left w-100">
                                                    <div class="row">
                                                        <div class="col">
                                                            <p><b class="text-g-green font-weight-bold">Proveedores</b></p>
                                                        </div>
                                                        <div class="col-1"></div>
                                                        <div class="col-7">
                                                            <p><b class="text-g-green">Proveedor/Costo</b></p>
                                                        </div>
                                                    </div>
                                                    <div class="row align-items-center">
                                                        <div id="lista_proveedores_{{$servicio->id}}_{{$destino[0]}}" class="col">
                                                            @if($destino[1]!='TRAINS')
                                                                @foreach ($proveedores as $proveedor)
                                                                    <div class="">
                                                                        <label class="text-primary">
                                                                            <input class="proveedores_{{$servicio->id}}" type="checkbox" aria-label="..." name="proveedores_[]" value="{{$proveedor->id}}_{{$proveedor->nombre_comercial}}">
                                                                            {{strtoupper($proveedor->nombre_comercial)}}
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="col-1">
                                                            <a href="#!" class="btn btn-primary" onclick="Pasar_pro('{{$categoria_id}}','{{$destino[1]}}','{{$servicio->id}}')">
                                                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                                            </a>
                                                        </div>
                                                        <div class="col-7">
                                                            @php
                                                                $proveedor_costito=0;
                                                            @endphp
                                                            <div id="lista_costos_{{$destino[1]}}_{{$id}}_{{$servicio->id}}">
                                                                @foreach ($costos->where('m_servicios_id',$servicio->id)->where('grupo', $destino[1])->where('localizacion',$servicio->localizacion)->unique() as $costo)
                                                                    <div id="fila_p_{{$servicio->id}}_{{$costo->id}}_{{$costo->proveedor->id}}" class="row align-items-center">
                                                                        <div class="col-5">
                                                                            <i class="fas fa-check text-success"></i>
                                                                            <span class="fila_proveedores_{{$servicio->id}}_{{$destino[1]}}">{{ucwords(strtolower($costo->proveedor->nombre_comercial))}}</span>
                                                                        </div>
                                                                        <div class="col">
                                                                            <input name="costo_id[]" type="hidden" value="{{$costo->id}}">
                                                                            <input name="costo_val[]" type="number" class="form-control form-control-sm my-2" value="{{$costo->precio_costo}}">
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <button type="button" class="btn btn-danger btn-sm" onclick="eliminar_proveedor_comprobando('{{$servicio->id}}','{{$costo->id}}','{{$costo->proveedor->id}}','{{$costo->proveedor->nombre_comercial}}')">
                                                                                <i class="fas fa-trash" aria-hidden="true"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    @php
                                                                        $proveedor_costito=$costo->id;
                                                                    @endphp
                                                                @endforeach
                                                                @php
                                                                    $nro_tresnes=$costos->where('m_servicios_id',$servicio->id)->where('grupo', $destino[1])->where('localizacion',$servicio->localizacion)->count();
                                                                @endphp
                                                                {{--@if($nro_tresnes>0)--}}
                                                                {{--<div id="fila_p_{{$servicio->id}}_{{$costo->id}}_{{$costo->proveedor->id}}" class="row align-items-center">--}}
                                                                {{--<div class="col-5">--}}
                                                                {{--<i class="fas fa-check text-success"></i>--}}
                                                                {{--<span class="fila_proveedores_{{$servicio->id}}_{{$destino[1]}}">{{ucwords(strtolower($costo->proveedor->nombre_comercial))}}</span>--}}
                                                                {{--</div>--}}
                                                                {{--<div class="col">--}}
                                                                {{--<input name="costo_id[]" type="hidden" value="{{$costo->id}}">--}}
                                                                {{--<input name="costo_val[]" type="number" class="form-control form-control-sm my-2" value="{{$costo->precio_costo}}">--}}
                                                                {{--</div>--}}
                                                                {{--<div class="col-3">--}}
                                                                {{--<button type="button" class="btn btn-danger btn-sm" onclick="eliminar_proveedor_comprobando('{{$servicio->id}}','{{$costo->id}}','{{$costo->proveedor->id}}','{{$costo->proveedor->nombre_comercial}}')">--}}
                                                                {{--<i class="fas fa-trash" aria-hidden="true"></i>--}}
                                                                {{--</button>--}}
                                                                {{--</div>--}}
                                                                {{--</div>--}}
                                                                {{--@endif--}}
                                                            </div>
                                                            <input type="hidden" id="id_lista_costos_{{ $destino[1]}}_{{ $id}}_{{$servicio->id}}" value="{{ $proveedor_costito }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        {{csrf_field()}}
                                        <input type="hidden" name="id" value="{{$servicio->id}}">
                                        <input type="hidden" name="posTipo" id="posTipo" value="0">
                                        <input type="hidden" name="grupo_{{$servicio->id}}" id="grupo_{{$servicio->id}}" value="{{$destino[1]}}">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="editar_producto('{{$servicio->id}}')">Save changes</button>
                                    </div>
                                    <div id="result_{{$servicio->id}}" class="bg-success text-15 text-center"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm" onclick="eliminar_servicio('{{$servicio->localizacion}}','{{$servicio->id}}','{{$servicio->nombre}}')">
                        <i class="fa fa-trash"></i>
                    </button>
                    {{ csrf_field() }}
                    <input type="hidden" id="estado_servicio_{{$servicio->id}}" value="{{$servicio->estado}}">
                    <button id="btn_{{$servicio->id}}" type="button" class="btn btn-sm" onclick="cambiar_estado('{{$servicio->nombre}}','estado_servicio_','{{$servicio->id}}')">
                        @if($servicio->estado==0)
                            <i class="fas fa-toggle-off text-unset"></i>
                        @elseif($servicio->estado==1)
                            <i class="fas fa-toggle-on text-success"></i>
                        @endif
                        
                    </button>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>