
<table id="tb_HOTELS" class="table table-striped table-bordered table-responsive text-12" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th class="col-lg-1">Localizacion</th>
        <th class="col-lg-1">Categoria</th>
        <th class="col-lg-1">Proveedor</th>
        <th class="col-lg-1">Opciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($hotel as $hotel_)
        <tr id="h_p_{{$hotel_->id}}">
            <td>{{$hotel_->localizacion}}</td>
            <td>{{$hotel_->estrellas}} Stars</td>
            <td>{{$hotel_->proveedor->nombre_comercial}}</td>
            <td>
                <b class="text-warning">
                    <a class="text-warning" href="{{route('editar_hotel_proveedor_path',$hotel_->id)}}">
                        <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                    </a>
                </b>
                <b href="!#" class="puntero text-danger" onclick="eliminar_hotel_pro('{{$hotel_->proveedor->nombre_comercial}}','{{$hotel_->id}}')">
                    <i class="fa fa-trash-o fa-2x" aria-hidden="true"></i>
                </b>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
