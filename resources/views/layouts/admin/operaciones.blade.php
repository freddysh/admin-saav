<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    {{--estilos--}}
    <link rel="stylesheet" href="{{mix("css/app.css")}}">
    <link rel="stylesheet" href="{{mix("css/admin/admin.css")}}">
    {{--fonts--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.6.2/sweetalert2.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap.min.css"/>

    @yield('archivos-css')
    {{--scripts--}}
    <script src="{{asset("js/app.js")}}"></script>
    <script src="{{asset("https://cdn.jsdelivr.net/sweetalert2/6.6.2/sweetalert2.js")}}"></script>
    @yield('archivos-js')
    <script src="{{asset("js/admin/plugins.js")}}"></script>
    {{--<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>--}}
</head>
<body>

{{--@include('layouts.admin.nav-operaciones')--}}
@php
    function activar_link2($link){
        $activo='';
        if(request()->is($link))
        $activo=' menu-lista-activo';


        return $activo;
    }
@endphp
<div class="container-fluid">
    <div class="row">
        <div class="col-2">
            @include('layouts.admin.nav')
        </div>
        <div class="col-10">
            @yield('content')
        </div>
    </div>
</div>
{{--scripts--}}
<script src="{{asset("js/font-awesome.js")}}"></script>
<script>
    var jumboHeight = $('.jumbotron').outerHeight();
    function parallax(){
        var scrolled = $(window).scrollTop();
        $('.bg').css('height', (jumboHeight-scrolled) + 'px');
    }

    $(window).scroll(function(e){
        parallax();
    });
</script>



</body>
</html>
