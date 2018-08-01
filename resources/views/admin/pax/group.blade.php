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
