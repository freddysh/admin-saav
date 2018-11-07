@php
    function fecha_peru($fecha){
    $fecha=explode('-',$fecha);
    return $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
    }
@endphp
<div class="row">
    <div class="col-8">
        <b>{{$opcion}}</b>
        <b class="text-unset @if($opcion=='TODOS LOS PENDIENTES') d-none @endif">LIQUIDACION DESDE: <span class="text-green-goto">{{fecha_peru($ini)}}</span> - HASTA: <span class="text-green-goto">{{fecha_peru($fin)}}</span></b>
    </div>
    <div class="col-4 form-inline right">
        <div class="form-group  right" id="from">
            <label for="total_entrances" class="text-secondary font-weight-bold pr-2">TOTAL </label>
            <input type="text" class="form-control" id="total_entrances" value="0" disabled="disabled">
        </div>
</div>
</div>
<div class="row">
    <div class="col">
        @php
        $total=0;
        @endphp
        <table  class="table table-bordered table-striped table-responsive table-hover table-condensed">
            <thead>
            <tr>
                <th width="150px">FECHA USO</th>
                <th width="40px">CLASE</th>
                <th width="250px">SERVICIO</th>
                <th width="30px">AD</th>
                <th width="300px">PAX</th>
                <th width="50px">$ AD</th>
                <th width="50px">TOTAL</th>
                <th width="50px">PRIORIDAD</th>
            </tr>
            </thead>
            <tbody>
            <tr><td colspan="8" class="bg-grey-goto text-white"><b>LIQUIDACION DE BOLETOS TURISTICOS</b></td></tr>
            @foreach($cotizacion->sortBy('fecha') as $cotizacion_)
                @foreach($cotizacion_->paquete_cotizaciones as $paquete_cotizaciones)
                    @foreach($paquete_cotizaciones->itinerario_cotizaciones->sortBy('fecha') as $itinerario_cotizaciones)
                        @foreach($itinerario_cotizaciones->itinerario_servicios->where('liquidacion','0') as $itinerario_servicios)
                            @if($opcion=='TODOS LOS PENDIENTES')
                                @if($itinerario_servicios->servicio->grupo=='ENTRANCES' && $itinerario_servicios->servicio->clase=='BTG')
                                    @php
                                        $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                    @endphp
                                    <tr>
                                        <td>
                                            <label class="text-primary">
                                                <input type="checkbox" class="mis-checkboxes" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                               <b>{{fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                            </label>
                                        </td>
                                        <td>{{$itinerario_servicios->servicio->clase}}</td>
                                        <td>{{$itinerario_servicios->nombre}}</td>
                                        <td>{{$cotizacion_->nropersonas}}</td>
                                        <td>
                                            <b>
                                                @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                    {{$cotizaciones_cliente->cliente->nombres}} {{$cotizaciones_cliente->cliente->apellidos}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
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
                                    </tr>
                                @endif
                            @endif
                        @endforeach
                    @endforeach
                @endforeach
            @endforeach
            <tr>
                <td colspan="6">
                    <b>TOTAL</b>
                </td>
                <td>
                    <b>{{$total}}</b>
                </td>
                <td></td>
            </tr>
            <tr><td colspan="8" class="bg-grey-goto text-white"><b>LIQUIDACION DE INGRESO A CATEDRAL</b></td></tr>
            @php
                $total=0;
            @endphp
            @foreach($cotizacion->sortBy('fecha') as $cotizacion_)
                @foreach($cotizacion_->paquete_cotizaciones as $paquete_cotizaciones)
                    @foreach($paquete_cotizaciones->itinerario_cotizaciones->sortBy('fecha') as $itinerario_cotizaciones)
                        @foreach($itinerario_cotizaciones->itinerario_servicios->where('liquidacion','0') as $itinerario_servicios)
                            @if($opcion=='TODOS LOS PENDIENTES')
                                @if($itinerario_servicios->servicio->grupo=='ENTRANCES' && $itinerario_servicios->servicio->clase=='CAT')
                                    @php
                                        $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                    @endphp
                                    <tr>
                                        <td>
                                            <label class="text-primary">
                                                <input type="checkbox" class="mis-checkboxes" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                <b>{{fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                            </label>
                                        </td>
                                        <td>{{$itinerario_servicios->servicio->clase}}</td>
                                        <td>{{$itinerario_servicios->nombre}}</td>
                                        <td>{{$cotizacion_->nropersonas}}</td>
                                        <td>
                                            <b>
                                                @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                    {{$cotizaciones_cliente->cliente->nombres}} {{$cotizaciones_cliente->cliente->apellidos}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
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
                                    </tr>
                                @endif
                            @endif
                        @endforeach
                    @endforeach
                @endforeach
            @endforeach
            <tr>
                <td colspan="6">
                    <b>TOTAL</b>
                </td>
                <td>
                    <b>{{$total}}</b>
                </td>
                <td></td>
            </tr>
            <tr><td colspan="8" class="bg-grey-goto text-white"><b>LIQUIDACION DE INGRESO AL KORICANCHA</b></td></tr>
            @php
                $total=0;
            @endphp
            @foreach($cotizacion->sortBy('fecha') as $cotizacion_)
                @foreach($cotizacion_->paquete_cotizaciones as $paquete_cotizaciones)
                    @foreach($paquete_cotizaciones->itinerario_cotizaciones->sortBy('fecha') as $itinerario_cotizaciones)
                        @foreach($itinerario_cotizaciones->itinerario_servicios->where('liquidacion','0') as $itinerario_servicios)
                            @if($opcion=='TODOS LOS PENDIENTES')
                                @if($itinerario_servicios->servicio->grupo=='ENTRANCES' && $itinerario_servicios->servicio->clase=='KORI')
                                    @php
                                        $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                    @endphp
                                    <tr>
                                        <td>
                                            <label class="text-primary">
                                                <input type="checkbox" class="mis-checkboxes" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                <b>{{fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                            </label>
                                        </td>
                                        <td>{{$itinerario_servicios->servicio->clase}}</td>
                                        <td>{{$itinerario_servicios->nombre}}</td>
                                        <td>{{$cotizacion_->nropersonas}}</td>
                                        <td>
                                            <b>
                                                @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                    {{$cotizaciones_cliente->cliente->nombres}} {{$cotizaciones_cliente->cliente->apellidos}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
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
                                    </tr>
                                @endif
                            @endif
                        @endforeach
                    @endforeach
                @endforeach
            @endforeach
            <tr>
                <td colspan="6">
                    <b>TOTAL</b>
                </td>
                <td>
                    <b>{{$total}}</b>
                </td>
                <td></td>
            </tr>
            <tr><td colspan="8" class="bg-grey-goto text-white"><b>LIQUIDACION DE INGRESO A MACHUPICCHU</b></td></tr>
            @php
                $total=0;
            @endphp
            @foreach($cotizacion->sortBy('fecha') as $cotizacion_)
                @foreach($cotizacion_->paquete_cotizaciones as $paquete_cotizaciones)
                    @foreach($paquete_cotizaciones->itinerario_cotizaciones->sortBy('fecha') as $itinerario_cotizaciones)
                        @foreach($itinerario_cotizaciones->itinerario_servicios->where('liquidacion','0') as $itinerario_servicios)
                            @if($opcion=='TODOS LOS PENDIENTES')
                                @if($itinerario_servicios->servicio->grupo=='ENTRANCES' && $itinerario_servicios->servicio->clase=='MAPI')
                                    @php
                                        $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                    @endphp
                                    <tr>
                                        <td>
                                            <label class="text-primary">
                                                <input type="checkbox" class="mis-checkboxes" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                <b>{{fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                            </label>
                                        </td>
                                        <td>{{$itinerario_servicios->servicio->clase}}</td>
                                        <td>{{$itinerario_servicios->nombre}}</td>
                                        <td>{{$cotizacion_->nropersonas}}</td>
                                        <td>
                                            <b>
                                                @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                    {{$cotizaciones_cliente->cliente->nombres}} {{$cotizaciones_cliente->cliente->apellidos}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
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
                                    </tr>
                                @endif
                            @endif
                        @endforeach
                    @endforeach
                @endforeach
            @endforeach
            <tr>
                <td colspan="6">
                    <b>TOTAL</b>
                </td>
                <td>
                    <b>{{$total}}</b>
                </td>
                <td></td>
            </tr>
            <tr><td colspan="8" class="bg-grey-goto text-white"><b>ENTRADAS OTROS</b></td></tr>
            @php
                $total=0;
            @endphp
            @foreach($cotizacion->sortBy('fecha') as $cotizacion_)
                @foreach($cotizacion_->paquete_cotizaciones as $paquete_cotizaciones)
                    @foreach($paquete_cotizaciones->itinerario_cotizaciones->sortBy('fecha') as $itinerario_cotizaciones)
                        @foreach($itinerario_cotizaciones->itinerario_servicios->where('liquidacion','0') as $itinerario_servicios)
                            @if($opcion=='TODOS LOS PENDIENTES')
                                @if($itinerario_servicios->servicio->grupo=='ENTRANCES' && $itinerario_servicios->servicio->clase=='OTROS')
                                    @php
                                        $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                    @endphp
                                    <tr>
                                        <td>
                                            <label class="text-primary">
                                                <input type="checkbox" class="mis-checkboxes" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                <b>{{fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                            </label>
                                        </td>
                                        <td>{{$itinerario_servicios->servicio->clase}}</td>
                                        <td>{{$itinerario_servicios->nombre}}</td>
                                        <td>{{$cotizacion_->nropersonas}}</td>
                                        <td>
                                            <b>
                                                @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                    {{$cotizaciones_cliente->cliente->nombres}} {{$cotizaciones_cliente->cliente->apellidos}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
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
                                    </tr>
                                @endif
                            @endif
                        @endforeach
                    @endforeach
                @endforeach
            @endforeach
            <tr>
                <td colspan="6">
                    <b>TOTAL</b>
                </td>
                <td>
                    <b>{{$total}}</b>
                </td>
                <td></td>
            </tr>
            <tr><td colspan="8" class="bg-grey-goto text-white"><b>ENTRADAS BUSES</b></td></tr>
            @php
                $total=0;
            @endphp
            @foreach($cotizacion->sortBy('fecha') as $cotizacion_)
                @foreach($cotizacion_->paquete_cotizaciones as $paquete_cotizaciones)
                    @foreach($paquete_cotizaciones->itinerario_cotizaciones->sortBy('fecha') as $itinerario_cotizaciones)
                        @foreach($itinerario_cotizaciones->itinerario_servicios->where('liquidacion','0') as $itinerario_servicios)
                            @if($opcion=='TODOS LOS PENDIENTES')
                                @if($itinerario_servicios->servicio->grupo=='MOVILID' && $itinerario_servicios->servicio->clase=='BOLETO')
                                    @php
                                        $total+=$itinerario_servicios->precio*$cotizacion_->nropersonas;
                                    @endphp
                                    <tr>
                                        <td>
                                            <label class="text-primary">
                                                <input type="checkbox" class="mis-checkboxes" value="{{$itinerario_servicios->precio*$cotizacion_->nropersonas}}">
                                                <b>{{fecha_peru($itinerario_cotizaciones->fecha)}}</b>
                                            </label>
                                        </td>
                                        <td>{{$itinerario_servicios->servicio->clase}}</td>
                                        <td>{{$itinerario_servicios->nombre}}</td>
                                        <td>{{$cotizacion_->nropersonas}}</td>
                                        <td>
                                            <b>
                                                @foreach($cotizacion_->cotizaciones_cliente->where('estado','1') as $cotizaciones_cliente)
                                                    {{$cotizaciones_cliente->cliente->nombres}} {{$cotizaciones_cliente->cliente->apellidos}}x{{$cotizacion_->nropersonas}} {{fecha_peru($cotizacion_->fecha)}}
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
                                    </tr>
                                @endif
                            @endif
                        @endforeach
                    @endforeach
                @endforeach
            @endforeach
            <tr>
                <td colspan="6">
                    <b>TOTAL</b>
                </td>
                <td>
                    <b>{{$total}}</b>
                </td>
                <td></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
