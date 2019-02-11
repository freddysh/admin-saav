@extends('admin.mails.layouts.inquire')
@section('content')
    <tr>
        <td>
            <strong>Venta anulada!</strong><br>
                La venta <b>{{$coti}}</b> ha sido {{$anulada}} el {{MisFunciones::fecha_peru($fecha)}} por {{$nombre_ventas}}, por favor informar a los proveedores lo sucedido.
            <a href="http://sistema.gotoperu.com.pe/admin/book/{{$id}}" target="_blank">Revisar venta</a>
            <p>Saludos cordiales</p>
            <p>GOTOPERU - ventas</p>
        </td>
    </tr>
@stop