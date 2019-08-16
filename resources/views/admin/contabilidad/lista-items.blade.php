{{-- @if ($grupo=='HOTELS') --}}
<div class="row mb-0-5">
    <div class="col-6  text-left">
        @php
            $notas_contabilidad='';
        @endphp
        @if($grupo=='HOTELS')
            @foreach ($consulta as $itinerario_cotizaciones)
                @foreach ($itinerario_cotizaciones->hotel as $item)   
                    @php
                        $notas_contabilidad=$item->notas_contabilidad;
                    @endphp
                @endforeach
            @endforeach
        @else
            @foreach ($consulta as $item_)   
                @foreach ($item_->itinerario_servicios->whereIn('id',$lista_items) as $item)   
                    @php
                        $notas_contabilidad=$item->notas_contabilidad;
                    @endphp
                @endforeach
            @endforeach
        @endif
        <div class="card">
            <div class="card-header">
                <i class="far fa-sticky-note"></i> Contabilidad
            </div>
            <div class="card-body">
                <p class="card-text">{!! $notas_contabilidad !!}</p>
            </div>
        </div>
    </div>
    <div class="col-6 text-left pl-0">
        @php
            $notas_contabilidad_aprovador='';
        @endphp
        @if($grupo=='HOTELS')
            @foreach ($consulta as $itinerario_cotizaciones)
                @foreach ($itinerario_cotizaciones->hotel as $item)   
                    @php
                        $notas_contabilidad_aprovador=$item->notas_contabilidad_aprovador;
                    @endphp
                @endforeach
            @endforeach
        @else
            @foreach ($consulta as $item_)   
                @foreach ($item_->itinerario_servicios->whereIn('id',$lista_items) as $item)   
                    @php
                        $notas_contabilidad_aprovador=$item->notas_contabilidad_aprovador;
                    @endphp
                @endforeach
            @endforeach
        @endif
        <div class="card">
            <div class="card-header">
                <i class="far fa-sticky-note"></i> Admintracion
            </div>
            <div class="card-body">
                <p class="card-text">{!! $notas_contabilidad_aprovador !!}</p>
            </div>
        </div>
    </div>
