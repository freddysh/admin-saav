
<table id="tb_HOTELS" class="table table-bordered table-sm">
    <thead>
    <tr>
        <th>Localizacion</th>
        <th>Categoria</th>
        <th>Proveedor</th>
        <th>Opciones</th>

    </tr>
    </thead>
    <tbody>
    @foreach($hotel as $hotel_)
        <tr id="h_p_{{$hotel_->id}}">

            <td>{{ucwords(strtolower($hotel_->localizacion))}}</td>
            <td>{{$hotel_->estrellas}} Stars</td>
            <td>{{ucwords(strtolower($hotel_->proveedor->nombre_comercial))}}</td>
            <td class="text-center">
                <b class="text-warning">
                    <a class="text-warning" href="{{route('editar_hotel_proveedor_path',$hotel_->id)}}">
                        <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                    </a>
                </b>
                <b href="!#" class="puntero text-danger" onclick="eliminar_hotel_pro('{{$hotel_->proveedor->nombre_comercial}}','{{$hotel_->id}}')">
                    <i class="fa fa-trash" aria-hidden="true"></i>

                </b>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
