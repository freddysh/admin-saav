@if($action=='a')
    @if($productos->count()==0)
        <b class="text-danger">No tenemos proveedores disponibles!</b>
    @else
        <table>
            <thead>
                <tr>
                    <th>PROVEEDOR</th>
                    <th>CALCULO</th>
                    <th>PRECIO</th>
                    <th>NOTAS</th>
                </tr>
            </thead>
            <tbody>
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
                <tr>
                    <td>
                        <label>
                            <input class="grupo" type="radio" onchange="dato_producto('{{$producto->id}}','{{$producto->proveedor_id}}','{{$servicios->id}}','{{$itinerario_id}}')" name="precio[]" value="{{$cotizacion->id}}_{{$servicios->id}}_{{$producto->proveedor->id}}_{{$precio_book}}">
                            {{$producto->proveedor->nombre_comercial}} para {{$producto->tipo_producto}} - {{$producto->clase}}
                            @if($producto->grupo=='TRAINS')
                                <span class="small text-grey-goto">[Sal: {{$servicios->salida}} - Lleg:{{$servicios->llegada}}]</span>
                            @endif
                        </label>
                    </td>
                    <td>
                        <input type="hidden" id="proveedor_servicio_{{$producto->id}}" value="{{$producto->proveedor->nombre_comercial}}">                        
                        <small>$</small>
                        @if($producto->precio_grupo==1)
                            {{$producto->precio_costo*1}}
                        @else
                            {{$producto->precio_costo}}x{{$cotizacion->nropersonas}}
                        @endif
                    </td>
                    <td>
                        <small>$</small>
                        @if($producto->precio_grupo==1)
                            {{number_format($producto->precio_costo,2)}}
                            <input type="hidden" id="book_price_{{$producto->id}}" value="{{ $producto->precio_costo}}">
                        @else
                            {{number_format($producto->precio_costo*$cotizacion->nropersonas,2)}}
                            {{--<input type="hidden" id="book_price_{{$producto->id}}" value="{{$producto->precio_costo}}x{{$cotizacion->nropersonas}}={{$producto->precio_costo*$cotizacion->nropersonas}}">--}}
                            <input type="hidden" id="book_price_{{$producto->id}}" value="{{$producto->precio_costo*$cotizacion->nropersonas}}">
                        @endif
                    </td>
                    <td>
                        <span class="text-primary">{{$producto->proveedor->tipo_proveedor}} | {{$producto->proveedor->tipo_pago}} Se paga {{$producto->proveedor->plazo}} {{$producto->proveedor->desci}}</span>
                    </td>
                </tr>                
            @endforeach
            </tbody>
        </table>
    @endif
@elseif($action=='e')
    @if($productos->count()==0)
    <b class="text-danger">No tenemos proveedores disponibles!</b>
    @else
        <table>
            <thead>
                <tr>
                    <th>PROVEEDOR</th>
                    <th>CALCULO</th>
                    <th>PRECIO</th>
                    <th>NOTAS</th>
                </tr>
            </thead>
            <tbody>
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
                        <tr>
                            <td>
                                <label class="text-grey-goto">
                                    <input class="grupo" type="radio" onchange="dato_producto('{{$producto->id}}','{{$producto->proveedor_id}}','{{$servicios->id}}','{{$itinerario_id}}')" name="precio[]" value="{{$cotizacion->id}}_{{$servicios->id}}_{{$producto->proveedor->id}}_{{$precio_book}}" {!! $valor_chk !!}>
                                    
                                    {{$producto->proveedor->nombre_comercial}} para {{$producto->tipo_producto}} - {{$producto->clase}}
                                    @if($producto->grupo=='TRAINS')
                                        <span class="small text-grey-goto" >[Sal: {{$servicios->salida}} - Lleg:{{$servicios->llegada}}]</span>
                                    @endif
                                    <input type="hidden" id="proveedor_servicio_{{$producto->id}}" value="{{$producto->proveedor->nombre_comercial}}">
                                </label>        
                            </td>
                            <td>
                                <small>$</small>
                                @php
                                    $producto_id_=$producto->id;   
                                @endphp
                                @if($producto->precio_grupo==1)
                                    {{$producto->precio_costo*1}}
                                    <input type="hidden" id="book_price_{{$producto->id}}" value="{{$producto->precio_costo*1}}">
                                @else
                                    {{$producto->precio_costo}}x{{$cotizacion->nropersonas}}
                                    <input type="hidden" id="book_price_{{$producto->id}}" value="{{$producto->precio_costo*$cotizacion->nropersonas}}">
                                @endif
                            </td>
                            <td>
                                <small>$</small>
                                @php
                                    $producto_id_=$producto->id;   
                                @endphp
                                @if($producto->precio_grupo==1)
                                    {{number_format($producto->precio_costo*1,2)}}
                                    <input type="hidden" id="book_price_{{$producto->id}}" value="{{$producto->precio_costo*1}}">
                                @else
                                    {{number_format($producto->precio_costo*$cotizacion->nropersonas,2)}}
                                    <input type="hidden" id="book_price_{{$producto->id}}" value="{{$producto->precio_costo*$cotizacion->nropersonas}}">
                                @endif
                            </td>
                            <td>
                                <span class="text-primary">{{$producto->proveedor->tipo_proveedor}} | {{$producto->proveedor->tipo_pago}} Se paga {{$producto->proveedor->plazo}} {{$producto->proveedor->desci}}</span>
                            </td>
                        </tr>
                        
                        {{--@endif--}}
                    {{-- @endif --}}
                @endforeach
            </tbody>
        </table>
    @endif
@endif
