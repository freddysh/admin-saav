@extends('admin.mails.layouts.inquire')
@section('content')
    <tr>
        <td>
            Nueva venta confirmada,<br>
            Tenemos una ventra confimada a nombre de <b>{{$coti}}</b>, por favor realizar el filtro.
            <a href="http://sistema.gotoperu.com.pe/admin/contabilidad/{{$anio}}" target="_blank">Realizar filtro</a>
            <p>Saludos cordiales</p>
            <p>GOTOPERU</p>
        </td>
    </tr>
@stop