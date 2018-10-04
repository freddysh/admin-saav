@php
function seachIn($destinos,$arreglo){
    $rpt=true;
    foreach ($destinos as $valor){
        if($rpt){
            if(!in_array($valor,$arreglo)){
               $rpt=false;
            }
        }
    }
    return $rpt;
}
    $pos=0;
    $precio_hotel_s=0;
    $precio_hotel_d=0;
    $precio_hotel_m=0;
    $precio_hotel_t=0;
    $estrellas='0';
@endphp
@foreach($ppaquetes as $p_paquete_)
    @php
        $array_destinos2=[];
    $iti_total=0;
    $cadena_hiden='';
    $array_destinos1='';
    @endphp
    @foreach($p_paquete_->itinerarios as $itinerarios0)
        @foreach($itinerarios0->destinos as $destino0)
            @php
                $array_destinos2[$destino0->destino]=$destino0->destino;
            @endphp
        @endforeach
    @endforeach
    @foreach($array_destinos2 as $arreglo)
        @php
            $array_destinos1.=$arreglo.'/';
        @endphp
    @endforeach
    @if(seachIn($destinos,$array_destinos2))
        <div class="col-4  mb-3" id="itinerario3_0_{{$pos}}">
            <div class="card w-100">
                <div class="card-header">
                    @foreach($p_paquete_->itinerarios as $itinerarios0)
                        @foreach($itinerarios0->serivicios as $serivicios0)
                            @if($serivicios0->precio_grupo==1)
                                @php
                                    $iti_total+=$serivicios0->precio;
                                    $cadena_hiden.=($serivicios0->precio*2).'_g/';
                                @endphp
                            @else
                                @php
                                    $iti_total+=$serivicios0->precio;
                                    $cadena_hiden.=$serivicios0->precio.'_i/';
                                @endphp
                            @endif
                        @endforeach
                    @endforeach
                    <label class="lista_itinerarios2 small font-weight-bold">
                        <input class="lista_itinerarios3" type="hidden"  value="{{$p_paquete_->id.'_'.$p_paquete_->duracion.'_'.$array_destinos1.'_'.$pos}}">
                        <input class="paquetespack" type="radio" name="paquetes[]" id="pqt_{{$pos}}" value="{{$p_paquete_->id.'_'.$p_paquete_->duracion.'_'.$array_destinos1.'_'.$estrellas}}" onchange="mostrar_datos('{{$p_paquete_->id.'_'.$p_paquete_->duracion.'_'.$iti_total.'_'.$pos.'_'.$estrellas}}')">
                        <input type="hidden" name="datos_paquete_{{$p_paquete_->id}}" id="datos_paquete_{{$p_paquete_->id}}" value="0">
                        <input type="hidden" class="lista_itinerarios4" id="lista_servicios_{{$pos}}" value="{{$cadena_hiden}}">
                        <span class="text-green-goto">{{$p_paquete_->codigo}} - </span> <span class="text-g-yellow">{{$estrellas}} STARS</span>
                    </label>
                </div>
                <div id="collapseExample_{{$p_paquete_->id}}" class="card-body">
                    <h6 class="text-center text-secondary">{{$p_paquete_->titulo}}</h6>
                    <ul class="list-style-none p-0">
                        @foreach($p_paquete_->itinerarios as $itinerarios0)
                            <li><small><b class="font-weight-bold">Dia {{$itinerarios0->dias}}</b> {{ucwords(strtolower($itinerarios0->titulo))}}</small></li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Basado en 2 personas <span class="text-primary"><sup>$</sup>{{$iti_total}}</span></small>
                </div>
            </div>
        </div>
    @endif
@endforeach