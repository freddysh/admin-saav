<nav class="navbar navbar-fixed-top bg-white">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="nav-brand-goto margin-top-10" href="/">
                <img alt="Brand" src="{{asset("img/logos/logo-gotoperu.png")}}" width="200">
            </a>
        </div>
        <div class="collapse navbar-collapse">

            <ul class="nav navbar-nav margin-left-60">
                <li><a class="ventas " href="{{route('index_path')}}">Ventas</a></li>
                <li><a class="reservas activo" href="{{route('book_path')}}">Reservas</a></li>
                <li><a class="contabilidad" href="{{route('contabilidad_index_path')}}">Contabilidad</a></li>
                <li><a class="operaciones" href="{{route('operaciones_path')}}">Operaciones</a></li>
                <li><a class="reportes" href="{{route('reportes_path')}}">Reportes</a></li>
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