</div>
<table class="table table-striped table-sm table-hover">
    <thead class="bg-dark text-white">
        <tr>
            <th>FECHA USO</th>
            <th>FECHA PAGO</th>
            <th>SERVICIO</th>
            <th>MONTO VENTA</th>
            <th>MONTO RESERVA</th>
            <th>MONTO CONTA</th>
            <th>ESTADOS</th>
        </tr>
    </thead>
    <tbody>
        @php
            $fecha_pago='';
            $pos=0;
            $total_r=0;
            $total_v=0;
            $total_c=0;
        @endphp        
            @if($grupo=='HOTELS')
                @foreach ($consulta as $itinerario_cotizaciones)
                @php
                    $notas_contabilidad_aprovador='';
                @endphp
                @foreach ($itinerario_cotizaciones->hotel as $item)   
                    @php
                        $notas_contabilidad_aprovador=$item->notas_contabilidad_aprovador;
                    @endphp
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
                                    $total_v+=$item->personas_s*$item->precio_s;    
                                @endphp
                                <input class="form-control" style="width:100px" type="number" name="precio_s[]" value="{{$item->personas_s*$item->precio_s}}" readonly>
                                                        
                            @endif
                            @if ($item->personas_d>0)
                                @php
                                    $total_v+=$item->personas_d*$item->precio_d_r;    
                                @endphp
                                <input class="form-control" style="width:100px" type="number" name="precio_d[]" value="{{$item->personas_d*$item->precio_d}}" readonly>
                            
                            @endif
                            @if ($item->personas_m>0)
                                @php
                                    $total_v+=$item->personas_m*$item->precio_m_r;    
                                @endphp
                                <input class="form-control" style="width:100px" type="number" name="precio_m[]" value="{{$item->personas_m*$item->precio_m}}" readonly>
                                
                            @endif
                            @if ($item->personas_t>0)
                                @php
                                    $total_v+=$item->personas_t*$item->precio_t_r;    
                                @endphp
                                <input class="form-control" style="width:100px" type="number" name="precio_t[]" value="{{$item->personas_t*$item->precio_t}}" readonly>
                                
                            @endif
                        </td>
                        <td class="text-right">
                            @if ($item->personas_s>0)
                                @php
                                    $total_r+=$item->personas_s*$item->precio_s_r;    
                                @endphp
                                <input class="form-control" style="width:100px" type="number" name="precio_s_r[]" value="{{$item->personas_s*$item->precio_s_r}}" readonly>
                                                        
                            @endif
                            @if ($item->personas_d>0)
                                @php
                                    $total_r+=$item->personas_d*$item->precio_d_r;    
                                @endphp
                                <input class="form-control" style="width:100px" type="number" name="precio_d_r[]" value="{{$item->personas_d*$item->precio_d_r}}" readonly>
                                
                            @endif
                            @if ($item->personas_m>0)
                                @php
                                    $total_r+=$item->personas_m*$item->precio_m_r;    
                                @endphp
                                <input class="form-control" style="width:100px" type="number" name="precio_m_r[]" value="{{$item->personas_m*$item->precio_m_r}}" readonly>
                                
                            @endif
                            @if ($item->personas_t>0)
                                @php
                                    $total_r+=$item->personas_t*$item->precio_t_r;    
                                @endphp
                                <input class="form-control" style="width:100px" type="number" name="precio_t_r[]" value="{{$item->personas_t*$item->precio_t_r}}" readonly>
                                
                            @endif
                        </td>
                        <td class="text-right">
                            @if ($item->personas_s>0)
                                @php
                                    $total_c+=$item->personas_s*$item->precio_s_c;    
                                @endphp
                                <input class="form-control" style="width:100px" type="number" name="precio_s_c_{{$clave}}[]" step="0.01" min="1" value="{{$item->personas_s*$item->precio_s_c}}" onchange="sumar_hotel_subtotales('{{$clave}}')"  @if($operacion=='aprobar') readonly @endif>
                                <input type="hidden" name="hotel_id_s[]" value="{{$item->id}}">
                                <input type="hidden" name="personas_s[]" value="{{$item->personas_s}}">                            
                            @endif
                            @if ($item->personas_d>0)
                                @php
                                    $total_c+=$item->personas_d*$item->precio_d_c;    
                                @endphp
                                <input class="form-control" style="width:100px" type="number" name="precio_d_c_{{$clave}}[]" step="0.01" min="1" value="{{$item->personas_d*$item->precio_d_c}}" onchange="sumar_hotel_subtotales('{{$clave}}')" @if($operacion=='aprobar') readonly @endif>
                                <input type="hidden" name="hotel_id_d[]" value="{{$item->id}}">  
                                <input type="hidden" name="personas_d[]" value="{{$item->personas_d}}">
                            @endif
                            @if ($item->personas_m>0)
                                @php
                                    $total_c+=$item->personas_m*$item->precio_m_c;    
                                @endphp
                                <input class="form-control" style="width:100px" type="number" name="precio_m_c_{{$clave}}[]" step="0.01" min="1" value="{{$item->personas_m*$item->precio_m_c}}" onchange="sumar_hotel_subtotales('{{$clave}}')" @if($operacion=='aprobar') readonly @endif>
                                <input type="hidden" name="hotel_id_m[]" value="{{$item->id}}">
                                <input type="hidden" name="personas_m[]" value="{{$item->personas_m}}">  
                            @endif
                            @if ($item->personas_t>0)
                                @php
                                    $total_c+=$item->personas_t*$item->precio_t_c;    
                                @endphp
                                <input class="form-control" style="width:100px" type="number" name="precio_t_c_{{$clave}}[]" step="0.01" min="1" value="{{$item->personas_t*$item->precio_t_c}}" onchange="sumar_hotel_subtotales('{{$clave}}')" @if($operacion=='aprobar') readonly @endif>
                                <input type="hidden" name="hotel_id_t[]" value="{{$item->id}}">  
                                <input type="hidden" name="personas_t[]" value="{{$item->personas_t}}">
                            @endif
                        </td>
                        <td>
                            @if($item->precio_confirmado_contabilidad=='1')
                                <b class="badge badge-success">Confirmado</b>
                            @elseif($item->precio_confirmado_contabilidad=='0')
                                <b class="badge badge-warning">Sin confirmar</b>
                            @endif
                        </td>
                    </tr>
                @endforeach
                @endforeach  
            @else
                @foreach ($consulta as $item_)
                    @foreach ($item_->itinerario_servicios->whereIn('id',$lista_items) as $item)   
                        @php
                            $notas_contabilidad_aprovador=$item->notas_contabilidad_aprovador;
                        @endphp
                        @if ($pos==0)
                            @php
                                $fecha_pago=$item->fecha_venc;
                                $pos++;
                            @endphp    
                        @endif            
                        <tr>
                            <td><i class="fas fa-calendar"></i> {{MisFunciones::fecha_peru($item_->fecha)}}</td>
                            <td><i class="fas fa-calendar"></i> {{MisFunciones::fecha_peru($fecha_pago)}}</td>
                            <td class="text-left">
                            @if($item->grupo=='TOURS')
                                <i class="fas fa-map text-info" aria-hidden="true"></i>
                            @endif
                            @if($item->grupo=='MOVILID')
                                @if($clase=='BOLETO')
                                    <i class="fas fa-ticket-alt text-warning" aria-hidden="true"></i>
                                @else
                                    <i class="fa fa-bus text-warning" aria-hidden="true"></i>
                                @endif
                            @endif
                                    
                            @if($item->grupo=='REPRESENT')
                                <i class="fa fa-users text-success" aria-hidden="true"></i>
                            @endif
                            @if($item->grupo=='ENTRANCES')
                            <i class="fas fa-ticket-alt text-warning" aria-hidden="true"></i>
                            @endif
                            @if($item->grupo=='FOOD')
                                <i class="fas fa-utensils text-danger" aria-hidden="true"></i>
                            @endif
                            @if($item->grupo=='TRAINS')
                                <i class="fa fa-train text-info" aria-hidden="true"></i>
                            @endif
                            @if($item->grupo=='FLIGHTS')
                                <i class="fa fa-plane text-primary" aria-hidden="true"></i>
                            @endif
                            @if($item->grupo=='OTHERS')
                                <i class="fa fa-question fa-text-success" aria-hidden="true"></i>
                            @endif    
                            {{$item->nombre}}</td>                    
                            </td>
                            <td class="text-right">
                                @if ($item->precio_grupo==1)
                                    @php
                                        $total_v+=$item->precio;    
                                    @endphp
                                    <input class="form-control d-none" style="width:100px" type="number" name="precio_s[]" value="{{$item->precio}}" readonly>
                                    <span><b class="text-success"><sup>$</sup></b><b>{{number_format($item->precio,2)}}</b></span>
                                @elseif ($item->precio_grupo==0)
                                    @php
                                        $total_v+=$nro_personas*$item->precio;    
                                    @endphp
                                    <input class="form-control d-none" style="width:100px" type="number" name="precio_s[]" value="{{$nro_personas*$item->precio}}" readonly>
                                    <span><b class="text-success"><sup>$</sup></b><b>{{number_format($nro_personas*$item->precio,2)}}</b></span>
                                @endif
                            </td>
                            <td class="text-right">
                                @if ($item->precio_grupo==1)
                                    @php                               
                                        $total_r+=$item->precio_proveedor;  
                                    @endphp
                                    <input class="form-control d-none" style="width:100px" type="number" name="precio_s_r[]" value="{{$item->precio_proveedor}}" readonly>                    <span><b class="text-success"><sup>$</sup></b><b>{{number_format($item->precio_proveedor,2)}}</b></span>
                                @elseif ($item->precio_grupo==0)
                                    @php                               
                                        $total_r+=$item->precio_proveedor;  
                                    @endphp
                                    <input class="form-control d-none" style="width:100px" type="number" name="precio_s_r[]" value="{{$item->precio_proveedor}}" readonly>
                                    <span><b class="text-success"><sup>$</sup></b><b>{{number_format($item->precio_proveedor,2)}}</b></span>
                                @endif
                            </td>
                            <td class="text-right">
                                {{-- @if ($item->precio_grupo==1) --}}
                                    @php
                                        $total_c+=$item->precio_c;    
                                    @endphp
                                    <input class="form-control" style="width:100px" type="number" name="precio_s_c_{{$clave}}[]" step="0.01" min="1" value="{{$item->precio_c}}" onchange="sumar_hotel_subtotales('{{$clave}}')"  @if($operacion=='aprobar') readonly @endif>
                                    <input type="hidden" name="hotel_id_s[]" value="{{$item->id}}">
                                    <input type="hidden" name="personas_s[]" value="{{$nro_personas}}">                           
                                {{-- @elseif ($item->precio_grupo==0)
                                    @php
                                        $total_c+=$item->precio_c;    
                                    @endphp
                                    <input class="form-control" style="width:100px" type="number" name="precio_s_c_{{$clave}}[]" step="0.01" min="1" value="{{$item->precio_c}}" onchange="sumar_hotel_subtotales('{{$clave}}')"  @if($operacion=='aprobar') readonly @endif>
                                    <input type="hidden" name="hotel_id_s[]" value="{{$item->id}}">
                                    <input type="hidden" name="personas_s[]" value="{{$nro_personas}}">
                                @endif --}}
                            </td>
                            <td>
                            @if($item->precio_confirmado_contabilidad=='1')
                                <b class="badge badge-success">Confirmado</b>
                            @elseif($item->precio_confirmado_contabilidad=='0')
                                <b class="badge badge-warning">Sin confirmar</b>
                            @endif
                        </td>
                        </tr>    
                    @endforeach
                @endforeach
            @endif      
            <tr>
                <td colspan="3">TOTAL</td>
                <td>
                    <b id="total" class="text-15">
                    <input class="form-control d-none" style="width:100px" type="number" name="precio" value="{{$total_v}}" readonly></b>
                    <span><b class="text-success"><sup>$</sup></b><b>{{number_format($total_v,2)}}</b></span>
                </td>
                <td>
                    <b id="total" class="text-15">
                    <input class="form-control d-none" style="width:100px" type="number" name="precio" value="{{$total_r}}" readonly></b>
                    <span><b class="text-success"><sup>$</sup></b><b>{{number_format($total_r,2)}}</b></span>
                </td>
                <td>
                    <b id="total" class="text-15">
                    <input class="form-control" style="width:100px" type="number" name="precio_total_{{$clave}}" id="precio_total_{{$clave}}" name="precio" value="{{$total_c}}" readonly></b>
                </td>
                <td></td>
            </tr>
    </tbody>
