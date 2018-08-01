<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{--estilos--}}
    <link rel="stylesheet" href="{{mix("css/admin/admin.css")}}">
    {{--fonts--}}
    <link rel="stylesheet" href="{{mix("css/font-awesome.css")}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.6.2/sweetalert2.css">

    <script src="{{asset("js/app.js")}}"></script>
    @yield('archivos-css')
    {{--scripts--}}
    <script src="{{asset("https://cdn.jsdelivr.net/sweetalert2/6.6.2/sweetalert2.js")}}"></script>
    @yield('archivos-js')
    <script src="{{asset("js/admin/plugins.js")}}"></script>
</head>
<body>
@include('layouts.admin.nav-login')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-sm-offset-4  main">
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>