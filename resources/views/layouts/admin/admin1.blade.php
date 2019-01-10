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
    @yield('archivos-css')
    <script src="{{asset("js/app.js")}}"></script>
    
    {{--scripts--}}
    <script src="{{asset("https://cdn.jsdelivr.net/sweetalert2/6.6.2/sweetalert2.js")}}"></script>
    <script src="{{asset("js/admin/plugins.js")}}"></script>
    @yield('archivos-js')
    
</head>
<body data-spy="scroll" data-target="#menu" class="position-relative">
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
            @include('layouts.admin.nav1')
        </div>
        <div class="col-10">
            @yield('content')
        </div>
    </div>
</div>
{{--scripts--}}
<script src="{{asset("js/font-awesome.js")}}"></script>
<script>
    var swiper = new Swiper('.swiper-container', {
        direction: 'vertical',
        slidesPerView: 'auto',
        freeMode: true,
        scrollbar: {
            el: '.swiper-scrollbar',
        },
        mousewheel: true,
    });

    var jumboHeight = $('.jumbotron').outerHeight();
    function parallax(){
        var scrolled = $(window).scrollTop();
        $('.bg').css('height', (jumboHeight-scrolled) + 'px');
    }

    $(window).scroll(function(e){
        parallax();
    });

    $('.popover-hover').popover({
        trigger: 'hover'
    });
    $('.popover-focus').popover({
        trigger: 'focus',
        html: true
    });
    $('.popover-dismiss').popover({
        trigger: 'focus',
        html: true
    })

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    $(function () {
        $('[data-toggle="popover"]').popover({
            html: true
        })
    })
</script>



</body>
</html>