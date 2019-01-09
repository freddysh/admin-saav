@php
    function fecha_peru($fecha){
    if(strlen(trim($fecha))>0){
        $fecha=explode('-',$fecha);
        return $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
        }
    }
@endphp
<div class="row">
    <div class="col-10">
        <b>{{$opcion}}</b>
        <b class="text-unset @if($opcion=='TODOS LOS PENDIENTES'||$opcion=='TODOS LOS URGENTES') d-none @endif">LIQUIDACION DESDE: <span class="text-green-goto">{{fecha_peru($ini)}}</span> - HASTA: <span class="text-green-goto">{{fecha_peru($fin)}}</span></b>
        <div class="row">
            <div class="col-12">
                @php
                    $total=0;
                @endphp
                <table  class="table table-bordered table-striped table-responsive table-hover table-condensed">
                    <thead>
                        <tr>
                            <th width="150px">FECHA USO</th>
                            <th width="150px">FECHA DE PAGO</th>
                            <th width="40px">CLASE</th>
                            <th width="250px">SERVICIO</th>
                            <th width="30px">AD</th>
                            <th width="300px">PAX</th>
                            <th width="50px">$ AD</th>
                            <th width="50px">TOTAL</th>
                            <th width="50px">PRIORIDAD</th>
                            <th width="50px">OPER.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td colspan="9" class="bg-grey-goto text-white"><b>LIQUIDACION DE BOLETOS TURISTICOS</b></td></tr>
                        @if($opcion=='POR CODIGO' || $opcion=='POR NOMBRE')
                            @foreach($cotizacion_codigo_o_nombre->sortBy('fecha') as $cotizacion_)
                                @foreach($cotizacion_->paquete_cotizaciones as $paquete_cotizaciones)
                                    @foreach($paquete_cotizaciones->itinerario_cotizaciones->sortBy('fecha') as $itinerario_cotizaciones)
                                        @foreach($itinerario_cotizaciones->itinerario_servicios->where('liquidacion','1') as $itinerario_servicios)
                                            @if($itinerario_servicios->grupo=='ENTRANCES' && $itinerario_servicios->clase=='BTG')
                                                @php
                                                    $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                @endphp
                                                <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                    <td>
                                                        <label class="text-primary">
                                                            <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}">
                                                            <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                            <b>{{fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <b>{{fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                    </td>
                                                    <td>{{$itinerario_servicios->clase}}</td>
                                                    <td>{{$itinerario_servicios->nombre}}</td>
                                                    <td>{{$cotizacion_->nropersonas}}</td>
                                                    <td>
                                                        <b>
                                                            @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                {{$cotizaciones_cliente->cliente->nombres}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
                                                            @endforeach
                                                        </b>
                                                    </td>
                                                    <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                    <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                    <td class="text-right">
                                                        <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                            {{$itinerario_servicios->prioridad}}
                                                        </b>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
                        @else
                            @foreach($cotizacion->sortBy('fecha') as $cotizacion_)
                                @foreach($cotizacion_->paquete_cotizaciones as $paquete_cotizaciones)
                                    @foreach($paquete_cotizaciones->itinerario_cotizaciones->sortBy('fecha') as $itinerario_cotizaciones)
                                        @foreach($itinerario_cotizaciones->itinerario_servicios->where('liquidacion','1') as $itinerario_servicios)
                                            @if($opcion=='ENTRE DOS FECHAS'||$opcion=='ENTRE DOS FECHAS URGENTES')
                                                @if($ini<=$itinerario_servicios->fecha_venc && $itinerario_servicios->fecha_venc<=$fin)
                                                    @if($opcion=='ENTRE DOS FECHAS URGENTES')
                                                        @if($itinerario_servicios->prioridad=='URGENTE')
                                                            @if($itinerario_servicios->grupo=='ENTRANCES' && $itinerario_servicios->clase=='BTG')
                                                                @php
                                                                    $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                                @endphp
                                                                <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                    <td>
                                                                        <label class="text-primary">
                                                                            <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}">
                                                                            <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                            <b>{{fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                        </label>
                                                                    </td>
                                                                    <td>
                                                                        <b>{{fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                    </td>
                                                                    <td>{{$itinerario_servicios->clase}}</td>
                                                                    <td>{{$itinerario_servicios->nombre}}</td>
                                                                    <td>{{$cotizacion_->nropersonas}}</td>
                                                                    <td>
                                                                        <b>
                                                                            @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                                {{$cotizaciones_cliente->cliente->nombres}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
                                                                            @endforeach
                                                                        </b>
                                                                    </td>
                                                                    <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                    <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                    <td class="text-right">
                                                                        <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                            {{$itinerario_servicios->prioridad}}
                                                                        </b>
                                                                    </td>
                                                                    <td>
                                                                        <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endif
                                                    @elseif($opcion=='ENTRE DOS FECHAS')
                                                        @if($itinerario_servicios->grupo=='ENTRANCES' && $itinerario_servicios->clase=='BTG')
                                                            @php
                                                                $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                            @endphp
                                                            <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                <td>
                                                                    <label class="text-primary">
                                                                        <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}">
                                                                        <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                        <b>{{fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                    </label>
                                                                </td>
                                                                <td>
                                                                    <b>{{fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                </td>
                                                                <td>{{$itinerario_servicios->clase}}</td>
                                                                <td>{{$itinerario_servicios->nombre}}</td>
                                                                <td>{{$cotizacion_->nropersonas}}</td>
                                                                <td>
                                                                    <b>
                                                                        @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                            {{$cotizaciones_cliente->cliente->nombres}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
                                                                        @endforeach
                                                                    </b>
                                                                </td>
                                                                <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                <td class="text-right">
                                                                    <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                        {{$itinerario_servicios->prioridad}}
                                                                    </b>
                                                                </td>
                                                                <td>
                                                                    <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                @endif
                                            @elseif($opcion=='TODOS LOS PENDIENTES' || $opcion=='TODOS LOS URGENTES')
                                                @if($opcion=='TODOS LOS URGENTES')
                                                    @if($itinerario_servicios->prioridad=='URGENTE')
                                                        @if($itinerario_servicios->grupo=='ENTRANCES' && $itinerario_servicios->clase=='BTG')
                                                            @php
                                                                $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                            @endphp
                                                            <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                <td>
                                                                    <label class="text-primary">
                                                                        <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}">
                                                                        <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                        <b>{{fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                    </label>
                                                                </td>
                                                                <td>
                                                                    <b>{{fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                </td>
                                                                <td>{{$itinerario_servicios->clase}}</td>
                                                                <td>{{$itinerario_servicios->nombre}}</td>
                                                                <td>{{$cotizacion_->nropersonas}}</td>
                                                                <td>
                                                                    <b>
                                                                        @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                            {{$cotizaciones_cliente->cliente->nombres}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
                                                                        @endforeach
                                                                    </b>
                                                                </td>
                                                                <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                <td class="text-right">
                                                                    <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                        {{$itinerario_servicios->prioridad}}
                                                                    </b>
                                                                </td>
                                                                <td>
                                                                    <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                @elseif($opcion=='TODOS LOS PENDIENTES')
                                                    @if($itinerario_servicios->grupo=='ENTRANCES' && $itinerario_servicios->clase=='BTG')
                                                        @php
                                                            $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                        @endphp
                                                        <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                            <td>
                                                                <label class="text-primary">
                                                                    <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}">
                                                                    <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                    <b>{{fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <b>{{fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                            </td>
                                                            <td>{{$itinerario_servicios->clase}}</td>
                                                            <td>{{$itinerario_servicios->nombre}}</td>
                                                            <td>{{$cotizacion_->nropersonas}}</td>
                                                            <td>
                                                                <b>
                                                                    @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                        {{$cotizaciones_cliente->cliente->nombres}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
                                                                    @endforeach
                                                                </b>
                                                            </td>
                                                            <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                            <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                            <td class="text-right">
                                                                <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                    {{$itinerario_servicios->prioridad}}
                                                                </b>
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endif
                        <tr>
                            <td colspan="7">
                                <b>TOTAL</b>
                            </td>
                            <td class="text-right">
                                <b>{{$total}}</b>
                            </td>
                            <td></td>
                        </tr>
                        <tr><td colspan="9" class="bg-grey-goto text-white"><b>LIQUIDACION DE INGRESO A CATEDRAL</b></td></tr>
                        @php
                            $total=0;
                        @endphp
                        @if($opcion=='POR CODIGO' || $opcion=='POR NOMBRE')
                            @foreach($cotizacion_codigo_o_nombre->sortBy('fecha') as $cotizacion_)
                                @foreach($cotizacion_->paquete_cotizaciones as $paquete_cotizaciones)
                                    @foreach($paquete_cotizaciones->itinerario_cotizaciones->sortBy('fecha') as $itinerario_cotizaciones)
                                        @foreach($itinerario_cotizaciones->itinerario_servicios->where('liquidacion','1') as $itinerario_servicios)
                                            @if($itinerario_servicios->grupo=='ENTRANCES' && $itinerario_servicios->clase=='CAT')
                                                @php
                                                    $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                @endphp
                                                <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                    <td>
                                                        <label class="text-primary">
                                                            <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}">
                                                            <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                            <b>{{fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <b>{{fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                    </td>
                                                    <td>{{$itinerario_servicios->clase}}</td>
                                                    <td>{{$itinerario_servicios->nombre}}</td>
                                                    <td>{{$cotizacion_->nropersonas}}</td>
                                                    <td>
                                                        <b>
                                                            @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                {{$cotizaciones_cliente->cliente->nombres}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
                                                            @endforeach
                                                        </b>
                                                    </td>
                                                    <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                    <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                    <td class="text-right">
                                                        <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                            {{$itinerario_servicios->prioridad}}
                                                        </b>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
                        @else
                            @foreach($cotizacion->sortBy('fecha') as $cotizacion_)
                                @foreach($cotizacion_->paquete_cotizaciones as $paquete_cotizaciones)
                                    @foreach($paquete_cotizaciones->itinerario_cotizaciones->sortBy('fecha') as $itinerario_cotizaciones)
                                        @foreach($itinerario_cotizaciones->itinerario_servicios->where('liquidacion','1') as $itinerario_servicios)
                                            @if($opcion=='ENTRE DOS FECHAS'||$opcion=='ENTRE DOS FECHAS URGENTES')
                                                @if($ini<=$itinerario_servicios->fecha_venc && $itinerario_servicios->fecha_venc<=$fin)
                                                    @if($opcion=='ENTRE DOS FECHAS URGENTES')
                                                        @if($itinerario_servicios->prioridad=='URGENTE')
                                                            @if($itinerario_servicios->grupo=='ENTRANCES' && $itinerario_servicios->clase=='CAT')
                                                                @php
                                                                    $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                                @endphp
                                                                <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                    <td>
                                                                        <label class="text-primary">
                                                                            <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}">
                                                                            <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                            <b>{{fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                        </label>
                                                                    </td>
                                                                    <td>
                                                                        <b>{{fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                    </td>
                                                                    <td>{{$itinerario_servicios->clase}}</td>
                                                                    <td>{{$itinerario_servicios->nombre}}</td>
                                                                    <td>{{$cotizacion_->nropersonas}}</td>
                                                                    <td>
                                                                        <b>
                                                                            @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                                {{$cotizaciones_cliente->cliente->nombres}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
                                                                            @endforeach
                                                                        </b>
                                                                    </td>
                                                                    <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                    <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                    <td class="text-right">
                                                                        <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                            {{$itinerario_servicios->prioridad}}
                                                                        </b>
                                                                    </td>
                                                                    <td>
                                                                        <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endif
                                                    @elseif($opcion=='ENTRE DOS FECHAS')
                                                        @if($itinerario_servicios->grupo=='ENTRANCES' && $itinerario_servicios->clase=='CAT')
                                                            @php
                                                                $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                            @endphp
                                                            <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                <td>
                                                                    <label class="text-primary">
                                                                        <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}">
                                                                        <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                        <b>{{fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                    </label>
                                                                </td>
                                                                <td>
                                                                    <b>{{fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                </td>
                                                                <td>{{$itinerario_servicios->clase}}</td>
                                                                <td>{{$itinerario_servicios->nombre}}</td>
                                                                <td>{{$cotizacion_->nropersonas}}</td>
                                                                <td>
                                                                    <b>
                                                                        @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                            {{$cotizaciones_cliente->cliente->nombres}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
                                                                        @endforeach
                                                                    </b>
                                                                </td>
                                                                <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                <td class="text-right">
                                                                    <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                        {{$itinerario_servicios->prioridad}}
                                                                    </b>
                                                                </td>
                                                                <td>
                                                                    <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                @endif
                                            @elseif($opcion=='TODOS LOS PENDIENTES' || $opcion=='TODOS LOS URGENTES')
                                                @if($opcion=='TODOS LOS URGENTES')
                                                    @if($itinerario_servicios->prioridad=='URGENTE')
                                                        @if($itinerario_servicios->grupo=='ENTRANCES' && $itinerario_servicios->clase=='CAT')
                                                            @php
                                                                $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                            @endphp
                                                            <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                <td>
                                                                    <label class="text-primary">
                                                                        <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}">
                                                                        <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                        <b>{{fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                    </label>
                                                                </td>
                                                                <td>
                                                                    <b>{{fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                </td>
                                                                <td>{{$itinerario_servicios->clase}}</td>
                                                                <td>{{$itinerario_servicios->nombre}}</td>
                                                                <td>{{$cotizacion_->nropersonas}}</td>
                                                                <td>
                                                                    <b>
                                                                        @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                            {{$cotizaciones_cliente->cliente->nombres}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
                                                                        @endforeach
                                                                    </b>
                                                                </td>
                                                                <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                <td class="text-right">
                                                                    <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                        {{$itinerario_servicios->prioridad}}
                                                                    </b>
                                                                </td>
                                                                <td>
                                                                    <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                @elseif($opcion=='TODOS LOS PENDIENTES')
                                                    @if($itinerario_servicios->grupo=='ENTRANCES' && $itinerario_servicios->clase=='CAT')
                                                        @php
                                                            $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                        @endphp
                                                        <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                            <td>
                                                                <label class="text-primary">
                                                                    <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}">
                                                                    <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                    <b>{{fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <b>{{fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                            </td>
                                                            <td>{{$itinerario_servicios->clase}}</td>
                                                            <td>{{$itinerario_servicios->nombre}}</td>
                                                            <td>{{$cotizacion_->nropersonas}}</td>
                                                            <td>
                                                                <b>
                                                                    @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                        {{$cotizaciones_cliente->cliente->nombres}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
                                                                    @endforeach
                                                                </b>
                                                            </td>
                                                            <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                            <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                            <td class="text-right">
                                                                <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                    {{$itinerario_servicios->prioridad}}
                                                                </b>
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endif
                        <tr>
                            <td colspan="7">
                                <b>TOTAL</b>
                            </td>
                            <td class="text-right">
                                <b>{{$total}}</b>
                            </td>
                            <td></td>
                        </tr>
                        <tr><td colspan="9" class="bg-grey-goto text-white"><b>LIQUIDACION DE INGRESO AL KORICANCHA</b></td></tr>
                        @php
                            $total=0;
                        @endphp
                        @if($opcion=='POR CODIGO' || $opcion=='POR NOMBRE')
                            @foreach($cotizacion_codigo_o_nombre->sortBy('fecha') as $cotizacion_)
                                @foreach($cotizacion_->paquete_cotizaciones as $paquete_cotizaciones)
                                    @foreach($paquete_cotizaciones->itinerario_cotizaciones->sortBy('fecha') as $itinerario_cotizaciones)
                                        @foreach($itinerario_cotizaciones->itinerario_servicios->where('liquidacion','1') as $itinerario_servicios)  
                                            @if($itinerario_servicios->grupo=='ENTRANCES' && $itinerario_servicios->clase=='KORI')
                                                @php
                                                    $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                @endphp
                                                <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                    <td>
                                                        <label class="text-primary">
                                                            <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}">
                                                            <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                            <b>{{fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <b>{{fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                    </td>
                                                    <td>{{$itinerario_servicios->clase}}</td>
                                                    <td>{{$itinerario_servicios->nombre}}</td>
                                                    <td>{{$cotizacion_->nropersonas}}</td>
                                                    <td>
                                                        <b>
                                                            @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                {{$cotizaciones_cliente->cliente->nombres}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
                                                            @endforeach
                                                        </b>
                                                    </td>
                                                    <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                    <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                    <td class="text-right">
                                                        <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                            {{$itinerario_servicios->prioridad}}
                                                        </b>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
                        @else
                            @foreach($cotizacion->sortBy('fecha') as $cotizacion_)
                                @foreach($cotizacion_->paquete_cotizaciones as $paquete_cotizaciones)
                                    @foreach($paquete_cotizaciones->itinerario_cotizaciones->sortBy('fecha') as $itinerario_cotizaciones)
                                        @foreach($itinerario_cotizaciones->itinerario_servicios->where('liquidacion','1') as $itinerario_servicios)
                                            @if($opcion=='ENTRE DOS FECHAS'||$opcion=='ENTRE DOS FECHAS URGENTES')
                                                @if($ini<=$itinerario_servicios->fecha_venc && $itinerario_servicios->fecha_venc<=$fin)
                                                    @if($opcion=='ENTRE DOS FECHAS URGENTES')
                                                        @if($itinerario_servicios->prioridad=='URGENTE')
                                                            @if($itinerario_servicios->grupo=='ENTRANCES' && $itinerario_servicios->clase=='KORI')
                                                                @php
                                                                    $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                                @endphp
                                                                <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                    <td>
                                                                        <label class="text-primary">
                                                                            <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}">
                                                                            <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                            <b>{{fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                        </label>
                                                                    </td>
                                                                    <td>
                                                                        <b>{{fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                    </td>
                                                                    <td>{{$itinerario_servicios->clase}}</td>
                                                                    <td>{{$itinerario_servicios->nombre}}</td>
                                                                    <td>{{$cotizacion_->nropersonas}}</td>
                                                                    <td>
                                                                        <b>
                                                                            @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                                {{$cotizaciones_cliente->cliente->nombres}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
                                                                            @endforeach
                                                                        </b>
                                                                    </td>
                                                                    <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                    <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                    <td class="text-right">
                                                                        <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                            {{$itinerario_servicios->prioridad}}
                                                                        </b>
                                                                    </td>
                                                                    <td>
                                                                        <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endif
                                                    @elseif($opcion=='ENTRE DOS FECHAS')
                                                        @if($itinerario_servicios->grupo=='ENTRANCES' && $itinerario_servicios->clase=='KORI')
                                                            @php
                                                                $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                            @endphp
                                                            <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                <td>
                                                                    <label class="text-primary">
                                                                        <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}">
                                                                        <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                        <b>{{fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                    </label>
                                                                </td>
                                                                <td>
                                                                    <b>{{fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                </td>
                                                                <td>{{$itinerario_servicios->clase}}</td>
                                                                <td>{{$itinerario_servicios->nombre}}</td>
                                                                <td>{{$cotizacion_->nropersonas}}</td>
                                                                <td>
                                                                    <b>
                                                                        @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                            {{$cotizaciones_cliente->cliente->nombres}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
                                                                        @endforeach
                                                                    </b>
                                                                </td>
                                                                <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                <td class="text-right">
                                                                    <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                        {{$itinerario_servicios->prioridad}}
                                                                    </b>
                                                                </td>
                                                                <td>
                                                                    <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                @endif
                                            @elseif($opcion=='TODOS LOS PENDIENTES' || $opcion=='TODOS LOS URGENTES')
                                                @if($opcion=='TODOS LOS URGENTES')
                                                    @if($itinerario_servicios->prioridad=='URGENTE')
                                                        @if($itinerario_servicios->grupo=='ENTRANCES' && $itinerario_servicios->clase=='KORI')
                                                            @php
                                                                $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                            @endphp
                                                            <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                <td>
                                                                    <label class="text-primary">
                                                                        <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}">
                                                                        <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                        <b>{{fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                    </label>
                                                                </td>
                                                                <td>
                                                                    <b>{{fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                </td>
                                                                <td>{{$itinerario_servicios->clase}}</td>
                                                                <td>{{$itinerario_servicios->nombre}}</td>
                                                                <td>{{$cotizacion_->nropersonas}}</td>
                                                                <td>
                                                                    <b>
                                                                        @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                            {{$cotizaciones_cliente->cliente->nombres}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
                                                                        @endforeach
                                                                    </b>
                                                                </td>
                                                                <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                <td class="text-right">
                                                                    <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                        {{$itinerario_servicios->prioridad}}
                                                                    </b>
                                                                </td>
                                                                <td>
                                                                    <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                @elseif($opcion=='TODOS LOS PENDIENTES')
                                                    @if($itinerario_servicios->grupo=='ENTRANCES' && $itinerario_servicios->clase=='KORI')
                                                        @php
                                                            $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                        @endphp
                                                        <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                            <td>
                                                                <label class="text-primary">
                                                                    <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}">
                                                                    <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                    <b>{{fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <b>{{fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                            </td>
                                                            <td>{{$itinerario_servicios->clase}}</td>
                                                            <td>{{$itinerario_servicios->nombre}}</td>
                                                            <td>{{$cotizacion_->nropersonas}}</td>
                                                            <td>
                                                                <b>
                                                                    @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                        {{$cotizaciones_cliente->cliente->nombres}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
                                                                    @endforeach
                                                                </b>
                                                            </td>
                                                            <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                            <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                            <td class="text-right">
                                                                <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                    {{$itinerario_servicios->prioridad}}
                                                                </b>
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endif
                        <tr>
                            <td colspan="7">
                                <b>TOTAL</b>
                            </td>
                            <td class="text-right">
                                <b>{{$total}}</b>
                            </td>
                            <td></td>
                        </tr>
                        <tr><td colspan="9" class="bg-grey-goto text-white"><b>LIQUIDACION DE INGRESO A MACHUPICCHU</b></td></tr>
                        @php
                            $total=0;
                        @endphp
                        @if($opcion=='POR CODIGO' || $opcion=='POR NOMBRE')
                            @foreach($cotizacion_codigo_o_nombre->sortBy('fecha') as $cotizacion_)
                                @foreach($cotizacion_->paquete_cotizaciones as $paquete_cotizaciones)
                                    @foreach($paquete_cotizaciones->itinerario_cotizaciones->sortBy('fecha') as $itinerario_cotizaciones)
                                        @foreach($itinerario_cotizaciones->itinerario_servicios->where('liquidacion','1') as $itinerario_servicios)
                                            @if($itinerario_servicios->grupo=='ENTRANCES' && $itinerario_servicios->clase=='MAPI')
                                                @php
                                                    $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                @endphp
                                                <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                    <td>
                                                        <label class="text-primary">
                                                            <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}">
                                                            <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                            <b>{{fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <b>{{fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                    </td>
                                                    <td>{{$itinerario_servicios->clase}}</td>
                                                    <td>{{$itinerario_servicios->nombre}}</td>
                                                    <td>{{$cotizacion_->nropersonas}}</td>
                                                    <td>
                                                        <b>
                                                            @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                {{$cotizaciones_cliente->cliente->nombres}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
                                                            @endforeach
                                                        </b>
                                                    </td>
                                                    <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                    <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                    <td class="text-right">
                                                        <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                            {{$itinerario_servicios->prioridad}}
                                                        </b>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
                        @else
                            @foreach($cotizacion->sortBy('fecha') as $cotizacion_)
                                @foreach($cotizacion_->paquete_cotizaciones as $paquete_cotizaciones)
                                    @foreach($paquete_cotizaciones->itinerario_cotizaciones->sortBy('fecha') as $itinerario_cotizaciones)
                                        @foreach($itinerario_cotizaciones->itinerario_servicios->where('liquidacion','1') as $itinerario_servicios)
                                            @if($opcion=='ENTRE DOS FECHAS'||$opcion=='ENTRE DOS FECHAS URGENTES')
                                                @if($ini<=$itinerario_servicios->fecha_venc && $itinerario_servicios->fecha_venc<=$fin)
                                                    @if($opcion=='ENTRE DOS FECHAS URGENTES')
                                                        @if($itinerario_servicios->prioridad=='URGENTE')
                                                            @if($itinerario_servicios->grupo=='ENTRANCES' && $itinerario_servicios->clase=='MAPI')
                                                                @php
                                                                    $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                                @endphp
                                                                <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                    <td>
                                                                        <label class="text-primary">
                                                                            <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}">
                                                                            <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                            <b>{{fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                        </label>
                                                                    </td>
                                                                    <td>
                                                                        <b>{{fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                    </td>
                                                                    <td>{{$itinerario_servicios->clase}}</td>
                                                                    <td>{{$itinerario_servicios->nombre}}</td>
                                                                    <td>{{$cotizacion_->nropersonas}}</td>
                                                                    <td>
                                                                        <b>
                                                                            @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                                {{$cotizaciones_cliente->cliente->nombres}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
                                                                            @endforeach
                                                                        </b>
                                                                    </td>
                                                                    <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                    <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                    <td class="text-right">
                                                                        <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                            {{$itinerario_servicios->prioridad}}
                                                                        </b>
                                                                    </td>
                                                                    <td>
                                                                        <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endif
                                                    @elseif($opcion=='ENTRE DOS FECHAS')
                                                        @if($itinerario_servicios->grupo=='ENTRANCES' && $itinerario_servicios->clase=='MAPI')
                                                            @php
                                                                $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                            @endphp
                                                            <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                <td>
                                                                    <label class="text-primary">
                                                                        <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}">
                                                                        <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                        <b>{{fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                    </label>
                                                                </td>
                                                                <td>
                                                                    <b>{{fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                </td>
                                                                <td>{{$itinerario_servicios->clase}}</td>
                                                                <td>{{$itinerario_servicios->nombre}}</td>
                                                                <td>{{$cotizacion_->nropersonas}}</td>
                                                                <td>
                                                                    <b>
                                                                        @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                            {{$cotizaciones_cliente->cliente->nombres}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
                                                                        @endforeach
                                                                    </b>
                                                                </td>
                                                                <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                <td class="text-right">
                                                                    <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                        {{$itinerario_servicios->prioridad}}
                                                                    </b>
                                                                </td>
                                                                <td>
                                                                    <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                @endif
                                            @elseif($opcion=='TODOS LOS PENDIENTES' || $opcion=='TODOS LOS URGENTES')
                                                @if($opcion=='TODOS LOS URGENTES')
                                                    @if($itinerario_servicios->prioridad=='URGENTE')
                                                        @if($itinerario_servicios->grupo=='ENTRANCES' && $itinerario_servicios->clase=='MAPI')
                                                            @php
                                                                $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                            @endphp
                                                            <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                <td>
                                                                    <label class="text-primary">
                                                                        <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}">
                                                                        <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                        <b>{{fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                    </label>
                                                                </td>
                                                                <td>
                                                                    <b>{{fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                </td>
                                                                <td>{{$itinerario_servicios->clase}}</td>
                                                                <td>{{$itinerario_servicios->nombre}}</td>
                                                                <td>{{$cotizacion_->nropersonas}}</td>
                                                                <td>
                                                                    <b>
                                                                        @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                            {{$cotizaciones_cliente->cliente->nombres}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
                                                                        @endforeach
                                                                    </b>
                                                                </td>
                                                                <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                <td class="text-right">
                                                                    <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                        {{$itinerario_servicios->prioridad}}
                                                                    </b>
                                                                </td>
                                                                <td>
                                                                    <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                @elseif($opcion=='TODOS LOS PENDIENTES')
                                                    @if($itinerario_servicios->grupo=='ENTRANCES' && $itinerario_servicios->clase=='MAPI')
                                                        @php
                                                            $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                        @endphp
                                                        <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                            <td>
                                                                <label class="text-primary">
                                                                    <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}">
                                                                    <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                    <b>{{fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <b>{{fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                            </td>
                                                            <td>{{$itinerario_servicios->clase}}</td>
                                                            <td>{{$itinerario_servicios->nombre}}</td>
                                                            <td>{{$cotizacion_->nropersonas}}</td>
                                                            <td>
                                                                <b>
                                                                    @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                        {{$cotizaciones_cliente->cliente->nombres}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
                                                                    @endforeach
                                                                </b>
                                                            </td>
                                                            <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                            <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                            <td class="text-right">
                                                                <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                    {{$itinerario_servicios->prioridad}}
                                                                </b>
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endif
                        <tr>
                            <td colspan="7">
                                <b>TOTAL</b>
                            </td>
                            <td class="text-right">
                                <b>{{$total}}</b>
                            </td>
                            <td></td>
                        </tr>
                        <tr><td colspan="9" class="bg-grey-goto text-white"><b>ENTRADAS OTROS</b></td></tr>
                        @php
                            $total=0;
                        @endphp
                        @if($opcion=='POR CODIGO' || $opcion=='POR NOMBRE')
                            @foreach($cotizacion_codigo_o_nombre->sortBy('fecha') as $cotizacion_)
                                @foreach($cotizacion_->paquete_cotizaciones as $paquete_cotizaciones)
                                    @foreach($paquete_cotizaciones->itinerario_cotizaciones->sortBy('fecha') as $itinerario_cotizaciones)
                                        @foreach($itinerario_cotizaciones->itinerario_servicios->where('liquidacion','1') as $itinerario_servicios)
                                            @if($itinerario_servicios->grupo=='ENTRANCES' && $itinerario_servicios->clase=='OTROS')
                                                @php
                                                    $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                @endphp
                                                <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                    <td>
                                                        <label class="text-primary">
                                                            <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}">
                                                            <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                            <b>{{fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <b>{{fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                    </td>
                                                    <td>{{$itinerario_servicios->clase}}</td>
                                                    <td>{{$itinerario_servicios->nombre}}</td>
                                                    <td>{{$cotizacion_->nropersonas}}</td>
                                                    <td>
                                                        <b>
                                                            @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                {{$cotizaciones_cliente->cliente->nombres}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
                                                            @endforeach
                                                        </b>
                                                    </td>
                                                    <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                    <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                    <td class="text-right">
                                                        <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                            {{$itinerario_servicios->prioridad}}
                                                        </b>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
                        @else
                            @foreach($cotizacion->sortBy('fecha') as $cotizacion_)
                                @foreach($cotizacion_->paquete_cotizaciones as $paquete_cotizaciones)
                                    @foreach($paquete_cotizaciones->itinerario_cotizaciones->sortBy('fecha') as $itinerario_cotizaciones)
                                        @foreach($itinerario_cotizaciones->itinerario_servicios->where('liquidacion','1') as $itinerario_servicios)
                                            @if($opcion=='ENTRE DOS FECHAS'||$opcion=='ENTRE DOS FECHAS URGENTES')
                                                @if($ini<=$itinerario_servicios->fecha_venc && $itinerario_servicios->fecha_venc<=$fin)
                                                    @if($opcion=='ENTRE DOS FECHAS URGENTES')
                                                        @if($itinerario_servicios->prioridad=='URGENTE')
                                                            @if($itinerario_servicios->grupo=='ENTRANCES' && $itinerario_servicios->clase=='OTROS')
                                                                @php
                                                                    $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                                @endphp
                                                                <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                    <td>
                                                                        <label class="text-primary">
                                                                            <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}">
                                                                            <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                            <b>{{fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                        </label>
                                                                    </td>
                                                                    <td>
                                                                        <b>{{fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                    </td>
                                                                    <td>{{$itinerario_servicios->clase}}</td>
                                                                    <td>{{$itinerario_servicios->nombre}}</td>
                                                                    <td>{{$cotizacion_->nropersonas}}</td>
                                                                    <td>
                                                                        <b>
                                                                            @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                                {{$cotizaciones_cliente->cliente->nombres}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
                                                                            @endforeach
                                                                        </b>
                                                                    </td>
                                                                    <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                    <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                    <td class="text-right">
                                                                        <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                            {{$itinerario_servicios->prioridad}}
                                                                        </b>
                                                                    </td>
                                                                    <td>
                                                                        <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endif
                                                    @elseif($opcion=='ENTRE DOS FECHAS')
                                                        @if($itinerario_servicios->grupo=='ENTRANCES' && $itinerario_servicios->clase=='OTROS')
                                                            @php
                                                                $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                            @endphp
                                                            <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                <td>
                                                                    <label class="text-primary">
                                                                        <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}">
                                                                        <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                        <b>{{fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                    </label>
                                                                </td>
                                                                <td>
                                                                    <b>{{fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                </td>
                                                                <td>{{$itinerario_servicios->clase}}</td>
                                                                <td>{{$itinerario_servicios->nombre}}</td>
                                                                <td>{{$cotizacion_->nropersonas}}</td>
                                                                <td>
                                                                    <b>
                                                                        @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                            {{$cotizaciones_cliente->cliente->nombres}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
                                                                        @endforeach
                                                                    </b>
                                                                </td>
                                                                <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                <td class="text-right">
                                                                    <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                        {{$itinerario_servicios->prioridad}}
                                                                    </b>
                                                                </td>
                                                                <td>
                                                                    <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                @endif
                                            @elseif($opcion=='TODOS LOS PENDIENTES' || $opcion=='TODOS LOS URGENTES')
                                                @if($opcion=='TODOS LOS URGENTES')
                                                    @if($itinerario_servicios->prioridad=='URGENTE')
                                                        @if($itinerario_servicios->grupo=='ENTRANCES' && $itinerario_servicios->clase=='OTROS')
                                                            @php
                                                                $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                            @endphp
                                                            <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                <td>
                                                                    <label class="text-primary">
                                                                        <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}">
                                                                        <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                        <b>{{fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                    </label>
                                                                </td>
                                                                <td>
                                                                    <b>{{fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                </td>
                                                                <td>{{$itinerario_servicios->clase}}</td>
                                                                <td>{{$itinerario_servicios->nombre}}</td>
                                                                <td>{{$cotizacion_->nropersonas}}</td>
                                                                <td>
                                                                    <b>
                                                                        @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                            {{$cotizaciones_cliente->cliente->nombres}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
                                                                        @endforeach
                                                                    </b>
                                                                </td>
                                                                <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                <td class="text-right">
                                                                    <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                        {{$itinerario_servicios->prioridad}}
                                                                    </b>
                                                                </td>
                                                                <td>
                                                                    <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                @elseif($opcion=='TODOS LOS PENDIENTES')
                                                    @if($itinerario_servicios->grupo=='ENTRANCES' && $itinerario_servicios->clase=='OTROS')
                                                        @php
                                                            $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                        @endphp
                                                        <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                            <td>
                                                                <label class="text-primary">
                                                                    <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}">
                                                                    <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                    <b>{{fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <b>{{fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                            </td>
                                                            <td>{{$itinerario_servicios->clase}}</td>
                                                            <td>{{$itinerario_servicios->nombre}}</td>
                                                            <td>{{$cotizacion_->nropersonas}}</td>
                                                            <td>
                                                                <b>
                                                                    @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                        {{$cotizaciones_cliente->cliente->nombres}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
                                                                    @endforeach
                                                                </b>
                                                            </td>
                                                            <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                            <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                            <td class="text-right">
                                                                <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                    {{$itinerario_servicios->prioridad}}
                                                                </b>
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endif
                        <tr>
                            <td colspan="7">
                                <b>TOTAL</b>
                            </td>
                            <td class="text-right">
                                <b>{{$total}}</b>
                            </td>
                            <td></td>
                        </tr>
                        <tr><td colspan="9" class="bg-grey-goto text-white"><b>ENTRADAS BUSES</b></td></tr>
                        @php
                            $total=0;
                        @endphp
                        @if($opcion=='POR CODIGO' || $opcion=='POR NOMBRE')
                            @foreach($cotizacion_codigo_o_nombre->sortBy('fecha') as $cotizacion_)
                                @foreach($cotizacion_->paquete_cotizaciones as $paquete_cotizaciones)
                                    @foreach($paquete_cotizaciones->itinerario_cotizaciones->sortBy('fecha') as $itinerario_cotizaciones)
                                        @foreach($itinerario_cotizaciones->itinerario_servicios->where('liquidacion','1') as $itinerario_servicios)
                                            @if($itinerario_servicios->grupo=='MOVILID' && $itinerario_servicios->clase=='BOLETO')
                                                @php
                                                    $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                @endphp
                                                <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                    <td>
                                                        <label class="text-primary">
                                                            <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}">
                                                            <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                            <b>{{fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <b>{{fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                    </td>
                                                    <td>{{$itinerario_servicios->clase}}</td>
                                                    <td>{{$itinerario_servicios->nombre}}</td>
                                                    <td>{{$cotizacion_->nropersonas}}</td>
                                                    <td>
                                                        <b>
                                                            @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                {{$cotizaciones_cliente->cliente->nombres}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
                                                            @endforeach
                                                        </b>
                                                    </td>
                                                    <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                    <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                    <td class="text-right">
                                                        <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                            {{$itinerario_servicios->prioridad}}
                                                        </b>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
                        @else
                            @foreach($cotizacion->sortBy('fecha') as $cotizacion_)
                                @foreach($cotizacion_->paquete_cotizaciones as $paquete_cotizaciones)
                                    @foreach($paquete_cotizaciones->itinerario_cotizaciones->sortBy('fecha') as $itinerario_cotizaciones)
                                        @foreach($itinerario_cotizaciones->itinerario_servicios->where('liquidacion','1') as $itinerario_servicios)
                                            @if($opcion=='ENTRE DOS FECHAS'||$opcion=='ENTRE DOS FECHAS URGENTES')
                                                @if($ini<=$itinerario_servicios->fecha_venc && $itinerario_servicios->fecha_venc<=$fin)
                                                    @if($opcion=='ENTRE DOS FECHAS URGENTES')
                                                        @if($itinerario_servicios->prioridad=='URGENTE')
                                                            @if($itinerario_servicios->grupo=='MOVILID' && $itinerario_servicios->clase=='BOLETO')
                                                                @php
                                                                    $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                                @endphp
                                                                <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                    <td>
                                                                        <label class="text-primary">
                                                                            <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}">
                                                                            <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                            <b>{{fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                        </label>
                                                                    </td>
                                                                    <td>
                                                                        <b>{{fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                    </td>
                                                                    <td>{{$itinerario_servicios->clase}}</td>
                                                                    <td>{{$itinerario_servicios->nombre}}</td>
                                                                    <td>{{$cotizacion_->nropersonas}}</td>
                                                                    <td>
                                                                        <b>
                                                                            @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                                {{$cotizaciones_cliente->cliente->nombres}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
                                                                            @endforeach
                                                                        </b>
                                                                    </td>
                                                                    <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                    <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                    <td class="text-right">
                                                                        <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                            {{$itinerario_servicios->prioridad}}
                                                                        </b>
                                                                    </td>
                                                                    <td>
                                                                        <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endif
                                                    @elseif($opcion=='ENTRE DOS FECHAS')
                                                        @if($itinerario_servicios->grupo=='MOVILID' && $itinerario_servicios->clase=='BOLETO')
                                                            @php
                                                                $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                            @endphp
                                                            <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                <td>
                                                                    <label class="text-primary">
                                                                        <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}">
                                                                        <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                        <b>{{fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                    </label>
                                                                </td>
                                                                <td>
                                                                    <b>{{fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                </td>
                                                                <td>{{$itinerario_servicios->clase}}</td>
                                                                <td>{{$itinerario_servicios->nombre}}</td>
                                                                <td>{{$cotizacion_->nropersonas}}</td>
                                                                <td>
                                                                    <b>
                                                                        @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                            {{$cotizaciones_cliente->cliente->nombres}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
                                                                        @endforeach
                                                                    </b>
                                                                </td>
                                                                <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                <td class="text-right">
                                                                    <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                        {{$itinerario_servicios->prioridad}}
                                                                    </b>
                                                                </td>
                                                                <td>
                                                                    <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                @endif
                                            @elseif($opcion=='TODOS LOS PENDIENTES' || $opcion=='TODOS LOS URGENTES')
                                                @if($opcion=='TODOS LOS URGENTES')
                                                    @if($itinerario_servicios->prioridad=='URGENTE')
                                                        @if($itinerario_servicios->grupo=='MOVILID' && $itinerario_servicios->clase=='BOLETO')
                                                            @php
                                                                $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                            @endphp
                                                            <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                                <td>
                                                                    <label class="text-primary">
                                                                        <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}">
                                                                        <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                        <b>{{fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                    </label>
                                                                </td>
                                                                <td>
                                                                    <b>{{fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                                </td>
                                                                <td>{{$itinerario_servicios->clase}}</td>
                                                                <td>{{$itinerario_servicios->nombre}}</td>
                                                                <td>{{$cotizacion_->nropersonas}}</td>
                                                                <td>
                                                                    <b>
                                                                        @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                            {{$cotizaciones_cliente->cliente->nombres}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
                                                                        @endforeach
                                                                    </b>
                                                                </td>
                                                                <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                                <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                                <td class="text-right">
                                                                    <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                        {{$itinerario_servicios->prioridad}}
                                                                    </b>
                                                                </td>
                                                                <td>
                                                                    <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                @elseif($opcion=='TODOS LOS PENDIENTES')
                                                    @if($itinerario_servicios->grupo=='MOVILID' && $itinerario_servicios->clase=='BOLETO')
                                                        @php
                                                            $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                                        @endphp
                                                        <tr id="item-entrada-{{$itinerario_servicios->id}}">
                                                            <td>
                                                                <label class="text-primary">
                                                                    <input type="checkbox" form="form_guardar" class="mis-checkboxes" name="itinerario_servicio_id[]" value="{{$itinerario_servicios->id}}">
                                                                    <input type="hidden" id="precio_{{$itinerario_servicios->id}}" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                                    <b>{{fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <b>{{fecha_peru($itinerario_servicios->fecha_venc)}}</b>
                                                            </td>
                                                            <td>{{$itinerario_servicios->clase}}</td>
                                                            <td>{{$itinerario_servicios->nombre}}</td>
                                                            <td>{{$cotizacion_->nropersonas}}</td>
                                                            <td>
                                                                <b>
                                                                    @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                                        {{$cotizaciones_cliente->cliente->nombres}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
                                                                    @endforeach
                                                                </b>
                                                            </td>
                                                            <td class="text-right">{{$itinerario_servicios->precio}}</td>
                                                            <td class="text-right">{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}</td>
                                                            <td class="text-right">
                                                                <b class="@if($itinerario_servicios->prioridad=='NORMAL') {{'badge badge-success'}} @elseif($itinerario_servicios->prioridad=='URGENTE') {{'badge badge-danger'}} @endif">
                                                                    {{$itinerario_servicios->prioridad}}
                                                                </b>
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-danger btn-sm" onclick="eliminar_servicio_consulta('{{$itinerario_servicios->id}}','{{$itinerario_servicios->nombre}}')"><i class="fa fa-trash"></i></button>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endif
                        <tr>
                            <td colspan="7">
                                <b>TOTAL</b>
                            </td>
                            <td class="text-right">
                                <b>{{$total}}</b>
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-2 fixed">
        <form id="form_guardar" action="{{route('pagar_entradas_path')}}" method="post">
            <div class="form-group">
                <label for="total_entrances" class="text-secondary font-weight-bold pr-2">TOTAL </label>
                <input type="text" class="form-control" id="total_entrances" name="total_entrances" value="0">
            </div>
            <div class="form-group">
                <label for="nro_operacion">Nro de operacion</label>
                <input type="text" class="form-control" id="nro_operacion" name="nro_operacion" aria-describedby="Nro operacion" placeholder="Nro operacion">
            </div>
            <input type="hidden" name="ini" value="{{$ini}}">
            <input type="hidden" name="fin" value="{{$fin}}">
            <input type="hidden" name="codigo" value="{{$codigo}}">
            <input type="hidden" name="nombre" value="{{$nombre}}">
            {{csrf_field()}}
            <button type="submit" name="guardar" class="form-control btn btn-success btn-block" value="Guardar"><i class="fas fa-save"></i> Guardar para despues</button>
            <button type="submit" name="pagar" class="form-control btn btn-primary btn-block" value="Pagar"><i class="fas fa-coin"></i> Pagar</button>
        </form>
    </div>
</div>

