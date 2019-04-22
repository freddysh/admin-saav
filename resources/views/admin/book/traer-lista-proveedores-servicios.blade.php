@if($action=='a')
    @if($productos->count()==0)
        <b class="text-danger">No tenemos proveedores disponibles!</b>
    @else
        @foreach($productos as $producto)
            @if($producto->precio_grupo==1)
                @php
                    $valor=$cotizacion->nropersonas;
                @endphp
            @else
                @php
                    $valor=1;
                @endphp
            @endif
            @php
                $precio_book=$producto->precio_costo*1;
            @endphp
            @if($producto->precio_grupo==0)
                @php
                    $precio_book=$producto->precio_costo*$cotizacion->nropersonas;
                @endphp
            @endif
            <div class="col-6">
                <div class="card  bg-light mb-3">
                    <div class="card-body">
                        <label class="text-grey-goto">
                            <p class="text-grey-goto">
                                <b>{{$producto->proveedor->nombre_comercial}} para {{$producto->tipo_producto}} - {{$producto->clase}}
                                @if($producto->grupo=='TRAINS')
                                    <span class="small text-grey-goto" >[Sal: {{$servicios->salida}} - Lleg:{{$servicios->llegada}}]</span>
                                @endif
                                </b>
                            </p>
                            <input type="hidden" id="proveedor_servicio_{{$producto->id}}" value="{{$producto->proveedor->nombre_comercial}}">
                            <input class="grupo" type="radio" onchange="dato_producto('{{$producto->id}}','{{$producto->proveedor_id}}','{{$servicios->id}}','{{$itinerario_id}}')" name="precio[]" value="{{$cotizacion->id}}_{{$servicios->id}}_{{$producto->proveedor->id}}_{{$precio_book}}">
                            <small>$</small>
                            @if($producto->precio_grupo==1)
                                {{$producto->precio_costo*1}}
                                <input type="hidden" id="book_price_{{$producto->id}}" value="{{$producto->precio_costo*1}}">
                            @else
                                {{$producto->precio_costo}}x{{$cotizacion->nropersonas}}={{$producto->precio_costo*$cotizacion->nropersonas}}
                                {{--<input type="hidden" id="book_price_{{$producto->id}}" value="{{$producto->precio_costo}}x{{$cotizacion->nropersonas}}={{$producto->precio_costo*$cotizacion->nropersonas}}">--}}
                                <input type="hidden" id="book_price_{{$producto->id}}" value="{{$producto->precio_costo*$cotizacion->nropersonas}}">
                            @endif
                            <span class="text-primary"> Se paga {{$producto->proveedor->plazo}} {{$producto->proveedor->desci}}</span>
                        </label>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@elseif($action=='e')
    @if($productos->count()==0)
    <b class="text-danger">No tenemos proveedores disponibles!</b>
    @else
        @foreach($productos as $producto)
            @php
                $valor_chk='';
            @endphp
            @if($producto->proveedor_id==$servicios->proveedor_id)
                @php
                    $valor_chk='checked=\'checked\'';
                @endphp
            @endif
            {{-- @if($producto->m_servicios_id==$servicios->m_servicios_id) --}}
                @if($producto->precio_grupo==1)
                    @php
                        $valor=$cotizacion->nropersonas;
                    @endphp
                @else
                    @php
                        $valor=1;
                    @endphp
                @endif
                @php
                    $precio_book=$producto->precio_costo*1;
                @endphp
                @if($producto->precio_grupo==0)
                    @php
                        $precio_book=$producto->precio_costo*$cotizacion->nropersonas;
                    @endphp
                @endif
                <div class="col-6">
                    <div class="card bg-light mb-3">
                        <div class="card-body">
                            <label class="text-grey-goto">
                                <p class="text-grey-goto">
                                    <b>{{$producto->proveedor->nombre_comercial}} para {{$producto->tipo_producto}} - {{$producto->clase}}
                                    @if($producto->grupo=='TRAINS')
                                        <span class="small text-grey-goto" >[Sal: {{$servicios->salida}} - Lleg:{{$servicios->llegada}}]</span>
                                    @endif
                                    </b>
                                </p>
                                <input type="hidden" id="proveedor_servicio_{{$producto->id}}" value="{{$producto->proveedor->nombre_comercial}}">
                                <input class="grupo" type="radio" onchange="dato_producto('{{$producto->id}}','{{$producto->proveedor_id}}','{{$servicios->id}}','{{$itinerario_id}}')" name="precio[]" value="{{$cotizacion->id}}_{{$servicios->id}}_{{$producto->proveedor->id}}_{{$precio_book}}" {!! $valor_chk !!}>
                                <small>$</small>
                                {{--<input class="grupo" type="radio" onchange="dato_producto({{$producto->id}})" name="precio[]" value="{{$cotizacion->id}}_{{$servicios->id}}_{{$producto->proveedor->id}}_{{$precio_book}}" {!! $valor_chk !!}>--}}
                                @php
                                    $producto_id_=$producto->id;   
                                @endphp
                                @if($producto->precio_grupo==1)
                                    {{$producto->precio_costo*1}}
                                    <input type="hidden" id="book_price_{{$producto->id}}" value="{{$producto->precio_costo*1}}">
                                @else
                                    {{$producto->precio_costo}}x{{$cotizacion->nropersonas}}={{$producto->precio_costo*$cotizacion->nropersonas}}
                                    <input type="hidden" id="book_price_{{$producto->id}}" value="{{$producto->precio_costo*$cotizacion->nropersonas}}">
                                @endif
                                <span class="text-primary"> Se paga {{$producto->proveedor->plazo}} {{$producto->proveedor->desci}}</span>
                            </label>        
                        </div>
                    </div>
                </div>
                {{--@endif--}}
            {{-- @endif --}}
        @endforeach
    @endif
@endif
