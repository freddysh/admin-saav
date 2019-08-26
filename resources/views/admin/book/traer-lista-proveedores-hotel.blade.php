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
@foreach($hotel_proveedor as $hotel_proveedor_)
    @php
        $valor_class='';
    @endphp
    @if($hotel_proveedor_->proveedor_id==$hotel->proveedor_id)
        @php
            $valor_class='checked=\'checked\'';
        @endphp
    @endif
    <tr>
        <td>
            <label>
                <input class="grupo" onchange="dato_producto_hotel('{{$hotel_proveedor_->id}}','{{$hotel_proveedor_->proveedor_id}}','{{$hotel->id}}','{{$itinerario_cotizaciones_id}}')" type="radio" name="precio" value="{{$cotizacion_id}}_{{$hotel->id}}_{{$hotel_proveedor_->proveedor_id}}_{{$hotel_proveedor_->id}}" {!! $valor_class !!}>
                <b>{{$hotel_proveedor_->proveedor->nombre_comercial}} | {{$hotel_proveedor_->estrellas}}<i class="fa fa-star text-warning" aria-hidden="true"></i></b>
                <span class="d-none" id="proveedor_servicio_hotel_{{$hotel_proveedor_->id}}">
                    {{$hotel_proveedor_->proveedor->nombre_comercial}}
                </span>
            </label>
        </td>
        <td>
            @if($hotel->personas_s>0)
                @php
                    $s=1;
                @endphp
                <p class="text-grey-goto">Single: ${{number_format($hotel_proveedor_->single*$hotel->personas_s,2)}}</p>
            @endif
            @if($hotel->personas_d>0)
                @php
                    $d=1;
                @endphp
                <p class="text-grey-goto">Double: ${{number_format($hotel_proveedor_->doble*$hotel->personas_d,2)}}</p>
            @endif
            @if($hotel->personas_m>0)
                @php
                    $m=1;
                @endphp
                <p class="text-grey-goto">Matrimonial: ${{number_format($hotel_proveedor_->matrimonial*$hotel->personas_m,2)}}</p>
            @endif
            @if($hotel->personas_t>0)
                @php
                    $t=1;
                @endphp
                <p class="text-grey-goto">Triple: ${{number_format($hotel_proveedor_->triple*$hotel->personas_t,2)}}</p>
            @endif
        </td>
        <td class="text-right">
            <span class="d-none1" id="book_price_hotel_{{$hotel_proveedor_->id}}">
                @if($hotel->personas_s>0)
                    <p id="book_price_s_{{$hotel_proveedor_->id}}">${{number_format($hotel_proveedor_->single*$hotel->personas_s,2)}}</p>
                @endif
                @if($hotel->personas_d>0)
                    <p id="book_price_d_{{$hotel_proveedor_->id}}">${{number_format($hotel_proveedor_->doble*$hotel->personas_d,2)}}</p>
                @endif
                @if($hotel->personas_m>0)
                    <p id="book_price_m_{{$hotel_proveedor_->id}}">${{number_format($hotel_proveedor_->matrimonial*$hotel->personas_m,2)}}</p>
                @endif
                @if($hotel->personas_t>0)
                    <p id="book_price_t_{{$hotel_proveedor_->id}}">${{number_format($hotel_proveedor_->triple*$hotel->personas_t,2)}}</p>
                @endif
            </span>
        </td>
        <td><span class="text-primary">{{$hotel_proveedor_->proveedor->tipo_pago}}  Se paga {{$hotel_proveedor_->proveedor->plazo}} {{$hotel_proveedor_->proveedor->desci}}</span></td>
    </tr>
@endforeach
</tbody>
</table>