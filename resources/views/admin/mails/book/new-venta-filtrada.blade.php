@extends('admin.mails.layouts.inquire')
@section('content')
    <tr>
        <td>
            Nueva venta cerrada,<br>
            La venta <b>{{$coti}}</b> está cerrada, por favor realizar las reservas con los proveedores.
            <a href="http://sistema.gotoperu.com.pe/admin/book/{{$id}}" target="_blank">Revisar venta</a>
            <p>Saludos cordiales</p>
            <p>GOTOPERU - ventas</p>
        </td>
    </tr>
@stop