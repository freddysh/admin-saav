@extends('layouts.admin.admin')
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Database</li>
            <li class="active">Destination</li>
        </ol>
    </div>
    <div class="row margin-top-20">
        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="media">
                        @foreach($cotizacion->sortBy('fecha') as $cotizaciones)
                            @foreach($cotizaciones->cotizaciones_cliente->where('estado', 1) as $coti_cliente)
                                @foreach($clients->where('id', $coti_cliente->clientes_id) as $cliente)
                                    <div align="center">
                                        <img class="thumbnail img-responsive" src="https://lut.im/7JCpw12uUT/mY0Mb78SvSIcjvkf.png" width="300px" height="300px">
                                        {{--<span class="text-warning"><i class="fa fa-2x fa-male"></i></span>--}}
                                    </div>
                                    <div class="media-body">
                                        <h3><strong>Fecha de viaje</strong></h3>
                                        <p>{{$cotizaciones->fecha}}</p>
                                        <hr>
                                        <h3><strong>Nacionalidad</strong></h3>
                                        <p>{{$cliente->nacionalidad}}</p>
                                        <hr>
                                        <h3><strong>N°Pasaporte</strong></h3>
                                        <p>{{$cliente->pasaporte}}</p>
                                        <hr>
                                        <h3><strong>Genero</strong></h3>
                                        <p>{{$cliente->genero}}</p>
                                        <hr>
                                        <h3><strong>Fecha de nacimiento</strong></h3>
                                        <p>{{$cliente->fechanacimiento}}</p>
                                    </div>
                                @endforeach
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="panel-title pull-left" style="font-size:30px;">{{$cliente->nombres}} <small>{{$cliente->email}}</small></h1>
                            <b class="text-warning padding-left-10"> (X{{$cotizaciones->nropersonas}})</b>
                            @for($i = 0; $i < $cotizaciones->nropersonas; $i++)
                                <i class="fa fa-male fa-2x"></i>
                            @endfor
                            <i class="fa fa-check text-success" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="{{$cliente->nombres}} esta activo"></i>
                            <div class="dropdown pull-right">
                                <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Opciones
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <li><a href="?page=update"><i class="fa fa-fw fa-database" aria-hidden="true"></i> Actualizar Datos</a></li>
                                    <li><a href="#"><i class="fa fa-fw fa-check" aria-hidden="true"></i> Friends</a></li>
                                    <li><a href="#">Work</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#"><i class="fa fa-fw fa-plus" aria-hidden="true"></i> Add a new aspect</a></li>
                                </ul>
                            </div>
                        </div>
                        {{--<br><br>--}}
                        <div class="col-md-12 margin-top-20">
                            <div class="progress">

                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                    Datos del pasajero 60%
                                </div>
                            </div>
                        </div>
                        {{--<div class="col-md-12 margin-top-0">--}}
                            {{--<div class="progress">--}}

                                {{--<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">--}}
                                    {{--Datos del pasajero 60%--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="col-md-12">
                            <span class="pull-left pax-nav">
                                <a href="?page=group" class="btn btn-link" style="text-decoration:none;"><i class="fa fa-fw fa-users" aria-hidden="true"></i> Travelers <span class="label label-info">4</span></a>
                                <a href="?page=package" class="btn btn-link" style="text-decoration:none;"><i class="fa fa-fw fa-thumbs-o-up" aria-hidden="true"></i> Itinerario</a>
{{--                                {{$count_pagos}}--}}

                                @if($count_pagos == 0)
                                    <a href="?page=payment" class="btn btn-link" style="text-decoration:none;"><i class="fa fa-fw fa-dollar" aria-hidden="true"></i> Pagos <span class="label label-danger"><i>pendiente</i></span></a>
                                @else
                                    <a href="?page=detail" class="btn btn-link" style="text-decoration:none;"><i class="fa fa-fw fa-dollar" aria-hidden="true"></i> Pagos <span class="label label-warning">4/2 (pend.)</span></a>
                                @endif
                                <a href="?page=flight" class="btn btn-link" style="text-decoration:none;"><i class="fa fa-fw fa-plane" aria-hidden="true"></i> Vuelos</a>
                                {{--<a href="?page=update" class="btn btn-link" style="text-decoration:none;"><i class="fa fa-fw fa-database" aria-hidden="true"></i> Actualizar Datos</a>--}}
                            </span>
                            <span class="pull-right">
                                {{--<a href="#" class="btn btn-link" style="text-decoration:none;"><i class="fa fa-lg fa-at" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Mention"></i></a>--}}
                                <a href="#" class="btn btn-link" style="text-decoration:none;"><i class="fa fa-lg fa-envelope-o" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Message"></i></a>
                                {{--<a href="#" class="btn btn-link" style="text-decoration:none;"><i class="fa fa-lg fa-ban" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Ignore"></i></a>--}}
                            </span>
                        </div>
                        {{--<div class="col-md-12">--}}
                            {{--<hr>--}}
                            {{--<i class="fa fa-tags" aria-hidden="true"></i>--}}
                            {{--<a href="/tags/diaspora" class="tag">Pagos</a> |--}}
                            {{--<a href="/tags/hashtag" class="tag">Grupos</a> |--}}
                            {{--<a href="/tags/caturday" class="tag"></a>--}}
                            {{--<hr>--}}
                        {{--</div>--}}

                    </div>
                </div>
            </div>
            <hr>

            <div class="content-pax">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="pull-left">
                            <a href="#">
                                <img class="media-object img-circle" src="https://lut.im/7JCpw12uUT/mY0Mb78SvSIcjvkf.png" width="50px" height="50px" style="margin-right:8px; margin-top:-5px;">
                            </a>
                        </div>

                        <h4><a href="#" style="text-decoration:none;"><strong>Grupo</strong></a> – <small><small><a href="#" style="text-decoration:none; color:grey;"><i><i class="fa fa-clock-o" aria-hidden="true"></i> ghg</i></a></small></small></h4>

                        <span>
                        <div class="navbar-right">
                            <div class="dropdown">
                                <button class="btn btn-link btn-xs dropdown-toggle" type="button" id="dd1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="fa fa-cog" aria-hidden="true"></i>
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dd1" style="float: right;">
                                    <li><a href="#"><i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i> Report</a></li>
                                    <li><a href="#"><i class="fa fa-fw fa-ban" aria-hidden="true"></i> Ignore</a></li>
                                    <li><a href="#"><i class="fa fa-fw fa-bell" aria-hidden="true"></i> Enable notifications for this post</a></li>
                                    <li><a href="#"><i class="fa fa-fw fa-eye-slash" aria-hidden="true"></i> Hide</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#"><i class="fa fa-fw fa-trash" aria-hidden="true"></i> Delete</a></li>
                                </ul>
                            </div>
                        </div>
                    </span>
                        <hr>
                        <div class="post-content">
                            @foreach($cotizacion as $cotizaciones)
                                @foreach($cotizaciones->cotizaciones_cliente->where('estado', 0) as $coti_cliente)
                                    @foreach($clients->where('id', $coti_cliente->clientes_id) as $cliente)
                                        <div class="col-md-4">
                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="pull-left">
                                                                <a href="#">
                                                                    <img class="media-object img-circle" src="https://diaspote.org/uploads/images/thumb_large_283df6397c4db3fe0344.png" width="50px" height="50px" style="margin-right:8px; margin-top:-5px;">
                                                                </a>
                                                            </div>
                                                            <h4><a href="#" style="text-decoration:none;"><strong>{{$cliente->nombres}} {{$cliente->apellidos}}</strong></a></h4>
                                                        </div>
                                                        <div class="col-md-12 margin-top-10">
                                                            <div class="progress">
                                                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                                                    Datos del pasajero 60%
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="post-content">
                                                        <table class="table table-condensed">
                                                            {{--<caption>table title and/or explanatory text</caption>--}}
                                                            {{--<thead>--}}
                                                            {{--<tr>--}}
                                                            {{--<th>header</th>--}}
                                                            {{--</tr>--}}
                                                            {{--</thead>--}}
                                                            <tbody>
                                                            <tr>
                                                                <td><b>Email:</b></td>
                                                                <td>{{$cliente->email}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Telefono:</b></td>
                                                                <td>{{$cliente->telefono}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Pasaporte:</b></td>
                                                                <td>{{$cliente->pasaporte}}</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>

                                                    {{--<a href="" class="btn btn-warning pull-right">Actualizar datos</a>--}}

                                                    <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-warning pull-right" data-toggle="modal" data-target="#{{$cliente->id}}">
                                                            Actualizar datos
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="{{$cliente->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        <h4 class="modal-title" id="myModalLabel">Actualizar datos</h4>
                                                                    </div>
                                                                    <div class="modal-body clearfix">
                                                                        <form action="">
                                                                            <div class="col-md-12">
                                                                                <div class="panel panel-default">
                                                                                    <div class="panel-body">
                                                                                        <h4><a href="#" style="text-decoration:none;"><strong>Cuenta</strong></a></h4>
                                                                                        {{--<hr>--}}
                                                                                        <div class="form-group">
                                                                                            <label for="exampleInputEmail1">Email address</label>
                                                                                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="exampleInputPassword1">Password</label>
                                                                                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>


                                                                                <div class="panel panel-default">
                                                                                    <div class="panel-body">

                                                                                        {{--<div class="pull-left">--}}
                                                                                        {{--<a href="#">--}}
                                                                                        {{--<img class="media-object img-circle" src="https://diaspote.org/uploads/images/thumb_large_283df6397c4db3fe0344.png" width="50px" height="50px" style="margin-right:8px; margin-top:-5px;">--}}
                                                                                        {{--</a>--}}
                                                                                        {{--</div>--}}
                                                                                        <h4><a href="#" style="text-decoration:none;"><strong>Datos Personales</strong></a></h4>
                                                                                        <hr>

                                                                                        <div class="form-group">
                                                                                            <label for="exampleInputEmail1">Nombres</label>
                                                                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nombre">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="exampleInputEmail1">Apellidos</label>
                                                                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Apellidos">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="exampleInputEmail1">Pasaporte</label>
                                                                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Fecha de nacimiento">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="exampleInputEmail1">Telefono</label>
                                                                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Telefono">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <b>Genero:</b>
                                                                                            <div class="radio">
                                                                                                <label>
                                                                                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                                                                                    Masculino
                                                                                                </label>
                                                                                            </div>
                                                                                            <div class="radio">
                                                                                                <label>
                                                                                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                                                                                    Femenino
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="exampleInputEmail1">Fecha nacimineto</label>
                                                                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Fecha de nacimiento">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="exampleInputEmail1">Nacionalidad</label>
                                                                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nacionalidad">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="exampleInputEmail1">Residencia</label>
                                                                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Residencia">
                                                                                        </div>

                                                                                    </div>
                                                                                </div>

                                                                                <div class="panel panel-default">
                                                                                    <div class="panel-body">

                                                                                        {{--<div class="pull-left">--}}
                                                                                        {{--<a href="#">--}}
                                                                                        {{--<img class="media-object img-circle" src="https://diaspote.org/uploads/images/thumb_large_283df6397c4db3fe0344.png" width="50px" height="50px" style="margin-right:8px; margin-top:-5px;">--}}
                                                                                        {{--</a>--}}
                                                                                        {{--</div>--}}
                                                                                        <h4><a href="#" style="text-decoration:none;"><strong>Restricciones medicas</strong></a></h4>
                                                                                        <hr>

                                                                                        <div class="form-group">
                                                                                            <label for="exampleInputEmail1">Restricciones</label>
                                                                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Restricciones">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="exampleInputEmail1">Alergias</label>
                                                                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Alergias">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="exampleInputEmail1">Dieta</label>
                                                                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Dieta">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="panel panel-default">
                                                                                    <div class="panel-body">

                                                                                        {{--<div class="pull-left">--}}
                                                                                        {{--<a href="#">--}}
                                                                                        {{--<img class="media-object img-circle" src="https://diaspote.org/uploads/images/thumb_large_283df6397c4db3fe0344.png" width="50px" height="50px" style="margin-right:8px; margin-top:-5px;">--}}
                                                                                        {{--</a>--}}
                                                                                        {{--</div>--}}
                                                                                        <h4><a href="#" style="text-decoration:none;"><strong>Comentarios</strong></a></h4>
                                                                                        <hr>

                                                                                        <div class="form-group">
                                                                                            <textarea name="" class="form-control" id="exampleInputEmail1" cols="30" rows="10"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            </div>

                                                                        </form>
                                                                    </div>
                                                                    {{--<div class="modal-footer">--}}
                                                                    {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                                                                    {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
                                                                    {{--</div>--}}
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            @endforeach

                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>

    <script>
        $(document).on('click','.pax-nav a',function(e){
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
//            console.log(page);
            var route = '{{route('pax_show_path', $cotizaciones->id)}}';
            $.ajax({
                data: {page: page},
                url: route,
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    $(".content-pax").html(data);
//                 console.log(data);
                }
            });
        });
    </script>

@stop

