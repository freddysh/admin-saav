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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--<link rel="stylesheet" href="{{mix("css/bootstrap-clockpicker.css")}}">--}}
</head>
<body>

{{--@include('layouts.admin.nav-book')--}}
{{--@include('layouts.admin.nav')--}}
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
{{--scripts--}}
<script src="{{asset("js/font-awesome.js")}}"></script>
{{--<script src="{{asset("js/admin/bootstrap-clockpicker.js")}}"></script>--}}

</body>
</html>