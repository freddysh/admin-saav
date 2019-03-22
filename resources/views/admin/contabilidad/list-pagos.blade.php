@php
    use App\Helpers\MisFunciones;
    $dato_cliente='';
    $tiempo_dias=5;
    $color='bg-danger-goto';

    function fecha_peru($fecha){
        $fecha=explode('-',$fecha);
        return $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
    }
@endphp
{{-- @foreach($cotizacion_cat->sortBy('fecha') as $cotizacion_cat_) --}}
    
        @if($columna=='NUEVO')
            <table class="table table-bordered table-striped table-responsive table-hover text-12">
                <thead>
                    <tr>
                        <th>PAX. <span class="text-success">({{{strtoupper($pagina)}}})</span></th>
                        <th>TOTAL</th>
                        <th>PAGADO</th>
                        <th>SALDO</th>
                        <th style="width:230px;">PROX. PAGO</th>
                        <th>OPER.</th>
                    </tr>    
                </thead>
                <tbody>
                @foreach($cotizacion_cat->where('anulado','>',0)->sortBy('fecha') as $cotizacion_cat_)
                    @php
                        $hoy=\Carbon\Carbon::now();
                        $fecha_llegada=\Carbon\Carbon::createFromFormat('Y-m-d',$cotizacion_cat_->fecha);
                        $diff_dias=$hoy->diffInDays($fecha_llegada,false);
                    @endphp
                    @if($diff_dias>$tiempo_dias)
                        @php
                            $color='bg-white';
                        @endphp
                    @endif
                    @php
                        $total=0;
                        $confirmados=0;
                        $ultimo_dia=$cotizacion_cat_->fecha;
                        $itinerario='';
                        $sumatoria=0;
                    @endphp
                    @foreach($cotizacion_cat_->paquete_cotizaciones->where('estado','2') as $pqts)
                        @php
                            $total_pagado=0;
                            $proximo_pago='No hay pagos programados';
                            $proximo_monto='';
                            $recogido=0;
                        @endphp
                        @foreach($pqts->pagos_cliente as $pagos_cliente)
                            @if($pagos_cliente->estado==1)
                                @php
                                    $total_pagado+=$pagos_cliente->monto;
                                @endphp
                            @endif
                            @if($recogido==0)
                                @if($pagos_cliente->estado==0)
                                    @php
                                        $proximo_pago=$pagos_cliente->fecha;
                                        $proximo_monto=$pagos_cliente->monto;
                                        $recogido++;
                                    @endphp
                                @endif
                            @endif
                        @endforeach
                        @foreach($pqts->itinerario_cotizaciones as $itinerarios)
                            @php
                                $ultimo_dia=$itinerarios->fecha;
                                $itinerario.='<p><b class="text-primary">Dia '.$itinerarios->dias.': </b>'.date_format(date_create($itinerarios->fecha), 'jS M Y').'</p>';
                            @endphp
                            @foreach($itinerarios->itinerario_servicios as $servicios)
                                @php
                                    $total++;
                                @endphp
                                @if($servicios->precio_grupo==1)
                                    @php
                                        $sumatoria+=$servicios->precio;
                                    @endphp
                                @else
                                    @php
                                        $sumatoria+=$servicios->precio*$cotizacion_cat_->nropersonas;
                                    @endphp
                                @endif
                            @endforeach
                            @foreach($itinerarios->hotel as $hotel)
                                @php
                                    $total++;
                                @endphp
                                @if($hotel->personas_s>0)
                                    @php
                                        $sumatoria+=$hotel->personas_s*$hotel->precio_s;
                                    @endphp
                                @endif
                                @if($hotel->personas_d>0)
                                    @php
                                        $sumatoria+=$hotel->personas_d*$hotel->precio_d*2;
                                    @endphp
                                @endif
                                @if($hotel->personas_m>0)
                                    @php
                                        $sumatoria+=$hotel->personas_m*$hotel->precio_m*2;
                                    @endphp
                                @endif
                                @if($hotel->personas_t>0)
                                    @php
                                        $sumatoria+=$hotel->personas_t*$hotel->precio_t*3;
                                    @endphp
                                @endif

                            @endforeach
                        @endforeach
                    
                        @php
                            $hoy=\Carbon\Carbon::now();
                            $ultimo_dia=\Carbon\Carbon::createFromFormat('Y-m-d',$ultimo_dia);
                            $dias_restantes=$hoy->diffInDays($ultimo_dia,false);
                        @endphp
                    
                        @if($sumatoria-$total_pagado!=0)
                            <tr>
                                <td class="text-11"><b class="text-success">{{$cotizacion_cat_->codigo}}</b> | {{strtoupper($cotizacion_cat_->nombre_pax)}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'jS M Y')}}</td>
                                <td class="text-right">{{number_format($sumatoria,0)}}</td>
                                <td class="text-right">{{number_format($total_pagado,0)}}</td>
                                <td class="text-right">{{number_format($sumatoria-$total_pagado,0)}}</td>
                                <td>{{$proximo_pago}} | {{$proximo_monto}}</td>
                                <td>
                                    <a class="text-primary small" href="#!" id="archivos" data-toggle="modal" data-target="#myModal_plan_pagos_{{$pqts->id}}">Detalle
                                    </a>
                                    <div class="modal fade" id="myModal_plan_pagos_{{$pqts->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h4 class="modal-title" id="myModalLabel">Detalle de pagos</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body clearfix">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <table class="table table-stripe table-hover text-13">
                                                                <thead>
                                                                    <tr>
                                                                        <th>FECHA</th>
                                                                        <th>NOTA</th>
                                                                        <th>MONTO</th>
                                                                        <th>ESTADO</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="lista_pagos_{{$pqts->id}}">
                                                                @php
                                                                    $total_pago=0;
                                                                    
                                                                @endphp
                                                                {{-- @if(true) --}}
                                                                @php
                                                                    $k=0;
                                                                @endphp
                                                                @foreach($pqts->pagos_cliente as $pagos_cliente)
                                                                    @php
                                                                        $total_pago+=$pagos_cliente->monto;
                                                                        $k++;
                                                                    @endphp
                                                                    <tr id="pago_{{$pqts->id}}_{{$pagos_cliente->id}}">
                                                                        <td style="width:180px;">{{$pagos_cliente->fecha}}</td>
                                                                        <td>{{$pagos_cliente->nota}}</td>
                                                                        <td style="width:100px">{{$pagos_cliente->monto}}</td>
                                                                        <td>
                                                                            @if($pagos_cliente->estado=='0')
                                                                                <span class="badge badge-secondary">Pendiente</span> 
                                                                            @else
                                                                            <span class="badge badge-success">Pagado</span>
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                {{-- @endif --}}
                                                                    
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td>
                                                                            <b>SUMATORIA</b>   
                                                                        </td>
                                                                        <td>
                                                                        </td>
                                                                        <td><b>{{$total_pago}}</b></td>
                                                                        <td></td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>   
                                                            <input type="hidden" id="nro_pagos_{{$pqts->id}}" value="1">   
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                    <button type="button" class="btn btn-primary d-none">Guardar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>    
                        @endif
                    @endforeach
                @endforeach    
                </tbody>
            </table>  
        @endif
        
        
<script>
    $(document).ready(function(){
        $('[data-toggle="popover"]').popover({
            html : true,
        });
    });
</script>