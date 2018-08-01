<nav class="navbar navbar-fixed-top bg-grey-goto">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="nav-brand-goto margin-top-10" href="/">
                <img alt="Brand" src="{{asset("img/logos/logo-gotoperu.png")}}" width="200">
            </a>
        </div>
        <div class="collapse navbar-collapse">

            <ul class="nav navbar-nav margin-left-60">
                <li><a href="{{route('operaciones_path')}}">Operaciones</a></li>
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