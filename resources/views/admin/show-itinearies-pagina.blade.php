<table id="example" class="table table-sm table-bordered" cellspacing="0">
    <thead>
    <tr>
        <th>Pagina</th>
        <th>Codigo</th>
        <th>Titulo</th>
        <th>Destinos</th>
        <th>Operaciones</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th>Pagina</th>
        <th>Codigo</th>
        <th>Titulo</th>
        <th>Destinos</th>
        <th>Operaciones</th>
    </tr>
    </tfoot>
    <tbody>
    @foreach($itineraries->sortByDesc('fecha') as $itinerary)
        <tr id="lista_destinos_{{$itinerary->id}}">
            <td>{{$itinerary->pagina}}</td>
            <td>{{$itinerary->codigo}}</td>
            @php
                $arra_destinos=array();
                $lista='';
                $existe=0;
            @endphp
            @foreach($itinerary->itinerarios as $itinerario)
                {{--@foreach($itinerarios->where('titulo',$itinerario->titulo) as $iti)--}}
                {{--@endforeach--}}
                @if($itinerario->where('titulo',$itinerario->titulo)->count('titulo')>0)
                    @php
                        $existe++;
                    @endphp
                @endif

                @php
                    $lista.="<p class=\"small text-primary\"><b>Dia: ".$itinerario->dias."</b> ".$itinerario->titulo."</p>";
                @endphp
                @foreach($itinerario->destinos as $destino)
                    @php
                        $arra_destinos[$destino->destino]=$destino->destino;
                    @endphp
                @endforeach
            @endforeach

            <td>
                <a id="propover_{{$itinerary->id}}" href="{{route('show_itinerary_path',$itinerary->id)}}" data-toggle="popover" title="{{$itinerary->titulo}} x {{$itinerary->duracion}} DAYS" data-content="{{$lista}}">{{ucwords(strtolower($itinerary->titulo))}} x {{$itinerary->duracion}} DAYS</a>
                @if(($itinerary->itinerarios->count()-$existe)>0)
                    <span class="small text-danger">({{($itinerary->itinerarios->count()-$existe)}} de {{$itinerary->itinerarios->count()}} "Day by Day" se modificaron)</span>
                @endif
                <i class='small text-secondary d-block'>Creado: {{$itinerary->created_at}}</i>
            </td>
            <td>
                @foreach($arra_destinos as $destino)
                    <p class="small m-0"><i class="fa fa-map-marker-alt text-secondary" aria-hidden="true"></i> {{ucwords(strtolower($destino)) }}</p>
                @endforeach
            </td>
            <td class="text-center">
                <a href="{{route('package_pdf_path',$itinerary->id)}}" class="btn btn-success btn-sm">
                    <i class="fa fa-download"></i>
                </a>
                <a href="{{route('duplicate_package_path',$itinerary->id)}}" class="btn btn-primary btn-sm">
                    <i class="fas fa-file"></i>
                </a>
                {{csrf_field()}}
                <button type="button" class="btn btn-danger btn-sm" onclick="eliminar_paquete('{{$itinerary->id}}','{{$itinerary->titulo}} x {{$itinerary->duracion}} DAYS')">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>