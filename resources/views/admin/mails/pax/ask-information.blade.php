@extends('admin.mails.layouts.inquire')
@section('content')
    <tr>
        <td>
            Dear {{$name}},<br>
            Below you will find a secure link to fill your personal information in order to complete bookings.<br>
            <a href="http://yourtrip.gotoperu.com.pe/booking_information_full/{{$cotizacion_id}}-{{$pqt_id}}" target="_blank">Fill Information</a>
            <p>If you need any assistance please dont hesitate to contact us.</p>
            <p>Cordially</p>
            <p>GOTOPERU</p>
        </td>
    </tr>
@stop