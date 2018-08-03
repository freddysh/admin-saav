@foreach($day_by_days->sortBy('titulo') as $day_by_day)
    @php
        $servicios1='';
        $precio_iti=0;
        $destinos_iti='';
    @endphp
    @foreach($day_by_day->itinerario_itinerario_servicios as $servicios)
        @if($servicios->itinerario_servicios_servicio->grupo!='HOTELS')
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
<div>
    <div class="row" >
        <div class="form-group">
            <div class="form-check">
                <input class="itinerario form-check-input" type="checkbox" id="checkbox_{{$day_by_day->id}}" name="itinerarios_{{$day_by_day->id}}" value="{{$day_by_day->id}}_{{$destinos_iti}}_{{$day_by_day->titulo}}_a_{{$precio_iti}}_s">
                <label class="form-check-label" for="checkbox_{{$day_by_day->id}}">
                    {{$day_by_day->titulo}}
                    <b>${{$precio_iti}}</b>
                    <a class="text-primary" data-toggle="collapse" href="#collapseExample_{{$day_by_day->id}}" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fas fa-eye"></i>
                    </a>
                </label>
            </div>
        </div>
    </div>
    <div class="collapse" id="collapseExample_{{$day_by_day->id}}">
        <div class="card card-body">
            <p class="text-10">{!! $day_by_day->descripcion !!}</p>
            <table class="table table-striped table-responsive table-borderless">
                <thead>
                <tr>
                    <th width="80%">Concepto</th>
                    <th width="20%">Costo</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($day_by_day->itinerario_itinerario_servicios as $servicios)
                        <tr>
                            <td>{{$servicios->itinerario_servicios_servicio->nombre}}</td>
                            <td>
                                @if($servicios->itinerario_servicios_servicio->precio_grupo==1)
                                    {{round($servicios->itinerario_servicios_servicio->precio_venta/2,2)}}
                                @else
                                    {{$servicios->itinerario_servicios_servicio->precio_venta}}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endforeach