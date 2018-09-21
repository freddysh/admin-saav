@extends('admin.mails.layouts.inquire')
@section('content')
    <tr>
        <td>
            Nueva venta filtrada,<br>
            La venta <b>{{$coti}}</b> está filtrada, por favor realizar las reservas con los proveedores.
            <a href="http://sistema.gotoperu.com.pe/admin/book" target="_blank">Revisar venta</a>
            <p>Saludos cordiales</p>
            <p>GOTOPERU - contabilidad</p>
        </td>
    </tr>
@stop