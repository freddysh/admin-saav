
<table id="tb_{{$destino[0]}}_{{$destino[1]}}" class="{{$destino[1]}} table table-sm table-striped table-bordered mt-3" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Localizacion</th>
        <th>Codigo</th>
        <th>Clase</th>
        <th>Ruta</th>
        <th>Horario</th>
        <th>Precio</th>
        <th>Operaciones</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th>Localizacion</th>
        <th>Codigo</th>
        <th>Clase</th>
        <th>Ruta</th>
        <th>Horario</th>
        <th>Precio</th>
        <th>Operaciones</th>
    </tr>
    </tfoot>
    <tbody>
    @php
        $pos = 0;
    @endphp
    @foreach ($sericios->sortBy('localizacion') as $servicio)
    <tr class="{{$servicio->localizacion}}" id="lista_services_{{$servicio->id}}">
        <td class="text-green-goto">{{ucwords(strtolower($servicio->localizacion))}}</td>
        <td class="text-green-goto">{{$servicio->codigo}}</td>
        <td id="tipo_{{$servicio->id}}">{{ucwords(strtolower($servicio->tipoServicio))}}</td>
        <td id="nombre_{{$servicio->id}}">{{ucwords(strtolower($servicio->nombre))}}</td>
        <td id="horario_{{$servicio->id}}">{{$servicio->salida}}-{{$servicio->llegada}}</td>
        <td id="precio_{{$servicio->id}}" class="text-right"><sup>$</sup>{{$servicio->precio_venta}}</td>
        <td class="text-center">

        </td>
    </tr>
    @endforeach
    </tbody>
</table>