</table>
{{-- <p class="text-success">
    operacion:{{$operacion}}
</p> --}}

<div class="row">
    <div class="col-8 
    @if($operacion=='ver')
        nada
    @elseif($operacion=='pagar')
        @if($estado_contabilidad=='4') nada @else d-none @endif
    @elseif($operacion=='aprobar')
        d-none
    @endif
    ">
        <label class="sr-only" for="fecha_venc">Fecha de pago</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-calendar"></i></div>
            </div>
            <input type="date" class="form-control" id="fecha_venc" name="fecha_venc" value="{{$fecha_pago}}">
        </div>
    </div>

    
    <div class="col-4 
    @if($operacion=='ver')
        nada
    @elseif($operacion=='pagar')
        @if($estado_contabilidad=='4') nada @else d-none @endif
    @elseif($operacion=='aprobar')
        d-none
    @endif
    ">
        {{ csrf_field() }}
        <input type="hidden"  name="nro_personas" value="{{$nro_personas}}">
        <input type="hidden"  name="clave" value="{{$clave}}">
        <input type="hidden"  name="grupo" value="{{$grupo}}">
        <input type="hidden"  name="operacion" value="{{$operacion}}">
        <button class="btn btn-primary" type="button" onclick="contabilidad_hotel_store('{{$grupo}}','{{$clave}}')">Guardar</button>
    </div>
    <div class="col-12 @if($operacion=='aprobar') nada @else d-none @endif">
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-sticky-note"></i></div>
            </div>
        <textarea class="form-control" name="notas" id="notas" cols="30" rows="10" placeholder="Puede ingresar un nota para contabilidad">{{$notas_contabilidad_aprovador}}</textarea>
        </div>
    </div>
    <div class="col-12 mt-2 text-right @if($operacion=='aprobar') nada @else d-none @endif">
        {{ csrf_field() }}
        <input type="hidden"  name="nro_personas" value="{{$nro_personas}}">
        <input type="hidden"  name="clave" value="{{$clave}}">
        <input type="hidden"  name="operacion" value="{{$operacion}}">
        <input type="hidden"  name="grupo" value="{{$grupo}}">
        <button class="btn btn-primary" type="button" onclick="contabilidad_hotel_store_notas('{{$grupo}}_{{$clave}}')">Guardar Observaciones</button>
    </div>
    <div class="col-12" id="rpt_{{$grupo}}_{{$clave}}">
    </div>
</div>

{{-- @endif --}}

