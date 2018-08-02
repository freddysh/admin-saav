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

    <script src="{{asset("js/app.js")}}"></script>
    @yield('archivos-css')
    {{--scripts--}}
    <script src="{{asset("https://cdn.jsdelivr.net/sweetalert2/6.6.2/sweetalert2.js")}}"></script>
    @yield('archivos-js')
    <script src="{{asset("js/admin/plugins.js")}}"></script>

</head>
<body>

<div class="container-fluid">
    <div class="row">
        {{--<div class="hide col-sm-3 col-md-2 sidebar">--}}
        {{--<ul class="nav nav-sidebar">--}}
        {{--<li class="padding-side-20 bg-green-goto text-white text-20">Database</li>--}}
        {{--<li><a href="{{route('provider_index_path')}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Providers</a></li>--}}
        {{--</ul>--}}
        {{--</div>--}}
        <div class="col-2">
            @include('layouts.admin.nav')
        </div>
        <div class="col-10">
            @yield('content')
        </div>
    </div>
</div>
{{--@include('layouts.admin.nav-contabilidad')--}}
{{--@include('layouts.admin.nav')--}}

{{--<div class="container-fluid">--}}
    {{--<div class="row">--}}
        {{--<div class="hide col-sm-3 col-md-2 sidebar">--}}
            {{--<ul class="nav nav-sidebar margin-bottom-0">--}}
                {{--<li class="padding-side-20 bg-green-goto text-white text-20">Contabilidad</li>--}}
                {{--<li class="divider"></li>--}}
                {{--<li class="padding-side-20 bg-sub-title-aside"><b class="text-green-goto text-16">Operaciones</b></li>--}}
                {{--<li class="padding-side-20 bg-sub-title-aside"><b class="text-green-goto text-16">Servicios</b></li>--}}
                {{--<li class="divider"></li>--}}
                {{--<li ><a href="{{route('contabilidad_index_path')}}"><i class="fa fa-angle-right" aria-hidden="true"></i> All</a></li>--}}
                {{--<li ><a href="{{route('list_proveedores_path')}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Listar por Proveedores</a></li>--}}
                {{--<li ><a href="{{route('rango_fecha_path')}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Listar por fechas</a></li>--}}
                {{--<li class="divider"></li>--}}
                {{--<li class="padding-side-20 bg-sub-title-aside"><b class="text-green-goto text-16">Hoteles</b></li>--}}
                {{--<li class="divider"></li>--}}
                {{--<li ><a href="{{route('contabilidad_index_path')}}"><i class="fa fa-angle-right" aria-hidden="true"></i> All</a></li>--}}
                {{--<li ><a href="{{route('list_proveedores_path')}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Listar por Proveedores</a></li>--}}
                {{--<li ><a href="{{route('rango_fecha_hotel_path')}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Listar por fechas</a></li>--}}
                {{--<li class="padding-side-20 bg-sub-title-aside"><b class="text-green-goto text-16">Pagos</b></li>--}}
                {{--<li class="divider"></li>--}}
                {{--<li ><a href=""><i class="fa fa-angle-right" aria-hidden="true"></i> Pagar</a></li>--}}
                {{--<li ><a href=""><i class="fa fa-angle-right" aria-hidden="true"></i> February </a></li>--}}
                {{--<li ><a href=""><i class="fa fa-angle-right" aria-hidden="true"></i> March</a></li>--}}
                {{--<li ><a href=""><i class="fa fa-angle-right" aria-hidden="true"></i> April</a></li>--}}
                {{--<li ><a href=""><i class="fa fa-angle-right" aria-hidden="true"></i> May</a></li>--}}
                {{--<li ><a href=""><i class="fa fa-angle-right" aria-hidden="true"></i> Jane</a></li>--}}
                {{--<li ><a href=""><i class="fa fa-angle-right" aria-hidden="true"></i> July</a></li>--}}
                {{--<li ><a href=""><i class="fa fa-angle-right" aria-hidden="true"></i> August</a></li>--}}
                {{--<li ><a href=""><i class="fa fa-angle-right" aria-hidden="true"></i> September</a></li>--}}
                {{--<li ><a href=""><i class="fa fa-angle-right" aria-hidden="true"></i> October</a></li>--}}
                {{--<li ><a href=""><i class="fa fa-angle-right" aria-hidden="true"></i> November</a></li>--}}
                {{--<li ><a href=""><i class="fa fa-angle-right" aria-hidden="true"></i> December</a></li>--}}
                {{--<li class="divider"></li>--}}
                {{--<li class="padding-side-20 bg-sub-title-aside"><b class="text-green-goto text-16">Quotes</b></li>--}}
                {{--<li class="divider"></li>--}}
                {{--<li><a href="{{route("quotes_new_path")}}"><i class="fa fa-angle-right" aria-hidden="true"></i> New</a></li>--}}
                {{--<li><a href="{{route("current-quote_path")}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Current</a></li>--}}
                {{--<li class="divider"></li>--}}
                {{--<li class="padding-side-20 bg-sub-title-aside"><b class="text-green-goto text-16">Sales</b></li>--}}
            {{--</ul>--}}
            {{--<ul class="nav nav-sidebar hide">--}}
            {{--<li class="padding-side-20 bg-green-goto text-white text-20">Operations</li>--}}
            {{--<li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i> Reservas</a></li>--}}
            {{--<li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i> Trafico</a></li>--}}
            {{--</ul>--}}
            {{--<ul class="nav nav-sidebar">--}}
                {{--<li class="padding-side-20 bg-green-goto text-white text-20">Database</li>--}}
{{--                <li><a href="{{route('destination_index_path')}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Destinations</a></li>--}}
{{--                <li><a href="{{route('category_index_path')}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Categories</a></li>--}}
{{--                <li><a href="{{route('service_index_path')}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Products</a></li>--}}
{{--                <li><a href="{{route('provider_index_path')}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Providers</a></li>--}}
                {{--<li><a href="{{route('costs_index_path')}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Costs</a></li>--}}
            {{--</ul>--}}
        {{--</div>--}}
        {{--<div class="col-sm-3 col-md-2 sidebar">--}}
            {{--@include('layouts.menu-lateral')--}}
        {{--</div>--}}
        {{--<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">--}}
            {{--@yield('content')--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
{{--scripts--}}

{{--scripts--}}
<script src="{{asset("js/font-awesome.js")}}"></script>

</body>
</html>