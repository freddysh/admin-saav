@if ($grupo=='HOTELS')
<table class="table table-striped table-sm table-hover">
    <thead>
        <tr>
            <th>FECHA USO</th>
            <th>FECHA PAGO</th>
            <th>HOTEL</th>
            <th>MONTO</th>
        </tr>
    </thead>
    <tbody>
        @php
            $fecha_pago='';
            $pos=0;
            $total=0;
        @endphp
        @foreach ($consulta as $itinerario_cotizaciones)
            @foreach ($itinerario_cotizaciones->hotel as $item)   
            @if ($pos==0)
                @php
                    $fecha_pago=$item->fecha_venc;
                    $pos++;
                @endphp    
            @endif
            
                <tr>
                    <td><i class="fas fa-calendar"></i> {{MisFunciones::fecha_peru($itinerario_cotizaciones->fecha)}}</td>
                    <td><i class="fas fa-calendar"></i> {{MisFunciones::fecha_peru($fecha_pago)}}</td>
                    <td>
                        @if ($item->personas_s>0)
                            <p class="mt-2">{{$item->personas_s}} <i class="fas fa-bed text-primary"></i></p>    
                        @endif
                        @if ($item->personas_d>0)
                            <p class="mt-2">{{$item->personas_d}} <i class="fas fa-bed text-primary"></i><i class="fas fa-bed text-primary"></i></p>    
                        @endif
                        @if ($item->personas_m>0)
                            <p class="mt-2">{{$item->personas_m}} <i class="fas fa-transgender text-primary"></i></p>    
                        @endif
                        @if ($item->personas_t>0)
                            <p class="mt-2">{{$item->personas_t}} <i class="fas fa-bed text-primary"></i><i class="fas fa-bed text-primary"></i><i class="fas fa-bed text-primary"></i></p>    
                        @endif
                    </td>
                    <td class="text-right">
                        @if ($item->personas_s>0)
                            @php
                                $total+=$item->personas_s*$item->precio_s_r;    
                            @endphp
                            <input class="form-control" style="width:100px" type="number" name="precio_s[]" value="{{$item->personas_s*$item->precio_s_r}}">
                            <input type="hidden" name="hotel_id_s[]" value="{{$item->id}}">
                            <input type="hidden" name="personas_s[]" value="{{$item->personas_s}}">                              
                        @endif
                        @if ($item->personas_d>0)
                            @php
                                $total+=$item->personas_d*$item->precio_d_r;    
                            @endphp
                            <input class="form-control" style="width:100px" type="number" name="precio_d[]" value="{{$item->personas_d*$item->precio_d_r}}">
                            <input type="hidden" name="hotel_id_d[]" value="{{$item->id}}">  
                            <input type="hidden" name="personas_d[]" value="{{$item->personas_d}}">
                        @endif
                        @if ($item->personas_m>0)
                            @php
                                $total+=$item->personas_m*$item->precio_m_r;    
                            @endphp
                            <input class="form-control" style="width:100px" type="number" name="precio_m[]" value="{{$item->personas_m*$item->precio_m_r}}">
                            <input type="hidden" name="hotel_id_m[]" value="{{$item->id}}">
                            <input type="hidden" name="personas_m[]" value="{{$item->personas_m}}">  
                        @endif
                        @if ($item->personas_t>0)
                            @php
                                $total+=$item->personas_t*$item->precio_t_r;    
                            @endphp
                            <input class="form-control" style="width:100px" type="number" name="precio_t[]" value="{{$item->personas_t*$item->precio_t_r}}">
                            <input type="hidden" name="hotel_id_t[]" value="{{$item->id}}">  
                            <input type="hidden" name="personas_t[]" value="{{$item->personas_t}}">
                        @endif
                    </td>
                </tr>
            @endforeach
        @endforeach        
            <tr>
                <td colspan="3">TOTAL</td>
                <td><b id="total" class="text-15">
                        <input class="form-control" style="width:100px" type="number" name="precio" value="{{$total}}" disabled></b></td></tr>
    </tbody>
</table>
    
<div class="row">
    <div class="col-8">
        <label class="sr-only" for="inlineFormInputGroupUsername">Fecha de pago</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-calendar"></i></div>
            </div>
            <input type="date" class="form-control" id="fecha_venc" name="fecha_venc" value="{{$fecha_pago}}">
        </div>
    </div>
    <div class="col-4">
        {{ csrf_field() }}
        <input type="hidden"  name="nro_personas" value="{{$nro_personas}}">
        <button class="btn btn-primary" type="button" onclick="contabilidad_hotel_store('{{$clave}}')">Guardar</button>
    </div>
    <div class="col-12" id="rpt_{{$clave}}">
    </div>
</div>
@endif
