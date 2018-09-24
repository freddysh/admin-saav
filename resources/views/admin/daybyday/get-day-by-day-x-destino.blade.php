@foreach($day_by_days->sortby('titulo') as $day_by_day)
    <div id="itinerario{{$day_by_day->id}}" class="row margin-bottom-0">
    <div class="input-group mb-2">
                                            <span class="input-group-prepend">
                                                <?php
                                                $servicios1='';
                                                $precio_iti=0;
                                                $destinos_iti='';
                                                ?>
                                                @foreach($day_by_day->itinerario_itinerario_servicios as $servicios)
                                                    <?php
                                                    if($servicios->itinerario_servicios_servicio->grupo!='HOTELS'){
                                                        if($servicios->itinerario_servicios_servicio->precio_grupo==1){
                                                            $precio_iti+=round($servicios->itinerario_servicios_servicio->precio_venta/2,2);
                                                            $servicios1.=$servicios->itinerario_servicios_servicio->nombre.'//'.round($servicios->itinerario_servicios_servicio->precio_venta/2,2).'//'.$servicios->itinerario_servicios_servicio->precio_grupo.'*';
                                                        }
                                                        else{
                                                            $precio_iti+=$servicios->itinerario_servicios_servicio->precio_venta;
                                                            $servicios1.=$servicios->itinerario_servicios_servicio->nombre.'//'.$servicios->itinerario_servicios_servicio->precio_venta.'//'.$servicios->itinerario_servicios_servicio->precio_grupo.'*';
                                                        }
                                                    }
                                                    ?>
                                                @endforeach
                                                @foreach($day_by_day->destinos as $destino)
                                                    <?php
                                                    $destinos_iti.=$destino->destino.'*';
                                                    ?>
                                                @endforeach
                                                <?php
                                                $destinos_iti=substr($destinos_iti,0,strlen($destinos_iti)-1);
                                                $servicios1=substr($servicios1,0,strlen($servicios1)-1);
                                                ?>
                                                <div class="input-group-text">
                                                <input class="itinerario" type="checkbox" aria-label="..." name="itinerarios_{{$day_by_day->id}}" value="{{$day_by_day->id}}_{{$destinos_iti}}_{{$day_by_day->titulo}}_a_{{$precio_iti}}_s">
                                            </div>
                                            </span>
        <input type="text" name="titulo_{{$day_by_day->id}}" class="form-control text-11" aria-label="..." value="{{$day_by_day->titulo}}" readonly>
        <span class="input-group-append">
                                                <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#collapse_{{$day_by_day->id}}"><b>${{$precio_iti}}</b> <i class="fas fa-angle-down"></i></button>
                                            </span>
    </div>
    <div class="collapse clearfix" id="collapse_{{$day_by_day->id}}">
        <div class="col-md-12 well margin-top-5">
            @php echo $day_by_day->descripcion; @endphp
            <h5><b>Services</b></h5>
            <table class="table table-condensed table-striped">
                <thead>
                <tr class="bg-grey-goto text-white">
                    <th width="80%">Concepts</th>
                    <th width="20%">Prices</th>
                </tr>
                </thead>
                <tbody>
                @foreach($day_by_day->itinerario_itinerario_servicios as $servicios)
                    <tr>
                        <td>
                            @if($servicios->itinerario_servicios_servicio->grupo=='TOURS')
                                <i class="fas fa-map text-info"></i>
                            @elseif($servicios->itinerario_servicios_servicio->grupo=='MOVILID')
                                <i class="fas fa-bus text-info"></i>
                            @elseif($servicios->itinerario_servicios_servicio->grupo=='REPRESENT')
                                <i class="fas fa-users text-info"></i>
                            @elseif($servicios->itinerario_servicios_servicio->grupo=='ENTRANCES')
                                <i class="fas fa-ticket text-info"></i>
                            @elseif($servicios->itinerario_servicios_servicio->grupo=='FOOD')
                                <i class="fas fa-utensils text-info"></i>
                            @elseif($servicios->itinerario_servicios_servicio->grupo=='TRAINS')
                                <i class="fas fa-train text-info"></i>
                            @elseif($servicios->itinerario_servicios_servicio->grupo=='FLIGHTS')
                                <i class="fas fa-plane text-info"></i>
                            @elseif($servicios->itinerario_servicios_servicio->grupo=='OTHERS')
                                <i class="fas fa-question text-info"></i>
                            @endif
                            {{$servicios->itinerario_servicios_servicio->nombre}}</td>
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