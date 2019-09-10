@foreach($day_by_days->sortBy('tipo') as $day_by_day)
    <div id="itinerario{{$day_by_day->id}}" class="row margin-bottom-0">
        <div class="input-group mb-2">
            <span class="input-group-prepend">
                @php
                    $servicios1='';
                    $precio_iti=0;
                    $destinos_iti='';
                    $nro_servicios=0;
                @endphp
                @foreach($day_by_day->itinerario_itinerario_servicios as $servicios)
                    @if($servicios->itinerario_servicios_servicio->grupo!='HOTELS')
                        @php
                            $nro_servicios++;
                        @endphp
                        @if($servicios->itinerario_servicios_servicio->precio_grupo==1)
                            @php
                                $precio_iti+=round($servicios->itinerario_servicios_servicio->precio_venta/2,2);
                                $servicios1.=$servicios->itinerario_servicios_servicio->nombre.'//'.round($servicios->itinerario_servicios_servicio->precio_venta/2,2).'//'.$servicios->itinerario_servicios_servicio->precio_grupo.'*';
                            @endphp
                        @else
                            @php
                                $precio_iti+=$servicios->itinerario_servicios_servicio->precio_venta;
                                $servicios1.=$servicios->itinerario_servicios_servicio->nombre.'//'.$servicios->itinerario_servicios_servicio->precio_venta.'//'.$servicios->itinerario_servicios_servicio->precio_grupo.'*';
                            @endphp
                        @endif
                    @endif
                @endforeach
                @foreach($day_by_day->destinos as $destino)
                    @php
                        $destinos_iti.=$destino->destino.'*';
                    @endphp
                @endforeach
                @php
                    $destinos_iti=substr($destinos_iti,0,strlen($destinos_iti)-1);
                    $servicios1=substr($servicios1,0,strlen($servicios1)-1);
                @endphp
                <div class="input-group-text">
                    <input class="itinerario" type="checkbox"  name="itinerarios[]" value="{{$day_by_day->id}}">
                </div>
            </span>
            @php
                $tipo_msj='IN';
                $tipo_msj_clase='btn-primary';
            @endphp
            @if ($day_by_day->tipo=='b')
                @php
                    $tipo_msj='GEN';
                    $tipo_msj_clase='btn-success';
                @endphp
            @elseif ($day_by_day->tipo=='c')
                @php
                    $tipo_msj='OUT';
                    $tipo_msj_clase='btn-warning';
                @endphp
            @endif
            <span class="input-group-append text-12">                
            <button class="btn {{$tipo_msj_clase}} text-12" type="button" data-toggle="collapse">{{$tipo_msj}}</button>
            </span>
            <input type="text" name="titulo_{{$day_by_day->id}}" class="form-control text-11" aria-label="..." value="{{$day_by_day->titulo}} [{{$m_destinos->where('id',$day_by_day->destino_foco)->first()->codigo}}]" readonly>
            <span class="input-group-append">
                <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#collapse_{{$day_by_day->id}}"><b>${{$precio_iti}}</b> <i class="fas fa-angle-down"></i></button>
            </span>
        </div>
    <div class="collapse clearfix" id="collapse_{{$day_by_day->id}}">
        <div class="col-md-12 well margin-top-5">
            {!!$day_by_day->descripcion!!}
            <table class="table table-condensed table-striped table-responsive">
                <thead>
                <tr class="bg-grey-goto text-white">
                    <th width="80%">Concepts</th>
                    <th width="20%">Prices</th>
                </tr>
                </thead>
                <tbody>
                @foreach($day_by_day->itinerario_itinerario_servicios as $servicios)
                    <tr class="text-12">
                        <td>
                            @if($servicios->itinerario_servicios_servicio->grupo=='TOURS')
                                <i class="fas fa-map text-info"></i>
                            @elseif($servicios->itinerario_servicios_servicio->grupo=='MOVILID')
                                <i class="fas fa-bus text-warning"></i>
                            @elseif($servicios->itinerario_servicios_servicio->grupo=='REPRESENT')
                                <i class="fas fa-users text-success"></i>
                            @elseif($servicios->itinerario_servicios_servicio->grupo=='ENTRANCES')
                                <i class="fas fa-ticket-alt text-warning"></i>
                            @elseif($servicios->itinerario_servicios_servicio->grupo=='FOOD')
                                <i class="fas fa-utensils text-danger"></i>
                            @elseif($servicios->itinerario_servicios_servicio->grupo=='TRAINS')
                                <i class="fas fa-train text-info"></i>
                            @elseif($servicios->itinerario_servicios_servicio->grupo=='FLIGHTS')
                                <i class="fas fa-plane text-primary"></i>
                            @elseif($servicios->itinerario_servicios_servicio->grupo=='OTHERS')
                                <i class="fas fa-question text-success"></i>
                            @endif
                            {{ $servicios->itinerario_servicios_servicio->nombre}}
                            <span class="text-danger"> | </span>
                            <span class="text-primary">
                                {{ $servicios->itinerario_servicios_servicio->tipoServicio }}
                            </span>
                            @if($servicios->itinerario_servicios_servicio->grupo=='TOURS'||$servicios->itinerario_servicios_servicio->grupo=='MOVILID'||$servicios->itinerario_servicios_servicio->grupo=='REPRESENT'||$servicios->itinerario_servicios_servicio->grupo=='OTHERS')
                                <span class="text-danger"> | </span>
                                <span class="text-primary">
                                    [{{ $servicios->itinerario_servicios_servicio->min_personas }} - {{ $servicios->itinerario_servicios_servicio->max_personas }}]
                                </span>
                            @elseif($servicios->itinerario_servicios_servicio->grupo=='TRAINS'||$servicios->itinerario_servicios_servicio->grupo=='FLIGHTS')
                                <span class="text-danger"> | </span>
                                <span class="text-primary">
                                    [{{ $servicios->itinerario_servicios_servicio->salida }} - {{ $servicios->itinerario_servicios_servicio->llegada }}]
                                </span>
                            @endif
                        </td>
                        <td class="text-right">
                            <b>
                                <sup>$</sup>
                                @if($servicios->itinerario_servicios_servicio->precio_grupo==1)
                                    {{ round($servicios->itinerario_servicios_servicio->precio_venta/2,2)}}
                                @else
                                    {{ round($servicios->itinerario_servicios_servicio->precio_venta,2)}}
                                @endif
                            </b>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endforeach