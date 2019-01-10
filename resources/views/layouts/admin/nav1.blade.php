            {{--@include('layouts.menu-lateral')--}}

            <nav id="sidebar" class="bg-light p-2">
                <div class="sidebar-header">
                    <img alt="Brand" src="{{asset("img/logos/logo-gotoperu.png")}}" class="w-100">
                    <div class="row justify-content-center my-3">
                        <div class="col-8 text-center">
                            <img src="https://scontent.flim9-1.fna.fbcdn.net/v/t1.0-9/31739806_993323907486435_1000599518791598080_n.jpg?_nc_cat=0&oh=5eb66ecc0cc7c6c1897958ef0907c7b1&oe=5B9E1A5A" alt="" class="rounded-circle w-100">
                            <p class="m-0">
                                {{auth()->guard('admin')->user()->name}}
                                <a href="#" class="popover-dismiss"
                                   data-toggle="popover" data-trigger="focus" data-placement="bottom"
                                   data-content="<ul class='list-style-none text-left p-0'>
                                        <li><a href=''><i class='fas fa-user-circle'></i> <span class='pl-2'>Profile</span></a></li>
                                        <li><a href='{{route('logout_path')}}'><i class='fas fa-sign-out-alt'></i> <span class='pl-2'>Logout</span></a></li>
                                    </ul>"
                                ><i class="fas fa-caret-down"></i></a>
                                <span class="d-block text-info">({{auth()->guard('admin')->user()->tipo_user}})</span>
                            </p>
                        </div>
                    </div>
                </div>
                @include('layouts.menu-full')
            </nav>


<nav class="navbar bg-white d-none">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="nav-brand-goto margin-top-10" href="/">
                <img alt="Brand" src="{{asset("img/logos/logo-gotoperu.png")}}" width="200">
            </a>
        </div>
        <div class="collapse navbar-collapse">

            <ul class="nav navbar-nav margin-left-60">
                @include('layouts.menu')
                    {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li><a href="#">Action</a></li>--}}
                        {{--<li><a href="#">Another action</a></li>--}}
                        {{--<li><a href="#">Something else here</a></li>--}}
                        {{--<li role="separator" class="divider"></li>--}}
                        {{--<li><a href="#">Separated link</a></li>--}}
                        {{--<li role="separator" class="divider"></li>--}}
                        {{--<li><a href="#">One more separated link</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
            </ul>

            <!-- Split button -->
            <div class="btn-group margin-top-7 navbar-right margin-right-0">
                <button type="button" class="btn btn-default"><img src="https://scontent.flim5-1.fna.fbcdn.net/v/t1.0-9/11219300_539606706191493_953162067565331778_n.jpg?oh=1e9c73929e406bf2b93275b010f287a0&oe=59957E5D" alt="" class="img-circle" width="20">
                    {{auth()->guard('admin')->user()->email}}
                </button>
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#">Profile</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="{{route('logout_path')}}">Logout</a></li>
                </ul>
            </div>

        </div>
    </div>
</nav>

{{--<nav class="navbar navbar-inverse navbar-fixed-top hide">--}}
{{--<div class="container-fluid">--}}
{{--<div class="navbar-header">--}}
{{--<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">--}}
{{--<span class="sr-only">Toggle navigation</span>--}}
{{--<span class="icon-bar"></span>--}}
{{--<span class="icon-bar"></span>--}}
{{--<span class="icon-bar"></span>--}}
{{--</button>--}}
{{--<a class="navbar-brand" href="#"> <img src="https://gotoperu.com/img/logos/logo-gotoperu.png" width="100" alt=""></a>--}}
{{--<!-- Split button -->--}}
{{--<div class="btn-group margin-top-7">--}}
{{--<button type="button" class="btn btn-default"><img src="https://scontent.flim5-1.fna.fbcdn.net/v/t1.0-9/11219300_539606706191493_953162067565331778_n.jpg?oh=1e9c73929e406bf2b93275b010f287a0&oe=59957E5D" alt="" class="img-circle" width="20">--}}
{{--Hidalgo Ch Ponce--}}
{{--</button>--}}
{{--<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--<span class="caret"></span>--}}
{{--<span class="sr-only">Toggle Dropdown</span>--}}
{{--</button>--}}
{{--<ul class="dropdown-menu">--}}
{{--<li><a href="#">Profile</a></li>--}}
{{--<li role="separator" class="divider"></li>--}}
{{--<li><a href="#">Logout</a></li>--}}
{{--</ul>--}}
{{--</div>--}}
{{--</div>--}}
{{--<div id="navbar" class="navbar-collapse collapse">--}}
{{--<ul class="nav navbar-nav navbar-right">--}}
{{--<li><a href="#"></a></li>--}}
{{--</ul>--}}
{{--<form class="navbar-form navbar-right">--}}
{{--<input type="text" class="form-control" placeholder="Search...">--}}
{{--</form>--}}
{{--</div>--}}
{{--</div>--}}
{{--</nav>--}}